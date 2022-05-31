<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;


use DB;

class DashboardController extends Controller {

	public function __construct()
    {
        $this->middleware('auth');
    }

	public function indexSCV()
	{

        $today               = \Carbon\Carbon::now();
        $today->timezone     = 'America/New_York';

		$comerciales      = \App\TipoMatricula::where('nombre', 'Comercial')->first()->id;
		$comercialPrivado = \App\TipoMatricula::where('nombre', 'Comercial Privado')->first()->id;
		$privado          = \App\TipoMatricula::where('nombre', 'Privado')->first()->id;
		$fecha            = \Carbon\Carbon::now();
		$hoy              = $fecha->toDateString();
		
		$aterrizajes                     = 0;
		$despegues                       = 0;
		$aterrizajesComerciales          = 0;
		$despeguesComerciales            = 0;
		$aterrizajesComercialPrivado     = 0;
		$despeguesComercialPrivado       = 0;
		$aterrizajesPrivados             = 0;
		$despeguesPrivados               = 0;
		$otrosDespegues                  = 0;
		$otrosAterrizajes                = 0;
		
		$desembarqueComercialAd          = 0;
		$desembarqueComercialInf         = 0;
		$desembarqueComercialTerc        = 0;
		$desembarqueComercial            = 0;
		$desembarquePrivadoAd            = 0;
		$desembarquePrivadoInf           = 0;
		$desembarquePrivadoTerc          = 0;
		$desembarquePrivado              = 0;
		$desembarqueComercialPrivadoAd   = 0;
		$desembarqueComercialPrivadoInf  = 0;
		$desembarqueComercialPrivadoTerc = 0;
		$desembarqueComercialPrivado     = 0;
		$desembarqueTotal                = 0;
		$desembarqueOtrosVuelos          = 0;
		
		$embarqueComercialAd             = 0;
		$embarqueComercialInf            = 0;
		$embarqueComercialTerc           = 0;
		$embarqueComercial               = 0;
		$embarquePrivadoAd               = 0;
		$embarquePrivadoInf              = 0;
		$embarquePrivadoTerc             = 0;
		$embarquePrivado                 = 0;
		$embarqueComercialPrivadoAd      = 0;
		$embarqueComercialPrivadoInf     = 0;
		$embarqueComercialPrivadoTerc    = 0;
		$embarqueComercialPrivado        = 0;
		$embarqueTotal                   = 0;
		$embarqueOtrosVuelos             = 0;
		$transitoTotal                   = 0;

		$aterrizajes = \App\Aterrizaje::where('aeropuerto_id', session('aeropuerto')->id)
									   ->where('fecha', $hoy)
									   ->get();


		$despegues = \App\Despegue::where('aeropuerto_id', session('aeropuerto')->id)
								   ->where('fecha', $hoy)
								   ->get();

		$aterrizajesTotal =$aterrizajes->count();
		$despeguesTotal   =$despegues->count();

		if($aterrizajesTotal!=0 || $despeguesTotal!=0){
			
			$aterrizajesComerciales          = $aterrizajes->where('tipoMatricula_id', $comerciales)->count();
			$despeguesComerciales            = $despegues->where('tipoMatricula_id', $comerciales)->count();
			$aterrizajesComercialPrivado     = $aterrizajes->where('tipoMatricula_id', $comercialPrivado)->count();
			$despeguesComercialPrivado       = $despegues->where('tipoMatricula_id', $comercialPrivado)->count();
			$aterrizajesPrivados             = $aterrizajes->where('tipoMatricula_id', $privado)->count();
			$despeguesPrivados               = $despegues->where('tipoMatricula_id', $privado)->count();
			
			$otrosDespegues                  = $despeguesTotal-($despeguesComerciales+$despeguesComercialPrivado+$despeguesPrivados);
			$otrosAterrizajes                = $aterrizajesTotal-($aterrizajesComerciales+$aterrizajesComercialPrivado+$aterrizajesPrivados);
			
			$desembarqueComercialAd          = $aterrizajes->where('tipoMatricula_id', $comerciales)->sum('desembarqueAdultos');
			$desembarqueComercialInf         = $aterrizajes->where('tipoMatricula_id', $comerciales)->sum('desembarqueInfantes');
			$desembarqueComercialTerc        = $aterrizajes->where('tipoMatricula_id', $comerciales)->sum('desembarqueTercera');
			$desembarqueComercial            = $desembarqueComercialAd+$desembarqueComercialInf+$desembarqueComercialTerc;
			$desembarquePrivadoAd            = $aterrizajes->where('tipoMatricula_id', $privado)->sum('desembarqueAdultos');
			$desembarquePrivadoInf           = $aterrizajes->where('tipoMatricula_id', $privado)->sum('desembarqueInfantes');
			$desembarquePrivadoTerc          = $aterrizajes->where('tipoMatricula_id', $privado)->sum('desembarqueTercera');
			$desembarquePrivado              = $desembarquePrivadoAd+$desembarquePrivadoInf+$desembarquePrivadoTerc;
			$desembarqueComercialPrivadoAd   = $aterrizajes->where('tipoMatricula_id', $comercialPrivado)->sum('desembarqueAdultos');
			$desembarqueComercialPrivadoInf  = $aterrizajes->where('tipoMatricula_id', $comercialPrivado)->sum('desembarqueInfantes');
			$desembarqueComercialPrivadoTerc = $aterrizajes->where('tipoMatricula_id', $comercialPrivado)->sum('desembarqueTercera');
			$desembarqueComercialPrivado     = $desembarqueComercialPrivadoAd+$desembarqueComercialPrivadoInf+$desembarqueComercialPrivadoTerc;
			$desembarqueTotal                = $aterrizajes->sum('desembarqueAdultos')+$aterrizajes->sum('desembarqueInfantes')+$aterrizajes->sum('desembarqueTercera');
			$desembarqueOtrosVuelos          = $desembarqueTotal-($desembarqueComercial+$desembarquePrivado+$desembarqueComercialPrivado);
			
			$embarqueComercialAd             = $despegues->where('tipoMatricula_id', $comerciales)->sum('embarqueAdultos');
			$embarqueComercialInf            = $despegues->where('tipoMatricula_id', $comerciales)->sum('embarqueInfante');
			$embarqueComercialTerc           = $despegues->where('tipoMatricula_id', $comerciales)->sum('embarqueTercera');
			$embarqueComercial               = $embarqueComercialAd+$embarqueComercialInf+$embarqueComercialTerc;
			$embarquePrivadoAd               = $despegues->where('tipoMatricula_id', $privado)->sum('embarqueAdultos'); 
			$embarquePrivadoInf              = $despegues->where('tipoMatricula_id', $privado)->sum('embarqueInfante');
			$embarquePrivadoTerc             = $despegues->where('tipoMatricula_id', $privado)->sum('embarqueTercera');
			$embarquePrivado                 = $embarquePrivadoAd+$embarquePrivadoInf+$embarquePrivadoTerc;
			$embarqueComercialPrivadoAd      = $despegues->where('tipoMatricula_id', $comercialPrivado)->sum('embarqueAdultos');
			$embarqueComercialPrivadoInf     = $despegues->where('tipoMatricula_id', $comercialPrivado)->sum('embarqueInfante');
			$embarqueComercialPrivadoTerc    = $despegues->where('tipoMatricula_id', $comercialPrivado)->sum('embarqueTercera');
			$embarqueComercialPrivado        = $embarqueComercialPrivadoAd+$embarqueComercialPrivadoInf+$embarqueComercialPrivadoTerc;
			$embarqueTotal                   = $despegues->sum('embarqueAdultos')+$despegues->sum('embarqueInfante')+$despegues->sum('embarqueTercera');
			$embarqueOtrosVuelos             = $embarqueTotal-($embarqueComercial+$embarquePrivado+$embarqueComercialPrivado);

			$transitoTotal                   = $despegues->sum('transitoAdultos')+$despegues->sum('transitoInfante')+$despegues->sum('transitoTercera');
		}

		$aterrizajesPendientes = \App\Aterrizaje::where('aeropuerto_id',session('aeropuerto')->id)
												->where('despego', 0)
												->orderBy('fecha', 'DESC')
												->orderBy('hora', 'DESC')
												->limit(5)
												->get();

		$despeguesRecientes = \App\Despegue::where('aeropuerto_id', session('aeropuerto')->id)
											->orderBy('fecha', 'DESC')
											->orderBy('hora', 'DESC')
											->limit(5)
											->get();

        $facturas = \App\Factura::where('fecha', $hoy)
                                ->where('facturas.deleted_at', null)
                                ->where('aeropuerto_id', session('aeropuerto')->id)
                                ->where('nroDosa', '<>', 'NULL')
                                ->get();

        $facturasTotal   = $facturas->sum('total');

        $facturasCredito = $facturas->where('condicionPago', 'Crédito')
                                    ->sum('total');

        $facturasContado = $facturas->where('condicionPago', 'Contado')
                                    ->sum('total');


		return view('dashboards.SCV.partials.index', compact('today', 'aterrizajesComerciales', 'despeguesComerciales', 'aterrizajesComercialPrivado','despeguesComercialPrivado', 'aterrizajesPrivados', 'despeguesPrivados', 'otrosDespegues' ,'otrosAterrizajes', 'desembarqueComercial', 'desembarquePrivado', 'desembarqueComercialPrivado', 'desembarqueOtrosVuelos','embarqueComercial', 'embarquePrivado', 'embarqueComercialPrivado', 'embarqueOtrosVuelos', 'transitoTotal', 'embarqueTotal', 'desembarqueTotal', 'aterrizajesPendientes', 'aterrizajesTotal', 'despeguesRecientes', 'facturasTotal', 'facturasCredito', 'facturasContado'));
	}

	public function indexRecaudacion(Request $request)
	{

        $today               = \Carbon\Carbon::now();
        $today_anno        = $today->year;
        $today->timezone     = 'America/Caracas';
		$fecha            = \Carbon\Carbon::now();
		$hoy              = $fecha->toDateString();
		$anno        = $request->get('anno', $fecha->year);
		$maxanno = Carbon::createFromFormat('Y-m-d H:i:s', \App\Factura::orderBy('created_at', 'DESC')->lists('created_at')[0])->year;
		$minanno = Carbon::createFromFormat('Y-m-d H:i:s', \App\Factura::orderBy('created_at', 'ASC')->lists('created_at')[0])->year;
		$mes = $request->get('mes', $fecha->month);
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

        //METAS
		$metas = \App\Meta::where('anno', $anno)->select('mes', DB::raw('sum(saar_meta) as saar_meta'))->groupby('mes')->lists('saar_meta', 'mes');

        //HOY - TODAY
        $banco = \App\Banco::where('mostrarEnResumen', 1)->sum('saldo');
        $montosMeses =[];
	    $facturado = 0;
	    $cobrado = 0;
	    $porCobrar = 0;

	    //Con año en la petición
	    $montosMeses_anno =[];
	    $facturado_anno = 0;
	    $cobrado_anno = 0;
	    $porCobrar_anno = 0;

	    //INGRESO MENSUAL CANON ARRENDAMIENTO LOCALES- HANGARES
	    $canon = \App\Modulo::where('nombre', 'like', '%CANON%')->lists('id');

	    //AERONAUTICOS 
	    $dosa = \App\Modulo::where('nombre', 'like', '%DOSA%')->lists('id');
	    $otrosAero = \App\Modulo::where('nombre', 'like', '%OTROS INGRESOS AERONÁUTICOS%')->lists('id');
	    $aeronauticos = array_merge($dosa, $otrosAero);

	    /************NO AERONATICOS TODOS AQUELLOS DIFERENTES A LOS AERONAUTICOS***********/

	    //Conceptos aeronauticos - no aeronauticos
	    $conceptos_aeronauticos = \App\Concepto::whereIn('modulo_id', $aeronauticos)->lists('id');
	    $conceptos_no_aeronauticos = \App\Concepto::whereNotIn('modulo_id', $aeronauticos)->lists('id');

	    //Conceptos hangares - locales
	    $conceptos_hangares = \App\Concepto::whereIn('modulo_id', $canon)->where('nompre','like', '%HANGAR%')->lists('id');
	    $conceptos_locales = \App\Concepto::whereIn('modulo_id', $canon)->whereNotIn('id', $conceptos_hangares)->lists('id');
	    $hangares = 0;
	    $locales = 0;

	    $aeropuerto  =$request->get('aeropuerto',  session('aeropuerto')->id);

		$comerciales      = \App\TipoMatricula::where('nombre', 'Comercial')->first()->id;
		$comercialPrivado = \App\TipoMatricula::where('nombre', 'Comercial Privado')->first()->id;
		$privado          = \App\TipoMatricula::where('nombre', 'Privado')->first()->id;

		$aterrizajesComerciales          = 0;
		$despeguesComerciales            = 0;
		$aterrizajesPrivados             = 0;
		$despeguesPrivados               = 0;

		$aterrizajes = \App\Aterrizaje::where('aeropuerto_id', $aeropuerto)
									   ->where('fecha', $hoy)
									   ->get();

		$despegues = \App\Despegue::where('aeropuerto_id', $aeropuerto)
								   ->where('fecha', $hoy)
								   ->get();

		$aterrizajesTotal =$aterrizajes->count();
		$despeguesTotal   =$despegues->count();

		if($aterrizajesTotal!=0 || $despeguesTotal!=0){
			
			$aterrizajesComerciales          = $aterrizajes->where('tipoMatricula_id', $comerciales)->count();
			$despeguesComerciales            = $despegues->where('tipoMatricula_id', $comerciales)->count();
		
			$aterrizajesPrivados             = $aterrizajes->where('tipoMatricula_id', $privado)->count();
			$despeguesPrivados               = $despegues->where('tipoMatricula_id', $privado)->count();
		}

		for($i=1;$i<=12; $i++)
		{
            $diaMes=\Carbon\Carbon::create($anno, $i,1);

            $tasas = \App\TasaCobro::select('tasaops.id')->join('tasaops', 'tasaops.tasa_cobro_id', '=', 'tasa_cobros.id')
                                        ->where('tasaops.fecha', '>=', $diaMes->startOfMonth()->toDateString())
                                        ->where('tasaops.fecha', '<=', $diaMes->endOfMonth()->toDateString())
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
            ->where('estado', 'P')
            ->where('facturas.deleted_at', null)
            ->get();

            //Facturas por Cobrar Aeronauticas
            $facturasPorCobrarAeronauticas=\App\Factura::where('facturas.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
            ->where('facturas.fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
            ->where('estado', 'P')
            ->where('facturas.deleted_at', null)
            ->whereIn('modulo_id', $aeronauticos)
            ->get();

            //Facturas por Cobrar No Aeronauticas
            $facturasPorCobrarNoAeronauticas=\App\Factura::where('facturas.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
            ->where('facturas.fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
            ->where('estado', 'P')
            ->where('facturas.deleted_at', null)
            ->whereNotIn('modulo_id', $aeronauticos)
            ->get();

            //Facturación
            $facturas=\App\Factura::where('facturas.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
            ->where('facturas.fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
            ->where('facturas.deleted_at', null)
            ->get();

            //Facturación aeronáutico
            $facturasAeronauticas = \App\Factura::where('facturas.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
            ->where('facturas.fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
            ->where('facturas.deleted_at', null)
            ->whereIn('modulo_id', $aeronauticos)
            ->get();


            //Facturación no aeronáutico
            $facturasNoAeronauticas = \App\Factura::where('facturas.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
            ->where('facturas.fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
            ->where('facturas.deleted_at', null)
            ->whereNotIn('modulo_id', $aeronauticos)
            ->get();

            //Cobrado
            $cobros=\App\Cobro::where('cobros.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
            ->where('cobros.fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
            ->get();

            //Cobrado aeronáutico
            $cobrosAeronauticos=\App\Cobro::where('cobros.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
            ->where('cobros.fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
            ->whereIn('modulo_id', $aeronauticos)
            ->get();

            //Cobrado no aeronáutico
            $cobrosNoAeronauticos=\App\Cobro::where('cobros.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
            ->where('cobros.fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
            ->whereNotIn('modulo_id', $aeronauticos)
            ->get();

            /*
            *
            * COBRADO CANON ARRENDAMIENTO DE HANGARES Y LOCALES COMERCIALES
            *
            */

            //Cobrado CANON
            $cobrosCANON=\App\Cobro::whereIn('modulo_id', $canon)
            			->where('fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
			            ->where('fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
			            ->lists('id');

			$facturasCobradasCANON=\App\Factura::join('cobro_factura', 'cobro_factura.factura_id', '=', 'facturas.id')
									->whereIn('cobro_id', $cobrosCANON)
									->lists('cobro_factura.factura_id');

			$facturasHangares=\App\Facturadetalle::whereIn('factura_id', $facturasCobradasCANON)
										->whereIn('concepto_id', $conceptos_hangares)
										->lists('factura_id');

			$facturasLocales=\App\Facturadetalle::whereIn('factura_id', $facturasCobradasCANON)
										->whereIn('concepto_id', $conceptos_locales)
										->lists('factura_id');

			$cobradoHangares = \App\Cobro::join('cobro_factura', 'cobro_factura.cobro_id', '=', 'cobros.id')
								->whereIn('factura_id', $facturasHangares)
								->sum('monto');

			$cobradoLocales = \App\Cobro::join('cobro_factura', 'cobro_factura.cobro_id' , '=', 'cobros.id')
								->whereIn('factura_id', $facturasLocales)
								->sum('monto');

            $montosMeses[$meses[$diaMes->month]]=[
                    "facturado"       		=>0,
                    "facturadoAero"       	=>0,
                    "facturadoNoAero"       =>0,
                    "cobrado"         		=>0,
                    "cobradoAero"         	=>0,
                    "cobradoNoAero"         =>0,
                    "porCobrar"       		=>0,
                    "porCobrarAero"       	=>0,
                    "porCobrarNoAero"       =>0,
                    "cobradoHangares" 		=>0,
                    "cobradoLocales" 		=>0,
                ];

            //FACTURADO
            foreach ($facturas as $factura) {
                $montosMeses[$meses[$diaMes->month]]["facturado"]+=$factura->total;
            }

            //FACTURADO AERONAUTICAS
            foreach ($facturasAeronauticas as $factura) {
                $montosMeses[$meses[$diaMes->month]]["facturadoAero"]+=$factura->total;
            }

            //FACTURADO NO AERONAUTICAS
            foreach ($facturasNoAeronauticas as $factura) {
                $montosMeses[$meses[$diaMes->month]]["facturadoNoAero"]+=$factura->total;
            }

            //POR COBRAR - MOROSIDAD
            foreach ($facturasPorCobrar as $facturaPorCobrar) {
                $montosMeses[$meses[$diaMes->month]]["porCobrar"]+=$facturaPorCobrar->total;
            }

             //POR COBRAR - MOROSIDAD - AERONAUTICO
            foreach ($facturasPorCobrarAeronauticas as $facturaPorCobrar) {
                $montosMeses[$meses[$diaMes->month]]["porCobrarAero"]+=$facturaPorCobrar->total;
            }

             //POR COBRAR - MOROSIDAD - NO AERONAUTICO
            foreach ($facturasPorCobrarNoAeronauticas as $facturaPorCobrar) {
                $montosMeses[$meses[$diaMes->month]]["porCobrarNoAero"]+=$facturaPorCobrar->total;
            }

            //COBRADO - RECAUDADO
            foreach ($cobros as $cobro) {
                $montosMeses[$meses[$diaMes->month]]["cobrado"]+=$cobro->montodepositado;
            }

            //COBRADO - RECAUDADO - AERONAUTICO
            foreach ($cobrosAeronauticos as $cobro) {
                $montosMeses[$meses[$diaMes->month]]["cobradoAero"]+=$cobro->montodepositado;
            }

            //COBRADO - RECAUDADO - NO AERONAUTICO 
            foreach ($cobrosNoAeronauticos as $cobro) {
                $montosMeses[$meses[$diaMes->month]]["cobradoNoAero"]+=$cobro->montodepositado;
            }

            $montosMeses[$meses[$diaMes->month]]["facturado"]=$montosMeses[$meses[$diaMes->month]]["facturado"]+$tasasFacturadas;
            $montosMeses[$meses[$diaMes->month]]["facturadoNoAero"]=$montosMeses[$meses[$diaMes->month]]["facturadoNoAero"]+$tasasFacturadas;

            $montosMeses[$meses[$diaMes->month]]["cobrado"]=$montosMeses[$meses[$diaMes->month]]["cobrado"]+$tasasMontos;
            $montosMeses[$meses[$diaMes->month]]["cobradoNoAero"]=$montosMeses[$meses[$diaMes->month]]["cobradoNoAero"]+$tasasMontos;

            //CANON ARRENDAMIENTO HANGARES Y LOCALES COMERCIALES
            $montosMeses[$meses[$diaMes->month]]["cobradoHangares"]=$cobradoHangares;
            $montosMeses[$meses[$diaMes->month]]["cobradoLocales"]=$cobradoLocales;

        }

    	$facturado = $montosMeses[$meses[$mes]]["facturado"];
    	$facturadoAero = $montosMeses[$meses[$mes]]["facturadoAero"];
    	$facturadoNoAero = $montosMeses[$meses[$mes]]["facturadoNoAero"];
    	$cobrado = $montosMeses[$meses[$mes]]["cobrado"];
    	$cobradoAero = $montosMeses[$meses[$mes]]["cobradoAero"];
    	$cobradoNoAero = $montosMeses[$meses[$mes]]["cobradoNoAero"];
    	$porCobrar = $montosMeses[$meses[$mes]]["porCobrar"];
    	$porCobrarAero = $montosMeses[$meses[$mes]]["porCobrarAero"];
    	$porCobrarNoAero = $montosMeses[$meses[$mes]]["porCobrarNoAero"];
    	$hangares = $montosMeses[$meses[$mes]]["cobradoHangares"];
    	$locales = $montosMeses[$meses[$mes]]["cobradoLocales"];
  
		
		return view('dashboards.recaudacion.partials.index', compact('metas', 'hangares','locales','banco','mes','anno','maxanno', 'minanno','meses','facturado','facturadoAero','facturadoNoAero','cobrado','cobradoAero','cobradoNoAero','porCobrar','porCobrarAero','porCobrarNoAero','montosMeses','puertosFrecuentes', 'procedenciaFrecuente', 'destinoFrecuente', 'today', 'aterrizajesComerciales', 'despeguesComerciales', 'aterrizajesPrivados', 'despeguesPrivados', 'desembarqueComercial', 'desembarquePrivado','embarqueComercial', 'embarquePrivado'));             
	}

	public function indexOpRecaudacion(Request $request)
	{
		$aeropuerto  =$request->get('aeropuerto',  session('aeropuerto')->id);
        $today               = \Carbon\Carbon::now();
        $today_anno        = $today->year;
        $today->timezone     = 'America/Caracas';
		$fecha            = \Carbon\Carbon::now();
		$hoy              = $fecha->toDateString();
		$anno        = $request->get('anno', $fecha->year);
		$maxanno = Carbon::createFromFormat('Y-m-d H:i:s', \App\Factura::orderBy('created_at', 'DESC')->lists('created_at')[0])->year;
		$minanno = Carbon::createFromFormat('Y-m-d H:i:s', \App\Factura::orderBy('created_at', 'ASC')->lists('created_at')[0])->year;
		$mes = $request->get('mes', $fecha->month);
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

        //METAS
		$metas = \App\Meta::where('anno', $anno)->select('mes', DB::raw('sum(saar_meta) as saar_meta'))->groupby('mes')->lists('saar_meta', 'mes');


        //HOY - TODAY
        $banco = \App\Banco::where('mostrarEnResumen', 1)->sum('saldo');
        $montosMeses =[];
	    $facturado = 0;
	    $cobrado = 0;
	    $porCobrar = 0;

	    //Con año en la petición
	    $montosMeses_anno =[];
	    $facturado_anno = 0;
	    $cobrado_anno = 0;
	    $porCobrar_anno = 0;

	    //INGRESO MENSUAL CANON ARRENDAMIENTO LOCALES- HANGARES
	    $canon = \App\Modulo::where('aeropuerto_id', $aeropuerto)->where('nombre', 'like', '%CANON%')->lists('id');

	    //AERONAUTICOS 
	    $dosa = \App\Modulo::where('aeropuerto_id', $aeropuerto)->where('nombre', 'like', '%DOSA%')->lists('id');
	    $otrosAero = \App\Modulo::where('aeropuerto_id', $aeropuerto)->where('nombre', 'like', '%OTROS INGRESOS AERONÁUTICOS%')->lists('id');
	    $aeronauticos = array_merge($dosa, $otrosAero);

	    /************NO AERONATICOS TODOS AQUELLOS DIFERENTES A LOS AERONAUTICOS***********/

	    //Conceptos aeronauticos - no aeronauticos
	    $conceptos_aeronauticos = \App\Concepto::where('aeropuerto_id', $aeropuerto)->whereIn('modulo_id', $aeronauticos)->lists('id');
	    $conceptos_no_aeronauticos = \App\Concepto::where('aeropuerto_id', $aeropuerto)->whereNotIn('modulo_id', $aeronauticos)->lists('id');

	    //Conceptos hangares - locales
	    $conceptos_hangares = \App\Concepto::where('aeropuerto_id', $aeropuerto)->whereIn('modulo_id', $canon)->where('nompre','like', '%HANGAR%')->lists('id');
	    $conceptos_locales = \App\Concepto::where('aeropuerto_id', $aeropuerto)->whereIn('modulo_id', $canon)->whereNotIn('id', $conceptos_hangares)->lists('id');
	    $hangares = 0;
	    $locales = 0;

		$comerciales      = \App\TipoMatricula::where('nombre', 'Comercial')->first()->id;
		$comercialPrivado = \App\TipoMatricula::where('nombre', 'Comercial Privado')->first()->id;
		$privado          = \App\TipoMatricula::where('nombre', 'Privado')->first()->id;

		$aterrizajesComerciales          = 0;
		$despeguesComerciales            = 0;
		$aterrizajesPrivados             = 0;
		$despeguesPrivados               = 0;

		$aterrizajes = \App\Aterrizaje::where('aeropuerto_id', $aeropuerto)
									   ->where('fecha', $hoy)
									   ->get();

		$despegues = \App\Despegue::where('aeropuerto_id', $aeropuerto)
								   ->where('fecha', $hoy)
								   ->get();

		$aterrizajesTotal =$aterrizajes->count();
		$despeguesTotal   =$despegues->count();

		if($aterrizajesTotal!=0 || $despeguesTotal!=0){
			
			$aterrizajesComerciales          = $aterrizajes->where('tipoMatricula_id', $comerciales)->count();
			$despeguesComerciales            = $despegues->where('tipoMatricula_id', $comerciales)->count();
		
			$aterrizajesPrivados             = $aterrizajes->where('tipoMatricula_id', $privado)->count();
			$despeguesPrivados               = $despegues->where('tipoMatricula_id', $privado)->count();
		}

		for($i=1;$i<=12; $i++)
		{
            $diaMes=\Carbon\Carbon::create($anno, $i,1);

            $tasas = \App\TasaCobro::select('tasaops.id')->join('tasaops', 'tasaops.tasa_cobro_id', '=', 'tasa_cobros.id')
                                        ->where('tasaops.fecha', '>=', $diaMes->startOfMonth()->toDateString())
                                        ->where('tasaops.fecha', '<=', $diaMes->endOfMonth()->toDateString())
                                        ->where('tasaops.consolidado', 1)
                                        ->where('tasaops.aeropuerto_id', $aeropuerto)
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
            ->where('estado', 'P')
            ->where('facturas.deleted_at', null)
            ->where('aeropuerto_id', $aeropuerto)
            ->get();

            //Facturas por Cobrar Aeronauticas
            $facturasPorCobrarAeronauticas=\App\Factura::where('facturas.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
            ->where('facturas.fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
            ->where('estado', 'P')
            ->where('facturas.deleted_at', null)
            ->whereIn('modulo_id', $aeronauticos)
            ->where('aeropuerto_id', $aeropuerto)
            ->get();

            //Facturas por Cobrar No Aeronauticas
            $facturasPorCobrarNoAeronauticas=\App\Factura::where('facturas.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
            ->where('facturas.fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
            ->where('estado', 'P')
            ->where('facturas.deleted_at', null)
            ->whereNotIn('modulo_id', $aeronauticos)
            ->where('aeropuerto_id', $aeropuerto)
            ->get();

            //Facturación
            $facturas=\App\Factura::where('facturas.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
            ->where('facturas.fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
            ->where('facturas.deleted_at', null)
            ->where('aeropuerto_id', $aeropuerto)
            ->get();

            //Facturación aeronáutico
            $facturasAeronauticas = \App\Factura::where('facturas.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
            ->where('facturas.fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
            ->where('facturas.deleted_at', null)
            ->whereIn('modulo_id', $aeronauticos)
            ->where('aeropuerto_id', $aeropuerto)
            ->get();


            //Facturación no aeronáutico
            $facturasNoAeronauticas = \App\Factura::where('facturas.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
            ->where('facturas.fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
            ->where('facturas.deleted_at', null)
            ->whereNotIn('modulo_id', $aeronauticos)
            ->where('aeropuerto_id', $aeropuerto)
            ->get();

            //Cobrado
            $cobros=\App\Cobro::where('cobros.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
            ->where('cobros.fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
            ->where('aeropuerto_id', $aeropuerto)
            ->get();

            //Cobrado aeronáutico
            $cobrosAeronauticos=\App\Cobro::where('cobros.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
            ->where('cobros.fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
            ->whereIn('modulo_id', $aeronauticos)
            ->where('aeropuerto_id', $aeropuerto)
            ->get();

            //Cobrado no aeronáutico
            $cobrosNoAeronauticos=\App\Cobro::where('cobros.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
            ->where('cobros.fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
            ->whereNotIn('modulo_id', $aeronauticos)
            ->where('aeropuerto_id', $aeropuerto)
            ->get();

            /*
            *
            * COBRADO CANON ARRENDAMIENTO DE HANGARES Y LOCALES COMERCIALES
            *
            */

            //Cobrado CANON
            $cobrosCANON=\App\Cobro::whereIn('modulo_id', $canon)
            			->where('fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
			            ->where('fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
            			->where('aeropuerto_id', $aeropuerto)
			            ->lists('id');

			$facturasCobradasCANON=\App\Factura::join('cobro_factura', 'cobro_factura.factura_id', '=', 'facturas.id')
									->whereIn('cobro_id', $cobrosCANON)
            						->where('facturas.aeropuerto_id', $aeropuerto)
									->lists('cobro_factura.factura_id');

			$facturasHangares=\App\Facturadetalle::whereIn('factura_id', $facturasCobradasCANON)
										->whereIn('concepto_id', $conceptos_hangares)
										->lists('factura_id');

			$facturasLocales=\App\Facturadetalle::whereIn('factura_id', $facturasCobradasCANON)
										->whereIn('concepto_id', $conceptos_locales)
										->lists('factura_id');

			$cobradoHangares = \App\Cobro::join('cobro_factura', 'cobro_factura.cobro_id', '=', 'cobros.id')
								->whereIn('factura_id', $facturasHangares)
            					->where('cobros.aeropuerto_id', $aeropuerto)
								->sum('monto');

			$cobradoLocales = \App\Cobro::join('cobro_factura', 'cobro_factura.cobro_id' , '=', 'cobros.id')
								->whereIn('factura_id', $facturasLocales)
            					->where('cobros.aeropuerto_id', $aeropuerto)
								->sum('monto');

            $montosMeses[$meses[$diaMes->month]]=[
                    "facturado"       		=>0,
                    "facturadoAero"       	=>0,
                    "facturadoNoAero"       =>0,
                    "cobrado"         		=>0,
                    "cobradoAero"         	=>0,
                    "cobradoNoAero"         =>0,
                    "porCobrar"       		=>0,
                    "porCobrarAero"       	=>0,
                    "porCobrarNoAero"       =>0,
                    "cobradoHangares" 		=>0,
                    "cobradoLocales" 		=>0,
                ];

            //FACTURADO
            foreach ($facturas as $factura) {
                $montosMeses[$meses[$diaMes->month]]["facturado"]+=$factura->total;
            }

            //FACTURADO AERONAUTICAS
            foreach ($facturasAeronauticas as $factura) {
                $montosMeses[$meses[$diaMes->month]]["facturadoAero"]+=$factura->total;
            }

            //FACTURADO NO AERONAUTICAS
            foreach ($facturasNoAeronauticas as $factura) {
                $montosMeses[$meses[$diaMes->month]]["facturadoNoAero"]+=$factura->total;
            }

            //POR COBRAR - MOROSIDAD
            foreach ($facturasPorCobrar as $facturaPorCobrar) {
                $montosMeses[$meses[$diaMes->month]]["porCobrar"]+=$facturaPorCobrar->total;
            }

             //POR COBRAR - MOROSIDAD - AERONAUTICO
            foreach ($facturasPorCobrarAeronauticas as $facturaPorCobrar) {
                $montosMeses[$meses[$diaMes->month]]["porCobrarAero"]+=$facturaPorCobrar->total;
            }

             //POR COBRAR - MOROSIDAD - NO AERONAUTICO
            foreach ($facturasPorCobrarNoAeronauticas as $facturaPorCobrar) {
                $montosMeses[$meses[$diaMes->month]]["porCobrarNoAero"]+=$facturaPorCobrar->total;
            }

            //COBRADO - RECAUDADO
            foreach ($cobros as $cobro) {
                $montosMeses[$meses[$diaMes->month]]["cobrado"]+=$cobro->montodepositado;
            }

            //COBRADO - RECAUDADO - AERONAUTICO
            foreach ($cobrosAeronauticos as $cobro) {
                $montosMeses[$meses[$diaMes->month]]["cobradoAero"]+=$cobro->montodepositado;
            }

            //COBRADO - RECAUDADO - NO AERONAUTICO 
            foreach ($cobrosNoAeronauticos as $cobro) {
                $montosMeses[$meses[$diaMes->month]]["cobradoNoAero"]+=$cobro->montodepositado;
            }

            $montosMeses[$meses[$diaMes->month]]["facturado"]=$montosMeses[$meses[$diaMes->month]]["facturado"]+$tasasFacturadas;
            $montosMeses[$meses[$diaMes->month]]["facturadoNoAero"]=$montosMeses[$meses[$diaMes->month]]["facturadoNoAero"]+$tasasFacturadas;

            $montosMeses[$meses[$diaMes->month]]["cobrado"]=$montosMeses[$meses[$diaMes->month]]["cobrado"]+$tasasMontos;
            $montosMeses[$meses[$diaMes->month]]["cobradoNoAero"]=$montosMeses[$meses[$diaMes->month]]["cobradoNoAero"]+$tasasMontos;

            //CANON ARRENDAMIENTO HANGARES Y LOCALES COMERCIALES
            $montosMeses[$meses[$diaMes->month]]["cobradoHangares"]=$cobradoHangares;
            $montosMeses[$meses[$diaMes->month]]["cobradoLocales"]=$cobradoLocales;

        }

    	$facturado = $montosMeses[$meses[$mes]]["facturado"];
    	$facturadoAero = $montosMeses[$meses[$mes]]["facturadoAero"];
    	$facturadoNoAero = $montosMeses[$meses[$mes]]["facturadoNoAero"];
    	$cobrado = $montosMeses[$meses[$mes]]["cobrado"];
    	$cobradoAero = $montosMeses[$meses[$mes]]["cobradoAero"];
    	$cobradoNoAero = $montosMeses[$meses[$mes]]["cobradoNoAero"];
    	$porCobrar = $montosMeses[$meses[$mes]]["porCobrar"];
    	$porCobrarAero = $montosMeses[$meses[$mes]]["porCobrarAero"];
    	$porCobrarNoAero = $montosMeses[$meses[$mes]]["porCobrarNoAero"];
    	$hangares = $montosMeses[$meses[$mes]]["cobradoHangares"];
    	$locales = $montosMeses[$meses[$mes]]["cobradoLocales"];
  
		
		return view('dashboards.recaudacion.partials.index', compact('metas', 'hangares','locales','banco','mes','anno','maxanno', 'minanno','meses','facturado','facturadoAero','facturadoNoAero','cobrado','cobradoAero','cobradoNoAero','porCobrar','porCobrarAero','porCobrarNoAero','montosMeses','puertosFrecuentes', 'procedenciaFrecuente', 'destinoFrecuente', 'today', 'aterrizajesComerciales', 'despeguesComerciales', 'aterrizajesPrivados', 'despeguesPrivados', 'desembarqueComercial', 'desembarquePrivado','embarqueComercial', 'embarquePrivado'));             
	}

	public function indexDireccion(Request $request)
	{
        $today               = \Carbon\Carbon::now();
        $today_anno        = $today->year;
        $today->timezone     = 'America/Caracas';
		$fecha            = \Carbon\Carbon::now();
		$hoy              = $fecha->toDateString();
		$anno        = $request->get('anno', $fecha->year);
		$maxanno = Carbon::createFromFormat('Y-m-d H:i:s', \App\Factura::orderBy('created_at', 'DESC')->lists('created_at')[0])->year;
		$minanno = Carbon::createFromFormat('Y-m-d H:i:s', \App\Factura::orderBy('created_at', 'ASC')->lists('created_at')[0])->year;
		$mes = $request->get('mes', $fecha->month);
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

        //METAS
		$metas = \App\Meta::where('anno', $anno)->select('mes', DB::raw('sum(saar_meta) as saar_meta'))->groupby('mes')->lists('saar_meta', 'mes');

        //HOY - TODAY
        $banco = \App\Banco::where('mostrarEnResumen', 1)->sum('saldo');
        $montosMeses =[];
	    $facturado = 0;
	    $cobrado = 0;
	    $porCobrar = 0;

	    //Con año en la petición
	    $montosMeses_anno =[];
	    $facturado_anno = 0;
	    $cobrado_anno = 0;
	    $porCobrar_anno = 0;

	    //INGRESO MENSUAL CANON ARRENDAMIENTO LOCALES- HANGARES
	    $canon = \App\Modulo::where('nombre', 'like', '%CANON%')->lists('id');

	    //AERONAUTICOS 
	    $dosa = \App\Modulo::where('nombre', 'like', '%DOSA%')->lists('id');
	    $otrosAero = \App\Modulo::where('nombre', 'like', '%OTROS INGRESOS AERONÁUTICOS%')->lists('id');
	    $aeronauticos = array_merge($dosa, $otrosAero);

	    /************NO AERONATICOS TODOS AQUELLOS DIFERENTES A LOS AERONAUTICOS***********/

	    //Conceptos aeronauticos - no aeronauticos
	    $conceptos_aeronauticos = \App\Concepto::whereIn('modulo_id', $aeronauticos)->lists('id');
	    $conceptos_no_aeronauticos = \App\Concepto::whereNotIn('modulo_id', $aeronauticos)->lists('id');

	    //Conceptos hangares - locales
	    $conceptos_hangares = \App\Concepto::whereIn('modulo_id', $canon)->where('nompre','like', '%HANGAR%')->lists('id');
	    $conceptos_locales = \App\Concepto::whereIn('modulo_id', $canon)->whereNotIn('id', $conceptos_hangares)->lists('id');
	    $hangares = 0;
	    $locales = 0;

	    $aeropuerto  =$request->get('aeropuerto',  session('aeropuerto')->id);

		$comerciales      = \App\TipoMatricula::where('nombre', 'Comercial')->first()->id;
		$comercialPrivado = \App\TipoMatricula::where('nombre', 'Comercial Privado')->first()->id;
		$privado          = \App\TipoMatricula::where('nombre', 'Privado')->first()->id;

		$aterrizajesComerciales          = 0;
		$despeguesComerciales            = 0;
		$aterrizajesPrivados             = 0;
		$despeguesPrivados               = 0;

		$aterrizajes = \App\Aterrizaje::where('aeropuerto_id', $aeropuerto)
									   ->where('fecha', $hoy)
									   ->get();

		$despegues = \App\Despegue::where('aeropuerto_id', $aeropuerto)
								   ->where('fecha', $hoy)
								   ->get();

		$aterrizajesTotal =$aterrizajes->count();
		$despeguesTotal   =$despegues->count();

		if($aterrizajesTotal!=0 || $despeguesTotal!=0){
			
			$aterrizajesComerciales          = $aterrizajes->where('tipoMatricula_id', $comerciales)->count();
			$despeguesComerciales            = $despegues->where('tipoMatricula_id', $comerciales)->count();
		
			$aterrizajesPrivados             = $aterrizajes->where('tipoMatricula_id', $privado)->count();
			$despeguesPrivados               = $despegues->where('tipoMatricula_id', $privado)->count();
		}

		for($i=1;$i<=12; $i++)
		{
            $diaMes=\Carbon\Carbon::create($anno, $i,1);

            $tasas = \App\TasaCobro::select('tasaops.id')->join('tasaops', 'tasaops.tasa_cobro_id', '=', 'tasa_cobros.id')
                                        ->where('tasaops.fecha', '>=', $diaMes->startOfMonth()->toDateString())
                                        ->where('tasaops.fecha', '<=', $diaMes->endOfMonth()->toDateString())
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
            ->where('estado', 'P')
            ->where('facturas.deleted_at', null)
            ->get();

            //Facturas por Cobrar Aeronauticas
            $facturasPorCobrarAeronauticas=\App\Factura::where('facturas.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
            ->where('facturas.fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
            ->where('estado', 'P')
            ->where('facturas.deleted_at', null)
            ->whereIn('modulo_id', $aeronauticos)
            ->get();

            //Facturas por Cobrar No Aeronauticas
            $facturasPorCobrarNoAeronauticas=\App\Factura::where('facturas.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
            ->where('facturas.fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
            ->where('estado', 'P')
            ->where('facturas.deleted_at', null)
            ->whereNotIn('modulo_id', $aeronauticos)
            ->get();

            //Facturación
            $facturas=\App\Factura::where('facturas.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
            ->where('facturas.fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
            ->where('facturas.deleted_at', null)
            ->get();



            //Facturación aeronáutico
            $facturasAeronauticas = \App\Factura::where('facturas.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
            ->where('facturas.fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
            ->where('facturas.deleted_at', null)
            ->whereIn('modulo_id', $aeronauticos)
            ->get();


            //Facturación no aeronáutico
            $facturasNoAeronauticas = \App\Factura::where('facturas.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
            ->where('facturas.fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
            ->where('facturas.deleted_at', null)
            ->whereNotIn('modulo_id', $aeronauticos)
            ->get();

            //Cobrado
            $cobros=\App\Cobro::where('cobros.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
            ->where('cobros.fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
            ->get();

            //Cobrado aeronáutico
            $cobrosAeronauticos=\App\Cobro::where('cobros.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
            ->where('cobros.fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
            ->whereIn('modulo_id', $aeronauticos)
            ->get();

            //Cobrado no aeronáutico
            $cobrosNoAeronauticos=\App\Cobro::where('cobros.fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
            ->where('cobros.fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
            ->whereNotIn('modulo_id', $aeronauticos)
            ->get();

            /*
            *
            * COBRADO CANON ARRENDAMIENTO DE HANGARES Y LOCALES COMERCIALES
            *
            */

            //Cobrado CANON
            $cobrosCANON=\App\Cobro::whereIn('modulo_id', $canon)
            			->where('fecha','>=' ,$diaMes->startOfMonth()->toDateTimeString())
			            ->where('fecha','<=' ,$diaMes->endOfMonth()->toDateTimeString())
			            ->lists('id');

			$facturasCobradasCANON=\App\Factura::join('cobro_factura', 'cobro_factura.factura_id', '=', 'facturas.id')
									->whereIn('cobro_id', $cobrosCANON)
									->lists('cobro_factura.factura_id');

			$facturasHangares=\App\Facturadetalle::whereIn('factura_id', $facturasCobradasCANON)
										->whereIn('concepto_id', $conceptos_hangares)
										->lists('factura_id');

			$facturasLocales=\App\Facturadetalle::whereIn('factura_id', $facturasCobradasCANON)
										->whereIn('concepto_id', $conceptos_locales)
										->lists('factura_id');

			$cobradoHangares = \App\Cobro::join('cobro_factura', 'cobro_factura.cobro_id', '=', 'cobros.id')
								->whereIn('factura_id', $facturasHangares)
								->sum('monto');

			$cobradoLocales = \App\Cobro::join('cobro_factura', 'cobro_factura.cobro_id' , '=', 'cobros.id')
								->whereIn('factura_id', $facturasLocales)
								->sum('monto');

            $montosMeses[$meses[$diaMes->month]]=[
                    "facturado"       		=>0,
                    "facturadoAero"       	=>0,
                    "facturadoNoAero"       =>0,
                    "cobrado"         		=>0,
                    "cobradoAero"         	=>0,
                    "cobradoNoAero"         =>0,
                    "porCobrar"       		=>0,
                    "porCobrarAero"       	=>0,
                    "porCobrarNoAero"       =>0,
                    "cobradoHangares" 		=>0,
                    "cobradoLocales" 		=>0,
                ];

            //FACTURADO
            foreach ($facturas as $factura) {
                $montosMeses[$meses[$diaMes->month]]["facturado"]+=$factura->total;
            }

            //FACTURADO AERONAUTICAS
            foreach ($facturasAeronauticas as $factura) {
                $montosMeses[$meses[$diaMes->month]]["facturadoAero"]+=$factura->total;
            }

            //FACTURADO NO AERONAUTICAS
            foreach ($facturasNoAeronauticas as $factura) {
                $montosMeses[$meses[$diaMes->month]]["facturadoNoAero"]+=$factura->total;
            }

            //POR COBRAR - MOROSIDAD
            foreach ($facturasPorCobrar as $facturaPorCobrar) {
                $montosMeses[$meses[$diaMes->month]]["porCobrar"]+=$facturaPorCobrar->total;
            }

             //POR COBRAR - MOROSIDAD - AERONAUTICO
            foreach ($facturasPorCobrarAeronauticas as $facturaPorCobrar) {
                $montosMeses[$meses[$diaMes->month]]["porCobrarAero"]+=$facturaPorCobrar->total;
            }

             //POR COBRAR - MOROSIDAD - NO AERONAUTICO
            foreach ($facturasPorCobrarNoAeronauticas as $facturaPorCobrar) {
                $montosMeses[$meses[$diaMes->month]]["porCobrarNoAero"]+=$facturaPorCobrar->total;
            }

            //COBRADO - RECAUDADO
            foreach ($cobros as $cobro) {
                $montosMeses[$meses[$diaMes->month]]["cobrado"]+=$cobro->montodepositado;
            }

            //COBRADO - RECAUDADO - AERONAUTICO
            foreach ($cobrosAeronauticos as $cobro) {
                $montosMeses[$meses[$diaMes->month]]["cobradoAero"]+=$cobro->montodepositado;
            }

            //COBRADO - RECAUDADO - NO AERONAUTICO 
            foreach ($cobrosNoAeronauticos as $cobro) {
                $montosMeses[$meses[$diaMes->month]]["cobradoNoAero"]+=$cobro->montodepositado;
            }

            $montosMeses[$meses[$diaMes->month]]["facturado"]=$montosMeses[$meses[$diaMes->month]]["facturado"]+$tasasFacturadas;
            $montosMeses[$meses[$diaMes->month]]["facturadoNoAero"]=$montosMeses[$meses[$diaMes->month]]["facturadoNoAero"]+$tasasFacturadas;

            $montosMeses[$meses[$diaMes->month]]["cobrado"]=$montosMeses[$meses[$diaMes->month]]["cobrado"]+$tasasMontos;
             $montosMeses[$meses[$diaMes->month]]["cobradoNoAero"]=$montosMeses[$meses[$diaMes->month]]["cobradoNoAero"]+$tasasMontos;

            //CANON ARRENDAMIENTO HANGARES Y LOCALES COMERCIALES
            $montosMeses[$meses[$diaMes->month]]["cobradoHangares"]=$cobradoHangares;
            $montosMeses[$meses[$diaMes->month]]["cobradoLocales"]=$cobradoLocales;

        }

    	$facturado = $montosMeses[$meses[$mes]]["facturado"];
    	$facturadoAero = $montosMeses[$meses[$mes]]["facturadoAero"];
    	$facturadoNoAero = $montosMeses[$meses[$mes]]["facturadoNoAero"];
    	$cobrado = $montosMeses[$meses[$mes]]["cobrado"];
    	$cobradoAero = $montosMeses[$meses[$mes]]["cobradoAero"];
    	$cobradoNoAero = $montosMeses[$meses[$mes]]["cobradoNoAero"];
    	$porCobrar = $montosMeses[$meses[$mes]]["porCobrar"];
    	$porCobrarAero = $montosMeses[$meses[$mes]]["porCobrarAero"];
    	$porCobrarNoAero = $montosMeses[$meses[$mes]]["porCobrarNoAero"];
    	$hangares = $montosMeses[$meses[$mes]]["cobradoHangares"];
    	$locales = $montosMeses[$meses[$mes]]["cobradoLocales"];

		return view('dashboards.direccion.partials.index', compact('metas', 'hangares','locales','banco','mes','anno','maxanno', 'minanno','meses','facturado','facturadoAero','facturadoNoAero','cobrado','cobradoAero','cobradoNoAero','porCobrar','porCobrarAero','porCobrarNoAero','montosMeses','puertosFrecuentes', 'procedenciaFrecuente', 'destinoFrecuente', 'today', 'aterrizajesComerciales', 'despeguesComerciales', 'aterrizajesPrivados', 'despeguesPrivados', 'desembarqueComercial', 'desembarquePrivado','embarqueComercial', 'embarquePrivado'));
	}

	public function indexOtros()
	{
		return view('dashboards.general.index');
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
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
