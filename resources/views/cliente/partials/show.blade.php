
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Información de contratos</h3>
            </div>
            {!! Form::model($cliente, []) !!}
                @include('cliente.partials.form', ["SubmitBtnText"=>"", "disabled" =>"disabled"])
            {!! Form::close() !!}
        </div>
    </div>
</div>
