<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConciliadosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('conciliados', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->date('fecha_conciliacion');
			$table->date('fecha_banco');
			$table->double('monto_banco', 20,2)->unsigned();
			$table->double('monto_lote', 20,2)->unsigned();
			$table->double('comision_bancaria', 20,2)->unsigned();
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
		Schema::drop('conciliados');
	}

}
