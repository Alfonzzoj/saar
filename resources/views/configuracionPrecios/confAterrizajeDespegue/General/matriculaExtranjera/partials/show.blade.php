
<div class="row invoice-info">	
    @foreach ($precioAterrizajeDespegue as $precioAterrizajeDespegue)
	    {!! Form::model($precioAterrizajeDespegue, []) !!}
	        @include('configuracionPrecios.precioAterrizajeDespegueGeneral.partials.form')
	    {!! Form::close() !!}
	@endforeach
</div>
<!-- Cancelar o Guardar cambios-->
<hr/>
<div class="row no-print">
	<div class="col-xs-12">
		<button class="btn btn-primary pull-right precioAterrizajeDespegueGeneral-save-btn" id="precioAterrizajeDespegueGeneral-save-btn" ><i class="fa fa-save"></i> Guardar Cambios</button>
		<button class="btn btn-default pull-right" style="margin-right: 5px;"> Cancelar</button>
	</div>
</div>