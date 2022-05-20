<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DateConverterTrait;
use App\Traits\DecimalConverterTrait;


class Carga extends Model {

    use DateConverterTrait;
    use DecimalConverterTrait;

	protected $guarded = array();

	public function setFechaAttribute($fecha)
	{
        $this->setFecha($fecha,'fecha');
	}

	public function getFechaAttribute($fecha)
	{
        return $this->getFecha($fecha);
	}

	public function aeronave()
	{
		return $this->belongsTo('App\Aeronave');
	}

	public function cliente()
	{
		return $this->belongsTo('App\Cliente');
	}

	public function precio()
	{
		return $this->belongsTo('App\PreciosCarga');
	}
	    public function aeropuerto()
    {
        return $this->belongsTo('App\Aeropuerto');
    }
        public function factura()
    {
        return $this->belongsTo('App\Factura');
    }




}

