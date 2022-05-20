@extends('app')
@section('content')
<ol class="breadcrumb">
	<li><a href="{{url('principal')}}">Inicio</a></li>
	<li><a href="{{action('FacturaController@main', ["Todos"])}}">Facturación Principal</a></li>
	<li><a href="{{action('FacturaController@index', [$modulo->nombre])}}">Facturación {{$modulo->nombre}}</a></li>
	<li><a href="{{ action('FacturaController@automatica',[$modulo->nombre]) }}">Generación automática {{$modulo->nombre}}</a></li>
	<li><a class="active">Resultado generación automática</a></li>
</ol>
<div class="row" id="box-wrapper">
	<div class="col-md-12">
		<!-- general form elements -->
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Facturas creadas</h3>
			</div><!-- /.box-header -->
			<!-- form start -->

			<div class="box-body"  id="container">

				<div class="row">

					<div class="col-xs-12">
                        <table class="table text-center">
                            <thead class="bg-primary">
                                <th># Factura</th>
                                <th># Control</th>
                                <th>Cliente</th>
                                <th>Descripción</th>
                                <th>Estado</th>
                                <th>Fecha de Emisión</th>
                                <th class="text-right">Total</th>
                                <th>Acción</th>
                            </thead>
                            <tbody>
                                @foreach($facturas as $factura)
                                <tr>
                                    <td class='text-justify'>{{$factura->nFacturaPrefix}}-{{$factura->nFactura}}</td>
                                    <td class='text-justify'>{{$factura->nControlPrefix}}-{{$factura->nControl}}</td>
                                    <td style="text-align: left">{{$factura->cliente->nombre}}</td>
                                    <td style="text-align: left">{{$factura->descripcion}}</td>
                                    <td class='text-justify'>
                                        @if($factura->estado=='P')
                                            Pendiente
                                        @elseif($factura->estado=='C')
                                            Pagada
                                        @endif
                                    </td>
                                    <td class='text-justify'>{{$factura->fecha}}</td>
                                    <td style="text-align: right">{{$traductor->format($factura->total)}}</td>
                                    <td>
                                        <div class='btn-group  btn-group-sm' role='group' aria-label='...'>
                                            <button class='btn btn-primary' data-id="{{$factura->id}}" data-toggle="modal" data-target="#show-modal"><span class='glyphicon glyphicon-eye-open'></span></button>
                                            <a target="_blank" class='btn btn-warning' href='{{url('facturacion/'.$modulo->nombre.'/factura/'.$factura->id.'/edit')}}'><span class='glyphicon glyphicon-pencil' ></span></a>
                                            <button class='btn btn-danger eliminar-factura-btn' data-id="{{$factura->id}}"><span class='glyphicon glyphicon-remove'></span></button>
                                            <a target="_blank" class='btn btn-default' href='{{action('FacturaController@getPrint', [$modulo->nombre, $factura->id])}}'><span class='glyphicon glyphicon-print' ></span></a>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>


                        </table>
					</div>
				</div>

			</div><!-- /.box-body -->
			<div class="box-footer">

			</div>
		</div><!-- /.box -->
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="show-modal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Factura</h4>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

@endsection
@section('script')

<script>

	$(document).ready(function(){
		$('#show-modal').on('show.bs.modal', function (e) {
			var id=$(e.relatedTarget).data("id");
			$('#show-modal .modal-body').html("Cargando...")
			.load("{{url("facturacion/".urlencode ($modulo->nombre)."/factura")}}/"+id, function(){
				$('.modal-backdrop').css('height',"1000px")
			});
		})

		$('.eliminar-factura-btn').click(function(){
			var tr=$(this).closest('tr');
			var id=$(this).data("id");
			var url="{{url('facturacion/'.$modulo->nombre.'/factura')}}/"+id;
			$.
			ajax({url: url,
				method:"DELETE"})
			.done(function(response, status, responseObject){
				try{
					var obj= JSON.parse(responseObject.responseText);
					if(obj.success==1){
						$(tr).remove();
						alertify.success(obj.text);
					}else if(obj.success==0)
					    alertify.error(obj.text);
				}catch(e){
					console.log(e);
					alertify.error("Error en el servidor");
				}
			})

		})


	});


</script>

@endsection