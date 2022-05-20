

<div class="box-body">
	<p class="help-block text-right"><span class="text-danger">*</span> Campos obligatorios</p>
	<h6><strong>Información General</strong></h6>
	<div class="form-group">
		<label for="nombre" class="col-sm-2 control-label">Nombre<span class="text-danger">*</span></label>
		<div class="col-sm-10">
			{!! Form::text('nombre', null, [ 'class'=>"form-control", $disabled, "placeholder"=>"Nombre del Módulo", "maxlength"=>"100"]) !!}

		</div>
	</div>
	<div class="form-group">
		<label for="descripcion" class="col-sm-2 control-label">Descripción</label>
		<div class="col-sm-10">
			{!! Form::text('descripcion', null, [ 'class'=>"form-control", $disabled, "placeholder"=>"Descripción del Módulo"]) !!}

		</div>
	</div>
	<div class="form-group">
		<label for="nombreImprimible" class="col-sm-2 control-label">Nombre Imprimible</label>
		<div class="col-sm-10">
			{!! Form::text('nombreImprimible', null, [ 'class'=>"form-control", $disabled, "placeholder"=>"Nombre que se visualizará en los reportes"]) !!}
		</div>
	</div>
	<h6><strong>Facturas del Sistema</strong></h6>
	<div class="form-group">
		<label for="nControlPrefix" class="col-sm-2 control-label">Prefijo de control</label>
		<div class="col-sm-10">
			{!! Form::text('nControlPrefix', null, ['class'=>"form-control", $disabled, "placeholder"=>"Prefijo del numero de control usado del Módulo"]) !!}
		</div>
	</div>
	<div class="form-group">
		<label for="nFacturaPrefix" class="col-sm-2 control-label">Prefijo de factura</label>
		<div class="col-sm-10">
			{!! Form::text('nFacturaPrefix', null, ['class'=>"form-control", $disabled, "placeholder"=>"Prefijo del numero de factura usado del Módulo"]) !!}
		</div>
	</div>
	<h6><strong>Facturas Manuales</strong></h6>
	<div class="form-group">
		<label for="nControlPrefix" class="col-sm-2 control-label">Prefijo de control</label>
		<div class="col-sm-10">
			{!! Form::text('nControlPrefixManual', null, ['class'=>"form-control", $disabled, "placeholder"=>"Prefijo del numero de control usado del módulo para facturas manuales"]) !!}
		</div>
	</div>
	<div class="form-group">
		<label for="nFacturaPrefix" class="col-sm-2 control-label">Prefijo de factura</label>
		<div class="col-sm-10">
			{!! Form::text('nFacturaPrefixManual', null, ['class'=>"form-control", $disabled, "placeholder"=>"Prefijo del numero de factura usado del módulo para facturas manuales"]) !!}
		</div>
	</div>

	<div class="form-group">
		<div class='col-xs-6 text-center'>
			<label><strong>Conceptos sin módulos</strong></label>
		</div>

		<div class='col-xs-6 text-center'>
			<label><strong>Conceptos asignados al módulo</strong></label>
		</div>
		<div class="col-sm-12">
			<select multiple="multiple" id="conceptos-select" name="conceptos[]" {{$disabled}}>
				@if(isset($conceptosSinModulo))
				@foreach($conceptosSinModulo as $concepto)
				<option value="{{$concepto->id}}">{{$concepto->nompre}}</option>
				@endforeach
				@endif
				@foreach($modulo->conceptos as $concepto)
				<option value="{{$concepto->id}}" selected>{{$concepto->nompre}}</option>
				@endforeach
			</select>
		</div>
	</div>
</div><!-- /.box-body -->
@if($disabled!="disabled")
<div class="box-footer text-right">
	<button class="btn btn-primary"> {{$SubmitBtnText}} </button>
</div>
@endif