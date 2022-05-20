<?php namespace App\Models\Oracle;

use yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class Factura extends Eloquent {

	protected $connection='oracle';

	protected $table='facturas';

	protected $primaryKey  = 'codemp';
}
