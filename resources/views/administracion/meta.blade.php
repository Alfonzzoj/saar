@extends('app')
@section('content')
<div class="row" id="">
	<div class="col-md-12">
		{!! Form::open(["id" => "newform", "url" => action("MetaController@store") , "method" => "POST"]) !!}
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title">Nueva Meta</h3>
			</div>
			<div class="box-body">
				<div class="form-group text-right">
						<input type="hidden" name="aeropuerto_id" value="{{session('aeropuerto')->id}}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<span class="pad"><b>Mes:</b></span>
						{!! Form::select('mes', ['1' => 'Enero','2' => 'Febrero','3' => 'Marzo','4' => 'Abril','5' => 'Mayo','6' => 'Junio','7' => 'Julio','8' => 'Agosto','9' => 'Septiembre','10' => 'Octubre','11' => 'Noviembre','12' => 'Diciembre'], $mes, ['id' => 'mes', 'style' => 'width: 100px;']) !!}			
	
						<span class="pad"><b>Año:</b></span>
							{!! Form::selectRange('anno', $minanno, $maxanno , $anno, ['class' => '', 'id' => 'anno','style' => 'width: 100px;']) !!}

						<span class="pad"><b>Meta Gobernación:</b></span>
						<input class="form-inline" autocomplete="off" id="gobernacion_meta" name="gobernacion_meta" type="text" value="0,00" placeholder="Meta Gobernación">
						
						<span class="pad"><b>Meta SAAR:</b></span>
						<input class="form-inline" autocomplete="off" id="saar_meta" name="saar_meta" type="text" value="0,00"  placeholder="Meta SAAR" >
			
						<button type="submit" class="btn btn-primary add-meta-btn" style="margin-left: 20px; margin-right: 30px;"><span class="glyphicon glyphicon-plus"></span></button>
				</div>
        	</div>
     	</div>
    	{!! Form::close() !!}
	</div>
	<div class="col-md-12">
		{!! Form::open(["url" => action("MetaController@update")]) !!}
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title">Metas - {{ $anno }}</h3>
				{!! Form::open(['url' => action("MetaController@index") , 'method' => 'GET']) !!}
					<div class="pull-right">
						<span class="pad"><b>Año:</b></span>
						{!! Form::selectRange('anno', $minanno, $maxanno , $anno, ['class' => '', 'id' => 'anno','style' => 'width: 100px;']) !!}
						<button id="fecha-filtrar" type="submit" class="btn btn-primary" style="margin-left: 20px; margin-right: 30px;">
							<i class="fa fa-filter"></i>
						</button>
					</div>
		    	{!! Form::close() !!}
			</div>
			<div class="box-body">
					<div class="form-group">
						<div class="text-center">
							<table class="table text-center" id="meta-table">
								<thead>
									<tr>
										<th>Mes</th>
                                        <th>Año</th>
										<th>Meta Gobernación</th>
										<th>Meta SAAR</th>
										<th>Acción</th>
									</tr>
								</thead>
								<tbody style="font-size: 17px;">
									@foreach($metas as $meta)
									<tr id="meta{{$meta->id}}">
	                                   <td>{{ $meses[$meta->mes] }}</td>
	                                   <td>{{ $meta->anno }}</td>
	                                   <td>{{ $traductor->format($meta->gobernacion_meta) }}</td>
	                                   <td>{{ $traductor->format($meta->saar_meta) }}</td>
	                                   <td>
	                                   		<button  type="button" class="btn btn-warning btn-edit" value="{{$meta->id}}" data-mes="{{ $meta->mes }}" data-anno="{{ $meta->anno }}" data-gob="{{ $meta->gobernacion_meta }}" data-saar="{{ $meta->saar_meta }}">
	                                            <span class="glyphicon glyphicon-pencil"></span>
	                                        </button>
	                                        <button type="button" class="btn btn-danger btn-delete" value="{{$meta->id}}">
	                                            <span class="glyphicon glyphicon-trash"></span>
	                                        </button>
	                                   </td>
	                               </tr>
                                   @endforeach
								</tbody>
							</table>
						</div>
					</div>
        	</div>
     	</div>
    	{!! Form::close() !!}
	</div>
</div>				

<!-- Modal -->
<div id="edit-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
      	<div class="form-group">
      		<div class="row">
      			<form id="edit-form-meta">
      			<input id="meta_id" class="hidden" type="number" name="meta_id">
      			<input id="meta_mes" class="hidden" type="number" name="mes">
	      		<input id="meta_anno" class="hidden" type="number" name="anno">
	      		<div class="col-sm-6 text-center">
	      			<label class="control-label" for="gobernacion_meta"><b>Meta Gobernación (Bs.)</b></label>
		        	<input id="gobernacion_meta" class="form-control text-center" type="text" name="gobernacion_meta">
		    	</div>
		    	<div class="col-sm-6 text-center">
		    		<label class="control-label" for="saar_meta"><b>Meta SAAR (Bs.)</b></label>
			        <input id="saar_meta" class="form-control text-center" type="text" name="saar_meta">
		        </div>
		    	</form>
	    	</div>
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


<script>

	$(document).ready(function(){
		var meses = ['Enero' , 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio' , 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
		$('.add-meta-btn').click(function(e){
			var formdata = $('#newform').serialize();
			console.log(formdata);
			e.preventDefault();
			$.ajax({
				type: 'POST',
				url: "{{ action('MetaController@store') }}",
				data: formdata,
				success: function(data){
					alertify.success("Meta agregada satisfactoriamente");

					var nueva_meta = "<tr id='meta" + data.id + "'>";
	                nueva_meta += "<td>" + meses[data.mes - 1] + "</td>";
	                 nueva_meta +=   "<td>" + data.anno + "</td>";
	                 nueva_meta +=   "<td>" + data.gobernacion_meta + "</td>";
	                 nueva_meta +=    "<td>" + data.saar_meta + "</td>";
	                 nueva_meta +=    "<td><button type='button' class='btn btn-warning btn-edit' value='" + data.id + "' data-mes='" + data.mes + "' data-anno='" + data.anno + "' data-gob='" + data.gobernacion_meta + "' data-saar='" + data.saar_meta + "'><span class='glyphicon glyphicon-pencil'></span></button>";
	                nueva_meta += "<button type='button' class='btn btn-danger btn-delete' value='" + data.id + "'><span class='glyphicon glyphicon-trash'></span></button></td></tr>";

					$("#meta-table tbody").append( nueva_meta);
				},
				error: function(data){
					alertify.error("Ocurrio un error agregando la meta");
				},
			});
		});

		$('#edit-modal .modal-footer').on('click','#modal-btn-save', function(e){
				e.preventDefault();
				var formdata = $('#edit-form-meta').serialize();
				$.ajax({
						type: 'PUT',
						url: "{{ action('MetaController@update') }}",
						data: formdata,
						success: function(data){
							$('#edit-modal').modal('hide');
							alertify.success("Meta actualizada satisfactoriamente");

							location.reload();
						},
						error: function(data){
							$('#edit-modal').modal('hide');
							alertify.error("Ocurrio un error actualizando la meta");
						},
					});
			});

		$('#meta-table').on('click', '.btn-delete', function(e){
			e.preventDefault();
			var id = $(this).val();
			alertify.confirm('¿Desea eliminar la meta?' , function(e){
				if(e){	
					$.ajax({
						type: 'DELETE',
						url: "{{ url('administracion/meta') }}/" + id,
						success: function(data){
							$("#meta" + id).remove();
							alertify.success('Meta eliminada satisfactoriamente');
						},
						error: function(data){
							alertify.error('Ocurrio un error eliminando la meta');
						},
					});
				}
			});	
		});

		$('#meta-table').on('click', '.btn-edit', function(e){
			e.preventDefault();
			var id = $(this).val();
			var mes = $(this).data('mes');
			var anno = $(this).data('anno');
			var gob = $(this).data('gob');
			var saar = $(this).data('saar');
			$('#edit-modal .modal-content .modal-header .modal-title').text("Meta - " + meses[mes - 1] + " - " + anno);
			$('#edit-modal .modal-content .modal-body #meta_id').val(id);
			$('#edit-modal .modal-content .modal-body #gobernacion_meta').val(gob);
			$('#edit-modal .modal-content .modal-body #saar_meta').val(saar);
			$('#edit-modal .modal-content .modal-body #meta_mes').val(mes);
			$('#edit-modal .modal-content .modal-body #meta_anno').val(anno);
			$('#edit-modal').modal('show');
		});

	});


</script>

@endsection