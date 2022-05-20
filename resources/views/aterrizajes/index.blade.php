@extends('app')
@section('content')
<div class="row">
	<section class="col-lg-12">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				<?php 
				$fecha = date('Y-m-d');
				ini_set('date.timezone','America/Caracas');
				?>
				<i class="fa fa-road"></i> Aterrizajes 
				<a href="{{ URL::to('operaciones/Aterrizajes/create') }}">
					<button type="button" class="btn btn-primary pull-right">
						<i class="fa fa-plus-circle"></i> Registrar
					</button>
				</a>
			</h1>
		</section>
		<section class="content">

			<!-- Tabla de Filtroa-->
			<div class="nav-tabs-custom">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title"><span class="ion ion-people-stalker"></span> Filtros de Búsqueda</h3>
					</div><!-- /.box-header -->
					<div class="box-body">

						<form class="form-inline">
							{!! Form::hidden('sortName', null, []) !!}
							{!! Form::hidden('sortType', null, []) !!}
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input id="fecha-datepicker-filter" data-inputmask="'alias': 'dd/mm/yyyy'"   type="text" name="fecha" class="form-control" data-mask  placeholder="Fecha" />
								</div><!-- /.input group -->
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-clock-o"></i>
									</div>
									<input type="text"  name="hora" class="form-control timepicker"  placeholder="HH:mm:ss"/>
								</div><!-- /.input group -->
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-plane"></i>
									</div>                                        
									<select name="aeronave_id" id="aeronave_id-flt" class="form-control aeronave">
										<option value="">--Matrícula--</option>
										@foreach ($aeronaves as $aeronave)
										<option data-modelo="{{$aeronave->modelo_id}}" data-nombremodelo="{{$aeronave->modelo->modelo}}" data-cliente="{{$aeronave->cliente_id}}" data-tipo="{{$aeronave->tipo_id}}" data-tipoV="{{$aeronave->tipo->nombre}}" value="{{$aeronave->id}}"> {{$aeronave->matricula}}</option>
										@endforeach
									</select>
								</div><!-- /.input group -->
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-flag-o"></i>
									</div>
									<input type="text" name="num_vuelo" class="form-control" style="width: 100px" placeholder="Número de Vuelo"/>
								</div><!-- /.input group -->
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-info"></i>
									</div>
									<select name="tipoMatricula_id" id="tipoMatricula_id-flt" class="form-control tipo_vuelo">
										<option value="">--Tipo de Vuelo--</option>
										@foreach ($tipoMatriculas as $tipoMatricula)
										<option value="{{$tipoMatricula->id}}"> {{$tipoMatricula->nombre}}</option>
										@endforeach
									</select>
								</div><!-- /.input group -->
							</div><!-- /.form group -->
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-map-marker"></i>
									</div>									
									<select name="puerto_id" id="puerto_id-flt" class="form-control puerto">
										<option value="">--Procedencia--</option>
										@foreach ($puertos as $puerto)
										<option  data-nacionalidad="{{$puerto->pais_id}}" value="{{$puerto->id}}"> {{$puerto->nombre}}</option>
										@endforeach
									</select>
								</div><!-- /.input group -->
							</div>  


							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-diamond"></i>
									</div>                                                                            
									<select name="cliente_id" id="cliente_id-flt" class="form-control cliente" >
										<option value="">--Cliente--</option>
										@foreach ($clientes as $index=>$cliente)
										<option value="{{$index}}"> {{$cliente}}</option>
										@endforeach
									</select>
								</div><!-- /.input group -->
							</div>


							
							<button type="submit" id="filtrar-btn" class="btn btn-primary pull-right" style="margin-left: 20px"><i class="fa fa-filter"></i></button>
						</form>
					</div><!-- /.box-body -->

				</div><!-- /.box -->
			</div><!-- /.col -->
			
			<!-- Tabla de aeronaves-->
			<div class="nav-tabs-custom">						
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title"><span class="ion ion-people-stalker"></span> Aterrizajes sin Despegue</h3>
					</div><!-- /.box-header -->
					<div class="box-body" id="table-wrapper">
					</div><!-- /.box-body -->
	 				<!-- <div class="overlay">
	 					<i class="fa fa-refresh fa-spin"></i>
	 				</div> -->
	 			</div><!-- /.box -->
	 		</div><!-- /.col -->
	 	</section>

	 	<!-- Modal de edición -->

	 	<div class="modal fade" id="show-modal" tabindex="-1" role="dialog" aria-labelledby="editarAterrizaje-modalLabel" aria-hidden="true">
	 		<div class="modal-dialog">
	 			<div class="modal-content">
	 				<div class="modal-header" id="titulo-div-modal">
	 					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	 					<h4 class="modal-title" id="titulo-modal">Editar Aterrizaje</h4>
	 				</div>
	 				<div class="modal-body">
	 				</div>
	 				<div class="modal-footer">
	 					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	 					<button id="save-aterrizaje-btn-modal" type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button>
	 				</div>
	 			</div>
	 		</div> <!-- /.Modal-dialog-->
	 	</div> <!-- /.Modal- fade-->
	</section>
</div><!-- /.row (main row) -->

@endsection

@section('script')
<script> 

function getTable(url){

	$('#table-wrapper').load(url)

}
	$(document).ready(function() {

		$('#aeronave_id-flt, #tipoMatricula_id-flt').chosen({width:'150px'});
		$('#puerto_id-flt, #cliente_id-flt').chosen({width:'350px'});


		/*	
	    	Listar los registros 
	    	*/
	    	$('#filtrar-btn').click(function(e){
	    		e.preventDefault();
	    		var data=$(this).closest('form').serialize();
	    		getTable("{{action('AterrizajeController@index')}}?"+data);
	    		console.log(data);
	    	}).trigger('click');


	    	$('#table-wrapper').delegate('.pagination li a', 'click', function(e){
	    		e.preventDefault();

    	    //Hay que quitar el slash antes del ?, no se como no generarlo pero replace resuelve.
    	    
    	    getTable($(this).attr('href').replace("/?", "?"));
    	})


	    	/*
		Campos Automáticos.

		*/

		$('body').delegate('.aeronave', 'change', function() {
			var option       =$(this).find('option:selected');
			var modelo       =$(this).closest('form').find('.modeloAeronave');
			var modeloHidden =$(this).closest('form').find('.modeloAeronaveHidden');
			var cliente      =$(this).closest('form').find('.cliente');
			var tipo_vuelo   =$(this).closest('form').find('.tipo_vuelo');
			if ($(option).val() == ''){
				$(modelo).val('').attr('disabled', 'disabled');
				$(tipo_vuelo).val('').attr('disabled', 'disabled');
				$(cliente).val('').attr('disabled', 'disabled');
			}else{
				var modelo_aeronave =$(option).data('nombremodelo');
				var modelo_id       =$(option).data('modelo');      
				$(modeloHidden).val(modelo_id);
				$(modelo).val(modelo_aeronave);

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
				if ($(nac_vuelo) == '232'){
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
	        $('#fecha-datepicker-filter').inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});


			$('#fecha-datepicker-filter').datepicker({
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
            Modificar un registro

            */      
            
            //Mostrar la información en un modal para editar

            $('body').delegate('.editarAterrizaje-btn', 'click', function(){
                var fila = $(this).closest('tr');
                var id   = $(fila).data('id');
                var url  ='{{action('AterrizajeController@edit', ["::"])}}';
                url      =url.replace("::", id)

                $.ajax({
                    method: 'get',
                    url: url})
                .always(function(text, status, responseObject){
                    $('#show-modal .modal-body').html(text);
                    $('#show-modal').modal('show');
                })
            })

            //Editar la información
            
            $('#save-aterrizaje-btn-modal').click(function(){

                var data =$('#show-modal form').serializeArray()
                var url  =$('#show-modal form').attr('action')
                console.log(url);
                $.ajax({data:data,
                    method:'PUT',
                    url:url})
                .always(function(text, status, responseObject){
                    try
                    {
                        var respuesta = JSON.parse(responseObject.responseText);
                        if (respuesta.success==1)
                        {
                            console.log(respuesta);
                            alertify.success(respuesta.text);
                            $('#filtrar-btn').trigger('click');
                        }
                        else
                        {
                            alertify.error(respuesta.text);
                        }
                    }
                    catch(e)
                    {
                        alertify.error('Error procesando la información');
                    }
                })
            })

        /*   
            Eliminar registro
            */
            
            $('body').delegate('.eliminarAterrizaje-btn', 'click', function(){
            var tr  =$(this).closest('tr');
            var id  =$(this).data('id');
            var url ="{{action('AterrizajeController@index')}}/"+id;
            // confirm dialog
            alertify.confirm("¿Realmente desea  eliminar este registro?", function (e) {
                if (e) {        

                    $.
                    ajax({url: url,
                        method:"DELETE"})
                    .done(function(response, status, responseObject){
                        try{
                            var obj= JSON.parse(responseObject.responseText);
                            if(obj.success==1){
                                $(tr).remove();
                                $('#filtrar-btn').trigger('click');
                                alertify.success(obj.text);
                            }
                        }catch(e){
                            console.log(e);
                            alertify.error('Error procesando la información');
                        }

                    })
                } 
            })
        })
    });
</script>
@endsection
