@extends('app')

@section('content')

<ol class="breadcrumb">
	<li><a href="{{url('principal')}}">Inicio</a></li>
	<li><a class="active">Relación de Cobranza</a></li>
</ol>
<div class="row" id="box-wrapper">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				</div><!-- /.box-tools -->
			</div>
			{!! Form::open(["url" => action('ReporteController@getReporteRelacionCobranza'), "method" => "GET", "class"=>"form-inline"]) !!}
				<div class="box-body">
					<div class="form-inline">
						<div class="form-group" >
							<label><strong>AEROPUERTO: </strong></label>
						{!! Form::select('aeropuerto', $aeropuertos, $aeropuerto, ["class"=> "form-control"]) !!}
						</div>
						<div class="form-group" >
							<label><strong>MÓDULO:</strong></label>
							{!! Form::select('modulo', $modulos, $modulo, ["class"=> "form-control"]) !!}
						</div>
						<div class="form-group" >
							<label><strong>MES: </strong></label>
		                      {!! Form::select('mes', $meses, $mes, ["class"=> "form-control"]) !!}
		                </div>
						<div class="form-group" >
							<label><strong>AÑO: </strong></label>
							{!! Form::select('anno', $annos, $anno, ["class"=> "form-control"]) !!}
						</div>
						<div class="clearfix"></div>
						</br>
						<div class="form-group" >
							<label ><strong>CLIENTE: </strong></label>
                     		 {!! Form::select('cliente_id', $clientes, $cliente, ["class"=> "form-control select-flt", 'id' => 'cliente']) !!}
						</div>
						<div class="clearfix"></div>
						</br>
						<div class="form-group" >
			            <label><strong>Nro. FACTURA: </strong></label>
							<input type="text" name="nFactura" class="form-control" value="{{ ($nFactura)?$nFactura:'' }}" placeholder="Número de Factura" />
		                </div> 
						<div class="form-group" >
			            <label><strong>Nro. COBRO: </strong></label>
							<input type="text" name="nCobro" class="form-control" value="{{ ($nCobro)?$nCobro:'' }}" placeholder="Número de Cobro" />
		                </div> 
					</div>
				</div>
				<div class="box-footer">
					<div class="form-inline pull-right">
						<button type="submit" class="btn btn-primary">BUSCAR</button>
						<a class="btn btn-default" href="{{action('ReporteController@getReporteRelacionCobranza')}}">RESET</a>
					</div>
					<div class="clearfix"></div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				{!! Form::open(["url" => action("ReporteController@postExportReport"), "id" =>"export-form", "target"=>"_blank"]) !!}
				{!! Form::hidden('table') !!}
                {!! Form::hidden('gerencia', $gerencia) !!}
                {!! Form::hidden('departamento', $departamento) !!}
				<span class="pull-right">
					<button type="button" class="btn btn-primary" id="export-btn">
						<span class="glyphicon glyphicon-file"></span> Exportar
					</button>
				</span>
				{!! Form::close() !!}
			</div>
			<div class="box-body" >
				<div class="row">
					<div class="col-xs-12">
						<div class="table-responsive">
							<table class="table table-hover table-condensed">
								<thead  class="bg-primary">
									<tr>
										<th  rowspan="2" style="vertical-align: middle;" align="center" class="text-center">
											Nro.
										</th>
										<th colspan="2" style="vertical-align: middle;" align="center" class="text-center">
											COBRO
										</th>
										<th colspan="3" style="vertical-align: middle;" align="center" class="text-center">
											CLIENTE
										</th>
										<th colspan="4" style="vertical-align: middle;" align="center" class="text-center">
											DEPÓSITO
										</th>
										<th colspan="3" style="vertical-align: middle;" align="center" class="text-center">
											COMPROBANTE DE RETENCIÓN
										</th>
										<th colspan="4" style="vertical-align: middle" align="center" class="text-center">
											TOTAL
										</th>
									</tr>
									<tr>
										<th style="vertical-align: middle; width:80px" align="center" class="text-center">
											Fecha
										</th>
										<th style="vertical-align: middle; width:50px" align="center" class="text-center">
											Nro.
										</th>
										<th  style="vertical-align: middle; width:80px" align="center" class="text-center">
											Rec. Caja
										</th>
										<th style="vertical-align: middle; width:80px" align="center" class="text-center">
											Código
										</th>
										<th style="vertical-align: middle; width:300px" align="center" class="text-center">
											Nombre o Razón Social
										</th>
										<th style="vertical-align: middle; width:80px" align="center" class="text-center">
											Fecha
										</th>
										<th style="vertical-align: middle; width:50px" align="center" class="text-center">
											Tipo
										</th>
										<th style="vertical-align: middle; width:80px"  align="center" class="text-center">
											Cuenta
										</th>
										<th style="vertical-align: middle; width:80px"  align="center" class="text-center">
											Ref
										</th>
										<th style="vertical-align: middle; width:90px"  align="center" class="text-center">
											Fecha
										</th>
										<th style="vertical-align: middle; width:90px"  align="center" class="text-center">
											Número
										</th>
										<th style="vertical-align: middle; width:90px"  align="center" class="text-center">
											IVA
										</th>
										<th style="vertical-align: middle; width:90px"  align="center" class="text-center">
											ISLR
										</th>
										<th style="vertical-align: middle; width:120px"  align="center" class="text-center">
											Cobrado
										</th>
										<th style="vertical-align: middle; width:120px" align="center" class="text-center">
											Depositado
										</th>
										<th style="vertical-align: middle; width:120px" align="center" class="text-center">
											Saldo a Favor
										</th>
									</tr>
								</thead>

								<tbody>
									@if($recibos->count()>0)
									@foreach($recibos as $index => $recibo)
									<tr>
										<td style="vertical-align: middle; width:30px" align="center">{{$index+1}}</td>
										<td style="vertical-align: middle; width:80px" align="center">{{$recibo->fecha}}</td>
										<td align="center"  style="vertical-align: middle; width:50px">{{$recibo->id}}</td>
										<td style="vertical-align: middle; width:80px" align="center" >{{($recibo->nRecibo)?$recibo->nRecibo:'N/A'}}</td>
										<td style="vertical-align: middle; width:80px" align="center" >{{$recibo->cliente->codigo}}</td>
										<td style="vertical-align: middle; width:300px" align="left" >{{$recibo->cliente->nombre}}</td>
										<td style="vertical-align: middle; width:80px" align="center">@if($recibo->pagos->count() >0) @foreach($recibo->pagos as $pagos) {{$pagos->fecha}} @if($recibo->pagos->count() > 1 )  @endif @endforeach @endif</td>
										<td style="vertical-align: middle; width:50px" align="center">@if($recibo->pagos->count() >0) @foreach($recibo->pagos as $pagos) {{$pagos->tipo}}  @if($recibo->pagos->count() > 1 )  @endif  @endforeach @endif</td>
										<td style="vertical-align: middle; width:80px" align="center">@if($recibo->pagos->count() >0) @foreach($recibo->pagos as $pagos) {{substr($pagos->cuenta->descripcion, -6)}}  @if($recibo->pagos->count() > 1 )  @endif  @endforeach @endif</td>
										<td style="vertical-align: middle; width:80px" align="center">@if($recibo->pagos->count() >0) @foreach($recibo->pagos as $pagos) {{$pagos->ncomprobante}}  @if($recibo->pagos->count() > 1 )  @endif  @endforeach @endif</td>
										<td style="vertical-align: middle; width:90px" align="center">@if($recibo->facturas->count() >0) @foreach($recibo->facturas as $comprobante) {{($comprobante->pivot->retencionFecha=='0')?'':$comprobante->pivot->retencionFecha}}  @if($recibo->pagos->count() > 1 )  @endif  @endforeach @endif</td>
										<td style="vertical-align: middle; width:90px" align="center">@if($recibo->facturas->count() >0) @foreach($recibo->facturas as $comprobante) {{($comprobante->pivot->retencionComprobante=='0')?'':$comprobante->pivot->retencionComprobante}}  @if($recibo->pagos->count() > 1 )  @endif  @endforeach @endif</td>
										<td style="vertical-align: middle; width:90px" class="iva-saldo" align="right">@if($recibo->facturas->count() >0) @foreach($recibo->facturas as $index => $comprobante) @if($index==0) {{ ($comprobante->pivot->iva=='0')?'':$traductor->format((($comprobante->pivot->ivapercentage)/100)*$comprobante->pivot->iva)  }} @endif  @if($recibo->pagos->count() > 1 )  @endif  @endforeach @endif</td>
										<td style="vertical-align: middle; width:90px" class="islr-saldo" align="right">@if($recibo->facturas->count() >0) @foreach($recibo->facturas as $index => $comprobante) @if($index==0) {{(($comprobante->pivot->base * $comprobante->pivot->islrpercentage)/100 == '0')?'':$traductor->format(($comprobante->pivot->base * $comprobante->pivot->islrpercentage)/100)}}@endif   @if($recibo->pagos->count() > 1 )  @endif  @endforeach @endif</td>
										<td style="vertical-align: middle; width:120px" align="right">{{$traductor->format($recibo->montofacturas)}}</td>
										<td style="vertical-align: middle; width:120px" align="right">{{$traductor->format($recibo->montodepositado)}}</td>
										<td style="vertical-align: middle; width:120px" class="saldoFavor" align="right">@if(isset($ajustes[$recibo->id])) {{$traductor->format($ajustes[$recibo->id])}}  @else 0,00 @endif</td>
									</tr>
									@endforeach

									<tr class="bg-gray" align="center">
										<td>Total</td>
										<td> - </td>
										<td> - </td>
										<td> - </td>
										<td> - </td>
										<td> - </td>
										<td> - </td>
										<td> - </td>
										<td> - </td>
										<td> - </td>
										<td> - </td>
										<td> - </td>
										<td style="vertical-align: middle; width:120px" id="ivaTotal" align="right">0,00</td>
										<td style="vertical-align: middle; width:120px" id="islrTotal" align="right">0,00</td>
										<td style="vertical-align: middle; width:120px" align="right">{{$traductor->format($totalFacturas)}}</td>
										<td style="vertical-align: middle; width:120px" align="right">{{$traductor->format($totalDepositado)}}</td>
										<td style="vertical-align: middle; width:120px" id="saldoFavorTotal" align="right">-</td>                                   
									</tr>   
									@else
									<tr>
										<td colspan="17" class="text-center">No hay registros para las fechas seleccionadas</td>
									</tr>
									@endif
<!--                         <tr class="bg-gray">
                        <td colspan="2">Totales Recaudado</td>
                            <td class="text-right" id="metaTotal">0</td>
                            <td class="text-right" id="recaudadoTotal">0</td>
                            <td class="text-right" id="diferenciaTotal">0</td>
                        </tr> -->



                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>


@endsection

@section('script')
<script>
	$(function(){


		$('#cliente').chosen({width:'355px'});


		var ivaTotal=0;
		$('.iva-saldo').each(function(index,value){
			ivaTotal+=commaToNum($(value).text().trim());
		});
		var islrTotal=0;
		$('.islr-saldo').each(function(index,value){
			islrTotal+=commaToNum($(value).text().trim());
		});

		var saldoFavorTotal=0;
		$('.saldoFavor').each(function(index,value){
			saldoFavorTotal+=commaToNum($(value).text().trim());
		});

		$('#saldoFavorTotal').text(numToComma(saldoFavorTotal));
		$('#ivaTotal').text(numToComma(ivaTotal));
		$('#islrTotal').text(numToComma(islrTotal));

		$('#export-btn').click(function(e){
			var table=$('table').clone();
			$(table).find('td, th').filter(function() {
				return $(this).css('display') == 'none';
			}).remove();
			$(table).find('tr').filter(function() {
				return $(this).find('td,th').length == 0;
			}).remove();
			$(table).prepend('<thead>\
								<tr>\
									<th colspan="17" style="vertical-align: middle; margin-top:20px" align="center" class="text-center">RELACIÓN DE COBRANZA\
										</br>\
										MES: {{ mesEnLetras($mes) }} AÑO: {{$anno}} | MÓDULO: {{$moduloNombre}}\
										</br>\
										CLIENTE: {{$clienteNombre}} | AEROPUERTO: {{$aeropuertoNombre}}\
									</th>\
								</tr>\
							</thead>')
			$(table).find('thead, th').css({'border-top':'1px solid black', 'font-weight': 'bold', 'text-align':"center", 'font-size': '12px'})
			$(table).find('th').css({'border-bottom':'1px solid black', 'font-weight': 'bold', 'text-align':"center", 'font-size': '12px'})
			$(table).find('td').css({'font-size': '10px'})
			$(table).find('tr:nth-child(even)').css({'border-bottom':'1px solid black'})

			$(table).find('tr:last td').css({'border-bottom':'1px solid black','border-top':'1px solid black', 'font-weight': 'bold'})
			var tableHtml= $(table)[0].outerHTML;
			$('[name=table]').val(tableHtml);
			$('#export-form').submit();
		})

	})
</script>


@endsection
