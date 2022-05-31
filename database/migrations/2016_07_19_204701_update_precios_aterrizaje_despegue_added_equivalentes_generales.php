<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePreciosAterrizajeDespegueAddedEquivalentesGenerales extends Migration {

	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('precios_aterrizajes_despegues', function(Blueprint $table){
			//Diurno Internacional
	        $table->integer('aplicar_minimo_diuInt_general')->default(0);
			$table->float('eq_bloqueMinimoDiuInt_general', 7, 2);
			//Nocturno Internacional
	        $table->integer('aplicar_minimo_nocInt_general')->default(0);
			$table->float('eq_bloqueMinimoNocInt_general', 7, 2);

			//Diurno Nacional
	        $table->integer('aplicar_minimo_diuNac_general')->default(0);
			$table->float('eq_bloqueMinimoDiuNac_general', 7, 2);
			//Nocturno Nacional
	        $table->integer('aplicar_minimo_nocNac_general')->default(0);
			$table->float('eq_bloqueMinimoNocNac_general', 7, 2);
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
