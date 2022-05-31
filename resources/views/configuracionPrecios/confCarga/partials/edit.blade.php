
<div class="row invoice-info">	
@foreach ($precioCargas as $precioCarga) 
    {!! Form::model($precioCarga, ['url' =>action('PreciosCargaController@update', [$precioCarga->id]), "method" => "PUT", "class"=>"form-horizontal"]) !!}
	    @include('configuracionPrecios.confCarga.partials.form')
	{!! Form::close() !!}
@endforeach
</div>
<!-- Cancelar o Guardar cambios-->
<hr/>
<div class="row no-print">
	<div class="col-xs-12">
		<button class="btn btn-primary pull-right precioCarga-save-btn" id="precioCarga-save-btn" ><i class="fa fa-save"></i> Guardar Cambios</button>
	</div>
</div>

