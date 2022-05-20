
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Información de Despegue</h3>
            </div>
            {!! Form::model($despegue, []) !!}
                @include('despegues.partials.form', [disabled" =>"disabled"])
            {!! Form::close() !!}
        </div>
    </div>
</div>
