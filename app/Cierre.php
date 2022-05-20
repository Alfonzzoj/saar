<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DateConverterTrait;
use App\Traits\DecimalConverterTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meta extends Model {


    use DateConverterTrait;
    use DecimalConverterTrait;
    use SoftDeletes;

    protected $guarded = [];

    public function getFechaInicioAttribute($fecha)
    {
        return $this->getFecha($fecha);
    }
    public function setFechaInicioAttribute($fecha)
    {
        $this->setFecha($fecha,'fecha_inicio');
    }

    public function getFechaFinAttribute($fecha)
    {
        return $this->getFecha($fecha);
    }
    public function setFechaFinAttribute($fecha)
    {
        $this->setFecha($fecha,'fecha_fin');
    }


    public function setMontoGobernacionAttribute($numero)
    {
        $this->parseDecimal($numero,'montoGobernacion');
    }

    public function setMontoSaarAttribute($numero)
    {
        $this->parseDecimal($numero,'montoSaar');
    }

    public function detalles()
    {
        return $this->hasMany('App\MetaDetalle');
    }

    public function aeropuerto()
    {
        return $this->belongsTo('App\Aeropuerto');
    }
}
