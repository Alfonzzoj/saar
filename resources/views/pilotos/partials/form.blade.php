<div class="form-group">
	<label for="nombre" class="col-sm-2 control-label">Nombre y Apellido</label>
	<div class="col-sm-10">
		{!! Form::text('nombre', null, [ 'class'=>"form-control", $disabled, "placeholder"=>"Nombre Completo del Piloto", "maxlength"=>"255"]) !!}

	</div>
</div> 

<div class="form-group" >
	<label for="licencia" class="col-sm-2 control-label" >C.I</label>
	<div class="col-sm-10">
		{!! Form::text('documento_identidad', null, [ 'class'=>"form-control", $disabled, "placeholder"=>"Documento de Identidad"]) !!}

	</div>
</div>
<div class="form-group">
	<label for="telefono" class="col-sm-2 control-label">País</label>
	<div class="col-sm-10">
		{!! Form::select('nacionalidad_id',	$nacionalidad, null, [ 'class'=>"form-control"]) !!}
	</div>
</div>
<div class="form-group" >
	<label for="licencia" class="col-sm-2 control-label" >Licencia</label>
	<div class="col-sm-10">
		{!! Form::text('licencia', null, [ 'class'=>"form-control", $disabled, "placeholder"=>"Licencia del Piloto"]) !!}

	</div>
</div>
<div class="form-group">
	<label for="telefono" class="col-sm-2 control-label">Número de Contacto</label>
	<div class="col-sm-10">
		{!! Form::text('telefono', null, [ 'class'=>"form-control", $disabled, "placeholder"=>"Teléfono de Contacto"]) !!}
	</div>
</div>
<div class="form-group">
	<label for="estado" class="col-sm-2 control-label">Estado</label>
	<div class="col-sm-10">
			{!! Form::checkbox('estado', true, null) !!} Activo
	</div>
</div>