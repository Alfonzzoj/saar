@extends('app')
@section('content')
<ol class="breadcrumb">
  <li><a href="{{url('principal')}}">Inicio</a></li>
  <li><a href="{{action('RolesController@index')}}">Grupos de usuario</a></li>
  <li><a class="active">Creación de un grupo de usuario</a></li>
</ol>
    <div class="row" id="box-wrapper">
    <!-- left column -->
        <div class="col-md-12">
        <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h4 class="box-title">Creación de grupo de usuario</h4>
                </div><!-- /.box-header -->
                <!-- form start -->

                    {!! Form::model($rol, ["url" => "administracion/roles", "method" => "POST", "class" =>"form-horizontal"]) !!}
                        @include('roles.partials.form', ["SubmitBtnText"=>"Crear", "disabled" =>""])
                    {!! Form::close() !!}

            </div><!-- /.box -->
        </div>
    </div>
@endsection
@section('script')
    <script>

    $(document).ready(function(){
$('[data-toggle="tooltip"]').tooltip()
$('#permisos-select').multiSelect({keepOrder:true});

    });


    </script>

    @endsection