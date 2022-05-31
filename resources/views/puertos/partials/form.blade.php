
	<div class="form-group">
		<label for="nombre" class="col-sm-2 control-label">Nombre</label>
		<div class="col-sm-10">
			{!! Form::text('nombre', null, [ 'class'=>"form-control", $disabled, "placeholder"=>"Nombre del Puerto", "maxlength"=>"255"]) !!}

		</div>
	</div>
	<div class="form-group">
		<label for="siglas" class="col-sm-2 control-label">Nomenclatura</label>
		<div class="col-sm-10">
			{!! Form::text('siglas', null, [ 'class'=>"form-control", $disabled, "placeholder"=>"Localizador del Puerto"]) !!}
		</div>
	</div>
	<div class="form-group">
		<label for="pais_id" class="col-sm-2 control-label">País</label>
		<div class="col-sm-10">
			{!! Form::select('pais_id',	$paises, null, [ 'class'=>"form-control"]) !!}
		</div>
	</div>
	<div class="form-group">
		<label for="estado" class="col-sm-2 control-label">Status</label>
		<div class="col-sm-10">
			{!! Form::checkbox('estado', true, null) !!} Activo
		</div>
	</div>


