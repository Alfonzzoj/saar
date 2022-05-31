<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Aeropuerto extends Model {

    protected $guarded = [];

    public function conceptos(){

        return $this->hasMany('App\Concepto');
    }

    public function estacionamiento()
    {
        return $this->hasOne('App\Estacionamiento');
    }

    public function otras_configuraciones()
    {
        return $this->hasOne('App\otrasConfiguraciones');
    }

    public function tasas()
    {
        return $this->hasMany('App\Tasa');
    }

    public function hangar()
    {
        return $this->hasMany('App\Hangar');
    }

    public function metas()
    {
        return $this->hasMany('App\Meta');
    }


    public function usuarios()
    {
        return $this->belongsToMany('App\Usuario');
    }

    public function aterrizaje()
    {
        return $this->hasMany('App\Aterrizaje');
    }

    public function despegue()
    {
        return $this->hasMany('App\Despegue');
    }

    public function recibo()
    {
        return $this->hasMany('App\ReciboPago');
    }

    public function carga()
    {
        return $this->hasMany('App\Carga');
    }


    public function Aeronave()
    {
        return $this->hasMany('App\Aeronave');
    }

    public function modulos()
    {
        return $this->hasMany('App\Modulo');
    }
}
