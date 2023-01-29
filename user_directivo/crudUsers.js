window.onload= ()=>{
    console.log('File js->load: ok');
 
    


var form = document.getElementById('formulario');

form.onsubmit = function(evento){
    evento.preventDefault();
    console.log('submit detectado');
    insertUser(form);
    

}


}

function insertUser(form){
    console.log('entra metodo crearPregunta');
  
    // console.log(valorSeleccionado);
  
    //instanciamos a variable objeto formData que emula al formulario y pasamos como parametro la variable que guarda al formulario
    var fd= new FormData(form);
    
    //instanciamos el objeto XMLHttpRequest y lo guardamos en variable llamada ajax
    var ajax= new XMLHttpRequest ();
  
            
  
    //usamos el metodo open que abre la conexion, recibe tre parametros como argumentos, el primero: metodo de envio, el segundo: la url a donde viaja la peticion y el tercero es: valor boleano que define si es asincrono o sincrono, sino se pone por default se determina como true, es decir asincrona
    ajax.open('POST', 'crud.php',true);
  
  
    ajax.onload= function (){
  
        // manejamos el estado de la respuesta del servidor si es 200 el archivo fue encontrado y la respuesta es ok
        if(ajax.status==200){
            //console.log('cargado el estado' + ajax.status);
           
           console.log(ajax.responseText);
           
            //reseteamos campos del formulario
            form.reset();
           
        }
    }
  
    //hacemos la llamada y pasamos como argumento el formData
    ajax.send(fd);
   
    
  
  }
  