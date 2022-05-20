<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRecibosAnuladosAddComentario extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('recibos_anulados', function(Blueprint $table)
		{
            $table->text('comentario');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('recibos_anulados', function(Blueprint $table)
		{
			//
		});
	}

}
