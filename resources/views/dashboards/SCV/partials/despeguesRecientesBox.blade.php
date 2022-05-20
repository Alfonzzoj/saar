<div class="row">
	<div class="col-md-12">
		<div class="nav-tabs-custom ">
			<div class="box box-info">
				<div class="box-header with-border">
					<h3 class="box-title"><span class="fa fa-plane"></span> DESPEGUES RECIENTES DEL DÍA</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
					</div>
				</div><!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
						<table class="table no-margin">
							<thead>
								<tr class="bg-primary">
									<th colspan="2" class="text-center" >GENERAL</th>
									<th colspan="5" class="text-center" >ATERRIZAJE</th>
									<th colspan="5" class="text-center" >DESPEGUE</th>
								</tr>
								<tr class="bg-primary">
									<th class="text-center">Matrícula</th>
									<th class="text-center">Cliente</th>

									<th class="text-center">Hora</th>
									<th class="text-center">Nro. Vuelo</th>
									<th class="text-center">Piloto</th>
									<th class="text-center">Procedencia</th>
									<th class="text-center">Desembarque</th>

									<th class="text-center">Hora</th>
									<th class="text-center">Nro. Vuelo</th>
									<th class="text-center">Piloto</th>
									<th class="text-center">Destino</th>
									<th class="text-center">Embarque</th>
									
								</tr>
							</thead>
							<tbody>
							@if(count($despeguesRecientes)>0)
								@foreach($despeguesRecientes as $recientes)
									<tr>
										<td class="text-center">{{$recientes->aeronave->matricula}}</td>
										<td class="text-left">{{$recientes->cliente->nombre}}</td>
										<td class="text-center">{{$recientes->aterrizaje->hora}}</td>
										<td class="text-center">{{($recientes->aterrizaje->num_vuelo)?$recientes->aterrizaje->num_vuelo:'N/A'}}</td>
										<td class="text-left">{{$recientes->aterrizaje->piloto->nombre}}</td>
										<td class="text-center">{{$recientes->aterrizaje->puerto->nombre}}</td>
										<td class="text-center">{{$recientes->aterrizaje->desembarqueAdultos+$recientes->aterrizaje->desembarqueInfante+$recientes->aterrizaje->desembarqueTercera}}</td>
										<td class="text-center">{{$recientes->hora}}</td>
										<td class="text-center">{{($recientes->num_vuelo)?$recientes->num_vuelo:'N/A'}}</td>
										<td class="text-left">{{$recientes->piloto->nombre}}</td>
										<td class="text-center">{{$recientes->puerto->nombre}}</td>
										<td class="text-center">{{$recientes->embarqueAdultos+$recientes->embarqueInfante+$recientes->embarqueTercera+$recientes->transitoAdultos+$recientes->transitoInfante+$recientes->transitoTercera}}</td>
									</tr>
								@endforeach
							@else
								<tr>
									<td class="text-center" colspan="12">No hay registros disponibles</td>
								</tr>
							@endif
							</tbody>
						</table>
						<div class="box-footer clearfix">
							<a href="{{action('DespegueController@index') }}"  class="pull-right btn btn-default">Ver más <i class="fa fa-arrow-circle-right"></i></a>	
						</div>
					</div><!-- /.table-responsive -->
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.box -->
</div><!-- /.col -->