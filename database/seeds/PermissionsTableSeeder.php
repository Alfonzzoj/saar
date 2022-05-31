<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('permissions')->delete();
        
		\DB::table('permissions')->insert(array (
			0 => 
			array (
				'id' => 1,
				'name' => 'Menu contrato',
				'slug' => 'menu.contrato',
				'description' => NULL,
				'model' => NULL,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			1 => 
			array (
				'id' => 2,
				'name' => 'Menu factura',
				'slug' => 'menu.factura',
				'description' => NULL,
				'model' => NULL,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			2 => 
			array (
				'id' => 3,
				'name' => 'Menu cliente',
				'slug' => 'menu.cliente',
				'description' => NULL,
				'model' => NULL,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			3 => 
			array (
				'id' => 4,
				'name' => 'Menu modulo',
				'slug' => 'menu.modulo',
				'description' => NULL,
				'model' => NULL,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			4 => 
			array (
				'id' => 5,
				'name' => 'Menu concepto',
				'slug' => 'menu.concepto',
				'description' => NULL,
				'model' => NULL,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			5 => 
			array (
				'id' => 6,
				'name' => 'Menu pilotos',
				'slug' => 'menu.piloto',
				'description' => NULL,
				'model' => NULL,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			6 => 
			array (
				'id' => 7,
				'name' => 'Menu aeronaves',
				'slug' => 'menu.aeronave',
				'description' => NULL,
				'model' => NULL,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			7 => 
			array (
				'id' => 8,
				'name' => 'Menu puertos',
				'slug' => 'menu.puerto',
				'description' => NULL,
				'model' => NULL,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			8 => 
			array (
				'id' => 9,
				'name' => 'Menu hangares',
				'slug' => 'menu.hangar',
				'description' => NULL,
				'model' => NULL,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			9 => 
			array (
				'id' => 10,
				'name' => 'Menu modelo aeronave',
				'slug' => 'menu.modeloaeronave',
				'description' => NULL,
				'model' => NULL,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			10 => 
			array (
				'id' => 11,
				'name' => 'Menu usuario',
				'slug' => 'menu.usuario',
				'description' => NULL,
				'model' => NULL,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			11 => 
			array (
				'id' => 12,
				'name' => 'Menu cobranza',
				'slug' => 'menu.cobranza',
				'description' => NULL,
				'model' => NULL,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			12 => 
			array (
				'id' => 13,
				'name' => 'Menu estacionamiento',
				'slug' => 'menu.estacionamiento',
				'description' => NULL,
				'model' => NULL,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			13 => 
			array (
				'id' => 14,
				'name' => 'Menu grupos de usuario',
				'slug' => 'menu.role',
				'description' => NULL,
				'model' => NULL,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			14 => 
			array (
				'id' => 15,
				'name' => 'Menu Aterrizaje',
				'slug' => 'menu.aterrizaje',
				'description' => NULL,
				'model' => NULL,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			15 => 
			array (
				'id' => 16,
				'name' => 'Menu Despegue',
				'slug' => 'menu.despegue',
				'description' => NULL,
				'model' => NULL,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			16 => 
			array (
				'id' => 17,
				'name' => 'Menu Carga',
				'slug' => 'menu.carga',
				'description' => NULL,
				'model' => NULL,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			17 => 
			array (
				'id' => 18,
				'name' => 'Menu Configuración de Precios SCV',
				'slug' => 'menu.preciosSCV',
				'description' => NULL,
				'model' => NULL,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			18 => 
			array (
				'id' => 19,
				'name' => 'Menú Información',
				'slug' => 'menu.informacion',
				'description' => NULL,
				'model' => NULL,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			19 => 
			array (
				'id' => 20,
				'name' => 'Menú Reportes SCV',
				'slug' => 'menu.reporteSCV',
				'description' => NULL,
				'model' => NULL,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			20 => 
			array (
				'id' => 21,
				'name' => 'Menú Reportes Recaudación',
				'slug' => 'menu.reporteRecaudacion',
				'description' => NULL,
				'model' => NULL,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			21 => 
			array (
				'id' => 22,
				'name' => 'Menú Tasas',
				'slug' => 'menu.tasas',
				'description' => NULL,
				'model' => NULL,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			22 => 
			array (
				'id' => 23,
				'name' => 'Menú Systas',
				'slug' => 'menu.systas',
				'description' => NULL,
				'model' => NULL,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
		));
	}

}
