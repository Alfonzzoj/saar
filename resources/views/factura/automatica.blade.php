@extends('app')
@section('content')
<ol class="breadcrumb">
	<li><a href="{{url('principal')}}">Inicio</a></li>
	<li><a href="{{action('FacturaController@main', ["Todos"])}}">Facturación Principal</a></li>
	<li><a class="active">Facturación {{$modulo->nombre}}</a></li>
</ol>
 <div class="row" id="box-wrapper">
 	<!-- left column -->
 	<div class="col-md-12">
 		<!-- general form elements -->
 		<div class="box box-primary" id="main-box">
 			<div class="box-header">
 				<h3 class="box-title"></h3>
 			</div><!-- /.box-header -->
 			<!-- form start -->

 			<div class="box-body"  id="container">

 				<div class="row">

 					<div class="col-xs-12">
 						<div style="padding:0px 30px 0px 0px">
 							<div class="panel panel-default">
 								<div class="panel-body">
 									<div class="container-fluid">

 										<div class="form-group">
 											<label for="active-input">Año</label>
 											<select class="form-control search-parm-select" id="year-select" autocomplete="off">
	 											@foreach ($annos as $index => $anno)
	 												<option value="{{$index}}" {{($index==$fecha->year)?"selected":""}}>{{ $anno }}</option>
	 											@endforeach
 											</select>
 										</div>
 										<div class="form-group">
 											<label for="active-input">Mes</label>
 											<select class="form-control search-parm-select" id="month-select" autocomplete="off">
 												@foreach ($meses as $index => $mes)
	 												<option value="{{$index}}" {{($index==$fecha->month)?"selected":""}}>{{ $mes }}</option>
	 											@endforeach
 											</select>
 										</div>
 										<div class="row form-group">
                                            <div class="col-md-8">
                                                <label for="Femision-input">Seleccione las facturas a crear (Numero Contrato | Codigo Cliente | Nombre Cliente | Monto)</label>
                                            </div>
                                            <div class="col-md-4 text-right">
                                                <button type="button" class="btn btn-default" id="select-all-btn">Seleccionar todos</button>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div id="contratos-wrapper">

                                                @include('factura.partials.automaticaContratos', compact('contratos', 'fecha'))
                                            </div>
 										</div>
<!--                                         <div class="form-group">
                                            <div class="input-group">
                                                <input class="form-control" id="cantidad-items-input" value="0"/>
                                            </div>
                                        </div> -->
                                        <label for="active-input">Contratos seleccionados</label>
                                        <div class="form-inline">
                                            <label for="active-input">Número de control</label>
     										<div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-btn">
                                                        <button style="max-height:37px" type="button" class="btn btn-default"><span class="nControlPrefix-text">{{$modulo->nControlPrefix}}</span></button>
                                                    </div>
     											    <input class="form-control" id="nc-general-input" value="{{\App\Factura::getMaxWith('nControlPrefix', 'nControl', $modulo->nControlPrefix)}}"/>
                                                </div>
     										</div>
                                            <label for="active-input">Número de factura</label>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-btn">
                                                        <button style="max-height:37px" type="button" class="btn btn-default"><span class="nControlPrefix-text">{{$modulo->nFacturaPrefix}}</span></button>
                                                    </div>
                                                    <input
                                                    class="form-control" 
                                                    id="nf-general-input" 
                                                    value="{{\App\Factura::getMaxWith('nFacturaPrefix', 'nFactura', $modulo->nFacturaPrefix)}}"/>
                                                </div>
                                            </div>
     										<label for="active-input">Fecha de Facturación</label>
     										<div class="form-group">
                                                <div class="input-group">
     											    <input class='form-control datepicker today' id="today-input" value="{{$today->format('d/m/Y')}}" /></td>
                                                </div>
     										</div>
                                        </div>
 										<button type="submit" class="btn btn-primary pull-right" style="margin-top: 10px" id="generar-btn">Generar</button>

 									</div>
 								</div>
 							</div>

 						</div>

 					</div>
 					<div class="col-xs-12">

 						<table class="table" id="fac-table">
 							<thead>
 								<th>Fecha Emisión</th>
                                <th style="width:150px">Nro. Factura</th>
                                <th style="width:150px">Nro. Control</th>
                                <th class="text-left">Cliente </th>
                                <th>Nro. Contrato </th>
                                <th class="text-right">Monto</th>
                                <th class="text-right">IVA</th>
                                <th class="text-right">Total</th>
<!--  								<th>Fecha de vencimiento</th> -->
 								<th>Acción</th>
 							</thead>
 							<tbody>
 							</tbody>



 						</table>

 					</div>



 				</div>
 			</div><!-- /.box-body -->
 			<div class="box-footer">
 				<button class="btn btn-primary pull-right" id="guardar-btn"> Guardar </button>
 			</div>
 		</div><!-- /.box -->
 	</div>
 </div>

@endsection
@section('script')
 <script>
    function tooltipOnDisabledChecks(){
      $('input[type="checkbox"][disabled]').each(function(index, value){
        $(value).closest('label').tooltip({
            title: "Ya existe una factura automatica para este contrato en la fecha seleccionada."
        })
      })

    }

 	$(document).ready(function(){
        tooltipOnDisabledChecks()
        $('.search-parm-select').change(function(){
            var year=$("#year-select").val();
            var month=$("#month-select").val();
            $.ajax({
                method:'POST',
                url:"{{action('FacturaController@postContratosByFecha', [$modulo->nombre])}}",
                data:{year:year, month:month}
            }).always(function(data, status){
                if(status!="error"){
                  $('#contratos-wrapper').html(data);
                  $('input[type="checkbox"]').iCheck({
                    checkboxClass: 'icheckbox_flat-blue',
                    radioClass: 'iradio_flat-blue'
                  });
                    tooltipOnDisabledChecks()
                }
                else
                    console.log(data, status);
            })
        });


      $('.datepicker').datepicker({
        closeText: 'Cerrar',
        prevText: '&#x3C;Ant',
        nextText: 'Sig&#x3E;',
        currentText: 'Hoy',
        monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
        'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
        'Jul','Ago','Sep','Oct','Nov','Dic'],
        dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
        dayNamesMin: ['D','L','M','M','J','V','S'],
        weekHeader: 'Sm',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: '',
        dateFormat: "dd/mm/yy"});
          $('.today').on('changeDate', function(e){
            $(this).closest('tr').find('.ffin').val(moment(e.date).add(1, 'M').format("DD/MM/YYYY"));
          });

        $('#select-all-btn').click(function(){
            var $unCheckedChecks=$('#contratos-wrapper [type=checkbox]:not(:disabled):not(:checked)');
            console.log($unCheckedChecks);
            if($unCheckedChecks.length==0)
                $('#contratos-wrapper [type=checkbox]:not(:disabled)').iCheck('uncheck');
            else
                $('#contratos-wrapper [type=checkbox]:not(:disabled)').iCheck('check');

        });

 		$('#generar-btn').click(function(){
 			$('#fac-table tbody tr').remove();
             var tr ="";
             var nc =parseInt($('#nc-general-input').val());
             nc     =isNaN(nc)?"":nc;
             var nf =parseInt($('#nf-general-input').val());
             nf     =isNaN(nf)?"":nf;
 			$('#contratos-wrapper').find('[type=checkbox]:checked').each(function(){
             var monto                =$(this).data('monto');
             var fechaControlContrato =$(this).data('fechaControlContrato');
             var today                =$('#today-input').val();
             var ffin                 =$(this).data('ffin');
             var concepto_id          =$(this).data('concepto_id');
             var cliente_id           =$(this).data('cliente_id');
             var cliente_codigo       =$(this).data('cliente_codigo');
             var cliente_nombre       =$(this).data('cliente_nombre');
             var contrato_id          =$(this).data('contrato_id');
             var iva                  =$(this).data('conceptoIva');
             var total                =$(this).data('total');
             var montoiva             =$(this).data('concepto-montoiva');

 				tr+=" <tr " +
 				 "data-concepto_id='" + concepto_id+"' "+
                 "data-n-factura-prefix='{{$modulo->nFacturaPrefix}}' "+
 				 "data-n-factura='"+nf+"' "+
 				 "data-n-control-prefix='{{$modulo->nControlPrefix}}' "+
 				 "data-n-control='"+nc+"' "+
                 "data-fecha-control-contrato='" + fechaControlContrato+"' "+
 				 "data-fecha='" + today+"' "+
 				 "data-fecha-vencimiento='" + ffin+"' "+
 				 "data-cliente_id='" + cliente_id+"' "+
 				 "data-contrato_id='" + contrato_id+"' "+
                 "data-modulo_id='{{$modulo->id}}' "+
                 "data-monto='" + numToComma(monto)+"' "+
 				     ">" +
                        " <td class='text-justify'><input class='form-control datepicker today' value='"+today+"' /></td>" +
                        "<td class='text-justify'>" +
                            '<div class="input-group">'+
                                '<div class="input-group-btn">'+
                                    '<button style="max-height:37px" type="button" class="btn btn-default"><span class="nControlPrefix-text">{{$modulo->nFacturaPrefix}}</span></button>'+
                                '</div>'+
                                "<input class='form-control nf-input' autocomplete='off' value='"+((nf=="")?"":(nf++))+"' data-toggle='tooltip' data-placement='top' title='El numero de factura es solo informativo. Ya que puede variar cuando se cree una factura.'/> " +
                            "</div>"+
                        "</td>" +
                        "<td class='text-justify'>" +
                            '<div class="input-group">'+
                                '<div class="input-group-btn">'+
                                    '<button style="max-height:37px" type="button" class="btn btn-default"><span class="nControlPrefix-text">{{$modulo->nControlPrefix}}</span></button>'+
                                '</div>'+
                                "<input class='form-control nc-input' autocomplete='off' value='"+((nc=="")?"":(nc++))+"'/> " +
                            "</div>"+
                        "</td>" +
                        " <td style='align:left'>"+
                            cliente_codigo+"|"+cliente_nombre+
                        "</td> " +
                        " <td class='text-justify'>"+
                            $(this).val()+
                        "</td> " +
                        "<td class='text-right'>"+numToComma(monto)+"</td>" +
                        "<td class='text-right'>"+numToComma(montoiva)+"</td>" +
                        "<td class='text-right'>"+numToComma(total)+"</td>" +
                        " <td>" +
                            " <div class='btn-group  btn-group-sm' role='group' aria-label='...'>" +
                                " <button class='btn btn-danger eliminar-btn'><span class='glyphicon glyphicon-remove'></span></button>" +
                            " </div>" +
                        " </td>" +
                    " </tr>";
 			});

 			$('#fac-table tbody').append(tr);
 			$('[data-toggle="tooltip"]').tooltip()
 			  $('.datepicker').datepicker({
                closeText: 'Cerrar',
                prevText: '&#x3C;Ant',
                nextText: 'Sig&#x3E;',
                currentText: 'Hoy',
                monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
                'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
                'Jul','Ago','Sep','Oct','Nov','Dic'],
                dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
                dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
                dayNamesMin: ['D','L','M','M','J','V','S'],
                weekHeader: 'Sm',
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: '',
                dateFormat: "dd/mm/yy"});
                  $('.today').on('changeDate', function(e){
                    $(this).closest('tr').find('.ffin').val(moment(e.date).add(1, 'M').format("DD/MM/YYYY"));
                  });
 		})

 		$('#fac-table').delegate('.eliminar-btn','click',function(){
 			$(this).closest('tr').remove();
 		})

 		$('#guardar-btn').click(function(){
 		    var $trs =$('#fac-table tbody tr');
 		    if($trs.length==0){
 		        alertify.error("No se ha seleccionado ningun contrato")
 		        return;
 		    }
            var facturas=[];
            $trs.each(function(index, value){
                $(value).data('nFactura', $(value).find('.nf-input').val());
                $(value).data('fecha', $(value).find('.today').val());
                $(value).data('fechaVencimiento', $(value).find('.ffin').val());
                facturas.push($(value).data());
            })

            alertify.confirm("Las facturas emitidas se crearan con el iva denotado en el modulo de concepto." +
            "Esta seguro de su seleccion?", function (e) {
                if (e) {
                    addLoadingOverlay('#main-box');
                    $.ajax({
                    method:'POST',
                    url:"{{action('FacturaController@postContratosStoreAutomatica', [$modulo->nombre])}}",
                    data:{facturas:facturas}
                    }).always(function(data, status){
                        removeLoadingOverlay('#main-box');
                        if(status!="error"){
                            location.replace("{{action('FacturaController@getContratosAutomaticaResult', [$modulo->nombre])}}")
                        }
                        else{
                            alertify.error("Se produjo un error en el servidor.");
                            console.log(data, status);
                        }
                    })
                }
            });
 		})
        $('[data-toggle="tooltip"]').tooltip()
 	});


</script>

@endsection