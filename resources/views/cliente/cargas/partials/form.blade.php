<h5><i align="center" class="fa fa-plane"></i> Información de Vuelo</h5>


<input type="hidden" name="" id="precio_bloque" class="form-control" value="{{$precios_cargas->equivalenteUT}}">	
<input type="hidden" name="" id="toneladas_bloque" class="form-control" value="{{$precios_cargas->toneladaPorBloque}}">	
<input type="hidden" name="" id="ut" class="form-control" value="{{$montos_fijos->unidad_tributaria}}">	
				
<div class="form-group" >
	<label for="fecha" class="col-sm-2 control-label" >Fecha</label>
	<div class="col-sm-10">
		{!! Form::text('fecha', null, [ 'class'=>"form-control fecha", "disabled"=>"disabled",  "placeholder"=>"Fecha"]) !!}
	</div>
</div>
<div class="form-group">
	<label for="cliente_id" class="col-sm-2 control-label">Cliente</label>
	<div class="col-sm-10">
		<select name="cliente_id" class="form-control cliente">
			<option value="">--Seleccione Cliente--</option>
			@foreach ($clientes as $index=>$cliente)
			<option value="{{$index}}" {{(($carga->cliente_id == $index)?"selected":"")}}> {{$cliente}}</option>
			@endforeach
		</select>
	</div>
</div>
<h5><i align="center" class="fa fa-truck"></i> Información de Carga</h5>
<div class="form-group" >
	<label for="peso_embarcado" class="col-sm-2 control-label" >Peso Embarcado (Kgs)</label>
	<div class="col-sm-10">
		{!! Form::text('peso_embarcado', null, [ 'class'=>"form-control peso_embarcado",  "placeholder"=>"Peso Embarcado"]) !!}
	</div>
</div>


<div class="form-group" >
	<label for="peso_desembarcado" class="col-sm-2 control-label" >Peso Desembarcado (Kgs)</label>
	<div class="col-sm-10">
		{!! Form::text('peso_desembarcado', null, [ 'class'=>"form-control peso_desembarcado",  "placeholder"=>"Peso Desembarcado"]) !!}
	</div>
</div>

