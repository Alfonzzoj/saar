<?php
	/**
	 * Funciones para eventos generales
	 */
	
//	Enlace Dinamico Basico
	function linkTo ($link_ref, $link_nombre, $link_titulo) {			
		$link_to = "<a href=\"$link_ref\" title=\"$link_titulo\" >$link_nombre</a>";
		print $link_to;
	}
	
	function aJax($nombre, $titulo, $div, $ruta, $datos, $confirm) {
		if ($datos == "") $datos = "''" ;		//	en caso de que enviemos la consulta sin datos
		$cursor = "style=\"cursor:pointer\"";	//	estilo de cursor para mostrar el enlace
		
		$enlace = "<a onclick= \" aJax ('$div', '$ruta', $datos, '$confirm')\" title=\"$titulo\" $cursor>$nombre</a>";
		print $enlace;
	}
	
	function aJaxOnLoad($div, $ruta, $datos, $confirm) {
		if ($datos == "") $datos = "''" ;		//	en caso de que enviemos la consulta sin datos
		
		$enlace = "aJax ('$div', '$ruta', $datos, '$confirm')";
		print $enlace;
	}
	
	//	Botonera basica por defecto
 	function aJaxBoton($name, $value, $div, $ruta, $datos, $confirm){
 		if ($datos == "") $datos = "''" ;
 		print 	"<input type=\"button\" id=\"$name\" name=\"$name\" value=\"$value\" onclick= \" aJax ('$div', '$ruta', $datos, '$confirm')\" />\n";
 	}

//	Imagen Dinamico Basico
	function imgRef ($link_ref, $link_titulo) {			
		$img_Ref = "<img src=\"$link_ref\" title=\"$link_titulo\" alt=\"$link_titulo\" >";
		print $img_Ref;
	}
	
//	Mostrar imagenes aleatorias
	function rdm_imagenes($directorio_imagenes) {
		
		$msg = "";						#mensaje para mostrar.
		$y = 0;							#cuenta el numero de imagenes.
		$imagenes = array();       #mantiene la lista de las imagenes.
		$manejador_archivos = "";
		
		if (is_dir($directorio_imagenes)) {
			$manejador_archivos=opendir($directorio_imagenes); 
			$y = 0;
			while ($archivo = readdir($manejador_archivos)) { 
					  if (!is_dir($directorio_imagenes . $archivo)) { 
						  $imagenes[$y] = $directorio_imagenes . $archivo; 
						  $y += 1;
					}
			}
			closedir($manejador_archivos); 
			if (count($imagenes) > 0) {
				  srand((double)microtime()*1000000);
				$y = rand(0,(count($imagenes) - 1));
				$msg = "<IMG SRC=\"" . $imagenes[$y] . "\" ALT=\"" . $y . "\">\n";
			} else {
				$msg = "No se han localizado imagenes para mostrar \"" . $directorio_imagenes . "\"\n";
			}
		} else {
			$msg = "\"" . $directorio_imagenes . "\" no es un directorio v&aacute;lido!\n";
		}
		return $msg;
	}
	
/**
 * FUNCIUONES PARA LA FECHA
 */
	function normal_mysql($Fecha) {
		if ($Fecha<>""){
			$partes=explode("/",$Fecha,3);
			return $partes[2]."-".$partes[1]."-".$partes[0]; }
		else
			{return "NULL";}
	}
	
	function mysql_normal($MySQLFecha) {
		if (($MySQLFecha == "") or ($MySQLFecha == "0000-00-00") )
			 {return "";}
		else
			 {return date("d/m/Y",strtotime($MySQLFecha));}
	}
	
	function mysql_foto($MyFecha) {
		if (($MyFecha == "") or ($MyFecha == "0000-00-00") )
			 {return "";}
		else
			 {return date("d_m_y",strtotime($MyFecha));}
	}
	
	function normal_mysql_hora($Hora) {
		if ($Hora<>""){
			$partes=explode(":",$Hora,2);
			return $partes[0]."".$partes[1]; }
		else
			{return "NULL";}
	}
	


/**
 * FUNCUIONES PARA TEXTO
 */
 	function recortar_cadena ($str, $num) {
	  $str = substr($str, 0, $num);
	  $str = substr($str, 0, $num-strlen(strrchr($str, " ")));
	  return $str."...";
	  	//recortar_cadena($frase, 20) . "<br><br>";
	}

	
	function sel_lst_num($lst_num) {
		if ($lst_num <> ""){
			$partes = explode("-",$lst_num,3);
			return $partes[2]; }
		else
			{return "NULL";}
	}
	
	
	//Desconcatenar combo
	
	function cb_descon($lst_num) {
		if ($lst_num <> ""){
			$partes = explode("-",$lst_num);
			return $partes[1]; }
		else
			{return "NULL";}
	}
	

/**
 * FUNCIONES PARA EL CALENDARIO
 */
 function dtCalendario ($form, $campo) {
 	$calendario = "<a onclick=\"displayCalendar (" .
 				  "document.".$form.".".$campo.",'dd/mm/yyyy',this)\" " .
 				  "style=\"cursor:pointer\" title=\"Haga click para mostrar el calendario\" >" .
 				  "<img src=\"public/css/img/fecha.gif\" width=\"15\" height=\"11\" border=\"0\" />" .
 				  "</a>";
 	print $calendario;
 }
 
 
?>