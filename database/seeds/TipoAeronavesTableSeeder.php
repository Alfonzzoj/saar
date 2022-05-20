<?php

use Illuminate\Database\Seeder;

class TipoAeronavesTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
        
		\DB::table('tipo_aeronaves')->insert(array (
			0 => 
			array (
				'id' => 1,
				'nombre' => 'Helicóptero',
				'created_at' => '2015-08-25 22:26:26',
				'updated_at' => '2015-08-25 22:26:26',
			),
			1 => 
			array (
				'id' => 2,
				'nombre' => 'Avión',
				'created_at' => '2015-08-25 22:26:31',
				'updated_at' => '2015-08-25 22:26:31',
			),
		));
	}

}
