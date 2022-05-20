@extends('app')
@section('content')

<ol class="breadcrumb">
  <li><a href="{{url('principal')}}">Inicio</a></li>
  <li><a href="{{ URL::to('cobranza/Todos/main') }}">Cobranza</a></li>
  <li><a class="active">Cobranza - {{$moduloName}}</a></li>
</ol>

<div class="row" id="box-wrapper">
	<!-- left column -->
	<div class="col-md-12">
		<!-- general form elements -->
		<div class="box box-primary" id="main-box">
			<div class="box-header">
				<h3 class="box-title">Cobranza</h3>
			</div><!-- /.box-header -->
			<!-- form start -->

			<div class="box-body"  id="container">
				<div class="form-horizontal">
					<div class="form-group">
						<label for="cliente-select" class="control-label col-xs-1">Cliente</label>
						<div class="col-xs-5">
							<select class="form-control" id="cliente-select" autocomplete="off">
								<option value="">--Seleccione una Opción--</option>
								@foreach($clientes as $cliente)
								<option
									data-id="{{$cliente->cliente_id}}"
									data-nombre="{{$cliente->nombre}}"
									data-ced-rif="{{$cliente->cedRif}}"
									data-ced-rif-prefix="{{$cliente->cedRifPrefix}}"
									data-islr="{{$cliente->islrpercentage}}"
									data-iva="{{$cliente->ivapercentage}}"
									data-is-contribuyente="{{$cliente->isContribuyente}}"
									data-condicion="{{$cliente->condicionPago}}"
									value="{{$cliente->codigo}}">
									{{$cliente->codigo}} | {{$cliente->nombre}}
								</option>
								@endforeach
							</select>
						</div>
						<div class="col-xs-3">
							<input class="form-control" id="cliente_nombre-input" readonly autocomplete="off">
						</div>
						<div class="col-xs-3">
							<input class="form-control" id="cliente_cedRif-input" readonly autocomplete="off">
						</div>
					</div>
				</div>
				<h5>Cuentas por Cobrar</h5>
				<div class="row">
					<div class="col-xs-2 col-xs-offset-8 text-right">
						<select class="form-control" id="type-rows-cxc-table-wrapper-select">
							<option value="t">Todas</option>
							<option value="s">Seleccionadas</option>
							<option value="n">No seleccionadas</option>
						</select>
					</div>
					<div class="col-xs-2 text-right">
						<select class="form-control" id="max-rows-cxc-table-wrapper-select" autocomplete="off">
							<option>5</option>
							<option>10</option>
							<option>25</option>
							<option>50</option>
						</select>
					</div>
				</div>

<!--Poner un input pegado al boton de retencion que muestre el total de retencion
	Poner subtotal de la operacion del saldo abonado y la retencion -->
	            <div class="table-responsive" id="cxc-table-wrapper" style="margin-top:15px; margin-bottom:15px">
		            <table class="table table-condensed text-center" id="cxc-table">
			            <thead class="bg-primary">
				            <th style="min-width:120px"># Fac/Doc</th>
				            <th style="min-width:120px"># Control</th>
				            <th style="min-width:120px">Fecha Emisión</th>
				            <th style="min-width:120px">Monto Documento</th>
				            <th style="min-width:120px">Saldo Cancelado</th>
				            <th style="min-width:120px">Saldo Pendiente</th>

				            <th style="min-width:120px">Retención</th>
				            <th style="min-width:120px">Saldo a Pagar</th>
				            <th style="min-width:120px">Saldo Abonado</th>
				            <th style="min-width:120px">Saldo Restante</th>
				            <th style="min-width:200px">Acción</th>
			            </thead>
			            <tbody>
			            </tbody>
		            </table>
	            </div> 
				<div class="form-inline" style="margin-bottom: 30px"> 
					<div class="form-group">
					<label style="font-weight: bold;" >Recibo de Caja: </label>
						<div class="input-group">
							<input type="text" id="nRecibo-input" name="nRecibo" class="form-control" placeholder="Número"/>
						</div><!-- /.input group -->
					</div>  
					<div class="form-group">
					<label style="font-weight: bold;" >Fecha: </label>
						<div class="input-group">
							<input type="text" id="fecha-datepicker" data-inputmask="'alias': 'dd/mm/yyyy'" name="fecha" class="form-control" placeholder="Fecha" value="{{$today->format('d/m/Y')}}"/>
						</div><!-- /.input group -->
					</div>                          
		            <div class="form-group pull-right">
			            <label for="total-a-pagar-doc-input" class="col-sm-6 control-label"><h5>Total a Cobrar</h5></label>
			            <div class="col-sm-6">
				            <input autocomplete="off" type="text" class="form-control total-a-pagar-doc-input" style="font-weight: bold;" readonly value="0,00">
			            </div>
		            </div>
				</div>

	            <div class="row">
		            <div class="col-xs-12">
			            <label>Leyenda:[<span class="text-success">Pago Completo</span> |
			            				<span class="text-info">Sobrepagado</span> | 
			            				<span class="text-warning">Pago Parcial</span> | 
			            				<span class="text-danger">Error en Saldo Ingresado</span>]
			            </label>
 			            <div  class="pull-right">
							<div class="col-sm-1" style="margin-right: 20px">
								<div class="round round hollow blue">
							        <span id="contador" style="font-weight: bold; font-size: 15px">0</span>
							    </div>
							</div>
	 			            <label id="items-seleccionados-label" class="text-primary" style="font-weight: bold; margin-top: 3px; margin-right: -30px; font-size: 15px">
	 			            	 Facturas Seleccionadas
	 			            </label>
	 			        </div>
 		            </div>

	            </div>
	            <h5>Formas de Pago</h5>
	            <div class="row">
		            <div class="col-xs-12 text-right"> 
			            <button class="btn btn-primary register-payment-btn"><span class="glyphicon glyphicon-plus"></span> Registrar Pago</button> 
		            </div> 
	            </div> 
	            <div class="table-responsive" style="margin-top:15px;margin-bottom:15px">
		            <table id="formas-pago-table" class="table table-condensed text-center">
			            <thead class="bg-primary">
				            <th>Fecha</th>
				            <th>Banco</th> 
				            <th>Cuenta</th>
				            <th>Forma de Pago</th>
				            <th>#Depósito/#Lote</th>
				            <th>Monto</th>
				            <th>Acción</th>
			            </thead> 
			            <tbody>

			            </tbody>
		            </table>
	            </div>

	            <div class="row">
		            <div class="col-xs-12">
			            <div class="form-horizontal">
				            <div class="form-group">
					            <label for="inputEmail3" class="col-sm-2 control-label">Observaciones</label>
					            <div class="col-sm-9">
						            <textarea id="observaciones-documento" class="form-control" row="5"></textarea>
					            </div>
				            </div>
			            </div>
		            </div>
	            </div>
	            <div class="row">
		            <div class="col-xs-12">
			            <div class="form-horizontal">
				            <div class="form-group">
					            <label for="total-a-pagar-doc-input" class="col-sm-2 control-label">Total a Cobrar</label>
					            <div class="col-sm-2">
						            <input autocomplete="off" type="text" class="form-control total-a-pagar-doc-input" readonly value="0,00">
					            </div>
					            <label for="total-diferencia-doc-input" class="col-sm-2 control-label">Diferencia</label>
					            <div class="col-sm-2">
						            <input autocomplete="off" type="text" class="form-control" id="total-diferencia-doc-input" readonly value="0,00">
					            </div>
					            <label for="total-a-depositar-doc-input" class="col-sm-2 control-label">Total Depositado</label>
					            <div class="col-sm-2">
						            <input autocomplete="off" type="text" class="form-control" id="total-a-depositar-doc-input" readonly value="0,00">
					            </div>
				            </div>
			            </div>
		            </div>
	            </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
            <!--                 Se debe validar que el monto a cobrar y el monto depositado sean iguales, mostrar un alert de confirmacion
            -->               
                <div class="row">
	                <div class="col-xs-6">
		                <div class="checkbox">
			                <label>
				                <input type="checkbox" checked id="hasrecaudos-check"> Recaudos Conciliados
			                </label>
		                </div>
	                </div>
	                <div class="col-xs-6 text-right">
		                <button  class="btn btn-primary" id="save-cobro-btn">Guardar</button>
	                </div>
                </div><!-- /.box -->
            </div>
        </div>
    </div>
</div>

@include('cobranza.partials.cuotaModal')
@include('cobranza.partials.pagoModal')
@include('cobranza.partials.retencionModal')

@endsection


@section('script')
<script>

    $(document).ready(function(){

        @include('cobranza.partials.script')

        //Datemask dd/mm/yyyy
        $('#fecha-datepicker').inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});

		$('#fecha-datepicker').datepicker({
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
			dateFormat: 'yy-mm-dd'});

        $('#save-cobro-btn').click(function(){

			var pagar     =commaToNum($('.total-a-pagar-doc-input').first().val());
			var depositar =commaToNum($('#total-a-depositar-doc-input').val());
			var ajuste    =commaToNum($('#ajuste-input').val());
			var nRecibo   =$('#nRecibo-input').val();
			var fecha     =$('#fecha-datepicker').val();
			var condicion =$('#cliente-select option:selected').data("condicion");


		    /*if(nRecibo=='' && condicion=="Crédito"){
				alertify.error("Número de Recibo de Caja es requerido.");
				return;
		    }*/
            if(pagar>depositar){
                alertify.error("El monto a cobrar no puede ser mayor al depositado.");
                return;
            }
            if(pagar==0 || depositar==0){
                alertify.error("El monto a cobrar o depositado no pueden ser cero.");
                return;
            }
            if(ajuste>0){
                var ajusteMaximo=parseFloat(
                	$('.ajuste-row').find('.saldo-pagar').text());
                if(ajuste>numToComma(ajusteMaximo)){
                	console.log(ajuste, ajusteMaximo);
                    alertify.error("El ajuste no puede superar " +ajusteMaximo+ "Bs.");
                    return;
                }
            }
            var facturas=[];
            var trs=$('#cxc-table tbody').find('tr.success, tr.info, tr.warning').not('.ajuste-row');
            $.each(trs, function(index,value){
				var retencionInput       =$(value).find('.retencion-pagar');
				var isrlModal            =$(retencionInput).data('islrModal');
				var ivaModal             =$(retencionInput).data('ivaModal');
				var retencionFecha       =$(retencionInput).data('retencionFecha');
				var retencionComprobante =$(retencionInput).data('retencionComprobante');
				isrlModal                =(isrlModal===undefined)?0:isrlModal;
				ivaModal                 =(ivaModal===undefined)?0:ivaModal;
				retencionFecha           =(retencionFecha===undefined)?0:retencionFecha;
				retencionComprobante     =(retencionComprobante===undefined)?0:retencionComprobante
                var o={
                    id:$(value).data('id'),
                    montoAbonado: commaToNum($(value).find('.saldo-abonado-input').val()),
                    islrpercentage:isrlModal,
                    ivapercentage:ivaModal,
                    retencionFecha:retencionFecha,
                    retencionComprobante:retencionComprobante
                }

                facturas.push(o);
            });

            var pagos=[];
            $('#formas-pago-table tbody tr').each(function(index,value){
                pagos.push($(value).data('object'));
            })
            console.log(facturas);

            addLoadingOverlay('#main-box');
            console.log("AJUSTE: " + ajuste);
            $.ajax({
                method:'POST',
                data:{
                    facturas:facturas,
                    pagos:pagos,
                    cliente_id: $('#cliente-select option:selected').data("id"),
                    totalFacturas:$('.total-a-pagar-doc-input').first().val() ,
                    totalDepositado:$('#total-a-depositar-doc-input').val(),
                    observacion:$('#observaciones-documento').val(),
                    hasrecaudos:$('#hasrecaudos-check').prop('checked'),
                    ajuste:ajuste,
                    modulo_id:'{{$id}}',
                    nRecibo:$('#nRecibo-input').val(),
                    fecha:$('#fecha-datepicker').val()
                },
                url: "{{action('CobranzaController@store')}}"
            }).done(function(data, status, jx){
                try{
                    var response=JSON.parse(jx.responseText);
                    if(response.success==1){
						alertify.success("Cobranza realizada con éxito.");
						alertify.confirm("¿Desea imprimir el Recibo de Caja", function (e) {
							if (e) {
							    window.open(response.impresion, '_blank');
								alertify.log("Se emitió orden de impresion");
							}
                        setTimeout(
                            function()
                            {
                                location.reload();
                            }, 2000);
                    });
                   }
                }catch(e){
                    removeLoadingOverlay('#main-box');
                    alertify.error("Error en el servidor");
                }


            })
        })
    });


</script>

@endsection
