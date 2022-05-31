<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaUsuario extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuarios', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('username', 200);
			$table->string('password', 100);
			$table->string('fullname', 200);
			$table->integer('estado');
			$table->integer('departamento_id')->unsigned()->nullable();
			$table->integer('aeropuerto_id')->unsigned()->nullable();
			$table->integer('cargo_id')->unsigned()->nullable();
			$table->string('directo', 4);
			$table->string('email');
            $table->rememberToken();
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
		Schema::drop('usuarios');
	}

}
