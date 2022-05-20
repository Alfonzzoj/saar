<?php

use Illuminate\Database\Seeder;

class OtrosCargosTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
        
		\DB::table('otros_cargos')->insert(array (
			0 => 
			array (
				'id' => 2,
				'nombre_cargo' => 'hola',
				'precio_cargo' => 12345,
				'aeropuerto_id' => 1,
				'conceptoCredito_id' => 67,
				'conceptoContado_id' => 67,
				'created_at' => '2015-11-25 16:28:07',
				'updated_at' => '2015-11-25 16:28:07',
			),
			1 => 
			array (
				'id' => 3,
				'nombre_cargo' => 'nuevo',
				'precio_cargo' => 1500,
				'aeropuerto_id' => 1,
				'conceptoCredito_id' => 67,
				'conceptoContado_id' => 67,
				'created_at' => '2015-12-08 20:35:45',
				'updated_at' => '2015-12-08 20:35:45',
			),
		));
	}

}
