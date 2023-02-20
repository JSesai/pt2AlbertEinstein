<?PHP
//se inicia o se reanuda la sesion cualquiera de las 2 posibilidades
session_start();

// Si existe una variable de sesión 'LAST_ACTIVITY' y ha pasado más de 15 minutos desde la última actividad
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800) ) {
    //redirige al archivo que destruye la sesion y rediracciona al login
    header("Location:../loginUsuarios/sessionExpired.php");
}elseif (!isset($_SESSION["usuario"])&&($_SESSION['tpoUser']!='Administrator')) { //validamos si no existe la sesion con usuario y la sesion es distinta de directivo se expira la sesion
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
    <link rel="stylesheet" href="../CSS/styles2.css">
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

        


        <div class="listaTest">

            <ul class="exam-form">
                <input type="button" value="Nuevo Test" id="nuevoTest">
                <h2>Lista de test</h2>
                <li>test 1</li>
                <li>test 2</li>
                <li>test 3</li>

            </ul>
        </div>

        <table class="tabla">
                <caption>
                    <h2>Nombre del test</h2>
                </caption>
                <tr class="cabeceraCursos">

                    <!-- cabeceras de la tabla  -->

                    <th class="">Numero</th>
                    <th class="">Pregunta</th>
                    <th class="">Opción 1</th>
                    <th class="">Opción 2</th>
                    <th class="">Opción 3</th>
                    <th class="">Opción 4</th>
                    <th class="">Opción correcta</th>

                </tr>

                <!-- Mostramos contenido de tabla cursos de la BD -->
                <?PHP

                //empleamos un foreach para repetir la estructura de la tabla para cada registro y mostrarlos en pantalla
                foreach ($registros as $cursos) : ?>
                    <tr class="rowTabCursos">
                        <!--mostramos numero de la pregunta en la tabla  -->
                        <td class=""><input type="text" value="<?PHP echo $cursos->nombre_curso ?>"></td>
                        <!-- mostramos pregunta del test -->
                        <td class=""><input type="text" value="<?PHP echo $cursos->descripcion_curso ?>"></td>
                        <!-- mostramos opciones de respuesta de la pregunta -->
                        <td class=""><input type="text" value="<?PHP echo $cursos->valor ?>"require></td>
                        <td class=""><input type="text" value="<?PHP echo $cursos->valor ?>"require></td>
                        <td class=""><input type="text" value="<?PHP echo $cursos->valor ?>"require></td>
                        <td class=""><input type="text" value="<?PHP echo $cursos->valor ?>"require></td>
                        <!-- respuesta correcta de la pregunta -->
                        <td class=""><input type="number" value="<?PHP echo $cursos->valor ?>"></td>
                    
                        <!--botones para actualizar y borrar pregunta del test -->
                        <td><input type="button" value="actualizar" name="actualizaPregunta"></td>
                        <td><input type="button" value="Borrar" name="borrarPregunta"></td>
                        



                      
                    </tr>
                <?PHP
                //cerramos el bucle
                endforeach;

                ?>
            </table>
        


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



    <script src="test.js"></script>
</body>

</html>