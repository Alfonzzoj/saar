<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEstacionamientoAeronavesAddedCamposMatriculaExtranjeraComercial extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('estacionamiento_aeronaves', function(Blueprint $table)
		{
			$table->integer('tiempoLibreInt_ext');
			$table->float('eq_bloqueInt_ext', 7, 4);
			$table->float('precio_estInt_ext', 7, 2);
			$table->integer('minBloqueInt_ext');
			$table->integer('tiempoLibreNac_ext');
			$table->float('eq_bloqueNac_ext', 7, 4);
			$table->float('precio_estNac_ext', 7, 2);
			$table->integer('minBloqueNac_ext');
            $table->integer('aplicar_minimo_nac_ext')->default(0);
			$table->float('eq_bloqueMinimoNac_ext', 7, 2);
            $table->integer('aplicar_minimo_int_ext')->default(0);
			$table->float('eq_bloqueMinimoInt_ext', 7, 2);
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
