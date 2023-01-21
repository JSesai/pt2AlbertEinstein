<?PHP
//se inicia o se reanuda la sesion cualquiera de las 2 posibilidades
session_start();


//validamos si no hay nada almacenado informacion en la variable global SESSION
if (!isset($_SESSION["usuario"])) {
    header("Location:../login.php");
} else {

    //recuperamos variables globales las almacenamos en locales para uso en este ambito
    //almacena el id del usuario
    $user = $_SESSION["IdUser"];
    //almacena el nombre del usuario
    $name = $_SESSION["usuario"];
}

//si no se ha presionado el boton submit llamado buscar, entonces esta vacio y entra al if
if (empty($_GET["buscar"])) {


    //llamamos al archivo donde se efectua la conexion a la BD
    include("../conectBD/Conexion.php");
    //hacemos una consulta a la tabla de cursos para mostrar todos los cursos
    $registros = $bds->query('SELECT * FROM curso WHERE estatusCurso= "activo"')->fetchAll(PDO::FETCH_OBJ);
} else {
    //obtiene lo que se ha escrito el input text de busqueda y lo guarda en $busqueda
    $busqueda = $_GET["elementoBuscar"];

    //llamamos al archivo donde se efectua la conexion a la BD
    include("../conectBD/Conexion.php");
    //hacemos una consulta a la tabla de cursos con el criterio de busqueda

    $registros = $bds->query("SELECT * FROM curso WHERE estatusCurso= 'activo' AND nombre_curso LIKE '%$busqueda%' ")->fetchAll(PDO::FETCH_OBJ);
}


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
    <div class="container">


        <div class="menu">
            <nav>
                <input type="checkbox" name="" id="btnMenu" class="check">
                <label for="btnMenu" class="btnMenu"><img src="../img/imgsysgerde/meniu.png" alt="Menu"></label>
                <ul class="items">
                    <li class="itemMenu"><a href="index.php"><img src="../img/imgsysgerde/Logo_CAE.png" alt="Inicio" class="logodeBarraNav"></a></li>
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


        <div class="aside">
            <div class="testTemas">
                <h2>Test Actuales</h2>
            </div>
            <div class="listaTesta">
            

                <ul id="listaTest"></ul>
            <input type="button" value="Actualizar Test" id="nuevoTest">
            </div>
        </div>

        <div class="contenedor_formulario">
            <form action="probando2.php" id="formulario" method="POST">
                <div id="alertaForm"></div>
                <h2 class="">Ingrese las Preguntas</h2>
                <input type="hidden" name="idPregunta"  id="idPregunta">
                <label for="pregunta" class="etiqueta_input">Pregunta</label>
                <input type="text" class="input_form" placeholder="Ingresa la pregunta" name="pregunta" id="pregunta" required>
                <label for="resp_ok" class="etiqueta_input">Respuesta correcta</label>
                <input type="text" class="input_form" name="resp_ok" id="resp_ok" placeholder="Ingresa la respuesta correcta" required>
                <label for="op1" class="etiqueta_input">Opcion 1</label>
                <input type="text" class="input_form" name="op1" id="op1" placeholder="ingresa la opcion 1" required>
                <label for="op2" class="etiqueta_input">Opcion 2</label>
                <input type="text" class="input_form" name="op2" id="op2" placeholder="ingresa la opcion 2" required>
                <label for="op3" class="etiqueta_input">Opcion 3</label>
                <input type="text" class="input_form" name="op3" id="op3" placeholder="ingresa la opcion 3" required>

                <input type="submit" name="addPreg" value="Agregar" class="btnAgregaPreg">
            </form>


        </div>

        <div class="conTabla">
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

                <tbody id="tbody">
                    <tr>
                        <td> </td>

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



    <script src="test.js"></script>

   
</body>

</html>