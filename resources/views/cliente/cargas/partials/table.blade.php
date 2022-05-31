
<div class="table-responsive">     
	<table id="carga-table" class="table no-margin">
		<thead class="bg-primary">
			<tr>
                    {!!Html::sortableColumnTitle("Fecha", "fecha")!!}
                    {!!Html::sortableColumnTitle("Cliente", "cliente_id")!!}
                    <th>Peso Embarcado</th>
                    <th>Peso Desembarcado</th>
                    <th>Monto Total</th>
                    <th>Opciones</th>
               </tr>
          </thead>
               @if($cargas->count()==0)
               <tr>
                    <td colspan="7" class="text-center">No se consiguió ningún registro</td>
               </tr>
               @endif
               @foreach($cargas as $carga)
               <tr data-id='{{$carga->id}}'>
                    <td class ='text-center fecha-td'>{{$carga->fecha}}</td>
                    <td class ='text-center cliente_id-td'>{{$carga->cliente->nombre}}</td>
                    <td class ="text-right peso_embarcado-td">{{$traductor->format($carga->peso_embarcado)}}</td>
                    <td class ="text-right peso_desembarcado-td">{{$traductor->format($carga->peso_desembarcado)}}</td>
                    <td class ="text-right peso_desembarcado-td">{{$traductor->format($carga->monto_total)}}</td>
                    <td>      
                         @if($carga->factura_id != NULL)
                        <a target="_blank" class='btn btn-default  btn-sm' href='{{action('FacturaController@getPrint', ["modulo"=>"CARGA", $carga->factura_id])}}'>
                              <span class='glyphicon glyphicon-print'></span>
                        </a>
                         @endif
                         @if($carga->factura_id == NULL)
                         <a href="{{  action('CargaController@getCrearFactura', [$carga->id])}}">
                              <button class='btn btn-info btn-sm facturaCarga-btn'><span class='fa fa-credit-card' title='Facturar'></span></button>
                         </a>                              
                         <button class='btn btn-warning btn-sm editarCarga-btn' data-id='{{$carga->id}}' ><i class='fa fa-edit' title='Editar Información'></i></button>
                         @endif
                         <button class='btn btn-success btn-sm verCarga-btn'><span class='glyphicon glyphicon-eye-open' title='Ver Información'></span></button>
                    </td>
               </tr>   
               @endforeach
          </tbody>
     </table>
</div><!-- /.table-responsive -->
<div class="row">
     <div class="col-xs-12 text-center">
          {!! $cargas->appends(Input::except('page'))->render() !!}
     </div>
</div>
