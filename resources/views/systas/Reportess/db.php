<?php
/*
CONECTAR A LA DB
CVS Diseñado por php.com.ve 2000-2007  */
$servidor = "localhost";
$usuario = "root";
$clave_acceso_bd = "root";
$base_datos = "systat";
if (!$conexion = @mysql_connect("$servidor", "$usuario", "$clave_acceso_bd"))
{
  die ("Error en conexión a base de datos, reintente más tarde por favor");
  
/* $conexion =@mysql_connect("$servidor", "$usuario", "$clave_acceso_bd")
    OR die("Error en conexión a base de datos "); */

  
}
if (!@mysql_select_db($base_datos, $conexion))
{
  die ("Error en conexión a base de datos, reintente más tarde por favor");
}
?>
