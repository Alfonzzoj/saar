<html>
<body>
<table width="100%" border="0">
<tr>
<td>
<table width="100%" border="1">
  <tr> 
    <td height="71"><img src="../public/css/img/top.gif" width="100%" height="130"></td>
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
      <?PHP
include 'db.php';

//AQUI SE EXTRAE EL USUARIO DE LA SESION

$fver = $_REQUEST['f'];
$u=     $_REQUEST['u'];
 
 echo "$u"; ?>
      <div align="left"></div></td>
    <td width="41%"></td>
    <td width="23%"><div align="center"><strong>Fecha: 
        <?= date ("d/m/Y");?>
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
            <?php
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
            <?php
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
            <?php
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
            <?php
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
            <?php
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
            <?php
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
            <?php
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
            <?php
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
            <?php
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
            <?php

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
            <?php
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
            <?php
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
            <?php
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
            <?php
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
            <?php
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
            <?php
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
     <td><div align="right"></div></td>
    <td><div align="center"></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="right"><strong>Total Tasas Serie A:</strong> </div></td>
    <td><div align="center">
        <?php //CONSULTA LA CANTIDAD DE TASAS SERIE A
 $filasA = mysql_query("SELECT * FROM tatasas WHERE femision='$fver' and encargado='$u' and serie='A'");
 $serieA = mysql_num_rows($filasA);

echo "$serieA";  ?>
    </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td width="50%"><div align="right"><strong>Total Tasas Serie B:</strong> </div></td>
    <td width="13%">  
      <div align="center">
        <?php //CONSULTA LA CANTIDAD DE TASAS SERIE B
 $filasB = mysql_query("SELECT * FROM tatasas WHERE femision='$fver' and encargado='$u' and serie='B'");
 $serieB = mysql_num_rows($filasB);

echo "$serieB";  ?>      
      </div></td>
    <td width="37%">&nbsp;</td>
  </tr>
  <tr>
    <td width="50%"><div align="right"><strong>Total Tasas Serie C:</strong></div></td>
    <td><div align="center">
      <?php //CONSULTA LA CANTIDAD DE TASAS SERIE C
 $filasC = mysql_query("SELECT * FROM tatasas WHERE femision='$fver' and encargado='$u' and serie='C'");
 $serieC = mysql_num_rows($filasC);

echo "$serieC";  ?>
    </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td width="50%"><div align="right"><strong>Total Tasas Exoneradas:</strong> </div></td>
    <td>  
      <div align="center">
        <?php //CONSULTA LA CANTIDAD DE TASAS EXONERADAS
 $filasE = mysql_query("SELECT * FROM tatasas WHERE femision='$fver' and encargado='$u' and (serie='I' or serie ='T')");
 $exonerado = mysql_num_rows($filasE);
echo "$exonerado";  ?>      
      </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><div align="right"></div></td>
    </tr>
  <tr>
    <td><div align="right"><strong>Total Tasas Impresas:</strong></div></td>
    <td><div align="center"><strong>
      <?php //CONSULTA LA CANTIDAD DE TASAS EN EL REPORTE
 $filas = mysql_query("SELECT * FROM tatasas WHERE femision='$fver' and encargado='$u'");
$num_rows = mysql_num_rows($filas);

echo "$num_rows";  ?>
    </strong></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>     
  </tr>
</table>
<table width="100%" border="1">
  <tr>
    <td width="30%"><strong> Tasas Nacionales:</strong> </td>
    <td width="20%"><div align="center"><strong>
      <?php //CONSULTA LA CANTIDAD DE TASAS SERIE A
 $filasN = mysql_query("SELECT * FROM tatasas WHERE femision='$fver' and encargado='$u' and tiptas='0001'");
 $nacionales = mysql_num_rows($filasN);
echo "$nacionales";  ?>
    </strong></div></td>
    <td width="30%"><strong>Sub - Total Bs.</strong></td>
    <td width="20%"><div align="center"><strong>
      <?php //CONSULTA LA CANTIDAD DE TASAS SERIE A
 $filasN = mysql_query("SELECT * FROM tatasas WHERE femision='$fver' and encargado='$u' and tiptas='0001'");
 $nacionales = mysql_num_rows($filasN);
 $bn = $nacionales * 35.00 ;
echo number_format($bn, 2, ',', '.');  ?>
    </strong></div></td>
  </tr>
</table>
<table width="100%" border="1">
  <tr>
    <td width="30%"><strong>Tasas Internacionales:</strong></td>
    <td width="20%"><div align="center"><strong>
      <?php //CONSULTA LA CANTIDAD DE TASAS SERIE A
 $filasI = mysql_query("SELECT * FROM tatasas WHERE femision='$fver' and encargado='$u' and tiptas='0002'");
 $internacionales = mysql_num_rows($filasI);
echo "$internacionales";  ?>
    </strong></div></td>
    <td width="30%"><strong>Sub -  Total Bs.</strong></td>
    <td width="20%"><div align="center"><strong>
      <?php //CONSULTA LA CANTIDAD DE TASAS SERIE A
 $filasI = mysql_query("SELECT * FROM tatasas WHERE femision='$fver' and encargado='$u' and tiptas='0002'");
 $internacionales = mysql_num_rows($filasI);
 $bi = $internacionales * 152.00 ;
echo number_format($bi, 2, ',', '.');  ?>
    </strong></div></td>
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
    <td width="50%"><div align="right"></div></td>
    <td width="30%"><strong>Total Bs.</strong></td>
    <td width="20%"><div align="center"><strong>
        <?php $filasbsn = mysql_query("SELECT * FROM tatasas WHERE femision='$fver' and encargado='$u' and tiptas='0001'");
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