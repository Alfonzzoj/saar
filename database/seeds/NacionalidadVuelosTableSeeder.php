<?php

use Illuminate\Database\Seeder;

class NacionalidadVuelosTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
        
		\DB::table('nacionalidad_vuelos')->insert(array (
			0 => 
			array (
				'id' => 1,
				'siglas' => 'V',
				'nombre' => 'Nacional',
				'created_at' => '2015-10-05 21:43:59',
				'updated_at' => '2015-10-05 21:43:59',
			),
			1 => 
			array (
				'id' => 2,
				'siglas' => 'I',
				'nombre' => 'Internacional',
				'created_at' => '2015-10-05 21:44:12',
				'updated_at' => '2015-10-05 21:44:12',
			),
		));
	}

}
