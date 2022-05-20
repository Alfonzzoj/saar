<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class NacionalidadMatricula extends Model {

	//
	protected $guarded = [];

	public function aeronave()
    {
        return $this->hasMany('App\Aeronave');
    }

}
