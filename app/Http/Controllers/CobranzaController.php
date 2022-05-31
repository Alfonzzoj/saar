<?php namespace App\Http\Controllers;

use App\Facturametadata;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\DecimalConverterTrait;

class CobranzaController extends Controller {

    use DecimalConverterTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function main($moduloNombre){
        $moduloNombre=($moduloNombre=="Todos")?"%":$moduloNombre;
        $modulos=$this->getModulos($moduloNombre);
        return view('cobranza.main', compact('modulos'));
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($moduloNombre, Request $request)
	{

        $sortName           = $request->get('sortName','id');
        $sortName           = ($sortName=="")?"id":$sortName;

        $sortType           = $request->get('sortType','DESC');
        $sortType           = ($sortType=="")?"DESC":$sortType;


        $cobroId            = $request->get('id');
        $cobroId            = ($cobroId=="")?0:$cobroId;
        $cobroIdOperator    = $request->get('cobroIdOperator', '>=');
        $cobroIdOperator    = ($cobroIdOperator=="")?'>=':$cobroIdOperator;
        $cobroIdOperator    = ($cobroId==0)?">=":$cobroIdOperator;

        $clienteNombre      = $request->get('clienteNombre', '%');

        $observacion        = $request->get('observacion', '%');

        $pagado             = $request->get('pagado');
        $pagado             =($pagado=="")?0:$pagado;
        $pagadoOperator     = $request->get('pagadoOperator', '>=');
        $pagadoOperator     =($pagadoOperator=="")?'>=':$pagadoOperator;
        $pagadoOperator     =($pagado==0)?">=":$pagadoOperator;

        $depositado         = $request->get('depositado');
        $depositado         = ($depositado=="")?0:$depositado;
        $depositadoOperator = $request->get('depositadoOperator', '>=');
        $depositadoOperator = ($depositadoOperator=="")?'>=':$depositadoOperator;
        $depositadoOperator = ($depositado==0)?">=":$depositadoOperator;

        $fecha              = $request->get('fecha');
        $fechaOperator      = $request->get('fechaOperator', '>=');
        $fechaOperator      = ($fechaOperator=="")?'>=':$fechaOperator;

        if($fecha==""){
            $fecha         ='0000-00-00';
            $fechaOperator ='>=';
        }else{
                $fecha            =\Carbon\Carbon::createFromFormat('d/m/Y', $fecha);
                $fecha            = $fecha->toDateString();
        }
        if($pagado==""){
            $pagado         =0;
            $pagadoOperator ='>=';
        }else{
                $pagado            =$this->parseDecimal($pagado);
        }
        if($depositado==""){
            $depositado         =0;
            $depositadoOperator ='>=';
        }else{
                $depositado            =$this->parseDecimal($depositado);
        }



        $modulo=\App\Modulo::where("nombre","like",$moduloNombre)
                            ->where('aeropuerto_id','=', session('aeropuerto')->id)->first();

        $cobros=\App\Cobro::select("cobros.*","clientes.nombre as clienteNombre")
        ->join('clientes','clientes.id' , '=', 'cobros.cliente_id')
        ->where('cobros.modulo_id', "=", $modulo->id)
        ->where('cobros.id', ($cobroId==0)?'>':'=', $cobroId)
        ->where('montodepositado', $depositadoOperator, $depositado)
        ->where('montofacturas', $pagadoOperator, $pagado)
        ->where('cobros.fecha', $fechaOperator, $fecha)
        ->where('observacion', 'like', "%$observacion%")
        ->where('clientes.nombre', 'like', "%$clienteNombre%")
        ->where('cobros.aeropuerto_id', session('aeropuerto')->id)
        ->with('cliente');

        $cobros=$cobros->orderBy($sortName, $sortType)->paginate(15);
        $cobros->setPath('');

/*
        \Input::replace([ 'fechaOperator'      =>'=',
                        'cobroIdOperator'    =>'=',
                        'pagadoOperator'     =>'=',
                        'depositadoOperator' =>'=',
                        'sortName'           =>$sortName,
                        'sortType'           =>$sortType]);
*/

        
        return view('cobranza.index', compact('cobros','modulo'))->withInput(\Input::all());
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($moduloName)
	{
        $idOperator=">=";
        $id=0;
        if($moduloName!="Todos"){
            $modulo=\App\Modulo::where("nombre","like",$moduloName)->where('aeropuerto_id', session('aeropuerto')->id)->orderBy("nombre")->first();
            $id=$modulo->id;
            $idOperator="=";
        }
        $clientes=$this->getClientesPendietesByModulo($idOperator, $id);
        $bancos=\App\Banco::with('cuentas')->get();
        $today               = \Carbon\Carbon::now();
        $today->timezone     = 'America/New_York';

        return view('cobranza.create',compact('clientes','moduloName', 'bancos','id', 'recibosAnulados', 'today'));
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
	$impresion="";
        \DB::transaction(function () use ($request, &$impresion) {
            $cobro=\App\Cobro::create([
                'cliente_id'    => $request->get('cliente_id'),
                'modulo_id'     => $request->get('modulo_id'),
                'fecha'         => $request->get('fecha'),
                'aeropuerto_id' => session('aeropuerto')->id,
                'nRecibo'       => $request->get('nRecibo')]);

            $facturas=$request->get('facturas',[]);
            $pagos=$request->get('pagos',[]);

            foreach($facturas as $f){
                $factura=\App\Factura::find($f["id"]);

                $facturaMetadata=\App\Facturametadata::firstOrCreate(["factura_id"=>$factura->id]);
                $facturaMetadata->ncobros++;
            /**
             * En el request me llega los porcentajes del iva e isrl que fueron usados en la retencion
             * y el monto de abonado. Debo hallar cuanto de ese monto abonado corresponde la base y al iva
             *
             */
            //Calculo el total de la retencion
            //

           // dd($factura->subtotalNeto, $f["islrpercentage"], round($factura->subtotalNeto*$f["islrpercentage"]/100, 2), round($factura->iva*$f["ivapercentage"]/100, 2), $factura->subtotalNeto*$f["islrpercentage"]/100+($factura->iva*$f["ivapercentage"]/100));
            //$totalRetencion=($factura->subtotalNeto*$f["islrpercentage"]/100)+($factura->iva*$f["ivapercentage"]/100);
            $totalRetencion=round($factura->subtotalNeto*$f["islrpercentage"]/100, 2)+round($factura->iva*$f["ivapercentage"]/100, 2);
            //dd($totalRetencion);

            //Calculo el total que se debe pagar

            $totalPagar=$factura->total-$totalRetencion;

            //Con el total a pagar puedo calcular cuanto porcentualmente contribuye lo abonado al saldo
	    
	    if($totalPagar != 0){
                $abonadoPorcentaje=$f["montoAbonado"]/$totalPagar;
            }else{
                $abonadoPorcentaje = 0;
            }

            //total real abonado a la factura

            $abonadoReal=round($abonadoPorcentaje*$factura->total,2);

            /*
             * ya tengo el abonado real, ahora debo calcular cuanto contribuye a la base y al iva
             */
            //calculo cuanto es el total sin la recarga

            $totalSinRecarga=$factura->total-$factura->recargoTotal;

            //ahora calculo la contribucion porcentual del iva y la base en el total
	    
	    if($totalSinRecarga != 0){
                $ivaPorcentaje=$factura->iva/$totalSinRecarga;
                $baseDespuesDescuentoPorcentaje=$factura->subtotal/$totalSinRecarga;
            }else{
                $ivaPorcentaje = 0;
                $baseDespuesDescuentoPorcentaje = 0;
            }

            //calculo cuanto es la contribucion de la base y el descuento en el subtotalDespuesDescuento
	    if($factura->subtotal != 0) {
                $baseDescuentoPorcentaje=$factura->subtotalNeto/$factura->subtotal;
            }else{
                $baseDescuentoPorcentaje = 0;
            }
            

            //calculo cuanto del saldo abonado en la base

            $base=$abonadoReal*$baseDespuesDescuentoPorcentaje*$baseDescuentoPorcentaje;

            //calculo cuanto del saldo abonado en el iva

            $iva=$abonadoReal*$ivaPorcentaje;

            //Nota si no existiera descuento $base+$iva=$abonadoReal

            //Ya que tengo la base y el iva abonado puedo calcular la retencion abonada

            //dd(round($base*$f["islrpercentage"]/100,2), round($iva*$f["ivapercentage"]/100, 2), round(($base*$f["islrpercentage"]/100)+($iva*$f["ivapercentage"]/100), 2), round($base, 2));
            $retencion=(round($base*$f["islrpercentage"]/100, 2)+round($iva*$f["ivapercentage"]/100, 2));

            $facturaMetadata->montopagado+=$f["montoAbonado"];
            $facturaMetadata->basepagado+=$base;
            $facturaMetadata->ivapagado+=$iva;
            $facturaMetadata->islrpercentage=$f["islrpercentage"];
            $facturaMetadata->ivapercentage=$f["ivapercentage"];
            $facturaMetadata->retencion+=$retencion;
            $facturaMetadata->total+=$abonadoReal;
            $facturaMetadata->save();
            $cobro->facturas()
            ->attach([$factura->id =>
                ['monto' => $f["montoAbonado"],
                'base' => $base,
                'iva' => $iva,
                'islrpercentage' => $f["islrpercentage"],
                'ivapercentage' => $f["ivapercentage"],
                'retencion' => $retencion,
                'total' => $abonadoReal,
                'retencionFecha' => $f["retencionFecha"],
                'retencionComprobante' => $f["retencionComprobante"],
                ]]);


                $factura->estado="C";
                $factura->save();
            
        }

        foreach($pagos as $p){
            if($p["tipo"] != 'DP'){
                $cobro->pagos()->create(["tipo"        =>$p["tipo"],
                                        "fecha"        =>$p["fecha"],
                                        "banco_id"     =>$p["banco_id"],
                                        "cuenta_id"    =>$p["cuenta_id"],
                                        "ncomprobante" =>$p["ncomprobante"],
                                        "monto"        =>$p["monto"]+0]);
            }else{
                $cobro->pagos()->create(["tipo"        =>$p["tipo"],
                                        "fecha"        =>$p["fecha"],
                                        "monto"        =>$p["monto"]+0]);
            }
        }


        $cobro->montofacturas=$request->get("totalFacturas");
        $cobro->montodepositado=$request->get("totalDepositado");
	
        $ajuste=$request->get("ajuste");

        if($cobro->montodepositado>($cobro->montofacturas-$ajuste)){
            $cobro->ajustes()->create([
                                        "monto"         => $cobro->montodepositado-$cobro->montofacturas-$ajuste,
                                        "cliente_id"    => $request->get("cliente_id"),
                                        "aeropuerto_id" => session('aeropuerto')->id]);

        }
        $cobro->observacion=$request->get('observacion');
        $cobro->hasrecaudos=$request->get('hasrecaudos');
        $cobro->save();
        //VERIFICAMOS SI EN EL COBRO EL CLIENTE TIENE AJUSTE SI NO SE CREO, SE REALIZA UN rollback
        if($cobro->montodepositado>($cobro->montofacturas-$ajuste)){
            $tiene_ajuste = \App\Ajuste::where('cliente_id' , $request->get("cliente_id"))->get();
            if(!isset($tiene_ajuste)){
                DB::rollback();
            }
        }
	
        $impresion=action('CobranzaController@getPrint', ["cobro"=>$cobro->id, "modulo"=>$cobro->modulo_id]);
	
	
    });
return ["success"=>1, "impresion" => $impresion];
}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($moduloNombre, $id)
	{

        $cobro=\App\Cobro::find($id);

        $cobro->load('facturas', 'pagos', 'ajustes', 'cliente')->groupBy($cobro->facturas)->orderBy($cobro->facturas);
        $totalDepositado = 0;
        $totalAjuste = 0;
        foreach ($cobro->pagos as $p) {
            # code...
            $totalDepositado +=$p->monto;
        }

        $ajuste     =\DB::table('ajustes')
                            ->select('monto')
                                ->where('cobro_id', $cobro->id)
                                ->lists('monto');
        $ajuste = array_sum($ajuste);

        $totalAjuste =($ajuste<0)?abs($ajuste):'0,00';

        return view('cobranza.show', compact('cobro', 'moduloNombre', 'totalDepositado', 'totalAjuste'));
    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($moduloName, $id)
	{
        $cobro=\App\Cobro::find($id);
        $cobro->load('facturas', 'pagos', 'ajustes', 'cliente');
        $idOperator=">=";
        $id=0;
        if($moduloName!="Todos"){
            $modulo=\App\Modulo::where("nombre","like",$moduloName)->orderBy("nombre")->first();
            $id=$modulo->id;
            $idOperator="=";
        }
        $bancos=\App\Banco::with('cuentas')->get();
        $ajusteCliente= \DB::table('ajustes')
            ->where('cobro_id', $cobro->id)
            ->sum('monto');
        $today               = \Carbon\Carbon::now();
        $today->timezone     = 'America/New_York';
        $s = "$cobro<hr> $bancos<hr> $ajusteCliente<hr> $today";
        
        return view('cobranza.edit',compact('moduloName', 'bancos','id', 'cobro', 'ajusteCliente', 'today'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($moduloName, $id, Request $request)
    {
        $cobro=\App\Cobro::find($id);
        $cobroAttrs=$request->only('nRecibo', 'observacion', 'hasrecaudos', 'fecha');
        $cobro->update($cobroAttrs);
        $pagos=$request->get('pagos');

        $facturas=$request->get('facturas');
        if(isset($pagos)){
            $cobro->pagos()->whereNotIn('id', array_column($pagos, 'id'))->delete();
            foreach($pagos as $pago){
                $pagoAttrs=[
                    "tipo" => $pago['tipo'],
                    "fecha" => $pago['fecha'],
                    "banco_id" => $pago['banco_id'],
                    "cuenta_id" => $pago['cuenta_id'],
                    "ncomprobante" => $pago['ncomprobante'],
                    "monto" => $pago['monto']+0,
                ];
                if(array_key_exists('id', $pago)){
                    $pagoIds[]=$pago['id'];
                    $pago=$cobro->pagos()->find($pago['id']);
                    $pago->update($pagoAttrs);
                }else{
                    $cobro->pagos()->create($pagoAttrs);
                }
            }
        }



        foreach($facturas as $factura){
            $factAttrs=[
                "retencionComprobante" => $factura['retencionComprobante'],
                "retencionFecha" => $factura['retencionFecha'],
            ];
            if(array_key_exists('id', $factura)){
                $facturaIds[]=$factura['id'];
                $factura=$cobro->facturas()->find($factura['id']);
                $cobro->facturas()->updateExistingPivot($factura['id'], $factAttrs);
            }
        }
        return ["success"=>1];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function cambiarRecibo(Request $request)
    {
        $cobro = \App\Cobro::find($request->cobro_id);
        $reciboAnulado=$this->anularRecibo($cobro);
        if($reciboAnulado){
            $reciboAnulado->update(['comentario' => $request->comentario]);
            $cobro->update(["nRecibo"=>$request->nRecibo]);
            return ["success"=>1, "text" => "Número de recibo de caja cambiado exitósamente."];
        }
        else{
           return ["success"=>0, "text" => "Ocurrió un problema cambiando el número de recibo."];
       }
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editDate(Request $request)
	{
        $cobro = \App\Cobro::find($request->cobro_id);
        $date  =  $cobro->update(["fecha"=>$request->fecha]);
        if($date){
            return ["success"=>1, "text" => "Fecha actualizada exitósamente."];
        }
        else{
           return ["success"=>0, "text" => "Ocurrió un problema cambiando la fecha."];
       }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($moduloNombre,  $id)
	{

        \DB::transaction(function () use ($moduloNombre, $id) {
            $cobro                    =\App\Cobro::find($id);
            $facturas                 =$cobro->facturas;
            $nRecibo=$cobro->nRecibo;
            if($nRecibo!=NULL)
                $reciboAnulado=$this->anularRecibo($cobro);

            foreach($facturas as $factura){

                $facturaMetadata=$factura->metadata;
                if($facturaMetadata){
                    $facturaMetadata->ncobros--;
                    if($facturaMetadata->ncobros==0){
                        $facturaMetadata->delete();
                        $factura->estado="P";
                        $factura->save();
                    }else{
                        $facturaMetadata->montopagado-=$factura->pivot->monto;
                        $facturaMetadata->basepagado-=$factura->pivot->base;
                        $facturaMetadata->ivapagado-=$factura->pivot->iva;
                        $facturaMetadata->retencion-=$factura->pivot->retencion;
                        $facturaMetadata->total-=$factura->pivot->total;
                        $facturaMetadata->save();
                        if($facturaMetadata->total!=$factura->total){
                            $factura->estado="P";
                            $factura->save();
                        }
                    }
                }
            }
            if($nRecibo!=NULL){
                if($reciboAnulado){
                    $cobro->delete();
                }
            }else{
                $cobro->delete();
            }
        });

    return ["success"=>1, "text"=>"El cobro se ha eliminado con éxito"];
    }


    protected function anularRecibo($cobro){

        $reciboAnulado=\App\RecibosAnulado::create([
            'fecha'         => \Carbon\Carbon::now()->toDateString(),
            'nroRecibo'     => $cobro->nRecibo,
            'cobro_id'      => $cobro->id,
            'aeropuerto_id' => session('aeropuerto')->id
        ]);
        return $reciboAnulado;
    }


    public function getFacturasClientes($moduloName,Request $request){
        $idOperator=">=";
        $id=0;
        if($moduloName!="Todos"){
            $modulo=\App\Modulo::where("nombre","like",$moduloName)
            ->where('aeropuerto_id', session('aeropuerto')->id)
            ->first();
            $id=$modulo->id;
            $idOperator="=";
        }
        $codigo  =$request->get('codigo');
        $cliente =\App\Cliente::where("codigo","=", $codigo)->get()->first();
        if(!$cliente)
            return ["facturas"=>[], "ajuste"=> [], "ajusteCobros"=>[]];

        $facturas=\App\Factura::with('metadata')
            ->where('cliente_id', $cliente->id)
            ->where('modulo_id', $idOperator, $id)
            ->where('aeropuerto_id', session('aeropuerto')->id)
            ->where('facturas.estado','=','P')
            ->groupBy("facturas.id")->get();
        $ajusteCliente= \DB::table('ajustes')
            ->where('cliente_id', $cliente->id)
            ->where('aeropuerto_id', session('aeropuerto')->id)
            ->sum('monto');
        $ajusteCobros= \DB::table('ajustes')
            ->select('cobro_id')
            ->where('cliente_id', $cliente->id)
            ->where('aeropuerto_id', session('aeropuerto')->id)
            ->get();

        return ["facturas"=>$facturas, "ajuste"=> $ajusteCliente, "ajusteCobros"=> $ajusteCobros];
    }

    protected function getClientesPendietesByModulo($idOperator, $id){
        return \App\Cliente::join('facturas','facturas.cliente_id' , '=', 'clientes.id')
            ->where('facturas.aeropuerto_id','=', session('aeropuerto')->id)
            ->where('facturas.modulo_id', $idOperator, $id)
            ->where('facturas.estado','=','P')
            ->orderBy('clientes.nombre')
            ->groupBy("clientes.id")->get();
    }

    protected function getModulos($moduloNombre){
        $modulos=session('aeropuerto')->modulos()->where('isActivo',1)->where("nombre","like",$moduloNombre)->orderBy("nombre")->get();
        return $modulos;
    }

    protected function crearRecibo($cobro, $output= 'I', $dir='ReciboCaja/'){

        $cobroid =$cobro;
        $cobro   =\App\Cobro::with('pagos', 'cliente')->find($cobroid);
	
        $monto = 0;
        $aeropuerto=session('aeropuerto');

        foreach ($cobro->pagos as $c){
            $pagos[]   =\App\Cobrospago::with('banco', 'cuenta')->find($c->id);
            $monto += $c->monto;
            $cuentas[] =\App\Bancoscuenta::where('id', $c->cuenta_id)->get();
        }
    
        $fechaDesglose = explode('/', $cobro->fecha);

        // $ajuste = \App\Ajuste::with('cobro')
        //                     ->where('cliente_id', $cobro->cliente_id)
        //                     ->where('aeropuerto_id', $cobro->aeropuerto_id)
        //                     ->where('cobro_id', '=', $cobro->id)
        //                     ->get();

        $ajuste= \DB::table('ajustes')
            ->where('cobro_id', $cobro->id)
            ->where('aeropuerto_id', $cobro->aeropuerto_id)
            ->lists('monto');

        $ajustetotal= \DB::table('ajustes')
            ->where('cliente_id', $cobro->cliente_id)
            ->where('aeropuerto_id', $cobro->aeropuerto_id)
            ->lists('monto');

        if (count($ajustetotal) > 0) {
            $ajustetotal = array_sum($ajustetotal);

            if ($ajustetotal < 0) {
                $ajustetotal = 0;
            }
        } else {
            $ajustetotal = 0;
        }

        if (count($ajuste) > 0) {
            $ajuste = array_sum($ajuste);
            if ($ajuste < 0) {
                $monto += abs($ajuste);
            }
        } else {
            $ajuste = 0;
        }



        //dd($cobro);
        //return view('pdf.factura', compact('factura'));
        // create new PDF document
        $pdf = new \TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        // set margins
        $pdf->SetMargins('8', PDF_MARGIN_TOP, '0');
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        // ---------------------------------------------------------
        // set default font subsetting mode
        $pdf->setFontSubsetting(true);
        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('helvetica', '', '10', '', true);
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
        // set text shadow effect
        // Set some content to print
        //

        // @if($ajustetotal > 0) SALDO A FAVOR: {{$traductor->format($ajustetotal)}}) @endif
        $html = view('pdf.reciboCaja', compact('cobro', 'pagos', 'cuentas', 'ajuste','ajustetotal', 'monto', 'traductor', 'fechaDesglose'))->render();

        // Print text using writeHTMLCell()
        $pdf->writeHTML($html);
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        ob_end_clean();
        if($output=='I')
            $pdf->Output($cobro->id."reciboCaja.pdf", $output);
        else{
            $path=$dir.$cobro->id."reciboCaja.pdf";
            $pdf->Output($path, $output);
            return $path;
        }
        $factura->update(["isImpresa"=> true]);
    }


    public function getPrint($modulo, $cobro){
      return $this->crearRecibo($cobro);
    }

}
