@extends('app')

@section('content')
<ol class="breadcrumb">
	<li><a href="{{url('principal')}}">Inicio</a></li>
	<li><a class="active">Relación de Estacionamiento Diario</a></li>
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
				{!! Form::open(["url" => action('ReporteController@getReporteRelacionEstacionamientoDiario'), "method" => "GET", "class"=>"form-inline"]) !!}
				<div class="form-group" style="margin-left: 20px">
					<label><strong>MES: </strong></label>
					{!! Form::select('mes', $meses, $mes, ["class"=> "form-control"]) !!}
				</div>
				<div class="form-group" style="margin-left: 20px">
					<label><strong>AÑO:</strong></label>
					{!! Form::select('anno', $annos, $anno, ["class"=> "form-control"]) !!}
				</div>
				<div class="form-group">
					<label style="width:80px; margin-left: 20px"><strong>AEROPUERTO:</strong></label>
					{!! Form::select('aeropuerto', $aeropuertos, $aeropuerto, ["class"=> "form-control"]) !!}
				</div>
				<button type="submit" class="btn btn-primary pull-right">Buscar</button>
				<a class="btn btn-default  pull-right" href="{{action('ReporteController@getReporteRelacionEstacionamientoDiario')}}">Reset</a>
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
				<h3 class="box-title">Reporte</h3>
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
							<table class="table table-hover table-condensed">
								<thead  class="bg-primary">
									<tr>
										<th style="vertical-align: middle" class="text-center" colspan="1"></th>
										<th style="vertical-align: middle" class="text-center" colspan="4">TICKETS DE ESTACIONAMIENTO</th>
										<th style="vertical-align: middle" class="text-center" colspan="4">TICKETS DE PERNOCTA</th>
										<th style="vertical-align: middle" class="text-center" colspan="4">TICKETS EXTRAVIADOS</th>
										<th style="vertical-align: middle" class="text-center" colspan="3">TARJETAS ELECTRÓNICAS</th>
										<th style="vertical-align: middle" class="text-center" colspan="3">RECAUDADO</th>
										<th style="vertical-align: middle" class="text-center">DEP.</th>
									</tr>
									<tr>
										<th   style="vertical-align: middle" class="text-center" align="center">
											Fecha
										</th>
										<th   style="vertical-align: middle" class="text-center" align="center">
											Cant
										</th>
										<th   style="vertical-align: middle; width: 60px; " class="text-center" align="center">
											Base
										</th>
										<th   style="vertical-align: middle; width: 60px; " class="text-center" align="center">
											IVA
										</th>
										<th   style="vertical-align: middle; width: 60px; " class="text-center" align="center">
											Total
										</th>
										<th   style="vertical-align: middle" class="text-center" align="center">
											Cant
										</th>
										<th   style="vertical-align: middle; width: 60px; " class="text-center" align="center">
											Base
										</th>
										<th   style="vertical-align: middle; width: 60px; " class="text-center" align="center">
											IVA
										</th>
										<th   style="vertical-align: middle; width: 60px; " class="text-center" align="center">
											Total
										</th>
										<th   style="vertical-align: middle" class="text-center" align="center">
											Cant
										</th>
										<th   style="vertical-align: middle; width: 60px; " class="text-center" align="center">
											Base
										</th>
										<th   style="vertical-align: middle; width: 60px;" class="text-center" align="center">
											IVA
										</th>
										<th   style="vertical-align: middle; width: 60px; " class="text-center" align="center">
											Total
										</th>
										<th   style="vertical-align: middle; width: 60px; " class="text-center" align="center">
											Base
										</th>
										<th   style="vertical-align: middle; width: 60px; " class="text-center" align="center">
											IVA
										</th>
										<th   style="vertical-align: middle; width: 60px; " class="text-center" align="center">
											Total
										</th>
										<th   style="vertical-align: middle; width: 60px; " class="text-center" align="center">
											Base
										</th>
										<th   style="vertical-align: middle; width: 60px; " class="text-center" align="center">
											IVA
										</th>
										<th   style="vertical-align: middle; width: 60px; " class="text-center" align="center">
											Total
										</th>
										<th   style="vertical-align: middle; width: 60px; " class="text-center" align="center" align="center">
											Ref
										</th>
									</tr>
								</thead>
								<tbody>
								@foreach($estacionamientoDiario as $dia => $estacionamiento)
									<tr>
										<td class="text-center dia" align="center">{{$dia}}</td>
										<td class="text-center ticketEstacionamiento" align="center">{{$estacionamiento["ticketEstacionamiento"]}}</td>
										<td class="text-right baseTicketEstacionamiento" align="right" style="width: 60px; ">{{$traductor->format($estacionamiento["baseTicketEstacionamiento"])}}</td>
										<td class="text-right ivaTicketEstacionamiento" align="right" style="width: 60px; ">{{$traductor->format($estacionamiento["ivaTicketEstacionamiento"])}}</td>
										<td class="text-right totalTicketEstacionamiento" align="right" style="width: 60px; ">{{$traductor->format($estacionamiento["totalTicketEstacionamiento"])}}</td>
										<td class="text-center ticketPernocta" align="center">{{$estacionamiento["ticketPernocta"]}}</td>
										<td class="text-right baseTicketPernocta" align="right" style="width: 60px; ">{{$traductor->format($estacionamiento["baseTicketPernocta"])}}</td>
										<td class="text-right ivaTicketPernocta" align="right" style="width: 60px; ">{{$traductor->format($estacionamiento["ivaTicketPernocta"])}}</td>
										<td class="text-right totalTicketPernocta" align="right" style="width: 60px; ">{{$traductor->format($estacionamiento["totalTicketPernocta"])}}</td>
										<td class="text-center ticketExtraviado"  align="center">{{$estacionamiento["ticketExtraviado"]}}</td>
										<td class="text-right baseTicketExtraviado" align="right" style="width: 60px; ">{{$traductor->format($estacionamiento["baseTicketExtraviado"])}}</td>
										<td class="text-right ivaTicketExtraviado" align="right" style="width: 60px; ">{{$traductor->format($estacionamiento["ivaTicketExtraviado"])}}</td>
										<td class="text-right totalTicketExtraviado" align="right" style="width: 60px; ">{{$traductor->format($estacionamiento["totalTicketExtraviado"])}}</td>
										<td class="text-right baseTarjetas" align="right" style="width: 60px; ">{{$traductor->format($estacionamiento["baseTarjetas"])}}</td>
										<td class="text-right ivaTarjetas" align="right" style="width: 60px; ">{{$traductor->format($estacionamiento["ivaTarjetas"])}}</td>
										<td class="text-right totalTarjetas" align="right" style="width: 60px; ">{{$traductor->format($estacionamiento["totalTarjetas"])}}</td>
										<td class="text-right baseTotal" align="right" style="width: 60px; ">{{$traductor->format($estacionamiento["baseTotal"])}}</td>
										<td class="text-right ivaTotal" align="right" style="width: 60px; ">{{$traductor->format($estacionamiento["ivaTotal"])}}</td>
										<td class="text-right montoTotal" align="right" style="width: 60px; ">{{$traductor->format($estacionamiento["montoTotal"])}}</td>
										<td class="text-center deposito" align="center" style="width: 60px; ">{{$estacionamiento["deposito"]}}</td>
									</tr>
									@endforeach
									<tr>
										<td style="font-weight: bold">TOTALES</td>
										<td class="text-right" style="font-weight: bold" align="center" id="ticketEstacionamiento">0</td>
										<td class="text-right" style="font-weight: bold; width: 60px; " align="right" id="baseTicketEstacionamiento">0</td>
										<td class="text-right" style="font-weight: bold; width: 60px; " align="right" id="ivaTicketEstacionamiento">0</td>
										<td class="text-right" style="font-weight: bold; width: 60px; " align="right" id="totalTicketEstacionamiento">0</td>
										<td class="text-right" style="font-weight: bold" align="center" id="ticketPernocta">0</td>
										<td class="text-right" style="font-weight: bold; width: 60px; " align="right" id="baseTicketPernocta">0</td>
										<td class="text-right" style="font-weight: bold; width: 60px; " align="right" id="ivaTicketPernocta">0</td>
										<td class="text-right" style="font-weight: bold; width: 60px; " align="right" id="totalTicketPernocta">0</td>
										<td class="text-right" style="font-weight: bold;" align="center" id="ticketExtraviado">0</td>
										<td class="text-right" style="font-weight: bold; width: 60px; " align="right" id="baseTicketExtraviado">0</td>
										<td class="text-right" style="font-weight: bold; width: 60px; " align="right" id="ivaTicketExtraviado">0</td>
										<td class="text-right" style="font-weight: bold; width: 60px; " align="right" id="totalTicketExtraviado">0</td>
										<td class="text-right" style="font-weight: bold; width: 60px; " align="right" id="baseTarjetas">0</td>
										<td class="text-right" style="font-weight: bold; width: 60px; " align="right" id="ivaTarjetas">0</td>
										<td class="text-right" style="font-weight: bold; width: 60px; " align="right" id="totalTarjetas">0</td>
										<td class="text-right" style="font-weight: bold; width: 60px; " align="right" id="baseTotal">0</td>
										<td class="text-right" style="font-weight: bold; width: 60px; " align="right" id="ivaTotal">0</td>
										<td class="text-right" style="font-weight: bold; width: 60px; " align="right" id="montoTotal">0</td>
										<td class="text-right" style="font-weight: bold; width: 60px; " align="center" id="deposito"></td>
									</tr>
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

		var ticketEstacionamiento=0;
		$('.ticketEstacionamiento').each(function(index,value){
			ticketEstacionamiento+=commaToNum($(value).text().trim());
		});

		var baseTicketEstacionamiento=0;
		$('.baseTicketEstacionamiento').each(function(index,value){
			baseTicketEstacionamiento+=commaToNum($(value).text().trim());
		});

		var ivaTicketEstacionamiento=0;
		$('.ivaTicketEstacionamiento').each(function(index,value){
			ivaTicketEstacionamiento+=commaToNum($(value).text().trim());
		});

		var totalTicketEstacionamiento=0;
		$('.totalTicketEstacionamiento').each(function(index,value){
			totalTicketEstacionamiento+=commaToNum($(value).text().trim());
		});

		var ticketPernocta=0;
		$('.ticketPernocta').each(function(index,value){
			ticketPernocta+=commaToNum($(value).text().trim());
		});

		var baseTicketPernocta=0;
		$('.baseTicketPernocta').each(function(index,value){
			baseTicketPernocta+=commaToNum($(value).text().trim());
		});

		var ivaTicketPernocta=0;
		$('.ivaTicketPernocta').each(function(index,value){
			ivaTicketPernocta+=commaToNum($(value).text().trim());
		});

		var totalTicketPernocta=0;
		$('.totalTicketPernocta').each(function(index,value){
			totalTicketPernocta+=commaToNum($(value).text().trim());
		});

		var ticketExtraviado=0;
		$('.ticketExtraviado').each(function(index,value){
			ticketExtraviado+=commaToNum($(value).text().trim());
		});

		var baseTicketExtraviado=0;
		$('.baseTicketExtraviado').each(function(index,value){
			baseTicketExtraviado+=commaToNum($(value).text().trim());
		});

		var ivaTicketExtraviado=0;
		$('.ivaTicketExtraviado').each(function(index,value){
			ivaTicketExtraviado+=commaToNum($(value).text().trim());
		});

		var totalTicketExtraviado=0;
		$('.totalTicketExtraviado').each(function(index,value){
			totalTicketExtraviado+=commaToNum($(value).text().trim());
		});

		var baseTarjetas=0;
		$('.baseTarjetas').each(function(index,value){
			baseTarjetas+=commaToNum($(value).text().trim());
		});

		var ivaTarjetas=0;
		$('.ivaTarjetas').each(function(index,value){
			ivaTarjetas+=commaToNum($(value).text().trim());
		});

		var totalTarjetas=0;
		$('.totalTarjetas').each(function(index,value){
			totalTarjetas+=commaToNum($(value).text().trim());
		});

		var baseTotal=0;
		$('.baseTotal').each(function(index,value){
			baseTotal+=commaToNum($(value).text().trim());
		});

		var ivaTotal=0;
		$('.ivaTotal').each(function(index,value){
			ivaTotal+=commaToNum($(value).text().trim());
		});

		var montoTotal=0;
		$('.montoTotal').each(function(index,value){
			montoTotal+=commaToNum($(value).text().trim());
		});

		$('#ticketEstacionamiento').text(ticketEstacionamiento);
		$('#baseTicketEstacionamiento').text(numToComma(baseTicketEstacionamiento));
		$('#ivaTicketEstacionamiento').text(numToComma(ivaTicketEstacionamiento));
		$('#totalTicketEstacionamiento').text(numToComma(totalTicketEstacionamiento));
		$('#ticketPernocta').text(ticketPernocta);
		$('#baseTicketPernocta').text(numToComma(baseTicketPernocta));
		$('#ivaTicketPernocta').text(numToComma(ivaTicketPernocta));
		$('#totalTicketPernocta').text(numToComma(totalTicketPernocta));
		$('#ticketExtraviado').text(ticketExtraviado);
		$('#baseTicketExtraviado').text(numToComma(baseTicketExtraviado));
		$('#ivaTicketExtraviado').text(numToComma(ivaTicketExtraviado));
		$('#totalTicketExtraviado').text(numToComma(totalTicketExtraviado));
		$('#baseTarjetas').text(numToComma(baseTarjetas));
		$('#ivaTarjetas').text(numToComma(ivaTarjetas));
		$('#totalTarjetas').text(numToComma(totalTarjetas));
		$('#baseTotal').text(numToComma(baseTotal));
		$('#ivaTotal').text(numToComma(ivaTotal));
		$('#montoTotal').text(numToComma(montoTotal));



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
									<th colspan="20" style="vertical-align: middle; margin-top:20px" align="center" class="text-center">RELACIÓN DE ESTACIONAMIENTO DIARIO\
										</br>\
										MES:  {{ mesEnLetras($mes) }} AÑO: {{$anno}}\
										</br>\
										AEROPUERTO: {{$aeropuertoNombre}}\
									</th>\
								</tr>\
							</thead>')
			$(table).find('thead, th').css({'border-top':'1px solid black', 'font-weight': 'bold', 'text-align':"center", 'font-size': '12px'})
			$(table).find('th').css({'border-bottom':'1px solid black', 'font-weight': 'bold', 'text-align':"center", 'font-size': '12px'})
			$(table).find('td').css({'font-size': '11px'})
			$(table).find('tr:nth-child(even)').css({'border-bottom':'1px solid black'})
			$(table).find('tr:last td').css({'border-bottom':'1px solid black','border-top':'1px solid black', 'font-weight': 'bold'})
			var tableHtml= $(table)[0].outerHTML;
			$('[name=table]').val(tableHtml);
			$('#export-form').submit();
		})

});
</script>


@endsection

