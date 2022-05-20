<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model {

    protected $guarded = array();

    public function aeropuerto()
    {
        return $this->belongsTo('App\Aeropuerto');
    }

    public function conceptos()
    {
        return $this->hasMany('App\Concepto');
    }


    public function conceptosCantidad()
    {
        return $this->hasOne('App\Concepto')
            ->selectRaw('modulo_id, count(*) as aggregate')
            ->groupBy('modulo_id');
    }

    public function getConceptosCantidadAttribute()
    {
        // if relation is not loaded already, let's do it first
        if ( ! array_key_exists('conceptosCantidad', $this->relations))
            $this->load('conceptosCantidad');

        $related = $this->getRelation('conceptosCantidad');

        // then return the count directly
        return ($related) ? (int) $related->aggregate : 0;
    }

    public function facturas()
    {
        return $this->hasMany('App\Factura');
    }

    public function contratos()
    {
        return $this->hasManyThrough('App\Contrato', 'App\Concepto', 'modulo_id', 'concepto_id');
    }

    public function tieneContratosVigentes()
    {
        $hoy = \Carbon\Carbon::now()->lastOfMonth();
        $contratosPosibles = $this->contratos()->where('fechaInicio', '<=' ,$hoy)->where('fechaVencimiento', '>=', $hoy)->count();
        if ($contratosPosibles) {
            return true;
        }
        return false;
    }

}
