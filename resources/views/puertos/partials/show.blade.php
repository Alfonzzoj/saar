<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Información del Puerto</h3>
			</div>
			{!! Form::model($puerto, [ "class" => "form-horizontal"]) !!}
			@include('puertos.partials.form', ["disabled" =>"disabled"])
			{!! Form::close() !!}
		</div>
	</div>
</div>