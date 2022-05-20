@extends('app')


@section('content')
<ol class="breadcrumb">
  <li><a href="{{url('principal')}}">Inicio</a></li>
  <li><a class="active">Conceptos</a></li>
</ol>
             <div class="row" id="box-wrapper">
              <!-- left column -->
              <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title">Gestión de Conceptos</h3>

        <div class="box-tools pull-right">
                         <a class="btn btn-primary" href="{{action("ConceptoController@create")}}"><span class="glyphicon glyphicon-plus-sign"></span> Agregar un concepto</a>
                        </div>
                  </div><!-- /.box-header -->
                  <!-- form start -->

                  <div class="box-body"  id="container">
                    <div class="row">
                      <div class="col-xs-12">
                        <ul class="list-group">
                        @foreach($conceptos as $concepto)
                            <li class="list-group-item modulos-li" style="margin-bottom:-3px" title="{{$concepto->descripcion}}">
                                <div class="row">
                                    <div class="col-xs-12 shrinkable" style="cursor:pointer; padding-top:15px; padding-bottom:15px; margin-top:-15px; margin-bottom:-15px" data-min="10" data-max="12" data-target=".control-btns" data-is="max">
                                        {{$concepto->nompre}}
                                        <span class="pull-right">IVA {{$concepto->iva}} %</span>
                                    </div>

                                    <div class="control-btns" style="display:none">
                                    <div  data-toggle="modal" data-target="#show-modal" data-id="{{$concepto->id}}" class="col-xs-1 text-center bg-light-blue info-modulo-btn" style="padding:15px; margin:-14px auto;cursor:pointer" >
                                        <span  class="glyphicon glyphicon-eye-open"></span>
                                    </div>
                                    <a href="{{action("ConceptoController@edit", [$concepto->id])}}" >
                                    <div class="col-xs-1 text-center bg-yellow" style="padding:15px; margin:-14px auto;">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </div>
                                    </a>
{{--       no deberia poder eliminar conceptos por el sistema

  <div data-id="{{$concepto->id}}" data-nombre="{{$concepto->nompre}}" class="col-xs-1 text-center bg-red delete-concepto-btn" style="padding:15px; margin:-14px auto;cursor:pointer" >
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </div>--}}
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
                        <h4 class="modal-title" id="myModalLabel">Concepto</h4>
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

    $('.delete-concepto-btn').click(function(){
        var li=$(this).closest('li');
        var data=$(this).data();
        var url="{{url('administracion/concepto')}}/"+data.id;
        alertify.confirm("Desea eliminar el concepto de "+data.nombre+"?. Los conceptos asociados seran liberados", function (e) {
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
                              .load("{{url('administracion/concepto')}}/"+id, function(){
                              $('.modal-backdrop').css('height',"1000px")
                              });
})

})


</script>

@endsection