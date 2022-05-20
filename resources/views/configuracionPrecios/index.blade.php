@extends('app')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		<i class="ion-settings"></i>
		Configuración del Sistema
	</h1>
</section>

<!-- Main content -->
<section class="invoice">

	<!-- info row -->
	<div class="row invoice-info">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#General-tab" data-toggle="tab">General</a>
				</li>
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown">Aviación Comercial <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#aviacionComercialNacional-tab" data-toggle="tab">Matricula Nacional</a></li>
                        <li><a href="#aviacionComercialExtranjera-tab" data-toggle="tab">Matrícula Extranjera</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown">Aviación General <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#aviacionGeneralNacional-tab" data-toggle="tab">Matricula Nacional</a></li>
                        <li><a href="#aviacionGeneralExtranjera-tab" data-toggle="tab">Matrícula Extranjera</a></li>
                    </ul>
                </li>
				<li>
					<a href="#Carga-tab" data-toggle="tab">Carga</a>
				</li>
				<li>
					<a href="#Horarios-tab" data-toggle="tab">Horarios</a>
				</li>
				<li>
					<a href="#otrosCargos-tab" data-toggle="tab">Otros Cargos</a>
				</li>
 				<li>
					<a href="#cargosVarios-tab" data-toggle="tab">Cargos Varios</a>
				</li>
			</ul>
			<div class="tab-content">

				<!-- Configuración General del Sistema -->
				<div class="tab-pane active" id="General-tab">
					
					@include('configuracionPrecios.confGeneral.partials.edit')

				</div><!-- /.tab-pane -->

				<!-- Configuración de Aviación Comercial -->
				<div class="tab-pane" id="aviacionComercialNacional-tab">
					<h4 class="text-center">Aviación Comercial - Matrícula Nacional</h4>
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="#estacionamientoComercialNacional-tab" data-toggle="tab">Estacionamiento</a>
							</li>
							<li>
								<a href="#aterrizajeComercialNacional-tab" data-toggle="tab">Aterrizaje y Despegue</a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active estacionamientoAeronave-tab" id="estacionamientoComercialNacional-tab">
								@include('configuracionPrecios.confEstacionamientoAeronave.Comercial.matriculaNacional.partials.edit')
							</div>
							<div class="tab-pane precioAterrizajeDespegue-tab" id="aterrizajeComercialNacional-tab">
								@include('configuracionPrecios.confAterrizajeDespegue.Comercial.matriculaNacional.partials.edit')
							</div>
						</div>
					</div><!-- /.nav-tabs-custom -->
				</div><!-- /.tab-pane -->


				<!-- Configuración de Aviación Comercial -->
				<div class="tab-pane" id="aviacionComercialExtranjera-tab">
					<h4 class="text-center">Aviación Comercial - Matrícula Extranjera</h4>
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="#estacionamientoComercialExtranjera-tab" data-toggle="tab">Estacionamiento</a>
							</li>
							<li>
								<a href="#aterrizajeComercialExtranjera-tab" data-toggle="tab">Aterrizaje y Despegue</a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active estacionamientoAeronave-tab" id="estacionamientoComercialExtranjera-tab">
								@include('configuracionPrecios.confEstacionamientoAeronave.Comercial.matriculaExtranjera.partials.edit')
							</div>
							<div class="tab-pane precioAterrizajeDespegue-tab" id="aterrizajeComercialExtranjera-tab">
								@include('configuracionPrecios.confAterrizajeDespegue.Comercial.matriculaExtranjera.partials.edit')
							</div>
						</div>
					</div><!-- /.nav-tabs-custom -->
				</div><!-- /.tab-pane -->

				<!-- Configuración de Aviación General -->
				<div class="tab-pane" id="aviacionGeneralNacional-tab">
					<h4 class="text-center">Aviación General - Matrícula Nacional</h4>
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="#estacionamientoGeneralNacional-tab" data-toggle="tab">Estacionamiento</a>
							</li>
							<li>
								<a href="#aterrizajeGeneralNacional-tab" data-toggle="tab">Aterrizaje y Despegue</a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active estacionamientoAeronave-tab" id="estacionamientoGeneralNacional-tab">
								@include('configuracionPrecios.confEstacionamientoAeronave.General.matriculaNacional.partials.edit')
							</div>
							<div class="tab-pane precioAterrizajeDespegue-tab" id="aterrizajeGeneralNacional-tab">
								@include('configuracionPrecios.confAterrizajeDespegue.General.matriculaNacional.partials.edit')
							</div>
						</div>
					</div><!-- /.nav-tabs-custom -->
				</div><!-- /.tab-pane -->

				<!-- Configuración de Aviación General -->
				<div class="tab-pane" id="aviacionGeneralExtranjera-tab">
					<h4 class="text-center">Aviación General - Matrícula Extranjera</h4>
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="#estacionamientoGeneralExtranjera-tab" data-toggle="tab">Estacionamiento</a>
							</li>
							<li>
								<a href="#aterrizajeGeneralExtranjera-tab" data-toggle="tab">Aterrizaje y Despegue</a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active estacionamientoAeronave-tab" id="estacionamientoGeneralExtranjera-tab">
								@include('configuracionPrecios.confEstacionamientoAeronave.General.matriculaExtranjera.partials.edit')
							</div>
							<div class="tab-pane precioAterrizajeDespegue-tab" id="aterrizajeGeneralExtranjera-tab">
								@include('configuracionPrecios.confAterrizajeDespegue.General.matriculaExtranjera.partials.edit')
							</div>
						</div>
					</div><!-- /.nav-tabs-custom -->
				</div><!-- /.tab-pane -->

				<!-- Configuración de Estacionamiento -->
				{{-- <div class="tab-pane" id="aviacionGeneralNacional-tab">

					@include('configuracionPrecios.confEstacionamientoAeronave.partials.edit')


				</div> --}}<!-- /.tab-pane -->

				<!-- Otros Cargos-->
				<div class="tab-pane" id="Horarios-tab">

					@include('configuracionPrecios.confHorarioAeronautico.partials.edit')


				</div><!-- /.tab-pane -->

				<!-- Otros Cargos -->
				<div class="tab-pane" id="otrosCargos-tab">

	 				@include('configuracionPrecios.confOtrosCargos.index') 

				</div><!-- /.tab-pane -->



				<!-- Otras Configuraciones -->
				<div class="tab-pane" id="cargosVarios-tab">

	 				@include('configuracionPrecios.confCargosVarios.partials.edit') 

				</div><!-- /.tab-pane -->

				<!-- Otras Configuraciones -->
				<div class="tab-pane" id="Carga-tab">

					@include('configuracionPrecios.confCarga.partials.edit')

				</div><!-- /.tab-pane -->

			</div><!-- /.tab-content -->
		</div><!-- nav-tabs-custom -->
	</section><!-- /.content -->
	<div class="clearfix"></div>
</div><!-- /.row (main row) -->

@endsection

@section('script')
<script> 


$(document).ready(function(){
	//Cálculos para Matrículas Nacionales
	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		switch ($('#tipo_pago_ate_gen_matricula_nac_nac_id').val()) {
			case '1':
			var ut1    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut1   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut1   =$('body #General-tab .euro_oficial').val();
			break;
		}
		switch ($('#tipo_pago_ate_gen_matricula_nac_int_id').val()) {
			case '1':
			var ut2    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut2   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut2   =$('body #General-tab .euro_oficial').val();
			break;
		}
		var eq_dN =$('body #aterrizajeGeneralNacional-tab .eq_diurnoNac').val();
		var eq_dI =$('body #aterrizajeGeneralNacional-tab .eq_diurnoInt').val();
		var eq_nN =$('body #aterrizajeGeneralNacional-tab .eq_nocturNac').val();
		var eq_nI =$('body #aterrizajeGeneralNacional-tab .eq_nocturInt').val();

		var val_dN= eq_dN*ut1;
		$('body #aterrizajeGeneralNacional-tab #precio_diurnoNac').val(val_dN.toFixed(5));
		var val_dI= eq_dI*ut2;
		$('body #aterrizajeGeneralNacional-tab #precio_diurnoInt').val(val_dI.toFixed(5));
		var val_nN= eq_nN*ut1;
		$('body #aterrizajeGeneralNacional-tab #precio_nocturNac').val(val_nN.toFixed(5));
		var val_nI= eq_nI*ut2;
		$('body #aterrizajeGeneralNacional-tab #precio_nocturInt').val(val_nI.toFixed(5));
	});

	$( "body #aterrizajeGeneralNacional-tab input" ).keyup(function( event ) {
		switch ($('#tipo_pago_ate_gen_matricula_nac_nac_id').val()) {
			case '1':
			var ut1    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut1   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut1   =$('body #General-tab .euro_oficial').val();
			break;
		}
		switch ($('#tipo_pago_ate_gen_matricula_nac_int_id').val()) {
			case '1':
			var ut2    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut2   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut2   =$('body #General-tab .euro_oficial').val();
				break;
		}
		var eq_dN =$('body #aterrizajeGeneralNacional-tab .eq_diurnoNac').val();
		var eq_dI =$('body #aterrizajeGeneralNacional-tab .eq_diurnoInt').val();
		var eq_nN =$('body #aterrizajeGeneralNacional-tab .eq_nocturNac').val();
		var eq_nI =$('body #aterrizajeGeneralNacional-tab .eq_nocturInt').val();

		var val_dN= eq_dN*ut1;
		$('body #aterrizajeGeneralNacional-tab .precio_diurnoNac').val(val_dN.toFixed(5));
		var val_dI= eq_dI*ut2;
		$('body #aterrizajeGeneralNacional-tab .precio_diurnoInt').val(val_dI.toFixed(5));
		var val_nN= eq_nN*ut1;
		$('body #aterrizajeGeneralNacional-tab .precio_nocturNac').val(val_nN.toFixed(5));
		var val_nI= eq_nI*ut2;
		$('body #aterrizajeGeneralNacional-tab .precio_nocturInt').val(val_nI.toFixed(5));
	});

	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		switch ($('#tipo_pago_est_gen_matricula_nac_nac_id').val()) {
			case '1':
			var ut1    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut1   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut1   =$('body #General-tab .euro_oficial').val();
			break;

			default:
				break;
		}
		switch ($('#tipo_pago_est_gen_matricula_nac_int_id').val()) {
			case '1':
			var ut2    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut2   =$('body #General-tab .dolar_oficial').val();
			break
			case '3':
			var ut2   =$('body #General-tab .euro_oficial').val();
			break;
		}
		var eq_bI =$('body #estacionamientoGeneralNacional-tab .eq_bloqueInt').val();
		var eq_bN =$('body #estacionamientoGeneralNacional-tab .eq_bloqueNac').val();

		var val_precioInt= eq_bI*ut2;
		$('body #estacionamientoGeneralNacional-tab .precio_estInt').val(val_precioInt.toFixed(5));
		var val_precioNac= eq_bN*ut1;
		$('body #estacionamientoGeneralNacional-tab .precio_estNac').val(val_precioNac.toFixed(5));
	});

	$( "body #estacionamientoGeneralNacional-tab input" ).keyup(function( event ) {	
		switch ($('#tipo_pago_est_gen_matricula_nac_nac_id').val()) {
			case '1':
			var ut1    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut1   =$('body #General-tab .dolar_oficial').val();
			break
			case '3':
			var ut1   =$('body #General-tab .euro_oficial').val();
			break

			default:
				break;
		}
		switch ($('#tipo_pago_est_gen_matricula_nac_int_id').val()) {
			case '1':
			var ut2    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut2   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut2   =$('body #General-tab .euro_oficial').val();
			break;

			default:
				break;
		}
		var eq_bI =$('body #estacionamientoGeneralNacional-tab .eq_bloqueInt').val();
		var eq_bN =$('body #estacionamientoGeneralNacional-tab .eq_bloqueNac').val();

		var val_precioInt= eq_bI*ut2;
		$('body #estacionamientoGeneralNacional-tab .precio_estInt').val(val_precioInt.toFixed(5));
		var val_precioNac= eq_bN*ut1;
		$('body #estacionamientoGeneralNacional-tab .precio_estNac').val(val_precioNac.toFixed(5));
	});
	
	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		switch ($('#tipo_pago_ate_com_matricula_nac_nac_id').val()) {
			case '1':
			var ut1    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut1   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut1   =$('body #General-tab .euro_oficial').val();
			break;

			default:
				break;
		}
		switch ($('#tipo_pago_ate_com_matricula_nac_int_id').val()) {
			case '1':
			var ut2    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut2   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut2   =$('body #General-tab .euro_oficial').val();
			break;

			default:
				break;
		}

		var eq_dN =$('body #aterrizajeComercialNacional-tab .eq_diurnoNac').val();
		var eq_dI =$('body #aterrizajeComercialNacional-tab .eq_diurnoInt').val();
		var eq_nN =$('body #aterrizajeComercialNacional-tab .eq_nocturNac').val();
		var eq_nI =$('body #aterrizajeComercialNacional-tab .eq_nocturInt').val();

		var val_dN= eq_dN*ut1;
		$('body #aterrizajeComercialNacional-tab #precio_diurnoNac').val(val_dN.toFixed(5));
		var val_dI= eq_dI*ut2;
		$('body #aterrizajeComercialNacional-tab #precio_diurnoInt').val(val_dI.toFixed(5));
		var val_nN= eq_nN*ut1;
		$('body #aterrizajeComercialNacional-tab #precio_nocturNac').val(val_nN.toFixed(5));
		var val_nI= eq_nI*ut2;
		$('body #aterrizajeComercialNacional-tab #precio_nocturInt').val(val_nI.toFixed(5));
	});

	$( "body #aterrizajeComercialNacional-tab input" ).keyup(function( event ) {
		switch ($('#tipo_pago_ate_com_matricula_nac_nac_id').val()) {
			case '1':
			var ut1    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut1   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut1   =$('body #General-tab .euro_oficial').val();
			break;
			default:
				break;
		}
		switch ($('#tipo_pago_ate_com_matricula_nac_int_id').val()) {
			case '1':
			var ut2    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut2   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut2   =$('body #General-tab .euro_oficial').val();
			break;
			default:
				break;
		}

		var eq_dN =$('body #aterrizajeComercialNacional-tab .eq_diurnoNac').val();
		var eq_dI =$('body #aterrizajeComercialNacional-tab .eq_diurnoInt').val();
		var eq_nN =$('body #aterrizajeComercialNacional-tab .eq_nocturNac').val();
		var eq_nI =$('body #aterrizajeComercialNacional-tab .eq_nocturInt').val();

		var val_dN= eq_dN*ut1;
		$('body #aterrizajeComercialNacional-tab .precio_diurnoNac').val(val_dN.toFixed(5));
		var val_dI= eq_dI*ut2;
		$('body #aterrizajeComercialNacional-tab .precio_diurnoInt').val(val_dI.toFixed(5));
		var val_nN= eq_nN*ut1;
		$('body #aterrizajeComercialNacional-tab .precio_nocturNac').val(val_nN.toFixed(5));
		var val_nI= eq_nI*ut2;
		$('body #aterrizajeComercialNacional-tab .precio_nocturInt').val(val_nI.toFixed(5));
	});

	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		switch ($('#tipo_pago_est_com_matricula_nac_nac_id').val()) {
			case '1':
			var ut1    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut1   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut1   =$('body #General-tab .euro_oficial').val();
			break;
			default:
				break;
		}
		switch ($('#tipo_pago_est_com_matricula_nac_int_id').val()) {
			case '1':
			var ut2    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut2   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut2   =$('body #General-tab .euro_oficial').val();
			break;
			default:
				break;
		}		
		var eq_bI =$('body #estacionamientoComercialNacional-tab .eq_bloqueInt').val();
		var eq_bN =$('body #estacionamientoComercialNacional-tab .eq_bloqueNac').val();

		var val_precioInt= eq_bI*ut2;
		$('body #estacionamientoComercialNacional-tab .precio_estInt').val(val_precioInt.toFixed(5));
		var val_precioNac= eq_bN*ut1;
		$('body #estacionamientoComercialNacional-tab .precio_estNac').val(val_precioNac.toFixed(5));
	});

	$( "body #estacionamientoComercialNacional-tab input" ).keyup(function( event ) {
		switch ($('#tipo_pago_est_com_matricula_nac_nac_id').val()) {
			case '1':
			var ut1    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut1   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut1   =$('body #General-tab .euro_oficial').val();
			break;
			default:
				break;
		}
		switch ($('#tipo_pago_est_com_matricula_nac_int_id').val()) {
			case '1':
			var ut2    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut2   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut2   =$('body #General-tab .euro_oficial').val();
			break;
			default:
				break;
		}
		var eq_bI =$('body #estacionamientoComercialNacional-tab .eq_bloqueInt').val();
		var eq_bN =$('body #estacionamientoComercialNacional-tab .eq_bloqueNac').val();

		var val_precioInt= eq_bI*ut2;
		$('body #estacionamientoComercialNacional-tab .precio_estInt').val(val_precioInt.toFixed(5));
		var val_precioNac= eq_bN*ut1;
		$('body #estacionamientoComercialNacional-tab .precio_estNac').val(val_precioNac.toFixed(5));
	});

	
	//Cálculos para matrículas extrajeras
	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		switch ($('#tipo_pago_ate_gen_matricula_int_nac_id').val()) {
			case '1':
			var ut1    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut1   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut1   =$('body #General-tab .euro_oficial').val();
			break;
			default:
				break;
		}
		switch ($('#tipo_pago_ate_gen_matricula_int_int_id').val()) {
			case '1':
			var ut2    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut2   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut2   =$('body #General-tab .euro_oficial').val();
			break;
			default:
				break;
		}
		var eq_dN =$('body #aterrizajeGeneralExtranjera-tab .eq_diurnoNac').val();
		var eq_dI =$('body #aterrizajeGeneralExtranjera-tab .eq_diurnoInt').val();
		var eq_nN =$('body #aterrizajeGeneralExtranjera-tab .eq_nocturNac').val();
		var eq_nI =$('body #aterrizajeGeneralExtranjera-tab .eq_nocturInt').val();

		var val_dN= eq_dN*ut1;
		$('body #aterrizajeGeneralExtranjera-tab #precio_diurnoNac').val(val_dN);
		var val_dI= eq_dI*ut2;
		$('body #aterrizajeGeneralExtranjera-tab #precio_diurnoInt').val(val_dI);
		var val_nN= eq_nN*ut1;
		$('body #aterrizajeGeneralExtranjera-tab #precio_nocturNac').val(val_nN);
		var val_nI= eq_nI*ut2;
		$('body #aterrizajeGeneralExtranjera-tab #precio_nocturInt').val(val_nI);
	});

	$( "body #aterrizajeGeneralExtranjera-tab input" ).keyup(function( event ) {	
		switch ($('#tipo_pago_ate_gen_matricula_int_nac_id').val()) {
			case '1':
			var ut1    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut1   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut1   =$('body #General-tab .euro_oficial').val();
			break;
			default:
				break;
		}
		switch ($('#tipo_pago_ate_gen_matricula_int_int_id').val()) {
			case '1':
			var ut2    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut2   =$('body #General-tab .dolar_oficial').val();
			break;
			break;
			case '3':
			var ut2   =$('body #General-tab .euro_oficial').val();
			break;
			default:
				break;
		}

		var eq_dN =$('body #aterrizajeGeneralExtranjera-tab .eq_diurnoNac').val();
		var eq_dI =$('body #aterrizajeGeneralExtranjera-tab .eq_diurnoInt').val();
		var eq_nN =$('body #aterrizajeGeneralExtranjera-tab .eq_nocturNac').val();
		var eq_nI =$('body #aterrizajeGeneralExtranjera-tab .eq_nocturInt').val();

		var val_dN= eq_dN*ut1;
		$('body #aterrizajeGeneralExtranjera-tab .precio_diurnoNac').val(val_dN.toFixed(5));
		var val_dI= eq_dI*ut2;
		$('body #aterrizajeGeneralExtranjera-tab .precio_diurnoInt').val(val_dI.toFixed(5));
		var val_nN= eq_nN*ut1;
		$('body #aterrizajeGeneralExtranjera-tab .precio_nocturNac').val(val_nN.toFixed(5));
		var val_nI= eq_nI*ut2;
		$('body #aterrizajeGeneralExtranjera-tab .precio_nocturInt').val(val_nI.toFixed(5));
	});

	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		switch ($('#tipo_pago_est_gen_matricula_int_nac_id').val()) {
			case '1':
			var ut1    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut1   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut1   =$('body #General-tab .euro_oficial').val();
			break;
			default:
				break;
		}
		switch ($('#tipo_pago_est_gen_matricula_int_int_id').val()) {
			case '1':
			var ut2    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut2   =$('body #General-tab .dolar_oficial').val();
			case '3':
			var ut2   =$('body #General-tab .euro_oficial').val();
			break;
			default:
				break;
		}

		var eq_bI =$('body #estacionamientoGeneralExtranjera-tab .eq_bloqueInt').val();
		var eq_bN =$('body #estacionamientoGeneralExtranjera-tab .eq_bloqueNac').val();

		var val_precioInt= eq_bI*ut2;
		$('body #estacionamientoGeneralExtranjera-tab .precio_estInt').val(val_precioInt.toFixed(5));
		var val_precioNac= eq_bN*ut1;
		$('body #estacionamientoGeneralExtranjera-tab .precio_estNac').val(val_precioNac.toFixed(5));
	});

	$( "body #estacionamientoGeneralExtranjera-tab input" ).keyup(function( event ) {
		switch ($('#tipo_pago_est_gen_matricula_int_nac_id').val()) {
			case '1':
			var ut1    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut1   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut1   =$('body #General-tab .euro_oficial').val();
			break;
			default:
				break;
		}
		switch ($('#tipo_pago_est_gen_matricula_int_int_id').val()) {
			case '1':
			var ut2    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut2   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut2   =$('body #General-tab .euro_oficial').val();
			break;

			default:
				break;
		}
		
		var eq_bI =$('body #estacionamientoGeneralExtranjera-tab .eq_bloqueInt').val();
		var eq_bN =$('body #estacionamientoGeneralExtranjera-tab .eq_bloqueNac').val();

		var val_precioInt= eq_bI*ut2;
		$('body #estacionamientoGeneralExtranjera-tab .precio_estInt').val(val_precioInt.toFixed(5));
		var val_precioNac= eq_bN*ut1;
		$('body #estacionamientoGeneralExtranjera-tab .precio_estNac').val(val_precioNac.toFixed(5));
	});

	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {	
		switch ($('#tipo_pago_ate_com_matricula_int_nac_id').val()) {
			case '1':
			var ut1    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut1   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut1   =$('body #General-tab .euro_oficial').val();
			break;
			default:
				break;
		}
		switch ($('#tipo_pago_ate_com_matricula_int_int_id').val()) {
			case '1':
			var ut2    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut2   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut2   =$('body #General-tab .euro_oficial').val();
			break;
			default:
				break;
		}
		
		var eq_dN =$('body #aterrizajeComercialExtranjera-tab .eq_diurnoNac').val();
		var eq_dI =$('body #aterrizajeComercialExtranjera-tab .eq_diurnoInt').val();
		var eq_nN =$('body #aterrizajeComercialExtranjera-tab .eq_nocturNac').val();
		var eq_nI =$('body #aterrizajeComercialExtranjera-tab .eq_nocturInt').val();

		var val_dN= eq_dN*ut1;
		$('body #aterrizajeComercialExtranjera-tab #precio_diurnoNac').val(val_dN.toFixed(5));
		var val_dI= eq_dI*ut2;
		$('body #aterrizajeComercialExtranjera-tab #precio_diurnoInt').val(val_dI.toFixed(5));
		var val_nN= eq_nN*ut1;
		$('body #aterrizajeComercialExtranjera-tab #precio_nocturNac').val(val_nN.toFixed(5));
		var val_nI= eq_nI*ut2;
		$('body #aterrizajeComercialExtranjera-tab #precio_nocturInt').val(val_nI.toFixed(5));
	});

	$( "body #aterrizajeComercialExtranjera-tab input" ).keyup(function( event ) {
		switch ($('#tipo_pago_ate_com_matricula_int_nac_id').val()) {
			case '1':
			var ut1    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut1   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut1   =$('body #General-tab .euro_oficial').val();
			break;
			default:
				break;
		}
		switch ($('#tipo_pago_ate_com_matricula_int_int_id').val()) {
			case '1':
			var ut2    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut2   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut2   =$('body #General-tab .euro_oficial').val();
			break;
			default:
				break;
		}
		var eq_dN =$('body #aterrizajeComercialExtranjera-tab .eq_diurnoNac').val();
		var eq_dI =$('body #aterrizajeComercialExtranjera-tab .eq_diurnoInt').val();
		var eq_nN =$('body #aterrizajeComercialExtranjera-tab .eq_nocturNac').val();
		var eq_nI =$('body #aterrizajeComercialExtranjera-tab .eq_nocturInt').val();

		var val_dN= eq_dN*ut1;
		$('body #aterrizajeComercialExtranjera-tab .precio_diurnoNac').val(val_dN.toFixed(5));
		var val_dI= eq_dI*ut2;
		$('body #aterrizajeComercialExtranjera-tab .precio_diurnoInt').val(val_dI.toFixed(5));
		var val_nN= eq_nN*ut1;
		$('body #aterrizajeComercialExtranjera-tab .precio_nocturNac').val(val_nN.toFixed(5));
		var val_nI= eq_nI*ut2;
		$('body #aterrizajeComercialExtranjera-tab .precio_nocturInt').val(val_nI);
	});

	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		switch ($('#tipo_pago_est_com_matricula_int_nac_id').val()) {
			case '1':
			var ut1    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut1   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut1   =$('body #General-tab .euro_oficial').val();
			break;
			default:
				break;
		}
		switch ($('#tipo_pago_est_com_matricula_int_int_id').val()) {
			case '1':
			var ut2    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut2   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut2   =$('body #General-tab .euro_oficial').val();
			break;
			default:
				break;
		}
		var eq_bI =$('body #estacionamientoComercialExtranjera-tab .eq_bloqueInt').val();
		var eq_bN =$('body #estacionamientoComercialExtranjera-tab .eq_bloqueNac').val();

		var val_precioInt= eq_bI*ut2;
		$('body #estacionamientoComercialExtranjera-tab .precio_estInt').val(val_precioInt.toFixed(5));
		var val_precioNac= eq_bN*ut1;
		$('body #estacionamientoComercialExtranjera-tab .precio_estNac').val(val_precioNac.toFixed(5));
	});

	$( "body #estacionamientoComercialExtranjera-tab input" ).keyup(function( event ) {
		switch ($('#tipo_pago_est_com_matricula_int_nac_id').val()) {
			case '1':
			var ut1    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut1   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut1   =$('body #General-tab .euro_oficial').val();
			break;
			default:
				break;
		}
		switch ($('#tipo_pago_est_com_matricula_int_int_id').val()) {
			case '1':
			var ut2    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut2   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut2   =$('body #General-tab .euro_oficial').val();
			break;
			default:
				break;
		}

		var eq_bI =$('body #estacionamientoComercialExtranjera-tab .eq_bloqueInt').val();
		var eq_bN =$('body #estacionamientoComercialExtranjera-tab .eq_bloqueNac').val();

		var val_precioInt= eq_bI*ut2;
		$('body #estacionamientoComercialExtranjera-tab .precio_estInt').val(val_precioInt.toFixed(5));
		var val_precioNac= eq_bN*ut1;
		$('body #estacionamientoComercialExtranjera-tab .precio_estNac').val(val_precioNac.toFixed(5));
	});

	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		switch ($('#tipo_pago_formulario_id').val()) {
			case '1':
			var ut    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut   =$('body #General-tab .euro_oficial').val();
			break;
			default:
				break;
		}

		var eq_form   =$('body #cargosVarios-tab .eq_formulario').val();
		var eq_DerHab =$('body #cargosVarios-tab .eq_derechoHabilitacion').val();
		var eq_AborSH =$('body #cargosVarios-tab .eq_usoAbordajeSinHab').val();
		var eq_AborCH =$('body #cargosVarios-tab .eq_usoAbordajeConHab').val();

		var val_form= Math.ceil(eq_form*ut);
		$('body #cargosVarios-tab #precio_formulario-input').val(val_form.toFixed(5));

		var ut        =$('body #General-tab .euro_oficial').val();
		var val_DerHab= eq_DerHab*ut;
		$('body #cargosVarios-tab #precio_derechoHabilitacion-input').val(val_DerHab)
		var val_AborSH= eq_AborSH*ut;
		$('body #cargosVarios-tab #precio_usoAbordajeSinHab-input').val(val_AborSH);
		var val_AborCH= eq_AborCH*ut;
		$('body #cargosVarios-tab #precio_usoAbordajeConHab-input').val(val_AborCH);
	});

	$("body #cargosVarios-tab input" ).keyup(function( event ) {	

		var eq_form   =$('body #cargosVarios-tab .eq_formulario').val();
		var eq_DerHab =$('body #cargosVarios-tab .eq_derechoHabilitacion').val();
		var eq_AborSH =$('body #cargosVarios-tab .eq_usoAbordajeSinHab').val();
		var eq_AborCH =$('body #cargosVarios-tab .eq_usoAbordajeConHab').val();


		switch ($('#tipo_pago_formulario_id').val()) {
			case '1':
			var ut    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut   =$('body #General-tab .euro_oficial').val();
			break;
			default:
				break;
		}

		var val_form= eq_form*ut;
		$('body #cargosVarios-tab #precio_formulario-input').val(val_form.toFixed(5));

		switch ($('#tipo_pago_habilitacion_id').val() ) {
			case '1':
			var ut    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut   =$('body #General-tab .euro_oficial').val();
			break;
			default:
				break;
		}

		var val_DerHab= eq_DerHab*ut;
		$('body #cargosVarios-tab #precio_derechoHabilitacion-input').val(val_DerHab);



		switch ($('#tipo_pago_derecho_abordaje_nac_id').val()) {
			case '1':
			var ut    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut   =$('body #General-tab .euro_oficial').val();
			break;
			default:
				break;
		}

		var val_AborSH= eq_AborSH*ut;
		$('body #cargosVarios-tab #precio_usoAbordajeSinHab-input').val(val_AborSH);


		switch ($('#tipo_pago_derecho_abordaje_int_id').val()) {
			case '1':
			var ut    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut   =$('body #General-tab .euro_oficial').val();
			break;
			default:
				break;
		}

		var val_AborCH= eq_AborCH*ut;
		$('body #cargosVarios-tab #precio_usoAbordajeConHab-input').val(val_AborCH);
	});


	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {	
		
		switch ($('#tipo_pago_carga_id').val()) {
			case '1':
			var ut    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut   =$('body #General-tab .euro_oficial').val();
			break;
			default:
				break;
		}
		var eq_UT     =$('body #Carga-tab .equivalenteUT').val();
		
		var val_carga = eq_UT*ut;
		$('body #Carga-tab #precio_carga-input').val(val_carga.toFixed(5));
	});

	$( "body #Carga-tab input" ).keyup(function( event ) {
		switch ($('#tipo_pago_carga_id').val()) {
			case '1':
			var ut    =$('body #General-tab .unidad_tributaria').val();				
				break;
			case '2':
			var ut   =$('body #General-tab .dolar_oficial').val();
			break;
			case '3':
			var ut   =$('body #General-tab .euro_oficial').val();
			break;
			default:
				break;
		}
		
		var eq_UT     =$('body #Carga-tab .equivalenteUT').val();
		
		var val_carga = eq_UT*ut;
		$('body #Carga-tab #precio_carga-input').val(val_carga.toFixed(5));
	});


		/*
	
		Modificar Montos Fijos
		*/
		$('#confGeneral-save-btn').click(function(){
			var data               ={};
			data.unidad_tributaria =$('#General-tab form .unidad_tributaria').val()
			data.dolar_oficial     =$('#General-tab form .dolar_oficial').val()
			data.euro_oficial     =$('#General-tab form .euro_oficial').val()
			var url                =$('#General-tab form').attr('action')

			var overlay=    "<div class='overlay'>\
	            <i class='fa fa-refresh fa-spin'></i>\
	            </div>";
	            $('body .confGeneralBox').append(overlay);

			$.ajax({data:data,
				method:'PUT',
				url:url})
			.always(function(text, status, responseObject){
                $('body .confGeneralBox .overlay').remove();
				try
				{
					var respuesta = JSON.parse(responseObject.responseText);
					if (respuesta.success==1)
					{
						console.log(respuesta);
						alertify.success(respuesta.text);
					}
					else
					{
						alertify.error(respuesta.text);
					}
				}
				catch(e)
				{
					alertify.error('Error procesando la información');
				}
			})
		})



	/*
	
		Modificar Montos de Aterrizaje y despegue
		*/
		$('.precioAterrizajeDespegue-save-btn').click(function(){

			var data =$('.precioAterrizajeDespegue-tab form').serializeArray()
			var url  =$('.precioAterrizajeDespegue-tab form').attr('action')

			var overlay=    "<div class='overlay'>\
	            <i class='fa fa-refresh fa-spin'></i>\
	            </div>";
	            $('body .aterrizajeBox').append(overlay);

			$.ajax({data:data,
				method:'PUT',
				url:url})
			.always(function(text, status, responseObject){
                $('body .aterrizajeBox .overlay').remove();
				try
				{
					var respuesta = JSON.parse(responseObject.responseText);
					if (respuesta.success==1)
					{
						alertify.success(respuesta.text);
					}
					else
					{
						alertify.error(respuesta.text);
					}
				}
				catch(e)
				{
					alertify.error('Error procesando la información');
				}
			})
		})

			/*
	
		Modificar Montos de Estacionamiento
		*/
		$('.estacionamientoAeronave-save-btn').click(function(){

			var data =$('.estacionamientoAeronave-tab form').serializeArray()
			var url  =$('.estacionamientoAeronave-tab form').attr('action')

			var overlay=    "<div class='overlay'>\
	            <i class='fa fa-refresh fa-spin'></i>\
	            </div>";
	            $('body .estacionamientoBox').append(overlay);

			$.ajax({data:data,
				method:'PUT',
				url:url})
			.always(function(text, status, responseObject){
                $('body .estacionamientoBox .overlay').remove();
				try
				{
					var respuesta = JSON.parse(responseObject.responseText);
					if (respuesta.success==1)
					{
						console.log(respuesta);
						alertify.success(respuesta.text);
					}
					else
					{
						alertify.error(respuesta.text);
					}
				}
				catch(e)
				{
					alertify.error('Error procesando la información');
				}
			})
		})

			/*
	
	/*
	
		Modificar Horarios
		*/
		$('#horarioAeronautico-save-btn').click(function(){

			var data =$('#Horarios-tab form').serializeArray()
			var url  =$('#Horarios-tab form').attr('action')

			var overlay=    "<div class='overlay'>\
	            <i class='fa fa-refresh fa-spin'></i>\
	            </div>";
	            $('body .horariosBox').append(overlay);


			$.ajax({data:data,
				method:'PUT',
				url:url})
			.always(function(text, status, responseObject){
                $('body .horariosBox .overlay').remove();
				try
				{
					var respuesta = JSON.parse(responseObject.responseText);
					if (respuesta.success==1)
					{
						alertify.success(respuesta.text);
					}
					else
					{
						alertify.error(respuesta.text);
					}
				}
				catch(e)
				{
					alertify.error('Error procesando la información');
				}
			})
		})
	/*
	
		Modificar Cargos Varios
		*/
		$('#cargosVarios-save-btn').click(function(){
			
			var data =$('#cargosVarios-tab form').serializeArray()
			var url  =$('#cargosVarios-tab form').attr('action')

			var overlay=    "<div class='overlay'>\
	            <i class='fa fa-refresh fa-spin'></i>\
	            </div>";
	            $('body .cargosVariosBox').append(overlay);

			$.ajax({data:data,
				method:'PUT',
				url:url})
			.always(function(text, status, responseObject){
                $('body .cargosVariosBox .overlay').remove();
				try
				{
					var respuesta = JSON.parse(responseObject.responseText);
					if (respuesta.success==1)
					{
						console.log(respuesta);
						alertify.success(respuesta.text);
					}
					else
					{
						alertify.error(respuesta.text);
					}
				}
				catch(e)
				{
					alertify.error('Error procesando la información');
				}
			})
		})
	/*
	
		Modificar Cargos Varios
		*/
		$('#precioCarga-save-btn').click(function(){
			
			var data =$('#Carga-tab form').serializeArray()
			var url  =$('#Carga-tab form').attr('action')

			var overlay=    "<div class='overlay'>\
	            <i class='fa fa-refresh fa-spin'></i>\
	            </div>";
	            $('body .cargaBox').append(overlay);

			$.ajax({data:data,
				method:'PUT',
				url:url})
			.always(function(text, status, responseObject){
                $('body .cargaBox .overlay').remove();
                try
				{
					var respuesta = JSON.parse(responseObject.responseText);
					if (respuesta.success==1)
					{
						console.log(respuesta);
						alertify.success(respuesta.text);
					}
					else
					{
						alertify.error(respuesta.text);
					}
				}
				catch(e)
				{
					alertify.error('Error procesando la información');
				}
			})
		})
	})

</script>
@endsection
