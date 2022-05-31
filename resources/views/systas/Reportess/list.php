<?PHP 
	include_once ('../conf_tasas/index.php');
	
	/**
	 * Verificar si hay resultados
	 */
	 if ($total <= 0){
	 	$error = "<h3>No Se encontraron resultados.</h3>";
	 	print $error;
	 }
	 else{
?>

<div>
	<!-- HEADER DEL FORMULARIO -->
	<fieldset><legend>Tasa en Consulta</legend></fieldset>
</div>

<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
	<th>Fecha Emision</th><th>Monto</th><th>Estado</th>
  </tr>
  <?php
		for ($i = 0; $i < mysql_num_rows($result); $i++){
			print '
			<tr>
				<td width="30%">
					<a onclick = "aJax (\'dNews\',\'private/regtas/regtasa.php\',' .
										'\'qIdList='.mysql_result ($result, $i, "ID").'\')" 
					>'.mysql_result($result, $i, "femision").'</a>' .
				'</td>
				' .
				'<td width="30%">'.mysql_result($result, $i, "monto").'</td>' .
				'<td width="30%">'.mysql_result($result, $i, "status").'</td>
			</tr>';
		}
	?>
</table>
<?php } ?>

