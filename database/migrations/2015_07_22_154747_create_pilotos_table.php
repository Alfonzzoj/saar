<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePilotosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pilotos', function(Blueprint $table)
		{

            $table->increments('id');
            $table->string('nombre', 100);
            $table->integer('nacionalidad_id')->unsigned();
            $table->foreign('nacionalidad_id')->references('id')->on('pais');
            $table->string('documento_identidad');
            $table->string('telefono');
            $table->string('licencia');
            $table->integer('estado')->default(0);
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
		Schema::drop('pilotos');
	}

}