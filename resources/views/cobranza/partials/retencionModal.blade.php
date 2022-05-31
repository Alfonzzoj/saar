<div class="modal fade" id="retencion-modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Selección de Retención</h4>
			</div>
			<div class="modal-body">
			    <div class="form-horizontal">
                    <div class="form-group">
                        <label for="fecha-modal-input" class="col-sm-2 control-label">Fecha Retención</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="fecha-retencion-input" autocomplete='off'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fecha-modal-input" class="col-sm-2 control-label">Comprobante Retención</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="comprobante-retencion-input" autocomplete='off'>
                        </div>
                    </div>
			    </div>

				<div class="row" style="margin:15px auto">

					<label class="control-label col-xs-2">Base a Pagar</label>

					<div class="col-xs-4">
						<input class="form-control" id="base-modal-input" readonly/>
					</div>
					<label class="control-label col-xs-2">IVA a Pagar</label>
					<div class="col-xs-4">
						<input class="form-control" id="iva-modal-input" readonly/>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-offset-3 col-xs-6">
						<table class="table">
							<thead class="bg-primary"><tr><th></th><th>Concepto</th><th>Porcentaje</th></tr></thead>
							<tbody>
								@if(isset($cliente) && $cliente->isContribuyente == 1)
									<tr>
										<td>{!! Form::checkbox('estado', '1', true, ["class"=>"retencion-check", "id"=>"islr-checkbox", "autocomplete"=>"off" ]) !!}</td>									
										<td>ISLR</td>
										<td><input type="text" class="form-control retencion-input" id="islrper-modal-input" data-target="#base-modal-input"/></td>
									</tr>
									<tr>
										<td>{!! Form::checkbox('estado', '1', true, ["class"=>"retencion-check", "id"=>"iva-checkbox", "autocomplete"=>"off" ]) !!}</td>
										<td>IVA</td>
										<td><input type="text" class="form-control retencion-input" id="ivaper-modal-input" data-target="#iva-modal-input" /></td>
									</tr>
								@else
									<tr>
										<td>{!! Form::checkbox('estado', true, null, ["class"=>"retencion-check", "id"=>"islr-checkbox", "autocomplete"=>"off" ]) !!}</td>									
										<td>ISLR</td>
										<td><input type="text" class="form-control retencion-input" id="islrper-modal-input" data-target="#base-modal-input"/></td>
									</tr>
									<tr>
										<td>{!! Form::checkbox('estado', true, null, ["class"=>"retencion-check", "id"=>"iva-checkbox", "autocomplete"=>"off" ]) !!}</td>
										<td>IVA</td>
										<td><input type="text" class="form-control retencion-input" id="ivaper-modal-input" data-target="#iva-modal-input" /></td>
									</tr>
								@endif
							</tbody>
						</table>
					</div>
				</div>
				<div class="row" style="margin:15px auto">

					<label class="control-label col-xs-2">Total</label>

					<div class="col-xs-4">
						<input class="form-control" id="total-modal-input" readonly value="0,00" autocomplete="off"/>
					</div>

				</div>
			</div>
			<div class="modal-footer">

				<button type="button" class="btn btn-primary" id="accept-retencion-modal-btn">Aceptar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="edit-retencion-modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Editar információn de Retención</h4>
			</div>
			<div class="modal-body">
			    <div class="form-horizontal">
                    <div class="form-group">
                        <label for="fecha-modal-input" class="col-sm-2 control-label">Fecha Retención</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="edit-fecha-retencion-input" value="" autocomplete='off'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fecha-modal-input" class="col-sm-2 control-label">Comprobante Retención</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="edit-comprobante-retencion-input" autocomplete='off'>
                        </div>
                    </div>
			    </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="edit-accept-retencion-modal-btn">Aceptar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->