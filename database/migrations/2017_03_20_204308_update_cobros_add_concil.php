<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCobrosAddConcil extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cobros', function(Blueprint $table)
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
		Schema::table('cobros', function(Blueprint $table)
		{
			//
		});
	}

}