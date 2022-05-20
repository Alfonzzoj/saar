<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DateConverterTrait;


class Tasaop extends Model {

    use DateConverterTrait;

    protected $guarded = array();

    public function detalles()
    {
        return $this->hasMany('App\Tasaopdetalle');
    }

    public function cobro()
    {
        return $this->belongsTo('App\TasaCobro', 'tasa_cobro_id');
    }
    
  /*  public function getFechaAttribute($fecha)
    {
        return $this->getFecha($fecha);
    }*/
}
