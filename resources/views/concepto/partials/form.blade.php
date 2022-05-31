<div class="box-body">
	<p class="help-block text-right"><span class="text-danger">*</span> Campos obligatorios</p>
	<div class="form-group">
		<div class="col-sm-12 text-right">
			<button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
				<span class="glyphicon glyphicon-glass"></span> Información adicional
			</button>
		</div>
	</div>
	<div class="form-group">
		<label for="nompre" class="col-sm-2 control-label">Nombre<span class="text-danger">*</span></label>
		<div class="col-sm-10">
			{!! Form::text('nompre', null, [ 'class'=>"form-control", $disabled, "placeholder"=>"Nombre del concepto", "maxlength"=>"255"]) !!}
		</div>
	</div>
	<div class="form-group">
		<label for="iva" class="col-sm-2 control-label">IVA</label>
		<div class="col-sm-10">
			{!! Form::text('iva', null, [ 'class'=>"form-control", $disabled, "placeholder"=>"IVA por defecto del concepto"]) !!}
		</div>
	</div>
	<div class="form-group">
		<label for="nombreImprimible" class="col-sm-2 control-label">Nombre Imprimible</label>
		<div class="col-sm-10">
			{!! Form::text('nombreImprimible', null, [ 'class'=>"form-control", $disabled,  "placeholder"=>"Nombre que se visualizará en los reportes"]) !!}
		</div>
	</div>
	<div class="form-group">
		<label for="iva" class="col-sm-2 control-label">Condición de pago</label>
		<div class="col-sm-10">
		{!! Form::select('condicionPago', ["Crédito" => "Crédito", "Contado"=>"Contado"], null, [ 'class'=>"form-control", $disabled]) !!}
		</div>
	</div>
	<div class="form-group">
		<label for="iva" class="col-sm-2 control-label">Recargo por feriado</label>
		<div class="col-sm-10">
		{!! Form::select('recargo', ["SI" => "SI", "NO"=>"NO"], null, [ 'class'=>"form-control", $disabled]) !!}
		</div>
	</div>

	<div class="collapse" id="collapseExample">
		<div class="well">
			<div class="form-group">
				<label for="codcta" class="col-sm-2 control-label">Aeropuerto</label>
				<div class="col-sm-10">
					{!! Form::text(null, ((isset($concepto->aeropuerto))?$concepto->aeropuerto->nombre:'No esta asignado a ningun aeropuerto'), ['readonly', 'class'=>"form-control", $disabled, "placeholder"=>"Nombre del aeropuerto", "maxlength"=>"255"]) !!}
				</div>
			</div>
			<div class="form-group">
				<label for="codcta" class="col-sm-2 control-label">Módulo</label>
				<div class="col-sm-10">
					{!! Form::text(null, ((isset($concepto->modulo))?$concepto->modulo->nombre:'No esta asignado a ningún módulo'), ['readonly', 'class'=>"form-control", $disabled, "placeholder"=>"Nombre del modulo asignado", "maxlength"=>"255"]) !!}
				</div>
			</div>
			<div class="form-group">
				<label for="codpre" class="col-sm-2 control-label">Código presupuestario</label>
				<div class="col-sm-10">
					{!! Form::text('codpre', null, [null, 'class'=>"form-control", $disabled, "placeholder"=>"Información del código presupuestario", "maxlength"=>"255"]) !!}
				</div>
			</div>
			<div class="form-group">
				<label for="codcta" class="col-sm-2 control-label">Código contable</label>
				<div class="col-sm-10">
					{!! Form::text('codcta', null, [null, 'class'=>"form-control", $disabled, "placeholder"=>"Información del código contable", "maxlength"=>"255"]) !!}
				</div>
			</div>
		</div>
	</div>

</div><!-- /.box-body -->
@if($disabled!="disabled")
<div class="box-footer">
	<button class="btn btn-primary"> {{$SubmitBtnText}} </button>
</div>
@endif