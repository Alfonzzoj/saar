<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Información del Hangar</h3>
			</div>
			{!! Form::model($hangar, [ "class" => "form-horizontal"]) !!}
			@include('hangares.partials.form', ["disabled" =>"disabled"])
			{!! Form::close() !!}
		</div>
	</div>
</div>