@extends('app')
@section('content')
<section class="content-header">
		<h1>
			<span style="font-size: 15px; font-family: 'Source Sans Pro','Helvetica Neue','Helvetica','Arial','sans-serif';"><i class="fa fa-bank"></i> SALDO EN BANCO</span>
			<small><b>Bs. {{ $traductor->format($banco) }}</b></small>
			<div class="pull-right">
				<div style="font-size: 15px; font-family: 'Source Sans Pro','Helvetica Neue','Helvetica','Arial','sans-serif';">

					{!! Form::open(['route' => 'dashboard.direccion', 'method' => 'GET']) !!}
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
{{--@include('dashboards.direccion.partials.bancoBox')--}}
@include('dashboards.direccion.partials.infoBox') 
@include('dashboards.direccion.partials.lineChart')
@include('dashboards.direccion.partials.totalesAeronauticosNo')
@include('dashboards.direccion.partials.ingresoMensualLocalesHangares')
{{--@include('dashboards.direccion.partials.barChart') --}}
{{--@include('dashboards.direccion.partials.cantidadOperaciones') --}}

@section('script')
	<script>
		@include('dashboards.direccion.partials.script') 
	</script>
@endsection
@endsection