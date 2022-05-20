<br>
<br>
<table>
<tr>
<td colspan="10" style="text-align: center;">	
<strong>INFORMACIÓN GENERAL DE DESPEGUE</strong> 	
</td>
</tr>
</table>
<br>
<br>
<table>
<tr>
<td colspan="2" style="border-bottom: 1px solid black; ">		
</td>
<td colspan="8" style="text-align: center; border-bottom: 1px solid black; ">	
<strong>INFORMACIÓN DEL CLIENTE</strong> 	
</td>
<td colspan="2" style="border-bottom: 1px solid black; ">		
</td>
</tr>
</table>
<br>
<br>


<table style="width:100%; border-collapse: collapse;">
<tr>
<td  colspan="7">
<strong>CLIENTE:</strong> {{$despegue->cliente->nombre}}
</td>
<td  colspan="3">
<strong>RIF:</strong> {{($despegue->cliente)?$despegue->cliente->rif:"N/A"}}
</td>
</tr>
<tr>
<td colspan="7">
</td>
<td colspan="3">
<strong>TELÉFONO:</strong> {{$despegue->cliente->telefonos}}
</td>
</tr>
<tr>
<td  colspan="10">
<strong>DIRECCIÓN FISCAL:</strong> {{$despegue->cliente->direccion}}
</td>
</tr>
</table>

<table>
<tr>
<td colspan="2" style="border-bottom: 1px solid black; ">		
</td>
<td colspan="8" style="text-align: center; border-bottom: 1px solid black; ">	
<strong>INFORMACIÓN DE LA AERONAVE</strong> 	
</td>
<td colspan="2" style="border-bottom: 1px solid black; ">		
</td>
</tr>
</table>
<br>
<br>
<table style="width:100%;"> 
<tr> 
<td colspan="3"> 
<strong>MATRÍCULA: </strong> 
{{($despegue->aeronave)?$despegue->aeronave->matricula:"N/A"}} 
</td> 
<td colspan="2"> 
<strong>MODELO: </strong> 
{{$despegue->aeronave->modelo->modelo}} 
</td> 
<td colspan="3"> 
<strong>PESO: </strong> 
{{$traductor->format($despegue->aeronave->peso)}} Kgs. 
</td> 
<td colspan="3"> 
<strong>TIPO: </strong> 
{{ $despegue->tipo->nombre}}  
</td> 
</tr> 
</table>
<br>
<br>
<table>
<tr>
<td colspan="2" style="border-bottom: 1px solid black; ">		
</td>
<td colspan="8" style="text-align: center; border-bottom: 1px solid black; ">	
<strong>INFORMACIÓN DEL VUELO</strong> 	
</td>
<td colspan="2" style="border-bottom: 1px solid black; ">		
</td>
</tr>
</table>
<br>
<br>
<table style="width:100%; border-collapse: collapse; padding: 2px;">
<tr>
<td  colspan="3">
<strong>FECHA y HORA</strong>
</td>
<td  colspan="7">
{{$despegue->fecha}} {{$despegue->hora}}
</td>
</tr>
<tr>
<td  colspan="3">
<strong>DESTINO</strong>
</td>
<td  colspan="7">
{{$despegue->puerto->nombre}} ({{$despegue->puerto->siglas}})
</td>
</tr>
<tr>
<td  colspan="3">
<strong>NRO. VUELO</strong>
</td>
<td  colspan="7">
{{($despegue->num_vuelo)?$despegue->num_vuelo:"N/A"}}
</td>
</tr>
<tr>
<td colspan="10">
<strong>PILOTO</strong>
</td>
</tr>
<tr>
<td colspan="1"></td>
<td  colspan="2">
<strong>Nombre:</strong>
</td>
<td  colspan="7">
{{($despegue->piloto)?$despegue->piloto->nombre:"N/A"}}
</td>
</tr>
<tr>
<td colspan="1">
</td>
<td  colspan="2">
<strong>Licencia:</strong>
</td>
<td  colspan="7">
{{($despegue->piloto)?$despegue->piloto->licencia:"N/A"}}
</td>
</tr>
<tr>
<td colspan="1">
</td>
<td  colspan="2">
<strong>Teléfono:</strong>
</td>	
<td colspan="7">
{{ $despegue->piloto->telefono }}
</td>
</tr>
<tr>
<td colspan="3">
<strong>CARGA (KG)</strong>
</td>
<td colspan="7">{{ $despegue->peso_embarcado }}</td>
</tr>
</table>
<br>
<br>
<table>
<tr>
<td colspan="2">		
</td>
<td colspan="8" style="text-align: center;">	
<strong>INFORMACIÓN DE PASAJEROS EMBARCADOS</strong> 	
</td>
<td colspan="2">		
</td>
</tr>
</table>
<br>
<br>

<table style="width:100%; border-collapse: collapse; padding: 2px">
<tr>
<td style="border-top: 1px solid black;border-bottom: 1px solid black;" colspan="1">
<strong>Nro.</strong>
</td>
<td style="border-top: 1px solid black;border-bottom: 1px solid black;" colspan="3">
<strong>Cédula y/o Pasaporte</strong>
</td>
<td style="border-top: 1px solid black;border-bottom: 1px solid black;" colspan="4">
<strong>Nombre</strong>
</td>
<td style="border-top: 1px solid black;border-bottom: 1px solid black;" colspan="4">
<strong>Apellido</strong>
</td>
<td style="border-top: 1px solid black;border-bottom: 1px solid black;" colspan="3">
<strong>Nacionalidad</strong>
</td>
</tr>
@foreach($pasajeros as $index => $pasajero)
<tr id="pasajero{{ $pasajero->id }}">
		<td colspan="1">{{ $index+1 }}</td>
		<td colspan="3">{{ ($pasajero->cedula) == 0 ?'':$pasajero->cedula }}</td>
		<td  colspan="4">{{ $pasajero->nombre }}</td>
		<td  colspan="4">{{ $pasajero->apellido }}</td>
		<td  colspan="3">{{ $pasajero->nacionalidad }}</td>
</tr>
@endforeach	
</table>
<br>
<br>
<br>
<br>
<table>
<tr>
	<td colspan="10"><strong>CANTIDAD PASAJEROS REGISTRADOS: </strong> {{$despegue->pasajero->count()}}</td>
</tr>
<br>
<tr>
	<td colspan="10"><strong>CANTIDAD PASAJEROS EMBARCADOS: </strong> {{$despegue->embarqueAdultos+$despegue->embarqueInfante+$despegue->embarqueTercera}}</td>
</tr>
</table>