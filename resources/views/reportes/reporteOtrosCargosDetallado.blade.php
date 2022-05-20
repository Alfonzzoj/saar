@extends('app')

@section('content')
<ol class="breadcrumb">
	<li><a href="{{url('principal')}}">Inicio</a></li>
	<li><a class="active">Desglose Cobranza Otros Cargos</a></li>
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
				{!! Form::open(["url" => action('ReporteController@getReporteOtrosCargosDetallado'), "method" => "GET", "class"=>"form-inline"]) !!}
				<div class="form-group" style="margin-left: 20px">
					<label><strong>MES: </strong></label>
					{!! Form::select('mes', $meses, $mes, ["class"=> "form-control"]) !!}
				</div>
				<div class="form-group" style="margin-left: 20px">
					<label><strong>AÑO: </strong></label>
					{!! Form::select('anno', $annos, $anno, ["class"=> "form-control"]) !!}
				</div>
				<div class="form-group">
					<label><strong>AEROPUERTO: </strong></label>
					{!! Form::select('aeropuerto', $aeropuertos, $aeropuerto, ["class"=> "form-control"]) !!}
				</div>
				<button type="submit" class="btn btn-default">Buscar</button>
				<a class="btn btn-default" href="{{action('ReporteController@getControlDeRecaudacionDiario')}}">Reset</a>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				{!! Form::open(["url" => action("ReporteController@postExportReport"), "id" =>"export-form", "target"=>"_blank"]) !!}
				{!! Form::hidden('table') !!}
               {{-- {!! Form::hidden('gerencia', $gerencia) !!}
                {!! Form::hidden('departamento', $departamento) !!} --}}
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
										<th id="fecha-col" style="vertical-align: middle;" class="text-center" align="left">
											Fecha
										</th>
										@foreach($modulos as $modulo)
											<th expandible data-colspan="{{$modulo->conceptos()->distinct('nombreImprimible')->count('nombreImprimible')}}" class="text-center" align="center" style="vertical-align: middle;" >
												{{$modulo->nombreImprimible}}
											</th>
										@endforeach
										<th rowspan="2" class="text-center" align="center" style="vertical-align: middle" >TOTAL</th>
									</tr>
									<tr>
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
										<td align="left">{{$fecha}}</td>
											@foreach($montoModulos as $moduloNombre => $conceptos)
												@foreach($conceptos as $concepto => $monto)
													@if($concepto=="total")
														<td align="right" style="text-align:right; ;" main data-parent="{{$moduloNombre}}">{{$traductor->format($monto)}}</td>
													@elseif($concepto!="totalDia")
														<td class="{{ $concepto }}" details data-parent="{{$moduloNombre}}" style="display:none;text-align:right">{{$traductor->format($monto)}}</td>
													@endif
												@endforeach
											@endforeach
										@foreach($montosDias as $dia => $monto)
											@if($dia == $fecha)
												<td align="right" class="text-right totalDia">{{ $traductor->format($monto['total']) }}</td>
											@endif
										@endforeach
									</tr>
									@endforeach
									<tr class="bg-gray">
										<td><strong>TOTALES</strong></td>
											@foreach($montosTotales as $moduloNombre => $conceptos)
												@foreach($conceptos as $concepto => $monto)
													@if($concepto=="total")
														<td style="text-align:right" main data-parent="{{$moduloNombre}}"><strong>{{$traductor->format($monto)}}</strong></td>
													@else
														<td id="{{ $concepto }}" details data-parent="{{$moduloNombre}}" style="display:none;text-align:right"><strong>{{$traductor->format($monto)}}</strong></td>
													@endif
												@endforeach
											@endforeach
										<td align="right" id="totalDia" class="text-right" style="font-weight: bold">0,00</td>
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

		var tasasNacMod=0;
		$('.TASAS NACIONALES MODULO').each(function(index,value){
			tasasNacMod+=commaToNum($(value).text().trim());
		});

		var tasasIntMod=0;
		$('.TASAS INTERNACIONALES MODULO').each(function(index,value){
			tasasIntMod+=commaToNum($(value).text().trim());
		});
		var tasasNacSCV=0;
		$('.TASAS NACIONALES SCV').each(function(index,value){
			tasasNacSCV+=commaToNum($(value).text().trim());
		});

		var tasasIntSCV=0;
		$('.TASAS INTERNACIONALES SCV').each(function(index,value){
			tasasIntSCV+=commaToNum($(value).text().trim());
		});

		var totalDia=0;
		$('.totalDia').each(function(index,value){
			totalDia+=commaToNum($(value).text().trim());
		});


		$('#totalDia').text(numToComma(totalDia));
		$('#TASAS NACIONALES MODULO').text(numToComma(tasasNacMod));
		$('#TASAS INTERNACIONALES MODULO').text(numToComma(tasasIntMod));
		$('#TASAS NACIONALES SCV').text(numToComma(tasasNacSCV));
		$('#TASAS INTERNACIONALES SCV').text(numToComma(tasasIntSCV));


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
					$('th[expandible]:not(".activo")').attr('rowspan',2);

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
									<th colspan="27" style="vertical-align: middle; margin-top:20px" align="center" class="text-center">CONTROL DE RECAUDACIÓN DIARIO\
									</br>\
									AEROPUERTO: {{$aeropuertoNombre}}\
									</br>\
									MES: {{$mesLetras}} AÑO: {{$anno}} </th>\
								</tr>\
							</thead>')
			$(table).find('thead, th').css({'border-top':'1px solid black', 'font-weight': 'bold', 'text-align':"center", 'font-size': '9px'})
			$(table).find('th').css({'border-bottom':'1px solid black', 'font-weight': 'bold', 'text-align':"center", 'font-size': '9px'})
			$(table).find('td').css({'font-size': '7px'})
			$(table).find('tr:nth-child(even)').css({'border-bottom':'1px solid black'})
			$(table).find('tr:last td').css({'border-bottom':'1px solid black','border-top':'1px solid black', 'font-weight': 'bold'})
			
			var tableHtml= $(table)[0].outerHTML;
			$('[name=table]').val(tableHtml);
			$('#export-form').submit(); 
		})


	})


</script>


@endsection
