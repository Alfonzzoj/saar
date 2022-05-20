@extends('app')
@section('content')

<div class="row">
	<section class="col-lg-10">


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
						<div class="form-group col-sm-3">
							<input type="text" class="form-control" name="nombre"  placeholder="Nombre">
						</div>
						<div class="form-group col-sm-3">
							<input type="text" class="form-control" name="siglas" placeholder="Nomenclatura">
						</div>
						<div class="form-group" >
							<select name="pais_id" id="pais_id-flt" class="form-control">
							<option value="">--Seleccione País--</option>
								@foreach ($paises as $pais)
								<option value="{{$pais->id}}"> {{$pais->nombre}}</option>
								@endforeach
							</select>
						</div>
						<button type="submit" id="filtrar-btn" class="btn btn-primary" style="margin-left: 20px"><i class="fa fa-filter"></i></button>
					</form>
				</div><!-- /.box-body -->

			</div><!-- /.box -->
		</div><!-- /.col -->

		<!-- Tabla de Puertos -->
		<div class="nav-tabs-custom">                          
			<div class="box box-info">
				<div class="box-header with-border">
					<h3 class="box-title"><span class="ion ion-people-stalker"></span> Puertos Registrados</h3>
				</div><!-- /.box-header -->
				<div class="box-body" id="table-wrapper">
				</div><!-- /.box-body -->
				<!-- <div class="overlay">
					<i class="fa fa-refresh fa-spin"></i>
				</div> -->
			</div><!-- /.box -->
		</div><!-- /.col -->
	</section>

	<section class="col-lg-6">

		<!-- Formulario de Registro -->
		<div id='puertoForm-div' class="box box-info">
			<div class="box-header">
				<h3 class="box-title">Registro de Puertos</h3>
			</div>
			<div class="box-body">

     			<form id="puerto-form">
					<div class="input-group">
						<span class="input-group-addon"><i class="ion ion-android-arrow-dropright"></i></span>
						<input name="nombre" type="text" class="form-control no-vacio" id='nombre-input' placeholder="Nombre">
					</div>
					<br/>
					<div class="input-group">
						<span class="input-group-addon"><i class="ion ion-android-arrow-dropright"></i></span>
						<input name="siglas" type="text" class="form-control no-vacio" id='siglas-input' placeholder="Nomenclatura">
					</div>
					<br/>
					<div class="input-group">
						<span class="input-group-addon"><i class="ion ion-android-arrow-dropright"></i></span>
						<div class="form-group" style="margin-top: 10px">
							<select name="pais_id" class="form-control no-vacio" id="pais_id-select">
								<option value="">--Seleccione País--</option>
								@foreach ($paises as $pais)
								<option value="{{$pais->id}}"> {{$pais->nombre}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<br/>
					<div class="form-group">
						<div class="checkbox">
							<label>
								{!! Form::checkbox('estado', '1', true) !!} Activo
							</label>
						</div>
					</div>
				</form>
				<br/>
			</div><!-- /.box-body -->
			<div class="box-footer" align="right">
				<button class="btn btn-default" id='cancel-puerto-btn' type="button" > Cancelar </button>
				<button class="btn btn-primary" id='save-puerto-btn' type="submit" disabled> Registrar </button>
			</div><!-- ./box-footer -->
		</div><!-- /.box -->
	</section>
	<!-- Modal de edición -->

		<div class="modal fade" id="show-modal" tabindex="-1" role="dialog" aria-labelledby="editarModelo-modalLabel" aria-hidden="true">
     		<div class="modal-dialog">
     			<div class="modal-content">
     				<div class="modal-header" id="titulo-div-modal">
     					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     					<h4 class="modal-title" id="titulo-modal">Editar Puerto</h4>
     				</div>
     				<div class="modal-body">
     				</div>
     				<div class="modal-footer">
     					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
     					<button id="save-puerto-btn-modal" type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button>
     				</div>
     			</div>
     		</div> <!-- /.Modal-dialog-->
     	</div> <!-- /.Modal- fade-->
</div><!-- /.row (main row) -->


@endsection
@section('script')

<script>

	 function getTable(url){

     	$('#table-wrapper').load(url)

    }

     //Función para construir las filas de la tabla de modelos de Aeronaves
     
     function constructorFila(puerto)
     {


     	var estado=puerto.estado;

     	var fila = "<tr data-id='"+puerto.id+"'>\
     	<td class='nombre-td'>"+puerto.nombre+"</td>\
     	<td class='siglas-td'>"+puerto.siglas+"</td>\
     	<td class='pais_id-td'>"+puerto.pais.nombre+"</td>\
     	<td>\
     	<button class='btn "+((estado==1)?"btn-primary":"btn-default")+" btn-sm activarPuerto-btn'><i class='glyphicon glyphicon-adjust' title='"+((estado==1)?"Puerto Habilitado":"Puerto Inhabilitado")+"'></i></button>\
     	<button class='btn btn-warning btn-sm editarPuerto-btn'><i class='glyphicon glyphicon-pencil' title='Editar Información'></i></button>\
     	<button class='btn btn-danger  btn-sm eliminarPuerto-btn'><i class='glyphicon glyphicon-trash' title='Eliminar Registro'></i></button>\
     	</td>\
     	</tr>";        
     	return fila;

     }


    //Función que comprueba que no existen campos sin llenar al momento de enviar el formulario.
    function camposVacios() {
    	var flag=true;
    	$('#puertoForm-div .no-vacio').each(function(index, value){
    		if($(value).val()=='')
    			flag&=false;
    	});
    	if(flag==false){
    		$('#save-puerto-btn').attr('disabled','disabled');
    	}else{
    		$('#save-puerto-btn').removeAttr('disabled');
    	}
    }



    $(document).ready(function(){

    	/* 
    		Condiciones en los campos de los formularios
    		*/

    		$('#puertoForm-div input').keyup(function()
    		{
    			camposVacios();
    		});

    		$('#puertoForm-div select').change(function()
    		{
    			camposVacios();	
    		});

    		$('#pais_id-flt, #pais_id-select').chosen({width:'100%'})


        /*
            Limpiar Formularios
            */


           //Formulario de creación
           
           $('#cancel-puerto-btn').click(function(){
           	$('#puertoForm-div input, #puertoForm-div select').val('');
           });          



	     /*	
	    	Listar los registros 
	    	*/
	    	$('#filtrar-btn').click(function(e){
	    		e.preventDefault();
	    		var data=$(this).closest('form').serialize();
	    		getTable("{{action('PuertoController@index')}}?"+data);
	    	}).trigger('click');


	    	$('#table-wrapper').delegate('.pagination li a', 'click', function(e){
	    		e.preventDefault();

		    //Hay que quitar el slash antes del ?, no se como no generarlo pero replace resuelve.
		    //
		    getTable($(this).attr('href').replace("/?", "?"));
		})

	    		// Botón para habilitar/inhabilitar
	    		
	  			$('body').delegate('.activarPuerto-btn', 'click', function(){
	    			var fila =  $(this).closest('tr');
	    			var id   =  $(fila).data('id');

				// confirm dialog
				alertify.confirm("¿Realmente desea  cambiar el estado a este puerto?", function (e) {
					if (e) {		

						$.ajax({
							data:{id:id},
							method:'get',
							url:"{{action('PuertoController@estadoPuerto')}}"})
						.always(function(text, status, responseObject){
							try{
								var respuesta=JSON.parse(responseObject.responseText);
								if(respuesta.success==1){
									if (respuesta.puerto.estado==0){
										console.log(respuesta.puerto.estado);
										$(fila).find('.activarPuerto-btn')
										.removeClass('btn-primary')
										.addClass('btn-default')
										.prop('title', 'Puerto Inhabilitado');

									}
									else if (respuesta.puerto.estado==1){

										console.log(respuesta.puerto.estado);
										$(fila).find('.activarPuerto-btn')
										.addClass('btn-primary')
										.removeClass('btn-default')
										.prop('title', 'Puerto Habilitado');								
									}
									alertify.success(respuesta.text);

								}
								else
								{
									alertify.error(respuesta.text);
								}
								
							}catch (e){
								console.log(e);
								alertify.error("Error procensando la información del servidor")

							}

						})
					} 
				});

		});


    	/*
    		Modificar un registro

    		*/ 		
    		

    		//Mostrar la información en un modal para editar

	  		$('body').delegate('.editarPuerto-btn', 'click', function(){
	  			var fila = $(this).closest('tr');
	  			var id   = $(fila).data('id');
	  			var url  ='{{action('PuertoController@edit', ["::"])}}';
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
    		
    		$('#save-puerto-btn-modal').click(function(){

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

    						console.log(respuesta.puerto);

    						var fila=$('#puerto-table tbody tr[data-id="'+data.id+'"]');
    						$(fila).find('.nombre-td').html(respuesta.puerto.nombre);
    						$(fila).find('.siglas-td').html(respuesta.puerto.siglas);
    						$(fila).find('.pais_id-td').html(respuesta.puerto.pais.nombre);
							$('#filtrar-btn').trigger('click');
    						alertify.success(respuesta.text);
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
    	$('body').delegate('.eliminarPuerto-btn', 'click', function(){
    		var tr  =$(this).closest('tr');
    		var id  =$(this).data("id");
    		var url ="{{action('PuertoController@index')}}/"+id;


				// confirm dialog
				alertify.confirm("¿Realmente desea  eliminar este puerto?", function (e) {
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
	    	Guardar un nuevo registro
	    	*/


	    	$('#save-puerto-btn').click(function(){

	    		var data=$('#puerto-form').serializeArray();
	    		console.log(data);

	    		var overlay= "<div class='overlay'>\
	    						<i class='fa fa-refresh' fa-spin></i>\
	    					 </div>";
	    		$('#puertoForm-div').append(overlay);

	    		$.ajax(
    			{data:data,
    				method:'post',
    				url:"{{action('PuertoController@store')}}"}
    			)
	    		.always(function(response, status, responseObject){
	    			$('#puertoForm-div .overlay').remove();

	    			 if(status=="error"){
	                    if(response.status==422){
	                        alertify.error(processValidation(response.responseJSON));

	                    }
	                }else{

		    			try{
		    				var respuesta=JSON.parse(responseObject.responseText);
		    				if(respuesta.success==1)
		    				{
		    					var value = respuesta.puerto;
		    					var fila  = constructorFila(value);
		    					$('#puerto-table tbody').prepend(fila);
		    					$('#puertoForm-div .no-vacio').val('');
		    					$('#save-puerto-btn').attr('disabled','disabled');
								$('#filtrar-btn').trigger('click');
		    					alertify.success(respuesta.text);
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