<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecibosAnuladosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recibos_anulados', function(Blueprint $table)
		{
			$table->increments('id');
			$table->date('fecha');
			$table->integer('nroRecibo');
            $table->integer('cobro_id')->unsigned();
            $table->foreign('cobro_id')->references('id')->on('cobros')->onDelete('cascade');
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
		Schema::drop('recibos_anulados');
	}

}
