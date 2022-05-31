@extends('app')

@section('content')
<ol class="breadcrumb">
  <li><a href="{{url('principal')}}">Inicio</a></li>
  <li><a class="active">Reporte Listado Facturas Emitidas</a></li>
</ol>
<div class="row" id="box-wrapper">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Filtros</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div><!-- /.box-tools -->
            </div>
            <div class="box-body">
                {!! Form::open([
                    "url" => action('ReporteController@getReporteListadoFacturas'),
                    "method" => "POST",
                    "class" => "form-horizontal"]) !!}
                    <div class="form-group">
                        <label class="col-md-1 control-label"><strong>Aeropuerto</strong></label>
                        <div class="col-md-6">
                            {!! Form::select('aeropuerto', $aeropuertos, isset($aeropuerto)?$aeropuerto:null, ["class"=> "form-control", "autocomplete" => "off"]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-1 control-label"><strong>Modulo</strong></label>
                        <div class="col-md-6">
                            <select autocomplete="off" class="form-control" id="modulo-select" name="modulo">
                                @foreach($modulos as $m)
                                <option data-aeropuerto="{{$m->aeropuerto->id}}" value="{{$m->id}}" @if(isset($modulo) && $modulo==$m->id) selected="selected" @endif >{{$m->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-1 control-label"><strong>Período</strong></label>
                        <div class="col-md-4">
                            {!! Form::text('desde', isset($desde)?$desde:null, ["class"=> "form-control datepicker",  "data-inputmask"=>"'alias': 'dd/mm/yyyy'" ,"placeholder" => "Desde", "autocomplete" => "off"]) !!}
                        </div>
                        <label class="col-md-1 text-center" style="padding-top:10px"><strong>-</strong></label>
                        <div class="col-md-4">
                            {!! Form::text('hasta', isset($hasta)?$hasta:null, ["class"=> "form-control datepicker",  "data-inputmask"=>"'alias': 'dd/mm/yyyy'" ,"placeholder" => "Hasta", "autocomplete" => "off"]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-1 control-label"><strong>#Factura</strong></label>
                        <div class="col-md-6">
                            {!! Form::text('nFactura', isset($nFactura)?$nFactura:null, ["class"=> "form-control", "placeholder" => "Número de Factura", "autocomplete" => "off"]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-1 control-label"><strong>Cliente</strong></label>
                        <div class="col-md-6">
                            <select class="form-control" id="cliente-select" name="cliente_id" autocomplete="off">                                <option value="">--Seleccione una opcion--</option>
                                @foreach($clientes as $cliente)
                                <option
                                    value="{{$cliente->id}}">
                                    {{$cliente->codigo}} | {{$cliente->nombre}}
                                </option>
                                @endforeach    
                            </select>                   
                        </div>
                    </div>
                <div class="form-group">
                    <label class="col-md-1 control-label"><strong>Estatus</strong></label>
                    <div class="col-md-6">
                        {!! Form::select('estatus', [
                            "%" => "Todas",
                            "C" => "Cobradas",
                            "P" => "Por Cobrar",
                            "A" => "Anuladas",
                            "V" => "Vencidas"
                            ], isset($estatus)?$estatus:null, ["class"=> "form-control", "autocomplete" => "off"]) !!}
                        </div>
                    </div>
                    <div class="form-group" style="margin-right: 20px">
                        <a class="btn btn-default pull-right" href="{{action('ReporteController@getReporteListadoFacturas')}}">Reset</a>
                        <button type="submit" class="btn btn-primary pull-right">Buscar</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        @if(isset($facturas))
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    {!! Form::open(["url" => action("ReporteController@postExportReport"), "id" =>"export-form", "target"=>"_blank"]) !!}
                    {!! Form::hidden('table') !!}
                    {!! Form::hidden('gerencia', $gerencia) !!}
                    {!! Form::hidden('departamento', $departamento) !!}
                    <span class="pull-right"><button class="btn btn-primary" id="export-btn"><span class="glyphicon glyphicon-file"></span> Exportar</button></span>
                    {!! Form::close() !!}
                </div>
                <div class="box-body" >
                    <div class="row">
                        <div class="col-xs-12">

                            <div class="table-responsive">
                               <table class="table table-hover table-condensed">
                                   <thead  class="bg-primary">
                                       <tr>
                                        <th style="vertical-align: middle; width:40px" align="center" class="text-center">
                                            Nro.
                                        </th>
                                        <th style="vertical-align: middle; width:80px" align="center" class="text-center">
                                            Fecha
                                        </th>
                                        <th style="vertical-align: middle; width:80px" align="center" class="text-center">
                                            Nro. Factura
                                        </th>
                                        <th style="vertical-align: middle; width:80px" align="center" class="text-center">
                                            Nro. Control
                                        </th>
                                        <th style="vertical-align: middle; width:60px" align="center" class="text-center">
                                            RIF
                                        </th>
                                        <th style="vertical-align: middle; width:50px" align="center" class="text-center">
                                            Código
                                        </th>
                                        <th style="vertical-align: middle; width:250px" align="center" class="text-center">
                                            Nombre ó Razón Social
                                        </th>
                                        <th style="vertical-align: middle; width:250px" align="center"  class="text-center">
                                            Descripción
                                        </th>
                                        <th style="vertical-align: middle; width:120px" align="center" class="text-center">
                                            Sub-Total
                                        </th>
                                        <th style="vertical-align: middle; width:120px" align="center" class="text-center">
                                            IVA
                                        </th>
                                        <th style="vertical-align: middle; width:120px" align="center" class="text-center">
                                            Monto
                                        </th>
                                        <th style="vertical-align: middle; width:120px" align="center" class="text-center">
                                            Saldo Deudor
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($facturas)>0)
                                    @foreach($listadoModulo as $nombreModulo)
                                    @if($nombreModulo->nombre  != 'TASAS')
                                    <tr>
                                       <td colspan="12" class="text-center bg-gray" align="center"><strong>{{ $nombreModulo->nombre }}</strong></td>   
                                   </tr>
                                   @foreach($facturas as $index => $factura)
                                   @if($factura->modulo_id == $nombreModulo->id )
                                   <tr>
                                    <td style="vertical-align: middle; width:40px" align="center">{{$index+1}}</td>
                                    <td style="vertical-align: middle; width:80px" align="center">{{$factura->fecha}}</td>
                                    <td style="vertical-align: middle; width:80px" align="center" >{{$factura->nFacturaPrefix}}-{{$factura->nFactura}}</td>
                                    <td style="vertical-align: middle; width:80px" align="center" >{{$factura->nControlPrefix}}-{{$factura->nControl}}</td>
                                    <td style="vertical-align: middle; width:60px" align="center" >{{$factura->cliente->cedRifPrefix}}-{{$factura->cliente->cedRif}}</td>
                                    <td style="vertical-align: middle; width:50px" align="center" >{{$factura->cliente->codigo}}</td>
                                    <td style="vertical-align: middle; width:250px" align="left" >{{$factura->cliente->nombre}}</td>
                                    <td style="vertical-align: middle; width:250px" align="left">{{$factura->descripcion}}</td>
                                    <td style="vertical-align: middle; width:120px" align="right" class="{{ studly_case($nombreModulo->nombre) }}-subtotal">{{$traductor->format($factura->subtotal)}}</td>
                                    {{--@if(!$factura->metadata)--}}
                                    <td style="vertical-align: middle; width:120px" align="right" class="{{ studly_case($nombreModulo->nombre) }}-iva">{{$traductor->format($factura->iva)}}</td>
                                    {{--@els        e--}}
                                    {{--<td style="vertical-align: middle; width:60px" align="right">{{$factura->metadata->ivapercentage}}</td>--}}
                                    {{--<td style="vertical-align: middle; width:60px" align="right">{{$factura->metadata->islrpercentage}}</td>--}}
                                    {{--@endif--}}
                                    <td style="vertical-align: middle; width:120px" align="right" class="{{ studly_case($nombreModulo->nombre) }}-total">{{$traductor->format($factura->total)}}</td>
                                    <td style="vertical-align: middle; width:120px" align="right" class="{{ studly_case($nombreModulo->nombre) }}-totalDeudor deuda">{{($factura->estado=='P')?$traductor->format($factura->total):'0,00'}}</td>
                                </tr>
                                    @endif
                                    @endforeach
                                    <tr class="bg-gray">
                                        <td colspan="3" align="left" class="text-left"><strong>TOTAL {{ $nombreModulo->nombre }}</strong></td>
                                        <td> - </td>
                                        <td> -  </td>
                                        <td> - </td>
                                        <td> - </td>
                                        <td> - </td>
                                        <td style="vertical-align: middle; width:120px; font-weight: bold" class="text-right" align="right" id="{{ studly_case($nombreModulo->nombre) }}-subtotalTotal">0,00</td>
                                        <td style="vertical-align: middle; width:120px; font-weight: bold" class="text-right" align="right" id="{{ studly_case($nombreModulo->nombre) }}-ivaTotal">0,00</td>
                                        <td style="vertical-align: middle; width:120px; font-weight: bold" class="text-right" align="right" id="{{ studly_case($nombreModulo->nombre) }}-totalTotal">0,00</td>
                                        <td style="vertical-align: middle; width:120px; font-weight: bold" class="text-right totalDeudor" align="right" id="{{ studly_case($nombreModulo->nombre) }}-totalDeudorTotal">0,00</td>                                   
                                    </tr>
                                    @endif
                                    @endforeach    
                                    <tr class="bg-gray">
                                        <td colspan="3" align="left" class="text-left"><strong>TOTAL</strong></td>
                                        <td> - </td>
                                        <td> -  </td>
                                        <td> - </td>
                                        <td> - </td>
                                        <td> - </td>
                                        <td style="vertical-align: middle; width:120px; font-weight: bold" class="text-right" align="right">{{$traductor->format($subtotal)}}</td>
                                        <td style="vertical-align: middle; width:120px; font-weight: bold" class="text-right" align="right">{{$traductor->format($iva)}}</td>
                                        <td style="vertical-align: middle; width:120px; font-weight: bold" class="text-right" align="right">{{$traductor->format($total)}}</td>
                                        <td style="vertical-align: middle; width:120px; font-weight: bold" class="text-right" align="right" id="totalDeudor">0,00</td>                                   
                                    </tr> 
                                    @else
                                    <tr>
                                        <td colspan="12" class="text-center" align="center">No hay registros para los parámetros seleccionados</td>
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
    @endif
</div>


@endsection

@section('script')
<script>
    $(function(){


        var canonSubtotal=0;
        $('.CANON-subtotal').each(function(index,value){
            canonSubtotal+=commaToNum($(value).text().trim());
        });

        var canonIva=0;
        $('.CANON-iva').each(function(index,value){
            canonIva+=commaToNum($(value).text().trim());
        });

        var canonTotal=0;
        $('.CANON-total').each(function(index,value){
            canonTotal+=commaToNum($(value).text().trim());
        });

        var canonTotalDeudor=0;
        $('.CANON-totalDeudor').each(function(index,value){
            canonTotalDeudor+=commaToNum($(value).text().trim());
        });


        $('#CANON-subtotalTotal').text(numToComma(canonSubtotal));
        $('#CANON-ivaTotal').text(numToComma(canonIva));
        $('#CANON-totalTotal').text(numToComma(canonTotal));
        $('#CANON-totalDeudorTotal').text(numToComma(canonTotalDeudor));

    //DOSAS
    var dosasSubtotal=0;
    $('.DOSAS-subtotal').each(function(index,value){
        dosasSubtotal+=commaToNum($(value).text().trim());
    });

    var dosasIva=0;
    $('.DOSAS-iva').each(function(index,value){
        dosasIva+=commaToNum($(value).text().trim());
    });

    var dosasTotal=0;
    $('.DOSAS-total').each(function(index,value){
        dosasTotal+=commaToNum($(value).text().trim());
    });

    var dosasTotalDeudor=0;
    $('.DOSAS-totalDeudor').each(function(index,value){
        dosasTotalDeudor+=commaToNum($(value).text().trim());
    });


    $('#DOSAS-subtotalTotal').text(numToComma(dosasSubtotal));
    $('#DOSAS-ivaTotal').text(numToComma(dosasIva));
    $('#DOSAS-totalTotal').text(numToComma(dosasTotal));
    $('#DOSAS-totalDeudorTotal').text(numToComma(dosasTotalDeudor));

    //ESTACIONAMIENTO
    var estacionamientoSubtotal=0;
    $('.ESTACIONAMIENTO-subtotal').each(function(index,value){
        estacionamientoSubtotal+=commaToNum($(value).text().trim());
    });

    var estacionamientoIva=0;
    $('.ESTACIONAMIENTO-iva').each(function(index,value){
        estacionamientoIva+=commaToNum($(value).text().trim());
    });

    var estacionamientoTotal=0;
    $('.ESTACIONAMIENTO-total').each(function(index,value){
        estacionamientoTotal+=commaToNum($(value).text().trim());
    });

    var estacionamientoTotalDeudor=0;
    $('.ESTACIONAMIENTO-totalDeudor').each(function(index,value){
        estacionamientoTotalDeudor+=commaToNum($(value).text().trim());
    });


    $('#ESTACIONAMIENTO-subtotalTotal').text(numToComma(estacionamientoSubtotal));
    $('#ESTACIONAMIENTO-ivaTotal').text(numToComma(estacionamientoIva));
    $('#ESTACIONAMIENTO-totalTotal').text(numToComma(estacionamientoTotal));
    $('#ESTACIONAMIENTO-totalDeudorTotal').text(numToComma(estacionamientoTotalDeudor));

    //CARGA
    var cargaSubtotal=0;
    $('.CARGA-subtotal').each(function(index,value){
        cargaSubtotal+=commaToNum($(value).text().trim());
    });

    var cargaIva=0;
    $('.CARGA-iva').each(function(index,value){
        cargaIva+=commaToNum($(value).text().trim());
    });

    var cargaTotal=0;
    $('.CARGA-total').each(function(index,value){
        cargaTotal+=commaToNum($(value).text().trim());
    });

    var cargaTotalDeudor=0;
    $('.CARGA-totalDeudor').each(function(index,value){
        cargaTotalDeudor+=commaToNum($(value).text().trim());
    });


    $('#CARGA-subtotalTotal').text(numToComma(cargaSubtotal));
    $('#CARGA-ivaTotal').text(numToComma(cargaIva));
    $('#CARGA-totalTotal').text(numToComma(cargaTotal));
    $('#CARGA-totalDeudorTotal').text(numToComma(cargaTotalDeudor));

    //PUBLICIDAD
    var publicidadSubtotal=0;
    $('.PUBLICIDAD-subtotal').each(function(index,value){
        publicidadSubtotal+=commaToNum($(value).text().trim());
    });

    var publicidadIva=0;
    $('.PUBLICIDAD-iva').each(function(index,value){
        publicidadIva+=commaToNum($(value).text().trim());
    });

    var publicidadTotal=0;
    $('.PUBLICIDAD-total').each(function(index,value){
        publicidadTotal+=commaToNum($(value).text().trim());
    });

    var publicidadTotalDeudor=0;
    $('.PUBLICIDAD-totalDeudor').each(function(index,value){
        publicidadTotalDeudor+=commaToNum($(value).text().trim());
    });


    $('#PUBLICIDAD-subtotalTotal').text(numToComma(publicidadSubtotal));
    $('#PUBLICIDAD-ivaTotal').text(numToComma(publicidadIva));
    $('#PUBLICIDAD-totalTotal').text(numToComma(publicidadTotal));
    $('#PUBLICIDAD-totalDeudorTotal').text(numToComma(publicidadTotalDeudor));

    //PUBLICIDAD
    var tarjIdentSubtotal=0;
    $('.TARJETASDEIDENTIFICACION-subtotal').each(function(index,value){
        tarjIdentSubtotal+=commaToNum($(value).text().trim());
    });

    var tarjIdentIva=0;
    $('.TARJETASDEIDENTIFICACION-iva').each(function(index,value){
        tarjIdentIva+=commaToNum($(value).text().trim());
    });

    var tarjIdentTotal=0;
    $('.TARJETASDEIDENTIFICACION-total').each(function(index,value){
        tarjIdentTotal+=commaToNum($(value).text().trim());
    });

    var tarjIdentTotalDeudor=0;
    $('.TARJETASDEIDENTIFICACION-totalDeudor').each(function(index,value){
        tarjIdentTotalDeudor+=commaToNum($(value).text().trim());
    });


    $('#TARJETASDEIDENTIFICACION-subtotalTotal').text(numToComma(tarjIdentSubtotal));
    $('#TARJETASDEIDENTIFICACION-ivaTotal').text(numToComma(tarjIdentIva));
    $('#TARJETASDEIDENTIFICACION-totalTotal').text(numToComma(tarjIdentTotal));
    $('#TARJETASDEIDENTIFICACION-totalDeudorTotal').text(numToComma(tarjIdentTotalDeudor));

    //OTROSINGRESOSAERONÁUTICOS
    var otrosIngAeroSubtotal=0;
    $('.OTROSINGRESOSAERONÁUTICOS-subtotal').each(function(index,value){
        otrosIngAeroSubtotal+=commaToNum($(value).text().trim());
    });

    var otrosIngAeroIva=0;
    $('.OTROSINGRESOSAERONÁUTICOS-iva').each(function(index,value){
        otrosIngAeroIva+=commaToNum($(value).text().trim());
    });

    var otrosIngAeroTotal=0;
    $('.OTROSINGRESOSAERONÁUTICOS-total').each(function(index,value){
        otrosIngAeroTotal+=commaToNum($(value).text().trim());
    });

    var otrosIngAeroTotalDeudor=0;
    $('.OTROSINGRESOSAERONÁUTICOS-totalDeudor').each(function(index,value){
        otrosIngAeroTotalDeudor+=commaToNum($(value).text().trim());
    });


    $('#OTROSINGRESOSAERONÁUTICOS-subtotalTotal').text(numToComma(otrosIngAeroSubtotal));
    $('#OTROSINGRESOSAERONÁUTICOS-ivaTotal').text(numToComma(otrosIngAeroIva));
    $('#OTROSINGRESOSAERONÁUTICOS-totalTotal').text(numToComma(otrosIngAeroTotal));
    $('#OTROSINGRESOSAERONÁUTICOS-totalDeudorTotal').text(numToComma(otrosIngAeroTotalDeudor));

    //OTROSINGRESOSNOAERONÁUTICOS
    var otrosIngNoAeroSubtotal=0;
    $('.OTROSINGRESOSNOAERONÁUTICOS-subtotal').each(function(index,value){
        otrosIngNoAeroSubtotal+=commaToNum($(value).text().trim());
    });

    var otrosIngNoAeroIva=0;
    $('.OTROSINGRESOSNOAERONÁUTICOS-iva').each(function(index,value){
        otrosIngNoAeroIva+=commaToNum($(value).text().trim());
    });

    var otrosIngNoAeroTotal=0;
    $('.OTROSINGRESOSNOAERONÁUTICOS-total').each(function(index,value){
        otrosIngNoAeroTotal+=commaToNum($(value).text().trim());
    });

    var otrosIngNoAeroTotalDeudor=0;
    $('.OTROSINGRESOSNOAERONÁUTICOS-totalDeudor').each(function(index,value){
        otrosIngNoAeroTotalDeudor+=commaToNum($(value).text().trim());
    });


    $('#OTROSINGRESOSNOAERONÁUTICOS-subtotalTotal').text(numToComma(otrosIngNoAeroSubtotal));
    $('#OTROSINGRESOSNOAERONÁUTICOS-ivaTotal').text(numToComma(otrosIngNoAeroIva));
    $('#OTROSINGRESOSNOAERONÁUTICOS-totalTotal').text(numToComma(otrosIngNoAeroTotal));
    $('#OTROSINGRESOSNOAERONÁUTICOS-totalDeudorTotal').text(numToComma(otrosIngNoAeroTotalDeudor));



    var totalDeudor=0;
    $('.deuda').each(function(index,value){
        totalDeudor+=commaToNum($(value).text().trim());
    });


    $('#totalDeudor').text(numToComma(totalDeudor));

    //Datemask dd/mm/yyyy
    $('.datepicker').inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});

    $('.datepicker').datepicker({
        closeText: 'Cerrar',
        prevText: '&#x3C;Ant',
        nextText: 'Sig&#x3E;',
        currentText: 'Hoy',
        monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
        'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
        'Jul','Ago','Sep','Oct','Nov','Dic'],
        dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
        dayNamesMin: ['D','L','M','M','J','V','S'],
        weekHeader: 'Sm',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: '',
        dateFormat: "dd/mm/yy"});

})
$('#cliente-select').chosen({width: "100%"})

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
                            <th colspan="13" style="vertical-align: middle; margin-top:20px" align="center" class="text-center">LISTADO DE FACTURAS EMITIDAS\
                                </br>\
                                DESDE: {{isset($desde)?$desde:"N/A"}} HASTA: {{isset($hasta)?$hasta:"N/A"}} | MÓDULO: {{isset($moduloNombre)?$moduloNombre:"TODOS"}}\
                                </br>\
                                CLIENTE: {{isset($clienteNombre)?$clienteNombre:"TODOS"}} | AEROPUERTO: {{isset($aeropuertoNombre)?$aeropuertoNombre:"TODOS"}}\
                                </br>\
                                CONDICIÓN: {{isset($estatusNombre)?$estatusNombre:"TODAS"}}\
                            </th>\
                        </tr>\
                </thead>')
    $(table).find('thead, th').css({'border-top':'1px solid black', 'font-weight': 'bold', 'text-align':"center", 'font-size': '11px'})
    $(table).find('th').css({'border-bottom':'1px solid black', 'font-weight': 'bold', 'text-align':"center", 'font-size': '11px'})
    $(table).find('td').css({'font-size': '9px'})
    $(table).find('tr:nth-child(even)').css({'border-bottom':'1px solid black'})

    $(table).find('tr:last td').css({'border-bottom':'1px solid black','border-top':'1px solid black', 'font-weight': 'bold'})
    var tableHtml= $(table)[0].outerHTML;
    $('[name=table]').val(tableHtml);
    $('#export-form').submit();
})

$('[name=aeropuerto]').change(function(e){
    var value=$(this).val();
    $('[name=modulo] option').show();
    if(value!=0)
        $('[name=modulo] option[data-aeropuerto!='+value+']').hide();
    var $options=$('[name=modulo] option:visible');
    if($options.length>0)
        $('[name=modulo]').val($options.first().attr('value'));
    else
        $('[name=modulo]').val('');

}).change();
</script>


@endsection