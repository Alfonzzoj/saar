<?php

use Illuminate\Database\Seeder;

class MontosFijosTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
        
		\DB::table('montos_fijos')->insert(array (
			0 => 
			array (
				'id' => 1,
				'unidad_tributaria' => 150,
				'dolar_oficial' => 195.25,
				'aeropuerto_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2015-10-14 20:06:03',
			),
		));
	}

}
