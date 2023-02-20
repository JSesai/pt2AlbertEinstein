const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');
const btnSubmit= document.querySelector('.form_submitReg');
 btnSubmit.disabled=true;


const expresiones = {
	
	nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
    apePat: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
    apeMat: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
	//password: /^.{4,12}$/, // 4 a 12 digitos.
   // password: /^[a-zA-Z0-9#$&%._-]{8}$/, 
   	passwordMin: /[a-z]{1,}/,
	passwordMayus: /[A-Z]{1,}/,
	passwordTam:/.{8}$/,
	passwordNum:/[0-9]{1,}/,
	passworCarEsp:/[#$/&%!¡._-]{1,}/,
	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/
	
}

const campos = {
	usuario: false,
	nombre: false,
	password1: false,
	correo: false,
	telefono: false
}




//constante que contien funcion flecha 
const validarFormulario = (e) => {
    // usamos un switch para evaluar el campo que se esta tecleando , target nos trae el nombre del imput seleccionado
	switch (e.target.name) {
        //si se tecleo en nombre 
		case "nombreAl":
            //accedemos a la etiqueta p que contiene el mensaje de error y la guardamos en variable
            var errorNombre= document.getElementById('mensajeError');
       // console.log('eres verguita');
			//evaluamos si es verdadera la condicion de expresiones regulares nombre con o que se ha tecleado
            if(expresiones.nombre.test(e.target.value)){
               // console.log('Cumple con la expresion regular');
               errorNombre.style.visibility="hidden";

            } else{
                //console.log('no cumple con exp regular');
                errorNombre.style.visibility="visible";
              

                errorNombre.style.color="red";

            }
		break;

        //si se tecleo en apellido paterno 
		case "apePat":
            var errorNombre= document.getElementById('mensajeErrorApePat');
        //evaluamos si es verdadera la condicion de expresiones regulares nombre con o que se ha tecleado
        if(expresiones.apePat.test(e.target.value)){
            // console.log('Cumple con la expresion regular');
            errorNombre.style.visibility="hidden";

         } else{
             //console.log('no cumple con exp regular');
             errorNombre.style.visibility="visible";
           

             errorNombre.style.color="red";

         }
		break;

        //si se tecleo en apellido materno 
		case "apemat":
           var errorNombre=document.getElementById('mensajeErrorApeMat');

           if(expresiones.apeMat.test(e.target.value)){
            // console.log('Cumple con la expresion regular');
            errorNombre.style.visibility="hidden";

           } else{
            //console.log('no cumple con exp regular');
            errorNombre.style.visibility="visible";
          

            errorNombre.style.color="red";

        }
		break;

        //si se tecleo en correo electronico
		case "correo":
			var errorNombre= document.getElementById("mensajeErrorMail");

            if(expresiones.correo.test(e.target.value)){
                // console.log('Cumple con la expresion regular');
            errorNombre.style.visibility="hidden";
            }else{
                //console.log('no cumple con exp regular');
                errorNombre.style.visibility="visible";
              
    
                errorNombre.style.color="red";
    
            }
            
		break;

        //si se tecleo en contraseña
		case "pass":
			
			//minusculas
			var msgVlidacon= document.getElementById("mensajeValidacion");
			var bien= document.getElementById("imgOk");
			var mal= document.getElementById("imgMal");


			//mayusculas
			var mayus= document.getElementById("mensajeValMay");
			var bienMay= document.getElementById("imgOkMay");
			var malMay= document.getElementById("imgMalMay"); 
			
			//tamaño de 8 caracteres
			var tam= document.getElementById("msgErrTamanio");
			var imgMalTam= document.getElementById("imgMalTam");
			var imgOkTam= document.getElementById("imgOkTam");

			//Numeros
			var num= document.getElementById("mensajeErrorPasNum");
			var imgMalNum= document.getElementById("imgMalNum");
			var imgOkNum= document.getElementById("imgOkNum");

			//caracter especial
			var char= document.getElementById("mensajeErrorPasChar");
			var charOk= document.getElementById("imgOkChar");
			var charMal= document.getElementById("imgMalChar");

			var imgBn= document.getElementById("imgOkPasFormato");

			var formatPas = document.getElementById("validarPas");
			if(e.target.value!=""){

				
			formatPas.style.display="block";

				//si se ha tecleado minuscula se ha cumplido con la espresion regular y entra a este bloque
				if(expresiones.passwordMin.test(e.target.value)){
					
					
					//cambiamos de color el mensaje de validacion a verde
					msgVlidacon.style.color="green";

					//console.log("OK Tiene minuscula ");
					//hacemos visible la img de check 
					bien.style.visibility="visible";
					//ocultamos la imagen de x
					mal.style.visibility="hidden";
		
					}else{
						//cambiamos de color el mensaje de validacion a verde
						msgVlidacon.style.color="red";
						//hacemos NO visible la img de check 
						bien.style.visibility="hidden";
						//mostramos la imagen de x
						mal.style.visibility="visible";
					}
					
				if(expresiones.passwordMayus.test(e.target.value)){
					console.log("OK Tiene Mayuscula ");

					//cambiamos de color el mensaje de validacion a verde
					mayus.style.color="green";
					
					
					//hacemos visible la img de check 
					bienMay.style.visibility="visible";
					//ocultamos la imagen de x
					malMay.style.visibility="hidden";
					
					} else{
							//cambiamos de color el mensaje de validacion a verde
							mayus.style.color="red";
							//hacemos NO visible la img de check 
							bienMay.style.visibility="hidden";
							//mostramos la imagen de x
							malMay.style.visibility="visible";
					}
				if(expresiones.passwordTam.test(e.target.value)){
					console.log("OK Tiene tamaño de 8 ");
					//cambiamos de color el mensaje de validacion a verde
					tam.style.color="green";
					
					
					//hacemos visible la img de check 
					imgOkTam.style.visibility="visible";
					//ocultamos la imagen de x
					imgMalTam.style.visibility="hidden";
					
					} else{
							//cambiamos de color el mensaje de validacion a verde
							tam.style.color="red";
							//hacemos NO visible la img de check 
							imgOkTam.style.visibility="hidden";
							//mostramos la imagen de x
							imgMalTam.style.visibility="visible";
					}


					
				if(expresiones.passwordNum.test(e.target.value)){
					console.log("OK tiene numeros");
					num.style.color="green";
					
					
					//hacemos visible la img de check 
					imgOkNum.style.visibility="visible";
					//ocultamos la imagen de x
					imgMalNum.style.visibility="hidden";

					}else{
						//cambiamos de color el mensaje de validacion a verde
						num.style.color="red";
						//hacemos NO visible la img de check 
						imgOkNum.style.visibility="hidden";
						//mostramos la imagen de x
						imgMalNum.style.visibility="visible";
				}
				if(expresiones.passworCarEsp.test(e.target.value)){
					console.log("tiene caracter especial");
					char.style.color="green";
					
					
					//hacemos visible la img de check 
					charOk.style.visibility="visible";
					//ocultamos la imagen de x
					charMal.style.visibility="hidden";

					

					}else{
						//cambiamos de color el mensaje de validacion a rojo
						char.style.color="red";
						//hacemos NO visible la img de check 
						charOk.style.visibility="hidden";
						//mostramos la imagen de x
						charMal.style.visibility="visible";
				}


				if(expresiones.passwordMin.test(e.target.value) && expresiones.passwordMayus.test(e.target.value) && expresiones.passwordTam.test(e.target.value) && expresiones.passwordNum.test(e.target.value) && expresiones.passworCarEsp.test(e.target.value )){
				
				formatPas.style.display="none";
				
				imgBn.style.visibility="visible";
                    
		
					}else{
						imgBn.style.visibility="hidden";
                         
					}

				

				




			}else{
				//console.log("Esta vacio");
				formatPas.style.display="none";

			}
       
        
		
		break;

        //si se tecleo en confirmar contraseña
		case "passConf":
		var msgErr= document.getElementById("mensajeErrorPas");
		var imgok= document.getElementById("confContraOk");
		var imgMal= document.getElementById("confContraMal");
		var pas1= document.getElementById("pass").value;
		var pas2= document.getElementById("passConf").value;
		
		if(e.target.value!==""){
		
			if(pas1==pas2){
				console.log("son igules");
				msgErr.style.color="green";
				imgok.style.visibility="visible";
				imgMal.style.visibility="hidden";

			}else{
				msgErr.style.visibility="visible";
				msgErr.style.color="red";
				imgok.style.visibility="hidden";
				imgMal.style.visibility="visible";
				console.log("no son iguales");
			}
		
		} else{
			console.log("esta vacio");
			imgMal.style.visibility="visible";

		}
        
		break;
	}

	btnSubmit.disabled=false;

}

//creamos los eventos para validar
inputs.forEach((input) => {
    //evento cuando se presiona y se sulta la tecla; se llama a validarFormulario
	input.addEventListener('keyup', validarFormulario);
    //evento cuando se da clic fuera del input; se llama a validarFormulario
	input.addEventListener('blur', validarFormulario);
});

