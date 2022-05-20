

<div class="form-group">
	<label for="nacionalidad_id" class="col-sm-2 control-label">Nacionalidad</label>
	<div class="col-sm-10">
		<select class="form-control no-vacio nacionalidad" name="nacionalidad_id" required>
			<option value="">--Seleccione Nacionalidad--</option>
	        @foreach ($nacionalidad_matriculas as $nacionalidad_matricula)

	        <option data-siglas="{{$nacionalidad_matricula->siglas}}" value="{{$nacionalidad_matricula->id}}" {{(($aeronave->nacionalidad_id == $nacionalidad_matricula->id)?"selected":"")}}> {{$nacionalidad_matricula->nombre}}</option>
   			@endforeach						
		</select>
	</div>
</div>
<div class="form-group" >
	<label for="matricula" class="col-sm-2 control-label" >Matrícula</label>
	<div class="col-sm-10">
		{!! Form::text('matricula', null, [ 'class'=>"form-control matricula", $disabled, "placeholder"=>"Matrícula"]) !!}
	</div>
</div>
<div class="form-group">
	<label for="modelo_id" class="col-sm-2 control-label">Modelo de Aeronave</label>
	<div class="col-sm-10">
		<select class="form-control no-vacio modelo" name="modelo_id" required>
          <option value="">--Seleccione Modelo de Aeronave--</option>
            @foreach ($modelo_aeronaves as $modelo_aeronave)
            <option data-peso="{{$modelo_aeronave->peso_maximo}}" value="{{$modelo_aeronave->id}}" {{(($aeronave->modelo_id == $modelo_aeronave->id)?"selected":"")}}> {{$modelo_aeronave->modelo}}</option>
            @endforeach
        </select>
	</div>
</div>
<div class="form-group" >
	<label for="peso" class="col-sm-2 control-label" >Peso</label>
	<div class="col-sm-10">
		{!! Form::text('peso', null, [ 'class'=>"form-control peso", $disabled, "placeholder"=>"Peso(Kgs.)"]) !!}
	</div>
</div>
<div class="form-group">
	<label for="tipo_id" class="col-sm-2 control-label">Tipo de Matrícula</label>
	<div class="col-sm-10">
		{!! Form::select('tipo_id',	$tipos, null, [ 'class'=>"form-control"]) !!}
	</div>
</div>
<div class="form-group">
	<label for="cliente_id" class="col-sm-2 control-label">Cliente</label>
	<div class="col-sm-10">
		{!! Form::select('cliente_id',	$clientes, null, [ 'class'=>"form-control"]) !!}
	</div>
</div>
<div class="form-group">
	<label for="hangar_id" class="col-sm-2 control-label">Hangar</label>
	<div class="col-sm-10">
		<select class="form-control" id="hangar_id-select" name="hangar_id" >
			<option value=""> No Dispone</option>
			@foreach ($hangares as $index=>$hangar)
			<option value="{{$index}}" {{(($aeronave->hangar_id == $index)?"selected":"No Dispone")}}> {{$hangar}}</option>
			@endforeach
		</select>
	</div>
</div>

