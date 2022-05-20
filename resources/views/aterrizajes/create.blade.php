@extends('app')
@section('content')
<div class="row">
	<section class="col-lg-10">
		<!-- Content Header (Page header) -->

		<ol class="breadcrumb">
			<li><a href="{{url('principal')}}">Inicio</a></li>
			<li><a id="listado-aterrizajes" href="{{action('AterrizajeController@index')}}">Lista de Aterrizajes</a></li>
			<li><a id="registro-aterrizajes" class="active">Registro</a></li>
		</ol>
		<section class="content-header">
			<h1>
				<i class="fa fa-road"></i> Registro de Aterrizajes  
			</h1>
		</section>

		<!-- Main content -->
		<section class="content ">

			<div id="aterrizajeForm-div">
				<div class="box box-primary">

					<div class="box-header">
						<h5>
							<i class="fa fa-plane"></i>
							Información del vuelo
						</h5>
					</div>
					<div class="box-body" id="box1">  
						<form id="aterrizaje-form">                       
							<div class="form-inline">
								<div class="form-group" style="width:180px">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input id="fecha-datepicker" data-inputmask="'alias': 'dd/mm/yyyy'"  type="text" name="fecha" class="form-control no-vacio" value="{{$today->format('d/m/Y')}}" placeholder="Fecha" />
										<input type="hidden" name="aeropuerto_id" value="{{session('aeropuerto')->id}}"></input>
									</div><!-- /.input group -->
								</div>
								<div class="form-group"  style="width:150px">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-clock-o"></i>
										</div> 
										<input type="text"  name="hora"  id="hora" class="form-control no-vacio" value="{{$today->format('H:i:s')}}"  placeholder="Hora"/>
									</div><!-- /.input group -->
								</div>								                   
							</div>                    
							<div class="form-inline" style="margin-top: 20px" >
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-plane"></i>
										</div>                                        
										<select name="aeronave_id" id="aeronave_id" class="form-control aeronave no-vacio">
											<option value=""> Matrícula </option>
											@foreach ($aeronaves as $aeronave)
											<option data-modelo="{{$aeronave->modelo_id}}" data-nacionalidad="{{$aeronave->nacionalidad_id}}" data-peso="{{$aeronave->peso}}" data-nombremodelo="{{$aeronave->modelo->modelo}}" data-cliente="{{$aeronave->cliente_id}}" data-tipo="{{$aeronave->tipo_id}}" data-tipoV="{{$aeronave->tipo->nombre}}" value="{{$aeronave->id}}"> {{$aeronave->matricula}}</option>
											@endforeach
										</select>
									</div><!-- /.input group -->
								</div>
								<div class="form-group"  style="width:150px">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-paper-plane"></i>
										</div>
										<input type="text" class="form-control modeloAeronave" placeholder="Modelo" disabled />
									</div><!-- /
									input group -->
								</div>
								<div class="form-group"  style="width:150px">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-balance-scale"></i>
										</div>
										<input type="text" class="form-control pesoAeronave" placeholder="Peso" disabled />
										<div class="input-group-addon">
											Kgs.
										</div>
									</div><!-- /
									input group -->
								</div>
								<div class="form-group"  style="width:150px">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-info"></i>
										</div>
										<select name="tipoMatricula_id" id="tipoMatricula_id" class="form-control tipo_vuelo no-vacio">
											<option value="">Tipo de Vuelo</option>
											@foreach ($tipoMatriculas as $tipoMatricula)
											<option value="{{$tipoMatricula->id}}"> {{$tipoMatricula->nombre}}</option>
											@endforeach
										</select>
									</div><!-- /.input group -->
								</div><!-- /.form group -->             
							</div> 
							<div class="form-inline" style="margin-top: 20px">
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-diamond"></i>
										</div>                                                                            
										<select name="cliente_id" id="cliente_id" class="form-control cliente" style="width: 590px">
											<option value="">--Seleccione Cliente--</option>
											@foreach ($clientes as $index=>$cliente)
											<option value="{{$index}}"> {{$cliente}}</option>
											@endforeach
										</select>
									</div><!-- /.input group -->
								</div>
							</div>
							<div class="form-inline" style="margin-top: 20px">
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-map-marker"></i>
										</div>									
										<select name="puerto_id" id="puerto_id" class="form-control puerto">
											<option value="">--Seleccione Procedencia--</option>
											@foreach ($puertos as $puerto)
											<option  data-nacionalidad="{{$puerto->pais_id}}" value="{{$puerto->id}}"> {{$puerto->nombre}}</option>
											@endforeach
										</select>
									</div><!-- /.input group -->
								</div>    
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-flag-o"></i>
										</div>
										<input type="text" name="num_vuelo" class="form-control" placeholder="Número de Vuelo"/>
									</div><!-- /.input group -->
								</div>                          
							</div>
							<div class="form-inline" style="margin-top: 20px">
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-user"></i>
										</div>									                                    
										<select name="piloto_id" id="piloto_id" class="form-control piloto">
											<option value="">--Seleccione Piloto--</option>
											@foreach ($pilotos as $piloto)
											<option data-ci="{{$piloto->documento_identidad}}" value="{{$piloto->id}}"> {{$piloto->nombre}}</option>
											@endforeach
										</select>
									</div><!-- /.input group -->
								</div>
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-user"></i>
										</div>
										<input type="text" class="form-control piloto_ci" data-provide="typeahead" placeholder="C.I del Piloto"/>
									</div><!-- /.input group -->
								</div>                            
							</div>
						</div><!-- /.box-body -->
					</div><!-- /.box -->

					<div class="box box-warning">
						<div class="box-header">
							<h5>
								<i class="fa fa-plane"></i>
								Desembarque
								<small>Cantidad de Pasajeros</small>
							</h5>
						</div>
						<div class="box-body" id="box2">

							<!-- Pasajeros adultos -->
							<div class="form-group col-md-3">
								<label>Adultos:</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="ion ion-person-stalker"></i>
									</div>
									<input type="number" name="desembarqueAdultos"  value="0"  class="form-control" />
								</div><!-- /.input group -->
							</div><!-- /.form group -->

							<!-- Pasajeros Infantes-->
							<div class="bootstrap-timepicker col-md-3">
								<div class="form-group ">
									<label>Infantes:</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="ion ion-android-happy"></i>
										</div>
										<input type="number" name="desembarqueInfante"  value="0"  class="form-control"/>
									</div><!-- /.input group -->
								</div><!-- /.form group -->
							</div>

							<!-- Pasajeros tercera edad -->
							<div class="form-group col-md-3">
								<label>Tercera Edad:</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="ion ion-person-stalker"></i>
									</div>
									<input type="number" name="desembarqueTercera" value="0" class="form-control" />
								</div><!-- /.input group -->
							</div><!-- /.form group -->

							<!-- Pasajeros en Tránsito -->
							<div class="form-group ">
								<label>En Tránsito:</label>
								<div class="input-group col-md-3">
									<div class="input-group-addon">
										<i class="ion ion-android-plane"></i>
									</div>
									<input type="number" name="desembarqueTransito" value="0" class="form-control col-md-3" />
								</div><!-- /.input group -->
							</div><!-- /.form group -->
						</form>
					</div> <!-- /. box-body -->
				</div><!-- /. box-body -->
			</div>

			<div class="box-footer" align="right">
				<button class="btn btn-default" type="button" id="cancel-aterrizaje-btn">Cancelar </button>
				<button class="btn btn-primary" type="submit" disabled id="save-aterrizaje-btn"> Registrar </button>
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

$(document).ready(function(){

		$('#aeronave_id').chosen({width:'135px'});
		$('#puerto_id').chosen({width:'300px'});
		$('#piloto_id').chosen({width:'300px'});

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

		$('body').delegate('.aeronave', 'change', function() {
			var option       =$(this).find('option:selected');
			var modelo       =$(this).closest('form').find('.modeloAeronave');
			var peso       =$(this).closest('form').find('.pesoAeronave');
			var modeloHidden =$(this).closest('form').find('.modeloAeronaveHidden');
			var cliente      =$(this).closest('form').find('.cliente');
			var tipo_vuelo   =$(this).closest('form').find('.tipo_vuelo');
			var nacionalidad   =$(this).closest('form').find('.nacionalidad');
			if ($(option).val() == ''){
				$(modelo).val('').attr('disabled', 'disabled');
				$(peso).val('').attr('disabled', 'disabled');
				$(tipo_vuelo).val('').attr('disabled', 'disabled');
				$(cliente).val('').attr('disabled', 'disabled');
			}else{
				var modelo_aeronave =$(option).data('nombremodelo');
				var peso_aeronave =$(option).data('peso');
				var modelo_id       =$(option).data('modelo');       
				$(modeloHidden).val(modelo_id);
				$(modelo).val(modelo_aeronave);
				$(peso).val(peso_aeronave);

				var tipo=$(option).data('tipo');        
				$(tipo_vuelo).val(tipo).removeAttr('disabled');

				var cliente_id=$(option).data('cliente');        
				$(cliente).val(cliente_id).removeAttr('disabled');
			}               
		});

		$('body').delegate('.piloto', 'change', function() {
			var option =$(this).find('option:selected');
			var cedula =$(this).closest('form').find('.piloto_ci');
			if ($(option).val() == ''){
				$(cedula).val('').attr('disabled', 'disabled');
			}else{
				var cedula_piloto=$(option).data('ci');
				$(cedula).val(cedula_piloto).removeAttr('disabled');
			}               
		});

		$('body').delegate('.puerto', 'change', function() {
			var option    =$(this).find('option:selected');
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

		$('#cancel-aterrizaje-btn').click(function(){
			$('#aterrizajeForm-div input').val('');
			$('#aterrizajeForm-div select').val('');
			$('#aterrizajeForm-div #fecha-datepicker').val(today);
			$('#aterrizajeForm-div #hora').val(time);

		})

	/*
	
		Registro de Aterrizajes

		*/
		
		$('#save-aterrizaje-btn').click(function(){

			var data=$('#aterrizaje-form').serializeArray();

			var overlay="<div class='overlay'>\
			<i class='fa fa-refresh fa-spin'></i>\
			</div>";
			$('.box-body').append(overlay);


			$.ajax(
				{data:data,
					method:'post',
					url:"{{action('AterrizajeController@store')}}"}
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
							$('#save-aeronave-btn').attr('disabled','disabled');
							$('#aterrizajeForm-div input').val('');
							$('#aterrizajeForm-div select').val('');
							$('#aterrizajeForm-div #fecha-datepicker').val(today);
							alertify.success(respuesta.text);
							window.location="{{action('AterrizajeController@index')}}";

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