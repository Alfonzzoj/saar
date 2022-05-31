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
						<div class="form-group">
							<input type="text" class="form-control" name="nombre_fbo"  placeholder="Nombre Fbo">
						</div>

						<button type="submit" id="filtrar-btn" class="btn btn-primary" style="margin-left: 20px"><i class="fa fa-filter"></i></button>
					</form>
				</div><!-- /.box-body -->

			</div><!-- /.box -->
		</div><!-- /.col --> 
		<!-- Tabla de fbos -->
		<div class="nav-tabs-custom">
			<div class="box box-info">
				<div class="box-header with-border">
					<h3 class="box-title"><span class="ion ion-people-stalker"></span> Fbos registrados</h3>
				</div><!-- /.box-header -->
				<div class="box-body" id="table-wrapper">

				</div><!-- /.box-body -->
                <!--<div class="overlay">
     					<i class="fa fa-refresh fa-spin"></i>
     				</div> -->
     			</div><!-- /.box -->
     		</div><!-- /.col -->
     	</section>

     	<section class="col-lg-6">

     		<!-- Formulario de Registro -->
     		<div id="fbosForm-div" class="box box-info">
     			<div class="box-header">
     				<h3 class="box-title">Registro de Fbo</h3>
     			</div>
     			<div class="box-body">
     				<form id="fbo-form">
     					<div class="input-group">
     						<span class="input-group-addon"><i class="ion ion-android-arrow-dropright"></i></span>
     						<input name="nombre_fbo" id="fbo-nombre-input" type="text" class="form-control no-vacio" placeholder="Ingrese nombre del fbo ">
     					</div>
     					<br/>
     				</form><!-- /.fbo-form -->
     			</div><!-- /.box-body -->
     			<div class="box-footer" align="right">
     				<button class="btn btn-default" type="button" id="cancel-fbos-btn"> Cancelar </button>
     				<button class="btn btn-primary" type="submit"id="save-fbos-btn" disabled> Registrar </button>
     			</div><!-- ./box-footer -->
     		</div><!-- /.box -->
     	</section>

     	<!-- Modal de edición -->

     	{{-- <div class="modal fade" id="show-modal" tabindex="-1" role="dialog" aria-labelledby="editarfbo-modalLabel" aria-hidden="true">
     		<div class="modal-dialog">
     			<div class="modal-content">
     				<div class="modal-header" id="titulo-div-modal">
     					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     					<h4 class="modal-title" id="titulo-modal">Editar fbo</h4>
     				</div>
     				<div class="modal-body">
     				</div>
     				<div class="modal-footer">
     					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
     					<button id="save-fbos-btn-modal" type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button>
     				</div>
     			</div>
     		</div> <!-- /.Modal-dialog-->
     	</div> <!-- /.Modal- fade--> --}}
     </div><!-- /.row (main row) -->

 @endsection

 @section('script')

 <script>

// Función constructora de la tabla.
function getTable(url){
    $('#table-wrapper').load(url)
}

//Función que comprueba que no existen campos sin llenar al momento de enviar el formulario.
function camposVacios() {
	var flag=true;
	$('#fbosForm-div .no-vacio').each(function(index, value){
		if($(value).val()=='')
			flag&=false;
	});
	if(flag==false){
		$('#save-fbos-btn').attr('disabled','disabled');
	}else{
		$('#save-fbos-btn').removeAttr('disabled');
	}
}



$(document).ready(function(){

	/* 
		Condiciones en los campos de los formularios
		*/

		$('#fbosForm-div input').keyup(function()
		{
			camposVacios();
		});

		$('#fbosForm-div select').change(function()
		{
			camposVacios();	
		});

    /*
        Limpiar Formularios
        */


       //Formulario de creación
       
    	$('#cancel-fbos-btn').click(function(){
   			$('#fbosForm-div input, #fbosForm-div select').val('');
    	});          


    /*	
    	Listar los registros 
    	*/
    	$('#filtrar-btn').click(function(e){
    		e.preventDefault();
    		var data=$(this).closest('form').serialize();
			console.log(data)
    		getTable("{{action('FboController@index')}}?"+data);
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

  		$('body').delegate('.editarFbo-btn', 'click', function(){
  			var fila = $(this).closest('tr');
  			var id   = $(fila).data('id');
  			var url  ='{{action('FboController@edit', ["::"])}}';
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
		
		$('#save-fbos-btn-modal').click(function(){

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
                            }else{
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
					alertify.error('Error procesando la información');
				}
				}
			})
		})




	/*	
    	Eliminar registro
    	*/
    	$('body').delegate('.eliminarfbo-btn', 'click', function(){
    		var tr  =$(this).closest('tr');
            console.log(tr)
    		var id  =$(this).data("id");
    		var url ="{{action('FboController@index')}}/"+id;


				// confirm dialog
				alertify.confirm("¿Realmente desea  eliminar este fbo?", function (e) {
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
    	$('#save-fbos-btn').click(function(){

    		var data=$('#fbo-form').serializeArray();
    		
    		var overlay= 	"<div class='overlay'>\
    		<i class='fa fa-refresh' fa-spin></i>\
    		</div>";
    		$('#fbosForm-div').append(overlay);

    		$.ajax(
    			{data:data,
    				method:'post',
    				url:"{{action('FboController@store')}}"}
    				)
    		.always(function(response, status, responseObject){

    			$('#fbosForm-div .overlay').remove();
				
                if(status=="error"){
                    if(response.status==422){
                        alertify.error(processValidation(response.responseJSON));

                    }
                }else{

        			try{
        				var respuesta=JSON.parse(responseObject.responseText);
						console.log(respuesta);
        				if(respuesta.success==1)
        				{
        					$('#fbosForm-div .no-vacio').val('');
        					$('#save-fbos-btn').attr('disabled','disabled');
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
        			console.log(e);
        				alertify.error("Error procensando la información");
        			}
                }
    		})
    	})


})



</script>

@endsection



