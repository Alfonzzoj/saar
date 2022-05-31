<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePuertosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('puertos', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('nombre', 50);
            $table->string('siglas', 20);
            $table->integer('estado')->default(0);
            $table->integer('pais_id')->unsigned();
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
		Schema::drop('puertos');
	}

}
