<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePreciosAterrizajeDespegueAddedCamposMatriculaExtranjera extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('precios_aterrizajes_despegues', function(Blueprint $table){
			$table->float('eq_diurnoNac_general_ext');
			$table->float('precio_diurnoNac_general_ext');
			$table->float('eq_diurnoInt_general_ext');
			$table->float('precio_diurnoInt_general_ext');
			$table->float('eq_nocturNac_general_ext');
			$table->float('precio_nocturNac_general_ext');
			$table->float('eq_nocturInt_general_ext');
			$table->float('precio_nocturInt_general_ext');
	        $table->integer('aplicar_minimo_diuInt_general_ext')->default(0);
			$table->float('eq_bloqueMinimoDiuInt_general_ext', 7, 2);
	        $table->integer('aplicar_minimo_nocInt_general_ext')->default(0);
			$table->float('eq_bloqueMinimoNocInt_general_ext', 7, 2);
	        $table->integer('aplicar_minimo_diuNac_general_ext')->default(0);
			$table->float('eq_bloqueMinimoDiuNac_general_ext', 7, 2);
	        $table->integer('aplicar_minimo_nocNac_general_ext')->default(0);
			$table->float('eq_bloqueMinimoNocNac_general_ext', 7, 2);
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
