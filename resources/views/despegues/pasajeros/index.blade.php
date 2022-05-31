@extends('app')
@section('content')
<div class="row">
<section class="col-lg-12">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				<i class="fa fa-users"></i> Pasajeros 
			</h1>
		</section>
		<section class="content">
			<div class="box box-info">
				<div class="box-header with-border">
						<h3 class="box-title" style="width: 100%;"><i class="fa fa-road"></i> Despegue <a class="btn btn-default btn-sm pull-right" href="{{ route('pasajeros.print', $despegue->id) }}" target="_blank"><span class="glyphicon glyphicon-print"></span> Exportar </a></h3>
		
						<input id="despegue" class="hidden" type="text" value="{{ $despegue->id }}">
				</div><!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">     
					    <table id="despegue-table" class="table no-margin">
					       	<thead class="bg-primary">          
				               	<tr>
				                    <th colspan="4" style="vertical-align: middle" class="text-center">DESPEGUE</th>
				                    <th colspan="4" style="vertical-align: middle" class="text-center">ATERRIZAJE</th>
				                    <th colspan="3" style="vertical-align: middle" class="text-center">GENERAL</th>
				               	</tr>
				               	<tr>
				                	<th>Fecha</th>
				                    <th>Puerto</th>
				                    <th>Vuelo</th>
				                    <th>Piloto</th>
				                    <th>Fecha</th>                  
				                    <th>Puerto</th>                  
				                    <th>Vuelo</th>    
				                    <th>Piloto</th>    
				                    <th>Matrícula</th>
				                    <th>Cliente</th>
				               	</tr>
					        </thead>
					        <tbody>
					            <tr data-id='{{$despegue->id}}' data-aterrizaje='{{$despegue->aterrizaje_id}}'>
					                <td class ='horaFecha-td'>{{$despegue->fecha}} {{$despegue->hora}}</td>
					                <td class ='puerto_id-td'>{{(($despegue->puerto)?$despegue->puerto->siglas:"No disponible")}}</td>
					                <td class ='num_vuelo-td'>{{(($despegue->num_vuelo)?$despegue->num_vuelo:"N/A")}}</td>
					                <td class ='piloto_id-td'>{{(($despegue->piloto)?$despegue->piloto->nombre:"N/A")}}</td>                    
					                <td class ='horaFecha-td'>{{$despegue->aterrizaje->fecha}} {{$despegue->aterrizaje->hora}}</td>
					                <td class ='puerto_id-td'>{{(($despegue->aterrizaje->puerto)?$despegue->aterrizaje->puerto->siglas:"No disponible")}}</td>
					                <td class ='num_vuelo-td'>{{(($despegue->aterrizaje->num_vuelo)?$despegue->aterrizaje->num_vuelo:"N/A")}}</td>
					                <td class ='piloto_id-td'>{{(($despegue->aterrizaje->piloto)?$despegue->aterrizaje->piloto->nombre:"N/A")}}</td>      
					                <td class ='matricula-td'>{{$despegue->aterrizaje->aeronave->matricula}}</td>
					                <td class ='cliente_id-td'>{{(($despegue->cliente)?$despegue->cliente->nombre:"No asignado")}}</td> 
					            </tr>   
					        </tbody>
					    </table>
					</div><!-- /.table-responsive -->
				</div>
			</div>
			<div class="box box-info">
				<div class="box-header with-border">
					<h3 class="box-title" style="width: 100%;"><i class="fa fa-users"></i> Pasajeros <b class="pull-right"><span id="pasajeros-registrados">{{ $despegue->pasajero->count() }}</span> / {{ $despegue->embarqueAdultos + 	$despegue->embarqueInfante + $despegue->embarqueTercera }} Registrados</b>
						<input id="pasajeros-registrados-input" type="number" class="hidden" value="{{ $despegue->pasajero->count() }}"></input>
						<input id="pasajeros-maximos-input" type="number" class="hidden" value="{{ $despegue->embarqueAdultos + $despegue->embarqueInfante + $despegue->embarqueTercera }}"></input>
					</h3>
				</div>
				<div class="box-body">
					<div class="table-responsive">
						<table id="pasajeros-table" class="table">
							<thead>
								<tr>
									<th>Cédula y/o Pasaporte</th>
									<th>Nombre</th>
									<th>Apellido</th>
									<th>Nacionalidad</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<form id="form-pasajero">
									<input class="hidden" type="text" name="despegue" value="{{ $despegue->id }}">
									<td><input type="number" name="cedula" min="0"></td>
									<td><input type="text" name="nombre"></td>
									<td><input type="text" name="apellido"></td>
									<td>
										<div class="radio">
										  	<label>
										    	<input checked type="radio" name="nacionalidad" value="Residente">Residente
										  	</label>
										  	<label>
										    	<input type="radio" name="nacionalidad" value="">Otro
										    	<input id="input-otro" type="text" disabled name="nacionalidad">
										  	</label>
										</div>
										
									</td>
									<td>
										<button type="submit" id="añadir-pasajero" class=" btn btn-primary"><span class='glyphicon glyphicon-plus' title='Añadir Registro'></span></button>
									</td>
									</form>
								</tr>
								@foreach($pasajeros as $pasajero)
								<tr id="pasajero{{ $pasajero->id }}">
										<td>{{ ($pasajero->cedula) == 0 ?'':$pasajero->cedula }}</td>
										<td>{{ $pasajero->nombre }}</td>
										<td>{{ $pasajero->apellido }}</td>
										<td>{{ $pasajero->nacionalidad }}</td>
										<td>
											<button class="editar-pasajero btn btn-warning" value="{{$pasajero->id}}" data-cedula="{{ $pasajero->cedula }}" data-nombre="{{ $pasajero->nombre }}" data-apellido="{{ $pasajero->apellido }}" data-nacionalidad="{{ $pasajero->nacionalidad }}"><span class='glyphicon glyphicon-pencil' title='Editar Registro'></span></button>
											<button class="eliminar-pasajero btn btn-danger" value="{{ $pasajero->id }}"><span class='glyphicon glyphicon-trash' title='Eliminar Registro'></span></button>
										</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				<div class="box-footer">
					<div class="container-fluid">
					<a class="btn btn-success align-middle" style="margin-left: 50%;" href="{{action('DespegueController@index')}}"><i class="fa fa-check"></i> Aceptar</a>
					</div>
				</div>
			</div>
		</section>
</section>
</div>
<!-- Modal -->
<div id="edit-modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
	      		<div class="table-responsive">
					<table id="edit-pasajeros-table" class="table pad">
						<thead>
							<tr>
								<th>Cédula y/o Pasaporte</th>
								<th>Nombre</th>
								<th>Apellido</th>
								<th>Nacionalidad</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<form id="edit-form-pasajero">
								<input id="pasajero_id" class="hidden" type="text" name="pasajero_id">	
								<td><input id="pasajero_cedula" type="number" name="cedula" min="0"></td>
								<td><input id="pasajero_nombre" type="text" name="nombre"></td>
								<td><input id="pasajero_apellido" type="text" name="apellido"></td>
								<td>
									<div class="radio">
									  	<label>
									    	<input checked type="radio" name="nacionalidad" value="Residente">Residente
									  	</label>
									  	<label>
									    	<input id="pasajero-radio-otro" type="radio" name="nacionalidad" value="">Otro
									    	<input id="pasajero-input-otro" type="text" disabled name="nacionalidad">
									  	</label>
									</div>								
								</td>
								</form>
							</tr>
						</tbody>
					</table>
				</div>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button id="modal-btn-save" type="button" class="btn btn-primary">Guardar Cambios</button>
      </div>
    </div>
  </div>
@endsection
@section('script')
	<script type="text/javascript">
		$(document).ready(function(){

			$('#pasajeros-table').on('click', '.editar-pasajero', function(e){
				e.preventDefault();
				var id = $(this).val();
				var cedula = $(this).data('cedula');
				var nombre = $(this).data('nombre');
				var apellido = $(this).data('apellido');
				var nacionalidad = $(this).data('nacionalidad');
				$('#edit-modal .modal-content .modal-header .modal-title').text("Pasajero - " + nombre + ' ' + apellido);
				$('#edit-modal .modal-content .modal-body #pasajero_id').val(id);
				$('#edit-modal .modal-content .modal-body #pasajero_cedula').val(cedula);
				$('#edit-modal .modal-content .modal-body #pasajero_nombre').val(nombre);
				$('#edit-modal .modal-content .modal-body #pasajero_apellido').val(apellido);
		
				if(nacionalidad != 'Residente'){
					$("#pasajero-radio-otro").attr('checked', 'checked');
					$('#pasajero-input-otro').prop('placeholder', 'Indique nacionalidad');
					$('#pasajero-input-otro').prop('disabled', false);
					$('#pasajero-input-otro').val(nacionalidad);
				}
				else{
					$('#pasajero-input-otro').prop('placeholder', '');
					$('#pasajero-input-otro').prop('disabled', true);
				}
				$('#edit-modal').modal('show');
			});

			$('#edit-modal .modal-footer').on('click','#modal-btn-save', function(e){
				e.preventDefault();
				var formdata = $('#edit-form-pasajero').serialize();
				$.ajax({
						type: 'PUT',
						url: "{{ action('DespegueController@updatePasajeros') }}",
						data: formdata,
						success: function(data){
							$('#edit-modal').modal('hide');
							alertify.success("Pasajero actualizado satisfactoriamente");

							location.reload();
						},
						error: function(data){
							$('#edit-modal').modal('hide');
							alertify.error("Ocurrio un error actualizando al pasajero");
						},
					});
			});


			$("#pasajeros-table input[name = 'nacionalidad']").on('change', function(){
				if($(this).val() != 'Residente'){
					$('#input-otro').prop('disabled', false);
					$('#input-otro').prop('placeholder', 'Indique nacionalidad');
				}else{
					$('#input-otro').val('');
					$('#input-otro').prop('placeholder', '');
					$('#input-otro').prop('disabled', true);
				}
			});

			$("#edit-modal .modal-body input[name = 'nacionalidad']").on('change', function(){
				if($(this).val() != 'Residente'){
					$('#pasajero-input-otro').prop('disabled', false);
					$('#pasajero-input-otro').prop('placeholder', 'Indique nacionalidad');
				}else{
					$('#pasajero-input-otro').val('');
					$('#pasajero-input-otro').prop('placeholder', '');
					$('#pasajero-input-otro').prop('disabled', true);
				}
			});


			
			$('#añadir-pasajero').click(function(e){
				e.preventDefault();
				if($('#pasajeros-registrados-input').val() < $('#pasajeros-maximos-input').val())
				{
		            $.ajax({
						type: 'POST',
						url: "{{ action('DespegueController@addPasajeros') }}",
						data: $('#form-pasajero').serialize(),
						success: function(data){
							alertify.success("Pasajero agregado satisfactoriamente");
							console.log(data);
							var nuevo_pasajero = "<tr id='pasajero" + data.id + "'>";
							nuevo_pasajero += "<td>" + data.cedula + "</td>";
							nuevo_pasajero += "<td>" + data.nombre + "</td>";
							nuevo_pasajero += "<td>" + data.apellido + "</td>";
							nuevo_pasajero += "<td>" + data.nacionalidad + "</td><td>";
							nuevo_pasajero += "<button class='editar-pasajero btn btn-warning' value='" + data.id + "' data-cedula='" + data.cedula + "' data-nombre='" + data.nombre + "' data-apellido='" + data.apellido + "' data-nacionalidad='" + data.nacionalidad + "'><span class='glyphicon glyphicon-pencil' title='Editar Registro'></span></button>";
							nuevo_pasajero += "<button class='eliminar-pasajero btn btn-danger' value='" + data.id + "'><span class='glyphicon glyphicon-trash' title='Eliminar Registro'></span></button></td></tr>";

							$("#pasajeros-table tbody").append(nuevo_pasajero);

							$('#form-pasajero')[0].reset();
							$('#input-otro').val('');
							$('#input-otro').prop('placeholder', '');
							$('#input-otro').prop('disabled', true);
							//$('#form-pasajero #input-despegue').val($('#despegue').val());

							$('#pasajeros-registrados-input').val(parseInt($('#pasajeros-registrados-input').val()) + 1);
							$('#pasajeros-registrados').text($('#pasajeros-registrados-input').val());

						},
						error: function(data){
							alertify.error("Ocurrio un error agregando al pasajero");
						},
					});	
		        }else{
		        	alertify.error("Limite de pasajeros alcanzado");
		        }
			});
				

			$('#pasajeros-table').on('click', '.eliminar-pasajero', function(e){
				e.preventDefault();
				var pasajero = '#pasajero' + $(this).val();
				var id = $(this).val();
				alertify.confirm("¿Realmente desea eliminar este registro?", function (e) {
	                if (e) {        
						$.ajax({
							type: 'DELETE',
							url: "{{ action('DespegueController@removePasajeros') }}",
							data: {'pasajero': id},
							success: function(data){
								alertify.success("Pasajero eliminado satisfactoriamente");

								$(pasajero).remove();
								$('#pasajeros-registrados-input').val($('#pasajeros-registrados-input').val() - 1);
								$('#pasajeros-registrados').text($('#pasajeros-registrados-input').val());
							},
							error: function(data){
								alertify.error("Ocurrio un error eliminando al pasajero");
							},
						});
	                } 
	            })
			});
		});
	</script>
@endsection