<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SysTasController extends Controller {


    public function configurar(){
        return view('systas.conf_tasas.main');
    }

    public function imprimir(){
        return view('systas.conf_tasas.main');
    }

    public function verificar(){
        return view('systas.tasas.main');
    }

    public function repccaja(){
        return view('systas.reportes.repccaja');
    }

    public function repctasa(){
        return view('systas.reportes.repctasa');
    }

    public function reprseries(){
        return view('systas.reportes.reprseries');
    }

}
