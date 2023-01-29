<?PHP

//se inicia o se reanuda la sesion cualquiera de las 2 posibilidades
session_start();
// Si existe una variable de sesión 'LAST_ACTIVITY' y ha pasado más de 15 minutos desde la última actividad
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 2400)) {
        
    header("Location:../login.php");
}
// Asigna el tiempo actual a la variable de sesión 'LAST_ACTIVITY'
$_SESSION['LAST_ACTIVITY'] = time();

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
                    <li class="itemMenu"><a href="">Misión</a></li>

                    <li class="itemMenu"><a href="">Visión</a></li>
                    <li class="itemMenu"><a href=""></a></li>

                    <li class="itemMenu"><a href="">Valores</a></li>
                    <li class="itemMenu"><input type="text" placeholder="Buscar" class="buscador"></li>

                    <li class="itemMenu" id="datosPersonales">
                        <a href="datosPersonales.php" class="">
                            <figure><img src="../img/imgsysgerde/perfil.jpg" alt="FotoAdm" class="imgAdmin">
                                <figcaption class="nombreUsr"><?PHP echo $name ?></figcaption>
                            </figure>
                        </a>
                    </li>
                    


                    <li class="itemMenu"><a href="../SessionClose.php">Cerrar Sesión</a></li>


                </ul>
            </nav>
        </div>



        <!-- colocamos divs para contener las cards de los cursos-->
        <div class="cardCurso">


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
                    <h2 class="opcAdm_titulo">Nuevo Curso</h2>
                </div>
                <div class="card-body">
                    <div class="imagenCurso"><a href="formNewCur.php"><img src="../img/imgsysgerde/newCurso.png" alt=""></a>
                    </div>
                    <div class="descripcionCurso">

                    </div>
                </div>
                <div class="card-footer">

                    <div class="administra"><a href="formNewCur.php"><img src="../img/imgsysgerde/administrar.png" alt="Editar" width="100px"></a></div>


                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2 class="opcAdm_titulo">Editar Curso</h2>
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
                    <h2 class="opcAdm_titulo">Eliminar Curso</h2>
                </div>
                <div class="card-body">
                    <div class="imagenCurso"><a href="eliminaCurso.php"><img src="../img/imgsysgerde/eliminaCurso.png" alt=""></a>
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
                    <h2 class="opcAdm_titulo">Agregar Tema</h2>
                </div>
                <div class="card-body">
                    <div class="imagenCurso"><a href="formAddTema.php"><img src="../img/imgsysgerde/agregaTema.png" alt=""></a>
                    </div>
                    <div class="descripcionCurso">

                    </div>
                </div>
                <div class="card-footer">

                    <div class="administra"><a href="formAddTema.php"><img src="../img/imgsysgerde/administrar.png" alt="Editar"></a></div>


                </div>
            </div>


            <div class="card">
                <div class="card-header">
                    <h2 class="opcAdm_titulo">Editar Tema</h2>
                </div>
                <div class="card-body">
                    <div class="imagenCurso"><a href="formActualizaTema.php"><img src="../img/imgsysgerde/editaTema.png" alt=""></a>
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
                    <h2 class="opcAdm_titulo">Eliminar Tema</h2>
                </div>
                <div class="card-body">
                    <div class="imagenCurso"><a href="formEliminaTema.php"><img src="../img/imgsysgerde/eliminaTema.png" alt=""></a>
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
                    <h2 class="opcAdm_titulo">Crear Test</h2>
                </div>
                <div class="card-body">
                    <div class="imagenCurso"><a href="nuevoTest2.php"><img src="../img/imgsysgerde/newTest.png" alt="nuevo test"></a>
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
                    <h2 class="opcAdm_titulo">Actualizar Test</h2>
                </div>
                <div class="card-body">
                    <div class="imagenCurso"><a href=""><img src="../img/imgsysgerde/actTest.png" alt=""></a>
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
                    <h2 class="opcAdm_titulo">Eliminar Test</h2>
                </div>
                <div class="card-body">
                    <div class="imagenCurso"><a href=""><img src="../img/imgsysgerde/delTest.png" alt=""></a>
                    </div>
                    <div class="descripcionCurso">

                    </div>
                </div>
                <div class="card-footer">

                    <div class="administra"><a href=""><img src="../img/imgsysgerde/administrar.png" alt="Editar"></a></div>


                </div>
            </div>

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
                <p>© Colegio Albert Einstein Oaxaca 2022. Todos los derechos reservados</p>

            </div>

        </div>


    </div>




</body>

</html>