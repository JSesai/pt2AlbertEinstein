<?PHP
//se inicia o se reanuda la sesion cualquiera de las 2 posibilidades
session_start();


//validamos si no hay nada almacenado informacion en la variable global SESSION
if (!isset($_SESSION["usuario"])) {
    header("Location:../fLogin.php");
} else {

    //recuperamos variables globales las almacenamos en locales para uso en este ambito
    //almacena el id del usuario
    $user = $_SESSION["IdUser"];
    //almacena el nombre del usuario
    $name = $_SESSION["usuario"];


    //llamamos al archivo donde se efectua la conexion a la BD
    include("../conectBD/Conexion.php");

    //hacemos una consulta atraves de inner join
    //llamamos al archivo donde se efectua la conexion a la BD

    $registros = $bds->query('SELECT curso.id_curso, curso.nombre_curso, curso.descripcion_curso, curso.imgCurso FROM curso INNER JOIN curso_alumno ON curso.id_curso= curso_alumno.id_curso INNER JOIN alumno ON curso_alumno.id_matricula = alumno.id_matricula WHERE alumno.id_matricula=' . $user)->fetchAll(PDO::FETCH_OBJ);
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
    <title>SysGeRDE</title>
</head>

<body>
    <div class="container" style="background-color:#105652;">


        <div class="menu">
            <nav>
                <input type="checkbox" name="" id="btnMenu" class="check">
                <label for="btnMenu" class="btnMenu"><img src="../img/imgsysgerde/meniu.png" alt="Menu"></label>
                <ul class="items">
                    <li class="itemMenu"><a href="index.php"><img src="../img/imgsysgerde/Logo_CAE.png" alt="Inicio" class="logodeBarraNav"></a></li>
                    <li class="itemMenu"><a href="index.php"><img src="../img/imgsysgerde/meniu.png" alt="Menu" class="imgMenuCatResp"></a></li>

                    <!-- aqui se pueden agregar enlaces -->
                    <li class="itemMenu"><a href="index.php" class="itemInicio">Inicio </a></li>
                    <li class="itemMenu"><a href="formNewCur.php"></a></li>
                    <li class="itemMenu"><a href="formNewCur.php"></a></li>


                    <li class="itemMenu"><input type="text" placeholder="Buscar" id="buscar"></li>
                    <li class="elemenu"><a href=""><img src="../img/users/admin/charmanderAdm.png" alt="Mi perfil" class="imgPerfil">
                            <figcaption id="usuario" class="nombreUsr"><?PHP echo "Alumno: " . $name ?></figcaption>
                        </a>

                    </li>



                    <li class="elemenu"><a href="../SessionClose.php"><img src="../img/imgsysgerde/cerrarSesion.png" alt="Cerrar Sesion" class="imgCcerrarSes"></a></li>




                </ul>
            </nav>
        </div>

        <!-- colocamos divs para contener las cards de los cursos-->


        <!-- colocamos divs para contener las cards de los cursos-->


        <div class="cardCurso">
            <?PHP
            //empleamos un foreach para repetir la estructura de la tabla para cada registro y mostrarlos en pantalla
            foreach ($registros as $cursos) : ?>
                <div class="card">
                    <div class="card-header">
                        <h1 class="card_titulo"><?PHP echo $cursos->nombre_curso ?></h1>
                    </div>
                    <div class="card-body">
                        <div class="imagenCurso"><img src="../img/<?php echo $cursos->imgCurso ?>" alt="" class="imgcard">
                        </div>
                        <div class="descripcionCurso">
                            <p><?PHP echo $cursos->descripcion_curso ?></p>

                        </div>
                    </div>
                    <div class="card-footer">
                      
                        <!-- ingresa a pagina que contiene los temas,  pasa el id en el enlace atraves de la url  -->
                        <div class="mochila"><a href="CursoVideoAl.php?id=<?php echo $cursos->id_curso ?>"><img src="../img/imgsysgerde/entraAula.png" alt="Cursar"></a></div>
                       

                    </div>
                </div>
            <?PHP
            //cerramos el bucle
            endforeach;

            ?>



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
                <p> ?? Colegio Albert Einstein Oaxaca 2022. Todos los derechos reservados</p>

            </div>

        </div>


    </div>



    <script src="aula.js"></script>
</body>

</html>