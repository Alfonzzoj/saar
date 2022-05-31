<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateConceptosAddedCondicionPago extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('conceptos', function(Blueprint $table)
		{
            $table->enum('condicionPago', ['Ambas', 'Crédito', 'Contado']);
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
			//
		});
	}

}
