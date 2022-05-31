<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Bancoscuenta;
use App\DiaFeriado;
use DB;

class InformacionController extends Controller {


    use \App\Traits\DecimalConverterTrait;


    public function __construct()
    {
        $this->middleware('auth');
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$aeropuerto=session("aeropuerto");
		if(!$aeropuerto){
			abort(500);
		}
		$estacionamiento=$aeropuerto->estacionamiento()->first();
		if(!$estacionamiento){
			$estacionamiento=$aeropuerto->estacionamiento()->create(['nTurnos' => 0, 'nTaquillas' => 0]);
		}

		$portons=$estacionamiento->portons()->get();

		if($portons->count()==0){
			$portons=$estacionamiento->portons()->create(['nombre'=> 'predeterminado']);
		}

		$conceptosEstacionamiento=$estacionamiento->conceptos()->get();
		if($conceptosEstacionamiento->count()==0){
            $conceptosEstacionamiento=$estacionamiento->conceptos()->create(['nombre'=> 'predeterminado', 'costo' => 0]);
		}

        $tasas=$aeropuerto->tasas()->get();

        $bancos = \App\Banco::get();

        $otrasConfiguraciones = \App\OtrasConfiguraciones::where('aeropuerto_id', session('aeropuerto')->id)->first();

        return view("administracion/informacion", compact("aeropuerto", "estacionamiento", "portons", "conceptosEstacionamiento", "tasas", "bancos", "otrasConfiguraciones"));
	}

    public function dias_feriados(Request $request)
    {
        $aeropuerto = session("aeropuerto");
        $fechas = DB::table('dias_feriados')->where('aeropuerto_id', $aeropuerto->id)->get();

        $anho = date("Y");

        $array_fechas = array();

        foreach($fechas as $fecha)
        {
            $str_fecha = $anho . '-' . $fecha->mes . '-' . $fecha->dia;
            array_push($array_fechas, ['title' => $fecha->porcentaje, 'id' => $fecha->id, 'start' => $str_fecha, 'end' => $str_fecha]);
        }
        return response()->json($array_fechas);
    }

    public function store_dias_feriados(Request $request)
    {
        $dia = $request->get("dia");
        $mes = $request->get("mes");
        $porcentaje = $request->get("porcentaje");
        $aeropuerto = session("aeropuerto");

        $feriado = DiaFeriado::create(['dia' => $dia, 'mes' => $mes, 'porcentaje' => $porcentaje, 'aeropuerto_id' => $aeropuerto->id]);

        return response()->json($feriado);
    }

    public function update_dias_feriados(Request $request)
    {
        $id = $request->get('id');
        $porcentaje = $request->get("porcentaje");

        $feriado = DiaFeriado::find($id);
        $feriado->porcentaje = $porcentaje;
        $feriado->save();

        return response()->json($feriado);
    }

    public function delete_dias_feriados(Request $request)
    {
        $id = $request->get('id');
    
        $feriado = DiaFeriado::find($id);

        $operacion = DB::table('dias_feriados')->where('id', $id)->delete();

        return response()->json(['feriado' => $feriado,'operacion' => $operacion]);
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function update(Request $request)
	{
        
        //actualizando aeropuerto de sesion
		$aeropuerto=session("aeropuerto");
        $aeropuerto->update($request->get("aeropuerto"));
        
        //actualizando bancos
        $bancos=\App\Banco::all();
        $this->actualizarBancos($bancos, $request->get('bancosNuevos',[]), $request->get("bancos", []));
        
        //actualizando cuentas bancarias
        $cuentas=\App\Bancoscuenta::all();
        $this->actualizarCuentas($cuentas, $request->get('cuentasNuevas',[]), $request->get("cuentas", []));
        
        //actualizando estacionamientos del aeropuerto de la sesion
        $estacionamiento=$aeropuerto->estacionamiento;
        $estacionamiento_update = $request->get("estacionamiento");

        $estacionamiento->nTurnos = $estacionamiento_update['nTurnos'];
        $estacionamiento->nTaquillas = $estacionamiento_update['nTaquillas'];
        $estacionamiento->tarjetacosto = $estacionamiento_update['tarjetacosto'];
        $estacionamiento->save();
        //actualizando portones
        $this->actualizarEstacionamientos($estacionamiento, $request->get('portonesNuevos',[]), $request->get("portones", []));

        //actualizando conceptos
        $this->actualizarConceptos($estacionamiento, $request->get('conceptosNuevos',[]), $request->get("conceptos", []));

        //actualizando configuración 
        $otrasConfiguraciones = \App\OtrasConfiguraciones::where('aeropuerto_id', session('aeropuerto')->id)->first();
        $otrasConfiguraciones->update($request->get("otrasConfiguraciones"));



        /**
         *
         * Eliminar las siguientes tablas, si ven este mensaje
         *
         * lista_tasas
         * footers
         * tasa cierres
         * ta tasas
         * tip tasas
         * topes
         * concils
         *



         OK! Lo haré
         */

        $this->actualizarTasas($aeropuerto, $request->get('tasasNuevas',[]), $request->get('tasas',[]));


		return redirect('administracion/informacion');


	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

      /**
     * Habilita/Inhabilita un registro
     * @param  int  $id
     * @return Response
     */
     public function estadoBanco(Request $request)
   {
        $id      = $request->input('id');
        $banco = \App\Banco::find($id);

       if ($banco->mostrarEnResumen == '0')
       {
            $banco->mostrarEnResumen = '1';
            $mensaje       = "Estado 'Mostrar saldo de banco en resumen' activado exitósamente";
            $mensajeError  = "Ocurrió un error activando el estado 'mostrar saldo de banco en resumen'.";
       } 
       else
       {
            $banco->mostrarEnResumen = '0';
            $mensaje       = "Estado 'Mostrar saldo de banco en resumen' desactivado exitósamente";
            $mensajeError  = "Ocurrió un error desactivando el estado 'mostrar saldo de banco en resumen'.";
       }
       if($banco->save())
       {
           return response()->json(array("text"=>$mensaje,
               "banco"=>$banco,
               "success"=>1));

       }
       else
       {
           return response()->json(array("text"=>$mensajeError, "success"=>0));
       }
   }


    /**
     * Habilita/Inhabilita un registro
     * @param  int  $id
     * @return Response
     */
     public function estadoCuenta(Request $request)
   {
        $id      = $request->input('id');
        $account = Bancoscuenta::find($id);

       if ($account->isActivo == '0')
       {
            $account->isActivo = '1';
            $mensaje       = "Número de cuenta activada exitósamente";
            $mensajeError  = "Ocurrió un error activando la cuenta.";
       } 
       else
       {
            $account->isActivo = '0';
            $mensaje       = "Número de cuenta desactivada exitósamente";
            $mensajeError  = "Ocurrió un error desactivando la cuenta.";
       }
       if($account->save())
       {
           return response()->json(array("text"=>$mensaje,
               "cuenta"=>$account,
               "success"=>1));

       }
       else
       {
           return response()->json(array("text"=>$mensajeError, "success"=>0));
       }
   }


    /**
     *
     * Estos tres metodos de abajo se pudieran combinar en uno ya que basicamente hacen lo mismo
     * pero se los dejo de tarea.
     *
     */
    protected function actualizarBancos($bancos, $nuevos, $actualizados){

        foreach($actualizados as $bancoID => $banco){
            $bancos->find($bancoID)->update($banco);
        }
        list($keys, $values) = array_divide($actualizados);
        $bancosBorrar=\App\Banco::whereNotIn('id',$keys)->get();
        $bancosBorrar->each(function($banco){
            $banco->delete();
        });
        foreach($nuevos as $banco){

            $bancosCreate = \App\Banco::create($banco);
        }
    }

    protected function actualizarCuentas($cuentas, $nuevos, $actualizados){

        foreach($actualizados as $cuentaID => $cuenta){
            $cuentas->find($cuentaID)->update($cuenta);
        }
        list($keys, $values) = array_divide($actualizados);
        $cuentasBorrar=\App\Bancoscuenta::whereNotIn('id',$keys)->get();
        $cuentasBorrar->each(function($cuenta){
            $cuenta->delete();
        });
        foreach($nuevos as $cuenta){
            $cuenta['banco_id'] = (int)$cuenta['banco_id'];
            $cuentasCreate = new Bancoscuenta();
            $cuentasCreate->descripcion = $cuenta['descripcion'];
            $cuentasCreate->banco_id    = $cuenta['banco_id'];
            $cuentasCreate->isActivo    = 1;
            $cuentasCreate->save();
        }
    }
    
    protected function actualizarEstacionamientos($estacionamiento, $nuevos, $actualizados){

        foreach($actualizados as $portonId => $porton){
            $estacionamiento->portons()->find($portonId)->update($porton);
        }
        list($keys, $values) = array_divide($actualizados);
        $portonesBorrar=$estacionamiento->portons()->whereNotIn('id',$keys)->get();
        $portonesBorrar->each(function($porton){
            $porton->delete();
        });
        foreach($nuevos as $porton){
            $estacionamiento->portons()->create($porton);
        }
    }

    protected function actualizarConceptos($estacionamiento, $nuevos, $actualizados){

        foreach($actualizados as $conceptoId => $concepto){
            $estacionamiento->conceptos()->find($conceptoId)->update($concepto);
        }
        list($keys, $values) = array_divide($actualizados);
        $conceptosBorrar=$estacionamiento->conceptos()->whereNotIn('id',$keys)->get();
        $conceptosBorrar->each(function($concepto){
            $concepto->delete();
        });
        foreach($nuevos as $concepto){
            $estacionamiento->conceptos()->create($concepto);
        }

    }

    protected function actualizarTasas($aeropuerto, $tasasNuevas, $tasas){

        foreach($tasas as $tasaId => $tasa){
            $aeropuerto->tasas()->find($tasaId)->update($tasa);
        }
        list($keys, $values) = array_divide($tasas);
        $tasasBorrar=$aeropuerto->tasas()->whereNotIn('id',$keys)->get();
        $tasasBorrar->each(function($tasa){
            $tasa->delete();
        });
        foreach($tasasNuevas as $tasa){
            $aeropuerto->tasas()->create($tasa);
        }

    }    
}
