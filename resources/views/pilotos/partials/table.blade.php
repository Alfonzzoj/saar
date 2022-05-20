<div class="table-responsive">
	<table id="piloto-table" class="table no-margin">
		<thead class="bg-primary">
			<tr>
				{!!Html::sortableColumnTitle("Nombre", "nombre")!!}
				{!!Html::sortableColumnTitle("C.I", "documento_identidad")!!}
				{!!Html::sortableColumnTitle("País", "nacionalidad_id")!!}
				{!!Html::sortableColumnTitle("Teléfono", "telefono")!!}
				{!!Html::sortableColumnTitle("Licencia", "licencia")!!}
				<th>Opciones</th>
			</tr>
		</thead>
		<tbody> 
           @if($totalPilotos==0)
	           <tr>
	                <td colspan="7" class="text-center">No se consiguió ningún registro</td>
	           </tr>
           @else           
                    <h6 class="table-info pull-right">Total de Registros: {{$totalPilotos}}</h6>
            @endif
			@foreach($pilotos as $piloto)
			<tr data-id='{{$piloto->id}}'>
				<td class='nombre-td'>{{$piloto->nombre}}</td>
				<td class='documento_identidad-td'>{{$piloto->documento_identidad}}</td>
				<td class='nacionalidad-td'>{{$piloto->nacionalidad->nombre}}</td>
				<td class='telefono-td'>{{(($piloto->telefono)?$piloto->telefono:"No dispone")}}</td>
				<td class='licencia-td'>{{$piloto->licencia}}</td>
				<td>
					<button class='btn {{($piloto->estado==1)?"btn-primary":"btn-default"}} btn-sm activarPiloto-btn' data-id='{{$piloto->id}}'><i class='glyphicon glyphicon-adjust' title='{{($piloto->estado==1)?"Piloto Habilitado":"Piloto Inhabilitado"}}'></i></button>
					<button class='btn btn-warning btn-sm editarPiloto-btn' data-id="{{$piloto->id}}"><i class='glyphicon glyphicon-pencil' title='Editar Información'></i></button>
					<button class='btn btn-danger btn-sm eliminarPiloto-btn' data-id="{{$piloto->id}}"><i class='glyphicon glyphicon-trash' title='Eliminar Registro'></i></button>
				</td>
			</tr>   
			@endforeach
		</tbody>
	</table>
</div><!-- /.table-responsive -->
<div class="row">
	<div class="col-xs-12 text-center">
		{!! $pilotos->appends(Input::except('page'))->render() !!}
	</div>
</div> 