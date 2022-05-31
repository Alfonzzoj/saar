<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAeronavesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('aeronaves', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('matricula');
            $table->integer('nacionalidad_id')->unsigned();
            $table->foreign('nacionalidad_id')->references('id')->on('nacionalidad_matriculas');
            $table->integer('tipo_id')->unsigned();
            $table->foreign('tipo_id')->references('id')->on('tipo_matriculas');
            $table->integer('modelo_id')->unsigned();
            $table->foreign('modelo_id')->references('id')->on('modelo_aeronaves');
            $table->string('peso');
            $table->integer('cliente_id')->unsigned()->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->integer('hangar_id')->unsigned()->nullable();
            $table->foreign('hangar_id')->references('id')->on('hangars');
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
		Schema::drop('aeronaves');
	}

}
