<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Información del Usuario</h3>
			</div>
			{!! Form::model($usuario, [ "class" => "form-horizontal"]) !!}
			@include('usuarios.partials.form', ["disabled" =>"disabled"])
			{!! Form::close() !!}
		</div>
	</div>
</div>