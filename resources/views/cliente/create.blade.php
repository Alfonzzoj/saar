@extends('app')
@section('content')
<ol class="breadcrumb">
  <li><a href="{{url('principal')}}">Inicio</a></li>
  <li><a href="{{action('ClienteController@index')}}">Clientes</a></li>
  <li><a class="active">Creación de cliente</a></li>
</ol>
         <div class="row" id="box-wrapper">
              <!-- left column -->
              <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">

                  <div class="box-header">
                    <h3 class="box-title">Creación de Cliente</h3>
                  </div><!-- /.box-header -->
                  <!-- form start -->
                    {!! Form::model($cliente, ["url" => "administracion/cliente", "method" => "POST"]) !!}
                        @include('cliente.partials.form', ["SubmitBtnText"=>"Crear", "disabled" =>""])
                    {!! Form::close() !!}
                </div><!-- /.box -->
              </div>
            </div>


@endsection
@section('script')

 <script>

    $(document).ready(function(){

        $('#hangars-select').multiSelect({keepOrder:true});

        $('#ingre_fecha-datepicker').datepicker({
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
            dateFormat: "dd/mm/yy"
        });

        $('.operator-list li').click(function(){
            var value=$(this).text();
            var formGroup=$(this).closest('.form-group');
            $(formGroup).find('.operator-text').text(value);
            $(formGroup).find('.operator-input').val(value);
        });

        $('.operator-list li:first').trigger('click');

        $('select[name=tipo]').change(function(){
            var value=$(this).val();
                    if(value=='No Aeronáutico')
                        $('a[href=#aeronautico]').removeAttr('data-toggle');
                    else
                        $('a[href=#aeronautico]').attr('data-toggle','tab');
        })

         $('a[href=#aeronautico]').click(function(){
            if(!$(this).attr('data-toggle'))
                alertify.error('"Información Aeronáutica" no esta disponible con tipo "No Aeronáutico"');
         })
    });


</script>
    @endsection