<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\PilotoRequest;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Piloto;
use App\Pais;

class PilotoController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	
	//Mostrar tabla
	public function index(Request $request)
	{
		if($request->ajax()){
			$sortName             = $request->get('sortName','nombre');
			$sortName             =($sortName=="")?"nombre":$sortName;
			
			$sortType             = $request->get('sortType','ASC');
			$sortType             =($sortType=="")?"ASC":$sortType;
			
			$nombre               = $request->get('nombre', '%');
			$nombre               =($nombre=="")?"%":$nombre;
			
			$documento_identidad  = $request->get('documento_identidad', '%');
			$documento_identidad  =($documento_identidad=="")?"%":$documento_identidad;
			
			$licencia             = $request->get('licencia', '%');
			$licencia             =($licencia=="")?"%":$licencia;
			
			$telefono             = $request->get('telefono', '%');
			$telefono             =($telefono=="")?"%":$telefono;
			
			$nacionalidad_id      = $request->get('nacionalidad_id', 0);
			$nacionalidadOperador =($nacionalidad_id=="")?">":"=";
			\Input::merge([
				'sortName'=>$sortName,
				'sortType'=>$sortType]);

			$pilotos= Piloto::where('nombre', 'like', '%'.$nombre.'%')
							->where('documento_identidad', 'like', $documento_identidad)
							->where('licencia', 'like', $licencia)
							->where('nacionalidad_id', $nacionalidadOperador, $nacionalidad_id);
			if($telefono==''){
				$pilotos=$pilotos->orWhere('telefono','=' , null);
			}
			$totalPilotos = $pilotos->count();
			$pilotos=$pilotos->orderBy($sortName, $sortType)
							 ->paginate(7);




			return view('pilotos.partials.table', compact('pilotos', 'totalPilotos'));
		}
		else
		{			
			$paises = Pais::all();
			return view('pilotos.index', compact('paises'));
		}
	}

	/**
	 * Muestra el formulario de creación del registro
	 * @return Response
	 */
	public function create(Request $request)
	{
		//
	}

	/**
	 * Ingresa un nuevo registro
	 * @return Response
	 */
	public function store(PilotoRequest $request)
	{
		$pilot         = new Piloto();		
		$pilot         =Piloto::create($request->except('estado'));
		$pilot->estado =$request->input('estado', 0);

		if($pilot->save())
		{
			return response()->json(array("text"=>'Piloto registrado exitósamente',
										  "piloto"=>$pilot->load("nacionalidad"),
										  "success"=>1));
		}
		else
		{
			response()->json(array("text"=>'Error registrando el piloto',"success"=>0));
		}		
	}

	/**
	 * Muestra la información de un registro
	 * @param  int  $id
	 * @return Response
	 */
		public function show(ModeloAeronave $piloto)
	{
       return view("pilotos.partials.show", compact('piloto'));
	}

	/**
	 * Muestra el formulario de edición de un registro
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$pilot        = Piloto::find($id);
		$nacionalidad = Pais::lists('nombre', 'id');
		return view('pilotos.partials.edit', compact('pilot', 'nacionalidad'));
	}

	/**
	 *Actualiza la información de un registro
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, PilotoRequest $request)
	{
		$pilot                      = Piloto::find($id);
		$pilot->nombre              =$request->input('nombre');
		$pilot->nacionalidad_id     =$request->input('nacionalidad_id');
		$pilot->documento_identidad =$request->input('documento_identidad');
		$pilot->telefono            =$request->input('telefono');
		$pilot->licencia            =$request->input('licencia');
		$pilot->estado              =$request->input('estado', 0);


		if($pilot->save())
		{
			return response()->json(array("text"=>"Registro modificado correctamente", 
										  "piloto"=>$pilot->load("nacionalidad"), "success"=>1));
		}
		else
		{
			return response()->json(array("text"=>"Ocurrió un error modificando el registro", "success"=>0));
		}
	}

	/**
	 * Elimina un registro específico
	 * @param  int  $id
	 * @return Response
	 */
   public function destroy($id)
   {
       if(\App\Piloto::destroy($id)){
           return ["success"=>1, "text" => "El piloto fue eliminado con exito."];
       }else{
           return ["success"=>0, "text" => "El piloto no fue eliminado."];
       }
   }


	/**
	 * Habilita/Inhabilita un registro
	 * @param  int  $id
	 * @return Response
	 */
	 public function estadoPiloto(Request $request)
   {
		$id    = $request->input('id');
		$pilot = Piloto::find($id);

       if ($pilot->estado == '0')
       {
			$pilot->estado = '1';
			$mensaje       = "Piloto habilitado exitósamente.";
			$mensajeError  = "Ocurrió un error habilitando al Piloto.";
       } 
       else
       {
			$pilot->estado = '0';
			$mensaje       = "Piloto inhabilitado exitósamente.";
			$mensajeError  = "Ocurrió un error inhabilitando al Piloto.";
       }
       if($pilot->save())
       {
           return response()->json(array("text"=>$mensaje,
               "piloto"=>$pilot,
               "success"=>1));

       }
       else
       {
           return response()->json(array("text"=>$mensajeError, "success"=>0));
       }
   }

}