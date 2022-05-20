<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEstacionamientoAeronavesAddedMinimos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('estacionamiento_aeronaves', function(Blueprint $table)
		{
            $table->integer('aplicar_minimo_nac')->default(0);
			$table->float('eq_bloqueMinimoNac', 7, 2);
            $table->integer('aplicar_minimo_int')->default(0);
			$table->float('eq_bloqueMinimoInt', 7, 2);
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
