<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model {

	    public function usuarios()
    {
        return $this->hasMany('App\Usuario');
    }

}
