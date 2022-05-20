<div class="table-responsive">     
	<table id="aeronave-table" class="table no-margin">
		<thead class="bg-primary">
			<tr>
                    {!!Html::sortableColumnTitle("Matrícula", "matricula")!!}
                    {!!Html::sortableColumnTitle("Nacionalidad", "nacionalidad_id")!!}
                    {!!Html::sortableColumnTitle("Tipo", "tipo_id")!!}
                    {!!Html::sortableColumnTitle("Modelo", "modelo_id")!!}
                    {!!Html::sortableColumnTitle("Peso", "peso")!!}
                    {!!Html::sortableColumnTitle("Cliente", "cliente_id")!!}
                    {!!Html::sortableColumnTitle("Hangar", "hangar_id")!!}
                    <th>Opciones</th>
               </tr>
          </thead>
          <tbody>
               @if($totalAeronaves==0)
               <tr>
                    <td colspan="8" class="text-center">No se consiguió ningun registro</td>
               </tr>
               @else           
                    <h6 class="table-info pull-right">Total de Registros: {{$totalAeronaves}}</h6>
               @endif
               @foreach($aeronaves as $aeronave)
               <tr data-id='{{$aeronave->id}}'>
                    <td class ='matricula-td'>{{$aeronave->matricula}}</td>
                    <td class ='matricula-td'>{{$aeronave->nacionalidad->nombre}}</td>
                    <td class ='tipo_id-td'>{{$aeronave->tipo->nombre}}</td>
                    <td class ='tipo_id-td'>{{$aeronave->modelo->modelo}}</td>
                    <td class ='peso-td'>{{$aeronave->peso}}</td>
                    <td class ='cliente_id-td'>{{(($aeronave->cliente)?$aeronave->cliente->nombre:"No asignado")}}</td>
                    <td class ='hangar_id-td'>{{(($aeronave->hangar)?$aeronave->hangar->nombre:"No asignado")}}</td>
                    <td>
                         <button class='btn btn-warning btn-sm editarAeronave-btn' data-id='{{$aeronave->id}}' ><i class='glyphicon glyphicon-pencil' title='Editar Información'></i></button>
                         <button class='btn btn-danger  btn-sm eliminarAeronave-btn' data-id='{{$aeronave->id}}' ><i class='glyphicon glyphicon-trash' title='Eliminar Registro'></i></button>
                    </td>
               </tr>   
               @endforeach
          </tbody>
     </table>
</div><!-- /.table-responsive -->
<div class="row">
     <div class="col-xs-12 text-center">
          {!! $aeronaves->appends(Input::except('page'))->render() !!}
     </div>
</div>