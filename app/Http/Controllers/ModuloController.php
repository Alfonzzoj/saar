<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ModuloRequest;
use Illuminate\Http\Request;

class ModuloController extends Controller {


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
        $conceptosSinModulosCantidad = $this->getConceptosSinModulo()->count();
        $modulos=\App\Modulo::with('conceptosCantidad')->where("aeropuerto_id","=", session('aeropuerto')->id)->orderby('nombre')->get();
        return view('modulo.index', compact('modulos', 'conceptosSinModulosCantidad'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $modulo=new \App\Modulo();
        $conceptosSinModulo=$this->getConceptosSinModulo();
		return view("modulo.create", compact('modulo', 'conceptosSinModulo'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ModuloRequest $request)
	{
		$attrs                  =$request->only('nombre', 'descripcion', 'nControlPrefix', 'nFacturaPrefix', 'nControlPrefixManual', 'nFacturaPrefixManual', 'nombreImprimible');
		$attrs["aeropuerto_id"] =session('aeropuerto')->id;
		$modulo                 =\App\Modulo::create($attrs);
		$conceptos              =$request->get('conceptos',[]);
		$conceptos              =\App\Concepto::findMany(array_flatten($conceptos));
		$conceptos->each(function ($item) use ($modulo) {
           $item->update(["modulo_id" => $modulo->id]);
        });
        return redirect("administracion/modulo")->with('status', 'Se ha creado el Módulo de manera satisfactoria.');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $modulo=\App\Modulo::find($id);
        return view("modulo.partials.show", compact('modulo'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$modulo=\App\Modulo::find($id);
        $conceptosSinModulo=$this->getConceptosSinModulo();
        return view("modulo.edit", compact('modulo', 'conceptosSinModulo'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, ModuloRequest $request)
	{
        $modulo=\App\Modulo::find($id);
        $modulo->update($request->only('nombre', 'descripcion', 'nControlPrefix', 'nFacturaPrefix',  'nControlPrefixManual', 'nFacturaPrefixManual', 'nombreImprimible'));
        $invalidConcepts=collect([]);
        $validConcepts=$modulo->conceptos->filter(function($item) use ($invalidConcepts){
            if($item->facturadetalles()->count()>0){
                $invalidConcepts->push($item);
                return false;
            }
            return true;
        })->all();
        foreach($validConcepts as $c){
            $c->update(['modulo_id' => null]);
        }
        $conceptos=$request->get('conceptos',[]);
        $conceptos=\App\Concepto::findMany(array_flatten($conceptos));
        $conceptos->each(function ($item) use ($modulo,&$invalidConcepts) {
            $invalidConcepts=$invalidConcepts->reject(function ($c) use($item) {
                return $c->id == $item->id;
            });
            $item->update(["modulo_id" => $modulo->id]);
        });
        return redirect("administracion/modulo")->with('invalidConcepts', $invalidConcepts)->with('status', 'Se ha actualizado el Módulo de manera satisfactoria.');;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$modulo=\App\Modulo::find($id);
        $modulo->conceptos()->update(['modulo_id' => null]);
        $modulo->delete();
        return ["success"=>1, "text" => "El Módulo fue eliminado con éxito."];
	}



    protected function getConceptosSinModulo(){
        return \App\Concepto::where("modulo_id", "=", null)->where('aeropuerto_id', '=', session('aeropuerto')->id)->orderBy('nompre')->get();
    }

}
