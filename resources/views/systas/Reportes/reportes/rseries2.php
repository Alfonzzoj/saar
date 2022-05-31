<html>
<body>
<table width="100%" border="0">
<tr>
<td>
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
            <font size="3"><strong>REPORTE DE SERIES IMPRESAS A SECCION DE OPERACIONES 
            Y CONTROL DE VUELOS</strong></font></font><br></td>
    
  </tr>
</table>
<table width="100%" align="center" border="0">
  <tr> 
   <td width="11%"><strong>SUPERVISOR:</strong></td>
    <td width="25%"> 
      <?
include 'db.php';

//AQUI SE EXTRAE EL USUARIO DE LA SESION

$fver = $_REQUEST['f'];
$u=     $_REQUEST['u'];
 
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
          <td width="22%" background="#666666"><div align="center"><strong>Serie</strong></div></td>
          <td width="38%" background="#666666"><div align="center"><strong>Desde</strong></div></td>
          <td width="40%" background="#666666"> <div align="center"><strong>Hasta</strong></div></td>
        </tr>
      </table>
       <table width="100%" border="1">
        <tr> 
          <td width="22%"><div align="left"><strong>C </strong>(Nacional)</div></td>
          <td width="38%" align="center"> <strong> 
            <?

include 'db.php';

$fver = $_REQUEST['f'];
$u=     $_REQUEST['u'];


$sqld = mysql_query("SELECT codbarras FROM tatasas WHERE femision='$fver' and encargado='$u' and serie='C' and tiptas = '0001'");
$cont=mysql_num_rows($sqld);
if ($cont > 0) {
$result = mysql_result($sqld,0);
echo "$result";
}else{
echo "N/A";
}
?>
            </strong></td>
          <td width="40%" align="center"><strong> 
            <?

include 'db.php';

$fver = $_REQUEST['f'];
$u=     $_REQUEST['u'];


$sqlh = mysql_query("SELECT codbarras FROM tatasas WHERE femision='$fver' and encargado='$u' and serie='C' and tiptas = '0001' ORDER BY codbarras DESC LIMIT 0,1");
$cont=mysql_num_rows($sqlh);
if ($cont > 0) {
$result = mysql_result($sqlh,0);
echo "$result";
}else{
echo "N/A";
}
?>
            </strong></td>
        </tr>
      </table>
	  
	  
	  <table width="100%" border="1">
        <tr> 
          <td width="22%"><div align="left"><strong>C </strong>(Internacional)</div></td>
          <td width="38%" align="center"> <strong> 
            <?

include 'db.php';

$fver = $_REQUEST['f'];
$u=     $_REQUEST['u'];


$sqld = mysql_query("SELECT codbarras FROM tatasas WHERE femision='$fver' and encargado='$u' and serie='C' and tiptas = '0002'");
$cont=mysql_num_rows($sqld);
if ($cont > 0) {
$result = mysql_result($sqld,0);
echo "$result";
}else{
echo "N/A";
}
?>
            </strong></td>
          <td width="40%" align="center"><strong> 
            <?

include 'db.php';

$fver = $_REQUEST['f'];
$u=     $_REQUEST['u'];


$sqlh = mysql_query("SELECT codbarras FROM tatasas WHERE femision='$fver' and encargado='$u' and serie='C' and tiptas = '0002' ORDER BY codbarras DESC LIMIT 0,1");
$cont=mysql_num_rows($sqlh);
if ($cont > 0) {
$result = mysql_result($sqlh,0);
echo "$result";
}else{
echo "N/A";
}
?>
            </strong></td>
        </tr>
      </table>
	  <table width="100%" border="0">
  <tr> 
    <td> 
    </td>
  </tr>
</table>
      <table width="100%" border="0">
        <tr> 
          <td width="28%"><strong>Total Tasas Serie C:</strong> </td>
          <td width="72%"> 
            <? //CONSULTA LA CANTIDAD DE TASAS SERIE B
 $filasC = mysql_query("SELECT * FROM tatasas WHERE femision='$fver' and encargado='$u' and serie='C'");
 $serieC = mysql_num_rows($filasC);

echo "$serieC";  ?>
          </td>
        </tr>
      </table>
<table width="100%" border="1">
  <tr> 
    <td width="28%"><strong> Tasas Nacionales:</strong> </td>
    <td width="12%"> <strong> 
      <? //CONSULTA LA CANTIDAD DE TASAS SERIE A
 $filasN = mysql_query("SELECT * FROM tatasas WHERE femision='$fver' and encargado='$u' and serie ='C' and tiptas='0001'");
 $nacionales = mysql_num_rows($filasN);
echo "$nacionales";  ?>
      </strong></td>
    <td width="30%"><strong>Tasas Internacionales:</strong></td>
    <td> <strong> 
      <? //CONSULTA LA CANTIDAD DE TASAS SERIE A
 $filasI = mysql_query("SELECT * FROM tatasas WHERE femision='$fver' and encargado='$u' and serie = 'C' and tiptas='0002'");
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
 $filasN = mysql_query("SELECT * FROM tatasas WHERE femision='$fver' and encargado='$u' and serie = 'C' and tiptas='0001'");
 $nacionales = mysql_num_rows($filasN);
 $bn = $nacionales * 24.00 ;
echo number_format($bn, 2, ',', '.');  ?>
      </strong></td>
    <td width="30%"><strong>Internacionales Total Bs.</strong></td>
    <td> <strong> 
      <? //CONSULTA LA CANTIDAD DE TASAS SERIE A
 $filasI = mysql_query("SELECT * FROM tatasas WHERE femision='$fver' and encargado='$u' and serie = 'C' and tiptas='0002'");
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
        <? $filasbsn = mysql_query("SELECT * FROM tatasas WHERE femision='$fver' and encargado='$u' and serie = 'C' and tiptas='0001'");
                       $bsnacionales = mysql_num_rows($filasbsn);
					   $bsnT= $bsnacionales * 24.00;
                       $filasbsi = mysql_query("SELECT * FROM tatasas WHERE femision='$fver' and encargado='$u' and serie = 'C' and tiptas='0002'");
                       $bsinternacionales = mysql_num_rows($filasbsi);
					   $bsiT= $bsinternacionales * 110.00;
					   $total= $bsnT + $bsiT;
 
echo number_format($total, 2, ',', '.');  ?>
        </strong></div></td>
  </tr>
</table>
</td>
</tr>
</table>
</body>
</html>