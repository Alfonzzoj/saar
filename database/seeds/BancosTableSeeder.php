<?php

use Illuminate\Database\Seeder;

class BancosTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
	
        
		\DB::table('bancos')->insert(array (
			0 => 
			array (
				'id' => 1,
				'nombre' => 'Caroni',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			1 => 
			array (
				'id' => 2,
				'nombre' => 'Venezuela',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
		));
	}

}
