<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;


class ViewComposerServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{


        \Html::macro('sortableColumnTitle', function($title, $varName){
            return "<th style='cursor:pointer' class='sortable-table-title' data-sort-name='".$varName."'> $title <span class='".((array_get(\Input::all(),"sortName") == $varName)?((array_get(\Input::all(),"sortType")=='ASC')?'glyphicon glyphicon-sort-by-attributes':'glyphicon glyphicon-sort-by-attributes-alt'):'glyphicon glyphicon-sort')."'></span></th>";
        });

        \Html::macro('pagination', function($page){

           return "Mostrando: ".(($page->currentPage()-1)*$page->perPage()+1)." - ".(($page->currentPage()-1)*$page->perPage()+$page->count())." de ".$page->total();
        });

        view()->composer(['*'], function($view){
            /**
             * tiene dos metodos
             * numtoletras(numero) => trnasforma numero en letras
             * format(numero) => transforma los decimales a español
             */
            $traductor=new \App\Library\Converter();
            $view->with(compact('traductor'));
        });

		view()->composer(['partials.navbar', 'partials.menu'], function($view){
            $user      =\Auth::user();
            $rol        = $user->roles->first();
            if ($rol->id == 1 || $rol->id == 2 || $rol->name == 5){
                $url  ='DashboardController@indexSCV';
                $name ='CONTROL DE VUELOS';
            }elseif ($rol->id == 3 || $rol->name == 7){
                $url  ='DashboardController@indexRecaudacion';
                $name ='RECAUDACIÓN';
            }elseif ($rol->id == 8){
                $url  ='DashboardController@indexDireccion';
                $name ='DIRECCION';
            }else{
                $url  ='DashboardController@indexOtros';
                $name = $user->departamento->nombre;
            }
            $userName  =ucwords($user->username);
            $createdAt =$user->created_at;
            $view->with(compact('userName', 'createdAt', 'url', 'name'));
        });

        view()->composer(['aeronaves.partials.index'], function($view){
            $nacionalidades= \App\NacionalidadMatricula::lists('nombre', 'siglas', 'id');
            $view->with(compact('nacionalidades'));
        });


        view()->composer(['reportes.reporteTraficoAereo'], function($view){
            $puertos= [""=>"TODOS"]+\App\Puerto::lists('nombre','id');
            $view->with(compact('puertos'));
        });


        view()->composer(['administracion.informacion', 'conciliacion.listMovimientos'], function($view){
            $bancos= \App\Banco::get();
            $view->with(compact('bancos'));
        });

        view()->composer(['conciliacion.listMovimientos'], function($view){
            $cuentas= [""=>"-- Seleccione Cuenta Bancaria--"]+\App\Bancoscuenta::lists('descripcion', 'id');
            $view->with(compact('cuentas'));
        });

        view()->composer(['administracion.informacion'], function($view){
            $cuentas= \App\Bancoscuenta::get();
            $view->with(compact('cuentas'));
        });

        view()->composer(['cliente.partials.form', 'aeronaves.index', 'aeronaves.partials.form'], function($view){
            $hangars= \App\Hangar::where("aeropuerto_id","=", session('aeropuerto')->id)->lists('nombre', 'id');
            $view->with(compact('hangars'));
        });

        view()->composer(['reportes.reporteTraficoAereo', 'reportes.reporteDES900'], function($view){
            $clientes= [""=>"TODOS"]+\App\Cliente::where("tipo","=", "Aeronáutico")->orWhere("tipo","=", "Mixto")->lists('nombre', 'id');
            $view->with(compact('clientes'));
        });

        view()->composer(['aeronaves.partials.form', 'aeronaves.index', 'aterrizajes.index', 'aterrizajes.create', 'aterrizajes.partials.form', 'aterrizajes.partials.edit', 'aterrizajes.partials.show', 'despegues.index', 'despegues.create', 'despegues.partials.form', 'despegues.partials.edit', 'despegues.partials.show', 'cargas.index', 'cargas.create', 'cargas.partials.edit', 'cargas.partials.form', 'cargas.partials.show', 'reportes.reporteRelacionFacturasAeronauticasCredito', 'reportes.reporteRelacionFacturasAeronauticas','reportes.reporteRelacionFacturasCliente', 'reportes.reporteRelacionFacturasAeronauticasCreditoResumen'], function($view){
            $clientes= [""=>"-- Seleccione Cliente--"]+\App\Cliente::where("tipo","=", "Aeronáutico")->orWhere("tipo","=", "Mixto")->lists('nombre', 'id');
            $view->with(compact('clientes'));
        });

        view()->composer(['reportes.reporteRelacionCobranza'], function($view){
            $clientes= [""=>"-- Seleccione Cliente--"]+\App\Cliente::lists('nombre', 'id');
            $view->with(compact('clientes'));
        });

        view()->composer(['reportes.reporteReporteDeMorosidad'], function($view){
            $clientes= [""=>"-- Seleccione Cliente--"]+\App\Cliente::join('facturas','facturas.cliente_id' , '=', 'clientes.id')
                                    ->where('facturas.aeropuerto_id','=', session('aeropuerto')->id)
                                    ->where('facturas.estado','=','P')
                                    ->orderBy('clientes.nombre')
                                    ->groupBy("clientes.id")
                                    ->select('clientes.nombre as nombre', 'clientes.id as id')
                                    ->lists('nombre', 'id');
            $view->with(compact('clientes'));
        });

        view()->composer(['index',
                          'cliente.partials.form',
                          'factura.partials.form', 
                          'usuarios.index', 
                          'usuarios.partials.form', 
                          'reportes.reporteControlDeRecaudacionMensual', 
                          'reportes.reporteControlDeRecaudacionDiario', 
                          'reportes.reporteFormulariosAnulados', 
                          'reportes.reporteReporteDeMorosidad'], function($view){
            $aeropuertos = \App\Aeropuerto::lists('nombre', 'id');
            $view->with(compact('aeropuertos'));
        });

        view()->composer(['cliente.partials.form'], function($view){
            $paises = \App\Pais::lists('nombre','id');
            $view->with(compact('paises'));
        });

        view()->composer(['usuarios.index', 
                          'usuarios.partials.show', 
                          'usuarios.partials.edit',
                          'usuarios.partials.form'], function($view){
            $departamentos = \App\Departamento::lists('nombre','id');
            $view->with(compact('departamentos'));
        });

        view()->composer(['usuarios.index', 
                          'usuarios.partials.show', 
                          'usuarios.partials.edit',
                          'usuarios.partials.form'], function($view){
            $cargos = \App\Cargo::lists('nombre','id');
            $view->with(compact('cargos'));
        });

        view()->composer(['configuracionPrecios.confGeneral.index', 
                          'configuracionPrecios.confGeneral.partials.edit',
                          'configuracionPrecios.confGeneral.partials.form', 
                          'configuracionPrecios.confGeneral.partials.show', 
                          'configuracionPrecios.confAterrizajeDespegue.Comercial.matriculaNacional.partials.edit', 
                          'configuracionPrecios.confAterrizajeDespegue.Comercial.matriculaNacional.partials.form', 
                          'configuracionPrecios.confEstacionamientoAeronave.Comercial.matriculaNacional.partials.edit', 
                          'configuracionPrecios.confEstacionamientoAeronave.Comercial.matriculaNacional.partials.form', 
                          'configuracionPrecios.confAterrizajeDespegue.Comercial.matriculaExtranjera.partials.edit', 
                          'configuracionPrecios.confAterrizajeDespegue.Comercial.matriculaExtranjera.partials.form', 
                          'configuracionPrecios.confEstacionamientoAeronave.Comercial.matriculaExtranjera.partials.edit', 
                          'configuracionPrecios.confEstacionamientoAeronave.Comercial.matriculaExtranjera.partials.form', 
                          'configuracionPrecios.confAterrizajeDespegue.General.matriculaNacional.partials.edit', 
                          'configuracionPrecios.confAterrizajeDespegue.General.matriculaNacional.partials.form', 
                          'configuracionPrecios.confEstacionamientoAeronave.General.matriculaNacional.partials.edit', 
                          'configuracionPrecios.confEstacionamientoAeronave.General.matriculaNacional.partials.form', 
                          'configuracionPrecios.confAterrizajeDespegue.General.matriculaExtranjera.partials.edit', 
                          'configuracionPrecios.confAterrizajeDespegue.General.matriculaExtranjera.partials.form', 
                          'configuracionPrecios.confEstacionamientoAeronave.General.matriculaExtranjera.partials.edit', 
                          'configuracionPrecios.confEstacionamientoAeronave.General.matriculaExtranjera.partials.form', 
                          'configuracionPrecios.confCargosVarios.index', 
                          'configuracionPrecios.confCargosVarios.partials.edit', 
                          'configuracionPrecios.confCargosVarios.partials.form', 
                          'configuracionPrecios.confCargosVarios.partials.show', 
                          'configuracionPrecios.confCarga.index', 
                          'configuracionPrecios.confCarga.partials.edit', 
                          'configuracionPrecios.confCarga.partials.form', 
                          'configuracionPrecios.confCarga.partials.show'], function($view){
            $confGeneral = \App\MontosFijo::where("aeropuerto_id", session('aeropuerto')->id)->get();
            $view->with(compact('confGeneral'));
        });

        view()->composer(['configuracionPrecios.confAterrizajeDespegue.Comercial.matriculaNacional.partials.edit', 
                          'configuracionPrecios.confAterrizajeDespegue.Comercial.matriculaNacional.partials.form', 
                          'configuracionPrecios.confAterrizajeDespegue.Comercial.matriculaExtranjera.partials.edit', 
                          'configuracionPrecios.confAterrizajeDespegue.Comercial.matriculaExtranjera.partials.form', 
                          'configuracionPrecios.confAterrizajeDespegue.General.matriculaNacional.partials.edit', 
                          'configuracionPrecios.confAterrizajeDespegue.General.matriculaNacional.partials.form', 
                          'configuracionPrecios.confAterrizajeDespegue.General.matriculaExtranjera.partials.edit', 
                          'configuracionPrecios.confAterrizajeDespegue.General.matriculaExtranjera.partials.form'], function($view){
            $precioAterrizajeDespegue = \App\PreciosAterrizajesDespegue::where("aeropuerto_id", session('aeropuerto')->id)->get();
            $view->with(compact('precioAterrizajeDespegue'));
        });


        view()->composer(['configuracionPrecios.confEstacionamientoAeronave.Comercial.matriculaNacional.partials.edit', 
                          'configuracionPrecios.confEstacionamientoAeronave.Comercial.matriculaNacional.partials.form', 
                          'configuracionPrecios.confEstacionamientoAeronave.Comercial.matriculaExtranjera.partials.edit', 
                          'configuracionPrecios.confEstacionamientoAeronave.Comercial.matriculaExtranjera.partials.form', 
                          'configuracionPrecios.confEstacionamientoAeronave.General.matriculaNacional.partials.edit', 
                          'configuracionPrecios.confEstacionamientoAeronave.General.matriculaNacional.partials.form', 
                          'configuracionPrecios.confEstacionamientoAeronave.General.matriculaExtranjera.partials.edit', 
                          'configuracionPrecios.confEstacionamientoAeronave.General.matriculaExtranjera.partials.form'], function($view){
            $estacionamientoAeronave = \App\EstacionamientoAeronave::where("aeropuerto_id", session('aeropuerto')->id)->get();
            $view->with(compact('estacionamientoAeronave'));
        });


        view()->composer(['configuracionPrecios.confHorarioAeronautico.index', 
                          'configuracionPrecios.confHorarioAeronautico.partials.edit', 
                          'configuracionPrecios.confHorarioAeronautico.partials.form', 
                          'configuracionPrecios.confHorarioAeronautico.partials.show'], function($view){
            $horarioAeronautico  = \App\HorariosAeronautico::where("aeropuerto_id", session('aeropuerto')->id)->get();
            $view->with(compact('horarioAeronautico'));
        });

        view()->composer(['configuracionPrecios.confCargosVarios.index', 
                          'configuracionPrecios.confCargosVarios.partials.edit', 
                          'configuracionPrecios.confCargosVarios.partials.form', 
                          'configuracionPrecios.confCargosVarios.partials.show'], function($view){
            $cargosVarios  = \App\CargosVario::where("aeropuerto_id", session('aeropuerto')->id)->get();
            $view->with(compact('cargosVarios'));
        });


        view()->composer(['configuracionPrecios.confCarga.index', 
                          'configuracionPrecios.confCarga.partials.edit', 
                          'configuracionPrecios.confCarga.partials.form', 
                          'configuracionPrecios.confCarga.partials.show'], function($view){
            $precioCargas = \App\PreciosCarga::where("aeropuerto_id", session('aeropuerto')->id)->get();
            $view->with(compact('precioCargas'));
        });


        view()->composer([  'dashboards.recaudacion.partials.index',
                            'reportes.reporteRelacionCobranza',
                            'reportes.reporteListadoFacturas',
                            'reportes.reporteListadoFacturasCliente',
                            'reportes.reporteRelacionEstacionamientoDiario',
                            'reportes.reporteRelacionMensualDeIngresosRecaudacionPendiente',
                            'reportes.reporteRelacionMensualDeFacturacionCobradosYPorCobrar',
                            'reportes.reporteRelacionIngresoMensual',
                            'reportes.reporteRelacionIngresosAeronauticosContado',
                            'reportes.reporteRelacionFacturasAeronauticasCredito',
                            'reportes.reporteRelacionFacturasAeronauticas',
                            'reportes.reporteRelacionFacturasCliente',
                            'reportes.reporteRelacionFacturasAeronauticasCreditoResumen',
                            'reportes.reporteRelacionMetaRecaudacionMensual',
                            'reportes.reporteDiario',
                            'reportes.reporteFormulariosAnulados',
                            'reportes.reporteListadoClientes',
                            'reportes.reporteLibroDeVentas',
                            'reportes.reporteControlDeRecaudacionMensual',
                            'reportes.reporteControlDeRecaudacionDiario',
                            'reportes.reporteModuloMetaMensual'], function($view){
            $gerencia     = "Gerencia de Administración";
            $departamento = "Departamento de Recaudación de Servicios Aeroportuarios";
            $view->with(compact('gerencia', 'departamento'));
        });

        view()->composer([  'reportes.reporteTraficoAereo',
                            'reportes.reporteCuadreCaja',
                            'reportes.reporteDES900'], function($view){
            $gerencia     = "Gerencia de Aeropuerto";
            $departamento = "Sección de Control de Vuelos";
            $view->with(compact('gerencia', 'departamento'));
        });

        view()->composer(['contrato.partials.form','factura.partials.form', 'aeronaves.partials.table'], function($view){
            $clientes =\App\Cliente::select('codigo', 'id', 'nombre','cedRif','cedRifPrefix')->get();
            $view->with(compact('clientes'));
        });

        view()->composer(['administracion.informacion', 
                          'administracion.meta', 
                          'contrato.partials.form', 
                          'configuracionPrecios.confAterrizajeDespegue.Comercial.matriculaNacional.partials.edit', 
                          'configuracionPrecios.confAterrizajeDespegue.Comercial.matriculaNacional.partials.form', 
                          'configuracionPrecios.confEstacionamientoAeronave.Comercial.matriculaNacional.partials.edit', 
                          'configuracionPrecios.confEstacionamientoAeronave.Comercial.matriculaNacional.partials.form', 
                          'configuracionPrecios.confAterrizajeDespegue.Comercial.matriculaExtranjera.partials.edit', 
                          'configuracionPrecios.confAterrizajeDespegue.Comercial.matriculaExtranjera.partials.form', 
                          'configuracionPrecios.confEstacionamientoAeronave.Comercial.matriculaExtranjera.partials.edit', 
                          'configuracionPrecios.confEstacionamientoAeronave.Comercial.matriculaExtranjera.partials.form', 
                          'configuracionPrecios.confAterrizajeDespegue.General.matriculaNacional.partials.edit', 
                          'configuracionPrecios.confAterrizajeDespegue.General.matriculaNacional.partials.form', 
                          'configuracionPrecios.confEstacionamientoAeronave.General.matriculaNacional.partials.edit', 
                          'configuracionPrecios.confEstacionamientoAeronave.General.matriculaNacional.partials.form', 
                          'configuracionPrecios.confAterrizajeDespegue.General.matriculaExtranjera.partials.edit', 
                          'configuracionPrecios.confAterrizajeDespegue.General.matriculaExtranjera.partials.form', 
                          'configuracionPrecios.confEstacionamientoAeronave.General.matriculaExtranjera.partials.edit', 
                          'configuracionPrecios.confEstacionamientoAeronave.General.matriculaExtranjera.partials.form',  
                          'configuracionPrecios.confCargosVarios.partials.edit', 
                          'configuracionPrecios.confCargosVarios.partials.form', 
                          'configuracionPrecios.confCarga.partials.edit', 
                          'configuracionPrecios.confCarga.partials.form', 
                          'configuracionPrecios.confOtrosCargos.index',
                          'configuracionPrecios.confOtrosCargos.partials.table',
                          'configuracionPrecios.confOtrosCargos.partials.form',], function($view){
            $conceptos =[""=>"-- Seleccione un concepto --"]+session('aeropuerto')->conceptos()->orderBy('nompre', 'ASC')->lists('nompre', 'id');
            $view->with(compact('conceptos'));
        });


        view()->composer(['factura.edit', 'factura.create', 'factura.partials.show'], function($view){
            $route        =\Route::current();
            $params       =$route->parameters();
            $moduloNombre =($params["modulo"]=="Todos")?"%":$params["modulo"];
            $modulo       =\App\Modulo::where("nombre", "like", $moduloNombre)->where("aeropuerto_id","=", session('aeropuerto')->id)->lists("id");
            $conceptos    =\App\Concepto::select('nompre', 'id', 'iva', 'condicionPago')->whereIn("modulo_id",$modulo)->orderBy('nompre', 'ASC')->get();
            $view->with(compact('clientes', 'conceptos'));
        });

        view()->composer([
            'reportes.reporteRelacionCobranza',
            'reportes.reporteRelacionEstacionamientoDiario',
            'reportes.reporteDiario',
            'reportes.reporteModuloMetaMensual',
            'reportes.reporteRelacionMensualDeFacturacionCobradosYPorCobrar',
            'reportes.reporteDES900',
            'reportes.reporteListadoFacturas',
            'reportes.reporteListadoFacturasCliente',
            'reportes.reporteRelacionIngresosAeronauticosContado',
            'reportes.reporteLibroDeVentas',
            'reportes.reporteRelacionFacturasAeronauticasCredito',
            'reportes.reporteRelacionFacturasAeronauticas',
            'reportes.reporteRelacionFacturasCliente',
            'reportes.reporteRelacionFacturasAeronauticasCreditoResumen',
            'reportes.reporteTraficoAereo'], function($view){
            $aeropuertos = \App\Aeropuerto::lists('nombre', 'id');
            $aeropuertos[0]="Todos";
            $view->with(compact('aeropuertos'));
        });


        \View::composer([
            'reportes.reporteRelacionCobranza',
            'reportes.reporteRelacionEstacionamientoDiario',
            'reportes.reporteDiario',
            'reportes.reporteModuloMetaMensual',
            'reportes.reporteRelacionMensualDeFacturacionCobradosYPorCobrar',
            'reportes.reporteDES900',
            'reportes.reporteCuadreCaja',
            'factura.automatica',
            'reportes.reporteListadoFacturas',
            'reportes.reporteListadoFacturasCliente',
            'reportes.reporteRelacionIngresoMensual',
            'reportes.reporteRelacionIngresosAeronauticosContado',
            'reportes.reporteRelacionMetaRecaudacionMensual',
            'reportes.reporteRelacionFacturasAeronauticasCredito',
            'reportes.reporteRelacionFacturasAeronauticas',
            'reportes.reporteRelacionFacturasCliente',
            'reportes.reporteRelacionFacturasAeronauticasCreditoResumen',
            'reportes.reporteRelacionMensualDeIngresosRecaudacionPendiente',
            'reportes.reporteControlDeRecaudacionMensual',
            'reportes.reporteControlDeRecaudacionDiario',
            'reportes.reporteLibroDeVentas',
            'reportes.reporteFormulariosAnulados',
            'reportes.reporteReporteDeMorosidad',
            'reportes.reporteTraficoAereo',
            'conciliacion.listMovimientos'], function($view){
            $meses=[
                "01"=>"ENERO",
                "02"=>"FEBRERO",
                "03"=>"MARZO",
                "04"=>"ABRIL",
                "05"=>"MAYO",
                "06"=>"JUNIO",
                "07"=>"JULIO",
                "08"=>"AGOSTO",
                "09"=>"SEPTIEMBRE",
                "10"=>"OCTUBRE",
                "11"=>"NOVIEMBRE",
                "12"=>"DICIEMBRE"];

            $annos=[
                "2015"=>"2015", 
                "2016"=>"2016", "2017"=>"2017",
                "2018"=>"2018", "2019"=>"2019",
                "2020"=>"2020", "2021"=>"2021",
                "2022"=>"2022", "2023"=>"2023",
                "2024"=>"2024", "2025"=>"2025",
                "2026"=>"2026", "2027"=>"2027",
                "2028"=>"2028", "2029"=>"2029",
                "2030"=>"2030", "2031"=>"2031",
                "2032"=>"2032", "2033"=>"2033",
                "2034"=>"2034", "2035"=>"2035",
            ];
            $view->with(compact('meses', 'annos'));
        });
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
