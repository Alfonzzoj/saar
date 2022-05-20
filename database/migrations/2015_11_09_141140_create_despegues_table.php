<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDespeguesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('despegues', function(Blueprint $table)
		{
			$table->increments('id');
			$table->time('hora');
			$table->date('fecha');
			$table->integer('num_vuelo')->nullable();
			$table->integer('aeronave_id')->unsigned();
			$table->integer('aeropuerto_id')->unsigned()->nullable();
			$table->foreign('aeropuerto_id')->references('id')->on('aeropuertos');
			$table->integer('puerto_id')->unsigned()->nullable();
			$table->foreign('puerto_id')->references('id')->on('puertos');
			$table->integer('piloto_id')->unsigned()->nullable();
			$table->foreign('piloto_id')->references('id')->on('pilotos');
			$table->integer('tipoMatricula_id')->unsigned();
			$table->foreign('tipoMatricula_id')->references('id')->on('tipo_matriculas');
			$table->integer('nacionalidadVuelo_id')->unsigned()->nullable();
			$table->foreign('nacionalidadVuelo_id')->references('id')->on('nacionalidad_vuelos');
			$table->foreign('aeronave_id')->references('id')->on('aeronaves');
			$table->integer('cliente_id')->unsigned()->nullable();
			$table->foreign('cliente_id')->references('id')->on('clientes');
			$table->integer('embarqueAdultos')->default(0);
			$table->integer('embarqueInfante')->default(0);
			$table->integer('embarqueTercera')->default(0);
			$table->integer('transitoAdultos')->default(0);
			$table->integer('transitoInfante')->default(0);
			$table->integer('transitoTercera')->default(0);
			$table->float('tiempo_estacionamiento')->nullable();
			$table->integer('numero_puenteAbordaje')->nullable();
			$table->float('tiempo_puenteAbord')->nullable();
			$table->float('peso_embarcado')->nullable();
			$table->float('peso_desembarcado')->nullable();
			$table->integer('cobrar_estacionamiento')->nullable();
			$table->integer('cobrar_puenteAbordaje')->nullable();
			$table->integer('cobrar_Formulario')->nullable();
			$table->integer('cobrar_AterDesp')->nullable();
			$table->integer('cobrar_carga')->nullable();
			$table->integer('cobrar_habilitacion')->nullable();
			$table->integer('cobrar_otrosCargos')->nullable();
			$table->integer('otrosCargo_id')->unsigned()->nullable();
			$table->foreign('otrosCargo_id')->references('id')->on('otros_cargos');
			$table->integer('aterrizaje_id')->unsigned();
			$table->foreign('aterrizaje_id')->references('id')->on('aterrizajes')->onDelete('cascade');
			$table->integer('factura_id')->nullable()->unsigned();
			$table->foreign('factura_id')->references('id')->on('facturas');
			$table->string('condicionPago')->nullable();
			$table->integer('facturado')->default(0);
			$table->integer('pagado')->default(0);

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
		Schema::drop('despegues');
	}

}
