<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEstacionamientosAddedTarjetaCosto extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('estacionamientos', function(Blueprint $table)
		{
            $table->double('tarjetacosto',15,2);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('estacionamientos', function(Blueprint $table)
		{
			//
		});
	}

}
