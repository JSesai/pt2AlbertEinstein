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

    $idCurso = "";
    //recuperamos variables globales las almacenamos en locales para uso en este ambito
    //almacena el id del usuario
    $user = $_SESSION["IdUser"];
    //almacena el nombre del usuario
    $name = $_SESSION["usuario"];

    // Asigna el tiempo actual a la variable de sesión 'LAST_ACTIVITY'
    $_SESSION['LAST_ACTIVITY'] = time();

    //llamamos al archivo donde se efectua la conexion a la BD
    include("../conectBD/Conexion.php");


    //comprobamos si existe el id que corresponde al id del curso enviado por get, este existe la primera vez que es cargada la pagina 

    if (isset($_GET["id"]) && isset($_GET["curso"])) {

        $idTema = $_GET["id"];
        $idCurso = $_GET["curso"];
        //echo 'existe id curso : ' . $idCurso . ' y existe id tema: ' . $idTema;


        //Hacemos una consulta uniendo 2 tablas para recuperar los datos en el select se indican los campos que desea seleccionar de ambas tablas, from->nombre tabla inner join unir internamente, nombre de tabla a unir on columnas relacionadas     
        $registros = $bds->query('SELECT curso.nombre_curso, curso.imgCurso, tema.nombre_tema, tema.vCont_tema, tema.id_tema FROM curso INNER JOIN tema ON tema.id_curso=curso.id_curso WHERE curso.id_curso=' . $idCurso)->fetchAll(PDO::FETCH_OBJ);

        //nmbre del curso
        $curso = $registros[0]->nombre_curso;
        //imagen del curso
        $imagenCurso = $registros[0]->imgCurso;

        //otro select de la tabla temas * where id_tema = record
        //hacemos una consulta a la tabla de cursos para extraer los temas del curso seleccionado
        $registros2 = $bds->query('SELECT * FROM tema WHERE id_tema=' . $idTema)->fetchAll(PDO::FETCH_OBJ);



        $video = $registros2[0]->vCont_tema;
        $nameTema = $registros2[0]->nombre_tema;
    }
}
?>



<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/imgsysgerde/logo2.png" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/admon.css">
    <title>SysGeRDE</title>
</head>

<body>
    <div class="container" style="background-color: #125B50;">


        <div class="menu" style="background-color: #1A3C40;">
            <nav style="background-color: #1A3C40;">
                <input type="checkbox" name="" id="btnMenu" class="check">
                <label for="btnMenu" class="btnMenu"><img src="../img/imgsysgerde/meniu.png" alt="Menu"></label>
                <ul class="items" style="background-color: #1A3C40;">
                    <li class="itemMenu"><a href="index.php"><img src="../img/imgsysgerde/Logo_CAE.png" alt="Inicio" class="logodeBarraNav"></a></li>
                    <li class="itemMenu"><a href="temasCurso.php?id=<?php echo $idCurso ?>">Temas</a></li>

                    <li class="itemMenu"><a href=""></a></li>
                    <li class="itemMenu"><a href=""></a></li>

                    <li class="itemMenu"><a href=""></a></li>
                    <li class="itemMenu"><input type="text" placeholder="Buscar" class="buscador"></li>

                    <li class="itemMenu"><a href="datosPersonales.php"><img src="" alt="FotoAdm">
                            <figcaption><?PHP echo $name ?></figcaption>
                        </a></li>
                    <li class="itemMenu"><a href="../SessionClose.php">Cerrar Sesión</a></li>


                </ul>
            </nav>
        </div>



        <!-- colocamos divs para contener el reproductor de video-->
        <div class="cont_repr">
            <div class="contenedor-temas">


                <div class="header--aside">

                    <div class="aside--menu__img--responsive">
                        <img src="../img/imgsysgerde/ocultarMenu.svg" alt="Imgagen MenuR" id="menu__img--responsive">
                    </div>
                    <div class="aside--titulo__cursoImagen">
                        <!-- parrafo que contien el nombre del curso que es cargado de manera dinamica desde el java script -->
                        <img class="img__curso--miniatura" src="../img/<?php echo $imagenCurso ?>" alt="">
                        <p id="nomCurso"><?php echo $curso ?></p>


                    </div>
                    <div class="aside--barraProgresoCurso">
                        <div class="porcentaje"></div>
                        <div class="barraProgreso"></div>

                    </div>
                </div>


                <div class="aside--body">

                    <div class="aside--body__item"></div>

                    <ul id="listaTemas">
                        <?php foreach ($registros as $temaCurso) : ?>



                            <!-- carga los temas de manera dinamica con la consulta que se hizo a la bd  el item guarda el id-->
                            <li class="item-list-temas">
                                <a href="CursoVideo.php?id=<?php echo  $temaCurso->id_tema ?>&curso=<?php echo $idCurso; ?>" class="nav-item-video">
                                    <svg src="../img/imgsysgerde/video.png" alt="Video" class="aside--lista__temas-imagen"></svg>
                                    <span class="item--numero__tema"></span>
                                    <span class="item--describcion__tema">
                                        <span class="item--titulo__tema"><?php echo $temaCurso->nombre_tema ?></span>
                                    </span>
                                    <span class="item--info">
                                        <span class="item--info__duracion"></span>
                                    </span>


                                </a>
                            </li>


                        <?php endforeach ?>


                    </ul>


                </div>

            </div>



            <div id="contenedor-video">
                <span class="btn__prox--actividad">
                    <p><input type="button" value="Proxima Actividad"></p>
                </span>
                <h2>Tema: <?php echo $nameTema ?></h2>
                <video controls autoplay class="reproductor">
                    <source src="../video/<?php echo $video ?>" type="video/mp4">

                </video>

            </div>


        </div>







        <div class="patas">
            <!-- Estructura del pie de pagina-->

            <div class="patas2">
                <p> © Colegio Albert Einstein Oaxaca 2022. Todos los derechos reservados</p>
            </div>

        </div>


    </div>



    <script src="js/cursoMochila.js"></script>
</body>

</html>