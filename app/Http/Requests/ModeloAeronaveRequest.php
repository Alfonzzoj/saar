<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ModeloAeronaveRequest extends Request {

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
		$modeloAeronaveId =$this->route()->getParameter('modelosAeronaves');
		if($modeloAeronaveId)
			$id       =$modeloAeronaveId;
        return [
			'modelo'      => 'required|alpha_dash|unique:modelo_aeronaves,modelo,'.$id,
			'peso_maximo' => 'required|numeric',
			'tipo_id'     => 'required',
        ];
	}
}
