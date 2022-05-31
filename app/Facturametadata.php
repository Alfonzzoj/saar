<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DecimalConverterTrait;

class Facturametadata extends Model {

    use DecimalConverterTrait;

    protected $guarded = array();

    public function factura()
    {
        return $this->belongsTo('App\Factura', 'factura_id', 'nFactura');
    }

    public function setMontoiniciocuotaAttribute($numero)
    {
        $this->parseDecimal($numero,'montoiniciocuota');
    }

    public function setMontopagadoAttribute($numero)
    {
        $this->parseDecimal($numero,'montopagado');
    }

    public function setBasepagadoAttribute($numero)
    {
        $this->parseDecimal($numero,'basepagado');
    }

    public function setIvapagadoAttribute($numero)
    {
        $this->parseDecimal($numero,'ivapagado');
    }

    public function setIslrpercentageAttribute($numero)
    {
        $this->parseDecimal($numero,'islrpercentage');
    }

    public function setIvapercentageAttribute($numero)
    {
        $this->parseDecimal($numero,'ivapercentage');
    }

    public function setRetencionAttribute($numero)
    {
        $this->parseDecimal($numero,'retencion');
    }

    public function setTotalAttribute($numero)
    {
        $this->parseDecimal($numero,'total');
    }
}
