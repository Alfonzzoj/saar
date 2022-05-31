@extends('app')

@section('content')

<ol class="breadcrumb">
    <li><a href="{{url('principal')}}">Inicio</a></li>
    <li><a class="active">Relación de Facturas Cobradas Por Cliente</a></li>
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
            <div class="box-body">
                {!! Form::open(["url" => action('ReporteController@getReporteRelacionFacturasCliente'), "method" => "GET", "class"=>"form-inline"]) !!}
                <div class="form-group ">
                    <label>AEROPUERTO:</label>
                      {!! Form::select('aeropuerto_id', $aeropuertos, $aeropuerto, ["class"=> "form-control select-flt"]) !!}
                </div>
                <div class="form-group">
                
                    <label>CLIENTE:</label>
                      {!! Form::select('cliente_id', $clientes, $cliente, ["class"=> "form-control select-flt"]) !!}
                </div>
                <br>
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
                <label style="margin-left: 20px"><strong>HASTA: </strong></label>
                <div class="form-group">
                    <input type="text" class="form-control" name="diaHasta" value="{{$diaHasta}}" placeholder="Día">
                </div>
                <div class="form-group">
                      {!! Form::select('mesHasta', $meses, $mesHasta, ["class"=> "form-control"]) !!}
                </div>
                <div class="form-group">
                      {!! Form::select('annoHasta', $annos, $annoHasta, ["class"=> "form-control"]) !!}
                </div>
                <br>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary" >Buscar</button>
                    <a class="btn btn-default text-right" href="{{action('ReporteController@getReporteRelacionFacturasCliente')}}">Reset</a>
                </div>
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

                        <div class="table-responsive">
                            <table  class="table table-condensed">
                                <thead>
                                    <tr class="bg-primary" >
                                        <th  style="vertical-align: middle; width: 200px" rowspan="2" colspan="2" class="text-center">CLIENTE</th>
                                        <th  style="vertical-align: middle" colspan="4" class="text-center" >COBRO</th>
                                        <th  style="vertical-align: middle" colspan="3" class="text-center">Concepto</th>
                                        <th  style="vertical-align: middle" colspan="3" class="text-center">DEPÓSITO</th>
                                    </tr>
                                    <tr class="bg-primary" >
                                        <!--cobro -->
                                        <th  style="vertical-align: middle" class="text-center" >Rec. Caja</th>
                                        <th style="vertical-align: middle" class="text-center" >Nro.</th>
                                        <th  style="vertical-align: middle" class="text-center" >Tipo de Pago</th>
                                        <th style="vertical-align: middle" class="text-center" >Fecha</th>
                                        
                                        <!-- Concepto -->
                                        <th style="vertical-align: middle" class="text-center" >Concepto.</th>
                                        <th style="vertical-align: middle" class="text-center" >Total (Bs.)</th>
                                        
                                        <!-- Deposito -->
                                        <th  style="vertical-align: middle" class="text-center" >Banco.</th>
                                        <th style="vertical-align: middle" class="text-center">Ref.</th>
                                        <th style="vertical-align: middle" class="text-center">Fecha</th>
                                        <th style="vertical-align: middle" class="text-center">Monto (Bs.)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($dosaFactura) >0)
                                        @foreach($dosaFactura as $index => $df)
                                            <tr align="center">
                                                <td class="text-left" align="left" rowspan="{{$df['detalle_count']}}" colspan="2" style="width: 200px">{{$df['cliente']}}</td> 

                                                <td class="text-center align-middle" rowspan="{{$df['detalle_count']}}" align="center">{{$df['nCobro']}}</td>                         
                                                <td class="text-center" rowspan="{{$df['detalle_count']}}" align="center">{{$df['reciboCaja']}}</td>                         
                                                <td class="text-center" rowspan="{{$df['detalle_count']}}" align="center">{{$df['condicionPago']}}</td>  
                                                <td class="text-center" rowspan="{{$df['detalle_count']}}" align="center">{{$df['fecha']}}</td>

                                                <td>{{$df['detalle'][0]['concepto']}}</td>
                                                <td class="text-right totalDosa" rowspan="{{$df['detalle_count']}}" align="right">{{$traductor->format($df['totalDosa'])}}</td>
                                                
                                                
                                                <td class="text-center" rowspan="{{$df['detalle_count']}}" align="center">{{$df['banco']}}</td>
                                                <td rowspan="{{$df['detalle_count']}}">{{($df['refBancaria'])?$df['refBancaria']:'N/A'}}</td>   
                                                <td rowspan="{{$df['detalle_count']}}">{{($df['fechaDeposito']!=0)?$df['fechaDeposito']:'N/A'}}</td>                               
                                                <td class="text-right totalDepositado" rowspan="{{$df['detalle_count']}}" align="right">{{($df['totalDepositado']!=0)?$traductor->format($df['totalDepositado']):$traductor->format($df['totalDosa'])}}</td>                               
                                            </tr align="center">  
                                                @for($i = 1; $i<=$df['detalle_count']-1; $i++)                               
                                            <tr align="center">
                                                    <td>{{$df['detalle'][$i]['concepto']}}</td>
                                            </tr>
                                                @endfor   
                                        @endforeach
                                        <tr class="bg-gray" id="Totales" align="center" style="font-weight: bold">
                                            <td colspan="2">TOTAL</td>
                                            <td>  </td>
                                            <td>  </td>
                                            <td>  </td>
                                            <td>  </td>
                                            <td>  </td>
                                            <strong>
                                                <td></td>
                                                <td></td>
                                            </strong>
                                            <td>  </td>                                 
                                            <td>  </td>                                 
                                            <td align="right" id="totalTotal">0,00</td>                           
                                        </tr>
                                        <tr>
                                            <td colspan="16" class="text-right" align="right">CANTIDAD DE FACTURAS:</td>
                                            <td class="text-right" align="right">{{ count($dosaFactura) }}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="17" class="text-center" align="center">No hay registros disponibles.</td>
                                        </tr>
                                    @endif

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

        //Por Aeropuerto
        var totalFormulario=0;
        $('.formularioBs').each(function(index,value){
            totalFormulario+=commaToNum($(value).text().trim());
        });

        var totalAterrizaje=0;
        $('.aterrizajeBs').each(function(index,value){
            totalAterrizaje+=commaToNum($(value).text().trim());
        });


        var totalEstacionamiento=0;
        $('.estacionamientoBs').each(function(index,value){
            totalEstacionamiento+=commaToNum($(value).text().trim());
        });

        var totalHabilitacion=0;
        $('.habilitacionBs').each(function(index,value){
            totalHabilitacion+=commaToNum($(value).text().trim());
        });

        var totalJetway=0;
        $('.jetwayBs').each(function(index,value){
            totalJetway+=commaToNum($(value).text().trim());
        });

        var totalCarga=0;
        $('.cargaBs').each(function(index,value){
            totalCarga+=commaToNum($(value).text().trim());
        });

        var totalOtrosCargos=0;
        $('.otrosCargosBs').each(function(index,value){
            totalOtrosCargos+=commaToNum($(value).text().trim());
        });

        var totalDosa=0;
        $('.totalDosa').each(function(index,value){
            totalDosa+=commaToNum($(value).text().trim());
        });

        $('#totalFormulario').text(numToComma(totalFormulario));
        $('#totalAterrizaje').text(numToComma(totalAterrizaje));
        $('#totalEstacionamiento').text(numToComma(totalEstacionamiento));
        $('#totalHabilitacion').text(numToComma(totalHabilitacion));
        $('#totalJetway').text(numToComma(totalJetway));
        $('#totalCarga').text(numToComma(totalCarga));
        $('#totalOtrosCargos').text(numToComma(totalOtrosCargos));
        $('#totalDosa').text(numToComma(totalDosa));
        $('#totalTotal').text(numToComma(totalDosa));


        $('.select-flt').chosen({width:'400px'});


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
                                    <th colspan="17" style="vertical-align: middle; margin-top:20px" align="center" class="text-center">RELACIÓN DE FACTURAS AERONÁUTICAS COBRADAS CRÉDITO (DETALLADO) \
                                        </br>\
                                        AEROPUERTO: {{$aeropuertoNombre}} \
                                        </br>\
                                        CLIENTE: {{($cliente==0)?"TODOS":$clienteNombre}}\
                                    </th>\
                                </tr>\
                            </thead>')
                $(table).find('thead, th').css({'border-top':'1px solid black', 'font-weight': 'bold', 'text-align':"center", 'font-size': '10px'})
                $(table).find('th').css({'border-bottom':'1px solid black', 'font-weight': 'bold', 'text-align':"center", 'font-size': '10px'})
                $(table).find('td').css({'font-size': '8px'})
                $(table).find('tr:nth-child(even)').css({'border-bottom':'1px solid black','font-weight': 'bold'})

                $(table).find('tr:last td').css({'border-bottom':'1px solid black','border-top':'1px solid black', 'font-weight': 'bold'})
                var tableHtml= $(table)[0].outerHTML;
                $('[name=table]').val(tableHtml);
                $('#export-form').submit();
        })

    })
</script>


@endsection