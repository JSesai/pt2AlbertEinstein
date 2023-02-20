<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-signin-client_id" content="660053218878-lvfoc3kch1ui1l5mpd3bnf3p7cpl2kf3.apps.googleusercontent.com">
    
    <link rel="shortcut icon" href="../img/imgsysgerde/Logo_CAE.png" type="image/x-icon">
    <title>login</title>
    <link rel="stylesheet" href="../CSS/styleforms.css">







</head>

<body style=" background: rgb(176,223,226);
    background: linear-gradient(0deg, rgba(176,223,226,1) 0%, rgba(182,191,223,1) 48%);">

<div id="g_id_onload"
     data-client_id="660053218878-lvfoc3kch1ui1l5mpd3bnf3p7cpl2kf3.apps.googleusercontent.com"
     data-context="signup"
     data-ux_mode="popup"
     data-callback="handleCredentialResponse"
     data-auto_prompt="false">
</div>

<div class="g_id_signin"
     data-type="standard"
     data-shape="rectangular"
     data-theme="filled_black"
     data-text="signin_with"
     data-size="large"
     data-logo_alignment="left">
</div>

    <section>
        <div class="contenedorFormReg">
            <form action="registraE.php" method="POST" class="formReg" id="formulario">
                <h2 class="form_titleReg">Ingresa tus datos </h2>
                    <!-- aqui vamos a poner logeo con gmail -->
                    

                <div class="form_containerReg">
                    <div class="form_groupReg">
                        <input type="text" id="nombreAl" class="form_inputReg" placeholder=" " name="nombreAl" required>
                        <label for="nombreAl" class="form_labelReg">*Nombre:</label>
                        <span class="form_lineReg"></span>
                        <p class="mensajeError" id="mensajeError">Campo requerido, sin numeros, sin caracteres especiales</p>
                    </div>

                    <div class="form_groupReg">
                        <input type="text" id="apePat" class="form_inputReg" placeholder="  " name="apePat" >
                        <label for="apePat" class="form_labelReg">Apellido Paterno:</label>
                        <span class="form_lineReg"></span>
                        <p class="mensajeError" id="mensajeErrorApePat">Campo opcional sin numeros, sin caracteres especiales</p>
                    </div>

                    <div class="form_groupReg">
                        <input type="text" id="apemat" class="form_inputReg" placeholder=" " name="apemat" required>
                        <label for="apemat" class="form_labelReg">*Apellido Materno:</label>
                        <span class="form_lineReg"></span>
                        <p class="mensajeError" id="mensajeErrorApeMat">Campo requerido, sin numeros, sin caracteres especiales</p>

                    </div>

                    <div class="form_groupReg">
                        <input type="mail" id="correo" class="form_inputReg" placeholder=" " name="correo" required>
                        <label for="correo" class="form_labelReg">*Correo Electronico:</label>
                        <span class="form_lineReg"></span>
                        <p class="mensajeError" id="mensajeErrorMail">Formato de Correo Incorrecto</p>

                    </div>

                    <div class="form_groupReg">
                        <input type="password" id="pass" class="form_inputReg" placeholder=" " name="pass" id="pass" required>
                        <label for="pass" class="form_labelReg">*Contraseña:</label>
                        <span class="form_lineReg"></span>

                        <div class="validarPas" id="validarPas">
                            <p class="mensajeValidaciones" id="mensajeValidaciones">Tu contraseña debe contener:</p>
                            <p class="mensajeValidacion" id="mensajeValidacion">Una minuscula <img src="../img/imgsysgerde/correcto.png" alt="I/" id="imgOk" class="correcto"> <img src="../img/imgsysgerde/error.png" alt="X" id="imgMal" class="incorrecto"></p>
                            <p class="mensajeValidacion" id="mensajeValMay">Una Mayuscula <img src="../img/imgsysgerde/correcto.png" alt="I/" id="imgOkMay" class="correcto"> <img src="../img/imgsysgerde/error.png" alt="X" id="imgMalMay" class="incorrecto"></p>
                            <p class="mensajeValidacion" id="mensajeErrorPasNum">Un numero  <img src="../img/imgsysgerde/correcto.png" alt="I/" id="imgOkNum" class="correcto"> <img src="../img/imgsysgerde/error.png" alt="X" id="imgMalNum" class="incorrecto"></p>
                            <p class="mensajeValidacion" id="mensajeErrorPasChar">Un caracter especial <img src="../img/imgsysgerde/correcto.png" alt="I/" id="imgOkChar" class="correcto"> <img src="../img/imgsysgerde/error.png" alt="X" id="imgMalChar" class="incorrecto"></p>
                            <p class="mensajeValidacion" id="msgErrTamanio">Tamaño de 8 caracteres<img src="../img/imgsysgerde/correcto.png" alt="I/" id="imgOkTam" class="correcto"> <img src="../img/imgsysgerde/error.png" alt="X" id="imgMalTam" class="incorrecto"></p></p>
                         
                        </div>
                        <p class="FormatcorrectoPas"><img src="../img/imgsysgerde/correcto.png" alt="I/" id="imgOkPasFormato"></p>
                    </div>
                    <!-- grupo confirmar contraseña -->
                    <div class="form_groupReg">
                        <input type="password" id="passConf" class="form_inputReg" placeholder=" " name="passConf">
                        <label for="passConf" class="form_labelReg">*Confirma contraseña:</label>
                        <span class="form_lineReg"></span>
                        <p class="mensajeErrorPas" id="mensajeErrorPas">Contraseñas Coinciden <img src="../img/imgsysgerde/correcto.png" alt="I/" id="confContraOk" class="correcto"> <img src="../img/imgsysgerde/error.png" alt="X" id="confContraMal" class="incorrecto"></p>
                    </div>


                    <input type="submit" class="form_submitReg" value="Registrarme" name="registraEst">
                    <input type="button" onclick="location.href='../index.php';" value="Cancelar" class="form_cancelReg">

                </div>

              
                
                <script src="validarForm.js"></script>
            </form>
        </div>
        </div>
    </section>

    <script src="https://accounts.google.com/gsi/client" async defer></script>
    

<script>
       function handleCredentialResponse(response) {
     
     
        //gurdamos la credencial en var 
        var credencial= response.credential;
        //llamamos al metodo para decodificar
       let credencialDecodificada= decodifica(credencial);

    
       
        


    // const responsePayload = decodeJwtResponse(response.credential);
        //id unico del usuario de la cuenta de google
     let idUser= credencialDecodificada.sub;
     console.log(idUser);
     let nombre= credencialDecodificada.given_name;
     console.log(nombre);
     let ape= credencialDecodificada.family_name;
     console.log(ape);
     imgPerfil= credencialDecodificada.picture;
     let mail= credencialDecodificada.email;
     console.log(mail);

     enviarDatos(idUser, nombre, ape, imgPerfil, mail);

    }

    function decodifica(token) {
    const base64Url = token.split('.')[1];
    const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
    const jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    }).join(''));

    console.log(jsonPayload);
    return JSON.parse(jsonPayload);
}

    function enviarDatos(idUser, nombre, ape, imgPerfil, mail){
    let loginGoogle='enviadoConGoogle';
    let fd= new FormData();
    fd.append('loginGoogle', loginGoogle); 
    fd.append('idUser',idUser);
    fd.append('nombre', nombre);
    fd.append('ape', ape);
    fd.append('imgPerfil', imgPerfil) ;
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
        console.log(respuesta);

        //recorremos la respuesta
    
        }else{
        console.log('no hay respuesta');
        } 
    }

        xhr.send(fd);
    }

</script>

</body>

</html>