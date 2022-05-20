<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DecimalConverterTrait;

class Estacionamiento extends Model {

    use DecimalConverterTrait;


    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['nTurnos', 'nTaquillas', 'tarjetacosto'];


    public function portons()
    {
        return $this->hasMany('App\Estacionamientoporton', 'estacionamiento_id');
    }

    public function conceptos()
    {
        return $this->hasMany('App\Estacionamientoconcepto', 'estacionamiento_id');
    }

    public function clientes()
    {
        return $this->hasMany('App\Estacionamientocliente', 'estacionamiento_id');
    }

    public function operaciones(){
        return $this->hasMany('App\Estacionamientoop', 'estacionamiento_id');
    }


    public function setTarjetacostoAttribute($numero)
    {
        $this->parseDecimal($numero,'tarjetacosto');
    }
}
