<br>
<br>
<br>
<br>
<table style="width:100%; border-collapse: collapse">
<tr>
<td  colspan="3" >
<strong>FACTURA:</strong> {{$factura->nFacturaPrefix}}-{{$factura->nFactura}}
</td>
<td colspan="7">
</td>
<td  colspan="3">
<strong>FECHA:</strong> {{$factura->fecha}}
</td>

</tr>
<tr>
<td  colspan="3">
<strong>NRO. DOSA:</strong> {{$factura->nroDosa}}
</td>	
<td  colspan="7">
</td>
<td  colspan="3">
<strong>COND. DE PAGO:</strong> {{$factura->condicionPago}}
</td>
</tr>
</table>
<br>

<table>
<tr>
<td colspan="3">		
</td>
<td colspan="5" >	
<strong>FACTURACIÓN POR DERECHOS AERONÁUTICOS</strong> 	
</td>
<td colspan="2">		
</td>
</tr>	
</table>
<br>

<table style="width:100%; border-collapse: collapse; padding: 2px">
<tr>
<td colspan="4" style="border-bottom: 1px solid black; ">		
</td>
<td colspan="4" style="border-bottom: 1px solid black; ">	
<strong>INFORMACIÓN DEL CLIENTE</strong> 	
</td>
<td colspan="2" style="border-bottom: 1px solid black; ">		
</td>
</tr>	
</table>
<br>

<table style="width:100%; border-collapse: collapse;">
<tr>
<td  colspan="7">
<strong>CLIENTE:</strong> {{$factura->cliente->nombre}}
</td>


<td  colspan="3">
<strong>RIF:</strong> {{($factura->cliente)?$factura->cliente->rif:"N/A"}}
</td>
</tr>
<tr>
<td colspan="7">
		<strong>FBO:</strong> {{$despegue->fbo}}
</td>
<td colspan="3">
<strong>TELÉFONO:</strong> {{$factura->cliente->telefonos}}
</td>
</tr>
<tr>
<td  colspan="10">
<strong>DIRECCIÓN FISCAL:</strong> {{$factura->cliente->direccion}}
</td>
</tr>
</table>

<table style="width: 100%" >
<tr>
	<td colspan="10"></td>
</tr>
<tr>
<td colspan="4" style="border-bottom: 1px solid black;">		
</td>
<td colspan="4" style="border-bottom: 1px solid black; ">	
<strong>INFORMACIÓN DE LA AERONAVE</strong> 	
</td>
<td colspan="2" style="border-bottom: 1px solid black; ">		
</td>
</tr>	
</table>
<br>

<table style="width:100%;"> 
<tr> 
<td colspan="3"> 
<strong>MATRÍCULA: </strong> 
{{($despegue->aterrizaje->aeronave)?$despegue->aterrizaje->aeronave->matricula:"N/A"}} 
</td> 
<td colspan="2"> 
<strong>MODELO: </strong> 
{{$despegue->aterrizaje->aeronave->modelo->modelo}} 
</td> 
<td colspan="3"> 
<strong>PESO: </strong> 
{{$traductor->format($despegue->aterrizaje->aeronave->peso)}} Kgs. 
</td> 
<td colspan="3"> 
<strong>TIPO: </strong> 
{{ $despegue->aterrizaje->tipo->nombre}}  
</td> 
</tr> 
</table>

<br>

<table style="width:100%">
<tr>
<td colspan="4" style="border-bottom: 1px solid black;">    
</td>
<td colspan="4" style="border-bottom: 1px solid black;">  
<strong>INFORMACIÓN DEL VUELO</strong>   
</td>
<td colspan="2" style="border-bottom: 1px solid black;">    
</td>
</tr> 
</table>
<br>

<table style="width:100%; border-collapse: collapse; padding: 2px;">
<tr>
<td  colspan="3">
</td>
<td  colspan="3">
<strong>ATERRIZAJE</strong>
</td>
<td  colspan="1">
</td>
<td  colspan="3">
<strong>DESPEGUE</strong>
</td>
</tr>
<tr>
<td  colspan="3">
<strong>PROCEDENCIA/DESTINO</strong>
</td>
<td  colspan="3">
{{$despegue->aterrizaje->puerto->nombre}} ({{$despegue->aterrizaje->puerto->siglas}})
</td>
<td colspan="1">
</td>
<td  colspan="3">
{{$despegue->puerto->nombre}} ({{$despegue->puerto->siglas}})
</td>
</tr>
<tr>
<td  colspan="3">
<strong>NRO. VUELO</strong>
</td>
<td  colspan="3">
{{($despegue->aterrizaje->num_vuelo)?$despegue->aterrizaje->num_vuelo:"N/A"}}
</td>
<td colspan="1">
</td>
<td  colspan="3">
{{($despegue->num_vuelo)?$despegue->num_vuelo:"N/A"}}
</td>
</tr>
<tr>
<td colspan="1">
<strong>PILOTO</strong>
</td>
<td  colspan="2">
<strong>Nombre:</strong>
</td>
<td  colspan="4">
{{$despegue->aterrizaje->piloto->nombre}}
</td>
<td  colspan="3">
{{($despegue->piloto)?$despegue->piloto->nombre:"N/A"}}
</td>
</tr>
<tr>
<td colspan="1">
</td>
<td  colspan="2">
<strong>Licencia:</strong>
</td>
<td  colspan="4">
{{$despegue->aterrizaje->piloto->licencia}}
</td>
<td  colspan="3">
{{($despegue->piloto)?$despegue->piloto->licencia:"N/A"}}
</td>
</tr>
<tr>
<td colspan="1">
</td>
<td  colspan="2">
<strong>Teléfono:</strong>
</td>	
<td colspan="3">
{{ $despegue->aterrizaje->piloto->telefono }}
</td>
<td colspan="1"></td>
<td colspan="3">
{{ $despegue->piloto->telefono }}
</td>
</tr>
<tr>
<td colspan="10">
<strong>PASAJEROS</strong>
</td>
</tr>
<tr>
<td colspan="1">
</td>
<td  colspan="2">
<strong>Des/Embarcados</strong>
</td>
<td  colspan="4">
{{$despegue->aterrizaje->desembarqueAdultos+$despegue->aterrizaje->desembarqueInfante+$despegue->aterrizaje->desembarqueTercera}}
</td>
<td  colspan="3">
{{$despegue->embarqueAdultos+$despegue->embarqueInfante+$despegue->embarqueTercera}}
</td>
</tr>
<tr>
<td colspan="1">
</td>
<td  colspan="2">
<strong>En tránsito:</strong>
</td>
<td  colspan="4">
{{$despegue->aterrizaje->desembarqueTransito}}
</td>
<td  colspan="3">
{{$despegue->transitoAdultos+$despegue->transitoInfante+$despegue->transitoTercera}}
</td>
</tr>
<tr>
<td colspan="3">
<strong>CARGA (KG)</strong>
</td>
<td colspan="3">{{ $despegue->peso_desembarcado }}</td>
<td colspan="1"></td>
<td colspan="3">{{ $despegue->peso_embarcado }}</td>
</tr>
<tr>
<td  colspan="3">
<strong>FECHA y HORA</strong>
</td>
<td  colspan="3">
{{$despegue->aterrizaje->fecha}} {{$despegue->aterrizaje->hora}}
</td>
<td colspan="1">
</td>
<td  colspan="3">
{{$despegue->fecha}} {{$despegue->hora}}
</td>
</tr>
</table>
<br>

<table style="width:100%; border-collapse: collapse; padding: 2px">
<tr>
<td style="border-top: 1px solid black;border-bottom: 1px solid black;" colspan="1">
<strong>Nro.</strong>
</td>
<td style="border-top: 1px solid black;border-bottom: 1px solid black;" colspan="7">
<strong>Concepto</strong>
</td>
<td style="border-top: 1px solid black;border-bottom: 1px solid black;" colspan="2">
<strong>Monto (Bs.)</strong>
</td>
</tr>
@foreach($factura->detalles as $index => $detalle)
<tr>
<td colspan="1" >
{{$index +1}}
</td>
<td colspan="5" >
{{$detalle->concepto->nompre}}
</td>
<td colspan="3" style="text-align:right">
{{$traductor->format($detalle->totalDes)}}
</td>
<td colspan="1">
</td>
</tr>
@endforeach
<tr> <td colspan="10">
@for($i=0; $i<8-$factura->detalles->count();$i++)
<br>
@endfor
</td></tr>
<tr><td colspan="10" ></td></tr>
<tr>
<td colspan="6">
<strong>DESCRIPCIÓN: </strong> 
</td>
<td colspan="2" style="border-bottom: 1px solid black;border-top: 1px solid black;border-left: 1px solid black;">
<strong>TOTAL FACTURADO</strong>
</td>
<td colspan="2" style="border-bottom: 1px solid black;border-top: 1px solid black;border-right: 1px solid black;text-align:left" >
<strong> Bs. </strong> {{$traductor->format($factura->total)}}  
</td>
</tr>
</table>


<br>
<table style="width:100%; border-collapse: collapse; padding: 2px">
<tr>
<td  colspan="10">
{{$factura->descripcion}}
</td>
</tr>
</table>


<br>
<br>
<table style="width:100%; border-collapse: collapse; padding: 2px">
<tr>
<td  colspan="5">
<strong></strong>
</td>
<td  colspan="5">
</td>
</tr>
<tr>
<td  colspan="5"  style="border-top: 1px solid black;">
<strong>Firma Autorizado Sección de Control de Vuelos</strong> 
</td>
<td colspan="1"></td>
<td  colspan="4" style="border-top: 1px solid black;">
<strong>Firma Autorizado Línea Aérea</strong> 
</td>
</tr>
</table>
