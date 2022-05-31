<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DateConverterTrait;

class Aterrizaje extends Model {

    use DateConverterTrait;

	protected $guarded = [];

    public static function filter($fecha, $hora, $aeronave_id, $num_vuelo, $tipoMatricula_id, $puerto_id, $cliente_id,  $despego, $aeropuerto_id)
    {
        return Aterrizaje::fecha($fecha)
        				->hora($hora)
        				->aeronave($aeronave_id)
        				->numeroVuelo($num_vuelo)
        				->tipoVuelo($tipoMatricula_id)
        				->procedencia($puerto_id)
                        ->cliente($cliente_id)
                        ->despego($despego)
                        ->aeropuerto($aeropuerto_id)
	                    ->orderBy('id', 'DESC');
    }

	public function setFechaAttribute($fecha)
	{
        $this->setFecha($fecha,'fecha');
	}

	public function getFechaAttribute($fecha)
	{
        return $this->getFecha($fecha);
	}

	public function puerto()
	{
		return $this->belongsTo('App\Puerto');
	}

	public function piloto()
	{
		return $this->belongsTo('App\Piloto');
	}


	public function nacionalidad_vuelo()
	{
		return $this->belongsTo('App\NacionalidadVuelo', 'nacionalidadVuelo_id');
	}

	public function aeronave()
	{
		return $this->belongsTo('App\Aeronave');
	}


	public function cliente()
	{
		return $this->belongsTo('App\Cliente');
	}

	public function tipo()
	{
		return $this->belongsTo('App\TipoMatricula', 'tipoMatricula_id');
	}

	public function despegue()
	{
		return $this->hasOne('App\Despegue');
	}

	public function factura()
	{
		return $this->hasMany('App\Factura');
	}

	public function aeropuerto()
    {
        return $this->belongsTo('App\Aeropuerto');
    }



    //Filtros
    public function scopeFecha($query, $fecha)
    {
        if (trim($fecha)!= "0000-00-00"){
            $query->where('fecha',$fecha);
        }else{
            $query->where('fecha', '>=', $fecha);
        }
    } 
    public function scopeHora($query, $hora)
    {
        if (trim($hora)!= "00:00:00"){
            $query->where('hora','like', "%$hora%");
        }else{
            $query->where('hora', '>=', $hora);
        }
    } 
    public function scopeAeronave($query, $aeronave_id)
    {
        if ($aeronave_id != ""){
            $query->where('aeronave_id', $aeronave_id);
        }
    }  
    public function scopeNumeroVuelo($query, $num_vuelo)
    {
        if (trim($num_vuelo)!= ""){
            $query->where('num_vuelo',$num_vuelo);
        }
    }  
    public function scopeTipoVuelo($query, $tipoMatricula_id)
    {
        if ($tipoMatricula_id != ""){
            $query->where('tipoMatricula_id', $tipoMatricula_id);
        }
    } 
    public function scopeProcedencia($query, $puerto_id)
    {
        if ($puerto_id != ""){
            $query->where('puerto_id', $puerto_id);
        }
    } 
    public function scopeCliente($query, $cliente_id)
    {
        if ($cliente_id != ""){
            $query->where('cliente_id', $cliente_id);
        }
    } 
    public function scopeAeropuerto($query, $aeropuerto_id)
    {
        if ($aeropuerto_id != ""){
            $query->where('aeropuerto_id', $aeropuerto_id);
        }
    }
    public function scopeDespego($query, $despego)
    {
        $query->where('despego', $despego);
    }
}
