@extends('app')
@section('content')

<form id="despegue-form">
	<div class="form-group" style="width:180px">
		<div class="input-group">
			<div class="input-group-addon">
				<i class="fa fa-plane"></i>
			</div>
			@if($procedencia == 1)                    
				<input name="procedencia" id="procedencia" type="text" class="form-control no-vacio" value="1" placeholder="PROCEDENCIA" />
			@else
				<input name="procedencia" id="procedencia" type="text" class="form-control no-vacio" value="2" placeholder="PROCEDENCIA" />
			@endif
		</div><!-- /.input group -->
	</div>  

	<div class="form-group" style="width:180px">
		<div class="input-group">
			<div class="input-group-addon">
				<i class="fa fa-plane"></i>
			</div>                                        
			<input name="peso" id="peso" type="text" class="form-control no-vacio" value="{{$peso}}" placeholder="PESO" />
		</div><!-- /.input group -->
	</div>

	<div class="form-group" style="width:180px">
		<div class="input-group">
			<div class="input-group-addon">
				<i class="fa fa-plane"></i>
			</div>
			@if($nacionalidad == 1)                    
				<input name="nacionalidad" id="nacionalidad" type="text" class="form-control no-vacio" value="1" placeholder="NACIONALIDAD" />
			@else
				<input name="nacionalidad" id="nacionalidad" type="text" class="form-control no-vacio" value="2" placeholder="NACIONALIDAD" />
			@endif
		</div><!-- /.input group -->
	</div>  

	<div class="form-group" >
		<div class="input-group" >
			<div class="input-group-addon">
				<i class="fa fa-paper-plane"></i>
			</div>
			<select name="tipoMatricula_id" id="tipoMatricula" class="form-control tipo_vuelo no-vacio">
				@foreach ($tipoMatriculas as $tipoMatricula)
					<option value="{{$tipoMatricula->id}}"> {{$tipoMatricula->nombre}}</option>
				@endforeach
			</select>									
		</div><!-- /input group -->
	</div>
							 
	<!-- Condición de Pago -->
	<div class="form-group">
		<label><strong>Condición de pago: </strong></label>
		<div class="input-group">
			<select id="condicionPago" name="condicionPago" id="condicionPago-select" class="form-control">
				<option value="Contado"> Contado</option>
				<option value="Crédito"> Crédito</option>	
			</select>                
		</div><!-- /.input group -->
	</div><!-- /.form group -->							
								
	<div class="form-group" style="margin-left: 20px">
		{!! Form::select('otrosCargo_id[]', $otrosCargos, null, [ 'class'=>"form-control chosen-select", "multiple"=>"true",  "autocomplete"=>"off", 'id'=>"otros_cargos-select"]) !!}
	</div><!-- /.form group -->
</form>							
@endsection

@section('script')
<script>

	function filtro(){
		var data=$('#despegue-form').serializeArray();
		$.ajax({
			data:data,
			method:'get',
			url:"{{action('TestingController@filtro')}}"
		}).success(function(data) {
			console.log(data);
			cambiar_valores_otros_cargos(data);
		});
	}

	function cambiar_valores_otros_cargos(data){

		var cargos = $("#otros_cargos-select");
		cargos.empty(); // borrar opciones viejas.


		$.each(data, function(value,key) { 
		  cargos.append($("<option></option>")
		     .attr("value", value).text(key));
		});

		cargos.val('').trigger('chosen:updated');
	}

$(document).ready(function(){
	filtro();

	$( "#condicionPago").change(function() {
		filtro();
	});

	$( "#tipoMatricula").change(function() {
		filtro();
	});
	
	$('#otros_cargos-select').chosen({width:'450px'});

});
</script>

@endsection
