<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class MetaDetalle extends Model {

    protected $guarded = [];

    public function concepto()
    {
        return $this->belongsTo('App\Concepto');
    }
}
