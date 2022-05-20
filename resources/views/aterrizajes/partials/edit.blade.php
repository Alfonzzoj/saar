{!! Form::model($aterrizaje, ['url' =>action('AterrizajeController@update', [$aterrizaje->id]), "method" => "PUT", "class"=>"form-horizontal"]) !!}
    @include('aterrizajes.partials.form', ["disabled"=>""])
{!! Form::close() !!}



