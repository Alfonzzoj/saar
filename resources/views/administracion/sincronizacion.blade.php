 @include('shared.header')
 @include('shared.menu')

 <div class="row" id="box-wrapper">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Sincronizacion de datos</h3>
      </div><!-- /.box-header -->
      <!-- form start -->

      <div class="box-body"  id="container">
                    <div class="form-group">
                      <label for="active-input">Año</label>
                      <select class="form-control">
                        <option>2015</option>
                        <option>2014</option>
                        <option>2013</option>
                        <option>2012</option>
                        <option>2011</option>
                        <option>2010</option>
                        <option>2009</option>
                        <option>2008</option>
                        <option>...</option>
                      </select>
                    </div>
        <div class="row">


          <div class="col-xs-12">

            <ul class="list-group">
              <li class="list-group-item">
<button class="btn btn-success sync-btn">Sincronizar seleccion</button>

              </li>
              <li class="list-group-item">
                <div class="media">
                  <div class="media-left">
                    <div class="checkbox ">
                      <label>
                        <input type="checkbox" class="sync-check"> 
                      </label>
                    </div>
                  </div>
                  <div class="media-body">
                    <h4 class="media-heading">Retenciones <span class="pull-right"><button class="btn btn-success sync-btn">Sincronizar</button></span></h4>
                    Ultima sincronizacion 00/00/0000
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="media">
                  <div class="media-left">
                    <div class="checkbox ">
                      <label>
                        <input type="checkbox" class="sync-check"> 
                      </label>
                    </div>
                  </div>
                  <div class="media-body">
                    <h4 class="media-heading">Cuentas bancarias <span class="pull-right"><button class="btn btn-success sync-btn">Sincronizar</button></span></h4>
                    Ultima sincronizacion 00/00/0000
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="media">
                  <div class="media-left">
                    <div class="checkbox ">
                      <label>
                        <input type="checkbox" class="sync-check"> 
                      </label>
                    </div>
                  </div>
                  <div class="media-body">
                    <h4 class="media-heading">Conceptos <span class="pull-right"><button class="btn btn-success sync-btn">Sincronizar</button></span></h4>
                    Ultima sincronizacion 00/00/0000
                  </div>
                </div>
              </li>
             <li class="list-group-item">
                <div class="media">
                  <div class="media-left">
                    <div class="checkbox ">
                      <label>
                        <input type="checkbox" class="sync-check"> 
                      </label>
                    </div>
                  </div>
                  <div class="media-body">
                    <h4 class="media-heading">Cobros <span class="pull-right"><button class="btn btn-success sync-btn">Sincronizar</button></span></h4>
                    Ultima sincronizacion 00/00/0000
                  </div>
                </div>
              </li>

            </ul>

          </div>
        </div>

      </div><!-- /.box-body -->

    </div><!-- /.box -->
  </div>
</div>

<div id="progress-modal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" data-keyboard="false" data-backdrop="static" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Sincronizando....</h4>
      </div>
      <div class="modal-body">
<div class="progress">
  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">

  </div>
</div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@include('shared.footer')


<script>
var progress=0;
var interval=null;
$(document).ready(function(){
$('.sync-btn').click(function(){

$('#progress-modal').modal('show');
interval=setInterval(function(){ 
  if(progress==100){
    clearInterval(interval);
    progress=0;
    $('#progress-modal').modal('hide');
    alert("Se ha sincronizado correctamente.")
    return;
  }
  $('#progress-modal .progress-bar').css("width",(progress)+"%");
  progress+=5;

},200);



})
})

</script>