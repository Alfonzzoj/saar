<?php namespace App\Traits;

trait DateConverterTrait {

    protected function setFecha($fecha, $attr){
        $this->attributes[$attr]=\Carbon\Carbon::createFromFormat('d/m/Y', $fecha);
    }

    protected function getFecha($fecha){
        $carbon=\Carbon\Carbon::now();
        $carbon->timezone='America/Caracas';
        if(!is_null($fecha) && $fecha!="" && is_string($fecha))
            $carbon= \Carbon\Carbon::createFromFormat('Y-m-d', preg_replace( "/\s+\d+:\d+:\d+.?\d+/", "", $fecha));
        if(is_a($fecha, 'Carbon\Carbon'))
            $carbon=$fecha;
        return $carbon->format('d/m/Y');
    }
}
