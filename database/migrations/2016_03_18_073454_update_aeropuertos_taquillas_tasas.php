<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAeropuertosTaquillasTasas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('aeropuertos', function(Blueprint $table)
		{
			$table->integer('n_tasas_taquillas');
			$table->integer('n_tasas_turnos');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('aeropuertos', function(Blueprint $table)
		{
			//
		});
	}

}
