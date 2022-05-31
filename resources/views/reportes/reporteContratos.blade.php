@extends('app')

@section('content')

<ol class="breadcrumb">
	<li><a href="{{url('principal')}}">Inicio</a></li>
	<li><a class="active">Listado de Contratos</a></li>
</ol>
<div class="row" id="box-wrapper">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				{!! Form::open(["url" => action("ReporteController@postExportReport"), "id" =>"export-form", "target"=>"_blank"]) !!}
				{!! Form::hidden('table') !!}
                {!! Form::hidden('departamento', 'Oficina de Asuntos Legales') !!}
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
								<thead  class="bg-primary">
									<tr align="center">
										<th  class="text-center" align="center" style="width: 50px; vertical-align: middle;">Nro.</th>
										<th  class="text-center" align="center" style="width: 100px; vertical-align: middle;">COD. CONTRATO</th>
										<th  class="text-center" align="center" style="width: 100px; vertical-align: middle;">COD. CLIENTE</th>
										<th  class="text-center" align="center" style="width: 550px; vertical-align: middle;">CLIENTE</th>
										<th  class="text-center" align="center" style="width: 150px; vertical-align: middle;">TIPO </th>
										<th  class="text-center" align="center" style="width: 150px; vertical-align: middle;">MONTO (Bs.)</th>
									</tr>
								</thead>
								<tbody>
									@foreach($contratos as $index => $contrato)
									<tr align="left">
										<td class="text-center" align="center" style="width: 50px">{{$index+1}}</td>
										<td class="text-center" align="center" style="width: 100px">{{$contrato->nContrato}}</td>
										<td class="text-center" align="center" style="width: 100px">{{$contrato->cliente->codigo}}</td>
										<td class="text-left" align="left" style="width: 550px">{{$contrato->cliente->nombre}}</td>
										<td class="text-center" align="center" style="width: 150px">{{$contrato->montoTipo}}</td>
										<td class="text-right" align="right" style="width: 150px">{{$traductor->format($contrato->monto)}}</td>
									</tr>
									@endforeach
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
			$(table).prepend('<thead>\
								<tr>\
									<th colspan="6" style="vertical-align: middle; margin-top:20px" align="center" class="text-center">RELACIÓN DE CONTRATOS\
									</th>\
								</tr>\
							</thead>')
			$(table).find('thead, th').css({'border-top':'1px solid black', 'font-weight': 'bold', 'text-align':"center", 'font-size': '12px'})
			$(table).find('th').css({'border-bottom':'1px solid black', 'font-weight': 'bold', 'text-align':"center", 'font-size': '12px'})
			$(table).find('td').css({'font-size': '10px'})
			$(table).find('tr:nth-child(even)').css({'border-bottom':'1px solid black'})
		    $(table).find('tr:last td').css({'border-bottom':'1px solid black'})
			var tableHtml= $(table)[0].outerHTML;
			$('[name=table]').val(tableHtml);
			$('#export-form').submit();
		})
	});
</script>
@endsection