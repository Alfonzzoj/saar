<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DateConverterTrait;

class Tasa extends Model {
	
    use DateConverterTrait;

    protected $guarded = [];



}
