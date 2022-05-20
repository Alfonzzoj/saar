<?php session_start();

	/*
	 * NOTAS PENDIENTES:
	 * 					1. Hay que agregar la funcion para generar el codigo de barras y meter el arreglo dentro 
	 * 						de la variable asignada $BC.
	 * 					2. Generar el Usuario segun la sesion, revisar sesion de usuario , se necesita formulario para 
	 * 						dich accion.
	 */
	require_once ("../../inc/db.php");
	require_once ("../../class/func.php");
	include_once ("index.php");	
    
	
	//	Campos
	$c		= strtoupper($_REQUEST ['c']);
	$f		= date("d/m/Y");
	$h		= date("H:i:s");
    $x      = strtoupper($_REQUEST ['c']);
    $ct     = strtoupper($_REQUEST ['c']);

	
	$c=str_replace('\'', '-', $c);  // remplazar 
	
	$x=substr ($c, 0, 1);
	
	$ct=substr ($c, 1, 4);
    
	
	// ** Fin del Codigo de Barras
	
	
	 $n=$_SESSION['auth_nom'];
	
	/*
	 * Verificar si el codigo esta activo  
	 */
	 
	 //NUEVO//	
	 
	 $sqlVer=mysql_query("Select status from tatasas where codbarras='$c'",$conn) or die (mysql_error());
	 
	 $s=mysql_result($sqlVer,0,0);
	  
	 if ($s=='A') {
	 
	 	//Actualizar 
	    mysql_query("UPDATE tatasas set status='1',fVer='$f',hVer='$h' where codbarras='$c'",$conn) or die (mysql_error());
		header('location: ../../index.php');
		
		mysql_query("insert into concil (encargado,codbarras, fVer, hVer, serie, codtas) values ('$n','$c','$f','$h','$x','$ct')") ;
	

		} else {
		
		if ($s==0) {
//		   header('location: ../../index.php');
		   echo '<script> alert (\'.::Tasa NO Existe!!!::.\'); history.back();</script>';
		   }  else {
		
	  	   echo '<script> alert (\'.::Tasa YA Verificada!!!::.\'); history.back();</script>';
		   }
	 }
	
?> 
