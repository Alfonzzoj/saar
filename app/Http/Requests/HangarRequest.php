<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class HangarRequest extends Request {

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
		$hangaresID =$this->route()->getParameter('hangares');
		if($hangaresID)
			$id = $hangaresID;
        return [
			'aeropuerto_id' => 'required',
			'nombre'        => "required|alpha_dash|unique:hangars,nombre,$id"
        ];
	}

}
