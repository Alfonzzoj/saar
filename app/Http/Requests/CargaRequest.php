<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CargaRequest extends Request {

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
			'cliente_id'        => 'required',
			'peso_embarcado'    => 'required|numeric',
			'peso_desembarcado' => 'required|numeric',
			'monto_total'       => 'required|numeric'
		];
	}

}
