@foreach($contratos as $contrato)
    <div class="checkbox {{(($contrato->hasFacturaByFecha($fecha->year, $fecha->month))?"bg-gray":"")}}">
        <label>
            <input name="contratos-checkbox" type="checkbox"
            {{(($contrato->hasFacturaByFecha($fecha->year, $fecha->month))?"disabled":"")}}
            value="{{$contrato->nContrato}}"
            autocomplete="off"
            data-monto="{{($contrato->montoTipo=="Mensual")?$contrato->monto:$contrato->monto/12}}"
            data-fecha-control-contrato="{{$fecha->format('d/m/Y')}}"
            data-finicio="{{$fecha->format('d/m/Y')}}"
            data-ffin="{{$fecha->copy()->addMonth()->format('d/m/Y')}}"
            data-today="{{$today->format('d/m/Y')}}"
            data-concepto_id="{{$contrato->concepto_id}}"
            data-concepto-iva="{{round($contrato->concepto->iva,2)}}"
            data-concepto-montoiva="{{round((($contrato->montoTipo=="Mensual")?$contrato->monto:$contrato->monto/12)*(($contrato->concepto->iva)/100),2)}}"
            data-cliente_id="{{$contrato->cliente_id}}"
            data-cliente_codigo="{{$contrato->cliente->codigo}}"
            data-cliente_nombre="{{$contrato->cliente->nombre}}"
            data-contrato_id="{{$contrato->id}}"
            data-total="{{round(((($contrato->montoTipo=="Mensual")?$contrato->monto:$contrato->monto/12)*(($contrato->concepto->iva)/100))+(($contrato->montoTipo=="Mensual")?$contrato->monto:$contrato->monto/12),2)}}"
            > {{$contrato->nContrato}} | {{$contrato->cliente->codigo}} |  {{$contrato->cliente->nombre}} | Bs. {{$traductor->format(($contrato->montoTipo=="Mensual")?$contrato->monto:$contrato->monto/12)}} 

        </label>
    </div>
@endforeach