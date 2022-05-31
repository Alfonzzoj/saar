<?php

use Illuminate\Database\Seeder;

class CargosVariosTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
        
		\DB::table('cargos_varios')->insert(array (
			0 => 
			array (
				'id' => 1,
				'eq_formulario' => 0.14000000000000001332267629550187848508358001708984375,
				'eq_derechoHabilitacion' => 14,
				'eq_usoAbordajeSinHab' => 5.13999999999999968025576890795491635799407958984375,
				'eq_usoAbordajeConHab' => 5.70999999999999996447286321199499070644378662109375,
				'aeropuerto_id' => 1,
				'formularioCredito_id' => 71,
				'formularioContado_id' => 57,
				'habilitacionCredito_id' => 70,
				'habilitacionContado_id' => 56,
				'abordajeCredito_id' => 72,
				'abordajeContado_id' => 58,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2015-12-08 01:57:03',
			),
		));
	}

}
