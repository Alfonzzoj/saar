<?php

use Illuminate\Database\Seeder;

class UsuariosTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
        
		\DB::table('usuarios')->insert(array (
			0 => 
			array (
				'id' => 1,
				'username' => 'admin',
				'password' => '$2y$10$IiAw5mwzKZwMjPMP7gv64OBUMHL2INfwOYpZaYxbHPPaS1oJComkm',
				'fullname' => '',
				'estado' => 0,
				'departamento_id' => NULL,
				'aeropuerto_id' => NULL,
				'cargo_id' => NULL,
				'directo' => '',
				'email' => '',
				'remember_token' => '7RAWXVUUPE4tfNZU4ZhhWJcUulWCe1btZ3nSiukdgsrk90HjG9Wx05Jag9rv',
				'created_at' => '2015-07-31 08:12:36',
				'updated_at' => '2015-12-07 20:12:47',
			),
			1 => 
			array (
				'id' => 2,
				'username' => 'supervisor-scv',
				'password' => '$2y$10$hZdmhsjIpdtl0elgxBhg4OIbeTa4EnN6525Gm/ZmtTgrvDCKOZ4Sy',
				'fullname' => 'Supervisor SCV',
				'estado' => 1,
				'departamento_id' => 1,
				'aeropuerto_id' => 1,
				'cargo_id' => 1,
				'directo' => '0000',
				'email' => 'saar@gmail.com',
				'remember_token' => 'Ate9WJDGMcl1BpKn382FipyUJxuOIbRWVPySyyEmpC5DtWJM50v3frWp6bKC',
				'created_at' => '2015-09-01 20:02:49',
				'updated_at' => '2015-09-14 22:28:26',
			),
			2 => 
			array (
				'id' => 3,
				'username' => 'recaudacion',
				'password' => '$2y$10$euqvcZN2k7eP6B6gFfbb.eIfKJ7JaUZMHe8hg9ORz5zWD6uKBIrQ.',
				'fullname' => 'Recaudacion',
				'estado' => 1,
				'departamento_id' => 1,
				'aeropuerto_id' => 1,
				'cargo_id' => 1,
				'directo' => '1234',
				'email' => 'email@gmail.com',
				'remember_token' => 'B75Y0W3frFNjkXwEqzh6gHgcssFIxBBJf4NGRjoi0brkjHCGUJMSUrK2XiS4',
				'created_at' => '2015-09-01 20:48:54',
				'updated_at' => '2015-09-01 21:10:19',
			),
		));
	}

}
