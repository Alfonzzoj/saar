<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePreciosAterrizajeDespegueAddedEquivalentes extends Migration {

	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('precios_aterrizajes_despegues', function(Blueprint $table){
			$table->float('eq_diurnoNac_general');
			$table->float('precio_diurnoNac_general');
			$table->float('eq_diurnoInt_general');
			$table->float('precio_diurnoInt_general');
			$table->float('eq_nocturNac_general');
			$table->float('precio_nocturNac_general');
			$table->float('eq_nocturInt_general');
			$table->float('precio_nocturInt_general');
		});
	}

	/**
	 * Reverse the migrations.
	 *s
	 * @return void
	 */
	public function down()
	{
		Schema::table('precios_aterrizajes_despegues', function(Blueprint $table)
		{
			//
		});
	}

}

			