<?php

use Illuminate\Database\Seeder;

class HangarsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
        
		\DB::table('hangars')->insert(array (
			0 => 
			array (
				'id' => 2,
				'nombre' => '1-A',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 20:20:52',
				'updated_at' => '2015-09-10 20:20:52',
			),
			1 => 
			array (
				'id' => 5,
				'nombre' => '4-A',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:32:04',
				'updated_at' => '2015-09-10 21:32:04',
			),
			2 => 
			array (
				'id' => 6,
				'nombre' => '5-A',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:32:11',
				'updated_at' => '2015-09-10 21:32:11',
			),
			3 => 
			array (
				'id' => 7,
				'nombre' => '6-A',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:32:20',
				'updated_at' => '2015-09-10 21:32:20',
			),
			4 => 
			array (
				'id' => 8,
				'nombre' => '7-A',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:32:37',
				'updated_at' => '2015-09-10 21:32:37',
			),
			5 => 
			array (
				'id' => 9,
				'nombre' => '8-A',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:32:43',
				'updated_at' => '2015-09-10 21:32:43',
			),
			6 => 
			array (
				'id' => 10,
				'nombre' => '9-A',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:33:45',
				'updated_at' => '2015-09-10 21:33:45',
			),
			7 => 
			array (
				'id' => 11,
				'nombre' => '10-A',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:33:54',
				'updated_at' => '2015-09-10 21:33:54',
			),
			8 => 
			array (
				'id' => 12,
				'nombre' => '11-A',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:34:03',
				'updated_at' => '2015-09-10 21:34:03',
			),
			9 => 
			array (
				'id' => 13,
				'nombre' => '1-B',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:34:20',
				'updated_at' => '2015-09-10 21:34:20',
			),
			10 => 
			array (
				'id' => 14,
				'nombre' => '2-B',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:34:27',
				'updated_at' => '2015-09-10 21:34:27',
			),
			11 => 
			array (
				'id' => 15,
				'nombre' => '3-B',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:34:34',
				'updated_at' => '2015-09-10 21:34:34',
			),
			12 => 
			array (
				'id' => 16,
				'nombre' => '4-B',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:34:41',
				'updated_at' => '2015-09-10 21:37:54',
			),
			13 => 
			array (
				'id' => 17,
				'nombre' => '5-B',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:34:52',
				'updated_at' => '2015-09-10 21:34:52',
			),
			14 => 
			array (
				'id' => 19,
				'nombre' => '2-A',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:45:32',
				'updated_at' => '2015-09-10 21:45:32',
			),
			15 => 
			array (
				'id' => 20,
				'nombre' => '3-A',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:45:45',
				'updated_at' => '2015-09-10 21:45:45',
			),
			16 => 
			array (
				'id' => 21,
				'nombre' => '6-B',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:46:49',
				'updated_at' => '2015-09-10 21:46:49',
			),
			17 => 
			array (
				'id' => 22,
				'nombre' => '7-B',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:47:12',
				'updated_at' => '2015-09-10 21:47:12',
			),
			18 => 
			array (
				'id' => 23,
				'nombre' => '8-B',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:47:28',
				'updated_at' => '2015-09-10 21:47:28',
			),
			19 => 
			array (
				'id' => 24,
				'nombre' => '9-B',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:47:34',
				'updated_at' => '2015-09-10 21:47:34',
			),
			20 => 
			array (
				'id' => 25,
				'nombre' => '10-B',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:47:46',
				'updated_at' => '2015-09-10 21:47:46',
			),
			21 => 
			array (
				'id' => 26,
				'nombre' => '11-B',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:48:03',
				'updated_at' => '2015-09-10 21:48:03',
			),
			22 => 
			array (
				'id' => 27,
				'nombre' => '12-B',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:48:16',
				'updated_at' => '2015-09-10 21:48:16',
			),
			23 => 
			array (
				'id' => 28,
				'nombre' => '13-B',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:48:51',
				'updated_at' => '2015-09-10 21:48:51',
			),
			24 => 
			array (
				'id' => 29,
				'nombre' => '14-B',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:48:59',
				'updated_at' => '2015-09-10 21:48:59',
			),
			25 => 
			array (
				'id' => 30,
				'nombre' => '1-C',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:49:26',
				'updated_at' => '2015-09-10 21:49:26',
			),
			26 => 
			array (
				'id' => 31,
				'nombre' => '2-C',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:49:36',
				'updated_at' => '2015-09-10 21:49:36',
			),
			27 => 
			array (
				'id' => 32,
				'nombre' => '3-C',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:49:42',
				'updated_at' => '2015-09-10 21:49:42',
			),
			28 => 
			array (
				'id' => 33,
				'nombre' => '4-C',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:49:48',
				'updated_at' => '2015-09-10 21:49:48',
			),
			29 => 
			array (
				'id' => 34,
				'nombre' => '5-C',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:49:53',
				'updated_at' => '2015-09-10 21:49:53',
			),
			30 => 
			array (
				'id' => 35,
				'nombre' => '6-C',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:50:00',
				'updated_at' => '2015-09-10 21:50:00',
			),
			31 => 
			array (
				'id' => 36,
				'nombre' => '7-C',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:50:06',
				'updated_at' => '2015-09-10 21:50:06',
			),
			32 => 
			array (
				'id' => 37,
				'nombre' => '8-C',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:50:20',
				'updated_at' => '2015-09-10 21:50:20',
			),
			33 => 
			array (
				'id' => 38,
				'nombre' => '9-C',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:50:28',
				'updated_at' => '2015-09-10 21:50:28',
			),
			34 => 
			array (
				'id' => 39,
				'nombre' => '10-C',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:50:37',
				'updated_at' => '2015-09-10 21:50:37',
			),
			35 => 
			array (
				'id' => 40,
				'nombre' => '11-C',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:51:11',
				'updated_at' => '2015-09-10 21:51:11',
			),
			36 => 
			array (
				'id' => 41,
				'nombre' => '12-C',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:51:18',
				'updated_at' => '2015-09-10 21:51:18',
			),
			37 => 
			array (
				'id' => 42,
				'nombre' => '13-C',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:51:24',
				'updated_at' => '2015-09-10 21:51:24',
			),
			38 => 
			array (
				'id' => 43,
				'nombre' => '14-C',
				'aeropuerto_id' => 1,
				'created_at' => '2015-09-10 21:51:34',
				'updated_at' => '2015-09-10 21:51:34',
			),
		));
	}

}
