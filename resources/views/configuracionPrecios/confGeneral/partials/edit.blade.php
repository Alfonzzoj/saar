
<div class="row invoice-info">	
@foreach ($confGeneral as $confGeneral) 
    {!! Form::model($confGeneral, ['url' =>action('MontosFijoController@update', [$confGeneral->id]), "method" => "PUT", "class"=>"form-horizontal"]) !!}
	    @include('configuracionPrecios.confGeneral.partials.form')
	{!! Form::close() !!}
@endforeach
</div>
<!-- Cancelar o Guardar cambios-->
<hr/>
<div class="row no-print">
	<div class="col-xs-12">
		<button class="btn btn-primary pull-right confGeneral-save-btn" id="confGeneral-save-btn" ><i class="fa fa-save"></i> Guardar Cambios</button>
	</div>
</div>

