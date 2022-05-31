<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEstacionamientoAeronavesAddedCamposMatriculaExtranjera extends Migration {

	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('estacionamiento_aeronaves', function(Blueprint $table)
		{
			$table->integer('tiempoLibreInt_general_ext');
			$table->float('eq_bloqueInt_general_ext', 7, 4);
			$table->float('precio_estInt_general_ext', 7, 2);
			$table->integer('minBloqueInt_general_ext');
			$table->integer('tiempoLibreNac_general_ext');
			$table->float('eq_bloqueNac_general_ext', 7, 4);
			$table->float('precio_estNac_general_ext', 7, 2);
			$table->integer('minBloqueNac_general_ext');
            $table->integer('aplicar_minimo_nac_general_ext')->default(0);
			$table->float('eq_bloqueMinimoNac_general_ext', 7, 2);
            $table->integer('aplicar_minimo_int_general_ext')->default(0);
			$table->float('eq_bloqueMinimoInt_general_ext', 7, 2);
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
