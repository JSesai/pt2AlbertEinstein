<?php


//ESTE CODIGO CONSULTA LOS TEMAS Y LOS RETORNA CODIFICADOS EN FORMATO JSON 
include("../conectBD/Conexion.php");

//hacemos una consulta a la tabla de tema para extraer los nombres de los temas
$registros = $bds->query('SELECT id_tema, nombre_tema FROM tema')->fetchAll(PDO::FETCH_OBJ);


// Codifica la matriz en formato JSON y envía la respuesta
echo json_encode($registros);




//La función "funcionaBien" también hace una consulta a la base de datos y devuelve el resultado en formato JSON, pero utiliza la extensión MySQLi de PHP en lugar de PDO (que se utiliza en la primera consulta).
function funcionaBien(){

// Conecta a la base de datos y ejecuta la consulta
$conn = mysqli_connect("localhost", "root", "", "educae"); 
$query = "SELECT nombre_tema FROM tema";
$result = mysqli_query($conn, $query);

// Crea una matriz con los datos de la base de datos
$datos = array();
while ($row = mysqli_fetch_assoc($result)) {
  $datos[] = $row;
}

// Codifica la matriz en formato JSON y envía la respuesta
echo json_encode($datos);


}




?>

