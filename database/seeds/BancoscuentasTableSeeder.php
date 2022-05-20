<?php

use Illuminate\Database\Seeder;

class BancoscuentasTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
        
		\DB::table('bancoscuentas')->insert(array (
			0 => 
			array (
				'id' => 1,
				'descripcion' => '11111111111111111',
				'isActivo' => 1,
				'banco_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			1 => 
			array (
				'id' => 2,
				'descripcion' => '22222222222222222222',
				'isActivo' => 1,
				'banco_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
		));
	}

}
