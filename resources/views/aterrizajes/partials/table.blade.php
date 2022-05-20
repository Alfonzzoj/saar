<div class="table-responsive">     
	<table id="aterrizaje-table" class="table no-margin">
		<thead class="bg-primary">
			<tr>
                    {!!Html::sortableColumnTitle("Fecha", "fecha")!!}
                    {!!Html::sortableColumnTitle("Hora", "hora")!!}
                    {!!Html::sortableColumnTitle("Matrícula", "aeronave_id")!!}
                    {!!Html::sortableColumnTitle("Tipo", "tipoMatricula_id")!!}
                    {!!Html::sortableColumnTitle("Procedencia", "puerto_id")!!}
                    {!!Html::sortableColumnTitle("Nro. Vuelo", "num_vuelo")!!}
                    {!!Html::sortableColumnTitle("Cliente", "cliente_id")!!}
                    <th>Opciones</th>
               </tr>
          </thead>
          <tbody>
               @if($aterrizajes->count()==0)
               <tr>
                    <td colspan="7" class="text-center">No se consiguió ningún registro</td>
               </tr>
               @endif
               @foreach($aterrizajes as $aterrizaje)
               <tr data-id='{{$aterrizaje->id}}'>
                    <td class ='fecha-td'>{{$aterrizaje->fecha }}</td>
                    <td class ='hora-td'>{{$aterrizaje->hora}}</td>
                    <td class ='aeronave_id-td'>{{$aterrizaje->aeronave->matricula}}</td>
                    <td class ='tipoMatricula_id-td'>{{$aterrizaje->tipo->nombre}}</td>
                    <td class ='puerto_id-td'>{{(($aterrizaje->puerto)?$aterrizaje->puerto->siglas:"No disponible")}}</td>
                    <td class ='num_vuelo-td'>{{(($aterrizaje->num_vuelo)?$aterrizaje->num_vuelo:"N/A")}}</td>
                    <td class ='cliente_id-td'>{{(($aterrizaje->cliente)?$aterrizaje->cliente->nombre:"No asignado")}}</td>
                    <td>
                         <div class='btn-group  btn-group-sm' role='group' aria-label='...'>
                              <a class='btn btn-success btn-sm darSalida-btn' href='{{action('DespegueController@create', [$aterrizaje->id])}}'><i class='fa fa-plane' title='Dar Salida'></i></a>
                              <button class='btn btn-warning btn-sm editarAterrizaje-btn' data-id='{{$aterrizaje->id}}' ><i class='fa fa-edit' title='Editar Información'></i></button>
                              <a class='btn btn-info btn-sm cargoAdicional-btn' href='{{action('AterrizajeController@getCrearFactura', [$aterrizaje->id])}}'><i class='fa fa-plus' title='Facturar Cargo Adicional'></i></a>
                              <button class='btn btn-danger  btn-sm eliminarAterrizaje-btn' data-id='{{$aterrizaje->id}}' ><i class='fa fa-trash' title='Eliminar Registro'></i></button>
                         </div>
                    </td>
               </tr>   
               @endforeach
          </tbody>
     </table>
</div><!-- /.table-responsive -->
<div class="row">
     <div class="col-xs-12 text-center">
          {!! $aterrizajes->appends(Input::except('page'))->render() !!}
     </div>
</div>