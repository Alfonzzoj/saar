<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OtrosCargo extends Model {

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $fillable = ['tipo_pago_id','nombre_cargo', 'precio_cargo', 'peso_desde', 'peso_hasta', 'conceptoCredito_id', 'conceptoContado_id', 'concepto_id', 'cantidad_unidades', 'tipo_matricula', 'nacionalidad_matricula', 'procedencia', 'aeropuerto_id'];
    
    protected $guarded = [];

    public function conceptos()
    {
        return $this->belongsTo('App\Concepto');
    }

    public function despegue()
    {
        return $this->belongsToMany('App\Despegue', 'despegue_otros_cargo', 'otrosCargo_id', 'despegue_id')
                    ->withPivot('monto')
                    ->withTimestamps();
    }

    public function tipo_pago()
    {
        return $this->belongsTo('App\TipoPago');
    }

    public static function updateOrCreate(array $attributes, array $values = array())
    {
        $instance = static::firstOrNew($attributes);

        $instance->fill($values)->save();

        return $instance;
    }

}
