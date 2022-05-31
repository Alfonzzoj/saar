<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DateConverterTrait;

class Cliente extends Model {

    use DateConverterTrait;

    protected $guarded = array();

    public function aeronave()
    {
        return $this->hasMany('App\Aeronave');
    }

    public function contratos()
    {
        return $this->hasMany('App\Contrato');
    }

    public function hangars()
    {
        return $this->belongsToMany('App\Hangar');
    }

    public function ajustes()
    {
        return $this->hasMany('App\Ajuste');
    }
    public function setFechaIngresoAttribute($fecha)
    {
        $this->setFecha($fecha,'fechaIngreso');
    }

    public function getFechaIngresoAttribute($fecha)
    {
        return $this->getFecha($fecha);
    }

    public function getRifAttribute($fecha)
    {
        return $this->attributes['cedRifPrefix'].'-'.$this->attributes['cedRif'];
    }

    public function aterrizaje()
    {
        return $this->hasMany('App\Aterrizaje');
    }

    public function despegue()
    {
        return $this->hasMany('App\Despegue');
    }

    public function carga()
    {
        return $this->hasMany('App\Carga');
    }
    
}
