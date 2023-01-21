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

    //hacemos una consulta a la tabla de cursos para extraer la informacion del curso seleccionado
    $registros = $bds->query('SELECT * FROM curso WHERE id_curso='. $idCurso)->fetchAll(PDO::FETCH_OBJ);

    //empleamos un foreach para recorrer el array y poder obtener los valores de los campos de la tabla 
    foreach ($registros as $cursos) {
    }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/Logo_CAE.png" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/styles2.css">
    <title>SysGeRDE</title>
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

        <!-- FORMULARIO PARA AGREGAR NUEVO CURSO-->



        <div class="contenedorForm">

            <form action="subirCurso.php" method="POST" enctype="multipart/form-data" class="formulario">

                <!-- titulo de formulario-->
                <h2 class="titulo_fomulario">Eliminaras Esté Curso</h2>
                <div class="form_container">

                    <!-- Bloque para el input nombre del curso-->
                    <div class="formBloque">
                        <input type="hidden" name="id_curso" value="<?php echo $cursos->id_curso; ?>" hidden>
                        <label for="nombreC" class="form_etiqueta">Nombre del curso:</label>
                        <input type="text" class="inputForm" name="nombreC" placeholder=" " value="<?php echo $cursos->nombre_curso; ?>">
                        <span class="form_line"></span>

                    </div>

                    <!-- Bloque para el input descripcion del curso-->
                    <div class="formBloque">
                        <label for="descripcionC" class="form_etiqueta">Descripción:</label>
                        <textarea name="descripcionC" id="" cols="20" rows="5" class="input_txtArea" placeholder=" "><?php echo $cursos->descripcion_curso; ?></textarea>
                        <span class="form_line"></span>
                    </div>

                    <!-- Bloque para el input costo del curso-->
                    <div class="formBloque">
                        <label for="costo" class="form_etiqueta">Costo:</label>
                        <input type="number" class="inputForm" name="costo" placeholder=" " value="<?php echo $cursos->valor; ?>">
                        <span class="form_line"></span>

                    </div>

                    <!-- Bloque para el file imagen del curso-->
                    <div class="formBloque">
                        <label for="imagenCurso">
                            <p>Imagen del curso:</p> <img src="../../AlbertoEinstein/img/<?PHP echo $cursos->imgCurso ?>" alt="Imagen de curso" width="150px">
                        </label>
                        
                        
                    </div>

                    <!-- ponemos un select para elegir la categoria del curso -->
                    <select name='categoria' class="form-control" required>
                        <option selected>Categoria</option>
                        <!--incluimos el archivo que tiene la conexion a la BD -->
                        <?php
                        include("../conectBD/Conexion.php");
                        //almacenamos en variable $sql la consulta para extraer a las categorias registradas 
                        $reg = $bds->query('SELECT id_categoria, nombre_cat FROM curso_categoria')->fetchAll(PDO::FETCH_OBJ);

                        ?>

                        <?PHP
                        //empleamos un foreach para repetir la estructura de la tabla para cada registro
                        foreach ($reg as $cat) : ?>
                            <!-- IMportante poner echo de lo contrario no se guardan en el form y no se envia en el post -->
                            <option value="<?PHP echo $cat->id_categoria  ?>"><?PHP echo $cat->nombre_cat ?></option>


                        <?PHP
                        //cerramos el bucle
                        endforeach;

                        ?>

                    </select>



                    <div class="botons">
                        <input type="button" onclick="location.href='eliminaCurso.php';" value=" Cancelar " class="btn_cancel">
                        <input type="submit" class="btn_submit" value="Eliminar " name="eliminaCurso">
                    </div>
                </div>
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