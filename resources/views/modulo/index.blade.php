@extends('app')


@section('content')
<ol class="breadcrumb">
  <li><a href="{{url('principal')}}">Inicio</a></li>
  <li><a class="active">Módulos</a></li>
</ol>
             <div class="row" id="box-wrapper">
              <!-- left column -->
              <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title">Gestión de Módulos</h3>
                        <div class="box-tools pull-right">
                         <a class="btn btn-primary" href="{{action("ModuloController@create")}}"><span class="glyphicon glyphicon-plus-sign"></span> Agregar un módulo</a>
                        </div><!-- /.box-tools -->
                  </div><!-- /.box-header -->
                  <!-- form start -->

                  <div class="box-body"  id="container">
                  @if(session()->has('invalidConcepts') && session('invalidConcepts')->count()>0)
                  <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Advertencia!</strong> Los siguientes conceptos no pudieron ser actualizados debido a que poseen facturas asociadas.
                    @foreach(session('invalidConcepts') as $c)
                    <br>{{$c->nompre}}
                    @endforeach
                  </div>


                  @endif
                    @if($conceptosSinModulosCantidad>0)
                        <p class="help-block">Existe/n {{$conceptosSinModulosCantidad}} concepto/s sin módulo asignado.</p>
                    @else
                        <p class="help-block">Todos los conceptos han sido asignados.</p>
                    @endif
                    <div class="row">
                      <div class="col-xs-12">
                        <ul class="list-group">
                        @foreach($modulos as $modulo)
                            <li class="list-group-item modulos-li" style="margin-bottom:-3px" title="{{$modulo->descripcion}}">
                                <div class="row">
                                    <div class="col-xs-10 shrinkable" style="cursor:pointer; padding-top:15px; padding-bottom:15px; margin-top:-15px; margin-bottom:-15px" data-min="7" data-max="10" data-target=".control-btns" data-is="max">
                                        {{$modulo->nombre}}
                                    </div>
                                    <div class="col-xs-2 text-right">
                                        <span class="badge {{($modulo->conceptosCantidad>0)?"bg-light-blue":""}}">{{$modulo->conceptosCantidad}}</span>
                                    </div>
                                    <div class="control-btns" style="display:none">
                                    <div  data-toggle="modal" data-target="#show-modal" data-id="{{$modulo->id}}" class="col-xs-1 text-center bg-light-blue info-modulo-btn" style="padding:15px; margin:-14px auto;cursor:pointer" >
                                        <span  class="glyphicon glyphicon-eye-open"></span>
                                    </div>
                                    <a href="{{action("ModuloController@edit", [$modulo->id])}}" >
                                    <div class="col-xs-1 text-center bg-yellow" style="padding:15px; margin:-14px auto;">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </div>
                                    </a>
                                    <div data-id="{{$modulo->id}}" data-nombre="{{$modulo->nombre}}" data-predeterminado="{{$modulo->isPredeterminado}}" class="col-xs-1 text-center bg-red delete-modulo-btn" style="padding:15px; margin:-14px auto;cursor:pointer" >
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        </ul>
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                </div><!-- /.box -->
              </div>
            </div>
        <!-- Modal -->
        <div class="modal fade" id="show-modal" tabindex="-1" role="dialog" aria-labelledby="cliente-show-modal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Módulo</h4>
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

    $('.shrinkable').click(function(){
        var data=$(this).data();
        var li=$(this).closest('li');
        switch(data.is){
            case "max":
                $(this).switchClass("col-xs-"+data.max,"col-xs-"+data.min,function(){$(li).find(data.target).show();} );
                $(this).data('is','min');
            break;

            case "min":
                $(li).find(data.target).hide();
                $(this).switchClass("col-xs-"+data.min,"col-xs-"+data.max );
                $(this).data('is','max');
            break;
        }
    })

    $('.delete-modulo-btn').click(function(){
        var li=$(this).closest('li');
        var data=$(this).data();
        if(data.predeterminado){
            alertify.log("Este es un modulo predeterminado del sistema no puede ser eliminado");
            return;
        }
        var url="{{url('administracion/modulo')}}/"+data.id;
        alertify.confirm("Desea eliminar el Módulo de "+data.nombre+"?. Los conceptos asociados seran liberados", function (e) {
    if (e) {
        $.
        ajax({url: url,
              method:"DELETE"})
        .done(function(response, status, responseObject){
            try{
                var obj= JSON.parse(responseObject.responseText);
                if(obj.success==1){
                    $(li).remove();
                    alertify.success(obj.text);
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
  $('#show-modal .modal-body').html("Cargando...")
                              .load("{{url('administracion/modulo')}}/"+id, function(){
                              $('.modal-backdrop').css('height',"1000px")
                              $('#conceptos-select').multiSelect();
                              });
})

})


</script>

@endsection