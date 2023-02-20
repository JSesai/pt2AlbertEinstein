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
                    <a class="nav-link active" aria-current="page" href="index.php"><i class="bi bi-person-gear"> <?PHP echo $name ?>: </i> Administra tu Perfil</a>
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
    <main class="container-fluid">
        <section class="d-flex">
            <article class="col-3">

            </article>

            <article class="col-9 border border-danger">
                <p class="">
                <h3 class="text-center">Informacion Personal</h3>
                </p>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Información básica</th>
                        </tr>
                        <tr>
                            <td colspan="3">Es posible que los directivos puedan ver parte de tu información al usar esta plataforma.</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>

                        </tr>
                        <tr class="align-middle">
                            <th scope="row">Foto</th>
                            <td>Personaliza tu perfil con una foto</td>
                            
                            <td colspan="2">
                                <label for="imageInput">
                                    <img src="" class="img-thumbnail rounded-circle img-profile" alt="Foto de perfil" style="max-width: 80px;" onerror="this.onerror=null; this.src='../img/imgsysgerde/perfil.jpg'">
                                </label>
                                <input type="file" id="imageInput" accept="image/*" onchange="uploadImage(event)" style="display:none;">

                            </td>
                        </tr>

                        <tr>
                            <th scope="row">Nombre</th>
                            <td colspan="2">Julio Sesai</td>
                            <?php include("modales.php") ?>
                            <td colspan="2"><a href="#" data-bs-toggle="modal" data-bs-target="#modalPrueba"><i class="bi bi-chevron-right"></i></a></td>

                        </tr>
                        <tr>
                            <th scope="row">Fecha de nacimiento</th>
                            <td colspan="2">22/12/1989</td>
                            <td colspan="2"><a href=""><i class="bi bi-chevron-right"></i></a></td>


                        </tr>
                        <tr>
                            <th scope="row">Genero</th>
                            <td colspan="2">Hombre</td>
                            <td colspan="2"><a href=""><i class="bi bi-chevron-right"></i></a></td>


                        </tr>
                    </tbody>
                </table>
                <form>

                    <div class="mb-3">
                        <label for="nombre" class="form-label"></label>
                        <input type="email" class="form-control" id="nombre" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </article>


        </section>
    </main>

    <form id="formCp" action="">
        <input type="text" id="cp">
        <button type="submit">CP</button>
    </form>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script>
        function uploadImage(event) {
            const input = event.target;
            const file = input.files[0];
            const formData = new FormData();
            formData.append("image", file);

            // Aquí se puede llamar a una función para enviar la imagen al servidor
            sendImageToServer(formData);
        }
    </script>


    </scrip>

    <script src="pruebaCp.js"></script>
</body>

</html>