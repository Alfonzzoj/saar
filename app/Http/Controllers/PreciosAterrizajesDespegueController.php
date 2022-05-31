<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\PrecioAterrizajeDespegueRequest;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\PreciosAterrizajesDespegue;

class PreciosAterrizajesDespegueController extends Controller {

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
		$precioAterrizajeDespegue = PreciosAterrizajesDespegue::find($id);
		$precioAterrizajeDespegue->update($request->except('aplicar_minimo_diuInt', 
															'aplicar_minimo_nocInt',
															'aplicar_minimo_diuNac', 
															'aplicar_minimo_nocNac',
															'aplicar_minimo_diuInt_general', 
															'aplicar_minimo_nocInt_general',
															'aplicar_minimo_diuNac_general', 
															'aplicar_minimo_nocNac_general',
															'aplicar_minimo_diuInt_ext', 
															'aplicar_minimo_nocInt_ext',
															'aplicar_minimo_diuNac_ext', 
															'aplicar_minimo_nocNac_ext',
															'aplicar_minimo_diuInt_general_ext', 
															'aplicar_minimo_nocInt_general_ext',
															'aplicar_minimo_diuNac_general_ext', 
															'aplicar_minimo_nocNac_general_ext'));
		
		$precioAterrizajeDespegue->aplicar_minimo_diuInt =($request->input('aplicar_minimo_diuInt'))?1:0;
		$precioAterrizajeDespegue->aplicar_minimo_nocInt =($request->input('aplicar_minimo_nocInt'))?1:0;
		$precioAterrizajeDespegue->aplicar_minimo_diuNac =($request->input('aplicar_minimo_diuNac'))?1:0;
		$precioAterrizajeDespegue->aplicar_minimo_nocNac =($request->input('aplicar_minimo_nocNac'))?1:0;
		$precioAterrizajeDespegue->aplicar_minimo_diuInt_general =($request->input('aplicar_minimo_diuInt_general'))?1:0;
		$precioAterrizajeDespegue->aplicar_minimo_nocInt_general =($request->input('aplicar_minimo_nocInt_general'))?1:0;
		$precioAterrizajeDespegue->aplicar_minimo_diuNac_general =($request->input('aplicar_minimo_diuNac_general'))?1:0;
		$precioAterrizajeDespegue->aplicar_minimo_nocNac_general =($request->input('aplicar_minimo_nocNac_general'))?1:0;
		$precioAterrizajeDespegue->aplicar_minimo_diuInt_ext =($request->input('aplicar_minimo_diuInt_ext'))?1:0;
		$precioAterrizajeDespegue->aplicar_minimo_nocInt_ext =($request->input('aplicar_minimo_nocInt_ext'))?1:0;
		$precioAterrizajeDespegue->aplicar_minimo_diuNac_ext =($request->input('aplicar_minimo_diuNac_ext'))?1:0;
		$precioAterrizajeDespegue->aplicar_minimo_nocNac_ext =($request->input('aplicar_minimo_nocNac_ext'))?1:0;
		$precioAterrizajeDespegue->aplicar_minimo_diuInt_general_ext =($request->input('aplicar_minimo_diuInt_general_ext'))?1:0;
		$precioAterrizajeDespegue->aplicar_minimo_nocInt_general_ext =($request->input('aplicar_minimo_nocInt_general_ext'))?1:0;
		$precioAterrizajeDespegue->aplicar_minimo_diuNac_general_ext =($request->input('aplicar_minimo_diuNac_general_ext'))?1:0;
		$precioAterrizajeDespegue->aplicar_minimo_nocNac_general_ext =($request->input('aplicar_minimo_nocNac_general_ext'))?1:0;

		if($precioAterrizajeDespegue->save())
		{			
			return response()->json(array("text"=>'Información Modificada exitósamente',
										  "precioAterrizajeDespegue"=>$precioAterrizajeDespegue,
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
