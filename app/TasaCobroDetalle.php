<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DecimalConverterTrait;
use App\Traits\DateConverterTrait;

class TasaCobroDetalle extends Model {


        use DecimalConverterTrait;
        use DateConverterTrait;

        protected $guarded = array();

        public function cobro()
        {
            return $this->belongsTo('App\TasaCobro');
        }

        public function banco()
        {
            return $this->belongsTo('App\Banco');
        }

        public function cuenta()
        {
            return $this->belongsTo('App\Bancoscuenta');
        }

        public function setFechaAttribute($fecha)
        {
            $this->setFecha($fecha,'fecha');
        }
        public function getFechaAttribute($fecha)
        {
            return $this->getFecha($fecha);
        }

        public function setMontoAttribute($numero)
        {
            $this->parseDecimal($numero,'monto');
        }

        public function getTipoAttribute($value){
            $d=
                [
                    "D"  => "DEP",
                    "NC" => "NC",
                    "T"  => "TRAN"
                ];
            return (array_key_exists($value, $d))?$d[$value]:"";
        }


    //Filtros
    
    public function scopeNombrebanco($query, $banco_id)
    {
        if($banco_id != null){
            $query->where('banco_id', ($banco_id == '')?'>':'=', $banco_id);
        }
        
    }

    public function scopeNumerocuenta($query, $cuenta_id)
    {
        if($cuenta_id != null){
            $query->where('cuenta_id', ($cuenta_id == '')?'>':'=', $cuenta_id);
        }

    }

    public function scopeTipo($query, $tipo)
    {
        if($tipo != null){
            $query->where('tipo', ($tipo == '')?'%':$tipo);
        }

    }

    public function scopeReferencia($query, $ncomprobante)
    {
        if($ncomprobante != null){
            $query->where('ncomprobante', ($ncomprobante == '')?'>':'=', $ncomprobante);
        }

    }

    public function scopeCobro($query, $cobro_id)
    {
        if($cobro_id != null){
            $query->where('tasa_cobro_id', ($cobro_id == '')?'>':'=', $cobro_id);
        }

    }

    public function scopeConciliado($query){
        $query->where('conciliado', 0);
    }

    public function scopeAnno($query, $anno)
    {
        if($anno != null){
            $primerDiaAno=\Carbon\Carbon::create($anno, 1,1)->toDateString();
            $ultimoDiaAno=\Carbon\Carbon::create($anno, 12, 31)->toDateString();
            $query->whereBetween('fecha', array($primerDiaAno, $ultimoDiaAno));
        }

    }

    public function scopeFecha($query, $fecha_inicio, $fecha_fin)
    {
        if($fecha_inicio != null && $fecha_fin != null){
            if($fecha_inicio != '' && $fecha_fin != ''){
                $fecha_inicio = ($fecha_inicio == '')?'':\Carbon\Carbon::createFromFormat('d/m/Y', $fecha_inicio)->format('Y-m-d');
                $fecha_fin    = ($fecha_fin == '')?'':\Carbon\Carbon::createFromFormat('d/m/Y', $fecha_fin)->format('Y-m-d');
                $query->whereBetween('tasa_cobro_detalles.fecha', array($fecha_inicio, $fecha_fin));
            }else{
                $query->where('tasa_cobro_detalles.fecha', '>', '0000-00-00');
            }
        }
    }

}
