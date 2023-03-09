<?php 

if(isset($_POST['formName'])){
    
    $admin = $_POST['idAdm'];
    $nombre = ucwords(strtolower($_POST['nombreModal']));
    $apePa = ucwords(strtolower($_POST['apePatModal']));
    $apeMa = ucwords(strtolower($_POST['apeMatModal']));

    try {
        //SI NO EXISTE EL REGISTRO HACERLO, SI YA EXISTE ACTUALIZARLO

        //llamamos al archivo donde se efectua la conexion a la BD
        include("../conectBD/Conexion.php");

        //creamos la sentencia SQL select empleamos marcadores con el fin de evitar inyecciones SQL 
        $sql=" SELECT * FROM administrador WHERE id_admon=:m_id_admon";
        //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
        $resultado= $bds->prepare($sql);

        //ahora se ejecuta la sentencia, debemos sustituir el marcador por la variable que contiene el ID que el usuario ingreso
        $resultado->execute(array(":m_id_admon" => $admin));
        
        $registro= $resultado->fetchAll(PDO::FETCH_ASSOC);
        $num_resultados = count($registro);
        
    
        //validamos si existe el registro 
        if($num_resultados==1){
        // actualizar nombre siempre va a ser este bloque en el que va caer pero por buena practica pondre el insert pero jamas caera siempre que exista su nombre
        
            try{
                
                //creamos la sentencia SQL UPDATE empleamos marcadores con el fin de evitar inyecciones SQL
                $sql = "UPDATE administrador SET nombre_adm = :m_nombre, apePat_adm = :m_apePa, apeMa_adm = :m_apeMa WHERE id_admon = :m_id_admon";

            
                //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
                $resultado = $bds->prepare($sql);
            
                //ahora se ejecuta la sentencia, debemos sustituir los marcadores por las variables que contiene la informacion que el usuario ingreso
                $resultado->execute(array(":m_nombre" => $nombre, ":m_apePa" => $apePa, ":m_apeMa" => $apeMa, ":m_id_admon" => $admin));
                
                $resultado->closeCursor();
        
            
            } catch (Exception $e) {
            
                
                //indicamos que nos muestre la linea de error
                echo "Error en linea: " . $e->getLine() . $e->getMessage();
            }

        }else{

            
                //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
                $resultado = $bds->prepare($sql);
                $sql= "INSERT INTO administrador (nombre_adm, apePat_adm, apeMa_adm) VALUES (:m_nombre, :m_apePa, :m_apeMa)";
                //ahora se ejecuta la sentencia, debemos sustituir los marcadores por las variables que contiene la informacion que el usuario ingreso
                $resultado->execute(array(":m_nombre" => $nombre, ":m_apePa" => $apePa, ":m_apeMa" => $apeMa, ":m_id_admon" => $admin));
                
                $resultado->closeCursor();
           
            
        }
        
        //capturamos el error en caso de fallar la conexion
    } catch (Exception $e) {
        
        
        //indicamos que nos muestre la linea de error
        echo "Error en linea: " . $e->getLine() . $e->getMessage();
    }
    
   
    
}

if(isset($_POST['formFnac'])){
    $fechaNac= $_POST['fechaNac'];
    $admin = $_POST['idAdm'];
    $hoy = date('Y-m-d');
    $fecha_nacimiento = new DateTime($fechaNac);
    $edad = $fecha_nacimiento->diff(new DateTime($hoy))->y;
    
    //comprobamos si existe registro hacemos el insert en la base de datos o update segun sea el caso
    try {
        //HACEMOS CONSULTA PARA SABER SI EXISTE ENTONCES ACTUALIZARLO, SINO HACER REGSTRO
        
        //llamamos al archivo donde se efectua la conexion a la BD
        include("../conectBD/Conexion.php");

        //creamos la sentencia SQL select empleamos marcadores con el fin de evitar inyecciones SQL 
        $sql="SELECT fnac_admin FROM datper_admin WHERE id_admon=:m_id_admon";
        //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
        $resultado= $bds->prepare($sql);

        //ahora se ejecuta la sentencia, debemos sustituir el marcador por la variable que contiene el ID que el usuario ingreso
        $resultado->execute(array(":m_id_admon" => $admin));
        
        $registro= $resultado->fetchAll(PDO::FETCH_ASSOC);
        $num_resultados = count($registro);
        //echo $num_resultados;
    
        //validamos si existe el registro si existe devuelve 1
        if($num_resultados==1){
        //hacemos el update del domicilio
        try{
            //echo "La edad es: " . $edad . " años.";
            
            //elimina nombre del archivo en la bd
            //creamos la sentencia SQL UPDATE empleamos marcadores con el fin de evitar inyecciones SQL
            $sql = "UPDATE datper_admin SET edad_admin = :m_edad_admin, fnac_admin = :m_fnac_admin  WHERE id_admon = :m_id_admon";
                       
            //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
            $resultado = $bds->prepare($sql);
        
            //ahora se ejecuta la sentencia, debemos sustituir los marcadores por las variables que contiene la informacion que el usuario ingreso
            $resultado->execute(array(":m_edad_admin" => $edad,":m_fnac_admin" => $fechaNac, ":m_id_admon" => $admin));
            
            $resultado->closeCursor();
    
           
        } catch (Exception $e) {
        
        
            //indicamos que nos muestre la linea de error
            echo "Error en linea: " . $e->getLine() . $e->getMessage();
        }
        
        
    }else{
        
        //creamos la sentencia SQL INSERT empleamos marcadores con el fin de evitar inyecciones SQL 
      
        $sql= "INSERT INTO datper_admin (edad_admin, fnac_admin ) VALUES (:m_edad_admin, :m_fnac_admin) WHERE id_admon = :m_id_admon ";

            // //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
            $resultado = $bds->prepare($sql);

            // //ahora se ejecuta la sentencia, debemos sustituir los marcadores por las variables que contiene la informacion que el usuario ingreso
            // $resultado->execute(array(":m_foto" => $nombre_imagen, ":m_id_admon" => $admin));
            $resultado->execute(array(":m_edad_admin" => $edad,":m_fnac_admin" => $fechaNac, ":m_id_admon" => $admin));
            // //liberamos la memoria para no consumir recursos de manera innecesaria
            $resultado->closeCursor();
            
        }
        




        //capturamos el error en caso de fallar la conexion
    } catch (Exception $e) {


        //indicamos que nos muestre la linea de error
        echo "Error en linea: " . $e->getLine() . $e->getMessage();
    }
}

if(isset($_POST['formGenero'])){
    $admin = $_POST['idAdm'];
    $genero = $_POST['selectGnro'];
    try {
        //HACEMOS CONSULTA PARA SABER SI EXISTE ENTONCES ACTUALIZARLO, SINO HACER REGSTRO
        
        //llamamos al archivo donde se efectua la conexion a la BD
        include("../conectBD/Conexion.php");

              
            //creamos la sentencia SQL UPDATE empleamos marcadores con el fin de evitar inyecciones SQL
            $sql = "UPDATE datper_admin SET sexo_admin = :m_sexo_admin WHERE id_admon = :m_id_admon";
                       
            //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
            $resultado = $bds->prepare($sql);
        
            //ahora se ejecuta la sentencia, debemos sustituir los marcadores por las variables que contiene la informacion que el usuario ingreso
            $resultado->execute(array(":m_sexo_admin" => $genero, ":m_id_admon" => $admin));
            
            $resultado->closeCursor();
    
           
        } catch (Exception $e) {
        
        
            //indicamos que nos muestre la linea de error
            echo "Error en linea: " . $e->getLine() . $e->getMessage();
        }
        
        
    }





if(isset($_POST['inputCp'])){  //manejo de datos para los datos de domicilio 
    //recuperamos los datos del formulario
    $cp= $_POST['inputCp'];
    $estado= $_POST['estadoModal'];
    $municipio= $_POST['municipioModal'];
    $colonia= $_POST['coloniaModal'];
    $calle= ucfirst(strtolower($_POST['calleModal']));
    $numero= $_POST['numExtModal'];
    $numInter= $_POST['numIntModal'];
    $referencia= ucfirst(($_POST['refModal']));
    $admin= $_POST['idAdm'];
    
    //comprobamos si existe registro hacemos el insert en la base de datos o update segun sea el caso
    try {
        //HACEMOS CONSULTA PARA SABER SI EXISTE ENTONCES ACTUALIZARLO, SINO HACER REGSTRO

        //llamamos al archivo donde se efectua la conexion a la BD
        include("../conectBD/Conexion.php");

        //creamos la sentencia SQL select empleamos marcadores con el fin de evitar inyecciones SQL 
        $sql="SELECT id_datdom_admin FROM datdom_admin WHERE id_admon=:m_id_admon";
        //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
        $resultado= $bds->prepare($sql);

        //ahora se ejecuta la sentencia, debemos sustituir el marcador por la variable que contiene el ID que el usuario ingreso
        $resultado->execute(array(":m_id_admon" => $admin));
        
        $registro= $resultado->fetchAll(PDO::FETCH_ASSOC);
        $num_resultados = count($registro);
        //echo $num_resultados;
    
        //validamos si existe el registro si existe devuelve 1
        if($num_resultados==1){
        //hacemos el update del domicilio
        try{
            
            //elimina nombre del archivo en la bd
            //creamos la sentencia SQL UPDATE empleamos marcadores con el fin de evitar inyecciones SQL
            $sql = "UPDATE datdom_admin SET cp = :m_cp, calle = :m_calle, numero = :m_numero, num_int = :m_num_int, colonia = :m_colonia, municipio = :m_municipio, referencia = :m_referencia, estado = :m_estado WHERE id_admon = :m_id_admon";

           
            //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
            $resultado = $bds->prepare($sql);
        
            //ahora se ejecuta la sentencia, debemos sustituir los marcadores por las variables que contiene la informacion que el usuario ingreso
            $resultado->execute(array(":m_cp" => $cp, ":m_calle" => $calle, ":m_numero" => $numero, ":m_num_int" => $numInter, ":m_colonia" => $colonia, ":m_municipio" => $municipio, ":m_referencia" => $referencia, ":m_estado" => $estado, ":m_id_admon" => $admin));
            
            $resultado->closeCursor();
    
           
        } catch (Exception $e) {
        
        
            //indicamos que nos muestre la linea de error
            echo "Error en linea: " . $e->getLine() . $e->getMessage();
        }
        
        
    }else{
        
        //creamos la sentencia SQL INSERT empleamos marcadores con el fin de evitar inyecciones SQL 
      
        $sql= "INSERT INTO datdom_admin (cp, calle, numero, num_int, colonia, municipio, referencia, estado, id_admon) VALUES (:m_cp, :m_calle, :m_numero, :m_num_int, :m_colonia, :m_municipio, :m_referencia, :m_estado, :m_id_admon)";

            // //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
            $resultado = $bds->prepare($sql);

            // //ahora se ejecuta la sentencia, debemos sustituir los marcadores por las variables que contiene la informacion que el usuario ingreso
            // $resultado->execute(array(":m_foto" => $nombre_imagen, ":m_id_admon" => $admin));
            $resultado->execute(array(":m_cp" => $cp, ":m_calle" => $calle, ":m_numero" => $numero, ":m_num_int" => $numInter, ":m_colonia" => $colonia, ":m_municipio" => $municipio, ":m_referencia" => $referencia, ":m_estado" => $estado, ":m_id_admon" => $admin));
            // //liberamos la memoria para no consumir recursos de manera innecesaria
            $resultado->closeCursor();
            echo 'Registro exitoso';
        }
        




        //capturamos el error en caso de fallar la conexion
    } catch (Exception $e) {


        //indicamos que nos muestre la linea de error
        echo "Error en linea: " . $e->getLine() . $e->getMessage();
    }
}



//evalua si existe el archivo de nombre imagenPerfil
if(isset($_FILES['imagenPerfil']['name'])){
    //recupera nombre de la magen
    $nombre_imagen = $_FILES['imagenPerfil']['name'];
    //guardamos el tipo de archivo seleccionado
    $tipo_imagen = $_FILES['imagenPerfil']['type'];
    //guardamos el tamaño del archivo
    $tam_imagen = $_FILES['imagenPerfil']['size'];
    $admin= $_POST['idAdm'];
   
    $respuesta = [];

    //si pesa menos de 2 MB  la sube directo caso contarrio se redimensiona la imagen
    if ($tam_imagen <= 10000000) {
        if ($tipo_imagen == "image/jpeg" || $tipo_imagen == "image/jpg" || $tipo_imagen == "image/png") {

            
            //llamamos al metodo para hacer el registro de la imagen
            $nuevoNombreImagen= moverFoto($nombre_imagen);
           
            registrarimgPerfil( $admin, $nuevoNombreImagen);
            
            //consulta foto y la guarda en variable de session 
            consultaFoto($admin);

            $respuesta += ['alerta' => 'success', 'titulo'=>'Foto ok', 'mensaje'=>'foto agregada correctamente'];
            echo json_encode($respuesta);
            
            
            
            
        } else {
            
        }
    } else {
        
        $respuesta += ['alerta' => 'warning', 'titulo'=>'Foto demasiado pesada', 'mensaje'=>'ingrese otra foto'];
        echo json_encode($respuesta);

    
            
    }

}

function consultaFoto($admin){
    try {
        

        //llamamos al archivo donde se efectua la conexion a la BD
        include("../conectBD/Conexion.php");

        //creamos la sentencia SQL select empleamos marcadores con el fin de evitar inyecciones SQL 
        $sql="SELECT foto_admin FROM datper_admin WHERE id_admon=".$admin;
        //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
        $resultado= $bds->query($sql);

        
        $registro= $resultado->fetchAll(PDO::FETCH_ASSOC);
        // ($registro[0]['foto_admin']);
        session_start();
        $_SESSION["imgPerfil"]= $registro[0]['foto_admin'];
        


        

    } catch (Exception $e) {

        //indicamos que nos muestre la linea de error
        echo "Error en linea: " . $e->getLine() . $e->getMessage();
    }
}

//mueve la foto recibida a una carpeta especificada recuciendo el tamaño de la imagen retorna el nuevo nombre
function moverFoto($nombre_imagen){

    //definimos variable para la ruta de almacenamiento destino de la imagen seleccionada; colocamos la raiz del servidor concatenando la ruta de las carpetas
    $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/AlbertoEinstein/datosPerfiles/imageProfile/';
    
     
    $nuevo_ancho = 800;
    $nuevo_alto = 600;
    $ruta_temporal = $_FILES['imagenPerfil']['tmp_name'];
    $imagen = imagecreatefromjpeg($ruta_temporal);
    $nueva_imagen = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
    imagecopyresampled($nueva_imagen, $imagen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, imagesx($imagen), imagesy($imagen));
    $ruta_destino = $carpeta_destino . 'reducida_' . $nombre_imagen;
    imagejpeg($nueva_imagen, $ruta_destino, 80);

    return  'reducida_' . $nombre_imagen;
}

function registrarimgPerfil( $admin, $nuevoNombreImagen){
   

    try {
        //SI NO EXISTE EL REGISTRO HACERLO, SI YA EXISTE ACTUALIZARLO

        //llamamos al archivo donde se efectua la conexion a la BD
        include("../conectBD/Conexion.php");

        //creamos la sentencia SQL select empleamos marcadores con el fin de evitar inyecciones SQL 
        $sql="SELECT foto_admin FROM datper_admin WHERE id_admon=:m_id_admon";
        //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
        $resultado= $bds->prepare($sql);

        //ahora se ejecuta la sentencia, debemos sustituir el marcador por la variable que contiene el ID que el usuario ingreso
        $resultado->execute(array(":m_id_admon" => $admin));
        
        $registro= $resultado->fetchAll(PDO::FETCH_ASSOC);
        $num_resultados = count($registro);
        
    
        //validamos si existe el registro 
        if($num_resultados==1){
        //como no necesitamos guardar todas las fotos que sube debemos elminar la actual y subir la nueva foto
        //echo 'actualiza datos';
        $fotoAnt = $registro[0]['foto_admin'];
        
        // delImgPerfil($fotoAdmin);
        updateImgProfile($fotoAnt, $admin, $nuevoNombreImagen);

        }else{
           
            //creamos la sentencia SQL INSERT empleamos marcadores con el fin de evitar inyecciones SQL 
            $sql = "INSERT INTO datper_admin (foto_admin, id_admon) VALUES (:m_foto, :m_id_admon)";

            // //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
            $resultado = $bds->prepare($sql);

            // //ahora se ejecuta la sentencia, debemos sustituir los marcadores por las variables que contiene la informacion que el usuario ingreso
            $resultado->execute(array(":m_foto" => $nuevoNombreImagen, ":m_id_admon" => $admin));
            // //liberamos la memoria para no consumir recursos de manera innecesaria
            $resultado->closeCursor();
        }
        




        //capturamos el error en caso de fallar la conexion
    } catch (Exception $e) {


        //indicamos que nos muestre la linea de error
        echo "Error en linea: " . $e->getLine() . $e->getMessage();
    }

}

//actualiza la base de datos con el nuevo nombre de la imagen donde el id del admon conincida y elimina la imagen anterior fisica de la carpeta
function updateImgProfile($fotoAnt, $admin,$fotoActual){
    
    try{
        //llamamos al archivo donde se efectua la conexion a la BD
        include("../conectBD/Conexion.php");
        //elimina nombre del archivo en la bd
        //creamos la sentencia SQL UPDATE empleamos marcadores con el fin de evitar inyecciones SQL
        $sql = 'UPDATE datper_admin SET foto_admin=:m_fotoAdm WHERE id_admon=:m_id_admon';
       
        //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
        $resultado = $bds->prepare($sql);
    
        //ahora se ejecuta la sentencia, debemos sustituir los marcadores por las variables que contiene la informacion que el usuario ingreso
        $resultado->execute(array(":m_fotoAdm" => $fotoActual,":m_id_admon"=>$admin));
        
        $resultado->closeCursor();

       
             
        // elimina el archivo en la carpeta especificada
        $ruta =  'imageProfile/'.$fotoAnt;
        if (!unlink($ruta)) {
            // echo "Error al eliminar el archivo";
        } else {
            // echo "Archivo eliminado correctamente";
        }
    } catch (Exception $e) {
    
    
        //indicamos que nos muestre la linea de error
        echo "Error en linea: " . $e->getLine() . $e->getMessage();
    }
}
