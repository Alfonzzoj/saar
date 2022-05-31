<?php namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {
    protected $meses=[
        "1"=>"ENERO",
        "2"=>"FEBRERO",
        "3"=>"MARZO",
        "4"=>"ABRIL",
        "5"=>"MAYO",
        "6"=>"JUNIO",
        "7"=>"JULIO",
        "8"=>"AGOSTO",
        "9"=>"SEPTIEMBRE",
        "10"=>"OCTUBRE",
        "11"=>"NOVIEMBRE",
        "12"=>"DICIEMBRE"];
	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		'App\Console\Commands\Inspire',
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
        $schedule->call(function () {
            $hoy=\Carbon\Carbon::now();
            $fechaFin=\Carbon\Carbon::now()->lastOfMonth();
            $contratos=\App\Contrato::where('fechaInicio', '<=' ,$hoy)
                ->where('fechaVencimiento', '>=', $hoy)
                ->where('isGeneracionAutomaticaFactura', true)
                ->where('diaGeneracion', $hoy->day)
                ->whereDoesntHave('facturas', function($query) use ($fechaFin){
                    $query->where('fechaControlContrato', $fechaFin);
                })->get();
            foreach($contratos as $contrato){

                \DB::transaction(function () use ($contrato, $fechaFin, $hoy) {
                    $concepto=$contrato->concepto;
                    $modulo=$concepto->modulo;
                    $f = new \App\Factura();
                    $f->aeropuerto_id=$contrato->concepto->aeropuerto_id;
                    $f->condicionPago='Crédito';
                    $f->nFacturaPrefix = $modulo->nFacturaPrefix;
                    $f->nControlPrefix = $modulo->numeroControlPrefix;
                    //este numero de control no se puede calcular
                    $f->nControl = "";
                    $f->fechaControlContrato=$fechaFin;
                    $f->fecha = $hoy->format('d/m/Y');
                    $f->fechaVencimiento = $fechaFin->format('d/m/Y');
                    $f->cliente_id = $contrato->cliente_id;
                    $f->modulo_id = $modulo->id;
                    $f->contrato_id = $contrato->id;
                    $monto=($contrato->montoTipo=="Mensual")?$contrato->monto:$contrato->monto/12;
                    $subtotal = ($monto / (1 + floatval(config('app.iva')) / 100));
                    $f->subtotalNeto = $subtotal;
                    $f->descuentoTotal = 0;
                    $f->subtotal = $subtotal;
                    $f->iva = $monto - $subtotal;
                    $f->recargoTotal = 0;
                    $f->total = $monto;
                    $f->estado='P';
                    if($modulo->nombre=="CANON"){
                        $hoy=\Carbon\Carbon::now();
                        $f->descripcion="PERIODO ".$this->meses[$hoy->month]." $hoy->year  PATENTE: 2010-AG1845";
                    }
                    if($f->save()){
                        $f->detalles()->create([
                            "concepto_id" => $concepto->id,
                            "cantidadDes" => "1",
                            "montoDes" => $subtotal,
                            "descuentoPerDes" => 0,
                            "descuentoTotalDes" =>0,
                            "ivaDes" => config('app.iva'),
                            "recargoPerDes" => 0,
                            "recargoTotalDes" =>0,
                            "totalDes" => $f->total
                        ]);
                    }
                });
            }
            $contratos=\App\Contrato::where('fechaVencimiento', $hoy)
                ->where('isReanudacionAutomatica', true)->get();
            foreach($contratos as $contrato){
                $meses=$contrato->mesesReanudacion;
                $nuevaFecha=\Carbon\Carbon::now()->addMonth($meses);
                $contrato->update(['fechaVencimiento' => $nuevaFecha]);
            }
        })->daily();
	}

}
