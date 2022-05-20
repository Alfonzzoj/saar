
                        {!! Form::hidden('sortName', array_get($input,"sortName"), []) !!}
                        {!! Form::hidden('sortType', array_get($input,"sortType"), []) !!}
                        <div class="form-group">
                            {!! Form::text('codigo', array_get($input,"codigo"), [ 'class'=>"form-control", 'placeholder'=>'Código']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::text('nombre', array_get($input,"nombre"), [ 'class'=>"form-control", 'placeholder'=>'Nombre']) !!}
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                  {!! Form::hidden('cedRifPrefix', array_get($input,"cedRifPrefix"), ['id' => 'cedRifPrefix', 'class' => 'operator-input', 'autocomplete'=>'off']) !!}
                                  <div class="input-group">
                                      <div class="input-group-btn">
                                        <button style="max-height:37px" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="operator-text">{{($input["cedRifPrefix"]=="_")?"Todos":$input["cedRifPrefix"]}}</span></button>
                                        <ul class="dropdown-menu operator-list">
                                          <li><a href="#">Todos</a></li>
                                          <li><a href="#">V</a></li>
                                          <li><a href="#">E</a></li>
                                          <li><a href="#">J</a></li>
                                        </ul>
                                      </div>
                                      {!! Form::text('cedRif', array_get($input,"cedRif"), [ 'class'=>"form-control", 'placeholder'=>'CI./RIF', 'style'=>'padding-left:2px']) !!}
                                  </div>
                            </div>

                        </div>
                        <div class="form-group">
                            {!! Form::select('tipo',["%"=>"Todos", "Aeronáutico"=>"Aeronáutico","No Aeronáutico"=>"No Aeronáutico","Mixto"=>"Mixto"], array_get($input,"tipo"), [ 'class'=>"form-control"]) !!}
                        </div>
                        <button type="submit" class="btn btn-default" id="cliente-filter-btn">Buscar</button>
                        <a class="btn btn-default cliente-reset-btn" href="{{$resetHref}}">Reset</a>