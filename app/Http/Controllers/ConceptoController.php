<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConceptoRequest;
use Illuminate\Http\Request;

class ConceptoController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $conceptos=\App\Concepto::where('aeropuerto_id', '=', session('aeropuerto')->id)->orderBy('nompre')->where('stacod','A')->get();
        return view('concepto.index', compact('conceptos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $concepto=new \App\Concepto();

        return view("concepto.create", compact('concepto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ConceptoRequest $request)
    {        
        $conceptoAttrs=$request->only('nompre', 'iva', 'nombreImprimible', 'condicionPago', 'recargo', 'nombreImprimible','codpre','codcta');

        \App\Concepto::create([
                'nompre'                    => $conceptoAttrs['nompre'],
                'iva'                       => $conceptoAttrs['iva'],
                'nombreImprimible'          => $conceptoAttrs['nombreImprimible'],
                'aeropuerto_id'             => session('aeropuerto')->id,
                'recargo'                   => $conceptoAttrs['recargo'],
                'condicionPago'             => $conceptoAttrs['condicionPago'],
                'stacod'                    => 'A',
                'nombreImprimible'          => $conceptoAttrs['nombreImprimible'],
                'codcta'                    => $conceptoAttrs['codcta'],
                'codpre'                    => $conceptoAttrs['codpre']

                
                ]);
        return redirect("administracion/concepto");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $concepto=\App\Concepto::where('id','=',$id)->with('aeropuerto','modulo')->first();
        return view("concepto.partials.show", compact('concepto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $concepto=\App\Concepto::where('id','=',$id)->with('aeropuerto','modulo')->first();
        return view("concepto.edit", compact('concepto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, ConceptoRequest $request)
    {
        $concepto=\App\Concepto::find($id);
        $concepto->update($request->only('nompre', 'iva', 'condicionPago', 'nombreImprimible','recargo'));

        return redirect("administracion/concepto")->with('status','El concepto fue actualizado con �xito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if(\App\Concepto::destroy($id)){
            return ["success"=>1, "text" => "El concepto fue eliminado con exito."];
        }else{
            return ["success"=>0, "text" => "El concepto no fue eliminado."];
        }


    }

}
