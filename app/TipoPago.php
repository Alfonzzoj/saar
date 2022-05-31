<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\MontosFijo;

class TipoPago extends Model {

  public function precio(){
    switch ($this->name) {
      case 'unidad tributaria (Bsf)':
        return  MontosFijo::where('aeropuerto_id', session('aeropuerto')->id)->first()->unidad_tributaria;
        break;
      
      case 'dolares ($)':
        return  MontosFijo::where('aeropuerto_id', session('aeropuerto')->id)->first()->dolar_oficial;
        break;
      case 'Euro (€)':
        return  MontosFijo::where('aeropuerto_id',1)->first()->euro_oficial;
      break;
    }
  }
}
