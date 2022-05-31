<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\MontosFijoRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\MontosFijo;
use App\TipoMatricula;
use App\NacionalidadVuelo;
use App\Concepto;
use App\EstacionamientoAeronave;
use App\PreciosAterrizajesDespegue;
use App\TipoPago;
use App\CargosVario;
use App\PreciosCarga;
class MontosFijoController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$cargoVario = CargosVario::where('aeropuerto_id',session('aeropuerto')->id)->first();
		$conceptoss = Concepto::where('aeropuerto_id', session('aeropuerto')->id)->orderby('nompre','ASC')->where('stacod','A')->lists('nompre', 'id');
		$nacionalidades_vuelos = NacionalidadVuelo::lists('nombre','id');
		//NacionalidadVuelo::all()->pluck('nombre','id');
		$montoFijo = MontosFijo::where('aeropuerto_id', session('aeropuerto')->id)->first();
		$tipo_pagos = TipoPago::lists('name','id');
		$tipos_matriculas = TipoMatricula::lists('nombre','id');
		$estacionamientoAeronave = EstacionamientoAeronave::where('aeropuerto_id',session('aeropuerto')->id)->first();
		$precioAterrizajes = PreciosAterrizajesDespegue::where('aeropuerto_id',session('aeropuerto')->id)->first();
		return view('configuracionPrecios.index',compact(
			'conceptoss',
			'nacionalidades_vuelos',
			'tipos_matriculas',
			'tipo_pagos',
			'montoFijo',
			'estacionamientoAeronave',
			'precioAterrizajes',
			'cargoVario'
		));
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

	public function show(MontosFijo $confGeneral)
	{
        return view("configuracionPrecios.confGeneral.partials.show");
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
		$confGeneral = MontosFijo::find($id);
		return view('configuracionPrecios.confGeneral.partials.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		//actualizo el valor de la unidad monetaria
		$confGeneral                    =MontosFijo::find($id);
		$confGeneral->unidad_tributaria =$request->input('unidad_tributaria');
		$confGeneral->dolar_oficial     =$request->input('dolar_oficial');
		$confGeneral->euro_oficial			=$request->input('euro_oficial');





		if($confGeneral->save())
		{
			$precioCargas = PreciosCarga::where('aeropuerto_id',session('aeropuerto')->id)->first();
			$precioCargas->precio_carga = $precioCargas->equivalenteUT * $precioCargas->tipo_pago->precio();
			$precioCargas->save();
			// actualizo los valores del formulario, derecho habilitacion, derecho de abordaje internacional y nacional
			$cargoVario = CargosVario::where('aeropuerto_id',session('aeropuerto')->id)->first();
			$cargoVario->precio_formulario = $cargoVario->eq_formulario * $cargoVario->TipoPagoFormulario->precio(); 
			$cargoVario->precio_derechoHabilitacion = $cargoVario->eq_derechoHabilitacion * $cargoVario->tipoPagoFHabilitacion->precio(); 
			$cargoVario->precio_usoAbordajeSinHab = $cargoVario->eq_usoAbordajeSinHab * $cargoVario->tipoPagoDerechoAbordajeNac->precio();
			$cargoVario->precio_usoAbordajeConHab = $cargoVario->eq_usoAbordajeConHab * $cargoVario->tipoPagoDerechoAbordajeInt->precio();
			$cargoVario->save();
			
		// actualizar los valores de los cobros por matricula general y comercial tanto de procedencia nacional como de procedencia internacional
		$estacionamientoAeronave = EstacionamientoAeronave::where('aeropuerto_id',session('aeropuerto')->id)->first();
		$estacionamientoAeronave->precio_estNac = $estacionamientoAeronave->eq_bloqueNac * $estacionamientoAeronave->tipo_pago_com_matricula_nac_nac->precio();
		$estacionamientoAeronave->precio_estInt = $estacionamientoAeronave->eq_bloqueInt * $estacionamientoAeronave->tipo_pago_com_matricula_nac_int->precio();
		$estacionamientoAeronave->precio_estNac_general = $estacionamientoAeronave->eq_bloqueNac_general * $estacionamientoAeronave->tipo_pago_gen_matricula_nac_nac->precio();
		$estacionamientoAeronave->precio_estInt_general = $estacionamientoAeronave->eq_bloqueInt_general * $estacionamientoAeronave->tipo_pago_gen_matricula_nac_int->precio();
		$estacionamientoAeronave->precio_estNac_ext = $estacionamientoAeronave->eq_bloqueNac_ext * $estacionamientoAeronave->tipo_pago_com_matricula_int_nac->precio();
		$estacionamientoAeronave->precio_estInt_ext = $estacionamientoAeronave->eq_bloqueInt_ext * $estacionamientoAeronave->tipo_pago_com_matricula_int_int->precio();
		$estacionamientoAeronave->precio_estNac_general_ext = $estacionamientoAeronave->eq_bloqueNac_general_ext * $estacionamientoAeronave->tipo_pago_gen_matricula_int_nac->precio();
		$estacionamientoAeronave->precio_estInt_general_ext =$estacionamientoAeronave->eq_bloqueInt_general_ext * $estacionamientoAeronave->tipo_pago_gen_matricula_int_int->precio();
		$estacionamientoAeronave->save();

		// actualizar los valores de los cobros por matricula general y comercial tanto de procedencia nacional como de procedencia internacional
		$precioAterrizajeDespegue = PreciosAterrizajesDespegue::where('aeropuerto_id',session('aeropuerto')->id)->first();
		$precioAterrizajeDespegue->precio_diurnoNac = $precioAterrizajeDespegue->eq_diurnoNac * $precioAterrizajeDespegue->tipo_pago_com_matricula_nac_nac->precio();
		$precioAterrizajeDespegue->precio_nocturNac = $precioAterrizajeDespegue->eq_nocturNac * $precioAterrizajeDespegue->tipo_pago_com_matricula_nac_nac->precio();
		$precioAterrizajeDespegue->precio_diurnoInt = $precioAterrizajeDespegue->eq_diurnoInt * $precioAterrizajeDespegue->tipo_pago_com_matricula_nac_int->precio();
		$precioAterrizajeDespegue->precio_nocturInt = $precioAterrizajeDespegue->eq_nocturInt * $precioAterrizajeDespegue->tipo_pago_com_matricula_nac_int->precio();
		$precioAterrizajeDespegue->precio_diurnoNac_general = $precioAterrizajeDespegue->eq_diurnoNac_general * $precioAterrizajeDespegue->tipo_pago_gen_matricula_nac_nac->precio();
		$precioAterrizajeDespegue->precio_nocturNac_general = $precioAterrizajeDespegue->eq_nocturNac_general * $precioAterrizajeDespegue->tipo_pago_gen_matricula_nac_nac->precio();
		$precioAterrizajeDespegue->precio_diurnoInt_general = $precioAterrizajeDespegue->eq_diurnoInt_general * $precioAterrizajeDespegue->tipo_pago_gen_matricula_nac_int->precio();
		$precioAterrizajeDespegue->precio_nocturInt_general = $precioAterrizajeDespegue->eq_nocturInt_general * $precioAterrizajeDespegue->tipo_pago_gen_matricula_nac_int->precio();

		$precioAterrizajeDespegue->precio_diurnoNac_ext = $precioAterrizajeDespegue->eq_diurnoNac_ext * $precioAterrizajeDespegue->tipo_pago_com_matricula_int_nac->precio();
		$precioAterrizajeDespegue->precio_nocturNac_ext = $precioAterrizajeDespegue->eq_nocturNac_ext * $precioAterrizajeDespegue->tipo_pago_com_matricula_int_nac->precio();
		$precioAterrizajeDespegue->precio_diurnoInt_ext = $precioAterrizajeDespegue->eq_diurnoInt_ext * $precioAterrizajeDespegue->tipo_pago_com_matricula_int_int->precio();
		$precioAterrizajeDespegue->precio_nocturInt_ext = $precioAterrizajeDespegue->eq_nocturInt_ext * $precioAterrizajeDespegue->tipo_pago_com_matricula_int_int->precio();
		$precioAterrizajeDespegue->precio_diurnoNac_general_ext = $precioAterrizajeDespegue->eq_diurnoNac_general_ext * $precioAterrizajeDespegue->tipo_pago_gen_matricula_int_nac->precio();
		$precioAterrizajeDespegue->precio_nocturNac_general_ext = $precioAterrizajeDespegue->eq_nocturNac_general_ext * $precioAterrizajeDespegue->tipo_pago_gen_matricula_int_nac->precio();
		$precioAterrizajeDespegue->precio_diurnoInt_general_ext = $precioAterrizajeDespegue->eq_diurnoInt_general_ext * $precioAterrizajeDespegue->tipo_pago_gen_matricula_int_int->precio();
		$precioAterrizajeDespegue->precio_nocturInt_general_ext = $precioAterrizajeDespegue->eq_nocturInt_general_ext * $precioAterrizajeDespegue->tipo_pago_gen_matricula_int_int->precio();
		$precioAterrizajeDespegue->save();

			return response()->json(array("text"=>'Configuracion modificada exitósamente.',
										  "confGeneral"=>$confGeneral,
										  "success"=>1));
		}
		else
		{
			response()->json(array("text"=>'Error modificando el registro',"success"=>0));
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
		//
	}

}
