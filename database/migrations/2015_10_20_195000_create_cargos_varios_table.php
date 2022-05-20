<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargosVariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cargos_varios', function(Blueprint $table)
		{
			$table->increments('id');
			$table->float('eq_formulario');
			$table->float('precio_formulario');
			$table->float('eq_derechoHabilitacion');
			$table->float('precio_derechoHabilitacion');
			$table->float('eq_usoAbordajeSinHab');
			$table->float('precio_usoAbordajeSinHab');
			$table->float('eq_usoAbordajeConHab');
			$table->float('precio_usoAbordajeConHab');
			$table->integer('aeropuerto_id')->unsigned();
			$table->foreign('aeropuerto_id')->references('id')->on('aeropuertos');
			$table->integer('formularioCredito_id')->unsigned();
			$table->foreign('formularioCredito_id')->references('id')->on('conceptos');
			$table->integer('formularioContado_id')->unsigned();
			$table->foreign('formularioContado_id')->references('id')->on('conceptos');		
			$table->integer('habilitacionCredito_id')->unsigned();
			$table->foreign('habilitacionCredito_id')->references('id')->on('conceptos');		
			$table->integer('habilitacionContado_id')->unsigned();
			$table->foreign('habilitacionContado_id')->references('id')->on('conceptos');	
			$table->integer('abordajeCredito_id')->unsigned();
			$table->foreign('abordajeCredito_id')->references('id')->on('conceptos');		
			$table->integer('abordajeContado_id')->unsigned();
			$table->foreign('abordajeContado_id')->references('id')->on('conceptos');
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
		Schema::drop('cargos_varios');
	}

}
