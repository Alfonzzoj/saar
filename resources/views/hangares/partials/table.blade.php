<div class="table-responsive">
	<table id="hangar-table" class="table no-margin">
		<thead class="bg-primary">
			<tr>
                    {!!Html::sortableColumnTitle("Aeropuerto", "aeropuerto_id")!!}
                    {!!Html::sortableColumnTitle("Nombre", "nombre")!!}
                    <th>N° Clientes</th>
                    <th>N° Aeronaves</th>
                    <th>Opciones</th>
               </tr>
          </thead>
          <tbody>
               @if($hangares->count()==0)
               <tr>
                    <td colspan="7" class="text-center">No se consiguió ningún registro</td>
               </tr>
               @endif
               @foreach($hangares as $hangar)
               <tr data-id='{{$hangar->id}}'>
                    <td class='aeropuerto_id-td'>{{$hangar->aeropuerto->nombre}}</td>
                    <td class='nombre-td'>{{$hangar->nombre}}</td>
                    <td class='clientes-td'>{{$hangar->clientes->count()}}</td>
                    <td class='aeronaves-td'>{{$hangar->aeronaves->count()}}</td>
                    <td>
                         <!-- <button class='btn btn-primary btn-sm editarHangar-btn' data-id='{{$hangar->id}}'><i class='glyphicon glyphicon-eye-open' title='Ver Información'></i></button> -->
                         <button class='btn btn-warning btn-sm editarHangar-btn' data-id='{{$hangar->id}}'><i class='glyphicon glyphicon-pencil' title='Editar Información'></i></button>
                         <button class='btn btn-danger  btn-sm eliminarHangar-btn' data-id='{{$hangar->id}}'><i class='glyphicon glyphicon-trash' title='Eliminar Registro'></i></button>
                    </td>
               </tr>   
               @endforeach
               <h6 class="table-info pull-right">Total de Registros: {{$hangar->count()}}</h6>

          </tbody>
     </table>
</div><!-- /.table-responsive -->
<div class="row">
     <div class="col-xs-12 text-center">
          {!! $hangares->appends(Input::except('page'))->render() !!}
     </div>
</div>