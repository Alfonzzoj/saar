<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\DecimalConverterTrait;
use App\Traits\DateConverterTrait;

class Factura extends Model {

    use DateConverterTrait;
    use DecimalConverterTrait;
    use SoftDeletes;

    protected $guarded = array();

    protected $dates = ['fecha', 'fechaVencimiento', 'deleted_at'];

    public static function getMaxWith($prefixColumn, $column, $searchPrefix){
        $aeropuertoSigla=session('aeropuerto')->siglas;
        $max=config("facturas.$column.$aeropuertoSigla.$searchPrefix");
        return max($max,\DB::table('facturas')->where($prefixColumn,$searchPrefix)->groupby($prefixColumn)->max($column)+1);
    }

    public function detalles()
    {
        return $this->hasMany('App\Facturadetalle');
    }

    public function metadata()
    {
        return $this->hasOne('App\Facturametadata');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }

    public function aterrizaje()
    {
        return $this->belongsTo('App\Aterrizaje');
    }

    public function cobros()
    {
        return $this->belongsToMany('App\Cobro', 'cobro_factura', 'factura_id', 'cobro_id')
            ->withPivot('monto',
                'retencionFecha',
                'retencionComprobante',
                'base',
                'iva',
                'islrpercentage',
                'ivapercentage',
                'retencion',
                'total')
            ->withTimestamps();
    }

    public function aeropuerto()
    {
        return $this->belongsTo('App\Aeropuerto');
    }

    public function modulo()
    {
        return $this->belongsTo('App\Modulo');
    }

    public function despegue()
    {
        return $this->hasOne('App\Despegue');
    }

    public function carga()
    {
        return $this->hasOne('App\Carga');
    }

    public function setFechaAttribute($fecha)
    {
        $this->setFecha($fecha,'fecha');
    }
    public function getFechaAttribute($fecha)
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

    public function setFechaControlContratoAttribute($fecha)
    {
        $this->setFecha($fecha,'fechaControlContrato');
    }
    public function getFechaControlContratoAttribute($fecha)
    {
        return $this->getFecha($fecha);
    }

    public function setSubtotalNetoAttribute($numero)
    {
        $this->parseDecimal($numero,'subtotalNeto');
    }

    public function setDescuentoTotalAttribute($numero)
    {
        $this->parseDecimal($numero,'descuentoTotal');
    }

    public function setSubtotalAttribute($numero)
    {
        $this->parseDecimal($numero,'subtotal');
    }

    public function setIvaAttribute($numero)
    {
        $this->parseDecimal($numero,'iva');
    }

    public function setRecargoTotalAttribute($numero)
    {
        $this->parseDecimal($numero,'recargoTotal');
    }

    public function setTotalAttribute($numero)
    {
        $this->parseDecimal($numero,'total');
    }
}
