
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Información General</h3>
            </div>
            {!! Form::model($contrato, []) !!}
                @include('contrato.partials.form', ["SubmitBtnText"=>"", "disabled" =>"disabled"])
            {!! Form::close() !!}
        </div>
    </div>
</div>





