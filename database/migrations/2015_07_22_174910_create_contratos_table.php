<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

        Schema::create('conceptos', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('codpre',255);
            $table->string('nompre',255);
            $table->string('codcta',255);
            $table->char('stacod',1);
            $table->string('coduni',255);
            $table->float('iva')->unsigned();
            $table->integer('aeropuerto_id')->unsigned();
            $table->foreign('aeropuerto_id')->references('id')->on('aeropuertos');
            $table->timestamps();
        });


		Schema::create('contratos', function(Blueprint $table)
		{
			$table->increments('id');


            /**
             * Informacion basica
             */
            $table->string('nContrato',100)->unique();
            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->integer('concepto_id')->unsigned();
            $table->foreign('concepto_id')->references('id')->on('conceptos');
            $table->float('monto')->unsigned();
            $table->enum('montoTipo', ['Mensual', 'Anual']);
            $table->date('fechaInicio');
            $table->date('fechaVencimiento');
            $table->boolean('isReanudacionAutomatica');
            $table->integer('mesesReanudacion');
            $table->boolean('isGeneracionAutomaticaFactura');
            $table->integer('diaGeneracion');
            $table->text('consideracion');


            /**
             * Extra
             */
            $table->string('metros',100);
            $table->string('responsable',255);
            $table->string('telefono',100);
            $table->text('ubicacion');
            $table->text('descripcion');
            $table->text('imagen');

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
		Schema::drop('contratos');
        Schema::drop('conceptos');
	}

}
