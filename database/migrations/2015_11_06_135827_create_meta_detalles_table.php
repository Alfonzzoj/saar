<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetaDetallesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('meta_detalles', function(Blueprint $table)
		{
			$table->increments('id');

            $table->integer('meta_id')->unsigned();

            $table->foreign('meta_id')->references('id')->on('metas');

            $table->integer('concepto_id')->unsigned();

            $table->foreign('concepto_id')->references('id')->on('conceptos');

            $table->float('gobernacion_meta');

            $table->float('saar_meta');

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
		Schema::drop('meta_detalles');
	}

}
