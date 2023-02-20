<?PHP
//se inicia o se reanuda la sesion cualquiera de las 2 posibilidades
session_start();

// Si existe una variable de sesión 'LAST_ACTIVITY' y ha pasado más de 15 minutos desde la última actividad
if(isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
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
    <link rel="shortcut icon" href="../img/imgsysgerde/Logo_CAE.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../CSS/adminStyle.css">
    <title>SysGeRDE</title>
</head>

<body class="background">
    <!-- barra de navegacion con bootstrap -->
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="../img/imgsysgerde/Logo_CAE.png" alt="Albert Einstein">
            </a>
            <ul class="navbar-nav ms-lg-auto">
                <li class="nav-item">
                    <span class="nav-link" aria-current="page" href="index.php"><i class="bi bi-person-gear">Administrador: <?PHP echo $name ?></i> </span>
                </li>
            </ul>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation ">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-lg-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="catalogo.php">Catalogo</a>
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


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="../img/imgsysgerde/perfil.jpg" alt="FotoAdm" class="imgAdmin">

                        </a>
                        <div class="menu-container">
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="perfilAdmin.php">Mi perfil</a></li>
                                <li><a class="dropdown-item" href=""></a></li>
                                <li><a class="dropdown-item" href="../loginUsuarios/SessionClose.php"><b>Cerrar Sesión</b></a></li>
                            </ul>
                        </div>

                    </li>



                </ul>
            </div>
        </div>
    </nav>




    <!-- colocamos divs para contener las cards de los cursos-->
    <div class="cardCurso ">


        <div class="card">
            <div class="card-header">
                <h2 class="opcAdm_titulo">Catalogo de Cursos</h2>
            </div>
            <div class="card-body">
                <div class="imagenCurso"><a href="catalogo.php"><img src="../img/imgsysgerde/catalogo.png" alt=""></a>
                </div>

            </div>
            <div class="card-footer">

                <div class="administra"><a href="catalogo.php"><img src="../img/imgsysgerde/administrar.png" alt="Editar"></a></div>


            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="opcAdm_titulo">Administrar Cursos</h2>
            </div>
            <div class="card-body">
                <div class="imagenCurso"><a href="tblActualizarCurso.php"><img src="../img/imgsysgerde/editarCurso.png" alt=""></a>
                </div>
                <div class="descripcionCurso">

                </div>
            </div>
            <div class="card-footer">

                <div class="administra"><a href="tblActualizarCurso.php"><img src="../img/imgsysgerde/administrar.png" alt="Editar"></a></div>


            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="opcAdm_titulo">Administrar Temas</h2>
            </div>
            <div class="card-body">
                <div class="imagenCurso"><a href="formActualizaTema.php"><img src="../img/imgsysgerde/editaTema.png" alt="Administrar Temas"></a>
                </div>
                <div class="descripcionCurso">

                </div>
            </div>
            <div class="card-footer">

                <div class="administra"><a href="formActualizaTema.php"><img src="../img/imgsysgerde/administrar.png" alt="Editar"></a></div>


            </div>
        </div>


        <div class="card">
            <div class="card-header">
                <h2 class="opcAdm_titulo">Administrar Test</h2>
            </div>
            <div class="card-body">
                <div class="imagenCurso"><a href=""><img src="../img/imgsysgerde/actTest.png" alt="Administrar Test"></a>
                </div>
                <div class="descripcionCurso">

                </div>
            </div>
            <div class="card-footer">

                <div class="administra"><a href=""><img src="../img/imgsysgerde/administrar.png" alt="Editar"></a></div>


            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="opcAdm_titulo">Mi Perfil</h2>
            </div>
            <div class="card-body">
                <div class="imagenCurso"><a href="perfilAdmin.php"><img src="../img/imgsysgerde/perfil.png" alt="Mi perfil"></a>
                </div>
                <div class="descripcionCurso">

                </div>
            </div>
            <div class="card-footer">

                <div class="administra"><a href=""><img src="../img/imgsysgerde/administrar.png" alt="Editar"></a></div>


            </div>
        </div>

    </div>

    





    <footer class="bg-dark p-3">
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