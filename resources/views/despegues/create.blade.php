@extends('app')
@section('content')
<div class="row">
	<section class="col-lg-12">
		<!-- Content Header (Page header) -->
		<ol class="breadcrumb">
			<li><a href="{{url('principal')}}">Inicio</a></li>
			<li><a id="listado-despegues" href="{{action('DespegueController@index')}}">Lista de Despegues</a></li>
			<li><a id="registro-despegues" class="active">Registro</a></li>
		</ol>
		<section class="content-header">
			<h1>
				<i class="ion ion-android-plane"></i> Registro de Despegues	
			</h1>
		</section>

		<!-- Main content -->
		<section class="content ">

			<div class="box box-primary">

				<div class="box-header">
					<h5>
						<i class="fa fa-plane"></i>
						Información del vuelo
					</h5>
				</div>
				<div class="box-body">
					<form id="despegue-form">                       
						<input id="fechaAterrizaje" type="hidden" class="form-control" value="{{$aterrizaje->fecha}}"/>
						<input id="horaAterrizaje" type="hidden" class="form-control" value="{{$aterrizaje->hora}}"/>
						<input type="hidden" name="aterrizaje_id" class="form-control" value="{{$aterrizaje->id}}" />

						<div class="form-inline" style="margin-top: 20px">
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input id="fecha-datepicker" data-inputmask="'alias': 'dd/mm/yyyy'"   type="text" name="fecha" class="form-control no-vacio" value="{{$today->format('d/m/Y')}}" placeholder="Fecha" />
										<input type="hidden" name="aeropuerto_id" value="{{session('aeropuerto')->id}}"></input>									
									</div><!-- /.input group -->
								</div>
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-clock-o"></i>
										</div> 
										<input type="text"  name="hora"  id="hora" class="form-control no-vacio" value="{{$today->format('H:i:s')}}"  placeholder="Hora"/>
									</div><!-- /.input group -->
								</div>
								<div class="form-group" style="width:180px">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-plane"></i>
										</div>                                        
										<input type="text" class="form-control no-vacio" value="{{$aterrizaje->aeronave->matricula}}" placeholder="Matrícula" />
										<input type="hidden" name="aeronave_id" class="form-control" value="{{$aterrizaje->aeronave_id}}" />
									</div><!-- /.input group -->
								</div>         
								<div class="form-group" >
									<div class="input-group" >
										<div class="input-group-addon">
											<i class="fa fa-paper-plane"></i>
										</div>
										<select name="tipoMatricula_id" id="tipoMatricula_id" class="form-control tipo_vuelo no-vacio">
											<option value="">--Seleccione Tipo de Vuelo--</option>
											@foreach ($tipoMatriculas as $tipoMatricula)
											<option value="{{$tipoMatricula->id}}" {{(($aterrizaje->tipoMatricula_id == $tipoMatricula->id)?"selected":"")}}> {{$tipoMatricula->nombre}}</option>
											@endforeach
										</select>									
									</div><!-- /input group -->
								</div>
							</div>  
							<div class="form-inline" style="margin-top: 20px">
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-map-marker"></i>
										</div>	
										<input id="procedencia" type="text" class="form-control no-vacio" readonly value="{{($aterrizaje->puerto)?$aterrizaje->puerto->nombre:'N/A'}}" placeholder="Procedencia" />
									</div><!-- /.input group -->
								</div>
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-map-marker"></i>
										</div> 								
										<select name="puerto_id" class="form-control puerto" id="puerto_id-select">
											<option value="">--Destino--</option>
											@foreach ($puertos as $puerto)
											<option  data-nacionalidad="{{$puerto->pais_id}}" value="{{$puerto->id}}"> {{$puerto->nombre}}</option>
											@endforeach
										</select>	
									</div><!-- /.input group -->
								</div>								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-globe"></i>
										</div>
					
										<select name="nacionalidadVuelo_id" class="form-control nacionalidad" id="nacionalidad_id-select">
											<option value="">--Nacionalidad--</option>
											@foreach ($nacionalidad_vuelos as $nacionalidad)
											<option  value="{{$nacionalidad->id}}"> {{$nacionalidad->nombre}}</option>
											@endforeach
										</select>	
									</div><!-- /.input group -->
								</div><!-- /.form group -->
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-plane"></i>
										</div>                                        
										<input id="num_vuelo" type="text" name="num_vuelo" class="form-control no-vacio" placeholder="Número de Vuelo" />
									</div><!-- /.input group -->
								</div>
							</div> 
							<div class="form-inline" style="margin-top: 20px">      
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-diamond"></i>
										</div>                                                                            
										<select name="cliente_id" class="form-control cliente" id="cliente_id-select" style="width: 527px">
											<option value="">--Seleccione Cliente--</option>
											@foreach ($clientes as $index=>$cliente)
											<option value="{{$index}}" {{(($aterrizaje->cliente_id == $index)?"selected":"")}} > {{$cliente}}</option>
											@endforeach
										</select>
									</div><!-- /.input group -->
								</div>
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-plane"></i>
										</div>    
										<select name="piloto_id" id="piloto_id-select" class="form-control piloto">
											<option value="">--Seleccione Piloto--</option>
											@foreach ($pilotos as $piloto)
											<option value="{{$piloto->id}}" {{(($aterrizaje->piloto_id == $piloto->id)?"selected":"")}}> {{$piloto->nombre}}</option>
											@endforeach
										</select>
									</div><!-- /.input group -->
								</div>
							</div>	
							@if($aterrizaje->tipoMatricula_id!="4")         
							<hr>
							<h5>
								<i class="fa fa-money"></i>
								Cobros
								<small>Conceptos a facturar</small>
							</h5>	

							<div class="form-inline  pull-right">
								<!-- Condición de Pago -->
								<div class="form-group">
									<label><strong>Condición de pago: </strong></label>
									<div class="input-group">
										<select name="condicionPago" id="condicionPago-select" class="form-control">
										@if($aterrizaje->cliente->condicionPago=="Crédito")
											<option value="Crédito" selected> Crédito</option>
											<option value="Contado"> Contado</option>
										@elseif($aterrizaje->cliente->condicionPago=="Contado")
											<option value="Contado" selected> Contado</option>
											<option value="Crédito"> Crédito</option>
										@else
											<option value=""> Seleccione</option>
											<option value="Contado"> Contado</option>
											<option value="Crédito"> Crédito</option>
										@endif		
										</select>
										<div class="input-group-addon">
										</div>                    
									</div><!-- /.input group -->
								</div><!-- /.form group -->
							</div>  
							<br>   
							<div class="form-inline">
								<div class="form-group" >
									
									<label>
										{!! Form::checkbox('cobrar_formulario', '1', true) !!}
										Formulario
									</label>
									<br>
									<br>
									<label >
										{!! Form::checkbox('cobrar_AterDesp', '1', true) !!}
										Aterrizaje y Despegue
									</label>
								</div><!-- /.form group -->
								<!-- Tiempo de Estacionamiento-->
								<div class="form-group " style="margin-left: 30px">
									@if($hangarLocal==true)
										<label>
											{!! Form::checkbox('cobrar_estacionamiento',true, null) !!}
											Estacionamiento
										</label>
									@else
										<label>
											{!! Form::checkbox('cobrar_estacionamiento', '1', true) !!}
											Estacionamiento
										</label>
									@endif 
									<br> 
									<label>Tiempo: </label>
									<div class="input-group" style="width: 150px">
										<input type="text" class="form-control" id="tiempo_estacionamiento" name="tiempo_estacionamiento" readonly />
										<div class="input-group-addon">
											min
											<i class="ion ion-clock"></i>
										</div>
									</div><!-- /.input group -->
								</div><!-- /.form group -->  

								<div class="form-group" style="margin-left: 20px">
									@if($aterrizaje->tipoMatricula_id=='3')
										<label>
											{!! Form::checkbox('cobrar_puenteAbordaje','1', true) !!}
											Puentes de Abordaje
										</label>
									@else									
										<label>
											{!! Form::checkbox('cobrar_puenteAbordaje',true, null) !!}
											Puentes de Abordaje
										</label>
									@endif
									<br> 
									<div class="input-group" style="width:100px">
										<div class="input-group-addon">
											#
										</div>
										<input type="number" class="form-control" min="1" name="numero_puenteAbordaje" />
									</div><!-- /.input group -->
									<div class="input-group" style="width:140px">
										<input type="number" class="form-control"  min="1" name="tiempo_puenteAbord"  />
										<div class="input-group-addon">
											horas
											<i class="ion ion-clock"></i>
										</div>
									</div><!-- /.input group -->
								</div><!-- /.form group --> 

								<div class="form-group"  style="width:150px; margin-left: 20px; margin-top:25px;">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-balance-scale"></i>
										</div>
										<input name="peso" type="text" class="form-control pesoAeronave" placeholder="Peso" disabled value="{{$aterrizaje->aeronave->peso}}"/>
										<div class="input-group-addon">
											Kgs.
										</div>
									</div><!-- /
									input group -->
								</div>	
								<div class="form-inline" style="margin-top: 20px">
									@if($aterrizaje->cliente_id=="13")
										<label>
											{!! Form::checkbox('cobrar_carga', '1', true) !!}
											Carga
										</label>
									@else
										<label>
											{!! Form::checkbox('cobrar_carga', true, null) !!}
											Carga
										</label>
									@endif
									<div class="form-group">
										<br> 
										<div class="input-group" style="width:170px; margin-right: 10px">
											<input type="text" name="peso_embarcado" placeholder="Embarcado" id="peso_embarcado" placeholder="Peso Embarcado" class="form-control no-vacio"/>
											<div class="input-group-addon">
												Kg(s) <i class="ion ion-soup-can-outline"></i>
											</div>
										</div><!-- /.input group -->
										<div class="input-group" style="width:190px">
											<input type="text"  name="peso_desembarcado" placeholder="Desembarcado" id="peso_desembarcado" placeholder="Peso Desembarcado" class="form-control no-vacio"/>
											<div class="input-group-addon ">
												Kg(s) <i class="ion ion-soup-can-outline"></i>
											</div>
										</div><!-- /.input group -->
									</div><!-- /.form group -->

									<div class="form-group" style="margin-left: 20px">
										<label>
											{!! Form::checkbox('cobrar_otrosCargos', true, null, ['id'=>"cobrar_otrosCargos"]) !!}
											Otros Cargos
										</label>
										<br> 
										{!! Form::select('otrosCargo_id[]', $otrosCargos, null, [ 'class'=>"form-control chosen-select otrosCargos-select", "multiple"=>"true",  "autocomplete"=>"off", 'id'=>"otros_cargos-select"]) !!}
									</div><!-- /.form group -->
								</div>
								<hr>
								<h5>
									<i class="fa fa-user"></i>
									Pasajeros
									<small>Embarcados y en Tránsito</small>
								</h5>
								<div class="form-inline">
									<label><i class="ion ion-android-plane col-md-2"> </i><strong> EMBARCADOS</strong></label>
									<!-- Pasajeros adultos -->
									<div class="form-group">
										<label>Adultos:</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="ion ion-person-stalker"></i>
											</div>
											<input type="number" name="embarqueAdultos"  value="0"  class="form-control" />
										</div><!-- /.input group -->
									</div><!-- /.form group -->

									<!-- Pasajeros Infantes-->
									<div class="form-group">
										<label>Infantes:</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="ion ion-android-happy"></i>
											</div>
											<input type="number" name="embarqueInfante"  value="0"  class="form-control" />
										</div><!-- /.input group -->
									</div><!-- /.form group -->


									<!-- Pasajeros tercera edad -->
									<div class="form-group ">
										<label>Tercera Edad:</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="ion ion-person-stalker"></i>
											</div>
											<input type="number" name="embarqueTercera"  value="0"  class="form-control" />
										</div><!-- /.input group -->
									</div><!-- /.form group -->
								</div>
								<br>
								<div class="form-inline">

									<label><i class="ion ion-android-plane col-md-2"> </i><strong>EN TRÁNSITO</strong></label>

									<!-- Pasajeros adultos -->
									<div class="form-group">
										<label>Adultos:</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="ion ion-person-stalker"></i>
											</div>
											<input type="number" name="transitoAdultos"  value="0"  class="form-control" />
										</div><!-- /.input group -->
									</div><!-- /.form group -->

									<!-- Pasajeros Infantes-->
									<div class="form-group">
										<label>Infantes:</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="ion ion-android-happy"></i>
											</div>
											<input type="number" name="transitoInfante"  value="0"  class="form-control" />
										</div><!-- /.input group -->
									</div><!-- /.form group -->


									<!-- Pasajeros tercera edad -->
									<div class="form-group  ">
										<label>Tercera Edad:</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="ion ion-person-stalker"></i>
											</div>
											<input type="number" name="transitoTercera"  value="0"  class="form-control" />
										</div><!-- /.input group -->
									</div><!-- /.form group -->
								</div>
								<br>
								<div class="form-inline">
									<label style="margin-right: 25px"><i class="ion ion-android-plane col-md-2" > </i><strong>TOTALES</strong></label>
									<!-- Pasajeros adultos -->
									<div class="form-group ">
										<label>Adultos:</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="ion ion-person-stalker"></i>
											</div>
											<input type="number"   value="0" disabled class="form-control" />
										</div><!-- /.input group -->
									</div><!-- /.form group -->

									<!-- Pasajeros Infantes-->
									<div class="form-group ">
										<label>Infantes:</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="ion ion-android-happy"></i>
											</div>
											<input type="number"   value="0" disabled  class="form-control" />
										</div><!-- /.input group -->
									</div><!-- /.form group -->

									<!-- Pasajeros tercera edad -->
									<div class="form-group" >
										<label>Tercera Edad:</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="ion ion-person-stalker"></i>
											</div>
											<input type="number"   value="0" disabled class="form-control" />
										</div><!-- /.input group -->
									</div><!-- /.form group -->

									<!-- Total de Pasajeros -->
									<div class="form-group">

										<label>Total:</label>
										<div class="input-group" style="width:80px">
											<input type="number" value="0" disabled class="form-control" />
										</div><!-- /.input group -->
									</div><!-- /.form group -->
								</div>
							</div>
							@endif
						</form>
					</div> <!-- /. box-body -->					
				</div>
				<div class="box-footer" align="right">
					<a class="btn btn-default" href="{{action('DespegueController@index')}}">Cancelar</a>
					<button class="btn btn-primary" type="submit" id="save-despegue-btn"> Registrar </button>
				</div><!-- ./box-footer -->
			</section>
		</section>
	</div><!-- /.row (main row) -->

	@endsection

	@section('script')
	<script>

//Función que comprueba que no existen campos sin llenar al momento de enviar el formulario.
function camposVacios() {
	var flag=true;
	$('#fecha-datepicker, #hora, #aeronave_id, tipoMatricula_id').each(function(index, value){
		if($(value).val()=='')
			flag&=false;
	});
	if(flag==false){
		$('#save-aterrizaje-btn').attr('disabled','disabled');
	}else{
		$('#save-aterrizaje-btn').removeAttr('disabled');
	}
}

//Función que calcula el tiempo 
function calcularDiferenciaMinutos(){

	var fecha             = $('#fechaAterrizaje').val();
	var hora              = $('#horaAterrizaje').val();
	var fecha_hora        = fecha+' '+hora;

	var fechaActual       = $('#fecha-datepicker').val();
	var horaActual        = $('#hora').val();
	var fecha_hora_actual = fechaActual+' '+horaActual;

	var a = moment(fecha_hora, "DD/MM/YYYY HH:mm:ss");
	var b = moment(fecha_hora_actual, "DD/MM/YYYY HH:mm:ss");	
	var estacionamiento = (b.diff(a, 'minutes'));
	$('#tiempo_estacionamiento').val(estacionamiento);
}

	function filtro(){
		var data=$('#despegue-form').serializeArray();
		$.ajax({
			data:data,
			method:'get',
			url:"{{action('DespegueController@filtro')}}"
		}).success(function(data) {
			console.log(data);
			cambiar_valores_otros_cargos(data);
		});
	}

	function cambiar_valores_otros_cargos(data){

		var cargos = $("#otros_cargos-select");
		cargos.empty(); // borrar opciones viejas.

		$.each(data, function(value,key) { 
		  cargos.append($("<option></option>")
		     .attr("value", value).text(key));
		});

		cargos.val('').trigger('chosen:updated');
	}

	function validar_otros_cargos(){
		if($('#otros_cargos-select').val()){
			console.log("CON VALOR");
			if(!$('#cobrar_otrosCargos').is(":checked")){
				console.log("TRUE");
				alertify.error("Debe Seleccionar Otros Cargos.");
				return -1;
			}
		}
		return 1;
	}

$(document).ready(function(){

	$('#otros_cargos-select').chosen({width:'450px'});
	$('#piloto_id-select').chosen({width:'200px'});
	$('#puerto_id-select').chosen({width:'140px'});
	$('#cliente_id-select').chosen({width:'500px'});

	filtro();

	$( "#condicionPago-select").change(function() {
		filtro();
	});

	$( "#tipoMatricula_id").change(function() {
		filtro();
	});
	
	/* 
	Condiciones en los campos de los formularios
	*/

	$('#aterrizajeForm-div input').keyup(function()
	{
		camposVacios();
	});

	$('#aterrizajeForm-div select').change(function()
	{
		camposVacios();	
	});

/*
	Fecha
	*/
	var d= new Date();
	var today=$.datepicker.formatDate('d/m/yy', new Date());
	var h=d.getHours();
	var m=d.getMinutes();
	var s=d.getSeconds();
	if (m<'10'){
		m='0'+m;
	}
	var time=h+':'+m+':'+s;
	

/*
	Campos Automáticos.

	*/
	$('body').delegate('.puerto', 'change', function() {
		var option       =$(this).find('option:selected');
		var nacionalidad =$(this).closest('form').find('.nacionalidad');

		if ($(option).val() == ''){
			$(nacionalidad).val('').attr('disabled', 'disabled');
		}else{
			var nac_vuelo=$(option).data('nacionalidad');
			if (nac_vuelo == '232'){
				$(nacionalidad).val('1');
			}else{
				$(nacionalidad).val('2');
			}
		}               
	});

	$('#fecha-datepicker').change(calcularDiferenciaMinutos).trigger('change');
	$('#hora').keyup(calcularDiferenciaMinutos);


/*
	Datepicker
	*/


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

	$('#cancel-despegue-btn').click(function(){
		$('#despegueForm-div input').val('');
		$('#despegueForm-div select').val('');
		$('#despegueForm-div #fecha-datepicker').val(today);
		$('#despegueForm-div #hora').val(time);
	})



	/*
	Registro de despegue

	*/
	
	$('#save-despegue-btn').click(function(){
		if(validar_otros_cargos() == -1){
			return;
		}
		var data=$('#despegue-form').serializeArray();
		console.log(data);
		var overlay="<div class='overlay'>\
		<i class='fa fa-refresh fa-spin'></i>\
	</div>";
	$('.box-body').append(overlay);


	$.ajax(
		{data:data,
			method:'post',
			url:"{{action('DespegueController@store')}}"}
			)
	.always(function(response, status, responseObject){
		$('.box-body .overlay').remove();
		if(status=="error"){
			if(response.status==422){
				alertify.error(processValidation(response.responseJSON));
			}
		}else{

			try{
				var respuesta=JSON.parse(responseObject.responseText);
				if(respuesta.success==1)
				{
					$('#save-despegue-btn').attr('disabled','disabled');
					alertify.success(respuesta.text);
					window.location="{{action('DespegueController@index')}}";
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
});

</script>

@endsection
