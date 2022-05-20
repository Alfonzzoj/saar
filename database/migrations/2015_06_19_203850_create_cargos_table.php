<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cargos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre', 150);
			$table->integer('departamento_id')->unsigned();
			$table->foreign('departamento_id')->references('id')->on('departamentos');
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
		Schema::drop('cargos');
	}

}
