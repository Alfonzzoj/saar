<div class="table-responsive">     
	<table id="aterrizaje-table" class="table no-margin">
		<thead class="bg-primary">
			<tr>
                    {!!Html::sortableColumnTitle("Nombre", "nombre_cargo")!!}
                    {!!Html::sortableColumnTitle("Monto", "precio_cargo")!!}
                    {!!Html::sortableColumnTitle("Desde (Kgs.)", "peso_desde")!!}
                    {!!Html::sortableColumnTitle("Hasta (Kgs.)", "peso_hasta")!!}
                    {!!Html::sortableColumnTitle("T. Matricula", "tipo_matricula")!!}
                    {!!Html::sortableColumnTitle("N. Matricula", "nacionalidad_matricula")!!}
                    {!!Html::sortableColumnTitle("Procedencia", "procedencia")!!}
                    {!!Html::sortableColumnTitle("Tipo pago", "tipo_pago")!!}

                    <th>Opciones</th>
               </tr>
          </thead>
          <tbody>
               @foreach($otros_cargos as $otro_cargo)
               <tr data-id='{{$otro_cargo->id}}'>
                    <td class ='nombre-td'>{{$otro_cargo->nombre_cargo}}</td>
                    @if($otro_cargo->tipo_pago_id == 1)
                         <td class ='monto-td default' style="width: 100px;">{{ $traductor->format($otro_cargo->precio_cargo)}}</td>
                    @elseif($otro_cargo->tipo_pago_id == 2)
                         <td class ='monto-td internacional' style="width: 100px;">{{ $traductor->format($otro_cargo->precio_cargo)}}</td>
                    @else
                         <td class ='monto-td internacional' style="width:100px;">{{ $traductor->format($otro_cargo->precio_cargo)}}</td>
                    @endif
                    <input type="hidden" class="cantidad_unidades" value="{{ $otro_cargo->cantidad_unidades }}"></input>
                    <td class ='peso_desde-td'>{{ $otro_cargo->peso_desde}}</td>
                    <td class ='peso_hasta-td'>{{ $otro_cargo->peso_hasta}}</td>
                    <td class ='tipo_matricula-td'>{{$otro_cargo->tipo_matricula == 0 ?'Default': $tipos_matriculas[$otro_cargo->tipo_matricula] }}</td>
                    <td class ='nacionalidad_matricula-td'>{{$otro_cargo->nacionalidad_matricula == 0 ?'Default': $nacionalidades_vuelos[$otro_cargo->nacionalidad_matricula] }}</td>
                    <td class ='procedencia-td'>{{$otro_cargo->procedencia == 0 ?'Default': $nacionalidades_vuelos[$otro_cargo->procedencia] }}</td>
                    <td class ='tipo_pago-td'>{{$otro_cargo->tipo_pago->name}}</td>
                    
                    <td>
                         <button class='btn btn-warning btn-sm editarOtroCargo-btn' data-id='{{$otro_cargo->id}}' ><i class='glyphicon glyphicon-pencil' title='Editar Información'></i></button>
                         <button class='btn btn-danger btn-sm eliminarOtroCargo-btn' data-id='{{$otro_cargo->id}}' ><i class='glyphicon glyphicon-trash' title='Eliminar Registro'></i></button>
                    </td>
               </tr>   
               @endforeach
          </tbody>
     </table>
</div><!-- /.table-responsive -->
<div class="row">
     <div class="col-xs-12 text-center">
          {!! $otros_cargos->appends(Input::except('page'))->render() !!}

     </div>
</div>

<script>
     $(document).ready(function() {
          $("#aterrizaje-table tbody tr").each(function(index) {
              var monto = $(this).find('.monto-td');
              var unidades = $(this).find('.cantidad_unidades');
              if(monto.hasClass('nacional') == true){
                    var monto_total = (unidades.val() * $('#cal-unidad-tributaria').val()).toFixed(2);
                    var monto_formato = addCommas(monto_total);
                    monto.text(monto_formato);
              }else if(monto.hasClass('internacional') == true){
                    var monto_total = (unidades.val() * $('#cal-euro-oficial').val()).toFixed(2);
                    var monto_formato = addCommas(monto_total);
                    monto.text(monto_formato);
              }
          });

          function addCommas(nStr)
          {
              nStr += '';
              x = nStr.split('.');
              x1 = x[0];
              x2 = x.length > 1 ? ',' + x[1] : '';
              var rgx = /(\d+)(\d{3})/;
              while (rgx.test(x1)) {
                  x1 = x1.replace(rgx, '$1' + '.' + '$2');
              }
              return x1 + x2;
          }
     });

</script>