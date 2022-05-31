<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DecimalConverterTrait;

class Ajuste extends Model {

    use DecimalConverterTrait;

    protected $guarded = array();

    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }

    public function cobro()
    {
        return $this->belongsTo('App\Cobro');
    }

    public function setMontoAttribute($numero)
    {
        $this->parseDecimal($numero,'monto');
    }
}
