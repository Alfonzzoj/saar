<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Estacionamientoconcepto extends Model {


    protected $fillable = ['nombre', 'costo'];

    protected $hidden = ['created_at', 'updated_at'];

    public function estacionamiento()
    {
        return $this->belongsTo('App\Estacionamiento');
    }

}
