@extends('app')
@section('content')
<section class="content-header">
		<h1>
			@if(\Request::is('dashboard/Recaudacion'))
				<span style="font-size: 15px; font-family: 'Source Sans Pro','Helvetica Neue','Helvetica','Arial','sans-serif';"><i class="fa fa-bank"></i> SALDO EN BANCO</span>
				<small><b>Bs. {{ $traductor->format($banco) }}</b></small>
			@else
				<span style="font-size: 15px; font-family: 'Source Sans Pro','Helvetica Neue','Helvetica','Arial','sans-serif';">OPERADOR RECAUDACIÓN</span>
			@endif

			<div class="pull-right">
				<div style="font-size: 15px; font-family: 'Source Sans Pro','Helvetica Neue','Helvetica','Arial','sans-serif';">

					@if(\Request::is('dashboard/Recaudacion'))
						{!! Form::open(['route' => 'dashboard.recaudacion', 'method' => 'GET']) !!}
					@else
						{!! Form::open(['route' => 'dashboard.oprecaudacion', 'method' => 'GET']) !!}
					@endif
							Fecha: 
							{!! Form::select('mes', ['1' => 'Enero','2' => 'Febrero','3' => 'Marzo','4' => 'Abril','5' => 'Mayo','6' => 'Junio','7' => 'Julio','8' => 'Agosto','9' => 'Septiembre','10' => 'Octubre','11' => 'Noviembre','12' => 'Diciembre'], $mes, ['id' => 'mes']) !!}
							{!! Form::selectRange('anno', $minanno, $maxanno , $anno, ['class' => '', 'id' => 'anno','style' => 'width: 50px;']) !!}
							<button id="fecha-filtrar" type="submit" class="btn btn-sm btn-flat btn-primary" style="height: 24px; width: 20px padding: 0px; margin: 0px;">
								<i class="fa fa-filter" style="font-size: 20px; padding: 0px; margin: 0px; margin-top: -5px;"></i>
							</button>
						{!! Form::close() !!}
					

				</div>
			</div>
		</h1>
</section>
{{--@include('dashboards.recaudacion.partials.bancoBox')--}}
@include('dashboards.recaudacion.partials.infoBox') 
@include('dashboards.recaudacion.partials.lineChart')
@include('dashboards.recaudacion.partials.totalesAeronauticosNo')
@include('dashboards.recaudacion.partials.ingresoMensualLocalesHangares')
{{--@include('dashboards.recaudacion.partials.barChart') --}}
{{--@include('dashboards.recaudacion.partials.cantidadOperaciones') --}}

@section('script')
	<script>
		@include('dashboards.recaudacion.partials.script') 
	</script>
@endsection
@endsection