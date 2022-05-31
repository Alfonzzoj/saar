<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorariosAeronauticosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */	public function up()
	{
		Schema::create('horarios_aeronauticos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->time('operaciones_inicio');
			$table->time('operaciones_fin');
			$table->time('sol_salida');
			$table->time('sol_puesta');
			$table->integer('aeropuerto_id')->unsigned();
			$table->foreign('aeropuerto_id')->references('id')->on('aeropuertos');		
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
		Schema::drop('horarios_aeronauticos');
	}

}
