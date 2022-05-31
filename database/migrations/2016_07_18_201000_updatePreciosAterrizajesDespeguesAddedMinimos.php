<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePreciosAterrizajesDespeguesAddedMinimos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('precios_aterrizajes_despegues', function(Blueprint $table){
			//Diurno Internacional
	        $table->integer('aplicar_minimo_diuInt')->default(0);
			$table->float('eq_bloqueMinimoDiuInt', 7, 2);
			//Nocturno Internacional
	        $table->integer('aplicar_minimo_nocInt')->default(0);
			$table->float('eq_bloqueMinimoNocInt', 7, 2);

			//Diurno Nacional
	        $table->integer('aplicar_minimo_diuNac')->default(0);
			$table->float('eq_bloqueMinimoDiuNac', 7, 2);
			//Nocturno Nacional
	        $table->integer('aplicar_minimo_nocNac')->default(0);
			$table->float('eq_bloqueMinimoNocNac', 7, 2);
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
