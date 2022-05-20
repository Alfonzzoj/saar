@extends('app')
@section('content')
<ol class="breadcrumb">
  <li><a href="{{url('principal')}}">Inicio</a></li>
  <li><a href="{{action('ConceptoController@index')}}">Conceptos</a></li>
  <li><a class="active">Edición de concepto</a></li>
</ol>
         <div class="row" id="box-wrapper">
              <!-- left column -->
              <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">

                  <div class="box-header">
                    <h3 class="box-title">Edición de concepto</h3>
                  </div><!-- /.box-header -->
                  <!-- form start -->
                    {!! Form::model($concepto, ['route' => ['administracion.concepto.update', $concepto->id], "method" => "PUT", "class" => "form-horizontal"]) !!}
                        @include('concepto.partials.form', ["SubmitBtnText"=>"Modificar", "disabled" =>"", "readonly"=>"readonly"])
                    {!! Form::close() !!}
                </div><!-- /.box -->
              </div>
            </div>


@endsection
