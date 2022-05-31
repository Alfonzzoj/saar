<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Bancoscuenta extends Model {

    protected $fillable = ['descripcion', 'isActivo'];

    protected $hidden = ['created_at', 'updated_at'];

    public function banco()
    {
        return $this->belongsTo('App\Banco');
    }
    public function cobros()
    {
        return $this->hasMany('App\Cobrospago');
    }

}
