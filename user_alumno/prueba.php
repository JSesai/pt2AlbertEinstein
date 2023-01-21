<?PHP

//  //generamos un random
//  $mat1= "AE";
//  $mat2= rand(10,100);
//  $mat3= rand(100,200);
//  $matricula=$mat1.$mat2.$mat3;
//  echo $matricula;



?>



<?PHP
        //se inicia o se reanuda la sesion cualquiera de las 2 posibilidades
        session_start();

  
//validamos si no hay nada almacenado informacion en la variable global SESSION
if (!isset($_SESSION["usuario"])) {
    header("Location:../fLogin.php");
} else {
  
    //recuperamos variables globales las almacenamos en locales para uso en este ambito
    //almacena el id del usuario
    $user = $_SESSION["IdUser"];
    //almacena el nombre del usuario
    $name = $_SESSION["usuario"];
    echo $user;
    echo$name;

//llamamos al archivo donde se efectua la conexion a la BD
include("../conectBD/Conexion.php");
$registros = $bds->query('SELECT curso.id_curso, curso.nombre_curso, curso.descripcion_curso, curso.imgCurso FROM curso INNER JOIN curso_alumno ON curso.id_curso= curso_alumno.id_curso INNER JOIN alumno ON curso_alumno.id_matricula = alumno.id_matricula WHERE alumno.id_matricula='.$user)->fetchAll(PDO::FETCH_OBJ);

foreach($registros as $curso){

    echo $curso->nombre_curso;
    echo $curso->id_curso;
}        


        }


        
       
        

      


?>

<?PHP
        

function x (){
    include("../conectBD/Conexion.php");
$registros = $bds->query('SELECT id_curso.curso, nombre_curso.curso, descripcion_curso.curso, imgCurso.curso  FROM curso INNER JOIN curso_alumno ON id_matricula = id_matricula INNER JOIN alumno ON id_matricula = id_matricula WHERE id_matricula='.$user)->fetchAll(PDO::FETCH_OBJ);


        //hacemos una consulta con alias para poder diferenciar las tablas
          $registros= $bds->query('SELECT cita.id_cita, medicos.nombre AS nomMed, medicos.apellidoPaterno AS apePaMed,medicos.apellidoMaterno As apeMaMed, cita.fecha, cita.hora, pacientes.nombre AS nombrePac, pacientes.apellidoPaterno AS apePaPa
          FROM cita INNER JOIN medicos ON cita.id_medicoFor = medicos.id_medico INNER JOIN pacientes ON cita.id_pacienteFor = pacientes.Id_Paciente WHERE cita.id_medicoFor='.$idMed)->fetchAll(PDO::FETCH_OBJ);
       
}
       ?>


