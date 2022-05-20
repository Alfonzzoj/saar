<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDespegueOtrosCargoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('despegue_otros_cargo', function(Blueprint $table)
		{
			$table->increments('id');
		    $table->integer('despegue_id')->unsigned();
		    $table->foreign('despegue_id')->references('id')->on('despegues');
		    $table->integer('otrosCargo_id')->unsigned();
		    $table->foreign('otrosCargo_id')->references('id')->on('otros_cargos');
		    $table->float('monto');
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
        Schema::drop('despegue_otros_cargo');
	}

}
