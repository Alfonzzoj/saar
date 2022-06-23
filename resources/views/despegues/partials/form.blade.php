<h5><i align="center" class="fa fa-plane"></i>Información de Despegue</h5>

<div class="form-group" >
	<label for="fecha" class="col-sm-2 control-label" >Fecha</label>
	<div class="col-sm-10">
		{!! Form::text('fecha', null, ['class'=>"form-control fecha",  "placeholder"=>"Fecha", "id"=>"fecha-datepicker-modal"]) !!}
	</div>
</div>
<div class="form-group" >
	<label for="hora" class="col-sm-2 control-label" >Hora</label>
	<div class="col-sm-10">
		{!! Form::text('hora', null, [ 'class'=>"form-control hora", "placeholder"=>"Hora"]) !!}
	</div>
</div> 
<div class="form-group">
	<label for="aeronave_id-modal" class="col-sm-2 control-label">Aeronave</label>
	<div class="col-sm-10">
		<input type="text" class="form-control" value="{{$despegue->aeronave->matricula}}" readonly="" placeholder="Matrícula" />
		{!! Form::hidden('aeronave_id', null ,[ 'class'=>"form-control hora",  'readonly'=>'readonly', "placeholder"=>"Hora"]) !!}
	</div>
</div>
<div class="form-group">
	<label for="cliente_id-select" class="col-sm-2 control-label">Cliente</label>
	<div class="col-sm-10">
		<select name="cliente_id" class="form-control cliente">
			<option value="">--Seleccione Cliente--</option>
			@foreach ($clientes as $index=>$cliente)
			<option value="{{$index}}" {{(($despegue->cliente_id == $index)?"selected":"")}}> {{$cliente}}</option>
			@endforeach
		</select>
	</div>
</div>
<div class="form-group">
	<label for="fbo_id-select" class="col-sm-2 control-label">fbo</label>
	<div class="col-sm-10">
		<select name="fbo_id" class="form-control fbo">
			<option value="">--Sin Fbo--</option>
			@foreach ($fbos as $index=>$fbo)
			<option value="{{$fbo->id}}" {{(($despegue->fbo_id == $fbo->id)?"selected":"")}}> {{$fbo->nombre}}</option>
			@endforeach
		</select>
	</div>
</div>
<div class="form-group">
	<label for="puerto_id-select" class="col-sm-2 control-label">Destino</label>
	<div class="col-sm-10">               
		<select name="puerto_id" class="form-control puerto">
			<option value="">--Seleccione Destino--</option>
			@foreach ($puertos as $puerto)
			<option  data-nacionalidad="{{$puerto->pais_id}}" value="{{$puerto->id}}" {{(($despegue->puerto_id == $puerto->id)?"selected":"")}}> {{$puerto->nombre}}</option>
			@endforeach
		</select>
	</div>
</div>
<div class="form-group">
	<label for="piloto_id" class="col-sm-2 control-label">Piloto</label>
	<div class="col-sm-10">                                                           
		<select name="piloto_id" id="piloto_id-select" class="form-control piloto">
			<option value="">--Seleccione Piloto--</option>
			@foreach ($pilotos as $piloto)
			<option data-ci="{{$piloto->documento_identidad}}" value="{{$piloto->id}}" {{(($despegue->piloto_id == $piloto->id)?"selected":"")}}> {{$piloto->nombre}}</option>
			@endforeach
		</select>
	</div>
</div>
<div class="form-group">
	<label for="tipoMatricula_id" readonly class="col-sm-2 control-label">Tipo de Vuelo</label>
	<div class="col-sm-10"> 
		<select name="tipoMatricula_id" class="form-control tipo_vuelo">
			<option value="">--Seleccione Tipo de Vuelo--</option>
			@foreach ($tipoMatriculas as $tipoMatricula)
			<option value="{{$tipoMatricula->id}}" {{(($despegue->tipoMatricula_id == $tipoMatricula->id)?"selected":"")}}> {{$tipoMatricula->nombre}}</option>
			@endforeach
		</select>
	</div>
</div>
<div class="form-group" >
	<label for="num_vuelo" class="col-sm-2 control-label" >Número de Vuelo</label>
	<div class="col-sm-10">
		{!! Form::text('num_vuelo', ($despegue->num_vuelo)?$despegue->num_vuelo:'N/A', [ 'class'=>"form-control num_vuelo",  "placeholder"=>"Número de Vuelo"]) !!}
	</div>
</div>
<h5>
	<i class="fa fa-money"></i>
	Cobros
	<small>Conceptos a facturar</small>
</h5> 

<div style="margin-left: 15px; margin-right:15px">
	<div class="form-inline  pull-right">
		<!-- Condición de Pago -->
		<div class="form-group">
			<label><strong>Condición de pago: </strong></label>
			<div class="input-group">
				<select name="condicionPago" id="condicionPago-select" class="form-control">
					@if($despegue->condicionPago == NULL)
						<option value="">Seleccione</option>
						<option value="Contado"> Contado</option>
						<option value="Crédito"> Crédito</option>
						@else
						<option value="{{$despegue->condicionPago}}">{{$despegue->condicionPago}}</option>
						<option value="Exonerado"> Exonerado</option>
						<option value="Contado"> Contado</option>
						<option value="Crédito"> Crédito</option>
					@endif
				</select>
				<div class="input-group-addon">
				</div>                    
			</div><!-- /.input group -->
		</div><!-- /.form group -->
	</div>  
	<br>            
	<div class="form-inline">
		<div class="form-group" >
			<label>
				{!! Form::checkbox('cobrar_Formulario', ($despegue->cobrar_Formulario)?true:null, true) !!}
				Formulario
			</label>
			<br>
			<br>
			<label >
				{!! Form::checkbox('cobrar_AterDesp', ($despegue->cobrar_AterDesp)?true:null, true) !!}
				Aterrizaje y Despegue
			</label>
		</div><!-- /.form group -->
		<!-- Tiempo de Estacionamiento-->
		<div class="form-group " style="margin-left: 30px">
			<label>
				{!! Form::checkbox('cobrar_estacionamiento', ($despegue->cobrar_estacionamiento)?true:null, true) !!}
				Estacionamiento
			</label> 
			<br> 
			<label>Tiempo: </label>
			<div class="input-group" style="width: 150px">
				{!! Form::text('tiempo_estacionamiento', ($despegue->tiempo_estacionamiento)?$despegue->tiempo_estacionamiento:'', [ 'id'=>'tiempo_estacionamiento-input', 'class'=>"form-control tiempo_estacionamiento", 'disabled'=>'disabled', "placeholder"=>"Número de Vuelo"]) !!}
				<div class="input-group-addon">
					min
					<i class="ion ion-clock"></i>
				</div>
			</div><!-- /.input group -->
		</div><!-- /.form group -->  

		<div class="form-group" style="margin-left: 20px">
			<label>
				{!! Form::checkbox('cobrar_puenteAbordaje', ($despegue->cobrar_puenteAbordaje)?true:null, true) !!}
				Puentes de Abordaje
			</label>
			<br> 
			<div class="input-group" style="width:100px">
				<div class="input-group-addon">
					#
				</div>
				{!! Form::text('numero_puenteAbordaje', ($despegue->numero_puenteAbordaje)?$despegue->numero_puenteAbordaje:'', [ 'class'=>"form-control num_vuelo",  "placeholder"=>"Número de Vuelo"]) !!}
			</div><!-- /.input group -->
			<div class="input-group" style="width:140px">
				{!! Form::text('tiempo_puenteAbord', ($despegue->tiempo_puenteAbord)?$despegue->tiempo_puenteAbord:'', [ 'class'=>"form-control num_vuelo",  "placeholder"=>"Número de Vuelo"]) !!}
				<div class="input-group-addon">
					horas
					<i class="ion ion-clock"></i>
				</div>
			</div><!-- /.input group -->
		</div><!-- /.form group --> 

		<div class="form-group">
			<label>
				{!! Form::checkbox('cobrar_carga', ($despegue->cobrar_carga)?true:null, true) !!}
				Carga
			</label>
			<br> 
			<div class="input-group" style="width:170px; margin-right: 10px">
			{!! Form::text('peso_embarcado', ($despegue->peso_embarcado)?$despegue->peso_embarcado:'', [ 'class'=>"form-control num_vuelo",  "placeholder"=>"Número de Vuelo"]) !!}
				<div class="input-group-addon">
					Kg(s) <i class="ion ion-soup-can-outline"></i>
				</div>
			</div><!-- /.input group -->
			<div class="input-group" style="width:190px">
			{!! Form::text('peso_desembarcado', ($despegue->peso_desembarcado)?$despegue->peso_desembarcado:'', [ 'class'=>"form-control num_vuelo",  "placeholder"=>"Número de Vuelo"]) !!}
				<div class="input-group-addon ">
					Kg(s) <i class="ion ion-soup-can-outline"></i>
				</div>
			</div><!-- /.input group -->
		</div><!-- /.form group --> 
		<!-- <div class="form-group" style="margin-left:50px; margin-top:40px">
			<label>
				{!! Form::checkbox('cobrar_otrosCargos', 'true', $despegue->cobrar_otrosCargos) !!}
					Otros Cargos
			</label>
			<br> 
				{!! Form::select('otrosCargo_id[]', $otrosCargos, null, [ "id"=>"otros_cargos-select", 'class'=>"form-control chosen-select otrosCargos-select", "multiple"=>"true", "autocomplete"=>"off", 'id'=>"otros_cargos-select"]) !!}

		</div> --><!-- /.form group --> 
		<div  style="margin-left: -15px; margin-right:-15px">
			<hr>
			<h5>
				<i class="fa fa-user"></i>
				Pasajeros
				<small>Embarcados y en Tránsito</small>
			</h5>
			<div class="form-inline">
				<label><i class="ion ion-android-plane col-md-2"> </i><strong> EMBARCADOS </strong></label>
				<!-- Pasajeros adultos -->
				<div class="form-group">
					<label> Adultos:</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="ion ion-person-stalker"></i>
						</div>
						{!! Form::text('embarqueAdultos', ($despegue->embarqueAdultos)?$despegue->embarqueAdultos:'0', [ 'class'=>"form-control embarqueAdultos",  "placeholder"=>"Embarcados"]) !!}
					</div><!-- /.input group -->
				</div><!-- /.form group -->

				<!-- Pasajeros Infantes-->
				<div class="form-group">
					<label> Infantes:</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="ion ion-android-happy"></i>
						</div>
						{!! Form::text('embarqueInfante', ($despegue->embarqueInfante)?$despegue->embarqueInfante:'0', [ 'class'=>"form-control embarqueInfante",  "placeholder"=>"Embarcados"]) !!}
					</div><!-- /.input group -->
				</div><!-- /.form group -->


				<!-- Pasajeros tercera edad -->
				<div class="form-group ">
					<label> Tercera Edad:</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="ion ion-person-stalker"></i>
						</div>
						{!! Form::text('embarqueTercera', ($despegue->embarqueTercera)?$despegue->embarqueTercera:'0', [ 'class'=>"form-control embarqueTercera",  "placeholder"=>"Embarcados"]) !!}
					</div><!-- /.input group -->
				</div><!-- /.form group -->
			</div>
			<br>
			<div class="form-inline">

				<label><i class="ion ion-android-plane col-md-2"> </i><strong>EN TRÁNSITO </strong></label>

				<!-- Pasajeros adultos -->
				<div class="form-group">
					<label>Adultos:</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="ion ion-person-stalker"></i>
						</div>
						{!! Form::text('transitoAdultos', ($despegue->transitoAdultos)?$despegue->transitoAdultos:'0', [ 'class'=>"form-control transitoAdultos",  "placeholder"=>"Embarcados"]) !!}
					</div><!-- /.input group -->
				</div><!-- /.form group -->

				<!-- Pasajeros Infantes-->
				<div class="form-group">
					<label>Infantes:</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="ion ion-android-happy"></i>
						</div>
						{!! Form::text('transitoInfante', ($despegue->transitoInfante)?$despegue->transitoInfante:'0', [ 'class'=>"form-control transitoInfante",  "placeholder"=>"Embarcados"]) !!}
					</div><!-- /.input group -->
				</div><!-- /.form group -->


				<!-- Pasajeros tercera edad -->
				<div class="form-group  ">
					<label>Tercera Edad:</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="ion ion-person-stalker"></i>
						</div>
						{!! Form::text('transitoTercera', ($despegue->transitoTercera)?$despegue->transitoTercera:'0', [ 'class'=>"form-control transitoTercera",  "placeholder"=>"Embarcados"]) !!}
					</div><!-- /.input group -->
				</div><!-- /.form group -->
			</div>
			<br>
			<div class="form-inline">
				<label style="margin-right: 25px"><i class="ion ion-android-plane col-md-2" > </i><strong>TOTALES</strong></label>
				<!-- Pasajeros adultos -->
				<div class="form-group ">
					<label> Adultos:</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="ion ion-person-stalker"></i>
						</div>
						<input type="number"   value="0" class="form-control" />
					</div><!-- /.input group -->
				</div><!-- /.form group -->

				<!-- Pasajeros Infantes-->
				<div class="form-group ">
					<label> Infantes:</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="ion ion-android-happy"></i>
						</div>
						<input type="number"   value="0"  class="form-control" />
					</div><!-- /.input group -->
				</div><!-- /.form group -->

				<!-- Pasajeros tercera edad -->
				<div class="form-group" >
					<label> Tercera Edad:</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="ion ion-person-stalker"></i>
						</div>
						<input type="number"   value="0"  class="form-control" />
					</div><!-- /.input group -->
				</div><!-- /.form group -->

				<!-- Total de Pasajeros -->
				<div class="form-group">

					<label>Total:</label>
					<div class="input-group" style="width:80px">
						<input type="number" value="0"  class="form-control" />
					</div><!-- /.input group -->
				</div><!-- /.form group -->
			</div>

