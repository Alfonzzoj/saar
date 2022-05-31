<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\HorariosAeronauticoRequest;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\HorariosAeronautico;

class HorarioAeronauticoController extends Controller {

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
		$horarioAeronautico = HorariosAeronautico::find($id);
		$horarioAeronautico->update($request->all());
		
		if($horarioAeronautico)
		{			
			return response()->json(array("text"=>'Información Modificada exitósamente',
										  "horarioAeronautico"=>$horarioAeronautico,
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
