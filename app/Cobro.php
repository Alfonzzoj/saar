<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DateConverterTrait;
use App\Traits\DecimalConverterTrait;

class Cobro extends Model {

    use DateConverterTrait;
    use DecimalConverterTrait;

    protected $guarded = array();


    public function ajustes()
    {
        return $this->hasMany('App\Ajuste');
    }

    public function pagos()
    {
        return $this->hasMany('App\Cobrospago');
    }

    public function recibosAnulados()
    {
        return $this->hasMany('App\RecibosAnulado');
    }

    public function facturas()
    {
        return $this->belongsToMany('App\Factura', 'cobro_factura', 'cobro_id', 'factura_id')
            ->withPivot('monto',
            'retencionFecha',
            'retencionComprobante',
            'base',
            'iva',
            'islrpercentage',
            'ivapercentage',
            'retencion',
            'total')-> withTimestamps();
    }

    public function getCreatedAtAttribute($fecha)
    {
        return $this->getFecha($fecha);
    }

    public function cliente(){
        return $this->belongsTo('App\Cliente');
    }

    public function modulo(){
        return $this->belongsTo('App\Modulo');
    }

    public function setMontofacturasAttribute($numero)
    {
        $this->parseDecimal($numero,'montofacturas');
    }

    public function setMontodepositadoAttribute($numero)
    {
        $this->parseDecimal($numero,'montodepositado');
    }
    
    public function setFechaAttribute($fecha)
    {
        $this->setFecha($fecha,'fecha');
    }

    public function getFechaAttribute($fecha)
    {
        return $this->getFecha($fecha);
    }

    public function conciliado()
    {
        return $this->belongsTo('App\Conciliado');
    }

}
