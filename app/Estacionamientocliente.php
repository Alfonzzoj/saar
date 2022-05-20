<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Estacionamientocliente extends Model {

    protected $fillable = ['nombre', 'cantidad', 'costoUnidad', 'fechaSuscripcion', 'isActivo'];

    public function estacionamiento()
    {
        return $this->belongsTo('App\Estacionamiento');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }
}
