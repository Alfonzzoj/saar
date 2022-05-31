{!! Form::model($user, ['url' =>action('UsuarioController@update', [$user->id]), "method" => "PUT", "class"=>"form-horizontal"]) !!}
    @include('usuarios.partials.form', ["disabled"=>""])
{!! Form::close() !!}



