<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DecimalConverterTrait;

class Concepto extends Model {

    use DecimalConverterTrait;

    protected $guarded = array();

    public function modulo()
    {
        return $this->belongsTo('App\Modulo');
    }
    public function aeropuerto()
    {
        return $this->belongsTo('App\Aeropuerto');
    }
    public function facturadetalles()
    {
        return $this->hasMany('App\Facturadetalle');
    }
    
    public function aterrizaje()
    {
        return $this->hasOne('App\PreciosAterrizajesDespegue');
    }
    
    public function estacionamiento()
    {
        return $this->hasOne('App\EstacionamientoAeronave');
    }
    public function cargos_varios()
    {
        return $this->hasOne('App\CargosVario');
    }
    public function carga()
    {
        return $this->hasOne('App\PreciosCarga');
    }

    public function otros_cargos()
    {
        return $this->hasOne('App\OtrosCargo');
    }

    public function setIvaAttribute($numero)
    {
        $this->parseDecimal($numero,'iva');
    }
}
