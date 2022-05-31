<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEstacionamitoopsAddedEstacionamientoFkey extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('estacionamientoops', function(Blueprint $table)
		{
            $table->integer('estacionamiento_id')->unsigned();
            $table->foreign('estacionamiento_id')->references('id')->on('estacionamientos');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('estacionamientoops', function(Blueprint $table)
		{
            $table->dropForeign('estacionamientoops_estacionamiento_id_foreign');
		});
	}

}
