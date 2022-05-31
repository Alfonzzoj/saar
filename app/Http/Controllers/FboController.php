<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \App\Fbo;

use Illuminate\Http\Request;

class FboController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		if($request->ajax()){
			$sortName     = $request->get('sortName','nombre');
			$sortName     =($sortName=="")?"nombre":$sortName;
			
		
			$fbos = Fbo::all();
			$totalFbos = $fbos->count();

			return view('fbos.partials.table',compact('fbos','totalFbos'));
		}else{
			$fbos = Fbo::all();
			$totalFbos = $fbos->count();

			return view('fbos.index',compact('fbos','totalFbos'));
		}	
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
	public function store(Request $request)
	{

		// return $request->all();
		// dd($request->all());
		$fbo = Fbo::create([
			'nombre' => $request->nombre_fbo,
		]);

		

		if($fbo){
			return response()->json(array("text"=>'Fbo registrado exitósamente',
			"success"=>1));
		}else{
			response()->json(array("text"=>'Error registrando el fbo',"success"=>0));

		}
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
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(\App\Fbo::destroy($id)){
			return ["success"=>1, "text" => "El Fbo fue eliminado con exito."];
		}else{
			return ["success"=>0, "text" => "El Fbo no fue eliminado."];
		}	}

}
