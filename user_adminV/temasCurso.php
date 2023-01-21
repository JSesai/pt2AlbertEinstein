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

    $idCurso = $_GET["id"];


    //llamamos al archivo donde se efectua la conexion a la BD
    include("../conectBD/Conexion.php");

    //hacemos una consulta a la tabla de cursos para extraer los temas del curso seleccionado
    $registros = $bds->query('SELECT * FROM tema WHERE id_curso=' . $idCurso)->fetchAll(PDO::FETCH_OBJ);

    //empleamos un foreach para recorrer el array y poder obtener los valores de los campos de la tabla 
    // foreach ($registros as $tema) {
    // }
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
            <nav style="background-color: #1A3C40;" id="barraNavega">
                <input type="checkbox" name="" id="btnMenu" class="check">
                <label for="btnMenu" class="btnMenu"><img src="../img/imgsysgerde/meniu.png" alt="Menu"></label>
                <ul class="items" style="background-color: #1A3C40;">
                    <li class="itemMenu"><a href="index.php"><img src="../img/imgsysgerde/Logo_CAE.png" alt="Inicio" class="logodeBarraNav"></a></li>
                    <li class="itemMenu"><a href="index.php">Inicio</a></li>

                    <li class="itemMenu"><a href="">Ofertas</a></li>
                    <li class="itemMenu"><a href="">Contacto</a></li>

                    <li class="itemMenu"><a href="">Registrate</a></li>
                    <li class="itemMenu"><input type="text" placeholder="Buscar" class="buscador"></li>
                    <li class="itemMenu">
                        <p class="nombreUsr"><?PHP echo $name ?></p>
                    </li>
                    <li class="itemMenu"><a href="datosPersonales.php"><img src="" alt="FotoAdm"></a></li>
                    <li class="itemMenu"><a href="../SessionClose.php">Cerrar Sesión</a></li>


                </ul>
            </nav>
        </div>

      

        <!-- colocamos divs para contener las cards de los cursos-->
        <div class="cardCurso">
            
            <?PHP
            //empleamos un foreach para repetir la estructura de la tabla para cada registro y mostrarlos en pantalla
            foreach ($registros as $tema) : ?>
                <div class="card">
                    <div class="card-header">
                        <h2 class="opcAdm_titulo"><?php echo $tema->nombre_tema; ?></h2>
                    </div>
                    <div class="card-body">
                        <div class="imagenCurso"><a href="CursoVideo.php?id=<?php echo  $tema->id_tema ?>"><img src="../img/<?php echo $tema->img_tema ?>" alt="Imagen Tema" class="imgcard"></a>
                        </div>
                        <div class="descripcionCurso">

                        </div>
                    </div>
                    <div class="card-footer">

                        <div class="administra"><a href=""><img src="../img/imgsysgerde/newTest.png" alt="Examen"></a></div>
                        <div class="administra"><a href="CursoVideo.php?id=<?php echo  $tema->id_tema ?>"><img src="../img/imgsysgerde/play.png" alt="Play"></a></div>


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
            
            <div class="patas2">
                <p> © Colegio Albert Einstein Oaxaca 2022. Todos los derechos reservados</p>
            </div>

        </div>


    </div>




</body>

</html>