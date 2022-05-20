<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasaopdetallesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tasaopdetalles', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('tasaop_id')->unsigned();
            $table->foreign('tasaop_id')->references('id')->on('tasaops');
            $table->string('serie');
            $table->integer('inicio');
            $table->integer('fin');
            $table->double('costo', 20, 2);
            $table->integer('cantidad');
            $table->double('total', 20, 2);
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
		Schema::drop('tasaopdetalles');
	}

}
