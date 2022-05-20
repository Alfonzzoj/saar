<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
        
		\DB::table('roles')->insert(array (
			0 => 
			array (
				'id' => 1,
				'name' => 'Admin',
				'slug' => 'admin',
				'description' => '',
				'level' => 1,
				'created_at' => '2015-07-31 09:37:13',
				'updated_at' => '2015-08-04 20:54:35',
			),
			1 => 
			array (
				'id' => 2,
				'name' => 'SCV',
				'slug' => 'scv',
				'description' => '',
				'level' => 1,
				'created_at' => '2015-09-01 20:04:18',
				'updated_at' => '2015-09-01 20:04:18',
			),
			2 => 
			array (
				'id' => 3,
				'name' => 'recaudacion',
				'slug' => 'recaudacion',
				'description' => '',
				'level' => 1,
				'created_at' => '2015-09-01 20:49:32',
				'updated_at' => '2015-09-01 20:49:32',
			),
		));
	}

}
