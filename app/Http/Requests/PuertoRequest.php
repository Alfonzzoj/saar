<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class PuertoRequest extends Request {

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
		$puertoId =$this->route()->getParameter('puertos');
		if($puertoId)
			$id       =$puertoId;
		return [
				'nombre'  => 'required|string|unique:puertos,nombre,'.$id,
				'siglas'  => 'required|alpha|unique:puertos,siglas,'.$id,
				'pais_id' => 'required',
		];
	}

}
