<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\PuertoRequest;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Puerto;
use App\Pais;

class PuertoController extends Controller {

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
		
		$sortType     = $request->get('sortType','ASC');
		$sortType     =($sortType=="")?"ASC":$sortType;
		
		$nombre       = $request->get('nombre', '%');
		$nombre       =($nombre=="")?"%":$nombre;
		
		$siglas       = $request->get('siglas', '%');
		$siglas       =($siglas=="")?"%":$siglas;
		
		$pais_id      = $request->get('pais_id', 0);
		$paisOperator =($pais_id=="")?">":"=";
        \Input::merge([
            'sortName'=>$sortName,
            'sortType'=>$sortType]);
	
		$puertos= Puerto::with("pais")
									->where('nombre', 'like', '%'.$nombre.'%')
									->where('siglas', 'like', $siglas)
									->where('pais_id', $paisOperator, $pais_id)
									->orderBy($sortName, $sortType);
		$totalPuertos = $puertos->count();
		$puertos= $puertos->paginate(7);
		return view('puertos.partials.table', compact('puertos', 'totalPuertos'));
		}
		else
		{

		$paises = Pais::all();
		
		return view('puertos.index', compact('puertos', 'paises'));
		}

	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
		//
	}

	public function store(PuertoRequest $request)
	{
		$port          = new Puerto();
		
		$port->nombre  =$request->input('nombre');
		$port->siglas  =$request->input('siglas');
		$port->pais_id =$request->input('pais_id');
		$port->estado  =$request->input('estado', 0);
		if($port->save())
		{
			return response()->json(array("text"=>'Puerto registrado exitósamente',
										  "puerto"=>$port->load("pais"),
										  "success"=>1));
		}
		else
		{
			response()->json(array("text"=>'Error registrando el puerto',"success"=>0));
		}
	}

	public function show(Puerto $puerto)
	{
        return view("puertos.partials.show", compact('puerto'));
	}

	
	public function edit($id)
	{
		$port   = Puerto::find($id);
		$paises = Pais::lists('nombre', 'id');
		return view('puertos.partials.edit', compact('port', 'paises'));
	}


	public function update($id, PuertoRequest $request)
	{
		$port          = Puerto::find($id);
		
		$port->nombre  =$request->input('nombre');
		$port->siglas  =$request->input('siglas');
		$port->pais_id =$request->input('pais_id');
		$port->estado  =$request->input('estado', 0);


		if($port->save())
		{
			return response()->json(array("text"=>"Registro modificado corréctamente", "puerto"=>$port->load("pais"), "success"=>1));
		}
		else
		{
			return response()->json(array("text"=>"Ocurrió un error modificando el registro", "success"=>0));
		}
	}


    public function destroy($id)
    {
        if(\App\Puerto::destroy($id)){
            return ["success"=>1, "text" => "El puerto fue eliminado con exito."];
        }else{
            return ["success"=>0, "text" => "El puerto no fue eliminado."];
        }
    }


	 //Cambio de estado de un puerto.
    public function estadoPuerto(Request $request)
    {
        $id           = $request->input('id');
        $port         = Puerto::find($id);

        if ($port->estado == '0')
        {
            $port->estado     = '1';
            $mensaje          = "Puerto habilitado exitósamente.";
            $mensajeError     = "Ocurrió un error habilitando al puerto.";
        } 
        else
        {
            $port->estado = '0';
            $mensaje      = "Puerto inhabilitado exitósamente.";
            $mensajeError = "Ocurrió un error inhabilitando al puerto.";
        }
        if($port->save())
        {
            return response()->json(array("text"=>$mensaje,
                "puerto"=>$port,
                "success"=>1));

        }
        else
        {
            return response()->json(array("text"=>$mensajeError, "success"=>0));
        }

    }


}
