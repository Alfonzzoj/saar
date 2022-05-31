<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoAeronave extends Model {

    protected $guarded = [];

    public function modelo_aeronave()
    {
        return $this->hasMany('App\ModeloAeronave');
    }


}
