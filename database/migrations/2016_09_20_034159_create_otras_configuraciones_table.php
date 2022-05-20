<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtrasConfiguracionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('otras_configuraciones', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('diasVencimientoCred');
            $table->integer('aeropuerto_id')->unsigned();
            $table->foreign('aeropuerto_id')->references('id')->on('aeropuertos')->onDelete('cascade');
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
		Schema::drop('otras_configuraciones');
	}

}
