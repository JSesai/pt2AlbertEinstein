  window.onload=()=>{
    console.log("Documento js cargado");
    //recuperamos el formulario por su id y guardamos en variable
    var formularioGet = document.getElementById('formEnviadoGet');
    //disparamos un evento cuando se submitea el formulario y se ejecuta una funcion anonima
    formularioGet.onsubmit = function (evento){
        //llamamos al metodo que va a manejar el envio
        enviarXget(evento);
    }

    

  }

  function enviarXget(evento){
          
        //prevenimos la accion por defecto del submit que es navegar a otro archivo
        evento.preventDefault();

        //recuperamos los datos del formulario
        let usuario = document.getElementById('usuario').value;
        let pass = document.getElementById('pass').value;
        let clave = document.querySelector(["input[name='clave']"]).value;
        //imprimimos los valores de los inputs
        console.log('usuario: '+usuario);
        console.log('Contraseña: '+pass);
        console.log('clave : '+clave);
        

        //instanciamos el objeto XMLHttpRequest y lo guardamos en variable llamada ajax
        var ajax= new XMLHttpRequest ();
     

        //usamos el metodo open que abre la conexion, recibe tre parametros como argumentos, el primero: metodo de envio, el segundo: la url a donde viaja la peticion y el tercero es: valor boleano que define si es asincrono o sincrono, sino se pone por default se determina como true, es decir asincrona
        ajax.open('GET', 'probando.php?usuario='+usuario+'&pass='+pass+'&clave='+clave,true);
      
        //El metodo onload es cuando la solicitud de los estados de cambio han pasado correctamente y llega la respuesta de la peticion 
        ajax.onload= function (){

            // manejamos el estado de la respuesta del servidor si es 200 el archivo fue encontrado y la respuesta es ok
            if(ajax.status==200){
                //console.log('cargado el estado' + ajax.status);
                
                console.log(ajax.response);
                
                
            }
        }
        
        //enviamos la petiicon 
        ajax.send( );


    


  }
        
  function plantillaxhr(){
    //recuperamos el formulario
    var form= document.getElementById('formulario');
    //manejamos el metodo submit del formulario
    form.onsubmit= function(e) {

        //instanciamos a variable objeto formData que emula al formulario y pasamos como parametro la variable que guarda al formulario
        var fd= new FormData(form);
    
                    
        //prevenimos la accion por defecto del submit que es navegar a otro archivo
        e.preventDefault();

        //instanciamos el objeto XMLHttpRequest y lo guardamos en variable llamada ajax
        var ajax= new XMLHttpRequest ();
     

        //usamos el metodo open que abre la conexion, recibe tre parametros como argumentos, el primero: metodo de envio, el segundo: la url a donde viaja la peticion y el tercero es: valor boleano que define si es asincrono o sincrono, sino se pone por default se determina como true, es decir asincrona
        ajax.open('POST', 'probando.php',true);
        

       
        ajax.onload= function (){

            // manejamos el estado de la respuesta del servidor si es 200 el archivo fue encontrado y la respuesta es ok
            if(ajax.status==200){
                //console.log('cargado el estado' + ajax.status);
                
                console.log(ajax.response);
                
                //reseteamos campos del formulario
                form.reset();
            }
        }
        
        //hacemos la llamada y pasamos como argumento el formData
        ajax.send( fd );


    }
  }
       
        
   