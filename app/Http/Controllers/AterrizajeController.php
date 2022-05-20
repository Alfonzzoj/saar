<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\AterrizajeRequest;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Aterrizaje;
use App\Puerto;
use App\Piloto;
use App\NacionalidadVuelo;
use App\Aeronave;
use App\TipoMatricula;
use App\Cliente;
use App\Factura;
use App\Concepto;

use Carbon\Carbon;

class AterrizajeController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	//Mostrar tabla
	public function index(Request $request)
	{
		if($request->ajax()){

			
			$fecha            = $request->get('fecha');
			if($fecha == ""){
				$fecha = "0000-00-00";
			}else{
				$fecha            =\Carbon\Carbon::createFromFormat('d/m/Y', $fecha);
				$fecha            = $fecha->toDateString();
			}
			$hora            = $request->get('hora');
			if($hora == ""){
				$hora = "00:00:00";
			}
			$despego=0;
			$aeropuerto_id    =session('aeropuerto')->id;
			$aterrizajes      = Aterrizaje::filter($fecha, $hora, $request->get('aeronave_id'), $request->get('num_vuelo'), $request->get('tipoMatricula_id'), $request->get('puerto_id'), $request->get('cliente_id'), $despego, $aeropuerto_id);
			$totalAterrizajes = $aterrizajes->count();
			$aterrizajes      = $aterrizajes->paginate(7);
			return view('aterrizajes.partials.table', compact('aterrizajes', 'totalAterrizajes'));
		}
		else
			{
				$aterrizajes         = Aterrizaje::where('despego', '=', '0')->where('aeropuerto_id', '=', session('aeropuerto')->id)->paginate(7);
				$puertos             = Puerto::all();
				$pilotos             = Piloto::all();
				$nacionalidad_vuelos = NacionalidadVuelo::all();
				$aeronaves           = Aeronave::all();
				$tipoMatriculas      = TipoMatricula::all();
				$today               = Carbon::now();
				$today->timezone     = 'America/New_York';

			return view("aterrizajes.index", compact('aterrizajes',"nacionalidad_vuelos", "tipoMatriculas", "aeronaves", "puertos", "pilotos", "today"));
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
			$aterrizajes         = Aterrizaje::all();
			$puertos             = Puerto::all();
			$pilotos             = Piloto::all();
			$nacionalidad_vuelos = NacionalidadVuelo::all();
			$aeronaves           = Aeronave::all();
			$tipoMatriculas      = TipoMatricula::all();
			$today               = Carbon::now();
			$today->timezone     = 'America/New_York';
		return view("aterrizajes.create", compact("nacionalidad_vuelos", "tipoMatriculas", "aeronaves", "puertos", "pilotos", "today"));


	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(AterrizajeRequest $request)
	{

        $fecha            =\Carbon\Carbon::createFromFormat('d/m/Y', $request->get('fecha'));
        $fecha            = $fecha->toDateString();
		$aterrizajes = Aterrizaje::where('aeronave_id', $request->get('aeronave_id'))
									->where('fecha', $fecha)
									->where('hora', $request->get('hora'))
									->get();
		if($aterrizajes->count() > 0)
			return response()->json(array("text"=>'Aterrizaje Duplicado',"success"=>0));
		

		$aterrizaje = Aterrizaje::create($request->except("nacionalidadVuelo_id", "piloto_id", "puerto_id", "cliente_id"));

		if($aterrizaje)
		{

			$puertoID  =$puerto = Puerto::find($request->get("puerto_id"));
			$pilotoID  =$piloto = Piloto::find($request->get("piloto_id"));
			$clienteID =$cliente = Cliente::find($request->get("cliente_id"));
			
			$puertoID  =($puertoID)?$puerto->id:NULL;
			$pilotoID  =($pilotoID)?$piloto->id:NULL;
			$clienteID =($clienteID)?$cliente->id:NULL;

			$aterrizaje->puerto_id  =$puertoID;
			$aterrizaje->piloto_id  =$pilotoID;
			$aterrizaje->cliente_id =$clienteID;
			
			if ($puertoID)
			{
				$nacionalidadMatricula = $aterrizaje->aeronave->nacionalidad_id;
				$nacionalidadPuerto    = $aterrizaje->puerto->pais_id;

			if(($nacionalidadMatricula != '246') || ($nacionalidadMatricula == '246' && $nacionalidadPuerto != '232')){					
				$aterrizaje->nacionalidadVuelo_id = '2';
				}else{
					$aterrizaje->nacionalidadVuelo_id = '1';
				}
			}else{
				$aterrizaje->nacionalidadVuelo_id = NULL;
			}
			$aterrizaje->save();

			return response()->json(array("text"		 =>'Aterrizaje registrado exitósamente',
									      "success"      =>1));
		}
		else
		{
			return response()->json(array("text"=>'Error registrando el aterrizaje',"success"=>0));
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Aterrizaje $aterrizaje)
	{
		$aterrizaje          = Aterrizaje::find($aterrizaje);
		$puertos             = Puerto::all();
		$pilotos             = Piloto::all();
		$nacionalidad_vuelos = NacionalidadVuelo::all();
		$aeronaves           = Aeronave::all();
		$tipoMatriculas      = TipoMatricula::all();
        return view("aterrizajes.partials.show", compact('aterrizaje', "nacionalidad_vuelos", "tipoMatriculas", "aeronaves", "puertos", "pilotos"));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		$aterrizaje          = Aterrizaje::find($id);
		$puertos             = Puerto::all();
		$pilotos             = Piloto::all();
		$nacionalidad_vuelos = NacionalidadVuelo::all();
		$aeronaves           = Aeronave::all();
		$tipoMatriculas      = TipoMatricula::all();
		return view("aterrizajes.partials.edit", compact("aterrizaje", "nacionalidad_vuelos", "tipoMatriculas", "aeronaves", "puertos", "pilotos"));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, AterrizajeRequest $request)
	{
		$aterrizaje = Aterrizaje::find($id);
		$aterrizaje->update($request->except("nacionalidadVuelo_id", "piloto_id", "puerto_id", "cliente_id"));

		if($aterrizaje)
		{

			$puertoID  =$puerto=Puerto::find($request->get("puerto_id"));
			$pilotoID  =$piloto=Piloto::find($request->get("piloto_id"));
			$clienteID =$cliente=Cliente::find($request->get("cliente_id"));

			
			$puertoID  =($puertoID)?$puerto->id:NULL;
			$pilotoID  =($pilotoID)?$piloto->id:NULL;
			$clienteID =($clienteID)?$cliente->id:NULL;


			$aterrizaje->puerto_id            =$puertoID;
			$aterrizaje->piloto_id            =$pilotoID;
			$aterrizaje->cliente_id           =$clienteID;
			if ($puertoID)
			{
				$nacionalidadMatricula = $aterrizaje->aeronave->nacionalidad_id;
				$nacionalidadPuerto    = $aterrizaje->puerto->pais_id;
				if(($nacionalidadMatricula != '246') || ($nacionalidadMatricula == '246' && $nacionalidadPuerto != '232')){
					$aterrizaje->nacionalidadVuelo_id = '2';
				}else{
					$aterrizaje->nacionalidadVuelo_id = '1';
				}
			}else{
				$aterrizaje->nacionalidadVuelo_id = NULL;
			}
			$aterrizaje->save();

			return response()->json(array("text"		 =>'Aterrizaje modificado exitósamente',
									      "success"      =>1));
		}
		else
		{
			response()->json(array("text"=>'Error registrando el aterrizaje',"success"=>0));
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
    {
        if(\App\Aterrizaje::destroy($id)){
            return ["success"=>1, "text" => "Aterrizaje eliminado con éxito."];
        }else{
            return ["success"=>0, "text" => "Error eliminando el registro."];
        }


    }

    public function getCrearFactura($aterrizajeId)
    {
    	$aterrizaje = Aterrizaje::find($aterrizajeId);
			$factura       = new Factura();
			$modulo        = \App\Modulo::find(5)->nombre;
			$conceptos = Concepto::where('aeropuerto_id', session('aeropuerto')->id)->where('modulo_id', '5')->get();


			$factura->fill(['aeropuerto_id' => $aterrizaje->aeropuerto_id,
				               'cliente_id'   => $aterrizaje->cliente_id]);

      $modulo= \App\Modulo::where('nombre','DOSAS')->where('aeropuerto_id', session('aeropuerto')->id)->first();
      if(!$modulo){
          return response("No se consiguio el modulo 'DOSAS' en el aeropuerto de sesion", 500);
      }
      $modulo_id=$modulo->id;

        $diasVencimientoCred = \App\OtrasConfiguraciones::where('aeropuerto_id', session('aeropuerto')->id)->first()->diasVencimientoCred;


			return view('factura.facturaCargosAdicionales.create', compact('factura', 'modulo_id', 'modulo', 'conceptos', 'diasVencimientoCred'))->with(["aterrizaje_id"=>$aterrizaje->id]);

    }
}
