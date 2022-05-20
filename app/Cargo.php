<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model {

	public function usuarios()
	{
		return $this->hasMany('App\Usuario');
	}

}
