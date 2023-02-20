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
    //se inicia o se reanuda la sesion cualquiera de las 2 posibilidades
    session_start();
    
    //recuperamos variables globales las almacenamos en locales para uso en este ambito
    //almacena el id del usuario
    $user = $_SESSION["IdUser"];
    //almacena el nombre del usuario
    $name = $_SESSION["usuario"];
    $stado = 'activo';
}
//--SUBIR CURSO--- DATOS TOMADOS DEL FORMULARIO Y ALMACENADOS A LA BD
//Validamos si se ha pulsado el boton submit con name subirCurso
if (isset($_POST["subirCurso"])) {

    //recuperamos informacion de formulario con la ayuda de la super global POST y almacenamos en variables locales
    $nombreCurso = $_POST["nombreC"];
    $descripcionCurso = $_POST["descripcionC"];
    $costoCurso = $_POST["costo"];
    $categoria = $_POST["categoria"];


    echo $categoria;
    //Recuperamos los datos de la imagen seleccionada con ayuda de super global FILES
    //guardamos el nombre del archivo
    $nombre_imagen = $_FILES['imagenCurso']['name'];
    //guardamos el tipo de archivo seleccionado
    $tipo_imagen = $_FILES['imagenCurso']['type'];
    //guardamos el tamaño del archivo
    $tam_imagen = $_FILES['imagenCurso']['size'];



    //valida que las cajas del formulario no se encuentren vacios
    //validamos que ninguna caja este vacia
    if (empty($nombreCurso)) {
        echo '<script>window.alert("Ingrese el nombre del curso");
            window.location.href ="formNewCur.php";
            </script>';
    } elseif (empty($descripcionCurso)) {
        echo '<script>window.alert("Ingrese la descipcion del curso");
            window.location.href ="formNewCur.php";
            </script>';
    } elseif (empty($costoCurso)) {
        echo '<script>window.alert("Ingrese el costo del curso");
            window.location.href ="formNewCur.php";
            </script>';
    } elseif (empty($nombre_imagen)) {
        echo '<script>window.alert("Seleccione imagen del curso");
            window.location.href ="formNewCur.php";
            </script>';
    } elseif (($categoria == "Categoria")) {
        echo '<script>window.alert("Indique la categoria del curso");
            window.location.href ="formNewCur.php";
            </script>';
    }

    //si pesa mas de 5 MB no se sube
    if ($tam_imagen <= 5000000) {
        if ($tipo_imagen == "image/jpeg" || $tipo_imagen == "image/jpg" || $tipo_imagen == "image/png") {

            //definimos la ruta de almacenamiento destino de la imagen seleccionada
            //colocamos la raiz del servidor y concatenmos la ruta de las carpetas
            // $carpeta_destino= $_SERVER['DOCUMENT_ROOT']. '/plataforma_educae/img/imagenes_cursos'
            $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/AlbertoEinstein/img/';

            //movemos el archivo
            move_uploaded_file($_FILES['imagenCurso']['tmp_name'], $carpeta_destino . $nombre_imagen);
        } else {
            echo '<script>window.alert("El tipo de archivo es invalido");
            window.location.href ="formNewCur.php";
            </script>';
        }
    } else {
        echo '<script>window.alert("El tamaño maximo es de 5MB");
            window.location.href ="formNewCur.php";
            </script>';
    }



    //llamamos al metodo para hacer el registro
    registrarCurso($nombreCurso, $descripcionCurso, $costoCurso, $nombre_imagen, $stado, $user, $categoria);
}


function registrarCurso($nombreCurso, $descripcionCurso, $costoCurso, $nombre_imagen, $stado, $user, $categoria)
{

    try {

        //llamamos al archivo donde se efectua la conexion a la BD
        include("../conectBD/Conexion.php");

        //creamos la sentencia SQL INSERT empleamos marcadores con el fin de evitar inyecciones SQL 
        $sql = "INSERT INTO curso (nombre_curso, descripcion_curso, valor, imgCurso, estatusCurso, id_admon, id_categoria) VALUES (:m_nombre, :m_descripcion, :m_costo, :m_imagen, :m_estatus, :m_admin, :m_categoria)";

        //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
        $resultado = $bds->prepare($sql);

        //ahora se ejecuta la sentencia, debemos sustituir los marcadores por las variables que contiene la informacion que el usuario ingreso
        $resultado->execute(array(":m_nombre" => $nombreCurso, ":m_descripcion" => $descripcionCurso, ":m_costo" => $costoCurso, ":m_imagen" => $nombre_imagen, ":m_estatus" => $stado, ":m_admin" => $user, ":m_categoria" => $categoria));
        //liberamos la memoria para no consumir recursos de manera innecesaria






        //mostramos mensaje de registro exitoso
        echo '<script>window.alert("Curso Agregado!!");
            window.location.href ="formNewCur.php";
            </script>';
        $resultado->closeCursor();


        //capturamos el error en caso de fallar la conexion
    } catch (Exception $e) {


        //indicamos que nos muestre la linea de error
        echo "Error en linea: " . $e->getLine() . $e->getMessage();
    }
}
//ACTUALIZA ALGUN CURSO SELECCIONADO
//Validamos si se ha pulsado el boton de logeo
if (isset($_POST["actualizaCurso"])) {




    //recuperamos informacion de formulario con la ayuda de la super global POST y almacenamos en variables locales
    $id_curso = $_POST["id_curso"];
    $nombreCurso = $_POST["nombreC"];
    $descripcionCurso = $_POST["descripcionC"];
    $costoCurso = $_POST["costo"];
    $categoria = $_POST["categoria"];

    //Recuperamos los datos de la imagen seleccionada con ayuda de super global FILES
    //guardamos el nombre del archivo
    $nombre_imagen = $_FILES['imagenCurso']['name'];
    //guardamos el tipo de archivo seleccionado
    $tipo_imagen = $_FILES['imagenCurso']['type'];
    //guardamos el tamaño del archivo
    $tam_imagen = $_FILES['imagenCurso']['size'];


    //valida que las cajas del formulario no se encuentren vacios
    //validamos que ninguna caja este vacia
    if (empty($nombreCurso)) {
        echo '<script>window.alert("Ingrese el nombre del curso");
                window.location.href ="tblActualizarCurso.php";
                </script>';
    } elseif (empty($descripcionCurso)) {
        echo '<script>window.alert("Ingrese la descipcion del curso");
                window.location.href ="tblActualizarCurso.php";
                </script>';
    } elseif (empty($costoCurso)) {
        echo '<script>window.alert("Ingrese el costo del curso");
                window.location.href ="tblActualizarCurso.php";
                </script>';
    } elseif (empty($nombre_imagen)) {
        echo '<script>window.alert("Seleccione imagen del curso");
                window.location.href ="tblActualizarCurso.php";
                </script>';
    } elseif (($categoria == "Categoria")) {
        echo '<script>window.alert("Indique la categoria del curso");
                window.location.href ="tblActualizarCurso.php";
                </script>';
    }

    //si pesa mas de 5 MB no se sube
    if ($tam_imagen <= 5000000) {
        if ($tipo_imagen == "image/jpeg" || $tipo_imagen == "image/jpg" || $tipo_imagen == "image/png") {

            //definimos la ruta de almacenamiento destino de la imagen seleccionada
            //colocamos la raiz del servidor y concatenmos la ruta de las carpetas
            // $carpeta_destino= $_SERVER['DOCUMENT_ROOT']. '/plataforma_educae/img/imagenes_cursos'
            $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/AlbertoEinstein/img/';

            //movemos el archivo
            move_uploaded_file($_FILES['imagenCurso']['tmp_name'], $carpeta_destino . $nombre_imagen);
        } else {
            echo '<script>window.alert("El tipo de archivo es invalido");
                window.location.href ="formActCurso.php";
                </script>';
        }
    } else {
        echo '<script>window.alert("El tamaño maximo es de 5MB");
                window.location.href ="formActCurso.php";
                </script>';
    }



    //llamamos al metodo para hacer el registro
    actualizaCurso($id_curso, $nombreCurso, $descripcionCurso, $costoCurso, $nombre_imagen, $user);
}

//funcion que actualiza la informacion del curso
function actualizaCurso($id_curso, $nombreCurso, $descripcionCurso, $costoCurso, $nombre_imagen, $user)
{

    try {

        //llamamos al archivo donde se efectua la conexion a la BD
        include("../conectBD/Conexion.php");

        //creamos la sentencia SQL UPDATE empleamos marcadores con el fin de evitar inyecciones SQL 
        //$sql= "UPDATE curso (nombre_curso, descripcion_curso, valor, imgCurso, estatusCurso, id_admon) VALUES (:m_nombre, :m_descripcion, :m_costo, :m_imagen, :m_estatus, :m_admin)WHERE id_curso=:m_id_curso";
        $sql = 'UPDATE curso SET nombre_curso =:m_nombre, descripcion_curso =:m_descripcion, valor= :m_costo, imgCurso = :m_imagen, id_admon= :m_admin  WHERE id_curso =:m_id_curso';
        //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
        $resultado = $bds->prepare($sql);

        //ahora se ejecuta la sentencia, debemos sustituir los marcadores por las variables que contiene la informacion que el usuario ingreso
        $resultado->execute(array(":m_nombre" => $nombreCurso, ":m_descripcion" => $descripcionCurso, ":m_costo" => $costoCurso, ":m_imagen" => $nombre_imagen, ":m_admin" => $user, ":m_id_curso" => $id_curso));
        //liberamos la memoria para no consumir recursos de manera innecesaria







        //mostramos mensaje de registro exitoso
        echo '<script>window.alert("Curso Actualizado!!");
                window.location.href ="tblActualizarCurso.php";
                </script>';
        $resultado->closeCursor();


        //capturamos el error en caso de fallar la conexion
    } catch (Exception $e) {


        //indicamos que nos muestre la linea de error
        echo "Error en linea: " . $e->getLine();
    }
}

//ACTUALIZA ALGUN CURSO SELECCIONADO
//Validamos si se ha pulsado el boton de logeo
if (isset($_POST["eliminaCurso"])) {



    //recuperamos informacion de formulario con la ayuda de la super global POST y almacenamos en variables locales
    $id_curso = $_POST["id_curso"];
    $nombreCurso = $_POST["nombreC"];
    $descripcionCurso = $_POST["descripcionC"];
    $costoCurso = $_POST["costo"];
    $categoria = $_POST["categoria"];
    $nvoStatus = "inactivo";

    //Recuperamos los datos de la imagen seleccionada con ayuda de super global FILES
    //guardamos el nombre del archivo
    // $nombre_imagen = $_FILES['imagenCurso']['name'];
    // //guardamos el tipo de archivo seleccionado
    // $tipo_imagen = $_FILES['imagenCurso']['type'];
    // //guardamos el tamaño del archivo
    // $tam_imagen = $_FILES['imagenCurso']['size'];








    //llamamos al metodo para hacer el registro
    eliminarCurso($id_curso, $nvoStatus);
}

//funcion que actualiza la informacion del curso
function eliminarCurso($id_curso, $nvoStatus)
{

    try {

        //llamamos al archivo donde se efectua la conexion a la BD
        include("../conectBD/Conexion.php");

        //creamos la sentencia SQL UPDATE empleamos marcadores con el fin de evitar inyecciones SQL 
        //$sql= "UPDATE curso (nombre_curso, descripcion_curso, valor, imgCurso, estatusCurso, id_admon) VALUES (:m_nombre, :m_descripcion, :m_costo, :m_imagen, :m_estatus, :m_admin)WHERE id_curso=:m_id_curso";
        $sql = 'UPDATE curso SET  estatusCurso =:m_estatus WHERE id_curso =:m_id_curso';
        //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
        $resultado = $bds->prepare($sql);

        //ahora se ejecuta la sentencia, debemos sustituir los marcadores por las variables que contiene la informacion que el usuario ingreso
        $resultado->execute(array(":m_estatus" => $nvoStatus, ":m_id_curso" => $id_curso));
        //liberamos la memoria para no consumir recursos de manera innecesaria





        //mostramos mensaje de registro exitoso
        echo '<script>window.alert("Curso Eliminado!!");
                window.location.href ="eliminaCurso.php";
                </script>';



        //capturamos el error en caso de fallar la conexion
    } catch (Exception $e) {


        //indicamos que nos muestre la linea de error
        echo "Error en linea: " . $e->getLine();
    }
}


//1. TRABAJAMOS AQUI AHORA... subimos el video al servidor
//Validamos si se ha pulsado el boton de logeo
if (isset($_POST["subirTema"])) {

    //recuperamos informacion de formulario con la ayuda de la super global POST y almacenamos en variables locales
    $id_Curso = $_POST["idCurso"];
    $nombreTema = $_POST["nombreTema"];
    

    // //Recuperamos los datos de la imagen seleccionada con ayuda de super global FILES
    //         //guardamos el nombre del archivo
    $nombre_imgTem = $_FILES['imagenTema']['name'];
    //guardamos el tipo de archivo seleccionado
    $tipo_imgTem = $_FILES['imagenTema']['type'];
    // guardamos el tamaño del archivo
    $tam_imgTem = $_FILES['imagenTema']['size'];

    //guardamos el nombre del archivo de tipo video
    $nombre_vidTem = $_FILES['videoTema']['name'];
    //guardamos el tipo de archivo seleccionado
    $tipo_vidTem = $_FILES['videoTema']['type'];
    //guardamos el tamaño del archivo
    $tam_vidTem = $_FILES['videoTema']['size'];

    //valida que las cajas del formulario no se encuentren vacios

    if (empty($id_Curso)) {
        echo '<script>window.alert("Seleccione el nombre del curso");
                window.location.href ="index.php";
                </script>';
    } elseif (empty($nombreTema)) {
        echo '<script>window.alert("Ingrese el nombre del tema del curso");
                window.location.href ="index.php";
                </script>';
    } elseif (empty($nombre_imgTem)) {
        echo '<script>window.alert("Seleccione la imagen del tema");
                        window.location.href ="index.php";
                        </script>';
    }
    elseif (empty($nombre_vidTem)) {
        echo '<script>window.alert("Seleccione el video del tema del curso");
            window.location.href ="index.php";
            </script>';}


    if ($tam_imgTem <= 4000000 and $tipo_imgTem = "image/jpeg" || $tipo_imagen == "image/jpg" || $tipo_imagen == "image/png" and $tipo_vidTem == "video/mp4") {

        // Creamos la ruta de destino donde se subiran los archivos, guardamos la ruta en $carpeta_destino= $_SERVER['DOCUMENT_ROOT']. '/plataforma_educae/img/imagenes_cursos'
        $carpeta_destinoImg = $_SERVER['DOCUMENT_ROOT'] . '/AlbertoEinstein/img/';
        $carpeta_destinoVid = $_SERVER['DOCUMENT_ROOT'] . '/AlbertoEinstein/video/';

        //usamos el metodo de PHP para mover archivos, le pasamos la direccion de destino y el nombre del archovp y subimos los archivos imagen y video al servidor
        move_uploaded_file($_FILES['imagenTema']['tmp_name'], $carpeta_destinoImg . $nombre_imgTem);
        move_uploaded_file($_FILES['videoTema']['tmp_name'], $carpeta_destinoVid . $nombre_vidTem);

        $stado = "activo";
        subirTema($nombreTema, $nombre_imgTem, $nombre_vidTem, $stado, $id_Curso);
    } else {

        echo '<script>window.alert("Solo son validos imagen jpg.jpeg,png y video mp4");
                window.location.href ="formAddTema.php";
                </script>';
    }



}



//SI NO ES NULLO EL VALOR DEL BOTON SUMIT ACTUALIZAR TEMA , SE EJECUTA EL SIGUIENTE CODIGO
if (isset($_POST["actualizarTema"])) {
   
    //recuperamos informacion de formulario con la ayuda de la super global POST y almacenamos en variables locales
    $id_Curso = $_POST["idCurso"];
    $nombreTema = $_POST["idTema"];
    $nombreNvoTema= $_POST["nombreTema"];
   

    //Recuperamos los datos de la imagen seleccionada con ayuda de super global FILES
            //guardamos el nombre del archivo
    $nombre_imgTem= $_FILES['imagenTema'] ['name'];
    //guardamos el tipo de archivo seleccionado
    $tipo_imgTem= $_FILES['imagenTema'] ['type'];
    //guardamos el tamaño del archivo
    $tam_imgTem= $_FILES['imagenTema'] ['size'];

     //guardamos el nombre del archivo
     $nombre_vidTem= $_FILES['videoTema'] ['name'];
     //guardamos el tipo de archivo seleccionado
     $tipo_vidTem= $_FILES['videoTema'] ['type'];
     //guardamos el tamaño del archivo
     $tam_vidTem= $_FILES['videoTema'] ['size'];

       //valida que las cajas del formulario no se encuentren vacios

    if (empty($id_Curso) || $id_Curso=="Curso") {
        echo '<script>window.alert("Seleccione el nombre del curso");
                window.location.href ="formActualizaTema.php";
                </script>';
    } elseif (empty($nombreTema)) {
        echo '<script>window.alert("Ingrese el nombre del tema del curso");
                window.location.href ="formActualizaTema.php";
                </script>';
    } elseif (empty($nombre_imgTem)) {
        echo '<script>window.alert("Seleccione la imagen del tema");
                        window.location.href ="formActualizaTema.php";
                        </script>';
    }
    elseif (empty($nombre_vidTem)) {
        echo '<script>window.alert("Seleccione el video del tema del curso");
            window.location.href ="formActualizaTema.php";
            </script>';}


    if($tam_imgTem<=4000000 AND $tipo_imgTem="image/jpeg"|| $tipo_imagen=="image/jpg"|| $tipo_imagen=="image/png" AND $tipo_vidTem=="video/mp4" ){

         // $carpeta_destino= $_SERVER['DOCUMENT_ROOT']. '/plataforma_educae/img/imagenes_cursos'
         $carpeta_destinoImg= $_SERVER['DOCUMENT_ROOT']. '/AlbertoEinstein/img/';
         $carpeta_destinoVid= $_SERVER['DOCUMENT_ROOT']. '/AlbertoEinstein/video/';

         //movemos y subimos los archivos imagen y video al servidor
         move_uploaded_file($_FILES['imagenTema'] ['tmp_name'], $carpeta_destinoImg . $nombre_imgTem);
         move_uploaded_file($_FILES['videoTema'] ['tmp_name'], $carpeta_destinoVid . $nombre_vidTem);

        
        actualizarTema($nombreTema, $nombre_imgTem, $nombre_vidTem,$id_Curso, $nombreNvoTema);


    }else{

        echo'<script>window.alert("Solo son validos imagen jpg.jpeg,png y video mp4");
            window.location.href ="formAddTema.php";
            </script>';

    }

}
function subirTema($nombreTema, $nombre_imgTem, $nombre_vidTem, $stado, $id_Curso)
{

    try {

        //llamamos al archivo donde se efectua la conexion a la BD
        include("../conectBD/Conexion.php");

        //creamos la sentencia SQL INSERT empleamos marcadores con el fin de evitar inyecciones SQL 
        $sql = "INSERT INTO tema (nombre_tema, img_tema, vCont_tema, estatus_tema, id_curso) VALUES (:m_nombre, :m_imagen, :m_video, :m_estatus, :m_id_curso)";

        //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
        $resultado = $bds->prepare($sql);

        //ahora se ejecuta la sentencia, debemos sustituir los marcadores por las variables que contiene la informacion que el usuario ingreso
        $resultado->execute(array(":m_nombre" => $nombreTema, ":m_imagen" => $nombre_imgTem, ":m_video" => $nombre_vidTem, ":m_estatus" => $stado, ":m_id_curso" => $id_Curso));
        //liberamos la memoria para no consumir recursos de manera innecesaria


        //mostramos mensaje de registro exitoso
        echo '<script>window.alert("Tema Agregado!!");
            window.location.href ="index.php";
            </script>';
        $resultado->closeCursor();


        //capturamos el error en caso de fallar la conexion
    } catch (Exception $e) {


        //indicamos que nos muestre la linea de error
        echo "Error: " . $e->getMessage() . " En linea: " . $e->getLine();
    }
}


//SI NO ES NULLO EL VALOR DEL BOTON SUMIT ACTUALIZAR TEMA , SE EJECUTA EL SIGUIENTE CODIGO
if (isset($_POST["actualizarTema"])) {
   
    //recuperamos informacion de formulario con la ayuda de la super global POST y almacenamos en variables locales
    $id_Curso = $_POST["idCurso"];
    $nombreTema = $_POST["idTema"];
    $nombreNvoTema= $_POST["nombreTema"];
   

    //Recuperamos los datos de la imagen seleccionada con ayuda de super global FILES
            //guardamos el nombre del archivo
    $nombre_imgTem= $_FILES['imagenTema'] ['name'];
    //guardamos el tipo de archivo seleccionado
    $tipo_imgTem= $_FILES['imagenTema'] ['type'];
    //guardamos el tamaño del archivo
    $tam_imgTem= $_FILES['imagenTema'] ['size'];

     //guardamos el nombre del archivo
     $nombre_vidTem= $_FILES['videoTema'] ['name'];
     //guardamos el tipo de archivo seleccionado
     $tipo_vidTem= $_FILES['videoTema'] ['type'];
     //guardamos el tamaño del archivo
     $tam_vidTem= $_FILES['videoTema'] ['size'];

       //valida que las cajas del formulario no se encuentren vacios

    if (empty($id_Curso) || $id_Curso=="Curso") {
        echo '<script>window.alert("Seleccione el nombre del curso");
                window.location.href ="formActualizaTema.php";
                </script>';
    } elseif (empty($nombreTema)) {
        echo '<script>window.alert("Ingrese el nombre del tema del curso");
                window.location.href ="formActualizaTema.php";
                </script>';
    } elseif (empty($nombre_imgTem)) {
        echo '<script>window.alert("Seleccione la imagen del tema");
                        window.location.href ="formActualizaTema.php";
                        </script>';
    }
    elseif (empty($nombre_vidTem)) {
        echo '<script>window.alert("Seleccione el video del tema del curso");
            window.location.href ="formActualizaTema.php";
            </script>';}


    if($tam_imgTem<=4000000 AND $tipo_imgTem="image/jpeg"|| $tipo_imagen=="image/jpg"|| $tipo_imagen=="image/png" AND $tipo_vidTem=="video/mp4" ){

         // $carpeta_destino= $_SERVER['DOCUMENT_ROOT']. '/plataforma_educae/img/imagenes_cursos'
         $carpeta_destinoImg= $_SERVER['DOCUMENT_ROOT']. '/AlbertoEinstein/img/';
         $carpeta_destinoVid= $_SERVER['DOCUMENT_ROOT']. '/AlbertoEinstein/video/';

         //movemos y subimos los archivos imagen y video al servidor
         move_uploaded_file($_FILES['imagenTema'] ['tmp_name'], $carpeta_destinoImg . $nombre_imgTem);
         move_uploaded_file($_FILES['videoTema'] ['tmp_name'], $carpeta_destinoVid . $nombre_vidTem);

        
        actualizarTema($nombreTema, $nombre_imgTem, $nombre_vidTem,$id_Curso, $nombreNvoTema);


    }else{

        echo'<script>window.alert("Solo son validos imagen jpg.jpeg,png y video mp4");
            window.location.href ="formAddTema.php";
            </script>';

    }

}

function actualizarTema($nombreTema, $nombre_imgTem, $nombre_vidTem, $id_Curso, $nombreNvoTema)
{

    try {

        //llamamos al archivo donde se efectua la conexion a la BD
        include("../conectBD/Conexion.php");
        //vamos a obtener el id del tema con el nombre del tema proporcionado por el usuario, hacemos uso de fech assoc y recuperamos dato que guardamos en variable
        //para usarlo en la segunda consulta 
        $sql2= 'SELECT id_tema FROM tema WHERE nombre_tema=:m_nomTem';
        $res = $bds->prepare($sql2);
        $res->execute(array(":m_nomTem" => $nombreTema));
        
        //guardamos el resultado en la varible registro
         $result= $res->fetch(PDO::FETCH_ASSOC); 
        $idReal= $result["id_tema"];
        
        
        
        //creamos la sentencia SQL UPDATE empleamos marcadores con el fin de evitar inyecciones SQL 
       // $sql = "INSERT INTO tema (nombre_tema, img_tema, vCont_tema, estatus_tema, id_curso) VALUES (:m_nombre, :m_imagen, :m_video, :m_estatus, :m_id_curso)";
       $sql = 'UPDATE tema SET nombre_tema= :m_nombre, img_tema= :m_imgTema, vCont_tema= :m_videoTema WHERE id_tema = :m_idTema ';

        //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
        $resultado = $bds->prepare($sql);

        //ahora se ejecuta la sentencia, debemos sustituir los marcadores por las variables que contiene la informacion que el usuario ingreso
        $resultado->execute(array(":m_nombre" => $nombreNvoTema, ":m_imgTema" => $nombre_imgTem, ":m_videoTema" => $nombre_vidTem, ":m_idTema" => $idReal));
        //liberamos la memoria para no consumir recursos de manera innecesaria


        //mostramos mensaje de registro exitoso
        echo '<script>window.alert("Tema Actualizado!!");
            window.location.href ="index.php";
            </script>';
        $resultado->closeCursor();


        //capturamos el error en caso de fallar la conexion
    } catch (Exception $e) {


        //indicamos que nos muestre la linea de error
        echo "Error: ".$e->getMessage(). "en linea: " . $e->getLine();
    }




    
}


//SI NO ES NULLO EL VALOR DEL BOTON SUMIT ELIMINAR TEMA , SE EJECUTA EL SIGUIENTE CODIGO
if (isset($_POST["eliminarTema"])) {

   
    //recuperamos informacion de formulario con la ayuda de la super global POST y almacenamos en variables locales
    $id_Curso = $_POST["idCurso"];
    $nombreTema = $_POST["idTema"];
   
   //valida que las cajas del formulario no se encuentren vacios

    if ($id_Curso=="Curso ") {
        echo '<script>window.alert("Seleccione el nombre del curso");
                window.location.href ="formEliminaTema.php";
                </script>';
    } elseif ($nombreTema=="Tema" || $nombreTema=="") {
        echo '<script>window.alert("Selecciona el nombre del tema a eliminar");
                window.location.href ="formEliminaTema.php";
                </script>';
    }else{
        eliminaTema($nombreTemas);
    }
// echo "Id curso es ".$id_Curso. " Nombre tema es ".$nombreTema;


    

}

// funcion que se encarga de remover el tema de la BD
function eliminaTema($nombreTema)
{

    try {

        //llamamos al archivo donde se efectua la conexion a la BD
        include("../conectBD/Conexion.php");
        //vamos a obtener el id del tema con el nombre del tema proporcionado por el usuario, hacemos uso de fech assoc y recuperamos dato que guardamos en variable
        //para usarlo en la segunda consulta 
        $sql2= 'SELECT id_tema FROM tema WHERE nombre_tema=:m_nomTem';
        $res = $bds->prepare($sql2);
        $res->execute(array(":m_nomTem" => $nombreTema));
        
        //guardamos el resultado en la varible registro
         $result= $res->fetch(PDO::FETCH_ASSOC); 
        $idReal= $result["id_tema"];
        
        
        
        //creamos la sentencia SQL UPDATE empleamos marcadores con el fin de evitar inyecciones SQL 
        $sql = 'DELETE FROM tema WHERE id_tema = :m_idTema  ';
      // $sql = 'UPDATE tema SET nombre_tema= :m_nombre, img_tema= :m_imgTema, vCont_tema= :m_videoTema WHERE id_tema = :m_idTema ';

        //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
        $resultado = $bds->prepare($sql);

        //ahora se ejecuta la sentencia, debemos sustituir los marcadores por las variables que contiene la informacion que el usuario ingreso
        $resultado->execute(array(":m_idTema" => $idReal));
        //liberamos la memoria para no consumir recursos de manera innecesaria


        //mostramos mensaje de registro exitoso
        echo '<script>window.alert("Eliminado!!");
        window.location.href ="index.php";
        </script>';
       


        //capturamos el error en caso de fallar la conexion
    } catch (Exception $e) {


        //indicamos que nos muestre la linea de error
        echo "Error: ".$e->getMessage(). "en linea: " . $e->getLine();
    }




    
}
