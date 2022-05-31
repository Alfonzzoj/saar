<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEstacionamientoAeronavesAddedHorasLibres extends Migration {

	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('estacionamiento_aeronaves', function(Blueprint $table)
		{
			$table->integer('tiempoLibreInt_general');
			$table->float('eq_bloqueInt_general', 7, 4);
			$table->float('precio_estInt_general', 7, 2);
			$table->integer('minBloqueInt_general');
			$table->integer('tiempoLibreNac_general');
			$table->float('eq_bloqueNac_general', 7, 4);
			$table->float('precio_estNac_general', 7, 2);
			$table->integer('minBloqueNac_general');
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
