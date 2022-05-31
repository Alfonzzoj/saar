<div class="col-md-7 connectedSortable" >
	<div class="box box-success">
		<div class="box-header with-border">
			<h3 class="box-title"><span class="fa fa-road"></span> ATERRIZAJES PENDIENTES DEL DÍA</h3>
			<div class="box-tools pull-right">
				<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
			</div>
		</div><!-- /.box-header -->
		<div class="box-body">
			<div class="table-responsive">
				<table class="table no-margin">
					<thead>
						<tr class="bg-gray">
							<th>Hora</th>
							<th>Matrícula</th>
							<th>Procedencia</th>
							<th>Cliente</th>
							<th>Opciones</th>
						</tr>
					</thead>
					<tbody>
					@if(count($aterrizajesPendientes)>0)
						@foreach($aterrizajesPendientes as $aterrizaje)
			               <tr data-id='{{$aterrizaje->id}}'>
			                    <td class ='hora-td'>{{$aterrizaje->hora}}</td>
			                    <td class ='aeronave_id-td'>{{$aterrizaje->aeronave->matricula}}</td>
			                    <td class ='puerto_id-td'>{{(($aterrizaje->puerto)?$aterrizaje->puerto->siglas:"No disponible")}}</td>
			                    <td class ='cliente_id-td'>{{(($aterrizaje->cliente)?$aterrizaje->cliente->nombre:"No asignado")}}</td>
			                    <td>
			                         <div class='btn-group  btn-group-sm' role='group' aria-label='...'>
			                              <a class='btn btn-success btn-sm darSalida-btn' href='{{action('DespegueController@create', [$aterrizaje->id])}}'><i class='fa fa-plane' title='Dar Salida'></i> Dar Salida</a>
			                         </div>
			                    </td>
			               </tr> 
						@endforeach
					@else					
						<tr>
							<td colspan="5" align="center">No hay Aterrizajes Pendientes</td>
						</tr>
					@endif
					</tbody>
				</table>
				<div class="box-footer clearfix">
						<a href="{{action('AterrizajeController@index') }}" class="pull-right btn btn-default">Ver más <i class="fa fa-arrow-circle-right"></i></a>
					</a>	
				</div>
			</div><!-- /.table-responsive -->
		</div><!-- /.box-body -->
	</div><!-- /.box -->
</div><!-- /.col -->