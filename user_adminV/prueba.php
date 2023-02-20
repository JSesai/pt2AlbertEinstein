<?php

//condicioneamos el data enviado por metodo AJAX 
if(!isset($_POST["valor"])){
    //si esta vacio no hacemos nada
}else{
    //Si no esta vacio hacemos lo siguiente
    //recuperamos data con super global POST y almacenamos en variable local. 
    $id_curso= $_POST["valor"];

    try{

        //llamamos al archivo donde se efectua la conexion a la BD
        include("../conectBD/Conexion.php");
    
        //creamos la sentencia SQL INSERT empleamos marcadores con el fin de evitar inyecciones SQL 
        $sql= "SELECT id_tema , nombre_tema FROM tema WHERE id_curso = ?"; 
        //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
          
        //hacemossentencia preparada con el objeto conexion $bds que llama a la funcion prepare y le pasamos la consulta $sql y todo esto es guardado en variable $resultado
        $resultado= $bds->prepare($sql);
        
        //executamos la sentencia preparada y pasamos el valor a sustituir en el where $id_curso
        $resultado->execute(array($id_curso));

        $json= array();
        while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
            $json[]=array(
                'id_tema'=>$registro['id_tema'],
                'Nombre_tema'=>$registro['nombre_tema']
            );
           
        }

        $jsonstring=json_encode($json);
        echo $jsonstring;
        
        $resultado->closeCursor();
        


    
        //capturamos el error en caso de fallar la conexion
        }catch(Exception $e){
    
    
            //indicamos que nos muestre la linea de error
            echo "Error en linea: " . $e->getLine();
    
        }

    }
   

?>                                









