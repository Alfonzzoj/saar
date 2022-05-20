@extends('app')

@section('content')

<ol class="breadcrumb">
	<li><a href="{{url('principal')}}">Inicio</a></li>
	<li><a class="active">DES900</a></li>
</ol>
<div class="row" id="box-wrapper">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Filtros</h3>
				<div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse">
						<i class="fa fa-minus"></i>
					</button>
				</div><!-- /.box-tools -->
			</div>
            <div class="box-body text-right">
                {!! Form::open(["url" => action('ReporteController@getReporteDES900'), "method" => "GET", "class"=>"form-inline"]) !!}
                 <label><strong>DESDE: </strong></label>
				<div class="form-group">
					<input type="text" class="form-control" name="diaDesde" value="{{$diaDesde}}" placeholder="Día">
                </div>
                <div class="form-group">
                      {!! Form::select('mesDesde', $meses, $mesDesde, ["class"=> "form-control"]) !!}
                </div>
                <div class="form-group">
                      {!! Form::select('annoDesde', $annos, $annoDesde, ["class"=> "form-control"]) !!}
                </div>
                <label style="margin-left: 20px"><strong>HASTA: </strong></label>
				<div class="form-group">
					<input type="text" class="form-control" name="diaHasta" value="{{$diaHasta}}" placeholder="Día">
                </div>
                <div class="form-group">
                      {!! Form::select('mesHasta', $meses, $mesHasta, ["class"=> "form-control"]) !!}
                </div>
                <div class="form-group">
                      {!! Form::select('annoHasta', $annos, $annoHasta, ["class"=> "form-control"]) !!}
                </div>
				<div class="form-group text-left" >
					<label ><strong>CLIENTE: </strong></label>
             		 {!! Form::select('cliente_id', $clientes, $cliente, ["class"=> "form-control select-flt", 'id' => 'cliente']) !!}
				</div>
                <br>
                <button type="submit" class="btn btn-primary">Buscar</button>
                <a class="btn btn-default" href="{{action('ReporteController@getReporteDES900')}}">Reset</a>
                {!! Form::close() !!}
            </div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="box box-primary">
            <div class="box-header">
                {!! Form::open(["url" => action("ReporteController@postExportReport"), "id" =>"export-form", "target"=>"_blank"]) !!}
                {!! Form::hidden('table') !!}
                {!! Form::hidden('departamento', $departamento) !!}
                {!! Form::hidden('gerencia', $gerencia) !!}
                    <span class="pull-right">
											<input type="checkbox" name="excel"> Excel 
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
							<table class="table table-condensed">
								<thead  class="bg-primary">
									<tr>
										<th colspan="5" rowspan="2" style="vertical-align: middle; width: 220px; " class="text-center">GENERAL</th>
										<th colspan="9" style="vertical-align: middle; width: 450px; " class="text-center">ATERRIZAJE</th>
										<th colspan="7" style="vertical-align: middle; width: 350px; " class="text-center">DESPEGUE</th>
									</tr>
									<tr>
										<th colspan="5"></th>
										<th colspan="2" class="text-center" style="width: 100px">Desembarque</th>
										<th colspan="2" class="text-center" style="width: 100px">Tránsito</th>
										<th colspan="5"></th>
										<th colspan="2" class="text-center" style="width: 100px">Embarque</th>
									</tr>
									<tr align="center">
										<th class="text-center" align="center" style="width: 20px">Nro.</th>
										<th class="text-center" align="center" style="width: 50px">Día</th>
										<th class="text-center" align="center" style="width: 50px">N°Dosa</th>
										<th class="text-center" align="center" style="width: 50px">Modelo</th>
										<th class="text-center" align="center" style="width: 50px">Matrícula</th>

										<th class="text-center" align="center" style="width: 50px">Piloto</th>
										<th class="text-center" align="center" style="width: 50px">N°Vuelo</th>
										<th class="text-center" align="center" style="width: 50px">Fecha</th>
										<th class="text-center" align="center" style="width: 50px">Hora</th>
										<th class="text-center" align="center" style="width: 50px">Procedencia</th>
										<th class="text-center" align="center" style="width: 50px">Pass</th>
										<th class="text-center" align="center" style="width: 50px">Carga</th>
										<th class="text-center" align="center" style="width: 50px">Pass</th>
										<th class="text-center" align="center" style="width: 50px">Carga</th>

										<th class="text-center" align="center" style="width: 50px">Piloto</th>
										<th class="text-center" align="center" style="width: 50px">N°Vuelo</th>
										<th class="text-center" align="center" style="width: 50px">Fecha</th>
										<th class="text-center" align="center" style="width: 50px">Hora</th>
										<th class="text-center" align="center" style="width: 50px">Destino</th>
										<th class="text-center" align="center" style="width: 50px">Pass</th>
										<th class="text-center" align="center" style="width: 50px">Carga</th>
									</tr>
								</thead>
								<tbody>
								@if($despegues->count()>0)
									@foreach($despegues as $index=>$despegue)
										<tr title="{{$despegue->fecha}}">
											<td  class="text-center" align="center" style="width: 20px">{{$index+1}}</td>
											<td  class="text-center" align="center" style="width: 50px">{{$despegue->fecha}}</td>
											<td  class="text-center" align="center" style="width: 50px">{{($despegue->factura)?$despegue->factura->nroDosa:"N/A"}}</td>
											<td  class="text-center" align="center" style="width: 50px">{{$despegue->aterrizaje->aeronave->modelo->modelo}}</td>
											<td  class="text-center" align="center" style="width: 50px">{{$despegue->aterrizaje->aeronave->matricula}}</td>

											<td  class="text-center" align="center" style="width: 50px">{{($despegue->aterrizaje->piloto)?$despegue->aterrizaje->piloto->nombre:"N/A"}}</td>
											<td  class="text-center" align="center" style="width: 50px">{{($despegue->aterrizaje->num_vuelo)?$despegue->aterrizaje->num_vuelo:"N/A"}}</td>
											<td  class="text-center" align="center" style="width: 50px">{{$despegue->aterrizaje->fecha}}</td>
											<td  class="text-center" align="center" style="width: 50px">{{$despegue->aterrizaje->hora}}</td>
											<td  class="text-center" align="center" style="width: 50px">{{($despegue->aterrizaje->puerto)?$despegue->aterrizaje->puerto->nombre:"N/A"}}</td>
											<td  class="text-center" align="center" style="width: 50px">{{$despegue->aterrizaje->desembarqueAdultos+$despegue->aterrizaje->desembarqueInfante+$despegue->aterrizaje->desembarqueTercera}}</td>
											<td  class="text-center" align="center" style="width: 50px">{{$despegue->peso_desembarcado}}</td>
											<td  class="text-center" align="center" style="width: 50px">{{$despegue->aterrizaje->desembarqueTransito}}</td>
											<td  class="text-center" align="center" style="width: 50px">{{$despegue->peso_embarcado}}</td>

											<td  class="text-center" align="center" style="width: 50px">{{($despegue->piloto)?$despegue->piloto->nombre:"N/A"}}</td>
											<td  class="text-center" align="center" style="width: 50px">{{($despegue->num_vuelo)?$despegue->num_vuelo:"N/A"}}</td>
											<td  class="text-center" align="center" style="width: 50px">{{$despegue->fecha}}</td>
											<td  class="text-center" align="center" style="width: 50px">{{$despegue->hora}}</td>
											<td  class="text-center" align="center" style="width: 50px">{{($despegue->puerto)?$despegue->puerto->nombre:"N/A"}}</td>
											<td  class="text-center" align="center" style="width: 50px">{{$despegue->embarqueAdultos+$despegue->embarqueInfante+$despegue->embarqueTercera}}</td>
											<td  class="text-center" align="center" style="width: 50px">{{$despegue->peso_embarcado}}</td>
										</tr>
									@endforeach
								@else
									<tr>
										<td colspan="21" class="text-center" align="center">
											No hay registros disponibles.
										</td>
									</tr>
								@endif
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



		$('#cliente').chosen({width:'355px'});
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
									<th colspan="21" style="vertical-align: middle; margin-top:20px" align="center" class="text-center">DES 900\
									</br>\
									DESDE: {{$diaDesde}}/{{$mesDesde}}/{{$annoDesde}} HASTA: {{$diaHasta}}/{{$mesHasta}}/{{$annoHasta}} </th>\
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
		});
	});
</script>
@endsection