<?php

use Illuminate\Database\Seeder;

class ModeloAeronavesTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
        
		\DB::table('modelo_aeronaves')->insert(array (
			0 => 
			array (
				'id' => 1,
				'modelo' => '206B3',
				'peso_maximo' => '1500',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			1 => 
			array (
				'id' => 2,
				'modelo' => '8R-GHB',
				'peso_maximo' => '2500',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			2 => 
			array (
				'id' => 3,
				'modelo' => 'A-109',
				'peso_maximo' => '2000',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			3 => 
			array (
				'id' => 4,
				'modelo' => 'A-119',
				'peso_maximo' => '3000',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			4 => 
			array (
				'id' => 5,
				'modelo' => 'A-300',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			5 => 
			array (
				'id' => 6,
				'modelo' => 'A-310',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			6 => 
			array (
				'id' => 7,
				'modelo' => 'A-319',
				'peso_maximo' => '76000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			7 => 
			array (
				'id' => 8,
				'modelo' => 'A-320',
				'peso_maximo' => '78000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			8 => 
			array (
				'id' => 9,
				'modelo' => 'A-330',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			9 => 
			array (
				'id' => 10,
				'modelo' => 'A-340-200',
				'peso_maximo' => '275000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			10 => 
			array (
				'id' => 11,
				'modelo' => 'A-340-300',
				'peso_maximo' => '260000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			11 => 
			array (
				'id' => 12,
				'modelo' => 'A-36',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			12 => 
			array (
				'id' => 13,
				'modelo' => 'AA-5B',
				'peso_maximo' => '2000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			13 => 
			array (
				'id' => 14,
				'modelo' => 'AASB',
				'peso_maximo' => '3000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			14 => 
			array (
				'id' => 15,
				'modelo' => 'AC-14',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			15 => 
			array (
				'id' => 16,
				'modelo' => 'AC-21',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			16 => 
			array (
				'id' => 17,
				'modelo' => 'AC-500',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			17 => 
			array (
				'id' => 18,
				'modelo' => 'AC-520',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			18 => 
			array (
				'id' => 19,
				'modelo' => 'AC-560',
				'peso_maximo' => '2800',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			19 => 
			array (
				'id' => 20,
				'modelo' => 'AC-600',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			20 => 
			array (
				'id' => 21,
				'modelo' => 'AC-640',
				'peso_maximo' => '5000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			21 => 
			array (
				'id' => 22,
				'modelo' => 'AC-680',
				'peso_maximo' => '5000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			22 => 
			array (
				'id' => 23,
				'modelo' => 'AC-690',
				'peso_maximo' => '5000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			23 => 
			array (
				'id' => 24,
				'modelo' => 'AC-695',
				'peso_maximo' => '5000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			24 => 
			array (
				'id' => 25,
				'modelo' => 'AC-81',
				'peso_maximo' => '5000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			25 => 
			array (
				'id' => 26,
				'modelo' => 'AC-840',
				'peso_maximo' => '5000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			26 => 
			array (
				'id' => 27,
				'modelo' => 'AC-90',
				'peso_maximo' => '5000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			27 => 
			array (
				'id' => 28,
				'modelo' => 'AC-900',
				'peso_maximo' => '5000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			28 => 
			array (
				'id' => 29,
				'modelo' => 'AC-980',
				'peso_maximo' => '5000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			29 => 
			array (
				'id' => 30,
				'modelo' => 'AE-355',
				'peso_maximo' => '0',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			30 => 
			array (
				'id' => 31,
				'modelo' => 'AEROESTAR 600',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			31 => 
			array (
				'id' => 32,
				'modelo' => 'AG-109',
				'peso_maximo' => '0',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			32 => 
			array (
				'id' => 33,
				'modelo' => 'AG-109C',
				'peso_maximo' => '0',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			33 => 
			array (
				'id' => 34,
				'modelo' => 'AJ-25',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			34 => 
			array (
				'id' => 35,
				'modelo' => 'AK-88B',
				'peso_maximo' => '4000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			35 => 
			array (
				'id' => 36,
				'modelo' => 'ALOUETTE-2',
				'peso_maximo' => '650',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			36 => 
			array (
				'id' => 37,
				'modelo' => 'ALOVTTE 2',
				'peso_maximo' => '1500',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			37 => 
			array (
				'id' => 38,
				'modelo' => 'AMT-200',
				'peso_maximo' => '850',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			38 => 
			array (
				'id' => 39,
				'modelo' => 'AN-124-100',
				'peso_maximo' => '300000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			39 => 
			array (
				'id' => 40,
				'modelo' => 'AN-12BP',
				'peso_maximo' => '61000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			40 => 
			array (
				'id' => 41,
				'modelo' => 'AN-2',
				'peso_maximo' => '6000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			41 => 
			array (
				'id' => 42,
				'modelo' => 'AN-26',
				'peso_maximo' => '24000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			42 => 
			array (
				'id' => 43,
				'modelo' => 'AN-28',
				'peso_maximo' => '6000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			43 => 
			array (
				'id' => 44,
				'modelo' => 'AN-II',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			44 => 
			array (
				'id' => 45,
				'modelo' => 'AP-681P',
				'peso_maximo' => '2590',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			45 => 
			array (
				'id' => 46,
				'modelo' => 'AP-68P',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			46 => 
			array (
				'id' => 47,
				'modelo' => 'as-350b',
				'peso_maximo' => '1300',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			47 => 
			array (
				'id' => 48,
				'modelo' => 'AS-355F1',
				'peso_maximo' => '0',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			48 => 
			array (
				'id' => 49,
				'modelo' => 'AS-TR',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			49 => 
			array (
				'id' => 50,
				'modelo' => 'ASTR-SPX',
				'peso_maximo' => '11000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			50 => 
			array (
				'id' => 51,
				'modelo' => 'AT-401',
				'peso_maximo' => '3000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			51 => 
			array (
				'id' => 52,
				'modelo' => 'AT-42',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			52 => 
			array (
				'id' => 53,
				'modelo' => 'AT-502B',
				'peso_maximo' => '3000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			53 => 
			array (
				'id' => 54,
				'modelo' => 'ATR-42',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			54 => 
			array (
				'id' => 55,
				'modelo' => 'ATR-42-500',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			55 => 
			array (
				'id' => 56,
				'modelo' => 'ATR-72',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			56 => 
			array (
				'id' => 57,
				'modelo' => 'ATR-72500',
				'peso_maximo' => '22000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			57 => 
			array (
				'id' => 58,
				'modelo' => 'B-190',
				'peso_maximo' => '7815',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			58 => 
			array (
				'id' => 59,
				'modelo' => 'B-206 B',
				'peso_maximo' => '1500',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			59 => 
			array (
				'id' => 60,
				'modelo' => 'B-212',
				'peso_maximo' => '0',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			60 => 
			array (
				'id' => 61,
				'modelo' => 'B-300',
				'peso_maximo' => '6500',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			61 => 
			array (
				'id' => 62,
				'modelo' => 'B-407',
				'peso_maximo' => '2500',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			62 => 
			array (
				'id' => 63,
				'modelo' => 'B-427',
				'peso_maximo' => '2682',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			63 => 
			array (
				'id' => 64,
				'modelo' => 'B-707',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			64 => 
			array (
				'id' => 65,
				'modelo' => 'B-707-300',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			65 => 
			array (
				'id' => 66,
				'modelo' => 'B-727',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			66 => 
			array (
				'id' => 67,
				'modelo' => 'B-727-100',
				'peso_maximo' => '69000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			67 => 
			array (
				'id' => 68,
				'modelo' => 'B-727-200',
				'peso_maximo' => '87000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			68 => 
			array (
				'id' => 69,
				'modelo' => 'B-727-227',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			69 => 
			array (
				'id' => 70,
				'modelo' => 'B-727-300',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			70 => 
			array (
				'id' => 71,
				'modelo' => 'B-737-200',
				'peso_maximo' => '53000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			71 => 
			array (
				'id' => 72,
				'modelo' => 'B-737-200RDV',
				'peso_maximo' => '55000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			72 => 
			array (
				'id' => 73,
				'modelo' => 'B-737-241',
				'peso_maximo' => '52390',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			73 => 
			array (
				'id' => 74,
				'modelo' => 'B-737-300',
				'peso_maximo' => '57000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			74 => 
			array (
				'id' => 75,
				'modelo' => 'B-737-400',
				'peso_maximo' => '66000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			75 => 
			array (
				'id' => 76,
				'modelo' => 'B-737-500',
				'peso_maximo' => '66000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			76 => 
			array (
				'id' => 77,
				'modelo' => 'B-737-700',
				'peso_maximo' => '68000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			77 => 
			array (
				'id' => 78,
				'modelo' => 'B-737-800',
				'peso_maximo' => '79010',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			78 => 
			array (
				'id' => 79,
				'modelo' => 'B-747',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			79 => 
			array (
				'id' => 80,
				'modelo' => 'B-747-200',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			80 => 
			array (
				'id' => 81,
				'modelo' => 'B-752',
				'peso_maximo' => '114000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			81 => 
			array (
				'id' => 82,
				'modelo' => 'B-757',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			82 => 
			array (
				'id' => 83,
				'modelo' => 'B-757-2',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			83 => 
			array (
				'id' => 84,
				'modelo' => 'B-757-236',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			84 => 
			array (
				'id' => 85,
				'modelo' => 'B-767',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			85 => 
			array (
				'id' => 86,
				'modelo' => 'B-767-100',
				'peso_maximo' => '142881',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			86 => 
			array (
				'id' => 87,
				'modelo' => 'B-767-3',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			87 => 
			array (
				'id' => 88,
				'modelo' => 'B-767-300',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			88 => 
			array (
				'id' => 89,
				'modelo' => 'B-777-200',
				'peso_maximo' => '294200',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			89 => 
			array (
				'id' => 90,
				'modelo' => 'B-777-300',
				'peso_maximo' => '299370',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			90 => 
			array (
				'id' => 91,
				'modelo' => 'BA-31',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			91 => 
			array (
				'id' => 92,
				'modelo' => 'BA-900',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			92 => 
			array (
				'id' => 93,
				'modelo' => 'BAE-800',
				'peso_maximo' => '12000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			93 => 
			array (
				'id' => 94,
				'modelo' => 'BE-02',
				'peso_maximo' => '8000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			94 => 
			array (
				'id' => 95,
				'modelo' => 'BE-10',
				'peso_maximo' => '5000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			95 => 
			array (
				'id' => 96,
				'modelo' => 'BE-100',
				'peso_maximo' => '5000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			96 => 
			array (
				'id' => 97,
				'modelo' => 'BE-109',
				'peso_maximo' => '6000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			97 => 
			array (
				'id' => 98,
				'modelo' => 'BE-18',
				'peso_maximo' => '2000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			98 => 
			array (
				'id' => 99,
				'modelo' => 'BE-1900',
				'peso_maximo' => '8000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			99 => 
			array (
				'id' => 100,
				'modelo' => 'BE-1900-D',
				'peso_maximo' => '8000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			100 => 
			array (
				'id' => 101,
				'modelo' => 'BE-20',
				'peso_maximo' => '2000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			101 => 
			array (
				'id' => 102,
				'modelo' => 'BE-200',
				'peso_maximo' => '6000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			102 => 
			array (
				'id' => 103,
				'modelo' => 'BE-23',
				'peso_maximo' => '2000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			103 => 
			array (
				'id' => 104,
				'modelo' => 'BE-24r',
				'peso_maximo' => '3000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			104 => 
			array (
				'id' => 105,
				'modelo' => 'BE-300',
				'peso_maximo' => '6000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			105 => 
			array (
				'id' => 106,
				'modelo' => 'BE-33',
				'peso_maximo' => '2000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			106 => 
			array (
				'id' => 107,
				'modelo' => 'BE-35',
				'peso_maximo' => '2000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			107 => 
			array (
				'id' => 108,
				'modelo' => 'BE-350',
				'peso_maximo' => '8000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			108 => 
			array (
				'id' => 109,
				'modelo' => 'BE-36',
				'peso_maximo' => '2000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			109 => 
			array (
				'id' => 110,
				'modelo' => 'BE-400',
				'peso_maximo' => '8000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			110 => 
			array (
				'id' => 111,
				'modelo' => 'BE-50',
				'peso_maximo' => '3000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			111 => 
			array (
				'id' => 112,
				'modelo' => 'BE-55',
				'peso_maximo' => '3000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			112 => 
			array (
				'id' => 113,
				'modelo' => 'BE-58',
				'peso_maximo' => '3000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			113 => 
			array (
				'id' => 114,
				'modelo' => 'BE-60',
				'peso_maximo' => '4000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			114 => 
			array (
				'id' => 115,
				'modelo' => 'BE-65',
				'peso_maximo' => '4000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			115 => 
			array (
				'id' => 116,
				'modelo' => 'BE-76',
				'peso_maximo' => '4000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			116 => 
			array (
				'id' => 117,
				'modelo' => 'BE-80',
				'peso_maximo' => '4000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			117 => 
			array (
				'id' => 118,
				'modelo' => 'BE-90',
				'peso_maximo' => '5000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			118 => 
			array (
				'id' => 119,
				'modelo' => 'BE-95',
				'peso_maximo' => '5000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			119 => 
			array (
				'id' => 120,
				'modelo' => 'BE-99',
				'peso_maximo' => '5000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			120 => 
			array (
				'id' => 121,
				'modelo' => 'BE-9L',
				'peso_maximo' => '5000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			121 => 
			array (
				'id' => 122,
				'modelo' => 'BELL-206L',
				'peso_maximo' => '0',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			122 => 
			array (
				'id' => 123,
				'modelo' => 'BELL-222U',
				'peso_maximo' => '4500',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			123 => 
			array (
				'id' => 124,
				'modelo' => 'BELL-406',
				'peso_maximo' => '2200',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			124 => 
			array (
				'id' => 125,
				'modelo' => 'BELL-407',
				'peso_maximo' => '2000',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			125 => 
			array (
				'id' => 126,
				'modelo' => 'BELL-412',
				'peso_maximo' => '5410',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			126 => 
			array (
				'id' => 127,
				'modelo' => 'BELL-427',
				'peso_maximo' => '2100',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			127 => 
			array (
				'id' => 128,
				'modelo' => 'BELL-429',
				'peso_maximo' => '3175',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			128 => 
			array (
				'id' => 129,
				'modelo' => 'BELL-L3',
				'peso_maximo' => '0',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			129 => 
			array (
				'id' => 130,
				'modelo' => 'BELL206',
				'peso_maximo' => '1000',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			130 => 
			array (
				'id' => 131,
				'modelo' => 'BELL206BIII',
				'peso_maximo' => '1000',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			131 => 
			array (
				'id' => 132,
				'modelo' => 'BELL230',
				'peso_maximo' => '4000',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			132 => 
			array (
				'id' => 133,
				'modelo' => 'BH-06',
				'peso_maximo' => '2000',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			133 => 
			array (
				'id' => 134,
				'modelo' => 'BH-07',
				'peso_maximo' => '2268',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			134 => 
			array (
				'id' => 135,
				'modelo' => 'BH-206',
				'peso_maximo' => '0',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			135 => 
			array (
				'id' => 136,
				'modelo' => 'BH-412',
				'peso_maximo' => '3000',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			136 => 
			array (
				'id' => 137,
				'modelo' => 'BID-1900',
				'peso_maximo' => '7700',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			137 => 
			array (
				'id' => 138,
				'modelo' => 'BL-26',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			138 => 
			array (
				'id' => 139,
				'modelo' => 'BN-2',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			139 => 
			array (
				'id' => 140,
				'modelo' => 'BN-3',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			140 => 
			array (
				'id' => 141,
				'modelo' => 'BN-III',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			141 => 
			array (
				'id' => 142,
				'modelo' => 'BN2',
				'peso_maximo' => '2000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			142 => 
			array (
				'id' => 143,
				'modelo' => 'BO-105',
				'peso_maximo' => '0',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			143 => 
			array (
				'id' => 144,
				'modelo' => 'C-1',
				'peso_maximo' => '5000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			144 => 
			array (
				'id' => 145,
				'modelo' => 'C-130J HERCULES',
				'peso_maximo' => '70310',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			145 => 
			array (
				'id' => 146,
				'modelo' => 'C-152',
				'peso_maximo' => '800',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			146 => 
			array (
				'id' => 147,
				'modelo' => 'C-160',
				'peso_maximo' => '50000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			147 => 
			array (
				'id' => 148,
				'modelo' => 'C-172',
				'peso_maximo' => '2000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			148 => 
			array (
				'id' => 149,
				'modelo' => 'C-177',
				'peso_maximo' => '1600',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			149 => 
			array (
				'id' => 150,
				'modelo' => 'C-17A GLOBEMAST',
				'peso_maximo' => '266000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			150 => 
			array (
				'id' => 151,
				'modelo' => 'C-182',
				'peso_maximo' => '2000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			151 => 
			array (
				'id' => 152,
				'modelo' => 'C-185',
				'peso_maximo' => '2000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			152 => 
			array (
				'id' => 153,
				'modelo' => 'C-206',
				'peso_maximo' => '2000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			153 => 
			array (
				'id' => 154,
				'modelo' => 'C-207',
				'peso_maximo' => '2000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			154 => 
			array (
				'id' => 155,
				'modelo' => 'C-208',
				'peso_maximo' => '2000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			155 => 
			array (
				'id' => 156,
				'modelo' => 'C-208B',
				'peso_maximo' => '5000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			156 => 
			array (
				'id' => 157,
				'modelo' => 'C-210',
				'peso_maximo' => '2000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			157 => 
			array (
				'id' => 158,
				'modelo' => 'C-212',
				'peso_maximo' => '2000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			158 => 
			array (
				'id' => 159,
				'modelo' => 'C-302',
				'peso_maximo' => '3000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			159 => 
			array (
				'id' => 160,
				'modelo' => 'C-303',
				'peso_maximo' => '1500',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			160 => 
			array (
				'id' => 161,
				'modelo' => 'C-310',
				'peso_maximo' => '3000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			161 => 
			array (
				'id' => 162,
				'modelo' => 'C-335',
				'peso_maximo' => '3000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			162 => 
			array (
				'id' => 163,
				'modelo' => 'C-337',
				'peso_maximo' => '3000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			163 => 
			array (
				'id' => 164,
				'modelo' => 'C-340',
				'peso_maximo' => '3000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			164 => 
			array (
				'id' => 165,
				'modelo' => 'C-401',
				'peso_maximo' => '3000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			165 => 
			array (
				'id' => 166,
				'modelo' => 'C-402',
				'peso_maximo' => '4000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			166 => 
			array (
				'id' => 167,
				'modelo' => 'C-404',
				'peso_maximo' => '4000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			167 => 
			array (
				'id' => 168,
				'modelo' => 'C-406',
				'peso_maximo' => '5000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			168 => 
			array (
				'id' => 169,
				'modelo' => 'C-411',
				'peso_maximo' => '2000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			169 => 
			array (
				'id' => 170,
				'modelo' => 'C-414',
				'peso_maximo' => '2856',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			170 => 
			array (
				'id' => 171,
				'modelo' => 'C-421',
				'peso_maximo' => '4000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			171 => 
			array (
				'id' => 172,
				'modelo' => 'C-425',
				'peso_maximo' => '4000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			172 => 
			array (
				'id' => 173,
				'modelo' => 'C-440',
				'peso_maximo' => '5000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			173 => 
			array (
				'id' => 174,
				'modelo' => 'C-441',
				'peso_maximo' => '5000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			174 => 
			array (
				'id' => 175,
				'modelo' => 'C-500',
				'peso_maximo' => '6000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			175 => 
			array (
				'id' => 176,
				'modelo' => 'C-501',
				'peso_maximo' => '6000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			176 => 
			array (
				'id' => 177,
				'modelo' => 'C-510',
				'peso_maximo' => '3921',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			177 => 
			array (
				'id' => 178,
				'modelo' => 'C-525',
				'peso_maximo' => '4800',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			178 => 
			array (
				'id' => 179,
				'modelo' => 'C-52A',
				'peso_maximo' => '5000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			179 => 
			array (
				'id' => 180,
				'modelo' => 'C-550',
				'peso_maximo' => '7000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			180 => 
			array (
				'id' => 181,
				'modelo' => 'C-551',
				'peso_maximo' => '6000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			181 => 
			array (
				'id' => 182,
				'modelo' => 'C-560',
				'peso_maximo' => '6000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			182 => 
			array (
				'id' => 183,
				'modelo' => 'C-56X',
				'peso_maximo' => '10000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			183 => 
			array (
				'id' => 184,
				'modelo' => 'C-601',
				'peso_maximo' => '21000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			184 => 
			array (
				'id' => 185,
				'modelo' => 'C-650',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			185 => 
			array (
				'id' => 186,
				'modelo' => 'C-750',
				'peso_maximo' => '16195',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			186 => 
			array (
				'id' => 187,
				'modelo' => 'C-III',
				'peso_maximo' => '9500',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			187 => 
			array (
				'id' => 188,
				'modelo' => 'CHALLENGER',
				'peso_maximo' => '19618',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			188 => 
			array (
				'id' => 189,
				'modelo' => 'CL-22',
				'peso_maximo' => '20000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			189 => 
			array (
				'id' => 190,
				'modelo' => 'CL-300',
				'peso_maximo' => '26000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			190 => 
			array (
				'id' => 191,
				'modelo' => 'CL-60',
				'peso_maximo' => '21000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			191 => 
			array (
				'id' => 192,
				'modelo' => 'CL-600',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			192 => 
			array (
				'id' => 193,
				'modelo' => 'CL-601',
				'peso_maximo' => '20200',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			193 => 
			array (
				'id' => 194,
				'modelo' => 'CL-602',
				'peso_maximo' => '22000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			194 => 
			array (
				'id' => 195,
				'modelo' => 'CL-604',
				'peso_maximo' => '21000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			195 => 
			array (
				'id' => 196,
				'modelo' => 'CL-605',
				'peso_maximo' => '21000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			196 => 
			array (
				'id' => 197,
				'modelo' => 'CL-64',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			197 => 
			array (
				'id' => 198,
				'modelo' => 'CN-232',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			198 => 
			array (
				'id' => 199,
				'modelo' => 'CN-235',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			199 => 
			array (
				'id' => 200,
				'modelo' => 'CRJ-700',
				'peso_maximo' => '21000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			200 => 
			array (
				'id' => 201,
				'modelo' => 'CV-24',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			201 => 
			array (
				'id' => 202,
				'modelo' => 'CV-340',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			202 => 
			array (
				'id' => 203,
				'modelo' => 'CV-440',
				'peso_maximo' => '15500',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			203 => 
			array (
				'id' => 204,
				'modelo' => 'CV-580',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			204 => 
			array (
				'id' => 205,
				'modelo' => 'CW-3',
				'peso_maximo' => '6000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			205 => 
			array (
				'id' => 206,
				'modelo' => 'D-228-2',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			206 => 
			array (
				'id' => 207,
				'modelo' => 'D-28',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			207 => 
			array (
				'id' => 208,
				'modelo' => 'D-328',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			208 => 
			array (
				'id' => 209,
				'modelo' => 'D02802',
				'peso_maximo' => '3500',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			209 => 
			array (
				'id' => 210,
				'modelo' => 'DA-10',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			210 => 
			array (
				'id' => 211,
				'modelo' => 'DA-20',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			211 => 
			array (
				'id' => 212,
				'modelo' => 'DA-50',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			212 => 
			array (
				'id' => 213,
				'modelo' => 'DA-90',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			213 => 
			array (
				'id' => 214,
				'modelo' => 'DAS-8-300',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			214 => 
			array (
				'id' => 215,
				'modelo' => 'DASH 7',
				'peso_maximo' => '12273',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			215 => 
			array (
				'id' => 216,
				'modelo' => 'DASH-7',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			216 => 
			array (
				'id' => 217,
				'modelo' => 'DC-10',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			217 => 
			array (
				'id' => 218,
				'modelo' => 'DC-10-10',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			218 => 
			array (
				'id' => 219,
				'modelo' => 'DC-10-15',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			219 => 
			array (
				'id' => 220,
				'modelo' => 'DC-10-30',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			220 => 
			array (
				'id' => 221,
				'modelo' => 'DC-10/15',
				'peso_maximo' => '206400',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			221 => 
			array (
				'id' => 222,
				'modelo' => 'DC-3',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			222 => 
			array (
				'id' => 223,
				'modelo' => 'DC-3C',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			223 => 
			array (
				'id' => 224,
				'modelo' => 'DC-6',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			224 => 
			array (
				'id' => 225,
				'modelo' => 'DC-8',
				'peso_maximo' => '159091',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			225 => 
			array (
				'id' => 226,
				'modelo' => 'DC-9',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			226 => 
			array (
				'id' => 227,
				'modelo' => 'DC-9-15',
				'peso_maximo' => '43000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			227 => 
			array (
				'id' => 228,
				'modelo' => 'DC-9-30',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			228 => 
			array (
				'id' => 229,
				'modelo' => 'DC-9-31',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			229 => 
			array (
				'id' => 230,
				'modelo' => 'DC-9-32',
				'peso_maximo' => '50000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			230 => 
			array (
				'id' => 231,
				'modelo' => 'DC-9-34CF',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			231 => 
			array (
				'id' => 232,
				'modelo' => 'DC-9-50',
				'peso_maximo' => '55000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			232 => 
			array (
				'id' => 233,
				'modelo' => 'DC-9-51',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			233 => 
			array (
				'id' => 234,
				'modelo' => 'DC-9-82',
				'peso_maximo' => '66000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			234 => 
			array (
				'id' => 235,
				'modelo' => 'DC-9-83',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			235 => 
			array (
				'id' => 236,
				'modelo' => 'DH-06',
				'peso_maximo' => '5682',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			236 => 
			array (
				'id' => 237,
				'modelo' => 'DH-7',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			237 => 
			array (
				'id' => 238,
				'modelo' => 'DH-8',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			238 => 
			array (
				'id' => 239,
				'modelo' => 'DHS-7',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			239 => 
			array (
				'id' => 240,
				'modelo' => 'DO-C6',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			240 => 
			array (
				'id' => 241,
				'modelo' => 'DSH7',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			241 => 
			array (
				'id' => 242,
				'modelo' => 'E-120',
				'peso_maximo' => '12000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			242 => 
			array (
				'id' => 243,
				'modelo' => 'E50-P',
				'peso_maximo' => '6000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			243 => 
			array (
				'id' => 244,
				'modelo' => 'EA-30',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			244 => 
			array (
				'id' => 245,
				'modelo' => 'EA-31',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			245 => 
			array (
				'id' => 246,
				'modelo' => 'EA-320',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			246 => 
			array (
				'id' => 247,
				'modelo' => 'EC-120',
				'peso_maximo' => '900',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			247 => 
			array (
				'id' => 248,
				'modelo' => 'EC-130',
				'peso_maximo' => '2427',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			248 => 
			array (
				'id' => 249,
				'modelo' => 'EC-135',
				'peso_maximo' => '2800',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			249 => 
			array (
				'id' => 250,
				'modelo' => 'EMB-110',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			250 => 
			array (
				'id' => 251,
				'modelo' => 'EMB-120',
				'peso_maximo' => '12000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			251 => 
			array (
				'id' => 252,
				'modelo' => 'EMB-135BJ',
				'peso_maximo' => '22500',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			252 => 
			array (
				'id' => 253,
				'modelo' => 'EMB-190-100',
				'peso_maximo' => '51800',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			253 => 
			array (
				'id' => 254,
				'modelo' => 'EMB-810',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			254 => 
			array (
				'id' => 255,
				'modelo' => 'EPIC',
				'peso_maximo' => '3000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			255 => 
			array (
				'id' => 256,
				'modelo' => 'ERJ-145',
				'peso_maximo' => '22000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			256 => 
			array (
				'id' => 257,
				'modelo' => 'F-10',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			257 => 
			array (
				'id' => 258,
				'modelo' => 'F-100',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			258 => 
			array (
				'id' => 259,
				'modelo' => 'F-20',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			259 => 
			array (
				'id' => 260,
				'modelo' => 'F-27',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			260 => 
			array (
				'id' => 261,
				'modelo' => 'F-50',
				'peso_maximo' => '17300',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			261 => 
			array (
				'id' => 262,
				'modelo' => 'F-900',
				'peso_maximo' => '20000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			262 => 
			array (
				'id' => 263,
				'modelo' => 'FA-50',
				'peso_maximo' => '20000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			263 => 
			array (
				'id' => 264,
				'modelo' => 'FALCOM 2000LX',
				'peso_maximo' => '19142',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			264 => 
			array (
				'id' => 265,
				'modelo' => 'G-02',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			265 => 
			array (
				'id' => 266,
				'modelo' => 'G-100',
				'peso_maximo' => '12000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			266 => 
			array (
				'id' => 267,
				'modelo' => 'G-150',
				'peso_maximo' => '12000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			267 => 
			array (
				'id' => 268,
				'modelo' => 'G-159',
				'peso_maximo' => '16200',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			268 => 
			array (
				'id' => 269,
				'modelo' => 'G-200',
				'peso_maximo' => '16000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			269 => 
			array (
				'id' => 270,
				'modelo' => 'G-280',
				'peso_maximo' => '16000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			270 => 
			array (
				'id' => 271,
				'modelo' => 'G-3',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			271 => 
			array (
				'id' => 272,
				'modelo' => 'G-4',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			272 => 
			array (
				'id' => 273,
				'modelo' => 'G-73',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			273 => 
			array (
				'id' => 274,
				'modelo' => 'G-II',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			274 => 
			array (
				'id' => 275,
				'modelo' => 'GA-8',
				'peso_maximo' => '1800',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			275 => 
			array (
				'id' => 276,
				'modelo' => 'GA-LX',
				'peso_maximo' => '16000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			276 => 
			array (
				'id' => 277,
				'modelo' => 'GL-25',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			277 => 
			array (
				'id' => 278,
				'modelo' => 'GL-F2',
				'peso_maximo' => '28000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			278 => 
			array (
				'id' => 279,
				'modelo' => 'GL-F4',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			279 => 
			array (
				'id' => 280,
				'modelo' => 'GLEX',
				'peso_maximo' => '55000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			280 => 
			array (
				'id' => 281,
				'modelo' => 'GLF-3',
				'peso_maximo' => '31615',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			281 => 
			array (
				'id' => 282,
				'modelo' => 'GLF-5',
				'peso_maximo' => '41300',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			282 => 
			array (
				'id' => 283,
				'modelo' => 'GLF/5M',
				'peso_maximo' => '40910',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			283 => 
			array (
				'id' => 284,
				'modelo' => 'GULFTREAM',
				'peso_maximo' => '33000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			284 => 
			array (
				'id' => 285,
				'modelo' => 'GULFTREAM - G550',
				'peso_maximo' => '34156',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			285 => 
			array (
				'id' => 286,
				'modelo' => 'H-25A',
				'peso_maximo' => '11000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			286 => 
			array (
				'id' => 287,
				'modelo' => 'H-25B',
				'peso_maximo' => '12000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			287 => 
			array (
				'id' => 288,
				'modelo' => 'H-400',
				'peso_maximo' => '8500',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			288 => 
			array (
				'id' => 289,
				'modelo' => 'H-500C',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			289 => 
			array (
				'id' => 290,
				'modelo' => 'H-500D',
				'peso_maximo' => '0',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			290 => 
			array (
				'id' => 291,
				'modelo' => 'H-700',
				'peso_maximo' => '13000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			291 => 
			array (
				'id' => 292,
				'modelo' => 'H-800',
				'peso_maximo' => '10000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			292 => 
			array (
				'id' => 293,
				'modelo' => 'H-A1',
				'peso_maximo' => '1200',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			293 => 
			array (
				'id' => 294,
				'modelo' => 'H-M18',
				'peso_maximo' => '0',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			294 => 
			array (
				'id' => 295,
				'modelo' => 'HA-1',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			295 => 
			array (
				'id' => 296,
				'modelo' => 'HF-32',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			296 => 
			array (
				'id' => 297,
				'modelo' => 'HI-125',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			297 => 
			array (
				'id' => 298,
				'modelo' => 'HP-137',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			298 => 
			array (
				'id' => 299,
				'modelo' => 'HS-125',
				'peso_maximo' => '9000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			299 => 
			array (
				'id' => 300,
				'modelo' => 'HS-155',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			300 => 
			array (
				'id' => 301,
				'modelo' => 'HS-25',
				'peso_maximo' => '12500',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			301 => 
			array (
				'id' => 302,
				'modelo' => 'HS-25A',
				'peso_maximo' => '12000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			302 => 
			array (
				'id' => 303,
				'modelo' => 'HS-400',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			303 => 
			array (
				'id' => 304,
				'modelo' => 'HS-800',
				'peso_maximo' => '12600',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			304 => 
			array (
				'id' => 305,
				'modelo' => 'IL-18',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			305 => 
			array (
				'id' => 306,
				'modelo' => 'IL-62',
				'peso_maximo' => '60000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			306 => 
			array (
				'id' => 307,
				'modelo' => 'IL-62M',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			307 => 
			array (
				'id' => 308,
				'modelo' => 'IL-76',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			308 => 
			array (
				'id' => 309,
				'modelo' => 'J-328',
				'peso_maximo' => '16000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			309 => 
			array (
				'id' => 310,
				'modelo' => 'JC-1121',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			310 => 
			array (
				'id' => 311,
				'modelo' => 'JCOM',
				'peso_maximo' => '8000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			311 => 
			array (
				'id' => 312,
				'modelo' => 'JS-31',
				'peso_maximo' => '7000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			312 => 
			array (
				'id' => 313,
				'modelo' => 'JS-32',
				'peso_maximo' => '5000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			313 => 
			array (
				'id' => 314,
				'modelo' => 'KODI',
				'peso_maximo' => '3770',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			314 => 
			array (
				'id' => 315,
				'modelo' => 'L-1011',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			315 => 
			array (
				'id' => 316,
				'modelo' => 'L-1011-500',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			316 => 
			array (
				'id' => 317,
				'modelo' => 'L-1329',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			317 => 
			array (
				'id' => 318,
				'modelo' => 'L-329',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			318 => 
			array (
				'id' => 319,
				'modelo' => 'L-39',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			319 => 
			array (
				'id' => 320,
				'modelo' => 'LANCER',
				'peso_maximo' => '1000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			320 => 
			array (
				'id' => 321,
				'modelo' => 'LC-30',
				'peso_maximo' => '1454',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			321 => 
			array (
				'id' => 322,
				'modelo' => 'LEARJET 55',
				'peso_maximo' => '9525',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			322 => 
			array (
				'id' => 323,
				'modelo' => 'LET-410',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			323 => 
			array (
				'id' => 324,
				'modelo' => 'LJ-25',
				'peso_maximo' => '7000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			324 => 
			array (
				'id' => 325,
				'modelo' => 'LJ-31',
				'peso_maximo' => '8000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			325 => 
			array (
				'id' => 326,
				'modelo' => 'LJ-35',
				'peso_maximo' => '8319',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			326 => 
			array (
				'id' => 327,
				'modelo' => 'LJ-45',
				'peso_maximo' => '9752',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			327 => 
			array (
				'id' => 328,
				'modelo' => 'LJ-55',
				'peso_maximo' => '10000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			328 => 
			array (
				'id' => 329,
				'modelo' => 'LJ-60',
				'peso_maximo' => '11000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			329 => 
			array (
				'id' => 330,
				'modelo' => 'LNC-4',
				'peso_maximo' => '2000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			330 => 
			array (
				'id' => 331,
				'modelo' => 'LONG-RANGER',
				'peso_maximo' => '1500',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			331 => 
			array (
				'id' => 332,
				'modelo' => 'LOR-35',
				'peso_maximo' => '0',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			332 => 
			array (
				'id' => 333,
				'modelo' => 'LR-23',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			333 => 
			array (
				'id' => 334,
				'modelo' => 'LR-24',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			334 => 
			array (
				'id' => 335,
				'modelo' => 'LR-25',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			335 => 
			array (
				'id' => 336,
				'modelo' => 'LR-28',
				'peso_maximo' => '7000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			336 => 
			array (
				'id' => 337,
				'modelo' => 'LR-31',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			337 => 
			array (
				'id' => 338,
				'modelo' => 'LR-31A',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			338 => 
			array (
				'id' => 339,
				'modelo' => 'LR-35',
				'peso_maximo' => '7000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			339 => 
			array (
				'id' => 340,
				'modelo' => 'LR-35A',
				'peso_maximo' => '7000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			340 => 
			array (
				'id' => 341,
				'modelo' => 'LR-36',
				'peso_maximo' => '8910',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			341 => 
			array (
				'id' => 342,
				'modelo' => 'LR-45',
				'peso_maximo' => '9320',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			342 => 
			array (
				'id' => 343,
				'modelo' => 'LR-55',
				'peso_maximo' => '10000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			343 => 
			array (
				'id' => 344,
				'modelo' => 'LR-60',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			344 => 
			array (
				'id' => 345,
				'modelo' => 'LR-915',
				'peso_maximo' => '1500',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			345 => 
			array (
				'id' => 346,
				'modelo' => 'M-02K',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			346 => 
			array (
				'id' => 347,
				'modelo' => 'M-20P',
				'peso_maximo' => '1246',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			347 => 
			array (
				'id' => 348,
				'modelo' => 'M-20R',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			348 => 
			array (
				'id' => 349,
				'modelo' => 'M-21',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			349 => 
			array (
				'id' => 350,
				'modelo' => 'M-220J',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			350 => 
			array (
				'id' => 351,
				'modelo' => 'M-26',
				'peso_maximo' => '1200',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			351 => 
			array (
				'id' => 352,
				'modelo' => 'M-28',
				'peso_maximo' => '7000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			352 => 
			array (
				'id' => 353,
				'modelo' => 'M-3',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			353 => 
			array (
				'id' => 354,
				'modelo' => 'M-7',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			354 => 
			array (
				'id' => 355,
				'modelo' => 'MALIBU',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			355 => 
			array (
				'id' => 356,
				'modelo' => 'MD-11',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			356 => 
			array (
				'id' => 357,
				'modelo' => 'MD-500',
				'peso_maximo' => '0',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			357 => 
			array (
				'id' => 358,
				'modelo' => 'MD-500E',
				'peso_maximo' => '1500',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			358 => 
			array (
				'id' => 359,
				'modelo' => 'MD-520',
				'peso_maximo' => '0',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			359 => 
			array (
				'id' => 360,
				'modelo' => 'MD-600',
				'peso_maximo' => '0',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			360 => 
			array (
				'id' => 361,
				'modelo' => 'MD-80',
				'peso_maximo' => '67955',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			361 => 
			array (
				'id' => 362,
				'modelo' => 'MD-82',
				'peso_maximo' => '64000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			362 => 
			array (
				'id' => 363,
				'modelo' => 'MD-83',
				'peso_maximo' => '72000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			363 => 
			array (
				'id' => 364,
				'modelo' => 'MD-87',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			364 => 
			array (
				'id' => 365,
				'modelo' => 'MD-88',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			365 => 
			array (
				'id' => 366,
				'modelo' => 'MD-90',
				'peso_maximo' => '75500',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			366 => 
			array (
				'id' => 367,
				'modelo' => 'MD-900',
				'peso_maximo' => '3000',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			367 => 
			array (
				'id' => 368,
				'modelo' => 'MI-02',
				'peso_maximo' => '3000',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			368 => 
			array (
				'id' => 369,
				'modelo' => 'MI-8',
				'peso_maximo' => '0',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			369 => 
			array (
				'id' => 370,
				'modelo' => 'MID-2',
				'peso_maximo' => '0',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			370 => 
			array (
				'id' => 371,
				'modelo' => 'MO-20',
				'peso_maximo' => '1800',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			371 => 
			array (
				'id' => 372,
				'modelo' => 'MO-21',
				'peso_maximo' => '1000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			372 => 
			array (
				'id' => 373,
				'modelo' => 'MR-404',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			373 => 
			array (
				'id' => 374,
				'modelo' => 'MU-2',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			374 => 
			array (
				'id' => 375,
				'modelo' => 'MU-2B',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			375 => 
			array (
				'id' => 376,
				'modelo' => 'MU-30',
				'peso_maximo' => '7000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			376 => 
			array (
				'id' => 377,
				'modelo' => 'MU-300',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			377 => 
			array (
				'id' => 378,
				'modelo' => 'MU-60',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			378 => 
			array (
				'id' => 379,
				'modelo' => 'MV-02',
				'peso_maximo' => '5000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			379 => 
			array (
				'id' => 380,
				'modelo' => 'MY-20',
				'peso_maximo' => '3000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			380 => 
			array (
				'id' => 381,
				'modelo' => 'N-235',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			381 => 
			array (
				'id' => 382,
				'modelo' => 'N-265',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			382 => 
			array (
				'id' => 383,
				'modelo' => 'N-265-60',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			383 => 
			array (
				'id' => 384,
				'modelo' => 'N-327AR   LJ-60',
				'peso_maximo' => '23500',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			384 => 
			array (
				'id' => 385,
				'modelo' => 'N-731PC',
				'peso_maximo' => '3200',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			385 => 
			array (
				'id' => 386,
				'modelo' => 'NA-265',
				'peso_maximo' => '9000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			386 => 
			array (
				'id' => 387,
				'modelo' => 'NE-821',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			387 => 
			array (
				'id' => 388,
				'modelo' => 'P-58',
				'peso_maximo' => '2495',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			388 => 
			array (
				'id' => 389,
				'modelo' => 'P-68T',
				'peso_maximo' => '2627',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			389 => 
			array (
				'id' => 390,
				'modelo' => 'P68C',
				'peso_maximo' => '1600',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			390 => 
			array (
				'id' => 391,
				'modelo' => 'PA-18',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			391 => 
			array (
				'id' => 392,
				'modelo' => 'PA-22',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			392 => 
			array (
				'id' => 393,
				'modelo' => 'PA-23',
				'peso_maximo' => '2360',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			393 => 
			array (
				'id' => 394,
				'modelo' => 'PA-28',
				'peso_maximo' => '2000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			394 => 
			array (
				'id' => 395,
				'modelo' => 'PA-30',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			395 => 
			array (
				'id' => 396,
				'modelo' => 'PA-31',
				'peso_maximo' => '5000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			396 => 
			array (
				'id' => 397,
				'modelo' => 'PA-31T',
				'peso_maximo' => '3200',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			397 => 
			array (
				'id' => 398,
				'modelo' => 'PA-32',
				'peso_maximo' => '2000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			398 => 
			array (
				'id' => 399,
				'modelo' => 'PA-34',
				'peso_maximo' => '2000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			399 => 
			array (
				'id' => 400,
				'modelo' => 'PA-38',
				'peso_maximo' => '920',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			400 => 
			array (
				'id' => 401,
				'modelo' => 'PA-41',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			401 => 
			array (
				'id' => 402,
				'modelo' => 'PA-42',
				'peso_maximo' => '5000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			402 => 
			array (
				'id' => 403,
				'modelo' => 'PA-44',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			403 => 
			array (
				'id' => 404,
				'modelo' => 'PA-46',
				'peso_maximo' => '2000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			404 => 
			array (
				'id' => 405,
				'modelo' => 'PA-60',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			405 => 
			array (
				'id' => 406,
				'modelo' => 'PAT-31',
				'peso_maximo' => '3200',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			406 => 
			array (
				'id' => 407,
				'modelo' => 'PAY-1',
				'peso_maximo' => '2800',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			407 => 
			array (
				'id' => 408,
				'modelo' => 'PAY-2',
				'peso_maximo' => '5000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			408 => 
			array (
				'id' => 409,
				'modelo' => 'PC-68',
				'peso_maximo' => '2000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			409 => 
			array (
				'id' => 410,
				'modelo' => 'PC12',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			410 => 
			array (
				'id' => 411,
				'modelo' => 'PH-206',
				'peso_maximo' => '0',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			411 => 
			array (
				'id' => 412,
				'modelo' => 'PIPER-28',
				'peso_maximo' => '1450',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			412 => 
			array (
				'id' => 413,
				'modelo' => 'PR-M1',
				'peso_maximo' => '6000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			413 => 
			array (
				'id' => 414,
				'modelo' => 'PY1',
				'peso_maximo' => '4000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			414 => 
			array (
				'id' => 415,
				'modelo' => 'R-22',
				'peso_maximo' => '410',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			415 => 
			array (
				'id' => 416,
				'modelo' => 'R-44',
				'peso_maximo' => '800',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			416 => 
			array (
				'id' => 417,
				'modelo' => 'RANYE',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			417 => 
			array (
				'id' => 418,
				'modelo' => 'RF-10',
				'peso_maximo' => '850',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			418 => 
			array (
				'id' => 419,
				'modelo' => 'RL-893',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			419 => 
			array (
				'id' => 420,
				'modelo' => 'S-135',
				'peso_maximo' => '2700',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			420 => 
			array (
				'id' => 421,
				'modelo' => 'S-300C',
				'peso_maximo' => '0',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			421 => 
			array (
				'id' => 422,
				'modelo' => 'S-350',
				'peso_maximo' => '0',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			422 => 
			array (
				'id' => 423,
				'modelo' => 'S2R',
				'peso_maximo' => '2800',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			423 => 
			array (
				'id' => 424,
				'modelo' => 'SAAB-340B',
				'peso_maximo' => '13155',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			424 => 
			array (
				'id' => 425,
				'modelo' => 'SBR1',
				'peso_maximo' => '9000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			425 => 
			array (
				'id' => 426,
				'modelo' => 'SC-80',
				'peso_maximo' => '9000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			426 => 
			array (
				'id' => 427,
				'modelo' => 'SD-360',
				'peso_maximo' => '10387',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			427 => 
			array (
				'id' => 428,
				'modelo' => 'SE-210',
				'peso_maximo' => '52000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			428 => 
			array (
				'id' => 429,
				'modelo' => 'SF-34',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			429 => 
			array (
				'id' => 430,
				'modelo' => 'SIKORSKI',
				'peso_maximo' => '3500',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			430 => 
			array (
				'id' => 431,
				'modelo' => 'SK-59',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			431 => 
			array (
				'id' => 432,
				'modelo' => 'SK-76',
				'peso_maximo' => '0',
				'tipo_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			432 => 
			array (
				'id' => 433,
				'modelo' => 'SL-265',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			433 => 
			array (
				'id' => 434,
				'modelo' => 'SL-8',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			434 => 
			array (
				'id' => 435,
				'modelo' => 'SR-20',
				'peso_maximo' => '1500',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			435 => 
			array (
				'id' => 436,
				'modelo' => 'SR-22',
				'peso_maximo' => '1900',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			436 => 
			array (
				'id' => 437,
				'modelo' => 'SR22',
				'peso_maximo' => '1900',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			437 => 
			array (
				'id' => 438,
				'modelo' => 'ST-200',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			438 => 
			array (
				'id' => 439,
				'modelo' => 'SW-2',
				'peso_maximo' => '4600',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			439 => 
			array (
				'id' => 440,
				'modelo' => 'SW-3',
				'peso_maximo' => '5680',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			440 => 
			array (
				'id' => 441,
				'modelo' => 'SW-4',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			441 => 
			array (
				'id' => 442,
				'modelo' => 'T-39',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			442 => 
			array (
				'id' => 443,
				'modelo' => 'TB-9',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			443 => 
			array (
				'id' => 444,
				'modelo' => 'TS-60',
				'peso_maximo' => '2800',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			444 => 
			array (
				'id' => 445,
				'modelo' => 'TU-154M',
				'peso_maximo' => '100000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			445 => 
			array (
				'id' => 446,
				'modelo' => 'TWINS OSTER',
				'peso_maximo' => '5300',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			446 => 
			array (
				'id' => 447,
				'modelo' => 'V35B',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			447 => 
			array (
				'id' => 448,
				'modelo' => 'VU-93',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			448 => 
			array (
				'id' => 449,
				'modelo' => 'W-201',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			449 => 
			array (
				'id' => 450,
				'modelo' => 'WW-1123',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			450 => 
			array (
				'id' => 451,
				'modelo' => 'WW-1124',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			451 => 
			array (
				'id' => 452,
				'modelo' => 'WW-2',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			452 => 
			array (
				'id' => 453,
				'modelo' => 'WW-23',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			453 => 
			array (
				'id' => 454,
				'modelo' => 'WW-24',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			454 => 
			array (
				'id' => 455,
				'modelo' => 'XSH-500',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			455 => 
			array (
				'id' => 456,
				'modelo' => 'Y-12',
				'peso_maximo' => '12000',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			456 => 
			array (
				'id' => 457,
				'modelo' => 'YAK-40',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			457 => 
			array (
				'id' => 458,
				'modelo' => 'YAK-42',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			458 => 
			array (
				'id' => 459,
				'modelo' => 'YAK-42D',
				'peso_maximo' => '0',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			459 => 
			array (
				'id' => 460,
				'modelo' => 'YV-136T',
				'peso_maximo' => '4800',
				'tipo_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
		));
	}

}
