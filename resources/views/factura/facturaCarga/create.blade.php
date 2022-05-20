@extends('app')
@section('content')
<ol class="breadcrumb">
	<li><a href="{{url('principal')}}">Inicio</a></li>
	<li><a id="listado-cargas" href="{{action('CargaController@index')}}">Lista de Cargas</a></li>
	<li><a id="registro-cargas" class="active">Facturación de Cargas</a></li>
</ol>
<div class="row" id="box-wrapper">
	<!-- left column -->
	<div class="col-md-12">
		<!-- general form elements -->
		{!! Form::model($factura, ["url" => action('FacturaController@store'), "method" => "POST", "class" => "form-horizontal"]) !!}
		<div id="main-box" class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Creación de Factura</h3>
			</div><!-- /.box-header -->
			<!-- form start -->

			<div class="box-body"  id="container">

				@include('factura.partials.form', ["disabled"=>"", "bloqueoDosa"=>true, "facturaCarga"=>true, ])

			</div><!-- /.box-body -->
			<div class="box-footer text-right">
				<!-- <button type="submit" class="btn btn-success" id="preview-btn">Vista Previa</button> -->
				<button type="submit" class="btn btn-primary" id="save-btn">Guardar</button>
			</div>
		</div><!-- /.box -->
		{!!Form::close()!!}
	</div>
</div>

@endsection
@section('script')
<script>


$(document).ready(function(){

    var $doctype = 1;
	@include('factura.partials.script')
    $('[name="montoDes[]"]').first().trigger('focusout')
	$('#save-btn').click(function(e){

		e.preventDefault();

		if(parseFloat($('#total-doc-input').val())<=0){
			alertify.error("El total no puede ser menor o igual a cero");
			return;
		}

		var form=$(this).closest('form');
		var data=$(form).serializeArray();
		addLoadingOverlay('#main-box');
		$.ajax({url:'{{action('FacturaController@store')}}',
			method:'POST',
			data:data}).always(function(response, status, responseObject){
				if(status=="error"){
					if(response.status==422){
						alertify.error(processValidation(response.responseJSON));
						removeLoadingOverlay('#main-box');
					}
				}else
				try{
					var object=JSON.parse(responseObject.responseText);
					if(object.success==1){
						alertify.success("La factura se ha creado con éxito");
						alertify.confirm("Desea imprimir la factura?", function (e) {
						if (e) {
							alertify.log("Se emitió orden de impresión");
						}
						setTimeout(
							function()
							{
							    window.open(object.impresion, '_blank');
								location.replace("{{action('CargaController@index')}}");
							}, 2000);
						});
					}else{
						alertify.error(respuesta.text);
					}
				}catch(e){
					console.log(e);
					alertify.error("Error creando la factura");
					removeLoadingOverlay('#main-box');
				}
			})

		})
});


</script>

@endsection