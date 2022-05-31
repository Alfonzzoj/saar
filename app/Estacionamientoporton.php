<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Estacionamientoporton extends Model {


    protected $fillable = ['nombre'];



    public function estacionamiento()
    {
        return $this->belongsTo('App\Estacionamiento');
    }

}
