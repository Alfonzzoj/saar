<div class="col-sm-4 invoice-col">	
		<div class="box box-info horariosBox">
			<div class="box-header">
				<h5>Horario de Operaciones </h5>
			</div>
			<div class="box-body">
				<!-- Inicio de las operaciones -->
				<div class="bootstrap-timepicker">
					<div class="form-group">
						<label>Inicio de las Operaciones: </label>
						<div class="input-group">
							{!! Form::text('operaciones_inicio', null, [ 'class'=>"form-control operaciones_inicio","placeholder"=>"Hora en formato HH:MM:SS"]) !!}
					<input type="hidden" name="aeropuerto_id" value="{{session('aeropuerto')->id}}"></input>
							<div class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</div>
						</div><!-- /.input group -->
					</div><!-- /.form group -->
				</div>
				<!-- Puesta -->
				<div class="bootstrap-timepicker">
					<div class="form-group">
						<label>Fin de las Operaciones: </label>
						<div class="input-group">
							{!! Form::text('operaciones_fin', null, [ 'class'=>"form-control operaciones_fin","placeholder"=>"Hora en formato HH:MM:SS"]) !!}
							<div class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</div>
						</div><!-- /.input group -->
					</div><!-- /.form group -->
				</div>

			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div> <!-- /.col -->

	<div class="col-sm-4 invoice-col">	
		<div class="box box-info horariosBox">
			<div class="box-header">
				<h5>Salida y Puesta del Sol </h5>
			</div>
			<div class="box-body">
				<!-- Salida -->
				<div class="bootstrap-timepicker">
					<div class="form-group">
						<label>Salida del Sol: </label>
						<div class="input-group">
							{!! Form::text('sol_salida', null, [ 'class'=>"form-control sol_salida","placeholder"=>"Hora en formato HH:MM:SS"]) !!}
							<div class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</div>
						</div><!-- /.input group -->
					</div><!-- /.form group -->
				</div>
				<!-- Puesta -->
				<div class="bootstrap-timepicker">
					<div class="form-group">
						<label>Puesta del Sol: </label>
						<div class="input-group">
							{!! Form::text('sol_puesta', null, [ 'class'=>"form-control sol_puesta","placeholder"=>"Hora en formato HH:MM:SS"]) !!}
							<div class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</div>
						</div><!-- /.input group -->
					</div><!-- /.form group -->
				</div>

			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div> <!-- /.col -->