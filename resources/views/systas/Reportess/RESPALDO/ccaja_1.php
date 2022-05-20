<html>
<body> 
<head>
<title>Reporte de Tasas Conciliadas</title>
</head>
<table width="100%" border="1">
  <tr> 
    <td width="15%"><div align="center"><img src="../private/printTasa/geb.png" width="156" height="83"></div></td>
    <td width="70%"><div align="center"> <font size="2" face="Arial, Helvetica, sans-serif">GOBERNACIÓN DEL ESTADO BOLÍVAR <br>
        SERVICIO AUTONOMO DE AEROPUERTOS REGIONALES DEL ESTADO BOLÍVAR<br>
              <font size="1"><strong><font size="2">AEROPUERTO INTERNACIONAL<br>
              MANUEL CARLOS PIAR</font></strong></font></font><font size="1"><br>
              </font> </div></td>
    <td width="15%"><div align="center"><img src="../private/printTasa/saar.png" width="146" height="78"></div></td>
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
      <?
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
      <?

 include 'db.php';

$fver = $_REQUEST['f'];
$u=     $_REQUEST['u'];


$sql = "SELECT * FROM concil WHERE fVer='$fver' and encargado='$u'";
$result=mysql_query($sql) or die( "SQL Error: $sql - " . mysql_error() );
if (mysql_num_rows( $result ) > 0){  

echo "<table border = '0'> \n";
do {
echo "<tr> \n";
echo "<td>"."<td>"."<td>"."<td>"."<td>"."<td>".$row["codbarras"]."<td>"."</td> \n";
echo "<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>".$row["serie"]."<td>"."</td>\n";
echo "<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>".$row["codtas"]."<td>"."</td>\n";
echo "<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>"."<td>".$row["valor"]."<td>"."</td>\n";
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
      <? //CONSULTA LA CANTIDAD DE TASAS EN EL REPORTE
 $filas = mysql_query("SELECT * FROM concil WHERE fVer='$fver' and encargado='$u'");
$num_rows = mysql_num_rows($filas);

echo "$num_rows";  ?>
      </strong></td>
  </tr>
  <tr> 
    <td><strong>Total Tasas Serie A:</strong> </td>
    <td>  
      <? //CONSULTA LA CANTIDAD DE TASAS SERIE A
 $filasA = mysql_query("SELECT * FROM concil WHERE fVer='$fver' and encargado='$u' and serie='A'");
 $serieA = mysql_num_rows($filasA);

echo "$serieA";  ?>
      </td>
  </tr>
  <tr> 
    <td><strong>Total Tasas Serie B:</strong> </td>
    <td>  
      <? //CONSULTA LA CANTIDAD DE TASAS SERIE B
 $filasB = mysql_query("SELECT * FROM concil WHERE fVer='$fver' and encargado='$u' and serie='B'");
 $serieB = mysql_num_rows($filasB);

echo "$serieB";  ?>
      </td>
  </tr>
  <tr> 
    <td><strong>Total Tasas Exoneradas:</strong> </td>
    <td>  

<? //CONSULTA LA CANTIDAD DE TASAS EXONERADAS
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
      <? //CONSULTA LA CANTIDAD DE TASAS SERIE A
 $filasN = mysql_query("SELECT * FROM concil WHERE fVer='$fver' and encargado='$u' and codtas='0001'");
 $nacionales = mysql_num_rows($filasN);
echo "$nacionales";  ?>
      </strong></td>
    <td width="30%"><strong>Tasas Internacionales:</strong></td>
    <td> <strong> 
      <? //CONSULTA LA CANTIDAD DE TASAS SERIE A
 $filasI = mysql_query("SELECT * FROM concil WHERE fVer='$fver' and encargado='$u' and codtas='0002'");
 $internacionales = mysql_num_rows($filasI);
echo "$internacionales";  ?>
      </strong></td>
  </tr>
</table>
<table width="100%" border="1">
  <tr> 
    <td width="28%"><strong>Nacionales Total Bs.</strong></td>
    <td width="12%"><strong> 
      <? //CONSULTA LA CANTIDAD DE TASAS SERIE A
 $filasN = mysql_query("SELECT * FROM concil WHERE fVer='$fver' and encargado='$u' and codtas='0001'");
 $nacionales = mysql_num_rows($filasN);
 $bn = $nacionales * 24.00 ;
echo number_format($bn, 2, ',', '.'); ?>
      </strong></td>
    <td width="30%"><strong>Internacionales Total Bs.</strong></td>
    <td> <strong> 
      <? //CONSULTA LA CANTIDAD DE TASAS SERIE A
 $filasI = mysql_query("SELECT * FROM concil WHERE fVer='$fver' and encargado='$u' and codtas='0002'");
 $internacionales = mysql_num_rows($filasI);
 $bi = $internacionales * 110.00 ;
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
        <? $filasbsn = mysql_query("SELECT * FROM concil WHERE fVer='$fver' and encargado='$u' and codtas='0001'");
                       $bsnacionales = mysql_num_rows($filasbsn);
					   $bsnT= $bsnacionales * 24.00;
                       $filasbsi = mysql_query("SELECT * FROM concil WHERE fVer='$fver' and encargado='$u' and codtas='0002'");
                       $bsinternacionales = mysql_num_rows($filasbsi);
					   $bsiT= $bsinternacionales * 110.00;
					   $total= $bsnT + $bsiT;
 
echo number_format($total, 2, ',', '.');  ?>
        </strong></div></td>
  </tr>
</table>

</body>
</html>