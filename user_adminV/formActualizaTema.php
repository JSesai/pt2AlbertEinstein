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
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Styles.css">
    <script src="main.js"></script>
    <link rel="stylesheet" href="../CSS/styles2.css">
    <link rel="shortcut icon" href="../img/imgsysgerde/logo2.png" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

    <title>Actualizar Tema</title>
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
                    <li class="itemMenu"><a href="index.php" class="itemInicio">Inicio<img src="../img/imgsysgerde/meniu.png" alt="Menu de opciones" class="imgMenuCat"></a></li>
                    <li class="itemMenu"><a href="formNewCur.php"></a></li>
                    <li class="itemMenu"><a href="formNewCur.php"></a></li>


                    <li class="itemMenu"><input type="text" placeholder="Buscar"></li>
                    <li class="elemenu"><a href=""><img src="../img/users/admin/charmanderAdm.png" alt="Mi perfil" class="imgPerfil"></a>
                        <p class="nombreUsr"><?PHP echo $name ?></p>
                    </li>



                    <li class="elemenu"><a href="../SessionClose.php"><img src="../img/imgsysgerde/cerrarSesion.png" alt="Cerrar Sesion" class="imgCcerrarSes"></a></li>



                </ul>
            </nav>
        </div>

        <div class="contenedorForm">
            <form action="subirCurso.php" method="POST" enctype="multipart/form-data" class="formulario">
                <h2 class="titulo_fomulario">Actualizar Tema</h2>

                <!-- COMBO BOX 1 menu de seleccion del curso  a agregar tema -->
                <div class="formBloque">
                    <label for="idCurso" class="form_etiqueta">Selecciona Curso:</label>
                    <!-- Mediante JS vamos a obtener el id para poder mostrar las opc en el cmbx2 -->
                    <select name='idCurso' class="form-control" id="combo1" onchange="javascript:llenar_cmb2();" required>
                        <option selected>Curso</option>
                        <!--incluimos el archivo que tiene la conexion a la BD -->
                        <?php
                        include("../conectBD/Conexion.php");
                        //almacenamos en variable $registros la consulta para extraer a los pacientes registrados 
                        $registros = $bds->query('SELECT id_curso , nombre_curso	 FROM curso WHERE  estatusCurso= "activo"')->fetchAll(PDO::FETCH_OBJ);


                        ?>
                        <?PHP
                        //empleamos un foreach para repetir la estructura de la tabla para cada registro
                        foreach ($registros as $cursos) : ?>
                            <!-- IMportante poner echo de lo contrario no se guardan en el form y no se envia en el post -->
                            <option value="<?PHP echo $cursos->id_curso ?>"><?PHP echo $cursos->nombre_curso ?></option>


                        <?PHP

                        //cerramos el bucle
                        endforeach;
                        //HAY QUE RECUPERAR EL VALOR DE ID CURSO Y GUARDARLO EN VARIABLE 

                        ?>



                    </select>


                </div>


                <!-- COMBO BOX 2 menu de seleccion del curso  a agregar tema -->
                <div class="formBloque">
                    <label for="idTema" class="form_etiqueta">Tema a actualizar:</label>

                    <select name='idTema' class="form-control" id="combo2">
                        <option value="Tema" id="resultado"></option>


                    </select>

                </div>


                <div class="formBloque">
                    <label for="nombreTema" class="form_etiqueta">Nombre del tema:</label>
                    <input type="text" class="item_form" name="nombreTema">

                </div>

                <div class="formBloque">
                    <label for="imagenTema" class="form_etiqueta">Imagen del tema:</label>
                    <input type="file" class="item_form" name="imagenTema">

                </div>

                <div class="formBloque">
                    <label for="videoTema" class="form_etiqueta">Video del tema:</label>
                    <input type="file" class="item_form" name="videoTema">

                </div>

                <input type="button" onclick="location.href='index.php';" value="Cancelar" class="btn_cancel">
                <input type="submit" class="btn_submit" value="Subir" name="actualizarTema">

            </form>
        </div>



        <div class="patas">

            <div class="patas2">
                <p> © Colegio Albert Einstein Oaxaca 2022. Todos los derechos reservados</p>

            </div>

        </div>


    </div>




</body>

</html>