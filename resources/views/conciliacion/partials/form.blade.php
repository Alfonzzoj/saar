

    <div class="box-body">
        <div class="row">
            <div class="col-md-1" style="width: 100%;">
                        <table class="table text-center" id="movimientos-table" style="width: 100%;">
                            <thead>
                            <tr style="width: 100%;">
                                <th colspan="2">Origen</th>
                                <th colspan="1">Fecha</th>
                                <th colspan="1">Nro. Cobro</th>
                                <th colspan="4">Banco</th>
                                <th colspan="5">Cuenta</th>
                                <th colspan="3">Tipo</th>
                                <th colspan="3">Referencia</th>
                                <th colspan="5">Monto</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($movimientosCobros as $movimiento)
                                <tr style="width: 100%;">
                                    <td colspan="2">
                                        COBROS
                                    </td>
                                    <td colspan="1">
                                        {{ date("d-m-Y", strtotime($movimiento->cobrospagos_fecha)) }}
                                    </td>
                                    <td colspan="1">
                                        {{ ($movimiento->cobro_id)?$movimiento->cobro_id:'N/A' }}
                                    </td>
                                    <td colspan="4">
                                        {{ $movimiento->banco->nombre }}
                                    </td>
                                    <td colspan="5">
                                        {{ $movimiento->cuenta->descripcion }}
                                    </td>
                                    <td colspan="3">
                                        {{ $movimiento->tipo }}
                                    </td>
                                    <td colspan="3">
                                        {{ $movimiento->ncomprobante }}
                                    </td>
                                    <td colspan="5">
                                        <span class="amount">{{ $traductor->format($movimiento->monto) }}</span>
                                    </td>
                                </tr>
                            @endforeach
                            @foreach($movimientosTasas as $movimiento)
                                <tr style="width: 100%;">
                                    <td colspan="1">
                                        TASAS
                                    </td>
                                    <td colspan="2">
                                        {{ date("d-m-Y", strtotime($movimiento->tasa_cobro_detalles_fecha)) }}
                                    </td>
                                    <td colspan="1">
                                        {{ ($movimiento->tasa_cobro_id)?$movimiento->tasa_cobro_id:'N/A' }}
                                    </td>
                                    <td colspan="4">
                                        {{ $movimiento->banco->nombre }}
                                    </td>
                                    <td colspan="5">
                                        {{ $movimiento->cuenta->descripcion }}
                                    </td>
                                    <td colspan="3">
                                        {{ $movimiento->tipo }}
                                    </td>
                                    <td colspan="3">
                                        {{ $movimiento->ncomprobante }}
                                    </td>
                                    <td colspan="5">
                                        <span class="amount">{{ $traductor->format($movimiento->monto) }}</span>
                                    </td>
                                </tr>
                            @endforeach
                            <td colspan="1"></td>
                            <td colspan="2"></td>
                            <td colspan="1"></td>
                            <td colspan="4"></td>
                            <td colspan="5"> </td>
                            <td colspan="3"> </td>
                            <td colspan="3">
                                Total
                            </td>
                            <td colspan="5">
                                <span class="amount">{{ $traductor->format($total) }}</span>
                            </td>
                            </tbody>
                        </table>
                </div>
        </div>
    </div><!-- /.box-body -->