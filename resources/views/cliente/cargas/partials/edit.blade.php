{!! Form::model($carga, ['url' =>action('CargaController@update', [$carga->id]), "method" => "PUT", "class"=>"form-horizontal"]) !!}
    @include('cargas.partials.form', ["disabled"=>""])
{!! Form::close() !!}



