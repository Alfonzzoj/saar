@extends('app')

@section('content')
<ol class="breadcrumb">
	<li><a href="{{url('principal')}}">Inicio</a></li>
	<li><a class="active">Relación Mensual de Saldo Facturado, Cobrado y Por Cobrar</a></li>
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
				{!! Form::open(["url" => action('ReporteController@getReporteRelacionMensualDeFacturacionCobradosYPorCobrar'), "method" => "GET", "class"=>"form-inline"]) !!}
				<div class="form-group">
					<label><strong>AEROPUERTO:</strong></label>
					{!! Form::select('aeropuerto', $aeropuertos, $aeropuerto, ["class"=> "form-control"]) !!}
				</div>
				<div class="form-group">
					<label><strong>AÑO: </strong></label>
					{!! Form::select('anno', $annos, $anno, ["class"=> "form-control"]) !!}
				</div>
				<button type="submit" class="btn btn-primary">Buscar</button>
				<a class="btn btn-default" href="{{action('ReporteController@getReporteRelacionMensualDeFacturacionCobradosYPorCobrar')}}">Reset</a>
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

						<div class="table-responsive">
							<table class="table table-hover table-condensed">
								<thead  class="bg-primary">
									<tr>
										<th rowspan="2" style="vertical-align: middle; width: 200px; " class="text-center">
											MES
										</th>
										<th  colspan="4" style="vertical-align: middle; width: 800px; " class="text-center">
											AL MES ACTUAL
										</th>
										<th rowspan="2" style="vertical-align: middle; width: 200px; " class="text-center">
											TOTAL COBRADO
										</th>
									</tr>
									<tr>
										<th style="vertical-align: middle; width: 200px " class="text-center">
											FACTURADO
										</th>
										<th style="vertical-align: middle; width: 200px " class="text-center">
											COBRADO
										</th>
										<th style="vertical-align: middle; width: 200px " class="text-center">
											POR COBRAR
										</th>
										<th style="vertical-align: middle; width: 200px " class="text-center">
											COBRO DE MESES ANTERIORES
										</th>
									</tr>
								</thead>
								<tbody>
									@foreach($montosMeses as $mes => $montos)
									<tr>
										<td>{{$mes}}</td>
										<td class="text-right facturado" style="width: 200px" align="right">{{$traductor->format($montos["facturado"])}}</td>
										<td class="text-right cobrado" style="width: 200px"  align="right">{{$traductor->format($montos["cobrado"])}}</td>
										<td class="text-right porCobrar" style="width: 200px"   align="right">{{$traductor->format($montos["porCobrar"])}}</td>
										<td class="text-right cobroAnterior" style="width: 200px"  align="right">{{$traductor->format($montos["cobroAnterior"])}}</td>
										<td class="text-right totalCobradoMes" style="width: 200px"  align="right">{{$traductor->format($montos["totalCobradoMes"])}}</td>
									</tr>
									@endforeach
									<tr class="bg-gray">
										<td  style="font-weight: bold; width: 200px; " >TOTALES</td>
										<td  align="right" class="text-right" style="font-weight: bold; width: 200px; " id="facturadoTotal">0</td>
										<td  align="right" class="text-right" style="font-weight: bold; width: 200px; " id="cobradoTotal">0</td>
										<td  align="right" class="text-right" style="font-weight: bold; width: 200px; " id="porCobrarTotal">0</td>
										<td  align="right" class="text-right" style="font-weight: bold; width: 200px; " id="cobroAnteriorTotal">0</td>
										<td  align="right" class="text-right" style="font-weight: bold; width: 200px; " id="totalRecaudado">0</td>
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

		var facturadoTotal=0;
		$('.facturado').each(function(index,value){
			facturadoTotal+=commaToNum($(value).text().trim());
		});

		var cobradoTotal=0;
		$('.cobrado').each(function(index,value){
			cobradoTotal+=commaToNum($(value).text().trim());
		});

		var porCobrarTotal=0;
		$('.porCobrar').each(function(index,value){
			porCobrarTotal+=commaToNum($(value).text().trim());
		});

		var cobroAnteriorTotal=0;
		$('.cobroAnterior').each(function(index,value){
			cobroAnteriorTotal+=commaToNum($(value).text().trim());
		});

		var totalCobradoMesTotal=0;
		$('.totalCobradoMes').each(function(index,value){
			totalCobradoMesTotal+=commaToNum($(value).text().trim());
		});

		$('#facturadoTotal').text(numToComma(facturadoTotal));
		$('#cobradoTotal').text(numToComma(cobradoTotal));
		$('#porCobrarTotal').text(numToComma(porCobrarTotal));
		$('#cobroAnteriorTotal').text(numToComma(cobroAnteriorTotal));
		$('#totalRecaudado').text(numToComma(totalCobradoMesTotal));


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
					<th colspan="6" style="vertical-align: middle; margin-top:20px" align="center" class="text-center">RELACIÓN MENSUAL DE SALDO FACTURADO, COBRADO Y POR COBRAR\
					</br>\
					AÑO: {{$anno}} | AEROPUERTO: {{$aeropuertoNombre}}\
				</th>\
			</tr>\
		</thead>')
			$(table).find('thead, th').css({'border-top':'1px solid black', 'font-weight': 'bold', 'text-align':"center", 'font-size': '12px'})
			$(table).find('th').css({'border-bottom':'1px solid black', 'font-weight': 'bold', 'text-align':"center", 'font-size': '12px'})
			$(table).find('td').css({'font-size': '	11px'})
			$(table).find('tr:nth-child(even)').css({'border-bottom':'1px solid black'})
			$(table).find('tr:last td').css({'border-bottom':'1px solid black','border-top':'1px solid black', 'font-weight': 'bold'})
			$(table).append('<tr>\
					<td colspan="6"><br><br><br><br><br><br><br><br><br><br></td>\
					</tr><tr>\
					<td colspan="3" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black;; font-size:12px">REVISADO</td>\
					<td colspan="3" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black;; font-size:12px">CONFORMADO</td>\
					</tr><tr>\
					<td style="border-right: 1px solid black;border-left: 1px solid black;"><br><br><br><br><br></td>\
					<td style="border-right: 1px solid black;border-left: 1px solid black;"></td>\
					<td style="border-right: 1px solid black;border-left: 1px solid black;"></td>\
					<td style="border-right: 1px solid black;border-left: 1px solid black;"></td>\
					<td style="border-right: 1px solid black;border-left: 1px solid black;"></td>\
					<td style="border-right: 1px solid black;border-left: 1px solid black;"></td>\
					</tr><tr>\
					<td align="center" style="border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size:11px">FIRMA</td>\
					<td align="center" style="border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size:11px">FIRMA</td>\
					<td align="center" style="border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size:11px">FIRMA</td>\
					<td align="center" style="border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size:11px">FIRMA</td>\
					<td align="center" style="border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size:11px">FIRMA</td>\
					<td align="center" style="border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black font-size:11px;">FIRMA</td>\
					</tr><tr>\
					<td align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size:11px">JEFE DEPARTAMENTO RECAUDACIÓN</td>\
					<td align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size:11px">CONTADOR</td>\
					<td align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size:11px">GERENTE ADMINISTRACIÓN</td>\
					<td align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size:11px">SUB-DIRECTOR</td>\
					<td align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size:11px">DIRECTOR</td>\
					<td align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size:11px">DIRECTOR</td>\
					</tr>')
			var tableHtml= $(table)[0].outerHTML;
			$('[name=table]').val(tableHtml);
			$('#export-form').submit();
		})
	})
</script>


@endsection