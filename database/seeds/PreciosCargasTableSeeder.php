<?php

use Illuminate\Database\Seeder;

class PreciosCargasTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
        
		\DB::table('precios_cargas')->insert(array (
			0 => 
			array (
				'id' => 1,
				'equivalenteUT' => 0.01000000000000000020816681711721685132943093776702880859375,
				'toneladaPorBloque' => 1,
				'aeropuerto_id' => 1,
				'conceptoCredito_id' => 73,
				'conceptoContado_id' => 59,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2015-12-08 00:12:51',
			),
		));
	}

}
