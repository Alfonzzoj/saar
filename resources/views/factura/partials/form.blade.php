<div class="form-group">

	<label for="aeropuerto_id" class="col-xs-1  control-label"><strong>Aeropuerto<span class="text-danger">*</span></strong> </label>
	<div class="col-xs-3">
		{!! Form::hidden('modulo_id', ($factura->modulo_id)?$factura->modulo_id:$modulo_id,[ 'class'=>"form-control", "readonly"=>"true"]) !!}
		{!! Form::hidden('aeropuerto_id', session('aeropuerto')->id,[ 'class'=>"form-control", "readonly"=>"true"]) !!}
		{!! Form::text(null, session('aeropuerto')->nombre,[ 'class'=>"form-control", "readonly"=>"true"]) !!}
	</div>
	<label for="condicionPago" class="col-xs-1 control-label"><strong>Cond. de pago<span class="text-danger">*</span></strong> </label>
	<div class="col-xs-3">
		@if(!isset($bloqueoDosa))
			{!! Form::hidden('aplica_minimo_aterrizaje', 0) !!}
			{!! Form::hidden('aplica_minimo_estacionamiento', 0) !!}
			@if($modulo_id=="9" || $modulo_id=="4" || $modulo_id == "2" || $modulo_id == "26")
				{!! Form::select('condicionPago', ["Contado"=>"Contado","Crédito" => "Crédito","Exonerado" => "Exonerado"], null, [ 'id' =>'condicionPago', 'class'=>"form-control", $disabled, (!$factura->isImpresa)?"":"readonly"]) !!}
			@else
				{!! Form::select('condicionPago', ["Crédito" => "Crédito", "Contado"=>"Contado","Exonerado" => "Exonerado"], null, [ 'id' =>'condicionPago', 'class'=>"form-control", $disabled, (!$factura->isImpresa)?"":"readonly"]) !!}
			@endif
		@else		
		{!! Form::text('condicionPago', $condicionPago, [ 'id' =>'condicionPago', 'class'=>"form-control", $disabled, 'readonly']) !!}
			{!! Form::hidden('aplica_minimo_aterrizaje', $aplica_minimo_aterrizaje) !!}
			{!! Form::hidden('aplica_minimo_estacionamiento', $aplica_minimo_estacionamiento) !!}
		@endif
	</div>
	<label for="nControl" class="col-xs-1 control-label"><strong>N° Control</strong> </label>
	<div class="col-xs-3">
	 <!-- (!$factura->isImpresa)?"":"readonly" -->
        {!! Form::hidden('nControlPrefix', ($factura->nControlPrefix)?$factura->nControlPrefix:$modulo->nControlPrefix, ['id' => 'nControlPrefix', 'class' => 'nControlPrefix-input', 'autocomplete'=>'off']) !!}
        <div class="input-group">
            <div class="input-group-btn">
                <button style="max-height:37px" type="button" class="btn btn-default"><span class="nControlPrefix-text">{{$modulo->nControlPrefix}}</span></button>
            </div>
            {!! Form::text('nControl', null, [ 'id' => 'nControl', 'class'=>"form-control", $disabled,"data-empty"=>"false", "data-type"=>"int", "data-name"=>"Número de control", 'style' => 'padding-left:2px']) !!}
        </div>
	</div>
</div>
<div class="form-group">
	<label for="nFactura" class="col-xs-1 control-label"><strong>N° Factura <abbr title="Número tentativo puede cambiar al almacenar">?</abbr></strong> </label>
    <div class="col-xs-3">
        {!! Form::hidden('nFacturaPrefix', ($factura->nFacturaPrefix)?$factura->nFacturaPrefix:$modulo->nFacturaPrefix, ['id' => 'nFacturaPrefix', 'class' => 'nFacturaPrefix-input', 'autocomplete'=>'off']) !!}
        <div class="input-group">
            <div class="input-group-btn">
                <button style="max-height:37px" type="button" class="btn btn-default"><span class="nFacturaPrefix-text">{{$modulo->nFacturaPrefix}}</span></button>
            </div>
            {!! Form::text('nFactura', ($factura->nFactura)?$factura->nFactura:$factura->getMaxWith('nFacturaPrefix', 'nFactura', $modulo->nFacturaPrefix), [ 'id' => 'nFactura', 'class'=>"form-control", "data-empty"=>"false", "data-type"=>"int", "data-name"=>"Número de factura", 'readonly'=>'true', 'style' => 'padding-left:2px']) !!}
        </div>
    </div>


	<label for="inputEmail3" class="col-xs-1  control-label"><strong>Fecha<span class="text-danger">*</span> </strong></label>
	<div class="col-xs-3">
		{!! Form::text('fecha', null, [ 'class'=>"form-control", $disabled, "id" =>"fecha", "autocomplete"=>"off"] ) !!}
	</div>

	@if(!isset($bloqueoDosa) || isset($facturaCarga))
	<label for="inputEmail3" class="col-xs-1  control-label"><strong>Fecha Venc.<span class="text-danger">*</span> </strong></label>
	<div class="col-xs-3">
		{!! Form::text('fechaVencimiento', null, [ 'class'=>"form-control", $disabled, "id" =>"fechaVencimiento", "autocomplete"=>"off", "readonly"=>"true"]) !!}
		@if(isset($facturaCarga))
			{!! Form::hidden('aplica_minimo_aterrizaje', $aplica_minimo_aterrizaje) !!}
			{!! Form::hidden('aplica_minimo_estacionamiento', $aplica_minimo_estacionamiento) !!}
			{!! Form::hidden('carga_id', $carga_id) !!}
		@endif
	</div>
	@else
	<label for="inputEmail3" class="col-xs-1  control-label"><strong>Nro. Dosa<span class="text-danger">*</span> </strong></label>
    <div class="col-xs-3">
        <div class="input-group">
            {!! Form::text('nroDosa', $factura->getMaxWith('nFacturaPrefix', 'nroDosa', $modulo->nFacturaPrefix), [ 'id' => 'nroDosa', 'class'=>"form-control", "data-empty"=>"false", "data-type"=>"int", "data-name"=>"Número de Dosa"]) !!}
			{!! Form::hidden('fechaVencimiento') !!}
			{!! Form::hidden('despegue_id', $despegue_id) !!}
        </div>
    </div>
	@endif
	@if(isset($cargosAdicionales))		
		{!! Form::hidden('aterrizaje_id', $aterrizaje_id) !!}
	@endif		
</div>
<div class="form-group">
	<label for="cliente-select" class="control-label col-xs-1"><strong>Cliente<span class="text-danger">*</span></strong></label>
	<div class="col-xs-4">
		<select id="cliente-select" class="form-control" name="cliente_id" autocomplete="off" @if(!isset($bloqueoDosa, $cargosAdicionales) || !$factura->isImpresa) readonly @endif>
			<option value="0" > --Seleccione un cliente-- </option>
			@foreach($clientes as $c)
			<option {{($c->id==$factura->cliente_id)?"selected":""}}
				value="{{$c->id}}"
				data-nombre="{{$c->nombre}}"
				data-ced-rif="{{$c->cedRif}}"
				data-ced-rif-prefix="{{$c->cedRifPrefix}}">{{$c->codigo}} | {{$c->nombre}}</option>
				@endforeach
			</select>
		</div>
		@if($disabled!="disabled" && !isset($bloqueoDosa, $cargosAdicionales) && !$factura->isImpresa)
		<div class="col-xs-1">
			<button type="button" class="btn btn-primary" id="advance-search-btn" data-toggle="modal" data-target="#advance-search-modal"> <span class="glyphicon glyphicon-search"></span></button>
		</div>
		@endif
		<div class="col-xs-3">
			<input class="form-control" id="cliente_nombre-input" readonly autocomplete="off">
		</div>
		<div class="col-xs-3">
			<input class="form-control" id="cliente_cedRif-input" readonly autocomplete="off">
		</div>

	</div>
	<div class="form-group">
		<label class="col-md-1 control-label"><strong>FBO</strong></label>
		<div class="col-md-6">
			<select class="form-control" id="fbo-select" name="fbo_id" autocomplete="off">                                <option value="" selected>--Seleccione una opcion--</option>
				@foreach($fbos as $fbo)

				<option
					value="{{$fbo->id}}">
					{{$fbo->nombre}}
				</option>
				@endforeach    
			</select>                   
		</div>
	</div>
	@if(!isset($bloqueoDosa)&&!isset($facturaCarga) && !$factura->isImpresa)
	<div class="form-group">
		<label for="concepto-input" class="control-label col-xs-1"><strong>Concepto<span class="text-danger">*</span></strong></label>
		<div class="col-xs-4">
			<select id="concepto-select" class="form-control">
				@foreach($conceptos as $c)
				    <option condicionPago="{{$c->condicionPago}}" value="{{$c->id}}" data-costo="{{$c->costo}}" data-iva="{{$c->iva}}">{{$c->nompre}}</option>
				@endforeach
			</select>
		</div>
		@if($disabled!="disabled")
		<div class="col-xs-7">
			<btn class="btn btn-primary" href="" id="add-conceptop-btn"><span class="glyphicon glyphicon-plus"></span></btn>
		</div>
		@endif
	</div>
	@endif

	<div class="table-responsive"  style="margin-bottom:50px">
		<table class="table text-center" id="concepto-table">
			<thead class="bg-primary">
				<tr>
					<th style="min-width:90">Concepto</th>
					<th style="min-width:90">Cantidad</th>
					<th style="min-width:90">Monto Neto</th>
					<th style="min-width:90">% Descuento</th>
					<th style="min-width:90">Monto Descuento</th>
					<th style="min-width:90">% IVA</th>
					<th style="min-width:90">% Recargo</th>
					<th style="min-width:90">Monto Recargo</th>
					<th style="min-width:180px">Monto Total</th>
					@if($disabled!="disabled" && !isset($bloqueoDosa) && !$factura->isImpresa)<th style="min-width:90">Acción</th>@endif
				</tr>
			</thead>

			<tbody>

				@if(isset($factura->detalles))
                    @foreach($factura->detalles as $detalle)
                    <tr>
                        <td style="text-align: left"><input type="hidden" name="concepto_id[]" value="{{$detalle->concepto_id}}" autocomplete="off" />{{$detalle->concepto->nompre}}</td>
                        <td><input {{$disabled}} {{(!$factura->isImpresa)?"":"readonly"}} class="form-control cantidad-input text-right" value="{{$traductor->format($detalle->cantidadDes)}}" name="cantidadDes[]"  autocomplete="off" /></td>
                        <td><input {{$disabled}} {{(!$factura->isImpresa)?"":"readonly"}}  class="form-control monto-input text-right" value="{{$traductor->format($detalle->montoDes)}}" name="montoDes[]"  autocomplete="off" /> </td>
                        <td><input {{$disabled}} {{(!$factura->isImpresa)?"":"readonly"}}  class="form-control descuentoPer-input text-right" value="{{$traductor->format($detalle->descuentoPerDes)}}" name="descuentoPerDes[]"  autocomplete="off" /></td>
                        <td><input {{$disabled}} {{(!$factura->isImpresa)?"":"readonly"}}  class="form-control descuentoTotal-input text-right" value="{{$traductor->format($detalle->descuentoTotalDes)}}" name="descuentoTotalDes[]"  autocomplete="off" /></td>
                        <td><input {{$disabled}} {{(!$factura->isImpresa)?"":"readonly"}}  class="form-control iva-input text-right" value="{{$traductor->format($detalle->ivaDes)}}" name="ivaDes[]"  autocomplete="off" /></td>
                        <td><input {{$disabled}} {{(!$factura->isImpresa)?"":"readonly"}}  class="form-control recargoPer-input text-right" value="{{$traductor->format($detalle->recargoPerDes)}}" name="recargoPerDes[]"  autocomplete="off" /></td>
                        <td><input {{$disabled}} {{(!$factura->isImpresa)?"":"readonly"}}  class="form-control recargoTotal-input text-right" value="{{$traductor->format($detalle->recargoTotalDes)}}" name="recargoTotalDes[]"  autocomplete="off" /></td>
                        <td><input {{$disabled}} {{(!$factura->isImpresa)?"":"readonly"}}  class="form-control total-input text-right" value="{{$traductor->format($detalle->totalDes)}}" readonly name="totalDes[]"  autocomplete="off" /></td>

                        @if($disabled!="disabled" && !isset($bloqueoDosa) && !$factura->isImpresa)
                        <td><button type="button" class="btn btn-danger eliminar-concepto-btn"><span class="glyphicon glyphicon-remove"></span></button></td>
                        @endif
                    </tr>
                    @endforeach
				@endif
			</tbody>
			<tfoot style="background-color: #f3f3f3">
				<tr>
					<td><label  style="padding-top: 10px; text-align: left"><strong>Totales</strong></label></td>
					<td></td>
					<td>
						{!! Form::text('subtotalNeto', $traductor->format($factura->subtotalNeto), [ 'class'=>"form-control text-right", $disabled, "id" =>"subtotalNeto-doc-input", "autocomplete"=>"off", "readonly"]) !!}

					</td>
					<td></td>
					<td>
						{!! Form::text('descuentoTotal', $traductor->format($factura->descuentoTotal), [ 'class'=>"form-control text-right", $disabled, "id" =>"descuentoTotal-doc-input", "autocomplete"=>"off", "readonly"]) !!}
						{!! Form::hidden('subtotal', $traductor->format($factura->subtotal), [ 'class'=>"form-control text-right", $disabled, "id" =>"subtotal-doc-input", "autocomplete"=>"off", "readonly"]) !!}

					</td>
					<td>
						{!! Form::text('iva', $traductor->format($factura->iva), [ 'class'=>"form-control text-right", $disabled, "id" =>"iva-doc-input", "autocomplete"=>"off", "readonly"]) !!}

					</td>
					<td></td>
					<td>
						{!! Form::text('recargoTotal', $traductor->format($factura->recargoTotal), [ 'class'=>"form-control text-right", $disabled, "id" =>"recargoTotal-doc-input", "autocomplete"=>"off", "readonly"]) !!}

					</td>
					<td>
						{!! Form::text('total', $traductor->format($factura->total), [ 'class'=>"form-control text-right", $disabled, "id" =>"total-doc-input", "autocomplete"=>"off", "readonly"]) !!}

					</td>
                    @if($disabled!="disabled" && !isset($bloqueoDosa) && !$factura->isImpresa)
					<td></td>
					@endif
				</tr>



			</tfoot>
		</table>
	</div>

	<div class="form-group">
		<label for="descripcion" class="col-xs-2 control-label"><strong>Descripción<span class="text-danger">*</span></strong></label>
		<div class="col-xs-10">
			@if(isset($facturaCarga))
			{!! Form::textarea('descripcion', "Facturación de Carga", [ 'style'=>'padding-top:4px' ,'class'=>"form-control", $disabled , 'rows'=>"2", 'cols'=>"", "placeholder" => "Descripción de la factura"]) !!}
			@elseif(isset($cargosAdicionales))
			{!! Form::textarea('descripcion', "Facturación por Derechos Aeronáuticos Adicionales", [ 'style'=>'padding-top:4px' ,'class'=>"form-control", $disabled , 'rows'=>"2", 'cols'=>"", "placeholder" => "Descripción de la factura"]) !!}
			@else

			{!! Form::textarea('descripcion', (isset($bloqueoDosa))?'Facturación por Derechos Aeronáuticos: '.$mensajeAterrizaje.'. '.$mensajeEstacionamiento:null, [ 'style'=>'padding-top:4px' ,'class'=>"form-control", $disabled , 'rows'=>"2", 'cols'=>"", "placeholder" => "Descripción de la factura"]) !!}
			@endif
		</div>
	</div>
	<div class="form-group">
		<label for="comentario" class="col-xs-2 control-label"><strong>Comentario</strong></label>
		<div class="col-xs-10">
			{!! Form::textarea('comentario', null, [ 'style'=>'padding-top:4px' ,'class'=>"form-control", $disabled , 'rows'=>"2", 'cols'=>"", "placeholder" => "Uso interno"]) !!}
		</div>
	</div>
