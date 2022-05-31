<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class NacionalidadVuelo extends Model {

	//
	protected $guarded = [];

	
  public function aterrizaje()
    {
        return $this->hasMany('App\Aterrizaje', 'nacionalidadVuelo_id', 'id');
    }

	public function despegue()
    {
        return $this->hasMany('App\Despegue');
    }
}
