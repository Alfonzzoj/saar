<?php

	/*
	 * NOTAS PENDIENTES:
	 * 					1. Hay que agregar la funcion para generar el codigo de barras y meter el arreglo dentro 
	 * 						de la variable asignada $BC.
	 * 					2. Generar el Usuario segun la sesion, revisar sesion de usuario , se necesita formulario para 
	 * 						dich accion.
	 */

	include_once ("../conf_tasas/index.php");	
		
	//usando submit
	$fecha 		= $_REQUEST["tFechaHoy"];
	$fecha 		= normal_mysql ($fecha);
	
	$id 	= $_REQUEST["tID"];
	
	//	Campos
	$cod		= $_REQUEST [''];
	$femi		= $_REQUEST ['tFechaEmi'];
	$hemi		= $_REQUEST ['tHoraHoy'];
	$tiptas		= $_REQUEST ['tTasa'];
	$estado		= $_REQUEST ['tEstado'];
	$usuario	= $_REQUEST [''];
	$fcierre	= $_REQUEST ['tFechaCierre'];
	
	//	Generar codigo de barras
	$BC			= $_REQUEST [''];
	
	// ** Fin del Codigo de Barras
	
	//Insertar
	if (isset ($_REQUEST["bEnviar"])) {
			
		if (mysql_num_rows($result) > 0) mysql_query("select * from tatasas);
		
			}
	
	//Eliminar
	if (isset ($_REQUEST["bEliminar"])) {
		mysql_query("DELETE FROM tatasas WHERE ID ='$id'", $conn);
	}
	
	header('location: ../../../index.php');
?> 