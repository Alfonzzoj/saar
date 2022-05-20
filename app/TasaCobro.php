<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DecimalConverterTrait;
use App\Traits\DateConverterTrait;

class TasaCobro extends Model {


    use DecimalConverterTrait;
    use DateConverterTrait;

    protected $guarded = array();

    public function detalles()
    {
        return $this->hasMany('App\TasaCobroDetalle');
    }

    public function operaciones()
    {
        return $this->hasMany('App\Tasaop');
    }

    public function conciliado()
    {
        return $this->belongsTo('App\Conciliado');
    }

    public function delete() {
        $this->detalles()->delete();
        parent::delete();
    }

}
