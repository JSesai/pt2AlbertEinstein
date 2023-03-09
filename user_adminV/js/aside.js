//mensaje para comprobar que esta linkeado el archivo
console.log('carga de aside->ok');
window.onload= llamarContPrsnal('adminPerfil/infPersonal.php');

// capturar el enlace y agregar evento click que llama a la funcion talkcontent pasando como parametro la url del archivo que va a traer
document.getElementById('enlace1').addEventListener('click',function(){llamarContPrsnal('adminPerfil/infPersonal.php');});
document.getElementById('enlace2').addEventListener('click',function(){llamarContDom('adminPerfil/infDom.php');});
document.getElementById('enlace3').addEventListener('click',function(){llamarContenido('adminPerfil/infOtra.php');});
document.getElementById('enlace4').addEventListener('click',function(){llamarContenido('adminPerfil/infOtra.php');});
document.getElementById('enlace5').addEventListener('click',function(){llamarContenido('adminPerfil/prueba.php');});

//funcion que muestra alertas recibe 3 parametros el tipo de icono, el titulo del alert y eñ mensaje de la alerta
function alerta(tpoIcon, tituloAlert, msjAlert,){
  Swal.fire({
    icon: tpoIcon,
    title: tituloAlert,
    text: msjAlert   
  })
}
//---------------cuando esta sobre la edicion de datos personales 
//hace consulta, devuelve respuesta y la une con el div donde necesitamos mostrar el contenido del domicilio
function llamarContPrsnal(url){
  //fetch hace la consulta con la url
  fetch(url)
  //retorna la promesa, la ejecutamos como funcion felcha y retorna  la respuesta
    .then(response => response.text())
    .then(respuesta => { //se maneja la respuesta
      // console.log(respuesta);
      const contenedor = document.getElementById('contenido');//se obtiene en donde se va a mostrar la respuesta
      
      //---------------------- maneja el modal de nombre y apellidos
      contenedor.innerHTML = " "; //borramos donde se va a mostrar la respuesta por si tiene algun contenido
      contenedor.innerHTML = respuesta; //unimos la respuesta al elemento seleccionado
      let modalinfoPrsanl = document.querySelector('#modalNombre'); //recuperamos el modal
      modalinfoPrsanl.addEventListener('shown.bs.modal', function () { //capturamos el evento cuando se encuentra visible el modal
      //console.log('Modal cargado');
      let form= document.getElementById('formDatoPersnalModal');//recuperamos el dormulario de nombre y apellidos que esta en el body del modal
      form.onsubmit= function(e){ //capturamos el submit del formulario
        e.preventDefault(); //previnimos el envio por default
        var campos = validaCampos(form); // almacenamos la respuesta de la validacion que puede ser tru o false
         if(campos){//si es true entra al bloque
          //console.log(campos);
          enviaDatosPrsnal(form);//emvia datos al backed
          // quitamos el modal 
          var modalinfo = bootstrap.Modal.getInstance(modalinfoPrsanl);
          modalinfo.hide();
          setTimeout(()=>{
            llamarContPrsnal('adminPerfil/infPersonal.php');
          },1000);
          
  
          
        }
        
        
      }
      const inputs = document.querySelectorAll('#modalNombre input');
          //creamos los eventos para validar
      inputs.forEach((input) => {
        
        //evento cuando se presiona y se sulta la tecla; se llama a validarFormulario
        input.addEventListener('keyup', validarFormulario);
          //evento cuando se da clic fuera del input; se llama a validarFormulario
        input.addEventListener('blur', validarFormulario);
        
  
  
      });
  
           
  
      });
      //---------------------modal para guardar la fecha de nacimiento------------------
      let modalFnac = document.querySelector('#modalFnac'); //recuperamos el modal
      modalFnac.addEventListener('shown.bs.modal', function () {
        console.log("modal fecha nac cargado");
        let form= document.getElementById('formFnacMod');//recuperamos el dormulario que esta en el body del modal
      form.onsubmit= function(e){ //capturamos el submit del formulario
        e.preventDefault(); //previnimos el envio por default
        let campos = validaCampos(form);
         if(campos){
          console.log(campos);
          enviaFechanac(form);
          // quitamos el modal 
          var modalinfo = bootstrap.Modal.getInstance(modalFnac);
          modalinfo.hide();
          setTimeout(()=>{
            llamarContPrsnal('adminPerfil/infPersonal.php');
          },1000);
                    
        }
                
      }
      

      });
      //---------------------codigo para manejar y guardar genero seleccionado en el modal ------------------
      let modalGenero = document.querySelector('#modalGenero'); //recuperamos el modal
      modalGenero.addEventListener('shown.bs.modal', function () {
      console.log("modal genero cargado");
      let form= document.getElementById('formGenero');//recuperamos el dormulario que esta en el body del modal
      form.onsubmit= function(e){ //capturamos el submit del formulario
        e.preventDefault(); //previnimos el envio por default
        
        let id = document.getElementById('idAdm');//recuperamos el id del elemento que contiene el item
        let ids= id.getAttribute('item'); //recuperamos el valor del atributo item
        let fd= new FormData(form); //instanciamos FormData y le pasamos el formulario, recupera todos los elementos del formulario
        fd.append('idAdm', ids); //agregamos el id del usuario al FormData
        fd.append('formGenero','formGenero');//agregamos un valor para tomarlo como clave para poder identificarlo en el backend
        //enviamos al backend el formulario
        fetch('../datosPerfiles/datosUsuarios.php', { //metodo para envio de peticiones, especifica url destino
        method: 'POST', //metodo de envio por post
        body:  fd } )
        .then(response=>response.text()) //respuesta de la promesa, se retona la respuesta en formato texto
        .then(respuesta => { //manejo de la respuesta del backend
          console.log('respuesta servidor es' + respuesta);
          
          alerta('success', 'Guardado correctamente', 'Genero guardado correctamente') ;
        
          // quitamos el modal 
          var modal = bootstrap.Modal.getInstance(modalGenero);
          modal.hide();
          setTimeout(()=>{
            llamarContPrsnal('adminPerfil/infPersonal.php');
          },1000);
        });
       
      }
      

      });
      //---------------------codigo para manejar y guardar CURP seleccionado en el modal ------------------
      let modalCurp = document.querySelector('#modalCurp'); //recuperamos el modal
      modalCurp.addEventListener('shown.bs.modal', function () {
        console.log("modal CURP cargado");
        let form= document.getElementById('formCurp');//recuperamos el dormulario que esta en el body del modal
        form.onsubmit= function(e){ //capturamos el submit del formulario
          e.preventDefault(); //previnimos el envio por default
          console.log("presionado el submiteo");
          let campos = buscarCurp();
           console.log(campos);
           if(campos){
             console.log(campos);
          //   enviaFechanac(form);
          //   // quitamos el modal 
          //   var modalinfo = bootstrap.Modal.getInstance(modalFnac);
          //   modalinfo.hide();
          //   setTimeout(()=>{
          //     llamarContPrsnal('adminPerfil/infPersonal.php');
          //   },1000);
                    
           }
        
       
        }
      

      });
  
      
    })
    .catch(error => console.error(error));
  
  
  
  
  }
//hace consulta, devuelve respuesta y la une con el div donde necesitamos mostrar el contenido del domicilio
function llamarContDom(url){
//fetch hace la consulta con la url
fetch(url)
//retorna la promesa, la ejecutamos como funcion felcha y retorna  la respuesta
  .then(response => response.text())
  .then(respuesta => { //se maneja la respuesta
    // console.log(respuesta);
    const contenedor = document.getElementById('contenido');
    
    contenedor.innerHTML = " "; //borramos contenido de la tabla
    contenedor.innerHTML = respuesta; //unimos la respuesta al elemento seleccionado
    let modalinfoDom = document.querySelector('#modalDatDom'); //recuperamos el modal
    modalinfoDom.addEventListener('shown.bs.modal', function () { //capturamos el evento cuando se encuentra mostrado el modal
    console.log('Modal cargado');
    let form= document.getElementById('formDatosDomModal');//recuperamos el dormulario que esta en el body del modal
    form.onsubmit= function(e){ //capturamos el submit del formulario
      e.preventDefault(); //previnimos el envio por default
      var campos= validaCampos(form);
      if(campos){
        enviaDatos(form);
        // quitamos el modal 
        var modalinfo = bootstrap.Modal.getInstance(modalinfoDom);
        modalinfo.hide();
        setTimeout(()=>{
          llamarContDom('adminPerfil/infDom.php');
        },1000);
        

        
      }
      
      
    }
    const inputs = document.querySelectorAll('#formDatosDomModal input');
        //creamos los eventos para validar
    inputs.forEach((input) => {
      
      //evento cuando se presiona y se sulta la tecla; se llama a validarFormulario
      input.addEventListener('keyup', validarFormulario);
        //evento cuando se da clic fuera del input; se llama a validarFormulario
      input.addEventListener('blur', validarFormulario);
      


    });

    document.getElementById('btnCp').addEventListener('click',()=> { //manejador de evento para el boton buscar cp cuando el modal esta activo
    buscarCp(); //metodo que hace consumo de api cp

    });
    

    });

    //validamos que los campos no sean vacios o nulos

    
  })
  .catch(error => console.error(error));




}

//envia datos del formulario info personal al backend
function enviaDatosPrsnal(form){
//    console.log(form);
        let id = document.getElementById('idAdm');//recuperamos el id del elemento que contiene el item
        let ids= id.getAttribute('item'); //recuperamos el valor del atributo item
        let fd= new FormData(form); //instanciamos FormData y le pasamos el formulario, recupera todos los elementos del formulario
        fd.append('idAdm', ids); //agregamos el id del usuario al FormData
        fd.append('formName','formName');//agregamos un valor para tomarlo como clave para poder identificarlo en el backend
      //enviamos al backend el formulario
      fetch('../datosPerfiles/datosUsuarios.php', { //metodo para envio de peticiones, especifica url destino
        method: 'POST', //metodo de envio por post
        body:  fd } )
      .then(response=>response.text()) //respuesta de la promesa, se retona la respuesta en formato texto
      .then(responde=> { //manejo de la respuesta del backend
        console.log('respuesta servidor es' + responde);
        
        alerta('success', 'Registro exitoso', 'Nombre guardado correctamente') ;
        
      });
          
}
//envia fecha de nacimiento al backend
function enviaFechanac(form){
//    console.log(form);
        let id = document.getElementById('idAdm');//recuperamos el id del elemento que contiene el item
        let ids= id.getAttribute('item'); //recuperamos el valor del atributo item
        let fd= new FormData(form); //instanciamos FormData y le pasamos el formulario, recupera todos los elementos del formulario
        fd.append('idAdm', ids); //agregamos el id del usuario al FormData
        fd.append('formFnac','formFnac');//agregamos un valor para tomarlo como clave para poder identificarlo en el backend
      //enviamos al backend el formulario
      fetch('../datosPerfiles/datosUsuarios.php', { //metodo para envio de peticiones, especifica url destino
        method: 'POST', //metodo de envio por post
        body:  fd } )
      .then(response=>response.text()) //respuesta de la promesa, se retona la respuesta en formato texto
      .then(responde=> { //manejo de la respuesta del backend
        console.log('respuesta servidor es' + responde);
        
        alerta('success', 'Registro exitoso', 'Fecha de nacimiento guardada correctamente') ;
        
      });
          
}
//envia datos del formulario al backend
function enviaDatos(form){
//    console.log(form);
        let id = document.getElementById('idAdm');//recuperamos el id del elemento que contiene el item
        
        let ids= id.getAttribute('item'); //recuperamos el valor del atributo item
     
        let fd= new FormData(form); //instanciamos FormData y le pasamos el formulario, recupera todos los elementos del formulario
        fd.append('idAdm', ids); //agregamos el id del usuario al FormData
      //enviamos al backend el formulario
      fetch('../datosPerfiles/datosUsuarios.php', { //metodo para envio de peticiones, especifica url destino
        method: 'POST', //metodo de envio por post
        body:  fd } )
      .then(response=>response.text()) //respuesta de la promesa, se retona la respuesta en formato texto
      .then(resp=> { //manejo de la respuesta del backend
        console.log('respuesta servidor es'+resp);
        alerta('success', 'Registro exitoso', 'Domicilio guardado correctamente') ;
        
      });
          
}

// limpia los selects
function resetSelects(){
  document.getElementById('estadoModal').innerHTML = '';
  document.getElementById('municipioModal').innerHTML = '';
  document.getElementById('coloniaModal').innerHTML = '';
}

//consulta CURP con una api para validar que exista realmente
function buscarCurp(){
  let dato= false;
  let curp = document.getElementById('inputCurp').value;
  if(curp.trim() ==""){
    alerta('warning','Ingresa CURP','Campo vacio, ingresa tu CURP');

  }else{

    const options = {
      method: 'GET',
      headers: {
        'X-RapidAPI-Key': '8cc8889d0fmsh7e7e1deef1f9ec5p18c62ajsnbdff549a5399',
        'X-RapidAPI-Host': 'curp-renapo.p.rapidapi.com'
      }
    };
    
    fetch('https://curp-renapo.p.rapidapi.com/v1/curp/'+curp, options)
//retorna la promesa, la ejecutamos como funcion felcha y retorna  la respuesta
  .then(response => response.json())
  .then(respuesta => { //se maneja la respuesta
    // console.log(respuesta);
    console.log(respuesta);
    if(respuesta.renapo_valid == true){
      dato = true; 
    }else{
      alerta('warning','CURP invalida','La curp ingresada no existe.');
      console.log('NO existe');
    }
    
  })
  .catch(error => console.error(error));
  
}
  return dato;
      
}


//consulta codigo postal con una api
function buscarCp(){
  let cp= document.getElementById('inputCp').value;
  console.log(cp);
  let token= 'c3b89a51-227a-433e-8906-9b6db5d7697d';
  let prueba= 'prueba';
  let xhr= new XMLHttpRequest();
  xhr.open('get', 'https://api.copomex.com/query/info_cp/'+cp+'?token='+token, true);
  
 //manejo de respuesta de la peticion 
  xhr.onload= function (){

      // manejamos el estado de la respuesta del servidor si es 200 el archivo fue encontrado y la respuesta es ok
      if(xhr.status==200){
          //console.log('cargado el estado' + ajax.status);
                  
         let respuesta = JSON.parse(xhr.response); 
         console.log(respuesta);
         //borramos las opciones para que cada vez que presione el boton buscar cp solo muestre el resultado de la consulta actual
         resetSelects();
         document.getElementById('estadoModal').innerHTML += `<option >${respuesta[0].response.estado}</option>`; //agregamos la respuesta con un option al select recuperado con id
         for(let dato of respuesta){ //recorremos la respuesta 
          document.getElementById('municipioModal').innerHTML += `<option >${dato.response.municipio}</option>`;
          document.getElementById('coloniaModal').innerHTML += `<option >${dato.response.asentamiento}</option>`;
        }
     
               
      }else{
        resetSelects();
        // funcion propia que muestra alertas con  libreria sweet alert
        alerta('error','oopss','Revisa el Codigo Postal');
     
      
          
      }
      
  }
  
  xhr.send();
      
}

// valida los campos del formulario recibido, cada case corresponde a un formulario distinto, deben cumplir con las expresiones regulares para poder retornar true
function validaCampos(form){
  //obtine el nombre del formulario identificado con su etiqueta name
 let nombreFormulario= form.name;

 var dato = false;//banderilla
  switch(nombreFormulario){ //el nombre del formulario se busca dentro de las coincidencias
   
    case 'formDatoPersnalModal': //valida form del modal nombre
      console.log('has las validaciones del nombre');
      let nombre= document.getElementById('nombreModal').value;
      //console.log(nombre);
      let apePa = document.getElementById('apePatModal').value;
      let apeMa = document.getElementById('apeMatModal').value;
    
      //let dato = false; // inicializamos la variable como false
      if (nombre.trim() === ''){ 
        alerta('warning','Campos obligatorios vacios','Ingrese su nombre');

      } else if(!expresiones.nombre.test(nombre)){
       alerta('warning','Formato invalido','Omita numeros y caracteres especiales');

      } else if(apePa.trim() === "" && apeMa.trim() === ""){
        alerta('warning','Campos vacios','Ingrese al menos un apellido');

      } else if(apeMa.trim() !== ""){
        if(!expresiones.nombre.test(apeMa)){
          
          alerta('warning','Apellido materno invalido','Omita numeros y caracteres especiales');
        } else {
          dato = true; // si la validación es correcta, cambiamos el valor de la variable a true
        }
      } else if(apePa.trim() !== ""){
        if(!expresiones.nombre.test(apePa)){
        
          alerta('warning','Apellido Paterno invalido','Omita numeros y caracteres especiales');
        } else {
          dato = true; // si la validación es correcta, cambiamos el valor de la variable a true
        }
      }
      //return dato;
      
    break;

      case 'formDatosDomModal':
        console.log('valida campos de dom');
        let kalle= document.getElementById('calleModal').value;
        let num = document.getElementById('numExtModal').value;
        const inputs = form.querySelectorAll('select'); // selecciona todos los campos de entrada y los elementos de selección
        
       
        inputs.forEach(function(input) {
          if (input.value.trim() === '') { // verifica si el campo está vacío (o solo contiene espacios)
            alerta('warning','Campos vacios','Ingrese el codigo postal');//alerta
            
          }else if(kalle.trim() === ''){
            
            alerta('warning','Rellene campo','Ingrese la calle');//alerta
          }else if(!expresiones.calle.test(kalle)){
            alerta('warning','Formato invalido','Omita caracteres especiales');//alerta
            
          }else if(num.trim() ===''){
            alerta('warning','Campos vacios','Ingrese el numero exterior');//alerta
                  
          }else if(!expresiones.numero.test(num)){
            alerta('warning','Formato invalido','Omita caracteres especiales');//alerta
      
          }else{
           dato = true;
      
          }
        });
      break;

      case 'formFnacMod': //formulario fecha de nacimiento
      
        console.log('valida campos de fecha');
        let fechaNac = document.getElementById('fechaNac').value; //valor del input date del form
        console.log(fechaNac);

        let hoy = new Date(); // obtiene la fecha actual

        let anioHace5 = hoy.getFullYear() - 5; // obtiene el año actual menos 5

        let edadMinima = new Date(anioHace5, hoy.getMonth(), hoy.getDate()); // crea un objeto Date con la fecha mínima permitida (hoy menos 5 años)

        // convierte fechaNac en un objeto Date
        let fechaNacObj = new Date(fechaNac);

        if (fechaNac.trim() === '') { // quita espacios con trim y evalua si esta vacio
            alerta('warning', 'Seleccione fecha', 'Ingrese su fecha de nacimiento'); //alerta
        } else if (fechaNacObj > edadMinima) {
            alerta('warning', 'Error en la fecha', 'Ingrese una fecha de nacimiento válida'); //alerta
        } else {
            dato = true;
        }
   
      break;

      case 'formCurp':
        
      dato = true;
      
      break;

      default:
          console.log('no coincide nada');
      break;
          
  }
  
   return dato;
 
 
}


//hace consulta, devuelve respuesta y la une con el div donde necesitamos mostrar el contenido
function llamarContenido(url){
//console.log('llama al contenido');
//fetch hace la consulta con la url
fetch(url)
//retorna la promesa, la ejecutamos como funcion felcha y retorna  la respuesta
  .then(response => response.text())
  .then(respuesta => { //se maneja la respuesta
    // console.log(respuesta);
    const contenedor = document.getElementById('contenido');
    //borramos contenido de la tabla
    contenedor.innerHTML = " ";
    contenedor.innerHTML = respuesta;

    
  })
  .catch(error => console.error(error));

}


//*********************codigo que controla y ajusta el tamaño de la barra lateral del perfil **************************

//determina si el ancho es o no igual a 50px
function modificarAside(){
    // capturo la barra lateral para agregarle la clase display none
    let menuLat = document.getElementById('mnuLateral');
    if(menuLat.style.width=='50px'){
        //metodo que amplia el ancho
        ampliaAside(menuLat);
       
        
    }else{
        //metodo que reduce el ancho
        reduceAside(menuLat);
        
    }
}
//amplia ancho y une el texto
function ampliaAside(menuLat){
     //hacemos grande la barra
     menuLat.style.width = '220px';
     //agregamos contenido de informacion personal
     document.getElementById('btnEditAside').innerHTML=`<i class="bi bi-arrow-left-circle-fill"></i>`;
     document.getElementById('enlace1').innerHTML=`Información personal`;
     document.getElementById('enlace2').innerHTML=`Información de domicilio`;
     document.getElementById('enlace3').innerHTML=`Información de contacto`;
     document.getElementById('enlace4').innerHTML=`Administra contraseña`;

}
//reduce ancho, quita texto y agrega iconos
function reduceAside(menuLat){
    // reduce el tamño
    menuLat.style.width = '50px';
    //quitamos el contenido
    document.getElementById('btnEditAside').innerHTML=`<i class="bi bi-arrow-right-circle-fill"></i>`;
    document.getElementById('enlace1').innerHTML=`<i class="bi bi-person-bounding-box"></i>`;
    document.getElementById('enlace2').innerHTML=`<i class="bi bi-signpost-fill"></i>`;
    document.getElementById('enlace3').innerHTML=`<i class="bi bi-phone-flip"></i>`;
    document.getElementById('enlace4').innerHTML=`<i class="bi bi-key"></i>`;
    
}

// capturo el clic del boton y agrego evento
document.getElementById('btnEditAside').addEventListener('click', e => {
    modificarAside();

});


// consulta de medios para detectar un ancho máximo de 992 píxeles
const consultaMedios = window.matchMedia("(max-width: 992px)");
var menuLat = document.getElementById('mnuLateral');

// verificar si la consulta de medios se cumple
if (consultaMedios.matches) {
  // la pantalla tiene un ancho de 992 píxeles o menos
  reduceAside(menuLat);

} else {
  // la pantalla tiene un ancho mayor a 992 píxeles
  // ajustar el tamaño del elemento de otra manera aquí
  ampliaAside(menuLat);
  
}


// ********************* carga foto de perfil y la enviamos al sevidor

function uploadImage(event) {
  let input = event.target;
  let file = input.files[0];
 // console.log(file);
  //rescatamos id del administrador
  let id = document.getElementById('idAdm');
  let ids= id.getAttribute('item');
    
  let formData = new FormData();
  formData.append("imagenPerfil", file);
  formData.append('idAdm', ids);
  //console.log(formData);

      // Envía el valor seleccionado a tu archivo PHP usando fetch()
  fetch('../datosPerfiles/datosUsuarios.php', {
    method: 'POST',
    body: formData
    })
  .then(function(response) {
    return response.json();
  })
  .then(function(resp) {
    console.log(resp.titulo);
    console.log(resp.mensaje);
    if(resp.alerta=='warning'){
      alerta(resp.alerta,resp.titulo,resp.mensaje);//alerta con mensajes de respuesta del backend
    }else{

      window.location.href = "perfilAdmin.php";
    }
   
         
  });
  
  
  
}

// OBJETO CON TODAS LAS EXPRESIONES REGULARES A TESTEAR PARA LOS INPUTS
const expresiones = {
  
  nombre:/^[a-zA-ZÀ-ÿ\s]{3,30}$/,
	calle: /^[a-zA-Z0-9À-ÿ-"\s]{3,30}$/, // Letras, espacios y numeros, pueden llevar acentos.
  numero: /^[a-zA-Z0-9-/"\s]{1,9}$/, // Letras y espacios, pueden llevar acentos.
  referencia: /^[a-zA-Z0-9À-ÿ.,;:()-_\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
	//password: /^.{4,12}$/, // 4 a 12 digitos.
   // password: /^[a-zA-Z0-9#$&%._-]{8}$/, 
  passwordMin: /[a-z]{1,}/,
	passwordMayus: /[A-Z]{1,}/,
	passwordTam:/.{8}$/,
	passwordNum:/[0-9]{1,}/,
	passworCarEsp:/[#$/&%!¡._-]{1,}/,
	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/

	
}

//constante que contien funcion flecha 
  const validarFormulario= e=> {

    //inputs de formulario info personal  -------------------------------------------------
    var inputNombre= document.getElementById('nombreModal'); //input nombre
    var inputApePa= document.getElementById('apePatModal'); //input nombre
    var inputApeMa= document.getElementById('apeMatModal'); //input nombre
    //--------------------------------------------------------------------------------------
        
    //inputs de formulario datos de domicilio ------------------------------------------------
    var inputCalle = document.getElementById('calleModal');
    var inputNumero = document.getElementById('numExtModal');
    var inputNumeroInt = document.getElementById('numIntModal');
    var inputRef = document.getElementById('refModal');
    //----------------------------------------------------------------------------------------

        // usamos un switch para evaluar el campo que se esta tecleando , target nos trae el nombre del imput seleccionado
  switch (e.target.name) {
       
    case "nombreModal":  //si se tecleo en nombre 
      
      if(e.target.value.trim() ===''){ //si el input que esta levantando el evento es vacio
        //document.getElementById('validaNombre').innerHTML =""; //borra alerta textual por si antei
        document.getElementById('validaNombre').innerHTML =`<span class="alert alert-danger" role="alert"> 
          Campo obligatorio
          </span>`;
          setTimeout(function(){document.getElementById('validaNombre').innerHTML ='';},3000);
          
      }else{

        if(expresiones.nombre.test(e.target.value)){
          // console.log('Cumple con la expresion regular');
          inputNombre.classList.remove('border', 'border-danger');
          document.getElementById('validaNombre').innerHTML ="";//
          inputNombre.classList.add('border', 'border-success');
                  
        } else{
          // console.log('no cumple con exp regular');
          
          inputNombre.classList.remove('border', 'border-success');
          inputNombre.classList.add('border', 'border-danger');
          document.getElementById('validaNombre').innerHTML =`<span class="alert alert-danger" role="alert">
          Formato no permitido
          </span>`;
          setTimeout(function(){document.getElementById('validaNombre').innerHTML ='';
         
          },3000);
        
        }
      }

    break;

    case "apePatModal":  //si se tecleo en el input apellido paterno entra en este case
      
      if(e.target.value.trim() ===''){ //si el input que esta levantando el evento es vacio
        
        document.getElementById('validaApe1').innerHTML =`<span class="alert alert-warning" role="alert"> 
          Campo opcional
          </span>`;
          setTimeout(function(){document.getElementById('validaApe1').innerHTML ='';},3000);
          
      }else{

        if(expresiones.nombre.test(e.target.value)){
          // console.log('Cumple con la expresion regular');
          inputApePa.classList.remove('border', 'border-danger');
          document.getElementById('validaApe1').innerHTML ="";//
          inputApePa.classList.add('border', 'border-success');
                  
        } else{
          // console.log('no cumple con exp regular');
          
          inputApePa.classList.remove('border', 'border-success');
          inputApePa.classList.add('border', 'border-danger');
          document.getElementById('validaApe1').innerHTML =`<span class="alert alert-danger" role="alert">
          Formato no permitido
          </span>`;
          setTimeout(function(){document.getElementById('validaApe1').innerHTML ='';
         
          },3000);
        
        }
      }

    break;
    case "apeMatModal":  //si se tecleo en el input apellido paterno entra en este case
      
      if(e.target.value.trim() ===''){ //si el input que esta levantando el evento es vacio
        
        document.getElementById('validaApe2').innerHTML =`<span class="alert alert-warning" role="alert"> 
          Campo opcional
          </span>`;
          setTimeout(function(){document.getElementById('validaApe2').innerHTML ='';},3000);
          
      }else{

        if(expresiones.nombre.test(e.target.value)){
          // console.log('Cumple con la expresion regular');
          inputApeMa.classList.remove('border', 'border-danger');
          document.getElementById('validaApe2').innerHTML ="";//
          inputApeMa.classList.add('border', 'border-success');
                  
        } else{
          // console.log('no cumple con exp regular');
          
          inputApeMa.classList.add('border', 'border-danger');
          inputApeMa.classList.remove('border', 'border-success');
          document.getElementById('validaApe2').innerHTML =`<span class="alert alert-danger" role="alert">
          Formato no permitido
          </span>`;
          setTimeout(function(){document.getElementById('validaApe2').innerHTML ='';
         
          },3000);
        
        }
      }

    break;
    
        //si se tecleo en calle 
    case "calleModal":
        //console.log('presionado calle');
        //evaluamos si es verdadera la condicion de expresiones regulares nombre con o que se ha tecleado
        if(e.target.value.trim() ===''){ 
          
        }else{

          
          if(expresiones.calle.test(e.target.value)){
            // console.log('Cumple con la expresion regular');
            inputCalle.classList.remove('border', 'border-danger');
            document.getElementById('kalle').innerHTML ="";
            inputCalle.classList.add('border', 'border-success');
                    
          } else{
            // console.log('no cumple con exp regular');
            
            inputCalle.classList.remove('border', 'border-success');
            inputCalle.classList.add('border', 'border-danger');
            document.getElementById('kalle').innerHTML =`<span class="alert alert-danger" role="alert">
            Caracter no permitido
            </span>`;
            setTimeout(function(){document.getElementById('kalle').innerHTML ='';},3000);
          
          }
        }
    break;

        //si se tecleo en numero exterior 
    case "numExtModal":
      // console.log('presionado num exter');
      if(e.target.value.trim() ===''){
       
        document.getElementById('numExterior').innerHTML ="";
        document.getElementById('numExterior').innerHTML =`<span class="alert alert-danger" role="alert">
          Campo obligatorio
          </span>`;
          setTimeout(function(){document.getElementById('numExterior').innerHTML ='';},3000);
      }else{

        
        if(expresiones.numero.test(e.target.value)){
          // console.log('Cumple con la expresion regular');
          inputNumero.classList.remove('border', 'border-danger');
          document.getElementById('numExterior').innerHTML ="";
          inputNumero.classList.add('border', 'border-success');
          
        } else{
          // console.log('no cumple con exp regular');
          
          inputNumero.classList.remove('border', 'border-success');
          inputNumero.classList.add('border', 'border-danger');
          document.getElementById('numExterior').innerHTML =`<span class="alert alert-danger" role="alert">
          Caracter no permitido
          </span>`;
          
          setTimeout(function(){document.getElementById('numExterior').innerHTML ='';},3000);
        
        }
      }
    break;
        //si se tecleo en numero interior
    case "numIntModal":
    
      if(e.target.value.trim()==''){
        
        document.getElementById('numeroInte').innerHTML ="";
        document.getElementById('numeroInte').innerHTML =`<span class="alert alert-warning" role="alert">
          Campo opcional
          </span>`;
          setTimeout(function(){document.getElementById('numeroInte').innerHTML ='';},3000);

      }else{

        
        if(expresiones.numero.test(e.target.value)){
          // console.log('Cumple con la expresion regular');
          inputNumeroInt.classList.remove('border', 'border-warning');
          document.getElementById('numeroInte').innerHTML ="";
          inputNumeroInt.classList.add('border', 'border-success');
          
        } else{
          // console.log('no cumple con exp regular');
          inputNumeroInt.classList.remove('border', 'border-success');
          inputNumeroInt.classList.add('border', 'border-warning');
          document.getElementById('numeroInte').innerHTML =`<span class="alert alert-warning" role="alert">
          Caracter no permitido
          </span>`;
          setTimeout(function(){document.getElementById('numeroInte').innerHTML ='';},3000);

          
        }
      }
    break;

    case "refModal":
      
      if(e.target.value.trim()==''){
        
        document.getElementById('referencia').innerHTML ="";
        document.getElementById('referencia').innerHTML =`<span class="alert alert-warning" role="alert">
          Campo opcional
          </span>`;
          setTimeout(function(){document.getElementById('referencia').innerHTML ='';},3000);

      }else{

        
        if(expresiones.referencia.test(e.target.value)){
          // console.log('Cumple con la expresion regular');
          inputRef.classList.remove('border', 'border-warning');
          document.getElementById('referencia').innerHTML ="";
          inputRef.classList.add('border', 'border-success');
          
        } else{
          // console.log('no cumple con exp regular');
          inputRef.classList.remove('border', 'border-success');
          inputRef.classList.add('border', 'border-warning');
          document.getElementById('referencia').innerHTML =`<span class="alert alert-warning" role="alert">
          Caracter no permitido
          </span>`;
          setTimeout(function(){document.getElementById('referencia').innerHTML ='';},3000);

          
        }
      }
    break;

    
   
    
  }
 

 
  }


      
   