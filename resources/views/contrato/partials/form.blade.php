

    <div class="box-body">
    <p class="help-block text-right"><span class="text-danger">*</span> Campos obligatorios</p>
        <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs bg-gray" role="tablist">
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Información básica</a></li>
                <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Extras</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="form-group">
                                <label for="numero-input">Número de Punto de Cuenta<span class="text-danger">*</span></label>
                                {!! Form::text('nContrato', null, [ 'class'=>"form-control", $disabled]) !!}
                            </div>
                      <div class="form-group row">
                       <label for="cliente-select" class="control-label col-xs-12">Cliente<span class="text-danger">*</span></label>
                       <div class="col-xs-5">
                           <select id="cliente-select" class="form-control" name="cliente_id" autocomplete="off">
                           <option value="" > --Seleccione un cliente-- </option>
                               @foreach($clientes as $c)
                                   <option {{($c->id==$contrato->cliente_id)?"selected":""}} value="{{$c->id}}" data-nombre="{{$c->nombre}}" data-ced-rif="{{$c->cedRif}}" data-ced-rif-prefix="{{$c->cedRifPrefix}}">{{$c->codigo}}</option>
                               @endforeach
                           </select>
                      </div>
                      @if($disabled!="disabled")
                      <div class="col-xs-1">
                        <button type="button" class="btn btn-primary" id="advance-search-btn" data-toggle="modal" data-target="#advance-search-modal"> <span class="glyphicon glyphicon-search"></span></button>
                      </div>
                      @endif
                      <div class="col-xs-3">
                        <input class="form-control" id="cliente_nombre-input" readonly autocomplete="off">
                      </div>
                    <div class="col-xs-3">
                      <input class="form-control" id="cliente_cedRif-input" readonly autocomplete="off">
                    </div>

                    </div>
                            <div class="form-group ">
                                <label for="concepto-input">Concepto<span class="text-danger">*</span></label>
                                {!! Form::select('concepto_id', $conceptos, null, [ 'class'=>"form-control", $disabled, "id"=>"concepto-input"]) !!}
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12" >
                                    <label for="monto-input">Monto<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-8" >
                                    {!! Form::text('monto', $traductor->format($contrato->monto), [ 'class'=>"form-control", $disabled]) !!}
                                </div>
                                <div class="col-md-3 col-md-offset-1"  style="padding:0px">
                                    {!! Form::select('montoTipo',["Mensual"=>"Mensual","Anual"=>"Anual"], null, [ 'class'=>"form-control", $disabled]) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inicio-input">Fecha de Inicio<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    {!! Form::text('fechaInicio', null, [ 'class'=>"form-control", $disabled , 'id'=>"inicio-datepicker"]) !!}
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="vencimiento-input">Fecha de Vencimiento<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    {!! Form::text('fechaVencimiento', null, [ 'class'=>"form-control", $disabled , 'id'=>"vencimiento-datepicker"]) !!}
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12" >
                                    <label for="cliente-input">Período de Reanudación</label>
                                </div>
                                <div class="col-md-6" >
                                    <div class="checkbox">
                                        <label>
                                        {!! Form::checkbox('isReanudacionAutomatica',true, null, [ $disabled ]) !!} Reanudación Automática
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    {!! Form::select('mesesReanudacion',["3"=>"3 meses","6"=>"6 meses","9"=>"9 meses","12"=>"12 meses"], null, [ 'class'=>"form-control", $disabled]) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="emision-input">Fecha de Emisión</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkbox">
                                        <label>
                                        {!! Form::checkbox('isGeneracionAutomaticaFactura',true, null, [ $disabled ]) !!} Generación Automática de Factura
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::text('diaGeneracion', null, ['type'=>'number', 'class'=>"form-control", $disabled , 'placeholder'=>'Introduzca el día del mes (1-31)']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="consideracion">Consideraciones Generales</label>
                                {!! Form::textarea('consideracion', null, [ 'class'=>"form-control", $disabled , 'rows'=>"5", 'cols'=>""]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="profile">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="form-group">
                                <label for="numero-input">Metros Cuadrados</label>
                                {!! Form::text('metros', null, [ 'class'=>"form-control", $disabled, 'maxlength'=>'100' ]) !!}
                            </div>
                            <div class="form-group">
                                <label for="responsable">Nombre del Responsable</label>
                                {!! Form::text('responsable', null, [ 'class'=>"form-control", $disabled, 'maxlength'=>'255' ]) !!}
                            </div>
                            <div class="form-group">
                                <label for="teléfono">Teléfono(s) de Contacto</label>
                                {!! Form::text('telefono', null, [ 'class'=>"form-control", $disabled, 'maxlength'=>'100']) !!}
                            </div>
                            <div class="form-group">
                                <label for="ubicacion">Ubicación</label>
                                {!! Form::textarea('ubicacion', null, [ 'class'=>"form-control", $disabled , 'rows'=>"5", 'cols'=>""]) !!}
                            </div>
                            <div class="form-group">
                                <label for="descripción">Descripción</label>
                                {!! Form::textarea('descripcion', null, [ 'class'=>"form-control", $disabled , 'rows'=>"5", 'cols'=>""]) !!}
                            </div>
                            <div class="form-group">
                                <label for="inicio-input">Imagen</label>
                              {!!  Form::file('img-file', ["id" => "img-input", $disabled]) !!}
                            </div>
                            <div class="form-group text-center">
                                <img width="200" height="200" id="img-preview" src="{{asset($contrato->imagen)}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.box-body -->
    @if($disabled!="disabled")
    <div class="box-footer text-right">
        <button type="submit" class="btn btn-primary"> {{$SubmitBtnText}} </button>
    </div>
    @endif