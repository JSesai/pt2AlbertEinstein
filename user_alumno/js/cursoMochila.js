window.onload = ()=>{

    console.log('java script funcionando ok');
    
    cargarNombreTema();
    cargarTemas();
}



function cargarNombreTema(){
    
        console.log('Entra metodo cargar cursos');
        //instanciamos el objeto XMLHttpRequest y lo guardamos en variable llamada ajax
        var ajax= new XMLHttpRequest ();
     
       //usamos el metodo open que abre la conexion, recibe tre parametros como argumentos, el primero: metodo de envio, el segundo: la url a donde viaja la peticion y el tercero es: valor boleano que define si es asincrono o sincrono, sino se pone por default se determina como true, es decir asincrona
       ajax.open('POST', 'backAulas.php',true);
       //emulamos la cabecera con el metodo setRequestHeader
       ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
       let id= parseInt(document.getElementById('idCurso').value); 
       console.log(id);
       console.log( ajax.status);
       ajax.onload= function (){
     
           // manejamos el estado de la respuesta del servidor si es 200 el archivo fue encontrado y la respuesta es ok
        if(ajax.status==200){
            //console.log('cargado el estado' + ajax.status);
            
            //console.log(ajax.responseText)
            
            let respuesta= JSON.parse(ajax.responseText);
            console.log(respuesta);
             for(let datos of respuesta) {
            // //colocamos los datos en el cuerpo de la tabla
            document.getElementById('nomCurso').innerText = ` ${datos.nombre_curso}`;

                                                            
            }
    
           
       }
     
        }
       //hacemos la llamada y pasamos como argumento el formData
       ajax.send('cargarNombreTema='+id);
    
    
    
}


function cargarTemas(){
    console.log('Entra metodo cargar temas');
    //instanciamos el objeto XMLHttpRequest y lo guardamos en variable llamada ajax
    var ajax= new XMLHttpRequest ();
 
   //usamos el metodo open que abre la conexion, recibe tre parametros como argumentos, el primero: metodo de envio, el segundo: la url a donde viaja la peticion y el tercero es: valor boleano que define si es asincrono o sincrono, sino se pone por default se determina como true, es decir asincrona
   ajax.open('POST', 'backAulas.php',true);
   //emulamos la cabecera con el metodo setRequestHeader
   ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
   let id= document.getElementById('idCurso').value;
   console.log(id);
   ajax.onload= function (){
 
        // manejamos el estado de la respuesta del servidor si es 200 el archivo fue encontrado y la respuesta es ok
        if(ajax.status==200){
            //console.log('cargado el estado' + ajax.status);
            
            //console.log(ajax.responseText);
            
                let respuesta= JSON.parse(ajax.responseText);
                console.log(respuesta);
                for(let datos of respuesta) {
                 //colocamos los datos en el cuerpo de la tabla
                    document.getElementById('listaTemas').innerHTML += ` <li><p class="tema" item="${datos.vCont_tema}">${datos.nombre_tema}</p></li>

                                                                    `; 
                                                
            }

          
            //recuperamos todos los p que tienen la clase tema y guardamos en variable 
            let seleccionTema = document.querySelectorAll('.tema');

              //recorremos todos los elementos que tengan la clase tema
              for(let i=0; i<seleccionTema.length; i++){
               
                
                //obtenemos el atributo del primer item por eso es 0  /lo vamos a cambiar por el avance del alumno cuando 
                let video= seleccionTema[0].getAttribute('item');
                
                //recuperamos el div donde se agregara un fragmento de codigo
                document.getElementById('contenedor-video').innerHTML = `
                                                                            <video controls autoplay class="reproductor">
                                                                            <source src="../video/${video}" type="video/mp4">
                                                                                </video>

                                                                        `; 
                                                                        break;

                
                
            }



            
            //recorremos todos los elementos que tengan la clase tema
            for(let i=0; i<seleccionTema.length; i++){
                //agregamos un evento para cada tag con clase tema
                seleccionTema[i].addEventListener('click', function(){
                
                // cargamos el video en el div correspondiente
                    console.log('el id del video es: '+seleccionTema[i].getAttribute('item'));
                    let video= seleccionTema[i].getAttribute('item');
                    
                    //recuperamos el div donde se agregara un fragmento de codigo
                    document.getElementById('contenedor-video').innerHTML = `
                                                                                <video controls autoplay class="reproductor">
                                                                                <source src="../video/${video}" type="video/mp4">
                                                                                    </video>

                                                                            `; 

                
                });
            }


        }
   }
 
   //hacemos la llamada y pasamos como argumento el formData
   ajax.send('cargarTemas='+ id);

}


