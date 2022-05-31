@extends('app')

@section('content')

<ol class="breadcrumb">
	<li><a href="{{url('principal')}}">Inicio</a></li>
	<li><a class="active">Relación de Formularios Anulados</a></li>
</ol>
<div class="row" id="box-wrapper">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Filtros</h3>
				<div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				</div><!-- /.box-tools -->
			</div>
			<div class="box-body">
				{!! Form::open(["url" => action('ReporteController@getFormulariosAnulados'), "method" => "GET", "class"=>"form-inline"]) !!}
				<div class="form-group" style="margin-left: 20px">
					<label><strong>MES: </strong></label>
					{!! Form::select('mes', $meses, $mes, ["class"=> "form-control"]) !!}
				</div>
				<div class="form-group" style="margin-left: 20px">
					<label><strong>AÑO: </strong></label>
					{!! Form::select('anno', $annos, $anno, ["class"=> "form-control"]) !!}
				</div>
				<div class="form-group">
					<label style="width:80px"><strong>AEROPUERTO: </strong></label>
					{!! Form::select('aeropuerto', $aeropuertos, $aeropuerto, ["class"=> "form-control"]) !!}
				</div>
				<a class="btn btn-default  pull-right" href="{{action('ReporteController@getFormulariosAnulados')}}">Reset</a>
				<button type="submit" class="btn btn-primary pull-right">Buscar</button>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				{!! Form::open(["url" => action("ReporteController@postExportReport"), "id" =>"export-form", "target"=>"_blank"]) !!}
				{!! Form::hidden('table') !!}
                {!! Form::hidden('gerencia', $gerencia) !!}
                {!! Form::hidden('departamento', $departamento) !!}
				<span class="pull-right">
					<button type="button" class="btn btn-primary" id="export-btn">
						<span class="glyphicon glyphicon-file"></span> Exportar
					</button>
				</span>
				{!! Form::close() !!}
			</div>
			<div class="box-body" >
				<div class="row">
					<div class="col-xs-12">
						<div class="table-responsive" style="max-height: 500px">
							<table class="table table-condensed">
								<thead>
									<tr  class="bg-primary" >
										<th style="vertical-align: middle; width: 1200px"  colspan="6" align="center" class="text-center">
											<strong>FACTURAS ANULADAS</strong>
										</th>
									</tr>
									<tr class="bg-primary">
										<th style="vertical-align: middle; width: 200px; " align="center" class="text-center">
											<strong>NRO.</strong>
										</th>
										<th style="vertical-align: middle; width: 200px; " align="center" class="text-center">
											<strong>FECHA DE ANULACIÓN</strong>
										</th>
										<th style="vertical-align: middle;width: 200px;  " align="center" class="text-center">
											<strong>FECHA DE FACTURACIÓN</strong>
										</th>
										<th style="vertical-align: middle; width: 200px; " align="center" class="text-center">
											<strong>NRO DE FACTURA</strong>
										</th>
										<th style="vertical-align: middle; width: 200px; " align="center" class="text-center">
											<strong>NRO DE CONTROL</strong>
										</th>
										<th style="vertical-align: middle; width: 200px; " align="center" class="text-center">
											<strong>COMENTARIOS</strong>
										</th>
									</tr>
								</thead>
								@if($facturasAnuladas->count()>0)
									@foreach($facturasAnuladas as $index => $factura)
										<tr >
											<td style="vertical-align: middle; width: 200px; " align="center">{{$index+1}}</td>
											<td style="vertical-align: middle; width: 200px; " align="center">{{$factura->deleted_at}}</td>
											<td style="vertical-align: middle; width: 200px; " align="center">{{$factura->fecha}}</td>
											<td style="vertical-align: middle; width: 200px; " align="center" >{{ $factura->nFacturaPrefix }}-{{$factura->nFactura}}</td>
											<td style="vertical-align: middle; width: 200px; " align="center" >{{ $factura->nControlPrefix }}-{{$factura->nControl}}</td>
											<td style="vertical-align: middle; width: 200px; " align="center" >{{($factura->comentario)?$factura->comentario:''}}</td>
										</tr>
									@endforeach 
								@else
									<tr>
										<td colspan="6" class="text-center" align="center">No hay facturas anuladas para las fechas seleccionadas</td>
									</tr>
								@endif
								<thead>
									<tr  class="bg-primary" >
										<th style="vertical-align: middle; width: 1200px" colspan="6" align="center" class="text-center">
											<strong>RECIBOS ANULADOS</strong>
										</th>
									</tr>
									<tr class="bg-primary">
										<th style="vertical-align: middle;  width: 200px"  align="center" class="text-center">
											<strong>NRO.</strong>
										</th>
										<th style="vertical-align: middle;  width: 200px"  align="center" class="text-center">
											<strong>FECHA DE ANULACIÓN</strong>
										</th>
										<th style="vertical-align: middle;  width: 200px"  align="center" class="text-center">
											<strong>FECHA DE COBRO</strong>
										</th>
										<th style="vertical-align: middle;  width: 200px" align="center" class="text-center">
											<strong>NRO DE RECIBO</strong>
										</th>
										<th style="vertical-align: middle;  width: 200px " align="center" class="text-center">
											<strong>NRO COBRO</strong>
										</th>
										<th style="vertical-align: middle;  width: 200px " align="center" class="text-center">
											<strong>COMENTARIOS</strong>
										</th>
									</tr>
									</thead>
								@if($recibosAnulados->count()>0)
									@foreach($recibosAnulados as $index => $recibo)
									<tr>
										<td style="vertical-align: middle;  width: 200px" align="center">{{$index+1}}</td>
										<td style="vertical-align: middle;  width: 200px" align="center">{{$recibo->fecha}}</td>
										<td style="vertical-align: middle;  width: 200px" align="center">{{$recibo->cobro->fecha}}</td>
										<td style="vertical-align: middle;  width: 200px" align="center" >{{$recibo->nroRecibo}}</td>
										<td style="vertical-align: middle;  width: 200px" align="center" >{{$recibo->cobro_id}}</td>
										<td style="vertical-align: middle;  width: 200px" align="center" >{{($recibo->comentario)?$recibo->comentario:''}}</td>
									</tr>
									@endforeach 
								@else
									<tr>
										<td colspan="6" class="text-center" align="center">No hay recibos anulados para las fechas seleccionadas</td>
									</tr>
								@endif
			                    </tbody>
			                </table>
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</div>


@endsection

@section('script')
<script>
	$(function(){


		$('#cliente').chosen({width:'400px'});

		var metaTotal=0;
		$('.meta').each(function(index,value){
			metaTotal+=parseInt($(value).text().trim());
		});

		var recaudadoTotal=0;
		$('.recaudado').each(function(index,value){
			recaudadoTotal+=parseInt($(value).text().trim());
		});

		var diferenciaTotal=0;
		$('.diferencia').each(function(index,value){
			diferenciaTotal+=parseInt($(value).text().trim());
		});

		$('#metaTotal').text(metaTotal);
		$('#recaudadoTotal').text(recaudadoTotal);
		$('#diferenciaTotal').text(diferenciaTotal);


		$('#export-btn').click(function(e){
			var table=$('table').clone();
			$(table).find('td, th').filter(function() {
				return $(this).css('display') == 'none';
			}).remove();
			$(table).find('tr').filter(function() {
				return $(this).find('td,th').length == 0;
			}).remove();
			$(table).prepend('<thead>\
								<tr>\
									<th colspan="6" style="vertical-align: middle; margin-top:20px" align="center" class="text-center">RELACIÓN DE FORMULARIOS ANULADOS\
										</br>\
										MES: {{ mesEnLetras($mes) }} AÑO: {{$anno}}\
									</th>\
								</tr>\
							</thead>')
			$(table).find('thead, th').css({'border-top':'1px solid black', 'font-weight': 'bold', 'text-align':"center", 'font-size': '12px'})
			$(table).find('th').css({'border-bottom':'1px solid black', 'font-weight': 'bold', 'text-align':"center", 'font-size': '12px'})
			$(table).find('td').css({'font-size': '10px'})
			$(table).find('tr:nth-child(even)').css({'border-bottom':'1px solid black'})
			$(table).find('tr:last td').css({'border-bottom':'1px solid black','border-top':'1px solid black', 'font-weight': 'bold'})
			var tableHtml= $(table)[0].outerHTML;
			$('[name=table]').val(tableHtml);
			$('#export-form').submit();
		})

	})
</script>


@endsection
