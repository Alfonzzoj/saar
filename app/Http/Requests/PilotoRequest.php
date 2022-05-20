<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class PilotoRequest extends Request {

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
        $id       = null;
		$pilotoId = $this->route()->getParameter('pilotos');
		if($pilotoId)
			$id       = $pilotoId;
		return [
			'nombre'              => 'required|string',
			'nacionalidad_id'     => 'required',
			'licencia'            => 'required|alpha_dash|unique:pilotos,licencia,'.$id,
			'documento_identidad' => 'required|integer|unique:pilotos,documento_identidad,'.$id,
			'telefono'            => 'digits:11',
        ];
	}

}
