<div class="box-body"  id="container">
<p class="help-block text-right"><span class="text-danger">*</span> Campos obligatorios</p>
    <div role="tabpanel">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs bg-gray" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Información Básica</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Ubicación</a></li>
            <li role="presentation"><a href="#aeronautico" aria-controls="aeronautico" role="tab" data-toggle="tab">Información Aeronáutica</a></li>
            <li role="presentation"><a href="#credito" aria-controls="credito" role="tab" data-toggle="tab">Crédito y Saldo</a></li>
            <li role="presentation"><a href="#retencion" aria-controls="retencion" role="tab" data-toggle="tab">Retención</a></li>
            <li role="presentation"><a href="#extra" aria-controls="extra" role="tab" data-toggle="tab">Extra</a></li>


        </ul>

        <!-- Tab panes -->

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home" style="padding-top:15px">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-xs-2 control-label">Código<span class="text-danger">*</span></label>
                        <div class="col-xs-2">
                            {!! Form::text('codigo', null, [ 'class'=>"form-control", $disabled]) !!}
                        </div>
                        <label for="inputPassword" class="col-xs-1 control-label">CI./RIF<span class="text-danger">*</span></label>
                        <div class="col-xs-2">
                            <div class="form-group">
                                  {!! Form::hidden('cedRifPrefix', null, ['id' => 'cedRifPrefix', 'class' => 'operator-input', 'autocomplete'=>'off']) !!}
                                  <div class="input-group">
                                      <div class="input-group-btn">
                                        <button style="max-height:37px" type="button" class="btn btn-default dropdown-toggle" {{$disabled}} data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="operator-text">{{$cliente->cedRifPrefix or "V"}}</span></button>
                                        <ul class="dropdown-menu operator-list">
                                          <li><a href="#">V</a></li>
                                          <li><a href="#">E</a></li>
                                          <li><a href="#">J</a></li>
                                          <li><a href="#">G</a></li>
                                        </ul>
                                      </div>
                                      {!! Form::text('cedRif', null, [ 'class'=>"form-control", $disabled, 'style'=>'padding-left:2px']) !!}
                                  </div>
                            </div>
                        </div>
                        <label for="inputPassword" class="col-xs-1 control-label">NIT</label>
                        <div class="col-xs-2">
                            {!! Form::text('nit', null, [ 'class'=>"form-control", $disabled]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-2 control-label">Nombre ó Razón Social<span class="text-danger">*</span></label>
                        <div class="col-xs-10">
                        {!! Form::text('nombre', null, [ 'class'=>"form-control", $disabled]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-2 control-label">Tipo<span class="text-danger">*</span></label>
                        <div class="col-xs-4">
                          {!! Form::select('tipo',["Aeronáutico"=>"Aeronáutico","No Aeronáutico"=>"No Aeronáutico","Mixto"=>"Mixto"], null, [ 'class'=>"form-control", $disabled]) !!}
                        </div>
                        <label for="inputPassword" class="col-xs-2  control-label">Fecha de Ingreso</label>
                        <div class="col-xs-4">
                           {!! Form::text('fechaIngreso', null, [ 'class'=>"form-control", $disabled , 'id'=>"ingre_fecha-datepicker"]) !!}
                        </div>
                        <label class="col-xs-2 control-label">Condición de Pago</label>
                        <div class="col-xs-4">
                          {!! Form::select('condicionPago',["Contado"=>"Contado", "Crédito"=>"Crédito"], null, [ 'class'=>"form-control", $disabled]) !!}
                        </div>
                    </div>
                    <div class="form-group">

                        <label class="col-xs-2 control-label">E-mail</label>
                        <div class="col-xs-4">
                            {!! Form::text('email', null, [ 'class'=>"form-control", $disabled]) !!}
                        </div>
                        <div class="col-xs-4 text-right ">
                            <div class="checkbox">
                                <label>
                                {!! Form::checkbox('isEnvioAutomatico',true, null, [ $disabled ]) !!} Enviar facturas al E-mail automáticamente
                                </label>
                            </div>
                        </div>

                        <div class=" col-xs-2 text-right">
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('isActivo',true, null, [  $disabled ]) !!} Activo
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="profile" style="padding-top:15px">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-xs-2 control-label">Dirección Fiscal</label>
                        <div class="col-xs-10">
                        {!! Form::textarea('direccion', null, [ 'class'=>"form-control", $disabled , 'rows'=>"3", 'cols'=>""]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-2 control-label">Ciudad</label>
                        <div class="col-xs-4">
                            {!! Form::text('ciudad', null, [ 'class'=>"form-control", $disabled ]) !!}
                        </div>
                        <label class="col-xs-2 control-label">País</label>
                        <div class="col-xs-4">
                         {!! Form::select('pais_id', $paises,  null, [ 'class'=>"form-control", $disabled]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-2 control-label">Cod. Postal</label>
                        <div class="col-xs-4">
                            {!! Form::text('codpostal', null, [ 'class'=>"form-control", $disabled ]) !!}
                        </div>
                        <label class="col-xs-2 control-label">Teléfonos</label>
                        <div class="col-xs-4">
                            {!! Form::text('telefonos', null, [ 'class'=>"form-control", $disabled]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-2 control-label">Fax</label>
                        <div class="col-xs-4">
                            {!! Form::text('fax', null, [ 'class'=>"form-control", $disabled]) !!}
                        </div>
                        <label class="col-xs-2 control-label">Responsable</label>
                        <div class="col-xs-4">
                            {!! Form::text('responsable', null, [ 'class'=>"form-control", $disabled]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-2 control-label">Web Site</label>
                        <div class="col-xs-4">
                            {!! Form::text('web', null, [ 'class'=>"form-control", $disabled]) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="aeronautico" style="padding-top:15px">
                <div class="form-horizontal">
                    <div class="form-group">
                        <div class="col-xs-6 text-center">
                            <label>Hangares Disponibles</label>
                        </div>
                        <div class="col-xs-6 text-center">
                            <label>Hangares del Cliente</label>
                        </div>
                        <div class="col-xs-12">
                            {!! Form::select('hangars[]', $hangars,  $cliente->hangars->lists('id'), [ 'class'=>"form-control", $disabled, 'multiple'=>'multiple', 'id'=>'hangars-select']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="credito" style="padding-top:15px">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-xs-2 control-label">Límite de crédito Bs</label>
                        <div class="col-xs-4">
                            {!! Form::text('limiteCredito', null, [ 'class'=>"form-control", $disabled ]) !!}
                        </div>
                        <label class="col-xs-2 control-label">Días de crédito</label>
                        <div class="col-xs-4">
                            {!! Form::text('diasCredito', null, [ 'class'=>"form-control", $disabled ]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-2 control-label">Des. Pronto pago %</label>
                        <div class="col-xs-4">
                            {!! Form::text('prontoPago', null, [ 'class'=>"form-control", $disabled ]) !!}
                        </div>
                        <label class="col-xs-2 control-label">Desc. Tasa %</label>
                        <div class="col-xs-4">
                            {!! Form::text('descTasa', null, [ 'class'=>"form-control", $disabled ]) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="retencion" style="padding-top:15px">
                <div class="form-horizontal">
                    <div class="form-group">
                        <div class="col-xs-10 col-xs-offset-1">
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('isContribuyente',true, null, [  $disabled ]) !!} Contribuyente
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                         <label class="col-xs-2 control-label">ISLR %</label>
                        <div class="col-xs-4">
                        {!! Form::text('islrpercentage', (($cliente->islrpercentage)?$cliente->islrpercentage:'0'), [ 'class'=>"form-control", $disabled ]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                         <label class="col-xs-2 control-label">IVA %</label>
                        <div class="col-xs-4">
                        {!! Form::text('ivapercentage', (($cliente->ivapercentage)?$cliente->ivapercentage:'0'), [ 'class'=>"form-control", $disabled ]) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="extra" style="padding-top:15px">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-xs-2 control-label">Comentario</label>
                        <div class="col-xs-10">
                            {!! Form::textarea('comentario', null, [ 'class'=>"form-control", $disabled , 'rows'=>"3", 'cols'=>""]) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @if($disabled!="disabled")
        <div class="box-footer text-right">
            <button class="btn btn-primary"> {{$SubmitBtnText}} </button>
        </div>
    @endif


