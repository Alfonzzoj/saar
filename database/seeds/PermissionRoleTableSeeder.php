<?php

use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('permission_role')->delete();
        
		\DB::table('permission_role')->insert(array (
			0 => 
			array (
				'id' => 25,
				'permission_id' => 3,
				'role_id' => 1,
				'created_at' => '2015-09-01 14:44:15',
				'updated_at' => '2015-09-01 14:44:15',
			),
			1 => 
			array (
				'id' => 27,
				'permission_id' => 5,
				'role_id' => 1,
				'created_at' => '2015-09-01 14:44:15',
				'updated_at' => '2015-09-01 14:44:15',
			),
			2 => 
			array (
				'id' => 29,
				'permission_id' => 13,
				'role_id' => 1,
				'created_at' => '2015-09-01 14:44:15',
				'updated_at' => '2015-09-01 14:44:15',
			),
			3 => 
			array (
				'id' => 31,
				'permission_id' => 14,
				'role_id' => 1,
				'created_at' => '2015-09-01 14:44:15',
				'updated_at' => '2015-09-01 14:44:15',
			),
			4 => 
			array (
				'id' => 34,
				'permission_id' => 4,
				'role_id' => 1,
				'created_at' => '2015-09-01 14:44:15',
				'updated_at' => '2015-09-01 14:44:15',
			),
			5 => 
			array (
				'id' => 37,
				'permission_id' => 11,
				'role_id' => 1,
				'created_at' => '2015-09-01 14:44:15',
				'updated_at' => '2015-09-01 14:44:15',
			),
			6 => 
			array (
				'id' => 38,
				'permission_id' => 7,
				'role_id' => 2,
				'created_at' => '2015-09-01 20:04:18',
				'updated_at' => '2015-09-01 20:04:18',
			),
			7 => 
			array (
				'id' => 39,
				'permission_id' => 9,
				'role_id' => 2,
				'created_at' => '2015-09-01 20:04:18',
				'updated_at' => '2015-09-01 20:04:18',
			),
			8 => 
			array (
				'id' => 40,
				'permission_id' => 10,
				'role_id' => 2,
				'created_at' => '2015-09-01 20:04:18',
				'updated_at' => '2015-09-01 20:04:18',
			),
			9 => 
			array (
				'id' => 41,
				'permission_id' => 6,
				'role_id' => 2,
				'created_at' => '2015-09-01 20:04:18',
				'updated_at' => '2015-09-01 20:04:18',
			),
			10 => 
			array (
				'id' => 42,
				'permission_id' => 8,
				'role_id' => 2,
				'created_at' => '2015-09-01 20:04:18',
				'updated_at' => '2015-09-01 20:04:18',
			),
			11 => 
			array (
				'id' => 43,
				'permission_id' => 7,
				'role_id' => 1,
				'created_at' => '2015-09-01 20:46:44',
				'updated_at' => '2015-09-01 20:46:44',
			),
			12 => 
			array (
				'id' => 44,
				'permission_id' => 12,
				'role_id' => 1,
				'created_at' => '2015-09-01 20:47:12',
				'updated_at' => '2015-09-01 20:47:12',
			),
			13 => 
			array (
				'id' => 45,
				'permission_id' => 1,
				'role_id' => 1,
				'created_at' => '2015-09-01 20:47:12',
				'updated_at' => '2015-09-01 20:47:12',
			),
			14 => 
			array (
				'id' => 46,
				'permission_id' => 2,
				'role_id' => 1,
				'created_at' => '2015-09-01 20:47:12',
				'updated_at' => '2015-09-01 20:47:12',
			),
			15 => 
			array (
				'id' => 47,
				'permission_id' => 9,
				'role_id' => 1,
				'created_at' => '2015-09-01 20:47:12',
				'updated_at' => '2015-09-01 20:47:12',
			),
			16 => 
			array (
				'id' => 48,
				'permission_id' => 10,
				'role_id' => 1,
				'created_at' => '2015-09-01 20:47:12',
				'updated_at' => '2015-09-01 20:47:12',
			),
			17 => 
			array (
				'id' => 49,
				'permission_id' => 6,
				'role_id' => 1,
				'created_at' => '2015-09-01 20:47:12',
				'updated_at' => '2015-09-01 20:47:12',
			),
			18 => 
			array (
				'id' => 50,
				'permission_id' => 8,
				'role_id' => 1,
				'created_at' => '2015-09-01 20:47:12',
				'updated_at' => '2015-09-01 20:47:12',
			),
			19 => 
			array (
				'id' => 51,
				'permission_id' => 3,
				'role_id' => 3,
				'created_at' => '2015-09-01 20:49:32',
				'updated_at' => '2015-09-01 20:49:32',
			),
			20 => 
			array (
				'id' => 52,
				'permission_id' => 12,
				'role_id' => 3,
				'created_at' => '2015-09-01 20:49:32',
				'updated_at' => '2015-09-01 20:49:32',
			),
			21 => 
			array (
				'id' => 53,
				'permission_id' => 5,
				'role_id' => 3,
				'created_at' => '2015-09-01 20:49:32',
				'updated_at' => '2015-09-01 20:49:32',
			),
			22 => 
			array (
				'id' => 54,
				'permission_id' => 1,
				'role_id' => 3,
				'created_at' => '2015-09-01 20:49:32',
				'updated_at' => '2015-09-01 20:49:32',
			),
			23 => 
			array (
				'id' => 55,
				'permission_id' => 2,
				'role_id' => 3,
				'created_at' => '2015-09-01 20:49:32',
				'updated_at' => '2015-09-01 20:49:32',
			),
			24 => 
			array (
				'id' => 57,
				'permission_id' => 4,
				'role_id' => 3,
				'created_at' => '2015-09-01 20:49:32',
				'updated_at' => '2015-09-01 20:49:32',
			),
			25 => 
			array (
				'id' => 58,
				'permission_id' => 15,
				'role_id' => 1,
				'created_at' => '2015-10-05 14:08:09',
				'updated_at' => '2015-10-05 14:08:09',
			),
			26 => 
			array (
				'id' => 59,
				'permission_id' => 17,
				'role_id' => 1,
				'created_at' => '2015-10-05 14:08:09',
				'updated_at' => '2015-10-05 14:08:09',
			),
			27 => 
			array (
				'id' => 60,
				'permission_id' => 16,
				'role_id' => 1,
				'created_at' => '2015-10-05 14:08:09',
				'updated_at' => '2015-10-05 14:08:09',
			),
			28 => 
			array (
				'id' => 61,
				'permission_id' => 18,
				'role_id' => 2,
				'created_at' => '2015-10-09 20:24:39',
				'updated_at' => '2015-10-09 20:24:39',
			),
			29 => 
			array (
				'id' => 62,
				'permission_id' => 18,
				'role_id' => 1,
				'created_at' => '2015-10-09 20:24:46',
				'updated_at' => '2015-10-09 20:24:46',
			),
			30 => 
			array (
				'id' => 63,
				'permission_id' => 19,
				'role_id' => 1,
				'created_at' => '2015-12-09 21:35:30',
				'updated_at' => '2015-12-09 21:35:30',
			),
			31 => 
			array (
				'id' => 64,
				'permission_id' => 21,
				'role_id' => 1,
				'created_at' => '2015-12-09 21:35:30',
				'updated_at' => '2015-12-09 21:35:30',
			),
			32 => 
			array (
				'id' => 65,
				'permission_id' => 20,
				'role_id' => 1,
				'created_at' => '2015-12-09 21:35:30',
				'updated_at' => '2015-12-09 21:35:30',
			),
			33 => 
			array (
				'id' => 66,
				'permission_id' => 22,
				'role_id' => 1,
				'created_at' => '2015-12-09 21:35:30',
				'updated_at' => '2015-12-09 21:35:30',
			),
			34 => 
			array (
				'id' => 67,
				'permission_id' => 15,
				'role_id' => 2,
				'created_at' => '2015-12-16 13:44:07',
				'updated_at' => '2015-12-16 13:44:07',
			),
			35 => 
			array (
				'id' => 68,
				'permission_id' => 17,
				'role_id' => 2,
				'created_at' => '2015-12-16 13:44:07',
				'updated_at' => '2015-12-16 13:44:07',
			),
			36 => 
			array (
				'id' => 69,
				'permission_id' => 16,
				'role_id' => 2,
				'created_at' => '2015-12-16 13:44:07',
				'updated_at' => '2015-12-16 13:44:07',
			),
			37 => 
			array (
				'id' => 70,
				'permission_id' => 20,
				'role_id' => 2,
				'created_at' => '2015-12-16 13:44:07',
				'updated_at' => '2015-12-16 13:44:07',
			),
			38 => 
			array (
				'id' => 71,
				'permission_id' => 23,
				'role_id' => 2,
				'created_at' => '2015-12-16 13:44:07',
				'updated_at' => '2015-12-16 13:44:07',
			),
		));
	}

}
