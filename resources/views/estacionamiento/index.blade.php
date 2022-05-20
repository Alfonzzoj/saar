@extends('app')
@section('content')

       <div class="row" id="box-wrapper">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">ESTACIONAMIENTO</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-3 col-md-2">
                            <label>Modo de Carga</label>
                        </div>
                        <div class="col-xs-2 col-md-1 text-center">
                            <label class="radio-inline">
                                <input type="radio" name="date-radio" id="dia-radio" checked autocomplete="off"> Día
                            </label>
                        </div>
                        <div class="col-xs-2 col-md-1 text-center">
                            <label class="radio-inline">
                                <input type="radio" name="date-radio" id="rango-radio" autocomplete="off"> Rango
                            </label>
                        </div>
                        <div class="col-xs-4 col-md-7">
                            <div class="form-horizontal">
                                <div class="form-group" id="dia-div">
                                    <div class="col-xs-8 col-xs-offset-2  text-center">
                                        <div class="input-group">
                                            <input type="text" id="dia-datepicker" class="form-control" placeholder="Seleccione un día." autocomplete="off">
                                            <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" style="display:none" id="rango-div">
                                    <div class="col-xs-6 text-center">
                                        <div class="input-group">
                                            <input type="text" id="inicial-datepicker" class="form-control" placeholder="Seleccione el día inicial." autocomplete="off">
                                            <div class="input-group-addon"><span class="glyphicon glyphicon-calendar" ></span></div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 text-center">
                                        <div class="input-group">
                                            <input type="text" id="final-datepicker" class="form-control" placeholder="Seleccione el día final." autocomplete="off">
                                            <div class="input-group-addon"><span class="glyphicon glyphicon-calendar" ></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-1 col-md-1">
                            <button class="btn btn-default pull-right" id="date-select-panel-btn">
                            <span class="hidden-sm">ACEPTAR</span> <span class="glyphicon glyphicon-share-alt"></span></button>
                        </div>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

    <div class="modal fade" id="estacionamiento-cliente-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Gestión de usuarios de estacionamiento</h4>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label for="modal-nombre-input" class="col-sm-2 control-label">Nombre</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="modal-nombre-input" name="cliente_id" autocomplete="off">                                <option value="">--Seleccione una opcion--</option>
                                    @foreach($clientes as $cliente)
                                    <option
                                        data-rif="{{$cliente->cedRifPrefix}}-{{$cliente->cedRif}}"
                                        value="{{$cliente->id}}">
                                        {{$cliente->codigo}} | {{$cliente->nombre}}
                                    </option>
                                    @endforeach    
                                </select>                             
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="modal-rif-input" class="col-sm-2 control-label">RIF</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="modal-rif-input" placeholder="RIF">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="modal-cantidad-input" class="col-sm-2 control-label">Cantidad</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="modal-cantidad-input" placeholder="Cantidad de tarjetas por mes">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="modal-costoUnidad-input" class="col-sm-2 control-label">Costo unidad</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="modal-costoUnidad-input" placeholder="Costo de una tarjeta">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="modal-fechaSuscripcion-input" class="col-sm-2 control-label">Fecha de suscripcion</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="modal-fechaSuscripcion-input">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="modal-isActivo-check"> Activo
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="modal-save-client-btn">Guardar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@section('script')

<script>

var nTaquillasDefault ={{$estacionamiento->nTaquillas}};
var nTurnosDefault    ={{$estacionamiento->nTurnos}};
var conceptosDefault  ='{{!! $estacionamiento->conceptos !!}}';
conceptosDefault      =JSON.parse(conceptosDefault.substr(1, conceptosDefault.length-2));
var bancos            ='{{!! $bancos !!}}';
bancos                =JSON.parse(bancos.substr(1, bancos.length-2));

function tableConstructorDefault(nTaquillas, nTurnos, conceptos){

    var table='<table style="font-size:16px" class="table text-center tickets-table" data-n-taquillas="'+nTaquillas+'" data-n-turnos="'+nTurnos+'">\
    <thead> \
    <tr>\
    <th></th><th></th>';
    for(var k=0;k<nTaquillas; k++)
        table+='<th colspan="'+nTurnos*2+'">Taquilla '+(k+1)+'</th>';
    table+='</tr>\
    <tr>\
    <th></th><th></th>';
    for(var k=0;k<nTaquillas; k++)
    for(var j=0;j<nTurnos; j++)
        table+='<th colspan="2">Turno '+(j+1)+'</th>';
    table+='</tr>\
    <tr>\
    <th>Concepto</th><th>Bs.</th>';
    for(var k=0;k<nTaquillas; k++)
    for(var j=0;j<nTurnos; j++)
        table+='<th>Cantidad</th>\
        <th>Monto</th>';
    table+='</tr>\
    </thead>\
    <tbody>';
    $.each(conceptos, function(index,value){
        table+='<tr><td data-id="'+value.id+'" class="concepto-tickets-td" style="vertical-align: middle">'+value.nombre+'</td>' +
         '<td class="costo-tickets-td" style="vertical-align: middle">'
                      +numToComma(value.costo)+'</td>';
        for(var k=0;k<nTaquillas; k++)
        for(var j=0;j<nTurnos; j++)
            table+='<td style="vertical-align: middle" ><input \
            data-taquilla="'+k+'" \
            data-turno="'+j+'" \
            class="form-control text-right cantidad-tickets-input"/></td>\
            <td style="vertical-align: middle" ><input\
             data-taquilla="'+k+'" \
             data-turno="'+j+'" \
             class="form-control text-right monto-tickets-input" readonly/></td>';
        table+='</tr>';
    })
    table+='</tbody>\
    <tfoot>\
    <td><strong>Totales</strong></td><td></td>';
    for(var k=0;k<nTaquillas; k++)
    for(var j=0;j<nTurnos; j++)
        table+='<td></td>\
        <td class="total-tickets-td" style="text-align:right"'
        +'data-taquilla="'+k
        +'" data-turno="'+j+'" ><strong>0</strong></td>';
    table+='</tfoot>\
    </table>';
return table;
}

function tableConstructor(object){
    var nTaquillas=object.nTaquillas;
    var nTurnos=object.nTurnos;
    var table='<table style="font-size:16px" class="table text-center tickets-table" data-n-taquillas="'+nTaquillas+'" data-n-turnos="'+nTurnos+'">\
    <thead> \
    <tr>\
    <th></th><th></th>';
    for(var k=0;k<nTaquillas; k++)
        table+='<th colspan="'+nTurnos*2+'">Taquilla '+(k+1)+'</th>';
    table+='</tr>\
    <tr>\
    <th></th><th></th>';
    for(var k=0;k<nTaquillas; k++)
    for(var j=0;j<nTurnos; j++)
        table+='<th colspan="2">Turno '+(j+1)+'</th>';
    table+='</tr>\
    <tr>\
    <th>Concepto</th><th>Bs.</th>';
    for(var k=0;k<nTaquillas; k++)
    for(var j=0;j<nTurnos; j++)
        table+='<th>Cantidad</th>\
        <th>Monto</th>';
    table+='</tr>\
    </thead>\
    <tbody>';
    var conceptoId=null;
    $.each(object.tickets, function(index,value){
	console.log(value.monto);
        if(conceptoId!=null && conceptoId!=value.econcepto_id)
            table+='</tr>';
        if(conceptoId==null || conceptoId!=value.econcepto_id)
        table+='<tr><td data-id="'+value.id+'" class="concepto-tickets-td" style="vertical-align: middle">'
        +value.concepto.nombre+'</td>'+
        '<td class="costo-tickets-td" style="vertical-align: middle">'
        +value.costo+'</td>';
            table+='<td style="vertical-align: middle" ><input \
            data-taquilla="'+value.taquilla+'" \
            data-turno="'+value.turno+'" \
            class="form-control text-right cantidad-tickets-input" readonly value="'+value.cantidad+'" /></td>\
            <td style="vertical-align: middle" ><input\
             data-taquilla="'+value.taquilla+'" \
             data-turno="'+value.turno+'" \
             class="form-control text-right monto-tickets-input" readonly value="'+value.monto+'" /></td>';
        conceptoId=value.econcepto_id;

    })
    table+='</tbody>\
    <tfoot>\
    <td><strong>Totales</strong></td><td></td>';
    for(var k=0;k<nTaquillas; k++)
    for(var j=0;j<nTurnos; j++)
        table+='<td></td>\
        <td class="total-tickets-td" style="text-align:right"'
        +'data-taquilla="'+k
        +'" data-turno="'+j+'" ><strong>0</strong></td>';
    table+='</tfoot>\
    </table>';
return table;
}

function bancoOptionsConstructor(){
    var options="";
    $.each(bancos, function(index,value){
        options+="<option value='"+value.id+"'>"+value.nombre+"</option>";
    })
    return options;
}

function cuentasOptionsConstructor(banco){
    var options="";

    $.each(bancos, function(index,value){
        if(value.id==banco){
            banco=value;
            return false;
        }
    })

    $.each(banco.cuentas, function(index,value){
        options+="<option value='"+value.id+"'>"+value.descripcion+"</option>";
    })

   return options;
}


function updateClientesSelect(){
    $.ajax({
            url:'{{URL::to('estacionamiento/getClients')}}'
           }).done(function(response, status, responseObject){

                try{
                    var options="";
                    var clientes=JSON.parse(responseObject.responseText);
                    $.each(clientes, function(index, value){
                        options+="<option value='"+value.id+"' data-costo-unidad='"+value.costoUnidad+"'>"+value.nombre+"</option>";
                    })
                    $('.tarjeta-cliente-select option').remove();
                    $('.tarjeta-cliente-select').append(options);
                }catch(e){
                console.log(e);
                }

            })


}


function calcularTotalTarjetas(box){
     var trs=$(box).find('.tarjeta-table tbody tr:not(.control-row)');
     var total=0;
     $.each(trs, function(index, value){
        total+= commaToNum($(value).find('.tarjeta-total-tr-td').text());
     })

     $(box).find('.total-tarjetas-box').text(total);
    calcularTotalTickets(box);
 }

function calcularTotalTickets(box){
     var trs=$(box).find('.pago-tickets-table tbody tr:not(.control-row)');
     var total=0;
     $.each(trs, function(index, value){
        total+= commaToNum($(value).find('.tickets-total-tr-td').text());
     })

     $(box).find('.total-depositado-box').text(numToComma(total+commaToNum($(box).find('.total-tarjetas-box').text())));

 }

 function calcularTotal(box){
     var total=commaToNum($(box).find('.total-tarjetas-box').text())+commaToNum($(box).find('.total-tickets-box:eq(0)').text());
     $(box).find('.total-box').text(numToComma(total));
 }

 function checkDepositadoEqualsTotalTickets(box){
    var totalInput=$(box).find('.total-tickets-box');
    var depositadoInput=$(box).find('.depositado-tickets-box');
     var total=commaToNum($(totalInput).val());
     var depositado=commaToNum($(depositadoInput).val());
    depositado=isNaN(depositado)?0:depositado;
    if(total<=depositado){

    }else{

    }
 }


function tableTarjetasConstructor(object){
    var trs="";
    $.each(object.tarjetas, function(index,value){
       trs='<tr> ' +
       '<td>'+value.fecha+'</td>' +
       '<td>'+value.cliente.nombre+'</td>' +
       '<td>'+value.cantidad.toFixed(2)+'</td> '+
       '<td>'+value.banco.nombre+'</td>'+
       '<td>'+value.banco_cuenta.descripcion+'</td>'+
       '<td class="tarjeta-total-tr-td" style="text-align: right" >'+numToComma(value.total)+'</td>' +
       '<td>'+value.deposito+'</td>' +
       '</tr>';


    })
    return trs;
}

function tableTicketsConstructor(object){
    var trs="";
    $.each(object.depositos, function(index,value){
       trs+='<tr> ' +
       '<td>'+value.fecha+'</td>' +
       '<td>'+value.banco.nombre+'</td> ' +
       '<td>'+value.banco_cuenta.descripcion+'</td>' +
       '<td class="tickets-total-tr-td" style="text-align: right">'+numToComma(value.total)+'</td>' +
       '<td>'+value.deposito+'</td>' +
       '</tr>';

    })

    return trs;

}

$(document).ready(function(){

  $('#dia-datepicker,#final-datepicker,#inicial-datepicker, #modal-fechaSuscripcion-input').datepicker();
  $('#modal-nombre-input').chosen({width:'450px'});

 
  $('#rango-radio').change(function(){
    if($(this)[0].checked==true){
      $('#dia-div').hide();
      $('#rango-div').show();
    }
  })
  $('#dia-radio').change(function(){
    if($(this)[0].checked==true){
      $('#dia-div').show();
      $('#rango-div').hide();
    }
  })
  $('#date-select-back-btn').click(function(){
    $('#box-wrapper .box-item').remove();
    $('#date-select-back-panel').hide();
    $('#date-select-panel').show();
  })
  $('#date-select-panel-btn').click(function(){
    $('#box-wrapper > *:gt(0)').remove();
    var inicial;
    var fin;
    if($('#dia-radio:checked').length>0){
      var dia=$('#dia-datepicker').val().split("/");
      inicial=fin=(new Date(dia[2], parseInt(dia[1])-1, dia[0])).getTime();
    }else{
      inicial=$('#inicial-datepicker').val().split("/");
      inicial=(new Date(inicial[2], parseInt(inicial[1])-1, inicial[0])).getTime();
      fin=$('#final-datepicker').val().split("/");
      fin=(new Date(fin[2], parseInt(fin[1])-1, fin[0])).getTime();
    }
    if(inicial>fin){
      alertify.error("La fecha de inicio no puede ser mayor a la fecha de final.");
    }else{
      $('#date-select-panel').hide();
      $('#date-select-back-panel').show();
    }
    for(var i=inicial;i<=fin;i+=86400000){
      var date=$.datepicker.formatDate('dd/mm/yy', new Date(i));
      var box='<div class="col-md-12" class="box-item">\
      <div class="box box-primary">\
      <div class="box-header">\
      <div class="row">\
      <div class="col-md-12">\
      <h3 class="box-title">Detalle de estacionamiento del dia <span class="fecha-box">'+date+'</span> </h3>\
      </div>\
      </div>\
      </div> \
      </div>';
    box=$(box)
    $('#box-wrapper').append(box);
        $.ajax({
                url:'{{URL::to('estacionamiento/show')}}',
                data:{fecha:date},
                context:box
                }).done(function(response, status, responseObject){
                    try{
                    var object=null;

                    if(responseObject.responseText!=""){
                        object=JSON.parse(responseObject.responseText);
			console.log(object);
                    }

                        var boxBody='<div class="box-body">\
                                           <div class="row">\
                                           <div class="col-md-12">\
                                            <div class="table-responsive">'
                                            +((object==null)?
                                            tableConstructorDefault(nTaquillasDefault, nTurnosDefault, conceptosDefault):
                                            tableConstructor(object))+
                                           '</div>\
                                           <div class="col-md-12">\
                                           <p style="font-size:16px" class="text-right"><strong>Total ticket</strong>:Bs. <span class="total-tickets-box">0</span></p> \
                                           </div>\
                                           </div>\
                                           </div>\
                                           <h3 style="font-size: 18px">Pago de tickets</h3>\
                                           <div class="row">\
                                           <div class="col-xs-12">\
                                           <table class="table pago-tickets-table" style="font-size:16px">\
                                           <thead> \
                                           <tr>\
                                           <th>Fecha</th>\
                                           <th>Banco</th>\
                                           <th>Cuenta</th>\
                                           <th>Monto</th>\
                                           <th>Deposito</th>'
                                           +((object==null)?'<th>Acción</th>':'')+
                                           '</tr>\
                                           </thead>\
                                           <tbody>'
                                            +((object==null)?
                                            '<tr class="control-row"> \
                                            <td><input class="form-control  fecha" value="" data-empty="false" data-name="fecha deposito de tickets" /></td> \
                                            <td>\
                                            <select class="form-control pago-tickets-banco-select">'
                                            +bancoOptionsConstructor()+
                                            '</select>\
                                            </td>\
                                            <td>\
                                            <select class="form-control pago-tickets-cuenta-select" >\
                                            </select>\
                                            </td>\
                                            <td><input class="form-control monto-tickets-input text-right" value="" data-type="float" data-name="monto deposito de tickets"/></td>\
                                            <td><input class="form-control deposito-tickets-input" value="" data-empty="false" data-name="deposito de tickets"/></td>\
                                            <td><button class="btn btn-primary add-tickets"  ><span class="glyphicon glyphicon-plus"></span></button></td>\
                                            </tr>':
                                            tableTicketsConstructor(object))+
                                           '</tbody>\
                                           </table>\
                                           </div>\
                                           </div>\
                                           <h3  style="font-size: 18px">Pago de tarjetas electrónicas '
                                           +((object==null)?'<button class="btn btn-primary" data-toggle="modal" data-target="#estacionamiento-cliente-modal">\
                                           <span class="glyphicon glyphicon-user"></span>\
                                           </button>':'')+
                                           '</h3> \
                                           <div class="row">\
                                           <div class="col-xs-12">\
                                           <table class="table tarjeta-table" style="font-size:16px"> \
                                           <thead> \
                                           <tr> \
                                           <th>Fecha</th>\
                                           <th>Concesionario</th>\
                                           <th>Cantidad</th>\
                                           <th>Banco</th>\
                                           <th>Cuenta</th>\
                                           <th>Total</th>\
                                           <th>Deposito</th>'
                                           +((object==null)?'<th>Acción</th>':'')+
                                           '</tr>\
                                           </thead>\
                                           <tbody>'
                                          +((object==null)?
                                          '<tr class="control-row"> \
                                          <td><input class="form-control tarjeta-fecha-input fecha" data-empty="false" data-name="fecha deposito de tarjeta" value=""/></td> \
                                          <td>\
                                          <select class="form-control tarjeta-cliente-select" >\
                                          </select>\
                                          </td> \
                                          <td><input class="form-control tarjeta-cantidad-input text-right" value="" data-empty="false" data-name="cantidad de tarjeta" data-type="int" /></td> \
                                          <td>\
                                          <select class="form-control tarjeta-banco-select">'
                                          +bancoOptionsConstructor()+
                                          '</select>\
                                          </td>\
                                          <td>\
                                          <select class="form-control tarjeta-cuenta-select" >\
                                          </select>\
                                          </td>\
                                          <td><input class="form-control tarjeta-total-input text-right" value="" readonly/></td>\
                                          <td><input class="form-control tarjeta-deposito-input" value="" data-empty="false" data-name="deposito de tarjeta"/></td>\
                                          <td><button class="btn btn-primary add-tarjeta"  ><span class="glyphicon glyphicon-plus"></span></button></td>\
                                          </tr>':
                                          tableTarjetasConstructor(object))+
                                           '</tbody>\
                                           </table> \
                                           </div> \
                                           </div> \
                                           <p style="font-size:16px; margin-bottom:5px" class="text-right"><strong>Total ticket</strong>:Bs. <span class="total-tickets-box">0</span></p> \
                                           <p style="font-size:16px; margin-bottom:5px" class="text-right"><strong>Total tarjetas</strong>:Bs. <span class="total-tarjetas-box">0</span></p>\
                                           <p style="font-size:16px; margin-bottom:5px" class="text-right"><strong>Total</strong>:Bs. <span class="total-box">0</span></p>\
                                           <p style="font-size:16px; margin-bottom:5px" class="text-right"><strong>Depositado</strong>:Bs. <span class="total-depositado-box">0</span></p>\
                                           </div> \
                                           <div class="box-footer">'
                                           +((object==null)?
                                           '<button  class="btn btn-primary consolidar-btn">Consolidar</button> <button  class="btn btn-primary imprimir-btn"><span class="glyphicon glyphicon-file" disabled></span> Imprimir</button>':
                                           '<button  class="btn btn-primary imprimir-btn"><span class="glyphicon glyphicon-file"></span> Imprimir</button>')+
                                           '</div>';
                                           $(this).find('.box').append(boxBody);
                                                     $('.fecha').datepicker();
                                                     $('.tarjeta-banco-select, .pago-tickets-banco-select').trigger('change');
                                                     updateClientesSelect();
                                                     calcularTotalTarjetas(this);
                                                     calcularTotal(this);
                                           $(this).find('.cantidad-tickets-input').trigger('paste');
                    }catch(e){
                    console.log(e);
                    }

                })
    }






  })


 $('#box-wrapper').delegate('.add-tarjeta','click',function(){
 var box=$(this).closest('.box');
   var tr=$(this).closest('tr');
      var validarFormulario=isValid($(tr).find('input'))
      if(!validarFormulario.isValid){
      alertify.error(validarFormulario.text);
      return;


      }
   var fecha=$(tr).find('.tarjeta-fecha-input').val();
   var cliente=$(tr).find('.tarjeta-cliente-select option:selected').text();
   var clienteId=$(tr).find('.tarjeta-cliente-select').val();
   var cantidad=$(tr).find('.tarjeta-cantidad-input').val();
      var banco=$(tr).find('.tarjeta-banco-select option:selected').text();
      var bancoId=$(tr).find('.tarjeta-banco-select').val();
         var cuenta=$(tr).find('.tarjeta-cuenta-select option:selected').text();
         var cuentaId=$(tr).find('.tarjeta-cuenta-select').val();
   var total=$(tr).find('.tarjeta-total-input').val();
   var deposito=$(tr).find('.tarjeta-deposito-input').val();
       $(tr).find('input').val("");
   tr='<tr> <td>'
   +fecha
   +'</td> <td data-id="'+clienteId+'">'
   +cliente
   +'</td> <td  style="text-align:right">'
   +numToComma(cantidad)+'</td> <td  data-id="'+bancoId+'">'
   +banco+'</td> <td data-id="'+cuentaId+'">'
   +cuenta
   +'</td> <td class="tarjeta-total-tr-td"  style="text-align:right">'
   +numToComma(total)
   +'</td> <td>'
   +deposito
   +'</td> <td><button class="btn btn-danger delete-tarjeta" ><span class="glyphicon glyphicon-minus"></span></button></td> </tr>';
   $(this).closest('tbody').append(tr);
calcularTotalTarjetas(box);
calcularTotal(box);
 })
 $('#box-wrapper').delegate('.delete-tarjeta','click',function(){
  var box=$(this).closest('.box');
   $(this).closest('tr').remove();
calcularTotalTarjetas(box);
calcularTotal(box);
 })






 $('#box-wrapper').delegate('.add-tickets','click',function(){
 var box=$(this).closest('.box');
   var tr=$(this).closest('tr');
   var validarFormulario=isValid($(tr).find('input'))
   if(!validarFormulario.isValid){
   alertify.error(validarFormulario.text);
   return;


   }


   var fecha=$(tr).find('.fecha').val();
      var banco=$(tr).find('.pago-tickets-banco-select option:selected').text();
      var bancoId=$(tr).find('.pago-tickets-banco-select').val();
         var cuenta=$(tr).find('.pago-tickets-cuenta-select option:selected').text();
         var cuentaId=$(tr).find('.pago-tickets-cuenta-select').val();
   var monto=commaToNum($(tr).find('.monto-tickets-input').val());
   monto=isNaN(monto)?0:monto;
   var deposito=$(tr).find('.deposito-tickets-input').val();
       $(tr).find('input').val("");
   tr='<tr> <td>'
   +fecha
   +'</td><td data-id="'+bancoId+'">'
   +banco+'</td> <td data-id="'+cuentaId+'">'
   +cuenta
   +'</td> <td class="tickets-total-tr-td" style="text-align:right">'
   +numToComma(monto)
   +'</td> <td>'
   +deposito
   +'</td> <td><button class="btn btn-danger delete-ticket" ><span class="glyphicon glyphicon-minus"></span></button></td> </tr>';
   $(this).closest('tbody').append(tr);
calcularTotalTickets(box);
 })
 $('#box-wrapper').delegate('.delete-ticket','click',function(){
  var box=$(this).closest('.box');
   $(this).closest('tr').remove();
calcularTotalTickets(box);
 })

$('body').delegate('.cantidad-tickets-input','focusout paste',function(){
var box=$(this).closest('.box');
var data=$(this).data();
var tr=$(this).closest('tr');
var monto=commaToNum($(tr).find('.costo-tickets-td').text());
var totalInput=$(tr).find('.monto-tickets-input[data-turno="'+data.turno+'"][data-taquilla="'+data.taquilla+'"]');
var cantidadText=$(this).val();
var cantidad=parseInt(cantidadText);

if(cantidadText!="" && (isNaN(cantidad) || cantidad!=cantidadText))
    alertify.error("La cantidad debe ser un numero entero");
cantidad=isNaN(cantidad)?0:cantidad;
$(totalInput).val(numToComma(monto*cantidad));
var total=0;
$(box).find('.monto-tickets-input[data-turno="'+data.turno+'"][data-taquilla="'+data.taquilla+'"]').each(function(){
    var m=commaToNum($(this).val());
    total+= isNaN(m)?0:m;
})

$(box).find('.total-tickets-td[data-turno="'+data.turno+'"][data-taquilla="'+data.taquilla+'"]').html("<strong>"+numToComma(total)+"</strong>");
var totalBox=0;
$(box).find('.total-tickets-td').each(function(){

        var m=commaToNum($(this).text());
        totalBox+= isNaN(m)?0:m;
})
$(box).find('.total-tickets-box').text(numToComma(totalBox)).val(numToComma(totalBox));
calcularTotal(box);
})

$('body').delegate('.tarjeta-banco-select, .pago-tickets-banco-select', 'change', function(){
    var box=$(this).closest('.box');
    var cuentaSelect='.'+$(this).attr('class').replace("banco", "cuenta").replace("form-control ", "");
    cuentaSelect=$(box).find(cuentaSelect);
    $(cuentaSelect).find(' option').remove();
    $(cuentaSelect).append(cuentasOptionsConstructor($(this).val()));
})

$('body').delegate('.tarjeta-cantidad-input', 'keyup', function(){
    var tr=$(this).closest('tr');
    var costoUnidad=commaToNum($(tr).find('.tarjeta-cliente-select option:selected').data('costoUnidad'));
    var cantidad=$(this).val();
    cantidad=isNaN(cantidad)?0:cantidad;
    $(tr).find('.tarjeta-total-input').val(numToComma(costoUnidad*cantidad));
})


$('#estacionamiento-cliente-modal').on('shown.bs.modal', function () {
  $('#estacionamiento-cliente-modal input, #estacionamiento-cliente-modal select').val("").trigger('change');
})

$('#modal-nombre-input').change(function(){
    var value=$(this).val();
    var rif= $(this).find('option[value="'+value+'"]').data('rif');
    console.log(rif);
    $('#modal-rif-input').val(rif).attr('readonly');
})


$('#modal-save-client-btn').click(function(){
var cliente_id=$('#modal-rif-select').val();
if(cliente_id==""){
alertify.error("Debe seleccionar un cliente");
return;
}
   var nombre= $('#modal-nombre-input').val();
    var cantidad= $('#modal-cantidad-input').val();
    var costoUnidad= $('#modal-costoUnidad-input').val();
    var fechaSuscripcion= $('#modal-fechaSuscripcion-input').val();
    var isActivo= $('#modal-isActivo-check').is(':checked');
    $.ajax({
            url:'{{URL::to('estacionamiento/saveClient')}}',
            data:{
            "nombre":nombre,
            "cliente_id":cliente_id,
            "cantidad":cantidad,
            "costoUnidad":costoUnidad,
            "fechaSuscripcion":fechaSuscripcion,
            "isActivo":isActivo
            }}).done(function(response, status, responseObject){

                try{
                    var object=JSON.parse(responseObject.responseText);
                    alertify.log(object.text);
                    $('#estacionamiento-cliente-modal').modal('hide');
                }catch(e){
                console.log(e);
                }

            })

updateClientesSelect()
})





$('body').delegate('.consolidar-btn', 'click', function(){
    var box=$(this).closest('.box');
    var ticketsTable=$(box).find('.tickets-table');
    var nTaquillas=$(ticketsTable).data('nTaquillas');
    var nTurnos=$(ticketsTable).data('nTurnos');
    var fechaBox= $(box).find('.fecha-box').text();
    var totalBox= $(box).find('.total-box').text();
    var depositadoBox= $(box).find('.total-depositado-box').text();
    totalBox=commaToNum(totalBox);
    depositadoBox=commaToNum(depositadoBox);
    if(totalBox>depositadoBox){
        alertify.error("El valor depositado no puede ser menor al total de día.");
        return;
    }



    var tickets=[];
    $.each($(ticketsTable).find('tbody tr'), function(index,value){
        var concepto=$(value).find('.concepto-tickets-td').data('id');
        var costo=$(value).find('.costo-tickets-td').text();
        for(var k=0;k<nTaquillas; k++){
        var taquilla=k;
            for(var j=0;j<nTurnos; j++){
            var turno=j;

            var cantidad=parseInt($(value).find('.cantidad-tickets-input[data-turno="'+turno+'"][data-taquilla="'+taquilla+'"]').val());
            cantidad=isNaN(cantidad)?0:cantidad;
            var monto=commaToNum($(value).find('.monto-tickets-input[data-turno="'+turno+'"][data-taquilla="'+taquilla+'"]').val());
            monto=isNaN(monto)?0:monto;
            tickets.push({
                econcepto_id: concepto,
                taquilla:taquilla,
                turno:turno,
                costo:commaToNum(costo),
                cantidad:commaToNum(cantidad),
                monto:commaToNum(monto)
            });

            }
        }
    })

    var pagoTickets=$(box).find('.pago-tickets-table tbody tr:gt(0)');
    var depositoTickets=[];

    $.each(pagoTickets, function(index, value){
        var pagoTicketsFecha=$(value).find('td:eq(0)').text();
        var pagoTicketsBanco=$(value).find('td:eq(1)').data('id');
        var pagoTicketsCuenta=$(value).find('td:eq(2)').data('id');
        var pagoTicketsTotal=$(value).find('td:eq(3)').text();
        var pagoTicketsDeposito=$(value).find('td:eq(4)').text();

        depositoTickets.push({
        fecha:pagoTicketsFecha,
        banco_id:pagoTicketsBanco,
        bancoscuenta_id:pagoTicketsCuenta,
        total:commaToNum(pagoTicketsTotal),
        deposito:pagoTicketsDeposito
        })
    });

        var tarjetasTable=$(box).find('.tarjeta-table tbody tr:gt(0)');
        var tarjetas=[];
        $.each(tarjetasTable, function(index, value){
        var fecha=$(value).find('td:eq(0)').text();
        var cliente=$(value).find('td:eq(1)').data('id');
        var cantidad=$(value).find('td:eq(2)').text();
        var banco=$(value).find('td:eq(3)').data('id');
        var cuenta=$(value).find('td:eq(4)').data('id');
        var total=$(value).find('td:eq(5)').text();
        var deposito=$(value).find('td:eq(6)').text();
        tarjetas.push({
        fecha:fecha,
        estacionamientocliente_id:cliente,
        cantidad:commaToNum(cantidad),
        banco_id:banco,
        bancoscuenta_id:cuenta,
        total:commaToNum(total),
        deposito:deposito
        })

        })

        $.ajax({
        url: '{{action('EstacionamientoController@store')}}',
        method:'POST',
        context:box,
        data:{
        fecha:fechaBox,
        nTaquillas:nTaquillas,
        nTurnos:nTurnos,
        total:commaToNum(totalBox),
        depositado:depositadoBox,
        estacionamientooptickets:tickets,
        estacionamientoopticketsdepositos:depositoTickets,
        estacionamientooptarjetas:tarjetas
        }
        }).done(function(response, status, responseObject){

            try{
                var obj= JSON.parse(responseObject.responseText);
                if(obj.success==1){
                alertify.success('Registro guardado correctamente');
                      $(this).find('.control-row, .btn:not(.imprimir-btn)').remove();
                      $(this).find('.imprmir-btn').removeAttr('disabled');
                      $(this).find('.pago-tickets-table, .tarjeta-table').find('td:last, th:last').remove();
                      $(this).find('input').attr('readonly','');
                }else{
                alertify.error('Hubo un error guardando el registro');
                }
            }catch(e){
            alertify.error('Hubo un error guardando el registro');
            }


        })
})

})

 </script>


 @endsection
