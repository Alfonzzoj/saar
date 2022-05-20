<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstacionamientoAeronavesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('estacionamiento_aeronaves', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('tiempoLibreInt');
			$table->float('eq_bloqueInt', 7, 4);
			$table->float('precio_estInt', 7, 2);
			$table->integer('minBloqueInt');
			$table->integer('tiempoLibreNac');
			$table->float('eq_bloqueNac', 7, 4);
			$table->float('precio_estNac', 7, 2);
			$table->integer('minBloqueNac');
			$table->integer('aeropuerto_id')->unsigned();
			$table->foreign('aeropuerto_id')->references('id')->on('aeropuertos');
			$table->integer('conceptoCredito_id')->unsigned();
			$table->foreign('conceptoCredito_id')->references('id')->on('conceptos');
			$table->integer('conceptoContado_id')->unsigned();
			$table->foreign('conceptoContado_id')->references('id')->on('conceptos');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('estacionamiento_aeronaves');
	}

}
