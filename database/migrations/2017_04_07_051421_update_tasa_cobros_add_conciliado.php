<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTasaCobrosAddConciliado extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tasa_cobros', function(Blueprint $table)
		{
            $table->integer('conciliado_id')->nullable()->unsigned();
            $table->foreign('conciliado_id')->references('id')->on('conciliados')->onDelete('cascade');;
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
