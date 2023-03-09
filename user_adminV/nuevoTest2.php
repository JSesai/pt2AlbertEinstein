<?PHP
//se inicia o se reanuda la sesion cualquiera de las 2 posibilidades
session_start();

// Si existe una variable de sesión 'LAST_ACTIVITY' y ha pasado más de 15 minutos desde la última actividad
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    //redirige al archivo que destruye la sesion y rediracciona al login
    header("Location:../loginUsuarios/sessionExpired.php");
} elseif (!isset($_SESSION["usuario"]) && ($_SESSION['tpoUser'] != 'Administrator')) { //validamos si no existe la sesion con usuario y la sesion es distinta de directivo se expira la sesion
    //redirige al archivo que destruye la sesion y rediracciona al login
    header("Location:../loginUsuarios/sessionExpired.php");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/styleTest.css">

    <title>SysGeRDE</title>
</head>

<body>
    <div class="container">


        <div class="menu">
            <nav>
                <input type="checkbox" name="" id="btnMenu" class="check">
                <label for="btnMenu" class="btnMenu"><img src="../img/imgsysgerde/meniu.png" alt="Menu"></label>
                <ul class="items">
                    <li class="itemMenu"><a href="index.php"><img src="" alt="Inicio" class="logodeBarraNav"></a></li>
                    <li class="itemMenu"><a href="index.php"><img src="../img/imgsysgerde/meniu.png" alt="Menu" class="imgMenuCatResp"></a></li>

                    <!-- aqui se pueden agregar enlaces -->
                    <li class="itemMenu"><a href="index.php" class="itemInicio">Inicio</a></li>
                    <li class="itemMenu"><a href="index.php">Inicio</a></li>
                    <li class="itemMenu"><a href="">Visión</a></li>
                    <li class="itemMenu"><a href="">Valores</a></li>


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

        <div class="selecciona">
             <select class="listCursos" id="listCursos">
                <option>Selecciona el curso</option>
              
            </select>
        </div>

        <div class="header">
            <div class="contenedor__botones">
                <input type="button" value="Test Actuales">
                <input type="button" value="Agregar nueva pregunta" id="nuevaPregunta">
                <input type="button" value="Nuevo test" id="nuevoTest">
            </div>

        </div>

        <div class="aside">
            <div class="contenedor_formulario__test">
                <form action="probando2.php" id="formulario" method="POST">
                    <div id="alertaForm"></div>
                    <h2 class="titulo__modal__preguntas">Ingrese las Preguntas</h2>
                    <input type="hidden" name="idPregunta" id="idPregunta">
                    <label for="pregunta" class="etiqueta_input">Pregunta</label>
                    <input type="text" class="input_form" placeholder="Ingresa la pregunta" name="pregunta" id="pregunta" required autocomplete="off">
                    <label for="resp_ok" class="etiqueta_input">Respuesta correcta</label>
                    <input type="text" class="input_form" name="resp_ok" id="resp_ok" placeholder="Ingresa la respuesta correcta" required autocomplete="off">
                    <label for="op1" class="etiqueta_input">Opcion 1</label>
                    <input type="text" class="input_form" name="op1" id="op1" placeholder="ingresa la opcion 1" required autocomplete="off">
                    <label for="op2" class="etiqueta_input">Opcion 2</label>
                    <input type="text" class="input_form" name="op2" id="op2" placeholder="ingresa la opcion 2" required autocomplete="off">
                    <label for="op3" class="etiqueta_input">Opcion 3</label>
                    <input type="text" class="input_form" name="op3" id="op3" placeholder="ingresa la opcion 3" required autocomplete="off">


                    <button class="btn-close">&times;</button>
                    <!-- resto del contenido del modal -->



                    <input type="submit" name="addPreg" value="Guardar" class="modal__btnAgregaPreg">
                    <button class="saveAdd">Guardar y seguir agregando</button>

                </form>


            </div>
        </div>



        <div class="contenedor__tabla--preguntas-test">

            <table>
                <thead>
                    <caption>
                        <h2 class="tituloTest"></h2>
                    </caption>
                    <tr>
                        <th>Pregunta</th>
                        <th>Opciones</th>

                    </tr>
                </thead>
                <!-- fragmento cargado dinamicamente con vanilla js -->
                <tbody id="tbody">
                    <tr>
                        <td> </td>

                    </tr>
                    <tr>
                        <ul id="listaTest">
                            <!-- lista dinamica cargada desde js test -->
                        </ul>
                    </tr>
                </tbody>




            </table>
        </div>

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



    <script src="js/test.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/alert.js"></script>


</body>

</html>