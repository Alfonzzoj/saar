<div class="row">
	<div class="col-xs-3 col-xs-6">
		<!-- Caja 1 -->
		<div class="small-box bg-aqua">
			<div class="inner">
			<h3>{{$embarqueTotal}}</h3>
				<p>PASAJEROS EMBARCADOS</p>
			</div>
			<div class="icon">
				<i class="ion-ios-cloud-upload"></i>
			</div>
		</div>
	</div><!-- ./col -->
	<div class="col-xs-3 col-xs-6">
		<!-- Caja 2 -->
		<div class="small-box bg-red">
			<div class="inner">
			<h3>{{$desembarqueTotal}}</h3>
				<p>PASAJEROS DESEMBARCADOS</p>
			</div>
			<div class="icon">
				<i class="ion-ios-cloud-download"></i>
			</div>
		</div>
	</div><!-- ./col -->
	<div class="col-xs-3 col-xs-6">
		<!-- Caja 3 -->
		<div class="small-box bg-green">
			<div class="inner">
			<h3>{{$transitoTotal}}</h3>
				<p>PASAJEROS EN TRÁNSITO</p>
			</div>
			<div class="icon">
				<i class="ion ion-plane"></i>
			</div>
		</div>
	</div><!-- ./col -->
	<div class="col-xs-3 col-xs-6">
		<!-- Caja 4 -->
		<div class="small-box bg-yellow">
			<div class="inner">
			<h3>{{$embarqueTotal+$desembarqueTotal+$transitoTotal}}</h3>
				<p>TOTAL DE PASAJEROS</p>
			</div>
			<div class="icon">
				<i class="ion-android-contacts"></i>
			</div>
		</div>
	</div><!-- ./col -->
	<div style="margin-top: -10px" class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box">
			<span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">COMERCIALES</span>
				<div class="col-sm-6 ">
					<span class="info-box-number"><i class="fa fa-plane" style="transform: rotate(90deg);"></i> {{($aterrizajesComerciales)}}</span>
					<span class="info-box-number"><i class="fa fa-user"></i><i class="fa fa-long-arrow-down"></i> {{($desembarqueComercial)}}</span>
				</div>
				<div class="col-sm-6">
					<span class="info-box-number"><i class="fa fa-plane"></i> {{($despeguesComerciales)}}</span>
					<span class="info-box-number"><i class="fa fa-user"></i><i class="fa fa-long-arrow-up"></i> {{($embarqueComercial)}}</span>
				</div>
			</div><!-- /.info-box-content -->
		</div><!-- /.info-box -->
	</div><!-- /.col -->

	<div style="margin-top: -10px" class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box">
			<span class="info-box-icon bg-red"><i class="fa fa-lock"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">PRIVADOS</span>
				<div class="col-sm-6 ">
					<span class="info-box-number"><i class="fa fa-plane" style="transform: rotate(90deg);"></i> {{($aterrizajesPrivados)}}</span>
					<span class="info-box-number"><i class="fa fa-user"></i><i class="fa fa-long-arrow-down"></i> {{($desembarquePrivado)}}</span>
				</div>
				<div class="col-sm-6">
					<span class="info-box-number"><i class="fa fa-plane"></i> {{($despeguesPrivados)}}</span>
					<span class="info-box-number"><i class="fa fa-user"></i><i class="fa fa-long-arrow-up"></i> {{($embarquePrivado)}}</span>
				</div>
			</div><!-- /.info-box-content -->
		</div><!-- /.info-box -->
	</div><!-- /.col -->

	<!-- fix for small devices only -->
	<div class="clearfix visible-sm-block"></div>

	<div style="margin-top: -10px" class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box">
			<span class="info-box-icon bg-green"><i class="ion ion-plane"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">COMERCIAL PRIVADO</span>
				<div class="col-sm-6">
					<span class="info-box-number"><i class="fa fa-plane" style="transform: rotate(90deg);"></i> {{($aterrizajesComercialPrivado)}}</span>
					<span class="info-box-number"><i class="fa fa-user"></i><i class="fa fa-long-arrow-down"></i> {{($desembarqueComercialPrivado)}}</span>
				</div>
				<div class="col-sm-6">
					<span class="info-box-number"><i class="fa fa-plane"></i> {{($despeguesComercialPrivado)}}</span>
					<span class="info-box-number"><i class="fa fa-user"></i><i class="fa fa-long-arrow-up"></i> {{($embarqueComercialPrivado)}}</span>
				</div>
			</div><!-- /.info-box-content -->
		</div><!-- /.info-box -->
	</div><!-- /.col -->
	<div style="margin-top: -10px" class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box">
			<span class="info-box-icon bg-yellow"><i class="fa fa-rocket"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">OTROS VUELOS</span>
				<div class="col-sm-6">
					<span class="info-box-number"><i class="fa fa-plane" style="transform: rotate(90deg);"></i> {{($otrosAterrizajes)}}</span>
					<span class="info-box-number"><i class="fa fa-user"></i><i class="fa fa-long-arrow-down"></i> {{($desembarqueOtrosVuelos)}}</span>
				</div>
				<div class="col-sm-6">
					<span class="info-box-number"><i class="fa fa-plane"></i> {{($otrosDespegues)}}</span>
					<span class="info-box-number"><i class="fa fa-user"></i><i class="fa fa-long-arrow-up"></i> {{($embarqueOtrosVuelos)}}</span>
				</div>
			</div><!-- /.info-box-content -->
		</div><!-- /.info-box -->
	</div><!-- /.col -->
</div><!-- /.row -->
