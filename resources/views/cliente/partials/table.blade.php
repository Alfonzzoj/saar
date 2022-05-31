                                    <table class="table text-center">
                                        <thead class="bg-primary">
                                            <tr>
                                                {!!Html::sortableColumnTitle("Código", "codigo")!!}
                                                {!!Html::sortableColumnTitle("Nombre ó Razón Social", "nombre")!!}
                                                {!!Html::sortableColumnTitle("CI./RIF", "cedRifTotal")!!}
                                                {!!Html::sortableColumnTitle("Tipo", "tipo")!!}
                                                @if(!$selectButton)
                                                <th>Acción</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($clientes as $cliente)
                                             @if(!$selectButton)
                                                <tr >
                                             @else
                                                <tr class="select-client-btn " data-id="{{$cliente->id}}" style="cursor:pointer">
                                             @endif
                                                    <td class='text-justify'>{{$cliente->codigo}}</td>
                                                    <td style="text-align: left">{{$cliente->nombre}}</td>
                                                    <td class='text-justify'>{{$cliente->cedRifTotal}}</td>
                                                    <td class='text-justify'>{{$cliente->tipo}}</td>
                                                    @if(!$selectButton)
                                                    <td>
                                                        <div class='btn-group  btn-group-sm' role='group' aria-label='...'>

                                                            <button class='btn btn-primary' data-id="{{$cliente->id}}" data-toggle="modal" data-target="#show-modal"><span class='glyphicon glyphicon-eye-open'></span></button>
                                                            <a class='btn btn-warning' href='{{action('ClienteController@edit', ["id"=>$cliente->id])}}'><span class='glyphicon glyphicon-pencil' ></span></a>
                                                            <button class='btn btn-danger delete-cliente-btn' data-id="{{$cliente->id}}"><span class='glyphicon glyphicon-remove'></span></button>

                                                        </div>
                                                    </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            {!! $clientes->appends(Input::except('page'))->render() !!}
                                        </div>
                                        <div class="col-xs-12 text-right">
                                            {{\Html::pagination($clientes)}}
                                        </div>
                                    </div>