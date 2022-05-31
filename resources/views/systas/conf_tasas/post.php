<?php

	/*
	 * NOTAS PENDIENTES:
	 * 					1. Hay que agregar la funcion para generar el codigo de barras y meter el arreglo dentro 
	 * 						de la variable asignada $BC.
	 * 					2. Generar el Usuario segun la sesion, revisar sesion de usuario , se necesita formulario para 
	 * 						dich accion.
	 */

	include_once ("index.php");	
		
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
			
		if (mysql_num_rows($result) > 0) {
			mysql_query("UPDATE tatasas SET ".
											// "codtas 	= '$cod', " .
											// "femision 	= '$femi', " .
											// "hemision 	= '$hemi', " .
											// "tiptas 	= '$tiptas', " .
											 "status 	= '$estado', " .
											 "encargado = '$usuario', " .
											 "fcierre	= '$fcierre', " .
											// "codbarras	= '$CB' " .
						 "WHERE ID = '$id'", $conn);
		}
		else {
		
			mysql_query("INSERT INTO tatasas ".
						 "(" .
							 "codtas, " .
							 "femision, " .
							 "hemision, " .
							 "tiptas, " .
							 "status, " .
							 "encargado, " .
							// "fcierre, " .
							 "codbarras " .
						 "VALUES ".
						 "(" .
							 "'$cod', " .
							 "'$femi', " .
							 "'$hemi', " .
							 "'$tiptas', " .
							 "'$estado', " .
							 "'$usuario', " .
							// "'$fcierre', " .
							 "'$CB' " .
						 ")",$conn) or die (mysql_errno());
		}
	}
	
	//Eliminar
	if (isset ($_REQUEST["bEliminar"])) {
		mysql_query("DELETE FROM tatasas WHERE ID ='$id'", $conn);
	}
	
	header('location: ../../../index.php');
?> 