<?php namespace App\Traits;

trait DecimalConverterTrait {

    //si le paso un string con formato de decimal español lo transforma a float
    //si attr es distinto de null, se debe utilizar solo para modelos para setear el dato en el atributo
    protected function parseDecimal($numero, $attr=null){
        if(is_string($numero)){
            $numero=preg_replace ( '/\./i', "", $numero );
            $numero=preg_replace ( '/\,/i', ".", $numero );
            $numero=floatval($numero);
        }
        if($attr)
            $this->attributes[$attr]=$numero;
        else
           return $numero;
    }

}
