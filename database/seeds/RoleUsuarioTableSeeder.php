<?php

use Illuminate\Database\Seeder;

class RoleUsuarioTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
        
		\DB::table('role_usuario')->insert(array (
			0 => 
			array (
				'id' => 1,
				'role_id' => 1,
				'usuario_id' => 1,
				'created_at' => '2015-07-31 09:38:02',
				'updated_at' => '2015-07-31 09:38:02',
			),
			1 => 
			array (
				'id' => 2,
				'role_id' => 2,
				'usuario_id' => 2,
				'created_at' => '2015-09-01 20:04:25',
				'updated_at' => '2015-09-01 20:04:25',
			),
			2 => 
			array (
				'id' => 3,
				'role_id' => 3,
				'usuario_id' => 3,
				'created_at' => '2015-09-01 20:49:39',
				'updated_at' => '2015-09-01 20:49:39',
			),
		));
	}

}
