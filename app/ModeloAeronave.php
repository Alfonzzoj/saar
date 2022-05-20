<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ModeloAeronave extends Model {

    protected $guarded = [];

	public function tipo()
	{
		return $this->belongsTo('App\TipoAeronave');
	}
	public function aeronave()
	{
		return $this->hasMany('App\Aeronave');
	}



}
