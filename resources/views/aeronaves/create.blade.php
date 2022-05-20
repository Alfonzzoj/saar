@extends('app')
@section('content')
<div class="row" id="box-wrapper">
	<!-- left column -->
	<div class="col-md-12">
		<!-- general form elements -->
		<div class="box box-primary">

			<div class="box-header">
				<h3 class="box-title">Registro de Aeronave</h3>
			</div><!-- /.box-header -->
			<!-- form start -->
			{!! Form::model($aeronave, ['url' =>action('AeronaveController@store', "method" => "POST"]) !!}
				@include('aeronave.partials.form', ["disabled" =>""])
			{!! Form::close() !!}
		</div><!-- /.box -->
	</div>
</div>
@endsection
@section('script')