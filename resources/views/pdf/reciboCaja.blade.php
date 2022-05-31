
<br>
<table  style="width:90%; border-collapse: collapse; padding:2px;">
<tr>
<td  colspan="7">
</td>
<td  colspan="3">
</td>
</tr>
<tr>
<td  colspan="8">
</td>
<td  colspan="2" style="letter-spacing: 3px">
    <strong>{{$fechaDesglose[0]}} {{$fechaDesglose[1]}} {{$fechaDesglose[2]}}</strong>
</td>
</tr>
<tr>
<td  colspan="7">
</td>
<td  colspan="3">
</td>
</tr>
<tr>
<td  colspan="7">
</td>
<td  colspan="3">
</td>
</tr>
</table>

<table style="width:100%; border-collapse: collapse; padding:2px;">
<tr>
<td colspan="7"></td>
<td  colspan="3" style="font-family: Courier, monospace; font-size: 12; display:inline-block;">
<strong >MONTO: {{$traductor->format($monto)}} </strong>
</td>
</tr>
<tr>
<td  colspan="10" style="font-family: Courier, monospace; font-size: 12; display:inline-block;">
<strong>NRO. COBRO: {{$cobro->id}} </strong>
</td>
</tr>
<tr>
<td  colspan="10">
<strong>HEMOS RECIBIDO DE:</strong> {{$cobro->cliente->nombre}}
</td>
</tr>
<tr>
<td  colspan="10">
<strong>LA CANTIDAD DE:</strong> {{$traductor->numtoletras($monto)}}
</td>
</tr>
<tr>
<td  colspan="10">
<strong>POR CONCEPTO DE:</strong> {{$cobro->observacion}}@if($ajustetotal > 0 && strpos($cobro->observacion, 'SALDO') === false) (SALDO A FAVOR: {{$traductor->format($ajustetotal)}}) @endif
</td>
</tr>
</table>

<br>
<br>
<table style="width:95%" >
<tr>
<td colspan="2" style="border-bottom: 1px solid black; text-align:center">
<strong>FORMA DE PAGO</strong>
</td>
<td colspan="4" style="border-bottom: 1px solid black; text-align:center">
<strong>MONTO</strong>
</td>
<td colspan="3" style="border-bottom: 1px solid black; text-align:center">
<strong>REF</strong>
</td>
<td colspan="3" style="border-bottom: 1px solid black; text-align:center">
<strong>BANCO</strong>
</td>
<td colspan="4" style="border-bottom: 1px solid black; text-align:center">
<strong>CUENTA</strong>
</td>
<td colspan="2" style="border-bottom: 1px solid black; text-align:center">
<strong>FECHA</strong>
</td>
</tr>
<tr>
<td colspan="2" >
</td>
<td colspan="2" >
</td>
<td colspan="3">
</td>
<td colspan="2" >
</td>
<td colspan="2" >
</td>
<td colspan="2" >
</td>
</tr>
@if($cobro->pagos->count() > 0)
@foreach($cobro->pagos as $index => $pago)
<tr>
<td colspan="2" style=" text-align:center;" >
{{$pago->tipo}}
</td>
<td colspan="4" style="font-family: Courier, monospace; font-size: 12; display:inline-block;text-align:center;" >
    <strong>{{$traductor->format($pago->monto)}}</strong>
</td>
<td colspan="3"  style="font-family: Courier, monospace; font-size: 12; display:inline-block;text-align:center;">
@if($pago->tipo != 'DAC')
    <strong>{{$pago->ncomprobante}}</strong>
@else
No Aplica
@endif
</td>
<td colspan="3" style="text-align:center;">
@if($pago->tipo != 'DAC')
{{$pago->banco->nombre}}
@else
No Aplica
@endif
</td>
<td colspan="4" style="text-align:center;">
@if($pago->tipo != 'DAC')
{{$pago->cuenta->descripcion}}
@else
No Aplica
@endif
</td>
<td colspan="2" style="text-align:center;">
{{$pago->fecha}}
</td>
</tr>
@endforeach
@else
<tr>
<td colspan="17" style=" text-align:center;" >
<strong>PAGO REALIZADO CON SALDO A FAVOR DEL CLIENTE</strong>
</td>
</tr>
@endif

@if($ajuste <> 0)
        <tr>
            @if($ajuste < 0)
            <td colspan="2" style=" text-align:center;" >
                AJUSTE
            </td>
            @else
                <td colspan="2" style=" text-align:center;" >
                    SALDO A FAVOR
                </td>
            @endif
            <td colspan="3" style="font-family: Courier, monospace; font-size: 12; display:inline-block;text-align:right;" >
                <strong>{{$traductor->format(abs($ajuste))}}</strong>
            </td>
            <td colspan="3"  style="text-align:center;">

            </td>
            <td colspan="4" style="text-align:center;">

            </td>
            <td colspan="4" style="text-align:center;">

            </td>
            <td colspan="2" style="text-align:center;">

            </td>
        </tr>
@endif

</table>
<br>
<br>
<br>
<br>
<br>
<table style="width:95%; border-collapse: collapse; padding:2px">
<tr>
<td  colspan="5">
<strong></strong>
</td>
<td  colspan="5">
</td>
</tr>
<tr>
<td  colspan="5"  >
</td>
<td colspan="1"></td>
<td  colspan="4" style="border-top: 1px solid black;">
<strong>RECIBE CONFORME</strong>
</td>
</tr>
</table>
