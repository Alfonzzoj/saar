@extends('app')
@section('content')
<ol class="breadcrumb">
  <li><a href="{{url('principal')}}">Inicio</a></li>
  <li><a class="active">Contratos</a></li>
</ol>
    <div class="row" id="box-wrapper">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Filtros</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body text-right"  id="container">

                    {!! Form::open(["url" => "contrato", "method" => "GET", "class"=>"form-inline"]) !!}
                        {!! Form::hidden('sortName', array_get($input, 'sortName'), []) !!}
                        {!! Form::hidden('sortType', array_get($input, 'sortType'), []) !!}
                        <div class="form-group">
                            {!! Form::text('nContrato', array_get($input, 'nContrato'), [ 'class'=>"form-control", 'placeholder'=>'Número contrato']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::text('clienteNombre', array_get($input, 'clienteNombre'), [ 'class'=>"form-control", 'placeholder'=>'Cliente']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::select('concepto_id', $conceptos, array_get($input, 'concepto_id'), [ 'class'=>"form-control"]) !!}
                        </div>
                        <div class="form-group">
                              {!! Form::hidden('fechaInicioOperator', array_get($input, 'fechaInicioOperator'), ['id' => 'fechaInicioOperator', 'class' => 'operator-input', 'autocomplete'=>'off']) !!}
                              <div class="input-group">
                                  <div class="input-group-btn">
                                    <button style="max-height:37px" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="operator-text">{{array_get($input, 'fechaInicioOperator')}}</span></button>
                                    <ul class="dropdown-menu operator-list">
                                      <li><a href="#">>=</a></li>
                                      <li><a href="#"><=</a></li>
                                      <li><a href="#">=</a></li>
                                    </ul>
                                  </div>
                                   {!! Form::text('fechaInicio', array_get($input, 'fechaInicio'), ['id'=>'finicio-datepicker', 'class'=>"form-control", 'placeholder'=>'Fecha de inicio', 'style' => 'padding-left:2px']) !!}
                              </div>
                        </div>
                        <div class="form-group">
                              {!! Form::hidden('fechaVencimientoOperator', array_get($input, 'fechaVencimientoOperator'), ['id' => 'fechaVencimientoOperator', 'class' => 'operator-input', 'autocomplete'=>'off']) !!}
                              <div class="input-group">
                                  <div class="input-group-btn">
                                    <button style="max-height:37px" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="operator-text">{{array_get($input, 'fechaVencimientoOperator')}}</span></button>
                                    <ul class="dropdown-menu operator-list">
                                      <li><a href="#">>=</a></li>
                                      <li><a href="#"><=</a></li>
                                      <li><a href="#">=</a></li>
                                    </ul>
                                  </div>
                                  {!! Form::text('fechaVencimiento', array_get($input, 'fechaVencimiento'), ['id'=>'fvencimiento-datepicker', 'class'=>"form-control", 'placeholder'=>'Fecha de vencimiento', 'style' => 'padding-left:2px']) !!}
                              </div>
                        </div>
                        <div class="form-group margin">
                            <button type="submit" class="btn btn-default">Buscar</button>
                            <a class="btn btn-default" href="contrato">Reset</a>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Contratos</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-primary" id="renovar-contratos-btn">Renovación automática de contratos</button>
                        <a class="btn btn-warning"  href="{{ URL::to('contrato/lote') }}">Aumento en lote de contratos</a>
                    </div>
                </div>
                <div class="box-body"  id="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <ul class="list-group">
                                <li class="list-group-item" data-id="1">
                                    <div class="media">
                                        <div class="pull-right media-right">
                                            <div class="btn-group-vertical  btn-group-xs" role="group" aria-label="...">
                                                <a class="btn btn-primary" href="{{ action('ContratoController@create') }}">&nbsp;<span class="glyphicon glyphicon-plus"></span>&nbsp;</a>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="media-heading">Crear un nuevo contrato</h6>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">

                                    <table class="table text-center">
                                        <thead class="bg-primary">
                                            <tr>
                                                {!!Html::sortableColumnTitle("# Contrato", "nContrato")!!}
                                                {!!Html::sortableColumnTitle("Cliente", "clienteNombre")!!}
                                                {!!Html::sortableColumnTitle("Concepto", "conceptoNombre")!!}
                                                {!!Html::sortableColumnTitle("Fecha Inicio", "fechaInicio")!!}
                                                {!!Html::sortableColumnTitle("Fecha Vencimiento", "fechaVencimiento")!!}
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($contratos as $contrato)
                                                <tr>
                                                    <td class='text-justify'>{{$contrato->nContrato}}</td>
                                                    <td style="text-align: left">{{$contrato->cliente->nombre}}</td>
                                                    <td style="text-align: left">{{$contrato->concepto->nompre}}</td>
                                                    <td class='text-justify'>{{$contrato->fechaInicio}}</td>
                                                    <td class='text-justify'>{{$contrato->fechaVencimiento}}</td>
                                                    <td>
                                                        <div class='btn-group  btn-group-sm' role='group' aria-label='...'>
                                                            <button class='btn btn-primary' data-id="{{$contrato->id}}" data-toggle="modal" data-target="#show-modal"><span class='glyphicon glyphicon-eye-open'></span></button>
                                                            <button class='btn btn-success renovar-contrato-btn' data-id="{{$contrato->id}}" data-num= "{{$contrato->nContrato}}"><span class='glyphicon glyphicon-repeat'></span></button>
                                                            <a class='btn btn-warning' href='{{action('ContratoController@edit', ["id"=>$contrato->id])}}'><span class='glyphicon glyphicon-pencil' ></span></a>
                                                            <button class='btn btn-danger delete-contrato-btn' data-id="{{$contrato->id}}" ><span class='glyphicon glyphicon-remove'></span></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                        {!! $contratos->appends(Input::except('page'))->render() !!}
                                        </div>
                                       <div class="col-xs-12 text-right">
                                       {{\Html::pagination($contratos)}}
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="show-modal" tabindex="-1" role="dialog" aria-labelledby="contrato-show-modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Contrato</h4>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')

<script>

$(document).ready(function(){

  $('#fvencimiento-datepicker, #finicio-datepicker').datepicker({
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

    $('.delete-contrato-btn').click(function(){
        var tr=$(this).closest('tr');
        var id=$(this).data("id");
        var url="{{url('contrato')}}/"+id;
        alertify.confirm("¿Está seguro que desea eliminar el contrato seleccionado?", function (e) {
            if (e) {
                $.
                ajax({url: url,
                      method:"DELETE"})
                .done(function(response, status, responseObject){
                    try{
                        var obj= JSON.parse(responseObject.responseText);
                        if(obj.success==1){
                            $(tr).remove();
                            alertify.success(obj.text);
                        }
                    }catch(e){
                    console.log(e);
                    alertify.error("Error en el servidor");
                    }
                })
            }
        });
    })

$('#show-modal').on('show.bs.modal', function (e) {
  var id=$(e.relatedTarget).data("id");
  $('#show-modal .modal-body').html("Cargando...")
                              .load("{{url('contrato')}}/"+id, function(){
                              $('.modal-backdrop').css('height',"1000px")
                              });
})

$('#renovar-contratos-btn').click(function(){
        alertify.confirm("A continuación se renovaran los contratos vencidos. " +
        "Todo contrato que este vencido se le sumara sus meses de renovación hasta que su fecha de vencimiento ya no este expirada. " +
        "Estos cambios son irreversibles. Desea realizar la operación? ", function (e) {
            if (e) {
            addLoadingOverlay('.box');
                $.
                ajax({url: "{{action('ContratoController@postRenovarContratos')}}",
                      method:"POST"})
                .always(function(response, status, responseObject){
                    removeLoadingOverlay('.box');
                    try{
                        var obj= JSON.parse(responseObject.responseText);
                        if(obj.success==1){
                            alertify.success(obj.text);
                            setTimeout(
                                function()
                                {
                                    location.reload();
                                }, 1000);
                        }
                    }catch(e){
                    console.log(e);
                    alertify.error("Error en el servidor");
                    }
                })
            }
        });
})


    $('.renovar-contrato-btn').click(function(){

        var id=$(this).data("id");
        var num=$(this).data("num");

        alertify.confirm("A continuación se renovara el contrato " + num +
            ", Se le sumará sus meses de renovación hasta que su fecha de vencimiento ya no este expirada." +
            "Este cambio es irreversible. Desea realizar la operación? ", function (e) {
            if (e) {
                addLoadingOverlay('.box');
                $.ajax({url: "{{action('ContratoController@postRenovarContratosIndiv')}}",
                    method:"POST",
                    data:{id:id}})
                    .always(function(response, status, responseObject){
                        try{
                            var obj= JSON.parse(responseObject.responseText);
                            if(obj.success==1){
                                alertify.success(obj.text);
                                setTimeout(
                                    function()
                                    {
                                        location.reload();
                                    }, 1000);
                            }
                        }catch(e){
                            console.log(e);
                            alertify.error("Error en el servidor");
                        }
                    })
            }
        });
    })



});

</script>
@endsection