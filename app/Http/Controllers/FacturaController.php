<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\FacturaRequest;
use App\Http\Controllers\Controller;
use \App\Factura;
use App\Fbo;
use App\MontosFijo;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use App\Traits\DecimalConverterTrait;

class FacturaController extends Controller {

    use DecimalConverterTrait;

    protected $meses=[
    "1"  =>"ENERO",
    "2"  =>"FEBRERO",
    "3"  =>"MARZO",
    "4"  =>"ABRIL",
    "5"  =>"MAYO",
    "6"  =>"JUNIO",
    "7"  =>"JULIO",
    "8"  =>"AGOSTO",
    "9"  =>"SEPTIEMBRE",
    "10" =>"OCTUBRE",
    "11" =>"NOVIEMBRE",
    "12" =>"DICIEMBRE"];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function postContratosStoreAutomatica($moduloNombre, Request $request){
        $facturasDb=new Collection([]);
        $facturas=$request->get('facturas');

        foreach($facturas as $factura){

            \DB::transaction(function () use ($factura, $moduloNombre, &$facturasDb) {
                //no muy eficiente porque todas estas facturas tienen el mismo concepto pero bueno :/
                $concepto                =\App\Concepto::find($factura["concepto_id"]);
                $f                       = new \App\Factura();
                $f->aeropuerto_id        =session('aeropuerto')->id;
                $f->condicionPago        ='Crédito';
                $f->nFacturaPrefix       = $factura["nFacturaPrefix"];
                $f->nFactura             = $factura["nFactura"];
                $f->nControlPrefix       = $factura["nControlPrefix"];
                $f->nControl             = $factura["nControl"];
                $f->fechaControlContrato = $factura["fechaControlContrato"];
                $f->fecha                = $factura["fecha"];
                $f->fechaVencimiento     = $factura["fechaVencimiento"];
                $f->cliente_id           = $factura["cliente_id"];
                $f->modulo_id            = $factura["modulo_id"];
                $f->contrato_id          = $factura["contrato_id"];
               // $subtotal                = ($factura['monto'] / (1 + $concepto->iva / 100));
                $subtotal                = $this->parseDecimal($factura['monto']);
                $f->subtotalNeto         = $subtotal;
                $f->descuentoTotal       = 0;
                $f->subtotal             = $subtotal;
                //$f->iva                  = $factura['monto'] - $subtotal;
                $f->iva                  = ($subtotal*($concepto->iva/100));
                $f->recargoTotal         = 0;
                //$f->total                = $factura['monto'];
                $f->total                = (($subtotal*($concepto->iva/100))+$subtotal);
                $f->estado               ='P';

                if($moduloNombre=="CANON"){
                    $hoy           =\Carbon\Carbon::createFromFormat('d/m/Y',$factura["fechaControlContrato"]) ;
                    $hoy->timezone = 'America/Caracas';
                    $f->descripcion="PERIODO ".$this->meses[$hoy->month]." $hoy->year  PATENTE: 2010-AG1845";
                }
                if($f->save()){
                    $f->detalles()->create([
                                            "concepto_id" => $factura["concepto_id"],
                                            "cantidadDes" => "1",
                                            "montoDes" => $subtotal,
                                            "descuentoPerDes" => 0,
                                            "descuentoTotalDes" =>0,
                                            "ivaDes" => $concepto->iva,
                                            "recargoPerDes" => 0,
                                            "recargoTotalDes" =>0,
                                            "totalDes" => $f->total
                                            ]);
                    $facturasDb->push($f);
                }

            });
        }
        session()->put('facturasAutomaticas', $facturasDb);
        return;

    }
    public function getContratosAutomaticaResult($moduloNombre, Request $request){
        $facturas=session()->get('facturasAutomaticas');
        $modulo = \App\Modulo::where("nombre","like",$moduloNombre)->where('aeropuerto_id', session('aeropuerto')->id)->first();
        if(!$facturas)
            return response("Esta pagina ha expirado. Consulte las facturas por medio del modulo de facturacion correspondiente.", 500);
        return view('factura.automaticaResult', ["facturas" => $facturas, "modulo" => $modulo]);
    }
    public function automatica($moduloNombre) {

        $today=\Carbon\Carbon::now();
        $fecha=\Carbon\Carbon::now()->lastOfMonth();
        $modulo = \App\Modulo::where("nombre","like",$moduloNombre)->where('aeropuerto_id', session('aeropuerto')->id)->first();
        $contratos=$modulo->contratos()->where('fechaInicio', '<=' ,$fecha)->where('fechaVencimiento', '>=', $fecha)->with('cliente')->orderBy('nContrato')->get();
        return view('factura.automatica', compact('modulo', 'fecha', 'contratos', 'today'));
    }

    public function postContratosByFecha($moduloNombre, Request $request){


            $year      =$request->get('year');
            $month     =$request->get('month');
            $modulo    =\App\Modulo::where("nombre","like",$moduloNombre)->where('aeropuerto_id', session('aeropuerto')->id)->first();
            $fecha     =\Carbon\Carbon::create($year, $month, 1)->lastOfMonth();
            $contratos =$modulo->contratos()->where('fechaInicio', '<=' ,$fecha)->where('fechaVencimiento', '>=', $fecha)->with('cliente')->get();

        return view('factura.partials.automaticaContratos', compact('contratos', 'fecha'));

    }
    /**
     * @param $factura
     * @param string $output
     * I = imprimir en el explorador
     * F =  guardar en un archivo
     *
     * @return pdf
     */
    protected function crearFactura($factura, $output = 'I', $dir = 'facturas/'){
        $despegue = \App\Despegue::with('aterrizaje')
                                    ->where('factura_id', $factura->id)
                                    ->first();

        $factura->load('detalles');
        //return view('pdf.factura', compact('factura'));
        // create new PDF document
        $pdf = new \TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        // set margins
        $pdf->SetMargins(5, PDF_MARGIN_TOP, '4');
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
       // $pdf->SetFont('helvetica', '', 10, '', true);
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
        // set text shadow effect
        // Set some content to print
        //
        if($despegue){
            $pdf->SetFont('helvetica', '', '10', true);
            if ($despegue->fbo_id != null) {
                $fbo = Fbo::where('id',$despegue->fbo_id)->first();
                $fbo_nombre = $fbo->nombre;
                $despegue->fbo = $fbo_nombre;
            }

            $html = view('pdf.dosa', compact('factura', 'despegue', 'traductor'))->render();
        }else{
            $pdf->SetFont('helvetica', '', '10', '', true);
            $html = view('pdf.factura', compact('factura', 'traductor'))->render();
        }
        // Print text using writeHTMLCell()
        $pdf->writeHTML($html, true, false, true, false, '');
    
        //$pdf->writeHTML($html);
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.

        if($output=='I'){
            $pdf->Output($factura->id."factura.pdf", $output);
        }
        else{
            //$path=$dir.$factura->id."factura.pdf";
            $path=$factura->id."factura.pdf";
            $pdf->Output($path, $output);
            return $path;
        }
        $factura->update(["isImpresa"=> true]);
    }


    public function getPrint($modulo, Factura $factura){
      return $this->crearFactura($factura);
    }


    public function main($moduloNombre){
         
        $moduloNombre     =($moduloNombre=="Todos")?"%":$moduloNombre;
        $modulos          =$this->getModulos($moduloNombre);
        $exoneradas = Factura::where('condicionPago', 'Exonerado')->orderBy('id', 'DESC')->limit(15)->get();
        $anuladas = Factura::where('estado', 'A')->orderBy('id', 'DESC')->limit(15)->get();
        $canon = Factura::where('modulo_id','=',2)->orderBy('id', 'DESC')->limit(15)->get();
        $dosas = Factura::where('modulo_id','=',5)->orderBy('id', 'DESC')->limit(15)->get();
        $otros_ingresos_no_aeronauticos = Factura::where('modulo_id','=',8)->orderBy('id', 'DESC')->limit(15)->get();
        $tarjetas_identificacion = Factura::where('modulo_id','=',7)->orderBy('id', 'DESC')->limit(15)->get();
        $tasas = Factura::where('modulo_id','=',22)->orderBy('id', 'DESC')->limit(15)->get();
        // $tasas = Factura::where('modulo_id','=',22)->where('aeropuerto_id','=',session('aeropuerto')->id)->orderBy('id', 'DESC')->limit(15)->get();

        $publicidad = Factura::where('modulo_id','=',9)->orderBy('id', 'DESC')->limit(15)->get();
        return view('factura.main', compact('modulos', 'facturasManuales','exoneradas','anuladas','canon','tarjetas_identificacion','dosas','otros_ingresos_no_aeronauticos','publicidad','tasas'));
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($moduloNombre, Request $request)
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



        $modulo=\App\Modulo::where("nombre","like",$moduloNombre)->where('aeropuerto_id', session('aeropuerto')->id)->first();

        if($estado == 'A'){
            // $modulo->facturas=\App\Factura::onlyTrashed()

            $modulo->facturas=\App\Factura::select("facturas.*","clientes.nombre as clienteNombre")
                                            ->join('clientes','clientes.id' , '=', 'facturas.cliente_id')
                                            ->where('facturas.modulo_id', "=", $modulo->id)
                                            ->where('facturas.nControl', $nControlOperator, $nControl)
                                            ->where('facturas.nFactura', $nFacturaOperator, $nFactura)
                                            ->where('total', $totalOperator, $total)
                                            ->where('fecha', $fechaOperator, $fecha)
                                            ->where('descripcion', 'like', "%$descripcion%")
                                            ->where('estado', 'like', $estado)

                                            ->where('clientes.nombre', 'like', "%$clienteNombre%")
                                            ->where('facturas.aeropuerto_id','=', session('aeropuerto')->id)
                                            ->with('cliente')->groupBy("facturas.nFactura")
                                            ->orderBy('nFactura', $sortType)->paginate(10);
        }else{
            $modulo->facturas=\App\Factura::select("facturas.*","clientes.nombre as clienteNombre")
                                ->join('clientes','clientes.id' , '=', 'facturas.cliente_id')
                                ->where('facturas.modulo_id', "=", $modulo->id)
                                ->where('facturas.nControl', ($nControl==0)?'>':'=', $nControl)
                                ->where('facturas.nFactura', ($nFactura==0)?'>':'=', $nFactura)
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

        return view('factura.index', compact('modulo'))->withInput(\Input::all());
    }

    /**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($modulo,Factura $factura)
	{
        if($modulo=="CANON"){
            $hoy                  =\Carbon\Carbon::now();
            $hoy->timezone        = 'America/Caracas';
            $factura->descripcion ="PERIODO ".$this->meses[$hoy->month]." $hoy->year  PATENTE: 2010-AG1845";
        }
        if($modulo=="ESTACIONAMIENTO"){
            $hoy                  =\Carbon\Carbon::now();
            $hoy->timezone        = 'America/Caracas';
            $factura->descripcion ="PERIODO ".$this->meses[$hoy->month]." $hoy->year  PATENTE: 2010-AG1845";
            }
        if($modulo=="PUBLICIDAD"){
            $hoy                  =\Carbon\Carbon::now();
            $hoy->timezone        = 'America/Caracas';
            $factura->descripcion ="SERVICIOS DE PUBLICIDAD ".$this->meses[$hoy->month]." $hoy->year  PATENTE: 2010-AG1845";
        }
        if($modulo=="TARJETAS DE IDENTIFICACION"){
            $hoy                  =\Carbon\Carbon::now();
            $hoy->timezone        = 'America/Caracas';
            $factura->descripcion ="TARJETAS DE IDENTIFICACIÓN PATENTE 2010 AG-1845";
        }
        $modulo= \App\Modulo::where('nombre', $modulo)->where('aeropuerto_id', session('aeropuerto')->id)->first();
        if(!$modulo){
            return response("No se consiguió el modulo '$modulo' en el aeropuerto de sesion", 500);
        }
        $modulo_id=$modulo->id;
        $fbos = Fbo::all();
        $diasVencimientoCred = \App\OtrasConfiguraciones::where('aeropuerto_id', session('aeropuerto')->id)->first()->diasVencimientoCred;
		return view('factura.create', compact('factura', 'modulo', 'modulo_id','fbos', 'diasVencimientoCred'));
	}




	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($moduloNombre, FacturaRequest $request)
	{
        $mensaje="";
/*        $cp = $request->get('condicionPago');
        $conceptos = \App\Concepto::select('condicionPago')->whereIn('id', $request->get('concepto_id'))->lists('condicionPago');

        foreach($conceptos as $index=> $c){
            if($cp != $c){
                $mensaje='Alguno de los conceptos asociados a la factura no coinciden con la condicion de pago.';
                return ["success" => 0, "mensaje"=>$mensaje];
            }   
        }
*/
        $facturas=\App\Factura::all();
             foreach ($facturas as $factura) {
                $nFacturaPrefix    =$factura->nFacturaPrefix;
                $nControlPrefix    =$factura->nControlPrefix;
                $nFacturaPrefixReq =$request->get('nFacturaPrefix');
                $nControlPrefixReq =$request->get('nControlPrefix');
                $nFactura          =$factura->nFactura;
                $nControl          =$factura->nControl;
                $nFacturaReq       =$request->get('nFactura');
                $nControlReq       =$request->get('nControl');
                if($nFacturaPrefix.$nFactura==$nFacturaPrefixReq.$nFacturaReq){
                    $mensaje='El número de factura indicado ya ha sido tomado.';
                }                
                if($nControlPrefix.$nControl==$nControlPrefixReq.$nControlReq){
                    $mensaje='El número de control indicado ya ha sido tomado.';
                }


            }

        if($mensaje==""){
            $impresion="";
            \DB::transaction(function () use ($moduloNombre, $request, &$impresion,&$mensaje) {
                    $facturaData = $this->getFacturaDataFromRequest($request);
                    $facturaDetallesData = $this->getFacturaDetallesDataFromRequest($request);
                    $facturaData['estado'] = 'P';
                    if ($request->has('nroDosa'))
                        $facturaData['nroDosa'] = $request->get('nroDosa');
                    if ($request->has('aterrizaje_id'))
                        $facturaData['aterrizaje_id'] = $request->get('aterrizaje_id');
                    $factura = \App\Factura::create($facturaData);
                    $factura->detalles()->createMany($facturaDetallesData);
                    $cliente = $factura->cliente;               
                    $factura->nFactura = $request->nFactura;
                    $dicom = MontosFijo::where('aeropuerto_id', session('aeropuerto')->id)->first()->dolar_oficial;
                    $factura->dicom = $dicom;
                    $fbo_id = ($request->fbo_id=='')?null:$request->fbo_id;
                    $factura->fbo_id= $fbo_id;

                    $factura->save();
                    /*
                    if ($cliente && $cliente->isEnvioAutomatico == true && $cliente->email != "") {
                        $path = $this->crearFactura($factura, 'F');
                        Mail::send('emails.test', ['name' => $cliente->nombre], function ($message) use ($factura, $cliente, $path) {
                            $message
                                ->to($cliente->email, $cliente->nombre)
                                ->subject('Vuestra factura #' . $factura->codigo . ' esta lista')
                                ->attach($path);
                        });
                    */

                    if ($request->has('despegue_id')) {
                        $despegue = \App\Despegue::find($request->get('despegue_id'));
                        $despegue->factura_id = $factura->id; 
                        $despegue->save();
                    }
                    if ($request->has('carga_id')) {
                        $carga = \App\Carga::find($request->get('carga_id'));
                        $carga->factura_id = $factura->id;
                        $carga->save();
                    }
                    
                    $impresion=action('FacturaController@getPrint', [$moduloNombre, $factura->id]);                
            });
            return ["success" => 1, "impresion" => $impresion];
        }else{
            return ["success" => 0, "mensaje"=>$mensaje];
        }



	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($moduloId,Factura $factura)
	{
        $nFacturaPrefixManual = \App\Modulo::where('nombre', $moduloId)->first()->nFacturaPrefixManual;
        if($factura->nFacturaPrefix == $nFacturaPrefixManual){

            $factura->load('detalles');
            // $aeropuerto = session('aeropuerto')->id;
             $clientes   = \App\Cliente::all();
            // $conceptos  = \App\Concepto::where('aeropuerto_id', $aeropuerto)->get();
            $nControlPrefix = \App\Modulo::where('nombre', $moduloId)->first()->nFacturaPrefixManual;
            $nFacturaPrefix = $nFacturaPrefixManual;
            $modulo= \App\Modulo::where('nombre', $moduloId)->where('aeropuerto_id', session('aeropuerto')->id)->first();
            $modulo_id = $modulo->id;

            $diasVencimientoCred = \App\OtrasConfiguraciones::where('aeropuerto_id', session('aeropuerto')->id)->first()->diasVencimientoCred;


            return view('factura.facturaManual.partials.show', compact('factura', 'modulo', 'modulo_id', 'diasVencimientoCred', 'nControlPrefix', 'nFacturaPrefix', 'clientes'));

        }
        $modulo= \App\Modulo::where('nombre', $moduloId)->where('aeropuerto_id', session('aeropuerto')->id)->first();
        $factura->load('detalles');
        $modulo_id = $modulo->id;
		return view('factura.partials.show', compact('factura', 'modulo', 'modulo_id'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($modulo, Factura $factura)
	{
        $fbos = Fbo::all();

        $nFacturaPrefixManual = \App\Modulo::where('nombre', $modulo)->first()->nFacturaPrefixManual;
        if($factura->nFacturaPrefix == $nFacturaPrefixManual){

            $factura->load('detalles');
            // $aeropuerto = session('aeropuerto')->id;
             $clientes   = \App\Cliente::all();
            // $conceptos  = \App\Concepto::where('aeropuerto_id', $aeropuerto)->get();
            $nControlPrefix = \App\Modulo::where('nombre', $modulo)->first()->nFacturaPrefixManual;
            $nFacturaPrefix = $nFacturaPrefixManual;

            $modulo= \App\Modulo::where('nombre', $modulo)->where('aeropuerto_id', session('aeropuerto')->id)->first();
            $modulo_id = $modulo->id;

            $diasVencimientoCred = \App\OtrasConfiguraciones::where('aeropuerto_id', session('aeropuerto')->id)->first()->diasVencimientoCred;

            return view('factura.facturaManual.partials.edit', compact('factura', 'modulo', 'modulo_id', 'diasVencimientoCred', 'nControlPrefix', 'nFacturaPrefix', 'clientes','fbos'));

        }

        $modulo= \App\Modulo::where('nombre', $modulo)->where('aeropuerto_id', session('aeropuerto')->id)->first();
        if(!$modulo){
            return response("No se consiguió el modulo '$modulo' en el aeropuerto de sesion", 500);
        }
        $modulo_id=$modulo->id;
        $factura->load('detalles');

        $diasVencimientoCred = \App\OtrasConfiguraciones::where('aeropuerto_id', session('aeropuerto')->id)->first()->diasVencimientoCred;

        return view('factura.edit', compact('factura', 'modulo', 'modulo_id', 'diasVencimientoCred','fbos'));
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($moduloNombre, Factura $factura, FacturaRequest $request)
	{
        \DB::transaction(function () use ($moduloNombre, $factura, $request) {
            $facturaData = $this->getFacturaDataFromRequest($request);
            $facturaDetallesData = $this->getFacturaDetallesDataFromRequest($request);
            $factura->update($facturaData);          
            $factura->detalles()->delete();
            $factura->detalles()->createMany($facturaDetallesData);         
            $factura->nFactura = $request->nFactura;
            $factura->save();


        });
        return ["success" => 1, "impresion" => action('FacturaController@getPrint', [$moduloNombre, $factura->id])];

    }

    public function restore(Request $request){

        $factura = Factura::withTrashed()->find($request['id']);

        if($factura->restore())
            return ["success"=>1, "text"=>"La factura se ha restaurado con éxito."];
        else
            return ["success"=>0, "text"=>"No se pudo resturar la factura."];
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Factura $factura,Request $request)
	{

        if($factura->cobros()->count()>0){
            return ["success"=>0, "text"=>"No se pudo anular la factura ya que posee cobros asociados"];
        }


        $factura->update(['comentario' => $request->comentario]);
        // $factura->update(['status' => 'Anulada']);
        $factura->update(['estado' => 'A']);

        $despegue = \App\Despegue::where('factura_id', $factura->id)->first();

        if($despegue != ''){
            $aterrizaje = $despegue->aterrizaje_id;
            if(\App\Despegue::destroy($despegue->id)){
                if(\App\Aterrizaje::destroy($aterrizaje)){
                    if($factura->delete())
                        return ["success"=>1, "text"=>"La factura se ha anulado con éxito."];
                    else
                        return ["success"=>0, "text"=>"No se pudo anular la factura."];
                }else{
                    return ["success"=>0, "text"=>"No se pudo anular la factura."];
                }
            }else{
                return ["success"=>0, "text"=>"No se pudo anular la factura."];
            }
        }else{
            return ["success"=>1, "text"=>"Anulacion OK "];

        }

        // if($factura->delete())
        //     return ["success"=>1, "text"=>"La factura se ha anulado con éxito."];
        // else
        //     return ["success"=>0, "text"=>"No se pudo anular la factura."];
	}

    public function facturaManual($modulo,Factura $factura){

        $factura    = new Factura();
        $aeropuerto = session('aeropuerto')->id;
        $modulo = \App\Modulo::where('nombre', $modulo)->where('aeropuerto_id', $aeropuerto)->first();
        
        $clientes   = \App\Cliente::all();
        $conceptos  = \App\Concepto::where('aeropuerto_id', $aeropuerto)->orderby('nompre','ASC')->where('stacod','A')->get();
       
        /*$conceptoss = Concepto::where('aeropuerto_id', session('aeropuerto')->id)->orderby('nompre','ASC')->where('stacod','A')->lists('nompre', 'id');*/
        $nControlPrefix = $modulo->nControlPrefixManual;
        $nFacturaPrefix = $modulo->nFacturaPrefixManual;
        $modulo_id=$modulo->id;

        $factura->fill(['aeropuerto_id' => $aeropuerto]);
        $diasVencimientoCred = \App\OtrasConfiguraciones::where('aeropuerto_id', session('aeropuerto')->id)->first()->diasVencimientoCred;


        //RECARGO
        $feriados = \App\DiaFeriado::where('aeropuerto_id', session('aeropuerto')->id)->get();
       
         $conceptos_con_recargo = \App\Concepto::where('aeropuerto_id', $aeropuerto)->where('modulo_id', $modulo->id)->where('stacod','A')->where('recargo','SI')->get();

        return view('factura.facturaManual.create', compact('factura', 'clientes', 'conceptos', 'modulo_id', 'modulo', 'nControlPrefix', 'nFacturaPrefix', 'diasVencimientoCred', 'feriados', 'conceptos_con_recargo'));
    }



    protected function getFacturaDataFromRequest($request){
        return  $request->only('aeropuerto_id',
                                'modulo_id',
                                'condicionPago',
                                'nFacturaPrefix',
                                'nFactura',
                                'nControlPrefix',
                                'nControl',
                                'fecha',
                                'fechaVencimiento',
                                'cliente_id',
                                'subtotalNeto',
                                'descuentoTotal',
                                'subtotal',
                                'iva',
                                'recargoTotal',
                                'total',
                                'descripcion',
                                'aplica_minimo_aterrizaje',
                                'aplica_minimo_estacionamiento',
                                'comentario');


    }

    protected function getFacturaDetallesDataFromRequest($request)
    {

        $detalles=$request->only(   'concepto_id',
                                    'cantidadDes',
                                    'montoDes',
                                    'descuentoPerDes',
                                    'descuentoTotalDes',
                                    'ivaDes',
                                    'recargoPerDes',
                                    'recargoTotalDes',
                                    'totalDes' );

        $size                =count($detalles["concepto_id"]);
        $facturaDetallesData =array();
        for($i=0; $i<$size; $i++){
            $facturaDetallesData[]=array(   'concepto_id'       => $detalles["concepto_id"][$i],
                                            'cantidadDes'       => $detalles["cantidadDes"][$i],
                                            'montoDes'          => $detalles["montoDes"][$i],
                                            'descuentoPerDes'   => $detalles["descuentoPerDes"][$i],
                                            'descuentoTotalDes' => $detalles["descuentoTotalDes"][$i],
                                            'ivaDes'            => $detalles["ivaDes"][$i],
                                            'recargoPerDes'     => $detalles["recargoPerDes"][$i],
                                            'recargoTotalDes'   => $detalles["recargoTotalDes"][$i],
                                            'totalDes'          => $detalles["totalDes"][$i]);
        }
        return $facturaDetallesData;

    }

     protected function getModulos($moduloNombre){
        $modulos=session('aeropuerto')->
        modulos()->where('isActivo',1)->where("nombre","like",$moduloNombre)->orderBy("nombre")->get();
         return $modulos;
    }

}