<?php

//se inicia o se reanuda la sesion cualquiera de las 2 posibilidades
session_start();

// Si existe una variable de sesión 'LAST_ACTIVITY' y ha pasado más de 15 minutos desde la última actividad
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
        
    header("Location:../login.php");
}
// Asigna el tiempo actual a la variable de sesión 'LAST_ACTIVITY'
$_SESSION['LAST_ACTIVITY'] = time();
//validamos si no hay nada almacenado informacion en la variable global SESSION
if (!isset($_SESSION["usuario"])) {
    header("Location:../formLogin.php");
} else {

    //recuperamos variables globales las almacenamos en locales para uso en este ambito
    //almacena el id del usuario
    $user = $_SESSION["IdUser"];
    //almacena el nombre del usuario
    $name = $_SESSION["usuario"];

    
    
    if (isset($_POST['cargarCursos'])) { 
        cargarCursos($user);
    
    }

    if (isset($_POST['cargarTemas'])) { 

        cargarTemas();
        }

    if(isset($_POST['cargarNombreTema'])){
        
       $id = $_POST['cargarNombreTema'];
       cargarNombreTema($id);
        


    }

}


function  cargarCursos($user){

    //llamamos al archivo donde se efectua la conexion a la BD
    include("../conectBD/Conexion.php");

    //hacemos una consulta atraves de inner join
    $registros = $bds->query('SELECT curso.id_curso, curso.nombre_curso, curso.descripcion_curso, curso.imgCurso FROM curso INNER JOIN curso_alumno ON curso.id_curso= curso_alumno.id_curso INNER JOIN alumno ON curso_alumno.id_matricula = alumno.id_matricula WHERE alumno.id_matricula=' . $user)->fetchAll(PDO::FETCH_OBJ);
    //se detecta el input pregunta del form si existe se ejecuta el metodo que hace el insert
   
        //echo 'EL backend esta respondiendo ahora, el usuario es :' .$name . ' y su id es: '.$user;
        echo json_encode($registros);
}

function cargarTemas(){
    $idCurso = $_POST['cargarTemas'];

     //llamamos al archivo donde se efectua la conexion a la BD
     include("../conectBD/Conexion.php");

     //hacemos una consulta a la tabla de cursos para extraer los temas del curso seleccionado
     $registros = $bds->query('SELECT * FROM tema WHERE id_curso=' . $idCurso)->fetchAll(PDO::FETCH_OBJ);
 

    echo json_encode($registros);
}

function  cargarNombreTema($id){

    //llamamos al archivo donde se efectua la conexion a la BD
    include("../conectBD/Conexion.php");

    //hacemos una consulta atraves de inner join
    $registros = $bds->query('SELECT id_curso, nombre_curso FROM curso WHERE id_curso=' . $id)->fetchAll(PDO::FETCH_OBJ);
    //se detecta el input pregunta del form si existe se ejecuta el metodo que hace el insert
   
        //echo 'EL backend esta respondiendo ahora, el usuario es :' .$name . ' y su id es: '.$user;
        echo json_encode($registros);
}


function valorBuscado(){
   
    //se inicia o se reanuda la sesion cualquiera de las 2 posibilidades
    session_start();

    //recuperamos variables globales las almacenamos en locales para uso en este ambito
    //almacena el id del usuario
    $user = $_SESSION["IdUser"];
    //almacena el nombre del usuario
    $name = $_SESSION["usuario"];

    echo 'EL backend esta respondiendo ahora. el usuario es :' .$name . ' y su id es: '.$user;

}