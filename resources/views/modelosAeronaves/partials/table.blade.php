<div class="table-responsive">
	<table id="modelos-table" class="table no-margin">
		<thead class="bg-primary">
			<tr>
                    {!!Html::sortableColumnTitle("Modelo", "modelo")!!}
                    {!!Html::sortableColumnTitle("Peso Máximo (Kgs.)", "peso_maximo")!!}
                    {!!Html::sortableColumnTitle("Tipo de Aeronave", "tipo_id")!!}
                    <th>Opciones</th>
               </tr>
          </thead>
          <tbody>
           @if($totalModelosAeronaves==0)
                <tr>
                     <td colspan="7" class="text-center">No se consiguió ningún registro</td>
                </tr>
           @else           
                    <h6 class="table-info pull-right">Total de Registros: {{$totalModelosAeronaves}}</h6>
            @endif
               @foreach($modelos as $modelo)
               <tr data-id='{{$modelo->id}}'>
                    <td class='modelo-td'>{{$modelo->modelo}}</td>
                    <td class='peso_maximo-td'>{{$modelo->peso_maximo}}</td>
                    <td class='tipo_id-td'>{{$modelo->tipo->nombre}}</td>
                    <td>
                         <button class='btn btn-warning btn-sm editarModelo-btn' data-id="{{$modelo->id}}" ><span class='glyphicon glyphicon-pencil'></span></button>
                         <button class='btn btn-danger btn-sm eliminarModelo-btn' data-id="{{$modelo->id}}" ><span class='glyphicon glyphicon-trash'></span></button>
                    </td>
               </tr>   
               @endforeach
          </tbody>
     </table>
</div><!-- /.table-responsive -->
<div class="row">
     <div class="col-xs-12 text-center">
          {!! $modelos->appends(Input::except('page'))->render() !!}
     </div>
</div>