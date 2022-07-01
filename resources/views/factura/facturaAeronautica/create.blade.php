@extends('app')
@section('content')
<ol class="breadcrumb">
	<li><a href="{{url('principal')}}">Inicio</a></li>
	<li><a id="listado-despegues" href="{{action('DespegueController@index')}}">Lista de Despegues</a></li>
	<li><a id="registro-despegues" class="active">Creación de Dosa</a></li>
</ol>
<div class="row" id="box-wrapper">
	<!-- left column -->
	<div class="col-md-12">
		<!-- general form elements -->
		{!! Form::model($factura, ["url" => action('FacturaController@store'), "method" => "POST", "class" => "form-horizontal"]) !!}
		<div id="main-box" class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Creación Dosa</h3>
			</div><!-- /.box-header -->
			<!-- form start -->

			<div class="box-body"  id="container">
				@include('factura.partials.form', ["disabled"=>"", "bloqueoDosa"=>true])

			</div><!-- /.box-body -->
			<div class="box-footer text-right">
			    {{--

			     Te comente esta linea porque la funcion de print debe recibir un id de factura valido para mostrar el contenido,

			     Lo que pudieras hacer es hacer otro metodo y que no busque la facturea en la bd sino que construya el pdf

			     en base a lo que se le paso del formulario

			    --}}
				{{--<a target="_blank" class='btn btn-success' href='{{action('FacturaController@getPrint', ["modulo"=>"DOSAS", $factura->id])}}'>--}}
		               {{--Vista Previa--}}
		        {{--</a>--}}
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
							window.open(object.impresion, '_blank');
							alertify.log("Se emitió orden de impresión");
						}
						setTimeout(
							function()
							{
								location.replace("{{action('DespegueController@index')}}");
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