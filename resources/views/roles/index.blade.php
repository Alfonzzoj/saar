@extends('app')

@section('content')
<ol class="breadcrumb">
  <li><a href="{{url('principal')}}">Inicio</a></li>
  <li><a class="active">Grupos de usuarios</a></li>
</ol>
<div class="row" id="box-wrapper">
    <!-- left column -->
    <div class="col-md-12">
    <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Grupos de usuario</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <div class="box-body"  id="container">
                <div class="row">
                    <div class="col-xs-12">
                        <ul class="list-group">
                            <li class="list-group-item" data-id="1">
                                <div class="media">
                                    <div class="pull-right media-right">
                                        <div class="btn-group-vertical  btn-group-xs" role="group" aria-label="...">
                                            <a class="btn btn-primary" href="{{ action('RolesController@create') }}">&nbsp;<span class="glyphicon glyphicon-plus"></span>&nbsp;</a>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="media-heading">Crear un nuevo grupo</h6>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <table class="table text-center">
                                    <thead class="bg-primary">
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Acción</th>
                                    </thead>
                                    <tbody>
                                    @foreach($roles as $r)
                                        <tr>
                                            <td class='text-justify'>{{$r->name}}</td>
                                            <td class='text-justify'>{{$r->description}}</td>
                                            <td>
                                                <div class='btn-group  btn-group-sm' role='group' aria-label='...'>
                                                    <button class='btn btn-primary' data-toggle="modal" data-target="#show-modal" data-id="{{$r->id}}"><span class='glyphicon glyphicon-eye-open'></span></button>
                                                    <a class='btn btn-warning' href='{{action('RolesController@edit', [$r->id])}}'><span class='glyphicon glyphicon-pencil' ></span></a>
                                                    <button class='btn btn-danger delete-rol-btn' data-id="{{$r->id}}"><span class='glyphicon glyphicon-remove'></span></button>
                                                    <a class='btn btn-default' href='{{action('RolesController@users', [$r->id])}}'><span class='glyphicon glyphicon-user' ></span></a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-xs-12 text-center">
                                        {!! $roles->appends(Input::except('page'))->render() !!}
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
            </div>
        </div><!-- /.box -->
    </div>
</div>
        <div class="modal fade" id="show-modal" tabindex="-1" role="dialog" aria-labelledby="cliente-show-modal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Grupos</h4>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('script')

<script>

$(document).ready(function(){
$('.delete-rol-btn').click(function(){
        var tr=$(this).closest('tr');
        var id=$(this).data("id");
        var url="{{url('administracion/roles')}}/"+id;
        $.
        ajax({url: url,
              method:"DELETE"})
        .done(function(response, status, responseObject){
            try{
                var obj= JSON.parse(responseObject.responseText);
                if(obj.success==1){
                    $(tr).remove();
                    alertify.success(obj.text);
                }
            }catch(e){
            console.log(e);
            alertify.error("Error en el servidor");
            }
        })
})
$('#show-modal').on('show.bs.modal', function (e) {
  var id=$(e.relatedTarget).data("id");
  $('#show-modal .modal-body').html("Cargando...")
                              .load("{{url('administracion/roles')}}/"+id, function(){
                              $('.modal-backdrop').css('height',"1000px")
                              $('#permisos-select, #usuarios-select').multiSelect();
                              });
})



})



</script>


@endsection