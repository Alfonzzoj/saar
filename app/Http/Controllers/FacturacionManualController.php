<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class FacturacionManualController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{

        $sortName         = $request->get('sortName','id');
        $sortName         =($sortName=="")?"id":$sortName;
        
        $sortType         = $request->get('sortType','DESC');
        $sortType         =($sortType=="")?"DESC":$sortType;
        
        
        $nFactura         = $request->get('nFactura');
        $nFactura         =($nFactura=="")?0:$nFactura;
        $nFacturaOperator = $request->get('nFacturaOperator', '>=');
        $nFacturaOperator =($nFacturaOperator=="")?'>=':$nFacturaOperator;
        $nFacturaOperator =($nFactura==0)?">=":$nFacturaOperator;
        
        $nControl         = $request->get('nControl');
        $nControl         =($nControl=="")?0:$nControl;
        $nControlOperator = $request->get('nControlOperator', '>=');
        $nControlOperator =($nControlOperator=="")?'>=':$nControlOperator;
        $nControlOperator =($nControl==0)?">=":$nControlOperator;
        
        $clienteNombre    = $request->get('clienteNombre', '%');
        
        $descripcion      = $request->get('descripcion', '%');
        
        $total            = $request->get('total');
        $total            =($total=="")?0:$total;
        $totalOperator    = $request->get('totalOperator', '>=');
        $totalOperator    =($totalOperator=="")?'>=':$totalOperator;
        $totalOperator    =($total==0)?">=":$totalOperator;
        
        
        $fecha            = $request->get('fecha');
        $fechaOperator    = $request->get('fechaOperator', '>=');
        $fechaOperator    =($fechaOperator=="")?'>=':$fechaOperator;
        if($fecha==""){
            $fecha         ='0000-00-00';
            $fechaOperator ='>=';
        }else{
            $fecha            =\Carbon\Carbon::createFromFormat('d/m/Y', $fecha);
            $fecha            = $fecha->toDateString();
        }

        $estado               = $request->get('estado', '%');
        $estado               =($estado=="")?"%":$estado;


        if($total==""){
            $total         =0;
            $totalOperator ='>=';
        }else{
                $total            =$this->parseDecimal($total);
        }



        $modulo=\App\Modulo::where("nombre","like",'DOSAS')->where('aeropuerto_id', session('aeropuerto')->id)->first();


        $prefixManual = \App\Modulo::where('nombre', 'DOSAS')
                                ->where('aeropuerto_id', session('aeropuerto')->id)
                                ->first();
        $prefixManual = $prefixManual->nFacturaPrefixManual;  


        if($estado == 'A'){
            $modulo->facturas=\App\Factura::onlyTrashed()
                                            ->select("facturas.*","clientes.nombre as clienteNombre")
                                            ->join('clientes','clientes.id' , '=', 'facturas.cliente_id')
                                            ->where('facturas.modulo_id', "=", $modulo->id)
                                			->where('nFacturaPrefix', $prefixManual)
                                            ->where('facturas.nControl', $nControlOperator, $nControl)
                                            ->where('facturas.nFactura', $nFacturaOperator, $nFactura)
                                            ->where('total', $totalOperator, $total)
                                            ->where('fecha', $fechaOperator, $fecha)
                                            ->where('descripcion', 'like', "%$descripcion%")
                                            ->where('clientes.nombre', 'like', "%$clienteNombre%")
                                            ->where('facturas.aeropuerto_id','=', session('aeropuerto')->id)
                                            ->with('cliente')->groupBy("facturas.nFactura")
                                            ->orderBy('nFactura', $sortType)->paginate(10);
        }else{
            $modulo->facturas=\App\Factura::select("facturas.*","clientes.nombre as clienteNombre")
                                ->join('clientes','clientes.id' , '=', 'facturas.cliente_id')
                                ->where('facturas.modulo_id', "=", $modulo->id)
                                ->where('nFacturaPrefix', $prefixManual)
                                ->where('facturas.nControl', $nControlOperator, $nControl)
                                ->where('facturas.nFactura', $nFacturaOperator, $nFactura)
                                ->where('total', $totalOperator, $total)
                                ->where('fecha', $fechaOperator, $fecha)
                                ->where('descripcion', 'like', "%$descripcion%")
                                ->where('clientes.nombre', 'like', "%$clienteNombre%")
                                ->where('facturas.aeropuerto_id','=', session('aeropuerto')->id)
                                ->where('estado', 'like', $estado)
                                ->with('cliente')->groupBy("facturas.nFactura")
                                ->orderBy('nFactura', $sortType)->paginate(10);
        }

        $modulo->facturas->setPath('');

/*

        \Input::merge([ 'fechaOperator'   =>$fechaOperator,
                        'nFacturaOperator'  =>$nFacturaOperator,
                        'nControlOperator'  =>$nControlOperator,
                        'totalOperator'     =>$totalOperator,
                        'sortName'          =>$sortName,
                        'sortType'          =>$sortType]);
*/

        return view('factura.facturaManual.index', compact('modulo'))->withInput(\Input::all());
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
		//
	}

}
