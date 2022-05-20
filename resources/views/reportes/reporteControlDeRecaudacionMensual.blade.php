@extends('app')
@section('content')
<ol class="breadcrumb">
	<li><a href="{{url('principal')}}">Inicio</a></li>
	<li><a class="active">Control de Recaudación Mensual</a></li>
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
				{!! Form::open(["url" => action('ReporteController@getControlDeRecaudacionMensual'), "method" => "GET", "class"=>"form-inline"]) !!}
				<div class="form-group">
					<label><strong>AEROPUERTO:</strong></label>
					{!! Form::select('aeropuerto', $aeropuertos, $aeropuerto, ["class"=> "form-control"]) !!}
				</div>
				<div class="form-group">
					<label><strong>AÑO:</strong></label>
					{!! Form::select('anno', $annos, $anno, ["class"=> "form-control"]) !!}
				</div>
				<button type="submit" class="btn btn-primary">Buscar</button>
				<a class="btn btn-default" href="{{action('ReporteController@getControlDeRecaudacionMensual')}}">Reset</a>
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

						<div class="table-responsive" style="max-height: 600px">
							<table class="table table-hover table-condensed">
								<thead  class="bg-primary">
									<tr>
										<th id="fecha-col"  style="vertical-align: middle; width: 30px" class="text-center" align="left">
											MES
										</th>
										@foreach($modulos as $modulo)
												
										<th expandible data-colspan="{{$modulo->conceptos()->distinct('nombreImprimible')->count('nombreImprimible')}}" class="text-center" style="vertical-align: middle" >
											{{$modulo->nombreImprimible}}
										</th>
									
										@endforeach
										<th  align="left" rowspan="2" class="text-center"><strong>SALDO FAVOR.</strong></th>
										<th  align="left" rowspan="2" class="text-center"><strong>AJUSTE.</strong></th>
										<th id="fecha-col" rowspan="2" style="vertical-align: middle; width: 60px; " class="text-center" align="center">
											TOTAL
										</th>

									</tr>
									<tr >
										@foreach($modulos as $modulo)
											@if(($modulo->nombreImprimible != 'CANON'))
												@foreach($nombresImprimibles[$modulo->nombre] as $nombreImprimible => $valor) 
										<th details data-parent="{{$modulo->nombre}}" style="display:none;vertical-align: middle"  class="text-center" align="center" >
											<small>{{$nombreImprimible}}</small>
										</th>
										@endforeach
                                            @endif
										@endforeach
									</tr>
								</thead>
								<tbody>
									@foreach($montos as $fecha => $montoModulos)
									<tr title="{{$fecha}}" >
										<td align="left" class="text-left">{{substr($fecha, 0, 3)}}</td>
										@foreach($montoModulos as $moduloNombre => $conceptos)
											@foreach($conceptos as $concepto => $monto)
												@if($concepto=="total")
													<td align="right" style="text-align:right;"  main data-parent="{{$moduloNombre}}">{{$traductor->format($monto)}}</td>
												@else
													<td details data-parent="{{$moduloNombre}}" style="display:none;text-align:right">{{$traductor->format($monto)}}</td>
												@endif
											@endforeach
										@endforeach
										<td style="text-align:right">{{$traductor->format($saldoMes[$fecha])}}</td>
										<td style="text-align:right">{{$traductor->format($ajustesMes[$fecha])}}</td>

										@foreach($montosTotalesMeses as $mes => $totalMes)
											@if($mes == $fecha)
												<td align="right" class="text-right totalMes" style="width: 60px"><strong>{{$traductor->format($totalMes["totalMes"])}}</strong></td>
											@endif
										@endforeach
									</tr>
									@endforeach
									<tr class="bg-gray">
										<td  align="left" class="text-left"><strong>TOTAL</strong></td>
										@foreach($montosTotales as $moduloNombre => $conceptos)
											@foreach($conceptos as $concepto => $monto)
											@if($concepto=="total")
												<td style="text-align:right" main data-parent="{{$moduloNombre}}"><strong>{{$traductor->format($monto)}}</strong></td>
											@else
												<td  details data-parent="{{$moduloNombre}}" style="display:none;text-align:right"><strong>{{$traductor->format($monto)}}</strong></td>
												@endif
											@endforeach
										@endforeach
										<td style="text-align:right">
											<strong>{{$traductor->format($saldoMesTotal)}}</strong>
										</td>
										<td style="text-align:right">
											<strong>{{$traductor->format($ajustesMesTotal)}}</strong>
										</td>
										<td align="right" class="text-right" id="totalMeses" style="font-weight: bold; width: 60px; "><strong>0,00</strong></td>
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

	$(document).ready(function(){
	    var totalMeses=0;
	    $('.totalMes').each(function(index,value){
	        totalMeses+=commaToNum($(value).text().trim());
	    });

	    console.log(totalMeses);
	    var metaMeses=0;

	    $('.metaMes').each(function(index,value){
	        metaMeses+=commaToNum($(value).text().trim());
	    });
	    var diferenciaMeses=0;
	    $('.diferenciaMes').each(function(index,value){
	        diferenciaMeses+=commaToNum($(value).text().trim());
	    });

	    $('#totalMeses').text(numToComma(totalMeses));
	    $('#metaMeses').text(numToComma(metaMeses));
	    $('#diferenciaMeses').text(numToComma(diferenciaMeses));


		$.each($('th[expandible]'), function(index,value){
			if(($(this).text().trim())=='DOSAS' || ($(this).text().trim())=='TASAS'){
				var moduloNombre=$(this).text().trim();
				var thfecha=$('#fecha-col');
				if(!$(this).hasClass('activo')){
					$(this).attr('rowspan',1);
					$(this).addClass('activo');
					col=$(this).attr('colspan', $(this).data('colspan'));
					$(thfecha).attr('rowspan', 2);
					$('td[main][data-parent="'+moduloNombre+'"]').hide();
					$('td[details][data-parent="'+moduloNombre+'"]').show();
					$('th[details][data-parent="'+moduloNombre+'"]').show();
					$('th[expandible]:not(".activo")').attr('rowspan',2)

				}else{
					$(this).removeClass('activo');
					$(this).attr('colspan', 1);
					$('td[details][data-parent="'+moduloNombre+'"]').hide();
					$('th[details][data-parent="'+moduloNombre+'"]').hide();
					$('td[main][data-parent="'+moduloNombre+'"]').show();
					if($('th[expandible].activo').length==0){
						$(thfecha).attr('rowspan', 1);
						$('th[expandible]').attr('rowspan',1)
					}
				}
			}
		})



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
									<th colspan="27" style="vertical-align: middle; margin-top:20px" align="center" class="text-center">CONTROL DE RECAUDACIÓN MENSUAL\
									</br>\
									AEROPUERTO: {{$aeropuertoNombre}}\
									</br>\
									AÑO: {{$anno}} </th>\
								</tr>\
							</thead>')
			$(table).find('thead, th').css({'border-top':'1px solid black', 'font-weight': 'bold', 'text-align':"center", 'font-size': '10px'})
			$(table).find('th').css({'border-bottom':'1px solid black', 'font-weight': 'bold', 'text-align':"center", 'font-size': '10px'})
			$(table).find('td').css({'font-size': '7px'})
			$(table).find('tr:last td').css({'border-bottom':'1px solid black','border-top':'1px solid black'})
			$(table).find('tr:nth-child(even)').css({'border-bottom':'1px solid black'})
			$(table).append('<tr>\
								<td colspan="27"><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></td>\
								</tr><tr>\
								<td colspan="12" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 7px">REVISADO</td>\
								<td colspan="15" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 7px">CONFORMADO</td>\
								</tr><tr>\
								<td colspan="6" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black;"><br><br><br><br> </td>\
								<td colspan="6" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black;"> </td>\
								<td colspan="4" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black;"> </td>\
								<td colspan="6" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black;"> </td>\
								<td colspan="5" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black;"> </td>\
								</tr><tr>\
								<td colspan="6" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 6px">JEFE DEPARTAMENTO RECAUDACIÓN</td>\
								<td colspan="6" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 6px">CONTADOR</td>\
								<td colspan="4" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 6px">GERENTE ADMINISTRACIÓN</td>\
								<td colspan="6" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 6px">SUB-DIRECTOR</td>\
								<td colspan="5" align="center" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 6px">DIRECTOR</td>\
							</tr>')
			var tableHtml= $(table)[0].outerHTML;
			$('[name=table]').val(tableHtml);
			$('#export-form').submit();
		})


	})


</script>


@endsection