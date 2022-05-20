<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DateConverterTrait;
use App\Traits\DecimalConverterTrait;


class Conciliado extends Model {

    use DateConverterTrait;
    use DecimalConverterTrait;


    protected $fillable = ['monto_banco', 'monto_lote', 'fecha_banco','fecha_conciliacion','comision_bancaria','nombre','descripcion','ncomprobante' ];

	public function setFechaAttribute($fecha)
	{
        $this->setFecha($fecha,'fecha');
	}

	public function getFechaAttribute($fecha)
	{
        return $this->getFecha($fecha);
	}

    public function cobros()
    {
        return $this->hasMany('App\Cobro');
    }

    public function tasasCobros()
    {
        return $this->hasMany('App\TasaCobro');
    }

}
