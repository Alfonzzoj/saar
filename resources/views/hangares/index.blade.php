@extends('app')
@section('content')

 <div class="row">
 		<section class="col-lg-8">


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
							<input type="text" class="form-control" name="nombre" placeholder="Nombre">
						</div>
						<div class="form-group" >
							<select name="aeropuerto_id" id="aeropuerto_id-flt" class="form-control">
							<option value="">--Seleccione Aeropuerto--</option>
								@foreach ($aeropuertos as $aeropuerto)
								<option value="{{$aeropuerto->id}}"> {{$aeropuerto->nombre}}</option>
								@endforeach
							</select>
						</div>
						<button type="submit" id="filtrar-btn" class="btn btn-primary" style="margin-left: 20px"><i class="fa fa-filter"></i></button>
					</form>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->

		<!-- Tabla de Hangares -->
		<div class="nav-tabs-custom">                          
			<div class="box box-info">
				<div class="box-header with-border">
					<h3 class="box-title"><span class="ion ion-people-stalker"></span> Hangares Registrados</h3>
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
 		<div id="hangarForm-div" class="box box-info">
 			<div class="box-header">
 				<h3 class="box-title">Registro de Hangares</h3>
 			</div>
 			<div class="box-body">
 				<form id="hangar-form">
			 		<div class="input-group">
			 			<span class="input-group-addon"><i class="ion ion-android-arrow-dropright"></i></span>
			 			<div class="form-group">
			 				<select name="aeropuerto_id" class="form-control" id="aeropuerto_id-select">
			 					<option value="">Aeropuerto</option>
			 					@foreach ($aeropuertos as $aeropuerto)
			 					<option value="{{$aeropuerto->id}}"> {{$aeropuerto->nombre}}</option>
			 					@endforeach
			 				</select>
			 			</div>
			 		</div>
	 				<br/>
	 				<div class="input-group">
	 					<span class="input-group-addon"><i class="ion ion-android-arrow-dropright"></i></span>
	 					<input type="text" name="nombre" class="form-control" placeholder="Nombre" id="nombre-input">
	 				</div>
	 				<br/>
 				</form>
 			</div><!-- /.box-body -->
 			<div class="box-footer" align="right">
 				<button class="btn btn-default" type="button" id="cancel-hangars-btn"> Cancelar </button>
 				<button class="btn btn-primary" type="submit" id="save-hangars-btn"> Registrar </button>
 			</div><!-- ./box-footer -->
 		</div><!-- /.box -->
 	</section>

 	<div class="modal fade" id="show-modal" tabindex="-1" role="dialog" aria-labelledby="editarHangar-modalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" id="titulo-div-modal">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="titulo-modal">Editar hangar</h4>
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button id="save-hangars-btn-modal" type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button>
				</div>
			</div>
		</div> <!-- /.Modal-dialog-->
	</div> <!-- /.Modal- fade-->
 </div><!-- /.row (main row) -->


@endsection
@section('script')

<script>

	//Función que muestra la tabla
	function getTable(url){
     	$('#table-wrapper').load(url)
    }

	//Función que comprueba que no existen campos sin llenar al momento de enviar el formulario.
	function camposVacios() {
		var flag=true;
		$('#hangarForm-div input[type="text"], #hangarForm-div select').each(function(index, value){
			if($(value).val()=='')
				flag&=false;
		});
		if(flag==false){
			$('#save-hangars-btn').attr('disabled','disabled');
		}else{
			$('#save-hangars-btn').removeAttr('disabled');
		}
	}



	$(document).ready(function(){

		/*	
		 	Select
		 	*/

		$('#aeropuerto_id-flt, #cliente_id-flt, #aeronave_id-flt').chosen({width:'100%'})

		$('#hangarForm-div input[type="text"]').keyup(function(){
			camposVacios();
		});

		$('#hangarForm-div select').change(function(){
			camposVacios();
		});

		/*	
			Listar los registros 
			*/
			$('#filtrar-btn').click(function(e){
				e.preventDefault();
				var data=$(this).closest('form').serialize();
				getTable("{{action('HangarController@index')}}?"+data);
			}).trigger('click');


			$('#table-wrapper').delegate('.pagination li a', 'click', function(e){
				e.preventDefault();

		    //Hay que quitar el slash antes del ?, no se como no generarlo pero replace resuelve.
		    //
		    getTable($(this).attr('href').replace("/?", "?"));
		})


		/*
			Modificar un registro

			*/ 		    		

			//Mostrar la información en un modal para editar

		 $('body').delegate('.editarHangar-btn', 'click', function(){
			var fila = $(this).closest('tr');
			var id   = $(fila).data('id');
			var url  ='{{action('HangarController@edit', ["::"])}}';
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
		
		 $('#save-hangars-btn-modal').click(function(){

				var data =$('#show-modal form').serializeArray()
				var url  =$('#show-modal form').attr('action')

			$.ajax({data:data,
				method:'PUT',
				url:url})
			.always(function(response, status, responseObject){
			if(status=="error"){
	                if(response.status==422){
	                    alertify.error(processValidation(response.responseJSON));
	                }
                }
                else
                {
					
				try{
					var respuesta=JSON.parse(responseObject.responseText);
						if(respuesta.success==1){						
							$('#filtrar-btn').trigger('click');
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
				}
			})
		})

		/*	
	    	Eliminar registro
	    	*/
		 $('body').delegate('.eliminarHangar-btn', 'click', function(){
			var tr  =$(this).closest('tr');
			var id  =$(this).data('id');
			var url ="{{action('HangarController@index')}}/"+id;
			
			// confirm dialog
			alertify.confirm("¿Realmente desea  eliminar este Hangar?", function (e) {
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

		 $('#save-hangars-btn').click(function(){

			var data=$('#hangar-form').serializeArray();
			console.log(data);

		 	var overlay= "<div class='overlay'>\
		 	<i class='fa fa-refresh fa-spin'></i>\
		 	</div>";

		 	$('#hangarForm-div').append(overlay);

		 	$.ajax(
				{data:data,
					method:'post',
					url:"{{action('HangarController@store')}}"}
				)
			 	.always(function(response, status, responseObject){
			 		$('#hangarForm-div .overlay').remove();

			 		if(status=="error"){
		                if(response.status==422){
		                    alertify.error(processValidation(response.responseJSON));
		                }
	                }
	                else
	                {
				 		try{
				 			var respuesta=JSON.parse(responseObject.responseText);
				 			if(respuesta.success==1){
				 				$('#hangarForm-div input[type="text"], #hangarForm-div select').val('');
				 				$('#save-hangars-btn').attr('disabled','disabled');
								$('#filtrar-btn').trigger('click');
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
				 	}
			 	})
			})
		})



 </script>

@endsection