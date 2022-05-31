{!! Form::model($hangar, ['url' =>action('HangarController@update', [$hangar->id]), "method" => "PUT", "class"=>"form-horizontal"]) !!}
    @include('hangares.partials.form', ["disabled"=>""])
{!! Form::close() !!}



