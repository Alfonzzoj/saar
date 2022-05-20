<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\ClienteRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cliente;

class ClienteController extends Controller {


    public function __construct()
    {
        $this->middleware('auth');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
        $clientes=$this->getPagination($request);

        if($request->ajax()){
            return view("cliente.partials.ajaxPagination", compact('clientes'))->withInput(\Input::all());
        }
        $clientes->setPath('cliente');
		return view("cliente.index", compact('clientes'))->withInput(\Input::all());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Cliente $cliente)
	{

        $cliente->islrpercentage="5";
        $cliente->ivapercentage="75";
        $cliente->pais_id="232";
		return view("cliente.create", compact('cliente'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ClienteRequest $request)
	{

		$clientes=\App\Cliente::all();
		foreach ($clientes as $cliente) {
			$prefijo    =$cliente->cedRifPrefix;
			$cedRif     =$cliente->cedRif;
			$prefijoReq =$request->get('cedRifPrefix');
			$cedRifReq  =$request->get('cedRif');
			if($prefijo.$cedRif==$prefijoReq.$cedRifReq){
	        	return redirect()->back()->withErrors('El RIF indicado ya se encuentra registrado.')->withInput();
			}
		}

        $cliente=\App\Cliente::create($request->except('hangars', 'isContribuyente'));
		$cliente->isContribuyente =$request->input('isContribuyente', 0);
        if($request->get('tipo')!="No Aeronáutico")
            $hangars=$request->get('hangars',[]);
        else
            $hangars=[];
        $cliente->hangars()->sync(array_flatten($hangars));
		$cliente->save();
        return redirect("administracion/cliente")->with('status','El cliente fue creado exitósamente.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Cliente $cliente)
	{
        return view("cliente.partials.show", compact('cliente'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Cliente $cliente)
	{
        return view("cliente.edit", compact('cliente'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Cliente $cliente, ClienteRequest $request)
	{
		$factura = \App\Factura::where('cliente_id', $cliente->id)->get();

		/*if($factura->count() > 0){
			$nombreActual = Cliente::find($cliente->id)->nombre;
			if($nombreActual != $request->nombre){
        		return redirect()->back()->withErrors('No se puede modificar el nombre del cliente ya que tiene movimientos asociados.')->withInput();
			}
		}*/

        $cliente->update($request->except('hangars', 'isContribuyente'));
		$cliente->isContribuyente =$request->input('isContribuyente', 0);
        if($request->get('tipo')!="No Aeronáutico")
            $hangars=$request->get('hangars',[]);
        else
            $hangars=[];
        $cliente->hangars()->sync(array_flatten($hangars));
		$cliente->save();
        return redirect("administracion/cliente")->with('status','El cliente fue actualizado exitósamente.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy(Cliente $cliente)
    {
		$cliente->hangars()->detach();
        try{
            if($cliente->delete())
                return ["success"=>1, "text"=>"El cliente se ha eliminado con éxito"];
        }catch(\Exception $e){
            return ["success"=>0, "text"=>"No se pudo eliminar el cliente.<br>Consulte un administrador.<br> Error:".$e->getCode()];

        }


    }





    protected function getPagination($request){
        $sortName= $request->get('sortName','codigo');
        $sortName=($sortName=="")?"codigo":$sortName;

        $sortType= $request->get('sortType','ASC');
        $sortType=($sortType=="")?"ASC":$sortType;


        $cedRifPrefix= $request->get('cedRifPrefix', '_');
        $codigo= $request->get('codigo', '%');
        $nombre= $request->get('nombre', '%');
        $cedRif= $request->get('cedRif', '%');
        $tipo= $request->get('tipo', '%');
        \Input::merge(['cedRifPrefix'=>$cedRifPrefix,
            'sortName'=>$sortName,
            'sortType'=>$sortType]);
        $clientes=Cliente:: select('clientes.*', \DB::raw('CONCAT(cedRifPrefix,cedRif) as cedRifTotal'))
            ->where('codigo', 'like', "%$codigo%")
            ->where('nombre', 'like', "%$nombre%")
            ->where('cedRifPrefix', 'like', "$cedRifPrefix")
            ->where('cedRif', 'like', "$cedRif%")
            ->where('tipo', 'like',$tipo)
            ->orderBy($sortName, $sortType)->paginate(10);

        return $clientes;


    }

}
