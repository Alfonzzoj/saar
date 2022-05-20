<html>
<body>
<table width="100%" border="0">
<tr>
<td>
<table width="100%" border="1">
  <tr> 
    <td width="13%" height="71"><div align="center"><img src="../public/css/img/saar.png" width="86%" height="61%"></div></td>
    <td width="74%"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">GOBERNACIÓN DEL ESTADO BOLÍVAR <br>
      SERVICIO AUTONOMO DE AEROPUERTOS REGIONALES DEL ESTADO BOLÍVAR<br>
  <font size="1"><strong><font size="2">AEROPUERTO INTERNACIONAL<br>
    MANUEL CARLOS PIAR</font></strong></font></font></div></td>
    <td width="13%"><div align="center"><img src="../public/css/img/iso.png" width="86%" height="51%"></div></td>
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
      <font size="3"><strong>REPORTE DE SERIES IMPRESAS</strong></font></font></td>
    
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
          <td width="22%"><div align="left"><strong>A </strong>(Nacional)</div></td>
          <td width="38%" align="center"> <strong> 
            <?
//AQUI SE EXTRAE LA PRIMERA TASA NACIONAL IMPRESA DE LA SERIE A 
include 'db.php';

$fver = $_REQUEST['f'];
$u=     $_REQUEST['u'];


$sqld = mysql_query("SELECT codbarras FROM tatasas WHERE serie='A' and tiptas='0001' and encargado='$u' and femision= '$fver' ORDER BY codbarras ASC LIMIT 0,1");
$cont=mysql_num_rows($sqld);
if ($cont > 0) {
$result = mysql_result($sqld,0);
echo "$result";
}else{
echo "N/A";
}
?>
            </strong></td>
          <td width="40%" align="center"> <strong> 
            <?
//AQUI SE EXTRAE LA ULTIMA TASA NACIONAL IMPRESA DE LA SERIE A
include 'db.php';

$fver = $_REQUEST['f'];
$u=     $_REQUEST['u'];


$sqlh = mysql_query("SELECT codbarras FROM tatasas WHERE serie='A' and tiptas='0001' and encargado='$u' and femision= '$fver' ORDER BY codbarras DESC LIMIT 0,1");
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
          <td width="22%"><div align="left"><strong>A </strong>(Internacional)</div></td>
          <td width="38%" align="center"> <strong> 
            <?

include 'db.php';

//AQUI SE EXTRAE LA PRIMERA TASA INTERNACIONAL IMPRESA DE LA SERIE A

$fver = $_REQUEST['f'];
$u=     $_REQUEST['u'];


$sqld = mysql_query("SELECT codbarras FROM tatasas WHERE serie='A' and tiptas='0002' and encargado='$u' and femision= '$fver' ORDER BY codbarras ASC LIMIT 0,1");
$cont=mysql_num_rows($sqld);
if ($cont > 0) {
$result = mysql_result($sqld,0);
echo "$result";
}else{
echo "N/A";
}
?>
            </strong></td>
          <td width="40%" align="center"> <strong> 
            <?

include 'db.php';

//AQUI SE EXTRAE LA ULTIMA TASA INTERNACIONAL IMPRESA DE LA SERIE A

$fver = $_REQUEST['f'];
$u=     $_REQUEST['u'];


$sqlh = mysql_query("SELECT codbarras FROM tatasas WHERE serie='A' and tiptas='0002' and encargado='$u' and femision= '$fver' ORDER BY codbarras DESC LIMIT 0,1");
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
          <td width="22%"><div align="left"><strong>B </strong>(Nacional)</div></td>
          <td width="38%" align="center"> <strong> 
            <?

include 'db.php';

//AQUI SE EXTRAE LA PRIMERA TASA NACIONAL IMPRESA DE LA SERIE B

$fver = $_REQUEST['f'];
$u=     $_REQUEST['u'];


$sqld = mysql_query("SELECT codbarras FROM tatasas WHERE serie='B' and tiptas='0001' and encargado='$u' and femision= '$fver' ORDER BY codbarras ASC LIMIT 0,1");
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

//AQUI SE EXTRAE LA ULTIMA TASA NACIONAL IMPRESA DE LA SERIE B

$fver = $_REQUEST['f'];
$u=     $_REQUEST['u'];


$sqlh = mysql_query("SELECT codbarras FROM tatasas WHERE serie='B' and tiptas='0001' and encargado='$u' and femision= '$fver' ORDER BY codbarras DESC LIMIT 0,1");
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
          <td width="22%"><div align="left"><strong>B </strong>(Internacional)</div></td>
          <td width="38%" align="center"> <strong> 
            <?

include 'db.php';

//AQUI SE EXTRAE LA PRIMERA TASA INTERNACIONAL IMPRESA DE LA SERIE B

$fver = $_REQUEST['f'];
$u=     $_REQUEST['u'];


$sqld = mysql_query("SELECT codbarras FROM tatasas WHERE serie='B' and tiptas='0002' and encargado='$u' and femision= '$fver' ORDER BY codbarras ASC LIMIT 0,1");
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

//AQUI SE EXTRAE LA ULTIMA TASA INTERNACIONAL IMPRESA DE LA SERIE B

$fver = $_REQUEST['f'];
$u=     $_REQUEST['u'];


$sqlh = mysql_query("SELECT codbarras FROM tatasas WHERE serie='B' and tiptas='0002' and encargado='$u' and femision= '$fver' ORDER BY codbarras DESC LIMIT 0,1");
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
          <td width="22%"><div align="left"><strong>C </strong>(Nacional)</div></td>
          <td width="38%" align="center"> <strong> 
            <?

include 'db.php';

$fver = $_REQUEST['f'];
$u=     $_REQUEST['u'];


$sqld = mysql_query("SELECT codbarras FROM tatasas WHERE serie='C' and tiptas='0001' and encargado='$u' and femision= '$fver' ORDER BY codbarras ASC LIMIT 0,1");
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


$sqlh = mysql_query("SELECT codbarras FROM tatasas WHERE serie='C' and tiptas='0001' and encargado='$u' and femision= '$fver' ORDER BY codbarras DESC LIMIT 0,1");
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


$sqld = mysql_query("SELECT codbarras FROM tatasas WHERE serie='C' and tiptas='0002' and encargado='$u' and femision= '$fver' ORDER BY codbarras ASC LIMIT 0,1");
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


$sqlh = mysql_query("SELECT codbarras FROM tatasas WHERE serie='C' and tiptas='0002' and encargado='$u' and femision= '$fver' ORDER BY codbarras DESC LIMIT 0,1");
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
          <td width="22%"><div align="left"><strong>E</strong>xonerado(Inf)</div></td>
          <td width="38%" align="center"><strong> 
            <?

include 'db.php';

$fver = $_REQUEST['f'];
$u=     $_REQUEST['u'];


$sqld = mysql_query("SELECT codbarras FROM tatasas WHERE serie='I' and encargado='$u' and femision='$fver' ORDER BY codbarras ASC LIMIT 0,1 ");
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


$sqlh = mysql_query("SELECT codbarras FROM tatasas WHERE serie='I' and encargado='$u' and femision='$fver' ORDER BY codbarras DESC LIMIT 0,1 ");
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
          <td width="22%"><div align="left"><strong>E</strong>xonerado(3era)</div></td>
          <td width="38%" align="center"><strong> 
            <?

include 'db.php';

$fver = $_REQUEST['f'];
$u=     $_REQUEST['u'];


$sqld = mysql_query("SELECT codbarras FROM tatasas WHERE serie='T' and encargado='$u' and femision='$fver' ORDER BY codbarras ASC LIMIT 0,1 ");
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


$sqlh = mysql_query("SELECT codbarras FROM tatasas WHERE serie='T' and encargado='$u' and femision='$fver' ORDER BY codbarras DESC LIMIT 0,1 ");
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
          <td width="28%" background="#666666"><strong>Total Tasas Impresas:</strong> </td>
    <td width="72%" background="#666666"> <strong> 
      <? //CONSULTA LA CANTIDAD DE TASAS EN EL REPORTE
 $filas = mysql_query("SELECT * FROM tatasas WHERE femision='$fver' and encargado='$u'");
$num_rows = mysql_num_rows($filas);

echo "$num_rows";  ?>
      </strong></td>
  </tr>
  <tr> 
    <td><strong>Total Tasas Serie A:</strong> </td>
    <td>  
      <? //CONSULTA LA CANTIDAD DE TASAS SERIE A
 $filasA = mysql_query("SELECT * FROM tatasas WHERE serie='A' and encargado='$u' and femision='$fver'");
 $serieA = mysql_num_rows($filasA);

echo "$serieA";  ?>
      </td>
  </tr>
  <tr> 
    <td><strong>Total Tasas Serie B:</strong> </td>
    <td>  
      <? //CONSULTA LA CANTIDAD DE TASAS SERIE B
 $filasB = mysql_query("SELECT * FROM tatasas WHERE serie='B' and encargado='$u' and femision='$fver'");
 $serieB = mysql_num_rows($filasB);

echo "$serieB";  ?>
      </td>
  </tr>
  <tr> 
    <td><strong>Total Tasas Serie C:</strong> </td>
    <td>  
      <? //CONSULTA LA CANTIDAD DE TASAS SERIE B
 $filasC = mysql_query("SELECT * FROM tatasas WHERE serie='C' and encargado='$u' and femision='$fver'");
 $serieC = mysql_num_rows($filasC);

echo "$serieC";  ?>
      </td>
  </tr>
  <tr> 
    <td><strong>Total Tasas Exoneradas:</strong> </td>
    <td>  
      <? //CONSULTA LA CANTIDAD DE TASAS EXONERADAS
 $filasI = mysql_query("SELECT * FROM tatasas WHERE serie='I' and encargado='$u' and femision='$fver'");
 $exoneradoI = mysql_num_rows($filasI);

 $filasT = mysql_query("SELECT * FROM tatasas WHERE serie='T' and encargado='$u' and femision='$fver'");
 $exoneradoT = mysql_num_rows($filasT);
 $exoTotal = $exoneradoI + $exoneradoT;
echo "$exoTotal";  ?>
      </td>
  </tr>
</table>
<table width="100%" border="1">
  <tr> 
    <td width="28%"><strong> Tasas Nacionales:</strong> </td>
    <td width="12%"> <strong> 
      <? //CONSULTA LA CANTIDAD DE TASAS SERIE A
 $filasN = mysql_query("SELECT * FROM tatasas WHERE femision='$fver' and encargado='$u' and tiptas='0001'");
 $nacionales = mysql_num_rows($filasN);
echo "$nacionales";  ?>
      </strong></td>
    <td width="30%"><strong>Tasas Internacionales:</strong></td>
    <td> <strong> 
      <? //CONSULTA LA CANTIDAD DE TASAS SERIE A
 $filasI = mysql_query("SELECT * FROM tatasas WHERE femision='$fver' and encargado='$u' and tiptas='0002'");
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
 $filasN = mysql_query("SELECT * FROM tatasas WHERE femision='$fver' and encargado='$u' and tiptas='0001'");
 $nacionales = mysql_num_rows($filasN);
 $bn = $nacionales * 35.00 ;
echo number_format($bn, 2, ',', '.');  ?>
      </strong></td>
    <td width="30%"><strong>Internacionales Total Bs.</strong></td>
    <td> <strong> 
      <? //CONSULTA LA CANTIDAD DE TASAS SERIE A
 $filasI = mysql_query("SELECT * FROM tatasas WHERE femision='$fver' and encargado='$u' and tiptas='0002'");
 $internacionales = mysql_num_rows($filasI);
 $bi = $internacionales * 152.00 ;
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
        <? $filasbsn = mysql_query("SELECT * FROM tatasas WHERE femision='$fver' and encargado='$u' and tiptas='0001'");
                       $bsnacionales = mysql_num_rows($filasbsn);
					   $bsnT= $bsnacionales * 35.00;
                       $filasbsi = mysql_query("SELECT * FROM tatasas WHERE femision='$fver' and encargado='$u' and tiptas='0002'");
                       $bsinternacionales = mysql_num_rows($filasbsi);
					   $bsiT= $bsinternacionales * 152.00;
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