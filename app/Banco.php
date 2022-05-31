<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model {

    protected $fillable = ['nombre', 'saldo', 'mostrarEnResumen'];

    protected $hidden = ['created_at', 'updated_at'];

    public function cuentas()
    {
        return $this->hasMany('App\Bancoscuenta');
    }
    public function cobros()
    {
        return $this->hasMany('App\Cobrospago');
    }

}
