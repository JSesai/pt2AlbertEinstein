
function handleCredentialResponse(response) {
     
     
    //gurdamos la credencial en var 
    var credencial= response.credential;
    //llamamos al metodo para decodificar
    let credencialDecodificada= decodifica(credencial);

    // const responsePayload = decodeJwtResponse(response.credential);
    //id unico del usuario de la cuenta de google
    let idUser= credencialDecodificada.sub;
    //  console.log(idUser);
    let nombre= credencialDecodificada.given_name;
    //  console.log(nombre);
    let ape= credencialDecodificada.family_name;
    //  console.log(ape);
    let imgPerfil= credencialDecodificada.picture;
    let mail= credencialDecodificada.email;
    //  console.log(mail);

     registraDatos(idUser, nombre, ape, imgPerfil, mail);
     ingresaConGoogle(idUser, mail);
     

}

function decodifica(token) {
    const base64Url = token.split('.')[1];
    const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
    const jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    }).join(''));

    //console.log(jsonPayload);
    return JSON.parse(jsonPayload);
}

function registraDatos(idUser, nombre, ape, imgPerfil, mail){
    let loginGoogle='enviadoConGoogle';
    let fd= new FormData();
    fd.append('loginGoogle', loginGoogle); 
    fd.append('idUser',idUser);
    fd.append('nombre', nombre);
    fd.append('ape', ape);
    fd.append('imgPerfil', imgPerfil);
    fd.append('mail', mail);
    
    let xhr= new XMLHttpRequest();

    xhr.open('post','registraE.php', true);
    //cuando haya cargado validamos el estado de respuesta del servidor
    xhr.onload= function (){

        // manejamos el estado de la respuesta del servidor si es 200 el archivo fue encontrado y la respuesta es ok
        if(xhr.status==200){
        //console.log('cargado el estado' + ajax.status);
        
        //console.log("respuesta del server es: " + xhr.responseText);
        let respuesta = xhr.response; 
        //console.log(respuesta);

        //direccionamos al login 
    
        }else{
        console.log('no hay respuesta');
        } 
    }

        xhr.send(fd);
}


function ingresaConGoogle(idUser, mail){
    let loginGoogle='logeoConGoogle';
    let fd= new FormData();
    fd.append('loginGoogle', loginGoogle);
    fd.append('pass',idUser);
    fd.append('correo',mail);

    let xhr= new XMLHttpRequest();
    xhr.open('post','validaLoginAl.php', true);
    xhr.onload= function(){
        if(xhr.status==200){
            console.log(xhr.response);
            
            window.location.href ='../user_alumno/index.php';
        }else{
            console.log('No hay respuesta');
        }
    }

    xhr.send(fd);
}

