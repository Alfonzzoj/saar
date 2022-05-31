<div class="table-responsive">
	<table id="fbos-table" class="table no-margin">
		<thead class="bg-primary">
			<tr>
                    {!!Html::sortableColumnTitle("Nombre", "Nombre")!!}
                    <th>Opciones</th>
               </tr>
          </thead>
          <tbody>
           @if($totalFbos==0)
                <tr>
                     <td colspan="7" class="text-center">No se consiguió ningún registro</td>
                </tr>
           @else           
                    <h6 class="table-info pull-right">Total de Registros: {{$totalFbos}}</h6>
            @endif
               @foreach($fbos as $fbo)
               <tr data-id='{{$fbo->id}}'>
                    <td class='fbo-td'>{{$fbo->nombre}}</td>
                    <td>
                         <button class='btn btn-warning btn-sm editarfbo-btn' data-id="{{$fbo->id}}" ><span class='glyphicon glyphicon-pencil'></span></button>
                         <button class='btn btn-danger btn-sm eliminarfbo-btn' data-id="{{$fbo->id}}" ><span class='glyphicon glyphicon-trash'></span></button>
                    </td>
               </tr>   
               @endforeach
          </tbody>
     </table>
</div><!-- /.table-responsive -->
<div class="row">
     <div class="col-xs-12 text-center">
          {{-- {!! $fbos->appends(Input::except('page'))->render() !!} --}}
     </div>
</div>