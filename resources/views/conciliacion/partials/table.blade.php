<div class="table-responsive">     
	<table id="conciliacion-table" class="table no-margin">
		<thead class="bg-primary">
			<tr>
                    {!!Html::sortableColumnTitle("Fecha Banco", "fecha_banco")!!}
                    {!!Html::sortableColumnTitle("Fecha Conciliación", "fecha_conciliacion")!!}
                    {!!Html::sortableColumnTitle("Banco", "nombre")!!}
                    {!!Html::sortableColumnTitle("Cuenta", "descripcion")!!}
                    {!!Html::sortableColumnTitle("Referencia", "ncomprobante")!!}
                    {!!Html::sortableColumnTitle("Monto Lote", "monto_lote")!!}
                    {!!Html::sortableColumnTitle("Comisión Bancaria", "comision_bancaria")!!}
                    {!!Html::sortableColumnTitle("Monto Banco", "monto_banco")!!}
                    <th>Opciones</th>
               </tr>
          </thead>
          <tbody>
               @if($conciliados->count()==0)
               <tr>
                    <td colspan="6" class="text-center">No se consiguió ningún registro</td>
               </tr>
               @endif
               @foreach($conciliados as $conciliado)
               <tr data-id='{{$conciliado->id}}'>
                    <td class ='fecha_banco-td'>{{ date("d-m-Y", strtotime($conciliado->fecha_banco)) }}</td>
                    <td class ='fecha_conciliacion-td'>{{ date("d-m-Y", strtotime($conciliado->fecha_conciliacion)) }}</td>
                    <td class ='banco-td'>{{$conciliado->nombre }}</td>
                    <td class ='cuenta-td'>{{$conciliado->descripcion }}</td>
                    <td class ='referencia-td'>{{$conciliado->ncomprobante }}</td>
                    <td class ='monto_lote-td'>{{  $traductor->format($conciliado->monto_lote)  }}</td>
                    <td class ='comision_bancaria-td'>{{ $traductor->format($conciliado->comision_bancaria) }}</td>
                    <td class ='monto_banco-td'>{{ $traductor->format($conciliado->monto_banco) }}</td>

                    <td>
                         <div class='btn-group  btn-group-sm' role='group' aria-label='...'>
                              <button class='btn btn-primary' data-id="{{$conciliado->id}}" data-toggle="modal" data-target="#show-modal"><span class='glyphicon glyphicon-eye-open'></span></button>
                              <button class='btn btn-danger  btn-sm eliminarConciliacion-btn' data-id='{{$conciliado->id}}' ><i class='fa fa-trash' title='Eliminar Registro'></i></button>
                         </div>
                    </td>
               </tr>   
               @endforeach
               <br>
          <tr style="font-weight: bold">
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>Total</td>
              <td>{{ $traductor->format($conciliadosLot) }}</td>
              <td>{{ $traductor->format($conciliadosDif) }}</td>
              <td>{{ $traductor->format($conciliadosTotal) }}</td>
              <td></td>
          </tr>
          </tbody>
     </table>
</div><!-- /.table-responsive -->
@if(($fecha_desde == "" && $fecha_hasta == ""))
<div class="row">
     <div class="col-xs-12 text-center">
         {!! $conciliados->appends(Input::except('page'))->render() !!}
     </div>
</div>
@endif

<script>
        var im = false;


        $('#export-btn').click(function(e){

        if ($('#conciliacion-table tr').length > 1 && !im) {
            $("#conciliacion-table th:last-child, #conciliacion-table td:last-child").remove();
            im = true;
        }

        var table=$('#conciliacion-table').clone();

        $(table).find('td, th').filter(function() {
            return $(this).css('display') == 'none';
        }).remove();
        $(table).find('tr').filter(function() {
            return $(this).find('td,th').length == 0;
        }).remove();

            $(table).prepend('<thead>\
								<tr>\
									<th colspan="16" style="vertical-align: middle; margin-top:20px" align="center" class="text-center">REPORTE DE CONCILIACIÓN\
										</br>\
										@if(!($fecha_desde == "" && $fecha_hasta == ""))
										    FECHA DESDE: {{ $fecha_desde }} HASTA: {{ $fecha_hasta }}\
										    </br>\
										@endif
		                    			{{session('aeropuerto')->nombre}}\
									</th>\
								</tr>\
							</thead>');

        $(table).find('thead th').css({'width': '175px','border-bottom':'1px solid black', 'font-weight': 'bold', 'text-align':"center", 'font-size': '16px'});
        $(table).find('td').css({'width': '175px', 'text-align':"center", 'font-size': '14px'});
        $(table).find('td:nth-child( 6 )').css({'text-align':"right"});
        $(table).find('td:nth-child( 7 )').css({'text-align':"right"});
        $(table).find('td:nth-child( 8 )').css({'text-align':"right"});

        //$(table).find('tr:last td').css({'border-bottom':'1px solid black','border-top':'1px solid black', 'font-weight': 'bold'});

        //$(table2).find('tr:last td').css({'border-bottom':'1px solid black','border-top':'1px solid black', 'font-weight': 'bold'});
        var tableHtml= $(table)[0].outerHTML;
        $('[name=table]').val(tableHtml);
        $('#export-form').submit();
    })
</script>