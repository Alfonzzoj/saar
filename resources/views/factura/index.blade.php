@extends('app')
@section('content')
<ol class="breadcrumb">
	<li><a href="{{url('principal')}}">Inicio</a></li>
	<li><a href="{{action('FacturaController@main', ["Todos"])}}">Facturación Principal</a></li>
	<li><a class="active">Facturación {{$modulo->nombre}}</a></li>
</ol>
<div class="row" id="box-wrapper">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Filtros</h3>
				<div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				</div>
			</div>
			<div class="box-body text-right"  id="container">
				{!! Form::open(["url" => action('FacturaController@index',["id"=>$modulo->nombre]), "method" => "GET", "class"=>"form-inline"]) !!}
				{!! Form::hidden('sortName', array_get( $input, 'sortName'), []) !!}
				{!! Form::hidden('sortType', array_get( $input, 'sortType'), []) !!}
				<div class="form-group">
					{{-- por los momentos lo colocare en id pero debe ser el numero de factura --}}
					{!! Form::hidden('nFacturaOperator', array_get( $input, 'nFacturaOperator'), ['id' => 'nFacturaOperator', 'class' => 'operator-input', 'autocomplete'=>'off']) !!}
					<div class="input-group">
						<div class="input-group-btn">
							<button style="max-height:37px" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="operator-text">=</span></button>
							<ul class="dropdown-menu operator-list">
								<li><a href="#">>=</a></li>
								<li><a href="#"><=</a></li>
								<li><a href="#">=</a></li>
							</ul>
						</div>
						{!! Form::text('nFactura', array_get( $input, 'nFactura'), [ 'class'=>"form-control", 'style' => 'padding-left:2px', 'placeholder'=>'Número factura', 'style'=>'max-width:112px']) !!}
					</div>
				</div>
				<div class="form-group">
					{{-- por los momentos lo colocare en id pero debe ser el numero de factura --}}
					{!! Form::hidden('nControlOperator', array_get( $input, 'nControlOperator'), ['id' => 'nControlOperator', 'class' => 'operator-input', 'autocomplete'=>'off']) !!}
					<div class="input-group">
						<div class="input-group-btn">
							<button style="max-height:37px" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="operator-text">=</span></button>
							<ul class="dropdown-menu operator-list">
								<li><a href="#">>=</a></li>
								<li><a href="#"><=</a></li>
								<li><a href="#">=</a></li>
							</ul>
						</div>
						{!! Form::text('nControl', array_get( $input, 'nControl'), [ 'class'=>"form-control", 'style' => 'padding-left:2px', 'placeholder'=>'Número de control', 'style'=>'max-width:112px']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::text('clienteNombre', array_get( $input, 'clienteNombre'), [ 'class'=>"form-control", 'placeholder'=>'Cliente', 'style'=>'max-width:100px']) !!}
				</div>
				<div class="form-group">
					{!! Form::text('descripcion', array_get( $input, 'descripcion'), [ 'class'=>"form-control", 'placeholder'=>'Descripción', 'style'=>'max-width:150px']) !!}
				</div>
				<div class="form-group">
					{!! Form::select('estado', ["%" => "-- Estado --","P" => "Pendiente","C" => "Pagada","A" => "Anulada"], array_get( $input, 'estado'), [ 'class'=>"form-control", 'style'=>'max-width:100px']) !!}
				</div>
				<div class="form-group">
					{!! Form::hidden('fechaOperator', array_get( $input, 'fechaOperator'), ['id' => 'fechaOperator', 'class' => 'operator-input', 'autocomplete'=>'off']) !!}
					<div class="input-group">
						<div class="input-group-btn">
							<button style="max-height:37px" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="operator-text">=</span></button>
							<ul class="dropdown-menu operator-list">
								<li><a href="#">>=</a></li>
								<li><a href="#"><=</a></li>
								<li><a href="#">=</a></li>
							</ul>
						</div>
						{!! Form::text('fecha', array_get( $input, 'fecha'), ['id'=>'f-datepicker', 'class'=>"form-control", 'placeholder'=>'Fecha de inicio', 'style' => 'padding-left:2px', 'placeholder'=> 'Fecha de emisión', 'style'=>'max-width:112px']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::hidden('totalOperator', array_get( $input, 'totalOperator'), ['id' => 'totalOperator', 'class' => 'operator-input', 'autocomplete'=>'off']) !!}
					<div class="input-group">
						<div class="input-group-btn">
							<button style="max-height:37px" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="operator-text">=</span></button>
							<ul class="dropdown-menu operator-list">
								<li><a href="#">>=</a></li>
								<li><a href="#"><=</a></li>
								<li><a href="#">=</a></li>
							</ul>
						</div>
						{!! Form::text('total', array_get( $input, 'total'), [ 'class'=>"form-control", 'style' => 'padding-left:2px', 'placeholder'=>'Total', 'style'=>'max-width:100px']) !!}
					</div>
				</div>
				<button type="submit" class="btn btn-default">Buscar</button>
				<a class="btn btn-default" href="{{action('FacturaController@index',[$modulo->nombre])}}">Reset</a>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<!-- general form elements -->
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Facturas de {{$modulo->nombre}}</h3>
				@if ($modulo->tieneContratosVigentes())
					<div class="box-tools pull-right">
						<a class="btn btn-primary btn-sm" href="{{ action('FacturaController@automatica',[$modulo->nombre]) }}">Generación automática de facturas</a>
					</div>
				@endif
			</div><!-- /.box-header -->
			<!-- form start -->

			<div class="box-body"  id="container">

				<div class="row">

					<div class="col-xs-12">

						<ul class="list-group">
							<li class="list-group-item" data-id="1">
								<div class="media">

									<div class="pull-right media-right">
										<span><a  class="btn btn-warning"  href="{{ action('FacturaController@facturaManual', $modulo->nombre) }}" >Crear factura Manual</a></span>
										<a  style="margin-left: 20px"  class="btn btn-primary"  href="{{ URL::to('facturacion/'.$modulo->nombre.'/factura/create') }}">&nbsp;<span class="glyphicon glyphicon-plus"></span>&nbsp;</a>
									</div>
									<div class="media-body">
										<h6 class="media-heading">Crear una nueva factura</h6>
									</div>

								</div>
							</li>
							<li class="list-group-item">
								<table class="table text-center">
									<thead class="bg-primary">
										{!!Html::sortableColumnTitle("# Factura", "nFactura")!!}
										{!!Html::sortableColumnTitle("# Control", "nControl")!!}
										{!!Html::sortableColumnTitle("Cliente", "clienteNombre")!!}
										{!!Html::sortableColumnTitle("Descripción", "descripcion")!!}
										<th>Estado</th>
										{!!Html::sortableColumnTitle("Fecha de Emisión", "fecha")!!}
										{!!Html::sortableColumnTitle("Total", "total")!!}
										<th>Acción</th>
									</thead>
									<tbody>
										@foreach($modulo->facturas as $factura)
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
													<a class='btn btn-warning' href='{{url('facturacion/'.$modulo->nombre.'/factura/'.$factura->id.'/edit')}}'><span class='glyphicon glyphicon-pencil' ></span></a>
													<button class='btn btn-danger eliminar-factura-btn' data-id="{{$factura->id}}"><span class='glyphicon glyphicon-remove'></span></button>
													<a target="_blank" class='btn btn-default' href='{{action('FacturaController@getPrint', [$modulo->nombre, $factura->id])}}'><span class='glyphicon glyphicon-print' ></span></a>
													@if($factura->deleted_at !=  null) <button class='btn btn-info resturar-factura-btn' data-id="{{$factura->id}}"><span class='glyphicon glyphicon-refresh'></span></button> @endif 
												</div>
											</td>
										</tr>
										@endforeach
									</tbody>


								</table>
								<div class="row">
									<div class="col-xs-12 text-center">
										{!! $modulo->facturas->appends(Input::except('page'))->render() !!}
									</div>
								</div>

							</li>

						</ul>

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

		$('#fvencimiento-datepicker, #f-datepicker').datepicker({
			closeText: 'Cerrar',
			prevText: '&#x3C;Ant',
			nextText: 'Sig&#x3E;',
			currentText: 'Hoy',
			monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
			'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
			monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
			'Jul','Ago','Sep','Oct','Nov','Dic'],
			dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
			dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
			dayNamesMin: ['D','L','M','M','J','V','S'],
			weekHeader: 'Sm',
			firstDay: 1,
			isRTL: false,
			showMonthAfterYear: false,
			yearSuffix: '',
			dateFormat: "dd/mm/yy"});

		$('.eliminar-factura-btn').click(function(){
			var tr=$(this).closest('tr');
			var id=$(this).data("id");
			var url="{{url('facturacion/'.$modulo->nombre.'/factura')}}/"+id;
			console.log("ID: " + id);
			console.log("URL: " + url);
			alertify.prompt('Ingrese motivo para confirmar anulación de factura', function(evt, value) {
							if(evt){

 				                    $.
				                    ajax({data: {comentario: value},
				                    	url: url, 
				                         method:"DELETE"})
				                    .done(function(response, status, responseObject){
				                    	console.log("AJAX PETICION");
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
								}else{
									alertify.error('Cancelado') ;
								}
							});
							


	    });

		$('.resturar-factura-btn').click(function(){
			var tr=$(this).closest('tr');
			var id=$(this).data("id");

			alertify.confirm("¿Realmente desea  restaurar este registro?", function (e) {
                if (e) {        
                	
		                $.
	                    ajax({
							data:{id:id},
							method:'get',
							url:"{{action('FacturaController@restore')}}"})
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
                	} 
          	  })

	    });
    })

</script>

@endsection