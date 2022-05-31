<!-- Configuración del Precio por habilitación -->
<div class="col-sm-4 invoice-col">

	<!-- Configuración del Precio del Formulario -->
	<div class="box box-success cargosVariosBox">
		<div class="box-header">
			<h5>Formulario <small></br>Nacional e Internacional</small></h5>
		</div>
		<div class="box-body">

			<!-- Equivalente de la UT-->
			<div class="form-group">
				<label>Precio: </label>
				<label><b>NACIONAL</b></label>
				<div class="input-group"> 
					<div class="input-group-addon">
						Establecido: 
					</div>
					{!! Form::text('eq_formulario', null, [ 'class'=>"form-control eq_formulario","placeholder"=>"Equivalente de la UT"]) !!}
					<input type="hidden" name="aeropuerto_id" value="{{session('aeropuerto')->id}}"></input>
				</div><!-- /.input group -->
			</div><!-- /.form group -->	
			<!-- Precio NACIONAL-->
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-money"></i> BsF. 
					</div>
					{!! Form::text('precio_formulario', null, [ "id"=>"precio_formulario-input", 'class'=>"form-control precio_formulario","placeholder"=>"Precio Establecido", "readonly"=>"readonly"]) !!}
				</div><!-- /.input group -->
			</div><!-- /.form group -->	
			<div class="form-group">
				<div class="checkbox col-md-6">
					<label>
						<strong>Tipo de divisa:</strong>
						
					</label>
					</div>
					{!! Form::select('tipo_pago_formulario_id',$tipo_pagos,$cargoVario->tipo_pago_formulario_id, [ 'class'=>"form-control", 'id' => 'tipo_pago_formulario_id']) !!}
				</div><!-- /.form group -->		
			<!-- Equivalente de la Unidad Dolar DICOM-->
			<div class="form-group">
				<label>Precio: </label>
				<label><b>INTERNACIONAL</b></label>
				<div class="input-group"> 
					<div class="input-group-addon">
						Establecido: 
					</div>
					{!! Form::text('eq_formulario_inter', null, [ 'class'=>"form-control eq_formulario_inter","placeholder"=>"Unidad Dolar"]) !!}
				</div><!-- /.input group -->
			</div><!-- /.form group -->	
			{{--<!-- Precio INTERNACIONAL -->
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-dolar"></i> DICOM. 
					</div>
					{!! Form::text('precio_formulario_inter', null, [ "id"=>"precio_formulario_inter-input", 'class'=>"form-control precio_formulario_inter","placeholder"=>"Precio Establecido", "readonly"=>"readonly"]) !!}
				</div><!-- /.input group -->
			</div><!-- /.form group -->	--}}

			<div class="form-group" >
				<label>Concepto Crédito:  </label><br/>

				{!! Form::select('formularioCredito_id',	$conceptoss, null, [ 'class'=>"form-control"]) !!}
			</div>	

			<div class="form-group" >
				<label>Concepto Contado: </label><br/>

				{!! Form::select('formularioContado_id',	$conceptoss, null, [ 'class'=>"form-control"]) !!}
			</div>	
				
		</div><!-- /.box-body -->
	</div><!-- /.box -->
</div>

<div class="col-sm-4 invoice-col">
	<div class="box box-success cargosVariosBox">
		<div class="box-header">
			<h5>Derecho de Habilitación <small></br>Costo</small></h5>
		</div>
		<div class="box-body">


			<!-- Equivalente de la UT-->
			<div class="form-group">
				<label>Precio: </label>
				<div class="input-group"> 
					<div class="input-group-addon">
						Establecido: 
					</div>
					{!! Form::text('eq_derechoHabilitacion', null, [ 'class'=>"form-control eq_derechoHabilitacion","placeholder"=>"Equivalente de la UT"]) !!}
				</div><!-- /.input group -->
			</div><!-- /.form group -->	
			<!-- Precio -->
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-money"></i> BsF. 
					</div>
					{!! Form::text('precio_derechoHabilitacion', null, [ "id"=>"precio_derechoHabilitacion-input", 'class'=>"form-control precio_derechoHabilitacion","placeholder"=>"Precio Establecido", "readonly"=>"readonly"]) !!}
				</div><!-- /.input group -->
			</div><!-- /.form group -->	
			<div class="form-group" >
				<label>Concepto Crédito:  </label><br/>

				{!! Form::select('habilitacionCredito_id',	$conceptoss, null, [ 'class'=>"form-control"]) !!}
			</div>	

			<div class="form-group" >
				<label>Concepto Contado: </label><br/>

				{!! Form::select('habilitacionContado_id',	$conceptoss, null, [ 'class'=>"form-control"]) !!}
			</div>				
			<div class="form-group">
				<div class="checkbox col-md-6">
				<label>
					<strong>Tipo de divisa:</strong>
					
				</label>
				</div>
				{!! Form::select('tipo_pago_habilitacion_id',$tipo_pagos,$cargoVario->tipo_pago_habilitacion_id, [ 'class'=>"form-control", 'id' => 'tipo_pago_habilitacion_id']) !!}
			</div><!-- /.form group -->			
		</div><!-- /.box-body -->
	</div><!-- /.box -->		
</div><!-- /.col -->

<!-- Configuración del Precio del uso de Abordaje -->
<div class="col-sm-4 invoice-col">
	<div class="box box-success cargosVariosBox">
		<div class="box-header">
			<h5>Derecho de Uso de Abordaje <small></br>Nacional e Internacional</small></h5>
		</div>
		<div class="box-body">

			<!-- Equivalente de la UT-->
			<div class="form-group">
				<label>Precio por bloque <b>NACIONAL</b></label>
				<div class="input-group"> 
					<div class="input-group-addon">
						Establecido: 
					</div>
					{!! Form::text('eq_usoAbordajeSinHab', null, [ 'class'=>"form-control eq_usoAbordajeSinHab","placeholder"=>"Equivalente de la UT"]) !!}
				</div><!-- /.input group -->
			</div><!-- /.form group -->	
			<!-- Precio -->
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-money"></i> BsF. 
					</div>
					{!! Form::text('precio_usoAbordajeSinHab', null, [ "id"=>"precio_usoAbordajeSinHab-input", 'class'=>"form-control precio_usoAbordajeSinHab","placeholder"=>"Precio Establecido", "readonly"=>"readonly"]) !!}
				</div><!-- /.input group -->
			</div><!-- /.form group -->
			<div class="form-group">
				<div class="checkbox col-md-6">
				<label>
					<strong>Tipo de divisa:</strong>
					
				</label>
				</div>
				{!! Form::select('tipo_pago_derecho_abordaje_nac_id',$tipo_pagos,$cargoVario->tipo_pago_derecho_abordaje_nac_id, [ 'class'=>"form-control", 'id' => 'tipo_pago_derecho_abordaje_nac_id']) !!}
			</div><!-- /.form group -->	

			<!-- Equivalente de la UT-->
			<div class="form-group">
				<label>Precio por bloque <b>INTERNACIONAL</b></label>
				<div class="input-group"> 
					<div class="input-group-addon">
						Establecido: 
					</div>
					{!! Form::text('eq_usoAbordajeConHab', null, [ 'class'=>"form-control eq_usoAbordajeConHab","placeholder"=>"Equivalente de la UT"]) !!}
				</div><!-- /.input group -->
			</div><!-- /.form group -->	
			<div class="form-group">
				<div class="checkbox col-md-6">
				<label>
					<strong>Tipo de divisa:</strong>
					
				</label>
				</div>
				{!! Form::select('tipo_pago_derecho_abordaje_int_id',$tipo_pagos,$cargoVario->tipo_pago_derecho_abordaje_int_id, [ 'class'=>"form-control", 'id' => 'tipo_pago_derecho_abordaje_int_id']) !!}
			</div><!-- /.form group -->	
			<!-- Precio -->
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-money"></i> BsF. 
					</div>
					{!! Form::text('precio_usoAbordajeConHab', null, [ "id"=>"precio_usoAbordajeConHab-input", 'class'=>"form-control precio_usoAbordajeConHab","placeholder"=>"Precio Establecido", "readonly"=>"readonly"]) !!}
				</div><!-- /.input group -->
			</div><!-- /.form group -->
			<div class="form-group" >
				<label>Concepto Crédito:  </label><br/>

				{!! Form::select('abordajeCredito_id',	$conceptoss, null, [ 'class'=>"form-control"]) !!}
			</div>	

			<div class="form-group" >
				<label>Concepto Contado: </label><br/>

				{!! Form::select('abordajeContado_id',	$conceptoss, null, [ 'class'=>"form-control"]) !!}
			</div>								
		</div><!-- /.box-body -->
	</div><!-- /.box -->
</div> <!-- /.col -->