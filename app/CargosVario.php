<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CargosVario extends Model {

	//

	protected $guarded = [];

	public function conceptos()
	{ 
		return $this->belongsTo('App\Concepto');
	}

	public function tipoPagoFormulario()
	{
			return $this->belongsTo('App\TipoPago','tipo_pago_formulario_id','id');
	}

	public function tipoPagoFHabilitacion()
	{
			return $this->belongsTo('App\TipoPago','tipo_pago_habilitacion_id','id');
	}

	public function tipoPagoDerechoAbordajeNac()
	{
			return $this->belongsTo('App\TipoPago','tipo_pago_derecho_abordaje_nac_id','id');
	}

	public function tipoPagoDerechoAbordajeInt()
	{
			return $this->belongsTo('App\TipoPago','tipo_pago_derecho_abordaje_int_id','id');
	}
}
