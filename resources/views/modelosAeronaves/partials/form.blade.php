
	<div class="form-group">
		<label for="modelo" class="col-sm-2 control-label">Modelo</label>
		<div class="col-sm-10">
			{!! Form::text('modelo', null, [ 'class'=>"form-control", $disabled, "placeholder"=>"Nombre del Modelo", "maxlength"=>"255"]) !!}

		</div>
	</div>
	<div class="form-group">
		<label for="peso_maximo" class="col-sm-2 control-label">Peso (Kgs.)</label>
		<div class="col-sm-10">
			{!! Form::text('peso_maximo', null, [ 'class'=>"form-control", $disabled, "placeholder"=>"Peso Máximo de la Aeronave (Kgs.)"]) !!}

		</div>
	</div>
	<div class="form-group">
		<label for="tipo_id" class="col-sm-2 control-label">Tipo de Aeronave</label>
		<div class="col-sm-10">
	{!! Form::select('tipo_id',	$tipos, null, [ 'class'=>"form-control"]) !!}
		</div>
	</div>


