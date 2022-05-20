
<div class="row invoice-info">	
@foreach ($precioAterrizajeDespegue as $precioAterrizajeDespegue) 
    {!! Form::model($precioAterrizajeDespegue, ['url' =>action('PreciosAterrizajesDespegueController@update', [$precioAterrizajeDespegue->id]), "method" => "PUT", "class"=>"form-horizontal"]) !!}
	    @include('configuracionPrecios.confAterrizajeDespegue.Comercial.matriculaNacional.partials.form')
	{!! Form::close() !!}
@endforeach
</div>
<!-- Cancelar o Guardar cambios-->
<hr/>
<div class="row no-print">
	<div class="col-xs-12">
		<button class="btn btn-primary pull-right precioAterrizajeDespegue-save-btn" id="precioAterrizajeDespegueComercial-save-btn" ><i class="fa fa-save"></i> Guardar Cambios</button>
	</div>
</div>

