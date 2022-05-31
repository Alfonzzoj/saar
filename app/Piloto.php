<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Piloto extends Model {


     protected $guarded = [];

	//
	public function nacionalidad()
	{
		return $this->belongsTo('App\Pais');
	}
	public function aterrizaje()
	{
		return $this->belongsTo('App\Aterrizaje');
	}
	public function despegue()
	{
		return $this->belongsTo('App\Despegue');
	}
}
