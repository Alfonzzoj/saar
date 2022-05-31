@extends('app')
@section('content')
<ol class="breadcrumb">
	<li><a href="{{url('principal')}}">Inicio</a></li>
	<li><a href="{{action('FacturaController@main', ["Todos"])}}">Facturación Principal</a></li>
	<li><a href="{{action('FacturaController@index',["todos"])}}">Facturación Manual</a></li>
	<li><a class="active">Edición de factura</a></li>
</ol>
<div class="row" id="box-wrapper">
	<!-- left column -->
	<div class="col-md-12">
		<!-- general form elements -->
		{!! Form::model($factura, ["url" => action("FacturaController@update",['modulo'=>'todos', 'factura'=>$factura->id]), "method" => "PUT", "class" => "form-horizontal"]) !!}

		<div id="main-box" class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Editar Factura</h3>
			</div><!-- /.box-header -->
			<!-- form start -->

			<div class="box-body"  id="container">

				@include('factura.facturaManual.partials.form', ["disabled"=>""])

			</div><!-- /.box-body -->
			<div class="box-footer text-right">
				<button type="submit" class="btn btn-primary" id="save-btn">Guardar</button>
			</div>
		</div><!-- /.box -->
		{!!Form::close()!!}
	</div>
</div>

<div class="modal fade" id="advance-search-modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Busqueda avanzada de cliente</h4>
			</div>
			<div class="modal-body">


			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
@section('script')
<script>

	$(document).ready(function(){
        var $doctype = 0;
		@include('factura.partials.script')
		$('#save-btn').click(function(e){

			e.preventDefault();

			if($('#cliente-select').val()==0){
				alertify.error("Debe seleccionar un cliente");
				return;
			}
			if($('#concepto-table tbody tr').length==0){
				alertify.error("Debe seleccionar un concepto");
				return;
			}

			if(parseFloat($('#total-doc-input').val())<=0){
				alertify.error("El total no puede ser menor o igual a 0");
				return;
			}
			var form=$(this).closest('form');
			var data=$(form).serializeArray();
			console.log(data);

			addLoadingOverlay('#main-box');
			$.ajax({url:'{{action('FacturaController@update', ['modulo'=>'TODOS','factura'=>$factura->id])}}',
				method:'PUT',
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
									window.open(object.impresion, '_blank');
								}
								setTimeout(
									function()
									{
										location.replace("{{ URL::to('facturacion/Todos/main')}}");
									}, 2000);
							});
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