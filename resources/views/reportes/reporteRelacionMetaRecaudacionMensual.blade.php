@extends('app')

@section('content')
<ol class="breadcrumb">
	<li><a href="{{url('principal')}}">Inicio</a></li>
	<li><a class="active">Relación de Meta y Recaudación Mensual</a></li>
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
				{!! Form::open(["url" => action('ReporteController@getReporteRelacionMetaRecaudacionMensual'), "method" => "GET", "class"=>"form-inline"]) !!}
				<div class="form-group">
					<label><strong>AÑO: </strong></label>
					{!! Form::select('anno', $annos, $anno, ["class"=> "form-control"]) !!}
				</div>
				<button type="submit" class="btn btn-primary">Buscar</button>
				<a class="btn btn-default" href="{{action('ReporteController@getReporteRelacionMetaRecaudacionMensual')}}">Reset</a>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="box box-primary">
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

										<th rowspan="2" style="vertical-align: middle; width: 120px; " class="text-center">
											Mes
										</th>
										<th colspan="3" style="vertical-align: middle; width: 360px " class="text-center">
											MANUEL CARLOS PIAR
										</th>
										<th colspan="3" style="vertical-align: middle; width: 360px " class="text-center">
											GRAL. TOMÁS DE HERES
										</th>
										<th colspan="3" style="vertical-align: middle; width: 360px " class="text-center">
											SANTA ELENA DE UAIRÉN
										</th>
										<th colspan="3" style="font-weight: bold; vertical-align: middle; width: 120px; " class="text-center">
											TOTAL
										</th>
									</tr>
									<tr>
										<th style="vertical-align: middle; width: 120px" class="text-center">
											Meta
										</th>
										<th style="vertical-align: middle; width: 120px" class="text-center">
											Recaudado
										</th>
										<th style="vertical-align: middle; width: 120px" class="text-center">
											Diferencia
										</th>
										<th style="vertical-align: middle; width: 120px" class="text-center">
											Meta
										</th>
										<th style="vertical-align: middle; width: 120px" class="text-center">
											Recaudado
										</th>
										<th style="vertical-align: middle; width: 120px" class="text-center">
											Diferencia
										</th>
										<th style="vertical-align: middle; width: 120px" class="text-center">
											Meta
										</th>
										<th style="vertical-align: middle; width: 120px" class="text-center">
											Recaudado
										</th>
										<th style="vertical-align: middle; width: 120px" class="text-center">
											Diferencia
										</th>
										<th style="vertical-align: middle; width: 120px" class="text-center">
											Meta
										</th>
										<th style="vertical-align: middle; width: 120px" class="text-center">
											Recaudado
										</th>
										<th style="vertical-align: middle; width: 120px" class="text-center">
											Diferencia
										</th>
									</tr>
								</thead>
								<tbody>
									@foreach($montosMeses as $mes => $montos)
										<tr>
											<td>{{$mes}}</td>
											<td class="text-right metaPZO" style="width: 120px" align="right">{{$traductor->format($montos["metaPZO"])}}</td>
											<td class="text-right recaudadoPZO" style="width: 120px" align="right">{{$traductor->format($montos["recaudadoPZO"])}}</td>
											<td class="text-right diferenciaPZO" style="width: 120px" align="right">{{$traductor->format($montos["diferenciaPZO"])}}</td>
											<td class="text-right metaCBL style="width: 120px"" align="right">{{$traductor->format($montos["metaCBL"])}}</td>
											<td class="text-right recaudadoCBL" style="width: 120px" align="right">{{$traductor->format($montos["recaudadoCBL"])}}</td>
											<td class="text-right diferenciaCBL" style="width: 120px" align="right">{{$traductor->format($montos["diferenciaCBL"])}}</td>
											<td class="text-right metaSNV" style="width: 120px" align="right">{{$traductor->format($montos["metaSNV"])}}</td>
											<td class="text-right recaudadoSNV" style="width: 120px" align="right">{{$traductor->format($montos["recaudadoSNV"])}}</td>
											<td class="text-right diferenciaSNV" style="width: 120px" align="right">{{$traductor->format($montos["diferenciaSNV"])}}</td>
											<td class="text-right metaTotal" style="font-weight: bold; width: 120px" align="right">{{$traductor->format($montos["metaTotal"])}}</td>
											<td class="text-right recaudadoTotal" style="font-weight: bold; width: 120px" align="right">{{$traductor->format($montos["recaudadoTotal"])}}</td>
											<td class="text-right diferenciaTotal" style="font-weight: bold; width: 120px" align="right">{{$traductor->format($montos["diferenciaTotal"])}}</td>
										</tr>
									@endforeach
										<tr class="bg-gray">
											<td style="font-weight: bold;">TOTALES</td>
											<td class="text-right" id="metaPZO" style="font-weight: bold; width: 120px" align="right">{{$traductor->format($metaSaarPZO)}}</td>
											<td class="text-right" id="recaudadoPZO" style="font-weight: bold; width: 120px" align="right">0</td>
											<td class="text-right" id="diferenciaPZO" style="font-weight: bold; width: 120px" align="right">0</td>
											<td class="text-right" id="metaCBL" style="font-weight: bold; width: 120px" align="right">{{$traductor->format($metaSaarCBL)}}</td>
											<td class="text-right" id="recaudadoCBL" style="font-weight: bold; width: 120px" align="right">0</td>
											<td class="text-right" id="diferenciaCBL" style="font-weight: bold; width: 120px" align="right">0</td>
											<td class="text-right" id="metaSNV" style="font-weight: bold; width: 120px" align="right">{{$traductor->format($metaSaarSNV)}}</td>
											<td class="text-right" id="recaudadoSNV" style="font-weight: bold; width: 120px" align="right">0</td>
											<td class="text-right" id="diferenciaSNV" style="font-weight: bold; width: 120px" align="right">0</td>
											<td class="text-right" id="metaTotal" style="font-weight: bold; width: 120px" align="right">0</td>
											<td class="text-right" id="recaudadoTotal" style="font-weight: bold; width: 120px" align="right">0</td>
											<td class="text-right" id="diferenciaTotal" style="font-weight: bold; width: 120px" align="right">0</td>
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

		var metaTotalTotal=0;
		$('.metaTotal').each(function(index,value){
			metaTotalTotal+=commaToNum($(value).text().trim());
		});

		var recaudadoTotalTotal=0;
		$('.recaudadoTotal').each(function(index,value){
			recaudadoTotalTotal+=commaToNum($(value).text().trim());
		});

		var diferenciaTotalTotal=0;
		$('.diferenciaTotal').each(function(index,value){
			diferenciaTotalTotal+=commaToNum($(value).text().trim());
		});

		var recaudadoTotalPZO=0;
		$('.recaudadoPZO').each(function(index,value){
			recaudadoTotalPZO+=commaToNum($(value).text().trim());
		});

		var recaudadoTotalCBL=0;
		$('.recaudadoCBL').each(function(index,value){
			recaudadoTotalCBL+=commaToNum($(value).text().trim());
		});

		var recaudadoTotalSNV=0;
		$('.recaudadoSNV').each(function(index,value){
			recaudadoTotalSNV+=commaToNum($(value).text().trim());
		});


		var diferenciaTotalPZO=0;
		$('.diferenciaPZO').each(function(index,value){
			diferenciaTotalPZO+=commaToNum($(value).text().trim());
		});

		var diferenciaTotalCBL=0;
		$('.diferenciaCBL').each(function(index,value){
			diferenciaTotalCBL+=commaToNum($(value).text().trim());
		});

		var diferenciaTotalSNV=0;
		$('.diferenciaSNV').each(function(index,value){
			diferenciaTotalSNV+=commaToNum($(value).text().trim());
		});


		var diferenciaTotalTotal=0;
		$('.diferenciaTotal').each(function(index,value){
			diferenciaTotalTotal+=commaToNum($(value).text().trim());
		});

		var metaTotalTotal=0;
		$('.metaTotal').each(function(index,value){
			metaTotalTotal+=commaToNum($(value).text().trim());
		});

		var recaudadoTotalTotal=0;
		$('.recaudadoTotal').each(function(index,value){
			recaudadoTotalTotal+=commaToNum($(value).text().trim());
		});

		$('#recaudadoPZO').text(numToComma(recaudadoTotalPZO));
		$('#diferenciaPZO').text(numToComma(diferenciaTotalPZO));
		$('#recaudadoCBL').text(numToComma(recaudadoTotalCBL));
		$('#diferenciaCBL').text(numToComma(diferenciaTotalCBL));
		$('#recaudadoSNV').text(numToComma(recaudadoTotalSNV));
		$('#diferenciaSNV').text(numToComma(diferenciaTotalSNV));
		$('#metaTotal').text(numToComma(metaTotalTotal));
		$('#recaudadoTotal').text(numToComma(recaudadoTotalTotal));
		$('#diferenciaTotal').text(numToComma(diferenciaTotalTotal));

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
		                    <th colspan="13" style="vertical-align: middle; margin-top:20px" align="center" class="text-center">RELACIÓN DE META Y RECAUDACIÓN MENSUAL\
		                    </br>\
		                    AÑO: {{$anno}}\
		                  </th>\
		                </tr>\
		              </thead>')
		        $(table).find('thead, th').css({'border-top':'1px solid black', 'font-weight': 'bold', 'text-align':"center", 'font-size': '15px'})
		        $(table).find('th').css({'border-bottom':'1px solid black', 'font-weight': 'bold', 'text-align':"center", 'font-size': '15px'})
		        $(table).find('td').css({'font-size': '13px'})
				$(table).find('tr:nth-child(even)').css({'border-bottom':'1px solid black'})
		        $(table).find('tr:last td').css({'border-bottom':'1px solid black','border-top':'1px solid black', 'font-weight': 'bold'})
		        $(table).append('<tr>\
          						<td colspan="13"><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></td>\
               			  </tr><tr>\
          						<td colspan="7" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px">REVISADO</td>\
          						<td colspan="6" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">CONFORMADO</td>\
               			  </tr><tr>\
          						<td colspan="2" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black;"><br><br><br><br><br> </td>\
          						<td colspan="2" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black;"> </td>\
          						<td colspan="3" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black;"> </td>\
          						<td colspan="3" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black;"> </td>\
          						<td colspan="3" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black;"> </td>\
               			  </tr><tr>\
          						<td colspan="2" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px">JEFE DEPARTAMENTO RECAUDACIÓN</td>\
          						<td colspan="2" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px">CONTADOR</td>\
          						<td colspan="3" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px">GERENTE ADMINISTRACIÓN</td>\
          						<td colspan="3" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px">SUB-DIRECTOR</td>\
          						<td colspan="3" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px">DIRECTOR</td>\
               			  </tr>')
		        var tableHtml= $(table)[0].outerHTML;
		        $('[name=table]').val(tableHtml);
		        $('#export-form').submit();

		
		})
	})
</script>


@endsection