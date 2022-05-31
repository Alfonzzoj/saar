@extends('app')
@section('content')
<ol class="breadcrumb">
  <li><a href="{{url('principal')}}">Inicio</a></li>
  <li><a href="{{action('ContratoController@index')}}">Contratos</a></li>
  <li><a class="active">Creación de contrato</a></li>
</ol>
    <div class="row" id="box-wrapper">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Formulario de contratos</h3>
                </div>
                {!! Form::open(["action" => 'ContratoController@store', "method" => "POST", "enctype" => "multipart/form-data"]) !!}
                    @include('contrato.partials.form', ["SubmitBtnText"=>"Crear", "disabled" =>""])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="modal fade" id="advance-search-modal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Busqueda avanzada de cliente</h4>
          </div>
          <div class="modal-body">


      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('script')
  <script>
      var ajaxClienteTableStartUrl='{{url('administracion/cliente')}}';

      function getClientTable(url){$('#advance-search-modal .modal-body').load(url, function(){$.AdminLTE.boxWidget.activate();});}
      $(document).ready(function(){

          $('#img-input').change(function(){
            readURL(this,'#img-preview');
          })

          $('#inicio-datepicker, #vencimiento-datepicker').datepicker({
            closeText: 'Cerrar',
            prevText: '&#x3C;Ant',
            nextText: 'Sig&#x3E;',
            currentText: 'Hoy',
            monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
            'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
            'Jul','Ago','Sep','Oct','Nov','Dic'],
            dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
            dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
            dayNamesMin: ['D','L','M','M','J','V','S'],
            weekHeader: 'Sm',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: '',
            dateFormat: "dd/mm/yy"});

            /*
            *   Funcion para iniciar el modal de busqueda de cliente
            */
              getClientTable(ajaxClienteTableStartUrl)

              /*
              *   Funcion para darle accion al ordenamiento por columna al darle click al header
              */
            $('#advance-search-modal .modal-body').delegate('.operator-list li', 'click', function(){
                var value=$(this).text();
                var formGroup=$(this).closest('.form-group');
                $(formGroup).find('.operator-text').text(value);
                $(formGroup).find('.operator-input').val((value=="Todos")?"_":value);
            })

              /*
              *   Funcion para pasar de pagina
              */

              $('#advance-search-modal .modal-body').delegate('.pagination li a', 'click', function(e){
              e.preventDefault();
                //Hay que quitar el slash antes del ?, no se como no generarlo pero replace resuelve.
                getClientTable($(this).attr('href').replace("/?", "?"));
              })

                /*
                *   Funcion para reinciiar los filtros
                */

              $('#advance-search-modal .modal-body').delegate('.cliente-reset-btn', 'click', function(e){
              e.preventDefault();

                getClientTable(ajaxClienteTableStartUrl);
              })

                /*
                *   Funcion para buscar por los filtros
                */

                $('#advance-search-modal .modal-body').delegate('#cliente-filter-btn', 'click', function(e){
                e.preventDefault();
                var container=$(this).closest('.box-body');
                console.log(container,$(container).find('input[name="sortName"]').val());
                var getParametersString="?";
                var getParametersObject={
                     sortName : $(container).find('input[name="sortName"]').val(),
                     sortType : $(container).find('input[name="sortType"]').val(),
                     codigo : $(container).find('input[name="codigo"]').val(),
                     nombre : $(container).find('input[name="nombre"]').val(),
                     cedRifPrefix : $(container).find('input[name="cedRifPrefix"]').val(),
                     cedRif : $(container).find('input[name="cedRif"]').val(),
                     tipo : $(container).find('select[name="tipo"]').val()
                }
                for(var index in getParametersObject){
                    var value=getParametersObject[index];
                    getParametersString+=index+"="+encodeURI(value)+"&";
                }
                getParametersString= getParametersString.substring(0, getParametersString.length - 1);
                getClientTable(ajaxClienteTableStartUrl+getParametersString);
                })

                  /*
                  *   Funcion para seleccionar un cliente y colocarlo en el formulario de factura
                  */

                $('#advance-search-modal .modal-body').delegate('.select-client-btn', 'click', function(e){
                    e.preventDefault();
                    var clienteId=$(this).data('id');
                    $('#cliente-select').val(clienteId).trigger('chosen:updated').trigger('change');
                    $('#advance-search-modal').modal('hide');

                })
                  $('#cliente-select').chosen({width: "100%"}).change(function(){
                  var option=$('#cliente-select option:selected');
                    var nombre=$(option).data('nombre');
                    var cedRif=$(option).data('cedRifPrefix')+$(option).data('cedRif');
                    $('#cliente_nombre-input').val(((nombre)?nombre:""));
                    $('#cliente_cedRif-input').val(((cedRif)?cedRif:""));
                  }).trigger('change');

                  $('#concepto-input').chosen({width:"100%"})
      })
  </script>
  @endsection