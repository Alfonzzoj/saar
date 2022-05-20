<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DateConverterTrait;

class Pasajero extends Model {

    use DateConverterTrait;

    protected $guarded = array();

      public $timestamps = false;

    public function despegue()
    {
        return $this->belongsTo('App\Despegue');
    }
}
