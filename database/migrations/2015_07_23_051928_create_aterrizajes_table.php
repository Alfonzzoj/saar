<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAterrizajesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('aterrizajes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->time('hora');
			$table->date('fecha');
			$table->integer('aeropuerto_id')->unsigned();
			$table->foreign('aeropuerto_id')->references('id')->on('aeropuertos');
			$table->integer('aeronave_id')->unsigned();
			$table->foreign('aeronave_id')->references('id')->on('aeronaves');
			$table->integer('cliente_id')->unsigned()->nullable();
			$table->foreign('cliente_id')->references('id')->on('clientes');
			$table->integer('tipoMatricula_id')->unsigned();
			$table->foreign('tipoMatricula_id')->references('id')->on('tipo_matriculas');
			$table->integer('nacionalidadVuelo_id')->unsigned()->nullable();
			$table->foreign('nacionalidadVuelo_id')->references('id')->on('nacionalidad_vuelos');
			$table->integer('piloto_id')->unsigned()->nullable();
			$table->foreign('piloto_id')->references('id')->on('pilotos');
			$table->integer('num_vuelo')->nullable();
			$table->integer('puerto_id')->unsigned()->nullable();
			$table->foreign('puerto_id')->references('id')->on('puertos');
			$table->integer('desembarqueAdultos')->default(0);
			$table->integer('desembarqueInfante')->default(0);
			$table->integer('desembarqueTercera')->default(0);
			$table->integer('desembarqueTransito')->default(0);
			$table->integer('despego')->default(0);
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
		Schema::drop('aterrizajes');
	}

}
