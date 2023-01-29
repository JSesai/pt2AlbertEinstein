<?php
//llamamos al archivo donde se efectua la conexion a la BD
include("../conectBD/Conexion.php");

//se detecta el input pregunta del form si existe se ejecuta el metodo que hace el insert
if (isset($_POST['pregunta'])) {
    insertarPregunta();

      
}

//si existe el argumento consulta enviado por xhr em js se ejecuta el metodo que hace la consulta
if(isset($_POST['consulta'])){
       
    $idSelec = $_POST['idSelec'];
    consultarPreguntas($idSelec);
    
}

//si existe un argumento como test existentes responde con la llamada al metodo buscarTest
if(isset($_POST['testExistentes'])){
   
    buscarTest();

}


if(isset($_POST['Eliminarpregunta'])){

    $idPregunta= $_POST['Eliminarpregunta'];
    eliminaPreguntra($idPregunta);
}

if(isset($_POST['actPregunta'])){

    $idPregunta = $_POST['actPregunta'];
    actPregunta($idPregunta);
    
}



if (isset($_POST['valorSeleccionado'])) {


    $nombreTema = $_POST['valorSeleccionado'];

    //echo $nombreTema;

    //llamamos al archivo donde se efectua la conexion a la BD
    include("../conectBD/Conexion.php");

    //creamos la sentencia SQL SELECT del id id_pruebaRapida L 
    $sql1="SELECT id_pruebaRapida  FROM pruebarapida WHERE id_tema  = :m_idSeleccionado";
    //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
    $resultado1= $bds->prepare($sql1);

    //ahora se ejecuta la sentencia, debemos sustituir el marcador por la variable que contiene el ID que el usuario ingreso
    $resultado1->execute(array(":m_idSeleccionado"=>$nombreTema));
       
    $registro1= $resultado1->fetch(PDO::FETCH_ASSOC);
    //validamos si existe el registro 
    if($registro1){
        $resultado1->closeCursor();
        echo'El tema ya cuenta con test creado!!';
    }else{

        //creamos la sentencia SQL INSERT empleamos marcadores con el fin de evitar inyecciones SQL 
        $sql = "INSERT INTO pruebarapida (id_tema) VALUES (:m_tema)";

        //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
        $resultado = $bds->prepare($sql);

        //ahora se ejecuta la sentencia, debemos sustituir los marcadores por las variables que contiene la informacion que el usuario ingreso
        $resultado->execute(array(":m_tema" => $nombreTema));


    
        echo ("creado correctamente");
    }
}



//funcion que inserta una nueva pregunta
function insertarPregunta(){

//incluimos archivo de conexion a la bd
include("../conectBD/Conexion.php");
//recuperamos con super variables los inputs del formulario 
$pregunta = $_POST['pregunta'];
$respCorrecta = $_POST['resp_ok'];
$op1 = $_POST['op1'];
$op2 = $_POST['op2'];
$op3 = $_POST['op3'];
$idTema = $_POST['idTema'];

  // si el id pregunta esta vacio se realiza un nuevo registro caso contrario se realiza un actualizacion  
  if(empty($_POST['idPregunta'])){
  




    //hacemos un select en la tabla prueba rapida para recuperar el id_pruebaRapida  y usarlo en el insert en la tabla test_preguntas

    $sql2 = 'SELECT id_pruebaRapida FROM pruebarapida WHERE id_tema=:m_idTem';
    $res = $bds->prepare($sql2);
    $res->execute(array(":m_idTem" => $idTema));

    //guardamos el resultado en la varible 
    $result = $res->fetch(PDO::FETCH_ASSOC);
    $id_pruebaRapida = $result["id_pruebaRapida"];

    //echo $idReal;


   
    //creamos la sentencia SQL INSERT empleamos marcadores con el fin de evitar inyecciones SQL y usamos el valor obtenido en el select anterior
    $sql = "INSERT INTO test_preguntas (pregunta, respuesta_ok, respuesta_opc1, respuesta_opc2, respuesta_opc3, id_pruebaRapida ) VALUES (:m_pregunta, :m_respuesta, :m_opcion1, :m_opcion2, :m_opcion3, :m_id_pruebaRapida )";

    //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
    $resultado = $bds->prepare($sql);

    //ahora se ejecuta la sentencia, debemos sustituir los marcadores por las variables que contiene la informacion que el usuario ingreso
    $resultado->execute(array(":m_pregunta" => $pregunta, ":m_respuesta" => $respCorrecta, ":m_opcion1" => $op1, ":m_opcion2" => $op2, ":m_opcion3" => $op3, ":m_id_pruebaRapida" => $id_pruebaRapida));


    //liberamos la memoria para no consumir recursos de manera innecesaria

    echo ("Valores insertados correctamente en la tabla test_preguntas ");    
  }else{
    

    $id= $_POST['idPregunta'];

    $sql = "UPDATE test_preguntas SET pregunta= :m_pregunta, respuesta_ok= :m_respuesta, respuesta_opc1= :m_opc1, respuesta_opc2= :m_opc2, respuesta_opc3= :m_opc3 WHERE id_test_pregunta=:m_id";
    
    //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
    $resultado = $bds->prepare($sql);
    
    //ahora se ejecuta la sentencia, debemos sustituir los marcadores por las variables que contiene la informacion que el usuario ingreso
    $resultado->execute(array(":m_pregunta"=>$pregunta , ":m_respuesta"=>$respCorrecta, ":m_opc1"=>$op1, ":m_opc2"=>$op2 , ":m_opc3"=>$op3, ":m_id" => $id));



  }
}


function consultarPreguntas($idSelec){
  
    //llamamos al archivo donde se efectua la conexion a la BD
    include("../conectBD/Conexion.php");

     //hacemos un select en la tabla prueba rapida para recuperar el id_pruebaRapida  y usarlo en el select de la sifuiente consulta
 
     $sql2 = 'SELECT id_pruebaRapida FROM pruebarapida WHERE id_tema=:m_idTem';
     $res = $bds->prepare($sql2);
     $res->execute(array(":m_idTem" => $idSelec));
 
     //guardamos el resultado en la varible 
     $result = $res->fetch(PDO::FETCH_ASSOC);
     $id_pruebaRapida = $result["id_pruebaRapida"];

    //hacemos un select de  test_preguntas y lo mandamos en formato json para ser procesado en el front pasamos como condicion que seleccione donde se encuentre el id seleccionado 
    $registros = $bds->query('SELECT * FROM test_preguntas where id_pruebaRapida ='.$id_pruebaRapida)->fetchAll(PDO::FETCH_OBJ);

   
    // Codifica la matriz en formato JSON y envía la respuesta
    echo json_encode($registros);

    
}

function buscarTest(){
    // Incluimos el archivo de conexión a la base de datos
    include("../conectBD/Conexion.php");

    // Ejecutamos una consulta para seleccionar todos los campos de la tabla "pruebarapida"
    $resultado1 = $bds->query("SELECT * FROM pruebarapida")->fetchAll(PDO::FETCH_ASSOC);

    // Creamos un arreglo vacío para almacenar los resultados de la segunda consulta
    $array = array();

    // Recorremos cada registro del resultado de la primera consulta
    foreach($resultado1 as $test){
        // Ejecutamos una consulta para seleccionar "id_tema" y "nombre_tema" de la tabla "tema" donde "id_tema" sea igual al valor de $test['id_tema']
        $registros = $bds->query('SELECT id_tema, nombre_tema FROM tema where id_tema ='.$test['id_tema'])->fetchAll(PDO::FETCH_ASSOC);
        // Agregamos los resultados de la segunda consulta al arreglo $array
        $array = array_merge($array,$registros);
    }

    // Convertimos el arreglo $array a una cadena json y la imprimimos
    echo json_encode($array);
}


//funcion que elimina preguntas de la base de datos
function eliminaPreguntra( $idPregunta){

    //llamamos al archivo donde se efectua la conexion a la BD
    include("../conectBD/Conexion.php");

    //creamos la sentencia SQL UPDATE empleamos marcadores con el fin de evitar inyecciones SQL 
    $sql = 'DELETE FROM test_preguntas WHERE id_test_pregunta = :m_idTestP  ';
    // $sql = 'UPDATE tema SET nombre_tema= :m_nombre, img_tema= :m_imgTema, vCont_tema= :m_videoTema WHERE id_tema = :m_idTema ';

        //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
        $resultado = $bds->prepare($sql);

        //ahora se ejecuta la sentencia, debemos sustituir los marcadores por las variables que contiene la informacion que el usuario ingreso
        $resultado->execute(array(":m_idTestP" => $idPregunta));
        //liberamos la memoria para no consumir recursos de manera innecesaria
}

function actPregunta($idPregunta){
    //llamamos al archivo donde se efectua la conexion a la BD
    include("../conectBD/Conexion.php");

    

     //hacemos un select de  test_preguntas y lo mandamos en formato json para ser procesado en el front pasamos como condicion que seleccione donde se encuentre el id seleccionado 
     $registros = $bds->query('SELECT * FROM test_preguntas where id_test_pregunta ='.$idPregunta)->fetchAll(PDO::FETCH_OBJ);

   
     // Codifica la matriz en formato JSON y envía la respuesta
     echo json_encode($registros);


}