<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class DiaFeriado extends Model {

	protected $guarded = array();

	protected $table = "dias_feriados";

	public $timestamps = false;

}
