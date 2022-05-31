<div class="row" style="margin-top :15px;">
  <div style="" class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box bg-blue">
            <span class="info-box-icon"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Recaudado</span>
              <span class="info-box-number">Bs. {{ $traductor->format($cobrado) }}  </span>

              <div class="progress">
                <div class="progress-bar" style="width: {{ round((($cobrado/$facturado)*100),1) }}%;"></div>
              </div>
                  <span class="progress-description">
                    {{ round((($cobrado/$facturado)*100),1) }}%
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div style="" class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-calculator"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Por Cobrar</span>
              <span class="info-box-number">Bs. {{ $traductor->format($porCobrar) }}  </span>

              <div class="progress">
                <div class="progress-bar" style="width: {{ round((($porCobrar/$facturado)*100),1) }}%;"></div>
              </div>
                  <span class="progress-description">
                     {{ round((($porCobrar/$facturado)*100),1) }}%
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div style="" class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box" >
            <span class="info-box-icon bg-yellow"><i class="fa fa-plane"></i></span>
            <div class="row" style="padding:0px; margin:0px;">
              <div class="row" style="padding-top: 5px; margin:0; margin-top:10px; padding-left: 100px;">
                <div class="col-4"></div>
                <div class="col-4">
                  <div class="row" style="padding:0; margin: 0;">
                    <div class="col-sm-6" style="padding:0; margin: 0;">
                      <span style="font-size: 15px;">PRIVADOS</span>
                    </div>
                    <div class="col-sm-6" style="padding:0; margin: 0;">
                      <span class="" style="font-size: 16px;"><i class="fa fa-plane" style="transform: rotate(90deg);"></i> {{$aterrizajesPrivados}}</span>  
                      <span class="" style="font-size: 16px; margin-left: 8px;"><i class="fa fa-plane"></i> {{$aterrizajesPrivados}}</span>
                    </div>
                    <div class="col-sm-6" style="padding:0; margin: 0;">
                      <span style="font-size: 15px;">COMERCIALES</span>
                    </div>
                    <div class="col-sm-6" style="padding:0; margin: 0;">
                      <span class="" style="font-size: 16px;"><i class="fa fa-plane" style="transform: rotate(90deg);"></i> {{$aterrizajesComerciales}}</span>  
                      <span class="" style="font-size: 16px; margin-left: 8px;"><i class="fa fa-plane"></i> {{$despeguesComerciales}}</span>
                    </div>
                    <div class="col-sm-12" style="padding:0; margin: 0;">
                      <span style="font-size: 10px;"><b>Operaciones del día de hoy.</b></span>
                    </div>
                </div>
                </div>
                <div class="col-4">
                  <div class="row" style="padding:0; margin: 0;">
                    
                </div>
              </div>
           </div>
          </div><!-- /.info-box -->
      </div><!-- /.col -->
    </div>
</div>
