window.onload = function() {
  // Código a ejecutar una vez que la página se haya cargado completamente
   console.log("La página se ha cargado completamente avanzamos a seleccionar el tema");
  var idSelec;
  selecTemaTest();

  //reuperamos formulario, boton submit
  var formulario = document.getElementById('formulario');
  var btnSub = document.querySelector('.btnAgregaPreg'); 
  

  //creamos evento del submit 
  formulario.onsubmit= e=>{
    //prevenimos la accion por defecto del submit que es navegar a otro archivo
    
    e.preventDefault( );
    console.log('presionaste el submt');
    
    //desabilitamos boton submit
    //btnSub.disabled= true;
    
    crearPregunta(formulario);
    
   setTimeout(function(){ obtenerPreguntaz(valorSeleccionado);},500);
   

  }
   //llamamos al metodo que carga los nombres de los test creados
   testExistentes();
   

}
// variable que almacena el id del tema seleccionado
 var valorSeleccionado;

//recuperamos boton de nuevo test
var btnNuevoTest = document.getElementById("nuevoTest");


//agregamos evento al boton nuevo test
// agregamos un event listener al botón que llama a una función cuando se hace clic en el botón
btnNuevoTest.addEventListener("click", function(e){
 
 
  //llamamos a lafuncion
crearTest();


});

//maneja confirmacion de creacion de test
function crearTest(){

  var resp=  prompt('vas a abandonar el test actual, ¿deseas continuar? Ingresa si');
  
  
  if(resp=== null || resp===' '){
    console.log('vacio');
    
  }else{
    console.log('respuesta: ' + resp);
  
    if(resp.toLocaleLowerCase() =='si'){
      console.log('continuamos ejecucion');
      selecTemaTest();
  
    }else if(resp==''){
  
    }
    else{
      console.log('respuesta invalida');
      
    }
  }
 
  


}




//crea un select tomando temas de BD, genera modal 
function selecTemaTest(){
 // btnNuevoTest.disabled=true;
 


    // Crea una nueva instancia de XMLHttpRequest
var xhr = new XMLHttpRequest();
//console.log('objetoxhr creado'+xhr);
xhr.addEventListener("error", function() {
    console.error("Error al hacer la solicitud");
  });
  
// Abre una conexión con el archivo PHP
xhr.open("GET", "probando.php", true);

// Envía la solicitud
xhr.send();

// Cuando se recibe la respuesta, procesa los datos
xhr.onload = function() {
  if (xhr.status == 200) {
    // Obtiene los datos de la respuesta
    //muestra los datos de respuesta 
   // console.log('RESPUESTA=' + xhr.responseText);

    var datos = JSON.parse(xhr.responseText);
    //console.log('DATOS EN FORMATO JSON: ' + datos);
    // Crea un elemento modal
    var modal = document.createElement("div");
    modal.className = "modal";
    //console.log("Modal creado:", modal);

    // Crea el contenido de la modal tag <p>
    var p = document.createElement("p");
    p.textContent = "Selecciona el tema al que vas agregar el test.";
    modal.appendChild(p);

   
    
    // Crea el contenido de la modal <select>
    var select = document.createElement("select");
    select.className = "select";
    

    

    //agregamos un salto de linea
    var espacio= document.createElement("br");
    modal.appendChild(espacio);
    
   
    // Recorre la matriz de datos y crea opciones para el select
    for (var i = 0; i < datos.length; i++) {
      var opcion = document.createElement("option");
      
    //recorremos las propiedades del objeto que llamas 
    
       // opcion.value = datos[i].nombre_tema;  
        opcion.value = datos[i].id_tema;
        opcion.text = datos[i].nombre_tema;

        select.appendChild(opcion);
        //console.log(opcion);

       // let nombreTema= datos[i].nombre_tema;
       // nombreTema.text=datos[i].nombreTema;
       
        //console.log(nombreTema);

       
    }

    // Agrega el select a la modal
    modal.appendChild(select);

    // Agrega la modal al documento
    document.body.appendChild(modal);

        // segundo bloque
    var select = document.querySelector('.select');

    // Añade un event listener al elemento select que envía el valor seleccionado a tu archivo PHP
    select.addEventListener('change', function() {
    valorSeleccionado = this.value;
        
    var titulo= document.querySelector('.tituloTest');
    //titulo.appendChild(nombreTema);

  // Find the object with the matching name property
  for (let i = 0; i < datos.length; i++) {
      if (datos[i].id_tema === valorSeleccionado) {
        
        // Found the matching object, access the name property
        var selectedName = datos[i].nombre_tema;
         idSelec = datos[i].id_tema;
        // Set the text content of the h2 element to the selected name
        //titulo.textContent = selectedName;
       console.log('nombre seleccionado: ' +selectedName + ' su id es: ' +idSelec);
        titulo.innerHTML= 'Preguntas del test ' + selectedName;
        obtenerPreguntaz(idSelec);
        
       
      }else{
        //console.log("no esta dentro de la condicion");
      }
    }
    

   
    //tituloTest.appendChild(nombreTest);
     
  // Envía el valor seleccionado a tu archivo PHP usando fetch()
  fetch('probando2.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: 'valorSeleccionado=' + valorSeleccionado
   // body: 'idTema=' + idTema + '&nombreTema=' + nombreTema + '&id=' + id

  })
  .then(function(response) {
    
    return response.text();
  })
  .then(function(response) {
   
      console.log(response);
      modal.style.display = "none";
      // Elimina el modal del documento
      document.body.removeChild(modal);
    
  });
});
    
  }
  // Agrega un botón de cierre a la modal
    var cerrarBtn = document.createElement("button");
    cerrarBtn.textContent = "Cerrar";
    cerrarBtn.className="btnCerrar",
    cerrarBtn.addEventListener("click", function() {
    modal.style.display = "none";
    // Elimina el modal del documento
    document.body.removeChild(modal);
    });
    modal.appendChild(cerrarBtn);
};



}

function crearPregunta(form){
  console.log('entra metodo crearPregunta');

  // console.log(valorSeleccionado);

  //instanciamos a variable objeto formData que emula al formulario y pasamos como parametro la variable que guarda al formulario
  var fd= new FormData(form);
  //agregamos el valor seleccionado que es el id al form
  fd.append('idTema', valorSeleccionado);
  //instanciamos el objeto XMLHttpRequest y lo guardamos en variable llamada ajax
  var ajax= new XMLHttpRequest ();

          

  //usamos el metodo open que abre la conexion, recibe tre parametros como argumentos, el primero: metodo de envio, el segundo: la url a donde viaja la peticion y el tercero es: valor boleano que define si es asincrono o sincrono, sino se pone por default se determina como true, es decir asincrona
  ajax.open('POST', 'probando2.php',true);


  ajax.onload= function (){

      // manejamos el estado de la respuesta del servidor si es 200 el archivo fue encontrado y la respuesta es ok
      if(ajax.status==200){
          //console.log('cargado el estado' + ajax.status);
         
         console.log(ajax.responseText)
         
          //reseteamos campos del formulario
          form.reset();
          document.getElementById('idPregunta').value = ''; 
      }
  }

  //hacemos la llamada y pasamos como argumento el formData
  ajax.send(fd);
 
  

}

function obtenerPreguntas(){
  console.log('corriendo metodo obtener preguntas')
  //realizamos peticion xhr
  //instanciamos a variable objeto formData que emula al formulario y pasamos como parametro la variable que guarda al formulario
 
  //instanciamos el objeto XMLHttpRequest y lo guardamos en variable llamada ajax
  var xhr= new XMLHttpRequest ();



  //usamos el metodo open que abre la conexion, recibe tre parametros como argumentos, el primero: metodo de envio, el segundo: la url a donde viaja la peticion y el tercero es: valor boleano que define si es asincrono o sincrono, sino se pone por default se determina como true, es decir asincrona
  xhr.open('POST', 'probando2.php',true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

 
  xhr.onload= function (){

    // manejamos el estado de la respuesta del servidor si es 200 el archivo fue encontrado y la respuesta es ok
    if(xhr.status==200){
      console.log('cargado el estado ' + xhr.status);
      //parseamos la respuesta que por default viene en formato de texto
      let preguntasRegistradas= JSON.parse(xhr.responseText); 
      console.log(preguntasRegistradas  );
      
      //gpt
            // Recorremos el arreglo de preguntas
      preguntasRegistradas.forEach(function(pregunta) {
        // Crea una nueva fila en la tabla
        var fila = document.createElement("tr");
    
        // Crea la celda con la pregunta
        var celdaPregunta = document.createElement("td");
        celdaPregunta.innerText = pregunta.pregunta;
        fila.appendChild(celdaPregunta);
    
        // Crea la celda con las opciones
        var celdaOpciones = document.createElement("td");
        var select = document.createElement("select");
    
        // Agrega las opciones al select
        //creamos elemento option y guardamos en var
        var opcionCorrecta = document.createElement("option");
        //el valor del option va a ser el valor de pregunta que es de for each con lo que hay en la propiedad  value
        opcionCorrecta.value = pregunta.respuesta_ok;
        //el contenido textual va a ser lo de la propiedad espuesta_ok
        opcionCorrecta.innerText = pregunta.respuesta_ok;
        //testeamos lo que se esta almacenando
        console.log(opcionCorrecta);
        //agregamos al elemto padre el tag es decir al select que es el elemento padre le agregamos el hijo que es option esta opcion contiene la resp correcta
        select.appendChild(opcionCorrecta);

        // agregamos la opcion 1 al option y agregamos al select
        var opcion1 = document.createElement("option");
        opcion1.value = pregunta.respuesta_opc1;
        opcion1.innerText = pregunta.respuesta_opc1;
        select.appendChild(opcion1);
        console.log(opcion1);
    
        var opcion2 = document.createElement("option");
        opcion2.value = pregunta.respuesta_opc2;
        opcion2.innerText = pregunta.respuesta_opc2;
        select.appendChild(opcion2);
        
        var opcion3 = document.createElement("option");
        opcion3.value = pregunta.respuesta_opc3;
        opcion3.innerText = pregunta.respuesta_opc3;
        select.appendChild(opcion3);
        //agregamos el select a la celda
        celdaOpciones.appendChild(select);
        //agregamos la celda a la fila
        fila.appendChild(celdaOpciones);
        
        //agregamos la fila a la tabla 
        var tabla=document.querySelector(".conTabla table"); 
        // seleccionando la tabla con class conTabla
        tabla.appendChild(fila);
        
      });
  
    }  
  }
  //hacemos la llamada y pasamos como argumento consulta
  xhr.send('consulta');

  

}


function obtenerPreguntaz(idSelec){

  console.log(idSelec);

  console.log('corriendo metodo obtener preguntas');
  document.querySelector('tbody').innerHTML= ``;
  //realizamos peticion xhr instanciamos variable objeto formData que emula al formulario y pasamos como parametro la variable que guarda al formulario
 
  //instanciamos el objeto XMLHttpRequest y lo guardamos en variable llamada ajax
  var xhr= new XMLHttpRequest ();



  //usamos el metodo open que abre la conexion, recibe tre parametros como argumentos, el primero: metodo de envio, el segundo: la url a donde viaja la peticion y el tercero es: valor boleano que define si es asincrono o sincrono, sino se pone por default se determina como true, es decir asincrona
  xhr.open('POST', 'probando2.php',true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

 
  xhr.onload= function (){

    // manejamos el estado de la respuesta del servidor si es 200 el archivo fue encontrado y la respuesta es ok
    if(xhr.status==200){
      console.log('cargado el estado ' + xhr.status);
      //parseamos la respuesta que por default viene en formato de texto
      //let preguntasRegistradas= JSON.parse(xhr.responseText); 
      let preguntasRegistradas= JSON.parse(xhr.responseText); 
      
      console.log(preguntasRegistradas );
   
      //gpt
            // Recorremos la respuesta 
     for(let datos of preguntasRegistradas) {
        //colocamos los datos en el cuerpo de la tabla
        document.querySelector('tbody').innerHTML += `<td class="preguntaDom">${datos.pregunta}</td>
                                                        <td>
                                                          <select name="resp" class="resp">
                                                            
                                                            <option class="resOk">${datos.respuesta_ok}</option>
                                                            <option class="op1">${datos.respuesta_opc1}</option>
                                                            <option class="op2">${datos.respuesta_opc2}</option>
                                                            <option class="op3">${datos.respuesta_opc3}</option>
                                                          </select>
                                                          <button class="actualizar" item="${datos.id_test_pregunta }">Actualizar</button>
                                                          <button class="quitar" item="${datos.id_test_pregunta }">Quitar</button>
                                                        </td>`;
      }

      //capturamos el noton de quitar para poder eliminar la pregunta cuando se haga clic
      let btnQuitar = document.querySelectorAll('.quitar');
      
      //recorremos todos los elementos que tengan la clase quitar
      for(let i=0; i<btnQuitar.length; i++){
        //agregamos un evento para cada boton
        btnQuitar[i].addEventListener('click', function(){
          
          //llamamos al metodo eliminaPreguntra y le pasamos el item seleccionado a traves de su atributo
          eliminaPreguntra(btnQuitar[i].getAttribute('item'));
          
        });
      }

      //capturamos el boton actualizar y le agregamos un evento 
      let btnAct = document.querySelectorAll('.actualizar');
      //recorremos todos los elementos que tengan la clase actualizar
      for(let i=0; i<btnQuitar.length; i++){
        //agregamos un evento para cada boton
        btnAct[i].addEventListener('click', function(){
          
          //llamamos al metodo eliminaPreguntra y le pasamos el item seleccionado a traves de su atributo
          actualizarPreguntra(btnAct[i].getAttribute('item'));
          
        });
      }
  
    }  
  }
  //hacemos la llamada y pasamos como argumento consulta y el id seleccionado
  
  xhr.send("consulta=true&idSelec="+idSelec);
}




function testExistentes(){
  console.log('si entra al metodo testExistentes');
  //solcitamos la infotmacion a la BD con ayuda de xhr
  let xhr = new XMLHttpRequest();

  //abrimos conexion indicando los parametros
  xhr.open('POST', 'probando2.php', true);

  //para poder enviar por post debemos especificar la cabecera de lo contario no se enviaran los datos
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


  //cuando haya cargado validamos el estado de respuesta del servidor
  xhr.onload= function (){

    // manejamos el estado de la respuesta del servidor si es 200 el archivo fue encontrado y la respuesta es ok
    if(xhr.status==200){
        //console.log('cargado el estado' + ajax.status);
        

        //agregamos la respuesta al div llamado respuesta
        //document.querySelector('#listaTest').innerHTML= xhr.responseText;
        //console.log("respuesta del server es: " + xhr.responseText);
       let respuesta = JSON.parse(xhr.response); 
        console.log(respuesta);

        //recorremos la respuesta
        for(let resp of respuesta){
          document.getElementById("listaTest").innerHTML+= `<li>${resp.nombre_tema}</li>`;
        }

    }else{
      console.log('no hay respuesta');
    } 
  }

  //hacemos la llamada y como solo vamos a solicitar datos no es necesario enviar ningun dato sin embargo para reconocer en el backend que solicitud se esta realizando pasamos como argumento el dato 
  xhr.send( 'testExistentes' );



}


//metodo que elimina la pregunta seleccionado a traves de su item seleccionado 
function eliminaPreguntra(item){
  //console.log('entra al metodo eliminar con el item ' +item);
  
 


  //instanciamos objeto xhr
  let xhr = new XMLHttpRequest();

  //abrimos la conexion hacia el backend  pasando el tipo de envio, la direccion de envio y booleano true para indicar que es asincrona 
  xhr.open('POST', 'probando2.php', true);

   //para poder enviar por post debemos especificar la cabecera de lo contario no se enviaran los datos
   xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  //manejamos la respuesta cuando haya cargado esto quiere decir que se encontro el archivo y tenemos respuesta, es aqui donde manejamos la logica de programacion
  xhr.onload= function(){
    
    console.log(xhr.responseText);
    obtenerPreguntaz(idSelec);
  }
  xhr.send( "Eliminarpregunta="+item);
 
}

function actualizarPreguntra(item){

 // console.log('metodo para actualizar ok'+item);
  //instanciamos objeto xhr
  let xhr = new XMLHttpRequest();

  //abrimos la conexion hacia el backend  pasando el tipo de envio, la direccion de envio y booleano true para indicar que es asincrona 
  xhr.open('POST', 'probando2.php', true);

  //para poder enviar por post debemos especificar la cabecera de lo contario no se enviaran los datos
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  //manejamos la respuesta cuando haya cargado esto quiere decir que se encontro el archivo y tenemos respuesta, es aqui donde manejamos la logica de programacion
  xhr.onload= function(){
    
  //parseamos la respuesta
  let datos= JSON.parse(xhr.responseText);
  console.log(datos);

    
  //recorremos la respuesta
  for(let data of datos){
  //obtenemos los datos del formulario y asignamos el valor de nuestra respuesta
  let pruebamelo =  document.getElementById('idPregunta').value = `${data.id_test_pregunta}`;
  console.log(pruebamelo);
  document.getElementById('pregunta').value= `${data.pregunta}`;
  document.getElementById('resp_ok').value= `${data.respuesta_ok}`;
  document.getElementById('op1').value= `${data.respuesta_opc1}`;
  document.getElementById('op2').value= `${data.respuesta_opc2}`;
  document.getElementById('op3').value= `${data.respuesta_opc3}`;
  
  let msgAlerta =  document.getElementById('alertaForm');

  msgAlerta.innerHTML=`<p class="mensajeAlertaOnn">Actualiza los datos</p>`;
  document.querySelector
  setTimeout(function(){
  msgAlerta.innerHTML=`<p class="mensajeAlertaOff">Actualiza los datos</p>`;
  

  },2000);

  }

    


  }
  xhr.send( "actPregunta="+item);



}

