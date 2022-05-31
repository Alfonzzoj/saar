function calcularMonto(e,increment){

    var row=$(e).closest('tr');
    var montoInput=$(row).find('.monto-input');
    var bsInput=$(row).find('.bs-input');
    var hastaInput=$(row).find('.hasta-input');
    var desdeInput=$(row).find('.desde-input');
    var cantidadInput=$(row).find('.cantidad-input');
    var cantidad=$(cantidadInput).val();
    cantidad=parseInt(cantidad);
    cantidad=(isNaN(cantidad)?0:cantidad);
    cantidad+=increment;
    if(cantidad<0) cantidad=0;
    $(montoInput).text(numToComma(commaToNum($(bsInput).text())*cantidad));
    $(cantidadInput).val(cantidad);
    $(hastaInput).val(parseInt($(desdeInput).val())+cantidad-1);


    var $table= $(row).closest('table');
    calcularTableOperadorTotal($table);


}


function calcularTableOperadorTotal($table){
    
    var totalOperador=0;

    $table.find('.monto-input').each(function(){
        totalOperador+=commaToNum($(this).text());
    })

    $table.find('.total-operador').text(numToComma(totalOperador));
}

$(function(){

    $('#dia-datepicker').datepicker({
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

    $('#date-select-panel-btn').click(function(e){
        e.preventDefault();
        var $wrapper=$('#consultas_wrapper');
        var dia=$('#dia-datepicker').val();
        var taquilla=$('#taquilla-input').val();
        var turno=$('#turno-input').val();
        var $btn= $(this);
        $wrapper.html('');
        $.ajax({
            url:$btn.data('url'),
            data:{fecha:dia, taquilla:taquilla, turno:turno}
        }).done(function(response, status, responseObject){
            $wrapper.html(response);
            $wrapper.find('.operador-table').each(function(){
                var $table=$(this);
                calcularTableOperadorTotal($table)
            })
        	$('#fecha-modal-input').datepicker({
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
                });
            $('#banco-modal-input').change();
            setTimeout(function(){
                if (typeof calculateTotalDepositar == 'function'){
                    calculateTotalDepositar();
                    calculateTotalPagar();

                }
            }, 1000);
    });

    $('body').delegate('#add-serie-btn', 'click', function(){
        if($('#serie-select option[disabled]:selected').length>0)
          return;
        var $option=$('#serie-select option:selected');
        var serie=$option.text();
        var value=$option.val();
        var inicio=$option.data('inicio');
        var monto=$('#monto-input').val();
        $option.attr('disabled', '');
        $('#serie-table tbody').append(
            '<tr> ' +
                '<td class="serie-td">' +
                    '<input type="hidden" name="serie[]" class="serie-val" value="'+value+'">' +
                    '<p class="form-control-static">'+serie+'</p>' +
                '</td> ' +
                '<td>' +
                    '<input name="desde[]" class="form-control text-right desde-input" value="'+inicio+'">' +
                '</td> ' +
                '<td>' +
                    '<input name="hasta[]" class="form-control text-right hasta-input">' +
                '</td> ' +
                '<td> ' +
                    '<div class="input-group"> ' +
                        '<span class="input-group-btn"> ' +
                            '<button type="button" class="btn btn-danger subtract-tasa" type="button">' +
                                '<span class="glyphicon glyphicon-minus"></span>' +
                            '</button> ' +
                        '</span> ' +
                        '<input name="cantidad[]" class="form-control  text-center cantidad-input" value="0"> ' +
                        '<span class="input-group-btn"> ' +
                            '<button type="button" class="btn btn-primary add-tasa" type="button">' +
                                '<span class="glyphicon glyphicon-plus"></span>' +
                            '</button> ' +
                        '</span> ' +
                    '</div> ' +
                '</td> ' +
                '<td>' +
                    '<input type="hidden" name="monto[]" class="serie-val" value="'+monto+'">' +
                    '<p class="form-control-static text-right bs-input">'+monto+'</p>' +
                '</td> ' +
                '<td>' +
                    '<p class="form-control-static text-right monto-input">0</p>' +
                '</td> ' +
                '<td>' +
                    '<button type="button" class="btn btn-danger delete-serie-btn">' +
                        '<span class="glyphicon glyphicon-minus"></span>' +
                    '</button>' +
                '</td> ' +
            '</tr>');

    })

    $('body').delegate('.delete-serie-btn','click',function(){

        var $row=$(this).closest('tr');
        var serieVal=$row.find('.serie-val').val();
        $('#serie-select option[value="'+serieVal+'"]').removeAttr('disabled');
        $row.remove();
    })


    $('body').delegate('.subtract-tasa','click',function(){
        calcularMonto(this,-1);
    })

    $('body').delegate('.add-tasa','click',function(){
        calcularMonto(this,1);
    })

    $('body').delegate('.cantidad-input','keyup',function(){
        calcularMonto(this,0);
    })
    var hastaTimeOut=null;
    $('body').delegate('.hasta-input, .desde-input','keyup keypress',function(e){
                
          var code = e.keyCode || e.which;
          if (code == 13) {
                clearTimeout(hastaTimeOut);
                var input=this;
                hastaTimeOut=setTimeout(function(){
                    var row=$(input).closest('tr');
                    var hastaInput=$(row).find('.hasta-input').val();
                    var desdeInput=$(row).find('.desde-input').val();
                    desdeInput=parseInt(desdeInput);
                    hastaInput=parseInt(hastaInput);
                    hastaInput=(isNaN(hastaInput)?0:hastaInput);
                    var cantidad=hastaInput-desdeInput+1;
                    $(row).find('.cantidad-input').val(cantidad);
                    calcularMonto(input,0);
                },500)
          }

    })

    $('body').delegate('.save-tasa-btn','click',function(e){

        var pagar     =commaToNum($('.total-a-pagar-doc-input').first().val());
        var depositar =commaToNum($('#total-a-depositar-doc-input').val());


        e.preventDefault();
        var $btn= $(this);
        var $form= $btn.closest('form');
        var $consulta= $form.closest('.consulta');
        var canUpload=true;
        var isSupervisor=$form.data('isSupervisor');
        $form.find('.hasta-input, .desde-input').each(function(index, value){
            if($(value).val()=="")
                canUpload=false;
        })
        var pagos=[];

        $('#formas-pago-table tbody tr').each(function(index,value){
            pagos.push($(value).data('object'));
        })
        var data=$form.serializeArray();
        data.push({name:'pagos', value:JSON.stringify(pagos)});

        console.log(data);
            

        if(canUpload){

        alertify.confirm("¿Desea guardar la ínformación?", function (e) {
            if (e) {
                $.ajax({
                    url: $form.data('url'),
                    data: data,
                    method: "POST"
                }).always(function(response, status, responseObject){
                    if(status!="error"){
                        if(isSupervisor){
                            $('#consultas_wrapper').html(response);
                        }else{
                            $form.closest('.consulta').html($(response).html());
                        }
                        alertify.success('Los datos han sido guardados.');
                    }else
                        alertify.error('Error procesando los datos en el servidor.');
                    });
                }    
            })
        }else{
            alertify.error('Los campos no pueden estar vacios.');
        }
    })

    $('body').delegate('.consolidar-tasa-btn','click',function(e){

        var pagar     =commaToNum($('.total-a-pagar-doc-input').first().val());
        var depositar =commaToNum($('#total-a-depositar-doc-input').val());
        var diferencia=commaToNum($('#total-diferencia-doc-input').val());


        if(pagar>depositar){
            alertify.error("El monto total no puede ser mayor al depositado.");
            return;
        }
        if(pagar < depositar){
            alertify.error("El monto depositado no puede ser mayor al monto total.");
            return;
        }
        if(pagar==0 || depositar==0){
            alertify.error("El monto a cobrar o depositado no pueden ser cero.");
            return;
        }
        if (diferencia != 0) {
            alertify.error("No se a completado la diferencia");
            return;
        }


        e.preventDefault();
        var $btn= $(this);
        var $form= $btn.closest('form');
        var $consulta= $form.closest('.consulta');
        var canUpload=true;
        var isSupervisor=$form.data('isSupervisor');
        $form.find('.hasta-input, .desde-input').each(function(index, value){
            if($(value).val()=="")
                canUpload=false;
        })
        var pagos=[];

        $('#formas-pago-table tbody tr').each(function(index,value){
            pagos.push($(value).data('object'));
        })

        var data=$form.serializeArray();
        data.push({name:'pagos', value:JSON.stringify(pagos)});
        data.push({name:'fecha', value:JSON.stringify($("input[name = 'fecha']").val())});
        data.push({name:'taquilla', value:JSON.stringify($("input[name = 'taquilla']").val())});

        console.log(data);
            

        if(canUpload){

        alertify.confirm("¿Desea guardar la ínformación?", function (e) {
            if (e) {
                $.ajax({
                    url: $form.data('url'),
                    data: data,
                    method: "POST"
                }).always(function(response, status, responseObject){
                    if(status!="error"){
                        if(isSupervisor){
                            $('#consultas_wrapper').html(response);
                        }else{
                            $form.closest('.consulta').html($(response).html());
                        }
                        alertify.success('Los datos han sido guardados.');
                    }else
                        alertify.error('Error procesando los datos en el servidor.');
                    });
                }    
            })
        }else{
            alertify.error('Los campos no pueden estar vacios.');
        }
    })

})
