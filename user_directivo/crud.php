<?php

if(isset($_POST['valor'])){

    $name= $_POST["nombreUsr"];
    $apePat= $_POST["apePatUsr"];
    $apeMat= $_POST["apematUser"];
    $correo= $_POST["mailUser"];
    $ps=$_POST["passUser"];
    $confps=$_POST["confPassUser"];

    insertDocente($name, $apePat, $apeMat, $correo, $ps, $confps);

}


 // funcion que hace insert en la tabla alumno, con datos validados previamente
 function insertDocente($name, $apePat, $apeMat, $correo, $ps, $confps){
    $estatus="registrado";
    try{

        

        //llamamos al archivo donde se efectua la conexion a la BD
        include("../conectBD/Conexion.php");
    
        //creamos la sentencia SQL INSERT empleamos marcadores con el fin de evitar inyecciones SQL 
        $sql= "INSERT INTO directivo (nombre_dir, apePat_dir, apeMa_dir, correo, pass, estatus_directivo) VALUES (:m_nombre, :m_apeP, :m_apeM, :m_est, :m_correo, :m_pas)";
        
        //hacemos uso de nuestro objeto conexion $dbs con la sentencia preparada le debemos de pasar la sentencia sql
        $resultado= $bds->prepare($sql);
    
        //ahora se ejecuta la sentencia prepara, debemos sustituir los marcadores por las variables que contiene la informacion que el usuario ingreso
        $resultado->execute(array(":m_nombre"=>$name, ":m_apeP"=>$apePat, ":m_apeM"=>$apeMat, ":m_est"=>$estatus, ":m_correo"=>$correo, ":m_pas"=>$ps ));
    
        //liberamos la memoria para no consumirn recursos de manera innecesaria
        // $resultado->closeCursor();

        echo 'registrado correctamente';
    
        //capturamos el error en caso de fallar la conexion
        }catch(Exception $e){
    
    
            //indicamos que nos muestre la linea de error
            echo "Error en".$e->getLine() . $e->getMessage();
    
        }
}







?>