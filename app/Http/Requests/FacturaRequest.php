<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class FacturaRequest extends Request {

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
		$facturaID =$this->route()->getParameter('factura');
		if($facturaID)
			$id       =$facturaID->id;

			$validation = ([
					'nFactura'         =>'required',
					'nControl'         =>'required',
					'aeropuerto_id'    =>'required',
					'condicionPago'    =>'required',
					'fecha'            =>'required',
					'fechaVencimiento' =>'required',
					'descripcion'      =>'required',
					'cliente_id'       =>'required']);

		return $validation;
	}
}
