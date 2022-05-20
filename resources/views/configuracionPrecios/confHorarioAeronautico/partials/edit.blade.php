<div class="row invoice-info">
@foreach ($horarioAeronautico as $horarioAeronautico) 
    {!! Form::model($horarioAeronautico, ['url' =>action('HorarioAeronauticoController@update', [$horarioAeronautico ->id]), "method" => "PUT", "class"=>"form-horizontal"]) !!}
	    @include('configuracionPrecios.confHorarioAeronautico.partials.form')
	{!! Form::close() !!}
@endforeach
</div> <!-- /.row -->
<!-- Cancelar o Guardar cambios-->
<hr/>
<div class="row no-print">
	<div class="col-xs-12">
		<button class="btn btn-primary pull-right horarioAeronautico-save-btn"  id="horarioAeronautico-save-btn"><i class="fa fa-save"></i> Guardar Cambios</button>
	</div>
</div>