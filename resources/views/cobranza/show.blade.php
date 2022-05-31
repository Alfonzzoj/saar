@extends('app')

@section('script')
    <script>
        $(function(){
            $('#export-btn').click(function(e){
                var table=$('table').clone();
                $(table).find('td, th').filter(function() {
                    return $(this).css('display') == 'none';
                }).remove();
                $(table).find('tr').filter(function() {
                    return $(this).find('td,th').length == 0;
                }).remove();

                $(table).prepend('<thead> <tr>' +
                                    '<th align="left" colspan="15" >' +
                                    '<div style="font-weight: normal"><strong>NRO. COBRO: </strong> {{$cobro->id}} </div>' +
                                    '<div style="font-weight: normal"><strong>CLIENTE: </strong>{{$cobro->cliente->codigo}} | {{$cobro->cliente->nombre}}</div>' +
                                    '<div style="font-weight: normal"><strong>NRO. RECIBO DE CAJA: </strong> {{($cobro->nRecibo)?$cobro->nRecibo:"No Dispone"}} </div>' +
                                    '<div style="font-weight: normal"><strong>FECHA DE COBRO: </strong> {{($cobro->fecha=='30/11/-0001')?$cobro->created_at:$cobro->fecha}} </div>' +
                                    '<div style="font-weight: normal"><strong>OBSERVACIONES: </strong> {{($cobro->observacion)?$cobro->observacion:"No Dispone"}} </div>' +
                                    '<div style="font-weight: normal"><strong>RECAUDOS CONSIGNADOS: </strong> {{($cobro->hasrecaudos)?"Si":"No"}} </div>' +
                                    '</br>' +
                                    '</th>'+
                                '</tr> </thead>');
                $(table).find('thead, th').css({'border-top':'1px solid black', 'font-weight': 'bold', 'text-align':"center", 'font-size': '12px'})
                $(table).find('th').css({'border-bottom':'1px solid black', 'font-weight': 'bold', 'text-align':"center",  'font-size': '12px'})
                $(table).find('td').css({'font-size': '10px'})
                $(table).find('tr:nth-child(even)').css({'border-bottom':'1px solid black'})
                $(table).find('tr:last td').css({'border-bottom':'1px solid black','border-top':'1px solid black', 'font-weight': 'bold'})
                var tableHtml= $(table)[0].outerHTML;
                $('[name=table]').val(tableHtml);
                $('#export-form').submit();
            });
        });
    </script>
@endsection


@section('content')
<ol class="breadcrumb">
  <li><a href="{{url('principal')}}">Inicio</a></li>
  <li><a href="{{ URL::to('cobranza/Todos/main') }}">Cobranza</a></li>
  <li><a href="{{ action('CobranzaController@index', [$moduloNombre]) }}">Cobranza - {{$moduloNombre}}</a></li>
  <li><a class="active">Cobranza {{$cobro->id}}</a></li>
</ol>

<div class="row" id="box-wrapper">

    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header">
            {!! Form::open(["url" => action("ReporteController@postExportReport"), "id" =>"export-form", "target"=>"_blank"]) !!}
            {!! Form::hidden('table') !!}
            <span class="pull-right">
                <button type="button" class="btn btn-primary" id="export-btn">
                    <span class="glyphicon glyphicon-file"></span> Exportar
                </button>
            </span>
            {!! Form::close() !!}
        </div>
        <!-- form start -->
        <div class="box-body">
            <h6 style="font-weight: bold;">NRO. COBRO: <label>{{$cobro->id}}</label> </h6> 
            <h6 style="font-weight: bold;">CLIENTE: <label>{{$cobro->cliente->codigo}} | {{$cobro->cliente->nombre}}</label> </h6> 
            <h6 style="font-weight: bold;">NRO. RECIBO DE CAJA: <label>{{($cobro->nRecibo)?$cobro->nRecibo:"No Dispone"}}</label> </h6> 
            <h6 style="font-weight: bold;">FECHA DE COBRO: <label>{{($cobro->fecha=='30/11/-0001')?$cobro->created_at:$cobro->fecha}}</label> </h6> 
                <h6 style="font-weight: bold;">OBSERVACIONES:  <label>{{($cobro->observacion)?$cobro->observacion:"No Dispone"}}</label> </h6> 
                <h6 style="font-weight: bold;">RECAUDOS CONSIGNADOS:  <label> {{($cobro->hasrecaudos)?"Si":"No"}}</label> </h6> 

                <div class="table-responsive">
                    <table class="table table-condensed" >
                        <thead  class="bg-primary">
                            <tr>
                                <th align="center" class="text-center" colspan="3" style="width: 230px; vertical-align: middle">FACTURA</th>
                                <th align="center" class="text-center" colspan="2" style="width: 140px; vertical-align: middle">COMPROBANTE DE RETENCIÓN</th>
                                <th align="center" class="text-center" colspan="3" style="width: 220px; vertical-align: middle">FACTURA (Bs.)</th>
                                <th align="center" class="text-center" colspan="5" style="width: 330px; vertical-align: middle">RETENCIÓN (Bs.)</th>
                                <th align="center" class="text-center" colspan="2" style="width: 160px; vertical-align: middle">COBRO (Bs.)</th>
                            </tr>
                            <tr>
                                <th align="center" class="text-center" style="width: 70px">Fecha</th>
                                <th align="center" class="text-center" style="width: 80px">Nro. Factura</th>
                                <th align="center" class="text-center" style="width: 80px">Nro. Control</th>

                                <th align="center" class="text-center" style="width: 70px">Fecha</th>
                                <th align="center" class="text-center" style="width: 70px">Número</th>

                                <th align="center" class="text-center" style="width: 80px">Base</th>
                                <th align="center" class="text-center" style="width: 60px">IVA</th>
                                <th align="center" class="text-center" style="width: 80px">Total</th>

                                <th align="center" class="text-center" style="width: 60px">% IVA</th>
                                <th align="center" class="text-center" style="width: 70px">IVA (Bs.)</th>
                                <th align="center" class="text-center" style="width: 60px">% ISLR</th>
                                <th align="center" class="text-center" style="width: 60px">ISLR (Bs.)</th>
                                <th align="center" class="text-center" style="width: 80px">Total (Bs.)</th>

                                <th align="center" class="text-center" style="width: 80px">Por Cobrar</th>
                                <th align="center" class="text-center" style="width: 80px">Cobrado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cobro->facturas as $factura)
                            <tr>
                                <td align="center" style="width: 70px">{{$factura->fecha}}</td>
                                <td align="center" style="width: 80px">{{$factura->nFacturaPrefix}}-{{$factura->nFactura}}</td>
                                <td align="center" style="width: 80px">{{$factura->nControlPrefix}}-{{$factura->nControl}}</td>
                                
                                <td align="center" style="width: 70px">{{$factura->pivot->retencionFecha}}</td>
                                <td align="center" style="width: 70px">{{$factura->pivot->retencionComprobante}}</td>                                
                                
                                <td align="right" style="width: 80px">{{$traductor->format($factura->pivot->base)}}</td>
                                <td align="right" style="width: 60px">{{$traductor->format($factura->iva)}}</td>
                                <td align="right" style="width: 80px">{{$traductor->format($factura->pivot->total)}}</td>

                                <td align="right" style="width: 60px">{{$traductor->format($factura->pivot->ivapercentage)}}</td>
                                <td align="right" style="width: 70px">{{$traductor->format((($factura->pivot->ivapercentage)/100)*$factura->pivot->iva)}}</td>
                                <td align="right" style="width: 60px">{{$traductor->format($factura->pivot->islrpercentage)}}</td>
                                <td align="right" style="width: 60px">{{$traductor->format((($factura->pivot->islrpercentage)/100)*($factura->pivot->base))}}</td>
                                <td align="right" style="width: 80px">{{$traductor->format($factura->pivot->retencion)}}</td>
                                
                                <td align="right" style="width: 80px">{{$traductor->format(($factura->pivot->total)-($factura->pivot->retencion))}}</td>
                                <td align="right" style="width: 80px">{{$traductor->format($factura->pivot->monto)}}</td>
                            </tr>
                            @endforeach
                            <tr><td colspan="15"> </td></tr>
                            <tr class="footer-table" id="inicio-footer">
                                <td colspan="10"> </td>
                                <td align="left" colspan="4"><strong>TOTAL FACTURAS</strong></td>
                                <td align="right">{{$traductor->format($cobro->montofacturas)}}</td>                                   
                            </tr>
                            <tr class="footer-table">
                                <td colspan="10"> </td>
                                <td align="left" colspan="4"><strong>TOTAL DEPOSITADO</strong></td>
                                <td align="right">{{$traductor->format($totalDepositado)}}</td>                                   
                            </tr>
                            <tr class="footer-table">
                                <td colspan="10"> </td>
                                <td align="left" colspan="4"><strong>AJUSTE APLICADO</strong></td>
                                <td align="right">{{$traductor->format($totalAjuste)}}</td>                                   
                            </tr>
                            <tr class="footer-table">
                                <td colspan="10"> </td>
                                <td align="left" colspan="4"><strong>SALDO A FAVOR</strong></td>
                                <td align="right">{{$traductor->format(($totalDepositado+$totalAjuste) -$cobro->montofacturas)}}</td>                                 
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>




</div>
@endsection
