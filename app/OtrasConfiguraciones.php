<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class OtrasConfiguraciones extends Model {

	//
	protected $guarded = [];

		public function aeropuerto()
    { 
        return $this->belongsTo('App\Aeropuerto');
    }
}
