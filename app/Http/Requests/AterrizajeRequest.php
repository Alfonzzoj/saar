<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class AterrizajeRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{			
		$id       =null;
		$aterrizajeID =$this->route()->getParameter('aterrizaje');
		if($aterrizajeID)
			$id       =$aterrizajeID;
		return [
				'aeronave_id'         => 'required',
				'fecha'               => 'required',
				'hora'                => 'required',
				'tipoMatricula_id'    => 'required',
				'cliente_id'          => 'required_if:tipoMatricula_id,1|required_if:tipoMatricula_id,2|required_if:tipoMatricula_id,3',
				'puerto_id'           => 'required_if:tipoMatricula_id,1|required_if:tipoMatricula_id,2|required_if:tipoMatricula_id,3',
				'piloto_id'           => 'required_if:tipoMatricula_id,1|required_if:tipoMatricula_id,2|required_if:tipoMatricula_id,3',
				'num_vuelo'           => 'required_if:tipoMatricula_id,3',
        ];
	}
}
