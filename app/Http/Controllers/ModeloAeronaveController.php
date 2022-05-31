<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ModeloAeronaveRequest;

use Illuminate\Http\Request;
use App\ModeloAeronave;
use App\TipoAeronave;


class ModeloAeronaveController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	
	//Mostrar tabla
	public function index(Request $request)
	{

		if($request->ajax()){
		$sortName     = $request->get('sortName','modelo');
		$sortName     =($sortName=="")?"modelo":$sortName;
		
		$sortType     = $request->get('sortType','ASC');
		$sortType     =($sortType=="")?"ASC":$sortType;
		
		$modelo       = $request->get('modelo', '%');
		$modelo       =($modelo=="")?"%":$modelo;
		
		$peso_maximo  = $request->get('peso_maximo', '%');
		$peso_maximo  =($peso_maximo=="")?"%":$peso_maximo;
		
		$tipo_id      = $request->get('tipo_id', 0);
		$tipoOperator =($tipo_id=="")?">":"=";
        \Input::merge([
            'sortName'=>$sortName,
            'sortType'=>$sortType]);
	
		$modelos= ModeloAeronave::with("tipo")
									->where('modelo', 'like', '%'.$modelo.'%')
									->where('peso_maximo', 'like', $peso_maximo)
									->where('tipo_id', $tipoOperator, $tipo_id)
									->orderBy($sortName, $sortType);
		$totalModelosAeronaves = $modelos->count();
		$modelos               = $modelos->paginate(7);


		return view('modelosAeronaves.partials.table', compact('modelos', 'totalModelosAeronaves'));
		}else{

		$tipos = TipoAeronave::all();
		
		return view('modelosAeronaves.index', compact('tipos'));
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
	public function store(ModeloAeronaveRequest $request)
	{
		
		$model = ModeloAeronave::create($request->all());

		if($model)
		{
			return response()->json(array("text"=>'Modelo de Aeronave registrado exitósamente',
										  "modelo"=>$model->load("tipo"),
										  "success"=>1));
		}
		else
		{
			response()->json(array("text"=>'Error registrando el modelo',"success"=>0));
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(ModeloAeronave $modeloAeronave)
	{
        return view("modelosAeronaves.partials.show", compact('modeloAeronave'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$model = ModeloAeronave::find($id);
		$tipos = TipoAeronave::lists('nombre', 'id');
		return view('modelosAeronaves.partials.edit', compact('model', 'tipos'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, ModeloAeronaveRequest $request)
	{
		$model              = ModeloAeronave::find($id);
		$model->modelo      =$request->input('modelo');
		$model->peso_maximo =$request->input('peso_maximo');
		$model->tipo_id     =$request->input('tipo_id');


		if($model->save())
		{
			return response()->json(array("text"=>"Registro modificado correctamente", 
										  "modelo"=>$model->load("tipo"), "success"=>1));
		}
		else
		{
			return response()->json(array("text"=>"Ocurrió un error modificando el registro", "success"=>0));
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
        if(\App\ModeloAeronave::destroy($id)){
            return ["success"=>1, "text" => "El modelo fue eliminado con exito."];
        }else{
            return ["success"=>0, "text" => "El modelo no fue eliminado."];
        }


    }
}
