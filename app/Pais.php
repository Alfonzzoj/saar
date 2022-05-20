<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model {

	public function puerto()
    {
        return $this->hasMany('App\Puerto');
    }

	public function piloto()
    {
        return $this->hasMany('App\Piloto');
    }

}
