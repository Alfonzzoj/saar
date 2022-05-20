{!! Form::model($otrosCargo, ['url' =>action('OtrosCargoController@update', [$otrosCargo->id]), "method" => "PUT", "class"=>"form-horizontal"]) !!}
    @include('configuracionPrecios.confOtrosCargos.partials.form', ["disabled"=>""])
{!! Form::close() !!}