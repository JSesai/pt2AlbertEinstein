console.log('js->ok');

const formulario = document.getElementById('formRols');
const inputs = document.querySelectorAll('#formRols input');
const btnSubmit= document.getElementById('submitRols');
btnSubmit.disabled=true;

var mail="";
var pasUsr="";

const expresiones = {
	
	passwordMin: /[a-z]{1,}/,
	passwordMayus: /[A-Z]{1,}/,
	passwordTam:/.{8}$/,
	passwordNum:/[0-9]{1,}/,
	passworCarEsp:/[#$/&%!¡._-]{1,}/,
	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/
	
}




//capturamos el submiteo y ejecutamos funcion anonima que llama al metodo validar formulario
formulario.onsubmit = function(e){
    inputs.forEach((input) => {
       input.onchange= function(){
        if(mail =="no"){
            console.log('formato mail malo');
            //validarFormulario();
        }
        if(!expresiones.passwordMin.test(e.target.value) && expresiones.passwordMayus.test(e.target.value) && expresiones.passwordTam.test(e.target.value) && expresiones.passwordNum.test(e.target.value) && expresiones.passworCarEsp.test(e.target.value )){
            validarFormulario();
        }
       }
    });


      
}



//funcion que contiene funcion flecha  para validar lo pulsado en el teclado y cuando este fuera del input
const validarFormulario = (e) => {
	
    // usamos un switch para evaluar el campo que se esta tecleando , con el evento accedemos al target y al name que sera la opcion a evaluar en el switch case
	switch (e.target.name) {
      

        //si se tecleo en el input correo electronico
		case "correo":
			var errorNombre= document.getElementById("msgCorreo");

            //testea el valor del input del correo con el objeto expresiones con su propiedad correo
            if(expresiones.correo.test(e.target.value)){
                //si cumple y se permanece oculto el mensaje de error
                 console.log('expresion regular->correo:ok');
            errorNombre.style.visibility="hidden";

            mail='si';

            }else{
                //no se cumple con la expresion regular y se muestra el mensaje de error se le agrega el color rojo
                console.log('expresion regular->correo:NO');
                errorNombre.style.visibility="visible";
                errorNombre.style.color="red";
                mail='ok';
                //se ejecuta setTimeout para desaparecer el mensaje
                setTimeout(function(){
                    errorNombre.style.visibility="hidden";
                },8000);
    
            }
            
		break;

        //si se tecleo en contraseña
		case "userPas":
			
			//minusculas
			var msgVlidacon= document.getElementById("pass");
			
			

				//VAIDAMOS LAS EXPRESIONES REGULARES DE LA CONTRASEÑA 
				if(expresiones.passwordMin.test(e.target.value) && expresiones.passwordMayus.test(e.target.value) && expresiones.passwordTam.test(e.target.value) && expresiones.passwordNum.test(e.target.value) && expresiones.passworCarEsp.test(e.target.value )){
					
					msgVlidacon.style.visibility="hidden";
					
					console.log("expresion regular->pass:ok ");
                    pasUsr='ok';
                    
					}else{
						console.log("expresion regular->pass:NO ");
                         msgVlidacon.style.visibility="visible";
						 msgVlidacon.style.color="red";
                         //se ejecuta setTimeout para desaparecer el mensaje
                        setTimeout(function(){
                            msgVlidacon.style.visibility="hidden";
                        },8000);
                        }
			     
		break;

		
	}

if(mail=='ok' && pasUsr=='ok'){
console.log('se cumplen ambas');
}
btnSubmit.disabled=false;
    

}





//accedemos a todos los imputs y los recorremos con un foreach pasamos el evento impliciro
inputs.forEach((input) => {
    //evento cuando se presiona y se sulta la tecla; se llama a validarFormulario
	input.addEventListener('keyup', validarFormulario);
    //evento cuando se da clic fuera del input; se llama a validarFormulario
	input.addEventListener('blur', validarFormulario);
	//SubmitEvent.addEventListener('clic', validaInputs());
});


