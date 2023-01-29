
<!-- AFREGAR CURSO A MOCHILA -->
<?PHP
//se inicia o se reanuda la sesion cualquiera de las 2 posibilidades
session_start();
//si no existe la variable de sesion guardada como usuario te direcciona a la pagina de logeo
if (!isset($_SESSION["usuario"])) {
    header("Location:../login.php");
} else {

    //recuperamos variables globales las almacenamos en locales para uso en este ambito
    //almacena el id del usuario
    $user = $_SESSION["IdUser"];
    //almacena el nombre del usuario
    $name = $_SESSION["usuario"];
    //recuperamos el id del curso
    $idCurso = $_GET["id"];
    

   //obtenemos fecha  y guardamos en variable el formato que ocuparemos en la BD    
   date_default_timezone_set('UTC');
   $fechaInicio= date("Y-m-d");

   //establecemos el estatus como agregado 
   $estatus="agregado";

   //llamamos al metodo addCursoMochila y le pasamos los valores previamente almacenados en variables 
   addCursoMochila($user, $idCurso, $fechaInicio, $estatus);
   
}
//METODO QUE HACE EL REGISTRO EN LA BD 
function addCursoMochila($user, $idCurso, $fechaInicio, $estatus){
     //llamamos al archivo donde se efectua la conexion a la BD
     include("../conectBD/Conexion.php");

     $sql1= "SELECT id_curso FROM curso_alumno WHERE id_curso=:m_id AND id_matricula=:m_alumno";
     $resultado1 = $bds->prepare($sql1);
     $resultado1->execute(array(":m_id"=>$idCurso, ":m_alumno" => $user));
     $registro1= $resultado1->fetch(PDO::FETCH_ASSOC);

     if($registro1){
       
        echo '<script>window.alert("ya cuentas con este curso, ingresa al aula para verlo");
                window.location.href ="catalogoAlumno.php";
                </script>';

     }else{
        try {

       
        

            //creamos la sentencia SQL INSERT empleamos marcadores con el fin de evitar inyecciones SQL, la almacenamos en  variable $sql 
            $sql = "INSERT INTO curso_alumno (dateStart, estatus, id_curso, id_matricula) VALUES (:m_fecha, :m_estatus, :m_curso, :m_alumno)";
    
            //hacemos uso de la sentencia preparada de nuestro objeto de conexion $bds y le pasamos la sentencia sql  $sql 
            $resultado = $bds->prepare($sql);
    
            //ahora se ejecuta la sentencia y se guarda en $resultado, debemos sustituir los marcadores por las variables que contiene la informacion que el usuario ingreso
            $resultado->execute(array(":m_fecha" => $fechaInicio, ":m_estatus" => $estatus, ":m_curso" => $idCurso, ":m_alumno" => $user));
            //liberamos la memoria para no consumir recursos de manera innecesaria
    
    
            //mostramos mensaje de registro exitoso
            echo '<script>window.alert("Curso Agregado!, Ingresa al aula para verlo!");
                window.location.href ="catalogoAlumno.php";
                </script>';
            $resultado->closeCursor();
    
    
            //capturamos el error en caso de fallar la conexion
        } catch (Exception $e) {
    
    
            //indicamos que nos muestre la linea de error
            echo "Error en linea: " . $e->getLine() . $e->getMessage();
        }
     }

    
}



?>