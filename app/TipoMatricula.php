<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoMatricula extends Model {

	protected $guarded = [];

	public function aeronave()
	{
		return $this->hasMany('App\Aeronave');
	}
	public function aterrizaje()
	{
		return $this->hasMany('App\Aterrizaje', 'tipoMatricula_id', 'id');
	}
	public function despegue()
	{
		return $this->hasMany('App\Despegue', 'tipoMatricula_id', 'id');
	}

}
