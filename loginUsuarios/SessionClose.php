

<?PHP
//se inicia o se reanuda la sesion cualquiera de las 2 posibilidades
session_start();

//Destruimos la sesion actual
session_destroy();

//una vez cerrada la sesion direccionamos al usuario al inicio
header("Location:../index.php");

?>




