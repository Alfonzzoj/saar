<br>
<br>
<br>
<br>
<br>
<br>
<br>
<table style="width:90%; border-collapse: collapse; padding:2px; font-weight: 15px">
<tr>
<td  colspan="7">
</td>
<td colspan="3">
    <strong>FACTURA: <span  style="font-family: Courier, monospace; font-size: 12; display:inline-block; text-align: right;">{{$factura->nFacturaPrefix}}-{{$factura->nFactura}}</span></strong>
</td>
</tr>
<tr>
<td  colspan="7">
</td>
<td  colspan="3">
    <strong>FECHA: <span style="font-family: Courier, monospace; font-size: 12; display:inline-block; text-align: right;">{{$factura->fecha}}</span> </strong>
</td>
</tr>
</table>

<br>
<br>
<br>

<table style="width:90%; border-collapse: collapse; padding:2px">
<tr>
<td  colspan="10">
    <strong>CLIENTE:</strong> <span style="font-size: 11; font-weight: 900;">{{$factura->cliente->nombre}}</span>
</td>
</tr>
<tr>
<td  colspan="6">
<strong>DIRECCIÓN FISCAL:</strong> {{$factura->cliente->direccion}}
</td>
<td  colspan="2">
<strong>RIF:</strong> {{$factura->cliente->rif}}
</td>
<td  colspan="2">
<strong>NIT:</strong> {{$factura->cliente->nit}}
</td>
</tr>
<tr>
<td  colspan="5">
<strong>TELÉFONO:</strong> {{$factura->cliente->telefonos}}
</td>
<td  colspan="5">
<strong>CONDICIÓN DE PAGO:</strong> {{$factura->condicionPago}}
</td>
</tr>
</table>

<br>
<br>
<br>

<table style="width:90%; border-collapse: collapse; padding:2px">
<tr>
<td style="border-top: 1px solid black;border-bottom: 1px solid black;" colspan="2">
<strong>NRO.</strong>
</td>
<td style="border-top: 1px solid black;border-bottom: 1px solid black;" colspan="6">
<strong>CONCEPTO</strong>
</td>
<td style="border-top: 1px solid black;border-bottom: 1px solid black;" colspan="2">
<strong>MONTO (Bs.)</strong>
</td>
</tr>
@foreach($factura->detalles as $index => $detalle)
<tr>
<td colspan="2" >
{{$index + 1}}
</td>
<td colspan="5" >
{{$detalle->concepto->nompre}}
</td>
<td colspan="3" style="text-align: right; font-family: Courier, monospace; font-size: 12;">
    <strong> {{$traductor->format($detalle->montoDes)}} </strong>
</td>
</tr>
@endforeach

<tr> <td colspan="10">
@for($i=2; $i<20-$factura->detalles->count();$i++)
<br>
@endfor
</td></tr>
<tr><td colspan="10"><strong>DESCRIPCIÓN:</strong> {{$factura->descripcion}}</td></tr>
<br>
<tr><td colspan="10" style="border-bottom: 1px solid black;"></td></tr>
<tr>
<td colspan="3" >
</td>
<td colspan="2" style="text-align: left;"><strong>Sub Total</strong></td>
<td colspan="5" style="text-align: right;">
    <strong> Bs. <span style="text-align: right; font-family: Courier, monospace; font-size: 12;"> {{$traductor->format($factura->subtotal)}} </span> </strong>
</td>
</tr>
<tr>
<td colspan="3" ></td>
<td colspan="2" >
<strong>IVA</strong> ({{$traductor->format(($factura->iva>0)?( ($factura->iva/$factura->subtotal)* 100 ):0)}}%)
</td>
<td colspan="5" style="text-align: right;">
    <strong>Bs. <span style="font-family: Courier, monospace; font-size: 12; font-weight: bold;"> {{$traductor->format($factura->iva)}} </span> </strong>
</td>
</tr>
<tr>
<td colspan="3" ></td>
<td colspan="2" style="border-bottom: 1px solid black;border-top: 1px solid black;border-left: 1px solid black;">
    <strong>TOTAL GENERAL</strong>
</td>
<td colspan="5" style="border-bottom: 1px solid black;border-top: 1px solid black;border-right: 1px solid black;text-align:right; font-weight: bold;" >
    <strong>Bs.  <span style="font-family: Courier, monospace; font-size: 12;"> {{$traductor->format($factura->total)}} </span> </strong>
</td>
</tr>
<tr>
<td colspan="6" >
<strong>MONTO EN LETRAS</strong>
</td>
<td colspan="4">
</td>
</tr>
<tr>
<td colspan="10" >
<strong>SON: </strong> {{$traductor->numtoletras($factura->total)}}
</td>
</tr>
</table>
