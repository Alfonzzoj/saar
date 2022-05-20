<?php namespace App\Models\Oracle;

use yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class Empresa extends Eloquent {

	protected $connection='oracle';

	protected $table='empresa';

	protected $primaryKey  = 'codemp';
}
