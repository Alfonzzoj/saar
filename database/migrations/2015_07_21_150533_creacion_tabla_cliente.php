<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionTablaCliente extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::create('clientes', function(Blueprint $table)
		{
			$table->increments('id');
            /**
             * Primer tab (informacion basica) de la pantalla de crear usuario
             */
            $table->char('codigo',15);
            $table->char('cedRifPrefix',1)->nullable();
            $table->char('cedRif',100)->nullable();
            $table->char('nit',100)->nullable();
            $table->char('nombre',150);
            $table->enum('tipo', ['Aeronáutico', 'No Aeronáutico', 'Mixto']);
            $table->boolean('isActivo');
            $table->boolean('isEnvioAutomatico');
            $table->date('fechaIngreso');
            /**
             * Segundo tab (Ubicacion) de la pantalla de crear usuario
             */
            $table->text('direccion')->nullable();
            $table->char('ciudad',100)->nullable();
            $table->integer('pais_id')->unsigned();
            $table->foreign('pais_id')->references('id')->on('pais');
            $table->char('codpostal',15)->nullable();
            $table->char('telefonos',100)->nullable();
            $table->char('fax',100)->nullable();
            $table->char('responsable',200)->nullable();
            $table->char('email',200)->nullable();
            $table->char('web',255)->nullable();
            /**
             * Tercer tab (Informacio aeronautica) de la pantalla de crear usuario
             */
            //se tiene que hacer una tabla para la relacion con hangar
            /**
             * Cuarta tab (Credto y Saldo) de la pantalla de crear usuario
             */
            $table->float('limiteCredito')->nullable();
            $table->float('diasCredito')->nullable();
            $table->float('prontoPago')->nullable();
            $table->float('descTasa')->nullable();
            /**
             * Quinto tab (Extra) de la pantalla de crear usuario
             */
            $table->boolean('isContribuyente');
            $table->float('islrpercentage')->nullable();
            $table->float('ivapercentage')->nullable();
            /**
             * Sexto tab (Extra) de la pantalla de crear usuario
             */
            $table->text('comentario')->nullable();


            $table->timestamps();
		});

        Schema::table('estacionamientos', function(Blueprint $table)
        {
            $table->integer('aeropuerto_id')->unsigned();
            $table->foreign('aeropuerto_id')->references('id')->on('aeropuertos');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('estacionamientos', function(Blueprint $table)
        {
            $table->dropForeign("estacionamientos_aeropuerto_id_foreign");
            $table->dropColumn('aeropuerto_id');
        });
		Schema::dropIfExists('clientes');

	}

}
