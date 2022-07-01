<?php namespace App\Http\Controllers;

use App\Aeropuerto;
use App\Modulo;
use App\Ajuste;
use App\Cliente;
use App\Factura;
use App\Fbo;
use App\OtrosCargo;
use App\Meta;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReporteController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getReporteOtrosCargosDetallado(Request $request)
    {
        $mes           =$request->get('mes', Carbon::now()->month);
        $anno          =$request->get('anno',  Carbon::now()->year);
        $aeropuerto    =$request->get('aeropuerto',  session('aeropuerto')->id);
        $montos        =[];
        $montosTotales =[];
        $modulos       =Modulo::where('aeropuerto_id', $aeropuerto)->where('isActivo',1)->where('nombre', 'DOSAS')->get();
        $primerDiaMes  =Carbon::create($anno, $mes,1)->startOfMonth();
        $ultimoDiaMes  =Carbon::create($anno, $mes,1)->endOfMonth();

        for(;$primerDiaMes<=$ultimoDiaMes; $primerDiaMes->addDay())
        {
            foreach ($modulos as $modulo) 
            {
                $montos[$primerDiaMes->format('d/m/Y')][$modulo->nombre]["total"] = DB::table('cobros')->where('modulo_id', $modulo->id)
                        ->where('fecha', 'like', $primerDiaMes->toDateString() . '%')
                        ->sum('montodepositado');
                
                switch ($modulo->nombre) 
                {
                    case 'DOSAS':    
                        $Dconceptos = $modulo->conceptos()->where('nombreImprimible','like','Otros Aero%')->groupby('nompre')->distinct('nompre')->get();

                        foreach ($Dconceptos as $concepto) 
                        {
                            $nombresImprimibles[$modulo->nombre][$concepto->nompre] = 0;

                            $idsConceptos = DB::table('conceptos')->where('aeropuerto_id', $aeropuerto)->where('nompre', $concepto->nompre)->lists('id');

                            switch ($concepto->condicionPago) {
                                case "Contado":                                 
                                    $montos[$primerDiaMes->format('d/m/Y')][$modulo->nombre][$concepto->nompre] = DB::table('facturas')
                                        ->join('cobro_factura', 'cobro_factura.factura_id', '=', 'facturas.id')
                                        ->join('facturadetalles', 'facturadetalles.factura_id', '=', 'facturas.id')
                                        ->join('cobros', 'cobros.id', '=', 'cobro_factura.cobro_id')
                                        ->where('facturas.aeropuerto_id', $aeropuerto)
                                        ->where('facturas.fecha', $primerDiaMes->toDateString())
                                        ->whereIn('facturadetalles.concepto_id', $idsConceptos)
                                        ->sum('facturadetalles.totalDes');
                                         
                                    break;
                                case "Ambas":
                                case "Crédito":
                                    $montos[$primerDiaMes->format('d/m/Y')][$modulo->nombre][$concepto->nompre] = DB::table('facturas')
                                            ->join('cobro_factura', 'cobro_factura.factura_id', '=', 'facturas.id')
                                            ->join('facturadetalles', 'facturadetalles.factura_id', '=', 'facturas.id')
                                            ->join('cobros', 'cobros.id', '=', 'cobro_factura.cobro_id')
                                            ->where('facturas.aeropuerto_id', $aeropuerto)
                                            ->where('cobros.fecha', $primerDiaMes->toDateString())
                                            ->whereIn('facturadetalles.concepto_id', $idsConceptos)
                                            ->sum('facturadetalles.totalDes');
                                    break;
                                case "Default":
                                    break;
                            }
                        }


                        break;
                    default:
                        # code...
                        break;
                }

                if (!isset($montosTotalesMeses[$primerDiaMes->format('d/m/Y')]["totalMes"]))
                    $montosTotalesMeses[$primerDiaMes->format('d/m/Y')]["totalMes"] = 0;
                $montosTotalesMeses[$primerDiaMes->format('d/m/Y')]["totalMes"] += ($montos[$primerDiaMes->format('d/m/Y')][$modulo->nombre]["total"]);

                if (!isset($montosTotales[$modulo->nombre]))
                    $montosTotales[$modulo->nombre] = [];

                if (!isset($montosTotales[$modulo->nombre]["total"]))
                    $montosTotales[$modulo->nombre]["total"] = 0;

                $montosTotales[$modulo->nombre]["total"] += ($montos[$primerDiaMes->format('d/m/Y')][$modulo->nombre]["total"]);

                if (!isset($montosDias[$primerDiaMes->format('d/m/Y')]["total"]))
                    $montosDias[$primerDiaMes->format('d/m/Y')]["total"] = 0;


                $nombresDistintos = $modulo->conceptos()->where('nombreImprimible','like','Otros Aero%')->groupby('nompre')->distinct('nompre')->lists('nompre');


                foreach ($nombresDistintos as $concepto) {
                   
                    if (!isset($montosTotales[$modulo->nombre][$concepto]))
                        $montosTotales[$modulo->nombre][$concepto] = 0;

                    $montosDias[$primerDiaMes->format('d/m/Y')]["total"] += $montos[$primerDiaMes->format('d/m/Y')][$modulo->nombre][$concepto];
                    $montosTotales[$modulo->nombre][$concepto] += ($montos[$primerDiaMes->format('d/m/Y')][$modulo->nombre][$concepto]);

                   /* echo '<div class="text-center">';
                    echo $concepto;
                    print_r($montosTotales[$modulo->nombre][$concepto]);
                    echo '</br>';
                    echo '</div>';*/
                }
            }
        }


        $mes = (int)$mes;
        $meses=[
            1=>"ENERO",
            2=>"FEBRERO",
            3=>"MARZO",
            4=>"ABRIL",
            5=>"MAYO",
            6=>"JUNIO",
            7=>"JULIO",
            8=>"AGOSTO",
            9=>"SEPTIEMBRE",
            10=>"OCTUBRE",
            11=>"NOVIEMBRE",
            12=>"DICIEMBRE"];
        $mesLetras = $meses[$mes];
        $aeropuertoNombre=Aeropuerto::find($aeropuerto)->nombre;

        $annos = DB::table('facturas')->selectRaw('distinct(YEAR (fecha)) as annos')->groupby('fecha')->orderBy('annos','DESC')->lists('annos','annos');

        $aeropuertos = Aeropuerto::where('id','!=',3)->lists('nombre','id');
        return view('reportes.reporteOtrosCargosDetallado', compact('montosDias', 'mesLetras', 'aeropuertoNombre','modulos', 'montos', 'montosTotales', 'mes', 'anno', 'aeropuerto', 'nombresImprimibles', 'meses', 'annos', 'aeropuertos'));
    }

    public function getReporteMensual(Request $request){
        $mes           =$request->get('mes', \Carbon\Carbon::now()->month);
        $anno          =$request->get('anno',  \Carbon\Carbon::now()->year);
        $aeropuerto    =$request->get('aeropuerto',  0);
        $modulos       =\App\Modulo::where('aeropuerto_id', session('aeropuerto')->id )->get();
        $montos        =[];
        $montosTotales =[];
        $primerDiaMes  =\Carbon\Carbon::create($anno, $mes,1)->startOfMonth();
        $ultimoDiaMes  =\Carbon\Carbon::create($anno, $mes,1)->endOfMonth();

        for(;$primerDiaMes<=$ultimoDiaMes; $primerDiaMes->addDay()){
            $montos[$primerDiaMes->format('d/m/Y')]=[];
            foreach($modulos as $modulo) {
                if ($modulo->isActivo == 1) {
                    if (!isset($montos[$primerDiaMes->format('d/m/Y')][$modulo->nombre]))
                        $montos[$primerDiaMes->format('d/m/Y')][$modulo->nombre] = [];
                    $montos[$primerDiaMes->format('d/m/Y')][$modulo->nombre]["total"] = \DB::table('facturas')
                        ->join('facturadetalles', 'facturas.nFactura', '=', 'facturadetalles.factura_id')
                        ->join('conceptos', 'conceptos.id', '=', 'facturadetalles.concepto_id')
                        ->where('conceptos.modulo_id', "=", $modulo->id)
                        ->where('facturas.fecha', $primerDiaMes)
                        ->where('facturas.aeropuerto_id', ($aeropuerto == 0) ? ">" : "=", $aeropuerto)
                        ->where('facturas.deleted_at', null)
                        ->sum('facturas.total');
                    foreach ($modulo->conceptos as $concepto) {
                        $montos[$primerDiaMes->format('d/m/Y')][$modulo->nombre][$concepto->nompre] = \DB::table('facturadetalles')
                            ->join('facturas', 'facturas.nFactura', '=', 'facturadetalles.factura_id')
                            ->join('conceptos', 'conceptos.id', '=', 'facturadetalles.concepto_id')
                            ->where('conceptos.modulo_id', "=", $modulo->id)
                            ->where('facturadetalles.concepto_id', $concepto->id)
                            ->where('facturas.fecha', $primerDiaMes)
                            ->where('facturas.aeropuerto_id', ($aeropuerto == 0) ? ">" : "=", $aeropuerto)
                            ->where('facturas.deleted_at', null)
                            ->pluck('facturadetalles.totalDes');
                    }
                    if (!isset($montosTotales[$modulo->nombre]))
                        $montosTotales[$modulo->nombre] = [];
                    if (!isset($montosTotales[$modulo->nombre]["total"]))
                        $montosTotales[$modulo->nombre]["total"] = 0;
                    $montosTotales[$modulo->nombre]["total"] += ($montos[$primerDiaMes->format('d/m/Y')][$modulo->nombre]["total"]);
                    foreach ($modulo->conceptos as $concepto) {
                        if (!isset($montosTotales[$modulo->nombre][$concepto->nompre]))
                            $montosTotales[$modulo->nombre][$concepto->nompre] = 0;
                        $montosTotales[$modulo->nombre][$concepto->nompre] += ($montos[$primerDiaMes->format('d/m/Y')][$modulo->nombre][$concepto->nompre]);
                    }
                }
            }
        }

        return view('reportes.reporteDiario', compact('modulos', 'montos', 'montosTotales', 'mes', 'anno', 'aeropuerto'));
    }


    //Control de Recaudacíón Mensual
    public function getControlDeRecaudacionMensual(Request $request){
        $anno          =$request->get('anno',  \Carbon\Carbon::now()->year);
        $aeropuerto    =$request->get('aeropuerto',  session('aeropuerto')->id);
        $montos        =[];
        $montosTotales =[];
        $modulos       =Modulo::where('aeropuerto_id', $aeropuerto)->where('isActivo',1)->get();
        $ajustesMesTotal = 0;
        $saldoMesTotal = 0;
        $meses=[
            1  =>"ENERO",
            2  =>"FEBRERO",
            3  =>"MARZO",
            4  =>"ABRIL",
            5  =>"MAYO",
            6  =>"JUNIO",
            7  =>"JULIO",
            8  =>"AGOSTO",
            9  =>"SEPTIEMBRE",
            10 =>"OCTUBRE",
            11 =>"NOVIEMBRE",
            12 =>"DICIEMBRE"
        ];


        for($i=1;$i<=12; $i++)
        {
                $diaMes=\Carbon\Carbon::create($anno, $i,1);
                $estacionamientos = 0;
                $tasas = 0;
                $tasasNacSCV = 0;
                $tasasIntSCV = 0;
                $tasasNacMod = 0;
                $tasasIntMod = 0;


                foreach ($modulos as $modulo) 
	            {
	                $montos[$meses[$diaMes->month]][$modulo->nombre]["total"] = DB::table('cobros')->where('modulo_id', $modulo->id)
	                         ->where('fecha', '>=', $diaMes->startOfMonth()->toDateTimeString())
                            ->where('fecha', '<=', $diaMes->endOfMonth()->toDateTimeString())
	                        ->sum('montodepositado');
	                //$mconceptos = $modulo->conceptos()->
	                switch ($modulo->nombre) 
	                {
	                    case 'CANON':
	                    case 'DOSAS':
	                    case 'TARJETAS DE IDENTIFICACION':
	                    case 'OTROS INGRESOS NO AERONÁUTICOS':
	                    case 'PUBLICIDAD':
	                        $Mconceptos = $modulo->conceptos()->orderBy('orden')->get();
	                        foreach ($Mconceptos as $concepto) 
	                        {
	                            if($concepto->nombreImprimible != 'CANON')
	                                $nombresImprimibles[$modulo->nombre][$concepto->nombreImprimible] = 0;

	                            $idsConceptos = DB::table('conceptos')->where('nombreImprimible', $concepto->nombreImprimible)->lists('id');

	                            $montos[$meses[$diaMes->month]][$modulo->nombre][$concepto->nombreImprimible] = \App\Cobro::join('cobro_factura', 'cobro_factura.cobro_id', '=', 'cobros.id')
                                ->join('facturas', 'facturas.id', '=', 'cobro_factura.factura_id')
                                ->join('facturadetalles', 'facturadetalles.factura_id', '=', 'facturas.id')
                                ->where('cobros.aeropuerto_id', $aeropuerto)
                                ->where('cobros.fecha', '>=', $diaMes->startOfMonth()->toDateTimeString())
                                ->where('cobros.fecha', '<=', $diaMes->endOfMonth()->toDateTimeString())
                                ->whereIn('facturadetalles.concepto_id', $idsConceptos)
                                ->sum('facturadetalles.totalDes');
             
	                        }
	                        break;
	                    case 'TASAS':

	                        $tasas = \App\TasaCobroDetalle::join('tasa_cobros', 'tasa_cobros.id', '=', 'tasa_cobro_detalles.tasa_cobro_id')
	                            ->where('tasa_cobro_detalles.fecha', '>=', $diaMes->startOfMonth()->toDateTimeString())
                                ->where('tasa_cobro_detalles.fecha', '<=', $diaMes->endOfMonth()->toDateTimeString())
	                            ->where('tasa_cobros.aeropuerto_id', $aeropuerto)
	                            ->sum('tasa_cobro_detalles.monto');

	                        $Mconceptos = $modulo->conceptos()->orderBy('orden')->get();
	                        foreach ($Mconceptos as $concepto) 
	                        {
	                            $nombresImprimibles[$modulo->nombre][$concepto->nombreImprimible] = 0;

	                            $tasasInternacionales = \App\Tasa::join('tasaopdetalles', 'tasaopdetalles.serie', '=', 'tasas.nombre')
	                                ->join('tasaops', 'tasaops.id', '=', 'tasaopdetalles.tasaop_id')
	                                ->where('tasaops.aeropuerto_id', $aeropuerto)
	                                ->where('tasas.internacional', 1)
	                                ->lists('tasas.nombre');

	                            $tasasNacionales = \App\Tasa::join('tasaopdetalles', 'tasaopdetalles.serie', '=', 'tasas.nombre')
	                                ->join('tasaops', 'tasaops.id', '=', 'tasaopdetalles.tasaop_id')
	                                ->where('tasaops.aeropuerto_id', $aeropuerto)
	                                ->where('tasas.internacional', 0)
	                                ->lists('tasas.nombre');

	                            if ($concepto->nompre == 'TASAS INTERNACIONALES MODULO') {
	                                $tasasIntMod = \App\TasaCobro::select('tasaops.id')->join('tasaops', 'tasaops.tasa_cobro_id', '=', 'tasa_cobros.id')
	                                    ->where('tasaops.fecha', '>=', $diaMes->startOfMonth()->toDateTimeString())
                                        ->where('tasaops.fecha', '<=', $diaMes->endOfMonth()->toDateTimeString())
	                                    ->where('tasaops.aeropuerto_id', $aeropuerto)
	                                    ->where('tasaops.consolidado', 1)
	                                    ->where('tasa_cobros.cv', 0)
	                                    ->lists('tasaops.id');


	                                $montos[$meses[$diaMes->month]][$modulo->nombre][$concepto->nombreImprimible] = \App\Tasaop::join('tasaopdetalles', 'tasaops.id', '=', 'tasaopdetalles.tasaop_id')
	                                    ->whereIn('tasaops.id', $tasasIntMod)
	                                    ->whereIn('tasaopdetalles.serie', $tasasInternacionales)
	                                    ->sum('tasaopdetalles.total');

	                                $montos[$meses[$diaMes->month]][$modulo->nombre]["total"] += $montos[$meses[$diaMes->month]][$modulo->nombre][$concepto->nombreImprimible];


	                            } elseif ($concepto->nompre == 'TASAS NACIONALES MODULO') {
	                                $tasasNacMod = \App\TasaCobro::select('tasaops.id')->join('tasaops', 'tasaops.tasa_cobro_id', '=', 'tasa_cobros.id')
	                                    ->where('tasaops.fecha', '>=', $diaMes->startOfMonth()->toDateTimeString())
                                        ->where('tasaops.fecha', '<=', $diaMes->endOfMonth()->toDateTimeString())
	                                    ->where('tasaops.aeropuerto_id', $aeropuerto)
	                                    ->where('tasaops.consolidado', 1)
	                                    ->where('tasa_cobros.cv', 0)
	                                    ->lists('tasaops.id');


	                                $montos[$meses[$diaMes->month]][$modulo->nombre][$concepto->nombreImprimible] = \App\Tasaop::join('tasaopdetalles', 'tasaops.id', '=', 'tasaopdetalles.tasaop_id')
	                                    ->whereIn('tasaops.id', $tasasNacMod)
	                                    ->whereIn('tasaopdetalles.serie', $tasasNacionales)
	                                    ->sum('tasaopdetalles.total');


	                                $montos[$meses[$diaMes->month]][$modulo->nombre]["total"] += $montos[$meses[$diaMes->month]][$modulo->nombre][$concepto->nombreImprimible];


	                            } elseif ($concepto->nompre == 'TASAS INTERNACIONALES SCV') {


	                                $tasasIntSCV = \App\TasaCobro::select('tasaops.id')->join('tasaops', 'tasaops.tasa_cobro_id', '=', 'tasa_cobros.id')
	                                    ->where('tasaops.fecha', '>=', $diaMes->startOfMonth()->toDateTimeString())
                                        ->where('tasaops.fecha', '<=', $diaMes->endOfMonth()->toDateTimeString())
	                                    ->where('tasaops.aeropuerto_id', $aeropuerto)
	                                    ->where('tasaops.consolidado', 1)
	                                    ->where('tasa_cobros.cv', 1)
	                                    ->lists('tasaops.id');


	                                $montos[$meses[$diaMes->month]][$modulo->nombre][$concepto->nombreImprimible] = \App\Tasaop::join('tasaopdetalles', 'tasaops.id', '=', 'tasaopdetalles.tasaop_id')
	                                    ->whereIn('tasaops.id', $tasasIntSCV)
	                                    ->whereIn('tasaopdetalles.serie', $tasasInternacionales)
	                                    ->sum('tasaopdetalles.total');


	                                $montos[$meses[$diaMes->month]][$modulo->nombre]["total"] += $montos[$meses[$diaMes->month]][$modulo->nombre][$concepto->nombreImprimible];

	                            } elseif ($concepto->nompre == 'TASAS NACIONALES SCV') {

	                                $tasasNacSCV = \App\TasaCobro::select('tasaops.id')->join('tasaops', 'tasaops.tasa_cobro_id', '=', 'tasa_cobros.id')
	                                    ->where('tasaops.fecha', '>=', $diaMes->startOfMonth()->toDateTimeString())
                                        ->where('tasaops.fecha', '<=', $diaMes->endOfMonth()->toDateTimeString())
	                                    ->where('tasaops.aeropuerto_id', $aeropuerto)
	                                    ->where('tasaops.consolidado', 1)
	                                    ->where('tasa_cobros.cv', 1)
	                                    ->lists('tasaops.id');


	                                $montos[$meses[$diaMes->month]][$modulo->nombre][$concepto->nombreImprimible] = \App\Tasaop::join('tasaopdetalles', 'tasaops.id', '=', 'tasaopdetalles.tasaop_id')
	                                    ->whereIn('tasaops.id', $tasasNacSCV)
	                                    ->whereIn('tasaopdetalles.serie', $tasasNacionales)
	                                    ->sum('tasaopdetalles.total');


	                                $montos[$meses[$diaMes->month]][$modulo->nombre]["total"] += $montos[$meses[$diaMes->month]][$modulo->nombre][$concepto->nombreImprimible];

	                            }
	                        }

	                        if (!isset($montosTasas[$meses[$diaMes->month]]["totalMes"]))
	                                $montosTasas[$meses[$diaMes->month]]["totalMes"] = 0;
	                        $montosTasas[$meses[$diaMes->month]]["totalMes"] += $montos[$meses[$diaMes->month]][$modulo->nombre]["total"];
	                        $montosTotalesMeses[$meses[$diaMes->month]]["totalMes"] += $montosTasas[$meses[$diaMes->month]]["totalMes"];
	                        break;
	                    default:
	                        # code...
	                        break;
	                }

	                if (!isset($montosTotalesMeses[$meses[$diaMes->month]]["totalMes"]))
                            $montosTotalesMeses[$meses[$diaMes->month]]["totalMes"] = 0;
                        $montosTotalesMeses[$meses[$diaMes->month]]["totalMes"] += ($montos[$meses[$diaMes->month]][$modulo->nombre]["total"]);

                    if (!isset($montosTotales[$modulo->nombre]))
                    $montosTotales[$modulo->nombre] = [];

                	if (!isset($montosTotales[$modulo->nombre]["total"]))
                    $montosTotales[$modulo->nombre]["total"] = 0;

                	$montosTotales[$modulo->nombre]["total"] += ($montos[$meses[$diaMes->month]][$modulo->nombre]["total"]);

	                $nombresDistintos = $modulo->conceptos()->orderBy('orden')->groupby('nombreImprimible')->distinct('nombreImprimible')->get();

	                foreach ($nombresDistintos as $concepto) {
	                   	
	                    if (!isset($montosTotales[$modulo->nombre][$concepto->nombreImprimible]))
	                        $montosTotales[$modulo->nombre][$concepto->nombreImprimible] = 0;

	                    $montosTotales[$modulo->nombre][$concepto->nombreImprimible] += ($montos[$meses[$diaMes->month]][$modulo->nombre][$concepto->nombreImprimible]);

	                }
	            
	        }


                $ajustesMes[$meses[$diaMes->month]] = \App\Ajuste::join('cobros','cobros.id','=','cobro_id')
                    ->where('ajustes.aeropuerto_id','=', $aeropuerto)
                    ->where('fecha', '>=', $diaMes->startOfMonth()->toDateTimeString())
                    ->where('fecha', '<=', $diaMes->endOfMonth()->toDateTimeString())
                    //->whereBetween('fecha', [$diaMes->startOfMonth()->toDateTimeString(),$diaMes->endOfMonth()->toDateTimeString()])
                    ->where('monto','<=',0)
                    ->sum('monto');

                $saldoMes[$meses[$diaMes->month]] = \App\Ajuste::join('cobros','cobros.id','=','cobro_id')
                    ->where('ajustes.aeropuerto_id','=', $aeropuerto)
                    ->where('fecha', '>=', $diaMes->startOfMonth()->toDateTimeString())
                    ->where('fecha', '<=', $diaMes->endOfMonth()->toDateTimeString())
                    //->whereBetween('fecha', [$diaMes->startOfMonth()->toDateTimeString(),$diaMes->endOfMonth()->toDateTimeString()])
                    ->where('monto','>=',0)
                    ->sum('monto');

                $saldoMesTotal += $saldoMes[$meses[$diaMes->month]];

                $montosTotalesMeses[$meses[$diaMes->month]]["totalMes"] += $ajustesMes[$meses[$diaMes->month]];
                $ajustesMes[$meses[$diaMes->month]] = $ajustesMes[$meses[$diaMes->month]] * -1;
            $ajustesMesTotal += $ajustesMes[$meses[$diaMes->month]];

        }
        $aeropuertoNombre=\App\Aeropuerto::find($aeropuerto)->nombre;

        return view('reportes.reporteControlDeRecaudacionMensual', compact('aeropuertoNombre', 'modulos', 'montos', 'montosTotales', 'mes', 'anno', 'aeropuerto', 'montosTotalesMeses','saldoMes','ajustesMes','ajustesMesTotal','saldoMesTotal','nombresImprimibles'));
    }

    //Control de Recaudacíón Diario
	public function getControlDeRecaudacionDiario(Request $request){
        $mes           =$request->get('mes', Carbon::now()->month);
        $anno          =$request->get('anno',  Carbon::now()->year);
        $aeropuerto    =$request->get('aeropuerto',  session('aeropuerto')->id);
        $montos        =[];
        $montosTotales =[];
        $modulos       =Modulo::where('aeropuerto_id', $aeropuerto)->where('isActivo',1)->get();
        $primerDiaMes  =Carbon::create($anno, $mes,1)->startOfMonth();
        $ultimoDiaMes  =Carbon::create($anno, $mes,1)->endOfMonth();

        $ajustesMes = \App\Ajuste::join('cobros','cobros.id','=','cobro_id')
            ->where('ajustes.aeropuerto_id','=', $aeropuerto)
            ->where('fecha', '>=', Carbon::create($anno, $mes,1)->startOfMonth()->toDateTimeString())
            ->where('fecha', '<=', Carbon::create($anno, $mes,1)->endOfMonth()->toDateTimeString())
            ->where('monto','<=',0)
            ->sum('monto');

        $ajustesMes = $ajustesMes * -1;


        $saldoMes = \App\Ajuste::join('cobros','cobros.id','=','cobro_id')
            ->where('ajustes.aeropuerto_id','=', $aeropuerto)
            ->where('fecha', '>=', Carbon::create($anno, $mes,1)->startOfMonth())
            ->where('fecha', '<=', Carbon::create($anno, $mes,1)->endOfMonth())
            ->where('monto','>=',0)
            ->sum('monto');
        

        for(;$primerDiaMes<=$ultimoDiaMes; $primerDiaMes->addDay())
        {
            $ajustesDia[$primerDiaMes->format('d/m/Y')] = 0;
            $saldoDia[$primerDiaMes->format('d/m/Y')]   = 0;

            $ajustesDia[$primerDiaMes->format('d/m/Y')] = \App\Ajuste::join('cobros','cobros.id','=','cobro_id')
                ->where('ajustes.aeropuerto_id','=', $aeropuerto)
                ->where('fecha', '=', $primerDiaMes->toDateTimeString())
                ->where('monto','<=',0)
                ->sum('monto');

            $ajustesDia[$primerDiaMes->format('d/m/Y')] = $ajustesDia[$primerDiaMes->format('d/m/Y')] * -1;


            $saldoDia[$primerDiaMes->format('d/m/Y')] = \App\Ajuste::join('cobros','cobros.id','=','cobro_id')
                ->where('ajustes.aeropuerto_id','=', $aeropuerto)
                ->where('fecha', '=', $primerDiaMes->toDateTimeString())
                ->where('monto','>=',0)
                ->sum('monto');

            foreach ($modulos as $modulo) 
            {
                $montos[$primerDiaMes->format('d/m/Y')][$modulo->nombre]["total"] = DB::table('cobros')->where('modulo_id', $modulo->id)
                        ->where('fecha', 'like', $primerDiaMes->toDateString() . '%')
                        ->sum('montodepositado');
                //$mconceptos = $modulo->conceptos()->
                switch ($modulo->nombre) 
                {
                    case 'CANON':
                    case 'DOSAS':
                    case 'TARJETAS DE IDENTIFICACION':
                    case 'OTROS INGRESOS NO AERONÁUTICOS':
                    case 'PUBLICIDAD':

                        $Mconceptos = $modulo->conceptos()->orderBy('orden')->get();

                        foreach ($Mconceptos as $concepto) 
                        {
                            if($concepto->nombreImprimible != 'CANON')
                                $nombresImprimibles[$modulo->nombre][$concepto->nombreImprimible] = 0;

                            $idsConceptos = DB::table('conceptos')->where('nombreImprimible', $concepto->nombreImprimible)->lists('id');

                            switch ($concepto->condicionPago) {
                                case "Contado":
                                    $montos[$primerDiaMes->format('d/m/Y')][$modulo->nombre][$concepto->nombreImprimible] = DB::table('facturas')
                                        ->join('cobro_factura', 'cobro_factura.factura_id', '=', 'facturas.id')
                                        ->join('facturadetalles', 'facturadetalles.factura_id', '=', 'facturas.id')
                                        ->join('cobros', 'cobros.id', '=', 'cobro_factura.cobro_id')
                                        ->where('facturas.aeropuerto_id', $aeropuerto)
                                        ->where('facturas.fecha', $primerDiaMes->toDateString())
                                        ->whereIn('facturadetalles.concepto_id', $idsConceptos)
                                        ->sum('facturadetalles.totalDes');

                                    break;
                                case "Ambas":
                                case "Crédito":
                                    $montos[$primerDiaMes->format('d/m/Y')][$modulo->nombre][$concepto->nombreImprimible] = DB::table('facturas')
                                            ->join('cobro_factura', 'cobro_factura.factura_id', '=', 'facturas.id')
                                            ->join('facturadetalles', 'facturadetalles.factura_id', '=', 'facturas.id')
                                            ->join('cobros', 'cobros.id', '=', 'cobro_factura.cobro_id')
                                            ->where('facturas.aeropuerto_id', $aeropuerto)
                                            ->where('cobros.fecha', $primerDiaMes->toDateString())
                                            ->whereIn('facturadetalles.concepto_id', $idsConceptos)
                                            ->sum('facturadetalles.totalDes');
                                    break;
                                case "Default":
                                    break;
                            }


                        }
                        break;
                    case 'TASAS':

                        $tasas = \App\TasaCobroDetalle::join('tasa_cobros', 'tasa_cobros.id', '=', 'tasa_cobro_detalles.tasa_cobro_id')
                            ->where('tasa_cobro_detalles.fecha', $primerDiaMes->toDateString())
                            ->where('tasa_cobros.aeropuerto_id', $aeropuerto)
                            ->sum('tasa_cobro_detalles.monto');

                        foreach ($modulo->conceptos as $concepto) 
                        {
                            $nombresImprimibles[$modulo->nombre][$concepto->nombreImprimible] = 0;
                            
                            $tasasInternacionales = \App\Tasa::join('tasaopdetalles', 'tasaopdetalles.serie', '=', 'tasas.nombre')
                                ->join('tasaops', 'tasaops.id', '=', 'tasaopdetalles.tasaop_id')
                                ->where('tasaops.aeropuerto_id', $aeropuerto)
                                ->where('tasas.internacional', 1)
                                ->lists('tasas.nombre');

                            $tasasNacionales = \App\Tasa::join('tasaopdetalles', 'tasaopdetalles.serie', '=', 'tasas.nombre')
                                ->join('tasaops', 'tasaops.id', '=', 'tasaopdetalles.tasaop_id')
                                ->where('tasaops.aeropuerto_id', $aeropuerto)
                                ->where('tasas.internacional', 0)
                                ->lists('tasas.nombre');

                            if ($concepto->nompre == 'TASAS INTERNACIONALES MODULO') {
                                $tasasIntMod = \App\TasaCobro::select('tasaops.id')->join('tasaops', 'tasaops.tasa_cobro_id', '=', 'tasa_cobros.id')
                                    ->where('tasaops.fecha', $primerDiaMes->toDateString())
                                    ->where('tasaops.aeropuerto_id', $aeropuerto)
                                    ->where('tasaops.consolidado', 1)
                                    ->where('tasa_cobros.cv', 0)
                                    ->lists('tasaops.id');


                                $montos[$primerDiaMes->format('d/m/Y')][$modulo->nombre][$concepto->nombreImprimible] = \App\Tasaop::join('tasaopdetalles', 'tasaops.id', '=', 'tasaopdetalles.tasaop_id')
                                    ->whereIn('tasaops.id', $tasasIntMod)
                                    ->whereIn('tasaopdetalles.serie', $tasasInternacionales)
                                    ->sum('tasaopdetalles.total');

                                $montos[$primerDiaMes->format('d/m/Y')][$modulo->nombre]["total"] += $montos[$primerDiaMes->format('d/m/Y')][$modulo->nombre][$concepto->nombreImprimible];


                            } elseif ($concepto->nompre == 'TASAS NACIONALES MODULO') {
                                $tasasNacMod = \App\TasaCobro::select('tasaops.id')->join('tasaops', 'tasaops.tasa_cobro_id', '=', 'tasa_cobros.id')
                                    ->where('tasaops.fecha', $primerDiaMes->toDateString())
                                    ->where('tasaops.aeropuerto_id', $aeropuerto)
                                    ->where('tasaops.consolidado', 1)
                                    ->where('tasa_cobros.cv', 0)
                                    ->lists('tasaops.id');


                                $montos[$primerDiaMes->format('d/m/Y')][$modulo->nombre][$concepto->nombreImprimible] = \App\Tasaop::join('tasaopdetalles', 'tasaops.id', '=', 'tasaopdetalles.tasaop_id')
                                    ->whereIn('tasaops.id', $tasasNacMod)
                                    ->whereIn('tasaopdetalles.serie', $tasasNacionales)
                                    ->sum('tasaopdetalles.total');


                                $montos[$primerDiaMes->format('d/m/Y')][$modulo->nombre]["total"] += $montos[$primerDiaMes->format('d/m/Y')][$modulo->nombre][$concepto->nombreImprimible];


                            } elseif ($concepto->nompre == 'TASAS INTERNACIONALES SCV') {
                                $tasasIntSCV = \App\TasaCobro::select('tasaops.id')->join('tasaops', 'tasaops.tasa_cobro_id', '=', 'tasa_cobros.id')
                                    ->where('tasaops.fecha', $primerDiaMes->toDateString())
                                    ->where('tasaops.aeropuerto_id', $aeropuerto)
                                    ->where('tasaops.consolidado', 1)
                                    ->where('tasa_cobros.cv', 1)
                                    ->lists('tasaops.id');


                                $montos[$primerDiaMes->format('d/m/Y')][$modulo->nombre][$concepto->nombreImprimible] = \App\Tasaop::join('tasaopdetalles', 'tasaops.id', '=', 'tasaopdetalles.tasaop_id')
                                    ->whereIn('tasaops.id', $tasasIntSCV)
                                    ->whereIn('tasaopdetalles.serie', $tasasInternacionales)
                                    ->sum('tasaopdetalles.total');


                                $montos[$primerDiaMes->format('d/m/Y')][$modulo->nombre]["total"] += $montos[$primerDiaMes->format('d/m/Y')][$modulo->nombre][$concepto->nombreImprimible];

             
                            } elseif ($concepto->nompre == 'TASAS NACIONALES SCV') {

                                $tasasNacSCV = \App\TasaCobro::select('tasaops.id')->join('tasaops', 'tasaops.tasa_cobro_id', '=', 'tasa_cobros.id')
                                    ->where('tasaops.fecha', $primerDiaMes->toDateString())
                                    ->where('tasaops.aeropuerto_id', $aeropuerto)
                                    ->where('tasaops.consolidado', 1)
                                    ->where('tasa_cobros.cv', 1)
                                    ->lists('tasaops.id');


                                $montos[$primerDiaMes->format('d/m/Y')][$modulo->nombre][$concepto->nombreImprimible] = \App\Tasaop::join('tasaopdetalles', 'tasaops.id', '=', 'tasaopdetalles.tasaop_id')
                                    ->whereIn('tasaops.id', $tasasNacSCV)
                                    ->whereIn('tasaopdetalles.serie', $tasasNacionales)
                                    ->sum('tasaopdetalles.total');


                                $montos[$primerDiaMes->format('d/m/Y')][$modulo->nombre]["total"] += $montos[$primerDiaMes->format('d/m/Y')][$modulo->nombre][$concepto->nombreImprimible];



                            }
                        }

                        if (!isset($montosTasas[$primerDiaMes->format('d/m/Y')]["totalMes"]))
                                $montosTasas[$primerDiaMes->format('d/m/Y')]["totalMes"] = 0;
                            $montosTasas[$primerDiaMes->format('d/m/Y')]["totalMes"] += $montos[$primerDiaMes->format('d/m/Y')][$modulo->nombre]["total"];
                            $montosTotalesMeses[$primerDiaMes->format('d/m/Y')]["totalMes"] += $montosTasas[$primerDiaMes->format('d/m/Y')]["totalMes"];
                        break;
                    default:
                        # code...
                        break;
                }

                if (!isset($montosTotalesMeses[$primerDiaMes->format('d/m/Y')]["totalMes"]))
                    $montosTotalesMeses[$primerDiaMes->format('d/m/Y')]["totalMes"] = 0;
                $montosTotalesMeses[$primerDiaMes->format('d/m/Y')]["totalMes"] += ($montos[$primerDiaMes->format('d/m/Y')][$modulo->nombre]["total"]);

                if (!isset($montosTotales[$modulo->nombre]))
                    $montosTotales[$modulo->nombre] = [];

                if (!isset($montosTotales[$modulo->nombre]["total"]))
                    $montosTotales[$modulo->nombre]["total"] = 0;

                $montosTotales[$modulo->nombre]["total"] += ($montos[$primerDiaMes->format('d/m/Y')][$modulo->nombre]["total"]);

                if (!isset($montosDias[$primerDiaMes->format('d/m/Y')]["total"]))
                    $montosDias[$primerDiaMes->format('d/m/Y')]["total"] = 0;

                $montosDias[$primerDiaMes->format('d/m/Y')]["total"] += $montos[$primerDiaMes->format('d/m/Y')][$modulo->nombre]["total"] ;
                Log::info($ajustesDia[$primerDiaMes->format('d/m/Y')]);

                $nombresDistintos = $modulo->conceptos()->orderBy('orden')->groupby('nombreImprimible')->distinct('nombreImprimible')->get();

                foreach ($nombresDistintos as $concepto) {
                   
                    if (!isset($montosTotales[$modulo->nombre][$concepto->nombreImprimible]))
                        $montosTotales[$modulo->nombre][$concepto->nombreImprimible] = 0;

                    $montosTotales[$modulo->nombre][$concepto->nombreImprimible] += ($montos[$primerDiaMes->format('d/m/Y')][$modulo->nombre][$concepto->nombreImprimible]);

                }

            }
            $montosDias[$primerDiaMes->format('d/m/Y')]["total"] -= $ajustesDia[$primerDiaMes->format('d/m/Y')];
        }

        $mes = (int)$mes;
        $meses=[
            1=>"ENERO",
            2=>"FEBRERO",
            3=>"MARZO",
            4=>"ABRIL",
            5=>"MAYO",
            6=>"JUNIO",
            7=>"JULIO",
            8=>"AGOSTO",
            9=>"SEPTIEMBRE",
            10=>"OCTUBRE",
            11=>"NOVIEMBRE",
            12=>"DICIEMBRE"];
        $mesLetras = $meses[$mes];
        $aeropuertoNombre=Aeropuerto::find($aeropuerto)->nombre;

     
        return view('reportes.reporteControlDeRecaudacionDiario', compact('montosDias', 'mesLetras', 'aeropuertoNombre','modulos', 'montos', 'montosTotales', 'mes', 'anno', 'aeropuerto','saldoDia','ajustesDia','ajustesMes','saldoMes', 'nombresImprimibles'));
    }


    public function getReporteModuloMetaMensual(Request $request){
        $mes          =$request->get('mes', \Carbon\Carbon::now()->month);
        $anno         =$request->get('anno',  \Carbon\Carbon::now()->year);
        $aeropuerto   =$request->get('aeropuerto',  0);
        $primerDiaMes =\Carbon\Carbon::create($anno, $mes,1)->startOfMonth();
        $ultimoDiaMes =\Carbon\Carbon::create($anno, $mes,1)->endOfMonth();
        $modulos      =\App\Modulo::where('aeropuerto_id', session('aeropuerto')->id )->get();
        $montos       =[];



        foreach($modulos as $modulo) {
            if ($modulo->isActivo == 1) {
                $montos[$modulo->nombre] = \DB::table('facturas')
                    ->join('facturadetalles', 'facturas.nFactura', '=', 'facturadetalles.factura_id')
                    ->join('conceptos', 'conceptos.id', '=', 'facturadetalles.concepto_id')
                    ->where('conceptos.modulo_id', "=", $modulo->id)
                    ->where('facturas.fecha', '>=', $primerDiaMes)
                    ->where('facturas.fecha', '<=', $ultimoDiaMes)
                    ->where('facturas.aeropuerto_id', ($aeropuerto == 0) ? ">" : "=", $aeropuerto)
                    ->where('facturas.deleted_at', null)
                    ->sum('facturas.total');
            }
        }
        return view('reportes.reporteModuloMetaMensual', compact('montos', 'mes', 'anno', 'aeropuerto'));
    }

    //Reporte de Tráfico Aéreo
    public function getReporteTraficoAereo(Request $request){
        $diaDesde        =$request->get('diaDesde', \Carbon\Carbon::now()->day);
        $mesDesde        =$request->get('mesDesde', \Carbon\Carbon::now()->month);
        $annoDesde       =$request->get('annoDesde',  \Carbon\Carbon::now()->year);
        $diaHasta        =$request->get('diaHasta', \Carbon\Carbon::now()->day);
        $mesHasta        =$request->get('mesHasta', \Carbon\Carbon::now()->month);
        $annoHasta       =$request->get('annoHasta',  \Carbon\Carbon::now()->year);
        $destino         =$request->get('destino', 0);
        $procedencia     =$request->get('procedencia', 0);
        $cliente         =$request->get('cliente_id', 0);
        $aeropuerto      =session('aeropuerto');

        $procedenciaNombre =($procedencia==0)?'TODOS':\App\Puerto::find($procedencia)->nombre;
        $destinoNombre     =($destino==0)?'TODOS':\App\Puerto::find($destino)->nombre;

        if($cliente == 0){
            $clientes   = \App\Cliente::where('tipo', 'Mixto')
                                        ->OrWhere('tipo', 'Aeronáutico')
                                        ->orderBy('nombre')
                                        ->get();
        }else{
            $cliente_id = $cliente;
            $clientes   = \App\Cliente::where('id', $cliente_id)->orderBy('nombre')->get();
        }

        $datosCliente =[];

        foreach ($clientes as $index=>$cliente){

            $puertosNac = \App\Puerto::where('pais_id', '232')->lists('id');
            $puertosInt = \App\Puerto::where('pais_id', '<>', '232')->lists('id');


            $aterrizajesNac = \App\Aterrizaje::whereBetween('aterrizajes.fecha', array($annoDesde.'-'.$mesDesde.'-'.$diaDesde,  $annoHasta.'-'.$mesHasta.'-'.$diaHasta))
                                        ->join('despegues', 'despegues.aterrizaje_id', '=', 'aterrizajes.id')
                                        ->where('aterrizajes.cliente_id', $cliente->id)
                                        ->where('aterrizajes.aeropuerto_id', session('aeropuerto')->id)
                                        ->where('aterrizajes.puerto_id', ($procedencia==0)?'>=':'=', $procedencia)
                                        ->whereIn('aterrizajes.puerto_id', $puertosNac)
                                        ->get();


            $despeguesNac = \App\Despegue::whereBetween('fecha', array($annoDesde.'-'.$mesDesde.'-'.$diaDesde, $annoHasta.'-'.$mesHasta.'-'.$diaHasta))                                        ->where('cliente_id', $cliente->id)
                                        ->where('aeropuerto_id', session('aeropuerto')->id)
                                        ->where('puerto_id', ($destino==0)?'>=':'=', $destino)
                                        ->whereIn('puerto_id', $puertosNac)
                                        ->get();

            $aterrizajesInt = \App\Aterrizaje::whereBetween('aterrizajes.fecha', array($annoDesde.'-'.$mesDesde.'-'.$diaDesde,  $annoHasta.'-'.$mesHasta.'-'.$diaHasta))
                                         ->join('despegues', 'despegues.aterrizaje_id', '=', 'aterrizajes.id')
                                        ->where('aterrizajes.cliente_id', $cliente->id)
                                        ->where('aterrizajes.aeropuerto_id', session('aeropuerto')->id)
                                        ->where('aterrizajes.puerto_id', ($procedencia==0)?'>=':'=', $procedencia)
                                        ->whereIn('aterrizajes.puerto_id', $puertosInt)
                                        ->get();
            $despeguesInt = \App\Despegue::whereBetween('fecha', array($annoDesde.'-'.$mesDesde.'-'.$diaDesde,  $annoHasta.'-'.$mesHasta.'-'.$diaHasta))
                                        ->where('cliente_id', $cliente->id)
                                        ->where('aeropuerto_id', session('aeropuerto')->id)
                                        ->where('puerto_id', ($destino==0)?'>=':'=', $destino)
                                        ->whereIn('puerto_id', $puertosInt)
                                        ->get();

            if ($aterrizajesNac->count() != 0 || $aterrizajesInt->count() != 0 || $despeguesNac->count() != 0 || $despeguesInt->count()!= 0){
                $datosCliente[$cliente->nombre]=[
                    'desAdulNac'      => 0,
                    'desInfNac'       => 0,
                    'desTercNac'      => 0,

                    'EmbAdulNac'      => 0,
                    'EmbInfNac'       => 0,
                    'EmbTercNac'      => 0,
                    'TranAdulNac'     => 0,
                    'TranInfNac'      => 0,
                    'TranTercNac'     => 0,
                    'cargaEmbNac'     => 0,
                    'cargaDesNac'     => 0,
                    'aeroAterrizaNac' => 0,
                    'aeroDespegueNac' => 0,

                    'desAdulInt'      => 0,
                    'desInfInt'       => 0,
                    'desTercInt'      => 0,

                    'EmbAdulInt'      => 0,
                    'EmbInfInt'       => 0,
                    'EmbTercInt'      => 0,
                    'TranAdulInt'     => 0,
                    'TranInfInt'      => 0,
                    'TranTercInt'     => 0,
                    'cargaEmbInt'     => 0,
                    'cargaDesInt'     => 0,
                    'aeroAterrizaInt' => 0,
                    'aeroDespegueInt' => 0,
                ];

                if ($aterrizajesNac->count() != 0 || $aterrizajesInt->count() != 0){
                    $datosCliente[$cliente->nombre]['aeroAterrizaNac'] = $aterrizajesNac->count();
                    $datosCliente[$cliente->nombre]['aeroAterrizaInt'] = $aterrizajesInt->count();
                    foreach ($aterrizajesNac as $aterrizajeNac) {
                            $datosCliente[$cliente->nombre]['desAdulNac'] += $aterrizajeNac->desembarqueAdultos;
                            $datosCliente[$cliente->nombre]['desInfNac']  += $aterrizajeNac->desembarqueInfante;
                            $datosCliente[$cliente->nombre]['desTercNac'] += $aterrizajeNac->desembarqueTercera;
                    }
                    foreach ($aterrizajesInt as $aterrizajeInt) {
                            $datosCliente[$cliente->nombre]['desAdulInt'] += $aterrizajeInt->desembarqueAdultos;
                            $datosCliente[$cliente->nombre]['desInfInt']  += $aterrizajeInt->desembarqueInfante;
                            $datosCliente[$cliente->nombre]['desTercInt'] += $aterrizajeInt->desembarqueTercera;
                    }
                }
                if ($despeguesNac->count() != 0 || $despeguesInt->count() != 0){
                    $datosCliente[$cliente->nombre]['aeroDespegueNac'] = $despeguesNac->count();
                    $datosCliente[$cliente->nombre]['aeroDespegueInt'] = $despeguesInt->count();
                    foreach ($despeguesNac as $despegueNac) {
                            $datosCliente[$cliente->nombre]['EmbAdulNac']  += $despegueNac->embarqueAdultos;
                            $datosCliente[$cliente->nombre]['EmbInfNac']   += $despegueNac->embarqueInfantes;
                            $datosCliente[$cliente->nombre]['EmbTercNac']  += $despegueNac->embarqueTercera;
                            $datosCliente[$cliente->nombre]['TranAdulNac'] += $despegueNac->transitoAdultos;
                            $datosCliente[$cliente->nombre]['TranInfNac']  += $despegueNac->transitoInfantes;
                            $datosCliente[$cliente->nombre]['TranTercNac'] += $despegueNac->transitoTercera;
                            $datosCliente[$cliente->nombre]['cargaEmbNac'] += $despegueNac->peso_embarcado;
                            $datosCliente[$cliente->nombre]['cargaDesNac'] += $despegueNac->peso_desembarcado;
                    }
                    foreach ($despeguesInt as $despegueInt) {
                            $datosCliente[$cliente->nombre]['EmbAdulInt']  += $despegueInt->embarqueAdultos;
                            $datosCliente[$cliente->nombre]['EmbInfInt']   += $despegueInt->embarqueInfantes;
                            $datosCliente[$cliente->nombre]['EmbTercInt']  += $despegueInt->embarqueTercera;
                            $datosCliente[$cliente->nombre]['TranAdulInt'] += $despegueInt->transitoAdultos;
                            $datosCliente[$cliente->nombre]['TranInfInt']  += $despegueInt->transitoInfantes;
                            $datosCliente[$cliente->nombre]['TranTercInt'] += $despegueInt->transitoTercera;
                            $datosCliente[$cliente->nombre]['cargaEmbInt'] += $despegueInt->peso_embarcado;
                            $datosCliente[$cliente->nombre]['cargaDesInt'] += $despegueInt->peso_desembarcado;
                    }
                }
            }
        }

        return view('reportes.reporteTraficoAereo', compact('datosCliente', 'cliente', 'procedenciaNombre', 'destinoNombre', 'aeropuerto','procedencia', 'destino', 'clientes',  'diaDesde', 'mesDesde', 'annoDesde', 'diaHasta', 'mesHasta', 'annoHasta'));
    }

    //Relación de Ingreso Mensual
    public function getReporteRelacionIngresoMensual(Request $request){
        $anno        =$request->get('anno',  \Carbon\Carbon::now()->year);
        $aeropuerto  =$request->get('aeropuerto',  0);
        $montosMeses =[];

        $metas = Meta::where('anno', $anno)->lists('gobernacion_meta','mes');

        $meses=[
            1  =>"ENERO",
            2  =>"FEBRERO",
            3  =>"MARZO",
            4  =>"ABRIL",
            5  =>"MAYO",
            6  =>"JUNIO",
            7  =>"JULIO",
            8  =>"AGOSTO",
            9  =>"SEPTIEMBRE",
            10 =>"OCTUBRE",
            11 =>"NOVIEMBRE",
            12 =>"DICIEMBRE"
        ];
        for($i=1;$i<=12; $i++){
                $diaMes=\Carbon\Carbon::create($anno, $i,1);


                $pzo = \App\TasaCobro::select('tasaops.id')->join('tasaops', 'tasaops.tasa_cobro_id', '=', 'tasa_cobros.id')
                                            ->where('tasaops.fecha', '>=', $diaMes->startOfMonth()->toDateString())
                                            ->where('tasaops.fecha', '<=', $diaMes->endOfMonth()->toDateString())
                                            ->where('tasaops.aeropuerto_id', '1')
                                            ->where('tasaops.consolidado', 1)
                                            ->lists('tasaops.id');

                $tasasPZO = \App\Tasaop::join('tasaopdetalles', 'tasaops.id', '=', 'tasaopdetalles.tasaop_id')
                                            ->whereIn('tasaops.id', $pzo)
                                            ->sum('tasaopdetalles.total');

                $cbl = \App\TasaCobro::select('tasaops.id')->join('tasaops', 'tasaops.tasa_cobro_id', '=', 'tasa_cobros.id')
                                            ->where('tasaops.fecha', '>=', $diaMes->startOfMonth()->toDateString())
                                            ->where('tasaops.fecha', '<=', $diaMes->endOfMonth()->toDateString())
                                            ->where('tasaops.aeropuerto_id', '2')
                                            ->where('tasaops.consolidado', 1)
                                            ->lists('tasaops.id');

                $tasasCBL = \App\Tasaop::join('tasaopdetalles', 'tasaops.id', '=', 'tasaopdetalles.tasaop_id')
                                            ->whereIn('tasaops.id', $cbl)
                                            ->sum('tasaopdetalles.total');

                $snv = \App\TasaCobro::select('tasaops.id')->join('tasaops', 'tasaops.tasa_cobro_id', '=', 'tasa_cobros.id')
                                            ->where('tasaops.fecha', '>=', $diaMes->startOfMonth()->toDateString())
                                            ->where('tasaops.fecha', '<=', $diaMes->endOfMonth()->toDateString())
                                            ->where('tasaops.aeropuerto_id', '2')
                                            ->where('tasaops.consolidado', 1)
                                            ->lists('tasaops.id');

                $tasasSNV = \App\Tasaop::join('tasaopdetalles', 'tasaops.id', '=', 'tasaopdetalles.tasaop_id')
                                            ->whereIn('tasaops.id', $snv)
                                            ->sum('tasaopdetalles.total');


                $cobrosPZO=\App\Cobro::select('montodepositado')
                ->where('cobros.fecha','>=' ,$diaMes->startOfMonth()->toDateString())
                ->where('cobros.fecha','<=' ,$diaMes->endOfMonth()->toDateString())
                ->where('cobros.aeropuerto_id','1')
                ->sum('cobros.montodepositado');

                $cobrosCBL=\App\Cobro::where('cobros.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
                ->where('cobros.fecha','<=' ,$diaMes->endOfMonth()->toDateString())
                ->where('cobros.aeropuerto_id','2')
                ->sum('cobros.montodepositado');

                $cobrosSNV=\App\Cobro::where('cobros.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
                ->where('cobros.fecha','<=' ,$diaMes->endOfMonth()->toDateString())
                ->where('cobros.aeropuerto_id','3')
                ->sum('cobros.montodepositado');

            $montosMeses[$meses[$diaMes->month]]=[
                    "cobradoPZO"   =>0,
                    "cobradoCBL"   =>0,
                    "cobradoSNV"   =>0,
                    "cobradoTotal" =>0
                ];

            $ajustesMesPZO = \App\Ajuste::join('cobros','cobros.id','=','cobro_id')
                ->where('ajustes.aeropuerto_id','=', 1)
                ->where('fecha', '>=', $diaMes->startOfMonth()->toDateTimeString())
                ->where('fecha', '<=', $diaMes->endOfMonth()->toDateTimeString())
                ->where('monto','<=',0)
                ->sum('monto');

            $ajustesMesCBL = \App\Ajuste::join('cobros','cobros.id','=','cobro_id')
                ->where('ajustes.aeropuerto_id','=', 2)
                ->where('fecha', '>=', $diaMes->startOfMonth()->toDateTimeString())
                ->where('fecha', '<=', $diaMes->endOfMonth()->toDateTimeString())
                ->where('monto','<=',0)
                ->sum('monto');

            $montosMeses[$meses[$diaMes->month]]["cobradoPZO"]+=$tasasPZO+$cobrosPZO+$ajustesMesPZO;
            $montosMeses[$meses[$diaMes->month]]["cobradoCBL"]+=$tasasCBL+$cobrosCBL+$ajustesMesCBL;
            $montosMeses[$meses[$diaMes->month]]["cobradoSNV"]+=$tasasSNV+$cobrosSNV;

            $montosMeses[$meses[$diaMes->month]]["cobradoTotal"]+=$montosMeses[$meses[$diaMes->month]]["cobradoPZO"]+$montosMeses[$meses[$diaMes->month]]["cobradoCBL"]+$montosMeses[$meses[$diaMes->month]]["cobradoSNV"];

        }



        $mesActual    =$meses[\Carbon\Carbon::now()->month];

        return view('reportes.reporteRelacionIngresoMensual', compact('montosMeses', 'anno', 'mesActual'));
    }

    //Reporte de Morosidad
    public function getReporteDeMorosidad(Request $request){

        $anno             = $request->get('anno',  \Carbon\Carbon::now()->year);
        $aeropuerto       = $request->get('aeropuerto', session('aeropuerto')->id);
        $aeropuertoNombre = Aeropuerto::find($aeropuerto)->nombre;

        $modulos       = \App\Modulo::where('aeropuerto_id', $aeropuerto)->lists('nombre', 'id');

        $clienteID     = $request->get('cliente_id');
        $totales       = [];
        $totalClientes = [];
        $totalMes      = [];
        $hoy           = Carbon::now();
        $today         = $hoy->toDateString();
        $primerDiaAno=\Carbon\Carbon::create($anno, 1,1);
        $ultimoDiaAno=\Carbon\Carbon::create($anno, 12, 31);




        if($clienteID == ''){
            $cliente = \App\Cliente::join('facturas','facturas.cliente_id' , '=', 'clientes.id')
                                    ->where('facturas.aeropuerto_id','=', session('aeropuerto')->id)
                                    ->where('facturas.estado','P')
                                    ->orderBy('clientes.nombre')
                                    ->groupBy("clientes.id")->get();

            $nombreCliente = 'TODOS';
        }else{
            $cliente = Cliente::find($clienteID);
            $nombreCliente = $cliente->nombre;
        }



        foreach ($modulos as $idModulo => $modulo) {
                $f = DB::table('facturas')
                    ->join('clientes', 'facturas.cliente_id', '=', 'clientes.id')
                    ->where('facturas.deleted_at', null)
                    ->where('facturas.fecha', '>=', $primerDiaAno->toDateTimeString())
                    ->where('facturas.fecha', '<=', $ultimoDiaAno->toDateTimeString())
                    ->where('facturas.fechaVencimiento', '<', $ultimoDiaAno->toDateTimeString())
                    ->where('aeropuerto_id', $aeropuerto)
                    ->where('modulo_id', $idModulo)
                    ->where('estado', 'P');


                if ($clienteID == '') {
                    $clientesMod[$modulo] = $f->groupBy('cliente_id')
                        ->lists('clientes.nombre');

                } else {
                    $clientesMod[$modulo] = $f->where('cliente_id', $clienteID)
                        ->groupBy('cliente_id')
                        ->lists('clientes.nombre');


                }


                $meses = [
                    1 => "ENERO",
                    2 => "FEBRERO",
                    3 => "MARZO",
                    4 => "ABRIL",
                    5 => "MAYO",
                    6 => "JUNIO",
                    7 => "JULIO",
                    8 => "AGOSTO",
                    9 => "SEPTIEMBRE",
                    10 => "OCTUBRE",
                    11 => "NOVIEMBRE",
                    12 => "DICIEMBRE"
                ];


                if ($clienteID == '') {
                    $clientes = Factura::join('clientes', 'facturas.cliente_id', '=', 'clientes.id')
                        ->where('aeropuerto_id', $aeropuerto)
                        ->where('estado', 'P')
                        ->where('modulo_id', $idModulo)
                        ->groupBy('cliente_id')
                        ->lists('cliente_id', 'clientes.nombre');
                } else {
                    $clientes = Cliente::where('id', $clienteID)->lists('id', 'nombre');
                }


                for ($i = 1; $i <= 12; $i++) {
                    $diaMes = \Carbon\Carbon::create($anno, $i, 1);
                    foreach ($clientes as $nombre => $cliente_id) {


                        $facturasPendientesModulo[$modulo][$diaMes->month][$nombre] = Factura::with('cliente')
                            ->where('fecha', '>=', $diaMes->startOfMonth()->toDateTimeString())
                            ->where('fecha', '<=', $diaMes->endOfMonth()->toDateTimeString())
                            ->where('fechaVencimiento', '<', $today)
                            ->where('estado', 'P')
                            ->where('cliente_id', $cliente_id)
                            ->where('modulo_id', $idModulo)
                            ->sum('total');

                        if (!isset($totalClientes[$modulo][$nombre]["total"]))
                            $totalClientes[$modulo][$nombre]["total"] = 0;
                        $totalClientes[$modulo][$nombre]["total"] += ($facturasPendientesModulo[$modulo][$diaMes->month][$nombre]);
                        if (!isset($ModTotales[$modulo]))
                            $ModTotales[$modulo] = 0;
                        $ModTotales[$modulo] += ($facturasPendientesModulo[$modulo][$diaMes->month][$nombre]);
                    }
                }


        }
        return view('reportes.reporteReporteDeMorosidad', compact('aeropuertoNombre', 'nombreCliente', 'anno', 'aeropuerto', 'cliente',  'clientesMod','totalClientes','ModTotales','totalMes', 'facturasPendientesModulo', 'meses', 'modulos', 'totales', 'totalesCliente', 'clienteFacturaMes'));
    }

    //Relación Mensual de Facturado, Cobrado y por Cobrar
    public function getReporteRelacionMensualDeFacturacionCobradosYPorCobrar(Request $request){
        $anno        =$request->get('anno',  \Carbon\Carbon::now()->year);
        $aeropuerto  =$request->get('aeropuerto',  session('aeropuerto')->id);
        $montosMeses =[];
        $meses=[
            1  =>"ENERO",
            2  =>"FEBRERO",
            3  =>"MARZO",
            4  =>"ABRIL",
            5  =>"MAYO",
            6  =>"JUNIO",
            7  =>"JULIO",
            8  =>"AGOSTO",
            9  =>"SEPTIEMBRE",
            10 =>"OCTUBRE",
            11 =>"NOVIEMBRE",
            12 =>"DICIEMBRE"
        ];
        for($i=1;$i<=12; $i++){


            $diaMes=\Carbon\Carbon::create($anno, $i,1);

            $tasas = \App\TasaCobro::select('tasaops.id')->join('tasaops', 'tasaops.tasa_cobro_id', '=', 'tasa_cobros.id')
                                        ->where('tasaops.fecha', '>=', $diaMes->startOfMonth()->toDateString())
                                        ->where('tasaops.fecha', '<=', $diaMes->endOfMonth()->toDateString())
                                        ->where('tasaops.aeropuerto_id', $aeropuerto)
                                        ->where('tasaops.consolidado', 1)
                                        ->lists('tasaops.id');

            $tasasMontos = \App\Tasaop::join('tasaopdetalles', 'tasaops.id', '=', 'tasaopdetalles.tasaop_id')
                                        ->whereIn('tasaops.id', $tasas)
                                        ->sum('tasaopdetalles.total');


            $tasasFacturadas = \App\Tasaop::join('tasaopdetalles', 'tasaops.id', '=', 'tasaopdetalles.tasaop_id')
                                        ->where('tasaops.fecha', '>=', $diaMes->startOfMonth()->toDateString())
                                        ->where('tasaops.fecha', '<=', $diaMes->endOfMonth()->toDateString())
                                        ->sum('tasaopdetalles.total');

            //Facturas por Cobrar
            $facturasPorCobrar=\App\Factura::where('facturas.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
            ->where('facturas.fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
            ->where('facturas.aeropuerto_id',$aeropuerto)
            ->where('estado', 'P')
            ->where('facturas.deleted_at', null)
            ->get();

            //Facturación
            $facturas=\App\Factura::where('facturas.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
            ->where('facturas.fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
            ->where('facturas.aeropuerto_id',$aeropuerto)
            ->where('facturas.deleted_at', null)
            ->get();

            //Facturas de otros meses
            $facturasAnteriores=\App\Factura::where('fecha', '<',$diaMes->startOfMonth()->toDateTimeString())
            ->where('estado', 'C')
            ->where('aeropuerto_id', $aeropuerto)
            ->lists('id', 'fecha');


            $cobrosFacturasAnteriores = \App\Factura::join('cobro_factura', 'cobro_factura.factura_id', '=', 'facturas.id')
                                                    ->whereIn('facturas.id', $facturasAnteriores)
                                                    ->lists('cobro_factura.cobro_id');

            $cobrosAnteriores = \App\Cobro::where('cobros.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
            ->where('cobros.fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
            ->whereIn('cobros.id', $cobrosFacturasAnteriores)
            ->get();

            $cobrosAnt = $cobrosAnteriores->lists('id');

            //Cobrado
            $cobros=\App\Cobro::where('cobros.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
            ->where('cobros.fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
            ->where('cobros.aeropuerto_id',$aeropuerto)
            ->whereNotIn('id', $cobrosAnt)
            ->get();

            $montosMeses[$meses[$diaMes->month]]=[
                    "facturado"       =>0,
                    "cobrado"         =>0,
                    "porCobrar"       =>0,
                    "cobroAnterior"   =>0,
                    "totalCobradoMes" =>0
                ];

            foreach ($facturas as $factura) {
                $montosMeses[$meses[$diaMes->month]]["facturado"]+=$factura->total;
            }
            foreach ($facturasPorCobrar as $facturaPorCobrar) {
                $montosMeses[$meses[$diaMes->month]]["porCobrar"]+=$facturaPorCobrar->total;
            }

            foreach ($cobros as $cobro) {
                $montosMeses[$meses[$diaMes->month]]["cobrado"]+=$cobro->montodepositado;
            }

            foreach ($cobrosAnteriores as $cobroAnterior) {
                $montosMeses[$meses[$diaMes->month]]["cobroAnterior"]+=$cobroAnterior->montodepositado;
            }


            $montosMeses[$meses[$diaMes->month]]["facturado"]=$montosMeses[$meses[$diaMes->month]]["facturado"]+$tasasFacturadas;

            $montosMeses[$meses[$diaMes->month]]["cobrado"]=$montosMeses[$meses[$diaMes->month]]["cobrado"]+$tasasMontos;

            $montosMeses[$meses[$diaMes->month]]["totalCobradoMes"]=$montosMeses[$meses[$diaMes->month]]["cobrado"]+$montosMeses[$meses[$diaMes->month]]["cobroAnterior"];
        }

        $aeropuertoNombre=\App\Aeropuerto::find($aeropuerto)->nombre;

        return view('reportes.reporteRelacionMensualDeFacturacionCobradosYPorCobrar', compact('montosMeses', 'anno', 'aeropuerto', 'aeropuertoNombre'));
    }

    //Relación de Estacionamiento Diario
    public function getReporteRelacionEstacionamientoDiario(Request $request){
        $mes        =$request->get('mes', \Carbon\Carbon::now()->month);
        $anno       =$request->get('anno',  \Carbon\Carbon::now()->year);
        $aeropuerto =$request->get('aeropuerto', session('aeropuerto')->id)+0;
        $estacionamientoDiario=[];
        $primerDiaMes=\Carbon\Carbon::create($anno, $mes,1)->startOfMonth();
        $ultimoDiaMes=\Carbon\Carbon::create($anno, $mes,1)->endOfMonth();
        for(;$primerDiaMes<=$ultimoDiaMes; $primerDiaMes->addDay()){

            $estacionamientoDiario[$primerDiaMes->format('d/m/Y')]=[
                "ticketEstacionamiento"      =>0,
                "baseTicketEstacionamiento"  =>0,
                "ivaTicketEstacionamiento"   =>0,
                "totalTicketEstacionamiento" =>0,
                "ticketPernocta"             =>0,
                "baseTicketPernocta"         =>0,
                "ivaTicketPernocta"          =>0,
                "totalTicketPernocta"        =>0,
                "ticketExtraviado"           =>0,
                "baseTicketExtraviado"       =>0,
                "ivaTicketExtraviado"        =>0,
                "totalTicketExtraviado"      =>0,
                "totalTicketExtraviado"      =>0,
                "totalTicketExtraviado"      =>0,
                "totalTicketExtraviado"      =>0,
                "baseTotal"                  =>0,
                "ivaTotal"                   =>0,
                "montoTotal"                 =>0,
                "deposito"                   =>0,
                "baseTarjetas"               =>0,
                "ivaTarjetas"                =>0,
                "totalTarjetas"              =>0
            ];

            $iva=\App\Concepto::where('nompre', 'ESTACIONAMIENTO DE VEHICULOS')->where('aeropuerto_id', $aeropuerto)->first()->iva;

            $estacionamientos=\App\Estacionamientoopticket::join('estacionamientoops', 'estacionamientooptickets.estacionamientoop_id', '=', 'estacionamientoops.id')
                                                        ->join('estacionamientoopticketsdepositos', 'estacionamientoops.id', '=', 'estacionamientoopticketsdepositos.estacionamientoop_id')
                                                        ->where('estacionamientoops.fecha' ,$primerDiaMes)
                                                        ->get();

            $estacionamientosTarjetas=\App\Estacionamientooptarjeta::where('estacionamientooptarjetas.fecha' ,$primerDiaMes)
                                                        ->get();

            foreach ($estacionamientos as $estacionamiento) {


                if($estacionamiento->econcepto_id=='8' || $estacionamiento->econcepto_id=='11'|| $estacionamiento->econcepto_id=='13'){
                    $estacionamientoDiario[$primerDiaMes->format('d/m/Y')]["ticketEstacionamiento"]      +=$estacionamiento->cantidad;
                    $estacionamientoDiario[$primerDiaMes->format('d/m/Y')]["ivaTicketEstacionamiento"]   +=($estacionamiento->monto)*$iva/100;
                    $estacionamientoDiario[$primerDiaMes->format('d/m/Y')]["totalTicketEstacionamiento"] +=$estacionamiento->monto;
                    $estacionamientoDiario[$primerDiaMes->format('d/m/Y')]["baseTicketEstacionamiento"]  =$estacionamientoDiario[$primerDiaMes->format('d/m/Y')]["totalTicketEstacionamiento"]-$estacionamientoDiario[$primerDiaMes->format('d/m/Y')]["ivaTicketEstacionamiento"];

                }
                if($estacionamiento->econcepto_id=='10'){
                    $estacionamientoDiario[$primerDiaMes->format('d/m/Y')]["ticketEstacionamiento"]      +=$estacionamiento->cantidad;
                    $estacionamientoDiario[$primerDiaMes->format('d/m/Y')]["ivaTicketEstacionamiento"]   +=($estacionamiento->monto)*$iva/100;
                    $estacionamientoDiario[$primerDiaMes->format('d/m/Y')]["totalTicketEstacionamiento"] +=$estacionamiento->monto;
                    $estacionamientoDiario[$primerDiaMes->format('d/m/Y')]["baseTicketEstacionamiento"]  =$estacionamientoDiario[$primerDiaMes->format('d/m/Y')]["totalTicketEstacionamiento"]-$estacionamientoDiario[$primerDiaMes->format('d/m/Y')]["ivaTicketEstacionamiento"];

                }
                if($estacionamiento->econcepto_id=='9'){
                    $estacionamientoDiario[$primerDiaMes->format('d/m/Y')]["ticketEstacionamiento"]      +=$estacionamiento->cantidad;
                    $estacionamientoDiario[$primerDiaMes->format('d/m/Y')]["ivaTicketEstacionamiento"]   +=($estacionamiento->monto)*$iva/100;
                    $estacionamientoDiario[$primerDiaMes->format('d/m/Y')]["totalTicketEstacionamiento"] +=$estacionamiento->monto;
                    $estacionamientoDiario[$primerDiaMes->format('d/m/Y')]["baseTicketEstacionamiento"]  =$estacionamientoDiario[$primerDiaMes->format('d/m/Y')]["totalTicketEstacionamiento"]-$estacionamientoDiario[$primerDiaMes->format('d/m/Y')]["ivaTicketEstacionamiento"];

                }

                $estacionamientoDiario[$primerDiaMes->format('d/m/Y')]["deposito"]   =$estacionamiento->deposito;
                $estacionamientoDiario[$primerDiaMes->format('d/m/Y')]["montoTotal"] =$estacionamiento->total;
                $estacionamientoDiario[$primerDiaMes->format('d/m/Y')]["ivaTotal"]   =($estacionamiento->total)*$iva/100;
                $estacionamientoDiario[$primerDiaMes->format('d/m/Y')]["baseTotal"]  =$estacionamientoDiario[$primerDiaMes->format('d/m/Y')]["montoTotal"]-$estacionamientoDiario[$primerDiaMes->format('d/m/Y')]["ivaTotal"];


            }

            foreach ($estacionamientosTarjetas as $tarjetas) {
                        $estacionamientoDiario[$primerDiaMes->format('d/m/Y')]["ivaTarjetas"]   +=($tarjetas->total)*$iva/100;
                        $estacionamientoDiario[$primerDiaMes->format('d/m/Y')]["totalTarjetas"] +=$tarjetas->total;
                        $estacionamientoDiario[$primerDiaMes->format('d/m/Y')]["baseTarjetas"]  =$estacionamientoDiario[$primerDiaMes->format('d/m/Y')]["totalTarjetas"]-$estacionamientoDiario[$primerDiaMes->format('d/m/Y')]["ivaTarjetas"];
            }

        }

        $aeropuertoNombre=\App\Aeropuerto::find($aeropuerto)->nombre;
        return view('reportes.reporteRelacionEstacionamientoDiario', compact('mes', 'mesNombre', 'anno', 'aeropuerto', 'aeropuertoNombre', 'estacionamientoDiario'));
    }

    //DES 900
    public function getReporteDES900(Request $request){
        $diaDesde      =$request->get('diaDesde', \Carbon\Carbon::now()->day);
        $mesDesde      =$request->get('mesDesde', \Carbon\Carbon::now()->month);
        $annoDesde     =$request->get('annoDesde',  \Carbon\Carbon::now()->year);
        $diaHasta      =$request->get('diaHasta', \Carbon\Carbon::now()->day);
        $mesHasta      =$request->get('mesHasta', \Carbon\Carbon::now()->month);
        $annoHasta     =$request->get('annoHasta',  \Carbon\Carbon::now()->year);
        $aeropuerto    =session('aeropuerto');
        $cliente       =$request->get('cliente_id', 0);
        $clienteNombre =($cliente==0)?'TODOS':(\App\Cliente::where('id', $cliente)->first()->nombre);

        $aterrizajes =\App\Aterrizaje::select('aterrizajes.id as aux')
                                    ->whereBetween('aterrizajes.fecha', array($annoDesde.'-'.$mesDesde.'-'.$diaDesde,  $annoHasta.'-'.$mesHasta.'-'.$diaHasta))
                                    ->join('despegues', 'despegues.aterrizaje_id', '=', 'aterrizajes.id')
                                    ->where('aterrizajes.aeropuerto_id', session('aeropuerto')->id)
                                    ->where('aterrizajes.cliente_id',($cliente==0)?">":"=", $cliente)
                                    ->lists('aux');

        $despegues   =\App\Despegue::with("factura", "aterrizaje")
                                ->where('aeropuerto_id', session('aeropuerto')->id)
                                ->where('despegues.cliente_id',($cliente==0)?">":"=", $cliente)
                                ->whereBetween('fecha', array($annoDesde.'-'.$mesDesde.'-'.$diaDesde,  $annoHasta.'-'.$mesHasta.'-'.$diaHasta) )
                                ->OrwhereIn('aterrizaje_id', $aterrizajes)
                                ->orderBy('fecha')
                                ->get();


        return view('reportes.reporteDES900', compact('diaDesde', 'mesDesde', 'annoDesde', 'diaHasta', 'mesHasta', 'annoHasta', 'aeropuerto', 'despegues', 'cliente'));
    }

    //Formularios Anulados
    public function getFormulariosAnulados(Request $request){
        $mes          =$request->get('mes', \Carbon\Carbon::now()->month);
        $anno         =$request->get('anno',  \Carbon\Carbon::now()->year);
        $primerDiaMes =\Carbon\Carbon::create($anno, $mes,1)->startOfMonth();
        $ultimoDiaMes =\Carbon\Carbon::create($anno, $mes,1)->endOfMonth();
        $aeropuerto   =$request->get('aeropuerto', session('aeropuerto')->id);
        $recibosAnulados = \App\RecibosAnulado::where('fecha', '>=', $primerDiaMes)
                                                ->where('fecha', '<=', $ultimoDiaMes)
                                                ->where('aeropuerto_id', $aeropuerto)
                                                ->get();
        $facturasAnuladas = \App\Factura::onlyTrashed()
                                        ->where('fecha', '>=', $primerDiaMes)
                                        ->where('fecha', '<=', $ultimoDiaMes)
                                        ->where('aeropuerto_id', $aeropuerto)
                                        ->get();




        $aeropuertoNombre=\App\Aeropuerto::find($aeropuerto)->nombre;

        return view('reportes.reporteFormulariosAnulados', compact('mes', 'mesLetras', 'anno', 'aeropuerto', 'recibosAnulados', 'facturasAnuladas'));
    }

    //Listado de Clientes
    public function getListadoClientes(Request $request){
        $tipo = $request->get('tipo');
        if($tipo == 'TODOS'){
            $clientes = \App\Cliente::all();
        }else{
            $clientes = \App\Cliente::where('tipo', $tipo)->get();
        }
        return view('reportes.reporteListadoClientes', compact('clientes', 'tipo'));
    }

    //Relacion de Ingresos Aeronáuticos de Contado
    public function getReporteRelacionIngresosAeronauticosContado(Request $request){
        $diaDesde   =$request->get('diaDesde', \Carbon\Carbon::now()->day);
        $mesDesde   =$request->get('mesDesde', \Carbon\Carbon::now()->month);
        $annoDesde  =$request->get('annoDesde',  \Carbon\Carbon::now()->year);
        $diaHasta   =$request->get('diaHasta', \Carbon\Carbon::now()->day);
        $mesHasta   =$request->get('mesHasta', \Carbon\Carbon::now()->month);
        $annoHasta  =$request->get('annoHasta',  \Carbon\Carbon::now()->year);
        $aeropuerto =$request->get('aeropuerto', session('aeropuerto')->id);
        $modulo_id  =\App\Modulo::where('nombre', 'DOSAS')
                                    ->where('aeropuerto_id', $aeropuerto)
                                    ->where('isactivo', 1)
                                    ->lists('id');
        $modulos       =Modulo::where('aeropuerto_id', $aeropuerto)->get();
        $formulario      =\App\Concepto::where('aeropuerto_id', $aeropuerto)->where('nompre', 'FORMULARIO DOSA')->first();
        $aterrizaje      =\App\Concepto::where('aeropuerto_id', $aeropuerto)->where('nompre', 'ATERRIZAJE Y DESPEGUE DE AERONAVES')->first();
        $estacionamiento =\App\Concepto::where('aeropuerto_id', $aeropuerto)->where('nompre', 'ESTACIONAMIENTO DE AERONAVES')->first();
        $habilitacion    =\App\Concepto::where('aeropuerto_id', $aeropuerto)->where('nompre', 'HABILITACION')->first();
        $jetway          =\App\Concepto::where('aeropuerto_id', $aeropuerto)->where('nompre', 'JETWAY')->first();
        $carga           =\App\Concepto::where('aeropuerto_id', $aeropuerto)->where('nompre', 'CARGA')->first();
        $otrosIngresos   =\App\Concepto::where('aeropuerto_id', $aeropuerto)->where('nombreImprimible', 'like', 'Otros Aero%')->where('condicionPago','Contado')->get();


        /*
        foreach ($modulos as $modulo){
            if ($modulo->isActivo == 1) {
                foreach ($modulo->conceptos as $conc) {
                    $otrosIngresos[$conc->id] = DB::table('conceptos')
                        ->join('otros_cargos', 'otros_cargos.conceptoContado_id', '=', 'conceptos.id')
                        ->where('conceptos.id', '=', $conc);
                }
            }
        }
        */


        $facturas = \App\Factura::with('detalles', 'cobros')
                             ->whereBetween('fecha', array($annoDesde.'-'.$mesDesde.'-'.$diaDesde,  $annoHasta.'-'.$mesHasta.'-'.$diaHasta))
                             ->where('modulo_id',$modulo_id)
                             ->where('aeropuerto_id', $aeropuerto)
                             ->where('condicionPago', 'Contado')
                             ->where('estado', 'C')
                             ->where('deleted_at', null)
                             ->where('nroDosa', '<>', 'NULL')
                             ->orderBy('fecha', 'ASC')
                             ->orderBy('nFactura', 'ASC')
                             ->get();
        $aeropuertoNombre = \App\Aeropuerto::where('id', $aeropuerto)->first()->nombre;
        $dosaFactura = [];
        $dosaFacturaManual = [];
        $dosaFacturaAnulada = [];

        // se tenia {{$traductor->format($df['otros'])}}   para otros pagos, no funciona

        foreach ($facturas as $factura) {

            $cobros = \App\Cobro::join('cobro_factura', 'cobros.id', '=', 'cobro_factura.cobro_id')
                                    ->where('cobro_factura.factura_id', $factura->id)
                                    ->where('aeropuerto_id', $aeropuerto)
                                    ->first();

            $dosaFactura[$factura->nroDosa]=[
                "nFactura"          =>'',
                "nControl"          =>'',
                "fecha"             =>0,
                "formulario"        =>0,
                "aterrizaje"        =>0,
                "estacionamiento"   =>0,
                "habilitacion"      =>0,
                "jetway"            =>0,
                "carga"             =>0,
                "otros"             =>0,
                "tasaNacional"      =>0,
                "tasaInternacional" =>0,
                "montoFacturado"    =>0,
                "montoDepositado"   =>0,
                "nroCobro"          =>0,
                "nroDeposito"       =>0
            ];

            foreach ($factura->cobros as $cobro) {
                $dosaFactura[$factura->nroDosa]["nroCobro"]        =$cobro->id;
            }
            $dosaFactura[$factura->nroDosa]["fecha"]           =$factura->fecha;
            $dosaFactura[$factura->nroDosa]["nFactura"]        =$factura->nFacturaPrefix.'-'.$factura->nFactura;
            $dosaFactura[$factura->nroDosa]["nControl"]        =$factura->nControlPrefix.'-'.$factura->nControl;
            $dosaFactura[$factura->nroDosa]["montoFacturado"]  =$cobros->montofacturas;
            $dosaFactura[$factura->nroDosa]["montoDepositado"] =$cobros->montodepositado;
            $dosaFactura[$factura->nroDosa]["nroDeposito"]     =$cobro->pagos()->lists('ncomprobante');
           
            foreach ($factura->detalles as $detalle) {


                if($detalle->concepto_id == $formulario->id){
                    $dosaFactura[$factura->nroDosa]["formulario"]=$detalle->totalDes;
                }elseif($detalle->concepto_id == $aterrizaje->id){
                    $dosaFactura[$factura->nroDosa]["aterrizaje"]=$detalle->totalDes;
                }elseif($detalle->concepto_id == $estacionamiento->id){
                    $dosaFactura[$factura->nroDosa]["estacionamiento"]=$detalle->totalDes;
                }elseif($detalle->concepto_id == $habilitacion->id){
                    $dosaFactura[$factura->nroDosa]["habilitacion"]=$detalle->totalDes;
                }elseif($detalle->concepto_id == $jetway->id){
                    $dosaFactura[$factura->nroDosa]["jetway"]=$detalle->totalDes;
                }elseif($detalle->concepto_id == $carga->id){
                    $dosaFactura[$factura->nroDosa]["carga"]=$detalle->totalDes;
                }else{
                    foreach ($otrosIngresos as $concepto) {
                        if($detalle->concepto_id == $concepto->id)
                            $dosaFactura[$factura->nroDosa]["otros"]+=$detalle->totalDes;
                    }
                }
            }

        }


        $prefixManual = Modulo::where('nombre', 'DOSAS')
                                ->where('aeropuerto_id', $aeropuerto)
                                ->first();
        $prefixManual = $prefixManual->nFacturaPrefixManual;


        $facturasManuales = Factura::with('cobros')
                                ->whereBetween('fecha', array($annoDesde.'-'.$mesDesde.'-'.$diaDesde,  $annoHasta.'-'.$mesHasta.'-'.$diaHasta) )
                                ->where('nFacturaPrefix', $prefixManual)
                                ->where('estado', 'C')
                                ->orderBy('fecha', 'ASC')
                                ->orderBy('nControl', 'ASC')
                                ->orderBy('nFactura', 'ASC')
                                ->get();

        foreach ($facturasManuales as $factura) {

            $cobros = \App\Cobro::join('cobro_factura', 'cobros.id', '=', 'cobro_factura.cobro_id')
                                    ->where('cobro_factura.factura_id', $factura->id)
                                    ->where('aeropuerto_id', $aeropuerto)
                                    ->first();

            $dosaFacturaManual[$factura->nFactura]=[
                "nFactura"          =>'',
                "nControl"          =>'',
                "fecha"             =>0,
                "formulario"        =>0,
                "aterrizaje"        =>0,
                "estacionamiento"   =>0,
                "habilitacion"      =>0,
                "jetway"            =>0,
                "carga"             =>0,
                "otros"             =>0,
                "tasaNacional"      =>0,
                "tasaInternacional" =>0,
                "montoFacturado"    =>0,
                "montoDepositado"   =>0,
                "nroCobro"          =>0,
                "nroDeposito"       =>0
            ];

            foreach ($factura->cobros as $cobro) {
                $dosaFacturaManual[$factura->nFactura]["nroCobro"]        =$cobro->id;
            }
            $dosaFacturaManual[$factura->nFactura]["fecha"]           =$factura->fecha;
            $dosaFacturaManual[$factura->nFactura]["nFactura"]        =$factura->nFacturaPrefix.'-'.$factura->nFactura;
            $dosaFacturaManual[$factura->nFactura]["nControl"]        =$factura->nControlPrefix.'-'.$factura->nControl;
            $dosaFacturaManual[$factura->nFactura]["montoFacturado"]  =$cobros->montofacturas;
            $dosaFacturaManual[$factura->nFactura]["montoDepositado"] =$cobros->montodepositado;
            $dosaFacturaManual[$factura->nFactura]["nroDeposito"]     =$cobro->pagos()->lists('ncomprobante');

            foreach ($factura->detalles as $detalle) {
                if($detalle->concepto_id == $formulario->id){
                    $dosaFacturaManual[$factura->nFactura]["formulario"]=$detalle->totalDes;
                }elseif($detalle->concepto_id == $aterrizaje->id){
                    $dosaFacturaManual[$factura->nFactura]["aterrizaje"]=$detalle->totalDes;
                }elseif($detalle->concepto_id == $estacionamiento->id){
                    $dosaFacturaManual[$factura->nFactura]["estacionamiento"]=$detalle->totalDes;
                }elseif($detalle->concepto_id == $habilitacion->id){
                    $dosaFacturaManual[$factura->nFactura]["habilitacion"]=$detalle->totalDes;
                }elseif($detalle->concepto_id == $jetway->id){
                    $dosaFacturaManual[$factura->nFactura]["jetway"]=$detalle->totalDes;
                }elseif($detalle->concepto_id == $carga->id){
                    $dosaFacturaManual[$factura->nFactura]["carga"]=$detalle->totalDes;
                }else{
                    foreach ($otrosIngresos as $concepto) {
                        if($detalle->concepto_id == $concepto->id)
                            $dosaFacturaManual[$factura->nFactura]["otros"]+=$detalle->totalDes;
                    }
                }
            }

        }

        $facturasAnuladas = Factura::onlyTrashed()
                                ->with('cobros')
                                ->whereBetween('fecha', array($annoDesde.'-'.$mesDesde.'-'.$diaDesde,  $annoHasta.'-'.$mesHasta.'-'.$diaHasta) )
                                ->where('nFacturaPrefix', $prefixManual)
                                ->orderBy('fecha', 'ASC')
                                ->orderBy('nControl', 'ASC')
                                ->orderBy('nFactura', 'ASC')
                                ->get();

        foreach ($facturasAnuladas as $factura) {

            $dosaFacturaAnulada[$factura->id]=[
                "nFactura"          =>'',
                "nroDosa"           =>'',
                "nControl"          =>'',
                "fecha"             =>0,
                "formulario"        =>0,
                "aterrizaje"        =>0,
                "estacionamiento"   =>0,
                "habilitacion"      =>0,
                "jetway"            =>0,
                "carga"             =>0,
                "otros"             =>0,
                "tasaNacional"      =>0,
                "tasaInternacional" =>0,
                "montoFacturado"    =>0,
                "montoDepositado"   =>0,
                "nroCobro"          =>0,
                "nroDeposito"       =>0
            ];

 
            $dosaFacturaAnulada[$factura->id]["fecha"]           =$factura->fecha;
            $dosaFacturaAnulada[$factura->id]["nFactura"]        =$factura->nFacturaPrefix.'-'.$factura->nFactura;
            $dosaFacturaAnulada[$factura->id]["nControl"]        =$factura->nControlPrefix.'-'.$factura->nControl;
            $dosaFacturaAnulada[$factura->id]["nroDosa"]        =$factura->nroDosa;
            $dosaFacturaAnulada[$factura->id]["nroDeposito"]        =$factura->nroDosa;

            foreach ($factura->detalles as $detalle) {
                if($detalle->concepto_id == $formulario->id){
                    $dosaFacturaAnulada[$factura->id]["formulario"]=$detalle->totalDes;
                }elseif($detalle->concepto_id == $aterrizaje->id){
                    $dosaFacturaAnulada[$factura->id]["aterrizaje"]=$detalle->totalDes;
                }elseif($detalle->concepto_id == $estacionamiento->id){
                    $dosaFacturaAnulada[$factura->id]["estacionamiento"]=$detalle->totalDes;
                }elseif($detalle->concepto_id == $habilitacion->id){
                    $dosaFacturaAnulada[$factura->id]["habilitacion"]=$detalle->totalDes;
                }elseif($detalle->concepto_id == $jetway->id){
                    $dosaFacturaAnulada[$factura->id]["jetway"]=$detalle->totalDes;
                }elseif($detalle->concepto_id == $carga->id){
                    $dosaFacturaAnulada[$factura->id]["carga"]=$detalle->totalDes;
                }else{
                    foreach ($otrosIngresos as $concepto) {
                        if($detalle->concepto_id == $concepto->id)
                            $dosaFacturaAnulada[$factura->id]["otros"]+=$detalle->totalDes;
                    }
                }
            }

        }

        $tasasVendidas = \App\Tasaop::select('tasaops.fecha', 'tasaopdetalles.inicio', 'tasaopdetalles.fin', 'tasaopdetalles.costo', 'tasaopdetalles.cantidad', 'tasaopdetalles.total', 'tasaopdetalles.serie', 'tasas.internacional')
            ->join('tasa_cobro_detalles', 'tasa_cobro_detalles.tasa_cobro_id', '=', 'tasaops.tasa_cobro_id')
            ->join('tasa_cobros', 'tasa_cobros.id', '=', 'tasaops.tasa_cobro_id')
            ->join('tasaopdetalles', 'tasaopdetalles.tasaop_id', '=', 'tasaops.id')
            ->join('tasas', 'tasas.nombre', '=', 'tasaopdetalles.serie')
            ->whereBetween('tasaops.fecha', array($annoDesde.'-'.$mesDesde.'-'.$diaDesde,  $annoHasta.'-'.$mesHasta.'-'.$diaHasta) )
            ->whereBetween('tasa_cobro_detalles.fecha', array($annoDesde.'-'.$mesDesde.'-'.$diaDesde,  $annoHasta.'-'.$mesHasta.'-'.$diaHasta) )
            ->where('tasaops.aeropuerto_id', $aeropuerto)
            ->where('tasa_cobros.cv', 1)
            ->where('tasaops.consolidado', 1)
            ->groupBy('inicio')
            ->get();
        $totalTasas            = $tasasVendidas->sum('total');


        return view('reportes.reporteRelacionIngresosAeronauticosContado', compact('dosaFactura', 'dosaFacturaManual', 'dosaFacturaAnulada', 'aeropuertoNombre', 'diaDesde', 'mesDesde', 'annoDesde', 'diaHasta', 'mesHasta', 'annoHasta', 'aeropuerto', 'tasasVendidas', 'totalTasas'));

    }

    //Relación de Cobranza
    public function getReporteRelacionCobranza(Request $request){
        $modulos    =\App\Modulo::where('aeropuerto_id', session('aeropuerto')->id )->where('isActivo', 1)->lists('nombre','id');
        $mes        =$request->get('mes', \Carbon\Carbon::now()->month);
        $anno       =$request->get('anno',  \Carbon\Carbon::now()->year);
        $aeropuerto =$request->get('aeropuerto', session('aeropuerto')->id);
        $cliente    =$request->get('cliente_id', 0);
        $modulo     =$request->get('modulo', 0);
        $nFactura   =$request->get('nFactura', 0);
        $nCobro   =$request->get('nCobro', 0);

        $ajustes = [];

        if($aeropuerto!=0){
            $moduloNombre =($modulo==0)?'TODOS':\App\Modulo::where('id', $modulo)->first()->nombre;
            if($moduloNombre!='TODOS'){
                $modulo=\App\Modulo::where('nombre', $moduloNombre)->where('aeropuerto_id', $aeropuerto)->first()->id;
            }
        }
        else{
            $moduloNombre     =($modulo==0)?'TODOS':\App\Modulo::where('id', $modulo)->first()->nombre;

        }

        $clienteNombre    =($cliente==0)?'TODOS':(\App\Cliente::where('id', $cliente)->first()->nombre);
        $aeropuertoNombre =($aeropuerto==0)?'TODOS':(\App\Aeropuerto::where('id', $aeropuerto)->first()->nombre);
        if($mes == 0){
            $primerDiaMes     =\Carbon\Carbon::create($anno, 1,1)->startOfMonth();
            $ultimoDiaMes     =\Carbon\Carbon::create($anno, 12,31)->endOfMonth();
        }

        $factura_id = 0;

        if($nFactura != 0){

            $factura_id = \App\Factura::where('nFactura', $nFactura)
                                      ->where('aeropuerto_id', $aeropuerto)
                                      ->first();

            if($factura_id != ''){

                $cobros=\App\Cobro::select('cobros.id')
                                      ->join('cobro_factura', 'cobro_factura.cobro_id', '=', 'cobros.id')
                                      ->where('cobro_factura.factura_id', $factura_id->id)
                                      ->orderBy('cobro_factura.factura_id', 'ASC')
                                      ->lists('id');
            }else{
                $cobros = [];
            }

                $recibos=\App\Cobro::with('pagos','facturas')
                                      ->whereIn('cobros.id', $cobros)
                                      ->orderBy('fecha', 'ASC', 'facturas.nFactura', 'ASC')
                                      ->get();

        }elseif($nCobro != 0){

            $recibos=\App\Cobro::with('pagos','facturas')
                                  ->where('cobros.id', $nCobro)
                                  ->orderBy('fecha', 'ASC', 'cobros.id', 'ASC')
                                  ->get();
        }else{

            $primerDiaMes     =\Carbon\Carbon::create($anno, $mes,1)->startOfMonth();
            $ultimoDiaMes     =\Carbon\Carbon::create($anno, $mes,1)->endOfMonth();

            $recibos=\App\Cobro::with(['pagos' => function($query){
                                        $query->groupBy('ncomprobante');
                                    }])->with('facturas')->where('fecha','>=' ,$primerDiaMes)
                                  ->where('fecha','<=' ,$ultimoDiaMes)
                                  ->where('aeropuerto_id',($aeropuerto==0)?">":"=", $aeropuerto)
                                  ->where('cobros.modulo_id',($modulo==0)?">":"=", $modulo)
                                  ->where('cobros.cliente_id',($cliente==0)?">":"=", $cliente)
                                  ->orderBy('fecha', 'ASC', 'facturas.nFactura', 'ASC')
                                  ->get();
        }

        foreach ($recibos as $index => $recibo) {
            if($recibo->montodepositado <> $recibo->montofacturas){
                $monto = Ajuste::where('cobro_id','=',$recibo->id)->orderBy('id', 'DESC')->first();
                $ajustes[$recibo->id] = $monto->monto;
            }
        }


        $totalFacturas   =$recibos->sum('montofacturas');
        $totalDepositado =$recibos->sum('montodepositado');

        return view('reportes.reporteRelacionCobranza', compact('ajustes', 'mes','nFactura','nCobro', 'anno', 'aeropuerto', 'modulo', 'recibos', 'modulos', 'clientes', 'cliente', 'totalFacturas', 'totalDepositado', 'moduloNombre', 'clienteNombre', 'aeropuertoNombre'));

    }

    //Reporte de Relación de Meta y recaudación Mensual
    public function getReporteRelacionMetaRecaudacionMensual(Request $request){
        $anno            =$request->get('anno',  \Carbon\Carbon::now()->year);

        $montosMeses =[];
        $meses=[
            1=>"ENERO",
            2=>"FEBRERO",
            3=>"MARZO",
            4=>"ABRIL",
            5=>"MAYO",
            6=>"JUNIO",
            7=>"JULIO",
            8=>"AGOSTO",
            9=>"SEPTIEMBRE",
            10=>"OCTUBRE",
            11=>"NOVIEMBRE",
            12=>"DICIEMBRE"];
       for($i=1;$i<=12; $i++){
                $diaMes=\Carbon\Carbon::create($anno, $i,1);

                //Tasas

	            $tPZO = \App\TasaCobro::select('tasaops.id')->join('tasaops', 'tasaops.tasa_cobro_id', '=', 'tasa_cobros.id')
	                                        ->where('tasaops.fecha', '>=', $diaMes->startOfMonth()->toDateString())
	                                        ->where('tasaops.fecha', '<=', $diaMes->endOfMonth()->toDateString())
	                                        ->where('tasaops.aeropuerto_id', '1')
	                                        ->where('tasaops.consolidado', 1)
	                                        ->lists('tasaops.id');

	            $tasasPZO = \App\Tasaop::join('tasaopdetalles', 'tasaops.id', '=', 'tasaopdetalles.tasaop_id')
	                                        ->whereIn('tasaops.id', $tPZO)
	                                        ->sum('tasaopdetalles.total');

	            $tCBL = \App\TasaCobro::select('tasaops.id')->join('tasaops', 'tasaops.tasa_cobro_id', '=', 'tasa_cobros.id')
	                                        ->where('tasaops.fecha', '>=', $diaMes->startOfMonth()->toDateString())
	                                        ->where('tasaops.fecha', '<=', $diaMes->endOfMonth()->toDateString())
	                                        ->where('tasaops.aeropuerto_id', '2')
	                                        ->where('tasaops.consolidado', 1)
	                                        ->lists('tasaops.id');

	            $tasasCBL = \App\Tasaop::join('tasaopdetalles', 'tasaops.id', '=', 'tasaopdetalles.tasaop_id')
	                                        ->whereIn('tasaops.id', $tCBL)
	                                        ->sum('tasaopdetalles.total');

	            $tSNV = \App\TasaCobro::select('tasaops.id')->join('tasaops', 'tasaops.tasa_cobro_id', '=', 'tasa_cobros.id')
	                                        ->where('tasaops.fecha', '>=', $diaMes->startOfMonth()->toDateString())
	                                        ->where('tasaops.fecha', '<=', $diaMes->endOfMonth()->toDateString())
	                                        ->where('tasaops.aeropuerto_id', '3')
	                                        ->where('tasaops.consolidado', 1)
	                                        ->lists('tasaops.id');

	            $tasasSNV = \App\Tasaop::join('tasaopdetalles', 'tasaops.id', '=', 'tasaopdetalles.tasaop_id')
	                                        ->whereIn('tasaops.id', $tSNV)
	                                        ->sum('tasaopdetalles.total');

                // Ajuste cobrado
                   $ajustesPZO = \App\Ajuste::join('cobros','cobros.id','=','cobro_id')
                       ->where('ajustes.aeropuerto_id','=', 1)
                       ->where('fecha', '>=', $diaMes->startOfMonth()->toDateString())
                       ->where('fecha', '<=', $diaMes->endOfMonth()->toDateString())
                       ->where('monto','<=',0)
                       ->sum('monto');

                   $ajustesPZO = $ajustesPZO * -1;

                   $ajustesCBL = \App\Ajuste::join('cobros','cobros.id','=','cobro_id')
                       ->where('ajustes.aeropuerto_id','=', 2)
                       ->where('fecha', '>=', $diaMes->startOfMonth()->toDateString())
                       ->where('fecha', '<=', $diaMes->endOfMonth()->toDateString())
                       ->where('monto','<=',0)
                       ->sum('monto');
                   $ajustesCBL = $ajustesCBL * -1;

                   $ajustesSNV = \App\Ajuste::join('cobros','cobros.id','=','cobro_id')
                       ->where('ajustes.aeropuerto_id','=', 3)
                       ->where('fecha', '>=', $diaMes->startOfMonth()->toDateString())
                       ->where('fecha', '<=', $diaMes->endOfMonth()->toDateString())
                       ->where('monto','<=',0)
                       ->sum('monto');
                   $ajustesSNV = $ajustesSNV * -1;




                //Cobrado

                $cobrosPZO=\App\Cobro::where('cobros.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
					                ->where('cobros.fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
					                ->where('cobros.aeropuerto_id','1')
					                ->get();

                $cobrosCBL=\App\Cobro::where('cobros.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
					                ->where('cobros.fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
					                ->where('cobros.aeropuerto_id','2')
					                ->get();

                $cobrosSNV=\App\Cobro::where('cobros.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
					                ->where('cobros.fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
					                ->where('cobros.aeropuerto_id','3')
					                ->get();

            $montosMeses[$meses[$diaMes->month]]=[
                    "metaPZO"         =>0,
                    "recaudadoPZO"    =>0,
                    "diferenciaPZO"   =>0,
                    "metaCBL"         =>0,
                    "recaudadoCBL"    =>0,
                    "diferenciaCBL"   =>0,
                    "metaSNV"         =>0,
                    "recaudadoSNV"    =>0,
                    "diferenciaSNV"   =>0,
                    "metaTotal"       =>0,
                    "recaudadoTotal"  =>0,
                    "diferenciaTotal" =>0,
                ];

            $metaSaarPZO =\App\Meta::where('aeropuerto_id', 1)->where('anno', $anno)->where('mes', $diaMes->month)->first();
            $metaSaarCBL =\App\Meta::where('aeropuerto_id', 2)->where('anno', $anno)->where('mes', $diaMes->month)->first();
            $metaSaarSNV =\App\Meta::where('aeropuerto_id', 3)->where('anno', $anno)->where('mes', $diaMes->month)->first();

            $montosMeses[$meses[$diaMes->month]]["metaPZO"]= isset($metaSaarPZO->saar_meta)?$metaSaarPZO->saar_meta:0;
            $montosMeses[$meses[$diaMes->month]]["metaCBL"]= isset($metaSaarCBL->saar_meta)?$metaSaarCBL->saar_meta:0;
            $montosMeses[$meses[$diaMes->month]]["metaSNV"]= isset($metaSaarSNV->saar_meta)?$metaSaarSNV->saar_meta:0;

            foreach ($cobrosPZO as $cobroPZO) {
                $montosMeses[$meses[$diaMes->month]]["recaudadoPZO"]+=$cobroPZO->montodepositado;
            }
           $montosMeses[$meses[$diaMes->month]]["recaudadoPZO"] -= $ajustesPZO;

            foreach ($cobrosCBL as $cobroCBL) {
                $montosMeses[$meses[$diaMes->month]]["recaudadoCBL"]+=$cobroCBL->montodepositado;
            }

           $montosMeses[$meses[$diaMes->month]]["recaudadoCBL"] -= $ajustesCBL;

            foreach ($cobrosSNV as $cobroSNV) {
                $montosMeses[$meses[$diaMes->month]]["recaudadoSNV"]+=$cobroSNV->montodepositado;
            }

           $montosMeses[$meses[$diaMes->month]]["recaudadoCBL"] -= $ajustesSNV;


            $montosMeses[$meses[$diaMes->month]]["recaudadoPZO"]=$montosMeses[$meses[$diaMes->month]]["recaudadoPZO"]+$tasasPZO;
            $montosMeses[$meses[$diaMes->month]]["recaudadoCBL"]=$montosMeses[$meses[$diaMes->month]]["recaudadoCBL"]+$tasasCBL;
            $montosMeses[$meses[$diaMes->month]]["recaudadoSNV"]=$montosMeses[$meses[$diaMes->month]]["recaudadoSNV"]+$tasasSNV;

            $montosMeses[$meses[$diaMes->month]]["diferenciaPZO"]   =$montosMeses[$meses[$diaMes->month]]["recaudadoPZO"]-$montosMeses[$meses[$diaMes->month]]["metaPZO"];
            $montosMeses[$meses[$diaMes->month]]["diferenciaCBL"]   =$montosMeses[$meses[$diaMes->month]]["recaudadoCBL"]-$montosMeses[$meses[$diaMes->month]]["metaCBL"];
            $montosMeses[$meses[$diaMes->month]]["diferenciaSNV"]   =$montosMeses[$meses[$diaMes->month]]["recaudadoSNV"]-$montosMeses[$meses[$diaMes->month]]["metaSNV"];
            $montosMeses[$meses[$diaMes->month]]["metaTotal"]       =$montosMeses[$meses[$diaMes->month]]["metaPZO"]+$montosMeses[$meses[$diaMes->month]]["metaCBL"]+$montosMeses[$meses[$diaMes->month]]["metaSNV"];
            $montosMeses[$meses[$diaMes->month]]["recaudadoTotal"]  =$montosMeses[$meses[$diaMes->month]]["recaudadoPZO"]+$montosMeses[$meses[$diaMes->month]]["recaudadoCBL"]+$montosMeses[$meses[$diaMes->month]]["recaudadoSNV"];
            $montosMeses[$meses[$diaMes->month]]["diferenciaTotal"] =$montosMeses[$meses[$diaMes->month]]["diferenciaPZO"]+$montosMeses[$meses[$diaMes->month]]["diferenciaCBL"]+$montosMeses[$meses[$diaMes->month]]["diferenciaSNV"];
        }
        return view('reportes.reporteRelacionMetaRecaudacionMensual', compact('montosMeses', 'anno', 'metaSaarSNV', 'metaSaarCBL', 'metaSaarPZO'));
    }

    //Relación Mensual de Ingresos Y Recaudación Pendiente
    public function getReporteRelacionMensualDeIngresosRecaudacionPendiente(Request $request){
        $anno=$request->get('anno',  \Carbon\Carbon::now()->year);
        $montosMeses=[];
        $meses=[
            1=>"ENERO",
            2=>"FEBRERO",
            3=>"MARZO",
            4=>"ABRIL",
            5=>"MAYO",
            6=>"JUNIO",
            7=>"JULIO",
            8=>"AGOSTO",
            9=>"SEPTIEMBRE",
            10=>"OCTUBRE",
            11=>"NOVIEMBRE",
            12=>"DICIEMBRE"];
       for($i=1;$i<=12; $i++){
                $diaMes=\Carbon\Carbon::create($anno, $i,1);

                //Cobrado
                $pzo = \App\TasaCobro::select('tasaops.id')->join('tasaops', 'tasaops.tasa_cobro_id', '=', 'tasa_cobros.id')
                                            ->where('tasaops.fecha', '>=', $diaMes->startOfMonth()->toDateString())
                                            ->where('tasaops.fecha', '<=', $diaMes->endOfMonth()->toDateString())
                                            ->where('tasaops.aeropuerto_id', '1')
                                            ->where('tasaops.consolidado', 1)
                                            ->lists('tasaops.id');

                $tasasPZO = \App\Tasaop::join('tasaopdetalles', 'tasaops.id', '=', 'tasaopdetalles.tasaop_id')
                                            ->whereIn('tasaops.id', $pzo)
                                            ->sum('tasaopdetalles.total');

                $cbl = \App\TasaCobro::select('tasaops.id')->join('tasaops', 'tasaops.tasa_cobro_id', '=', 'tasa_cobros.id')
                                            ->where('tasaops.fecha', '>=', $diaMes->startOfMonth()->toDateString())
                                            ->where('tasaops.fecha', '<=', $diaMes->endOfMonth()->toDateString())
                                            ->where('tasaops.aeropuerto_id', '2')
                                            ->where('tasaops.consolidado', 1)
                                            ->lists('tasaops.id');

                $tasasCBL = \App\Tasaop::join('tasaopdetalles', 'tasaops.id', '=', 'tasaopdetalles.tasaop_id')
                                            ->whereIn('tasaops.id', $cbl)
                                            ->sum('tasaopdetalles.total');

                $snv = \App\TasaCobro::select('tasaops.id')->join('tasaops', 'tasaops.tasa_cobro_id', '=', 'tasa_cobros.id')
                                            ->where('tasaops.fecha', '>=', $diaMes->startOfMonth()->toDateString())
                                            ->where('tasaops.fecha', '<=', $diaMes->endOfMonth()->toDateString())
                                            ->where('tasaops.aeropuerto_id', '2')
                                            ->where('tasaops.consolidado', 1)
                                            ->lists('tasaops.id');

                $tasasSNV = \App\Tasaop::join('tasaopdetalles', 'tasaops.id', '=', 'tasaopdetalles.tasaop_id')
                                            ->whereIn('tasaops.id', $snv)
                                            ->sum('tasaopdetalles.total');


                $cobrosPZO=\App\Cobro::select('montodepositado')
                ->where('cobros.fecha','>=' ,$diaMes->startOfMonth()->toDateString())
                ->where('cobros.fecha','<=' ,$diaMes->endOfMonth()->toDateString())
                ->where('cobros.aeropuerto_id','1')
                ->sum('cobros.montodepositado');

                $cobrosCBL=\App\Cobro::where('cobros.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
                ->where('cobros.fecha','<=' ,$diaMes->endOfMonth()->toDateString())
                ->where('cobros.aeropuerto_id','2')
                ->sum('cobros.montodepositado');

                $cobrosSNV=\App\Cobro::where('cobros.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
                ->where('cobros.fecha','<=' ,$diaMes->endOfMonth()->toDateString())
                ->where('cobros.aeropuerto_id','3')
                ->sum('cobros.montodepositado');

                //Facturas por Cobrar
                $facturasPZO=\App\Factura::where('facturas.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
                ->where('facturas.fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
                ->where('facturas.aeropuerto_id','1')
                ->where('estado', 'P')
                ->where('facturas.deleted_at', null)
                ->get();
                $facturasCBL=\App\Factura::where('facturas.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
                ->where('facturas.fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
                ->where('facturas.aeropuerto_id','2')
                ->where('estado', 'P')
                ->where('facturas.deleted_at', null)
                ->get();
                $facturasSNV=\App\Factura::where('facturas.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
                ->where('facturas.fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
                ->where('facturas.aeropuerto_id','3')
                ->where('estado', 'P')
                ->where('facturas.deleted_at', null)
                ->get();

            $montosMeses[$meses[$diaMes->month]]=[
                    "cobradoPZO"     =>0,
                    "porCobrarPZO"   =>0,
                    "cobradoCBL"     =>0,
                    "porCobrarCBL"   =>0,
                    "cobradoSNV"     =>0,
                    "porCobrarSNV"   =>0,
                    "cobradoTotal"   =>0,
                    "porCobrarTotal" =>0,
                ];

            $montosMeses[$meses[$diaMes->month]]["cobradoPZO"]+=$tasasPZO+$cobrosPZO;
            $montosMeses[$meses[$diaMes->month]]["cobradoCBL"]+=$tasasCBL+$cobrosCBL;
            $montosMeses[$meses[$diaMes->month]]["cobradoSNV"]+=$tasasSNV+$cobrosSNV;


            foreach ($facturasPZO as $facturaPZO) {
                $montosMeses[$meses[$diaMes->month]]["porCobrarPZO"]+=$facturaPZO->total;
            }

            foreach ($facturasCBL as $facturaCBL) {
                $montosMeses[$meses[$diaMes->month]]["porCobrarCBL"]+=$facturaCBL->total;
            }

            foreach ($facturasSNV as $facturaSNV) {
                $montosMeses[$meses[$diaMes->month]]["porCobrarSNV"]+=$facturaSNV->total;
            }

            $montosMeses[$meses[$diaMes->month]]["cobradoTotal"]=$montosMeses[$meses[$diaMes->month]]["cobradoPZO"]+$montosMeses[$meses[$diaMes->month]]["cobradoCBL"]+$montosMeses[$meses[$diaMes->month]]["cobradoSNV"];
            $montosMeses[$meses[$diaMes->month]]["porCobrarTotal"]=$montosMeses[$meses[$diaMes->month]]["porCobrarPZO"]+$montosMeses[$meses[$diaMes->month]]["porCobrarCBL"]+$montosMeses[$meses[$diaMes->month]]["porCobrarSNV"];
        }
        return view('reportes.reporteRelacionMensualDeIngresosRecaudacionPendiente', compact('montosMeses', 'anno'));
    }

    //Reporte de Contratos
    public function getReporteContratos(Request $request){
        $contratos = \App\Contrato::with("cliente")->get();
        return view('reportes.reporteContratos', compact('contratos'));
    }

    //Cuadre de Caja
    public function getReporteCuadreCaja(Request $request){
        $diaDesde   =$request->get('diaDesde', \Carbon\Carbon::now()->day);
        $mesDesde   =$request->get('mesDesde', \Carbon\Carbon::now()->month);
        $annoDesde  =$request->get('annoDesde',  \Carbon\Carbon::now()->year);
        $diaHasta   =$request->get('diaHasta', \Carbon\Carbon::now()->day);
        $mesHasta   =$request->get('mesHasta', \Carbon\Carbon::now()->month);
        $annoHasta  =$request->get('annoHasta',  \Carbon\Carbon::now()->year);
        $aeropuerto =session('aeropuerto')->id;

        $prefix = Modulo::where('nombre', 'DOSAS')
                                ->where('aeropuerto_id', $aeropuerto)
                                ->first();
        $prefixManual = $prefix->nFacturaPrefixManual;

        $facturasManuales = Factura::with('cobros')
                                ->whereBetween('fecha', array($annoDesde.'-'.$mesDesde.'-'.$diaDesde,  $annoHasta.'-'.$mesHasta.'-'.$diaHasta) )
                                ->where('nFacturaPrefix', $prefixManual)
                                ->orderBy('fecha', 'ASC')
                                ->orderBy('nControl', 'ASC')
                                ->orderBy('nFactura', 'ASC')
                                ->get();


        $facturasManualesAnuladas = \App\Factura::onlyTrashed()
                                    ->whereBetween('fecha', array($annoDesde.'-'.$mesDesde.'-'.$diaDesde,  $annoHasta.'-'.$mesHasta.'-'.$diaHasta) )
                                    ->where('nFacturaPrefix', $prefixManual)
                                    ->orderBy('fecha', 'ASC')
                                    ->orderBy('nControl', 'ASC')
                                    ->orderBy('nFactura', 'ASC')
                                    ->get();

        $facturas = \App\Factura::with('cobros')
                                ->whereBetween('fecha', array($annoDesde.'-'.$mesDesde.'-'.$diaDesde,  $annoHasta.'-'.$mesHasta.'-'.$diaHasta) )
                                ->where('facturas.deleted_at', null)
                                ->where('aeropuerto_id', session('aeropuerto')->id)
                                ->where('nroDosa', '<>', 'NULL')
                                ->orderBy('fecha', 'ASC')
                                ->orderBy('nControl', 'ASC')
                                ->orderBy('nFactura', 'ASC')
                                ->orderBy('nroDosa', 'ASC')
                                ->get();

        $facturasAnuladas = \App\Factura::onlyTrashed()
                                ->whereBetween('fecha', array($annoDesde.'-'.$mesDesde.'-'.$diaDesde,  $annoHasta.'-'.$mesHasta.'-'.$diaHasta) )
                                ->where('aeropuerto_id', session('aeropuerto')->id)
                                ->where('nroDosa', '<>', 'NULL')
                                ->orderBy('fecha', 'ASC')
                                ->orderBy('nControl', 'ASC')
                                ->orderBy('nFactura', 'ASC')
                                ->orderBy('nroDosa', 'ASC')
                                ->get();

                                //dd($facturasAnuladas);


        $tasasVendidas = \App\Tasaop::select('tasaops.fecha', 'tasaopdetalles.inicio', 'tasaopdetalles.fin', 'tasaopdetalles.costo', 'tasaopdetalles.cantidad', 'tasaopdetalles.total', 'tasaopdetalles.serie', 'tasas.internacional')
                                    ->join('tasa_cobro_detalles', 'tasa_cobro_detalles.tasa_cobro_id', '=', 'tasaops.tasa_cobro_id')
                                    ->join('tasa_cobros', 'tasa_cobros.id', '=', 'tasaops.tasa_cobro_id')
                                    ->join('tasaopdetalles', 'tasaopdetalles.tasaop_id', '=', 'tasaops.id')
                                    ->join('tasas', 'tasas.nombre', '=', 'tasaopdetalles.serie')
                                    ->whereBetween('tasaops.fecha', array($annoDesde.'-'.$mesDesde.'-'.$diaDesde,  $annoHasta.'-'.$mesHasta.'-'.$diaHasta) )
                                    //->whereBetween('tasa_cobro_detalles.fecha', array($annoDesde.'-'.$mesDesde.'-'.$diaDesde,  $annoHasta.'-'.$mesHasta.'-'.$diaHasta) )
                                    ->where('tasaops.aeropuerto_id', $aeropuerto)
                                    ->where('tasa_cobros.cv', 1)
                                    ->where('tasaops.consolidado', 1)
                                    ->groupBy('inicio')
                                    ->get();

        $totalTasas            = $tasasVendidas->sum('total');
        $facturasTotal         = $facturas->sum('total');
        $facturasAnuladasTotal = $facturasAnuladas->sum('total');
        $facturasManualesTotal = $facturasManuales->sum('total');
        $facturasManualesAnuladasTotal = $facturasManualesAnuladas->sum('total');

        $facturasCredito       = $facturas->where('condicionPago', 'Crédito')
                                                ->sum('total');

        $facturasContado       = $facturas->where('condicionPago', 'Contado')
                                                ->sum('total');

        return view('reportes.reporteCuadreCaja', compact('diaDesde', 'mesDesde', 'annoDesde', 'diaHasta', 'mesHasta', 'annoHasta', 'aeropuerto', 'facturas', 'facturasTotal', 'facturasContado', 'facturasCredito', 'facturasAnuladas', 'facturasAnuladasTotal', 'tasasVendidas', 'totalTasas', 'tipoTasas', 'facturasManuales', 'facturasManualesTotal', 'facturasManualesAnuladas','facturasManualesAnuladasTotal'));
    }

    //Libro de Ventas
    public function getReporteLibroDeVentas(Request $request){
		$diaDesde         = $request->get('diaDesde', \Carbon\Carbon::now()->day);
		$mesDesde         = $request->get('mesDesde', \Carbon\Carbon::now()->month);
		$annoDesde        = $request->get('annoDesde',  \Carbon\Carbon::now()->year);
		$diaHasta         = $request->get('diaHasta', \Carbon\Carbon::now()->day);
		$mesHasta         = $request->get('mesHasta', \Carbon\Carbon::now()->month);
		$annoHasta        = $request->get('annoHasta',  \Carbon\Carbon::now()->year);
		$aeropuerto       = $request->get('aeropuerto', session('aeropuerto')->id);
		$aeropuertoNombre = Aeropuerto::find($aeropuerto)->nombre;
		$fecha            = $diaHasta.'/'.$mesHasta.'/'.$annoHasta;

        $facturas = \App\Factura::withTrashed()
                                ->with('cobros', 'detalles')
                                ->whereBetween('fecha', array($annoDesde.'-'.$mesDesde.'-'.$diaDesde,  $annoHasta.'-'.$mesHasta.'-'.$diaHasta) )
                                ->where('aeropuerto_id', $aeropuerto)
                               // ->groupBy('nFactura')
                                ->orderBy('fecha', 'ASC')
                                ->orderBy('nFacturaPrefix', 'ASC')
                                ->orderBy('nFactura', 'ASC')
                                ->get();

        $facturasAnteriores  =  \App\Factura::where('fecha', '<',  $annoDesde.'-'.$mesDesde.'-'.$diaDesde)
                                            ->where('estado', 'C')
                                            ->where('aeropuerto_id', $aeropuerto)
                                            ->orderBy('facturas.nFactura')
                                            ->lists('facturas.id');



        $cobrosFacturasAnteriores  =  \App\Cobro::select('cobros.id as cobroID')
                                                ->join('cobro_factura', 'cobros.id', '=', 'cobro_factura.cobro_id')
                                                ->whereBetween('cobros.fecha', array($annoDesde.'-'.$mesDesde.'-'.$diaDesde,  $annoHasta.'-'.$mesHasta.'-'.$diaHasta) )
                                                ->whereIn('cobro_factura.factura_id', $facturasAnteriores)
                                                ->where('retencionComprobante', '<>', '0')
                                                ->lists('cobroID');

        $facturasCobradas = \App\Factura::with('cobros', 'detalles')
                                ->join('cobro_factura', 'facturas.id', '=', 'cobro_factura.factura_id')
                                ->whereIn('cobro_factura.cobro_id', $cobrosFacturasAnteriores)
                                ->whereIn('facturas.id', $facturasAnteriores)
                                ->where('facturas.estado', 'C')
                                // ->orWhere('nFactura', '9180')
                                // ->orWhere('nFactura', '9088')
                                // ->orWhere('nFactura', '9247')
                                // ->orWhere('nFactura', '9204')
                                ->groupBy('facturas.nFactura')
                                ->orderBy('facturas.fecha', 'ASC')
                                ->orderBy('facturas.nFacturaPrefix', 'ASC')
                                ->orderBy('facturas.nFactura', 'ASC')
                                ->get();

        return view('reportes.reporteLibroDeVentas', compact('diaDesde', 'mesDesde', 'annoDesde', 'diaHasta', 'mesHasta', 'annoHasta', 'aeropuerto', 'facturas', 'facturasCobradas', 'fecha', 'aeropuertoNombre'));
    }

    //Listado de Facturas Emitidas
    public function getReporteListadoFacturas(Request $request){

        $modulos =\App\Modulo::all();
        $clientes =\App\Cliente::all();
        $fbos = \App\Fbo::all();
        $view=view('reportes.reporteListadoFacturas',compact('clientes', 'modulos','fbos'));
        if($request->isMethod("post")){
            $facturas=\App\Factura::select('facturas.*');

            
            $aeropuerto   =$request->get('aeropuerto');
            $modulo       =$request->get('modulo', 0);
            if ($modulo==0){
                 if($aeropuerto==0){
                    //como se van a mostrar todos los nombres de los modulos de todos los aeropuertos
                    //debo buscar por nimbre en vez de id
                    $facturas->where('facturas.aeropuerto_id', ">", $aeropuerto);

                }else{
                    $facturas->where('facturas.aeropuerto_id', $aeropuerto);
                }
            }else{
                if($aeropuerto==0){
                    //como se van a mostrar todos los nombres de los modulos de todos los aeropuertos
                    //debo buscar por nimbre en vez de id
                    $moduloO=\App\Modulo::find($modulo);
                    $facturas->where('facturas.aeropuerto_id', ">", $aeropuerto);
                    $facturas->join('modulos','modulos.id' , '=', 'facturas.modulo_id');
                    $facturas->where('modulos.nombre', 'like', "%$moduloO->nombre%");

                }else{
                    $facturas->where('facturas.aeropuerto_id', $aeropuerto);
                    $facturas->where('facturas.modulo_id', $modulo);
                }
                if ($request->input('fbo_id')!='') {
                    $fbos = \App\Fbo::all();
                    
                }
         
            }
            $desde= $request->get('desde');
            if($desde!="")
                $desdeC        =\Carbon\Carbon::createFromFormat('d/m/Y', $desde);
            else{

                $desdeC        =\Carbon\Carbon::minValue();
            }

            $facturas->where('facturas.fecha', '>=', $desdeC->toDateString());

            $hasta= $request->get('hasta');
            if($desde!="")
                $hastaC        =\Carbon\Carbon::createFromFormat('d/m/Y', $hasta);
            else
                $hastaC        =\Carbon\Carbon::maxValue();
            $facturas->where('facturas.fecha', '<=', $hastaC->toDateString());

            $nFactura     =$request->get('nFactura');
            if($nFactura!="")
            $facturas->where('facturas.nFactura', $nFactura);

            $cliente_id         =$request->get('cliente_id');
            $facturas->join('clientes','clientes.id' , '=', 'facturas.cliente_id');

            if($cliente_id!="")
                $facturas->where('clientes.id', $cliente_id);

            $estatus      =$request->get('estatus');
            if($estatus=="A"){
                $facturas->onlyTrashed();
            }else{
                $facturas->with('cobros')->where('facturas.estado', 'like',$estatus);
            }


            //dd($facturas->toSql(), $facturas->getBindings());
            $facturas=$facturas->orderBy('fecha', 'ASC')->orderBy('nFactura', 'ASC')->get();
            $total    =$facturas->sum('total');
            $subtotal =$facturas->sum('subtotal');
            $iva      =$facturas->sum('iva');
            $islr     =$facturas->sum('islr');

            if($modulo != '' || $modulo != 0){
                $moduloName=\App\Modulo::find($modulo);
                $moduloNombre = $moduloName->nombre;
            }else{
                $moduloNombre="TODOS";
            }
            if($aeropuerto != 0){
                $aeropuertoName=\App\Aeropuerto::find($aeropuerto);
                $aeropuertoNombre = $aeropuertoName->nombre;
            }else{
                $aeropuertoNombre="TODOS";
            }
            if($cliente_id != ''){
                $clienteName=\App\Cliente::find($cliente_id);
                $clienteNombre = $clienteName->nombre;
            }else{
                $clienteNombre="TODOS";
            }

            switch ($estatus) {
                case 'C':
                    $estatusNombre = "COBRADAS";
                    break;
                case 'P':
                    $estatusNombre = "PENDIENTES";
                    break;
                case 'A':
                    $estatusNombre = "ANULADAS";
                    break;
                case 'V':
                    $estatusNombre = "VENCIDAS";
                    break;
                default:
                    $estatusNombre = "TODAS";
                    break;
            }

            if($modulo!=0){
                $listadoModulo = \App\Modulo::where('id', $modulo)->get();
            }else{
                $listadoModulo = \App\Modulo::where('aeropuerto_id', $aeropuerto)->get();
            }

            $view->with( compact('facturas', 'aeropuerto','cliente', 'cliente_id', 'modulo', 'desde', 'hasta', 'nFactura', 'rif', 'nombre', 'estatus', 'estatusNombre', 'total', 'subtotal', 'islr', 'iva', 'moduloNombre', 'aeropuertoNombre', 'clienteNombre', 'listadoModulo'));


        }


        return $view;

    }

    //Listado de Facturas emitidas por cliente
    public function getReporteListadoFacturasCliente(Request $request){

        $modulos  =\App\Modulo::all();
        $clientes =\App\Cliente::all();
        $view     =view('reportes.reporteListadoFacturasCliente',compact('clientes', 'modulos'));
        if($request->isMethod("post")){
            $facturas=\App\Factura::select('facturas.*', 'clientes.nombre');

            $aeropuerto   =$request->get('aeropuerto');
            $modulo       =$request->get('modulo', 0);
            if ($modulo==0){
                 if($aeropuerto==0){
                    //como se van a mostrar todos los nombres de los modulos de todos los aeropuertos
                    //debo buscar por nimbre en vez de id
                    $facturas->where('facturas.aeropuerto_id', ">", $aeropuerto);

                }else{
                    $facturas->where('facturas.aeropuerto_id', $aeropuerto);
                }
            }else{
                if($aeropuerto==0){
                    //como se van a mostrar todos los nombres de los modulos de todos los aeropuertos
                    //debo buscar por nimbre en vez de id
                    $moduloO=\App\Modulo::find($modulo);
                    $facturas->where('facturas.aeropuerto_id', ">", $aeropuerto);
                    $facturas->join('modulos','modulos.id' , '=', 'facturas.modulo_id');
                    $facturas->where('modulos.nombre', 'like', "%$moduloO->nombre%");

                }else{
                    $facturas->where('facturas.aeropuerto_id', $aeropuerto);
                    $facturas->where('facturas.modulo_id', $modulo);
                }
            }

            $desde= $request->get('desde');
            if($desde!="")
                $desdeC        =\Carbon\Carbon::createFromFormat('d/m/Y', $desde);
            else{

                $desdeC        =\Carbon\Carbon::minValue();
            }

            $facturas->where('facturas.fecha', '>=', $desdeC->toDateString());

            $hasta= $request->get('hasta');
            if($desde!="")
                $hastaC        =\Carbon\Carbon::createFromFormat('d/m/Y', $hasta);
            else
                $hastaC        =\Carbon\Carbon::maxValue();
            $facturas->where('facturas.fecha', '<=', $hastaC->toDateString());

            $nFactura     =$request->get('nFactura');
            if($nFactura!="")
            $facturas->where('facturas.nFactura', $nFactura);

            $cliente_id         =$request->get('cliente_id');
            $facturas->join('clientes','clientes.id' , '=', 'facturas.cliente_id');

            if($cliente_id!="")
                $facturas->where('clientes.id', $cliente_id);

            $estatus      =$request->get('estatus');
            if($estatus=="A"){
                $facturas->onlyTrashed();
            }else{
                $facturas->with('cobros')->where('facturas.estado', 'like', $estatus);
            }

            //dd($facturasCliente->toSql(), $facturasCliente->getBindings());
            $facturas=$facturas->orderBy('nombre', 'ASC')->orderBy('fecha', 'ASC')->orderBy('nFactura', 'ASC')->get();
            $total    =$facturas->sum('total');
            $subtotal =$facturas->sum('subtotal');
            $iva      =$facturas->sum('iva');
            $islr     =$facturas->sum('islr');

            if($modulo != '' || $modulo != 0){
                $moduloName=\App\Modulo::find($modulo);
                $moduloNombre = $moduloName->nombre;
            }else{
                $moduloNombre="TODOS";
            }
            if($aeropuerto != 0){
                $aeropuertoName=\App\Aeropuerto::find($aeropuerto);
                $aeropuertoNombre = $aeropuertoName->nombre;
            }else{
                $aeropuertoNombre="TODOS";
            }
            if($cliente_id != ''){
                $clienteName=\App\Cliente::find($cliente_id);
                $clienteNombre = $clienteName->nombre;
            }else{
                $clienteNombre="TODOS";
            }

            switch ($estatus) {
                case 'C':
                    $estatusNombre = "COBRADAS";
                    break;
                case 'P':
                    $estatusNombre = "PENDIENTES";
                    break;
                case 'A':
                    $estatusNombre = "ANULADAS";
                    break;
                case 'V':
                    $estatusNombre = "VENCIDAS";
                    break;
                default:
                    $estatusNombre = "TODAS";
                    break;
            }


            if($modulo!=0){
                $listadoModulo = \App\Modulo::where('id', $modulo)->get();
            }else{
                $listadoModulo = \App\Modulo::where('aeropuerto_id', $aeropuerto)->get();
            }

            $view->with( compact('facturas', 'numero', 'aeropuerto','cliente', 'cliente_id', 'modulo', 'desde', 'hasta', 'nFactura', 'rif', 'nombre', 'estatus', 'estatusNombre', 'total', 'subtotal', 'islr', 'iva', 'moduloNombre', 'aeropuertoNombre', 'clienteNombre', 'listadoModulo'));

        }
        return $view;

    }

    //Relación de Facturas Aeronáuticas Crédito
    public function getReporteRelacionFacturasAeronauticasCredito(Request $request){
        $diaDesde         =$request->get('diaDesde', \Carbon\Carbon::now()->day);
        $mesDesde         =$request->get('mesDesde', \Carbon\Carbon::now()->month);
        $annoDesde        =$request->get('annoDesde', \Carbon\Carbon::now()->year);
        $diaHasta         =$request->get('diaHasta', \Carbon\Carbon::now()->day);
        $mesHasta         =$request->get('mesHasta', \Carbon\Carbon::now()->month);
        $annoHasta        =$request->get('annoHasta', \Carbon\Carbon::now()->year);
        $aeropuerto       =$request->get('aeropuerto_id', session('aeropuerto')->id);
        $aeropuertoNombre =\App\Aeropuerto::find($aeropuerto)->nombre;
        $cliente          =$request->get('cliente_id', 0);
        $clienteNombre    =($cliente==0)?'TODOS':(\App\Cliente::where('id', $cliente)->first()->nombre);

        $formulario      =\App\Concepto::where('aeropuerto_id', $aeropuerto)->where('nompre', 'FORMULARIO DOSA (CRÉDITO)')->first();
        $aterrizaje      =\App\Concepto::where('aeropuerto_id', $aeropuerto)->where('nompre', 'ATERRIZAJE Y DESPEGUE DE AERONAVES (CRÉDITO)')->first();
        $estacionamiento =\App\Concepto::where('aeropuerto_id', $aeropuerto)->where('nompre', 'ESTACIONAMIENTO DE AERONAVES (CRÉDITO)')->first();
        $habilitacion    =\App\Concepto::where('aeropuerto_id', $aeropuerto)->where('nompre', 'HABILITACION (CRÉDITO)')->first();
        $jetway          =\App\Concepto::where('aeropuerto_id', $aeropuerto)->where('nompre', 'JETWAY (CRÉDITO)')->first();
        $carga           =\App\Concepto::where('aeropuerto_id', $aeropuerto)->where('nompre', 'CARGA (CRÉDITO)')->first();
        $otrosIngresos   =\App\Concepto::where('aeropuerto_id', $aeropuerto)->where('nombreImprimible', 'Otros Aero. (Créd)')->get();




        $facturasAnteriores  =  \App\Factura::where('fecha', '<',  $annoHasta.'-'.$mesHasta.'-'.$diaHasta)
                                            ->where('estado', 'C')
                                            ->where('aeropuerto_id', $aeropuerto)
                                            ->where('nroDosa', '<>', 'NULL')
                                            ->where('condicionPago', 'Crédito')
                                            ->orderBy('facturas.nFactura')
                                            ->lists('facturas.id');


        $cobrosFacturasAnteriores  =  \App\Cobro::select('cobros.id as cobroID')
                                                ->join('cobro_factura', 'cobros.id', '=', 'cobro_factura.cobro_id')
                                                ->whereBetween('cobros.fecha', array($annoDesde.'-'.$mesDesde.'-'.$diaDesde,  $annoHasta.'-'.$mesHasta.'-'.$diaHasta) )
                                                ->whereIn('cobro_factura.factura_id', $facturasAnteriores)
                                                ->groupBy('cobros.id')
                                                ->lists('cobroID');


         $facturas        =\App\Factura::with('detalles', 'cobros')->select('facturas.*', 'clientes.nombre')
                                 ->join('clientes', 'facturas.cliente_id', '=', 'clientes.id')
                                 ->join('cobro_factura', 'facturas.id', '=', 'cobro_factura.factura_id')
                                 ->where('cliente_id', ($cliente==0)?'>=':'=', $cliente)
                                 ->where('facturas.condicionPago', 'Crédito')
                                 ->whereIn('cobro_factura.cobro_id', $cobrosFacturasAnteriores)
                                 ->orderBy('nombre', 'ASC')
                                 ->orderBy('fecha', 'ASC')
                                 ->orderBy('nFactura', 'ASC')
                                 ->get();

        $dosaFactura=[];
        $recibo=[];

        foreach ($facturas as $factura) {
            $dosaFactura[$factura->nroDosa] =[
                                'fecha'             => 0,
                                'reciboCaja'        => [],
                                'nCobro'            => [],
                                'refBancaria'       => [],
                                'formularioBs'      => 0,
                                'aterrizajeBs'      => 0,
                                'estacionamientoBs' => 0,
                                'habilitacionBs'    => 0,
                                'jetwayBs'          => 0,
                                'cargaBs'           => 0,
                                'otrosCargosBs'     => 0,
                                'totalDosa'         => 0,
                                'fechaDeposito'     => 0,
                                'totalDepositado'   => 0
                            ];
            $dosaFactura[$factura->nroDosa]["cliente"]         =$factura->cliente->nombre;
            $dosaFactura[$factura->nroDosa]["totalDosa"]       =$factura->total;
            foreach ($factura->detalles as $detalle) {
                if($detalle->concepto_id == $formulario->id){
                    $dosaFactura[$factura->nroDosa]["formularioBs"]=$detalle->totalDes;
                }elseif($detalle->concepto_id == $aterrizaje->id){
                    $dosaFactura[$factura->nroDosa]["aterrizajeBs"]=$detalle->totalDes;
                }elseif($detalle->concepto_id == $estacionamiento->id){
                    $dosaFactura[$factura->nroDosa]["estacionamientoBs"]=$detalle->totalDes;
                }elseif($detalle->concepto_id == $habilitacion->id){
                    $dosaFactura[$factura->nroDosa]["habilitacionBs"]=$detalle->totalDes;
                }elseif($detalle->concepto_id == $jetway->id){
                    $dosaFactura[$factura->nroDosa]["jetwayBs"]=$detalle->totalDes;
                }elseif($detalle->concepto_id == $carga->id){
                    $dosaFactura[$factura->nroDosa]["cargaBs"]=$detalle->totalDes;
                }else{
                    foreach ($otrosIngresos as $otroIngreso) {
                        if($detalle->concepto_id == $otroIngreso->id)
                            $dosaFactura[$factura->nroDosa]["otrosCargosBs"]+=$detalle->totalDes;
                    }
                }
            }

            foreach ($factura->cobros as $recibo){
                    $dosaFactura[$factura->nroDosa]["fecha"]=$recibo->fecha;
                    $dosaFactura[$factura->nroDosa]["reciboCaja"]=$recibo->nRecibo;
                    $dosaFactura[$factura->nroDosa]["nCobro"]=$recibo->id;
                foreach ($recibo->pagos as $pago){
                        $dosaFactura[$factura->nroDosa]["refBancaria"]     =$pago->ncomprobante;
                        $dosaFactura[$factura->nroDosa]["fechaDeposito"]   =$pago->fecha;
                        $dosaFactura[$factura->nroDosa]["totalDepositado"] +=$pago->monto;
                }
            }


        }
        
        return view('reportes.reporteRelacionFacturasAeronauticasCredito', compact('aeropuertoNombre', 'diaDesde', 'mesDesde', 'annoDesde', 'diaHasta', 'mesHasta', 'annoHasta', 'aeropuerto', 'cliente', 'clienteNombre', 'facturas', 'dosaFactura', 'clientes'));

    }

    public function getReporteRelacionFacturasAeronauticas(Request $request){
        $diaDesde         =$request->get('diaDesde', \Carbon\Carbon::now()->day);
        $mesDesde         =$request->get('mesDesde', \Carbon\Carbon::now()->month);
        $annoDesde        =$request->get('annoDesde', \Carbon\Carbon::now()->year);
        $diaHasta         =$request->get('diaHasta', \Carbon\Carbon::now()->day);
        $mesHasta         =$request->get('mesHasta', \Carbon\Carbon::now()->month);
        $annoHasta        =$request->get('annoHasta', \Carbon\Carbon::now()->year);
        $aeropuerto       =$request->get('aeropuerto_id', session('aeropuerto')->id);
        $aeropuertoNombre =\App\Aeropuerto::find($aeropuerto)->nombre;
        $cliente          =$request->get('cliente_id', 0);
        $clienteNombre    =($cliente==0)?'TODOS':(\App\Cliente::where('id', $cliente)->first()->nombre);

        $formulario      =\App\Concepto::where('aeropuerto_id', $aeropuerto)->where('nompre', 'FORMULARIO DOSA (CRÉDITO)')->first();
        $aterrizaje      =\App\Concepto::where('aeropuerto_id', $aeropuerto)->where('nompre', 'ATERRIZAJE Y DESPEGUE DE AERONAVES (CRÉDITO)')->first();
        $estacionamiento =\App\Concepto::where('aeropuerto_id', $aeropuerto)->where('nompre', 'ESTACIONAMIENTO DE AERONAVES (CRÉDITO)')->first();
        $habilitacion    =\App\Concepto::where('aeropuerto_id', $aeropuerto)->where('nompre', 'HABILITACION (CRÉDITO)')->first();
        $jetway          =\App\Concepto::where('aeropuerto_id', $aeropuerto)->where('nompre', 'JETWAY (CRÉDITO)')->first();
        $carga           =\App\Concepto::where('aeropuerto_id', $aeropuerto)->where('nompre', 'CARGA (CRÉDITO)')->first();
        $otrosIngresos   =\App\Concepto::where('aeropuerto_id', $aeropuerto)->where('nombreImprimible', 'Otros Aero. (Créd)')->get();




        $facturasAnteriores  =  \App\Factura::where('fecha', '<',  $annoHasta.'-'.$mesHasta.'-'.$diaHasta)
                                            ->where('estado', 'C')
                                            ->where('aeropuerto_id', $aeropuerto)
                                            ->where('nroDosa', '<>', 'NULL')
                                            ->orderBy('facturas.nFactura')
                                            ->lists('facturas.id');


        $cobrosFacturasAnteriores  =  \App\Cobro::select('cobros.id as cobroID')
                                                ->join('cobro_factura', 'cobros.id', '=', 'cobro_factura.cobro_id')
                                                ->whereBetween('cobros.fecha', array($annoDesde.'-'.$mesDesde.'-'.$diaDesde,  $annoHasta.'-'.$mesHasta.'-'.$diaHasta) )
                                                ->whereIn('cobro_factura.factura_id', $facturasAnteriores)
                                                ->groupBy('cobros.id')
                                                ->lists('cobroID');


         $facturas        =\App\Factura::with('detalles', 'cobros')->select('facturas.*', 'clientes.nombre')
                                 ->join('clientes', 'facturas.cliente_id', '=', 'clientes.id')
                                 ->join('cobro_factura', 'facturas.id', '=', 'cobro_factura.factura_id')
                                 ->where('cliente_id', ($cliente==0)?'>=':'=', $cliente)
                                 ->whereIn('cobro_factura.cobro_id', $cobrosFacturasAnteriores)
                                 ->orderBy('nombre', 'ASC')
                                 ->orderBy('fecha', 'ASC')
                                 ->orderBy('nFactura', 'ASC')
                                 ->get();

        $dosaFactura=[];
        $recibo=[];

        foreach ($facturas as $factura) {
            $dosaFactura[$factura->nroDosa] =[
                                'fecha'             => 0,
                                'reciboCaja'        => [],
                                'nCobro'            => [],
                                'refBancaria'       => [],
                                'formularioBs'      => 0,
                                'aterrizajeBs'      => 0,
                                'estacionamientoBs' => 0,
                                'habilitacionBs'    => 0,
                                'jetwayBs'          => 0,
                                'cargaBs'           => 0,
                                'otrosCargosBs'     => 0,
                                'totalDosa'         => 0,
                                'fechaDeposito'     => 0,
                                'totalDepositado'   => 0,
                                'condicionPago'     => $factura->condicionPago
                            ];
            $dosaFactura[$factura->nroDosa]["cliente"]         =$factura->cliente->nombre;
            $dosaFactura[$factura->nroDosa]["totalDosa"]       =$factura->total;
            foreach ($factura->detalles as $detalle) {
                if($detalle->concepto_id == $formulario->id){
                    $dosaFactura[$factura->nroDosa]["formularioBs"]=$detalle->totalDes;
                }elseif($detalle->concepto_id == $aterrizaje->id){
                    $dosaFactura[$factura->nroDosa]["aterrizajeBs"]=$detalle->totalDes;
                }elseif($detalle->concepto_id == $estacionamiento->id){
                    $dosaFactura[$factura->nroDosa]["estacionamientoBs"]=$detalle->totalDes;
                }elseif($detalle->concepto_id == $habilitacion->id){
                    $dosaFactura[$factura->nroDosa]["habilitacionBs"]=$detalle->totalDes;
                }elseif($detalle->concepto_id == $jetway->id){
                    $dosaFactura[$factura->nroDosa]["jetwayBs"]=$detalle->totalDes;
                }elseif($detalle->concepto_id == $carga->id){
                    $dosaFactura[$factura->nroDosa]["cargaBs"]=$detalle->totalDes;
                }else{
                    foreach ($otrosIngresos as $otroIngreso) {
                        if($detalle->concepto_id == $otroIngreso->id)
                            $dosaFactura[$factura->nroDosa]["otrosCargosBs"]+=$detalle->totalDes;
                    }
                }
            }

            foreach ($factura->cobros as $recibo){
                $dosaFactura[$factura->nroDosa]["fecha"]=$recibo->fecha;
                $dosaFactura[$factura->nroDosa]["reciboCaja"]=$recibo->nRecibo;
                $dosaFactura[$factura->nroDosa]["nCobro"]=$recibo->id;
                foreach ($recibo->pagos as $pago){
                        $dosaFactura[$factura->nroDosa]["refBancaria"]     =$pago->ncomprobante;
                        $dosaFactura[$factura->nroDosa]["fechaDeposito"]   =$pago->fecha;
                        $dosaFactura[$factura->nroDosa]["totalDepositado"] +=$pago->monto;
                }
            }


        }
        
        return view('reportes.reporteRelacionFacturasAeronauticas', compact('aeropuertoNombre', 'diaDesde', 'mesDesde', 'annoDesde', 'diaHasta', 'mesHasta', 'annoHasta', 'aeropuerto', 'cliente', 'clienteNombre', 'facturas', 'dosaFactura', 'clientes'));

    }

    public function getReporteRelacionFacturasCliente(Request $request){
        $diaDesde         =$request->get('diaDesde', \Carbon\Carbon::now()->day);
        $mesDesde         =$request->get('mesDesde', \Carbon\Carbon::now()->month);
        $annoDesde        =$request->get('annoDesde', \Carbon\Carbon::now()->year);
        $diaHasta         =$request->get('diaHasta', \Carbon\Carbon::now()->day);
        $mesHasta         =$request->get('mesHasta', \Carbon\Carbon::now()->month);
        $annoHasta        =$request->get('annoHasta', \Carbon\Carbon::now()->year);
        $aeropuerto       =$request->get('aeropuerto_id', session('aeropuerto')->id);
        $aeropuertoNombre =\App\Aeropuerto::find($aeropuerto)->nombre;
        $cliente          =$request->get('cliente_id', 0);
        $clienteNombre    =($cliente==0)?'TODOS':(\App\Cliente::where('id', $cliente)->first()->nombre);


        $facturasAnteriores  =  \App\Factura::where('fecha', '<',  $annoHasta.'-'.$mesHasta.'-'.$diaHasta)
                                            ->where('estado', 'C')
                                            ->where('aeropuerto_id', $aeropuerto)
                                            ->orderBy('facturas.nFactura')
                                            ->lists('facturas.id');


        $cobrosFacturasAnteriores  =  \App\Cobro::select('cobros.id as cobroID')
                                                ->join('cobro_factura', 'cobros.id', '=', 'cobro_factura.cobro_id')
                                                ->whereBetween('cobros.fecha', array($annoDesde.'-'.$mesDesde.'-'.$diaDesde,  $annoHasta.'-'.$mesHasta.'-'.$diaHasta) )
                                                ->whereIn('cobro_factura.factura_id', $facturasAnteriores)
                                                ->groupBy('cobros.id')
                                                ->lists('cobroID');


         $facturas        =\App\Factura::with('detalles', 'cobros')->select('facturas.*', 'clientes.nombre')
                                 ->join('clientes', 'facturas.cliente_id', '=', 'clientes.id')
                                 ->join('cobro_factura', 'facturas.id', '=', 'cobro_factura.factura_id')
                                 ->where('cliente_id', ($cliente==0)?'>=':'=', $cliente)
                                 ->whereIn('cobro_factura.cobro_id', $cobrosFacturasAnteriores)
                                 ->orderBy('nombre', 'ASC')
                                 ->orderBy('fecha', 'ASC')
                                 ->orderBy('nFactura', 'ASC')
                                 ->get();

        $dosaFactura=[];
        $recibo=[];

        for ($i=0; $i < count($facturas); $i++) { 
            $dosaFactura[$i] =[
                                'fecha'             => 0,
                                'reciboCaja'        => [],
                                'nCobro'            => [],
                                'refBancaria'       => [],
                                'formularioBs'      => 0,
                                'detalle'           => '',
                                'detalle_count'     => 1,
                                'totalDosa'         => 0,
                                'fechaDeposito'     => 0,
                                'totalDepositado'   => 0,
                                'condicionPago'     => $facturas[$i]->condicionPago
                            ];
            $dosaFactura[$i]["cliente"]         =$facturas[$i]->cliente->nombre;
            $dosaFactura[$i]["totalDosa"]       =$facturas[$i]->total;
                $dosaFactura[$i]['detalle'][0]['concepto']=$facturas[$i]->detalles[0]->concepto->modulo->nombre;
            $dosaFactura[$i]['detalle_count']=1;
            

            foreach ($facturas[$i]->cobros as $recibo){
                $dosaFactura[$i]["fecha"]=$recibo->fecha;
                $dosaFactura[$i]["reciboCaja"]=$recibo->nRecibo;
                $dosaFactura[$i]["nCobro"]=$recibo->id;
                foreach ($recibo->pagos as $pago){
                    $dosaFactura[$i]["refBancaria"]     =$pago->ncomprobante;
                    $dosaFactura[$i]["fechaDeposito"]   =$pago->fecha;
                    $dosaFactura[$i]["totalDepositado"] +=$pago->monto;
                    $dosaFactura[$i]["banco"] = $pago->banco->nombre;
                }
            }
            usort($dosaFactura,function ($a,$b){
                if ($a['refBancaria'] == $b['refBancaria']) {
                    return 0;
                }
                return ($a['refBancaria'] < $b['refBancaria']) ? -1 : 1;
            });


        }
        return view('reportes.reporteRelacionFacturasCliente', compact('aeropuertoNombre', 'diaDesde', 'mesDesde', 'annoDesde', 'diaHasta', 'mesHasta', 'annoHasta', 'aeropuerto', 'cliente', 'clienteNombre', 'facturas', 'dosaFactura', 'clientes'));

    }


    //Relación de Facturas Aeronáuticas Crédito RESUMEN
    public function getReporteResumenFacturasAeronauticasCredito (Request $request){
        $diaDesde         =$request->get('diaDesde', \Carbon\Carbon::now()->day);
        $mesDesde         =$request->get('mesDesde', \Carbon\Carbon::now()->month);
        $annoDesde        =$request->get('annoDesde', \Carbon\Carbon::now()->year);
        $diaHasta         =$request->get('diaHasta', \Carbon\Carbon::now()->day);
        $mesHasta         =$request->get('mesHasta', \Carbon\Carbon::now()->month);
        $annoHasta        =$request->get('annoHasta', \Carbon\Carbon::now()->year);
        $aeropuerto       =$request->get('aeropuerto_id', session('aeropuerto')->id);
        $aeropuertoNombre =\App\Aeropuerto::find($aeropuerto)->nombre;
        $cliente          =$request->get('cliente_id', 0);
        $clienteNombre    =($cliente==0)?'TODOS':(\App\Cliente::where('id', $cliente)->first()->nombre);

        $formulario      =\App\Concepto::where('aeropuerto_id', $aeropuerto)->where('nompre', 'FORMULARIO DOSA (CRÉDITO)')->first();
        $aterrizaje      =\App\Concepto::where('aeropuerto_id', $aeropuerto)->where('nompre', 'ATERRIZAJE Y DESPEGUE DE AERONAVES (CRÉDITO)')->first();
        $estacionamiento =\App\Concepto::where('aeropuerto_id', $aeropuerto)->where('nompre', 'ESTACIONAMIENTO DE AERONAVES (CRÉDITO)')->first();
        $habilitacion    =\App\Concepto::where('aeropuerto_id', $aeropuerto)->where('nompre', 'HABILITACION (CRÉDITO)')->first();
        $jetway          =\App\Concepto::where('aeropuerto_id', $aeropuerto)->where('nompre', 'JETWAY (CRÉDITO)')->first();
        $carga           =\App\Concepto::where('aeropuerto_id', $aeropuerto)->where('nompre', 'CARGA (CRÉDITO)')->first();
        $otrosIngresos   =\App\Concepto::where('aeropuerto_id', $aeropuerto)->where('nombreImprimible', 'Otros Aero. (Créd)')->lists('id');

       

        $facturasAnteriores  =  \App\Factura::where('fecha', '<',  $annoHasta.'-'.$mesHasta.'-'.$diaHasta)
                                            ->where('estado', 'C')
                                            ->where('condicionPago', 'Crédito')
                                            ->where('aeropuerto_id', $aeropuerto)
                                            ->where('nroDosa', '<>', 'NULL')
                                            ->orderBy('facturas.nFactura')
                                            ->lists('facturas.id');


        $cobrosFacturasAnteriores  =  \App\Cobro::select('cobros.id as cobroID')
                                                ->join('cobro_factura', 'cobros.id', '=', 'cobro_factura.cobro_id')
                                                ->whereBetween('cobros.fecha', array($annoDesde.'-'.$mesDesde.'-'.$diaDesde,  $annoHasta.'-'.$mesHasta.'-'.$diaHasta) )
                                                ->whereIn('cobro_factura.factura_id', $facturasAnteriores)
                                                ->groupBy('cobros.id')
                                                ->lists('cobroID');


         $facturas        =\App\Factura::with('detalles', 'cobros')->select('facturas.*', 'clientes.nombre')
                                 ->join('clientes', 'facturas.cliente_id', '=', 'clientes.id')
                                 ->join('cobro_factura', 'facturas.id', '=', 'cobro_factura.factura_id')
                                 ->where('cliente_id', ($cliente==0)?'>=':'=', $cliente)
                                 ->where('facturas.condicionPago', 'Crédito')
                                 ->whereIn('cobro_factura.cobro_id', $cobrosFacturasAnteriores)
                                 ->orderBy('nombre', 'ASC')
                                 ->orderBy('fecha', 'ASC')
                                 ->orderBy('nFactura', 'ASC')
                                 ->get();


        $dosaFactura=[];
        $recibo=[];

        foreach ($facturas as $factura) {
            foreach ($factura->cobros as $recibo){
                $dosaFactura[$recibo->id] =[
                                    'fecha'             => 0,
                                    'cantDosas'         => 0,
                                    'reciboCaja'        => [],
                                    'refBancaria'       => [],
                                    'formularioBs'      => 0,
                                    'aterrizajeBs'      => 0,
                                    'estacionamientoBs' => 0,
                                    'habilitacionBs'    => 0,
                                    'jetwayBs'          => 0,
                                    'cargaBs'           => 0,
                                    'otrosCargosBs'     => 0,
                                    'totalDosa'         => 0,
                                    'fechaDeposito'     => 0,
                                    'totalDepositado'   => 0,
                                    'ajuste'            => 0
                                ];
                $facturasCobradas = DB::table('cobro_factura')->where('cobro_id', $recibo->id);
                $dosaFactura[$recibo->id]["cantDosas"] =$facturasCobradas->count();
                $dosaFactura[$recibo->id]["cliente"]   =$factura->cliente->nombre;
                $dosaFactura[$recibo->id]["totalDosa"] =$recibo->montofacturas;
                foreach ($recibo->pagos as $p) {
                    # code...
                    $dosaFactura[$recibo->id]["totalDepositado"] +=$p->monto;
                }
                $ajuste     =DB::table('ajustes')
                                    ->select('monto')
                                        ->where('cobro_id', $recibo->id)
                                        ->lists('monto');
                $ajuste = array_sum($ajuste);

                $dosaFactura[$recibo->id]["ajuste"] =($ajuste<0)?abs($ajuste):'0,00';
                $dosaFactura[$recibo->id]["reciboCaja"] =$recibo->nRecibo;
                $dosaFactura[$recibo->id]["fecha"]      =$recibo->fecha;
                foreach ($recibo->pagos as $pago){
                        $dosaFactura[$recibo->id]["refBancaria"]     =$pago->ncomprobante;
                        $dosaFactura[$recibo->id]["fechaDeposito"]   =$pago->fecha;
                }

                $nroFacturas = $facturasCobradas->lists('factura_id');

                $f = DB::table('facturadetalles')
                        ->wherein('factura_id', $nroFacturas);

                $dosaFactura[$recibo->id]["formularioBs"]+= DB::table('facturadetalles')->wherein('factura_id', $nroFacturas)->where('concepto_id', $formulario->id)->sum('totalDes');
                $dosaFactura[$recibo->id]["aterrizajeBs"]+= DB::table('facturadetalles')->wherein('factura_id', $nroFacturas)->where('concepto_id', $aterrizaje->id)->sum('totalDes');
                $dosaFactura[$recibo->id]["estacionamientoBs"]= DB::table('facturadetalles')->wherein('factura_id', $nroFacturas)->where('concepto_id', $estacionamiento->id)->sum('totalDes');
                $dosaFactura[$recibo->id]["habilitacionBs"]= DB::table('facturadetalles')->wherein('factura_id', $nroFacturas)->where('concepto_id', $habilitacion->id)->sum('totalDes');
                $dosaFactura[$recibo->id]["jetwayBs"]= DB::table('facturadetalles')->wherein('factura_id', $nroFacturas)->where('concepto_id', $jetway->id)->sum('totalDes');
                $dosaFactura[$recibo->id]["cargaBs"]= DB::table('facturadetalles')->wherein('factura_id', $nroFacturas)->where('concepto_id', $carga->id)->sum('totalDes');

                $dosaFactura[$recibo->id]["otrosCargosBs"]= DB::table('facturadetalles')->wherein('factura_id', $nroFacturas)->whereIn('concepto_id', $otrosIngresos)->sum('totalDes');
            }
        }



        return view('reportes.reporteRelacionFacturasAeronauticasCreditoResumen', compact('aeropuertoNombre', 'diaDesde', 'mesDesde', 'annoDesde', 'diaHasta', 'mesHasta', 'annoHasta', 'aeropuerto', 'cliente', 'facturas', 'dosaFactura', 'clientes', 'clienteNombre'));

    }

    //Función para exportar los reportes
    public function postExportReport(Request $request){

        require_once('../vendor/autoload.php');
        $table        =$request->get('table');
        $tableFirmas  =$request->get('tableFirmas');
        /*$departamento =$request->get('departamento');
        $gerencia     =$request->get('gerencia');*/
        if($request->get('excel')){
            return $this->ReportToExcel($table);
        }


        $mpdf =  new \mPDF('','', 0, '', 15, 15, 16, 16, 9, 9, 'L', 'dejavusans');
        //$mpdf->SetHTMLHeader(asset('<img src="imgs/gobernacion.png"/>', '33', "SERVICIO AUTÓNOMO DE AEROPUERTOS REGIONALES DEL EDO. BOLÍVAR","SAAR BOLÍVAR\n".$gerencia."\n".$departamento);
         $mpdf->SetHTMLHeader('<img style="width: 140px" src="imgs/gobernacion.png"/>');
        // $mpdf->WriteHTML("SERVICIO AUTÓNOMO DE AEROPUERTOS REGIONALES DEL EDO. BOLÍVAR","SAAR BOLÍVAR");
        // $mpdf->WriteHTML($gerencia);
        // $mpdf->WriteHTML($departamento);
         $mpdf->defaultheaderfontsize=10;


        $mpdf->SetHTMLFooter('<table width="100%" style="vertical-align: bottom; border-top: 1px black solid; font-family: serif; font-size: 7pt; color: #000000; font-style: italic;">
                                <tr>
                                    <td>
                                        <span style="font-style: italic;">{DATE j/m/Y}</span>
                                    </td>
                                    <td align="center" style="font-style: italic;">
                                        {PAGENO}/{nbpg}
                                    </td>
                                </tr>
                            </table>');

        $html = view('pdf.generic', compact('table', 'tableFirmas'))->render();
        $mpdf->AddPage('L','', '', '', '','5', '5', '25', '15', '3', '3'); // margin footer
        $mpdf->WriteHTML($html);
        $mpdf->Output();
   }

   private function ReportToExcel($htmlTable)
   {
    //convierto un Html Table a formato csv
    $sentence = strip_tags(str_replace("</tr>","\n",trim(preg_replace('/\n+/', ";", str_replace("</tr>\n","</tr>",preg_replace('/\r/', '', preg_replace('/\t/', '',strip_tags($htmlTable,'<tr>')))))))); 
    //cambiar encode a utf-8
    $sentence = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $sentence);

    $file = fopen(storage_path()."/app/reporte.csv",'w');
    fwrite($file,$sentence);
    fclose($file);
    return response()->download(storage_path()."/app/reporte.csv",'reporte.csv',['Content-type'=>'text/html; charset=utf-8']);
   }
}
