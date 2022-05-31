    $('#condicionPago').change(function(e){
        var value=$(this).val();
        $('#concepto-select').val('');
        $('#concepto-select option[condicionPago="'+value+'"], #concepto-select option[condicionPago="Ambas"]').removeClass('inactive').show();
        $('#concepto-select').trigger('chosen:updated');
        var fecha = $('#fecha').val();

    condicionPago = $('#condicionPago').val();
      if(condicionPago == 'Contado'){
        $('#fechaVencimiento').val(moment(fecha, "DD/MM/YYYY").format("DD/MM/YYYY"));
      }else{
        days = {{ $diasVencimientoCred }};
        $('#fechaVencimiento').val(moment(fecha, "DD/MM/YYYY").add('days', days).format("DD/MM/YYYY"));
      };
    if ($doctype == 0) {$("#concepto-table tbody td").remove();}
    }).trigger('change');

    var ajaxClienteTableStartUrl='{{url('administracion/cliente')}}';
    var timeOut=null;
    function getClientTable(url){$('#advance-search-modal .modal-body').load(url, function(){$.AdminLTE.boxWidget.activate();});}

    function calculateTotal(e){
    clearTimeout(timeOut);
    timeOut=setTimeout(function(){

    if(e){
        var input= e.currentTarget;
        e.preventDefault();
    }


    var subtotalNeto=0;
    var descuentoTotalDoc=0;
    var subtotal=0;
    var iva=0;
    var recargoTotalDoc=0;
    var total=0;


    {{--$('.nControlPrefix-list li').click(function(e){--}}
        {{--e.preventDefault();--}}
        {{--var value=$(this).text();--}}
        {{--var max=$(this).data('max');--}}
        {{--var formGroup=$(this).closest('.form-group');--}}
        {{--$(formGroup).find('.nControlPrefix-text').text(value);--}}
        {{--$(formGroup).find('.nControlPrefix-input').val(value);--}}
        {{--$('#nControl').val()--}}
    {{--})--}}


    $('#concepto-table tbody tr').each(function(index, value){
    var cantidadVal=$(value).find('.cantidad-input').val();
    if(cantidadVal!=""){
    var cantidad=parseInt(commaToNum(cantidadVal));
    cantidad=isNaN(cantidad)?0:cantidad;
        $(value).find('.cantidad-input').val(numToComma(cantidad));
        }
    var montoVal=$(value).find('.monto-input').val();
    var monto=parseFloat(commaToNum(montoVal));
    monto=isNaN(monto)?0:monto;
    if(montoVal!="")
        $(value).find('.monto-input').val(numToComma(monto));
    var subtotalNetoRow=cantidad*monto;
    subtotalNeto+=subtotalNetoRow;
    var descuentoPer=$(value).find('.descuentoPer-input')[0];
    var descuentoTotal=$(value).find('.descuentoTotal-input')[0];

    var descuentoTotalRow=0;
    switch(input){

        case descuentoTotal:
        var descuentoTotalVal=parseFloat(commaToNum($(descuentoTotal).val()));
                    descuentoTotalVal=isNaN(descuentoTotalVal)?0:descuentoTotalVal;
        $(descuentoPer).val(numToComma(100*descuentoTotalVal/subtotalNetoRow));
                    $(descuentoTotal).val(numToComma(descuentoTotalVal));
        break;

                default:
                    var descuentoPerVal=parseFloat(commaToNum($(descuentoPer).val()));
                    descuentoPerVal=isNaN(descuentoPerVal)?0:descuentoPerVal;
                    $(descuentoTotal).val(numToComma(descuentoPerVal*subtotalNetoRow/100));
                    $(descuentoPer).val(numToComma(descuentoPerVal));
                break;

    }

    descuentoTotalDoc+=descuentoTotalRow=parseFloat(commaToNum($(descuentoTotal).val()));
    var subtotalRow=subtotalNetoRow-descuentoTotalRow;
    subtotal+=subtotalRow;
        var recargoPer=$(value).find('.recargoPer-input')[0];
        var recargoTotal=$(value).find('.recargoTotal-input')[0];
        switch(input){

            case recargoTotal:
                var recargoTotalVal=parseFloat(commaToNum($(recargoTotal).val()));
                            recargoTotalVal=isNaN(recargoTotalVal)?0:recargoTotalVal;
                $(recargoPer).val(numToComma(100*recargoTotalVal/subtotalRow));
                            $(recargoTotal).val(numToComma(recargoTotalVal));
            break;

        default:
            var recargoPerVal=parseFloat(commaToNum($(recargoPer).val()));
                        recargoPerVal=isNaN(recargoPerVal)?0:recargoPerVal;
            $(recargoTotal).val(numToComma(recargoPerVal*subtotalRow/100));
                        $(recargoPer).val(numToComma(recargoPerVal));
        break;
        }
        var ivaVal=$(value).find('.iva-input').val();
    var ivaInput=parseFloat(commaToNum(ivaVal));
    ivaInput=isNaN(ivaInput)?0:ivaInput;
    if(ivaVal!="")
        $(value).find('.iva-input').val(numToComma(ivaInput));
    var ivaRow=subtotalRow*ivaInput/100;
    iva+=ivaRow;
    var recargoTotalRow=parseFloat(commaToNum($(recargoTotal).val()));
    recargoTotalDoc+=recargoTotalRow;
    var totalRow=subtotalRow+ivaRow+recargoTotalRow;
    totalrow=totalRow.toFixed(2);
    $(value).find('.total-input').val(numToComma(totalRow));
    total+=totalRow;

    })
    var subtotalNeto=subtotalNeto.toFixed(2);
    var descuentoTotalDoc=descuentoTotalDoc.toFixed(2);
    var subtotal=subtotal.toFixed(2);
    var iva=iva.toFixed(2);
    var total=total.toFixed(2);
    var recargoTotalDoc=recargoTotalDoc.toFixed(2);
    $("#subtotalNeto-doc-input").val(numToComma(subtotalNeto));
    $("#descuentoTotal-doc-input").val(numToComma(descuentoTotalDoc));
    $("#subtotal-doc-input").val(numToComma(subtotal));
    $("#iva-doc-input").val(numToComma(iva));
    $("#recargoTotal-doc-input").val(numToComma(recargoTotalDoc));
    $("#total-doc-input").val(numToComma(total));

    },500);


}






/*
*   Funcion para iniciar el modal de busqueda de cliente
*/
  getClientTable(ajaxClienteTableStartUrl)

  /*
  *   Funcion para darle accion al ordenamiento por columna al darle click al header
  */
$('#advance-search-modal .modal-body').delegate('.operator-list li', 'click', function(){
    var value=$(this).text();
    var formGroup=$(this).closest('.form-group');
    $(formGroup).find('.operator-text').text(value);
    $(formGroup).find('.operator-input').val((value=="Todos")?"_":value);
})

  /*
  *   Funcion para pasar de pagina
  */

  $('#advance-search-modal .modal-body').delegate('.pagination li a', 'click', function(e){
  e.preventDefault();
    //Hay que quitar el slash antes del ?, no se como no generarlo pero replace resuelve.
    getClientTable($(this).attr('href').replace("/?", "?"));
  })

    /*
    *   Funcion para reinciiar los filtros
    */

  $('#advance-search-modal .modal-body').delegate('.cliente-reset-btn', 'click', function(e){
  e.preventDefault();

    getClientTable(ajaxClienteTableStartUrl);
  })

    /*
    *   Funcion para buscar por los filtros
    */

    $('#advance-search-modal .modal-body').delegate('#cliente-filter-btn', 'click', function(e){
    e.preventDefault();
    var container=$(this).closest('.box-body');

    var getParametersString="?";
    var getParametersObject={
         sortName : $(container).find('input[name="sortName"]').val(),
         sortType : $(container).find('input[name="sortType"]').val(),
         codigo : $(container).find('input[name="codigo"]').val(),
         nombre : $(container).find('input[name="nombre"]').val(),
         cedRifPrefix : $(container).find('input[name="cedRifPrefix"]').val(),
         cedRif : $(container).find('input[name="cedRif"]').val(),
         tipo : $(container).find('select[name="tipo"]').val()
    }
    for(var index in getParametersObject){
        var value=getParametersObject[index];
        getParametersString+=index+"="+encodeURI(value)+"&";
    }
    getParametersString= getParametersString.substring(0, getParametersString.length - 1);
    getClientTable(ajaxClienteTableStartUrl+getParametersString);
    })

      /*
      *   Funcion para seleccionar un cliente y colocarlo en el formulario de factura
      */

    $('#advance-search-modal .modal-body').delegate('.select-client-btn', 'click', function(e){
        e.preventDefault();
        var clienteId=$(this).data('id');
        $('#cliente-select').val(clienteId).trigger('chosen:updated').trigger('change');
        $('#advance-search-modal').modal('hide');

    })


  $('#fechaVencimiento:not([readonly]), #fecha:not([readonly])').datepicker({
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

  $('#fecha:not([readonly])').on('changeDate', function(e){
  	$("#concepto-table tbody td").remove()
    condicionPago = $('#condicionPago').val();
    if(condicionPago == 'Contado'){
      $('#fechaVencimiento').val(moment(e.date).format("DD/MM/YYYY"))
    }else{
      days = {{ $diasVencimientoCred }};
      $('#fechaVencimiento').val(moment(e.date).add(days, 'd').format("DD/MM/YYYY"));
    }
  });


  $('#condicionPago').on('changeDate', function(e){
    condicionPago = $('#condicionPago').val();
    if(condicionPago == 'Contado'){
      $('#fechaVencimiento').val(moment(e.date).format("DD/MM/YYYY"))
    }else{
      days = {{ $diasVencimientoCred }};
      $('#fechaVencimiento').val(moment(e.date).add(days, 'd').format("DD/MM/YYYY"));
    }
  });
  

  $('#concepto-select').chosen({
                    placeholder_text_single: "Selecione una opción",
                    width: "100%"});


  $('#cliente-select').chosen({width: "100%"}).change(function(){
  var option=$('#cliente-select option:selected');
    var nombre=$(option).data('nombre');
    var cedRif=$(option).data('cedRifPrefix')+$(option).data('cedRif');
    $('#cliente_nombre-input').val(((nombre)?nombre:""));
    $('#cliente_cedRif-input').val(((cedRif)?cedRif:""));
  }).trigger('change');

  $('#cliente-select').change(function() {
    var indice_seleccion = $("#cliente-select option:selected").index();
    if(indice_seleccion != 0){
      $('#concepto-select').val('');
      $('#concepto-select').prop( "disabled", false );
      $('#concepto-select').trigger('chosen:updated');
      $("#concepto-table tbody td").remove();
    }else{
      $('#concepto-select').val('');
      $('#concepto-select').prop( "disabled", true );
      $('#concepto-select').trigger('chosen:updated');
      $("#concepto-table tbody td").remove();
    }
  });


  $('#concepto-select').chosen({
                    placeholder_text_single: "Selecione una opción",
                    width: "100%"});



  $('#add-conceptop-btn').click(function(){

    var conceptoId=$('#concepto-select').val();
          if(conceptoId==0)
            return;
        var option=$('#concepto-select option[value="'+conceptoId+'"]');
        var conceptoNombre=$(option).text();
        var costo=$(option).data('costo');
        var iva=$(option).data('iva');


        var starts = $('#fecha').val();
        var match = /(\d+)\/(\d+)\/(\d+)/.exec(starts)
        var fecha = new Date(match[3], match[2], match[1]);

      var dia = fecha.getDate();
      var mes = fecha.getMonth();
      var aeropuerto_id = $("input[name=aeropuerto_id]").val();
      var recargo = 0;

    @if(isset($conceptos_con_recargo))

      	var conceptos_recargo = {!! $conceptos_con_recargo !!};
      	console.log(conceptos_recargo);
      	var bandera_recargo = 0;

      	for (indice in conceptos_recargo) {
	        if(conceptos_recargo[indice].id == conceptoId)
	        {
	          bandera_recargo = 1;
	        }
	    }

	    if(bandera_recargo == 1){

		    @if(isset($feriados))
		    	var feriados = {!! $feriados !!};

		      	for (indice in feriados) {

		          if(feriados[indice].dia == dia && feriados[indice].mes == mes)
		          {
		          	recargo = feriados[indice].porcentaje;
		          	break;
		          }
		      	}
		    @endif
		}

	@endif

    $('#concepto-table tbody').append('<tr>\
     <td style="text-align: left"><input type="hidden" name="concepto_id[]" value="'+conceptoId+'" autocomplete="off" />'+conceptoNombre+'</td>\
     <td><input class="form-control cantidad-input text-right" value="1" name="cantidadDes[]" autocomplete="off" /></td>\
     <td><input class="form-control monto-input text-right" value="'+numToComma(costo)+'" name="montoDes[]" autocomplete="off" /> </td>\
     <td><input class="form-control descuentoPer-input text-right" value="0,00" name="descuentoPerDes[]" autocomplete="off" /></td>\
     <td><input class="form-control descuentoTotal-input text-right" value="0,00" name="descuentoTotalDes[]" autocomplete="off" /></td>\
     <td><input class="form-control iva-input text-right" value="'+numToComma(iva)+'" name="ivaDes[]" autocomplete="off" /></td>\
     <td><input class="form-control recargoPer-input text-right" value="' + recargo + '" name="recargoPerDes[]" autocomplete="off" /></td>\
     <td><input class="form-control recargoTotal-input text-right" value="0,00" name="recargoTotalDes[]" autocomplete="off" /></td>\
     <td><input class="form-control total-input text-right" value="0,00" readonly name="totalDes[]" autocomplete="off" /></td>\
     <td><button class="btn btn-danger eliminar-concepto-btn"><span class="glyphicon glyphicon-remove"></span></button></td>\
     </tr>')

     calculateTotal();
     })

  $('#concepto-table').delegate('input', 'focusout paste',function(e){calculateTotal(e)});

$('#concepto-table').delegate('input', 'keyup keypress',function(e){
  var code = e.keyCode || e.which;
  if (code == 13) {
    calculateTotal(e)
  }
});

  $('#concepto-table').delegate('.eliminar-concepto-btn', 'click', function(){
    $(this).closest('tr').remove();
    calculateTotal();
  });


$('form').on('keyup keypress', function(e) {
  var code = e.keyCode || e.which;
  if (code == 13) {
    e.preventDefault();
    return false;
  }
});
