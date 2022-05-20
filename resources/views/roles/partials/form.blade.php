<div class="box-body"  id="container">
<p class="help-block text-right"><span class="text-danger">*</span> Campos obligatorios</p>
    <div class="form-group">
        <label class="col-xs-1 control-label">Nombre<span class="text-danger">*</span></label>
        <div class="col-xs-8">
            {!! Form::text('name', null, [ 'class'=>"form-control", $disabled]) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-1 control-label">Descripción</label>
        <div class="col-xs-8">
            {!! Form::textarea('description', null, [ 'class'=>"form-control", $disabled , 'rows'=>"3", 'cols'=>"" ]) !!}
        </div>
    </div>
    <h5>Permisos</h5>
    <hr/>
    <h5>Menu</h5>
    <div class='form-group'>
                             <div class='col-xs-6 text-center'>
                              <label><strong>Por Asignar</strong></label>
                              </div>

                              <div class='col-xs-6 text-center'>
                              <label><strong>Asignados</strong></label>
                              </div>
        <div class='col-xs-12'>
            {!! Form::select('permisos[]',$permisos, $rol->permissions->lists('id'), [ 'id'=>'permisos-select', 'class'=>"form-control", $disabled, 'multiple', 'autocomplete'=>'off']) !!}
        </div>
    </div>
</div><!-- /.box-body -->
@if($disabled!="disabled")
    <div class="box-footer">
        <button class="btn btn-primary"> {{$SubmitBtnText}} </button>
    </div>
@endif