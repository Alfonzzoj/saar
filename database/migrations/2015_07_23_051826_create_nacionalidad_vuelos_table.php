<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNacionalidadVuelosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('nacionalidad_vuelos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('siglas', 2);
			$table->string('nombre', 20);
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
		Schema::drop('nacionalidad_vuelos');
	}

}
