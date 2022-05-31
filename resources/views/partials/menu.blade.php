<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="{{asset('imgs/user-icon.png')}}" class="img-circle" alt="" />
			</div>
			<div class="pull-left info">
				<p>{{$userName}}</p>
				{{$name}}
			</div>
		</div>
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<li class="header">MENÚ</li>		

		@permission('menu.systas')
		<li class="treeview {{ (\Request::is('systas/*'))?"active":"" }}">
			<a href="{{ URL::to('systas/inicio') }}"><i class="fa  fa-plane"></i> Systas</a>
			<ul class="treeview-menu">
				<li class="header" style="color: #bbbbbb">Configuraciones</li>

				<li {{ (\Request::is('systas/configurar*'))?"class=active":"" }}><a href="{{ URL::to('systas/configurar') }}"><i class="fa fa-paper-plane"></i> Configurar Tipos de Tasa</a></li>

				<li class="header" style="color: #bbbbbb">Servicios</li>

				<li {{ (\Request::is('systas/imprimir*'))?"class=active":"" }}><a href="{{ URL::to('systas/imprimir') }}"><i class="fa fa-road"></i> Imprimir</a></li>

				<li {{ (\Request::is('systas/verificar*'))?"class=active":"" }}><a href="{{ URL::to('systas/verificar') }}"><i class="glyphicon glyphicon-user"></i> Verificar</a></li>

				<li class="header" style="color: #bbbbbb">Reportes</li>

				<li {{ (\Request::is('systas/reportes/repccaja*'))?"class=active":"" }}><a href="{{ URL::to('systas/reporte/repccaja') }}"><i class="glyphicon glyphicon-home"></i> Tasas Conciliadas</a></li>

				<li {{ (\Request::is('systas/reportes/repctasa*'))?"class=active":"" }}><a href="{{ URL::to('systas/reporte/repctasa') }}"><i class="fa fa-plane"></i> Tasas Emitidas (Detallado)</a></li>

				<li {{ (\Request::is('systas/reportes/reprseries*'))?"class=active":"" }}><a href="{{ URL::to('systas/reporte/reprseries') }}"><i class="fa fa-plane"></i> Tasas Emitidas (Series)</a></li>

			</ul>
		</li>
		@endpermission



		@permission('menu.modeloaeronave|menu.puerto|menu.piloto|menu.hangar|menu.aeronave')
		<li class="treeview {{ (\Request::is('maestros*'))?"active":""}}">
			<a href="#">
				<i class="fa fa-cube"></i> <span>Gestor de Maestros</span> <i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				@permission('menu.modeloaeronave|menu.puerto|menu.piloto|menu.piloto|menu.aeronave')
				<li class="header" style="color: #bbbbbb">GENERAL</li>
				@endpermission
				@permission('menu.modeloaeronave')
				<li {{ (\Request::is('maestros/modelosAeronaves*'))?"class=active":"" }}><a href="{{ URL::to('maestros/modelosAeronaves') }}"><i class="fa fa-paper-plane"></i> Modelos de Aeronaves</a></li>
				@endpermission
				@permission('menu.puerto')
				<li {{ (\Request::is('maestros/puertos*'))?"class=active":"" }}><a href="{{ URL::to('maestros/puertos') }}"><i class="fa fa-road"></i> Puertos</a></li>
				@endpermission
				@permission('menu.piloto')
				<li {{ (\Request::is('maestros/pilotos*'))?"class=active":"" }}><a href="{{ URL::to('maestros/pilotos') }}"><i class="glyphicon glyphicon-user"></i> Pilotos</a></li>
				@endpermission
				@permission('menu.hangar')
				<li {{ (\Request::is('maestros/hangares*'))?"class=active":"" }}><a href="{{ URL::to('maestros/hangares') }}"><i class="glyphicon glyphicon-home"></i> Hangares</a></li>
				@endpermission
				@permission('menu.aeronave')
				<li {{ (\Request::is('maestros/aeronaves*'))?"class=active":"" }}><a href="{{ URL::to('maestros/aeronaves') }}"><i class="fa fa-plane"></i> Aeronaves</a></li>
				@endpermission
				@permission('menu.aeronave')

				<li {{ (\Request::is('maestros/fbos*'))?"class=active":"" }}><a href="{{ URL::to('maestros/fbos') }}"><i class="glyphicon glyphicon-user"></i> Fbos</a></li>
				@endpermission

			</ul>
		</li>
		@endpermission

		@permission('menu.aterrizaje|menu.despegue|menu.carga')
			<li class="treeview {{ (\Request::is('operaciones*'))?"active":""}}">
				<a href="#">
					<i class="fa fa-cubes"></i> <span>Gestor de Operaciones</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					@permission('menu.aterrizaje|menu.despegue|menu.carga')
					@endpermission
					@permission('menu.aterrizaje')
					<li {{ (\Request::is('operaciones/Aterrizajes*'))?"class=active":"" }}><a href="{{ URL::to('operaciones/Aterrizajes') }}"><i class="fa fa-fighter-jet"></i> Aterrizajes</a></li>
					@endpermission
					@permission('menu.despegue')
					<li {{ (\Request::is('operaciones/*/Despegues*'))?"class=active":"" }}><a href="{{action('DespegueController@index')}}"><i class="fa fa-plane"></i> Despegues</a></li>
					@endpermission
					{{--@permission('menu.carga')
					<li {{ (\Request::is('operaciones/Cargas*'))?"class=active":"" }}><a href="{{ URL::to('operaciones/Cargas') }}"><i class="fa fa-truck"></i> Cargas</a></li>
					@endpermission--}}
					@permission('menu.facturacionManual')
					<li {{ (\Request::is('operaciones/facturacionManual*'))?"class=active":"" }}><a href="{{ URL::to('operaciones/facturacionManual') }}"><i class="fa fa-credit-card"></i> Facturación Manual</a></li>
					@endpermission
				</ul>
			</li>
		@endpermission

		@permission('menu.tasas')
			<li class="treeview {{ (\Request::is('estacionamiento*') || \Request::is('tasas*'))?"active":""}}">
				<a href="#">
					<i class="fa fa-share"></i> <span>Taquillas</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu ">
					<li><a href="#"><i class="fa fa-plane"></i><span> Tasas</span><i class="fa fa-angle-left pull-right"></i>
					</a>

					<ul class="treeview-menu">
						<li {{ (\Request::is('tasas/taquilla*'))?"class=active":"" }}><a href="{{ URL::to('tasas/taquilla') }}"><i class="fa fa-users"></i> Operador</a></li>
						<li {{ (\Request::is('tasas/supervisor*'))?"class=active":"" }}><a href="{{ URL::to('tasas/supervisor') }}"><i class="fa fa-user"></i> Supervisor</a></li>
					</ul>


				</li>
				<li class="{{ (\Request::is('estacionamiento*'))?"active":""}}"><a href="{{ URL::to('estacionamiento') }}"><i class="fa  fa-tachometer"></i> Estacionamiento</a></li>

			</ul>
		</li>
		@endpermission

		@permission('menu.contrato|menu.factura|menu.cobranza|menu.conciliacion|menu.cliente|menu.role|menu.usuario|menu.modulo|menu.concepto|menu.reporteSCV|menu.reporteRecaudacion|menu.informacion')
			@permission('menu.contrato|menu.factura|menu.cobranza|menu.conciliacion')
			<li class="treeview {{ (\Request::is('contrato*') or \Request::is('factura*') or \Request::is('cobranza*'))?"active":""}}">
				<a href="#">
					<i class="fa fa-money"></i> <span>Recaudación</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					@permission('menu.contrato')
					<li {{ (\Request::is('contrato*'))?"class=active":"" }}><a href="{{ URL::to('contrato') }}"><i class="fa fa-files-o"></i> Contratos</a></li>
					@endpermission
					@permission('menu.factura')
					<li {{ (\Request::is('factura*'))?"class=active":"" }}><a href="{{ URL::to('facturacion/Todos/main') }}"><i class="fa fa-folder"></i> Facturación</a></li>
					@endpermission
					@permission('menu.cobranza')
					<li {{ (\Request::is('cobranza*'))?"class=active":"" }}><a href="{{ URL::to('cobranza/Todos/main') }}"><i class="fa fa-folder-o"></i> Cobranza</a></li>
					@endpermission
					@permission('menu.conciliacion')
					<li {{ (\Request::is('conciliacion*'))?"class=active":"" }}><a href="{{ URL::to('conciliacion/movimientos') }}"><i class="fa fa-bank"></i> Conciliación Bancaria</a></li>
					@endpermission
				</ul>
			</li>
			@endpermission
 		<!-- <li class="treeview">
                <a href="#">
                  <i class="fa fa-circle-o"></i> <span>Simulación</span>  <i class="fa fa-angle-left pull-right"></i>
                </a>
               <ul class="treeview-menu">
                  <li><a href="#"><i class="fa fa-folder-o"></i> Proyección de cobranza</a></li>
                  <li><a href="#"><i class="fa fa-folder-o"></i> Estimación de metas</a></li>
                    </ul>
            </li>-->
            @permission('menu.reporteSCV|menu.reporteRecaudacion')
            <li class="treeview {{ (\Request::is('reporte*'))?"active":""}}">
            	<a href="#">
            		<i class="fa fa-signal"></i> <span>Reportes</span>  <i class="fa fa-angle-left pull-right"></i>
            	</a>
            	<ul class="treeview-menu">
            		@permission('menu.reporteSCV')
					<li {{ (\Request::is('reporte/reporterDES900*') || \Request::is('reporte/reporterCuadreCaja*') || \Request::is('reporte/reporteTraficoAereo*'))?"class=active":"" }}>
						<a href="#">
							<i class="fa fa-folder-open"></i>
							<span> Control de Vuelos</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li {{ (\Request::is('reporte/reporterDES900*'))?"class=active":"" }}>
								<a href="{{ URL::to('reporte/reporterDES900') }}">
									<i class="fa fa-file-o"></i> 1-. DES 900
								</a>
							</li>
							<li {{ (\Request::is('reporte/reporteTraficoAereo*'))?"class=active":"" }}>
								<a href="{{ URL::to('reporte/reporteTraficoAereo') }}">
									<i class="fa fa-file-o"></i> 2-. Tráfico Aéreo
								</a>
							</li>
							<li {{ (\Request::is('reporte/reporterCuadreCaja*'))?"class=active":"" }}>
								<a href="{{ URL::to('reporte/reporterCuadreCaja') }}">
									<i class="fa fa-file-o"></i> 3-. Cuadre de Caja
								</a>
							</li>
						</ul>
            		@endpermission
            		@permission('menu.reporteRecaudacion')
					<li {{ (\Request::is('reporte/reporteListadoFacturas*') || \Request::is('reporte/reporteListadoFacturaCliente*'))?"class=active":"" }}><a href="#"><i class="fa fa-folder-open"></i><span> Facturación</span><i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
	                   		<li {{ (\Request::is('reporte/reporteListadoFacturas*'))?"class=active":"" }}><a href="{{ URL::to('reporte/reporteListadoFacturas') }}"><i class="fa fa-file-o"></i> 1-. Listado de Facturas Emitidas</a></li>
	                    	<li {{ (\Request::is('reporte/reporteListadoFacturaCliente*'))?"class=active":"" }}><a href="{{ URL::to('reporte/reporteListadoFacturaCliente') }}"><i class="fa fa-file-o"></i> 2-. Listado de Facturas Emitidas por Cliente</a></li>
						</ul>  
					<li {{ (\Request::is('reporte/reporteRelacionCobranza*') || \Request::is('reporte/reporteRelacionFacturasAeronauticasCredito*') || \Request::is('reporte/reporteRelacionIngresosAeronauticosContado*'))?"class=active":"" }}><a href="#"><i class="fa fa-folder-open"></i><span> Cobranza</span><i class="fa fa-angle-left pull-right"></i></a>
					<ul class="treeview-menu">
							<li {{ (\Request::is('reporte/reporteRelacionFacturasAeronauticasCredito*'))?"class=active":"" }}><a href="{{ URL::to('reporte/reporteRelacionFacturasAeronauticasCredito') }}"><i class="fa fa-file-o"></i> 1-. Relación de Facturas Aeronáuticas Cobradas Crédito (Detallado)</a></li>
							<li {{ (\Request::is('reporte/reporteResumenFacturasAeronauticasCredito*'))?"class=active":"" }}><a href="{{ URL::to('reporte/reporteResumenFacturasAeronauticasCredito') }}"><i class="fa fa-file-o"></i> 2-. Relación de Facturas Aeronáuticas Cobradas Crédito (Resumen)</a></li>
							<li {{ (\Request::is('reporte/reporteRelacionIngresosAeronauticosContado*'))?"class=active":"" }}><a href="{{ URL::to('reporte/reporteRelacionIngresosAeronauticosContado') }}"><i class="fa fa-folder-o"></i> 3-. Relación de Ingresos Aeronáuticos Contado</a></li>
                   			<li {{ (\Request::is('reporte/reporteRelacionCobranza*'))?"class=active":"" }}><a href="{{ URL::to('reporte/reporteRelacionCobranza') }}"><i class="fa fa-file-o"></i> 4-. Relación de Cobranza</a></li>      
							<li {{ (\Request::is('reporte/reporteRelacionFacturasAeronauticas*'))?"class=active":"" }}><a href="{{ URL::to('reporte/reporteRelacionFacturasAeronauticas') }}"><i class="fa fa-file-o"></i> 5-. Relación de Facturas Aeronáuticas Cobradas</a></li>

					</ul> 
					<li {{ (\Request::is('reporte/reporteContratos*') || \Request::is('reporte/reporteRelacionIngresoMensual*') || \Request::is('reporte/reporteRelacionMensualDeIngresosRecaudacionPendiente*') || \Request::is('reporte/reporteRelacionMensualDeFacturacionCobradosYPorCobrar*')  || \Request::is('reporte/reporteRelacionEstacionamientoDiario*') || \Request::is('reporte/reporteRelacionMetaRecaudacionMensual*') || \Request::is('reporte/reporteControlDeRecaudacionDiario*') || \Request::is('reporte/reporteControlDeRecaudacionMensual*') || \Request::is('reporte/reporteFormulariosAnulados*'))?"class=active":"" }}><a href="#"><i class="fa fa-folder-open"></i><span> Movimientos</span><i class="fa fa-angle-left pull-right"></i></a>
					<ul class="treeview-menu">
						<li {{ (\Request::is('reporte/reporteContratos*'))?"class=active":"" }}><a href="{{ URL::to('reporte/reporteContratos') }}"><i class="fa fa-file-o"></i> 1-. Relación de Contratos Registrados</a></li>        		
						<li {{ (\Request::is('reporte/reporteRelacionIngresoMensual*'))?"class=active":"" }}><a href="{{ URL::to('reporte/reporteRelacionIngresoMensual') }}"><i class="fa fa-file-o"></i> 2-. Relación de Ingreso Mensual</a></li>        		
						<li {{ (\Request::is('reporte/reporteControlDeRecaudacionMensual*'))?"class=active":"" }}><a href="{{ URL::to('reporte/reporteControlDeRecaudacionMensual') }}"><i class="fa fa-file-o"></i> 3-. Control de Recaudación Mensual</a></li>        		
						<li {{ (\Request::is('reporte/reporteControlDeRecaudacionDiario*'))?"class=active":"" }}><a href="{{ URL::to('reporte/reporteControlDeRecaudacionDiario') }}"><i class="fa fa-file-o"></i> 4-. Control de Recaudación Diario</a></li>
						<li {{ (\Request::is('reporte/reporteOtrosCargosDetallado*'))?"class=active":"" }}><a href="{{ URL::to('reporte/reporteOtrosCargosDetallado') }}"><i class="fa fa-file-o"></i> 5-. Desglose Cobranza Otros Cargos</a></li>               		
						<li {{ (\Request::is('reporte/reporteRelacionMensualDeIngresosRecaudacionPendiente*'))?"class=active":"" }}><a href="{{ URL::to('reporte/reporteRelacionMensualDeIngresosRecaudacionPendiente') }}"><i class="fa fa-file-o"></i> 6-. Relación Mensual de Ingresos y Recaudación Pendiente</a></li>        		
						<li {{ (\Request::is('reporte/reporteRelacionMensualDeFacturacionCobradosYPorCobrar*'))?"class=active":"" }}><a href="{{ URL::to('reporte/reporteRelacionMensualDeFacturacionCobradosYPorCobrar') }}"><i class="fa fa-file-o"></i> 7-. Relación Mensual de Saldo Facturado, Cobrado y Por Cobrar</a></li>        		
						<li {{ (\Request::is('reporte/reporteRelacionEstacionamientoDiario*'))?"class=active":"" }}><a href="{{ URL::to('reporte/reporteRelacionEstacionamientoDiario') }}"><i class="fa fa-file-o"></i> 8-. Relación de Estacionamiento Diario</a></li>        
						<li {{ (\Request::is('reporte/reporteRelacionMetaRecaudacionMensual*'))?"class=active":"" }}><a href="{{ URL::to('reporte/reporteRelacionMetaRecaudacionMensual') }}"><i class="fa fa-file-o"></i> 9-. Relación de Meta y Recaudación Mensual</a></li>
						<li {{ (\Request::is('reporte/reporteFormulariosAnulados*'))?"class=active":"" }}><a href="{{ URL::to('reporte/reporteFormulariosAnulados') }}"><i class="fa fa-file-o"></i> 10-. Relación de Formularios Anulados</a></li>        		
						<li {{ (\Request::is('reporte/getReporteDeMorosidad*'))?"class=active":"" }}><a href="{{ URL::to('reporte/reporteListadoClientes') }}"><i class="fa fa-file-o"></i> 11-. Relación de Clientes</a></li>        		
					</ul>  
					<li {{ (\Request::is('reporte/reporteMorosidad*'))?"class=active":"" }}><a href="#"><i class="fa fa-folder-open"></i><span> Cuentas por Cobrar</span><i class="fa fa-angle-left pull-right"></i></a>
					<ul class="treeview-menu">
						<li {{ (\Request::is('reporte/reporteMorosidad*'))?"class=active":"" }}><a href="{{ URL::to('reporte/reporteMorosidad') }}"><i class="fa fa-file-o"></i> 1-. Reporte de Morosidad</a></li>        		
					</ul>  
					<li {{ (\Request::is('reporte/reporteLibroDeVentas*'))?"class=active":"" }}><a href="#"><i class="fa fa-folder-open"></i><span> Cierre Mensual</span><i class="fa fa-angle-left pull-right"></i></a>
					<ul class="treeview-menu">
						<li {{ (\Request::is('reporte/reporteLibroDeVentas*'))?"class=active":"" }}><a href="{{ URL::to('reporte/reporteLibroDeVentas') }}"><i class="fa fa-folder-o"></i> 1-. Libro de Ventas</a></li>
					</ul>
					<li {{ (\Request::is('reporte/reporteRelacionCobranza*') || \Request::is('reporte/reporteRelacionFacturasAeronauticasCredito*') || \Request::is('reporte/reporteRelacionIngresosAeronauticosContado*'))?"class=active":"" }}><a href="#"><i class="fa fa-folder-open"></i><span> Clientes</span><i class="fa fa-angle-left pull-right"></i></a>
					<ul class="treeview-menu">
							<li {{ (\Request::is('reporte/reporteRelacionFacturasCliente*'))?"class=active":"" }}><a href="{{ URL::to('reporte/reporteRelacionFacturasCliente') }}"><i class="fa fa-file-o"></i> 1-. Relación de Facturas De CLientes</a></li>

					</ul>    
<!--             			<li><a href="{{action('ReporteController@getReporteModuloMetaMensual')}}"><i class="fa fa-folder-o"></i> Libro de ventas</a></li> -->
<!-- 						<li {{ (\Request::is('reporte/mensual*'))?"class=active":"" }}><a href="{{ URL::to('reporte/mensual') }}"><i class="fa fa-folder-o"></i> Recaudación consolidada</a></li>-->
<!--                  	<li><a href="{{action('ReporteController@getReporteMensual')}}"><i class="fa fa-folder-o"></i> Recaudación consolidada</a></li>-->            		<!-- <li><a href="#"><i class="fa fa-folder-o"></i> Relación facturado/cobrado</a></li> 
            		<li><a href="#"><i class="fa fa-folder-o"></i> Relación de contratos</a></li>
            		<li><a href="#"><i class="fa fa-folder-o"></i> Listado facturas emitidas</a></li>  -->

            		@endpermission
            	</ul>
            </li>
           	@endpermission


            @permission('menu.informacion|menu.cliente|menu.role|menu.usuario|menu.modulo|menu.concepto|menu.preciosSCV')
            <li class="treeview {{ (\Request::is('administracion*'))?"active":""}}">
            	<a href="#">
            		<i class="fa fa-cogs"></i> <span>Administración</span> <i class="fa fa-angle-left pull-right"></i>
            	</a>
            	<ul class="treeview-menu">
            	<li {{ (\Request::is('administracion/informacion*'))?"class=active":"" }}><a href="{{ URL::to('administracion/informacion') }}"><i class="fa fa-info-circle"></i> Información</a></li>
            		@permission('menu.informacion')
            		<li {{ (\Request::is('administracion/meta*'))?"class=active":"" }}><a href="{{ URL::to('administracion/meta') }}"><i class="fa fa-area-chart"></i> Metas</a></li>
            		@endpermission
            		@permission('menu.cliente')
            		<li {{ (\Request::is('administracion/cliente*'))?"class=active":"" }}><a href="{{ URL::to('administracion/cliente') }}"><i class="fa  fa-smile-o"></i> Cliente</a></li>
            		@endpermission
            		@permission('menu.role')
            		<li {{ (\Request::is('administracion/roles*'))?"class=active":"" }}><a href="{{ URL::to('administracion/roles') }}"><i class="fa fa-users"></i> Grupos de usuarios</a></li>
            		@endpermission
            		@permission('menu.usuario')
            		<li><a href="{{ URL::to('administracion/usuarios') }}"><i class="fa fa-user"></i> Usuarios</a></li>
            		@endpermission
	                 <!-- <li><a href="{{ URL::to('tasas/impresion') }}"><i class="fa fa-print"></i> Impresión tasas</a></li>
	                 <li><a href="{{ URL::to('administracion/sincronizacion') }}"><i class="fa fa-refresh"></i> Sincronización</a></li>-->
	                 @permission('menu.modulo')
	                 <li {{ (\Request::is('administracion/modulo*'))?"class=active":"" }}><a href="{{ URL::to('administracion/modulo') }}"><i class="fa  fa-archive"></i> Módulos</a></li>
	                 @endpermission
	                 @permission('menu.concepto')
	                 <li {{ (\Request::is('administracion/concepto*'))?"class=active":"" }}><a href="{{ URL::to('administracion/concepto') }}"><i class="fa  fa-archive"></i> Conceptos</a></li>
	                 @endpermission
	                 @permission('menu.preciosSCV')
	                 <li {{ (\Request::is('administracion/configuracionSCV*'))?"class=active":"" }}><a href="{{ URL::to('administracion/configuracionSCV') }}"><i class="fa  fa-plane"></i> Configuración de Cargos</a></li>
	                 @endpermission
	             </ul>
	         </li>
	         @endpermission
         @endpermission
     </ul>
 </section>
 <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
<!--           <section class="content-header">
        <h1>
          Dashboard
          <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
    </section> -->



    <!-- Main content -->
    <section class="content">
