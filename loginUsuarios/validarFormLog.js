

const formulario = document.getElementById('logeoAlumno');
const inputs = document.querySelectorAll('#logeoAlumno input');
const btnSubmit= document.querySelector('.form_submit');
btnSubmit.disabled=true;


const expresiones = {
	
	passwordMin: /[a-z]{1,}/,
	passwordMayus: /[A-Z]{1,}/,
	passwordTam:/.{8}$/,
	passwordNum:/[0-9]{1,}/,
	passworCarEsp:/[#$/&%!¡._-]{1,}/,
	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/
	
}




//funcion que contiene funcion flecha  para validar lo pulsado en el teclado
const validarFormulario = (e) => {
	
    // usamos un switch para evaluar el campo que se esta tecleando , target nos trae el nombre del imput seleccionado
	switch (e.target.name) {
      

        //si se tecleo en correo electronico
		case "alCorreo":
			var errorNombre= document.getElementById("msgCorreo");

            if(expresiones.correo.test(e.target.value)){
                // console.log('Cumple con la expresion regular');
            errorNombre.style.visibility="hidden";
            }else{
               // console.log('no cumple con exp regular');
                errorNombre.style.visibility="visible";
              
    
                errorNombre.style.color="red";
    
            }
            
		break;

        //si se tecleo en contraseña
		case "alPas":
			
			//minusculas
			var msgVlidacon= document.getElementById("pass");
			
			

				//VAIDAMOS LAS EXPRESIONES REGULARES DE LA CONTRASEÑA 
				if(expresiones.passwordMin.test(e.target.value) && expresiones.passwordMayus.test(e.target.value) && expresiones.passwordTam.test(e.target.value) && expresiones.passwordNum.test(e.target.value) && expresiones.passworCarEsp.test(e.target.value )){
					
					msgVlidacon.style.visibility="hidden";
					
					console.log("OK Cumple con todas las expresiones regulares ");
                    
		
					}else{
						
                         msgVlidacon.style.visibility="visible";
						 msgVlidacon.style.color="red";
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
	//SubmitEvent.addEventListener('clic', validaInputs());
});


