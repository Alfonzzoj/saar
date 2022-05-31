<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DateConverterTrait;

class RecibosAnulado extends Model {

	use DateConverterTrait;
    protected $guarded = array();

    public function cobro()
    {
        return $this->belongsTo('App\Cobro');
    }

    public function getFechaAttribute($fecha)
    {
        return $this->getFecha($fecha);
    }
}
