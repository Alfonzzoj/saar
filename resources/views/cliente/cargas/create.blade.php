@extends('app')
@section('content')

<div class="row">
	<section class="col-lg-11">
		<!-- Content Header (Page header) -->

		<ol class="breadcrumb">
			<li><a href="{{url('principal')}}">Inicio</a></li>
			<li><a id="listado-cargas" href="{{action('CargaController@index')}}">Lista de Cargas</a></li>
			<li><a id="registro-cargas" class="active">Registro</a></li>
		</ol>
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				<?php $fecha = date('d/m/Y'); ?>
				<i class="fa fa-truck"></i> Registro de Cargas
			</h1>
		</section>

		<!-- Main content -->
		<section class="content ">

			<!-- Main row -->
			<div class="row">
				<!-- Left col -->
				<section class="col-md-12">
					<div class="box box-primary">
						<div class="box-body" id="cargaForm-div">
							<form id="carga-form">
								<legend>Información del Vuelo</legend>

								<div class="form-inline col-md-12" style="margin-bottom: 20px">
									<!-- Fecha  -->
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input id="fecha-datepicker" type="text" name="fecha" class="form-control no-vacio" value="{{$today->format('d/m/Y')}}" placeholder="Fecha" />
											<input type="hidden" name="aeropuerto_id" value="{{session('aeropuerto')->id}}"></input>
										</div><!-- /.input group -->
									</div><!-- /.form group -->
									<div class="form-group">
										<div class="form-inline" style="margin-left: 100px">
											<!-- Condición de Pago -->
											<div class="form-group">
												<label><strong>Condición de pago: </strong></label>
												<div class="input-group">
													<select name="condicionPago" id="condicionPago-select" class="form-control">
														<option value="Crédito"> Crédito</option>
														<option value="Contado"> Contado</option>
													</select>
													<div class="input-group-addon">
													</div>										
												</div><!-- /.input group -->
											</div><!-- /.form group -->
										</div><!-- /.form group -->
									</div><!-- /.form group -->
								</div>

								<div class="form-inline col-md-12">

									<!-- Cliente-->
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-addon">
												<i class="ion ion-person"></i>
											</div>
											<select name="cliente_id" id="cliente_id-select" class="form-control cliente no-vacio" style="width: 500px">
												<option value="">--Cliente--</option>
												@foreach ($clientes as $index=>$cliente)
												<option value="{{$index}}"> {{$cliente}}</option>
												@endforeach
											</select>
										</div><!-- /.input group -->
									</div><!-- /.form group -->
								</div>

								<div class="form-inline col-md-12" style="margin-top: 20px; margin-right: -20px">


									<input type="hidden" name="" id="precio_bloque" class="form-control" value="{{$precios_cargas->equivalenteUT}}" autocomplete="off">	
									<input type="hidden" name="" id="toneladas_bloque" class="form-control" value="{{$precios_cargas->toneladaPorBloque}}" autocomplete="off">	
									<input type="hidden" name="" id="ut" class="form-control" value="{{$montos_fijos->unidad_tributaria}}" autocomplete="off">	

									

									<!-- Peso de Embarque -->
									<div class="form-group col-md-4" style="margin-right: 10px" >
										<label>Peso Embarcado</label>
										<div class="input-group">
											<input type="text" name="peso_embarcado" value="0" id="peso_embarcado" placeholder="Peso Embarcado" class="form-control no-vacio"/>
											<div class="input-group-addon">
												Kg(s) <i class="ion ion-soup-can-outline"></i>
											</div>
										</div><!-- /.input group -->
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-money"></i> BsF.
											</div>
											<input type="text" disabled value="0" id="peso_embarcado_monto" placeholder="Peso Embarcado" class="form-control"/>
										</div><!-- /.input group -->
									</div><!-- /.form group -->


									<!-- Peso de Desembarque -->
									<div class="form-group col-md-4">
										<label>Peso Desembarcado</label>
										<div class="input-group">
											<input type="text"  name="peso_desembarcado" value="0" id="peso_desembarcado" placeholder="Peso Desembarcado" class="form-control no-vacio"/>
											<div class="input-group-addon ">
												Kg(s) <i class="ion ion-soup-can-outline"></i>
											</div>
										</div><!-- /.input group -->
										<div class="input-group">
											<div class="input-group-addon ">
												<i class="fa fa-money"></i> BsF.
											</div>
											<input type="text"  disabled value="0" id="peso_desembarcado_monto" placeholder="Peso Desembarcado" class="form-control"/>
										</div><!-- /.input group -->
									</div><!-- /.form group -->
								</div>

								<!-- Observaciones --> 
								<div class="form-group col-md-12" style="margin-top: 20px">
									<label>Observaciones </label>
									<div class="input-group col-md-12">
										<textarea type="text" name="observaciones" class="form-control"></textarea>
									</div><!-- /.input group -->
								</div><!-- /.form group -->	

								<!-- Precio en BsF. -->
								<div class="form-group" align="right" style="margin-top: 60px">
									<label>Total: </label>
									<div class="input-group col-md-3">
										<div class="input-group-addon">
											<i class="fa fa-money"></i> BsF. 
										</div>
										<input type="text" name="monto_total" id="monto_total" class="form-control no-vacio" />
									</div><!-- /.input group -->
								</div><!-- /.form group -->	

							</form>
						</div><!-- /.box-body -->
					</div><!-- /.box -->

					<div class="box-footer" align="right">
						<button class="btn btn-default" type="button" id="cancel-carga-btn">Cancelar </button>
						<button class="btn btn-primary" type="submit" id="save-carga-btn"> Registrar </button>
					</div><!-- ./box-footer -->


				</section>
			</div><!-- /.row (main row) -->
		</section>
	</section>
</div><!-- /.row (main row) -->
@endsection

@section('script')


<script>

//Función que comprueba que no existen campos sin llenar al momento de enviar el formulario.
function camposVacios() {
	var flag=true;
	$('#cargaForm-div .no-vacio').each(function(index, value){
		if($(value).val()=='')
			flag&=false;
	});
	if(flag==false){
		$('#save-carga-btn').attr('disabled','disabled');
	}else{
		$('#save-carga-btn').removeAttr('disabled');
	}
}


$(document).ready(function(){

		/*
			Select Chosen
			*/
			$('#cliente_id-select').chosen({width:'400px'});
			$('#aeronave_id-select').chosen({width:'200px'});

		/*
			Datepicker
			*/

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

		 /*
	    	Fecha
	    	*/
	    	var d= new Date();
	    	var today=$.datepicker.formatDate('d/m/yy', new Date());


		/*
			Boton Cancelar
			*/
			$('#cancel-carga-btn').click(function(){
				$('#cargaForm-div input').val('');
				$('#cargaForm-div select').val('');
				$('#cargaForm-div #fecha-datepicker').val(today);
				console.log(today);

			})


		/* 
			Cálculo de Monto Total
			*/
			$("#carga-form input" ).keyup(function(event) {	

				var ut                =$('#ut').val();
				var eq_carga          =$('#precio_bloque').val();
				var bloque            =$('#toneladas_bloque').val();
				var peso_embarcado    =$('#peso_embarcado').val();
				var peso_desembarcado =$('#peso_desembarcado').val();

				//Cálculo del equivalente a cobrar
				var equivalente             = parseFloat(ut)*parseFloat(eq_carga);
				
				//Cálculo del Precio del Peso embarcado
				var peso_embarcado_monto    = (parseFloat(peso_embarcado)/bloque)*parseFloat(equivalente);
				$('#peso_embarcado_monto').val(peso_embarcado_monto.toFixed(2));
				
				//Cálculo del Precio del Peso embarcado
				var peso_desembarcado_monto = (parseFloat(peso_desembarcado)/bloque)*parseFloat(equivalente);
				$('#peso_desembarcado_monto').val(peso_desembarcado_monto.toFixed(2));
				
				//Cálculo de Monto Total
				var monto_total             = parseFloat(peso_embarcado_monto) + parseFloat(peso_desembarcado_monto);
				$('#monto_total').val(monto_total.toFixed(2));

			});


		/*  
            Guardar un nuevo registro
            */
            $('#save-carga-btn').click(function(){

            	var data=$('#carga-form').serializeArray();                
            	var overlay=    "<div class='overlay'>\
            	<i class='fa fa-refresh fa-spin'></i>\
            	</div>";
            	$('#cargaForm-div').append(overlay);

            	$.ajax(
            		{data:data,
            			method:'post',
            			url:"{{action('CargaController@store')}}"}
            			)
            	.always(function(response, status, responseObject){
            		$('#cargaForm-div .overlay').remove();
            		if(status=="error"){
            			if(response.status==422){
            				alertify.error(processValidation(response.responseJSON));
            			}
            		}else{

            			try{
            				var respuesta=JSON.parse(responseObject.responseText);
            				if(respuesta.success==1)
            				{
                                //$('#cargaForm-div input').val('0');
                                $('#cargaForm-div #num_vuelo').val('');
                                $('#cargaForm-div select').val('').trigger('chosen:updated');
                                $('#save-carga-btn').attr('disabled','disabled');
                                alertify.success(respuesta.text);
                                window.location="{{action('CargaController@index')}}";
                            }
                            else
                            {
                            	alertify.error(respuesta.text);
                            }
                        }
                        catch(e)
                        {
                        	alertify.error("Error procensando la información");
                        }
                    }
                })
})


})
</script>
@endsection