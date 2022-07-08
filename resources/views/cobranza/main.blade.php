@extends('app')
@section('content')
<ol class="breadcrumb">
	<li><a href="{{url('principal')}}">Inicio</a></li>
	<li><a class="active">Cobranza Principal</a></li>
</ol>
<div class="row" id="box-wrapper">
	<!-- left column -->
	<div class="col-md-6">
		<h3>Cobranza</h3>
	</div>

</div>
<div class="row" id="box-wrapper">
	@foreach($modulos as $modulo)

	<div class="col-md-12">
		<!-- general form elements -->
		<div class="box box-primary">
			<div class="box-header">
				@if ($modulo->nombre == "EXONERADO")
				<h3 class="box-title">{{$modulo->descripcion}} </h3>
				@else
				<h3 class="box-title">{{$modulo->nombre}} (Facturas por Cobrar)</h3>
					
				@endif
				<span class="pull-right"><a class="btn btn-primary"  href="{{action('CobranzaController@create', [$modulo->nombre]) }}">Cobrar</a></span>
				<span class="pull-right" ><a class="btn btn-success"  style="margin-right: 5px" href="{{ action('CobranzaController@index', [$modulo->nombre]) }}">Consultar</a></span>
			</div><!-- /.box-header -->
			<!-- form start -->
			<div class="box-body">
				<table class="table text-center">
					<thead class="bg-primary">
						<th># Factura</th>
						<th># Control</th>
						<th>Cliente</th>
						<th>Descripción</th>
						<th>Monto documento</th>
						<th>Monto pendiente</th>
						<th>Fecha Emisión</th>
						<th>Fecha Vencimiento</th>
					</thead>
					<tbody>
						@if($modulo->facturas->count()==0)
						<tr>
							<td colspan="5">No hay facturas registradas en este módulo</td>
						</tr>
						@endif
						@if ($modulo->nombre == "EXONERADO")
						@foreach($exoneradas as $factura)
						<tr>
							<td>{{$factura->nFacturaPrefix}}-{{$factura->nFactura}}</td>
							<td>{{$factura->nControlPrefix}}-{{$factura->nControl}}</td>
							<td style="text-align:left">{{$factura->cliente->nombre}}</td>
							<td style="text-align:left">{{$factura->descripcion}}</td>
							<td style="text-align:right">{{$traductor->format($factura->total)}}</td>
							<td style="text-align:right">
								{{$traductor->format($factura->total-(($factura->metadata)?$factura->metadata->total:0))}}
							</td>
							{{-- <td style="text-align:right">{{$factura->fecha}}</td> --}}
							{{-- <td>{{$factura->fechaVencimiento}}</td> --}}
						</tr>
						@endforeach
						@elseif($modulo->nombre == "ANULADAS")
						@foreach($anuladas as $factura)
						<tr>
							<td>{{$factura->nFacturaPrefix}}-{{$factura->nFactura}}</td>
							<td>{{$factura->nControlPrefix}}-{{$factura->nControl}}</td>
							<td style="text-align:left">{{$factura->cliente->nombre}}</td>
							<td style="text-align:left">{{$factura->descripcion}}</td>
							<td style="text-align:right">{{$factura->fecha}}</td>
							<td style="text-align:right">{{$traductor->format($factura->total)}}</td>
						</tr>
						@endforeach
						@elseif($modulo->nombre == "CANON")
						@foreach($canon as $factura)
						<tr>
							<td>{{$factura->nFacturaPrefix}}-{{$factura->nFactura}}</td>
							<td>{{$factura->nControlPrefix}}-{{$factura->nControl}}</td>
							<td style="text-align:left">{{$factura->cliente->nombre}}</td>
							<td style="text-align:left">{{$factura->descripcion}}</td>
							<td style="text-align:right">{{$factura->fecha}}</td>
							<td style="text-align:right">{{$traductor->format($factura->total)}}</td>
						</tr>
						@endforeach
						@elseif($modulo->nombre == "DOSAS")
						@foreach($dosas as $factura)
						<tr>
							<td>{{$factura->nFacturaPrefix}}-{{$factura->nFactura}}</td>
							<td>{{$factura->nControlPrefix}}-{{$factura->nControl}}</td>
							<td style="text-align:left">{{$factura->cliente->nombre}}</td>
							<td style="text-align:left">{{$factura->descripcion}}</td>
							<td style="text-align:right">{{$factura->fecha}}</td>
							<td style="text-align:right">{{$traductor->format($factura->total)}}</td>
						</tr>
						@endforeach
						@elseif($modulo->nombre == "OTROS INGRESOS NO AERONÁUTICOS")
						@foreach($otros_ingresos_no_aeronauticos as $factura)
						<tr>
							<td>{{$factura->nFacturaPrefix}}-{{$factura->nFactura}}</td>
							<td>{{$factura->nControlPrefix}}-{{$factura->nControl}}</td>
							<td style="text-align:left">{{$factura->cliente->nombre}}</td>
							<td style="text-align:left">{{$factura->descripcion}}</td>
							<td style="text-align:right">{{$factura->fecha}}</td>
							<td style="text-align:right">{{$traductor->format($factura->total)}}</td>
						</tr>
						@endforeach
						@elseif($modulo->nombre == "TARJETAS DE IDENTIFICACION")
						@foreach($tarjetas_identificacion as $factura)
						<tr>
							<td>{{$factura->nFacturaPrefix}}-{{$factura->nFactura}}</td>
							<td>{{$factura->nControlPrefix}}-{{$factura->nControl}}</td>
							<td style="text-align:left">{{$factura->cliente->nombre}}</td>
							<td style="text-align:left">{{$factura->descripcion}}</td>
							<td style="text-align:right">{{$factura->fecha}}</td>
							<td style="text-align:right">{{$traductor->format($factura->total)}}</td>
						</tr>
						@endforeach
						@elseif($modulo->nombre == "TASAS
						")
						@foreach($tasas as $factura)
						<tr>
							<td>{{$factura->nFacturaPrefix}}-{{$factura->nFactura}}</td>
							<td>{{$factura->nControlPrefix}}-{{$factura->nControl}}</td>
							<td style="text-align:left">{{$factura->cliente->nombre}}</td>
							<td style="text-align:left">{{$factura->descripcion}}</td>
							<td style="text-align:right">{{$factura->fecha}}</td>
							<td style="text-align:right">{{$traductor->format($factura->total)}}</td>
						</tr>
						@endforeach
						@elseif($modulo->nombre == "PUBLICIDAD")
						@foreach($publicidad as $factura)
						<tr>
							<td>{{$factura->nFacturaPrefix}}-{{$factura->nFactura}}</td>
							<td>{{$factura->nControlPrefix}}-{{$factura->nControl}}</td>
							<td style="text-align:left">{{$factura->cliente->nombre}}</td>
							<td style="text-align:left">{{$factura->descripcion}}</td>
							<td style="text-align:right">{{$factura->fecha}}</td>
							<td style="text-align:right">{{$traductor->format($factura->total)}}</td>
						</tr>
						@endforeach
						@else
						{{-- DOSAS --}}
						@foreach($modulo->facturas()->where('estado', 'P')->orderBy('id', 'DESC')->limit(15)->get() as
						$factura) 
						<tr>
							<td>{{$factura->nFacturaPrefix}}-{{$factura->nFactura}}</td>
							<td>{{$factura->nControlPrefix}}-{{$factura->nControl}}</td>
							<td style="text-align: left">{{$factura->cliente->nombre}}</td>
							<td style="text-align: left">{{$factura->descripcion}}</td>
							<td>{{$factura->fecha}}</td>
							<td style="text-align: right">{{$traductor->format($factura->total)}}</td>
						</tr>
						@endforeach
						@endif

					</tbody>
				</table>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div>
	@endforeach
</div>
@endsection
