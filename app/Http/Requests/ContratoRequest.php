<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ContratoRequest extends Request {

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
        $id=null;
        $contrato=$this->route()->getParameter('contrato');
        if($contrato)
            $id=$contrato->id;
        return [
			'nContrato'        => 'required|unique:contratos,nContrato,'.$id,
			'concepto_id'      => 'required',
			'cliente_id'       => 'required',
			'monto'            => 'required',
			'fechaInicio'      => 'required',
			'fechaVencimiento' => 'required',
			'diaGeneracion'    => 'required_with:isGeneracionAutomaticaFactura|integer|between:0,31',
			'mesesReanudacion' => 'required_with:isReanudacionAutomatica',
        ];

	}

}
