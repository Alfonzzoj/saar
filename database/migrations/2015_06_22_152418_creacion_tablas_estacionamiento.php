<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionTablasEstacionamiento extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('estacionamientos', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('nTaquillas');
            $table->integer('nTurnos');
			$table->timestamps();
		});

        Schema::create('estacionamientoportons', function(Blueprint $table)
        {
            $table->increments('id');
            $table->char('nombre', 150);
            $table->integer('estacionamiento_id')->unsigned();
            $table->foreign('estacionamiento_id')->references('id')->on('estacionamientos');
            $table->timestamps();
        });

        Schema::create('estacionamientoconceptos', function(Blueprint $table)
        {
            $table->increments('id');
            $table->char('nombre', 150);
            $table->float('costo');
            $table->integer('estacionamiento_id')->unsigned();
            $table->foreign('estacionamiento_id')->references('id')->on('estacionamientos');
            $table->timestamps();
        });

        Schema::create('estacionamientoops', function(Blueprint $table)
        {
            $table->increments('id');
            $table->date('fecha');
            $table->integer('nTaquillas');
            $table->integer('nTurnos');
            $table->float('total');
            $table->float('depositado');
            $table->timestamps();
        });

        Schema::create('estacionamientooptickets', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('econcepto_id')->unsigned();
            $table->foreign('econcepto_id')->references('id')->on('estacionamientoconceptos');
            $table->integer('taquilla');
            $table->integer('turno');
            $table->float('costo');
            $table->integer('cantidad');
            $table->float('monto');
            $table->integer('estacionamientoop_id')->unsigned();
            $table->foreign('estacionamientoop_id')->references('id')->on('estacionamientoops');

            $table->timestamps();
        });
        Schema::create('estacionamientoopticketsdepositos', function(Blueprint $table)
        {
            $table->increments('id');
            $table->date('fecha');
            $table->integer('banco_id')->unsigned();
            $table->integer('bancoscuenta_id')->unsigned();
            $table->float('total');
            $table->char('deposito',150);
            $table->integer('estacionamientoop_id')->unsigned();
            $table->foreign('estacionamientoop_id')->references('id')->on('estacionamientoops');
            $table->timestamps();
        });
        Schema::create('estacionamientoclientes', function(Blueprint $table)
        {
            $table->increments('id');
            $table->char('nombre', 150);
            $table->integer('cantidad');
            $table->integer('costoUnidad')->unsigned();
            $table->date('fechaSuscripcion');
            $table->boolean('isActivo');
            $table->integer('nPagos');
            $table->integer('estacionamiento_id')->unsigned();
            $table->foreign('estacionamiento_id')->references('id')->on('estacionamientos');
            $table->timestamps();
        });
        Schema::create('estacionamientooptarjetas', function(Blueprint $table)
        {
            $table->increments('id');
            $table->date('fecha');
            $table->integer('estacionamientocliente_id')->unsigned();
            $table->foreign('estacionamientocliente_id')->references('id')->on('estacionamientoclientes');
            $table->integer('cantidad');
            $table->integer('banco_id')->unsigned();
            $table->integer('bancoscuenta_id')->unsigned();
            $table->float('total');
            $table->char('deposito',150);
            $table->integer('estacionamientoop_id')->unsigned();
            $table->foreign('estacionamientoop_id')->references('id')->on('estacionamientoops');
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
        Schema::dropIfExists('estacionamientooptarjetas');
        Schema::dropIfExists('estacionamientoclientes');
        Schema::dropIfExists('estacionamientoopticketsdepositos');
        Schema::dropIfExists('estacionamientooptickets');
		Schema::dropIfExists('estacionamientoops');
        Schema::dropIfExists('estacionamientoconceptos');
        Schema::dropIfExists('estacionamientoportons');
        Schema::dropIfExists('estacionamientos');
	}

}
