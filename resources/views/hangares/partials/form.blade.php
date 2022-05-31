
<div class="form-group">
	<label for="aeropuerto_id" class="col-sm-2 control-label">Aeropuerto</label>
	<div class="col-sm-10">
		{!! Form::select('aeropuerto_id', $aeropuerto, null, [ 'class'=>"form-control"]) !!}
	</div>
</div> 

<div class="form-group">
	<label for="nombre" class="col-sm-2 control-label">Nombre</label>
	<div class="col-sm-10">
		{!! Form::text('nombre', null, [ 'class'=>"form-control", $disabled, "placeholder"=>"Nombre del Hangar", "maxlength"=>"255"]) !!}

	</div>
</div> 