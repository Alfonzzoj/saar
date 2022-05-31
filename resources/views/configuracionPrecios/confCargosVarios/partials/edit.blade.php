
<div class="row invoice-info">	
@foreach ($cargosVarios as $cargosVarios) 
    {!! Form::model($cargosVarios, ['url' =>action('CargosVarioController@update', [$cargosVarios->id]), "method" => "PUT", "class"=>"form-horizontal"]) !!}
	    @include('configuracionPrecios.confCargosVarios.partials.form')
	{!! Form::close() !!}
@endforeach
</div>
<!-- Cancelar o Guardar cambios-->
<hr/>
<div class="row no-print">
	<div class="col-xs-12">
		<button class="btn btn-primary pull-right cargosVarios-save-btn" id="cargosVarios-save-btn" ><i class="fa fa-save"></i> Guardar Cambios</button>
	</div>
</div>

