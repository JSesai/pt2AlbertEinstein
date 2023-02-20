console.log('JS-Codigo Postal:->ok');

let formulario= document.getElementById('formCp')
formulario.onsubmit= e=>{
    e.preventDefault( );
    llamaCp();
}

function llamaCp(){
    
let cp= document.getElementById('cp').value;
console.log(cp);

let xhr= new XMLHttpRequest();

xhr.onload= function (){

    // manejamos el estado de la respuesta del servidor si es 200 el archivo fue encontrado y la respuesta es ok
    if(xhr.status==200){
        //console.log('cargado el estado' + ajax.status);
       
       
       let respuesta = JSON.parse(xhr.response); 
       console.log(respuesta);
       
    }else{
        console.log('errror en la respuesta');
    }
    
}

xhr.open('get', 'https://api.zippopotam.us/mx/'+cp, true);

xhr.send();
    
}

