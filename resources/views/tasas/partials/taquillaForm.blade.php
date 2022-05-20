    <div class="col-md-12 consulta">
        <div class="box box-primary">
            <div class="box-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="box-title">TAQUILLA</h3>
                    </div>
                    <div class="col-md-3 text-right">
                        <span class="pull-right"><strong>TAQUILLA:</strong> {{($taquilla=='CV')?'Sección de Control de Vuelos':$taquilla}} </span>
                    </div>
                    <div class="col-md-1 text-right">
                        <span class="pull-right"><strong>TURNO:</strong> {{($taquilla=='CV')?'Único':$turno}}</span>
                    </div>
                    <div class="col-md-2 text-right">
                        <span class="pull-right"><strong>FECHA:</strong> {{$fecha}}</span>
                    </div>
                </div>


            </div><!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
                <form data-url="{{action('TasaController@postOperacion')}}">
                    <input type="hidden" name="fecha" value="{{$fecha}}">
                    <input type="hidden" name="taquilla" value="{{$taquilla}}">
                    <input type="hidden" name="turno" value="{{$turno}}">

                    <table class="table operador-table" id="serie-table">
                        <thead>
                            <th class="text-center" style="min-width:100px">SERIE</th>
                            <th class="text-center">DESDE</th>
                            <th class="text-center">HASTA</th>
                            <th class="text-center" style="min-width:100px">CANTIDAD</th>
                            <th class="text-center" style="min-width:150px">MONTO</th>
                            <th class="text-center" style="min-width:150px">TOTAL</th>
                            <th>ACCIÓN</th>

                        </thead>
                        <tbody>

                            @if($tasaOp->detalles->count()==0)
                                @foreach($tasas as $tasa)

                                    <tr>
                                        <td class="serie-td">
                                            <input type="hidden" name="serie[]" class="serie-val" value="{{$tasa->nombre}}">
                                            <p class="form-control-static">Serie {{$tasa->nombre}}</p>
                                        </td>
                                        <td  style="width: 200px">
                                            <input name="desde[]" class="form-control text-right desde-input" value="{{max($tasa->inicio, $tasa->max)}}">
                                        </td>
                                        <td  style="width: 200px">
                                            <input name="hasta[]" class="form-control text-right hasta-input" >
                                        </td>
                                        <td>
                                            <div class="input-group" style="width: 300px; margin-left: 50px">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-danger subtract-tasa" type="button">
                                                        <span class="glyphicon glyphicon-minus"></span>
                                                    </button>
                                                </span>
                                                <input name="cantidad[]" class="form-control  text-center cantidad-input" value="0">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-primary add-tasa" type="button">
                                                        <span class="glyphicon glyphicon-plus"></span>
                                                    </button>
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="hidden" name="monto[]" class="serie-val" value="{{$tasa->monto}}">
                                            <p class="form-control-static text-right bs-input">{{$traductor->format($tasa->monto)}}</p>
                                        </td>
                                        <td>
                                            <p class="form-control-static text-right monto-input">0,00</p>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger delete-serie-btn">
                                                <span class="glyphicon glyphicon-minus"></span>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                @foreach($tasaOp->detalles as $detalle)
                                    <tr>
                                        <td class="serie-td">
                                            <input {{isset($isSupervisor)?"":"disabled"}} type="hidden" name="serie[]" class="serie-val" value="{{$detalle->serie}}">
                                            <p class="form-control-static">Serie {{$detalle->serie}}</p>
                                        </td>
                                        <td style="width: 200px">
                                            <input {{isset($isSupervisor)?"":"disabled"}} name="desde[]" class="form-control text-right desde-input" value="{{$detalle->inicio}}">
                                        </td>
                                        <td style="width: 200px">
                                            <input {{isset($isSupervisor)?"":"disabled"}} name="hasta[]" class="form-control text-right hasta-input" value="{{$detalle->fin}}">
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button {{isset($isSupervisor)?"":"disabled"}} type="button" class="btn btn-danger subtract-tasa" type="button">
                                                        <span class="glyphicon glyphicon-minus"></span>
                                                    </button>
                                                </span>
                                                <input {{isset($isSupervisor)?"":"disabled"}} name="cantidad[]" class="form-control  text-center cantidad-input" value="{{$detalle->cantidad}}">
                                                <span class="input-group-btn">
                                                    <button {{isset($isSupervisor)?"":"disabled"}} type="button" class="btn btn-primary add-tasa" type="button">
                                                        <span class="glyphicon glyphicon-plus"></span>
                                                    </button>
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <input {{isset($isSupervisor)?"":"disabled"}} type="hidden" name="monto[]" class="serie-val" value="{{$detalle->costo}}">
                                            <p class="form-control-static text-right bs-input">{{$traductor->format($detalle->costo)}}</p>
                                        </td>
                                        <td>
                                            <p class="form-control-static text-right monto-input">{{$traductor->format($detalle->total)}}</p>
                                        </td>
                                        <td>
                                            <button {{isset($isSupervisor)?"":"disabled"}} type="button" class="btn btn-danger delete-serie-btn">
                                                <span class="glyphicon glyphicon-minus"></span>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            <tr>
                                <td colspan="4"></td>
                                <td class="text-right">TOTAL</td>
                                <td class="total-operador text-right">0,00</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-6 text-right">
                                <button type="button" class="save-tasa-btn btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
