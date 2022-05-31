<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class AeronaveRequest extends Request {

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
		$aeronaveID =$this->route()->getParameter('aeronaves');
		if($aeronaveID)
			$id       =$aeronaveID;
        return [
			'matricula'       => 'required|alpha_dash|unique:aeronaves,matricula,'.$id,
			'modelo_id'       => 'required',
			'peso'            => 'required|numeric',
			'nacionalidad_id' => 'required',
			'tipo_id'         => 'required'
        ];
	}
}
