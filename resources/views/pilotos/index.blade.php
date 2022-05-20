@extends('app')
@section('content')

<div class="row">
	<section class="col-lg-12">


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
						<div class="form-group ">
							<input type="text" class="form-control" name="nombre"  placeholder="Nombre y/o Apellido">
						</div>
						<div class="form-group">
							<select  name="nacionalidad_id" id="nacionalidad_id-flt"  class="form-control">
								<option value="">--Seleccione Nacionalidad--</option>
								@foreach ($paises as $pais)
								<option value="{{$pais->id}}"> {{$pais->nombre}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group ">
							<input type="text" class="form-control" name="documento_identidad"  placeholder="CI">
						</div>

						<div class="form-group ">
							<input type="text" class="form-control" name="telefono"  placeholder="Teléfono">
						</div>

						<div class="form-group ">
							<input type="text" class="form-control" name="licencia"  placeholder="Licencia">
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
					<h3 class="box-title"><span class="ion ion-people-stalker"></span> Pilotos Registrados</h3>
				</div><!-- /.box-header -->
				<div class="box-body" id="table-wrapper">
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
	</section>

	<section class="col-lg-6">
		<!-- Formulario de Registro -->
		<div class="box box-info" id="pilotoForm-div">
			<div class="box-header">
				<h3 class="box-title">Registro de Pilotos</h3>
			</div>
			<div class="box-body">
				<form id="piloto-form">
					<div class="input-group">
						<span class="input-group-addon"><i class="ion ion-android-arrow-dropright"></i></span>
						<input type="text" class="form-control no-vacio" name="nombre" placeholder="Apellido y Nombre" id="nombre-input">
					</div>
					<br/>
					<div class="input-group" >
						<span class="input-group-addon"><i class="ion ion-android-arrow-dropright"></i></span>
						<div class="form-group" style="margin-top: 10px">
							<select name="nacionalidad_id" class="form-control no-vacio" id="nacionalidad_id-select">
								<option value="">--Seleccione Nacionalidad--</option>
								@foreach ($paises as $pais)
								<option value="{{$pais->id}}"> {{$pais->nombre}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<br/>
					<div class="input-group">
						<span class="input-group-addon"><i class="ion ion-android-arrow-dropright"></i></span>
						<input type="text" name="documento_identidad" class="form-control no-vacio" placeholder="Documento de Identidad" id="documento_identidad-input">
					</div>
					<br/>
					<div class="input-group">
						<span class="input-group-addon"><i class="ion ion-android-arrow-dropright"></i></span>
						<input type="text" name="licencia"  class="form-control no-vacio" placeholder="Licencia" id="licencia-input">
					</div>
					<br/>
					<div class="input-group">
						<span class="input-group-addon"><i class="ion ion-android-arrow-dropright"></i></span>
						<input type="text" class="form-control" name="telefono" placeholder="Número de Contacto. Ej: 04XX0000000" id="telefono-input">
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
			</div><!-- /.box-body -->
			<div class="box-footer" align="right">
				<button class="btn btn-default" type="button" id="cancel-piloto-btn"> Cancelar </button>
				<button class="btn btn-primary" type="submit" id="save-piloto-btn" disabled> Registrar </button>
			</div><!-- ./box-footer -->
		</div><!-- /.box -->
	</section>

	<!-- Modal de edición -->

	<div class="modal fade" id="show-modal" tabindex="-1" role="dialog" aria-labelledby="editarPiloto-modalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" id="titulo-div-modal">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="titulo-modal">Editar Piloto</h4>
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button id="save-pilots-btn-modal" type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button>
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

//Función que comprueba que no existen campos sin llenar al momento de enviar el formulario.
    function camposVacios() {
    	var flag=true;
    	$('#pilotoForm-div .no-vacio').each(function(index, value){
    		if($(value).val()=='')
    			flag&=false;
    	});
    	if(flag==false){
    		$('#save-piloto-btn').attr('disabled','disabled');
    	}else{
    		$('#save-piloto-btn').removeAttr('disabled');
    	}
    }

    $(document).ready(function(){

    	/* 
    		Condiciones en los campos de los formularios
    		*/

    		$('#pilotoForm-div input').keyup(function()
    		{
    			camposVacios();
    		});

    		$('#pilotoForm-div select').change(function()
    		{
    			camposVacios();	
    		});


    		$('#nacionalidad_id-flt,#nacionalidad_id-select, #pais_id-select').chosen({width:'100%'})


        /*
            Limpiar Formularios
            */


           //Formulario de creación
           
           $('#cancel-piloto-btn').click(function(){
           	$('#pilotoForm-div input[type="text"]').val('');
           	$('#nacionalidad_id-select').val('1');
           });  


            /*	
	    	Listar los registros 
	    	*/

	    	$('#filtrar-btn').click(function(e){
	    		e.preventDefault();
	    		var data=$(this).closest('form').serialize();
	    		getTable("{{action('PilotoController@index')}}?"+data);

	    	}).trigger('click');


	    	$('#table-wrapper').delegate('.pagination li a', 'click', function(e){
	    		e.preventDefault();

		    //Hay que quitar el slash antes del ?, no se como no generarlo pero replace resuelve.
		    //
		    getTable($(this).attr('href').replace("/?", "?"));
		})

	    	/*	
	    	Guardar un nuevo registro
	    	*/


	    	$('#save-piloto-btn').click(function(){

	    		var data=$('#piloto-form').serializeArray();
	    		console.log(data);

	    		var overlay= "<div class='overlay'>\
	    		<i class='fa fa-refresh' fa-spin></i>\
	    		</div>";
	    		$('#pilotoForm-div').append(overlay);

	    		$.ajax(
	    			{data:data,
	    				method:'post',
	    				url:"{{action('PilotoController@store')}}"}
	    				)
	    		.always(function(response, status, responseObject){
	    			$('#pilotoForm-div .overlay').remove();

	    			if(status=="error"){
	    				if(response.status==422){
	    					alertify.error(processValidation(response.responseJSON));

	    				}
	    			}else{

	    				try{
	    					var respuesta=JSON.parse(responseObject.responseText);
	    					if(respuesta.success==1)
	    					{
	    						$('#pilotoForm-div .no-vacio').val('');
	    						$('#save-piloto-btn').attr('disabled','disabled');
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

	 // Botón para habilitar/inhabilitar
	 $('body').delegate('.activarPiloto-btn', 'click', function(){
	 	var fila =  $(this).closest('tr');
	 	var id   =  $(fila).data('id');

			// confirm dialog
			alertify.confirm("¿Realmente desea cambiar el estado a este piloto?", function (e) {
				if (e) {		

					$.ajax({
						data:{id:id},
						method:'get',
						url:"{{action('PilotoController@estadoPiloto')}}"})
					.always(function(text, status, responseObject){
						try{
							var respuesta=JSON.parse(responseObject.responseText);
							if(respuesta.success==1){
								if (respuesta.piloto.estado==0){
									console.log(respuesta.piloto.estado);
									$(fila).find('.activarPiloto-btn')
									.removeClass('btn-primary')
									.addClass('btn-default')
									.prop('title', 'Piloto Inhabilitado');

								}
								else if (respuesta.piloto.estado==1){

									console.log(respuesta.piloto.estado);
									$(fila).find('.activarPiloto-btn')
									.addClass('btn-primary')
									.removeClass('btn-default')
									.prop('title', 'Piloto Habilitado');								
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

    		$('body').delegate('.editarPiloto-btn', 'click', function(){
    			var fila = $(this).closest('tr');
    			var id   = $(fila).data('id');
    			var url  ='{{action('PilotoController@edit', ["::"])}}';
    			url      = url.replace("::", id)

    			$.ajax({
    				method: 'get',
    				url: url})
    			.always(function(text, status, responseObject){
    				$('#show-modal .modal-body').html(text);
    				$('#show-modal').modal('show');
    			})
    		})

    	//Editar la información

    	$('#save-pilots-btn-modal').click(function(){

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
    				console.log(e);
    				alertify.error('Error procesando la información');
    			}
    		})
    	})


	/*	
    	Eliminar registro
    	*/
    	$('body').delegate('.eliminarPiloto-btn', 'click', function(){
		var tr  =$(this).closest('tr');
		var id  =$(this).data('id');
		var url ="{{action('PilotoController@index')}}/"+id;
			// confirm dialog
			alertify.confirm("¿Realmente desea  eliminar este Piloto?", function (e) {
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


	}) //.document    




</script>


@endsection



