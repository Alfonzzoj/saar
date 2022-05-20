@extends('app')

@section('content')
<ol class="breadcrumb">
	<li><a href="{{url('principal')}}">Inicio</a></li>
	<li><a class="active">Reporte Diario</a></li>
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
				{!! Form::open(["url" => action('ReporteController@getReporteMensual'), "method" => "GET", "class"=>"form-inline"]) !!}
				<div class="form-group">
					<label><strong>AEROPUERTO: </strong></label>
					{!! Form::select('aeropuerto', $aeropuertos, $aeropuerto, ["class"=> "form-control"]) !!}
				</div>
				<div class="form-group">
					<label><strong>MES: </strong></label>
					{!! Form::select('mes', $meses, $mes, ["class"=> "form-control"]) !!}
				</div>
				<div class="form-group">
					<label><strong>AÑO: </strong></label>
					{!! Form::select('anno', $annos, $anno, ["class"=> "form-control"]) !!}
				</div>
				<button type="submit" class="btn btn-default">Buscar</button>
				<a class="btn btn-default" href="{{action('ReporteController@getReporteMensual')}}">Reset</a>
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
							<table class="table table-hover table-condensed">
								<thead  class="bg-primary">
									<tr>
										<th id="fecha-col" style="vertical-align: middle" class="text-center">
											Fecha Recaudación
										</th>
										@foreach($modulos as $modulo)
										<th expandible data-colspan="{{$modulo->conceptos->count()}}" class="text-center" style="vertical-align: middle" >
											{{$modulo->nombre}}
										</th>
										@endforeach
									</tr>
									<tr >
										@foreach($modulos as $modulo)
										@foreach($modulo->conceptos as $concepto)
										<th details data-parent="{{$modulo->nombre}}" style="display:none;vertical-align: middle"  class="text-center" >
											<small>{{$concepto->nompre}}</small>
										</th>
										@endforeach
										@endforeach
									</tr>
								</thead>
								<tbody>
									@foreach($montos as $fecha => $montoModulos)
									<tr title="{{$fecha}}">
										<td>{{$fecha}}</td>
										@foreach($montoModulos as $moduloNombre => $conceptos)
										@foreach($conceptos as $concepto => $monto)
										@if($concepto=="total")
										<td style="text-align:right" main data-parent="{{$moduloNombre}}">{{$monto}}</td>
										@else
										<td details data-parent="{{$moduloNombre}}" style="display:none;text-align:right">{{$monto}}</td>
										@endif
										@endforeach
										@endforeach
									</tr>
									@endforeach

									<tr class="bg-gray">
										<td>Totales</td>
										@foreach($montosTotales as $moduloNombre => $conceptos)
										@foreach($conceptos as $concepto => $monto)
										@if($concepto=="total")
										<td style="text-align:right" main data-parent="{{$moduloNombre}}">{{$monto}}</td>
										@else
										<td  details data-parent="{{$moduloNombre}}" style="display:none;text-align:right">{{$monto}}</td>
										@endif
										@endforeach
										@endforeach
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



		$('#export-btn').click(function(e){
			var table=$('table').clone();
			$(table).find('td, th').filter(function() {
				return $(this).css('display') == 'none';
			}).remove();
			$(table).find('tr').filter(function() {
				return $(this).find('td,th').length == 0;
			}).remove();
			$(table).find('th').css({'border-bottom':'1px solid black','border-top':'1px solid black', 'font-weight': 'bold'})
			$(table).find('tr:last td').css({'border-bottom':'1px solid black','border-top':'1px solid black', 'font-weight': 'bold'})
			var tableHtml= $(table)[0].outerHTML;
			$('[name=table]').val(tableHtml);
			$('#export-form').submit();
		})


		$('th[expandible]').click(function(){
			var moduloNombre=$(this).text().trim();
			var thfecha=$('#fecha-col');
			if(!$(this).hasClass('activo')){
				$(this).attr('rowspan',1);
				$(this).addClass('activo');
				$(this).attr('colspan', $(this).data('colspan'));
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





		})



	})


</script>


@endsection