<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Aeronave extends Model {

    protected $guarded = [];

    public static function filter($matricula, $nacionalidad_id, $modelo_id, $tipo_id, $cliente_id)
    {
        return Aeronave::matricula($matricula)
                    ->nacionalidad($nacionalidad_id)
                    ->modelo($modelo_id)
                    ->tipoMatricula($tipo_id)
                    ->cliente($cliente_id)
                    ->orderBy('id', 'DESC');
    }
    public function tipo()
    {
        return $this->belongsTo('App\TipoMatricula');
    }
    public function hangar()
    {
        return $this->belongsTo('App\Hangar');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }
    public function modelo()
    {
        return $this->belongsTo('App\ModeloAeronave');
    }
    public function nacionalidad()
    {
        return $this->belongsTo('App\NacionalidadMatricula');
    }

    public function aterrizaje()
    {
        return $this->hasMany('App\Aterrizaje');
    }

    public function despegue()
    {
        return $this->hasMany('App\despegue');
    }

    public function carga()
    {
        return $this->hasMany('App\Carga');
    }

    //Filtros
    public function scopeMatricula($query, $matricula)
    {
        if (trim($matricula) != ""){
            $query->where('matricula', "LIKE", "%$matricula%");
        }
    } 
    public function scopeNacionalidad($query, $nacionalidad_id)
    {
        if ($nacionalidad_id != ""){
            $query->where('nacionalidad_id', $nacionalidad_id);
        }
    }  
    public function scopeModelo($query, $modelo_id)
    {
        if ($modelo_id != ""){
            $query->where('modelo_id', $modelo_id);
        }
    }  
    public function scopeTipoMatricula($query, $tipo_id)
    {
        if ($tipo_id != ""){
            $query->where('tipo_id', $tipo_id);
        }
    }     
    public function scopeCliente($query, $cliente_id)
    {
        if ($cliente_id != ""){
            $query->where('cliente_id', $cliente_id);
        }
    }       

}
