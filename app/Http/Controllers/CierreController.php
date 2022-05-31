<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Traits\DecimalConverterTrait;


class CierreController extends Controller {


    use DecimalConverterTrait;


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
		$aeropuerto      =session("aeropuerto");
		$metas           =$aeropuerto->metas()->orderBy('fecha_inicio')->get();
		$metaGobernacion =0;
		$metaSaar        =0;
		foreach ($metas as $meta) {
			foreach ($meta->detalles as $detalle) {
				$metaGobernacion+=$detalle->gobernacion_meta;
				$metaSaar+=$detalle->saar_meta;
			}
		}

        return view("administracion/meta", compact("aeropuerto", "estacionamiento", "portons", "conceptosEstacionamiento", "metas", "metaGobernacion", "metaSaar"));
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

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
	 * @return Response
	 */
	public function update(Request $request)
	{

        //actualizando aeropuerto de sesion
		$aeropuerto=session("aeropuerto");
        //$aeropuerto->update($request->get("aeropuerto"));

        //actualizando estacionamientos del aeropuerto de la sesion
        //$estacionamiento=$aeropuerto->estacionamiento;
        //$estacionamiento->update($request->get("estacionamiento"));

        //actualizando portones
        //$this->actualizarEstacionamientos($estacionamiento, $request->get('portonesNuevos',[]), $request->get("portones", []));

        //actualizando conceptos
        //$this->actualizarConceptos($estacionamiento, $request->get('conceptosNuevos',[]), $request->get("conceptos", []));

        //registrando metas nuevas
        //
        //

		$conceptoMeta     =$request->get("conceptoMeta", []);
		$montoGobernacion =$request->get("montoGobernacion", []);
		$montoGobernacion =$this->parseDecimal($request['montoGobernacion'],[]);
		$montoSaar        =$request->get("montoSaar", []);
		$montoSaar        =$this->parseDecimal($request['montoSaar'],[]);

		$metaDetalles     =[];
        foreach($conceptoMeta as $index => $meta){

            $metaDetalles[]=["concepto_id"=>$meta, "gobernacion_meta" => $this->parseDecimal($montoGobernacion[$index]), "saar_meta" => $this->parseDecimal($montoSaar[$index])];
        }


        if(count($metaDetalles)){
            if($aeropuerto->metas->count()>0){
                $ultimaMeta=$aeropuerto->metas()->latest()->first();
                $ultimaMeta->update(["fecha_fin" => $request->get('metaFechaInicio')]);
            }
            $meta=$aeropuerto->metas()->create(["fecha_inicio" => $request->get('metaFechaInicio')]);
            $meta->detalles()->createMany($metaDetalles);
        }

		return redirect('administracion/meta');


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

    protected function actualizarEstacionamientos($estacionamiento, $nuevos, $actualizados){

        foreach($actualizados as $portonId => $porton){
            $estacionamiento->portons()->find($portonId)->update($porton);
        }
        list($keys, $values) = array_divide($actualizados);
        $portonesBorrar=$estacionamiento->portons()->whereNotIn('id',$keys)->get();
        $portonesBorrar->each(function($porton){
            $porton->delete();
        });
        foreach($nuevos as $porton){
            $estacionamiento->portons()->create($porton);
        }

    }

    protected function actualizarConceptos($estacionamiento, $nuevos, $actualizados){

        foreach($actualizados as $conceptoId => $concepto){
            $estacionamiento->conceptos()->find($conceptoId)->update($concepto);
        }
        list($keys, $values) = array_divide($actualizados);
        $conceptosBorrar=$estacionamiento->conceptos()->whereNotIn('id',$keys)->get();
        $conceptosBorrar->each(function($concepto){
            $concepto->delete();
        });
        foreach($nuevos as $concepto){
            $estacionamiento->conceptos()->create($concepto);
        }

    }
}
