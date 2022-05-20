<?php

use Illuminate\Database\Seeder;

class PreciosAterrizajesDespeguesTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
        
		\DB::table('precios_aterrizajes_despegues')->insert(array (
			0 => 
			array (
				'id' => 1,
				'eq_diurnoNac' => 0.409999999999999975575093458246556110680103302001953125,
				'eq_diurnoInt' => 0.84999999999999997779553950749686919152736663818359375,
				'eq_nocturNac' => 0.4899999999999999911182158029987476766109466552734375,
				'eq_nocturInt' => 1.649999999999999911182158029987476766109466552734375,
				'aeropuerto_id' => 1,
				'conceptoCredito_id' => 68,
				'conceptoContado_id' => 54,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2015-12-11 16:41:16',
			),
		));
	}

}
