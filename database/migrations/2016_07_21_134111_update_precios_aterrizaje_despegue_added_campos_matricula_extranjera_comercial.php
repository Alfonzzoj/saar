<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePreciosAterrizajeDespegueAddedCamposMatriculaExtranjeraComercial extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('precios_aterrizajes_despegues', function(Blueprint $table){
			$table->float('eq_diurnoNac_ext');
			$table->float('precio_diurnoNac_ext');
			$table->float('eq_diurnoInt_ext');
			$table->float('precio_diurnoInt_ext');
			$table->float('eq_nocturNac_ext');
			$table->float('precio_nocturNac_ext');
			$table->float('eq_nocturInt_ext');
			$table->float('precio_nocturInt_ext');
	        $table->integer('aplicar_minimo_diuInt_ext')->default(0);
			$table->float('eq_bloqueMinimoDiuInt_ext', 7, 2);
	        $table->integer('aplicar_minimo_nocInt_ext')->default(0);
			$table->float('eq_bloqueMinimoNocInt_ext', 7, 2);
	        $table->integer('aplicar_minimo_diuNac_ext')->default(0);
			$table->float('eq_bloqueMinimoDiuNac_ext', 7, 2);
	        $table->integer('aplicar_minimo_nocNac_ext')->default(0);
			$table->float('eq_bloqueMinimoNocNac_ext', 7, 2);
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
