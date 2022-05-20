<?php

use Illuminate\Database\Seeder;

class ModulosTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
        
		\DB::table('modulos')->insert(array (
			0 => 
			array (
				'id' => 2,
				'nombre' => 'CANON',
				'descripcion' => 'ARRENDAMIENTO DE LOCALES COMERCIALES',
                'nFacturaPrefix' => 'PZO',
                'nControlPrefix' => 'PZO',
				'isRetencion' => 0,
				'isPredeterminado' => 0,
				'aeropuerto_id' => 1,
				'created_at' => '2015-08-04 11:10:52',
				'updated_at' => '2015-08-07 21:20:09',
			),
			1 => 
			array (
				'id' => 3,
				'nombre' => 'PUBLICIDAD',
				'descripcion' => 'INGRESOS POR ALQUILER DE ESPACIOS PUBLICITARIOS',
                'nFacturaPrefix' => 'PZO',
                'nControlPrefix' => 'PZO',
				'isRetencion' => 0,
				'isPredeterminado' => 0,
				'aeropuerto_id' => 1,
				'created_at' => '2015-08-07 21:20:37',
				'updated_at' => '2015-08-07 21:20:37',
			),
			2 => 
			array (
				'id' => 4,
				'nombre' => 'ESTACIONAMIENTO',
				'descripcion' => 'INGRESOS POR TICKETS DE ESTACIONAMIENTO DE VEHICULOS',
                'nFacturaPrefix' => 'PZO',
                'nControlPrefix' => 'PZO',
				'isRetencion' => 0,
				'isPredeterminado' => 0,
				'aeropuerto_id' => 1,
				'created_at' => '2015-08-07 21:21:06',
				'updated_at' => '2015-08-07 21:21:06',
			),
			3 => 
			array (
				'id' => 5,
				'nombre' => 'DOSAS',
				'descripcion' => 'MANEJO DE MOVIMIENTOS AERONAUTICOS POR CONTROL DE VUELO',
                'nFacturaPrefix' => 'D-PZO',
                'nControlPrefix' => 'D-PZO',
				'isRetencion' => 0,
				'isPredeterminado' => 0,
				'aeropuerto_id' => 1,
				'created_at' => '2015-08-07 21:21:53',
				'updated_at' => '2015-08-07 21:21:53',
			),
			4 => 
			array (
				'id' => 6,
				'nombre' => 'CARGA',
				'descripcion' => '',
                'nFacturaPrefix' => 'PZO',
                'nControlPrefix' => 'PZO',
				'isRetencion' => 0,
				'isPredeterminado' => 0,
				'aeropuerto_id' => 1,
				'created_at' => '2015-12-04 15:43:03',
				'updated_at' => '2015-12-04 15:43:03',
			),
		));
	}

}
