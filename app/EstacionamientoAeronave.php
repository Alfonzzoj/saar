<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class EstacionamientoAeronave extends Model {

	//
	protected $guarded = [];

		public function conceptos()
    { 
        return $this->belongsTo('App\Concepto');
    }

    public function tipo_pago_gen_matricula_nac_nac()
    {
        return $this->belongsTo('App\TipoPago','tipo_pago_gen_matricula_nac_nac_id','id');
    }

    public function tipo_pago_gen_matricula_nac_int()
    {
        return $this->belongsTo('App\TipoPago','tipo_pago_gen_matricula_nac_int_id','id');
    }

    public function tipo_pago_gen_matricula_int_nac()
    {
        return $this->belongsTo('App\TipoPago','tipo_pago_gen_matricula_int_nac_id','id');
    }

    public function tipo_pago_gen_matricula_int_int()
    {
        return $this->belongsTo('App\TipoPago','tipo_pago_gen_matricula_int_int_id','id');
    }

    //los otros 4

    public function tipo_pago_com_matricula_nac_nac()
    {
        return $this->belongsTo('App\TipoPago','tipo_pago_com_matricula_nac_nac_id','id');
    }

    public function tipo_pago_com_matricula_nac_int()
    {
        return $this->belongsTo('App\TipoPago','tipo_pago_com_matricula_nac_int_id','id');
    }

    public function tipo_pago_com_matricula_int_nac()
    {
        return $this->belongsTo('App\TipoPago','tipo_pago_com_matricula_int_nac_id','id');
    }

    public function tipo_pago_com_matricula_int_int()
    {
        return $this->belongsTo('App\TipoPago','tipo_pago_com_matricula_int_int_id','id');
    }
}
