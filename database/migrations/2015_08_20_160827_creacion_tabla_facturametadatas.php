<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionTablaFacturametadatas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('facturametadatas', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('factura_id')->unsigned();
            $table->foreign('factura_id')->references('id')->on('facturas')->onDelete('cascade');
            $table->integer('ncobros')->unsigned();
            $table->integer('ncuotas')->unsigned();
            $table->double('montoiniciocuota', 15,2);
            $table->double('montopagado', 15,2);
            $table->double('basepagado', 15,2);
            $table->double('ivapagado', 15,2);
            $table->double('islrpercentage');
            $table->double('ivapercentage');
            $table->double('retencion', 15,2);
            $table->double('total', 15,2);
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
		Schema::drop('facturametadatas');
	}

}
