<html>
<body> 
<head>
<title>Reporte de Tasas Conciliadas</title>
</head>
<table width="100%" border="1">
  <tr> 
    <td><img src="../public/css/img/top.gif" width="100%" height="130"></td>
  </tr>
</table>
<table width="100%" align="center" border="0" background="#666666">
  <tr> 
    <td width="100%" align="center"> 
    </td>
  </tr>
</table>
<table width="100%" align="center" border="0" background="#666666">
  <tr> 
    <td width="100%" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
      <font size="3"><strong>REPORTE DE TASAS CONCILIADAS</strong></font></font><br></td>
    
  </tr>
</table>
<table width="100%" align="center" border="0">
  <tr> 
   <td width="11%"><strong>Conciliador:</strong></td>
    <td width="25%"> 
      <?php
include 'db.php';

$fver = $_REQUEST['f'];
$u=     $_REQUEST['u'];
//$user = mysql_query("SELECT encargado FROM concil WHERE fVer='$fver' and encargado='$u'");
 //$ruser = mysql_result($user,1);
 echo "$u"; ?>
      <div align="left"></div></td>
    <td width="41%"></td>
    <td width="23%"><div align="center"><strong>Fecha: 
        <?= date ("d/m/Y")?>
        </strong></div></td>
  </tr>
</table>
<table width="100%" align="center" border="0">
  <tr> 
    <td width="16%"></td>
    <td width="20%"></td>
    <td width="41%"></td>
    <td width="23%"></td>
  </tr>
</table>
<table width="100%" border="1">
  <tr> 
    <td width="35%" background="#666666"><div align="center"><strong><font color="#000000">Nº 
        de Tasa</font></strong></div></td>
    <td width="19%" background="#666666"><div align="center"><strong>Serie</strong></div></td>
    <td width="23%" background="#666666"><div align="center"><strong>Tipo de Tasa</strong></div></td>
    <td width="23%" background="#666666"> <div align="center"><strong>Precio Bs.</strong></div></td>
  </tr>
</table>
      <?php
include 'db.php';

$fver = $_REQUEST['f'];
$u=     $_REQUEST['u'];


$sql = "SELECT * FROM concil WHERE fVer='$fver' and encargado='$u'";
$result=mysql_query($sql) or die( "SQL Error: $sql - " . mysql_error() );
if (mysql_num_rows( $result ) > 0){  

echo "<table border = '0'> \n";
do {
echo "<tr> \n";
echo "<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>".$row["codbarras"]."<td>"."</td> \n";

echo "<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>".$row["serie"]."<td>"."</td>\n";

echo "<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>".$row["tiptas"]."<td>"."</td>\n";

echo "<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>".$row["valtas"]."<td>"."</td>\n";

echo "</tr> \n";
} while ($row = mysql_fetch_array($result));
echo "</table> \n";
} else {
echo "¡ La base NO CONTIENE REGISTROS DE PRODUCTOS !";
}

?>
<table width="100%" border="1">
  <tr> 
    <td>
	
    </td>
  </tr>
</table>



<table width="100%" border="0">
  <tr> 
    <td width="28%"><strong>Total Tasas Verificadas:</strong> </td>
    <td width="72%"> <strong> 
      <?php //CONSULTA LA CANTIDAD DE TASAS EN EL REPORTE
 $filas = mysql_query("SELECT * FROM concil WHERE fVer='$fver' and encargado='$u'");
$num_rows = mysql_num_rows($filas);

echo "$num_rows";  ?>
      </strong></td>
  </tr>
  <tr> 
    <td><strong>Total Tasas Serie A:</strong> </td>
    <td>  
      <?php //CONSULTA LA CANTIDAD DE TASAS SERIE A
 $filasA = mysql_query("SELECT * FROM concil WHERE fVer='$fver' and encargado='$u' and serie='A'");
 $serieA = mysql_num_rows($filasA);

echo "$serieA";  ?>
    </td>
  </tr>
  <tr> 
    <td><strong>Total Tasas Serie B:</strong> </td>
    <td>  
      <?php //CONSULTA LA CANTIDAD DE TASAS SERIE B
 $filasB = mysql_query("SELECT * FROM concil WHERE fVer='$fver' and encargado='$u' and serie='B'");
 $serieB = mysql_num_rows($filasB);

echo "$serieB";  ?>
    </td>
  </tr>
  <tr> 
    <td><strong>Total Tasas Exoneradas:</strong> </td>
    <td>  

<?php //CONSULTA LA CANTIDAD DE TASAS EXONERADAS
 $filasT = mysql_query("SELECT * FROM concil WHERE fVer='$fver' and encargado='$u' and serie='T'");
 $serieT = mysql_num_rows($filasT);
 $filasI = mysql_query("SELECT * FROM concil WHERE fVer='$fver' and encargado='$u' and serie='I'");
 $serieI = mysql_num_rows($filasI);
 $exoT   = $serieT + $serieI;

echo "$exoT";  ?>
    
  </td>

  </tr>
</table>
<table width="100%" border="1">
  <tr> 
    <td width="28%"><strong> Tasas Nacionales:</strong> </td>
    <td width="12%"> <strong> 
      <?php //CONSULTA LA CANTIDAD DE TASAS SERIE A
 $filasN = mysql_query("SELECT * FROM concil WHERE fVer='$fver' and encargado='$u' and tiptas='0001'");
 $nacionales = mysql_num_rows($filasN);
echo "$nacionales";  ?>
      </strong></td>
    <td width="30%"><strong>Tasas Internacionales:</strong></td>
    <td> <strong> 
      <?php //CONSULTA LA CANTIDAD DE TASAS SERIE A
 $filasI = mysql_query("SELECT * FROM concil WHERE fVer='$fver' and encargado='$u' and tiptas='0002'");
 $internacionales = mysql_num_rows($filasI);
echo "$internacionales";  ?>
      </strong></td>
  </tr>
</table>
<table width="100%" border="1">
  <tr> 
    <td width="28%"><strong>Nacionales Total Bs.</strong></td>
    <td width="12%"><strong> 
      <?php //CONSULTA LA CANTIDAD DE TASAS SERIE A
 $filasN = mysql_query("SELECT * FROM concil WHERE fVer='$fver' and encargado='$u' and tiptas='0001'");
 $nacionales = mysql_num_rows($filasN);
 $bn = $nacionales * 25.00 ;
echo number_format($bn, 2, ',', '.'); ?>
      </strong></td>
    <td width="30%"><strong>Internacionales Total Bs.</strong></td>
    <td> <strong> 
      <?php //CONSULTA LA CANTIDAD DE TASAS SERIE A
 $filasI = mysql_query("SELECT * FROM concil WHERE fVer='$fver' and encargado='$u' and tiptas='0002'");
 $internacionales = mysql_num_rows($filasI);
 $bi = $internacionales * 107.00 ;
echo number_format($bi, 2, ',', '.');  ?>
      </strong></td>
  </tr>
</table>
<table width="100%" border="0">
  <tr>
    <td width="28%">&nbsp;</td>
    <td width="12%">&nbsp;</td>
    <td width="37%">&nbsp;</td>
    <td width="23%">&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0">
  <tr> 
    <td width="28%">&nbsp;</td>
    <td width="12%">&nbsp;</td>
    <td width="37%"><div align="right"><strong>Total Bs.</strong></div></td>
    <td width="23%"><div align="center"><strong> 
        <?php $filasbsn = mysql_query("SELECT * FROM concil WHERE fVer='$fver' and encargado='$u' and tiptas='0001'");
                       $bsnacionales = mysql_num_rows($filasbsn);
					   $bsnT= $bsnacionales * 25.00;
                       $filasbsi = mysql_query("SELECT * FROM concil WHERE fVer='$fver' and encargado='$u' and tiptas='0002'");
                       $bsinternacionales = mysql_num_rows($filasbsi);
					   $bsiT= $bsinternacionales * 107.00;
					   $total= $bsnT + $bsiT;
 
echo number_format($total, 2, ',', '.');  ?>
        </strong></div></td>
  </tr>
</table>

</body>
</html>