<?PHP
session_start();  //se inicia o se reanuda la sesion cualquiera de las 2 posibilidades

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

//si no se ha presionado el boton submit llamado buscar, entonces esta vacio y entra al if
if (empty($_GET["buscar"])) {
    $registros= allCurs(); //mostramos todos los cursos
    

    
} else {
    //obtiene lo que se ha escrito el input text de busqueda y lo guarda en $busqueda
    $busqueda = $_GET["elementoBuscar"];

    //llamamos al archivo donde se efectua la conexion a la BD
    include("../conectBD/Conexion.php");
    //hacemos una consulta a la tabla de cursos con el criterio de busqueda

    $registros = $bds->query("SELECT * FROM curso WHERE estatusCurso= 'activo' AND nombre_curso LIKE '%$busqueda%'")->fetchAll(PDO::FETCH_OBJ);
    
    $num_registros = count($registros);  //contamos los registros devueltos
    if($num_registros==0){ //si no existe ningun registro
        $registros= allCurs(); //se carga todos los cursos
        
    }

    //echo "Se encontraron $num_registros registros.";
}
//metodo que carga todos los cursos
function allCurs(){
     //llamamos al archivo donde se efectua la conexion a la BD
     include("../conectBD/Conexion.php");
     //consulta a la tabla de cursos para mostrar todos los cursos que estan activos
    return $bds->query('SELECT * FROM curso WHERE estatusCurso= "activo"')->fetchAll(PDO::FETCH_OBJ);
   
}
?>


<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/imgsysgerde/Logo_CAE.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../CSS/adminStyle.css">


    <title>SysGeRDE</title>
</head>

<body class="gradiente">
    <!-- barra de navegacion con bootstrap -->
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="../img/imgsysgerde/Logo_CAE.png" alt="Albert Einstein">
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation ">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-lg-auto">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="clientes.html">Catalogo</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Administrar
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="sitios.html#ultimos-proyectos"><i>Cursos</i></a></li>
                            <li><a class="dropdown-item" href="sitios.html#single-page"><i>Temas</i></a></li>
                            <li><a class="dropdown-item" href="sitios.html#multi-page"><i>Pruebas- Test</i></a></li>

                        </ul>
                    </li>

                    <form action="<?PHP echo $_SERVER["PHP_SELF"]; ?>" method="GET" class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Nombre del curso" aria-label="Search" id="areaBuscar" name="elementoBuscar">
                        <input type="submit" name="buscar" value="buscar" class="btn btn-outline-warning" id="btnBuscar">
                        
                    </form>

                    <li class="nav-item">
                        <a class="nav-link" href="comencemos.html"><?PHP echo $name ?></a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="../img/imgsysgerde/perfil.jpg" alt="FotoAdm" class="img-profile">

                        </a>
                        <div class="menu-container">
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Mi perfil</a></li>
                                <li><a class="dropdown-item" href=""></a></li>
                                <li><a class="dropdown-item" href="../loginUsuarios/SessionClose.php"><b>Cerrar Sesión</b></a></li>
                            </ul>
                        </div>

                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <article class="min-vh-100">
    <div class="card-catalogo my-5">
        <?PHP
        //empleamos un foreach para repetir la estructura de la tabla para cada registro y mostrarlos en pantalla
        foreach ($registros as $cursos) : ?>
            <div class="contenedor-card">
                <div class="cabecera-card">
                    <h1 class="titulo-card"><?PHP echo $cursos->nombre_curso ?></h1>
                </div>
                <div class="card-body">
                    <div class="imagen-curso"><img src="../img/<?php echo $cursos->imgCurso ?>" alt="" class="imagen-catalogo-card">
                    </div>
                    <div class="descripcion-curso-catalogo">
                        <p class="fs-6 fst-normal"><?PHP echo $cursos->descripcion_curso ?></p>

                    </div>
                </div>
                <div class="card-footer-catalogo">
                    <div class="card-footercosto-catalogo"><a class="btn btn-primary btn-sm"><?PHP echo "$" . $cursos->valor ?></a></div>
                    <div class="card-footer-mochila-catalogo"><a href="" class="btn btn-success btn-sm"><img src="../img/imgsysgerde/mochila3.png" alt="Agregar a mochila"></a></div>
                    <div class="card-footer-mochila-catalogo"><a href="temasCurso.php?id=<?php echo $cursos->id_curso ?>" class="btn btn-success btn-sm"><img src="../img/imgsysgerde/entrar.png" alt="Entrar"></a></div>



                </div>
            </div>
        <?PHP
        //cerramos el bucle
        endforeach;

        ?>
    </div>
    </article>



    <!-- <div class="card-catalogo">
        <?PHP
        //empleamos un foreach para repetir la estructura de la tabla para cada registro y mostrarlos en pantalla
        foreach ($registros as $cursos) : ?>
            <div class="contenedor-card">
                <div class="cabecera-card">
                    <h1 class="titulo-card"><?PHP echo $cursos->nombre_curso ?></h1>
                </div>
                <div class="card-body">
                    <div class="imagenCurso"><img src="../img/<?php echo $cursos->imgCurso ?>" alt="" class="imgcard">
                    </div>
                    <div class="descripcion-curso">
                        <p><?PHP echo $cursos->descripcion_curso ?></p>

                    </div>
                </div>
                <div class="card-footer">
                    <div class="costo">
                        <p><?PHP echo "$" . $cursos->valor ?></p>
                    </div>
                    <div class="mochila"><a href=""><img src="../img/imgsysgerde/mochila3.png" alt="Agregar a mochila"></a></div>
                    <div class="mochila"><a href="temasCurso.php?id=<?php echo $cursos->id_curso ?>"><img src="../img/imgsysgerde/entrar.png" alt="Entrar"></a></div>



                </div>
            </div>
        <?PHP
        //cerramos el bucle
        endforeach;

        ?>



    </div> -->



    <footer class="bg-dark p-3 mt-5">
        <div class="container text-center">
            <nav class="fs-3 d-flex justify-content-evenly">
                <a href="https://facebook.com" target="_blank"><i class="bi bi-facebook"></i></a>
                <a href="https://twitter.com" target="_blank"><i class="bi bi-twitter"></i></a>
                <a href="https://youtube.com" target="_blank"><i class="bi bi-youtube"></i></a>
                <a href="https://instagram.com" target="_blank"><i class="bi bi-instagram"></i></a>
                <a href="https://m.me/user.com" target="_blank"><i class="bi bi-messenger"></i></a>
                <a href="https://api.whatsapp.com/send?phone=529513159711" target="_blank"><i class="bi bi-whatsapp"></i></a>
            </nav>
            <small class="text-white">&copy;2023. Colegio Albert Einstein Oaxaca 2023. Todos los derechos reservados</p> </small>

        </div>
    </footer>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>