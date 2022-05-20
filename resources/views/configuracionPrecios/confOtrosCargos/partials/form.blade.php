<h6><b>Concepto</b></h6>
<hr>
<div class="form-group">
	<label for="concepto_id" class="col-sm-2 control-label">Concepto: </label>
	<div class="col-sm-10">
		{!! Form::select('concepto_id',	$conceptos, null, [ 'class'=>"form-control"]) !!}
	</div>
</div>
<br>
<h6><b>Vuelo</b></h6>
<hr>
<div class="form-group">
	<label for="procedencia" class="col-sm-2 control-label">Procedencia: </label>
	<div class="col-sm-10">
		{!! Form::select('procedencia',	$nacionalidades_vuelos, null, [ 'class'=>"form-control"]) !!}
	</div>
</div>
<br>
<h6><b>Matrícula</b></h6>
<hr>
<div class="form-group">
	<label for="tipo_matricula" class="col-sm-2 control-label">Tipo Matrícula: </label>
	<div class="col-sm-10">
		{!! Form::select('tipo_matricula',	$tipos_matriculas, null, [ 'class'=>"form-control"]) !!}
	</div>
</div>
<div class="form-group">
	<label for="nacionalidad_matricula" class="col-sm-2 control-label">Nacionalidad Matrícula: </label>
	<div class="col-sm-10">
		{!! Form::select('nacionalidad_matricula',	$nacionalidades_vuelos, null, ['id' =>"nacionalidad_matricula-modal" ,'class'=>"form-control"]) !!}
	</div>
</div>
<br>
<h6><b>Monto</b></h6>
<hr>
	<div id="d-tributarias-modal" class="form-group">
		<div class="col-sm-10">
			<label for="unidad_tributaria" class="col-sm-2 control-label" >Cantidad de unidades: </label>
			<div class="input-group">		
				{!! Form::text('cantidad_unidades', null, ['id'=>"unidad_tributaria-modal", 'class'=>"form-control",'style' => "margin-left: 10px;", $disabled, "placeholder"=>""]) !!}
				<span class="input-group-addon"></span>
			</div>
		</div>
	</div>							
	<div class="input-group">
		<span class="input-group-addon">Tipo pago</span>
		{!! Form::select('tipo_pago_id',$tipo_pagos,$otrosCargo->tipo_pago_id, [ 'class'=>"form-control", 'id' => 'tipo_pago_otros_cargos']) !!}
	</div>
<br>
<h6><b>Pesos</b></h6>
<hr>
<div class="form-group" >
	<div class="col-sm-10">
		<label for="peso_desde" class="col-sm-2 control-label">Desde: </label>
		<div class="input-group">		
			{!! Form::text('peso_desde', null, [ 'class'=>"form-control", $disabled, "placeholder"=>"Peso Desde"]) !!}
			<span class="input-group-addon">Kg(s)</span>
		</div>
	</div>
</div>
<div class="form-group" >
	<div class="col-sm-10">
		<label for="peso_desde" class="col-sm-2 control-label">Hasta: </label>
		<div class="input-group">		
			{!! Form::text('peso_hasta', null, [ 'class'=>"form-control", $disabled, "placeholder"=>"Peso Hasta"]) !!}
			<span class="input-group-addon">Kg(s)</span>
		</div>
	</div>
</div>
<br>