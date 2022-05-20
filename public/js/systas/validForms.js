/**
 * Validar Envio de Formularios
 */
	function validar_form (nombreForm) {
		var cont;
		var cont2;
		var nombreGrupo;
		var validarCheck;
	
	
		for ( cont = 0 ; cont < document.forms[nombreForm].elements.length ; ++cont )
		{
			if( document.forms[nombreForm].elements[cont].type == "radio" )
			{
				nombreGrupo = document.forms[nombreForm].elements[document.forms[nombreForm].elements[cont].name];
				
				validarCheck = false;
				
				for( cont2 = 0; cont2 < nombreGrupo.length; ++cont2 )	{
					if ( nombreGrupo[cont2].checked )	{	
						validarCheck = true;
						
						break;
					}
				}
				
				if( !validarCheck )	{
					break;
				}
			}
		}
		
		if( validarCheck ) {
			alert("Se han respondido todas las preguntas, el formulario se enviara.");
	
			// document.forms[nombreForm].submit();
		}
		else {
			alert("Debes contestar todas las preguntas.");
			return false;
		}
	}