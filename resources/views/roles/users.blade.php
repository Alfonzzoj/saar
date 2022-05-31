@extends('app')
@section('content')
<ol class="breadcrumb">
  <li><a href="{{url('principal')}}">Inicio</a></li>
  <li><a href="{{action('RolesController@index')}}">Grupos de usuario</a></li>
  <li><a class="active">Asignación de usuarios a un grupo de usuario</a></li>
</ol>
    <div class="row" id="box-wrapper">
    <!-- left column -->
        <div class="col-md-12">
        <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h4 class="box-title">Asignación de usuarios al grupo</h4>
                </div><!-- /.box-header -->
                <!-- form start -->
                {!! Form::model($rol, ["url" => action('RolesController@syncUsers',[$rol->id]), "method" => "POST", "class" =>"form-horizontal"]) !!}
                    <div class="box-body"  id="container">
                        <h5>Usuarios</h5>
                        <div class='form-group'>
                            <div class='col-xs-6 text-center'>
                                <label><strong>Por Asignar</strong></label>
                            </div>

                            <div class='col-xs-6 text-center'>
                                <label><strong>Asignados</strong></label>
                            </div>
                            <div class='col-xs-12'>
                                {!! Form::select('usuarios[]',$usuarios, $rol->users->lists('id'), [ 'id'=>'usuarios-select', 'class'=>"form-control", 'multiple', 'autocomplete'=>'off']) !!}
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button class="btn btn-primary"> Guardar </button>
                    </div>
                {!! Form::close() !!}
            </div><!-- /.box -->
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('#usuarios-select').multiSelect({keepOrder:true});
        });
    </script>
@endsection