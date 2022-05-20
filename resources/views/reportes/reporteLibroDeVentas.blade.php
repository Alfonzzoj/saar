@extends('app')

@section('content')

<ol class="breadcrumb">
	<li><a href="{{url('principal')}}">Inicio</a></li>
	<li><a class="active">Libro de Ventas</a></li>
</ol>
<div class="row" id="box-wrapper">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Filtros</h3>
				<div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse">
						<i class="fa fa-minus"></i>
					</button>
				</div><!-- /.box-tools -->
			</div>
            <div class="box-body text-right">
                {!! Form::open(["url" => action('ReporteController@getReporteLibroDeVentas'), "method" => "GET", "class"=>"form-inline"]) !!}
                <label><strong>DESDE: </strong></label>
				<div class="form-group">
					<input type="text" class="form-control" name="diaDesde" value="{{$diaDesde}}" placeholder="Día">
                </div>
                <div class="form-group">
                      {!! Form::select('mesDesde', $meses, $mesDesde, ["class"=> "form-control"]) !!}
                </div>
                <div class="form-group">
                      {!! Form::select('annoDesde', $annos, $annoDesde, ["class"=> "form-control"]) !!}
                </div>
                <label style="margin-left: 50px"><strong>HASTA: </strong></label>
				<div class="form-group">
					<input type="text" class="form-control" name="diaHasta" value="{{$diaHasta}}" placeholder="Día">
                </div>
                <div class="form-group">
                      {!! Form::select('mesHasta', $meses, $mesHasta, ["class"=> "form-control"]) !!}
                </div>
                <div class="form-group">
                      {!! Form::select('annoHasta', $annos, $annoHasta, ["class"=> "form-control"]) !!}
                </div>
				<div class="form-group">
					<label><strong>AEROPUERTO: </strong></label>
					{!! Form::select('aeropuerto', $aeropuertos, $aeropuerto, ["class"=> "form-control"]) !!}
				</div>
                <br>
                <button type="submit" class="btn btn-primary">Buscar</button>
                <a class="btn btn-default" href="{{action('ReporteController@getReporteLibroDeVentas')}}">Reset</a>
                {!! Form::close() !!}
            </div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="box box-primary">
            <div class="box-header">
                {!! Form::open(["url" => action("ReporteController@postExportReport"), "id" =>"export-form", "target"=>"_blank"]) !!}
                {!! Form::hidden('table') !!}
                {!! Form::hidden('departamento', $departamento) !!}
                {!! Form::hidden('gerencia', $gerencia) !!}
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

						<div class="table-responsive" style="max-height: 500px">
							<table  class="table table-condensed">
								<thead>
									<tr class="bg-primary" >
										<th class="text-center" align="center" style="vertical-align: middle; width: 50px" >Op. N°</th>
										<th class="text-center" align="center" style="vertical-align: middle; width: 70px" >Fecha</th>
										<th class="text-center" align="center" style="vertical-align: middle; width: 70px">RIF</th>
										<th class="text-center" align="center" style="vertical-align: middle; width: 300px">Nombre o Razón Social</th>
										<th class="text-center" align="center" style="vertical-align: middle; width: 70px">N° Comprobante</th>
										<th class="text-center" align="center" style="vertical-align: middle; width: 70px">N° Factura</th>
										<th class="text-center" align="center" style="vertical-align: middle; width: 70px">N° Control</th>
										<th class="text-center" align="center" style="vertical-align: middle; width: 70px">N° de Nota de Débito</th>
										<th class="text-center" align="center" style="vertical-align: middle; width: 70px">N° de Nota de Crédito</th>
										<th class="text-center" align="center" style="vertical-align: middle; width: 70px">Tipo de Transcc</th>
										<th class="text-center" align="center" style="vertical-align: middle; width: 70px">N° Factura Afectada</th>
										<th class="text-center" align="center" style="vertical-align: middle; width: 100px">Total de Ventas (Incluye IVA)</th>
										<th class="text-center" align="center" style="vertical-align: middle; width: 100px">Ventas Internas No Gravadas</th>
										<th class="text-center" align="center" style="vertical-align: middle; width: 100px">Base Imponible</th>
										<th class="text-center" align="center" style="vertical-align: middle; width: 100px">% Alicuota</th>
										<th class="text-center" align="center" style="vertical-align: middle; width: 100px">Impuesto IVA</th>
										<th class="text-center" align="center" style="vertical-align: middle; width: 100px">IVA Retenido por Comprador</th>
									</tr>
								</thead>
								<tbody>
									@if($facturas->count()>0 || $facturasCobradas->count()>0)
										@foreach($facturasCobradas as $index => $facturaCobrada)
											<tr>
												<td   style="vertical-align: middle; width: 50px" class="text-center" align="center" >{{$index+1}}</td>
												<td   style="vertical-align: middle; width: 70px" class="text-center" align="center" >{{$facturaCobrada->fecha}}</td>
												<td   style="vertical-align: middle; width: 70px" class="text-center" align="center" >{{$facturaCobrada->cliente->cedRifPrefix}}-{{$facturaCobrada->cliente->cedRif}}</td>
												<td   style="vertical-align: middle; width: 300px" class="text-left" align="left"    >{{$facturaCobrada->cliente->nombre}}</td>
												<td   style="vertical-align: middle; width: 70px" class="text-center" align="center" >{{($facturaCobrada->retencionComprobante == 0)?'':$facturaCobrada->retencionComprobante}}</td>
												<td   style="vertical-align: middle; width: 70px" class="text-center" align="center" >{{$facturaCobrada->nFacturaPrefix}}-{{$facturaCobrada->nFactura}}</td>
												<td   style="vertical-align: middle; width: 70px" class="text-center" align="center" >{{$facturaCobrada->nControlPrefix}}-{{$facturaCobrada->nControl}}</td>
												<td   style="vertical-align: middle; width: 70px" class="text-center" align="center" > </td>
												<td   style="vertical-align: middle; width: 70px" class="text-center" align="center" > </td>
												<td   style="vertical-align: middle; width: 70px" class="text-center" align="center" >{{ ($facturaCobrada->deleted_at == null)?'01-reg':'03-anu' }}</td>
												<td   style="vertical-align: middle; width: 70px" class="text-right" align="right"   > </td>
												<td   style="vertical-align: middle; width: 100px" class="text-right totalVentasConIva" align="right"></td>
												<td   style="vertical-align: middle; width: 100px" class="text-right ventasNoGravadas" align="right"></td>
												<td   style="vertical-align: middle; width: 100px" class="text-right baseImponible {{($facturaCobrada->base == $facturaCobrada->total)?'':round((($facturaCobrada->iva)*100)/$facturaCobrada->base)}}" align="right"></td>
												<td   style="vertical-align: middle; width: 100px" class="text-right porcAlicuota" align="right">{{($facturaCobrada->base == $facturaCobrada->total)?'':'16,00'}} </td>
												<td   style="vertical-align: middle; width: 100px" class="text-right impuestoIva {{($facturaCobrada->base == $facturaCobrada->total)?'':round((($facturaCobrada->iva)*100)/$facturaCobrada->base)}}" align="right">0,00</td>
												<td   style="vertical-align: middle; width: 100px" class="text-right ivaRetenido {{($facturaCobrada->base == $facturaCobrada->total)?'':round((($facturaCobrada->iva)*100)/$facturaCobrada->base)}}" align="right">{{($facturaCobrada->base == $facturaCobrada->total)?'':$traductor->format((($facturaCobrada->total-$facturaCobrada->base)*$facturaCobrada->ivapercentage)/100)}}</td>
											</tr>
										@endforeach
										@foreach($facturas as $index2 => $factura)
											<tr>
												<td   style="vertical-align: middle; width: 50px" class="text-center" align="center" align="center">{{$index2+1+$facturasCobradas->count()}}</td>
												<td   style="vertical-align: middle; width: 70px" class="text-center" align="center" align="center">{{$factura->fecha}}</td>
												<td   style="vertical-align: middle; width: 70px" class="text-center formulario-bs" align="left">{{$factura->cliente->cedRifPrefix}}-{{$factura->cliente->cedRif}}</td>
												<td   style="vertical-align: middle; width: 300px" class="text-left aterrizaje-bs" align="left">{{$factura->cliente->nombre}}</td>
												<td   style="vertical-align: middle; width: 70px" class="text-center" align="center" >@foreach($factura->cobros as $pagos){{ ( fechaEsMayor($pagos->fecha, $fecha) == false && $pagos->pivot->retencionComprobante <> 0)?$pagos->pivot->retencionComprobante:''}} @endforeach</td>
												<td   style="vertical-align: middle; width: 70px" class="text-center estacionamiento-bs" align="right">{{$factura->nFacturaPrefix}}-{{$factura->nFactura}}</td>
												<td   style="vertical-align: middle; width: 70px" class="text-center habilitacion-bs" align="right">{{$factura->nControl}}</td>
												<td   style="vertical-align: middle; width: 70px" class="text-center jetway-bs" align="right"> </td>
												<td   style="vertical-align: middle; width: 70px" class="text-center carga-bs" align="right"> </td>
												<td   style="vertical-align: middle; width: 70px" class="text-center" align="center" align="right">{{ ($factura->deleted_at == null)?'01-reg':'03-anu' }}</td>
												<td   style="vertical-align: middle; width: 70px" class="text-right jetway-bs" align="right"> </td>
												@if($factura->deleted_at == null)
													<td   style="vertical-align: middle; width: 100px" class="text-right totalVentasConIva" align="right">{{$traductor->format($factura->total)}}</td>
													<td   style="vertical-align: middle; width: 100px" class="text-right ventasNoGravadas" align="right">{{($factura->iva == 0.0)?$traductor->format($factura->total):''}}</td>
													<td   style="vertical-align: middle; width: 100px" class="text-right baseImponible {{($factura->iva == 0)?'':round((($factura->iva)*100)/$factura->subtotal)}}" align="right">{{($factura->iva == 0.00)?'':$traductor->format($factura->subtotal)}}</td>
													<td   style="vertical-align: middle; width: 100px" class="text-right porcAlicuota" align="right">{{($factura->iva == 0)?'':'16,00'}}</td>
													<td   style="vertical-align: middle; width: 100px" class="text-right impuestoIva {{($factura->iva == 0)?'':round((($factura->iva)*100)/$factura->subtotal)}}" align="right">{{($factura->iva == 0.00)?'':$traductor->format($factura->iva)}}</td>
													<td   style="vertical-align: middle; width: 100px" class="text-right ivaRetenido {{($factura->iva == 0)?'':round((($factura->iva)*100)/$factura->subtotal)}}" align="right">@foreach($factura->cobros as $pagos) {{ ( fechaEsMayor($pagos->fecha, $fecha) == false && $pagos->pivot->retencionComprobante <> 0)?$traductor->format((($pagos->pivot->total-$pagos->pivot->base)*$pagos->pivot->ivapercentage)/100):''}} @endforeach</td>
												@else
													<td   style="vertical-align: middle; width: 100px" class="text-right totalVentasConIva" align="right">0,00</td>
													<td   style="vertical-align: middle; width: 100px" class="text-right ventasNoGravadas" align="right">{{($factura->ivapercentage == '0.0')?'0,00':''}}</td>
													<td   style="vertical-align: middle; width: 100px" class="text-right baseImponible " align="right">{{($factura->ivapercentage != '0.0')?'':'0,00'}}</td>
													<td   style="vertical-align: middle; width: 100px" class="text-right porcAlicuota" align="right">{{($factura->ivapercentage != '0.0')?'':'0,00'}}</td>
													<td   style="vertical-align: middle; width: 100px" class="text-right impuestoIva" align="right">{{($factura->ivapercentage != '0.0')?'':'0,00'}}</td>
													<td   style="vertical-align: middle; width: 100px" class="text-right ivaRetenido" align="right">{{($factura->ivapercentage != '0.0')?'':'0,00'}}</td>
												@endif
											</tr>
										@endforeach
										<tr>
											<td   style="vertical-align: middle; width: 100px" align="left" class="text-left" colspan="11">TOTAL</td>
											<td   style="vertical-align: middle; width: 100px" align="right" class="text-right" id="totalVentasConIvaTotal" align="right">0,00</td>
											<td   style="vertical-align: middle; width: 100px" align="right" class="text-right" id="ventasNoGravadasTotal" align="right">0,00</td>											
											<td   style="vertical-align: middle; width: 100px" align="right" class="text-right" id="baseImponibleTotal" align="right">0,00</td>
											<td   style="vertical-align: middle; width: 100px" align="right" class="text-right"  align="right"></td>
											<td   style="vertical-align: middle; width: 100px" align="right" class="text-right" id="impuestoIvaTotal" align="right">0,00</td>
											<td   style="vertical-align: middle; width: 100px" align="right" class="text-right" id="ivaRetenidoTotal" align="right">0,00</td>
										</tr>
									@else
										<tr>
											<td colspan="18" class="text-center" align="center">No hay registros para los datos suministrados.</td>
										</tr>
									@endif
								</tbody>
								<tfoot>
									
								</tfoot>
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
	$( document ).ready(function() {

		var totalVentasConIva=0;
        $('.totalVentasConIva').each(function(index,value){
            totalVentasConIva+=commaToNum($(value).text().trim());
        });
        $('#totalVentasConIvaTotal').text(numToComma(totalVentasConIva));

		var ventasNoGravadas=0;
        $('.ventasNoGravadas').each(function(index,value){
            ventasNoGravadas+=commaToNum($(value).text().trim());
        });
        $('#ventasNoGravadasTotal').text(numToComma(ventasNoGravadas));

		var baseImponible12=0;
        $(".baseImponible.12").each(function(index,value){
            baseImponible12+=commaToNum($(value).text().trim());
        });
        var baseImponible9=0;
        $('.baseImponible.9').each(function(index,value){
            baseImponible9+=commaToNum($(value).text().trim());
        });
        var baseImponible7=0;
        $('.baseImponible.7').each(function(index,value){
            baseImponible7+=commaToNum($(value).text().trim());
        });
        $('#baseImponibleTotal').text(numToComma(baseImponible12 + baseImponible9 + baseImponible7));

		var porcAlicuota=0;
        $('.porcAlicuota').each(function(index,value){
            porcAlicuota+=commaToNum($(value).text().trim());
        });
        $('#porcAlicuotaTotal').text(numToComma(porcAlicuota));

		var impuestoIva12=0;
        $('.impuestoIva.12').each(function(index,value){
            impuestoIva12+=commaToNum($(value).text().trim());
        });
        var impuestoIva9=0;
        $('.impuestoIva.9').each(function(index,value){
            impuestoIva9+=commaToNum($(value).text().trim());
        });
        var impuestoIva7=0;
        $('.impuestoIva.7').each(function(index,value){
            impuestoIva7+=commaToNum($(value).text().trim());
        });
        $('#impuestoIvaTotal').text(numToComma(impuestoIva12 + impuestoIva9 + impuestoIva7));


		var ivaRetenido12=0;
        $('.ivaRetenido.12').each(function(index,value){
            ivaRetenido12+=commaToNum($(value).text().trim());
        });
        var ivaRetenido9=0;
        $('.ivaRetenido.9').each(function(index,value){
            ivaRetenido9+=commaToNum($(value).text().trim());
        });
        var ivaRetenido7=0;
        $('.ivaRetenido.7').each(function(index,value){
            ivaRetenido7+=commaToNum($(value).text().trim());
        });
        $('#ivaRetenidoTotal').text(numToComma(ivaRetenido12 + ivaRetenido9 + ivaRetenido7));

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
		                            <th colspan="18" style="vertical-align: middle; margin-top:70px" align="center" class="text-center" align="center">LIBRO DE VENTAS\
		                                </br>\
										DESDE: {{$diaDesde}}/{{$mesDesde}}/{{$annoDesde}} HASTA: {{$diaHasta}}/{{$mesHasta}}/{{$annoHasta}}\
										</br> AEROPUERTO: {{$aeropuertoNombre}}\
		                            </th>\
		                        </tr>\
		                    </thead>')
		    $(table).find('thead, th').css({'border-top':'1px solid black', 'font-weight': 'bold', 'text-align':"center", 'font-size': '14px'})
		    $(table).find('th').css({'border-bottom':'1px solid black', 'font-weight': 'bold', 'text-align':"center", 'font-size': '14px'})
		    $(table).find('td').css({'font-size': '12px'})
			$(table).find('tr:nth-child(even)').css({'border-bottom':'1px solid black'})
		    $(table).find('tr:last td').css({'border-bottom':'1px solid black','border-top':'1px solid black', 'font-weight': 'bold'})
	        $(table).append('<tr>\
      						<td colspan="18"><br><br><br></td>\
           			  </tr><tr>\
      						<td colspan="6" align="center" ></td>\
      						<td colspan="5" align="left" ></td>\
      						<td colspan="2" align="right" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">BASE IMPONIBLE</td>\
      						<td colspan="2" align="right" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">DÉBITO FISCAL</td>\
      						<td colspan="3" align="right" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">IVA RETENIDO POR EL COMPRADOR</td>\
           			  </tr><tr>\
      						<td colspan="6" align="center"></td>\
      						<td colspan="5" align="left" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">Total Ventas Internas No Gravadas </td>\
      						<td colspan="2" align="right" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">'+numToComma(ventasNoGravadas)+'</td>\
      						<td colspan="2" align="right" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">0,00</td>\
      						<td colspan="3" align="right" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">0,00</td>\
           			  </tr><tr>\
      						<td colspan="6" align="center"></td>\
      						<td colspan="5" align="left" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">Total Ventas Exportación Afectadas solo Alicuota 12,00</td>\
      						<td colspan="2" align="right" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">0,00</td>\
      						<td colspan="2" align="right" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">0,00</td>\
      						<td colspan="3" align="right" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">0,00</td>\
           			  </tr><tr>\
      						<td colspan="6" align="center"></td>\
      						<td colspan="5" align="left" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">Total Ventas Exportación Afectadas solo Alicuota 9,00</td>\
      						<td colspan="2" align="right" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">0,00</td>\
      						<td colspan="2" align="right" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">0,00</td>\
      						<td colspan="3" align="right" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">0,00</td>\
           			  </tr><tr>\
      						<td colspan="6" align="center"></td>\
      						<td colspan="5" align="left" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">Total Ventas Exportación Afectadas solo Alicuota 7,00</td>\
      						<td colspan="2" align="right" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">0,00</td>\
      						<td colspan="2" align="right" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">0,00</td>\
      						<td colspan="3" align="right" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">0,00</td>\
           			  </tr><tr>\
      						<td colspan="6" align="center"></td>\
      						<td colspan="5" align="left" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;"></td>\
      						<td colspan="2" align="right" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;"></td>\
      						<td colspan="2" align="right" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;"></td>\
      						<td colspan="3" align="right" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;"></td>\
           			  </tr><tr>\
      						<td colspan="6" align="center"></td>\
      						<td colspan="5" align="left" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">Total Ventas Internas Afectadas solo Alicuota 12,00</td>\
      						<td colspan="2" align="right" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">'+numToComma(baseImponible12)+'</td>\
      						<td colspan="2" align="right" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">'+numToComma(impuestoIva12)+'</td>\
      						<td colspan="3" align="right" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">'+numToComma(ivaRetenido12)+'</td>\
           			  </tr><tr>\
      						<td colspan="6" align="center"></td>\
      						<td colspan="5" align="left" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">Total Ventas Internas Afectadas solo Alicuota 9,00</td>\
      						<td colspan="2" align="right" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">'+numToComma(baseImponible9)+'</td>\
      						<td colspan="2" align="right" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">'+numToComma(impuestoIva9)+'</td>\
      						<td colspan="3" align="right" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">'+numToComma(ivaRetenido9)+'</td>\
           			  </tr><tr>\
      						<td colspan="6" align="center"></td>\
      						<td colspan="5" align="left" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">Total Ventas Internas Afectadas solo Alicuota 7,00</td>\
      						<td colspan="2" align="right" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">'+numToComma(baseImponible7)+'</td>\
      						<td colspan="2" align="right" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">'+numToComma(impuestoIva7)+'</td>\
      						<td colspan="3" align="right" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">'+numToComma(ivaRetenido7)+'</td>\
           			  </tr><tr>\
      						<td colspan="6" align="center"></td>\
      						<td colspan="5" align="left" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">TOTALES</td>\
      						<td colspan="2" align="right" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">'+numToComma(ventasNoGravadas + baseImponible12 + baseImponible9 + baseImponible7)+'</td>\
      						<td colspan="2" align="right" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">'+numToComma(impuestoIva12 + impuestoIva9 + impuestoIva7)+'</td>\
      						<td colspan="3" align="right" style="font-weight: bold; border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black; font-size: 12px;">'+numToComma(ivaRetenido12 + ivaRetenido9 + ivaRetenido7)+'</td>\
           			  </tr>')
		    var tableHtml= $(table)[0].outerHTML;
		    $('[name=table]').val(tableHtml);
		    $('#export-form').submit();
		})
	});
</script>
@endsection

