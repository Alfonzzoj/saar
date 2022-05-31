@extends('app')

@section('content')
<ol class="breadcrumb">
	<li><a href="{{url('principal')}}">Inicio</a></li>
	<li><a class="active">Relación Mensual de Ingresos Y Recaudación Pendiente</a></li>
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
				{!! Form::open(["url" => action('ReporteController@getReporteRelacionMensualDeIngresosRecaudacionPendiente'), "method" => "GET", "class"=>"form-inline"]) !!}
				<div class="form-group">
					<label><strong>AÑO: </strong></label>
					{!! Form::select('anno', $annos, $anno, ["class"=> "form-control"]) !!}
				</div>
				<button type="submit" class="btn btn-primary">BUSCAR</button>
				<a class="btn btn-default" href="{{action('ReporteController@getReporteRelacionMensualDeIngresosRecaudacionPendiente')}}">RESET</a>
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

										<th rowspan="2" style="vertical-align: middle; width:200px; " class="text-center">
											Mes
										</th>
										<th colspan="2" style="vertical-align: middle; width: 400px; " class="text-center">
											MANUEL CARLOS PIAR
										</th>
										<th colspan="2" style="vertical-align: middle; width: 400px; " class="text-center">
											GRAL. TOMÁS DE HERES
										</th>
										<th colspan="2" style="vertical-align: middle; width: 400px; " class="text-center">
											SANTA ELENA DE UAIRÉN
										</th>
										<th colspan="2" style="font-weight: bold; vertical-align: middle; width:400px; " class="text-center">
											TOTAL
										</th>
									</tr>
									<tr>
										<th style="vertical-align: middle; width: 200px; " class="text-center">
											Recaudado
										</th>
										<th style="vertical-align: middle; width: 200px; " class="text-center">
											Por Recaudar
										</th>
										<th style="vertical-align: middle; width: 200px; " class="text-center">
											Recaudado
										</th>
										<th style="vertical-align: middle; width: 200px; " class="text-center">
											Por Recaudar
										</th>
										<th style="vertical-align: middle; width: 200px; " class="text-center">
											Recaudado
										</th>
										<th style="vertical-align: middle; width: 200px; " class="text-center">
											Por Recaudar
										</th>
										<th style="font-weight: bold; vertical-align: middle; width: 200px; " class="text-center">
											Recaudado
										</th>
										<th style="font-weight: bold; vertical-align: middle; width: 200px; " class="text-center">
											Por Recaudar
										</th>
									</tr>
								</thead>
								<tbody>
									@foreach($montosMeses as $mes => $montos)
										<tr>
											<td class="text-left" style="width: 200px" align="left">{{$mes}}</td>
											<td class="text-right cobradoPZO" style="width: 200px" align="right">{{$traductor->format($montos["cobradoPZO"])}}</td>
											<td class="text-right porCobrarPZO" style="width: 200px" align="right">{{$traductor->format($montos["porCobrarPZO"])}}</td>
											<td class="text-right cobradoCBL" style="width: 200px" align="right">{{$traductor->format($montos["cobradoCBL"])}}</td>
											<td class="text-right porCobrarCBL" style="width: 200px" align="right">{{$traductor->format($montos["porCobrarCBL"])}}</td>
											<td class="text-right cobradoSNV" style="width: 200px" align="right">{{$traductor->format($montos["cobradoSNV"])}}</td>
											<td class="text-right porCobrarSNV" style="width: 200px" align="right">{{$traductor->format($montos["porCobrarSNV"])}}</td>
											<td class="text-right cobradoTotal" style="font-weight: bold; width: 200px" align="right">{{$traductor->format($montos["cobradoTotal"])}}</td>
											<td class="text-right porCobrarTotal"  style="font-weight: bold; width: 200px" align="right">{{$traductor->format($montos["porCobrarTotal"])}}</td>
										</tr>
									@endforeach
										<tr class="bg-gray">
											<td class="text-right" align="center" style="font-weight: bold; width: 200px">TOTALES</td>
											<td class="text-right" id="cobradoTotalPZO" style="font-weight: bold; width: 200px" align="right">0</td>
											<td class="text-right" id="porCobrarTotalPZO" style="font-weight: bold; width: 200px" align="right">0</td>
											<td class="text-right" id="cobradoTotalCBL" style="font-weight: bold; width: 200px" align="right">0</td>
											<td class="text-right" id="porCobrarTotalCBL" style="font-weight: bold; width: 200px" align="right">0</td>
											<td class="text-right" id="cobradoTotalSNV" style="font-weight: bold; width: 200px" align="right">0</td>
											<td class="text-right" id="porCobrarTotalSNV" style="font-weight: bold; width: 200px" align="right">0</td>
											<td class="text-right" id="cobradoTotalTotal" style="font-weight: bold; width: 200px" align="right">0</td>
											<td class="text-right" id="porCobrarTotalTotal" style="font-weight: bold; width: 200px" align="right">0</td>
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

		//Por Aeropuerto
		var cobradoTotalPZO=0;
		$('.cobradoPZO').each(function(index,value){
			cobradoTotalPZO+=commaToNum($(value).text().trim());
		});

		var porCobrarTotalPZO=0;
		$('.porCobrarPZO').each(function(index,value){
			porCobrarTotalPZO+=commaToNum($(value).text().trim());
		});

		var cobradoTotalCBL=0;
		$('.cobradoCBL').each(function(index,value){
			cobradoTotalCBL+=commaToNum($(value).text().trim());
		});

		var porCobrarTotalCBL=0;
		$('.porCobrarCBL').each(function(index,value){
			porCobrarTotalCBL+=commaToNum($(value).text().trim());
		});

		var cobradoTotalSNV=0;
		$('.cobradoSNV').each(function(index,value){
			cobradoTotalSNV+=commaToNum($(value).text().trim());
		});

		var porCobrarTotalSNV=0;
		$('.porCobrarSNV').each(function(index,value){
			porCobrarTotalSNV+=commaToNum($(value).text().trim());
		});


		var cobradoTotalTotal=0;
		$('.cobradoTotal').each(function(index,value){
			cobradoTotalTotal+=commaToNum($(value).text().trim());
		});

		var porCobrarTotalTotal=0;
		$('.porCobrarTotal').each(function(index,value){
			porCobrarTotalTotal+=commaToNum($(value).text().trim());
		});



		$('#cobradoTotalPZO').text(numToComma(cobradoTotalPZO));
		$('#porCobrarTotalPZO').text(numToComma(porCobrarTotalPZO));
		$('#cobradoTotalCBL').text(numToComma(cobradoTotalCBL));
		$('#porCobrarTotalCBL').text(numToComma(porCobrarTotalCBL));
		$('#cobradoTotalSNV').text(numToComma(cobradoTotalSNV));
		$('#porCobrarTotalSNV').text(numToComma(porCobrarTotalSNV));
		$('#cobradoTotalTotal').text(numToComma(cobradoTotalTotal));
		$('#porCobrarTotalTotal').text(numToComma(porCobrarTotalTotal));


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
		                    <th colspan="9" style="vertical-align: middle; margin-top:20px" align="center" class="text-center">RELACIÓN MENSUAL DE INGRESOS Y RECAUDACIÓN PENDIENTE\
		                    </br>\
		                    AÑO: {{$anno}}\
		                  </th>\
		                </tr>\
		              </thead>')
		        $(table).find('thead, th').css({'border-top':'1px solid black', 'font-weight': 'bold', 'text-align':"center", 'font-size': '17px'})
		        $(table).find('th').css({'border-bottom':'1px solid black', 'font-weight': 'bold', 'text-align':"center", 'font-size': '17px'})
		        $(table).find('td').css({'font-size': '15px'})
				$(table).find('tr:nth-child(even)').css({'border-bottom':'1px solid black'})
		        $(table).find('tr:last td').css({'border-bottom':'1px solid black','border-top':'1px solid black', 'font-weight': 'bold'})
		        $(table).append('<tr>\
          						<td colspan="8"><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></td>\
               			  </tr><tr>\
          						<td colspan="5" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black;">REVISADO</td>\
          						<td colspan="4" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black;">CONFORMADO</td>\
               			  </tr><tr>\
          						<td colspan="2" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black;"><br><br><br><br><br><br> </td>\
          						<td colspan="1" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black;"> </td>\
          						<td colspan="2" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black;"> </td>\
          						<td colspan="2" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black;"> </td>\
          						<td colspan="2" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black;"> </td>\
               			  </tr><tr>\
          						<td colspan="2" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black;">JEFE DEPARTAMENTO RECAUDACIÓN</td>\
          						<td colspan="1" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black;">CONTADOR</td>\
          						<td colspan="2" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black;">GERENTE ADMINISTRACIÓN</td>\
          						<td colspan="2" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black;">SUB-DIRECTOR</td>\
          						<td colspan="2" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black;">DIRECTOR</td>\
               			  </tr>')
		        var tableHtml= $(table)[0].outerHTML;
		        $('[name=table]').val(tableHtml);
		        $('#export-form').submit();

		
		})
	})
</script>


@endsection