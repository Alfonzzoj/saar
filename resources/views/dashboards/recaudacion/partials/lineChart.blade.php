<div class="box box-info">
	<input type="number" id="anno" name="anno" class="hidden" value="{{ $anno }}">
	<div class="box-header with-border">
  		<h3 class="box-title text-center" style="display: block;"><b>Situación Actual de Recaudación - {{ $anno }}</b></h3>
  		<div class="box-tools pull-right">
  			<button id="prev-year" type="button" class="btn btn-box-tool"><i class="fa fa-arrow-left"></i></button>
    		<button id="next-year" type="button" class="btn btn-box-tool"><i class="fa fa-arrow-right"></i></button>
    		<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    		<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
 	 	</div>
	</div>
	<div class="box-body">
 		<div class="chart">
    		<canvas id="myChart" width="507" height="100"></canvas>
  		</div>
	</div>
<!-- /.box-body -->
</div>
