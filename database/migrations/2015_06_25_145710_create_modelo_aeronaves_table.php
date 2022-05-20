<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModeloAeronavesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('modelo_aeronaves', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('modelo', 50);
			$table->string('peso_maximo', 20);
			$table->integer('tipo_id')->unsigned();
			$table->foreign('tipo_id')->references('id')->on('tipo_aeronaves');
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
		Schema::drop('modelo_aeronaves');
	}

}
