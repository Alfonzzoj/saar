<?php

use Illuminate\Database\Seeder;

class AterrizajesTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
        
		\DB::table('aterrizajes')->insert(array (
			0 => 
			array (
				'id' => 1,
				'hora' => '21:00:30',
				'fecha' => '2015-12-20',
				'aeropuerto_id' => 1,
				'aeronave_id' => 6,
				'cliente_id' => 13,
				'tipoMatricula_id' => 3,
				'nacionalidadVuelo_id' => 1,
				'piloto_id' => 9,
				'num_vuelo' => 123,
				'puerto_id' => 4,
				'desembarqueAdultos' => 100,
				'desembarqueInfante' => 2,
				'desembarqueTercera' => 0,
				'desembarqueTransito' => 0,
				'despego' => 0,
				'created_at' => '2015-12-21 01:30:48',
				'updated_at' => '2015-12-21 01:30:48',
			),
			1 => 
			array (
				'id' => 2,
				'hora' => '21:01:20',
				'fecha' => '2015-12-20',
				'aeropuerto_id' => 1,
				'aeronave_id' => 52,
				'cliente_id' => NULL,
				'tipoMatricula_id' => 4,
				'nacionalidadVuelo_id' => NULL,
				'piloto_id' => NULL,
				'num_vuelo' => 0,
				'puerto_id' => NULL,
				'desembarqueAdultos' => 0,
				'desembarqueInfante' => 0,
				'desembarqueTercera' => 0,
				'desembarqueTransito' => 0,
				'despego' => 0,
				'created_at' => '2015-12-21 01:31:29',
				'updated_at' => '2015-12-21 01:31:29',
			),
			2 => 
			array (
				'id' => 3,
				'hora' => '21:01:32',
				'fecha' => '2015-12-20',
				'aeropuerto_id' => 1,
				'aeronave_id' => 25,
				'cliente_id' => 24,
				'tipoMatricula_id' => 1,
				'nacionalidadVuelo_id' => 1,
				'piloto_id' => 8,
				'num_vuelo' => 234,
				'puerto_id' => 5,
				'desembarqueAdultos' => 3,
				'desembarqueInfante' => 2,
				'desembarqueTercera' => 0,
				'desembarqueTransito' => 0,
				'despego' => 0,
				'created_at' => '2015-12-21 01:31:49',
				'updated_at' => '2015-12-21 01:31:49',
			),
		));
	}

}
