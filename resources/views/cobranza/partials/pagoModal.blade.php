<div class="modal fade" id="register-payment-modal" tabindex="-1" role="dialog" aria-labelledby="register-payment-modal" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
	    <div class="modal-content">
		    <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cancelar</span></button>
			    <h4 class="modal-title">Registrar una forma de pago</h4>
		    </div>
		    <div class="modal-body">
			    <div class="form-horizontal">
				    <div class="form-group">
					    <label for="forma-modal-input" class="col-sm-2 control-label">Forma de pago</label>
					    <div class="col-md-10">
						    <select class="form-control"  id="forma-modal-input">
							    <option value="D">Deposito</option>
							    <option value="NC">Nota de credito</option>
								<option value="T">Transferencia</option>
								<option value="DP">Dación de Pago</option>
						    </select>
					    </div>
				    </div>
				    <div class="form-group">
					    <label for="fecha-modal-input" class="col-sm-2 control-label">Fecha</label>
					    <div class="col-md-10">
						    <input type="text" class="form-control" id="fecha-modal-input" autocomplete='off'>
					    </div>
				    </div>
				    <div class="form-group" id="bancoModal">
					    <label for="banco-modal-input" class="col-sm-2 control-label">Banco</label>
					    <div class="col-md-10">
						    <select id="banco-modal-input" class="form-control">
							    @foreach($bancos as $banco)

							    <option value="{{$banco->id}}" data-cuentas='{!!$banco->cuentas!!}' >{{$banco->nombre}}</option>

							    @endforeach
						    </select>
					    </div>
				    </div>
				    <div class="form-group" id="cuentaModal">
					    <label for="cuenta-modal-input" class="col-sm-2 control-label">Cuenta</label>
					    <div class="col-md-10">
						    <select id="cuenta-modal-input" class="form-control">
								<option value=''>Seleccione</option>
						    </select>
					    </div>
				    </div>
				    <div class="form-group" id="loteModal">
					    <label for="deposito-modal-input" class="col-sm-2 control-label">#Deposito/#Lote</label>
					    <div class="col-md-10">
						    <input type="text" class="form-control" id="deposito-modal-input" autocomplete='off'>
					    </div>
				    </div>

				    <div class="form-group">
					    <label for="monto-modal-input" class="col-sm-2 control-label">Monto</label>
					    <div class="col-md-10">
						    <input type="text" class="form-control" id="monto-modal-input" autocomplete='off'>
					    </div>
				    </div>
			    </div>
		    </div>
		    <div class="modal-footer">
			    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			    <button type="button" class="btn btn-primary" id="{{isset($edit)?'edit-deposito-modal-btn':'accept-deposito-modal-btn'}}">Aceptar</button>
		    </div>
	    </div>
    </div>
</div>
