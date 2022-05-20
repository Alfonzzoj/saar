<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\AeronaveRequest;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Aeronave;
use App\ModeloAeronave;
use App\TipoMatricula;
use App\Hangar;
use App\Cliente;
use App\NacionalidadMatricula;

class AeronaveController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	//Mostrar tabla
	public function index(Request $request)
	{
		if($request->ajax()){
			$aeronaves      = Aeronave::filter( $request->get('matricula'),
												$request->get('nacionalidad_id'), 
												$request->get('modelo_id'),
												$request->get('tipo_id'),
												$request->get('cliente_id'),
												$request->get('hangar_id'));
			$totalAeronaves = $aeronaves->count();
			$aeronaves      = $aeronaves->paginate(7);
			return view('aeronaves.partials.table', compact('aeronaves', 'totalAeronaves'));
		}else{
			$aeronaves               = Aeronave::all();
			$modelo_aeronaves        = ModeloAeronave::all();
			$tipo_matriculas         = TipoMatricula::all();
			$clientes                = Cliente::all();
			$nacionalidad_matriculas = NacionalidadMatricula::all();
		return view('aeronaves.index', compact('aeronaves', 'modelo_aeronaves', 'tipo_matriculas', 'clientes','nacionalidad_matriculas'));
		}	
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Aeronave $aeronave)
	{
		return view("aeronaves.create", compact('aeronave'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(AeronaveRequest $request)
	{

		$aeronave = Aeronave::create($request->except("hangar_id", "cliente_id"));

		if($aeronave)
		{
			
			$clienteID =$cliente=Cliente::find($request->get("cliente_id"));
			$hangarID  =$hangar=Hangar::find($request->get("hangar_id"));
			
			$clienteID =($clienteID)?$cliente->id:NULL;
			$hangarID  =($hangarID)?$hangar->id:NULL;
			
			$aeronave->hangar_id  =$hangarID;
			$aeronave->cliente_id =$clienteID;

			$aeronave->save();
			return response()->json(array("text"=>'Aeronave registrada exitósamente',
										  "modelo"=>$aeronave->load("modelo", "tipo", "hangar", "cliente", "nacionalidad"),
										  "success"=>1));
		}
		else
		{
			response()->json(array("text"=>'Error registrando la aeronave',"success"=>0));
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Aeronave $aeronave)
	{
        return view("aeronaves.partials.show", compact('aeronave'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$aeronave                = Aeronave::find($id);
		$modelo_aeronaves        = ModeloAeronave::all();
		$tipos                   = TipoMatricula::lists('nombre', 'id');
		$hangares                = Hangar::lists('nombre', 'id');
		$clientes                = Cliente::lists('nombre', 'id');
		$nacionalidad_matriculas = NacionalidadMatricula::all();
		return view('aeronaves.partials.edit', compact('aeronave', 'modelo_aeronaves', 'modelos', 'tipos', 'hangares', 'clientes', 'nacionalidad_matriculas'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, AeronaveRequest $request)
	{
		$aeronave = Aeronave::find($id);
		$aeronave->update($request->except("hangar_id", "cliente_id"));

		if($aeronave)
		{
			$clienteID =$cliente=Cliente::find($request->get("cliente_id"));
			$hangarID  =$hangar=Hangar::find($request->get("hangar_id"));
			
			$clienteID =($clienteID)?$cliente->id:NULL;
			$hangarID  =($hangarID)?$hangar->id:NULL;
			
			$aeronave->hangar_id  =$hangarID;
			$aeronave->cliente_id =$clienteID;

			$aeronave->save();
			return response()->json(array("text"=>'Aeronave registrado exitósamente',
										  "aeronave"=>$aeronave->load("modelo", "tipo", "hangar", "cliente", "nacionalidad"),
										  "success"=>1));
		}
		else
		{
			response()->json(array("text"=>'Error registrando la aeronave',"success"=>0));
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
        if(\App\Aeronave::destroy($id)){
            return ["success"=>1, "text" => "Registro eliminado con éxito."];
        }else{
            return ["success"=>0, "text" => "Error eliminando el registro."];
        }
    }

}
