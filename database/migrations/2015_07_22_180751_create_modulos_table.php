<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('modulos', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('nombre', 100);
            $table->text('descripcion');
            $table->string('nFacturaPrefix', 100);
            $table->string('nControlPrefix', 100);
            $table->boolean('isRetencion');
            $table->boolean('isPredeterminado');
            $table->integer('aeropuerto_id')->unsigned();
            $table->foreign('aeropuerto_id')->references('id')->on('aeropuertos');
            $table->timestamps();
		});

        Schema::table('conceptos', function(Blueprint $table)
        {
            $table->integer('modulo_id')->unsigned()->nullable();
            $table->foreign('modulo_id')->references('id')->on('modulos');
        });


	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('conceptos', function(Blueprint $table)
        {
            $table->dropForeign("conceptos_modulo_id_foreign");
            $table->dropColumn('modulo_id');
        });
		Schema::drop('modulos');
	}

}
