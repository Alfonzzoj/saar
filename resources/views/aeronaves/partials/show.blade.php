<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Información de Aeronave</h3>
            </div>
            {!! Form::model($aeronave, [ "class" => "form-horizontal"]) !!}
                @include('aeronaves.partials.form', ["disabled" =>"disabled"])
            {!! Form::close() !!}
        </div>
    </div>
</div>