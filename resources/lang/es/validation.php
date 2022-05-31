<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"             => ":attribute debe ser aceptado.",
	"active_url"           => ":attribute no es una dirección valida.",
	"after"                => ":attribute debe ser una fecha despues de :date.",
	"alpha"                => ":attribute solo puede contener letras.",
	"alpha_dash"           => ":attribute solo puede contener letras, numeros y dashes.",
	"alpha_num"            => ":attribute solo puede contener letras y numeros.",
	"array"                => ":attribute debe ser un arreglo.",
	"before"               => ":attribute debe ser una fecha antes de :date.",
	"between"              => [
		"numeric" => ":attribute debe estar entre :min y :max.",
		"file"    => ":attribute debe estar entre :min y :max kilobytes.",
		"string"  => ":attribute debe tener entre :min y :max caracteres.",
		"array"   => ":attribute debe tener entre :min y :max items.",
	],
	"boolean"              => ":attribute debe ser verdadero o falso.",
	"confirmed"            => "La confirmacion de :attribute no coincide.",
	"date"                 => ":attribute no es una fecha valida.",
	"date_format"          => ":attribute no coincide con el formato :format.",
	"different"            => ":attribute y :other deben ser diferentes.",
	"digits"               => ":attribute debe ser de :digits digitos.",
	"digits_between"       => ":attribute debe ser de :min a :max digitos.",
	"email"                => ":attribute debe ser una direccion de email valida.",
	"filled"               => ":attribute es requerido.",
	"exists"               => "El/La :attribute seleccionado es invalido.",
	"image"                => ":attribute debe ser una imagen.",
	"in"                   => "El/La :attribute seleccionado es invalido.",
	"integer"              => ":attribute debe ser un entero.",
	"ip"                   => ":attribute debe ser una direccion ip valida.",
	"max"                  => [
		"numeric" => ":attribute no debe ser mayor a :max.",
		"file"    => ":attribute no debe ser mayor que :max kilobytes.",
		"string"  => ":attribute no debe tener mas que :max caracteres.",
		"array"   => ":attribute no debe tener mas que :max items.",
	],
	"mimes"                => ":attribute debe ser de los tipos: :values.",
	"min"                  => [
		"numeric" => ":attribute debe ser al menos :min.",
		"file"    => ":attribute debe ser al menos :min kilobytes.",
		"string"  => ":attribute debe sr al menos :min caracteres.",
		"array"   => ":attribute debe tener al menos :min items.",
	],
	"not_in"               => "El :attribute seleccionado es invalido.",
	"numeric"              => ":attribute debe ser un numero.",
	"regex"                => "El formato de :attribute es invalido.",
	"required"             => ":attribute es requerido.",
	"required_if"          => ":attribute es requerido cuando :other es :value.",
	"required_with"        => ":attribute es requerido cuando :values esta presente.",
	"required_with_all"    => ":attribute es requerido cuando :values estan presentes.",
	"required_without"     => ":attribute es requerido cuando :values no esta presente.",
	"required_without_all" => ":attribute es requerido cuando ninguno de los :values no estan presentes.",
	"same"                 => ":attribute y :other deben coincidir.",
	"size"                 => [
		"numeric" => ":attribute debe ser :size.",
		"file"    => ":attribute debe ser :size kilobytes.",
		"string"  => ":attribute debe ser :size caracteres.",
		"array"   => ":attribute debe contener :size items.",
	],
	"unique"               => ":attribute ya ha sido tomado.",
	"url"                  => "El formato de :attribute es invalido.",
	"timezone"             => ":attribute debe ser una zona valida.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => [
		'attribute-name' => [
			'rule-name' => 'custom-message',
		],
	],

	'custom' => [
		'num_vuelo' => [
			'required_if' => '- El número de vuelo es requerido',
		],
		'piloto_id' => [
			'required_if' => '- Piloto es requerido',
		],
		'puerto_id' => [
			'required_if' => '- Procedencia es requerida',
		],
	],

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => [
        //Cliente
        "codigo" => "Código",
        "cedRif" => "Cédula",
        "cedRifPrefix" => "Prefijo de cédula",
        "hangars" => "Hangares",
        //Concepto
        "nompre" => "Nombre",
        //Contrato
        "nContrato" => "Número de contrato",
        "concepto_id" => "Concepto",
        "cliente_id" => "Cliente",
        "monto" => "Monto",
        "fechaInicio" => "Fecha de inicio",
        "fechaVencimiento" => "Fecha de vencimiento",
        "diaGeneracion" => "Día de generación",
        "mesesReanudacion" => "Meses de reanudación",
        //Factura
        "aeropuerto_id" => "Aeropuerto",
        "condicionPago" => "Condición de pago",
        "nControl" => "Número de control",
        "nFactura" => "Número de factura",
        "fecha" => "Fecha",
        "descripcion" => "Descripción",
        //Xs
        "nombre" => "Nombre",
        "name" => "Nombre"
    ],

];
