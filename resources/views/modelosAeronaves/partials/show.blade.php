<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Información de Modelo</h3>
			</div>
			{!! Form::model($modelosAeronaves, [ "class" => "form-horizontal"]) !!}
			@include('modelosAeronaves.partials.form', ["disabled" =>"disabled"])
			{!! Form::close() !!}
		</div>
	</div>
</div>