<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionTablasBancosCuentas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bancos', function(Blueprint $table)
		{
			$table->increments('id');
            $table->char('nombre', 150);
			$table->timestamps();
		});

        Schema::create('bancoscuentas', function(Blueprint $table)
        {
            $table->increments('id');
            $table->char('descripcion', 150);
            $table->boolean('isActivo');
            $table->integer('banco_id')->unsigned();
            $table->foreign('banco_id')->references('id')->on('bancos');
            $table->timestamps();
        });

        Schema::table('estacionamientooptarjetas', function(Blueprint $table)
        {
            $table->foreign('banco_id')->references('id')->on('bancos');
            $table->foreign('bancoscuenta_id')->references('id')->on('bancoscuentas');
        });

        Schema::table('estacionamientoopticketsdepositos', function(Blueprint $table)
        {
            $table->foreign('banco_id')->references('id')->on('bancos');
            $table->foreign('bancoscuenta_id')->references('id')->on('bancoscuentas');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('estacionamientooptarjetas', function(Blueprint $table)
        {
            $table->dropForeign("estacionamientooptarjetas_banco_id_foreign");
            $table->dropForeign("estacionamientooptarjetas_bancosCuenta_id_foreign");
        });
        Schema::table('estacionamientoopticketsdepositos', function(Blueprint $table)
        {
            $table->dropForeign("estacionamientoopticketsdepositos_banco_id_foreign");
            $table->dropForeign("estacionamientoopticketsdepositos_bancosCuenta_id_foreign");
        });
        Schema::dropIfExists('bancoscuentas');
		Schema::dropIfExists('bancos');
	}

}
