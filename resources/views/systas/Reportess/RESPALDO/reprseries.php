
<?php include_once('db.php'); ?>

	<!-- Colocar aqui el mensaje de login error -->
	<div id="MensajeLog"></div>
	
	<!-- Formulario -->
	<div id="Form">
	
		<!-- lOGIN -->
		<form action="reportes/rseries.php" method="post" name="form" >
		
			<!-- Fecha -->
		  <div>
				<label>Fecha: </label>			  	
				<input type="text" name="f" value="<?= date ("d/m/Y")?>" style="width:80px" />
		  	</div>
			
			<div>
				<label>Usuario: </label>			  	
				<select name="u" style="width:170px">
					<option value="jvillarroel">Jose Villarroel</option>
					<option value="vsanguino">Vilma Sanguino</option>
					<option value="marias">Marlin Arias</option>
					<option value="tsanchez">Thaidee S&aacute;nchez</option>
					<option value="falcala">Florangel Alcal&aacute;</option>
					<option value="imarchan">Indira Marchan</option>
					<option value="maro">Marjhoren Aro</option>
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
 