@extends('app')
@section('content')
    <ol class="breadcrumb">
        <li><a href="{{url('principal')}}">Inicio</a></li>
        <li><a href="{{action('ContratoController@index')}}">Contratos</a></li>
        <li><a class="active">Actualización de contratos en lote</a></li>
    </ol>
    <div class="row" id="box-wrapper">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Actualización de contratos en lote</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                {!! Form::open( ["url" => action('ContratoController@loteStore'), "method" => "POST"]) !!}
                    <div class="box-body"  id="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <label class="col-xs-1 control-label">Modificador</label>
                                        <div class="col-xs-2">
                                            <select class="form-control" id="modificador-select">
                                                <option value="=">valor absoluto</option>
                                                <option>%</option>
                                                <option>fórmula</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-7">
                                            <input class="form-control"  id="modificador-input" placeholder="Utilice [[valor]] para hacer refencia al precio en la formula." />
                                        </div>
                                        <div class="col-xs-2">
                                            <button type="button" class="btn btn-primary" id="modi-btn">Modificar</button>
                                        </div>
                                    </div>
                                </div>
                                <table class="table" id="contratos-table">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>Seleccion</th>
                                            <th># Contrato</th>
                                            <th>Cliente</th>
                                            <th>Monto actual</th>
                                            <th>Monto renovado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($contratos as $contrato)
                                            <tr>
                                                <td><input type="hidden" name="monto[]" class="monto-input"><input type="checkbox" autocomplete="off" name="id[]" value="{{$contrato->id}}"></td>
                                                <td>{{$contrato->nContrato}}</td>
                                                <td>{{$contrato->cliente->nombre}}</td>
                                                <td class="monto-actual text-right">{{$traductor->format($contrato->monto)}}</td>
                                                <td class="monto-nuevo text-right">0.00</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer text-right">
                        <button class="btn btn-primary">Actualizar</button>
                    </div>
                {!! Form::close() !!}
            </div><!-- /.box -->
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function(){
            $('#modi-btn').click(function(){
                var select=$('#modificador-select').val();
                var input=$('#modificador-input').val().replace(/\./g, '').replace(/,/g, '.');
                switch(select) {
                    case "=":
                        $('#contratos-table tbody tr').each(function(){
                            if($(this).find('input[type=checkbox]:checked').length>0){
                                var actual=commaToNum($(this).find('.monto-actual').text());
                                actual=parseFloat(actual);
                                input=parseFloat(input);
                                input=(isNaN(input))?0:input;
                                actual+=input;
                                $(this).find('.monto-nuevo').text(numToComma(actual));
                                $(this).find('.monto-input').val(numToComma(actual));
                            }
                        })
                    break;
                    case "%":
                        $('#contratos-table tbody tr').each(function(){
                            if($(this).find('input[type=checkbox]:checked').length>0){
                                var actual=commaToNum($(this).find('.monto-actual').text());
                                actual=parseFloat(actual);
                                input=parseFloat(input);
                                input=(isNaN(input))?0:input;
                                actual+=actual*input/100;
                                $(this).find('.monto-nuevo').text(numToComma(actual));
                                $(this).find('.monto-input').val(numToComma(actual));
                            }
                        })
                    break;
                    case "fórmula":
                        $('#contratos-table tbody tr').each(function(){
                            if($(this).find('input[type=checkbox]:checked').length>0){
                                var actual=commaToNum($(this).find('.monto-actual').text());
                                var formula=input.replace(/\[\[valor\]\]/g, actual);
                                var nuevo=0;
                                try{
                                    nuevo=eval(formula);
                                }catch(e){
                                    console.log(e);
                                }
                                $(this).find('.monto-nuevo').text(numToComma(nuevo));
                                $(this).find('.monto-input').val(numToComma(nuevo));
                            }
                        })
                    break;
                }
            })
        });
    </script>
@endsection