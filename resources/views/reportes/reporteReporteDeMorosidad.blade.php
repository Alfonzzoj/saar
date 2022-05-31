@extends('app')

@section('content')
<ol class="breadcrumb">
	<li><a href="{{url('principal')}}">Inicio</a></li>
	<li><a class="active">Reporte de Morosidad</a></li>
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
			<div class="box-body text-right">
				{!! Form::open(["url" => action('ReporteController@getReporteDeMorosidad'), "method" => "GET", "class"=>"form-inline"]) !!}
				<div class="form-group" style="margin-left: 20px">
					<label><strong>AÑO:</strong></label>
					{!! Form::select('anno', $annos, $anno, ["class"=> "form-control"]) !!}
				</div>
				<div class="form-group">
					<label><strong>AEROPUERTO: </strong></label>
					{!! Form::select('aeropuerto', $aeropuertos, $aeropuerto, ["class"=> "form-control"]) !!}
				</div>
                <div class="form-group text-left">
                    <label>CLIENTE:</label>
                      {!! Form::select('cliente_id', $clientes, $cliente, ["class"=> "form-control select-flt"]) !!}
                </div>
				<button type="submit" class="btn btn-primary">Buscar</button>
				<a class="btn btn-default" href="{{action('ReporteController@getReporteDeMorosidad')}}">RESET</a>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				{!! Form::open(["url" => action("ReporteController@postExportReport"), "id" =>"export-form", "target"=>"_blank"]) !!}
				{!! Form::hidden('table') !!}
				<span class="pull-right"><button type="button" class="btn btn-primary" id="export-btn"><span class="glyphicon glyphicon-file"></span> Exportar</button></span>
				{!! Form::close() !!}
			</div>
			<div class="box-body" >
				<div class="row">
					<div class="col-xs-12">
						<div class="table-responsive" style="max-height: 500px">
							<table class="table table-hover table-condensed">
								<thead  class="bg-primary">
									<tr>
										<th id="cliente-col" rowspan="2" style="vertical-align: middle; " class="text-center" align="center">
											CLIENTE
										</th>
										<th id="cliente-col" colspan="12" style="vertical-align: middle;" class="text-center" align="center">
											MES
										</th>
										<th id="cliente-col" rowspan="2" style="vertical-align: middle; " class="text-center" align="center">
											TOTAL
										</th>
									</tr>
									<tr>
										@foreach($meses as $index=>$mes)
											<th style="vertical-align: middle;" class="text-center" align="center">
												{{ $mes }}
											</th>
										@endforeach
									</tr>
								</thead>
								<tbody>
									@foreach($clientesMod as $modulo=>$cantCliente)
										@if(count($cantCliente)>0)
											<tr id="NombreModulo">
												<td  colspan="14" style="vertical-align: middle;" class="text-center bg-gray" align="center" >
													<strong>{{ $modulo }}</strong>
												</td>
											</tr>
											@foreach($cantCliente as $index => $cliente_id)
												<tr>
													<td  class="text-left" align="left" style="width: 200px">
														{{ $cliente_id }}
													</td>
													@foreach($facturasPendientesModulo as $mod => $facturasPendientes)
														@if($mod == $modulo)
															@foreach($facturasPendientes as $mes => $clientesPendientes)
																@foreach($clientesPendientes as $id => $montoMensual)
																	@if($cliente_id == $id)
																		<td class="text-right total-{{ $mes }}" align="right" style="width: 80px">
																			{{ $traductor->format($montoMensual) }}
																		</td>
																	@endif
																@endforeach
															@endforeach
														@endif
													@endforeach
													@foreach($totalClientes as $m => $c)
														@if($m == $modulo)
															@foreach($c as $nombre => $monto)
																@if($nombre == $cliente_id)
																	<td  class="text-right {{ $m }}" align="right" style="width: 80px">
																		{{ $traductor->format($monto["total"]) }}
																	</td>
																@endif
															@endforeach
														@endif
													@endforeach
												</tr>
											@endforeach
										<tr class="bg-gray">
											<td>
												<strong>TOTAL</strong>
											</td>
											@foreach($ModTotales as $md=>$monto)
												@if($md == $modulo)
													<td class="text-right  totalModulos" align="right" colspan="13">
														<strong>{{ $traductor->format($monto) }}</strong>
													</td>
												@endif
											@endforeach
										</tr>
										@endif
									@endforeach
								</tbody>
								<tfoot class="bg-primary">
									<tr >
										<th  align="left" class="text-left">
											TOTALES
										</th>
											<td  class="text-right" id="total-1" align="right" style="width: 80px">
												<strong>{{ $traductor->format($monto) }}</strong>
											</td>
											<td  class="text-right" id="total-2" align="right" style="width: 80px">
												<strong>{{ $traductor->format($monto) }}</strong>
											</td>
											<td  class="text-right" id="total-3" align="right" style="width: 80px">
												<strong>{{ $traductor->format($monto) }}</strong>
											</td>
											<td  class="text-right" id="total-4" align="right" style="width: 80px">
												<strong>{{ $traductor->format($monto) }}</strong>
											</td>
											<td  class="text-right" id="total-5" align="right" style="width: 80px">
												<strong>{{ $traductor->format($monto) }}</strong>
											</td>
											<td  class="text-right" id="total-6" align="right" style="width: 80px">
												<strong>{{ $traductor->format($monto) }}</strong>
											</td>
											<td  class="text-right" id="total-7" align="right" style="width: 80px">
												<strong>{{ $traductor->format($monto) }}</strong>
											</td>
											<td  class="text-right" id="total-8" align="right" style="width: 80px">
												<strong>{{ $traductor->format($monto) }}</strong>
											</td>
											<td  class="text-right" id="total-9" align="right" style="width: 80px">
												<strong>{{ $traductor->format($monto) }}</strong>
											</td>
											<td  class="text-right" id="total-10" align="right" style="width: 80px">
												<strong>{{ $traductor->format($monto) }}</strong>
											</td>
											<td  class="text-right" id="total-11" align="right" style="width: 80px">
												<strong>{{ $traductor->format($monto) }}</strong>
											</td>
											<td  class="text-right" id="total-12" align="right" style="width: 80px">
												<strong>{{ $traductor->format($monto) }}</strong>
											</td>
										<th class="text-right totalTotal" align="right">
											0,00
										</th>
									</tr>
								</tfoot>
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

	$(document).ready(function(){
		$('.select-flt').chosen({width:'200px'});


		var totalTotal=0;
		$('.totalModulos').each(function(index,value){
			totalTotal+=commaToNum($(value).text().trim());
		});


		$('.totalTotal').text(numToComma(totalTotal));


		var total1=0;
		$('.total-1').each(function(index,value){
			total1+=commaToNum($(value).text().trim());
		});

		$('#total-1').text(numToComma(total1));

		var total2=0;
		$('.total-2').each(function(index,value){
			total2+=commaToNum($(value).text().trim());
		});

		$('#total-2').text(numToComma(total2));

		var total3=0;
		$('.total-3').each(function(index,value){
			total3+=commaToNum($(value).text().trim());
		});

		$('#total-3').text(numToComma(total3));


		var total4=0;
		$('.total-4').each(function(index,value){
			total4+=commaToNum($(value).text().trim());
		});

		$('#total-4').text(numToComma(total4));


		var total5=0;
		$('.total-5').each(function(index,value){
			total5+=commaToNum($(value).text().trim());
		});

		$('#total-5').text(numToComma(total5));

		var total6=0;
		$('.total-6').each(function(index,value){
			total6+=commaToNum($(value).text().trim());
		});

		$('#total-6').text(numToComma(total6));


		var total7=0;
		$('.total-7').each(function(index,value){
			total7+=commaToNum($(value).text().trim());
		});

		$('#total-7').text(numToComma(total7));

		var total8=0;
		$('.total-8').each(function(index,value){
			total8+=commaToNum($(value).text().trim());
		});

		$('#total-8').text(numToComma(total8));


		var total9=0;
		$('.total-9').each(function(index,value){
			total9+=commaToNum($(value).text().trim());
		});

		$('#total-9').text(numToComma(total9));


		var total10=0;
		$('.total-10').each(function(index,value){
			total10+=commaToNum($(value).text().trim());
		});

		$('#total-10').text(numToComma(total10));

		var total11=0;
		$('.total-11').each(function(index,value){
			total11+=commaToNum($(value).text().trim());
		});

		$('#total-11').text(numToComma(total11));


		var total12=0;
		$('.total-12').each(function(index,value){
			total12+=commaToNum($(value).text().trim());
		});

		$('#total-12').text(numToComma(total12));



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
										<th colspan="14" style="vertical-align: middle; margin-top:20px" align="center" class="text-center">REPORTE DE MOROSIDAD\
										</br>\
										AEROPUERTO: {{ $aeropuertoNombre }} \
										</br>\
										CLIENTE: {{ $nombreCliente }}\
										</br>\
										AÑO: {{ $anno }}\
									</th>\
								</tr>\
							</thead>')
			$(table).find('thead, th').css({'border-top':'1px solid black', 'font-weight': 'bold', 'text-align':"center", 'font-size': '12px'})
			$(table).find('th').css({'border-bottom':'1px solid black', 'font-weight': 'bold', 'text-align':"center", 'font-size': '12px'})
			$(table).find('td').css({'font-size': '10px'})
			$(table).find('#NombreModulo').css({'font-size': '80px'})
			$(table).find('tr:nth-child(even)').css({'border-bottom':'1px solid black'})

			$(table).find('tr:last td').css({'border-bottom':'1px solid black','border-top':'1px solid black', 'font-weight': 'bold'})
			var tableHtml= $(table)[0].outerHTML;
			$('[name=table]').val(tableHtml);
			$('#export-form').submit();
		})


	})


</script>


@endsection