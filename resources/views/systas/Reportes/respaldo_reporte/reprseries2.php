
<?php session_start();
	include_once('db.php'); 
	
?>

	<!-- Colocar aqui el mensaje de login error -->
	<div id="MensajeLog"></div>
	
	<!-- Formulario -->
	<div id="Form">
	
		<!-- lOGIN -->
		<form action="reportes/rseries2.php" method="post" name="form" >
		
			<!-- Fecha -->
		  <div>
				<label>Fecha: </label>			  	
				<input type="text" name="f" value="<?= date ("d/m/Y")?>" style="width:80px" />
		  	</div>
			
			<div>
				<label>Usuario: </label>			  	
				<select name="u" style="width:170px">
					<option value="" >elija un usuario</option>
					<option value="maro" >Marjhoren Aro</option>
					<option value="jsandoval" >Janet Sandoval</option>
 <option value="imarchan" >Indira Marchan</option>
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
 