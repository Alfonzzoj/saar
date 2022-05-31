<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFacturasAddedAplicaMinimo extends Migration {

	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('facturas', function(Blueprint $table)
		{
            $table->boolean('aplica_minimo_aterrizaje')->default(false);
            $table->boolean('aplica_minimo_estacionamiento')->default(false);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('facturas', function(Blueprint $table)
		{

		});
	}

}
