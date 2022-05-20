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

					<form class="form-inline" id="form-filter">
						{!! Form::hidden('sortName', null, []) !!}
						{!! Form::hidden('sortType', null, []) !!}
                        <div class="form-group">
                            <input type="text" class="form-control" name="matricula"  placeholder="Matrícula">
                        </div>

                        <div class="form-group" >
                            <select name="nacionalidad_id" id="nacionalidad_id-flt" class="form-control">
                                <option value="">--Nacionalidad--</option>
                                @foreach ($nacionalidad_matriculas as $nacionalidad_matricula)
                                <option value="{{$nacionalidad_matricula->id}}"> {{$nacionalidad_matricula->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" >
                            <select name="modelo_id" id="modelo_id-flt" class="form-control">
                                <option value="">--Modelo--</option>
                                @foreach ($modelo_aeronaves as $modelo_aeronave)
                                <option value="{{$modelo_aeronave->id}}"> {{$modelo_aeronave->modelo}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" >
                            <select name="tipo_id" id="tipo_id-flt" class="form-control">
                                <option value="">--Tipo de Matrícula--</option>
                                @foreach ($tipo_matriculas as $tipo_matricula)
                                <option value="{{$tipo_matricula->id}}"> {{$tipo_matricula->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" >
                            <select name="cliente_id" id="cliente_id-flt" class="form-control">
                                <option value="">--Cliente--</option>
                                @foreach  ($clientes as $index=>$cliente)
                                <option value="{{$index}}"> {{$cliente}}</option>
                                @endforeach
                            </select>
                        </div>
						<button type="submit" id="filtrar-btn" class="btn btn-primary" style="margin-left: 20px"><i class="fa fa-filter"></i></button>
					</form>
				</div><!-- /.box-body -->

			</div><!-- /.box -->
		</div><!-- /.col -->
		
		<!-- Tabla de aeronaves-->
		<div class="nav-tabs-custom">						
			<div class="box box-info">
				<div class="box-header with-border">
					<h3 class="box-title"><span class="ion ion-people-stalker"></span> Aeronaves Registradas</h3>
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
        <div class="box box-info" id="aeronaveForm-div">
            <div class="box-header">
                <h3 class="box-title">Registro de Aeronaves</h3>
            </div>
            <div class="box-body">
                <form id="aeronave-form">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="ion ion-android-arrow-dropright"></i></span>
                        <div class="form-group" style="margin-top: 12px">
                            <select class="form-control no-vacio nacionalidad" id="nacionalidad-select" name="nacionalidad_id" required>
                                <option value="">--Seleccione Nacionalidad--</option>
                                @foreach ($nacionalidad_matriculas as $nacionalidad_matricula)
                                <option data-siglas="{{$nacionalidad_matricula->siglas}}" value="{{$nacionalidad_matricula->id}}"> {{$nacionalidad_matricula->nombre}}</option>
                                @endforeach                     
                            </select>
                        </div>
                    </div>
                    <br/>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="ion ion-android-arrow-dropright"></i></span>
                        <input type="text" class="form-control no-vacio matricula" placeholder="Matrícula" disabled name="matricula" id="matricula-input" required>
                    </div>
                    <br/>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="ion ion-android-arrow-dropright"></i></span>
                        <div class="form-group" style="margin-top: 12px">
                            <select class="form-control no-vacio modelo" id="modelo_id-select" name="modelo_id" required>
                              <option value="">--Seleccione Modelo de Aeronave--</option>
                                @foreach ($modelo_aeronaves as $modelo_aeronave)
                                <option data-peso="{{$modelo_aeronave->peso_maximo}}" value="{{$modelo_aeronave->id}}"> {{$modelo_aeronave->modelo}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br/>
                    <div class="input-group" >
                        <span class="input-group-addon"><i class="ion ion-android-arrow-dropright"></i></span>
                        <input type="text" class="form-control no-vacio peso" placeholder="Peso (kg.)"  name="peso"  id="peso-input">
                    </div>
                    <br/>
                    <div class="input-group" >
                        <span class="input-group-addon"><i class="ion ion-android-arrow-dropright"></i></span>
                        <div class="form-group" style="margin-top: 12px">
                            <select class="form-control no-vacio tipo" id="tipo_id-select"  name="tipo_id" required>
                                <option value="">--Seleccione Tipo--</option>
                                @foreach ($tipo_matriculas as $tipo_matricula)
                                <option value="{{$tipo_matricula->id}}"> {{$tipo_matricula->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="ion ion-android-arrow-dropright"></i></span>
                        <div class="form-group" style="margin-top: 8px"> 
                            <select class="form-control" id="hangar_id-select" name="hangar_id" >
                                <option value=''>-- Seleccione Hangar --</option>
                                <option value=''>No dispone</option>
                                @foreach ($hangars as $index=>$hangar)
                                <option value="{{$index}}"> {{$hangar}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br/>
                    <div class="input-group" >
                        <span class="input-group-addon"><i class="ion ion-android-arrow-dropright"></i></span>
                        <div class="form-group" style="margin-top: 12px">
                            <select class="form-control no-vacio cliente" id="cliente_id-select"  name="cliente_id" required>
                                <option value=''>--Seleccione Cliente--</option>
                                @foreach  ($clientes as $index=>$cliente)
                                <option value="{{$index}}"> {{$cliente}}</option> 
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div><!-- /.box-body -->
            <div class="box-footer" align="right">
                <button class="btn btn-default" type="button" id="cancel-aeronave-btn">Cancelar </button>
                <button class="btn btn-primary" type="submit" id="save-aeronave-btn"> Registrar </button>
            </div><!-- ./box-footer -->
        </div><!-- /.box -->
     </section>

 	

 <!-- Modal de edición -->

    <div class="modal fade" id="show-modal" tabindex="-1" role="dialog" aria-labelledby="editarAeronave-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" id="titulo-div-modal">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="titulo-modal">Editar Aeronave</h4>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button id="save-aeronave-btn-modal" type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button>
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
        $('#aeronaveForm-div .no-vacio').each(function(index, value){
            if($(value).val()=='')
               flag&=false;
        });
        if(flag==false){
            $('#save-aeronave-btn').attr('disabled','disabled');
        }else{
            $('#save-aeronave-btn').removeAttr('disabled');
        }
    }

   $(document).ready(function(){

    	/* 
    		Condiciones en los campos de los formularios
    		*/

    		$('#aeronaveForm-div input').keyup(function()
    		{
    			camposVacios();
    		});

    		$('#aeronaveForm-div select').change(function()
    		{
    			camposVacios();	
    		});


            $('body').delegate('.tipo', 'change', function() {
                if ($('#aeronaveForm-div .tipo').val() == '4'){
                    $('#aeronaveForm-div .cliente').removeClass('no-vacio')                
                }              
            });

            $('body').delegate('.nacionalidad', 'change', function() {
                var option    =$(this).find('option:selected');
                var matricula =$(this).closest('form').find('.matricula');
                if ($(option).val() == ''){
                    $(matricula).val('').attr('disabled', 'disabled');
                }else{
                    var siglas=$(option).data('siglas');
                    $(matricula).val(siglas+'-').removeAttr('disabled');
                }               
            });

            $('body').delegate('.modelo', 'change', function() {
                var option =$(this).find('option:selected');
                var peso   =$(this).closest('form').find('.peso');

                console.log(option, peso)
                if ($(option).val() == ''){
                    $(peso).val('').attr('disabled', 'disabled');
                }else{
                    var peso_aeronave=$(option).data('peso');
                    $(peso).val(peso_aeronave).removeAttr('disabled');
                }               
            });


        /*
        
            Select
            */

            $('#cliente_id-flt').chosen({width:'400px'});
            $('#nacionalidad_id-flt,#tipo_id-flt, #modelo_id-flt').chosen({width:'400px'});
            $('#hangar_id-flt').chosen({width:'100px'});
    		$('#cliente_id-select, #hangar_id-select, #tipo_id-select, #nacionalidad-select, #modelo_id-select').chosen({width:'400px'});

    		$('#modelo_id-select').chosen({width: "400"}).change(function(){
    			var peso =$('#modelo_id-select').data('peso');
    			$('#peso-input').val(peso);
    		}).trigger('change');

        /*
            Limpiar Formularios
            */


           //Formulario de creación
           
           $('#cancel-aeronave-btn').click(function(){
             	$('#aeronaveForm-div input, #aeronaveForm-div select').val('');
           });          


            /*  
            Listar los registros 
            */

            $('#filtrar-btn').click(function(e){
                e.preventDefault();
                var data=$(this).closest('form').serialize();
                getTable("{{action('AeronaveController@index')}}?"+data);

            }).trigger('click');


            $('#table-wrapper').delegate('.pagination li a', 'click', function(e){
                e.preventDefault();

            //Hay que quitar el slash antes del ?, no se como no generarlo pero replace resuelve.
            //
            getTable($(this).attr('href').replace("/?", "?"));
        })

        /*   
            Eliminar registro
            */
        $('body').delegate('.eliminarAeronave-btn', 'click', function(){
            var tr  =$(this).closest('tr');
            var id  =$(this).data('id');
            var url ="{{action('AeronaveController@index')}}/"+id;
            
            // confirm dialog
            alertify.confirm("¿Realmente desea  eliminar esta Aeronave?", function (e) {
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

            $('body').delegate('.editarAeronave-btn', 'click', function(){
                var fila = $(this).closest('tr');
                var id   = $(fila).data('id');
                var url  ='{{action('AeronaveController@edit', ["::"])}}';
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
            
            $('#save-aeronave-btn-modal').click(function(){

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


        /*  
            Guardar un nuevo registro
            */
            $('#save-aeronave-btn').click(function(){

                var data=$('#aeronave-form').serializeArray();
                
                var overlay=    "<div class='overlay'>\
                <i class='fa fa-refresh' fa-spin></i>\
                </div>";
                $('#aeronaveForm-div').append(overlay);

                $.ajax(
                    {data:data,
                        method:'post',
                        url:"{{action('AeronaveController@store')}}"}
                        )
                .always(function(response, status, responseObject){
                   $('#aeronaveForm-div .overlay').remove();
                    if(status=="error"){
                        if(response.status==422){
                            alertify.error(processValidation(response.responseJSON));
                        }
                    }else{

                        try{
                            var respuesta=JSON.parse(responseObject.responseText);
                            if(respuesta.success==1)
                            {
                                $('#aeronaveForm-div .no-vacio').val('');
                                $('#save-aeronave-btn').attr('disabled','disabled');
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