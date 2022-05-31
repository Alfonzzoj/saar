<input type="hidden" id="cal-unidad-tributaria"></input>
<input type="hidden" id="cal-dolar-oficial"></input>
<input type="hidden" id="cal-euro-oficial"></input>

<div class="row invoice-info">
	<div class="col-sm-12 invoice-col">	
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title">Registro de Otros Cargos</h3>
			</div>
			<div class="box-body" id="otrosCargos-div">
				<form id="otrosCargos-form">
					<div class="row" style="margin-top: 0;">
						<div class="col-md-10">		
							<h5 class="">Concepto</h5>	
							<div class="input-group">
								<span class="input-group-addon">Concepto</span>
								{!! Form::select('conceptos_id[]', $conceptoss, null, [ 'class'=>"form-control chosen-select conceptos-select", "multiple"=>"true",  "autocomplete"=>"off", 'id'=>"conceptos-select"]) !!}
								<input type="hidden" id="aeropuerto_id" name="aeropuerto_id" value="{{session('aeropuerto')->id}}"></input>
							</div>
						</div>
						<div class="col-sm-6">
							<h5 class="">Peso</h5>
							<div class="input-group">
								<span class="input-group-addon">Desde</span>
								<input type="text" name="peso_desde" class="form-control" placeholder="">
								<span class="input-group-addon">Kg(s)</span>
							</div>
							<div class="input-group">
								<span class="input-group-addon">Hasta</span>
								<input type="text" name="peso_hasta" class="form-control" placeholder="">
								<span class="input-group-addon">Kg(s)</span>
							</div>
							<h5 class="">Monto</h5>
							<div id="d-tributarias" class="input-group">
								<span class="input-group-addon">Unidades</span>
								<input type="number" step="0.00001" id="unidad_tributaria" name="unidades" class="form-control" placeholder="">
								<span class="input-group-addon">Unidades</span>
							</div>
							<div class="input-group">
								<span class="input-group-addon">Tipo pago</span>
								{!! Form::select('tipo_pago_id',$tipo_pagos,null, [ 'class'=>"form-control", 'id' => 'tipo_pago_otros_cargos']) !!}
							</div>
						</div>
						<div class="col-sm-6">
							<h5 class="">Matrícula</h5>
							<div class="input-group">
								<span class="input-group-addon">Tipo</span>
								{!! Form::select('tipos_matriculas_id[]', $tipos_matriculas, null, [ 'class'=>"form-control chosen-select tipos_matriculas-select", "multiple"=>"true",  "autocomplete"=>"off", 'id'=>"tipos_matriculas-select"]) !!}
							</div>
							<div class="input-group">
								<span class="input-group-addon">Nacionalidad</span>
								{!! Form::select('nacionalidad_matriculas[]', $nacionalidades_vuelos, null, [ 'class'=>"form-control chosen-select nacionalidad_matricula-select", "multiple"=>"true", 'id'=>"nacionalidad_matricula-select"]) !!}
							</div>
							<h5 class="">Vuelo</h5>
							<div class="input-group">
								<span class="input-group-addon">Procedencia</span>
								{!! Form::select('procedencias_id[]', $nacionalidades_vuelos, null, [ 'class'=>"form-control chosen-select procedencias-select", "multiple"=>"true",  "autocomplete"=>"off", 'id'=>"procedencias-select"]) !!}
							</div>
						</div>
					</div>	
				</form>
			</div><!-- /.box-body -->
			<div class="box-footer" align="right">
 				<button class="btn btn-default" type="button" id="cancel-otrosCargos-btn">Cancelar </button>
 			    <button class="btn btn-primary" type="submit" id="save-otrosCargos-btn"> Registrar </button>
     		</div><!-- ./box-footer -->
		</div><!-- /.box -->
	</div> <!-- /.col -->
</div>	
<div class="row invoice-info">
	<div class="col-sm-12 invoice-col">
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
								<i class="fa fa-angle-right"></i>
							</div>
							<input type="text" name="nombre_cargo" class="form-control nombre_cargo"  placeholder="Nombre del Cargo" style="width:300px;" />
							<input type="hidden" name="aeropuerto_id" value="{{session('aeropuerto')->id}}"></input>
						</div><!-- /.input group -->
					</div>						
					<button type="submit" id="filtrar-btn" class="btn btn-primary pull-right" style="margin-left: 20px"><i class="fa fa-filter"></i></button>
				</form>
			</div><!-- /.box-body -->
		</div><!-- /.box -->

		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><span class="ion ion-people-stalker"></span>Otros Cargos</h3>
			</div><!-- /.box-header -->
			<div class="box-body" id="table-wrapper">
			</div><!-- /.box-body -->
			<!-- <div class="overlay">
				<i class="fa fa-refresh fa-spin"></i>
			</div> -->
		</div><!-- /.box -->

	</div><!-- /.invoice col -->
</div>
	<!-- Modal de edición -->

	<div class="modal fade" id="show-modal" tabindex="-1" role="dialog" aria-labelledby="editarOtroCargo-modalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" id="titulo-div-modal">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="titulo-modal">Editar Cargo</h4>
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button id="save-otrosCargos-btn-modal" type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button>
				</div>
			</div>
		</div> <!-- /.Modal-dialog-->
	</div> <!-- /.Modal- fade-->




@section('script')
@parent
<script> 

	function getTable(url){
		$('#table-wrapper').load(url)
	}

	$('#show-modal').on('shown.bs.modal', function (e) {
		// EDIT IN MODAL - MOSTRAR CAMPO MONTO PARA CADA CASO DE LA NACIONALIDAD DE LA MATRICULA

		$('#nacionalidad_matricula-modal').change(function(e){
			if($('#nacionalidad_matricula-modal').val() == 1)
			{
				$('#d-dolares-modal').addClass('hidden');
				$('#dolares-modal').attr("disabled", true);

				$('#d-tributarias-modal').removeClass('hidden ');
				$('#unidad_tributaria-modal').prop('disabled', false);
			}else{
				$('#d-dolares-modal').removeClass('hidden');
				$('#dolares-modal').prop('disabled', false);

				$('#d-tributarias-modal').addClass('hidden');
				$('#unidad_tributaria-modal').attr("disabled", true);
			}
		});

		$('#nacionalidad_matricula-modal').trigger('change');
	});

	$(document).ready(function() {



		$('#conceptos-select').chosen({width:'600px'});
		$('#tipos_matriculas-select').chosen({width:'400px'});
		$('#procedencias-select').chosen({width:'350px'});
		$('#nacionalidad_matricula-select').chosen({width:'350px'});
		$('#nacionalidad_matricula-select').change();
		$('#cal-unidad-tributaria').val($('body #General-tab .unidad_tributaria').val());
		$('#cal-dolar-oficial').val($('body #General-tab .dolar_oficial').val());
		$('#cal-euro-oficial').val($('body #General-tab .euro_oficial').val());


		$( "body body #aterrizajeComercialNacional-tab input").keyup(function( event ) {
			console.log($('#tipo_pago_otros_cargos').val() )
			var eq   =$('body #General-tab .euro_oficial').val();
				let val = $('#equivalente_otros_cargos').val() * eq;
				console.log(val);
				$('#unidad_tributaria').val(val.toFixed(5));
		});
	


		/*	
    	Listar los registros 
    	*/

	    	$('#filtrar-btn').click(function(e){
	    		e.preventDefault();
	    		var data=$(this).closest('form').serialize();
	    		getTable("{{action('OtrosCargoController@index')}}?"+data);
	    	}).trigger('click');


	    	$('#table-wrapper').delegate('.pagination li a', 'click', function(e){
	    		e.preventDefault();

	    	    //Hay que quitar el slash antes del ?, no se como no generarlo pero replace resuelve.
	    	    
	    	    getTable($(this).attr('href').replace("/?", "?"));
    		})

	    	/*
    		Modificar un registro

    		*/ 		    		

    		//Mostrar la información en un modal para editar

    		$('body').delegate('.editarOtroCargo-btn', 'click', function(){
    			var fila = $(this).closest('tr');
    			var id   = $(fila).data('id');
    			var url  ='{{action('OtrosCargoController@edit', ["::"])}}';
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

    	$('#save-otrosCargos-btn-modal').click(function(){

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
            
            $('body').delegate('.eliminarOtroCargo-btn', 'click', function(){
            var tr  =$(this).closest('tr');
            var id  =$(this).data('id');
            var url ="{{action('OtrosCargoController@index')}}/"+id;
            
            // confirm dialog
            alertify.confirm("¿Realmente desea  eliminar este registro?", function (e){
                if (e) {        

                    $.ajax({url: url,
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
        $('#save-otrosCargos-btn').click(function(){

            var data=$('#otrosCargos-form').serializeArray();
            
            var overlay=    "<div class='overlay'>\
            <i class='fa fa-refresh fa-spin></i>\
            </div>";
            $('#otrosCargos-div').append(overlay);

            $.ajax(
                {data:data,
                    method:'post',
                    url:"{{action('OtrosCargoController@store')}}"}
                    )
            .always(function(response, status, responseObject){
               $('#otrosCargos-div .overlay').remove();
                if(status=="error"){
                    if(response.status==422){
                        alertify.error(processValidation(response.responseJSON));
                    }
                }else{

                    try{
                        var respuesta=JSON.parse(responseObject.responseText);
                        if(respuesta.success==1)
                        {
                            $('#otrosCargos-form input').val('');
                            $('#aeropuerto_id').val("{{session('aeropuerto')->id}}");

                            $('#save-aeronave-btn').attr('disabled','disabled');
                            $(".chosen-select").val('').trigger("chosen:updated");
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
@endsection('script')