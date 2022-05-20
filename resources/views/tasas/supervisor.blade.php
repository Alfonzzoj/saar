@extends('app')

@section('content')
    <div class="row" id="box-wrapper">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Tasas supervisor</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <select class="form-control" id="taquilla-input">
                                <option value="TQ">Regulares</option>
                                <option value="CV"  @if(session('rolUsuario')->id == '2' || session('rolUsuario')->id == '10') selected @endif>Control de vuelo</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="form-horizontal">
                                <div class="form-group" id="dia-div">
                                    <div class="col-xs-8 col-xs-offset-2  text-center">
                                        <div class="input-group">
                                            <input type="text" id="dia-datepicker" class="form-control" placeholder="Seleccione un día." value="{{ $today }}" autocomplete="off">
                                            <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-default pull-right" id="date-select-panel-btn" data-url="{{action('TasaController@getSupervisorOperacion')}}"><span class="hidden-sm">Aceptar</span> <span class="glyphicon glyphicon-share-alt"></span></button>
                        </div>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
        <div id="consultas_wrapper">
        </div>
    </div>

@include('cobranza.partials.pagoModal')


@endsection

@section('script')

    <script>

        function calculateTotalPagar(){
        	var total = 0;
        	$('.totales-tasas').each(function(index,value){
        		total+=commaToNum($(value).text().trim());
        	})

        	$('.total-a-pagar-doc-input').val(numToComma(total));
            $('#total').html(numToComma(total));
            $('#total-serie').html(numToComma(total));
            $('#total').html(numToComma(total));
        	$('#total-diferencia-doc-input').val(numToComma(commaToNum($('#total-a-depositar-doc-input').val())-total));
        }


        function calculateTotalDepositar(){
        	var total  =0;
        	$('#formas-pago-table tbody tr').each(function(index,value){
        		var o =commaToNum($(value).find('td:eq(5)').text().trim());
        		total +=o;
        	});

        	$('#total-a-depositar-doc-input').val(numToComma(total));
        	$('#total-diferencia-doc-input').val(numToComma(total-commaToNum($('.total-a-pagar-doc-input').val())));
        }

        @include('tasas.partials.script')
        $(function(){
            	$('#accept-deposito-modal-btn').click(function(){

            		var o={
            			tipo:$('#forma-modal-input option:selected').val(),
            			fecha:$('#fecha-modal-input').val(),
            			banco_id:$('#banco-modal-input option:selected').val(),
            			cuenta_id:$('#cuenta-modal-input option:selected').val(),
            			ncomprobante:$('#deposito-modal-input').val(),
            			monto:commaToNum($('#monto-modal-input').val())
            		};
            		if(o.ncomprobante=="" || o.fecha=="" || o.monto==""){
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
            });

            $('body').delegate('.remove-payment-btn', 'click', function(){
            	$(this).closest('tr').remove();
            	calculateTotalDepositar();
            });

            $('body').delegate('.register-payment-btn','click',function(){
            	var diferencia=commaToNum($('#total-diferencia-doc-input').val());
            	if(diferencia<0)
            		$('#register-payment-modal #monto-modal-input').val(numToComma(Math.abs(diferencia)));
            	$('#register-payment-modal').modal('show');

            });

            $('body').delegate('#banco-modal-input', 'change', function(){
            	var cuentas=$(this).find(':selected').data('cuentas');
            	cuentas=eval(cuentas);
            	var options="";
            	$.each(cuentas,function(index,value){
            		options+="<option value='"+value.id+"'>"+value.descripcion+"</option>";
            	})
            	var seleccione = "<option>Seleccione</option>\ ";
            	options=seleccione+options;
            	$('#cuenta-modal-input').html(options);
            });
        });


    </script>

@endsection
