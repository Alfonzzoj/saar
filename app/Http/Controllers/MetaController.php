<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\DecimalConverterTrait;
use Validator;

class MetaController extends Controller {


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
	public function index(Request $request)
	{
		$aeropuerto_id = session('aeropuerto')->id;
		$meses = ['1' => 'Enero','2' => 'Febrero','3' => 'Marzo','4' => 'Abril','5' => 'Mayo','6' => 'Junio','7' => 'Julio','8' => 'Agosto','9' => 'Septiembre','10' => 'Octubre','11' => 'Noviembre','12' => 'Diciembre'];

		$fecha            = \Carbon\Carbon::now();
		$anno        	 = $request->get('anno', $fecha->year);
		$mes = $fecha->month;
		$metas           = \App\Meta::where('aeropuerto_id', $aeropuerto_id)->where('anno', $anno)->orderBy('mes')->get();
		
		$maxanno = Carbon::createFromFormat('Y-m-d H:i:s', \App\Factura::orderBy('created_at', 'DESC')->lists('created_at')[0])->year;
		$minanno = Carbon::createFromFormat('Y-m-d H:i:s', \App\Factura::orderBy('created_at', 'ASC')->lists('created_at')[0])->year;

        return view("administracion/meta", compact("metas","anno", "mes", "meses", "minanno", "maxanno"));
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
	public function store(Request $request)
	{
		$validator = Validator::make($request->all(),[
	    	'mes' => 'required',
			'anno' => 'required',
			'gobernacion_meta' => 'required',
			'saar_meta' => 'required'
		]);

	    if ($validator->fails())
		{
			return response()->json($validator->errors(), 500);
		}else{
	        $meta = \App\Meta::create($request->all());
	    }

        return response()->json($meta);
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
		$validator = Validator::make($request->all(),[
	    	'mes' => 'required',
			'anno' => 'required',
			'gobernacion_meta' => 'required',
			'saar_meta' => 'required'
		]);

	    if($validator->fails())
		{
			return response()->json($validator->errors(), 500);
		}else{
	        $meta = \App\Meta::findOrFail($request->get('meta_id'))->update([
	            'gobernacion_meta' => $request->get("gobernacion_meta"),
	            'saar_meta' => $request->get("saar_meta")
	        ]);
	    }

        return response()->json($meta);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$meta = \App\Meta::destroy($id);
		return response()->json($meta);
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
