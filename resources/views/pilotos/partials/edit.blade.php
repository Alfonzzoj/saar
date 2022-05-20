{!! Form::model($pilot, ['url' =>action('PilotoController@update', [$pilot->id]), "method" => "PUT", "class"=>"form-horizontal"]) !!}
    @include('pilotos.partials.form', ["disabled"=>""])
{!! Form::close() !!}



