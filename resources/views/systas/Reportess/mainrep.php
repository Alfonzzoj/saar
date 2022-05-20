<?php session_start();
	include_once('../conf_tasas/index.php'); 
	include_once('../conf_tasas/auth.php');
	include_once ('consult.php');
?>

	<!-- Colocar aqui el mensaje de login error -->
	<div id="MensajeLog"></div>
	
	<!-- Formulario -->
	<div id="Form">
	
		    <!-- lOGIN -->
		<form action="../private/Reportes/rpt02.php" method="post" name="form" >
		
			<!-- Fecha -->
		  <div>
				<label>Fecha: </label>			  	
				<input type="text" name="f" value="<?= date ("d/m/Y")?>" style="width:80px" />
		  	</div>
			
			<!-- Serie -->
		  	<div>
				<label>Serie: </label>	
		  		<select name="s" style="width:175px; ">
					<option value="">Seleccione la Serie</option>
					<option value="A">A</option>
					<option value="B">B</option>
					<option value="C">C</option>
				</select>
		  	</div>
			
			<!-- Tipo de Tasa -->
		  <div>
				<label>Tipo de Tasa: </label>			  	
				
				<select name="tTasa" style="width:175px; " onchange="document.form.m.value=this.value">
					<option value="">Seleccion tipo de Tasa</option>
					<?php 
						for ($i=0;$i<=count($rsT);$i++){
							echo '<option value="'.$cmbT[$i].'">'.$cmbDesT[$i].'</option>';
						}
					?>
				</select>

		  	</div>
		  			
		  	<!-- Botones de Accion -->			
			<div class="inputBtn">
				<input type="submit" name="bConsulta" value="Enviar" class="pointer"/>
	
				<input type="button" name="bCancelar" value="Cancelar" class="pointer"
						onclick="aJax('Formularios','private/Reportes/mainrep.php','')" />
			</div>
		
		</form>
	</div>
