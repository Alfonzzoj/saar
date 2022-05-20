<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\DespegueRequest;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;

use Illuminate\Http\Request;

use App\Despegue;
use App\Aterrizaje;
use App\Puerto;
use App\Piloto;
use App\NacionalidadVuelo;
use App\Aeronave;
use App\TipoMatricula;
use App\Cliente;
use App\OtrosCargo;
use App\Factura;
use App\CargosVario;
use App\Facturadetalle;
use App\MontosFijo;
use App\Concepto;
use App\HorariosAeronautico;
use App\EstacionamientoAeronave;
use App\PreciosAterrizajesDespegue;
use App\PreciosCarga;

use Carbon\Carbon;

class TestingController extends Controller {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function select()
	{
		$aeropuerto = session('aeropuerto')->id;
		$procedencia = 1;
		//$procedencia = 2;
		$peso = 3000;
		$nacionalidad = 1;
		//$nacionalidad = 2;

		$tipoMatriculas      = TipoMatricula::all();
		$otrosCargos         = OtrosCargo::where('aeropuerto_id', $aeropuerto)
							->where('cantidad_unidades','<>',0)
							->where('peso_desde','<=', $peso)
							->where('peso_hasta','>=', $peso)
							->where('procedencia', $procedencia)
							->where('nacionalidad_matricula', $nacionalidad)
							->where('tipo_matricula', 1)
							->orderBy('nombre_cargo')->lists('nombre_cargo', 'id');
		
		return view("testing.select", compact("otrosCargos", "tipoMatriculas", "peso", "procedencia", "nacionalidad"));
	}

	public function filtro(Request $request){

		$conceptosCondicion = Concepto::where('condicionPago', $request->condicionPago)->lists('id');

		$otrosCargos      	= OtrosCargo::where('aeropuerto_id', session('aeropuerto')->id)
							->where('cantidad_unidades','<>',0)
							->whereIn('concepto_id', $conceptosCondicion)
							->where('peso_desde','<=', $request->peso)
							->where('peso_hasta','>=', $request->peso)
							->where('procedencia', $request->procedencia)
							->where('nacionalidad_matricula', $request->nacionalidad)
							->where('tipo_matricula', $request->tipoMatricula_id)
							->orderBy('nombre_cargo')->lists('nombre_cargo', 'id');


		return response($otrosCargos);
	}
}