window.onload = ()=>{

    console.log('java script funcionando ok');
    cargarCursos();
    
}


function cargarCursos(){
    console.log('Entra metodo cargar cursos');
    //instanciamos el objeto XMLHttpRequest y lo guardamos en variable llamada ajax
    var ajax= new XMLHttpRequest ();
 
   //usamos el metodo open que abre la conexion, recibe tre parametros como argumentos, el primero: metodo de envio, el segundo: la url a donde viaja la peticion y el tercero es: valor boleano que define si es asincrono o sincrono, sino se pone por default se determina como true, es decir asincrona
   ajax.open('POST', 'backAulas.php',true);
   //emulamos la cabecera con el metodo setRequestHeader
   ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
 
   ajax.onload= function (){
 
       // manejamos el estado de la respuesta del servidor si es 200 el archivo fue encontrado y la respuesta es ok
       if(ajax.status==200){
           //console.log('cargado el estado' + ajax.status);
          
          //console.log(ajax.responseText)
          
           let respuesta= JSON.parse(ajax.responseText);
           console.log(respuesta);
           for(let datos of respuesta) {
            //colocamos los datos en el cuerpo de la tabla
            document.getElementById('respuestaPhp').innerHTML += `<div class="card">
                                                                    <div class="card-header">
                                                                        <h1 class="card_titulo">${datos.nombre_curso} </h1>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="imagenCurso"><img src="../img/${datos.imgCurso}" alt="" class="imgcard">
                                                                        </div>
                                                                        <div class="descripcionCurso">
                                                                            <p>${datos.descripcion_curso}</p>

                                                                        </div>
                                                                    </div>
                                                                    <div class="card-footer">

                                                                        
                                                                        <div class="mochila"><a href="cursoMochila.php?id=${datos.id_curso}"><img src="../img/imgsysgerde/entraAula.png" alt="Cursar"></a></div>



                                                                    </div>
                                                                </div>`;



                                                                
          }

       }
   }
 
   //hacemos la llamada y pasamos como argumento el formData
   ajax.send('cargarCursos=cargarCursos');



}

