{!! Form::model($aeronave, ['url' =>action('AeronaveController@update', [$aeronave->id]), "method" => "PUT", "class"=>"form-horizontal"]) !!}
    @include('aeronaves.partials.form', ["disabled"=>""])
{!! Form::close() !!}



