<?php 

if(isset($_GET['clave'])){
    $usuario = $_GET['usuario'];
    $pass = $_GET['pass'];
    $clave = $_GET['clave'];
    echo 'usaste get y enviaste '.$usuario .$pass .$clave;
    
}


// function insert_ruta2(){
//  //llamamos al archivo donde se efectua la conexion a la BD
//  include("../conectBD/Conexion.php");

//  $nombreRuta= $_POST['nombreRuta'];
//  $coordinador= $_POST['coordinador'];
//  $turno= $_POST['turno'];

//  //creamos la sentencia SQL INSERT empleamos marcadores con el fin de evitar inyecciones SQL 
//  $sql = "INSERT INTO ruta (nombreRuta,coordinador,turno) VALUES (:m_nombreRuta, :m_coordinador, :m_turno)";

//  //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
//  $resultado = $bds->prepare($sql);

//  //ahora se ejecuta la sentencia, debemos sustituir los marcadores por las variables que contiene la informacion que el usuario ingreso
//  $resultado->execute(array(":m_nombreRuta" => $nombreRuta, ":m_coordinador" => $coordinador, ":m_turno" => $turno));
//  //liberamos la memoria para no consumir recursos de manera innecesaria

// }

//  function insert_ruta($nombreRuta,$coordinador,$turno){
//     $conectar= parent::conexion();
//     parent::set_names();
//     $sql="INSERT INTO ruta
//     (idRuta,nombreRuta,coordinador,turno) VALUES (NULL,?,?,?);";
//     $sql=$conectar->prepare($sql);
//     $sql->bindValue(1, $nombreRuta);
//     $sql->bindValue(2, $coordinador);
//     $sql->bindValue(3, $turno);
   
//     $sql->execute();
//      $result =$sql->fetchAll();

     
//       return $resultado=$sql->fetchAll();
   
// }



?>


