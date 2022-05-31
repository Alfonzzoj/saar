<?php

use Illuminate\Database\Seeder;

class EstacionamientoAeronavesTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
        
		\DB::table('estacionamiento_aeronaves')->insert(array (
			0 => 
			array (
				'id' => 1,
				'tiempoLibreInt' => 120,
				'eq_bloqueInt' => 0.09810000000000000663913368725843611173331737518310546875,
				'minBloqueInt' => 60,
				'tiempoLibreNac' => 60,
				'eq_bloqueNac' => 0.0748000000000000053734794391857576556503772735595703125,
				'minBloqueNac' => 60,
				'aeropuerto_id' => 1,
				'conceptoCredito_id' => 69,
				'conceptoContado_id' => 55,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2015-12-08 00:36:40',
			),
		));
	}

}
