@extends('app')
@section('content')

<ol class="breadcrumb">
	<li><a href="{{url('principal')}}">Inicio</a></li>
	<li><a href="{{ URL::to('cobranza/Todos/main') }}">Cobranza</a></li>
	<li><a class="active">Cobranza - {{$modulo->nombre}}</a></li>
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
				{!! Form::open(["url" => action('CobranzaController@index',[$modulo->nombre]), "method" => "GET", "class"=>"form-inline"]) !!}
				{!! Form::hidden('sortName', array_get( $input, 'sortName'), []) !!}
				{!! Form::hidden('sortType', array_get( $input, 'sortType'), []) !!}
				<div class="form-group">
					{{-- por los momentos lo colocare en id pero debe ser el numero de factura --}}
					{!! Form::hidden('cobroIdOperator', array_get( $input, 'cobroIdOperator'), ['id' => 'cobroIdOperator', 'class' => 'operator-input', 'autocomplete'=>'off']) !!}
					<div class="input-group">
						<div class="input-group-btn">
							<button style="max-height:37px" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="operator-text">=</span></button>
							<ul class="dropdown-menu operator-list">
								<li><a href="#">=</a></li>
								<li><a href="#">>=</a></li>
								<li><a href="#"><=</a></li>
							</ul>
						</div>
						{!! Form::text('id', array_get( $input, 'id'), [ 'class'=>"form-control", 'style' => 'padding-left:2px', 'placeholder'=>'Número Cobro', 'style'=>'max-width:112px']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::text('clienteNombre', array_get( $input, 'clienteNombre'), [ 'class'=>"form-control", 'placeholder'=>'Cliente', 'style'=>'max-width:100px']) !!}
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
					{!! Form::hidden('pagadoOperator', array_get( $input, 'pagadoOperator'), ['id' => 'pagadoOperator', 'class' => 'operator-input', 'autocomplete'=>'off']) !!}
					<div class="input-group">
						<div class="input-group-btn">
							<button style="max-height:37px" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="operator-text">=</span></button>
							<ul class="dropdown-menu operator-list">
								<li><a href="#">>=</a></li>
								<li><a href="#"><=</a></li>
								<li><a href="#">=</a></li>
							</ul>
						</div>
						{!! Form::text('pagado', array_get( $input, 'total'), [ 'class'=>"form-control", 'style' => 'padding-left:2px', 'placeholder'=>'Pagado', 'style'=>'max-width:100px']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::hidden('depositadoOperator', array_get( $input, 'depositadoOperator'), ['id' => 'depositadoOperator', 'class' => 'operator-input', 'autocomplete'=>'off']) !!}
					<div class="input-group">
						<div class="input-group-btn">
							<button style="max-height:37px" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="operator-text">=</span></button>
							<ul class="dropdown-menu operator-list">
								<li><a href="#">>=</a></li>
								<li><a href="#"><=</a></li>
								<li><a href="#">=</a></li>
							</ul>
						</div>
						{!! Form::text('depositado', array_get( $input, 'depositado'), [ 'class'=>"form-control", 'style' => 'padding-left:2px', 'placeholder'=>'Depositado', 'style'=>'max-width:100px']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::text('observacion', array_get( $input, 'observacion'), [ 'class'=>"form-control", 'placeholder'=>'Observación', 'style'=>'max-width:150px']) !!}
				</div>
				<button type="submit" id="buscar-btn" class="btn btn-primary">Buscar</button>
				<a class="btn btn-default" id="reset-btn"  href="{{action('CobranzaController@index',[$modulo->nombre])}}">Reset</a>
				{!! Form::close() !!}
			</div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Cobranza - {{$modulo->nombre}}</h3>
			</div>
			<div class="box-body"  id="container">
				<div class="row">
					<div class="col-xs-12">
						<ul class="list-group">
							<li class="list-group-item" data-id="1">
								<div class="media">
									<div class="pull-right media-right">
										<div class="btn-group-vertical  btn-group-xs" role="group" aria-label="...">
											<a class="btn btn-primary" href="{{action('CobranzaController@create', [$modulo->nombre]) }}">&nbsp;<span class="glyphicon glyphicon-plus"></span>&nbsp;</a>
										</div>
									</div>
									<div class="media-body">
										<h6 class="media-heading">Crear un nuevo cobro</h6>
									</div>
								</div>
							</li>
							<li class="list-group-item">
								<table class="table text-center">
									<thead class="bg-primary">
										<tr>
											{!!Html::sortableColumnTitle("Nro. Cobro", "id")!!}
											{!!Html::sortableColumnTitle("Nro. Recibo", "nRecibo")!!}
											{!!Html::sortableColumnTitle("Cliente", "clienteNombre")!!}
											{!!Html::sortableColumnTitle("Fecha", "fecha")!!}
											{!!Html::sortableColumnTitle("Monto pagado", "montofacturas")!!}
											{!!Html::sortableColumnTitle("Monto depositado", "montodepositado")!!}
											{!!Html::sortableColumnTitle("Observaciones", "observacion")!!}
											<th>Acción</th>
										</tr>
									</thead>
									<tbody>
							            @if($cobros->count()>0) 
											@foreach($cobros as $cobro)
											<tr  data-id="{{$cobro->id}}">
												<td class='text-justify'>{{$cobro->id}}</td>
												<td class='text-justify'>{{($cobro->nRecibo)?$cobro->nRecibo:'N/A'}}</td>
												<td style="text-align: left">{{$cobro->cliente->nombre}}</td>
												<td style="text-align: left">{{($cobro->fecha=='30/11/-0001')?$cobro->created_at:$cobro->fecha}}</td>
												<td style="text-align: right">{{$traductor->format($cobro->montofacturas)}}</td>
												<td style="text-align: right">{{$traductor->format($cobro->montodepositado)}}</td>
												<td class='text-justify'>{{$cobro->observacion}}</td>
												<td>
													<div class='btn-group  btn-group-sm' role='group' aria-label='...'>
														<a class='btn btn-primary' href='{{action('CobranzaController@show', [$modulo->nombre,$cobro->id])}}'><span class='glyphicon glyphicon-eye-open'></span></a>
														<a class='btn btn-warning' href='{{action('CobranzaController@edit', [$modulo->nombre,$cobro->id])}}'><span class='glyphicon glyphicon-pencil'></span></a>
														@if($cobro->fecha == '30/11/-0001')
															<a class='btn btn-info' id="fecha-btn" href='#'><span class='glyphicon glyphicon-calendar'></span></a>
														@endif
														@if($cobro->nRecibo != NULL)
														<div class="btn-group dropup">
															<a target="_blank" class='btn btn-default  btn-sm' href='{{action('CobranzaController@getPrint', ["cobro"=>$cobro->id, "modulo"=>$modulo->id])}}'><span class='glyphicon glyphicon-print'  ></span></a>
															<button type="button" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																<span class="caret"></span>
																<span class="sr-only">Toggle Dropdown</span>
															</button>
															<ul class="dropdown-menu">
																<li><a href="#" data-toggle="modal" data-id="{{$cobro->id}}" id="anularRecibo-btn">
																	  	Anular Recibo
																	</a>
																</li>
															</ul> 
														</div>
														@endif
														<button class='btn btn-danger delete-cobro-btn' data-id="{{$cobro->id}}"><span class='glyphicon glyphicon-remove'></span></button>
													</div>
												</td>
											</tr>
											@endforeach
										@else
							                <tr>
							                     <td colspan="8" class="text-center">No se consiguió ningún registro</td>
							                </tr>
										@endif
									</tbody>
								</table>
							</li>
							<div class="row">
							     <div class="col-xs-12 text-center">
							          {!! $cobros->appends(Input::except('page'))->render() !!}
							     </div>
							</div>
						</ul>
					</div>
				</div>
			</div>
			<div class="box-footer">
			</div>
		</div>
	</div>
	
	@if($cobros->count()>0) 
	    <div class="modal fade" id="show-modal" tabindex="-1" role="dialog" aria-labelledby="nvoRecibo-modalLabel" aria-hidden="true">
	        <div class="modal-dialog  modal-sm">
	            <div class="modal-content">
	                <div class="modal-header" id="titulo-div-modal">
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                    <h4 class="modal-title" id="titulo-modal">Recibo de Caja</h4>
	                </div>
	                <div class="modal-body">
		                <form>
							<div class="form-group">
								<label style="font-weight: bold;" >Inserte nuevo número de recibo de caja </label>
								<div class="input-group">
									<input type="hidden" id="cobro_id" name="cobro_id" value="{{($cobro->id)}}"/>
									<input type="text" id="nRecibo-input" name="nRecibo" class="form-control" placeholder="Número"/>
								</div><!-- /.input group -->
							</div> 
							<div class="form-group">
								<label style="font-weight: bold;" >Inserte motivo de anulación </label>
								<div class="input-group">
									<input type="text" id="comentario-input" name="comentario" class="form-control" placeholder="Comentario"/>
								</div><!-- /.input group -->
							</div>    
		                </form>
		            </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	                    <button id="save-nvoRecibo-btn-modal" type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button>
	                </div>
	            </div>
	        </div> <!-- /.Modal-dialog-->
	    </div> <!-- /.Modal- fade-->

	    <div class="modal fade" id="show-modal-fecha" tabindex="-1" role="dialog" aria-labelledby="fechaCobro-modalLabel" aria-hidden="true">
	        <div class="modal-dialog  modal-sm">
	            <div class="modal-content">
	                <div class="modal-header" id="titulo-div-modal">
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                    <h4 class="modal-title" id="titulo-modal">Fecha de Cobro</h4>
	                </div>
	                <div class="modal-body">
		                <form>
							<div class="form-group">
								<label style="font-weight: bold;" >Inserte fecha de cobro</label>
								<div class="input-group">
									<input type="hidden" id="cobro_id" name="cobro_id" value="{{($cobro->id)}}"/>
									<input type="text" id="fecha-input" name="fecha" class="form-control" placeholder="Ej. 01/03/2016" />
								</div><!-- /.input group -->
							</div>    
		                </form>
		            </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	                    <button id="save-fecha-btn-modal" type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button>
	                </div>
	            </div>
	        </div> <!-- /.Modal-dialog-->
	    </div> <!-- /.Modal- fade-->
	@endif

</div>





@endsection
@section('script')
<script>

	$(function(){

		$('.delete-cobro-btn').click(function(){
			var tr=$(this).closest('tr');
			var id=$(this).data("id");
			var url="{{url('cobranza/'.$modulo->nombre.'/cobro')}}/"+id;
			alertify.confirm("Desea eliminar el cobro seleccionado?", function (e) {
				if (e) {
					$.ajax({url: url,
						method:"DELETE"})
					.done(function(response, status, responseObject){
						try{
							var obj= JSON.parse(responseObject.responseText);
							if(obj.success==1){
								$(tr).remove();
								alertify.success(obj.text);
							}else{
								alertify.error(obj.text);
							}
						}catch(e){
							console.log(e);
							alertify.error("Error en el servidor");
						}
					})
				}
			});

		})

		$('body').delegate('#fecha-btn', 'click', function(){
                var fila = $(this).closest('tr');
                var id   = $(fila).data('id');
                $('#show-modal-fecha #cobro_id').val(id);
                $('#show-modal-fecha').modal('show');
            })

		$('body').delegate('#anularRecibo-btn', 'click', function(){
                var fila = $(this).closest('tr');
                var id   = $(fila).data('id');
                $('#show-modal #cobro_id').val(id);
                $('#show-modal').modal('show');
            })



	    /*
			Datepicker
			*/


	        //Datemask dd/mm/yyyy
	        $('#f-datepicker').inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});


			$('#f-datepicker').datepicker({
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
				dateFormat: 'yy-mm-dd'});

		$('#save-nvoRecibo-btn-modal').click(function(){
    		var data =$('#show-modal form').serializeArray()
    		var url  ='{{action('CobranzaController@cambiarRecibo')}}';
    	

    		$.ajax({data:data,
    			method:'get',
    			url:url})
    		.always(function(text, status, responseObject){
    			try
    			{
    				var respuesta = JSON.parse(responseObject.responseText);
    				if (respuesta.success==1)
    				{
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
    				alertify.error('Error procesando la información');
    			}
    		})

		})


		$('#save-fecha-btn-modal').click(function(){
    		var data =$('#show-modal-fecha form').serializeArray()
    		var url  ='{{action('CobranzaController@editDate')}}';
    	

    		$.ajax({data:data,
    			method:'get',
    			url:url})
    		.always(function(text, status, responseObject){
    			try
    			{
    				var respuesta = JSON.parse(responseObject.responseText);
    				if (respuesta.success==1)
    				{
    					alertify.success(respuesta.text);
                        $('#buscar-btn').trigger('click');
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
	})

</script>

@endsection