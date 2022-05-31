<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContratoRequest;
use Illuminate\Http\Request;
use \App\Contrato;

class ContratoController extends Controller {


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function postRenovarContratos(){

        $hoy=\Carbon\Carbon::now();
        $contratos=\App\Contrato::where('isReanudacionAutomatica', true)->get();
        foreach($contratos as $contrato){
            $meses=$contrato->mesesReanudacion;
            $fechaVencimiento=\Carbon\Carbon::createFromFormat('d/m/Y', $contrato->fechaVencimiento);
            while($fechaVencimiento<$hoy)
                $fechaVencimiento=$fechaVencimiento->addMonth($meses);
            $contrato->update(['fechaVencimiento' => $fechaVencimiento->format('d/m/Y')]);
        }
        return ["success"=>1, "text"=> "Los contratos se han actualizado con exito."];
    }


    public function postRenovarContratosIndiv(Request $request){

        $id= $request->get('id');

        $hoy=\Carbon\Carbon::now();
        $contrato=\App\Contrato::find($id);
        if ($contrato) {
            $meses = $contrato->mesesReanudacion;
            $fechaVencimiento = \Carbon\Carbon::createFromFormat('d/m/Y', $contrato->fechaVencimiento);

            while ($fechaVencimiento < $hoy)

                $fechaVencimiento = $fechaVencimiento->addMonth($meses);
            if ($contrato->update(['fechaVencimiento' => $fechaVencimiento->format('d/m/Y')])) {
                return ["success" => 1, "text" => "El contratos se han actualizado con exito."];
            } else {
                return ["success" => 0, "text" => "Error al renovar Contrato."];
            }
        } else {
            return ["success" => 0, "text" => "Error, No se encontro el contrato"];
        }
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{



        $sortName= $request->get('sortName','nContrato');
        $sortName=($sortName=="")?"nContrato":$sortName;

        $sortType= $request->get('sortType','ASC');
        $sortType=($sortType=="")?"ASC":$sortType;

        $nContrato= $request->get('nContrato', '%');

        $clienteNombre= $request->get('clienteNombre', '%');

        $concepto_id= $request->get('concepto_id', 0);
        $conceptoOperator=($concepto_id==0)?">":"=";

        $fechaInicio= $request->get('fechaInicio');
        $fechaInicioOperator= $request->get('fechaInicioOperator', '>=');
        $fechaInicioOperator=($fechaInicioOperator=="")?'>=':$fechaInicioOperator;
        if($fechaInicio==""){
            $fechaInicio='0000-00-00';
            $fechaInicioOperator='>=';
        }else{
            $fechaInicio=\Carbon\Carbon::createFromFormat('d/m/Y', $fechaInicio);
        }

        $fechaVencimientoOperator= $request->get('fechaVencimientoOperator', '<=');
        $fechaVencimientoOperator=($fechaVencimientoOperator=="")?"<=":$fechaVencimientoOperator;
        $fechaVencimiento= $request->get('fechaVencimiento');
        if($fechaVencimiento==""){
            $fechaVencimiento='3000-00-00';
            $fechaVencimientoOperator='<=';
        }else{
            $fechaVencimiento=\Carbon\Carbon::createFromFormat('d/m/Y', $fechaVencimiento);
        }

        \Input::merge(['fechaInicioOperator'=>$fechaVencimientoOperator,
                       'fechaVencimientoOperator'=>$fechaInicioOperator,
                       'sortName'=>$sortName,
                       'sortType'=>$sortType]);

        $contratos=Contrato:: select("contratos.*","clientes.nombre as clienteNombre", "conceptos.nompre as conceptoNombre")
            ->join('clientes','clientes.id' , '=', 'contratos.cliente_id')
            ->join('conceptos','conceptos.id' , '=', 'contratos.concepto_id')
            ->where('nContrato', 'like', "$nContrato%")
            ->where('concepto_id', $conceptoOperator, $concepto_id)
            ->where('fechaInicio', $fechaInicioOperator, $fechaInicio)
            ->where('fechaVencimiento', $fechaVencimientoOperator, $fechaVencimiento)
            ->where('clientes.nombre', 'like', "%$clienteNombre%")
            ->where('clientes.isActivo', '1')
            ->where('conceptos.aeropuerto_id','=', session('aeropuerto')->id)
            ->orderBy($sortName, $sortType)->paginate(10);
        $contratos->setPath('contrato');
        $conceptos=["Todos"]+\App\Concepto::where('aeropuerto_id', '=', session('aeropuerto')->id)->orderBy('nompre', 'ASC')->lists('nompre', 'id');
        $contratos->load('concepto', 'cliente');

        return view("contrato.index", compact('contratos','conceptos'))->withInput(\Input::all());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Contrato $contrato)
	{
        return view("contrato.create", compact('contrato' ));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ContratoRequest $request)
	{
        $all=$input = $request->except('img-file');
        if ($request->hasFile('img-file')) {
            $mime=$request->file('img-file')->getClientOriginalExtension();
            $fileName=$request->get('nContrato')."-Img.$mime";
            $request->file('img-file')->move(public_path('uploads/contratos'),$fileName );
            $all=array_add($all, "imagen", "uploads/contratos/$fileName");
        }
        Contrato::create($all);
        return redirect("contrato")->with('status','El contrato fue creado exitosamente.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Contrato $contrato)
	{

        $contrato->load('concepto', 'cliente');
        return view("contrato.partials.show", compact('contrato'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Contrato $contrato)
	{
        return view("contrato.edit", compact('contrato' ));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Contrato $contrato, ContratoRequest $request)
	{

        $all=$input = $request->except('img-file');
        if ($request->hasFile('img-file')) {
           if(\File::exists($contrato->imagen)){
               \File::delete($contrato->imagen);
           }
            $mime=$request->file('img-file')->getClientOriginalExtension();
            $fileName=$request->get('nContrato')."-Img.$mime";
            $request->file('img-file')->move(public_path('uploads/contratos'),$fileName );
            $all=array_add($all, "imagen", "uploads/contratos/$fileName");
        }

        $contrato->update($all);
        return redirect("contrato")->with('status','El contrato fue actualizado exitosamente.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Contrato $contrato)
	{
        if($contrato->delete())
            return ["success"=>1, "text"=>"El contrato se ha eliminado con exito"];
        else
            return ["success"=>0, "text"=>"No se pudo eliminar el contrato con exito"];
	}


    public function lote()
    {
        $contratos=\App\Contrato::with('cliente')
        ->join('clientes','clientes.id' , '=', 'contratos.cliente_id')
        ->join('conceptos','conceptos.id' , '=', 'contratos.concepto_id')
        ->where('fechaVencimiento', '>=', \Carbon\Carbon::now()->format('d/m/Y'))
        ->where('clientes.isActivo', '1')
        ->where('conceptos.aeropuerto_id','=', session('aeropuerto')->id)
        ->get();

        return view('contrato.lote', compact('contratos'));
    }


    public function loteStore(Request $request)
    {

        $contratoIds=$request->get('id', []);
        $montos=$request->get('monto');
        foreach($contratoIds as $index => $id){
            $contrato=\App\Contrato::find($id);
            $contrato->update(["monto" => $montos[$index]]);
        }
        return redirect("contrato")->with('status','Los contratos fueron actualizados exitosamente.');
    }

}
