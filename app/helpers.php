<?php

function fechaEsMayor($primera, $segunda)
{
	$valoresPrimera = explode ("/", $primera);   
	$valoresSegunda = explode ("/", $segunda); 
	$diaPrimera    = $valoresPrimera[0];  
	$mesPrimera  = $valoresPrimera[1];  
	$anyoPrimera   = $valoresPrimera[2]; 
	$diaSegunda   = $valoresSegunda[0];  
	$mesSegunda = $valoresSegunda[1];  
	$anyoSegunda  = $valoresSegunda[2];
	$diasPrimeraJuliano = gregoriantojd($mesPrimera, $diaPrimera, $anyoPrimera);  
	$diasSegundaJuliano = gregoriantojd($mesSegunda, $diaSegunda, $anyoSegunda);     
	if(!checkdate($mesPrimera, $diaPrimera, $anyoPrimera)){
    // "La fecha ".$primera." no es válida";
		return 0;
	}elseif(!checkdate($mesSegunda, $diaSegunda, $anyoSegunda)){
    // "La fecha ".$segunda." no es válida";
		return 0;
	}else{
		return  $diasPrimeraJuliano > $diasSegundaJuliano;
	} 
}

function mesEnLetras($mes)
{
    $meses=[
        '1'=>"ENERO",
        '01'=>"ENERO",
        '2'=>"FEBRERO",
        '02'=>"FEBRERO",
        '03'=>"MARZO",
        '3'=>"MARZO",
        '04'=>"ABRIL",
        '4'=>"ABRIL",
        '05'=>"MAYO",
        '5'=>"MAYO",
        '06'=>"JUNIO",
        '6'=>"JUNIO",
        '07'=>"JULIO",
        '7'=>"JULIO",
        '08'=>"AGOSTO",
        '8'=>"AGOSTO",
        '09'=>"SEPTIEMBRE",
        '9'=>"SEPTIEMBRE",
        '10'=>"OCTUBRE",
        '11'=>"NOVIEMBRE",
        '12'=>"DICIEMBRE"];

   	return  $meses[$mes];
}