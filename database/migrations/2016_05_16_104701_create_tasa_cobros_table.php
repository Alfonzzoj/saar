<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasaCobrosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('tasa_cobros', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('aeropuerto_id')->unsigned();
            $table->foreign('aeropuerto_id')->references('id')->on('aeropuertos');
            $table->date('fecha');
            $table->boolean('cv')->default(false);
            $table->timestamps();
        });

		Schema::create('tasa_cobro_detalles', function(Blueprint $table)
		{
            $table->increments('id');
            $table->enum('tipo',["D", "NC"]);
            $table->date('fecha');
            $table->integer('banco_id')->unsigned();
            $table->foreign('banco_id')->references('banco_id')->on('bancoscuentas');
            $table->integer('cuenta_id')->unsigned();
            $table->foreign('cuenta_id')->references('id')->on('bancoscuentas');
            $table->string('ncomprobante', 150);
            $table->double('monto', 15, 2);

            $table->integer('tasa_cobro_id')->unsigned();
            $table->foreign('tasa_cobro_id')->references('id')->on('tasa_cobros')->onDelete('cascade');
            $table->timestamps();
		});

        Schema::table('tasaops', function(Blueprint $table)
        {
            $table->integer('tasa_cobro_id')->unsigned()->nullable();
            $table->foreign('tasa_cobro_id')->references('id')->on('tasa_cobros')->onDelete('set null');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tasa_cobros_detalles');
		Schema::drop('tasa_cobros');
	}

}
