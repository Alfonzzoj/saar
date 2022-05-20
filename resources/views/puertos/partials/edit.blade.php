{!! Form::model($port, ['url' =>action('PuertoController@update', [$port->id]), "method" => "PUT", "class"=>"form-horizontal"]) !!}
    @include('puertos.partials.form', ["disabled"=>""])
{!! Form::close() !!}



