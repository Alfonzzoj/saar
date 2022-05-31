<?php

use Illuminate\Database\Seeder;

class HorariosAeronauticosTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
        
		\DB::table('horarios_aeronauticos')->insert(array (
			0 => 
			array (
				'id' => 1,
				'operaciones_inicio' => '05:00:00',
				'operaciones_fin' => '23:59:00',
				'sol_salida' => '05:00:00',
				'sol_puesta' => '17:30:00',
				'aeropuerto_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
		));
	}

}
