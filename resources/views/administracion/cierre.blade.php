@extends('app')
@section('content')

<div class="row" id="box-wrapper">
	<div class="col-md-12">
		{!! Form::open(["url" => action("MetaController@update")]) !!}
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Metas</h3>
			</div>
			<div class="box-body">
				<div role="tabpanel">

					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
<!--                         <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Aeropuerto</a></li>
                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Tasas</a></li>
                        <li role="presentation"><a href="#estacionamiento" aria-controls="profile" role="tab" data-toggle="tab">Estacionamiento</a></li> -->
                        <li role="presentation"><a href="#metas" aria-controls="profile" role="tab" data-toggle="tab">Metas</a></li>
                    </ul>
                    

                    <div role="tabpanel" class="tab-pane active" id="metas">
                    	<div class="row">
                    		<div class="col-md-12">
                    			<h3>Metas</h3>
                    			<div role="tabpanel" id="meta-tabs">

                    				<!-- Nav tabs -->
                    				<ul class="nav nav-tabs margin-bottom" role="tablist">
                    					<li role="presentation" class="active"><a href="#new-meta-tab" aria-controls="new-meta-tab" role="tab" data-toggle="tab"><span class="text-primary glyphicon glyphicon-plus"></span></a></li>

                    					@foreach($metas as $meta)
                    					<li role="presentation"><a href="#meta-{{$meta->id}}-tab" aria-controls="meta-{{$meta->id}}-tab" role="tab" data-toggle="tab">{{$meta->fecha_inicio}}</a></li>
                    					@endforeach
                    				</ul>

                    				<!-- Tab panes -->
                    				<div class="tab-content">
                    					<div role="tabpanel" class="tab-pane active" id="new-meta-tab">
                    						<div class="form-horizontal">
                    							<div class="form-group">
                    								<label for="fecha-inicio-input" class="col-xs-2 control-label" >Fecha inicio</label>
                    								<div class="col-xs-4">
                    									<input autocomplete="off" value="{{\Carbon\Carbon::now()->format("d/m/Y")}}" class="form-control" id="fecha-inicio-datepicker" name="metaFechaInicio">
                    								</div>
                    							</div>
                    							<div class="form-group">
                    								<div class="col-xs-4">
                    									<select id="concepto-meta-select">
                    										@foreach($conceptos as $pkey => $concepto)
                    										<option value="{{$pkey}}">{{$concepto}}</option>
                    										@endforeach
                    									</select>
                    								</div>
                    								<div class="col-xs-3">
                    									<input class="form-control text-right" autocomplete="off" id="monto-meta-gobernacion-input"  type="text" value="0,00" placeholder="Meta Gobernación">
                    								</div>
                    								<div class="col-xs-3">
                    									<input class="form-control text-right" autocomplete="off" id="monto-meta-saar-input"  type="text" value="0,00"  placeholder="Meta SAAR">
                    								</div>
                    								<div class="col-xs-1">
                    									<button type="button" class="btn btn-primary add-concepto-meta-btn"><span class="glyphicon glyphicon-plus"></span></button>
                    								</div>
                    							</div>
                    							<div class="form-group">
                    								<div class="col-xs-12">
                    									<table class="table" id="new-meta-table">
                    										<thead>
                    											<tr>
                    												<th style="width:400px">Concepto</th>
                    												<th>Meta Gobernación</th>
                    												<th>Meta SAAR</th>
                    												<th>Acción</th>
                    											</tr>
                    										</thead>
                    										<tbody>

                    										</tbody>
                    									</table>

                    									<label for="meta-gob" class="col-sm-4 control-label"><h6>TOTALES:</h6></label>
                    									<div class="form-inline">
                    										<div class="form-group pull-right col-sm-5" style="margin-left: 30px">
                    											<div class="col-sm-6">
                    												<input autocomplete="off" type="text" class="form-control meta-saar text-right col-sm-6" style="font-weight: bold;" readonly value="0,00">
                    											</div>
                    										</div>
                    										<div class="form-group pull-right" style="margin-left: 40px">
                    											<div class="col-sm-6" >
                    												<input autocomplete="off" type="text"  class="form-control meta-gobernacion text-right col-sm-6" style="font-weight: bold;" readonly value="0,00">
                    											</div>
                    										</div>
                    									</div>
                    								</div>
                    							</div>
                    						</div>

                    					</div>
                    					@foreach($metas as $meta)
                    					<div role="tabpanel" class="tab-pane" id="meta-{{$meta->id}}-tab">
                    						<div class="form-horizontal">
                    							<div class="form-group">
                    								<label for="fecha-inicio-input" class="col-xs-2 control-label" >Fecha Inicio</label>
                    								<div class="col-xs-4">
                    									<p class="form-control-static">{{$meta->fecha_inicio}}</p>
                    								</div>
                    								<label for="fecha-inicio-input" class="col-xs-2 control-label" >Fecha Fin</label>
                    								<div class="col-xs-4">
                    									<p class="form-control-static">{{$meta->fecha_fin}}</p>
                    								</div>
                    							</div>
                    							<div class="form-group">
                    								<div class="col-xs-12">
                    									<table class="table" id="new-{{$meta->id}}-table">
                    										<thead>
                    											<tr>
                    												<th>Concepto</th>
                    												<th>Meta Gobernación</th>
                    												<th>Meta SAAR</th>
                    											</tr>
                    										</thead>
                    										<tbody>
                    											@foreach($meta->detalles as $detalle)
                    											<tr>
                    												<td>{{$detalle->concepto->nompre}}</td>
                    												<td class="metaGobernacion">{{$traductor->format($detalle->gobernacion_meta)}}</td>
                    												<td class="metaSaar">{{$traductor->format($detalle->saar_meta)}}</td>
                    											</tr>
                    											@endforeach
                                                                           <tr>
                                                                                <td>TOTAL</td>
                                                                                <td id="metaGobernacion">{{$traductor->format($metaGobernacion)}}</td>
                                                                                <td id="metaSaar">{{$traductor->format($metaSaar)}}</td>
                                                                           </tr>
                    										</tbody>
                    									</table>
                    								</div>
                    							</div>
                    						</div>
                    					</div>
                    					@endforeach

                    				</div>
                    			</div>
                    		</div>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
        	<button  type="submit" class="btn btn-primary pull-right" id="save-info-btn">Aceptar</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>
</div>


@endsection
@section('script')


<script>


	function calculateTotalMetas(){
		var totalGob  =0;
		var trsGob    =$('#new-meta-table tbody tr td').find('.montoGobernacion');
		var totalSaar =0;
		var trsSaar   =$('#new-meta-table tbody tr td').find('.montoSaar');
		$.each(trsGob, function(index,value){
			console.log(value);
			totalGob+=commaToNum($(value).val());
		});
		$.each(trsSaar, function(index,value){
			console.log(value);
			totalSaar+=commaToNum($(value).val());
		});
		$('.meta-gobernacion').val(numToComma(totalGob));
		$('.meta-saar').val(numToComma(totalSaar));


	}


	$(document).ready(function(){

		$('#fecha-inicio-datepicker').datepicker({
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

		$('#tarjeta_costo').focusout(function(){
			$(this).val(numToComma($(this).val()))
		})


		$('#new-meta-tab').delegate('.add-concepto-meta-btn','click',function(){


			var concepto=$('#concepto-meta-select').val();
			if(concepto==""){
				alertify.error("Debe seleccionar un concepto.");
				return;
			}
			if($('input[name="conceptoMeta[]"][value="'+concepto+'"]').length>0){
				alertify.error("El concepto seleccionado ya existe en la tabla.");
				return;
			}
			var conceptoText     =$('#concepto-meta-select option:selected').text();
			var montoSaar        =$('#monto-meta-saar-input').val();
			var montoGobernacion =$('#monto-meta-gobernacion-input').val();
			$('#new-meta-table tbody').prepend(
				'<tr><td>'+conceptoText+'<input type="hidden" value="'+
				concepto
				+'"name="conceptoMeta[]" ></td><td> <input class="form-control text-right montoGobernacion" value="'+
				numToComma(montoGobernacion)
				+'" id="montoGob" name="montoGobernacion[]"></td><td><input class="form-control text-right montoSaar" value="'+
				numToComma(montoSaar)
				+'" id="montoSaar" name="montoSaar[]"></td><td><button class="btn btn-danger remove-meta-btn" type="button"><span class="glyphicon glyphicon-minus"></span> </td></tr>')

			$('#monto-meta-saar-input').val('');
			$('#monto-meta-gobernacion-input').val('');
			var total=calculateTotalMetas();

		})

		$('#concepto-meta-select').chosen({width:"350px"})

		$('#add-concepto-btn').click(function(){
			var value=$('#concepto-input').val();
			if(value=="")
				return;
			var index= $('#concepto-table tbody tr').length;
			$('#concepto-table tbody').append("<tr>\
				<td><input class='form-control' value='"+value+"' name='conceptosNuevos["+index+"][nombre]'></td>\
				<td><input type='text' class='form-control' value='0' name='conceptosNuevos["+index+"][costo]'></td>\
				<td><button class='btn btn-danger remove-concepto-btn'><span class='glyphicon glyphicon-minus'></span></button></td>\
			</tr>");
		});

		$('body').delegate('.remove-concepto-btn, .remove-porton-btn, .remove-meta-btn','click',function(){
			$(this).closest('tr').remove();
		});

		$('#add-porton-btn').click(function(){
			var value=$('#porton-input').val();
			if(value=="")
				return;
			$('#porton-table tbody').append("<tr>\
				<td><input type='text' class='form-control' value='"+value+"' name='portonesNuevos[][nombre]'></td>\
				<td><button type='button' class='btn btn-danger remove-porton-btn'><span class='glyphicon glyphicon-minus'></span></button></td>\
			</tr>");
		});


	});


</script>

@endsection