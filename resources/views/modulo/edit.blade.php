@extends('app')
@section('content')
<ol class="breadcrumb">
  <li><a href="{{url('principal')}}">Inicio</a></li>
  <li><a href="{{action('ModuloController@index')}}">Módulos</a></li>
  <li><a class="active">Edición de módulo</a></li>
</ol>
         <div class="row" id="box-wrapper">
              <!-- left column -->
              <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">

                  <div class="box-header">
                    <h3 class="box-title">Edición de módulo</h3>
                  </div><!-- /.box-header -->
                  <!-- form start -->
                    {!! Form::model($modulo, ['route' => ['administracion.modulo.update', $modulo->id], "method" => "PUT", "class" => "form-horizontal"]) !!}
                        @include('modulo.partials.form', ["SubmitBtnText"=>"Modificar", "disabled" =>""])
                    {!! Form::close() !!}
                </div><!-- /.box -->
              </div>
            </div>


@endsection
@section('script')

                     <script>

    $(document).ready(function(){
        $('#conceptos-select').multiSelect({keepOrder:true});


    });


    </script>
    @endsection