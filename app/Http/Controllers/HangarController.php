<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\HangarRequest;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Hangar;
use App\Cliente;
use App\Aeronave;
use App\Aeropuerto;

class HangarController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{

		if($request->ajax()){
			$sortName           = $request->get('sortName','aeropuerto_id');
			$sortName           =($sortName=="")?"aeropuerto_id":$sortName;
			
			$sortType           = $request->get('sortType','ASC');
			$sortType           =($sortType=="")?"ASC":$sortType;
			
			$aeropuerto_id      = $request->get('aeropuerto_id', 0);
			$aeropuertoOperador =($aeropuerto_id=="")?">":"=";
			
			$nombre             = $request->get('nombre', '%');
			$nombre             =($nombre=="")?"%":$nombre;
			
			\Input::merge([
	            'sortName'=>$sortName,
	            'sortType'=>$sortType]);
		
			$hangares= Hangar::with("aeropuerto", "clientes", "aeronaves")
									->where('aeropuerto_id', $aeropuertoOperador, $aeropuerto_id)
									->where('nombre', 'like', '%'.$nombre.'%')
									->where('aeropuerto_id', session('aeropuerto')->id)
									->orderBy($sortName, $sortType)
									->paginate(7);
			return view('hangares.partials.table', compact('hangares'));
		}
		else
		{
	
			$aeropuertos = Aeropuerto::all();
			$clientes    = Cliente::all();
			$aeronaves   = Aeronave::all();
			
			return view('hangares.index', compact('hangares', 'aeropuertos', 'clientes', 'aeronaves'));
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

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	
	public function store(HangarRequest $request)
	{
		
		$hangar = Hangar::create($request->all());

		if($hangar)
		{
			return response()->json(array("text"=>'Hangar registrado exitósamente',
										  "hangar"=>$hangar->load("aeropuerto"),
										  "success"=>1));
		}
		else
		{
			response()->json(array("text"=>'Error registrando el hangar',"success"=>0));
		}
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function show(Hangar $hangar)
	{
        return view("hangares.partials.show", compact('hangar'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$hangar     = Hangar::find($id);
		$aeropuerto = Aeropuerto::lists('nombre', 'id');
		return view('hangares.partials.edit', compact('hangar', 'aeropuerto'));
	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, HangarRequest $request)
	{
		$hangar                = Hangar::find($id);
		$hangar->aeropuerto_id =$request->input('aeropuerto_id');
		$hangar->nombre        =$request->input('nombre');

		if($hangar->save())
		{
			return response()->json(array("text"=>"Registro modificado correctamente", 
										  "hangar"=>$hangar->load("aeropuerto"), "success"=>1));
		}
		else
		{
			return response()->json(array("text"=>"Ocurrió un error modificando el registro", "success"=>0));
		}
	}


	//Eliminar un registro.
	 public function destroy($id)
    {
        if(\App\Hangar::destroy($id)){
            return ["success"=>1, "text" => "El hangar fue eliminado con éxito."];
        }else{
            return ["success"=>0, "text" => "El hangar no pudo ser eliminado."];
        }
    }

    //Cambio de estado de un hangar.
    public function estadoHangar(Request $request)
    {
		$id     = $request->input('id');
		$hangar = Hangar::find($id);

        if ($hangar->estado == '0')
        {
            $hangar->estado     = '1';
            $mensaje          = "Hangar habilitado exitósamente.";
            $mensajeError     = "Ocurrió un error habilitando al usuario.";
        } 
        else
        {
            $hangar->estado = '0';
            $mensaje      = "Hangar inhabilitado exitósamente.";
            $mensajeError = "Ocurrió un error inhabilitando al usuario.";
        }
        if($hangar->save())
        {
            return response()->json(array("text"=>$mensaje,
                "hangar"=>$hangar,
                "success"=>1));

        }
        else
        {
            return response()->json(array("text"=>$mensajeError, "success"=>0));
        }

    }

}
