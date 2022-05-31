<h5><i align="center" class="fa fa-plane"></i>Información de Aterrizaje</h5>

<div class="form-group" >
	<label for="fecha" class="col-sm-2 control-label" >Fecha</label>
	<div class="col-sm-10">
		{!! Form::text('fecha', null, [ 'class'=>"form-control fecha",  "placeholder"=>"Fecha"]) !!}
	</div>
</div>
<div class="form-group" >
	<label for="hora" class="col-sm-2 control-label" >Hora</label>
	<div class="col-sm-10">
		{!! Form::text('hora', null, [ 'class'=>"form-control hora", "placeholder"=>"Hora"]) !!}
	</div>
</div> 
<div class="form-group">
	<label for="aeronave_id" class="col-sm-2 control-label">Aeronave</label>
	<div class="col-sm-10">
		<select class="form-control no-vacio aeronave" name="aeronave_id" required>
			<option value="">--Seleccione Aeronave--</option>
	        @foreach ($aeronaves as $aeronave)
	        <option data-modelo="{{$aeronave->modelo_id}}" data-nombremodelo="{{$aeronave->modelo->modelo}}" data-cliente="{{$aeronave->cliente_id}}" data-tipo="{{$aeronave->tipo_id}}" data-tipoV="{{$aeronave->tipo->nombre}}" value="{{$aeronave->id}}" {{(($aterrizaje->aeronave_id == $aeronave->id)?"selected":"")}}> {{$aeronave->matricula}}</option>
   			@endforeach						
		</select>
	</div>
</div>
<div class="form-group">
	<label for="cliente_id" class="col-sm-2 control-label">Cliente</label>
	<div class="col-sm-10">
		<select name="cliente_id" class="form-control cliente">
			<option value="">--Seleccione Cliente--</option>
			@foreach ($clientes as $index=>$cliente)
			<option value="{{$index}}" {{(($aterrizaje->cliente_id == $index)?"selected":"")}}> {{$cliente}}</option>
			@endforeach
		</select>
	</div>
</div>
<div class="form-group">
	<label for="puerto_id" class="col-sm-2 control-label">Procedencia</label>
	<div class="col-sm-10">								
		<select name="puerto_id" class="form-control puerto">
			<option value="">--Seleccione Procedencia--</option>
			@foreach ($puertos as $puerto)
			<option  data-nacionalidad="{{$puerto->pais_id}}" value="{{$puerto->id}}" {{(($aterrizaje->puerto_id == $puerto->id)?"selected":"")}}> {{$puerto->nombre}}</option>
			@endforeach
		</select>
	</div>
</div>
<div class="form-group">
	<label for="piloto_id" class="col-sm-2 control-label">Piloto</label>
	<div class="col-sm-10">												                                    
		<select name="piloto_id" class="form-control piloto">
			<option value="">--Seleccione Piloto--</option>
			@foreach ($pilotos as $piloto)
			<option data-ci="{{$piloto->documento_identidad}}" value="{{$piloto->id}}" {{(($aterrizaje->piloto_id == $piloto->id)?"selected":"")}}> {{$piloto->nombre}}</option>
			@endforeach
		</select>
	</div>
</div>
<div class="form-group">
	<label for="tipoMatricula_id" class="col-sm-2 control-label">Tipo de Vuelo</label>
	<div class="col-sm-10">	
		<select name="tipoMatricula_id" class="form-control tipo_vuelo">
			<option value="">--Seleccione Tipo de Vuelo--</option>
			@foreach ($tipoMatriculas as $tipoMatricula)
			<option value="{{$tipoMatricula->id}}" {{(($aterrizaje->tipoMatricula_id == $tipoMatricula->id)?"selected":"")}}> {{$tipoMatricula->nombre}}</option>
			@endforeach
		</select>
	</div>
</div>
<div class="form-group" >
	<label for="num_vuelo" class="col-sm-2 control-label" >Número de Vuelo</label>
	<div class="col-sm-10">
		{!! Form::text('num_vuelo', ($aterrizaje->num_vuelo)?$aterrizaje->num_vuelo:'N/A', [ 'class'=>"form-control num_vuelo",  "placeholder"=>"Número de Vuelo"]) !!}
	</div>
</div>
<h5><i align="center" class="fa fa-plane"></i>Desembarque</h5>
<div class="form-group" >
	<label for="desembarqueAdultos" class="col-sm-2 control-label" >Adultos</label>
	<div class="col-sm-10">
		{!! Form::text('desembarqueAdultos', null, [ 'class'=>"form-control desembarqueAdultos",  "placeholder"=>"Hora"]) !!}
	</div>
</div>

<div class="form-group" >
	<label for="desembarqueInfante" class="col-sm-2 control-label" >Infantes</label>
	<div class="col-sm-10">
		{!! Form::text('desembarqueInfante', null, [ 'class'=>"form-control desembarqueInfante",  "placeholder"=>"Hora"]) !!}
	</div>
</div>

<div class="form-group" >
	<label for="desembarqueTercera" class="col-sm-2 control-label" >Tercera Edad</label>
	<div class="col-sm-10">
		{!! Form::text('desembarqueTercera', null, [ 'class'=>"form-control desembarqueTercera",  "placeholder"=>"Hora"]) !!}
	</div>
</div>

<div class="form-group" >
	<label for="desembarqueTransito" class="col-sm-2 control-label" >Tránsito</label>
	<div class="col-sm-10">
		{!! Form::text('desembarqueTransito', null, [ 'class'=>"form-control desembarqueTransito",  "placeholder"=>"Hora"]) !!}
	</div>
</div>