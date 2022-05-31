<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class EstacionamientoController extends Controller {



    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * @return \Illuminate\View\View
     */
    public function index()
	{
        $aeropuerto=session('aeropuerto');
        $clientes=\App\Cliente::all();
        $estacionamiento=$aeropuerto->estacionamiento;
        if(!$estacionamiento)
            $estacionamiento=$aeropuerto->estacionamiento()->create(["nTaquillas" => 1, "nTurnos" => 1]);
        if($estacionamiento->conceptos()->count()==0){
            $estacionamiento->conceptos()->create(["nombre" => "generico", "costo" => 0]);
        }
        $bancos=\App\Banco::with("cuentas")->get();
        return view('estacionamiento/index', compact('estacionamiento', 'bancos', 'clientes'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	public function store(Request $request)
	{

        $estacionamientoOp=session('aeropuerto')->estacionamiento->operaciones()->create($request->only('fecha', 'nTaquillas', 'nTurnos', 'total', 'depositado'));
        $estacionamientoOp->tickets()->createMany($request->get("estacionamientooptickets"));
        if($request->has("estacionamientoopticketsdepositos"))
        $estacionamientoOp->depositos()->createMany($request->get("estacionamientoopticketsdepositos"));
        if($request->has("estacionamientooptarjetas"))
        $estacionamientoOp->tarjetas()->createMany($request->get("estacionamientooptarjetas"));

        return ["success"=>1];







	}


    /**
     * @param Request $request
     *
     * Devuelve la operacion de un dia de estacionamiento en formato JSON
     *
     * @return mixed
     */
    public function show(Request $request)
	{
        /**
         * Tomamos la fecha enviada del request.
         * La fecha viene en formato dias/mes/año y la base de datos es año/mes/dia
         * asi que usamos la libreria de Carbon para transformarla
         */
        $fecha=\Carbon\Carbon::createFromFormat('d/m/Y', $request->get("fecha"))->toDateString();

        $aeropuerto=session('aeropuerto');

        $estacionamiento=$aeropuerto->estacionamiento;

        $estacinamientoop=$estacionamiento->operaciones()->where('fecha', $fecha)->first();

        /**
         * Luego mandamos a buscar todas las relaciones si se encontro un registro. Ya que hay que dibujar la tabla de tickets
         * se ordena por concepto>taquilla>turno para hacer mas facil el foreach
         */
        if($estacinamientoop)
            $estacinamientoop->load([
                                'tickets' => function ($query) {
                                    $query->orderBy('econcepto_id', 'asc')
                                    ->orderBy('taquilla', 'asc')->orderBy('turno', 'asc');
                                },
                                'tickets.concepto', 'tarjetas', 'tarjetas.banco', 'tarjetas.cliente',
                                'tarjetas.bancoCuenta', 'depositos', 'depositos.banco', 'depositos.bancoCuenta'
                              ]);
        /**
         * Se devuelve el objecto encontrado
         * Laravel lo transforma automaticamente a JSON
         */
        return $estacinamientoop;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}



    public function saveClient(Request $request)
{
    $estacionamiento=\App\Estacionamiento::find(1);
    if($estacionamiento->clientes()->create($request->all())){
        return ["text" => "Usuario ingresado con exito."];
    }else{
        return ["text" => "Fallo en la insercion de usuario."];
    }

}


    public function getClients(Request $request)
    {
        return \App\Estacionamientocliente::all();

    }
}
