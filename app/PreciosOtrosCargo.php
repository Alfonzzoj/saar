<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PerciosOtrosCargo extends Model {

	protected $guarded = [];

	public function conceptos()
    { 
        return $this->belongsTo('App\Concepto');
    }


    public function otrosCargos()
    {
        return $this->hasMany('App\OtrosCargos');
    }

    public function despegue()
    {
        return $this->hasMany('App\Despegue');
    }

}
