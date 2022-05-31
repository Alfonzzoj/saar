
<?php session_start();
	include_once('db.php'); 
	
?>

	<!-- Colocar aqui el mensaje de login error -->
	<div id="MensajeLog"></div>
	
	<!-- Formulario -->
	<div id="Form">
	
		<!-- lOGIN -->
		<form action="reportes/ccaja.php" method="post" name="form" >
		
			<!-- Fecha -->
		  <div>
				<label>Fecha: </label>			  	
				<input type="text" name="f" value="<?= date ("d/m/Y")?>" style="width:80px" />
		  	</div>
			
			<div>
				<label>Conciliador: </label>			  	
				<select name="u" style="width:170px">
					<option value="" >elija un conciliador</option>
					<option value="bchacon" >Blanca Chacon</option>
					<option value="jrivas" >Jose Rivas</option>
					<option value="wtorres" >Wilfredo Torres</option>
                                  <option value="ccarbajal" >Carolina Carbajal</option>
                                  <option value="iloreto" >Ibrahim Loreto</option>
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
 