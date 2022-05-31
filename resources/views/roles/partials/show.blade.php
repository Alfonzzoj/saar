<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Información de grupo</h3>
            </div>
                <div role="tabpanel">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs bg-gray" role="tablist">
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Información</a></li>
                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Usuarios</a></li>
                    </ul>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home" style="padding-top:15px">
                        {!! Form::model($rol, ["class" => "form-horizontal"]) !!}
                            @include('roles.partials.form', ["SubmitBtnText"=>"", "disabled" =>"disabled"])
                        {!! Form::close() !!}
                        </div>
                        <div role="tabpanel" class="tab-pane" id="profile" style="padding-top:15px">
                          <h5>Usuarios</h5>
                          <div class='col-xs-6 text-center'>
                          <label><strong>Por Asignar</strong></label>
                          </div>

                          <div class='col-xs-6 text-center'>
                          <label><strong>Asignados</strong></label>
                          </div>
                        {!! Form::select('usuarios[]',$rol->users->lists('username','id'), $rol->users->lists('id'), [ 'id'=>'usuarios-select', 'class'=>"form-control", 'multiple', 'autocomplete'=>'off', 'disabled']) !!}

             </div>

        </div>
    </div>
</div>