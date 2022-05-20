<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DateConverterTrait;
use App\DashboardController;


class Dashboard extends Model {

	    use DateConverterTrait;


    public function setFechaAttribute($fecha)
    {
        $this->setFecha($fecha,'fecha');
    }
    public function getFechaAttribute($fecha)
    {
        return $this->getFecha($fecha);
    }
}
