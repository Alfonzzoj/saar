<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEstacionamientoAeronavesAddedEquivalentesGenerales extends Migration {

	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('estacionamiento_aeronaves', function(Blueprint $table)
		{
            $table->integer('aplicar_minimo_nac_general')->default(0);
			$table->float('eq_bloqueMinimoNac_general', 7, 2);
            $table->integer('aplicar_minimo_int_general')->default(0);
			$table->float('eq_bloqueMinimoInt_general', 7, 2);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('estacionamiento_aeronaves', function(Blueprint $table)
		{
			//
		});
	}

}
