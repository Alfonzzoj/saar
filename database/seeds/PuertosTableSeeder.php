<?php

use Illuminate\Database\Seeder;

class PuertosTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('puertos')->delete();
        
		\DB::table('puertos')->insert(array (
			0 => 
			array (
				'id' => 1,
				'nombre' => 'ARUBA',
				'siglas' => 'TNCA',
				'estado' => 1,
				'pais_id' => 15,
				'created_at' => '2015-09-02 20:45:27',
				'updated_at' => '2015-12-07 23:37:25',
			),
			1 => 
			array (
				'id' => 3,
				'nombre' => 'SIMÓN BOLIVAR',
				'siglas' => 'SVMI',
				'estado' => 1,
				'pais_id' => 232,
				'created_at' => '2015-12-07 23:38:06',
				'updated_at' => '2015-12-07 23:38:06',
			),
			2 => 
			array (
				'id' => 4,
				'nombre' => 'BARCELONA',
				'siglas' => 'SVBC',
				'estado' => 1,
				'pais_id' => 232,
				'created_at' => '2015-12-07 23:38:34',
				'updated_at' => '2015-12-07 23:38:34',
			),
			3 => 
			array (
				'id' => 5,
				'nombre' => 'CHARALLAVE',
				'siglas' => 'SVCS',
				'estado' => 1,
				'pais_id' => 232,
				'created_at' => '2015-12-07 23:39:05',
				'updated_at' => '2015-12-07 23:39:05',
			),
			4 => 
			array (
				'id' => 6,
				'nombre' => 'VALENCIA',
				'siglas' => 'SVVA',
				'estado' => 1,
				'pais_id' => 232,
				'created_at' => '2015-12-16 13:50:01',
				'updated_at' => '2015-12-16 13:50:01',
			),
		));
	}

}
