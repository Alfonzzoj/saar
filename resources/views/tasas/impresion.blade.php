 @include('shared.header')
 @include('shared.menu')
             <div class="row" id="box-wrapper">
              <!-- left column -->
              <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title">Impresion de tasas</h3>
                  </div><!-- /.box-header -->
                  <!-- form start -->

                  <div class="box-body"  id="container">
                    <div class="form-horizontal">



  <div class="form-group">
    <label class="col-xs-3 control-label">Fecha</label>
    <div class="col-xs-7">
      <input class="form-control" id="fecha-input" name="indicador" type="text" autocomplete="off"></input>
    </div>
  </div>



  <div class="form-group">
    <label class="col-xs-3 control-label">Serie</label>
    <div class="col-xs-7">
      <select class="form-control">  
<option>A</option>
<option>B</option>
<option>C</option>
<option>Exonerado</option>
      </select>
    </div>
  </div>
    <div class="form-group">
    <label class="col-xs-3 control-label">Monto</label>
    <div class="col-xs-7">
      <select class="form-control">  
<option>85</option>
<option>170</option>
<option>0</option>

      </select>
    </div>
  </div>



  <div class="form-group">
    <label class="col-xs-3 control-label">Tipo de tasas</label>
    <div class="col-xs-7">
      <select class="form-control">  
<option>Nacional</option>
<option>Internacional</option>


      </select>
    </div>
  </div>
    <div class="form-group">
    <label class="col-xs-3 control-label">Cantidad</label>
    <div class="col-xs-7">
      <input class="form-control" id="cedula-input" name="cedula" type="number" autocomplete="off"></input>
    </div>
  </div>










</div>
           

                  </div><!-- /.box-body -->
                  <div class="box-footer">
<button class="btn btn-primary"> Imprimir </button>
                  </div>
                </div><!-- /.box -->
              </div>
            </div>
                  @include('shared.footer')

                  <script>
$(document).ready(function(){
  $('#fecha-input').datepicker({
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


});


                  </script>