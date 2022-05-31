@extends('app')

@section('content')
<ol class="breadcrumb">
	<li><a href="{{url('principal')}}">Inicio</a></li>
	<li><a class="active">Relación de Ingreso Mensual</a></li>
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
				{!! Form::open(["url" => action('ReporteController@getReporteRelacionIngresoMensual'), "method" => "GET", "class"=>"form-inline"]) !!}
				<div class="form-group">
					<label><strong>AÑO: </strong></label>
					{!! Form::select('anno', $annos, $anno, ["class"=> "form-control"]) !!}
				</div>
				<button type="submit" class="btn btn-primary">BUSCAR</button>
				<a class="btn btn-default" href="{{action('ReporteController@getReporteRelacionIngresoMensual')}}">RESET</a>
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
										<th class="text-center" style="vertical-align: middle; width:200px; font-weight: bold;" rowspan="2"  >
											MES
										</th>
										<th style="vertical-align: middle; font-weight: bold; width:750px; " class="text-center" colspan="3">
											AEROPUERTOS
										</th>
										<th rowspan="2" style="vertical-align: middle; font-weight: bold; width:200px; " class="text-center">
											TOTAL
										</th>

									<tr>
										<th style="vertical-align: middle; font-weight: bold; width:250px; " class="text-center">
											MANUEL CARLOS PIAR
										</th>
										<th style="vertical-align: middle; font-weight: bold; width:250px; " class="text-center">
											GRAL TOMÁS DE HERES
										</th>
										<th style="vertical-align: middle; font-weight: bold; width:250px; " class="text-center">
											SANTA ELENA DE UAIRÉN
										</th>
									</tr>
								</thead>
								<tbody>
									@foreach($montosMeses as $mes => $montos)
										<tr>
											<td class="text-center" style="vertical-align: middle; width:200px; ">{{$mes}}</td>
											<td class="text-right cobradoPZO" align="right" style="width: 250px">{{$traductor->format($montos["cobradoPZO"])}}</td>
											<td class="text-right cobradoCBL" align="right" style="width: 250px">{{$traductor->format($montos["cobradoCBL"])}}</td>
											<td class="text-right cobradoSNV" align="right" style="width: 250px">{{$traductor->format($montos["cobradoSNV"])}}</td>
											<td class="text-right cobradoTotal" align="right" style="font-weight: bold; width:200px; ">{{$traductor->format($montos["cobradoTotal"])}}</td>
										</tr>
									@endforeach
										<tr class="bg-gray" id="totales">
											<td style="font-weight: bold;">TOTALES</td>
											<td class="text-right" id="cobradoTotalPZO" align="right" style="font-weight: bold;">0</td>
											<td class="text-right" id="cobradoTotalCBL" align="right" style="font-weight: bold;">0</td>
											<td class="text-right" id="cobradoTotalSNV" align="right" style="font-weight: bold;">0</td>
											<td class="text-right cobradoTotalTotal" align="right" style="font-weight: bold;">0</td>
										</tr>
										<tr class="bg-gray">
											<td>-</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
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

		var cobradoTotalCBL=0;
		$('.cobradoCBL').each(function(index,value){
			cobradoTotalCBL+=commaToNum($(value).text().trim());
		});


		var cobradoTotalSNV=0;
		$('.cobradoSNV').each(function(index,value){
			cobradoTotalSNV+=commaToNum($(value).text().trim());
		});

		var cobradoTotalTotal=0;
		$('.cobradoTotal').each(function(index,value){
			cobradoTotalTotal+=commaToNum($(value).text().trim());
		});

		var meta=0;
		$('#meta').each(function(index,value){
			meta+=commaToNum($(value).text().trim());
		});

		diferencia=cobradoTotalTotal-meta;

		$('#cobradoTotalPZO').text(numToComma(cobradoTotalPZO));
		$('#cobradoTotalCBL').text(numToComma(cobradoTotalCBL));
		$('#cobradoTotalSNV').text(numToComma(cobradoTotalSNV));
		$('.cobradoTotalTotal').text(numToComma(cobradoTotalTotal));
		$('#diferencia').text(numToComma(diferencia));


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
		                    <th colspan="5" style="vertical-align: middle; margin-top:20px" align="center" class="text-center">RELACIÓN DE INGRESO MENSUAL\
		                    </br>\
		                    AÑO: {{$anno}}\
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

	})
</script>


@endsection