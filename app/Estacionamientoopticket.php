<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DateConverterTrait;

class Estacionamientoopticket extends Model {

    use DateConverterTrait;

    protected $fillable = ['econcepto_id', 'taquilla', 'turno', 'costo', 'cantidad', 'monto'];

    protected $hidden = ['created_at', 'updated_at'];

    public function setFechaAttribute($fecha)
    {
        $this->setFecha($fecha,'fecha');
    }

    public function concepto()
    {
        return $this->belongsTo('App\Estacionamientoconcepto', 'econcepto_id');
    }

    public function operacion()
    {
        return $this->belongsTo('App\Estacionamientoop', 'estacionamientoop_id');
    }



}
