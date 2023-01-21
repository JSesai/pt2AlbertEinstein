
<!-- FORMULARIO DE INGRESO DE ALUMNO -->
<?php 


//se inicia o se reanuda la sesion cualquiera de las 2 posibilidades
session_start();
//validamos si no hay nada almacenado informacion en la variable global SESSION
if (!isset($_SESSION["usuario"])) {
    header("Location:formLogin.php");
} else {
     //recuperamos variables globales las almacenamos en locales para uso en este ambito
    //almacena el id del usuario
    $user = $_SESSION["IdUser"];
    //almacena el nombre del usuario
    $name = $_SESSION["usuario"];
    $idCur= $_GET["id"];
    header("Location:procesos.php?id=$idCur");


}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/Logo_CAE.png" type="image/x-icon">
    <title>login</title>
    <link rel="stylesheet" href="../CSS/styleforms.css">
</head>
<body>
    
    <section>
    <div class="FEparte2">
            <form action="validaLogin.php" method="POST" class="form" >
            <div class="logoform"><img src="../img/imgsysgerde/Logo_CAE.png" alt="Albert Einstein"></div>
                <h2 class="form_title">Ingresa</h2>
                <P class="form_paragraph">¿Aun no tienes cuenta? <a href="formRegE.php" class="form_link">Registrate aqui</a></P>
                
                <div class="form_container">
                    <div class="form_group">
                        <input type="email" id="name" class="form_input" placeholder=" " name="alCorreo">
                        <label for="name" class="form_label" >Correo:</label>
                        <span class="form_line"></span>
                    </div>

                    <div class="form_group">
                        <input type="password" id="user" class="form_input" placeholder=" " name="alPas">
                        <label for="user" class="form_label" >Contraseña:</label>
                        <span class="form_line"></span>
                    </div>

                    
                    <input type="submit" class="form_submit" value="Ingresar" name="al_ingresoF">
                    <input type="button" onclick="location.href='../index.php';" value="Cancelar" class="form_cancel">

                </div>
            </form>
        </div>
    </div>
    </section>
  
</body>
</html>



