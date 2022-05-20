////////////////////////////////////////////////////////////////////////////////////////////
//PROGRAMADORES; JUAN CARLOS DOMINGUEZ
//ENTIDAD: EMERGENCIAS BOLIVAR 1-7-1
////////////////////////////////////////////////////////////////////////////////////////////
	
/*	
 * USO DE VARIABLES EN FUNCIONES
 */
		var http;
		var imgPrecarga;
	
/*	
 * Creacion del Objeto de HTMLREQUEST
 */
		function objetoAjax() {
		    var req;
		    req = false;
		    try {
		        req = new ActiveXObject("Msxml2.XMLHTTP");
		    } catch (e) {
		        try {
		            req = new ActiveXObject("Microsoft.XMLHTTP");
		        } catch (E) {
		            req = false;
		        }
		    }
		    if (!req && typeof XMLHttpRequest != "undefined") {
		        req = new XMLHttpRequest;
		    }
		    return req;
		}

/*
 * Consultar con ajax
 */
		function aJax(div_id, pag, act, chk) 
		{
			http = objetoAjax();
			imgPrecarga = "<img alt=\"cargando...\" src = \"public/js/img/p1.gif\" />"; //ruta de la imagen de precarga 
			
	//		alert (act);
				//	Manejador de REspuesta de aJax
				function aJaxManejador(){
						http.open('get', pag+'?'+ act,true);
						http.onreadystatechange = handleResponse;
						http.send(null);
				}
				
				//	Procesamiento de La Informacion
				function handleResponse() 
				{
						if (http.readyState != 4)
						{
							document.getElementById(div_id).innerHTML = imgPrecarga+" cargando m&oacute;dulo.";
						}
						else
						{
								var response = http.responseText;
								
								//	si desea enviar el efecto
								/*if (efecto == 'si'){
									Effecto.Appear(div_id);
								}*/	
								document.getElementById(div_id).innerHTML = response;
						}	
				}	
		
				//	Si decidimos enviar y como
				if (chk == "s") {
						var enviar = confirm("Los Datos seran enviados. Desea Continuar?");
						if (enviar)
						{
							aJaxManejador();
						}	
				}
				else {
						aJaxManejador();
				}
		}

		
