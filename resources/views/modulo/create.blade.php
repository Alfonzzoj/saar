@extends('app')
@section('content')
<ol class="breadcrumb">
  <li><a href="{{url('principal')}}">Inicio</a></li>
  <li><a href="{{action('ModuloController@index')}}">Módulos</a></li>
  <li><a class="active">Creación de módulo</a></li>
</ol>
         <div class="row" id="box-wrapper">
              <!-- left column -->
              <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">

                  <div class="box-header">
                    <h3 class="box-title">Creación de módulo</h3>
                  </div><!-- /.box-header -->
                  <!-- form start -->
                    {!! Form::model($modulo, ["url" => "administracion/modulo", "method" => "POST", "class" => "form-horizontal"]) !!}
                        @include('modulo.partials.form', ["SubmitBtnText"=>"Crear", "disabled" =>""])
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