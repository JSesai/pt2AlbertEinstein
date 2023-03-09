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
    $imgPerfil = $_SESSION["imgPerfil"];
    $correo= $_SESSION["correo"];
    // echo $imgPerfil;
    
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
                    <a class="nav-link active" aria-current="page" href="index.php" id="idAdm" item="<?php echo $user ?> "><i class="bi bi-person-gear"> <?PHP echo $name ?>: </i> Administra tu Perfil</a>
                </li>
            </ul>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation ">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-lg-auto">

                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Inicio</a>
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
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="perfilImg">
                            <img src="../datosPerfiles/imageProfile/<?php echo $imgPerfil?>" alt="FotoAdm" class="img-profile" onerror="this.onerror=null; this.src='../img/imgsysgerde/perfil.jpg'">


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
    

    <!-- consulta codigo postal 
    <form id="formCp" action="">
        <input type="text" id="cp">
        <button type="submit">CP</button>
    </form> -->

    <div class="row vh-100">

        <ul class="nav flex-column col-2 bg-dark border-top border-dark" id="mnuLateral">

            <a href="#" class="text-end fs-3 p-2" id="btnEditAside"><i class="bi bi-arrow-left-circle-fill"></i></a>
            
            <li class="nav-item">
                <!-- <a class="nav-link" id="enlace1" href="#"><h6>Información personal <i class="bi bi-person-bounding-box"></i></h6></a> -->
                <a class="nav-link" href="#"><h6 id="enlace1">Información personal</h6></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><h6 id="enlace2">Información de domicilio</h6></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><h6 id="enlace3">Información de contacto</h6></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><h6 id="enlace4">Administra contraseña</h6></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><h6 id="enlace5">Prueba de modales y cp</h6></a>
            </li>

        </ul>



        <!-- contenido de vh que vamos a mostrar -->
        <div class="col-8 col-md-8 col-lg-9">
            <div class="container-fluid" id="contenido">
               
                
                <h1 class="text-center"></h1>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script>
      
    </script>

    <script src="js/aside.js"></script>   
    <script src="js/buscarCpostal.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</script> 

    
</body>

</html>