<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\DecimalConverterTrait;

class Facturadetalle extends Model {

    use DecimalConverterTrait;

    protected $guarded = array();

    public function factura()
    {
        return $this->belongsTo('App\Factura', 'factura_id', 'nFactura');
    }
    public function concepto()
    {
        return $this->belongsTo('App\Concepto');
    }

    public function setCantidadDesAttribute($numero)
    {
        $this->parseDecimal($numero,'cantidadDes');
    }

    public function setMontoDesAttribute($numero)
    {
        $this->parseDecimal($numero,'montoDes');
    }

    public function setDescuentoPerDesAttribute($numero)
    {
        $this->parseDecimal($numero,'descuentoPerDes');
    }

    public function setDescuentoTotalDesAttribute($numero)
    {
        $this->parseDecimal($numero,'descuentoTotalDes');
    }

    public function setIvaDesAttribute($numero)
    {
        $this->parseDecimal($numero,'ivaDes');
    }

    public function setRecargoPerDesAttribute($numero)
    {
        $this->parseDecimal($numero,'recargoPerDes');
    }

    public function setRecargoTotalDesAttribute($numero)
    {
        $this->parseDecimal($numero,'recargoTotalDes');
    }

    public function setTotalDesAttribute($numero)
    {
        $this->parseDecimal($numero,'totalDes');
    }

}
