@extends('app')
@section('content')
<ol class="breadcrumb">
  <li><a href="{{url('principal')}}">Inicio</a></li>
  <li><a class="active">Clientes</a></li>
</ol>
<div class="row" id="box-wrapper">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Filtros</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div><!-- /.box-tools -->
            </div>
            <div class="box-body text-right">
                {!! Form::open(["url" => "administracion/cliente", "method" => "GET", "class"=>"form-inline"]) !!}
                @include('cliente.partials.filters', ["resetHref" => "cliente"])
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Clientes</h3>
            </div>
            <div class="box-body" >
                <div class="row">
                    <div class="col-xs-12">
                        <ul class="list-group">
                            <li class="list-group-item" data-id="1">
                                <div class="media">
                                    <div class="pull-right media-right">
                                        <div class="btn-group-vertical  btn-group-xs" role="group" aria-label="...">
                                            <a class="btn btn-primary" href="{{ URL::to('administracion/cliente/create') }}">&nbsp;<span class="glyphicon glyphicon-plus"></span>&nbsp;</a>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="media-heading">Crear un nuevo cliente</h6>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                @include('cliente.partials.table', ["selectButton" => false])
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="show-modal" tabindex="-1" role="dialog" aria-labelledby="cliente-show-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Cliente</h4>
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

        $('.delete-cliente-btn').click(function(){
            var tr=$(this).closest('tr');
            var id=$(this).data("id");
            var url="{{url('administracion/cliente')}}/"+id;
            alertify.confirm("Desea eliminar el cliente seleccionado?", function (e) {
                if (e) {
                    $.ajax({url: url, method:"DELETE"})
                    .done(function(response, status, responseObject){
                        try{
                            var obj= JSON.parse(responseObject.responseText);
                            if(obj.success==1){
                                $(tr).remove();
                                alertify.success(obj.text);
                            }else{
                                alertify.error(obj.text);
                            }
                        }catch(e){
                            console.log(e);
                            alertify.error("Error en el servidor");
                        }
                    })
                }
            });
        })

        $('#show-modal').on('show.bs.modal', function (e) {
          var id=$(e.relatedTarget).data("id");
          $('#show-modal .modal-body').html("Cargando...").load("{{url('administracion/cliente')}}/"+id, function(){
              $('#hangars-select').multiSelect({keepOrder:true});
              $('.modal-backdrop').css('height',"1000px")
          });
        })


    })

</script>

@endsection