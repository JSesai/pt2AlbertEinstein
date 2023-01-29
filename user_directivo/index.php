<?PHP
//se inicia o se reanuda la sesion cualquiera de las 2 posibilidades
session_start();

// Si existe una variable de sesión 'LAST_ACTIVITY' y ha pasado más de 15 minutos desde la última actividad
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800) ) {
    //redirige al archivo que destruye la sesion y rediracciona al login
    header("Location:../sessionExpired.php");
}elseif (!isset($_SESSION["usuario"])&&($_SESSION['tpoUser']!='Directivo')) { //validamos si no existe la sesion con usuario y la sesion es distinta de directivo se expira la sesion
    //redirige al archivo que destruye la sesion y rediracciona al login
    header("Location:../sessionExpired.php");
} else {
    
    //recuperamos variables globales las almacenamos en locales para uso en este ambito
    //almacena el id del usuario
    $user = $_SESSION["IdUser"];
    //almacena el nombre del usuario
    $name = $_SESSION["usuario"];
}

// Asigna el tiempo actual a la variable de sesión 'LAST_ACTIVITY'
$_SESSION['LAST_ACTIVITY'] = time();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/imgsysgerde/logo2.png" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/styleTest.css">
    

    <title>SysGeRDE</title>
</head>

<body>
    <div class="container__general" >


        <div class="menu">
            <nav>
                <input type="checkbox" name="" id="btnMenu" class="check">
                <label for="btnMenu" class="btnMenu"><img src="../img/imgsysgerde/meniu.png" alt="Menu"></label>
                <ul class="items">
                    <li class="itemMenu"><a href="index.php"><img src="../img/imgsysgerde/Logo_CAE.png" alt="Inicio" class="logodeBarraNav"></a></li>
                    <li class="itemMenu"><a href="index.php"><img src="../img/imgsysgerde/meniu.png" alt="Menu" class="imgMenuCatResp"></a></li>

                    <!-- aqui se pueden agregar enlaces -->
                    <li class="itemMenu"><a href="index.php" class="itemInicio">Inicio</a></li>
                    <li class="itemMenu"><a href="">Docentes</a></li>
                    <li class="itemMenu"><a href="">Alumnos</a></li>
                    <li class="itemMenu"><a href="">Valores</a></li>
                    <!-- formulario de busqueda  -->
                    <form action="<?PHP echo $_SERVER["PHP_SELF"]; ?>" method="GET">
                        <input type="text" placeholder="Introduce tu busqueda" id="areaBuscar" name="elementoBuscar">
                        <input type="submit" name="buscar" value="buscar" class="itemMenu" id="btnBuscar">
                    </form>

                    <!-- nombre de usuario admin con su imagen personal -->
                    <li class="itemMenu" id="datosPersonales">
                        <a href="datosPersonales.php" class="">
                            <figure><img src="../img/imgsysgerde/perfil.jpg" alt="FotoAdm" class="imgAdmin">
                                <figcaption class="nombreUsr"><?PHP echo $name ?></figcaption>
                            </figure>
                        </a>
                    </li>



                    <li class="elemenu"><a href="../SessionClose.php"><img src="../img/imgsysgerde/cerrarSesion.png" alt="Cerrar Sesion" class="imgCcerrarSes"></a></li>




                </ul>
            </nav>
        </div>

        <!-- colocamos divs para contener las cards de los cursos-->
        <h1>Registro Docente</h1>

        <div class="seccion__main" style="display: flex; justify-content: flex-start;">
               
            <div class="content__modal--table">
                <div class="cont__form">
                    <form action="registraUsr.php" method="POST" class="formReg" id="formulario">
                        <h2 class="form_titleReg">Ingresa los datos </h2>

                        <input type="hidden" name="valor">
                        <div class="form_containerReg">
                            <div class="form_groupReg">
                                <input type="text" id="name" class="form_inputReg" placeholder=" " name="nombreUsr" required>
                                <label for="name" class="form_labelReg">Nombre:</label>
                                <span class="form_lineReg"></span>
                            </div>

                            <div class="form_groupReg">
                                <input type="text" id="apepat" class="form_inputReg" placeholder="  " name="apePatUsr">
                                <label for="apepat" class="form_labelReg">Apellido Paterno:</label>
                                <span class="form_lineReg"></span>
                            </div>

                            <div class="form_groupReg">
                                <input type="text" id="apemat" class="form_inputReg" placeholder=" " name="apematUser" required>
                                <label for="apemat" class="form_labelReg">Apellido Materno:</label>
                                <span class="form_lineReg"></span>
                            </div>

                            <div class="form_groupReg">
                                <input type="text" id="correo" class="form_inputReg" placeholder=" " name="mailUser" required>
                                <label for="correo" class="form_labelReg">Correo Electronico:</label>
                                <span class="form_lineReg"></span>
                            </div>

                            <div class="form_groupReg">
                                <input type="password" id="pass" class="form_inputReg" placeholder=" " name="passUser" required>
                                <label for="pass" class="form_labelReg">Contraseña:</label>
                                <span class="form_lineReg"></span>
                            </div>

                            <div class="form_groupReg">
                                <input type="password" id="passConf" class="form_inputReg" placeholder=" " name="confPassUser" required>
                                <label for="passConf" class="form_labelReg">Confirma contraseña:</label>
                                <span class="form_lineReg"></span>
                            </div>


                            <div class="btnFormUsr">
                                <input type="submit" class="form_submiRegUsr" value="Registrar" name="registraUsuario">
                                <input type="button" onclick="location.href='../index.php';" value="Cancelar" class="form_cancelRegUsr">

                            </div>

                        </div>
                    </form>

                </div>
            </div>
            <div class="content__tabla">
                <table>
                    <thead>
                        <caption>
                            <h2 class="tituloTest"></h2>
                        </caption>
                        <tr>
                            <th>Nombre </th>
                            <th>Apellidos</th>
                            <th>Correo</th>

                        </tr>
                    </thead>

                    <tbody id="tbody">
                        <tr>
                            <td> </td>

                        </tr>
                    </tbody>




                </table>

            </div>
            <script src="crudUsers.js"></script>
        </div>


        <div class="aside"></div>
        <div class="patas">
            <!-- Estructura del pie de pagina-->
            <div class="patas1">
                <!-- imagen y enlace a twiter-->
                <div class="itemfoot">
                    <a href="" id="twit"><img src="../img/imgsysgerde/twiter.png" alt="twiter"></a>



                </div>
                <!-- imagen y enlace a facebook-->
                <div class="itemfoot">
                    <a href="" id="faceb"><img src="../img/imgsysgerde/face.png" alt="facebook"></a>


                </div>

                <!-- imagen y enlace a whatsap-->
                <div class="itemfoot">
                    <a href="" id="wasap"><img src="../img/imgsysgerde/what.png" alt="Whatsap"></a>

                </div>

                <!-- imagen y enlace a telefono-->
                <div class="itemfoot">
                    <a href="tel:5547962022" id="phone"><img src="../img/imgsysgerde/tel.png" alt="Tel"></a>


                </div>

                <!-- imagen y enlace a maps-->
                <div class="itemfoot">
                    <a href="https://www.google.com/maps/place/Escuela+Albert+Einstein/@17.10813,-96.766385,16z/data=!4m5!3m4!1s0x0:0xbcba480ed497fd1c!8m2!3d17.1065512!4d-96.7669967?hl=es" id="map"><img src="../img/imgsysgerde/maps.png" alt="Maps"></a>

                </div>
            </div>
            <div class="patas2">
                <p> © Colegio Albert Einstein Oaxaca 2022. Todos los derechos reservados</p>

            </div>

        </div>


    </div>




</body>

</html>