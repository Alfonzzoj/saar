<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\EstacionamientoAeronaveRequest;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\EstacionamientoAeronave;

class EstacionamientoAeronaveController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{		
		return view('configuracionPrecios.index');
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
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{		

		$estacionamientoAeronave                    = EstacionamientoAeronave::find($id);

		$update_values = $request->except('aplicar_minimo_int',
		'aplicar_minimo_nac',
		'aplicar_minimo_int_general',
		'aplicar_minimo_nac_general',
		'aplicar_minimo_int_ext',
		'aplicar_minimo_nac_ext',
		'aplicar_minimo_int_general_ext',
		'aplicar_minimo_nac_general_ext');
		$update_values['precio_estInt'] = round($update_values['precio_estInt'],2);
		$update_values['precio_estNac'] = round($update_values['precio_estNac'],2);
		$update_values['precio_estInt_general'] = round($update_values['precio_estInt_general'],2);
		$update_values['precio_estNac_general'] = round($update_values['precio_estNac_general'],2);
		
		$update_values['precio_estInt_ext'] = round($update_values['precio_estInt_ext'],2);
		$update_values['precio_estNac_ext'] = round($update_values['precio_estNac_ext'],2);
		$update_values['precio_estInt_general_ext'] = round($update_values['precio_estInt_general_ext'],2);
		$update_values['precio_estNac_general_ext'] = round($update_values['precio_estNac_general_ext'],2);

		$estacionamientoAeronave->update($update_values);
		
		$estacionamientoAeronave->aplicar_minimo_int =($request->input('aplicar_minimo_int'))?1:0;
		$estacionamientoAeronave->aplicar_minimo_nac =($request->input('aplicar_minimo_nac'))?1:0;
		$estacionamientoAeronave->aplicar_minimo_int_general =($request->input('aplicar_minimo_int_general'))?1:0;
		$estacionamientoAeronave->aplicar_minimo_nac_general =($request->input('aplicar_minimo_nac_general'))?1:0;
		$estacionamientoAeronave->aplicar_minimo_int_ext =($request->input('aplicar_minimo_int_ext'))?1:0;
		$estacionamientoAeronave->aplicar_minimo_nac_ext =($request->input('aplicar_minimo_nac_ext'))?1:0;
		$estacionamientoAeronave->aplicar_minimo_int_general_ext =($request->input('aplicar_minimo_int_general_ext'))?1:0;
		$estacionamientoAeronave->aplicar_minimo_nac_general_ext =($request->input('aplicar_minimo_nac_general_ext'))?1:0;
		
		if($estacionamientoAeronave->save())
		{
			return response()->json(array("text"=>'Información Modificada exitósamente',
										  "estacionamientoAeronave"=>$estacionamientoAeronave,
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
