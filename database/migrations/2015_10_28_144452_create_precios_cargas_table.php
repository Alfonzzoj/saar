<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreciosCargasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('precios_cargas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->float('equivalenteUT', 8,3);
			$table->float('precio_carga',8,2)
			$table->float('toneladaPorBloque');
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
		Schema::drop('precios_cargas');
	}

}
