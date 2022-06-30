<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\DespegueRequest;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;

use Illuminate\Http\Request;

use App\Despegue;
use App\Pasajero;
use App\Aterrizaje;
use App\Puerto;
use App\Piloto;
use App\NacionalidadVuelo;
use App\Aeronave;
use App\TipoMatricula;
use App\Cliente;
use App\OtrosCargo;
use App\Factura;
use App\CargosVario;
use App\Facturadetalle;
use App\MontosFijo;
use App\Concepto;
use App\HorariosAeronautico;
use App\EstacionamientoAeronave;
use App\PreciosAterrizajesDespegue;
use App\PreciosCarga;
use App\DiaFeriado;

use Carbon\Carbon;
use Validator;
use App\Estacionamiento;
use App\Fbo;

class DespegueController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $fecha            = $request->get('fecha');
            if ($fecha == "") {
                $fecha = "0000-00-00";
            } else {
                $fecha            = \Carbon\Carbon::createFromFormat('d/m/Y', $fecha);
                $fecha            = $fecha->toDateString();
            }
            $hora            = $request->get('hora');
            if ($hora == "") {
                $hora = "00:00:00";
            }
            $aeropuerto_id    = session('aeropuerto')->id;
            $despegues      = Despegue::filter($fecha, $hora, $request->get('aeronave_id'), $request->get('num_vuelo'), $request->get('puerto_id'), $request->get('cliente_id'), $aeropuerto_id);
            $despegues->with('factura');
            $totalDespegues = $despegues->count();
            $despegues      = $despegues->paginate(7);
            $fbos                = Fbo::all();

            return view('despegues.partials.table', compact('despegues', 'totalDespegues',"fbos"));
        } else {
            $aterrizajes         = Aterrizaje::all();
            $aeronaves           = Aeronave::all();
            $puertos             = Puerto::all();
            $pilotos             = Piloto::all();
            $nacionalidad_vuelos = NacionalidadVuelo::all();
            $aeronaves           = Aeronave::all();
            $tipoMatriculas      = TipoMatricula::all();
            $otrosCargos         = OtrosCargo::all();
            $today               = Carbon::now();
            $today->timezone     = 'America/New_York';
            $fbos                = Fbo::all();


            return view("despegues.index", compact("aterrizajes", "otrosCargos", "nacionalidad_vuelos", "tipoMatriculas", "aeronaves", "puertos", "pilotos", "today","fbos"));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($aterrizaje)
    {
        $aterrizaje          = Aterrizaje::with("aeronave", "puerto", "nacionalidad_vuelo")->where('id', $aterrizaje)->first();
        $hangarLocal = false;
        if ($aterrizaje->aeronave->hangar_id != NULL) {
            $hangarID = $aterrizaje->aeronave->hangar_id;
            $hangar = \App\Hangar::find($hangarID);
            if ($hangar->aeropuerto_id == session('aeropuerto')->id) {
                $hangarLocal = true;
            }
        }
        $puertos             = Puerto::all();
        $pilotos             = Piloto::all();
        $nacionalidad_vuelos = NacionalidadVuelo::all();
        $aeronaves           = Aeronave::all();
        $tipoMatriculas      = TipoMatricula::all();
        $today               = Carbon::now();
        $fbos                = Fbo::all();

        $today->timezone     = 'America/New_York';

        //FILTRO OTROS CARGOS
        $aeropuerto = session('aeropuerto')->id;
        $procedencia = $aterrizaje->nacionalidadVuelo_id;
        $peso = $aterrizaje->aeronave->peso;
        $tipo_matricula = $aterrizaje->aeronave->tipo_id;

        if ($aterrizaje->aeronave->nacionalidad_id == 246) {
            //246 - VENEZUELA, MATRICULA NACIONAL
            $nacionalidad_matricula = 1; //1 - NACIONAL, NACIONALIDAD VUELO
        } else {
            //DIFERENTE A 246, MATRICULA INTERNACIONAL
            $nacionalidad_matricula = 2; //2 - INTERNACIONAL, NACIONALIDAD VUELO
        }

        $otrosCargos        = OtrosCargo::where('aeropuerto_id', $aeropuerto)
            ->where('cantidad_unidades', '<>', 0)
            ->where('peso_desde', '<=', $peso)
            ->where('peso_hasta', '>=', $peso)
            ->where('procedencia', $procedencia)
            ->where('nacionalidad_matricula', $nacionalidad_matricula)
            ->where('tipo_matricula', $tipo_matricula)
            ->orderBy('nombre_cargo')->lists('nombre_cargo', 'id');

        return view("despegues.create", compact("aterrizaje", "hangarLocal", "otrosCargos", "nacionalidad_vuelos", "tipoMatriculas", "aeronaves", "puertos", "pilotos", "today","fbos"));
    }

    public function filtro(Request $request)
    {

        //FILTRO OTROS CARGOS
        $aterrizaje =  Aterrizaje::with('aeronave')->find($request->aterrizaje_id);
        $aeropuerto = $aterrizaje->aeropuerto_id;
        $procedencia = $aterrizaje->nacionalidadVuelo_id;
        $peso = $aterrizaje->aeronave->peso;
        $tipo_matricula = $request->tipoMatricula_id;

        if ($aterrizaje->aeronave->nacionalidad_id == 246) {
            //246 - VENEZUELA, MATRICULA NACIONAL
            $nacionalidad_matricula = 1; //1 - NACIONAL, NACIONALIDAD VUELO
        } else {
            //DIFERENTE A 246, MATRICULA INTERNACIONAL
            $nacionalidad_matricula = 2; //2 - INTERNACIONAL, NACIONALIDAD VUELO
        }

        $conceptosCondicion = Concepto::where('condicionPago', $request->condicionPago)->lists('id');

        //print_r(["aterrizaje" => $aterrizaje,"aeropuerto" => $aeropuerto, "procedencia" => $procedencia, "peso" => $peso, "tipo_matricula" => $tipo_matricula, "nacionalidad_matricula" => $nacionalidad_matricula, "conceptosCondicion" => $conceptosCondicion]);

        $otrosCargos        = OtrosCargo::where('aeropuerto_id', $aeropuerto)
            ->where('cantidad_unidades', '<>', 0)
            ->whereIn('concepto_id', $conceptosCondicion)
            ->where('peso_desde', '<=', $peso)
            ->where('peso_hasta', '>=', $peso)
            ->where('procedencia', $procedencia)
            ->where('nacionalidad_matricula', $nacionalidad_matricula)
            ->where('tipo_matricula', $tipo_matricula)
            ->orderBy('nombre_cargo')->lists('nombre_cargo', 'id');

        return response($otrosCargos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(DespegueRequest $request)
    {
        $fecha     = \Carbon\Carbon::createFromFormat('d/m/Y', $request->get('fecha'));
        $fecha     = $fecha->toDateString();
        $despegues = Despegue::where('aeronave_id', $request->get('aeronave_id'))
            ->where('fecha', $fecha)
            ->where('hora', $request->get('hora'))
            ->get();
        if ($despegues->count() > 0)
            return response()->json(array("text" => 'Despegue Duplicado', "success" => 0));
        else {
            $fechaD = $fecha . ' ' . $request->get('hora');
            $at     = Aterrizaje::where('id', $request->get("aterrizaje_id"))->first();
            $fechaA = \Carbon\Carbon::createFromFormat('d/m/Y', $at->fecha);
            $fechaA = $fechaA->toDateString();
            $fechaA = $fechaA . ' ' . $at->hora;
            if ($fechaA >= $fechaD)
                return response()->json(array("text" => 'Fecha y hora de despegue no puede ser menor a su aterrizaje', "success" => 0));
        }

        $despegue                         = Despegue::create($request->except("piloto_id", "puerto_id", "cliente_id", "cobrar_estacionamiento", "cobrar_puenteAbordaje", "cobrar_Formulario", "cobrar_AterDesp", "cobrar_habilitacion", "cobrar_carga", "cobrar_otrosCargos", "otrosCargo_id"));
        $aterrizaje                       = Aterrizaje::find($request->get("aterrizaje_id"));
        $aterrizaje->despegue()->save($despegue);
        $aterrizaje->update(["despego"    => "1"]);
        $despegue->cobrar_estacionamiento = $request->input('cobrar_estacionamiento', 0);
        $despegue->cobrar_puenteAbordaje  = $request->input('cobrar_puenteAbordaje', 0);
        $despegue->cobrar_Formulario      = $request->input('cobrar_Formulario', 1);
        $despegue->cobrar_AterDesp        = $request->input('cobrar_AterDesp', 0);
        $despegue->cobrar_AterDesp        = $request->input('cobrar_AterDesp', 0);
        $despegue->cobrar_carga           = $request->input('cobrar_carga', 0);
        $despegue->cobrar_otrosCargos     = $request->input('cobrar_otrosCargos', 0);
        $otrosCargos = $request->input('otrosCargo_id', []);
        /*foreach ($otrosCargos as $oc) {
            $precio[] = \App\OtrosCargo::where('id', $oc)->first()->precio_cargo;
        }
        $despegue->otros_cargos()->sync($otrosCargos, array('precio'));*/
        $despegue->otros_cargos()->sync($otrosCargos);
        $hora              = $aterrizaje->hora;
        $inicioOperaciones = HorariosAeronautico::first()->operaciones_inicio;
        $finOperaciones    = HorariosAeronautico::first()->operaciones_fin;

        if ($hora > $inicioOperaciones && $hora < $finOperaciones) {
            $despegue->cobrar_habilitacion  = '0';
        } else {
            $despegue->cobrar_habilitacion  = '1';
        }
        if ($despegue) {

            $puertoID  = $puerto = Puerto::find($request->get("puerto_id"));
            $pilotoID  = $piloto = Piloto::find($request->get("piloto_id"));
            $clienteID = $cliente = Cliente::find($request->get("cliente_id"));
            $fboID = $fbo = Fbo::find($request->get("fbo_id"));

            $puertoID  = ($puertoID) ? $puerto->id : NULL;
            $pilotoID  = ($pilotoID) ? $piloto->id : NULL;
            $clienteID = ($clienteID) ? $cliente->id : NULL;
            $fboID = ($fboID) ? $fbo->id : NULL;


            $despegue->puerto_id            = $puertoID;
            $despegue->piloto_id            = $pilotoID;
            $despegue->cliente_id           = $clienteID;
            $despegue->fbo_id               = $fboID;
            $despegue->save();

            return response()->json(array(
                "text"   => 'Despegue registrado exitósamente',
                "success" => 1
            ));
        } else {
            response()->json(array("text" => 'Error registrando el despegue', "success" => 0));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */

    public function show($aterrizaje, $id)
    {
        $despegue            = Despegue::find($id);
        $puertos             = Puerto::all();
        $pilotos             = Piloto::all();
        $nacionalidad_vuelos = NacionalidadVuelo::all();
        $aeronaves           = Aeronave::all();
        $tipoMatriculas      = TipoMatricula::all();
        $otrosCargos         = OtrosCargo::lists('nombre_cargo', 'id');
        return view("despegues.partials.show", compact("despegue", "otrosCargos", "nacionalidad_vuelos", "tipoMatriculas", "aeronaves", "puertos", "pilotos"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */

    public function edit($aterrizaje, $id)
    {
        $despegue            = Despegue::find($id);
        $puertos             = Puerto::all();
        $clientes             = Cliente::all();
        $pilotos             = Piloto::all();
        $nacionalidad_vuelos = NacionalidadVuelo::all();
        $aeronaves           = Aeronave::all();
        $tipoMatriculas      = TipoMatricula::all();
        $fbos                = Fbo::all();

        $otrosCargos         = OtrosCargo::lists('nombre_cargo', 'id');
        return view("despegues.partials.edit", compact("despegue", "otrosCargos", "nacionalidad_vuelos", "tipoMatriculas", "aeronaves", "puertos", "pilotos","fbos"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($aterrizaje, $id, DespegueRequest $request)
    {
        $despegue     = Despegue::find($id);
        $despegue->update($request->except("nacionalidadVuelo_id", "piloto_id", "puerto_id", "cliente_id", "cobrar_estacionamiento", "cobrar_puenteAbordaje", "cobrar_Formulario", "cobrar_AterDesp", "cobrar_habilitacion", "cobrar_carga", "tiempo_estacionamiento"));

        $cobrarAterrizaje      = $request->input('cobrar_AterDesp');
        $cobrarFormulario      = $request->input('cobrar_Formulario');
        $cobrarPuentes         = $request->input('cobrar_puenteAbordaje');
        $cobrarEstacionamiento = $request->input('cobrar_estacionamiento');
        $cobrarCarga           = $request->input('cobrar_carga');

        $cobrarAterrizaje      = ($cobrarAterrizaje) ? 1 : 0;
        $cobrarFormulario      = ($cobrarFormulario) ? 1 : 0;
        $cobrarPuentes         = ($cobrarPuentes) ? 1 : 0;
        $cobrarEstacionamiento = ($cobrarEstacionamiento) ? 1 : 0;
        $cobrarCarga           = ($cobrarCarga) ? 1 : 0;

        $despegue->cobrar_AterDesp        = $cobrarAterrizaje;
        $despegue->cobrar_Formulario      = $cobrarFormulario;
        $despegue->cobrar_puenteAbordaje  = $cobrarPuentes;
        $despegue->cobrar_estacionamiento = $cobrarEstacionamiento;
        $despegue->cobrar_carga           = $cobrarCarga;

        if ($cobrarEstacionamiento == 1) {

            $fechaAterrizaje       = $despegue->aterrizaje->fecha;
            $fechaAterrizaje       = Carbon::createFromFormat('d/m/Y', $fechaAterrizaje);
            $fechaAterrizaje       = $fechaAterrizaje->format('Y-m-d');
            $horaAterrizaje        = $despegue->aterrizaje->hora;
            $fecha_hora_aterrizaje = $fechaAterrizaje . ' ' . $horaAterrizaje;


            $fechaDespegue         = $request->fecha;
            $fechaDespegue         = Carbon::createFromFormat('d/m/Y', $fechaDespegue);
            $fechaDespegue         = $fechaDespegue->format('Y-m-d');
            $horaDespegue          = $despegue->hora;
            $fecha_hora_despegue   = $fechaDespegue . ' ' . $horaDespegue;

            $startTime             = Carbon::parse($fecha_hora_aterrizaje);
            $finishTime            = Carbon::parse($fecha_hora_despegue);

            $totalDuration = $finishTime->diffInMinutes($startTime);
            $despegue->tiempo_estacionamiento = $totalDuration;
            $despegue->save();
        }


        //$despegue->cobrar_otrosCargos     =$request->input('cobrar_otrosCargos', 0);
        /*$otrosCargos =$request->input('otrosCargo_id', []);
            foreach ($otrosCargos as $oc) {
                $precio[] = \App\OtrosCargo::where('id', $oc)->first()->precio_cargo;
            }
            $despegue->otros_cargos()->sync($otrosCargos, array('precio'));
            */
        if ($despegue) {

            $nacID     = $nacionalidad = NacionalidadVuelo::find($request->get("nacionalidadVuelo_id"));
            $puertoID  = $puerto = Puerto::find($request->get("puerto_id"));
            $pilotoID  = $piloto = Piloto::find($request->get("piloto_id"));
            $clienteID = $cliente = Cliente::find($request->get("cliente_id"));

            $nacID     = ($nacID) ? $nacionalidad->id : NULL;
            $puertoID  = ($puertoID) ? $puerto->id : NULL;
            $pilotoID  = ($pilotoID) ? $piloto->id : NULL;
            $clienteID = ($clienteID) ? $cliente->id : NULL;

            $despegue->nacionalidadVuelo_id = $nacID;
            $despegue->puerto_id            = $puertoID;
            $despegue->piloto_id            = $pilotoID;
            $despegue->cliente_id           = $clienteID;
            $despegue->save();

            return response()->json(array(
                "text"   => 'Despegue modificado exitósamente',
                "success" => 1
            ));
        } else {
            response()->json(array("text" => 'Error modificando el despegue', "success" => 0));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($aterrizaje, $id)
    {
        $despegue   = Despegue::find($id);
        $aterrizaje = Aterrizaje::find($aterrizaje);
        $despegue->otros_cargos()->detach();
        if (\App\Despegue::destroy($id)) {
            $aterrizaje->update(['despego' => '0']);
            return ["success" => 1, "text" => "Despegue eliminado con éxito."];
        } else {
            return ["success" => 0, "text" => "Error eliminando el registro."];
        }
    }

    public function getCrearFactura($id)
    {
        //DIA FERIADO
        
        $hoy = Carbon::now();
        $dia = $hoy->format('d');
        $mes = $hoy->format('m');
        $feriado = DiaFeriado::where('aeropuerto_id', session('aeropuerto')->id)->where('dia', $dia)->where('mes', $mes)->first();
        //Información general de la factura a crear.
        $despegue               = Despegue::find($id);
        $tipo_matricula = $despegue->aterrizaje->aeronave->tipo_id;
        $factura                = new Factura();

        $euro                  = MontosFijo::where('aeropuerto_id', session('aeropuerto')->id)->first()->euro_oficial;
        $condicionPago          = $despegue->condicionPago;
        if ($condicionPago == 'Exonerado') {
            $modulo                 = \App\Modulo::find(26)->nombre;
        }else{
            $modulo                 = \App\Modulo::find(5)->nombre;
            
        }
        // dd($condicionPago );
        $peso                   = ($despegue->aterrizaje->aeronave->peso) / 1000;
        $peso_aeronave          = ceil($peso);
        $mensajeEstacionamiento = ' ';
        $mensajeAterrizaje      = ' ';
        $nacionalidad = $despegue->aterrizaje->nacionalidadVuelo_id;

        $conceptosCon = \App\Concepto::where('aeropuerto_id', session('aeropuerto')->id)->where('condicionPago', '=', 'Contado')->lists('id');
        $conceptosCre = \App\Concepto::where('aeropuerto_id', session('aeropuerto')->id)->where('condicionPago', '=', 'Crédito')->lists('id');
        $conceptosAmb = \App\Concepto::where('aeropuerto_id', session('aeropuerto')->id)->where('condicionPago', '=', 'Ambas')->lists('id');
        $err = false;

        $aplica_minimo_estacionamiento = false;
        $aplica_minimo_aterrizaje      = false;

        $nroDosa = '1';
        $facturas = Factura::all()->count();
        if ($facturas > 0) {
            $dosas = Factura::where('nroDosa', '<>', 'NULL')->count();
            if ($dosas > 0) {
                $nroDosa = Factura::where('nroDosa', '<>', 'NULL')->orderBy('nroDosa', 'DESC')->first()->nroDosa;
                if ($nroDosa != NULL) {
                    $nroDosa = $nroDosa + 1;
                }
            }
        }

        $factura->fill([
            'aeropuerto_id' => $despegue->aeropuerto_id,
            'cliente_id'    => $despegue->cliente_id,
            'nroDosa'       => $nroDosa
        ]);
        
        $factura->detalles = new Collection();

        //Ítem de Formulario.
        if ($despegue->cobrar_Formulario == '1') {
            $formulario        = new Facturadetalle();
            $eq_formulario     = CargosVario::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_formulario;
            $eq_formulario_inter    = CargosVario::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_formulario_inter;
            $precio_formulario = CargosVario::where('aeropuerto_id', session('aeropuerto')->id)->first()->precio_formulario;
            switch ($condicionPago) {
                case 'Contado':
                    $concepto_id  = CargosVario::where('aeropuerto_id', session('aeropuerto')->id)->wherein('formularioContado_id', $conceptosAmb)->Orwherein('formularioContado_id', $conceptosCon)->firstOrFail()->formularioContado_id;
                    break;
                case 'Crédito':
                    $concepto_id  = CargosVario::where('aeropuerto_id', session('aeropuerto')->id)->wherein('formularioCredito_id', $conceptosAmb)->Orwherein('formularioCredito_id', $conceptosCre)->firstOrFail()->formularioCredito_id;
                    break;
                case 'Exonerado':
                    $concepto_id=1;
                    break;
                }
                
            //ID-246 ES VENEZUELA, NACIONALIDAD NACIONAL Y TODO LO DEMAS ES INTERNACIONAL
            if ($despegue->aeronave->nacionalidad_id == 246)
                $montoDes      = $precio_formulario + 0;
            else {
                $montoDes      = $eq_formulario_inter * $euro;
            }
            $cantidadDes       = '1';
            $iva               = Concepto::find($concepto_id)->iva;
            $montoIva          = ($iva * $montoDes) / 100;
            $totalDes          = $montoDes + $montoIva;
            
            //SI FERIADO - SI EL CONCEPTO EXISTE Y SI ACEPTA RECARGO - TIPO MATRICULA - ID 3 - MATRICULA COMERCIAL EXCENTO DE RECARGO SEGUN GACETA (DECRETO MARZO 2018)
            $concepto      = Concepto::find($concepto_id);
            if (isset($feriado) && isset($concepto) && ($concepto->recargo == 'SI') && ($tipo_matricula != 3)) {
                $recargoPerDes = $feriado->porcentaje;
            } else
                $recargoPerDes = 0;

            $formulario->fill(compact('concepto_id', 'condicionPago', 'montoDes', 'cantidadDes', 'iva', 'totalDes', 'recargoPerDes'));
            $factura->detalles->push($formulario);
        }

        //Ítem de Estacionamiento.
        
        if ($despegue->cobrar_estacionamiento == '1') {
            $estacionamiento = new Facturadetalle();
            $nacionalidad    = $despegue->aterrizaje->nacionalidadVuelo_id;
            $tipoVuelo       = $despegue->aterrizaje->tipoMatricula_id;
            
            
            switch ($condicionPago) {
                case 'Contado':
                    $concepto_id     = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->wherein('conceptoContado_id', $conceptosAmb)->Orwherein('conceptoContado_id', $conceptosCon)->firstOrFail()->conceptoContado_id;
                    break;
                case 'Crédito':
                    $concepto_id     = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->wherein('conceptoCredito_id', $conceptosAmb)->Orwherein('conceptoCredito_id', $conceptosCre)->firstOrFail()->conceptoCredito_id;
                    break;
                case 'Exonerado':
                    $concepto_id = 1;
                    break;
            }


            if ($despegue->aterrizaje->aeronave->nacionalidad->nombre == "Venezuela") {

                if ($tipoVuelo == 2 || $tipoVuelo == 3) {
                    switch ($nacionalidad) {
                        case 1:
                            $minutosLibre           = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->tiempoLibreNac;
                            $eq_bloque              = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_bloqueNac;
                            $precio_estacionamiento = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->precio_estNac;
                            $minutosBloque          = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->minBloqueNac;
                            $aplicaMinimo           = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->aplicar_minimo_nac;
                            $minimo = ($aplicaMinimo == 1) ? EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_bloqueMinimoNac : 0;
                            $tipoEstacionamiento  = 'Nacional';
                            break;
                        case 2:
                            $minutosLibre           = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->tiempoLibreInt;
                            $eq_bloque              = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_bloqueInt;
                            $precio_estacionamiento = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->precio_estInt;
                            $minutosBloque          = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->minBloqueInt;
                            $aplicaMinimo           = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->aplicar_minimo_int;
                            $minimo = ($aplicaMinimo == 1) ? EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_bloqueMinimoInt : 0;
                            $tipoEstacionamiento  = 'Internacional';
                            break;
                    }
                } else {
                    switch ($nacionalidad) {
                        case 1:
                            $minutosLibre           = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->tiempoLibreNac_general;
                            $eq_bloque              = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_bloqueNac_general;
                            $precio_estacionamiento = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->precio_estNac_general;
                            $minutosBloque          = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->minBloqueNac_general;
                            $aplicaMinimo           = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->aplicar_minimo_nac_general;
                            $minimo = ($aplicaMinimo == 1) ? EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_bloqueMinimoNac_general : 0;
                            $tipoEstacionamiento  = 'Nacional';
                            break;
                            case 2:
                                $minutosLibre           = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->tiempoLibreInt_general;
                                $eq_bloque              = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_bloqueInt_general;
                            $precio_estacionamiento = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->precio_estInt_general;
                            $minutosBloque          = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->minBloqueInt_general;
                            $aplicaMinimo           = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->aplicar_minimo_int_general;
                            $minimo = ($aplicaMinimo == 1) ? EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_bloqueMinimoInt_general : 0;
                            $tipoEstacionamiento  = 'Internacional';
                            break;
                    }
                }
            } else {

                if ($tipoVuelo == 2 || $tipoVuelo == 3) {

                    switch ($nacionalidad) {
                        case 1:
                            $minutosLibre           = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->tiempoLibreNac_ext;
                            $eq_bloque              = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_bloqueNac_ext;
                            $precio_estacionamiento = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->precio_estNac_ext;
                            $minutosBloque          = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->minBloqueNac_ext;
                            $aplicaMinimo           = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->aplicar_minimo_nac_ext;
                            $minimo = ($aplicaMinimo == 1) ? EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_bloqueMinimoNac_ext : 0;
                            $tipoEstacionamiento  = 'Nacional';
                            break;
                        case 2:
                            $minutosLibre           = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->tiempoLibreInt_ext;
                            $eq_bloque              = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_bloqueInt_ext;
                            $precio_estacionamiento = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->precio_estInt_ext;
                            $minutosBloque          = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->minBloqueInt_ext;
                            $aplicaMinimo           = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->aplicar_minimo_int_ext;
                            $minimo = ($aplicaMinimo == 1) ? EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_bloqueMinimoInt_ext : 0;
                            $tipoEstacionamiento  = 'Internacional';
                            break;
                    }
                } else {
                    switch ($nacionalidad) {
                        case 1:
                            $minutosLibre           = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->tiempoLibreNac_general_ext;
                            $eq_bloque              = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_bloqueNac_general_ext;
                            $precio_estacionamiento = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->precio_estNac_general_ext;
                            $minutosBloque          = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->minBloqueNac_general_ext;
                            $aplicaMinimo           = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->aplicar_minimo_nac_general_ext;
                            $minimo = ($aplicaMinimo == 1) ? EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_bloqueMinimoNac_general_ext : 0;
                            $tipoEstacionamiento  = 'Nacional';
                            break;
                        case 2:
                            $minutosLibre           = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->tiempoLibreInt_general_ext;
                            $eq_bloque              = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_bloqueInt_general_ext;
                            $precio_estacionamiento = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->precio_estInt_general_ext;
                            $minutosBloque          = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->minBloqueInt_general_ext;
                            $aplicaMinimo           = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->aplicar_minimo_int_general_ext;
                            $minimo = ($aplicaMinimo == 1) ? EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_bloqueMinimoInt_general_ext : 0;
                            $tipoEstacionamiento  = 'Internacional';
                            break;
                    }
                }
            }
            


            $tiempo_estacionamiento = $despegue->tiempo_estacionamiento;
            $tiempoAFacturar        = ($tiempo_estacionamiento - $minutosLibre) / $minutosBloque;
            $mensajeEstacionamiento = "Estacionamiento Exonerado.";

            if ($tiempoAFacturar > 0) {
                $mensajeEstacionamiento = 'Estacionamiento ' . $tipoEstacionamiento . '. Horas: ' . intval($tiempoAFacturar) . ', Tiempo libre: ' . $minutosLibre . ' min.';
                $tiempoAFacturar = ceil($tiempoAFacturar);

                if ($tiempoAFacturar > 8 && $despegue->aterrizaje->aeronave->nacionalidad->nombre != "Venezuela") {
                    $tiempoAFacturar = 8 + ceil(($tiempoAFacturar - 8) / 8);
                }

                if ($minimo == 0) {

                    //Calculo Estandar
                    if ($despegue->aterrizaje->aeronave->nacionalidad->nombre != "Venezuela")
                        $equivalente = $eq_bloque * $euro;

                    $montoDes        = ($equivalente * $tiempoAFacturar * $peso_aeronave);
                    $cantidadDes     = '1';
                    $iva             = Concepto::find($concepto_id)->iva;
                    $montoIva        = ($iva * $montoDes) / 100;
                    $totalDes        = $montoDes + $montoIva;
                } else {

                    $cantidadDes     = '1';
                    $iva             = Concepto::find($concepto_id)->iva;

                    //Calculo Estandar
                    $equivalenteEstandar = $precio_estacionamiento;
                    if ($despegue->aterrizaje->aeronave->nacionalidad->nombre != "Venezuela")
                        $equivalenteEstandar = $eq_bloque * $euro;
                    $montoDesEstandar    = ($equivalenteEstandar * $tiempoAFacturar * $peso_aeronave);
                    $montoIvaEstandar    = ($iva * $montoDesEstandar) / 100;
                    $totalDesEstandar    = $montoDesEstandar + $montoIvaEstandar;

                    //Cálculo con mínimo
                    $montoDesMinimo    = $minimo * $this->monto_minimo_est_despegue($despegue);
                    if ($despegue->aterrizaje->aeronave->nacionalidad->nombre != "Venezuela")
                        $montoDesMinimo = $minimo * $euro;

                    $montoIvaMinimo    = ($iva * $montoDesMinimo) / 100;
                    $totalDesMinimo    = $montoDesMinimo + $montoIvaMinimo;

                    $montoDes = max($montoDesEstandar, $montoDesMinimo);
                    $totalDes = max($totalDesEstandar, $totalDesMinimo);


                    if ($totalDesMinimo > $totalDesEstandar) {
                        $mensajeEstacionamiento        = $mensajeEstacionamiento . ' (Aplica Cobro Mínimo)';
                        $aplica_minimo_estacionamiento = true;
                    }
                }

                //SI FERIADO - SI EL CONCEPTO EXISTE Y SI ACEPTA RECARGO - TIPO MATRICULA - ID 3 - MATRICULA COMERCIAL EXCENTO DE RECARGO SEGUN GACETA (DECRETO MARZO 2018)
                $concepto      = Concepto::find($concepto_id);
                if (isset($feriado) && isset($concepto) && ($concepto->recargo == 'SI') && ($tipo_matricula != 3)) {
                    $recargoPerDes = $feriado->porcentaje;
                } else
                    $recargoPerDes = 0;

                $estacionamiento->fill(compact('concepto_id', 'condicionPago',  'montoDes', 'cantidadDes', 'iva', 'totalDes', 'recargoPerDes'));
                $factura->detalles->push($estacionamiento);
            }
        }

        //Ítem de Aterrizaje y Despegue

        if ($despegue->cobrar_AterDesp == '1') {
            $aterrizajeDespegue = new Facturadetalle();
            $nacionalidad       = $despegue->aterrizaje->nacionalidadVuelo_id;
            $hora               = $despegue->aterrizaje->hora;
            $salidaSol          = HorariosAeronautico::where('aeropuerto_id', session('aeropuerto')->id)->first()->sol_salida;
            $puestaSol          = HorariosAeronautico::where('aeropuerto_id', session('aeropuerto')->id)->first()->sol_puesta;
            $tipoVuelo          = $despegue->aterrizaje->tipoMatricula_id;

            switch ($condicionPago) {
                case 'Contado':
                    $concepto_id     = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->wherein('conceptoContado_id', $conceptosAmb)->Orwherein('conceptoContado_id', $conceptosCon)->firstOrFail()->conceptoContado_id;
                    break;
                case 'Crédito':
                    $concepto_id     = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->wherein('conceptoCredito_id', $conceptosAmb)->Orwherein('conceptoCredito_id', $conceptosCre)->firstOrFail()->conceptoCredito_id;
                    break;
                case 'Exonerado':
                    $concepto_id=1;
                    break;
            }


            if ($despegue->aterrizaje->aeronave->nacionalidad->nombre == "Venezuela") {
                if ($tipoVuelo == 2 || $tipoVuelo == 3) {

                    if ($hora > $salidaSol && $hora < $puestaSol) {
                        switch ($nacionalidad) {
                            case 1:
                                $eq_aterDesp     = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_diurnoNac;
                                $precio_AterDesp = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->precio_diurnoNac;
                                $tipoAterrizaje  = 'Diurno Nacional';
                                $aplicaMinimo    = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->aplicar_minimo_diuNac;
                                $minimo          = ($aplicaMinimo == 1) ? PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_bloqueMinimoDiuNac : 0;
                                break;
                            case 2:
                                $eq_aterDesp     = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_diurnoInt;
                                $precio_AterDesp = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->precio_diurnoInt;
                                $tipoAterrizaje  = 'Diurno Internacional';
                                $aplicaMinimo    = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->aplicar_minimo_diuInt;
                                $minimo          = ($aplicaMinimo == 1) ? PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_bloqueMinimoDiuInt : 0;
                                break;
                        }
                    } else {
                        switch ($nacionalidad) {
                            case 1:
                                $eq_aterDesp     = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_nocturNac;
                                $precio_AterDesp = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->precio_nocturNac;
                                $tipoAterrizaje  = 'Nocturno Nacional';
                                $aplicaMinimo    = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->aplicar_minimo_nocNac;
                                $minimo          = ($aplicaMinimo == 1) ? PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_bloqueMinimoNocNac : 0;
                                break;
                            case 2:
                                $eq_aterDesp     = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_nocturInt;
                                $precio_AterDesp = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->precio_nocturInt;
                                $tipoAterrizaje  = 'Nocturno Internacional';
                                $aplicaMinimo    = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->aplicar_minimo_nocInt;
                                $minimo          = ($aplicaMinimo == 1) ? PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_bloqueMinimoNocInt : 0;
                                break;
                        }
                    }
                } else {
                    if ($hora > $salidaSol && $hora < $puestaSol) {
                        switch ($nacionalidad) {
                            case 1:
                                $eq_aterDesp     = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_diurnoNac_general;
                                $precio_AterDesp = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->precio_diurnoNac_general;
                                $tipoAterrizaje  = 'Diurno Nacional';
                                $aplicaMinimo    = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->aplicar_minimo_diuNac_general;
                                $minimo          = ($aplicaMinimo == 1) ? PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_bloqueMinimoDiuNac_general : 0;
                                break;
                            case 2:
                                $eq_aterDesp     = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_diurnoInt_general;
                                $precio_AterDesp = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->precio_diurnoInt_general;
                                $tipoAterrizaje  = 'Diurno Internacional';
                                $aplicaMinimo    = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->aplicar_minimo_diuInt_general;
                                $minimo          = ($aplicaMinimo == 1) ? PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_bloqueMinimoDiuInt_general : 0;
                                break;
                        }
                    } else {
                        switch ($nacionalidad) {
                            case 1:
                                $eq_aterDesp     = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_nocturNac_general;
                                $precio_AterDesp = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->precio_nocturNac_general;
                                $tipoAterrizaje  = 'Nocturno Nacional';
                                $aplicaMinimo    = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->aplicar_minimo_nocNac_general;
                                $minimo          = ($aplicaMinimo == 1) ? PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_bloqueMinimoNocNac_general : 0;
                                break;
                            case 2:
                                $eq_aterDesp     = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_nocturInt_general;
                                $precio_AterDesp = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->precio_nocturInt_general;
                                $tipoAterrizaje  = 'Nocturno Internacional';
                                $aplicaMinimo    = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->aplicar_minimo_nocInt_general;
                                $minimo          = ($aplicaMinimo == 1) ? PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_bloqueMinimoNocInt_general : 0;
                                break;
                        }
                    }
                }
            } else {
                if ($tipoVuelo == 2 || $tipoVuelo == 3) {

                    if ($hora > $salidaSol && $hora < $puestaSol) {
                        switch ($nacionalidad) {
                            case 1:
                                $eq_aterDesp     = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_diurnoNac_ext;
                                $precio_AterDesp = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->precio_diurnoNac_ext;
                                $tipoAterrizaje  = 'Diurno Nacional';
                                $aplicaMinimo    = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->aplicar_minimo_diuNac_ext;
                                $minimo          = ($aplicaMinimo == 1) ? PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_bloqueMinimoDiuNac_ext : 0;
                                break;
                            case 2:
                                $eq_aterDesp     = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_diurnoInt_ext;
                                $precio_AterDesp = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->precio_diurnoInt_ext;
                                $tipoAterrizaje  = 'Diurno Internacional';
                                $aplicaMinimo    = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->aplicar_minimo_diuInt_ext;
                                $minimo          = ($aplicaMinimo == 1) ? PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_bloqueMinimoDiuInt_ext : 0;
                                break;
                        }
                    } else {
                        switch ($nacionalidad) {
                            case 1:
                                $eq_aterDesp     = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_nocturNac_ext;
                                $precio_AterDesp = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->precio_nocturNac_ext;
                                $tipoAterrizaje  = 'Nocturno Nacional';
                                $aplicaMinimo    = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->aplicar_minimo_nocNac_ext;
                                $minimo          = ($aplicaMinimo == 1) ? PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_bloqueMinimoNocNac_ext : 0;
                                break;
                            case 2:
                                $eq_aterDesp     = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_nocturInt_ext;
                                $precio_AterDesp = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->precio_nocturInt_ext;
                                $tipoAterrizaje  = 'Nocturno Internacional';
                                $aplicaMinimo    = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->aplicar_minimo_nocInt_ext;
                                $minimo          = ($aplicaMinimo == 1) ? PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_bloqueMinimoNocInt_ext : 0;
                                break;
                        }
                    }
                } else {
                    if ($hora > $salidaSol && $hora < $puestaSol) {
                        switch ($nacionalidad) {
                            case 1:
                                $eq_aterDesp     = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_diurnoNac_general_ext;
                                $precio_AterDesp = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->precio_diurnoNac_general_ext;
                                $tipoAterrizaje  = 'Diurno Nacional';
                                $aplicaMinimo    = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->aplicar_minimo_diuNac_general_ext;
                                $minimo          = ($aplicaMinimo == 1) ? PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_bloqueMinimoDiuNac_ext_general : 0;
                                break;
                            case 2:
                                $eq_aterDesp     = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_diurnoInt_general_ext;
                                $precio_AterDesp = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->precio_diurnoInt_general_ext;
                                $tipoAterrizaje  = 'Diurno Internacional';
                                $aplicaMinimo    = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->aplicar_minimo_diuInt_general_ext;
                                $minimo          = ($aplicaMinimo == 1) ? PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_bloqueMinimoDiuInt_general_ext : 0;
                                break;
                        }
                    } else {
                        switch ($nacionalidad) {
                            case 1:
                                $eq_aterDesp     = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_nocturNac_general_ext;
                                $precio_AterDesp = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->precio_nocturNac_general_ext;
                                $tipoAterrizaje  = 'Nocturno Nacional';
                                $aplicaMinimo    = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->aplicar_minimo_nocNac_general_ext;
                                $minimo          = ($aplicaMinimo == 1) ? PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_bloqueMinimoNocNac_general_ext : 0;
                                break;
                            case 2:
                                $eq_aterDesp     = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_nocturInt_general_ext;
                                $precio_AterDesp = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->precio_nocturInt_general_ext;
                                $tipoAterrizaje  = 'Nocturno Internacional';
                                $aplicaMinimo    = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->aplicar_minimo_nocInt_general_ext;
                                $minimo          = ($aplicaMinimo == 1) ? PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_bloqueMinimoNocInt_general_ext : 0;
                                break;
                        }
                    }
                }
            }


            $mensajeAterrizaje = 'Aterrizaje ' . $tipoAterrizaje;


            if ($minimo == 0) {
                //Cálculo Estándar


                $montoDes              = $precio_AterDesp * $peso_aeronave;

                if ($despegue->aterrizaje->aeronave->nacionalidad->nombre != "Venezuela") {
                    $montoDes = $eq_aterDesp * $euro * $peso_aeronave;
                }
                $cantidadDes       = '1';
                $iva               = Concepto::find($concepto_id)->iva;
                $montoIva          = ($iva * $montoDes) / 100;
                $totalDes          = $montoDes + $montoIva;
            } else {
                $cantidadDes           = '1';
                $iva                   = Concepto::find($concepto_id)->iva;


                //Cálculo Estándar
                $montoDesEstandar = $precio_AterDesp * $peso_aeronave;

                if ($despegue->aterrizaje->aeronave->nacionalidad->nombre != "Venezuela")
                    $montoDesEstandar = $eq_aterDesp * $euro * $peso_aeronave;

                $montoIvaEstandar = ($iva * $montoDesEstandar) / 100;
                $totalDesEstandar = $montoDesEstandar + $montoIvaEstandar;

                //Cálculo con Mínimo
                $montoDesMinimo   = $minimo * $this->monto_minimo_ate_despegue($despegue);



                $montoIvaMinimo = ($iva * $montoDesMinimo) / 100;
                $totalDesMinimo = $montoDesMinimo + $montoIvaMinimo;

                $montoDes = max($montoDesEstandar, $montoDesMinimo);
                $totalDes = max($totalDesEstandar, $totalDesMinimo);

                if ($totalDesMinimo > $totalDesEstandar) {
                    $mensajeAterrizaje = 'Aterrizaje ' . $tipoAterrizaje . '.  (Aplica Cobro Mínimo)';
                    $aplica_minimo_aterrizaje = true;
                }
            }

            //SI FERIADO - SI EL CONCEPTO EXISTE Y SI ACEPTA RECARGO - TIPO MATRICULA - ID 3 - MATRICULA COMERCIAL EXCENTO DE RECARGO SEGUN GACETA (DECRETO MARZO 2018)
            $concepto      = Concepto::find($concepto_id);
            if (isset($feriado) && isset($concepto) && ($concepto->recargo == 'SI') && ($tipo_matricula != 3)) {
                $recargoPerDes = $feriado->porcentaje;
            } else
                $recargoPerDes = 0;

            $aterrizajeDespegue->fill(compact('concepto_id', 'condicionPago',  'montoDes', 'cantidadDes', 'iva', 'totalDes', 'recargoPerDes'));
            $factura->detalles->push($aterrizajeDespegue);

            //Recargo Articulo 51 comentado hasta que se de la orden de comenzar a facturar

            // $recargoArt51 = new Facturadetalle();
            // $concepto_id = 501;
            // $montoDes = $aterrizajeDespegue->totalDes * 0.1;
            // $cantidadDes = 1.0;
            // $iva = 0.0;
            // $totalDes = $montoDes;
            // $recargoPerDes = 0.0;
            // $recargoArt51->fill(compact('concepto_id', 'condicionPago',  'montoDes', 'cantidadDes', 'iva', 'totalDes', 'recargoPerDes'));
            // $factura->detalles->push($recargoArt51);
        }

        //Ítem de Puentes de Abordaje.
        if ($despegue->cobrar_puenteAbordaje == '1') {
            $puenteAbordaje    = new Facturadetalle();
            $hora              = $despegue->aterrizaje->hora;
            $inicioOperaciones = HorariosAeronautico::where('aeropuerto_id', session('aeropuerto')->id)->first()->operaciones_inicio;
            $finOperaciones    = HorariosAeronautico::where('aeropuerto_id', session('aeropuerto')->id)->first()->operaciones_fin;


            switch ($condicionPago) {
                case 'Contado':
                    $concepto_id     = CargosVario::where('aeropuerto_id', session('aeropuerto')->id)->wherein('abordajeContado_id', $conceptosAmb)->Orwherein('abordajeContado_id', $conceptosCon)->firstOrFail()->abordajeContado_id;
                    break;
                case 'Crédito':
                    $concepto_id     = CargosVario::where('aeropuerto_id', session('aeropuerto')->id)->wherein('abordajeCredito_id', $conceptosAmb)->Orwherein('abordajeCredito_id', $conceptosCre)->firstOrFail()->abordajeCredito_id;
                    break;
                case 'Exonerado':
                    $concepto_id=1;
                    break;
            }


            switch ($nacionalidad) {
                case 1:
                    $eq_puenteAbordaje     = CargosVario::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_usoAbordajeSinHab;
                    $precio_puenteAbordaje = CargosVario::where('aeropuerto_id', session('aeropuerto')->id)->first()->precio_usoAbordajeSinHab;
                    break;
                case 2:
                    $eq_puenteAbordaje     = CargosVario::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_usoAbordajeConHab;
                    $precio_puenteAbordaje = CargosVario::where('aeropuerto_id', session('aeropuerto')->id)->first()->precio_usoAbordajeConHab;
                    break;
            }

            $tiempoUsoPuenteAbordaje = $despegue->tiempo_puenteAbord;
            $equivalente             = $precio_puenteAbordaje + 0;
            $montoDes                = $equivalente * $tiempoUsoPuenteAbordaje;
            $cantidadDes             = '1';
            $iva                     = Concepto::find($concepto_id)->iva;
            $montoIva                = ($iva * $montoDes) / 100;
            $totalDes                = $montoDes + $montoIva;

            //SI FERIADO - SI EL CONCEPTO EXISTE Y SI ACEPTA RECARGO - TIPO MATRICULA - ID 3 - MATRICULA COMERCIAL EXCENTO DE RECARGO SEGUN GACETA (DECRETO MARZO 2018)
            $concepto      = Concepto::find($concepto_id);
            if (isset($feriado) && isset($concepto) && ($concepto->recargo == 'SI') && ($tipo_matricula != 3)) {
                $recargoPerDes = $feriado->porcentaje;
            } else
                $recargoPerDes = 0;
            $puenteAbordaje->fill(compact('concepto_id', 'condicionPago',  'montoDes', 'cantidadDes', 'iva', 'totalDes', 'recargoPerDes'));
            $factura->detalles->push($puenteAbordaje);
        }

        //Ítem de Carga.
        if ($despegue->cobrar_carga == '1') {

            $carga    = new Facturadetalle();

            switch ($condicionPago) {
                case 'Contado':
                    $concepto_id     = PreciosCarga::where('aeropuerto_id', session('aeropuerto')->id)->wherein('conceptoContado_id', $conceptosAmb)->Orwherein('conceptoContado_id', $conceptosCon)->firstOrFail()->conceptoContado_id;
                    break;
                case 'Crédito':
                    $concepto_id     = PreciosCarga::where('aeropuerto_id', session('aeropuerto')->id)->wherein('conceptoCredito_id', $conceptosAmb)->Orwherein('conceptoCredito_id', $conceptosCre)->firstOrFail()->conceptoCredito_id;
                    break;
                    case 'Exonerado':
                        $concepto_id=1;
                        break;
    
            }

            $pesoEmb      = $despegue->peso_embarcado;
            $pesoDesemb   = $despegue->peso_desembarcado;
            $pesoBloque   = PreciosCarga::where('aeropuerto_id', session('aeropuerto')->id)->first()->toneladaPorBloque;
            $pesoCargado  = ($pesoDesemb + $pesoEmb) / $pesoBloque;
            $eq_Carga     = PreciosCarga::where('aeropuerto_id', session('aeropuerto')->id)->first()->equivalenteUT;
            $precio_carga = PreciosCarga::where('aeropuerto_id', session('aeropuerto')->id)->first()->precio_carga;
            $equivalente  = $precio_carga + 0;

            $montoDes     = $equivalente * $pesoCargado;
            $cantidadDes  = '1';
            $iva          = Concepto::find($concepto_id)->iva;
            $montoIva     = ($iva * $montoDes) / 100;
            $totalDes     = $montoDes + $montoIva;

            //SI FERIADO - SI EL CONCEPTO EXISTE Y SI ACEPTA RECARGO - TIPO MATRICULA - ID 3 - MATRICULA COMERCIAL EXCENTO DE RECARGO SEGUN GACETA (DECRETO MARZO 2018)
            $concepto      = Concepto::find($concepto_id);
            if (isset($feriado) && isset($concepto) && ($concepto->recargo == 'SI') && ($tipo_matricula != 3)) {
                $recargoPerDes = $feriado->porcentaje;
            } else
                $recargoPerDes = 0;

            $carga->fill(compact('concepto_id', 'montoDes', 'cantidadDes', 'iva', 'totalDes', 'recargoPerDes'));
            $factura->detalles->push($carga);
        }

        //Ítem de Habilitación

        if ($despegue->cobrar_habilitacion == '1') {
            $habilitacion               = new Facturadetalle();
            $eq_derechoHabilitacion     = CargosVario::where('aeropuerto_id', session('aeropuerto')->id)->first()->eq_derechoHabilitacion;
            $precio_derechoHabilitacion = CargosVario::where('aeropuerto_id', session('aeropuerto')->id)->first()->precio_derechoHabilitacion;


            switch ($condicionPago) {
                case 'Contado':
                    $concepto_id            = CargosVario::where('aeropuerto_id', session('aeropuerto')->id)->wherein('habilitacionContado_id', $conceptosAmb)->Orwherein('habilitacionContado_id', $conceptosCon)->firstOrFail()->habilitacionContado_id;
                    break;
                case 'Crédito':
                    $concepto_id            = CargosVario::where('aeropuerto_id', session('aeropuerto')->id)->wherein('habilitacionCredito_id', $conceptosAmb)->Orwherein('habilitacionCredito_id', $conceptosCre)->firstOrFail()->habilitacionCredito_id;
                    break;
                    case 'Exonerado':
                        $concepto_id=1;
                        break;
    
            }

            $montoDes     = $precio_derechoHabilitacion + 0;
            $cantidadDes  = '1';
            $iva          = Concepto::find($concepto_id)->iva;
            $montoIva     = ($iva * $montoDes) / 100;
            $totalDes     = $montoDes + $montoIva;

            //SI FERIADO - SI EL CONCEPTO EXISTE Y SI ACEPTA RECARGO - TIPO MATRICULA - ID 3 - MATRICULA COMERCIAL EXCENTO DE RECARGO SEGUN GACETA (DECRETO MARZO 2018)
            $concepto      = Concepto::find($concepto_id);
            if (isset($feriado) && isset($concepto) && ($concepto->recargo == 'SI') && ($tipo_matricula != 3)) {
                $recargoPerDes = $feriado->porcentaje;
            } else
                $recargoPerDes = 0;

            $habilitacion->fill(compact('concepto_id', 'condicionPago', 'montoDes', 'cantidadDes', 'iva', 'totalDes', 'recargoPerDes'));
            $factura->detalles->push($habilitacion);
        }


        //Ítem de Otros Cargos

        if ($despegue->cobrar_otrosCargos == '1') {

            $otros = $despegue->otros_cargos()->get();

            foreach ($otros as $oc) {
                $otrosCargos           = new Facturadetalle();

                /*//NECESITA CAMBIAR PARA EL NUEVO ANALISIS DE LOS OTROS CARGOS
                $concepto_id = oc->concepto_id;
                */
                switch ($condicionPago) {
                    case 'Contado':
                        $concepto_id            = $oc->conceptoContado_id;
                        break;
                    case 'Crédito':
                        $concepto_id            = $oc->conceptoCredito_id;
                        break;
                        case 'Exonerado':
                            $concepto_id=1;
                            break;
        
                }

                /*$precioTotal = 0;
                        foreach ($cargos as $oc) {
                            $precio = \App\OtrosCargo::where('id', $oc->id)->first()->precio_cargo;
                            $precioTotal = $precio + $precioTotal;
                        }*/

                if ($oc->cantidad_unidades == 0) {
                    $montoDes = $oc->precio_cargo;
                } else {
                    switch ($oc->tipo_pago_id) {
                        case 1:
                            $montoDes = round(($oc->cantidad_unidades * $euro), 5);
                            break;
                        case 2:
                            $montoDes = round(($oc->cantidad_unidades * $euro), 5);
                            break;
                        case 3:
                            $montoDes = round(($oc->cantidad_unidades * $euro), 5);
                            break;
                    }
                }
                $cantidadDes  = '1';
                $iva          = Concepto::find($concepto_id)->iva;
                $montoIva     = ($iva * $montoDes) / 100;
                $totalDes     = $montoDes + $montoIva;

                //SI FERIADO - SI EL CONCEPTO EXISTE Y SI ACEPTA RECARGO - TIPO MATRICULA - ID 3 - MATRICULA COMERCIAL EXCENTO DE RECARGO SEGUN GACETA (DECRETO MARZO 2018)
                $concepto      = Concepto::find($concepto_id);
                if (isset($feriado) && isset($concepto) && ($concepto->recargo == 'SI') && ($tipo_matricula != 3)) {
                    $recargoPerDes = $feriado->porcentaje;
                } else
                    $recargoPerDes = 0;

                $otrosCargos->fill(compact('concepto_id', 'condicionPago', 'montoDes', 'cantidadDes', 'iva', 'totalDes', 'recargoPerDes'));
                $factura->detalles->push($otrosCargos);
            }
        }

        $modulo = \App\Modulo::where('nombre', 'DOSAS')->where('aeropuerto_id', session('aeropuerto')->id)->first();
        if (!$modulo) {
            return response("No se consiguio el modulo 'DOSAS' en el aeropuerto de sesion", 500);
        }

        $diasVencimientoCred = \App\OtrasConfiguraciones::where('aeropuerto_id', session('aeropuerto')->id)->first()->diasVencimientoCred;
        if ($condicionPago == "Exonerado") {
            $modulo_id = 26;
            
        }else{
            $modulo_id = $modulo->id;

        }
        $view = view('factura.facturaAeronautica.create', compact('factura', 'condicionPago', 'modulo_id', 'modulo', 'aplica_minimo_aterrizaje', 'aplica_minimo_estacionamiento', 'diasVencimientoCred'))->with(['despegue_id' => $despegue->id]);

        if (isset($feriado)) $mensajeEstacionamiento = $mensajeEstacionamiento . ' ' . $feriado->porcentaje . '% de cobro adicional por concepto de feriado';

        if (isset($mensajeAterrizaje))
            $view->with(['mensajeAterrizaje' => $mensajeAterrizaje]);
        if (isset($mensajeEstacionamiento))
            $view->with(['mensajeEstacionamiento' => $mensajeEstacionamiento]);
        return $view;
    }

    public function getGenerarCobranza($id)
    {

        $despegue        = Despegue::find($id);
        $factura         = $despegue->factura;
        $cliente         = $factura->cliente;
        $idOperator      = ">=";
        $id              = 0;
        $moduloName      = 'DOSAS';
        $modulo          = \App\Modulo::where("nombre", "like", $moduloName)->where('aeropuerto_id', session('aeropuerto')->id)->orderBy("nombre")->first();
        $id              = $modulo->id;
        $idOperator      = "=";
        $today           = \Carbon\Carbon::now();
        $today->timezone = 'America/New_York';

        $bancos = \App\Banco::with('cuentas')->get();
        return view('cobranza.cobranzaSCV.create', compact('factura', 'cliente', 'moduloName', 'bancos', 'id', 'despegue', 'today'));
    }

    public function getDosaClientes($id, Request $request)
    {
        $dosa       = Despegue::find($id)->factura;
        $idOperator = ">=";
        $id         = 0;
        $modulo = \App\Modulo::where("nombre", "like", 'DOSAS')
            ->where('aeropuerto_id', session('aeropuerto')->id)
            ->first();
        $id = $modulo->id;
        $idOperator = "=";
        $codigo = $request->get('codigo');
        $cliente = \App\Cliente::where("codigo", "=", $codigo)->get()->first();
        if (!$cliente)
            return ["facturas" => [], "ajuste" => []];
        $facturas = \App\Factura::with('metadata')
            ->where('cliente_id', $cliente->id)
            ->where('modulo_id', $idOperator, $id)
            ->where('aeropuerto_id', session('aeropuerto')->id)
            ->where('facturas.estado', '=', 'P')
            ->where('facturas.condicionPago', '=', 'Contado')
            ->where('facturas.id', '=', $dosa->id)
            ->groupBy("facturas.id")->get();
        $ajusteCliente = \DB::table('ajustes')
            ->where('cliente_id', $cliente->id)
            ->sum('monto');


        return ["facturas" => $facturas];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postGenerarCobranza(Request $request)
    {

        \DB::transaction(function () use ($request) {
            $cobro = \App\Cobro::create([
                'cliente_id' => $request->get('cliente_id'),
                'modulo_id' => $request->get('modulo_id'),
                'aeropuerto_id' => session('aeropuerto')->id
            ]);
            $facturas = $request->get('facturas', []);
            $pagos = $request->get('pagos', []);
            foreach ($facturas as $f) {
                $factura = \App\Factura::find($f["id"]);

                $facturaMetadata = \App\Facturametadata::firstOrCreate(["factura_id" => $factura->id]);
                $facturaMetadata->ncobros++;
                /**
                 * En el request me llega los porcentajes del iva e isrl que fueron usados en la retencion
                 * y el monto de abonado. Debo hallar cuanto de ese monto abonado corresponde la base y al iva
                 *
                 */
                //Calculo el total de la retencion

                $totalRetencion = ($factura->subtotalNeto * $f["islrpercentage"] / 100) + ($factura->iva * $f["ivapercentage"] / 100);

                //Calculo el total que se debe pagar

                $totalPagar = $factura->total - $totalRetencion;

                //Con el total a pagar puedo calcular cuanto porcentualmente contribuye lo abonado al saldo

                $abonadoPorcentaje = $f["montoAbonado"] / $totalPagar;

                //total real abonado a la factura

                $abonadoReal = $abonadoPorcentaje * $factura->total;

                /*
             * ya tengo el abonado real, ahora debo calcular cuanto contribuye a la base y al iva
             */
                //calculo cuanto es el total sin la recarga

                $totalSinRecarga = $factura->total - $factura->recargoTotal;

                //ahora calculo la contribucion porcentual del iva y la base en el total

                $ivaPorcentaje = $factura->iva / $totalSinRecarga;
                $baseDespuesDescuentoPorcentaje = $factura->subtotal / $totalSinRecarga;

                //calculo cuanto es la contribucion de la base y el descuento en el subtotalDespuesDescuento

                $baseDescuentoPorcentaje = $factura->subtotalNeto / $factura->subtotal;

                //calculo cuanto del saldo abonado en la base

                $base = $abonadoReal * $baseDespuesDescuentoPorcentaje * $baseDescuentoPorcentaje;

                //calculo cuanto del saldo abonado en el iva

                $iva = $abonadoReal * $ivaPorcentaje;

                //Nota si no existiera descuento $base+$iva=$abonadoReal

                //Ya que tengo la base y el iva abonado puedo calcular la retencion abonada

                $retencion = ($base * $f["islrpercentage"] / 100) + ($iva * $f["ivapercentage"] / 100);


                $facturaMetadata->montopagado += $f["montoAbonado"];
                $facturaMetadata->basepagado += $base;
                $facturaMetadata->ivapagado += $iva;
                $facturaMetadata->islrpercentage = $f["islrpercentage"];
                $facturaMetadata->ivapercentage = $f["ivapercentage"];
                $facturaMetadata->retencion += $retencion;
                $facturaMetadata->total += $abonadoReal;
                $facturaMetadata->save();
                $cobro->facturas()
                    ->attach([$factura->id =>
                    [
                        'monto' => $f["montoAbonado"],
                        'base' => $base,
                        'iva' => $iva,
                        'islrpercentage' => $f["islrpercentage"],
                        'ivapercentage' => $f["ivapercentage"],
                        'retencion' => $retencion,
                        'total' => $abonadoReal,
                        'retencionFecha' => $f["retencionFecha"],
                        'retencionComprobante' => $f["retencionComprobante"],
                    ]]);
                if ($facturaMetadata->total == $factura->total) {
                    $factura->estado = "C";
                    $factura->save();
                }
            }


            foreach ($pagos as $p) {
                $cobro->pagos()->create($p);
            }

            $cobro->montofacturas = $request->get("totalFacturas");
            $cobro->montodepositado = $request->get("totalDepositado");
            $ajuste = $request->get("ajuste");

            if ($cobro->montodepositado > ($cobro->montofacturas - $ajuste)) {
                $cobro->ajustes()->create([
                    "monto" => $cobro->montodepositado - $cobro->montofacturas - $ajuste,
                    "cliente_id" => $request->get("cliente_id")
                ]);
            }
            $cobro->observacion = $request->get('observacion');
            $cobro->hasrecaudos = $request->get('hasrecaudos');
            $cobro->save();
        });

        return ["success" => 1];
    }

    public function showPasajeros(Request $request)
    {
        $despegue = Despegue::findOrFail($request->get('despegue'));
        $pasajeros = $despegue->pasajero;
        return view('despegues.pasajeros.index', compact('despegue', 'pasajeros'));
    }

    public function addPasajeros(Request $request)
    {

        $despegue = Despegue::findOrFail($request->get('despegue'));
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'apellido' => 'required',
            'nacionalidad' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 500);
        } else {
            $pasajero = Pasajero::create([
                'cedula' => $request->get("cedula"),
                'nombre' => $request->get("nombre"),
                'apellido' => $request->get("apellido"),
                'nacionalidad' => $request->get("nacionalidad"),
                'despegue_id' => $request->get('despegue')
            ]);

            return response()->json($pasajero);
        }
    }


    public function removePasajeros(Request $request)
    {

        $pasajero = Pasajero::destroy($request->get('pasajero'));

        return response()->json($pasajero);
    }

    public function updatePasajeros(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'apellido' => 'required',
            'nacionalidad' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 500);
        } else {
            $pasajero = Pasajero::findOrFail($request->get('pasajero_id'))->update([
                'cedula' => $request->get("cedula"),
                'nombre' => $request->get("nombre"),
                'apellido' => $request->get("apellido"),
                'nacionalidad' => $request->get("nacionalidad")
            ]);
        }

        return response()->json($pasajero);
    }


    protected function exportar($despegue, $pasajeros, $output = 'I', $dir = 'despegues/')
    {

        //return view('pdf.factura', compact('factura'));
        // create new PDF document
        $pdf = new \TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        // set margins
        $pdf->SetMargins(5, PDF_MARGIN_TOP, '4');
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------
        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        // $pdf->SetFont('helvetica', '', 10, '', true);
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
        // set text shadow effect
        // Set some content to print
        //
        $pdf->SetFont('helvetica', '', '10', true);
        $html = view('pdf.pasajeros', compact('despegue', 'pasajeros', 'traductor'))->render();

        // Print text using writeHTMLCell()
        $pdf->writeHTML($html, true, false, true, false, '');

        //$pdf->writeHTML($html);
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.

        if ($output == 'I') {
            $pdf->Output($despegue->id . "pasajeros.pdf", $output);
        } else {
            $path = $despegue->id . "pasajeros.pdf";
            $pdf->Output($path, $output);
            return $path;
        }
    }


    public function getPrint($despegue_id)
    {
        $despegue = Despegue::findOrFail($despegue_id);
        $pasajeros = $despegue->pasajero;
        return $this->exportar($despegue, $pasajeros);
    }

    private function monto_minimo_est_despegue(Despegue $despegue)
    {
        $monto = MontosFijo::where('aeropuerto_id', session('aeropuerto')->id)->first();
        $estacionamiento = EstacionamientoAeronave::where('aeropuerto_id', session('aeropuerto')->id)->first();
        switch ($despegue->aeronave->tipo->nombre) {
            case 'Privado':
                switch ($despegue->aeronave->nacionalidad_id) {
                    case 246:
                        switch ($despegue->aterrizaje->nacionalidad_vuelo->nombre) {
                            case 'Nacional':
                                if ($estacionamiento->tipo_pago_gen_matricula_nac_nac_id ==  1)
                                    return $monto->unidad_tributaria;

                                if ($estacionamiento->tipo_pago_gen_matricula_nac_nac_id ==  2) {
                                    return $monto->dolar_oficial;
                                }
                                if ($estacionamiento->tipo_pago_gen_matricula_nac_nac_id ==  3) {
                                    return $monto->euro_oficial;
                                }
                                break;


                            default:
                                if ($estacionamiento->tipo_pago_gen_matricula_nac_int_id ==  1)
                                    return $monto->unidad_tributaria;

                                if ($estacionamiento->tipo_pago_gen_matricula_nac_int_id ==  2)
                                    return $monto->dolar_oficial;

                                if ($estacionamiento->tipo_pago_gen_matricula_nac_int_id ==  3)
                                    return $monto->euro_oficial;
                                break;
                        }
                        break;

                    default:
                        switch ($despegue->aterrizaje->nacionalidad_vuelo->nombre) {
                            case 'Nacional':
                                # code...
                                if ($estacionamiento->tipo_pago_gen_matricula_int_nac_id ==  1)
                                    return $monto->unidad_tributaria;

                                if ($estacionamiento->tipo_pago_gen_matricula_int_nac_id ==  2)
                                    return $monto->dolar_oficial;

                                if ($estacionamiento->tipo_pago_gen_matricula_int_nac_id ==  3)
                                    return $monto->euro_oficial;

                                break;

                            default:
                                # code...
                                if ($estacionamiento->tipo_pago_gen_matricula_int_int_id ==  1)
                                    return $monto->unidad_tributaria;

                                if ($estacionamiento->tipo_pago_gen_matricula_int_int_id ==  2)
                                    return $monto->dolar_oficial;

                                if ($estacionamiento->tipo_pago_gen_matricula_int_int_id ==  3)
                                    return $monto->euro_oficial;

                                break;
                        }
                        break;
                }
                break;
            case 'Comercial Privado':
                switch ($despegue->aeronave->nacionalidad_id) {
                    case 246:
                        switch ($despegue->aterrizaje->nacionalidad_vuelo->nombre) {
                            case 'Nacional':
                                if ($estacionamiento->tipo_pago_com_matricula_nac_nac_id ==  1)
                                    return $monto->unidad_tributaria;

                                if ($estacionamiento->tipo_pago_com_matricula_nac_nac_id ==  2)
                                    return $monto->dolar_oficial;

                                if ($estacionamiento->tipo_pago_gen_matricula_nac_nac_id ==  3)
                                    return $monto->euro_oficial;

                                break;


                            default:
                                if ($estacionamiento->tipo_pago_com_matricula_nac_int_id ==  1)
                                    return $monto->unidad_tributaria;

                                if ($estacionamiento->tipo_pago_com_matricula_nac_int_id ==  2)
                                    return $monto->dolar_oficial;

                                if ($estacionamiento->tipo_pago_com_matricula_nac_int_id ==  3)
                                    return $monto->euro_oficial;

                                break;
                        }
                        break;

                    default:
                        switch ($despegue->aterrizaje->nacionalidad_vuelo->nombre) {
                            case 'Nacional':
                                # code...
                                if ($estacionamiento->tipo_pago_com_matricula_int_nac_id ==  1)
                                    return $monto->unidad_tributaria;

                                if ($estacionamiento->tipo_pago_com_matricula_int_nac_id ==  2)
                                    return $monto->dolar_oficial;

                                if ($estacionamiento->tipo_pago_com_matricula_int_nac_id ==  3)
                                    return $monto->euro_oficial;
                                break;

                            default:
                                # code...
                                if ($estacionamiento->tipo_pago_com_matricula_int_int_id ==  1)
                                    return $monto->unidad_tributaria;

                                if ($estacionamiento->tipo_pago_com_matricula_int_int_id ==  2)
                                    return $monto->dolar_oficial;

                                if ($estacionamiento->tipo_pago_com_matricula_int_int_id ==  3)
                                    return $monto->euro_oficial;
                                break;
                        }
                        break;
                }
                break;
            case 'Comercial':
                switch ($despegue->aeronave->nacionalidad_id) {
                    case 246:
                        switch ($despegue->aterrizaje->nacionalidad_vuelo->nombre) {
                            case 'Nacional':
                                if ($estacionamiento->tipo_pago_com_matricula_nac_nac_id ==  1)
                                    return $monto->unidad_tributaria;

                                if ($estacionamiento->tipo_pago_com_matricula_nac_nac_id ==  2)
                                    return $monto->dolar_oficial;

                                if ($estacionamiento->tipo_pago_com_matricula_nac_nac_id ==  3)
                                    return $monto->euro_oficial;
                                break;


                            default:
                                if ($estacionamiento->tipo_pago_com_matricula_nac_int_id ==  1)
                                    return $monto->unidad_tributaria;

                                if ($estacionamiento->tipo_pago_com_matricula_nac_int_id ==  2)
                                    return $monto->dolar_oficial;

                                if ($estacionamiento->tipo_pago_com_matricula_nac_int_id ==  3)
                                    return $monto->euro_oficial;
                                break;
                        }
                        break;

                    default:
                        switch ($despegue->aterrizaje->nacionalidad_vuelo->nombre) {
                            case 'Nacional':
                                # code...
                                if ($estacionamiento->tipo_pago_com_matricula_int_nac_id ==  1)
                                    return $monto->unidad_tributaria;

                                if ($estacionamiento->tipo_pago_com_matricula_int_nac_id ==  2)
                                    return $monto->dolar_oficial;

                                if ($estacionamiento->tipo_pago_com_matricula_int_nac_id ==  3)
                                    return $monto->euro_oficial;

                                break;

                            default:
                                # code...
                                if ($estacionamiento->tipo_pago_com_matricula_int_int_id ==  1)
                                    return $monto->unidad_tributaria;

                                if ($estacionamiento->tipo_pago_com_matricula_int_int_id ==  2)
                                    return $monto->dolar_oficial;

                                if ($estacionamiento->tipo_pago_com_matricula_int_int_id ==  3)
                                    return $monto->euro_oficial;
                                break;
                        }
                        break;
                }
                break;
        }
    }

    private function monto_minimo_ate_despegue(Despegue $despegue)
    {
        $monto = MontosFijo::where('aeropuerto_id', session('aeropuerto')->id)->first();
        $estacionamiento = PreciosAterrizajesDespegue::where('aeropuerto_id', session('aeropuerto')->id)->first();
        switch ($despegue->aeronave->tipo->nombre) {
            case 'Privado':
                switch ($despegue->aeronave->nacionalidad_id) {
                    case 246:
                        switch ($despegue->aterrizaje->nacionalidad_vuelo->nombre) {
                            case 'Nacional':
                                if ($estacionamiento->tipo_pago_gen_matricula_nac_nac_id ==  1)
                                    return $monto->unidad_tributaria;

                                if ($estacionamiento->tipo_pago_gen_matricula_nac_nac_id ==  2)
                                    return $monto->dolar_oficial;

                                if ($estacionamiento->tipo_pago_gen_matricula_nac_nac_id ==  3)
                                    return $monto->euro_oficial;

                                break;


                            default:
                                if ($estacionamiento->tipo_pago_gen_matricula_nac_int_id ==  1)
                                    return $monto->unidad_tributaria;

                                if ($estacionamiento->tipo_pago_gen_matricula_nac_int_id ==  2)
                                    return $monto->dolar_oficial;

                                if ($estacionamiento->tipo_pago_gen_matricula_nac_int_id ==  3)
                                    return $monto->euro_oficial;


                                break;
                        }
                        break;

                    default:
                        switch ($despegue->aterrizaje->nacionalidad_vuelo->nombre) {
                            case 'Nacional':
                                # code...
                                if ($estacionamiento->tipo_pago_gen_matricula_int_nac_id ==  1)
                                    return $monto->unidad_tributaria;

                                if ($estacionamiento->tipo_pago_gen_matricula_int_nac_id ==  2)
                                    return $monto->dolar_oficial;

                                if ($estacionamiento->tipo_pago_gen_matricula_int_nac_id ==  3)
                                    return $monto->euro_oficial;
                                break;

                            default:
                                # code...
                                if ($estacionamiento->tipo_pago_gen_matricula_int_int_id ==  1)
                                    return $monto->unidad_tributaria;

                                if ($estacionamiento->tipo_pago_gen_matricula_int_int_id ==  2)
                                    return $monto->dolar_oficial;

                                if ($estacionamiento->tipo_pago_gen_matricula_int_int_id ==  3)
                                    return $monto->euro_oficial;
                                break;
                        }
                        break;
                }
                break;
            case 'Comercial Privado':
                switch ($despegue->aeronave->nacionalidad_id) {
                    case 246:
                        switch ($despegue->aterrizaje->nacionalidad_vuelo->nombre) {
                            case 'Nacional':
                                if ($estacionamiento->tipo_pago_com_matricula_nac_nac_id ==  1)
                                    return $monto->unidad_tributaria;

                                if ($estacionamiento->tipo_pago_com_matricula_nac_nac_id ==  2)
                                    return $monto->dolar_oficial;

                                if ($estacionamiento->tipo_pago_com_matricula_nac_nac_id ==  3)
                                    return $monto->euro_oficial;

                                break;


                            default:
                                if ($estacionamiento->tipo_pago_com_matricula_nac_int_id ==  1)
                                    return $monto->unidad_tributaria;

                                if ($estacionamiento->tipo_pago_com_matricula_nac_int_id ==  2)
                                    return $monto->dolar_oficial;

                                if ($estacionamiento->tipo_pago_com_matricula_nac_int_id ==  3)
                                    return $monto->euro_oficial;

                                break;
                        }
                        break;

                    default:
                        switch ($despegue->aterrizaje->nacionalidad_vuelo->nombre) {
                            case 'Nacional':
                                # code...
                                if ($estacionamiento->tipo_pago_com_matricula_int_nac_id ==  1)
                                    return $monto->unidad_tributaria;

                                if ($estacionamiento->tipo_pago_com_matricula_int_nac_id ==  2)
                                    return $monto->dolar_oficial;

                                if ($estacionamiento->tipo_pago_com_matricula_int_nac_id ==  3)
                                    return $monto->euro_oficial;

                                break;

                            default:
                                # code...
                                if ($estacionamiento->tipo_pago_com_matricula_int_int_id ==  1)
                                    return $monto->unidad_tributaria;

                                if ($estacionamiento->tipo_pago_com_matricula_int_int_id ==  2)
                                    return $monto->dolar_oficial;

                                if ($estacionamiento->tipo_pago_com_matricula_int_int_id ==  3)
                                    return $monto->euro_oficial;

                                break;
                        }
                        break;
                }
                break;
            case 'Comercial':
                switch ($despegue->aeronave->nacionalidad_id) {
                    case 246:
                        switch ($despegue->aterrizaje->nacionalidad_vuelo->nombre) {
                            case 'Nacional':
                                if ($estacionamiento->tipo_pago_com_matricula_nac_nac_id ==  1)
                                    return $monto->unidad_tributaria;

                                if ($estacionamiento->tipo_pago_com_matricula_nac_nac_id ==  2)
                                    return $monto->dolar_oficial;

                                if ($estacionamiento->tipo_pago_com_matricula_nac_nac_id ==  3)
                                    return $monto->euro_oficial;

                                break;


                            default:
                                if ($estacionamiento->tipo_pago_com_matricula_nac_int_id ==  1)
                                    return $monto->unidad_tributaria;

                                if ($estacionamiento->tipo_pago_com_matricula_nac_int_id ==  2)
                                    return $monto->dolar_oficial;

                                if ($estacionamiento->tipo_pago_com_matricula_nac_int_id ==  3)
                                    return $monto->euro_oficial;

                                break;
                        }
                        break;

                    default:
                        switch ($despegue->aterrizaje->nacionalidad_vuelo->nombre) {
                            case 'Nacional':
                                # code...
                                if ($estacionamiento->tipo_pago_com_matricula_int_nac_id ==  1)
                                    return $monto->unidad_tributaria;

                                if ($estacionamiento->tipo_pago_com_matricula_int_nac_id ==  2)
                                    return $monto->dolar_oficial;

                                if ($estacionamiento->tipo_pago_com_matricula_int_nac_id ==  3)
                                    return $monto->euro_oficial;

                                break;

                            default:
                                # code...
                                if ($estacionamiento->tipo_pago_com_matricula_int_int_id ==  1)
                                    return $monto->unidad_tributaria;

                                if ($estacionamiento->tipo_pago_com_matricula_int_int_id ==  2)
                                    return $monto->dolar_oficial;

                                if ($estacionamiento->tipo_pago_com_matricula_int_int_id ==  3)
                                    return $monto->euro_oficial;

                                break;
                        }
                        break;
                }
                break;
        }
    }
}
