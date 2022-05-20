<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTasasTableActivaCv extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tasas', function(Blueprint $table)
		{
            $table->boolean('cv')->default(false);
            $table->boolean('activa')->default(false);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tasas', function(Blueprint $table)
		{

		});
	}

}
