<?php require_once('../Connections/conectar.php'); ?><?php
$maxRows_DetailRS1 = 10;
$pageNum_DetailRS1 = 0;
if (isset($_GET['pageNum_DetailRS1'])) {
  $pageNum_DetailRS1 = $_GET['pageNum_DetailRS1'];
}
$startRow_DetailRS1 = $pageNum_DetailRS1 * $maxRows_DetailRS1;

mysql_select_db($database_conectar, $conectar);
$recordID = $_GET['recordID'];
$query_DetailRS1 = "SELECT * FROM concil  WHERE ID = $recordID";
$query_limit_DetailRS1 = sprintf("%s LIMIT %d, %d", $query_DetailRS1, $startRow_DetailRS1, $maxRows_DetailRS1);
$DetailRS1 = mysql_query($query_limit_DetailRS1, $conectar) or die(mysql_error());
$row_DetailRS1 = mysql_fetch_assoc($DetailRS1);

if (isset($_GET['totalRows_DetailRS1'])) {
  $totalRows_DetailRS1 = $_GET['totalRows_DetailRS1'];
} else {
  $all_DetailRS1 = mysql_query($query_DetailRS1);
  $totalRows_DetailRS1 = mysql_num_rows($all_DetailRS1);
}
$totalPages_DetailRS1 = ceil($totalRows_DetailRS1/$maxRows_DetailRS1)-1;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
		
<table border="1" align="center">
  
  <tr>
    <td>ID</td>
    <td><?php echo $row_DetailRS1['ID']; ?> </td>
  </tr>
  <tr>
    <td>encargado</td>
    <td><?php echo $row_DetailRS1['encargado']; ?> </td>
  </tr>
  <tr>
    <td>codbarras</td>
    <td><?php echo $row_DetailRS1['codbarras']; ?> </td>
  </tr>
  <tr>
    <td>fVer</td>
    <td><?php echo $row_DetailRS1['fVer']; ?> </td>
  </tr>
  <tr>
    <td>hVer</td>
    <td><?php echo $row_DetailRS1['hVer']; ?> </td>
  </tr>
  <tr>
    <td>serie</td>
    <td><?php echo $row_DetailRS1['serie']; ?> </td>
  </tr>
  <tr>
    <td>codtas</td>
    <td><?php echo $row_DetailRS1['codtas']; ?> </td>
  </tr>
  
  
</table>

</body>
</html><?php
mysql_free_result($DetailRS1);
?>
