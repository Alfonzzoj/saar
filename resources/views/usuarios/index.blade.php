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
							<input type="text" class="form-control" name="username"  placeholder="Username">
						</div>
						<div class="form-group ">
							<input type="text" class="form-control" name="fullname"  placeholder="Nombre">
						</div>
						<div class="form-group">
							<select  name="departamento_id" id="departamento_id-flt"  class="form-control">
								<option value="">--Seleccione Departamento--</option>
								@foreach ($departamentos as $index=>$departamento)
								<option value="{{$index}}"> {{$departamento}}</option>
								@endforeach
							</select>
						</div>
						<div class="pull-right">
							<button type="submit" id="filtrar-btn" class="btn btn-primary" style="margin-left: 20px"><i class="fa fa-filter"></i></button>
							<a class="btn btn-default" href="{{action('UsuarioController@index')}}">Reset</a>
						</div>
					</form>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->

		<!-- Tabla de Usuarios -->
		<div class="nav-tabs-custom">                          
			<div class="box box-info">
				<div class="box-header with-border">
					<h3 class="box-title"><span class="ion ion-people-stalker"></span> Usuarios Registrados</h3>
				</div><!-- /.box-header -->
				<div class="box-body" id="table-wrapper">
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
	</section>

	<section class="col-lg-6">
		<!-- Formulario de Registro -->
		
 		<!-- Formulario de Registro -->
 		<div id="userForm-div" class="box box-info">
 			<div class="box-header">
 				<h3 class="box-title">Registro de Usuario</h3>
 			</div>
 			<div class="box-body">
 				<form id="user-form">
		 			<div class="input-group">
		 				<span class="input-group-addon">@</span>
		 				<input type="text" class="form-control" placeholder="Nombre de Usuario" name="username" id="username-input">
		 			</div>
		 			<br/>
		 			<div class="input-group">
		 				<span class="input-group-addon"><i class="ion ion-locked"></i></span>
		 				<input type="text" class="form-control" name="password" placeholder="Contraseña" id="password-input">
		 			</div>
		 			<br/>
		 			<div class="input-group">
		 				<span class="input-group-addon"><i class="ion ion-locked"></i></span>
		 				<input type="text" class="form-control" placeholder="Repetir Contraseña" id="password2-input">
		 			</div>
		 			<br/>
		 			<div class="input-group">
		 				<span class="input-group-addon"><i class="ion ion-android-arrow-dropright"></i></span>
		 				<input type="text" class="form-control" name="fullname" placeholder="Nombre y Apellido" id="fullname-input">
		 			</div>
		 			<br/>

                    <br>
		 			<div class="input-group">
							<span class="input-group-addon"><i class="ion ion-android-arrow-dropright"></i></span>
						<div class="form-group">
							<select  name="departamento_id" id="departamento_id-flt"  class="form-control">
								<option value="">--Seleccione Departamento--</option>
								@foreach ($departamentos as $index=>$departamento)
								<option value="{{$index}}"> {{$departamento}}</option>
								@endforeach
							</select>
						</div>
					</div>
		 			<br/>
		 			<div class="input-group">
		 				<span class="input-group-addon"><i class="ion ion-android-arrow-dropright"></i></span>
		 				<div class="form-group">
							<select  name="cargo_id" id="cargo_id"  class="form-control">
								<option value="">--Seleccione Cargo--</option>
								@foreach ($cargos as $index=>$cargo)
								<option value="{{$index}}"> {{$cargo}}</option>
								@endforeach
							</select>
		 				</div>
		 			</div>
		 			<br/>
		 			<div class="input-group">
		 				<span class="input-group-addon"><i class="ion ion-android-arrow-dropright"></i></span>
		 				<input type="text" class="form-control" name="directo" placeholder="Directo" id="directo-input">
		 			</div>
		 			<br/>
		 			<div class="input-group">
		 				<span class="input-group-addon"><i class="ion ion-android-arrow-dropright"></i></span>
		 				<input type="text" class="form-control" name="email" placeholder="Email" id="email-input">
		 			</div>
		 			<br/>
					<div class="form-group">
						<div class="checkbox">
							<label>
								{!! Form::checkbox('estado', '1', true) !!} Activo
							</label>
						</div>
					</div>
					<br>
					<label>Seleccione Aeropuerto(s)</label>
                    <div class="form-group"  style="margin-bottom:100px; margin-top: 20px">
                        <div class="col-xs-6 text-center">
                            <label>Aeropuertos Disponibles</label>
                        </div>
                        <div class="col-xs-6 text-center">
                            <label>Aeropuerto(s) Autorizado(s)</label>
                        </div>
                        <div class="col-xs-12">
                            {!! Form::select('aeropuertos[]', $aeropuertos, null, [ 'class'=>"form-control", 'multiple'=>'multiple', 'id'=>'aeropuerto-select']) !!}
                        </div>
                    </div>
                    <br>
				</form>
	 		</div><!-- /.box-body -->
	 		<div class="box-footer" align="right">
	 			<button class="btn btn-primary" type="submit" id="save-user-btn" disabled> Registrar </button>
	 		</div><!-- ./box-footer -->
	 	</div><!-- /.box -->
	</section>

	<!-- Modal de edición -->

	<div class="modal fade" id="show-modal" tabindex="-1" role="dialog" aria-labelledby="editarUsuario-modalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" id="titulo-div-modal">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="titulo-modal">Editar Usuario</h4>
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button id="save-user-btn-modal" type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button>
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
    	$('#userForm-div .no-vacio').each(function(index, value){
    		if($(value).val()=='')
    			flag&=false;
    	});
    	if(flag==false){
    		$('#save-user-btn').attr('disabled','disabled');
    	}else{
    		$('#save-user-btn').removeAttr('disabled');
    	}
    }

    $(document).ready(function(){

    	/* 
    		Condiciones en los campos de los formularios
    		*/

    		$('#userForm-div input').keyup(function()
    		{
    			camposVacios();
    		});

    		$('#userForm-div select').change(function()
    		{
    			camposVacios();	
    		});


    		$('#departamento_id-flt,#departamento_id-select,#cargo_id-select,#cargo_id, #departamento-select-modal, #cargo-select-modal').chosen({width:'100%'})
    		$('#aeropuerto-select').multiSelect();
    		


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
	    		getTable("{{action('UsuarioController@index')}}?"+data);

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


	    	$('#save-user-btn').click(function(){

	    		var data=$('#user-form').serializeArray();
	    		var overlay= "<div class='overlay'>\
	    		<i class='fa fa-refresh' fa-spin></i>\
	    		</div>";
	    		$('#userForm-div').append(overlay);

	    		$.ajax(
	    			{data:data,
	    				method:'post',
	    				url:"{{action('UsuarioController@store')}}"}
	    				)
	    		.always(function(response, status, responseObject){
	    			$('#userForm-div .overlay').remove();

	    			if(status=="error"){
	    				if(response.status==422){
	    					alertify.error(processValidation(response.responseJSON));

	    				}
	    			}else{

	    				try{
	    					var respuesta=JSON.parse(responseObject.responseText);
	    					if(respuesta.success==1)
	    					{
	    						console.log(respuesta);
	    						
	    						$('#userForm-div .no-vacio').val('');
	    						$('#save-user-btn').attr('disabled','disabled');
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
	 $('body').delegate('.activarUsuario-btn', 'click', function(){
	 	var fila =  $(this).closest('tr');
	 	var id   =  $(fila).data('id');

			// confirm dialog
			alertify.confirm("¿Realmente desea cambiar el estado a este usuario?", function (e) {
				if (e) {		

					$.ajax({
						data:{id:id},
						method:'get',
						url:"{{action('UsuarioController@estadoUser')}}"})
					.always(function(text, status, responseObject){
						try{
							var respuesta=JSON.parse(responseObject.responseText);
							if(respuesta.success==1){
								if (respuesta.usuario.estado==0){
									console.log(respuesta.usuario.estado);
									$(fila).find('.activarUsuario-btn')
									.removeClass('btn-primary')
									.addClass('btn-default')
									.prop('title', 'Usuario Inhabilitado');

								}
								else if (respuesta.usuario.estado==1){

									console.log(respuesta.usuario.estado);
									$(fila).find('.activarUsuario-btn')
									.addClass('btn-primary')
									.removeClass('btn-default')
									.prop('title', 'Usuario Habilitado');								
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

    		$('body').delegate('.editarUsuario-btn', 'click', function(){
    			var fila = $(this).closest('tr');
    			var id   = $(fila).data('id');
    			var url  ='{{action('UsuarioController@edit', ["::"])}}';
    			url      = url.replace("::", id)

    			$.ajax({
    				method: 'get',
    				url: url})
    			.always(function(text, status, responseObject){
    				$('#show-modal .modal-body').html(text);
    				$('#show-modal').modal('show');
    				$('#aeropuerto-select-modal').multiSelect();
    				$('#departamento-select-modal, #cargo-select-modal').chosen({width:'100%'});
    			})
    		})

    	//Editar la información

    	$('#save-user-btn-modal').click(function(){

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
    	$('body').delegate('.eliminarUsuario-btn', 'click', function(){
    		var tr  =$(this).closest('tr');
    		var id  =$(this).data('id');
    		var url ="{{action('UsuarioController@index')}}/"+id;
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


  		}) //.document    




</script>


@endsection



