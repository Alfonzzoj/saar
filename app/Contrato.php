<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DecimalConverterTrait;
use App\Traits\DateConverterTrait;

class Contrato extends Model {

    use DecimalConverterTrait;
    use DateConverterTrait;

    protected $guarded = array();

    public function setFechaInicioAttribute($fecha)
    {
        $this->setFecha($fecha,'fechaInicio');
    }
    public function getFechaInicioAttribute($fecha)
    {
        return $this->getFecha($fecha);
    }
    public function setFechaVencimientoAttribute($fecha)
    {
        $this->setFecha($fecha,'fechaVencimiento');
    }
    public function getFechaVencimientoAttribute($fecha)
    {
        return $this->getFecha($fecha);
    }

    public function concepto()
    {
        return $this->belongsTo('App\Concepto');
    }
    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }
    public function facturas()
    {
        return $this->hasMany('App\Factura');
    }
    public function hasFacturaByFecha($year, $month){
        $fechaFin=\Carbon\Carbon::create($year, $month, 1)->lastOfMonth();
        return $this->facturas()->where('fechaControlContrato', $fechaFin)->count();
    }

    public function setMontoAttribute($numero)
    {
        $this->parseDecimal($numero,'monto');
    }

}
