
<div class="box box-info">
	<div class="box-header  with-border">
		<h3 class="box-title text-center" style="display: block;"><b> Detalle Situación Actual del Mes: {{ $meses[$mes] }}</b></h3>
		<div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		</div>
	</div>
	<div class="box-body">
		<div class="table-responsive">
			<table class="table no-margin table-bordered ">
				<b><tbody>
					<tr>
						<td colspan="3" style="font-weight: bold"  align="center" class="text-center bg-blue"> TOTAL AERONÁUTICO </td>
						<td colspan="3" style="font-weight: bold"  align="center" class="text-center bg-blue"> TOTAL NO AERONÁUTICO </td>
					</tr>
					<tr>
						<!-- AERONAUTICOS -->
						<td align="center" class="text-center" style="background-color: #1976D2; color: white;">Monto Facturado (Bs.)</td>
						<td align="center" class="text-center" style="background-color: #1976D2; color: white;">Monto Recaudado (Bs.)</td>
						<td align="center" class="text-center" style="background-color: #1976D2; color: white;">Por Cobrar (Bs.)</td>

						<!-- NO AERONAUTICOS -->
						<td align="center" class="text-center" style="background-color: #1976D2; color: white;">Monto Facturado (Bs.)</td>
						<td align="center" class="text-center" style="background-color: #1976D2; color: white;">Monto Recaudado (Bs.)</td>
						<td align="center" class="text-center" style="background-color: #1976D2; color: white;">Por Cobrar (Bs.)</td>	
					</tr>
					<tr>
						<!-- AERONAUTICOS -->
						<td align="center" class="text-center">{{ $traductor->format($facturadoAero) }}</td>
						<td align="center" class="text-center">{{ $traductor->format($cobradoAero) }}</td>
						<td align="center" class="text-center">{{ $traductor->format($porCobrarAero) }}</td>

						<!-- NO AERONAUTICOS -->
						<td align="center" class="text-center">{{ $traductor->format($facturadoNoAero) }}</td>
						<td align="center" class="text-center">{{ $traductor->format($cobradoNoAero) }}</td>
						<td align="center" class="text-center">{{ $traductor->format($porCobrarNoAero) }}</td>		
					</tr>
				</tbody></b>
			</table>
		</div><!-- /.table-responsive -->
	</div><!-- /.box-body -->
</div><!-- /.box -->