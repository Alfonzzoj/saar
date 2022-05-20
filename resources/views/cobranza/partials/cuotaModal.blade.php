<div class="modal fade" id="cuota-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Abono por cuota</h4>
			</div>
			<div class="modal-body">
				<div class="form-horizontal">
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label">Saldo</label>
						<div class="col-sm-10">
							<input  class="form-control" id="cuota-saldo-input">
						</div>
					</div>
					<div class="form-group">
						<label for="inputPassword3" class="col-sm-2 control-label">Cantidad de cuotas</label>
						<div class="col-sm-10">
							<input  class="form-control" id="cuota-cantidad-input" >
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button class="btn btn-primary" id="procesar-cuotas-btn">Procesar</button>
						</div>
					</div>
					<div id="cuotas-wrapper">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary" id="accept-cuotas-modal-btn">Aceptar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->