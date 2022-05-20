<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Traits\DecimalConverterTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Conciliado;


class ConciliacionController extends Controller {

    use DecimalConverterTrait;
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		if($request->ajax()){

            $fecha_desde        = $request->get('fecha_desde');
			$fecha_hasta        = $request->get('fecha_hasta');
			$default            = '0000-00-00';
            $default2           = '9000-12-31';

			if(!($fecha_desde == "")){
                $fecha_desde            =\Carbon\Carbon::createFromFormat('d/m/Y', $fecha_desde)->toDateString();
			}
			if(!($fecha_hasta == "")){
                $fecha_hasta            =\Carbon\Carbon::createFromFormat('d/m/Y', $fecha_hasta)->toDateString();
			}

            if ($fecha_desde == "" && $fecha_hasta == "") {
                $conciliados = \App\Conciliado::where('aeropuerto_id', '=', session('aeropuerto')->id)
                    ->join('bancos','bancos.id','=','banco_id')
                    ->join('bancoscuentas', 'bancoscuentas.id','=','cuenta_id')
                    ->select('*','bancos.id as banco_id','bancoscuentas.id as bancoscuentas_id','conciliados.id as id')
                    ->whereBetween('fecha_banco', [$default, $default2])
                    ->orderby('fecha_banco','DESC')
                    ->paginate(10);

                $conciliadosTotal = \App\Conciliado::where('aeropuerto_id', '=', session('aeropuerto')->id)
                    ->whereBetween('fecha_banco', [$default, $default2])
                    ->sum('monto_banco');

                $conciliadosDif = \App\Conciliado::where('aeropuerto_id', '=', session('aeropuerto')->id)
                    ->whereBetween('fecha_banco', [$default, $default2])
                    ->sum('comision_bancaria');

                $conciliadosLot = \App\Conciliado::where('aeropuerto_id', '=', session('aeropuerto')->id)
                    ->whereBetween('fecha_banco', [$default, $default2])
                    ->sum('monto_lote');

            } else {
                $conciliados = \App\Conciliado::where('aeropuerto_id', '=', session('aeropuerto')->id)
                    ->join('bancos','bancos.id','=','banco_id')
                    ->join('bancoscuentas', 'bancoscuentas.id','=','cuenta_id')
                    ->select('*','bancos.id as banco_id','bancoscuentas.id as bancoscuentas_id','conciliados.id as id')
                    ->orderby('fecha_banco','DESC')
                    ->whereBetween('fecha_banco', [($fecha_desde == "") ? $default : $fecha_desde, ($fecha_hasta == '') ? $default2 : $fecha_hasta])
                    ->get();

                $conciliadosTotal = \App\Conciliado::where('aeropuerto_id', '=', session('aeropuerto')->id)
                    ->whereBetween('fecha_banco', [($fecha_desde == "") ? $default : $fecha_desde, ($fecha_hasta == '') ? $default2 : $fecha_hasta])
                    ->sum('monto_banco');

                $conciliadosDif = \App\Conciliado::where('aeropuerto_id', '=', session('aeropuerto')->id)
                    ->whereBetween('fecha_banco', [($fecha_desde == "") ? $default : $fecha_desde, ($fecha_hasta == '') ? $default2 : $fecha_hasta])
                    ->sum('comision_bancaria');

                $conciliadosLot = \App\Conciliado::where('aeropuerto_id', '=', session('aeropuerto')->id)
                    ->whereBetween('fecha_banco', [($fecha_desde == "") ? $default : $fecha_desde, ($fecha_hasta == '') ? $default2 : $fecha_hasta])
                    ->sum('monto_lote');
            }

			return view('conciliacion.partials.table', compact('conciliados','fecha_hasta','fecha_desde','conciliadosTotal','conciliadosLot','conciliadosDif'));
		}
		else{
            $conciliados = \App\Conciliado::where('aeropuerto_id', '=', session('aeropuerto')->id)
                ->join('bancos','bancos.id','=','banco_id')
                ->join('bancoscuentas', 'bancoscuentas.id','=','cuenta_id')
                ->orderby('fecha_banco','DESC')
                ->select('*','bancos.id as banco_id','bancoscuentas.id as bancoscuentas_id','conciliados.id as id')
                ->get();


			return view("conciliacion.index", compact('conciliados','fecha_hasta','fecha_desde'));
		}
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
	public function store(Request $request)
	{
        $movimientos=$request->get('movimientos');
        //dd($movimientos);
		foreach ($movimientos as $movimiento) {


            $origen = explode(',', $movimiento['origen']);
			$cobros = explode(',', $movimiento['cobros']);
			$ids    = explode(',', $movimiento['movimientos']);
			$mov    = new \App\Conciliado();


			$fecha_conciliacion      =\Carbon\Carbon::createFromFormat('d/m/Y', $movimiento["fecha_conciliacion"]);
			$fecha_conciliacion      = $fecha_conciliacion->toDateString();
			$fecha_banco             =\Carbon\Carbon::createFromFormat('d/m/Y', $movimiento["fecha_banco"]);
			$fecha_banco             = $fecha_banco->toDateString();

			$mov->aeropuerto_id      =  session('aeropuerto')->id;
			$mov->fecha_conciliacion =  $fecha_conciliacion;
			$mov->fecha_banco        =  $fecha_banco;
			$mov->monto_lote         =  $this->parseDecimal($movimiento["monto_lote"]);
			$mov->monto_banco        =  $this->parseDecimal($movimiento["monto_banco"]);
			$mov->comision_bancaria  =  $this->parseDecimal($movimiento["comision_bancaria"]);
			$mov->ncomprobante       =  $movimiento["referencia"];
            $mov->cuenta_id          =  $movimiento["cuenta_id"];
            $mov->banco_id           =  $movimiento["banco_id"];





			if($mov->save()){
				foreach ($cobros as $index => $c) {
			        switch ($origen[$index]) {
                        case "C"    : $cobro = \App\Cobro::find($c); $cobro->conciliado_id = $mov->id; $cobro->save(); break;
                        case "T"    : $cobro = \App\TasaCobro::find($c); $cobro->conciliado_id = $mov->id; $cobro->save();break;
                        default: break 2;
			        }
				}

				foreach ($ids as $index => $id){
                    switch ($origen[$index]) {
                        case "C": $m = \App\Cobrospago::find($id); break;
                        case "T": $m = \App\TasaCobroDetalle::find($id); break;
                        default: break 2;
                    }
					$m->update(['conciliado' => true]);
				}
				return response('Conciliación guardada exitósamente.', 200);

	        }else{
                return response("Ocurrió un error generar la conciliación.", 500);
	        }
		}
        return response("Ocurrió un error generar la conciliación.", 500);

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
	    $total  = 0;

        $movimientosCobros = \App\Cobrospago::join('cobros','cobros.id','=','cobrospagos.cobro_id')
                ->select('*','cobros.id as cobros_id','cobrospagos.id as cobrospagos_id','cobrospagos.fecha as cobrospagos_fecha','cobros.fecha as cobros_fecha')
                ->where('cobros.aeropuerto_id','=', session('aeropuerto')->id)
                ->where('cobros.conciliado_id',$id)
                ->where('cobrospagos.conciliado',1)
                ->orderBy('cobros.fecha', 'ASC')
                ->get();
        $movimientosTasas  = \App\TasaCobroDetalle::join('tasa_cobros','tasa_cobros.id','=','tasa_cobro_detalles.tasa_cobro_id')
                ->select('*','tasa_cobros.id as tasa_cobros_id','tasa_cobro_detalles.id as tasa_cobro_detalles_id','tasa_cobro_detalles.fecha as tasa_cobro_detalles_fecha','tasa_cobros.fecha as tasa_cobros_fecha')
                ->where('tasa_cobros.aeropuerto_id','=', session('aeropuerto')->id)
                ->where('tasa_cobro_detalles.conciliado',1)
                ->where('tasa_cobros.conciliado_id',$id)
                ->orderBy('tasa_cobros.fecha', 'ASC')
                ->get();


        foreach ($movimientosCobros as $movimientos) {
            $total += $movimientos->monto;
        }
        foreach ($movimientosTasas as $movimientos) {
            $total += $movimientos->monto;
        }

        return view("conciliacion.partials.show", compact('movimientosCobros','movimientosTasas','total'));
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
		$cobros = \App\Cobro::where('conciliado_id', $id)->get();
        $tasa_cobros = \App\TasaCobro::where('conciliado_id', $id)->get();
		
        if(\App\Conciliado::destroy($id)){

        	foreach ($cobros as $cobro) {
				$cobro->conciliado_id = null;
				$cobro->save();

				foreach ($cobro->pagos as $pago) {
					$pago->conciliado = false;
					$pago->save();
				}
			}
            foreach ($tasa_cobros as $cobro) {
                $cobro->conciliado_id = null;
                $cobro->save();

                foreach ($cobro->detalles as $detalles) {
                    $detalles->conciliado = false;
                    $detalles->save();
                }
            }

            return ["success"=>1, "text" => "Registro eliminado exitósamente."];
        }else{
            return ["success"=>0, "text" => "Error eliminando el registro."];
        }
	}

	public function getMovimientos(Request $request)
	{
		if(count($request->all()) != 0){

			$anno         = $request->get('anno', \Carbon\Carbon::now()->year);
			$banco_id     = $request->get('banco_id');
			$cuenta_id    = $request->get('cuenta_id');
			$tipo         = $request->get('tipo');
			$ncomprobante = $request->get('ncomprobante');
			$cobro_id     = $request->get('cobro_id');
			$total        = 0;
			//$fecha_inicio = $request->get('fecha_inicio');
			//$fecha_fin    = $request->get('fecha_fin');
            $fecha    = $request->get('fecha');
	        $today=\Carbon\Carbon::now();

	        if ($fecha == '') {
	            $fecha = '00/00/0000';
            }

			$movimientosCobros  = \App\Cobrospago::join('cobros','cobros.id','=','cobrospagos.cobro_id')->where('cobros.aeropuerto_id','=', session('aeropuerto')->id)
                                            ->select('*','cobros.id as cobros_id','cobrospagos.id as cobrospagos_id','cobrospagos.fecha as cobrospagos_fecha','cobros.fecha as cobros_fecha')
                                            ->orderBy('cobros.fecha', 'ASC')
                                            ->nombrebanco($banco_id)
											->numerocuenta($cuenta_id)
											->tipo($tipo)
											->referencia($ncomprobante)
											->cobro($cobro_id)
											->Where('conciliado',0)
                                            //->whereBetween('cobrospagos.fecha', [Carbon::createFromFormat('d/m/Y', $fecha_inicio)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $fecha_fin)->format('Y-m-d')])
                                            ->where('cobrospagos.fecha',($fecha == '00/00/0000')?'>':'=', Carbon::createFromFormat('d/m/Y', $fecha)->format('Y-m-d'))
			                                ->get();

            $movimientosTasas = \App\TasaCobroDetalle::join('tasa_cobros','tasa_cobros.id','=','tasa_cobro_detalles.tasa_cobro_id')
                                                ->where('tasa_cobros.aeropuerto_id','=', session('aeropuerto')->id)
                                                ->select('*','tasa_cobros.id as tasa_cobros_id','tasa_cobro_detalles.id as tasa_cobro_detalles_id','tasa_cobro_detalles.fecha as tasa_cobro_detalles_fecha','tasa_cobros.fecha as tasa_cobros_fecha')
                                                ->nombrebanco($banco_id)
												->numerocuenta($cuenta_id)
												->tipo($tipo)
												->referencia($ncomprobante)
                                                ->cobro($cobro_id)
                                                ->Where('conciliado',0)
                                                //->whereBetween('tasa_cobros.fecha', [Carbon::createFromFormat('d/m/Y', $fecha_inicio)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $fecha_fin)->format('Y-m-d')])
                                                ->where('tasa_cobros.fecha',($fecha == '00/00/0000')?'>':'=', Carbon::createFromFormat('d/m/Y', $fecha)->format('Y-m-d'))
                                                ->orderBy('tasa_cobros.fecha', 'ASC')
                                                ->get();


            //$movimientos = array_merge($movimientosCobros, $movimientosTasas);
            //dd($movimientos);
            //dd($movimientosTasas->toSql(), $movimientosTasas->getBindings());
			$movimientos = $movimientosCobros->merge($movimientosTasas);
		}else{
			$anno         = $request->get('anno', \Carbon\Carbon::now()->year);
			$banco_id     = $request->get('banco_id');
			$cuenta_id    = $request->get('cuenta_id');
			$tipo         = $request->get('tipo');
			$ncomprobante = $request->get('ncomprobante');
			$cobro_id     = $request->get('cobro_id');
			//$fecha_inicio = $request->get('fecha_inicio');
			//$fecha_fin    = $request->get('fecha_fin');
            $fecha    = $request->get('fecha');
	        $today=\Carbon\Carbon::now();
			$movimientos = collect([]);
            $movimientosTasas = \App\TasaCobroDetalle::all();
            $movimientosCobros  = \App\Cobrospago::all();
		}

        if ($fecha == '00/00/0000') {
            $fecha = '';
        }

		return view('conciliacion.listMovimientos', compact('movimientos','movimientosCobros', 'movimientosTasas', 'anno', 'banco_id', 'cuenta_id', 'tipo', 'ncomprobante', 'cobro_id', 'fecha', 'today'));
	}

    public function postExportReport(Request $request){


        require_once('../vendor/autoload.php');

        $table          =$request->get('table');

        $mpdf =  new \mPDF('','', 0, '', 9, 9, 16, 16, 15, 15, 'L', 'dejavusans');
        //$mpdf->SetHTMLHeader(asset('<img src="imgs/gobernacion.png"/>', '33', "SERVICIO AUTÓNOMO DE AEROPUERTOS REGIONALES DEL EDO. BOLÍVAR","SAAR BOLÍVAR\n".$gerencia."\n".$departamento);
        $mpdf->SetHTMLHeader('<img style="width: 140px" src="imgs/gobernacion.png"/>');
        //$mpdf->WriteHTML("SERVICIO AUTÓNOMO DE AEROPUERTOS REGIONALES DEL EDO. BOLÍVAR","SAAR BOLÍVAR");
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

        $html = view('pdf.tasas', compact('table', 'tableFirmas'))->render();
        $mpdf->AddPage('L','', '', '', '','5', '5', '25', '15', '3', '3'); // margin footer
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

}
