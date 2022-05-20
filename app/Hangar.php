<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Hangar extends Model {
    protected $guarded = [];

    public function aeronaves()
    {
        return $this->hasMany('App\Aeronave');
    }

    public function aeropuerto()
    {
        return $this->belongsTo('App\Aeropuerto');
    }

    public function clientes()
    {
        return $this->belongsToMany('App\Cliente');
    }
    


}
