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
    //recuperamos el Id y guardamos en variable
    $idTem = $_GET["id"];


    //llamamos al archivo donde se efectua la conexion a la BD
    include("../conectBD/Conexion.php");

    // //hacemos una consulta a la tabla de cursos para extraer los temas del curso seleccionado
    // $registros = $bds->query('SELECT  FROM tema WHERE id_curso=' . $idTem)->fetchAll(PDO::FETCH_OBJ);

    //para usarlo en la segunda consulta 
    $sql2= 'SELECT vCont_tema, id_curso  FROM tema WHERE id_tema=:m_nomTem';
    $res = $bds->prepare($sql2);
    $res->execute(array(":m_nomTem" => $idTem));
    
    //guardamos el resultado en la varible registro
     $result= $res->fetch(PDO::FETCH_ASSOC); 
     //guardamos la direccion del video en variable
    $video= $result["vCont_tema"];
    $idCurso= $result["id_curso"];
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
                    <li class="itemMenu"><a href="cursoMochila.php?id=<?php echo $idCurso?>">Temas</a></li>

                    <li class="itemMenu"><a href=""></a></li>
                    <li class="itemMenu"><a href=""></a></li>

                    <li class="itemMenu"><a href=""></a></li>
                    <li class="itemMenu"><input type="text" placeholder="Buscar" class="buscador"></li>
                    <li class="itemMenu">
                        <p class="nombreUsr"><?PHP echo $name ?></p>
                    </li>
                    <li class="itemMenu"><a href="datosPersonales.php"><img src="" alt="FotoAdm"></a></li>
                    <li class="itemMenu"><a href="../SessionClose.php">Cerrar Sesión</a></li>


                </ul>
            </nav>
        </div>


        
        <!-- colocamos divs para contener el reproductor de video-->
        <div class="cont_repr">


        
        

        <video controls  autoplay class="reproductor">
            <source src="../video/<?php echo $video ?>" type="video/mp4">
        </video>



           





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