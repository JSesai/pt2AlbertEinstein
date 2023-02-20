<?php 


?>

<!-- FORMULARIO DE INGRESO DE ALUMNO -->


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-signin-client_id" content="YOUR_GOOGLE_CLIENT_ID">

    <link rel="shortcut icon" href="../img/imgsysgerde/Logo_CAE.png" type="image/x-icon">
    <title>SysgGeRDE-login</title>
    <link rel="stylesheet" href="../CSS/styleforms.css">
</head>
<body>
    
    <section>
    <div class="FEparte2">
            <form action="validaLoginAl.php" method="POST" class="form" id="logeoAlumno" >
            <div class="logoform"><img src="../img/imgsysgerde/Logo_CAE.png" alt="Albert Einstein"></div>
                <h2 class="form_title">Ingresa</h2>
                <P class="form_paragraph">¿Aun no tienes cuenta? <a href="formRegE.php" class="form_link">Registrate aqui</a></P>
                
                <div id="g_id_onload"
     data-client_id="660053218878-lvfoc3kch1ui1l5mpd3bnf3p7cpl2kf3.apps.googleusercontent.com"
     data-context="signup"
     data-callback="handleCredentialResponse"
     data-itp_support="true">
</div>
               
                <div class="form_container">
                     <!-- grupo de input correo -->
                    <div class="form_group">
                        <input type="email" id="name" class="form_input" placeholder=" " name="alCorreo" required>
                        <label for="name" class="form_label" >Correo:</label>
                        <span class="form_line"></span>
                        <p class="mensajeValidacionLog" id="msgCorreo">Formato de correo Invalido</p>
                            
                    </div>

                    <!-- grupo de input para contraseña -->
                    <div class="form_group">
                        <input type="password" id="user" class="form_input" placeholder=" " name="alPas" required>
                        <label for="user" class="form_label" >Contraseña:</label>
                        <span class="form_line"></span>
                        <p class="mensajeValidacionLog2" id="pass">Formato de contraseña incorrecto</p>
                            
                    </div>

                    
                    <input type="submit" class="form_submit" value="Ingresar" name="al_ingreso" >
                    <input type="button" onclick="location.href='../index.php';" value="Cancelar" class="form_cancel">

                </div>
            </form>
        </div>
    </div>
    </section>

    <script src="https://accounts.google.com/gsi/client" async defer></script>

    <script src="validarFormLog.js"></script>
    <script src="loginGoogle.js"></script>
</body>
</html>



