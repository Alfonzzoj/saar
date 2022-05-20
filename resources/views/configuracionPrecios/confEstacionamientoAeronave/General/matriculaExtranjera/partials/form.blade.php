	<!-- Configuración del Precio del Estacionamiento y espacio libre -->
	<div class="col-sm-4 invoice-col">
		<div class="box box-danger estacionamientoBox">
			<div class="box-header">
				<h5>Internacionales<small></br>Bloque sin cargo y Precio por bloque</small></h5>
			</div>
			<div class="box-body">
				<!-- Espacio de Tiempo Libre-->
				<div class="bootstrap-timepicker">
					<div class="form-group">
						<label><strong>Minutos Libres: </strong></label>
						<div class="input-group">
							{!! Form::text('tiempoLibreInt_general_ext', null, [ 'class'=>"form-control tiempoLibreInt","placeholder"=>"Minutos libres de cargo"]) !!}
							<input type="hidden" name="aeropuerto_id" value="{{session('aeropuerto')->id}}"></input>
							<div class="input-group-addon">
								min <i class="fa fa-clock-o"></i>
							</div>
						</div><!-- /.input group -->
					</div><!-- /.form group -->
				</div>


				<!-- Equivalente de la UT-->
				<div class="form-group">
					<label><strong>Precio por bloque:</strong> </label>
					<div class="input-group"> 
						<div class="input-group-addon">
							Equivalente: 
						</div>
						{!! Form::text('eq_bloqueInt_general_ext', null, [ 'class'=>"form-control eq_bloqueInt","placeholder"=>"Equivalente de la UT por bloque"]) !!}
					</div><!-- /.input group -->
				</div><!-- /.form group -->	
				<!-- Equivalente de la UT por mínimo-->
				<div class="form-group">
					<div class="checkbox col-md-6" style="margin-left: -40px">
						<label>
							{!! Form::checkbox('aplicar_minimo_int_general_ext', true, null) !!} <strong>Aplicar Mínimo</strong>
						</label>
					</div>
					<div class="input-group  col-md-6" style="margin-left: -40px"> 
						<div class="input-group-addon">
							Equivalente
						</div>
						{!! Form::text('eq_bloqueMinimoInt_general_ext', null, [ 'class'=>"form-control eq_bloqueMinimoInt","placeholder"=>"Equivalente de la UT por bloque"]) !!}
					</div><!-- /.input group -->
				</div><!-- /.form group -->	
				<!-- Precio -->
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-money"></i> BsF. 
						</div>
							{!! Form::text('precio_estInt_general_ext', null, ["id"=>"precio_estInt-input", 'class'=>"form-control precio_estInt","placeholder"=>"Precio Establecido", "readonly"=>"readonly"]) !!}
					</div><!-- /.input group -->
				</div><!-- /.form group -->
				<div class="form-group">
				<div class="checkbox col-md-6"  style="margin-left: -40px">
					<label>
						<strong>Tipo de divisa:</strong>
						
					</label>
					</div>
					{!! Form::select('tipo_pago_gen_matricula_int_int_id',$tipo_pagos,$estacionamientoAeronave[0]->tipo_pago_gen_matricula_int_int_id, [ 'class'=>"form-control", 'id' => 'tipo_pago_est_gen_matricula_int_int_id']) !!}
				</div><!-- /.form group -->	
				<!-- Definición de Bloque -->
				<div class="bootstrap-timepicker">
					<div class="form-group">
						<label><strong>Cantidad de minutos por bloque a cobrar: </strong></label>
						<div class="input-group">
							{!! Form::text('minBloqueInt_general_ext', null, [ 'class'=>"form-control minBloqueInt","placeholder"=>"Minutos por bloque de tiempo"]) !!}
							<div class="input-group-addon">
								min <i class="fa fa-clock-o"></i>
							</div>
						</div><!-- /.input group -->
					</div><!-- /.form group -->
				</div>								
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div> <!-- /.col -->

	<!-- Configuración del Precio del Estacionamiento y espacio libre -->
	<div class="col-sm-4 invoice-col">
		<div class="box box-danger estacionamientoBox">
			<div class="box-header">
				<h5>Nacionales<small></br>Bloque sin cargo y Precio por bloque</small></h5>
			</div>
			<div class="box-body">
				<!-- Espacio de Tiempo Libre-->
				<div class="bootstrap-timepicker">
					<div class="form-group">
						<label><strong>Minutos Libres: </strong></label>
						<div class="input-group">
							{!! Form::text('tiempoLibreNac_general_ext', null, [ 'class'=>"form-control tiempoLibreNac","placeholder"=>"Minutos libres de cargo"]) !!}
							<div class="input-group-addon">
								min <i class="fa fa-clock-o"></i>
							</div>
						</div><!-- /.input group -->
					</div><!-- /.form group -->
				</div>


				<!-- Equivalente de la UT-->
				<div class="form-group">
					<label><strong>Precio por bloque: </strong></label>
					<div class="input-group"> 
						<div class="input-group-addon">
							Equivalente: 
						</div>
							{!! Form::text('eq_bloqueNac_general_ext', null, [ 'class'=>"form-control eq_bloqueNac","placeholder"=>"Equivalente de la UT por bloque" ]) !!}
					</div><!-- /.input group -->
				</div><!-- /.form group -->	
				<!-- Equivalente de la UT por mínimo-->
				<div class="form-group">
					<div class="checkbox col-md-6" style="margin-left: -40px">
						<label>
							{!! Form::checkbox('aplicar_minimo_nac_general_ext', true, null) !!} <strong>Aplicar Mínimo</strong>
						</label>
					</div>
					<div class="input-group  col-md-6"> 
						<div class="input-group-addon">
							Equivalente
						</div>
						{!! Form::text('eq_bloqueMinimoNac_general_ext', null, [ 'class'=>"form-control eq_bloqueMinimoNac","placeholder"=>"Equivalente de la UT por bloque"]) !!}
					</div><!-- /.input group -->
				</div><!-- /.form group -->	
				<!-- Precio -->
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-money"></i> BsF. 
						</div>
							{!! Form::text('precio_estNac_general_ext', null, ["id"=>"precio_estNac-input", 'class'=>"form-control precio_estNac","placeholder"=>"Precio Establecido", "readonly"=>"readonly"]) !!}
					</div><!-- /.input group -->
				</div><!-- /.form group -->
				<div class="form-group">
				<div class="checkbox col-md-6"  style="margin-left: -40px">
					<label>
						<strong>Tipo de divisa:</strong>
						
					</label>
					</div>
					{!! Form::select('tipo_pago_gen_matricula_int_nac_id',$tipo_pagos,$estacionamientoAeronave[0]->tipo_pago_gen_matricula_int_nac_id, [ 'class'=>"form-control", 'id' => 'tipo_pago_est_gen_matricula_int_nac_id']) !!}
				</div><!-- /.form group -->	
				<!-- Definición de Bloque -->
				<div class="bootstrap-timepicker">
					<div class="form-group">
						<label><strong>Cantidad de minutos por bloque a cobrar: </strong></label>
						<div class="input-group">
							{!! Form::text('minBloqueNac_general_ext', null, [ 'class'=>"form-control minBloqueNac","placeholder"=>"Minutos por bloque de tiempo"]) !!}
							<div class="input-group-addon">
								min <i class="fa fa-clock-o"></i>
							</div>
						</div><!-- /.input group -->
					</div><!-- /.form group -->
				</div>								
			</div><!-- /.box-body -->
		</div><!-- /.box -->

	</div> <!-- /.col -->

	
<!-- Definicion de Partida Presupuestaria -->
<div class="col-sm-4 invoice-col">
	<div class="box box-warning estacionamientoBox">
		<div class="box-header">
			<h5>Conceptos<small></br>Seleccionar nombre del concepto</small></h5>
		</div>
		<div class="box-body">
			<!-- Precio Diurno-->
			<!-- Equivalente de la UT-->
			<div class="form-group" >
				<label><strong>Concepto Contado: </strong></label><br/>

					{!! Form::select('conceptoContado_id',	$conceptoss, null, [ 'class'=>"form-control"]) !!}
			</div>	

			<div class="form-group" >
				<label><strong>Concepto Crédito: </strong></label><br/>

					{!! Form::select('conceptoCredito_id',	$conceptoss, null, [ 'class'=>"form-control"]) !!}
			</div>		
		</div><!-- /.box-body -->
	</div><!-- /.box -->
</div> <!-- /.col -->