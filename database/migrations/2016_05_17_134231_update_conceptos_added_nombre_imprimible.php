<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateConceptosAddedNombreImprimible extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('conceptos', function(Blueprint $table)
		{
            $table->string('nombreImprimible', 100);
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
