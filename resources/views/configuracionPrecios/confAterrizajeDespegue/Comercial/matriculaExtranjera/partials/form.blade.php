<div class="col-sm-4 invoice-col">
	<div class="box box-warning aterrizajeBox">
		<div class="box-header">
			<h5>Internacionales<small></br>Diurno y Nocturno</small></h5>
		</div>
		<div class="box-body">
			<!-- Precio Diurno-->
			<!-- Equivalente de la UT-->
			<div class="form-group">
				<label><strong>Diurno:</strong></label><br/>
				<div class="input-group"> 
					<div class="input-group-addon">
						Equivalente: 
					</div>
					{!! Form::text('eq_diurnoInt_ext', null, [ 'class'=>"form-control eq_diurnoInt","placeholder"=>"Equivalente de la UT"]) !!}
				</div><!-- /.input group -->
			</div><!-- /.form group -->

			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-money"></i> BsF. 
					</div>
					{!! Form::text('precio_diurnoInt_ext', null, ["id"=>"precio_diurnoInt-input", 'class'=>"form-control precio_diurnoInt","placeholder"=>"Precio Establecido", "readonly"=>"readonly"]) !!}
				</div><!-- /.input group -->
			</div><!-- /.form group -->	

			<!-- Equivalente de la UT por mínimo-->
			<div class="form-group">
				<div class="checkbox col-md-6"  style="margin-left: -40px">
					<label>
						{!! Form::checkbox('aplicar_minimo_diuInt_ext', true, null) !!} <strong>Aplicar Minimo</strong>
					</label>
				</div>
				<div class="input-group  col-md-6"> 
					<div class="input-group-addon">
						Equivalente
					</div>
					{!! Form::text('eq_bloqueMinimoDiuInt_ext', null, [ 'class'=>"form-control eq_bloqueMinimoDiuInt","placeholder"=>"Equivalente de la UT por bloque"]) !!}
				</div><!-- /.input group -->
			</div><!-- /.form group -->			

			<!-- Precio Nocturno-->
			<!-- Equivalente de la UT-->
			<div class="form-group">
				<label><strong>Nocturno</strong></label><br/>
				<div class="input-group"> 
					<div class="input-group-addon">
						Equivalente: 
					</div>
					{!! Form::text('eq_nocturInt_ext', null, [ 'class'=>"form-control eq_nocturInt","placeholder"=>"Equivalente de la UT"]) !!}
				</div><!-- /.input group -->
			</div><!-- /.form group -->	

			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-money"></i> BsF. 
					</div>
					{!! Form::text('precio_nocturInt_ext', null, ["id"=>"precio_nocturInt-input", 'class'=>"form-control precio_nocturInt","placeholder"=>"Precio Establecido", "readonly"=>"readonly"]) !!}
					<input type="hidden" name="aeropuerto_id" value="{{session('aeropuerto')->id}}"></input>
				</div><!-- /.input group -->
			</div><!-- /.form group -->		
			<!-- Equivalente de la UT por mínimo-->
			<div class="form-group">
				<div class="checkbox col-md-6"  style="margin-left: -40px">
					<label>
						{!! Form::checkbox('aplicar_minimo_nocInt_ext', true, null) !!} <strong>Aplicar	Mínimo</strong>
					</label>
				</div>
				<div class="input-group  col-md-6"> 
					<div class="input-group-addon">
						Equivalente
					</div>
					{!! Form::text('eq_bloqueMinimoNocInt_ext', null, [ 'class'=>"form-control eq_bloqueMinimoNocInt","placeholder"=>"Equivalente de la UT por bloque"]) !!}
				</div><!-- /.input group -->	
			</div><!-- /.form group -->
			<div class="form-group">
				<div class="checkbox col-md-6"  style="margin-left: -40px">
					<label>
						<strong>Tipo de divisa:</strong>
						
					</label>
				</div>
					{!! Form::select('tipo_pago_com_matricula_int_int_id',$tipo_pagos,$precioAterrizajes->tipo_pago_com_matricula_int_int_id, [ 'class'=>"form-control", 'id' => 'tipo_pago_ate_com_matricula_int_int_id']) !!}
			</div><!-- /.form group -->	
		</div><!-- /.box-body -->
	</div><!-- /.box -->
</div> <!-- /.col -->

<!-- Nacionales -->
<div class="col-sm-4 invoice-col">
	<div class="box box-warning aterrizajeBox">
		<div class="box-header">
			<h5>Nacionales<small></br>Diurno y Nocturno</small></h5>
		</div>
		<div class="box-body">
			<!-- Precio Diurno-->
			<!-- Equivalente de la UT-->
			<div class="form-group">
				<label><strong>Diurno: </strong></label><br/>
				<div class="input-group"> 
					<div class="input-group-addon">
						Equivalente: 
					</div>
					{!! Form::text('eq_diurnoNac_ext', null, [ 'class'=>"form-control eq_diurnoNac","placeholder"=>"Equivalente de la UT"]) !!}
				</div><!-- /.input group -->
			</div><!-- /.form group -->	

			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-money"></i> BsF. 
					</div>
					{!! Form::text('precio_diurnoNac_ext', null, ["id"=>"precio_diurnoNac-input", 'class'=>"form-control precio_diurnoNac","placeholder"=>"Precio Establecido", "readonly"=>"readonly"]) !!}
				</div><!-- /.input group -->
			</div><!-- /.form group -->	
			<!-- Equivalente de la UT por mínimo-->
			<div class="form-group">
				<div class="checkbox col-md-6"  style="margin-left: -40px">
					<label>
						{!! Form::checkbox('aplicar_minimo_diuNac_ext', true, null) !!} <strong>Aplicar	Mínimo</strong>
					</label>
				</div>
				<div class="input-group  col-md-6"> 
					<div class="input-group-addon">
						Equivalente
					</div>
					{!! Form::text('eq_bloqueMinimoDiuNac_ext', null, [ 'class'=>"form-control eq_bloqueMinimoDiuNac","placeholder"=>"Equivalente de la UT por bloque"]) !!}
				</div><!-- /.input group -->
			</div><!-- /.form group -->		

			<!-- Precio Nocturno-->
			<!-- Equivalente de la UT-->
			<div class="form-group">
				<label><strong>Nocturno: </strong></label><br/>
				<div class="input-group"> 
					<div class="input-group-addon">
						Equivalente: 
					</div>
					{!! Form::text('eq_nocturNac_ext', null, [ 'class'=>"form-control eq_nocturNac","placeholder"=>"Equivalente de la UT"]) !!}
				</div><!-- /.input group -->
			</div><!-- /.form group -->	

			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-money"></i> BsF. 
					</div>
					{!! Form::text('precio_nocturNac_ext', null, ["id"=>"precio_nocturNac-input", 'class'=>"form-control precio_nocturNac","placeholder"=>"Precio Establecido", "readonly"=>"readonly"]) !!}
				</div><!-- /.input group -->
			</div><!-- /.form group -->			
			<!-- Equivalente de la UT por mínimo-->
			<div class="form-group">
				<div class="checkbox col-md-6"  style="margin-left: -40px">
					<label>
						{!! Form::checkbox('aplicar_minimo_nocNac_ext', true, null) !!} <strong>Aplicar	Mínimo</strong>
					</label>
				</div>
				<div class="input-group  col-md-6"> 
					<div class="input-group-addon">
						Equivalente
					</div>
					{!! Form::text('eq_bloqueMinimoNocNac_ext', null, [ 'class'=>"form-control eq_bloqueMinimoNocNac","placeholder"=>"Equivalente de la UT por bloque"]) !!}
				</div><!-- /.input group -->
			</div><!-- /.form group -->	
			<div class="form-group">
				<div class="checkbox col-md-6"  style="margin-left: -40px">
					<label>
						<strong>Tipo de divisa:</strong>
						
					</label>
				</div>
					{!! Form::select('tipo_pago_com_matricula_int_nac_id',$tipo_pagos,$precioAterrizajes->tipo_pago_com_matricula_int_nac_id, [ 'class'=>"form-control", 'id' => 'tipo_pago_ate_com_matricula_int_nac_id']) !!}
			</div><!-- /.form group -->						
		</div><!-- /.box-body -->
	</div><!-- /.box -->
</div> <!-- /.col -->
<!-- Definicion de Partida Presupuestaria -->
<div class="col-sm-4 invoice-col">
	<div class="box box-warning aterrizajeBox">
		<div class="box-header">
			<h5>Conceptos<small></br>Seleccionar nombre del concepto</small></h5>
		</div>
		<div class="box-body">
			<!-- Precio Diurno-->
			<!-- Equivalente de la UT-->
			<div class="form-group" >
				<label>Concepto Contado: </label><br/>

					{!! Form::select('conceptoContado_id',	$conceptoss, null, [ 'class'=>"form-control"]) !!}
			</div>	

			<div class="form-group" >
				<label>Concepto Crédito: </label><br/>

					{!! Form::select('conceptoCredito_id',	$conceptoss, null, [ 'class'=>"form-control"]) !!}
			</div>		
		</div><!-- /.box-body -->
	</div><!-- /.box -->
</div> <!-- /.col -->