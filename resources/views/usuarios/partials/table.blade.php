<div class="table-responsive">
	<table id="usuario-table" class="table no-margin">
		<thead class="bg-primary">
			<tr>
				{!!Html::sortableColumnTitle("Username", "username")!!}
				{!!Html::sortableColumnTitle("Nombre y Apellido", "fullname")!!}
				{!!Html::sortableColumnTitle("Departamento", "departamento_id")!!}
				<th>Cargo</th>
				<th>Opciones</th>
			</tr>
		</thead>
		<tbody> 
           @if($totalUsuarios==0)
	           <tr>
	                <td colspan="5" class="text-center">No se consiguió ningún registro</td>
	           </tr>
           @else           
                    <h6 class="table-info pull-right">Total de Registros: {{$totalUsuarios}}</h6>
            @endif
			@foreach($usuarios as $usuario)
			<tr data-id='{{$usuario->id}}'>
				<td class='username-td'>{{$usuario->username}}</td>
				<td class='fullname-td'>{{$usuario->fullname}}</td>
				<td class='departamento_id-td'>{{$usuario->departamento->nombre}}</td>
				<td class='cargo_id-td'>{{($usuario->cargo)?$usuario->cargo->nombre:'N/A'}}</td>
				<td>
					<button class='btn {{($usuario->estado==1)?"btn-primary":"btn-default"}} btn-sm activarUsuario-btn' data-id='{{$usuario->id}}'><i class='glyphicon glyphicon-adjust' title='{{($usuario->estado==1)?"Usuario Habilitado":"Usuario Inhabilitado"}}'></i></button>
					<button class='btn btn-warning btn-sm editarUsuario-btn' data-id="{{$usuario->id}}"><i class='glyphicon glyphicon-pencil' title='Editar Información'></i></button>
					<button class='btn btn-danger btn-sm eliminarUsuario-btn' data-id="{{$usuario->id}}"><i class='glyphicon glyphicon-trash' title='Eliminar Registro'></i></button>
				</td>
			</tr>   
			@endforeach
		</tbody>
	</table>
</div><!-- /.table-responsive -->
<div class="row">
	<div class="col-xs-12 text-center">
		{!! $usuarios->appends(Input::except('page'))->render() !!}
	</div>
</div> 