<?php
    include_once ('index.php');
	
//	Switch para indicar el estado de una consulta
	$z = "n";
		
//	Cambiar el Formato de las fechas para mysql
	$CB	= $_REQUEST ['cb'];

	$sql = ("SELECT * FROM tatasas WHERE codbarras = '$CB' ORDER BY id DESC");
	$result = mysql_query($sql, $conn);
	$total = mysql_num_rows ($result);
	
	if (isset ($_REQUEST["qIdList"])) {
		$qID 	= $_REQUEST["qIdList"];
		$z 		= "s";
		
		$q  = ("SELECT * FROM tatasas WHERE id = '$qID'");
		$rs = mysql_query($q, $conn);
		
		/*
		 * Datos que devuelve la consulta para llenar los campos en el formulario
		 */
		$qID		= mysql_result ($rs, 0, "id");
		$qfemi 		= mysql_result ($rs, 0, "femision");
		$qhemi	 	= mysql_result ($rs, 0, "hemision");
		$qtiptas		= mysql_result ($rs, 0, "tiptas");
		$qestado		= mysql_result ($rs, 0, "status");
		$qfcierre	= mysql_result ($rs, 0, "fcierre");
		$qCB			= mysql_result ($rs, 0, "codbarras");
	}
?>