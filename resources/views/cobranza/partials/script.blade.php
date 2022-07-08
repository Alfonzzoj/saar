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

function calculateTotalRetencion(){

	var trs=$('#retencion-modal table tbody tr');
	var total=0;

	$.each(trs, function(){
		if($(this).find(':checkbox').prop('checked')){
			var input =$(this).find('.retencion-input');
			value     =commaToNum($(input).val());
			var monto =commaToNum($($(input).data('target')).val());
			total     +=Math.round(monto*value)/100
		}
	});
	total=(total).toFixed(2);
	$('#total-modal-input').val(numToComma(total));

}

function calculateTotalPagar(){
	var total =0;
	var trs   =$('#cxc-table tbody').find('tr.success, tr.info, tr.warning').not('.ajuste-row');
	$.each(trs, function(index,value){
		total+=commaToNum($(value).find('.saldo-abonado-input').val());
	})
	$('.total-a-pagar-doc-input').val(numToComma(total));
	$('#total-diferencia-doc-input').val(numToComma(commaToNum($('#total-a-depositar-doc-input').val())-total));
}


function calculateTotalDepositar(){
	var total  =0;
	var ajuste =commaToNum($('#ajuste-input').val());

	total      +=ajuste;
	max        = $('#formas-pago-table tbody tr').length;
	if (max == 1) {max += 1;}
	if (ajuste != 0){
			$('.pago').each(function(index,value){
				
				if (index <= max - 1) {
					var o =$(value).data('object');
					if(o != null)
						total +=parseFloat(o.monto);
				}
			})
	} else {
			$('#formas-pago-table tbody tr').each(function(index,value){
					var o =$(value).data('object');
					total +=parseFloat(o.monto);
			})
	}

	$('#total-a-depositar-doc-input').val(numToComma(total));
	$('#total-diferencia-doc-input').val(numToComma(total-commaToNum($('.total-a-pagar-doc-input').first().val())));
}




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
        $('#register-payment-modal').data('tr', null);
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

		var tr="<tr class='pago'>\
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


$('#edit-accept-retencion-modal-btn').click(function(){

	var tr             =$('tr.retencion');
	var retencionInput =$(tr).find('.retencion-pagar');

    var retencionfecha=$('#edit-fecha-retencion-input').val();
    var retencioncomprobante=$('#edit-comprobante-retencion-input').val();
    console.log(retencioncomprobante);
    $(retencionInput).data('retencionfecha',retencionfecha);
    $(retencionInput).data('retencioncomprobante',retencioncomprobante);
	$('#edit-retencion-modal').modal('hide');
})


$('.retencion-check').on('ifChanged',function(){calculateTotalRetencion()})
$('.retencion-input').keyup(function(){calculateTotalRetencion()});

$('#cxc-table').delegate('.retencion-btn','click',function(){
	var tr   =$(this).closest('tr');
	var data =$(tr).data();
	$('#islrper-modal-input').val(numToComma(data.islrper));
	$('#ivaper-modal-input').val(numToComma(data.ivaper));
	$('#iva-modal-input').val(numToComma(data.iva));
	$('#base-modal-input').val(numToComma(data.base));
	$(tr).addClass('retencion');
	if(!data.isRetencionEditable){
		$('#retencion-modal [type=text]').attr("disabled","");
		$('#retencion-modal :checkbox').iCheck('disable');

		var trs=$('#retencion-modal table tbody tr');
		$.each(trs, function(){
			if(commaToNum($(this).find('.retencion-input').val())!=0){
				$(this).find(':checkbox').attr('checked', 'checked');
			}
		});
		calculateTotalRetencion()
	}
	$('#retencion-modal').modal('show');
})


$('#cxc-table').delegate('.edit-retencion-btn','click',function(){
	var tr   =$(this).closest('tr');
	var data =$(tr).data();
	if (!$(tr).hasClass("retencion")){
        $(tr).addClass('retencion');
    }
	$('#edit-fecha-retencion-input').val(data.retencionfecha);
	$('#edit-comprobante-retencion-input').val(data.retencioncomprobante);
	$('#edit-retencion-modal').modal('show');
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

$('#edit-retencion-modal').on('hidden.bs.modal', function () {
	$('#retencion-modal [type=text]').removeAttr("disabled");
	$('#retencion-modal :checkbox').iCheck('enable');
	$('tr.retencion').removeClass('retencion');
	$('#edit-retencion-modal').find(':checkbox').iCheck('uncheck');
})

$('#procesar-cuotas-btn').click(function(){
	var saldo    =$('#cuota-saldo-input').val();
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

$('#cliente-select').chosen({width: "100%"}).change(function(){
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
		url:"{{action('CobranzaController@getFacturasClientes', [$moduloName])}}",
		data:{codigo:value}
	}).done(function(response, status, responseObject){
		console.log(response.facturas)
		try{
			var o=JSON.parse(responseObject.responseText);
			{{-- console.log("F:   "+ ) --}}
            console.log(o.ajusteCobros);
            console.log(o.ajuste);
			var cobro=[];
			$.each(o.ajusteCobros, function(i, value){
				cobro[i] =value.cobro_id;
			});
			var trs="";
			if(o.ajuste>0)
				trs+='<tr class="ajuste-row" >\
				<td rowspan="2" style="vertical-align: middle"> <p class="form-control-static "><strong>AJUSTE:</strong></p></td>\
						<td class="monto-documento"><p class="form-control-static"><strong>Saldo Total</strong></p></td>\
						<td class="monto-documento"><p class="form-control-static"><strong>Cobros</strong></p></td>\
						<td></td>\
						<td class="monto-documento"><p class="form-control-static"><strong>Saldo Aplicado</strong></p></td>\
						<td colspan="2" class="monto-documento"><p class="form-control-static"><strong>Acción</strong></p></td>\
				</tr>\
				<tr class="ajuste-row" >\
					<td class="monto-documento"><p class="form-control-static">'+numToComma(o.ajuste)+'</p></td>\
					<td class="numero-cobros"><p class="form-control-static">'+cobro+'</p></td>\
					<td ><p class="form-control-static"><span style="display:none" class="saldo-pagar">'+numToComma(o.ajuste)+'</span></p></td>\
					<td><input id="ajuste-input" class="form-control saldo-abonado-input "  autocomplete="off"></td>\
					<td colspan="2">\
						<div class="btn-group" role="group" aria-label="...">\
							<div class="btn-group" role="group">\
								<button type="button" class="btn btn-primary pay-all-btn">Abono total</button>\
								<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">\
									<span class="caret"></span>\
								</button>\
								<ul class="dropdown-menu" role="menu">\
									<li><a class="pay-all-btn">Abono total</a></li>\
								</ul>\
							</div>\
							<button type="button" class="btn btn-default reset-btn"><span class="glyphicon glyphicon-repeat"></span></button>\
						</div>\
					</td>\
				</tr>'


		$.each(o.facturas, function(index,value){
			{{-- console.log(value.metadata) --}}
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

			var pendiente 			= (value.condicionPago=="Exonerado")?0:	value.total-metadata.total;	
			var base                =value.subtotalNeto-metadata.basepagado;
			var ivaPagado           =value.iva-metadata.ivapagado;

			if(!isRetencionEditable)
				retencion=(base*metadata.islrpercentage+ivaPagado*metadata.ivapercentage)/100;

			trs+='<tr data-id="'+value.id+'" data-is-retencion-editable="'+isRetencionEditable+'" \
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
})
});


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
	var row   =$(this).closest('tr');
	var items=$('#cxc-table .success');
	var size=items.size()+1;
	$('#contador').text(size);


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
	var abonado = commaToNum($(row).find('.saldo-abonado-input').val());
	$(row).find('.saldo-abonado-input').val("");
	var total = commaToNum($('#total-a-depositar-doc-input').val()) - abonado;

	if($('#total-a-depositar-doc-input')>0){
		$('#total-a-depositar-doc-input').val(numToComma(total));
	}


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
