<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreciosAterrizajesDespeguesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('precios_aterrizajes_despegues', function(Blueprint $table)
		{
			$table->increments('id');
			$table->float('eq_diurnoNac');
			$table->float('precio_diurnoNac');
			$table->float('eq_diurnoInt');
			$table->float('precio_diurnoInt');
			$table->float('eq_nocturNac');
			$table->float('precio_nocturNac');
			$table->float('eq_nocturInt');
			$table->float('precio_nocturInt');
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
		Schema::drop('precios_aterrizajes_despegues');
	}

}
