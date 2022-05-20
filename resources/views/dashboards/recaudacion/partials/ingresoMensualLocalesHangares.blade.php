<div class="box box-info">
    <div class="box-header">
      <div class="box-header with-border">
        <h3 class="box-title text-center" style="display: block;"><b> Ingreso Mensual Locales-Hangares</b></h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
    </div>
    <div class="box-body">
      <div class="row" style="margin-top :15px;">
        <div style="" class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box bg-blue">
              <span class="info-box-icon"><i class="fa fa-home"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">HANGARES</span>
                <span class="info-box-number">Bs. {{ $traductor->format($hangares) }}  </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div style="" class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box bg-blue">
              <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">LOCALES COMERCIALES</span>
                <span class="info-box-number">Bs. {{ $traductor->format($locales) }}  </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

         
          <div style="" class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box bg-blue">
              <span class="info-box-icon"><i class="fa fa-calculator"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">TOTAL</span>
                <span class="info-box-number">Bs. {{ $traductor->format($hangares + $locales) }}  </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div>
      </div>
</div>
