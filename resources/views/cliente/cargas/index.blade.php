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
				<i class="fa fa-road"></i> Cargas 
				<a href="{{action('CargaController@create')}}">
					<button type="button" class="btn btn-primary pull-right">
						<i class="fa fa-plus-circle"></i> Registrar
					</button>
				</a>
			</h1>
		</section>
		<section class="content">		

		<!-- Tabla de Filtros-->
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
									<input id="fecha-datepicker-filter" type="text" name="fecha" class="form-control no-vacio" placeholder="Fecha" />
								</div><!-- /.input group -->
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-diamond"></i>
									</div>                                                                            
									<select name="cliente_id" id="cliente_id-select" class="form-control cliente" >
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
						<h3 class="box-title"><span class="ion ion-people-stalker"></span> Cargas Registradas</h3>
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
	 					<h4 class="modal-title" id="titulo-modal">Editar Carga</h4>
	 				</div>
	 				<div class="modal-body">
	 				</div>
	 				<div class="modal-footer">
	 					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	 					<button id="save-carga-btn-modal" type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button>
	 				</div>
	 			</div>
	 		</div> <!-- /.Modal-dialog-->
	 	</div> <!-- /.Modal- fade-->
	</section>
</div><!-- /.row (main row) -->

@endsection

@section('script')

<script>

// Función constructora de la tabla.
function getTable(url){
	$('#table-wrapper').load(url)
}

$(document).ready(function(){
	
/*
	Select Chosen
 	*/
	$('#cliente_id-select').chosen({width:'280px'});
	$('#aeronave_id-select').chosen({width:'180px'});

/*
	Datepicker
	*/

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
		dateFormat: 'yy-mm-dd'
	});


    /*	
    	Listar los registros 
    	*/
    	$('#filtrar-btn').click(function(e){
    		e.preventDefault();
    		var data=$(this).closest('form').serialize();
    		getTable("{{action('CargaController@index')}}?"+data);
    	}).trigger('click');


    	$('#table-wrapper').delegate('.pagination li a', 'click', function(e){
    		e.preventDefault();

		    //Hay que quitar el slash antes del ?, no se como no generarlo pero replace resuelve.
		    //
		    getTable($(this).attr('href').replace("/?", "?"));
		})


		/* 
			Cálculo de Monto Total
			*/
			$('body').delegate('#carga-form input', 'keyup', function(){

				var ut                =$('#ut').val();
				var eq_carga          =$('#precio_bloque').val();
				var bloque            =$('#toneladas_bloque').val();
				var peso_embarcado    =$('.peso_embarcado').val();
				var peso_desembarcado =$('.peso_desembarcado').val();

				//Cálculo del equivalente a cobrar
				var equivalente             = parseFloat(ut)*parseFloat(eq_carga);
				
				//Cáldulo del Precio del Peso embarcado
				var peso_embarcado_monto    = (parseFloat(equivalente)/bloque)*parseFloat(peso_embarcado);
				$('.peso_embarcado_monto').val(peso_embarcado_monto);
				
				//Cáldulo del Precio del Peso embarcado
				var peso_desembarcado_monto = (parseFloat(equivalente)/bloque)*parseFloat(peso_desembarcado);
				$('.peso_desembarcado_monto').val(peso_desembarcado_monto);
				
				//Cálculo de Monto Total
				var monto_total             = parseFloat(peso_embarcado_monto) + parseFloat(peso_desembarcado_monto);
				$('.monto_total').val(monto_total);

			});


 		/*   
            Eliminar registro
            */
        $('body').delegate('.eliminarCarga-btn', 'click', function(){
            var tr  =$(this).closest('tr');
            var id  =$(this).data('id');
            var url ="{{action('CargaController@index')}}/"+id;
            
            // confirm dialog
            alertify.confirm("¿Realmente desea eliminar este registro?", function (e) {
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

        /*
            Modificar un registro

            */      
            
            //Mostrar la información en un modal para editar

            $('body').delegate('.editarCarga-btn', 'click', function(){
                var fila = $(this).closest('tr');
                var id   = $(fila).data('id');
                var url  ='{{action('CargaController@edit', ["::"])}}';
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
            
            $('#save-carga-btn-modal').click(function(){

                var data =$('#show-modal form').serializeArray()
                var url  =$('#show-modal form').attr('action')
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

		
})
</script>
@endsection
