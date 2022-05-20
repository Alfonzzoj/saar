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
						    <input type="hidden" id="cliente_id-input" value="{{$cobro->cliente->id}}">
						    <input class="form-control" id="cliente-input" readonly autocomplete="off" value="{{$cobro->cliente->codigo}} | {{$cobro->cliente->nombre}}">
						</div>
						<div class="col-xs-3">
							<input class="form-control" id="cliente_nombre-input" readonly autocomplete="off" value="{{$cobro->cliente->nombre}}">
						</div>
						<div class="col-xs-3">
							<input class="form-control" id="cliente_cedRif-input" readonly autocomplete="off" value="{{$cobro->cliente->cedRifPrefix}}{{$cobro->cliente->cedRif}}">
						</div>
					</div>
				</div>
				<h5>Cuentas por cobrar</h5>
				<!--<div class="row">
					<div class="col-xs-2 col-xs-offset-8 text-right">
						<select class="form-control" id="type-rows-cxc-table-wrapper-select">
							<option value="t">Todas</option>
							<option value="s">Seleccionadas</option>
							<option value="n">No seleccionadas</option>
							<option>Vencidas??</option>
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
				</div>-->

<!--Poner un input pegado al boton de retencion que muestre el total de retencion
	Poner subtotal de la operacion del saldo abonado y la retencion -->
	            <div class="table-responsive" id="cxc-table-wrapper" style="margin-top:15px; margin-bottom:15px">
		            <table class="table table-condensed text-center" id="cxc-table">
			            <thead class="bg-primary">
				            <th style="min-width:120px"># Fac/Doc</th>
				            <th style="min-width:120px"># Control</th>
				            <th style="min-width:120px">Fecha emisión</th>
				            <th style="min-width:120px">Monto documento</th>
				            {{-- <th style="min-width:120px">Saldo Cancelado</th> --}}
				            {{-- <th style="min-width:120px">Saldo Pendiente</th> --}}

				            <th style="min-width:120px">Retencion</th>
				            <th style="min-width:120px">Saldo a pagar</th>
				            <th style="min-width:120px">Opciones</th>
				            {{-- <th style="min-width:120px">Saldo Abonado</th> --}}
				            {{-- <th style="min-width:120px">Saldo Restante</th> --}}
				            {{-- <th style="min-width:200px">Acción</th> --}}
			            </thead>
			            <tbody>
			            {{--@if($ajusteCliente>0)--}}
			            {{--<tr class="ajuste-row">--}}
                            {{--<td><p class="form-control-static"><strong>Ajuste</strong></p></td>--}}
                            {{--<td></td>--}}
                            {{--<td class="monto-documento"><p class="form-control-static">'+o.ajuste+'</p></td>--}}
                            {{--<td ><p class="form-control-static"><span style="display:none" class="saldo-pendiente">'+o.ajuste+'</span></p></td>--}}
                            {{--<td></td>--}}
                            {{--<td></td>--}}
                            {{--<td ><p class="form-control-static"><span style="display:none" class="saldo-pagar">'+o.ajuste+'</span></p></td>--}}
                            {{--<td><input id="ajuste-input" class="form-control saldo-abonado-input "  autocomplete="off"></td>--}}
                            {{--<td></td>--}}
                            {{--<td>--}}
                                {{--<div class="btn-group" role="group" aria-label="...">--}}
                                    {{--<div class="btn-group" role="group">--}}
                                        {{--<button type="button" class="btn btn-primary pay-all-btn">Abono total</button>--}}
                                        {{--<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">--}}
                                            {{--<span class="caret"></span>--}}
                                        {{--</button>--}}
                                        {{--<ul class="dropdown-menu" role="menu">--}}
                                            {{--<li><a class="pay-all-btn">Abono total</a></li>--}}
                                        {{--</ul>--}}
                                    {{--</div>--}}
                                    {{--<button type="button" class="btn btn-default reset-btn"><span class="glyphicon glyphicon-repeat"></span></button>--}}
                                {{--</div>--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                        {{--@endif--}}
						{{-- nuevo commit  --}}
			            @foreach($cobro->facturas as $factura)
                            <tr class="success" data-id="{{$factura->id}}" data-retencionfecha="{{ $factura->pivot->retencionFecha }}" data-retencioncomprobante="{{ $factura->pivot->retencionComprobante }}" data-is-retencion-editable=1
                            data-islrper="'+metadata.islrpercentage+'" data-ivaper="'+metadata.ivapercentage+'"
                            data-base="'+base+'" data-iva="'+ivaPagado+'"  >
                                <td><p class="form-control-static">{{$factura->nFacturaPrefix}}-{{$factura->nFactura}}</p></td>
                                <td><p class="form-control-static">{{$factura->nControlPrefix}}-{{$factura->nControl}}</p></td>
                                <td><p class="form-control-static">{{$factura->fecha}}</p></td>
                                <td class="monto-documento"><p class="form-control-static">{{$traductor->format($factura->total)}}</p></td>
                                {{-- <td><p class="form-control-static">{{$traductor->format($factura->metadata->total-$factura->pivot->total)}}</p></td> --}}
                                {{-- <td ><p class="form-control-static"><span class="saldo-pendiente">{{$traductor->format(abs($factura->total-$factura->metadata->total-$factura->pivot->total))}}</span></p></td> --}}
                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control retencion-pagar" data-retencionfecha="{{ $factura->pivot->retencionFecha }}" data-retencioncomprobante="{{ $factura->pivot->retencionComprobante }}" autocomplete="off"  readonly value="{{$traductor->format($factura->pivot->retencion)}}">
                                        {{-- <div class="input-group-btn"> --}}
                                            {{-- <button type="button" class="btn btn-warning retencion-btn"><span class="glyphicon glyphicon-search"></span></button> --}}
                                        {{-- </div> --}}
                                    </div>
                                </td>
                                {{-- <td ><p class="form-control-static"><span class="saldo-pagar"></span></p></td> --}}
                                <td><input readonly class=" text-right form-control saldo-abonado-input"  autocomplete="off" value="{{$traductor->format($factura->pivot->total-$factura->pivot->retencion)}}"></td>
                                <td><button  class='btn btn-warning edit-retencion-btn'><span class='glyphicon glyphicon-pencil'></span></button></td>
                                {{-- <td><p class="form-control-static saldo-restante"></p></td> --}}
                                {{-- <td> --}}
                                    {{-- <div class="btn-group" role="group" aria-label="..."> --}}
                                        {{-- <div class="btn-group" role="group"> --}}
                                            {{-- <button type="button" class="btn btn-primary pay-all-btn">Abono total</button> --}}
                                            {{-- <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> --}}
                                                {{-- <span class="caret"></span> --}}
                                            {{-- </button> --}}
                                            {{-- <ul class="dropdown-menu" role="menu"> --}}
                                                {{-- <li><a class="pay-all-btn">Abono total</a></li> --}}
                                                {{-- <li><a class="pay-partial-btn">Abono por cuota</a></li> --}}
                                            {{-- </ul> --}}
                                        {{-- </div> --}}
                                        {{-- <button type="button" class="btn btn-default reset-btn"><span class="glyphicon glyphicon-repeat"></span></button> --}}
                                    {{-- </div> --}}
                                {{-- </td> --}}
                            </tr>

			            @endforeach
			            </tbody>
		            </table>
	            </div>
				<div class="form-inline" style="margin-bottom: 30px">
					<div class="form-group">
					<label style="font-weight: bold;" >Recibo de Caja: </label>
						<div class="input-group">
							<input autocomplete="off" type="text" id="nRecibo-input" name="nRecibo" class="form-control" placeholder="Número" value="{{$cobro->nRecibo}}"/>
						</div><!-- /.input group -->
					</div>
					<div class="form-group">
					<label style="font-weight: bold;" >Fecha: </label>
						<div class="input-group">
							<input autocomplete="off" type="text" id="fecha-datepicker" name="fecha" class="form-control" placeholder="Fecha" value="{{$cobro->fecha}}"/>
						</div><!-- /.input group -->
					</div>
		            <div class="form-group pull-right">
			            <label for="total-a-pagar-doc-input" class="col-sm-6 control-label"><h5>Total a cobrar</h5></label>
			            <div class="col-sm-6">
				            <input autocomplete="off" type="text" class="form-control total-a-pagar-doc-input text-right" style="font-weight: bold;" readonly value="0,00">
			            </div>
		            </div>
		        <div>
	            {{-- <div class="row"> --}}
		            {{-- <div class="col-xs-12"> --}}
			            {{-- <label>Leyenda:[<span class="text-success">Pago completo</span> | <span class="text-info">Sobrepagado</span> | <span class="text-warning">Pago parcial</span> | <span class="text-danger">Error en saldo ingresado</span>]</label> --}}
		            {{-- </div> --}}
	            {{-- </div> --}}
	            <h5>Formas de pago</h5>
	            <div class="row">
		            <div class="col-xs-12 text-right">
			            <button class="btn btn-primary register-payment-btn"><span class="glyphicon glyphicon-plus"></span> Registrar pago</button>
		            </div>
	            </div>
	            <div class="table-responsive" style="margin-top:15px;margin-bottom:15px">
		            <table id="formas-pago-table" class="table table-condensed text-center">
			            <thead class="bg-primary">
				            <th>Fecha</th>
				            <th>Banco</th>
				            <th>Cuenta</th>
				            <th>Forma de pago</th>
				            <th>#Deposito/#Lote</th>
				            <th>Monto</th>
				            <th style="min-width:150px">Acción</th>
			            </thead>
			            <tbody>
							{{-- Si es por dacion, $cobro->pagos viene vacio entonces no puede mostrar esa collecion  --}}
							@if($cobro->pagos->isEmpty() == true)
								@foreach($cobro->pagos as $pago)
								<tr class="pago" data-object="{{$pago->toJson()}}">
									<td>{{$pago->fecha}}</td>
									<td>{{$pago->banco->nombre}}</td>
									<td>{{$pago->cuenta->descripcion}}</td>
									<td>{{$pago->tipo}}</td>
									<td>{{$pago->ncomprobante}}</td>
									<td>{{$traductor->format($pago->monto)}}</td>
									<td class="text-center">
										<button class='btn btn-warning edit-payment-btn'><span class='glyphicon glyphicon-pencil'></span></button>
										<button class='btn btn-danger remove-payment-btn'><span class='glyphicon glyphicon-minus'></span></button>
									</td>
								</tr>
								@endforeach
							@else

							@endif

  


							@if($ajusteCliente < 0)
								<tr class="pago">
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td>Ajuste </td>
									<td>
										<input id="ajuste-input" type="hidden" value="{{$traductor->format($ajusteCliente * -1)}}">
										{{$traductor->format($ajusteCliente * -1) }}
									</td>
									<td></td>
								</tr>
							@endif


			            </tbody>
		            </table>
	            </div>

	            <div class="row">
		            <div class="col-xs-12">
			            <div class="form-horizontal">
				            <div class="form-group">
					            <label for="inputEmail3" class="col-sm-2 control-label">Observaciones</label>
					            <div class="col-sm-9">
						            <textarea  style="width: 800px" id="observaciones-documento" class="form-control" row="5">{{ $cobro->observacion }}</textarea>
					            </div>
				            </div>
			            </div>
		            </div>
	            </div>
	            <div class="row">
		            <div class="col-xs-12">
			            <div class="form-horizontal">
				            <div class="form-group">
					            <label for="total-a-pagar-doc-input" class="col-sm-2 control-label">Total a cobrar</label>
					            <div class="col-sm-2">
						            <input autocomplete="off" type="text" class="form-control total-a-pagar-doc-input" readonly value="0,00">
					            </div>
					            <label for="total-diferencia-doc-input" class="col-sm-2 control-label">Diferencia</label>
					            <div class="col-sm-2">
						            <input autocomplete="off" type="text" class="form-control" id="total-diferencia-doc-input" readonly value="0,00">
					            </div>
					            <label for="total-a-depositar-doc-input" class="col-sm-2 control-label">Total depositado</label>
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
				                <input type="checkbox" checked id="hasrecaudos-check"> Recaudos conciliados
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
@include('cobranza.partials.pagoModal', ["edit" => true])
@include('cobranza.partials.retencionModal')



@endsection
@section('script')


<script>


    $(document).ready(function(){

        @include('cobranza.partials.script')
        calculateTotalPagar();
        calculateTotalDepositar();
        $('body').delegate('.edit-payment-btn', 'click', function(){
            var $tr=$(this).closest('tr');
            var pago=$tr.data('object');
            var tipo={
                "DEP"  : "D",
                "NC" : "NC",
                "TRAN"  : "T"
            };
            $('#forma-modal-input').val(tipo[pago.tipo]);
            $('#fecha-modal-input').val(pago.fecha);
            $('#banco-modal-input').val(pago.banco_id);
            $('#banco-modal-input').change();
            setTimeout(function(){$('#cuenta-modal-input').val(pago.cuenta_id);}, 500);
            $('#deposito-modal-input').val(pago.ncomprobante);
            $('#monto-modal-input').val(numToComma(pago.monto));
            $('#register-payment-modal').modal('show');
            $('#register-payment-modal').data('tr', $tr);
        })

        $('body').delegate('#edit-deposito-modal-btn', 'click', function(){
            var $tr=$('#register-payment-modal').data('tr') || false;
            var o={
    			tipo:$('#forma-modal-input option:selected').val(),
    			fecha:$('#fecha-modal-input').val(),
    			banco_id:$('#banco-modal-input option:selected').val(),
    			cuenta_id:$('#cuenta-modal-input option:selected').val(),
    			ncomprobante:$('#deposito-modal-input').val(),
    			monto:commaToNum($('#monto-modal-input').val())
    		};
    		if(o.ncomprobante=="" || o.fecha=="" || o.monto=="" || o.cuenta_id=="Seleccione"){
    			alertify.error('Debe llenar todos los campos del deposito.')
    			return;
    		}
            if(isNaN(parseFloat(o.monto))){
                alertify.error('El monto del deposito debe ser un numéro valido.')
                return;
            }
            if($tr){
                var pago=$tr.data('object');
                pago.tipo=o.tipo;
                pago.fecha=o.fecha;
                pago.banco_id=o.banco_id;
                pago.cuenta_id=o.cuenta_id;
                pago.ncomprobante=o.ncomprobante;
                pago.monto=o.monto;
                $tr.find('td:eq(0)').text(pago.fecha);
                $tr.find('td:eq(1)').text($('#banco-modal-input option:selected').text());
                $tr.find('td:eq(2)').text($('#cuenta-modal-input option:selected').text());
                $tr.find('td:eq(3)').text($('#forma-modal-input option:selected').text());
                $tr.find('td:eq(4)').text(pago.ncomprobante);
                $tr.find('td:eq(5)').text(numToComma(pago.monto));
                $tr.data('object', pago);
            }else{
                var tr="<tr class='pago'>\
                    		<td>"+o.fecha+"</td>\
                    		<td>"+$('#banco-modal-input option:selected').text()+"</td>\
                    		<td>"+$('#cuenta-modal-input option:selected').text()+"</td>\
                    		<td>"+$('#forma-modal-input option:selected').text()+"</td>\
                    		<td>"+o.ncomprobante+"</td>\
                    		<td>"+numToComma(o.monto)+"</td>\
                    		<td>\
                                <button class='btn btn-warning edit-payment-btn'><span class='glyphicon glyphicon-pencil'></span></button>\
                    			<button class='btn btn-danger remove-payment-btn'><span class='glyphicon glyphicon-minus'></span></button>\
                    		</td>\
	                   </tr>";
            	tr=$(tr);
            	$(tr).data("object",o);
            	$('#formas-pago-table tbody').append(tr);
            }

            $('#register-payment-modal').modal('hide');

            calculateTotalDepositar();
        })

        $('#save-cobro-btn').click(function(){

            var pagar     =commaToNum($('.total-a-pagar-doc-input').first().val());
            var depositar =commaToNum($('#total-a-depositar-doc-input').val());
            var ajuste    =commaToNum($('#ajuste-input').val());

            console.log("SAVE BUTTON: " + $('#total-diferencia-doc-input').val());
            console.log("PAGAR: " + pagar);
			console.log("AJUSTE: " + ajuste);
			console.log("DEPOSITAR: " + depositar);

            if(pagar>depositar){
                alertify.error("El monto a cobrar no puede ser mayor al depositado.");
                return;
            }
            if(pagar==0 || depositar==0){
                alertify.error("El monto a cobrar o depositado no pueden ser cero.");
                return;
            }
            if(ajuste>0){
                var ajusteMaximo=parseFloat($('.ajuste-row').find('.saldo-pagar').text());
                if(ajuste>ajusteMaximo){
                    alertify.error("El ajuste no puede superar " +ajusteMaximo+ "Bs.");
                    return;
                }
            }


            //QUEDE AQUI
            var facturas=[];
            var trs=$('#cxc-table tbody').find('tr.success, tr.info, tr.warning').not('.ajuste-row');
            $.each(trs, function(index,value){
				var retencionInput       =$(value).find('.retencion-pagar');
				console.log(retencionInput)
				var retencionFecha       =$(retencionInput).data('retencionfecha');
				var retencionComprobante =$(retencionInput).data('retencioncomprobante');
				retencionFecha           =(retencionFecha===undefined)?0:retencionFecha;
				retencionComprobante     =(retencionComprobante===undefined)?0:retencionComprobante;
                var o={
                    id:$(value).data('id'),
                    retencionFecha:retencionFecha,
                    retencionComprobante:retencionComprobante
                }
				console.log(o);

                facturas.push(o);
            });


            var pagos=[];
            $('#formas-pago-table tbody tr').each(function(index,value){
            	console.log(value);
                pagos.push($(value).data('object'));
            })

            addLoadingOverlay('#main-box');
            $.ajax({
                method:'PUT',
                data:{
                    pagos:pagos,
                    facturas:facturas,
                    nRecibo: $('#nRecibo-input').val(),
                    fecha: $('#fecha-datepicker').val(),
                    observacion:$('#observaciones-documento').val(),
                    hasrecaudos:$('#hasrecaudos-check').prop('checked'),
                    modulo_id:'{{$id}}'
                },
                url: '{{action('CobranzaController@update', [$moduloName, $cobro->id])}}'
            }).done(function(data, status, jx){
                try{
                    var response=JSON.parse(jx.responseText);
                    if(response.success){
                        alertify.success("El pago se actualizo con éxito.");
            			window.location.reload();
                    }
                    removeLoadingOverlay('#main-box');
                }catch(e){
                    removeLoadingOverlay('#main-box');
                    alertify.error("Error en el servidor");
                }


            })
        })

    });


</script>

@endsection
