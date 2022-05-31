@extends('app')

@section('content')

	<!--
	<script>
        $(document).ready(function(){
            $(document).on('change', 'input[type="checkbox"]', function(e){
                console.log("Hello");
            })
        });
	</script>
	-->

<ol class="breadcrumb">
	<li><a href="{{url('principal')}}">Inicio</a></li>
	<li><a href="#">Conciliación Bancaria</a></li>
	<li><a class="active">Crear</a></li>
</ol>
<div class="row" id="box-wrapper">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse">
						<i class="fa fa-minus"></i>
					</button>
				</div><!-- /.box-tools -->
			</div>
			<div class="box-body">
				{!! Form::open(["url" => action('ConciliacionController@getMovimientos'), "method" => "GET", "class"=>"form-inline"]) !!}
				{!! Form::hidden('sortName', null, []) !!}
				{!! Form::hidden('sortType', null, []) !!}
				<div class="form-inline">
	                <div class="form-group">
	                      {!! Form::select('anno', $annos, $anno, ["class"=> "form-control"]) !!}
	                </div>
					<div class="form-group">
						<select id="banco-select" name="banco_id" class="form-control" >
							<option value="">-- Seleccione Banco --</option>
							@foreach($bancos as $banco)
							<option value="{{$banco->id}}" data-cuentas='{!!$banco->cuentas!!}'  data-nombre="{{$banco->nombre}}">{{$banco->nombre}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<select id="cuenta-modal-input" name="cuenta_id" class="form-control">
							<option value="">-- Seleccione Cuenta Bancaria --</option>
						</select>
					</div>
					<div class="form-group">
						<select class="form-control search-parm-select" name="tipo" id="formaPago-select" autocomplete="off">
							<option value="">-- Seleccione Forma de Pago --</option>
							<option value="T">Transferencia Bancario</option>
							<option value="D">Depósito Bancario</option>
							<option value="NC">Nota de Crédito</option>
						</select>
					</div>
					<!-- <div class="form-group">
						<input class="form-control" id="referencia-input" name="ncomprobante" autocomplete="off" value="{{ $ncomprobante }}" placeholder="Nro de Referencia/Lote" />
					</div> -->
				</div>
				<div class="form-inline">
					<!--
					<div class="form-group">
						<input class="form-control datepicker" name="fecha_inicio" id="fecha_inicio-input"  autocomplete="off" value="" placeholder="Fecha Inicio" />
					</div>
					<div class="form-group">
						<input class="form-control datepicker" name="fecha_fin" id="fecha_fin-input" autocomplete="off" value="" placeholder="Fecha Fin" />
					</div>
					-->
						<div class="form-group">
							<input class="form-control datepicker" name="fecha" id="fecha-input" autocomplete="off" value="{{ $fecha }}" placeholder="Fecha" />
						</div>
					<div class="form-group">
						<input class="form-control " name="cobro_id" id="cobro-input" autocomplete="off" value="{{ $cobro_id }}"  placeholder="Nro de Cobro" />
					</div>
					<div class="form-group">
						<input class="form-control " name="ncomprobante" id="ncomprobante-input" autocomplete="off" value="{{ $ncomprobante }}"  placeholder="Nro de referencia" />
					</div>
				</div>
				<div class="form-inline text-right">
					<button type="submit" class="btn btn-primary">Buscar</button>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body" >
				<div class="row">
					<div class="col-xs-12">
						<div class="col-md-8">
							<label for="Femision-input"><b>SELECCIONE LOS MOVIMIENTOS A CONCILIAR</b></label>
						</div>
						<div class="col-md-12 text-right">
							<button type="button" class="btn btn-success" id="select-all-btn">Seleccionar todos</button>
						</div>
						<div class="col-md-10" id="movimientos-checkbox" >
							@if($movimientos->count() > 0)
								{{-- @foreach($movimientos as $movimiento)
							<span style="margin-left: 60px" >FECHA | BANCO | CUENTA | TIPO | REFERENCIA | MONTO</span>
								<div class="checkbox" >
									<label>
										<input id="mov-checkbox" name="contratos-checkbox" type="checkbox" data-monto="{{ $movimiento->monto }} ">
										{{ $movimiento->fecha }} | {{ $movimiento->banco->nombre }} | {{ $movimiento->cuenta->descripcion }} | {{ $movimiento->tipo }} | {{ $movimiento->ncomprobante }} | {{ $traductor->format($movimiento->monto) }}
									</label>
								</div>
								@endforeach
 --}}

 								<table class="table text-center" id="movimientos-table">
									<thead>
										<tr>
											<th colspan="1"></th>
											<th colspan="1">Origen</th>
											<th colspan="2">Fecha</th>
											<th colspan="1">Nro. Cobro</th>
											<th colspan="4">Banco</th>
											<th colspan="5">Cuenta</th>
											<th colspan="3">Tipo</th>
											<th colspan="3">Referencia</th>
											<th colspan="5">Monto</th>
										</tr>
									</thead>
									<tbody>
										@foreach($movimientosCobros as $movimiento)
											<tr>
												<td colspan="1">
													<input class="box" 
														   type="checkbox" 
														   name="movimientos-checkbox"
														   value="{{ $movimiento->id }}"
														   onclick = "aplicar()"
														   data-origen="C"
														   data-monto="{{ $movimiento->monto }}" 
														   data-bancoid="{{ $movimiento->banco_id }}" 
														   data-cuentaid="{{ $movimiento->cuenta_id }}" 
														   data-banco="{{ $movimiento->banco->nombre }}" 
														   data-cuenta="{{ $movimiento->cuenta->descripcion }}" 
														   data-cobro="{{ ($movimiento->cobro_id)?$movimiento->cobro_id:'' }}"
														   data-referencia="{{ $movimiento->ncomprobante }}"
														   data-movimiento="{{ $movimiento->cobrospagos_id }}"/>
												</td>
												<td colspan="1">
													COBROS
												</td>
												<td colspan="2">
													{{ date("d-m-Y", strtotime($movimiento->cobrospagos_fecha)) }}
												</td>
												<td colspan="1">
													{{ ($movimiento->cobro_id)?$movimiento->cobro_id:'N/A' }}
												</td>
												<td colspan="4">
													{{ $movimiento->banco->nombre }}
												</td>
												<td colspan="5">
													{{ $movimiento->cuenta->descripcion }}
												</td>
												<td colspan="3">
													{{ $movimiento->tipo }}
												</td>
												<td colspan="3">
													{{ $movimiento->ncomprobante }}
												</td>
												<td colspan="5">
													<span class="amount">{{ $traductor->format($movimiento->monto) }}</span>
												</td>
											</tr>
										@endforeach
										@foreach($movimientosTasas as $movimiento)
											<tr>
												<td colspan="1">
												<input class="box"
													   type="checkbox"
													   name="movimientos-checkbox"
													   onclick = "aplicar()"
													   value="{{ $movimiento->id }}"
													   data-origen="T"
													   data-monto="{{ $movimiento->monto }}"
													   data-bancoid="{{ $movimiento->banco_id }}"
													   data-cuentaid="{{ $movimiento->cuenta_id }}"
													   data-banco="{{ $movimiento->banco->nombre }}"
													   data-cuenta="{{ $movimiento->cuenta->descripcion }}"
													   data-cobro="{{ ($movimiento->tasa_cobro_id)?$movimiento->tasa_cobro_id:'' }}"
													   data-referencia="{{ $movimiento->ncomprobante }}"
													   data-movimiento="{{ $movimiento->tasa_cobro_detalles_id }}"/>
												</td>
												<td colspan="1">
													TASAS
												</td>
												<td colspan="2">
													{{ date("d-m-Y", strtotime($movimiento->tasa_cobro_detalles_fecha)) }}
												</td>
												<td colspan="1">
													{{ ($movimiento->tasa_cobro_id)?$movimiento->tasa_cobro_id:'N/A' }}
												</td>
												<td colspan="4">
													{{ $movimiento->banco->nombre }}
												</td>
												<td colspan="5">
													{{ $movimiento->cuenta->descripcion }}
												</td>
												<td colspan="3">
													{{ $movimiento->tipo }}
												</td>
												<td colspan="3">
													{{ $movimiento->ncomprobante }}
												</td>
												<td colspan="5">
													<span class="amount">{{ $traductor->format($movimiento->monto) }}</span>
												</td>
											</tr>
										@endforeach
											<tfooter>
												<td colspan="8" class="text-right">
													<button  class="btn btn-primary pull-right" id="aplicar-btn">Calcular</button>
												</td>
											</tfooter>
									</tbody>
								</table>
							@else
								<span>No hay registros disponibles para los datos suministrados</span>
							@endif
						</div>

 
						{{-- <div class="row">
						     <div class="col-xs-12 text-center">
						          {!! $movimientos->appends(Input::except('page'))->render() !!}
						     </div>
						</div>  --}}

						<div class="col-md-8" style="margin-top: 20px">
							<label>
								<b>INFORMACIÓN A APLICAR</b>
							</label>
						</div>
						<div class="col-md-8" style="margin-top: 20px; margin-left: 25px">

							<div class="form-inline">
								<label for="active-input">Fecha de Conciliación</label>
								<div class="form-group">
	                                <div class="input-group">
										    <input class='form-control datepicker today text-center' id="today-input" value="{{$today->format('d/m/Y')}}" /></td>
	                                </div>
								</div>
								<label for="active-input">	| Fecha de Banco</label>
								<div class="form-group">
									<input class="form-control text-right" type="hidden" id="origen" >
									<input class="form-control datepicker today text-center" type="text" name="fecha_banco-input" value="{{ $fecha }}" id="fecha_banco-input" placeholder="Fecha">
									<input class="form-control datepicker today text-center" type="hidden" name="referencia" id="referencia">
									<input class="form-control text-right" type="hidden" id="banco_id" >
									<input class="form-control text-right" type="hidden" id="cuenta_id" >
									<input class="form-control text-right" type="hidden" id="banco" >
									<input class="form-control text-right" type="hidden" id="cuenta" >
									<input class="form-control text-right" type="hidden" id="cobros" >
									<input class="form-control text-right" type="hidden" id="movimientos" >
								</div>
								<label for="active-input">	| Monto Actual</label>
								<div class="form-group">
									<input class="form-control text-right" type="text" name="monto_lote" id="monto_lote-input" placeholder="Monto Actual">
								</div>
								</br>
								</br>
								<!--
								<label for="active-input">	Com. Tranferencia</label>
								<div class="form-group">
									<input class="form-control text-right" type="text" name="com_tran" id="com_tran-input" placeholder="Com. Tranferencia" >
								</div>
								<label for="active-input">	| Com. Tarjeta Crédito</label>
								<div class="form-group">
									<input class="form-control text-right" type="text" name="com_tdc" id="com_tdc-input" placeholder="Com. Tarjeta Crédito">
								</div>
								<label for="active-input">	| Com. Deposito</label>
								<div class="form-group">
									<input class="form-control text-right" type="text" name="com_tdc" id="com_tdc-input" placeholder="Com. Tarjeta Crédito">
								</div>
								</br>
								</br>
								-->
								<label for="active-input">	Monto Banco</label>
								<div class="form-group">
									<input class="form-control text-right" type="text" name="monto_banco" id="monto_banco-input" placeholder="Monto Banco">
								</div>
								<label for="active-input">	| Diferencia</label>
								<div class="form-group">
									<input class="form-control text-right" type="text" name="comision_bancaria" id="comision_bancaria-input" placeholder="Comisión Bancaria" disabled>
								</div>
								</br>
							</div>
						</div>
						<div class="col-md-12">
							<button type="submit" class="btn btn-primary pull-right" id="generar-btn">Generar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body" >
				<div class="row">
					<div class="col-xs-12">
						<table class="table" id="conciliacion-table">
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script>
    Array.prototype.removeDuplicates = function () {
        return this.filter(function (item, index, self) {
            return self.indexOf(item) == index;
        });
    };



	$(document).ready(function(){


		$('#select-all-btn').click(function(){
			var $unCheckedChecks=$('#movimientos-checkbox [type=checkbox]:not(:disabled):not(:checked)');
			if($unCheckedChecks.length==0)
				$('#movimientos-checkbox [type=checkbox]:not(:disabled)').iCheck('uncheck');
			else
				$('#movimientos-checkbox [type=checkbox]:not(:disabled)').iCheck('check');

		});

        function aplicar() {
            console.log("Hello");
        }





        $('#monto_banco-input').keyup(function(event) {
            var diferencia        = 0;
            var monto             = commaToNum($('#monto_lote-input').val());
            var monto_banco       = commaToNum($('#monto_banco-input').val());
            var comision_bancaria = monto - monto_banco;
            $('#comision_bancaria-input').val(numToComma(comision_bancaria));
        });

        $('#monto_banco-input').keyup(function(event) {
            var diferencia        = 0;
            var monto             = commaToNum($('#monto_lote-input').val());
            var monto_banco       = commaToNum($('#monto_banco-input').val());
            var comision_bancaria = monto - monto_banco;
            $('#comision_bancaria-input').val(numToComma(comision_bancaria));
        });



		$('#aplicar-btn').click(function(event) {


            $('#generar-btn').attr('disabled','disabled');
		   var total = 0;
		   var cobros = [];
		   var movimientos = [];
		   var referencia = [];
		   var origen = [];
		   var cuenta;
		   var cuenta_id;
		   var banco_id;
		   var banco;

	       $('input[type=checkbox]:checked').each(function(i){
				total          	+=$(this).data('monto');
				cobros[i]      	=$(this).data('cobro');
				movimientos[i] 	=$(this).data('movimiento');
                referencia[i]	=$(this).data('referencia');
                origen[i]		=$(this).data('origen');
                cuenta        	=$(this).data('cuenta');
                cuenta_id     	=$(this).data('cuentaid');
                banco_id      	=$(this).data('bancoid');
                banco         	=$(this).data('banco');
	       });
	       $('#monto_lote-input').val(numToComma(total));
            $('#monto_banco-input').val(numToComma(total));

            var monto             = commaToNum($('#monto_lote-input').val());
            var monto_banco       = commaToNum($('#monto_banco-input').val());
            var comision_bancaria = monto - monto_banco;
            $('#comision_bancaria-input').val(numToComma(comision_bancaria));

            referencia = referencia.removeDuplicates();

            if (referencia.length == 0) {
                alertify.error("Debe seleccionar al menos un movimiento");
                $('#conciliacion-table').html('');
                $('#monto_lote-input').val(numToComma(0));
                $('#monto_banco-input').val(numToComma(0));
			} else if (referencia.length > 1) {
                alertify.error("No se pueden procesar movimientos con referencias diferentes");
                $('#conciliacion-table').html('');
                $('#monto_lote-input').val(numToComma(0));
                $('#monto_banco-input').val(numToComma(0));
			} else {
                $('#referencia').val(referencia);
                $('#origen').val(origen);
                $('#cobros').val(cobros);
                $('#movimientos').val(movimientos);
                $('#banco_id').val(banco_id);
                $('#cuenta_id').val(cuenta_id);
                $('#banco').val(banco);
                $('#cuenta').val(cuenta);
                $('#comision_bancaria-input').val(numToComma(comision_bancaria));
                $('#generar-btn').removeAttr('disabled');
			}

	       //referencia = $('#referencia-input').val();


		});





		$('#generar-btn').click(function() {
                var table ="";
            	var origen        	   = $('#origen').val();
				var fecha_banco        = $('#fecha_banco-input').val();
				var monto_lote         = $('#monto_lote-input').val();
				var monto_banco        = $('#monto_banco-input').val();
				var referencia         = $('#referencia').val();
				var banco_id           = $('#banco_id').val();
				var cuenta_id          = $('#cuenta_id').val();
				var banco              = $('#banco').val();
				var cuenta             = $('#cuenta').val();
				var comision_bancaria  = $('#comision_bancaria-input').val();
				var fecha_conciliacion = $('#today-input').val();
				var cobros             = $('#cobros').val();
				var movimientos        = $('#movimientos').val();
			

 				table="<table class='table' id='conciliacion-table'>" +

						"<thead>" +
                    		"<th>Origen</th>" +
							"<th>Fecha Conc.</th>" +
                    		"<th>Fecha Banc.</th>" +
							"<th>Banco</th>" +
							"<th>Nro. Cuenta</th>" +
							"<th>Nro. Ref/Lote</th>" +
							"<th>Monto Lote</th>" +
							"<th>Monto Banco</th>" +
							"<th>Comisión</th>" +
						"</thead>" +
						"<tbody>" +
						" <tr " +
                      		 "data-origen='" + origen+"' "+
			 				 "data-fecha_conciliacion='" + fecha_conciliacion+"' "+
			 				 "data-fecha_banco='" + fecha_banco+"' "+
			 				 "data-banco_id='" + banco_id+"' "+
			 				 "data-cuenta_id='" + cuenta_id+"' "+
			 				 "data-referencia='" + referencia+"' "+
			 				 "data-monto_lote='" + monto_lote+"' "+
			 				 "data-monto_banco='" + monto_banco+"' "+
			 				 "data-comision_bancaria='" + comision_bancaria+"' "+
			 				 "data-cobros='" + cobros+"' "+
			 				 "data-movimientos='" + movimientos+"' "+
			 			">" +
                    			"<td class='text-center'>	<input class='form-control ' id='origen-td' type='hidden' value='"+origen+"' />" +
									"<input class='form-control ' readonly value='"+ origen +"' /></td>" +
		                        "<td class='text-center'>	<input class='form-control ' id='fecha_conciliacion-td' type='hidden' value='"+fecha_conciliacion+"' />" +
									"<input class='form-control ' id='fecha_conciliacion-td' readonly value='"+fecha_conciliacion+"' /></td>" +
                    			"<td class='text-center'>	<input class='form-control ' id='fecha_banco-td' type='hidden' value='"+fecha_banco+"' />" +
                    				"<input class='form-control ' id='fecha_banco-td' readonly value='"+fecha_banco+"' /></td>" +
		                        "<td class='text-center'>	<input class='form-control ' id='banco_id-td' type='hidden' value='"+banco_id+"' />	" +
									"<input class='form-control' readonly value='"+banco+"' /></td>" +
		                        "<td class='text-center'>	<input class='form-control ' id='cuenta_id-td' type='hidden' value='"+cuenta_id+"' />					" +
									"<input class='form-control' readonly value='"+ cuenta+"' /></td>" +
		                        "<td class='text-center'>	<input class='form-control ' id='movimientos-td' type='hidden' value='"+movimientos+"' />" +
									"<input class='form-control ' id='cobros-td' type='hidden' value='"+cobros+"' />" +
										"<input class='form-control ' id='referencia-td' readonly value='"+referencia+"' /></td>" +
		                        "<td class='text-right'>	<input class='form-control ' id='monto_lote-td' readonly value='"+monto_lote+"' /></td>" +
		                        "<td class='text-right'>	<input class='form-control ' id='monto_banco-td' readonly value='"+monto_banco+"' /></td>" +
		                        "<td class='text-right'>	<input class='form-control ' id='comision_bancaria-td' readonly value='"+comision_bancaria+"' /></td>" +
		                    " </tr>"+
		                "</tbody>"+
						"<tfooter>" +
								"<td colspan='8' class='text-right'>" +
									"<button  class='btn btn-primary pull-right' id='confirmar-btn'>Confirmar</button>" +
								"</td>" +
							"</tfooter>" +
						"</table>";

                $('#conciliacion-table').html(table);
                $('[data-toggle="tooltip"]').tooltip();

 		});


 		$('body').delegate('#confirmar-btn', 'click', function(){
 		    var $trs =$('#conciliacion-table tbody tr:first');
 		    
            var movimientos=[];
            $trs.each(function(index, value){
                $(value).data('origen', $(value).find('#origen-td').val());
                $(value).data('fecha_banco', $(value).find('#fecha_banco-td').val());
                $(value).data('fecha_conciliacion', $(value).find('#fecha_conciliacion-td').val());
                $(value).data('banco_id', $(value).find('#banco_id-td').val());
                $(value).data('cuenta_id', $(value).find('#cuenta_id-td').val());
                $(value).data('referencia', $(value).find('#referencia-td').val());
                $(value).data('monto_lote', $(value).find('#monto_lote-td').val());
                $(value).data('monto_banco', $(value).find('#monto_banco-td').val());
                $(value).data('comision_bancaria', $(value).find('#comision_bancaria-td').val());
                $(value).data('cobros', $(value).find('#cobros-td').val());
                $(value).data('movimientos', $(value).find('#movimientos-td').val());
                movimientos.push($(value).data());
            })
			console.log (movimientos);


            alertify.confirm("¿Está seguro que desea guardar la información?", function (e) {
                if (e) {
                    $.ajax({
                    method:'POST',
                    url:"{{action('ConciliacionController@store')}}",
                    data:{movimientos:movimientos}
                    }).always(function(response, status, responseObject){
                        console.log(responseObject.responseText);
                    	//var respuesta=JSON.parse(responseObject.responseText);
                        if(status!="error"){
                            if(response.status==500){
                                alertify.error("Se produjo un error en el servidor.");
                            } else {
                                //alertify.success(respuesta.text);
                                alertify.success("Se registro exitosamente.");
                                window.location = "{{action('ConciliacionController@index')}}";
                            }
                        }
                        else{
                            alertify.error("Se produjo un error en el servidor.");
                        }
                    })
                }
            });
 		});






//		$('.datepicker').inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});

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
			dateFormat: 'yy-mm-dd'});

		$('#banco-select').change(function(){
			var cuentas=$(this).find(':selected').data('cuentas');
			cuentas=eval(cuentas);
			var options="";
			$.each(cuentas,function(index,value){
				options+="<option value='"+value.id+"'>"+value.descripcion+"</option>";
			})
			var seleccione = "<option value=''>-- Seleccione cuenta Bancaria --</option>\ ";
			options=seleccione+options;
			$('#cuenta-modal-input').html(options);
		}).trigger('change');
	})
</script>
@endsection