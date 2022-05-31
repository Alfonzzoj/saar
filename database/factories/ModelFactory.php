<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
 */

/*
 * Intro
 *
 * Factories use https://github.com/fzaninotto/Faker, you can use the link to fin documentation about it
 * you can also take a look at the Faker\Generator laravel provides and see its attributes
 * i'll copy them here
 *
 */

/**
 * @property string $name
 * @property string $firstName
 * @property string $firstNameMale
 * @property string $firstNameFemale
 * @property string $lastName
 * @property string $title
 * @property string $titleMale
 * @property string $titleFemale
 *
 * @property string $citySuffix
 * @property string $streetSuffix
 * @property string $buildingNumber
 * @property string $city
 * @property string $streetName
 * @property string $streetAddress
 * @property string $postcode
 * @property string $address
 * @property string $country
 * @property float  $latitude
 * @property float  $longitude
 *
 * @property string $ean13
 * @property string $ean8
 * @property string $isbn13
 * @property string $isbn10
 *
 * @property string $phoneNumber
 *
 * @property string $company
 * @property string $companySuffix
 *
 * @property string $creditCardType
 * @property string $creditCardNumber
 * @method string creditCardNumber($type = null, $formatted = false, $separator = '-')
 * @property \DateTime $creditCardExpirationDate
 * @property string $creditCardExpirationDateString
 * @property string $creditCardDetails
 * @property string $bankAccountNumber
 * @property string $swiftBicNumber
 * @property string $vat
 *
 * @property string $word
 * @property string|array $words
 * @method string|array words($nb = 3, $asText = false)
 * @property string $sentence
 * @method string sentence($nbWords = 6, $variableNbWords = true)
 * @property string|array $sentences
 * @method string|array sentences($nb = 3, $asText = false)
 * @property string $paragraph
 * @method string paragraph($nbSentences = 3, $variableNbSentences = true)
 * @property string|array $paragraphs
 * @method string|array paragraphs($nb = 3, $asText = false)
 * @property string $text
 * @method string text($maxNbChars = 200)
 *
 * @method string realText($maxNbChars = 200, $indexSize = 2)
 *
 * @property string $email
 * @property string $safeEmail
 * @property string $freeEmail
 * @property string $companyEmail
 * @property string $freeEmailDomain
 * @property string $safeEmailDomain
 * @property string $userName
 * @property string $password
 * @method string password($minLength = 6, $maxLength = 20)
 * @property string $domainName
 * @property string $domainWord
 * @property string $tld
 * @property string $url
 * @property string $slug
 * @method string slug($nbWords = 6, $variableNbWords = true)
 * @property string $ipv4
 * @property string $ipv6
 * @property string $localIpv4
 * @property string $macAddress
 *
 * @property int       $unixTime
 * @property \DateTime $dateTime
 * @property \DateTime $dateTimeAD
 * @property string    $iso8601
 * @property \DateTime $dateTimeThisCentury
 * @property \DateTime $dateTimeThisDecade
 * @property \DateTime $dateTimeThisYear
 * @property \DateTime $dateTimeThisMonth
 * @property string    $amPm
 * @property int       $dayOfMonth
 * @property int       $dayOfWeek
 * @property int       $month
 * @property string    $monthName
 * @property int       $year
 * @property int       $century
 * @property string    $timezone
 * @method string date($format = 'Y-m-d', $max = 'now')
 * @method string time($format = 'H:i:s', $max = 'now')
 * @method \DateTime dateTimeBetween($startDate = '-30 years', $endDate = 'now')
 *
 * @property string $md5
 * @property string $sha1
 * @property string $sha256
 * @property string $locale
 * @property string $countryCode
 * @property string $countryISOAlpha3
 * @property string $languageCode
 * @property string $currencyCode
 * @method boolean boolean($chanceOfGettingTrue = 50)
 *
 * @property int    $randomDigit
 * @property int    $randomDigitNotNull
 * @property string $randomLetter
 * @property string $randomAscii
 * @method int randomNumber($nbDigits = null, $strict = false)
 * @method int|string|null randomKey(array $array = array())
 * @method int numberBetween($min = 0, $max = 2147483647)
 * @method float randomFloat($nbMaxDecimals = null, $min = 0, $max = null)
 * @method mixed randomElement(array $array = array('a', 'b', 'c'))
 * @method array randomElements(array $array = array('a', 'b', 'c'), $count = 1)
 * @method array|string shuffle($arg = '')
 * @method array shuffleArray(array $array = array())
 * @method string shuffleString($string = '', $encoding = 'UTF-8')
 * @method string numerify($string = '###')
 * @method string lexify($string = '????')
 * @method string bothify($string = '## ??')
 * @method string asciify($string = '****')
 * @method string regexify($regex = '')
 * @method string toLower($string = '')
 * @method string toUpper($string = '')
 * @method Generator optional($weight = 0.5, $default = null)
 * @method Generator unique($reset = false, $maxRetries = 10000)
 *
 * @method integer biasedNumberBetween($min = 0, $max = 100, $function = 'sqrt')
 *
 * @property string $macProcessor
 * @property string $linuxProcessor
 * @property string $userAgent
 * @property string $chrome
 * @property string $firefox
 * @property string $safari
 * @property string $opera
 * @property string $internetExplorer
 * @property string $windowsPlatformToken
 * @property string $macPlatformToken
 * @property string $linuxPlatformToken
 *
 * @property string $uuid
 *
 * @property string $mimeType
 * @property string $fileExtension
 * @method string file($sourceDirectory = '/tmp', $targetDirectory = '/tmp', $fullPath = true)
 *
 * @method string imageUrl($width = 640, $height = 480, $category = null, $randomize = true)
 * @method string image($dir = null, $width = 640, $height = 480, $category = null, $fullPath = true)
 *
 * @property string $hexColor
 * @property string $safeHexColor
 * @property string $rgbColor
 * @property array $rgbColorAsArray
 * @property string $rgbCssColor
 * @property string $safeColorName
 * @property string $colorName
 */

/**
 * --------------------------------------------------------------------------------------------------
 *                                      IMPORTANT
 * --------------------------------------------------------------------------------------------------
 *
 * LETS TRY TO KEEP MODELS IN ALPHABETIC ORDER
 *
 */


/*
 * Modelo Aeronave Factory
 */

$factory->define(App\ModeloAeronave::class, function (Faker\Generator $faker) {
	return [
		'modelo'     => $faker->word(),		
		'peso'       => $faker->float,		
		//'tipo_id'  => Definir en el Seed,		
		'created_at' => \Carbon\Carbon::now(),
	];
});

/*
 * País Factory
 */

$factory->define(App\Pais::class, function (Faker\Generator $faker) {
	return [
		'siglas'     => $faker->str_random(2),		
		'nombre'     => $faker->country,		
		'created_at' => \Carbon\Carbon::now(),
	];
});

/*
 * Piloto Factory
 */

$factory->define(App\Pais::class, function (Faker\Generator $faker) {
	return [
		'nombre'              => $faker->name,
		'nacionalidad_id'     => '232',
		'documento_identidad' => $faker->unique(6),
		'telefono'            => $faker->unique(11),
		'licencia'            => $faker->unique(6),
		'estado'              => $faker->numberBetween(0,1),
		'created_at'          => \Carbon\Carbon::now(),
	];
});

/*
 * Puerto Factory
 */

$factory->define(App\Puerto::class, function (Faker\Generator $faker) {
	return [
		'nombre'     => $faker->country,
		'siglas'     => $faker->str_random(4),
		'estado'     => $faker->numberBetween(0,1),
		//'pais_id'    => Definir en el seed
		'created_at' => \Carbon\Carbon::now(),
	];
});


/*
 * Tipo Matrícula Factory
 */

$factory->define(App\TipoMatricula::class, function (Faker\Generator $faker) {
	return [
		'nombre'     => $faker->word(),		
		'siglas'     => $faker->randomLetter(),		
		'created_at' => \Carbon\Carbon::now(),
	];
});

/*
 * Tipo Aeronave Factory
 */

$factory->define(App\TipoAeronave::class, function (Faker\Generator $faker) {
	return [
		'nombre'     => $faker->word(),		
		'created_at' => \Carbon\Carbon::now(),
	];
});

/*
 * Usuarios Factory
 */

$factory->define(App\Usuario::class, function (Faker\Generator $faker) {
	return [
		'username'       => $faker->word(),
		'password'       => bcrypt("12345"),
		'remember_token' => str_random(10),		
		'created_at'     => \Carbon\Carbon::now(),
	];
});

