<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class DespegueRequest extends Request {

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
		return [
				'aeronave_id'           => 'required',
				'fecha'                 => 'required',
				'hora'                  => 'required',
				'tipoMatricula_id'      => 'required',
				'num_vuelo'             => 'required_if:tipoMatricula_id,3',
				'cliente_id'            => 'required_if:tipoMatricula_id,1|required_if:tipoMatricula_id,2|required_if:tipoMatricula_id,3',
				'puerto_id'             => 'required_if:tipoMatricula_id,1|required_if:tipoMatricula_id,2|required_if:tipoMatricula_id,3',
				'piloto_id'             => 'required_if:tipoMatricula_id,1|required_if:tipoMatricula_id,2|required_if:tipoMatricula_id,3',
				'condicionPago'         => 'required_if:tipoMatricula_id,1|required_if:tipoMatricula_id,2|required_if:tipoMatricula_id,3',
				'numero_puenteAbordaje' => 'required_if:cobrar_puenteAbordaje,1',
				'tiempo_puenteAbord'    => 'required_if:cobrar_puenteAbordaje,1',
				'peso_embarcado'        => 'required_if:cobrar_carga,1',
				'peso_desembarcado'     => 'required_if:cobrar_carga,1',
		];
	}

}
