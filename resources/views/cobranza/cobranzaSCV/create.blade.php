@extends('app')
@section('content')
<ol class="breadcrumb">
	<li><a href="{{url('principal')}}">Inicio</a></li>
	<li><a id="listado-despegues" href="{{action('DespegueController@index')}}">Lista de Despegues</a></li>
	<li><a class="active">Registro de Pago</a></li>
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
								<option
									data-id="{{$cliente->id}}"
									data-nombre="{{$cliente->nombre}}"
									data-ced-rif="{{$cliente->cedRif}}"
									data-ced-rif-prefix="{{$cliente->cedRifPrefix}}"
									data-islr="{{$cliente->islrpercentage}}"
									data-iva="{{$cliente->ivapercentage}}"
									data-is-contribuyente="{{$cliente->isContribuyente}}"
									value="{{$cliente->codigo}}">
									{{$cliente->codigo}} | {{$cliente->nombre}}
								</option>
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
				<h5>Cuentas por cobrar</h5>
				<div class="row">
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
				</div>

<!--Poner un input pegado al boton de retencion que muestre el total de retencion
	Poner subtotal de la operacion del saldo abonado y la retencion -->
	            <div class="table-responsive" id="cxc-table-wrapper" style="margin-top:15px; margin-bottom:15px">
		            <table class="table table-condensed text-center" id="cxc-table">
			            <thead class="bg-primary">
				            <th style="min-width:120px"># Fac/Doc</th>
				            <th style="min-width:120px"># Control</th>
				            <th style="min-width:120px">Fecha emisión</th>
				            <th style="min-width:120px">Monto documento</th>
				            <th style="min-width:120px">Saldo Cancelado</th>
				            <th style="min-width:120px">Saldo Pendiente</th>

				            <th style="min-width:120px">Retencion</th>
				            <th style="min-width:120px">Saldo a pagar</th>
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
					<label style="font-weight: bold;" >Fecha: </label>
						<div class="input-group">
							<input type="text" id="fecha-datepicker" name="fecha" class="form-control" placeholder="Fecha" value="{{$today->format('d/m/Y')}}"/>
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
			            <label>Leyenda:[<span class="text-success">Pago completo</span> | <span class="text-info">Sobrepagado</span> | <span class="text-warning">Pago parcial</span> | <span class="text-danger">Error en saldo ingresado</span>]</label>


		            </div>
	            </div>

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
						            <textarea id="observaciones-documento" class="form-control" row="5"> COBRO DE SERVICIOS AERONÁUTICOS </textarea>
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

<div class="modal fade" id="register-payment-modal" tabindex="-1" role="dialog" aria-labelledby="register-payment-modal" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">     
	    <div class="modal-content">      
		    <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cancelar</span></button>         
			    <h4 class="modal-title">Registrar una forma de pago</h4>       
		    </div>
		    <div class="modal-body">       
			    <div class="form-horizontal">
				    <div class="form-group">
					    <label for="forma-modal-input" class="col-sm-2 control-label">Forma de pago</label>
					    <div class="col-md-10">
						<select class="form-control"  id="forma-modal-input">
							    <option value="D">Deposito</option>
							    <option value="NC">Nota de credito</option>
								<option value="T">Transferencia</option>
								<option value="DP">Dación de Pago</option>
						    </select>
					    </div>
				    </div>
				    <div class="form-group">
					    <label for="fecha-modal-input" class="col-sm-2 control-label">Fecha</label>
					    <div class="col-md-10">
						    <input type="text" class="form-control" id="fecha-modal-input" autocomplete='off'>
					    </div>
				    </div>
				    <div class="form-group" id="bancoModal">
					    <label for="banco-modal-input" class="col-sm-2 control-label">Banco</label>
					    <div class="col-md-10">
						    <select id="banco-modal-input" class="form-control">
							    @foreach($bancos as $banco)

							    <option value="{{$banco->id}}" data-cuentas='{!!$banco->cuentas!!}' >{{$banco->nombre}}</option>

							    @endforeach
						    </select>
					    </div>
				    </div>
				    <div class="form-group" id="cuentaModal">
					    <label for="cuenta-modal-input" class="col-sm-2 control-label">Cuenta</label>
					    <div class="col-md-10">
						    <select id="cuenta-modal-input" class="form-control">
								<option value=''>Seleccione</option>
						    </select>		
					    </div>
				    </div>
				    <div class="form-group" id="loteModal">
					    <label for="deposito-modal-input" class="col-sm-2 control-label">#Deposito/#Lote</label>
					    <div class="col-md-10">
						    <input type="text" class="form-control" id="deposito-modal-input" autocomplete='off'>
					    </div>
				    </div>

				    <div class="form-group">
					    <label for="monto-modal-input" class="col-sm-2 control-label">Monto</label>
					    <div class="col-md-10">
						    <input type="text" class="form-control" id="monto-modal-input" autocomplete='off'>
					    </div>
				    </div>
			    </div>
		    </div>    
		    <div class="modal-footer">       
			    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>      
			    <button type="button" class="btn btn-primary" id="accept-deposito-modal-btn">Aceptar</button>
		    </div>
	    </div>  
    </div> 
</div>

<div class="modal fade" id="cuota-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Abono por cuota</h4>
			</div>
			<div class="modal-body">
				<div class="form-horizontal">
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label">Saldo</label>
						<div class="col-sm-10">
							<input  class="form-control" id="cuota-saldo-input">
						</div>
					</div>
					<div class="form-group">
						<label for="inputPassword3" class="col-sm-2 control-label">Cantidad de cuotas</label>
						<div class="col-sm-10">
							<input  class="form-control" id="cuota-cantidad-input" >
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button class="btn btn-primary" id="procesar-cuotas-btn">Procesar</button>
						</div>
					</div>
					<div id="cuotas-wrapper">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary" id="accept-cuotas-modal-btn">Aceptar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="retencion-modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Selección de retención</h4>
			</div>
			<div class="modal-body">
			    <div class="form-horizontal">
                    <div class="form-group">
                        <label for="fecha-modal-input" class="col-sm-2 control-label">Fecha retención</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="fecha-retencion-input" autocomplete='off'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fecha-modal-input" class="col-sm-2 control-label">Comprobante retención</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="comprobante-retencion-input" autocomplete='off'>
                        </div>
                    </div>
			    </div>

				<div class="row" style="margin:15px auto">

					<label class="control-label col-xs-2">Base a pagar</label>

					<div class="col-xs-4">
						<input class="form-control" id="base-modal-input" readonly/>
					</div>
					<label class="control-label col-xs-2">IVA a pagar</label>
					<div class="col-xs-4">
						<input class="form-control" id="iva-modal-input" readonly/>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-offset-3 col-xs-6">
						<table class="table">
							<thead class="bg-primary"><tr><th></th><th>Concepto</th><th>Porcentaje</th></tr></thead>
							<tbody>
								<tr>
									<td><input type="checkbox" class="retencion-check" autocomplete="off" /></td>
									<td>ISLR</td>
									<td><input type="text" class="form-control retencion-input" id="islrper-modal-input" data-target="#base-modal-input" /></td>
								</tr>
								<tr>
									<td><input type="checkbox" class="retencion-check" autocomplete="off"/></td>
									<td>IVA</td>
									<td><input type="text" class="form-control retencion-input" id="ivaper-modal-input" data-target="#iva-modal-input" /></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="row" style="margin:15px auto">

					<label class="control-label col-xs-2">Total</label>

					<div class="col-xs-4">
						<input class="form-control" id="total-modal-input" value="0,00" autocomplete="off"/>
					</div>

				</div>
			</div>
			<div class="modal-footer">

				<button type="button" class="btn btn-primary" id="accept-retencion-modal-btn">Aceptar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
@section('script')


<script>

//porcentaje de retencion, los modifico cunado selecciono un cliente
var islr=0;
var iva=0;
var calculatePagarTimeout=null;
function checkRowCondition(row, saldoAbonado, saldoPendiente,saldoAbonadoText){

	clearTimeout(calculatePagarTimeout);
	calculatePagarTimeout=setTimeout(calculateTotalPagar, 500);
	if(saldoAbonadoText==""){
		$(row).removeClass('info warning success danger');
		return false;
	}
	if(isNaN(saldoAbonado)){
		$(row).removeClass('info warning success').addClass('danger');
		return false;
	}
	var status=saldoAbonado-saldoPendiente;
	if(status==0){
		$(row).removeClass('info warning danger').addClass('success');
	}else if(status>0){
		$(row).removeClass('success warning danger').addClass('info');
	}else{
		$(row).removeClass('info success danger').addClass('warning');
	}
	return true;
}


function calculateTotalRetencion(){

	var trs=$('#retencion-modal table tbody tr');
	var total=0;
	$.each(trs, function(){
		if($(this).find(':checkbox').prop('checked')){
			var input =$(this).find('.retencion-input');
			value     =commaToNum($(input).val());
			var monto =commaToNum($($(input).data('target')).val());
			total     +=monto*value/100
		}
	});
	$('#total-modal-input').val(numToComma(total));
	$("#total-modal-input").attr("readonly", false); 
}

function calculateTotalPagar(){
	var total =0;
	var trs   =$('#cxc-table tbody').find('tr.success, tr.info, tr.warning').not('.ajuste-row');
	$.each(trs, function(index,value){
	console.log($(value).find('.saldo-abonado-input').val());
		total+=commaToNum($(value).find('.saldo-abonado-input').val());
	})
	console.log(total);
	$('.total-a-pagar-doc-input').val(numToComma(total));
	$('#total-diferencia-doc-input').val(numToComma(commaToNum($('#total-a-depositar-doc-input').val())-total));
}


function calculateTotalDepositar(){
	var total  =0;
	var ajuste =commaToNum($('#ajuste-input').val());
	total      +=ajuste;
	$('#formas-pago-table tbody tr').each(function(index,value){
		var o =$(value).data('object');

		total +=parseFloat(o.monto);
	})

	$('#total-a-depositar-doc-input').val(numToComma(total));
	$('#total-diferencia-doc-input').val(numToComma(total-commaToNum($('.total-a-pagar-doc-input').first().val())));
}
$(document).ready(function(){

	$('#forma-modal-input').on('change', function () {
	if(this.value == 'DP'){
		$('#cuentaModal').hide();
		$('#bancoModal').hide();
		$('#loteModal').hide();
	}else{
		$('#cuentaModal').show();
		$('#bancoModal').show();
		$('#loteModal').show();
	}
	})

	$('body').delegate('#ajuste-input', 'keyup paste', calculateTotalDepositar);

	$('#fecha-modal-input, #fecha-retencion-input').datepicker({
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


	$('#register-payment-modal').on('hidden.bs.modal', function () {
		$('#register-payment-modal input').val("");
	})

	$('#accept-deposito-modal-btn').click(function(){

		var o={
			tipo:$('#forma-modal-input option:selected').val(),
			fecha:$('#fecha-modal-input').val(),
			banco_id:$('#banco-modal-input option:selected').val(),
			cuenta_id:$('#cuenta-modal-input option:selected').val(),
			ncomprobante:$('#deposito-modal-input').val(),
			monto:commaToNum($('#monto-modal-input').val())
		};
		if((o.ncomprobante=="" || o.fecha=="" || o.monto=="" || o.cuenta_id=="Seleccione") && $('#forma-modal-input').val() != 'DP'){
			alertify.error('Debe llenar todos los campos del deposito.')
			return;
		}
		if(isNaN(parseFloat(o.monto))){
			alertify.error('El monto del deposito debe ser un numéro valido.')
			return;
		}

		var tr="<tr>\
		<td>"+o.fecha+"</td>\
		<td>"+$('#banco-modal-input option:selected').text()+"</td>\
		<td>"+$('#cuenta-modal-input option:selected').text()+"</td>\
		<td>"+$('#forma-modal-input option:selected').text()+"</td>\
		<td>"+o.ncomprobante+"</td>\
		<td>"+numToComma(o.monto)+"</td>\
		<td>\
			<button class='btn btn-danger remove-payment-btn'><span class='glyphicon glyphicon-minus'></span></button>\
		</td>\
	</tr>";
	tr=$(tr);
	$(tr).data("object",o);
	$('#formas-pago-table tbody').append(tr);
	$('#register-payment-modal').modal('hide');
	calculateTotalDepositar();
})

$('body').delegate('.remove-payment-btn', 'click', function(){
	$(this).closest('tr').remove();
	calculateTotalDepositar();
})



$('#banco-modal-input').change(function(){
	var cuentas=$(this).find(':selected').data('cuentas');
	cuentas=eval(cuentas);
	var options="";
	$.each(cuentas,function(index,value){
		options+="<option value='"+value.id+"'>"+value.descripcion+"</option>";
	})
	var seleccione = "<option>Seleccione</option>\ ";
	options=seleccione+options;
	$('#cuenta-modal-input').html(options);
}).trigger('change');

$('#accept-retencion-modal-btn').click(function(){
	var tr             =$('tr.retencion');
	var total          =commaToNum($('#total-modal-input').val());
	var retencionInput =$(tr).find('.retencion-pagar');
	var isrlModal      =0;
	var ivaModal       =0;

	if($('#islrper-modal-input').closest('tr').find(':checkbox').prop('checked'))
		isrlModal=commaToNum($('#islrper-modal-input').val());
	if($('#ivaper-modal-input').closest('tr').find(':checkbox').prop('checked'))
		ivaModal=commaToNum($('#ivaper-modal-input').val());

    var retencionFecha=$('#fecha-retencion-input').val();
    var retencionComprobante=$('#comprobante-retencion-input').val();
	$(retencionInput).val(numToComma(total));
	$(retencionInput).data('islrModal',isrlModal);
	$(retencionInput).data('ivaModal',ivaModal);
    $(retencionInput).data('retencionFecha',retencionFecha);
    $(retencionInput).data('retencionComprobante',retencionComprobante);
	var pendiente =commaToNum($(tr).find('.saldo-pendiente').text());
	$(tr).find('.saldo-pagar').text(numToComma(pendiente-total));
	$(tr).find('.saldo-abonado-input').val("");
	var saldoAbonadoText ="";
	var saldoAbonado     =0;
	var saldoPendiente   =commaToNum($(tr).find('.saldo-pagar').text());
	console.log(tr, saldoAbonado, saldoPendiente,saldoAbonadoText);
	checkRowCondition(tr, saldoAbonado, saldoPendiente,saldoAbonadoText);
	$('#retencion-modal').modal('hide');
})


$('.retencion-check').on('ifChanged',function(){calculateTotalRetencion()})
$('.retencion-input').keyup(function(){calculateTotalRetencion()});

$('#cxc-table').delegate('.retencion-btn','click',function(){
	var tr   =$(this).closest('tr');
	var data =$(tr).data();
	$('#islrper-modal-input').val(numToComma(data.islrper));
	$('#ivaper-modal-input').val(numToComma(data.ivaper));
	$('#iva-modal-input').val(numToComma(data.iva));
	$('#base-modal-input').val(numToComma(data.total));
	$(tr).addClass('retencion');
	if(!data.isRetencionEditable){
		$('#retencion-modal [type=text]').attr("disabled","");
		$('#retencion-modal :checkbox').iCheck('disable');

		var trs=$('#retencion-modal table tbody tr');
		$.each(trs, function(){
			if(commaToNum($(this).find('.retencion-input').val())!=0){
				$(this).find(':checkbox').iCheck('check');
			}
		});
		calculateTotalRetencion()
	}

	$('#retencion-modal').modal('show');

})

$('#retencion-modal').on('hidden.bs.modal', function () {
	$('#retencion-modal [type=text]').removeAttr("disabled");
	$('#retencion-modal :checkbox').iCheck('enable');
	$('#islrper-modal-input').val(0);
	$('#ivaper-modal-input').val(0);
	$('#base-modal-input,#iva-modal-input, #total-modal-input').val(0)
	$('tr.retencion').removeClass('retencion');
	$('#retencion-modal').find(':checkbox').iCheck('uncheck');
})

$('#procesar-cuotas-btn').click(function(){
	var saldo    = $('#cuota-saldo-input').val();
	var cantidad =$('#cuota-cantidad-input').val();
	saldo        =parseFloat(saldo);
	cantidad     =parseInt(cantidad);
	cantidad     =isNaN(cantidad)?1:cantidad;
	var pasos    =saldo/cantidad;
	var checks   ="";
	for(var i=0;i<cantidad;i++){
		checks+='  <div class="form-group"> <div class="col-sm-offset-2 col-sm-10"> <div class="checkbox"> <label> <input type="checkbox" data-pasos="'+pasos+'"> '+pasos+' Bs </label> </div> </div> </div>';
	}
	$('#cuotas-wrapper').html(checks);

})

$('#cxc-table').delegate('.pay-partial-btn','click',function(){
	var tr=$(this).closest('tr');
	$(tr).addClass('hasModalCuotaOpen');
	$('#cuota-saldo-input').val($(tr).find('.saldo-pendiente').text());
	$('#cuota-modal').modal('show');
})

$('#accept-cuotas-modal-btn').click(function(){
	var tr     =$('#cxc-table tr.hasModalCuotaOpen');
	$(tr).removeClass('hasModalCuotaOpen');
	var cuotas =$('#cuotas-wrapper');
	var total  =0;
	$.each($(cuotas).find('[type=checkbox]:checked'),function(index,value){
		total+=parseFloat($(value).data('pasos'));
	})
	$(cuotas).html("");
	$(tr).find('.saldo-abonado-input').val(total).trigger('keyup');
	$('#cuota-modal').modal('hide');

})


$('#cuota-modal').on('hidden.bs.modal', function (e) {
	$('#cuota-saldo-input,#cuota-cantidad-input').val('');
	$('#cxc-table tr.hasModalCuotaOpen').removeClass('hasModalCuotaOpen');
})

if ($('#cliente-select').val() != ""){
		$('#cliente-select').chosen({width: "100%"});
		var codigoCliente =$('#cliente-select').val();
		$('#cliente-select').val(codigoCliente).trigger('change');
		$('.total-a-pagar-doc-input').val("0.00");
		var option =$('#cliente-select option:selected');
		var value  =$(option).val();
		var nombre =$(option).data('nombre');
		var cedRif =$(option).data('cedRifPrefix')+$(option).data('cedRif');
		iva        =0;
		islr       =0;
		if($(option).data('isContribuyente')==1){
			iva  =$(option).data('iva');
			islr =$(option).data('islr');
		}

		$('#cliente_nombre-input').val(((nombre)?nombre:""));
		$('#cliente_cedRif-input').val(((cedRif)?cedRif:""));
		addLoadingOverlay('#main-box');
		$.ajax({
			url:"{{action('DespegueController@getDosaClientes', [$despegue])}}",
			data:{codigo:value}
		}).done(function(response, status, responseObject){
			try{
				var o=JSON.parse(responseObject.responseText);

				var trs="";


			$.each(o.facturas, function(index,value){
				var metadata            =value.metadata;
				var isRetencionEditable =false;
				var retencion           =0;
				if(metadata==null){
					metadata={
						montopagado:0,
						basepagado:0,
						ivapagado:0,
						ncuotas:0,
						montoiniciocuota:0,
						islrpercentage:islr,
						ivapercentage:iva,
						retencion:0,
						total:0
					};
					isRetencionEditable=true;
				}

				metadata.islrpercentage =isNaN(parseFloat(metadata.islrpercentage))?0:metadata.islrpercentage;
				metadata.ivapercentage  =isNaN(parseFloat(metadata.ivapercentage))?0:metadata.ivapercentage;
				var pendiente           =value.total-metadata.total;
				var base                =value.subtotalNeto-metadata.basepagado;
				var ivaPagado           =value.iva-metadata.ivapagado;

				if(!isRetencionEditable)
					retencion=(base*metadata.islrpercentage+ivaPagado*metadata.ivapercentage)/100;

				trs+='<tr data-total="'+value.total+'" data-id="'+value.id+'" data-is-retencion-editable="'+isRetencionEditable+'" \
				data-islrper="'+metadata.islrpercentage+'" data-ivaper="'+metadata.ivapercentage+'"\
				data-base="'+base+'" data-iva="'+ivaPagado+'" >\
				<td><p class="form-control-static">'+value.nFacturaPrefix+'-'+value.nFactura+'</p></td>\
				<td><p class="form-control-static">'+value.nControlPrefix+'-'+value.nControl+'</p></td>\
				<td><p class="form-control-static">'+value.fecha+'</p></td>\
				<td class="monto-documento"><p class="form-control-static">'+numToComma(value.total)+'</p></td>\
				<td><p class="form-control-static">'+numToComma(+metadata.total)+'</p></td>\
				<td ><p class="form-control-static"><span class="saldo-pendiente">'+numToComma(pendiente)+'</span></p></td>\
				<td>\
					<div class="input-group">\
						<input type="text" class="form-control retencion-pagar"  readonly value="'+numToComma(retencion)+'" '+((!isRetencionEditable)?('data-islr-modal="'+metadata.islrpercentage+'" data-iva-modal="'+metadata.ivapercentage+'"'):"")+'>\
						<div class="input-group-btn">\
							<button type="button" class="btn btn-warning retencion-btn"><span class="glyphicon glyphicon-search"></span></button>\
						</div>\
					</div>\
				</td>\
				<td ><p class="form-control-static"><span class="saldo-pagar">'+numToComma(pendiente-retencion)+'</span></p></td>\
				<td><input class="form-control saldo-abonado-input"  autocomplete="off"></td>\
				<td><p class="form-control-static saldo-restante">'+numToComma(pendiente-retencion)+'</p></td>\
				<td>\
					<div class="btn-group" role="group" aria-label="...">\
						<div class="btn-group" role="group">\
							<button type="button" class="btn btn-primary pay-all-btn">Abono total</button>\
							<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">\
								<span class="caret"></span>\
							</button>\
							<ul class="dropdown-menu" role="menu">\
								<li><a class="pay-all-btn">Abono total</a></li>\
								<li><a class="pay-partial-btn">Abono por cuota</a></li>\
							</ul>\
						</div>\
						<button type="button" class="btn btn-default reset-btn"><span class="glyphicon glyphicon-repeat"></span></button>\
					</div>\
				</td>\
			</tr>'

		})
		$('#cxc-table tbody').html(trs);
		}catch(e){console.log(e)}
		removeLoadingOverlay('#main-box');
		$('#max-rows-cxc-table-wrapper-select').trigger('change');
		$('.pay-all-btn').trigger('click');
	})
};



$('#max-rows-cxc-table-wrapper-select').change(function(){
	var value=$(this).val();
	if($('#cxc-table tr:eq(1)').length>0){
		var height=$('#cxc-table tr:eq(1)').height();
		$('#cxc-table-wrapper').css('max-height',(parseInt(value)+1)*height);
	}
}).trigger('change');


$('#cxc-table').delegate('.saldo-abonado-input', 'keyup',function(){
	var row              =$(this).closest('tr');
	var saldoAbonadoText =$(this).val();
	var saldoAbonado     =commaToNum(saldoAbonadoText);
	var saldoPendiente   =commaToNum($(row).find('.saldo-pagar').text());
	$(row).find('.saldo-restante').text(numToComma(saldoPendiente-saldoAbonado));
	checkRowCondition(row, saldoAbonado, saldoPendiente,saldoAbonadoText);

})


$('#cxc-table').delegate('.pay-all-btn', 'click',function(){
	var row=$(this).closest('tr');

	var saldoPendienteText =$(row).find('.saldo-pagar').text();
	var saldoPendiente     =commaToNum(saldoPendienteText);
	$(row).find('.saldo-restante').text("0,00");
	if(checkRowCondition(row, saldoPendiente, saldoPendiente,saldoPendienteText)){
		$(row).find('.saldo-abonado-input').val(saldoPendienteText);
	}
	if($(row).hasClass('ajuste-row'))
		calculateTotalDepositar();
})

$('#cxc-table').delegate('.reset-btn', 'click',function(){
	var row=$(this).closest('tr');
	checkRowCondition(row, 0, 0,"");
	$(row).find('.saldo-abonado-input').val("");


})



$('#box-wrapper').delegate('.register-payment-btn','click',function(){
	var diferencia=commaToNum($('#total-diferencia-doc-input').val());

	if(diferencia<0)
		$('#register-payment-modal #monto-modal-input').val(numToComma(Math.abs(diferencia)));
	$('#register-payment-modal').modal('show');

})

$('#type-rows-cxc-table-wrapper-select').change(function(){
	var value=$(this).val();
	switch(value) {
		case "t":
		    $('#cxc-table tr:gt(0)').show();
		break;
		case "s":
		    var filas=$('#cxc-table tr:gt(0)');
	    	$(filas).hide();
	    	$(filas).filter('.info,.warning,.success,.danger').show();
		break;
		case "n":
	    	var filas=$('#cxc-table tr:gt(0)');
	    	$(filas).hide();
	    	$(filas).filter(':not(.info,.warning,.success)').show();
		break;
	} 

});

$('#save-cobro-btn').click(function(){

	var pagar     =parseFloat($('#total-a-pagar-doc-input').val());
	var depositar =parseFloat($('#total-a-depositar-doc-input').val());
	var ajuste    =parseFloat($('#ajuste-input').val());
	var fecha     =$('#fecha-datepicker').val();
	ajuste        =isNaN(ajuste)?0:ajuste;
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
	var facturas=[];
	var trs=$('#cxc-table tbody').find('tr.success, tr.info, tr.warning').not('.ajuste-row');
	$.each(trs, function(index,value){
		var retencionInput=$(value).find('.retencion-pagar');
		var isrlModal=$(retencionInput).data('islrModal');
		var ivaModal=$(retencionInput).data('ivaModal');
		var retencionFecha=$(retencionInput).data('retencionFecha');
		var retencionComprobante=$(retencionInput).data('retencionComprobante');
		isrlModal=(isrlModal===undefined)?0:isrlModal;
		ivaModal=(ivaModal===undefined)?0:ivaModal;
		retencionFecha=(retencionFecha===undefined)?0:retencionFecha;
		retencionComprobante=(retencionComprobante===undefined)?0:retencionComprobante;
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

	addLoadingOverlay('#main-box');
	$.ajax({
		method:'POST',
		data:{
			facturas:facturas,
			pagos:pagos,
			cliente_id: $('#cliente-select option:selected').data("id"),
			totalFacturas:$('.total-a-pagar-doc-input').val() ,
			totalDepositado:$('#total-a-depositar-doc-input').val(),
			observacion:$('#observaciones-documento').val(),
			hasrecaudos:$('#hasrecaudos-check').prop('checked'),
            fecha:$('#fecha-datepicker').val(),
			ajuste:ajuste,
			modulo_id:'{{$id}}'
		},
		url: '{{action('CobranzaController@store')}}'
	}).done(function(data, status, jx){
		try{
			var response=JSON.parse(jx.responseText);
			if(response.success){
				alertify.success("El pago se efectuó con éxito.");
				setTimeout(
					function()
					{
						window.location="{{action('DespegueController@index')}}";
					}, 2000);
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
