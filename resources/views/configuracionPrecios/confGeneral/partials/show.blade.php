<div class="row invoice-info">	
    @foreach ($confGeneral as $confGeneral)
	    {!! Form::model($confGeneral, []) !!}
	        @include('configuracionPrecios.confGeneral.partials.form')
	    {!! Form::close() !!}
	@endforeach
</div>
<!-- Cancelar o Guardar cambios-->
<hr/>
<div class="row no-print">
	<div class="col-xs-12">
		<button class="btn btn-primary pull-right confGeneral-save-btn" id="confGeneral-save-btn" ><i class="fa fa-save"></i> Guardar Cambios</button>
		<button class="btn btn-default pull-right" style="margin-right: 5px;"> Cancelar</button>
	</div>
</div>