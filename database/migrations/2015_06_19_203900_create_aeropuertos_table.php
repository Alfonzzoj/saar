<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAeropuertosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('aeropuertos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre', 150);
			$table->string('siglas', 10);
			$table->string('rif', 150);
			$table->string('nit', 150);
			$table->string('telefono', 150);
			$table->string('direccion', 1500);
			$table->string('email', 150);
			$table->string('director', 150);
			$table->string('gerente', 150);
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
		Schema::drop('aeropuertos');
	}

}
