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

    //llamamos al archivo donde se efectua la conexion a la BD
    include("../conectBD/Conexion.php");

    //hacemos una consulta a la tabla de cursos
    $registros = $bds->query('SELECT * FROM curso')->fetchAll(PDO::FETCH_OBJ);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/imgsysgerde/logo2.png" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/cssNuevoCurso.css">


    <title>Document</title>
</head>

<body>
    <div class="ContenedorNuevoCurso">

        <div class="cabecera">

            <div class="contenedorMenuNuevoCurso">

                <div class="logoEducae"><a href="index.php"><img src="../img/imgsysgerde/Logo_CAE.png" alt="Inicio" class="logo_navFN"></a></div>

                <ul class="Menu">
                    <input type="checkbox" name="" id="btnMenu" class="check">
                    <label for="btnMenu" class="btnMenu"><img src="../img/imgsysgerde/menu.png" alt="Menu"></label>
                    <li class="elemenu"><a href="index.php">Inicio</a></li>
                    <li class="elemenu"><a href="">Catalogo</a></li>
                    <li class="elemenu"><a href="">Temas</a></li>
                    <li class="elemenu"><a href="">Test</a></li>
                    <!-- <li class="elemenu"><a href="../SessionClose.php">Cerrar Sesión</a></li> -->
                    

                </ul>
                <ul class="Menu2">
                    <!-- <li class="elemenu2"><a href="catalogo.php"><img src="../img/imgsysgerde/catalogo.png" alt="Catalogo de Cursos" class="imgMenu"></a></li> -->
                    <li class="elemenu2" id="datosPersonales">
                        <a href="datosPersonales.php" class="">
                            <figure><img src="../img/imgsysgerde/perfil.jpg" alt="FotoAdm" class="imgPerfilAdm">
                                <figcaption class="nombreUsr"><?PHP echo $name ?></figcaption>
                            </figure>
                        </a>
                    </li>
                    
                    <li class="elemenu2"><a href="../SessionClose.php"><img src="../img/imgsysgerde/cerrarSesion.png" alt="Cerrar Sesion" class="imgCcerrarSes"></a></li>



                </ul>



            </div>
        </div>

        <!-- FORMULARIO PARA AGREGAR NUEVO CURSO-->

        <div class="formRegCur">

            <form action="subirCurso.php" method="POST" enctype="multipart/form-data" class="formRegCurso">

                <!-- titulo de formulario-->
                <h2 class="titulo_fomulario">Agrega Curso Nuevo</h2>
                <div class="form_container">

                    <!-- Bloque para el input nombre del curso-->
                    <div class="formulario_bloque">

                        <label for="nombreC" class="form_etiqueta">Nombre del curso:</label>
                        <input type="text" class="input_formulario" name="nombreC" placeholder=" ">
                        <span class="form_line"></span>

                    </div>

                    <!-- Bloque para el input descripcion del curso-->
                    <div class="formulario_bloque">
                        <label for="descripcionC" class="form_etiqueta">Descripción:</label>
                        <textarea name="descripcionC" id="" cols="20" rows="5" class="input_txtArea" placeholder=" "></textarea>
                        <span class="form_line"></span>
                    </div>

                    <!-- Bloque para el input costo del curso-->
                    <div class="formulario_bloque">
                        <label for="costo" class="form_etiqueta">Costo:</label>
                        <input type="number" class="input_formulario" name="costo" placeholder=" ">
                        <span class="form_line"></span>

                    </div>

                    <!-- Bloque para el file imagen del curso-->
                    <div class="formulario_bloque">
                        <label for="imagenCurso" class="form_etiqueta">Imagen del curso:</label>
                        <input type="file" class="form_file" name="imagenCurso" placeholder=" " id="form_file">
                        <span class="form_line"></span>

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
                        <input type="button" onclick="location.href='index.php';" value=" Cancelar " class="btn_cancel">
                        <input type="submit" class="btn_submit" value=" Subir Curso " name="subirCurso">
                    </div>
                </div>
            </form>
        </div>

        <!-- TABLA QUE MUESTRA LOS CURSOS-->
        <div class="tablaCursos">

            <table class="tabla">
                <caption>
                    <h2>Cursos Acuales</h2>
                </caption>
                <tr class="cabeceraCursos">

                    <!-- cabeceras de la tabla  -->

                    <th class="">Nombre del curso</th>
                    <th class="">Descripción del curso</th>
                    <th class="">Costo MXN</th>
                    <th class="">Imagen del Curso</th>

                </tr>

                <!-- Mostramos contenido de tabla cursos de la BD -->
                <?PHP

                //empleamos un foreach para repetir la estructura de la tabla para cada registro y mostrarlos en pantalla
                foreach ($registros as $cursos) : ?>
                    <tr class="rowTabCursos">
                        <!--mostramos nombre de curso en la tabla  -->
                        <td class=""><?PHP echo $cursos->nombre_curso ?></td>
                        <!-- mostramos descripcion del curso -->
                        <td class=""><?PHP echo $cursos->descripcion_curso ?></td>
                        <!-- mostramos valor del curso en la cita-->
                        <td class=""><?PHP echo $cursos->valor ?></td>

                        <!-- mostramos la imagen guardada en el servidor,colocamos la ruta y agregamos el nombre de la imagen   -->

                        <td class=""><img src="../img/<?PHP echo $cursos->imgCurso ?>" alt="Imagen de curso" width="100px"> </td>
                        <!-- mostramos el nombre del paciente y apellido con la ayuda de los alias incluidos en la consulta SELECT-->


                    </tr>
                <?PHP
                //cerramos el bucle
                endforeach;

                ?>
            </table>
        </div>

        <div class="foot"></div>
    </div>
</body>

</html>