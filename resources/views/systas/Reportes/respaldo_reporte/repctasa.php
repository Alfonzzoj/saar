
<?php session_start();
	include_once('db.php'); 
	
?>

	<!-- Colocar aqui el mensaje de login error -->
	<div id="MensajeLog"></div>
	
	<!-- Formulario -->
	<div id="Form">
	
		<!-- lOGIN -->
		<form action="reportes/ctasa.php" method="post" name="form" >
		
			<!-- Fecha -->
		  <div>
				<label>Fecha: </label>			  	
				<input type="text" name="f" value="<?= date ("d/m/Y")?>" style="width:80px" />
		  	</div>
			
		  <div>
				<label>Usuario: </label>
		        <select name="u" id="u">
                  <option value="" selected="selected">Seleccione Usuario</option>
                  <?php
$con = mysql_connect("localhost","root","root");
mysql_select_db("systat", $con);

$result = mysql_query("SELECT * FROM tasauth where idTipo= 'rpt'");

while($row = mysql_fetch_array($result)) {
?>
                  <option value="<?php echo $row['idUsuario']; ?>"><?php echo $row['idUsuario']; ?></option>
                  <?php
}

mysql_close($con);
?>
            </select>
		  </div>
	  	  
		  	<!-- Botones de Accion -->			
			<div class="inputBtn">
				<input type="submit" name="bConsulta" value="Enviar" class="pointer"/>
	
				<input type="button" name="bCancelar" value="Cancelar" class="pointer"
						onclick="aJax('Formularios','reportes/repccaja.php','')" />
			</div>
		
		</form>
	</div>
 