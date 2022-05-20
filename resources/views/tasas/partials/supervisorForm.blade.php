<script>
    $(document).ready(function()
    {
        $("#total-table tr:odd").css("color", "#000000").css("background-color", "#ffffff");
        $("#total-table tr:even").css("color", "#000000").css("background-color", "#ecf0f5");
        $("#serie-table tr:odd").css("color", "#000000").css("background-color", "#ffffff");
        $("#serie-table tr:even").css("color", "#000000").css("background-color", "#ecf0f5");
        $('thead tr, thead td').css("color", "#ffffff").css("background-color", "#29293d");
        $('disabled').css("color", "#ffffff");
    });

</script>


    <div class="col-md-12 consulta">
        <div class="box box-primary">
            <div class="box-header">

                <div class="row">
                    <div class="col-md-6 col-md-offset-6 text-right">
                        {!! Form::open(["url" => action("TasaController@postExportReport"), "id" =>"export-form", "target"=>"_blank"]) !!}
                        {!! Form::hidden('table') !!}
                        {!! Form::hidden('table2') !!}
                        {!! Form::hidden('table3') !!}
                        {!! Form::hidden('fecha',$fecha) !!}
                        @if($tasaCobro)
                            <button type="button" class="btn btn-danger" id="desconsolidar-btn" data-fecha="{{ $fecha }}" data-taquilla="{{ $taquilla }}">Desconsolidar</button>
                        @endif
                        <button type="button" class="btn btn-primary" id="export-btn">Exportar</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="box-title"><strong>TAQUILLAS</strong></h3>
                    </div>
                    <div class="col-md-offset-4 col-md-2 text-right">
                        <span class="pull-right">Fecha: {{$fecha}}</span>
                    </div>
                </div>
            </div><!-- /.box-header -->


            <!-- form start -->
                    <form data-url="{{action('TasaController@postSupervisor')}}" data-is-supervisor="true">
                        <input type="hidden" name="fecha" value="{{$fecha}}">
                        <input type="hidden" name="taquilla" value="{{$taquilla}}">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="serie-table">
                                <thead>
                                <tr>
                                    <th class="text-right" colspan="2">TURNO</th>
                                    <th class="text-right" colspan="2">TAQUILLA</th>
                                    <th class="text-right" colspan="2">SERIE</th>
                                    <th class="text-right" colspan="4">DESDE</th>
                                    <th class="text-right" colspan="4">HASTA</th>
                                    <th class="text-right" colspan="6">COSTO</th>
                                    <th class="text-right" colspan="4">CANTIDAD</th>
                                    <th class="text-right" colspan="4">TOTAL</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if(count($tasaOpsArray)==0 || count($serieTasas)==0)
                                        <tr><td class="text-center">No se encontraron registros</td></tr>
                                    @else
                                        @foreach($tasaOpsArray as $taquilla => $tasaTaquillaOp)
                                            @foreach($serieTasas as $serie => $serieTotal)
                                                @foreach($tasaTaquillaOp as $turno)
                                                    @foreach($turno->detalles as $detalles => $detalle)
                                                        @if($detalle->serie == $serie)
                                                            <tr>
                                                                <td class="text-right" colspan="2">
                                                                    {{$turno->turno}}
                                                                </td>
                                                                <td class="text-right" colspan="2">
                                                                    {{ $turno->taquilla }}
                                                                </td>
                                                                <td class="text-right" colspan="2">
                                                                    {{ $serie }}
                                                                </td>
                                                                <td class="text-right" colspan="4">
                                                                    {{$detalle->inicio}}
                                                                </td>
                                                                <td class="text-right" colspan="4">
                                                                    {{$detalle->fin}}
                                                                </td>
                                                                <td class="text-right" colspan="6">
                                                                    {{$traductor->format($detalle->costo)}}
                                                                </td>
                                                                <td class="text-right" colspan="4">
                                                                    {{$detalle->cantidad}}
                                                                </td>
                                                                <td class="text-right" colspan="4">
                                                                    {{$traductor->format($detalle->total)}}
                                                                </td>
                                                            </tr>
                                                            @endif
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    @endif

                                    <tr>
                                        <td class="text-right" colspan="2"></td>
                                        <td class="text-right" colspan="2"></td>
                                        <td class="text-right" colspan="2"></td>
                                        <td class="text-right" colspan="4"></td>
                                        <td class="text-right" colspan="4"></td>
                                        <td class="text-right" colspan="6"></td>
                                        <td class="text-right" colspan="4">
                                            TOTAL
                                        </td>
                                        <td class="text-right" colspan="4" id="total">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <h5 class="text-center"><strong>Totales</strong></h5>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="total-table">
                                <thead>
                                <tr>
                                    <th class="text-right" colspan="4">SERIE</th>
                                    <th class="text-right" colspan="6">CANTIDAD</th>
                                    <th class="text-right" colspan="6">TOTAL</th>
                                </tr>
                                </thead>
                                <tbody>

                                    @foreach($serieTasas as $serie => $serieTotal)
                                                    <tr>
                                                        <td class="text-right totales-cantidad" colspan="4">
                                                            {{ $serie }}
                                                        </td>
                                                        <td class="text-right totales-cantidad" colspan="6">
                                                            {{$serieTotal['cantidad']}}
                                                        </td>
                                                        <td class="text-right totales-tasas" id="total" colspan="6">
                                                            {{$traductor->format($serieTotal['monto'])}}
                                                        </td>
                                                    </tr>
                                        @endforeach
                                    <tr>
                                        <td class="text-right" colspan="4"></td>
                                        <td class="text-right" colspan="6">
                                            TOTAL
                                        </td>
                                        <td class="text-right" colspan="6" id="total-serie">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <h5 class="box-title">Formas de Pago</h5>
                @if(!$tasaCobro)
                <div class="row">
                    <div class="col-xs-12 text-right">
                        <button type="button" class="btn btn-primary register-payment-btn"><span class="glyphicon glyphicon-plus"></span> Registrar Pago</button>
                    </div>
                </div>
                @endif
                <div class="table-responsive" style="margin-top:15px;margin-bottom:15px">
                    <table id="formas-pago-table" class="table table-condensed text-center">
                        <thead class="bg-primary">
                            <th>Fecha</th>
                            <th>Banco</th>
                            <th>Cuenta</th>
                            <th>Forma de Pago</th>
                            <th>#Depósito/#Lote</th>
                            <th>Monto</th>
                            <th>Acción</th>
                        </thead>
                        <tbody>
                            @if($tasaCobro && $tasaCobro->detalles->count()>0)
                                @foreach($tasaCobro->detalles as $pago)
                                    <tr>
                                        <td>{{$pago->fecha}}</td>
                                        <td>{{$pago->banco->nombre}}</td>
                                        <td>{{$pago->cuenta->descripcion}}</td>
                                        <td>{{$pago->tipo}}</td>
                                        <td>{{$pago->ncomprobante}}</td>
                                        <td>{{$traductor->format($pago->monto)}}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="total-a-pagar-doc-input" class="col-sm-2 control-label">Total a Cobrar</label>
                                <div class="col-sm-2">
                                    <input autocomplete="off" type="text" class="form-control total-a-pagar-doc-input" readonly value="0,00">
                                </div>
                                <label for="total-diferencia-doc-input" class="col-sm-2 control-label">Diferencia</label>
                                <div class="col-sm-2">
                                    <input autocomplete="off" type="text" class="form-control" id="total-diferencia-doc-input" readonly value="0,00">
                                </div>
                                <label for="total-a-depositar-doc-input" class="col-sm-2 control-label">Total Depositado</label>
                                <div class="col-sm-2">
                                    <input autocomplete="off" type="text" class="form-control" id="total-a-depositar-doc-input" readonly value="0,00">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(!$tasaCobro)
                <div class="row">
                    <div class="col-md-6 col-md-offset-6 text-right">
                        <button type="button" class="consolidar-tasa-btn btn btn-success">Consolidar</button>
                    </div>
                </div>
                @endif
                </form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>

    @if(!$tasaCobro)
        @foreach ($tasaOps as $tasa)
            @include('tasas.partials.taquillaForm', [
                'tasaOp'       => $tasa,
                'fecha'        => \Carbon\Carbon::createFromFormat('Y-m-d', $tasa->fecha)->format('d/m/Y'),
                'taquilla'     => $tasa->taquilla,
                'turno'        => $tasa->turno,
                'tasas'        => $tasas,
                'aeropuerto'   => $aeropuerto,
                'isSupervisor' => true
            ])
        @endforeach
    @endif
<script>

    $('#desconsolidar-btn').on('click', function(e){
        e.preventDefault();
        var fecha = $(this).data('fecha');
        var taquilla = $(this).data('taquilla');
        console.log(fecha);
        alertify.confirm('¿Desea Desconsolidar este dia?' , function(e){
            if(e){  
                $.ajax({
                    type: 'DELETE',
                    url: "{{ url('tasas/desconsolidar') }}",
                    data: {fecha: fecha, taquilla: taquilla},
                    success: function(data){
                        console.log(data);
                        alertify.success('Dia desconsolidado satisfactoriamente');
                    },
                    error: function(data){
                         console.log(data);
                        alertify.error('Ocurrio un error eliminando la meta');
                    },
                });
                
            }
        }); 
    });


    $('#export-btn').click(function(e){
        if ($('#formas-pago-table tr').length > 1 && $('#formas-pago-table thead th').length > 6) $("#formas-pago-table th:last-child, #formas-pago-table td:last-child").remove();
        var table=$('#serie-table').clone();
        var table2=$('#total-table').clone();
        var table3=$('#formas-pago-table').clone();
        var total = $('#total').text();

        $(table).find('td, th').filter(function() {
            return $(this).css('display') == 'none';
        }).remove();
        $(table).find('tr').filter(function() {
            return $(this).find('td,th').length == 0;
        }).remove();
        $(table2).find('td, th').filter(function() {
            return $(this).css('display') == 'none';
        }).remove();
        $(table2).find('tr').filter(function() {
            return $(this).find('td,th').length == 0;
        }).remove();
        $(table3).find('td, th').filter(function() {
            return $(this).css('display') == 'none';
        }).remove();
        $(table3).find('tr').filter(function() {
            return $(this).find('td,th').length == 0;
        }).remove();

        //$(table).find('tr:last').append('<tr> <td>Total</td>  <td></td>  <td></td>  <td></td>  <td></td>  <td></td>  <td></td>  <td>' + total + '</td> </tr>')
        $(table).find('thead, th').css({'border-bottom':'1px solid black', 'font-weight': 'bold', 'text-align':"center", 'font-size': '14px', 'color':"#000000", "background-color": "#ffffff"});
        $(table).find('td').css({'width': '100px','font-size': '12px', 'text-align':"center", 'color':"#000000", "background-color": "#ffffff"});
        $(table).find('td:nth-child( 6 )').css({'text-align':"right"});
        $(table).find('td:last-child').css({'text-align':"right"});
        $(table).find('tr:last-child').css({'font-weight': 'bold'});


        $(table2).find('thead, th').css({'border-bottom':'1px solid black', 'font-weight': 'bold', 'text-align':"center", 'font-size': '14px', 'color':"#000000", "background-color": "#ffffff"});
        $(table2).find('td').css({'width': '80px', 'font-size': '12px', 'text-align':"center", 'color':"#000000", "background-color": "#ffffff"});
        $(table2).find('td:last-child').css({'text-align':"right"});

        console.log($(table3).find("thead, th").length);
        if ($(table3).find("thead, th").length < 8) $(table3).find('tr:last').after('<tr> <td></td> <td></td> <td></td> <td></td> <strong><td>TOTAL</td> <td>' + $('.total-a-pagar-doc-input').val()  + '</td></strong></tr>');
        $(table3).find('thead, th').css({'border-bottom':'1px solid black', 'font-weight': 'bold', 'text-align':"center", 'font-size': '14px', 'color':"#000000", "background-color": "#ffffff"});
        $(table3).find('td').css({'width': '130px','font-size': '12px', 'text-align':"center", 'color':"#000000", "background-color": "#ffffff"});
        $(table3).find('td:last-child').css({'text-align':"right"});


        var tableHtml= $(table)[0].outerHTML;
        var tableHtml2= $(table2)[0].outerHTML;
        var tableHtml3= $(table3)[0].outerHTML;
        $('[name=table]').val(tableHtml);
        if ($('#total-table tr').length > 1) $('[name=table2]').val(tableHtml2);
        if ($('#formas-pago-table tr').length > 1) $('[name=table3]').val(tableHtml3);

        $('#export-form').submit();
    })
</script>