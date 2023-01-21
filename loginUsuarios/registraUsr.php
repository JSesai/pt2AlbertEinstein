<?PHP


//Validamos si se ha pulsado el boton submit nombrado: registraUsuario del formulario usuario
if ($_POST["registraUsuario"]) {



    //recuperamos variables globales del formulario y las almacenamos en variables locales

    $name = $_POST["nombreUsr"];
    $apePat = $_POST["apePatUsr"];
    $apeMat = $_POST["apematUser"];
    $correo = $_POST["mailUser"];
    $ps = $_POST["passUser"];
    $confps = $_POST["confPassUser"];
    $tipoUsr = $_POST["tab"];

    //llamamos a la funcion que nos valida que los campos no se encuentren vacios, le pasamos variables recuperadas del form
    validDat($name, $apePat, $apeMat, $correo, $ps, $confps);
   // $tabla= setearUser($tipoUsr);

        
   
    // validaCorreo($correo, $ps, $tabla);
    

    //validamos el tipo de usuario 
    //valida si es administrador 
    if ($tipoUsr == "Administrador") {
        //empleamos la funcion validaLog que nos ayudara a validar si el usuario existe le pasamos las variables que contienen los datos del usuario
        registraAdmin($name, $apePat, $apeMat, $correo, $ps, $confps);

        //registro de control escolar
    } elseif ($tipoUsr == "Control escolar") {
        registraCescolar($name, $apePat, $apeMat, $correo, $ps, $confps);

        //registro de directivo
    } elseif ($tipoUsr == "Directivo") {
        registraDir($name, $apePat, $apeMat, $correo, $ps, $confps);

        //registro de docente
    } elseif ($tipoUsr == "Docente") {
        registraDocte($name, $apePat, $apeMat, $correo, $ps, $confps);

    } elseif ($tipoUsr == "Tutor") {
        registraTutor($name, $apePat, $apeMat, $correo, $ps, $confps);
    } else {
        echo "invalido";
    }
}

//registrar administrador de videos, primero validamos que no exista el correo registrado en la BD
function registraAdmin($name, $apePat, $apeMat, $correo, $ps){
     //llamamos al archivo donde se efectua la conexion a la BD
     include("../conectBD/Conexion.php");

     //creamos la sentencia SQL SELECT empleamos marcadores con el fin de evitar inyecciones SQL 
     $sql = 'SELECT correo FROM administrador WHERE correo =:m_correo';
     //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
     $resultado = $bds->prepare($sql);
 
     //ahora se ejecuta la sentencia, debemos sustituir el marcador por la variable que contiene el ID que el usuario ingreso
     $resultado->execute(array(":m_correo"=>$correo));
 
     $registro = $resultado->fetch(PDO::FETCH_ASSOC);
     //validamos si existe el registro 
     if ($registro) {
        
         echo '<script>window.alert("El correo electronico es invalido, ya se encuentra registrado");
             window.location.href ="formUsuario.html";
             </script>';
     } else {

        $estatus = "registrado";
    try {

        //llamamos al archivo donde se efectua la conexion a la BD
        include("../conectBD/Conexion.php");

        //creamos la sentencia SQL INSERT empleamos marcadores con el fin de evitar inyecciones SQL 
        $sql = "INSERT INTO administrador (nombre_adm, apePat_adm, apeMa_adm, correo, pass, estatus) VALUES (:m_nombre, :m_apeP, :m_apeM, :m_correo, :m_pas, :m_est)";

        //hacemos uso de nuestro objeto conexion $dbs con la sentencia preparada le debemos de pasar la sentencia sql
        $resultado = $bds->prepare($sql);

        //ahora se ejecuta la sentencia prepara, debemos sustituir los marcadores por las variables que contiene la informacion que el usuario ingreso
        $resultado->execute(array(":m_nombre" => $name, ":m_apeP" => $apePat, ":m_apeM" => $apeMat, ":m_correo" => $correo, ":m_pas" => $ps, ":m_est" => $estatus));

        //liberamos la memoria para no consumirn recursos de manera innecesaria
        // $resultado->closeCursor();

        //mostramos mensaje de registro exitoso y direccionamos al inicio
        echo '<script>window.alert("Te has registrado!!");
             window.location.href ="user_adminV/index.php";
             </script>';
             //AQUI VA EL CAPTCHA

        //capturamos el error en caso de fallar la conexion
    } catch (Exception $e) {


        //indicamos que nos muestre la linea de error
        echo "Error en" . $e->getLine() . $e->getMessage();
    }
         
     }

}


//registrar Docente, primero validamos que no exista el correo registrado en la BD
function registraCescolar($name, $apePat, $apeMat, $correo, $ps){
    //llamamos al archivo donde se efectua la conexion a la BD
    include("../conectBD/Conexion.php");

    //creamos la sentencia SQL SELECT empleamos marcadores con el fin de evitar inyecciones SQL 
    $sql = 'SELECT correo FROM control_escolar WHERE correo =:m_correo';
    //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
    $resultado = $bds->prepare($sql);

    //ahora se ejecuta la sentencia, debemos sustituir el marcador por la variable que contiene el ID que el usuario ingreso
    $resultado->execute(array(":m_correo"=>$correo));

    $registro = $resultado->fetch(PDO::FETCH_ASSOC);
    //validamos si existe el registro 
    if ($registro) {
       
        echo '<script>window.alert("El correo electronico es invalido, ya se encuentra registrado");
            window.location.href ="registraUsr.php";
            </script>';
    } else {

        //Ahora que se ha validado que el correo no existe, se realiza el registro
       $estatus = "registrado";
   try {

       //llamamos al archivo donde se efectua la conexion a la BD
       include("../conectBD/Conexion.php");

       //creamos la sentencia SQL INSERT empleamos marcadores con el fin de evitar inyecciones SQL 
       $sql = "INSERT INTO control_escolar (nom_cont_esc, apePat_comt_esc, apeMat_cont_esc, correo, pass, estatus) VALUES (:m_nombre, :m_apeP, :m_apeM, :m_correo, :m_pas, :m_est)";

       //hacemos uso de nuestro objeto conexion $dbs con la sentencia preparada le debemos de pasar la sentencia sql
       $resultado = $bds->prepare($sql);

       //ahora se ejecuta la sentencia prepara, debemos sustituir los marcadores por las variables que contiene la informacion que el usuario ingreso
       $resultado->execute(array(":m_nombre" => $name, ":m_apeP" => $apePat, ":m_apeM" => $apeMat, ":m_correo" => $correo, ":m_pas" => $ps, ":m_est" => $estatus));

       //liberamos la memoria para no consumirn recursos de manera innecesaria
       // $resultado->closeCursor();

       //mostramos mensaje de registro exitoso y direccionamos al inicio
       echo '<script>window.alert("Te has registrado!!");
            window.location.href ="user_cEscolar/index.php";
            </script>';

       //capturamos el error en caso de fallar la conexion
   } catch (Exception $e) {


       //indicamos que nos muestre la linea de error
       echo "Error en" . $e->getLine() . $e->getMessage();
   }
        
    }

}

//registrar Docente, primero validamos que no exista el correo registrado en la BD
function registraDir($name, $apePat, $apeMat, $correo, $ps){
    //llamamos al archivo donde se efectua la conexion a la BD
    include("../conectBD/Conexion.php");

    //creamos la sentencia SQL SELECT empleamos marcadores con el fin de evitar inyecciones SQL 
    $sql = 'SELECT correo FROM directivo WHERE correo =:m_correo';
    //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
    $resultado = $bds->prepare($sql);

    //ahora se ejecuta la sentencia, debemos sustituir el marcador por la variable que contiene el ID que el usuario ingreso
    $resultado->execute(array(":m_correo"=>$correo));

    $registro = $resultado->fetch(PDO::FETCH_ASSOC);
    //validamos si existe el registro 
    if ($registro) {
       
        echo '<script>window.alert("El correo electronico es invalido, ya se encuentra registrado");
            window.location.href ="registraUsr.php";
            </script>';
    } else {

        //Ahora que se ha validado que el correo no existe, se realiza el registro
       $estatus = "registrado";
   try {

       //llamamos al archivo donde se efectua la conexion a la BD
       include("../conectBD/Conexion.php");

       //creamos la sentencia SQL INSERT empleamos marcadores con el fin de evitar inyecciones SQL 
       $sql = "INSERT INTO directivo (nombre_dir, apePat_dir, apeMa_dir, correo, pass, estatus) VALUES (:m_nombre, :m_apeP, :m_apeM, :m_correo, :m_pas, :m_est)";

       //hacemos uso de nuestro objeto conexion $dbs con la sentencia preparada le debemos de pasar la sentencia sql
       $resultado = $bds->prepare($sql);

       //ahora se ejecuta la sentencia prepara, debemos sustituir los marcadores por las variables que contiene la informacion que el usuario ingreso
       $resultado->execute(array(":m_nombre" => $name, ":m_apeP" => $apePat, ":m_apeM" => $apeMat, ":m_correo" => $correo, ":m_pas" => $ps, ":m_est" => $estatus));

       //liberamos la memoria para no consumirn recursos de manera innecesaria
       // $resultado->closeCursor();

       //mostramos mensaje de registro exitoso y direccionamos al inicio
       echo '<script>window.alert("Te has registrado!!");
            window.location.href ="user_directivo/index.php";
            </script>';

       //capturamos el error en caso de fallar la conexion
   } catch (Exception $e) {


       //indicamos que nos muestre la linea de error
       echo "Error en" . $e->getLine() . $e->getMessage();
   }
        
    }

}

//registrar Docente, primero validamos que no exista el correo registrado en la BD
function registraDocte($name, $apePat, $apeMat, $correo, $ps){
    //llamamos al archivo donde se efectua la conexion a la BD
    include("../conectBD/Conexion.php");

    //creamos la sentencia SQL SELECT empleamos marcadores con el fin de evitar inyecciones SQL 
    $sql = 'SELECT correo FROM docente WHERE correo =:m_correo';
    //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
    $resultado = $bds->prepare($sql);

    //ahora se ejecuta la sentencia, debemos sustituir el marcador por la variable que contiene el ID que el usuario ingreso
    $resultado->execute(array(":m_correo"=>$correo));

    $registro = $resultado->fetch(PDO::FETCH_ASSOC);
    //validamos si existe el registro 
    if ($registro) {
       
        echo '<script>window.alert("El correo electronico es invalido, ya se encuentra registrado");
            window.location.href ="registraUsr.php";
            </script>';
    } else {

        //Ahora que se ha validado que el correo no existe, se realiza el registro
       $estatus = "registrado";
   try {

       //llamamos al archivo donde se efectua la conexion a la BD
       include("../conectBD/Conexion.php");

       //creamos la sentencia SQL INSERT empleamos marcadores con el fin de evitar inyecciones SQL 
       $sql = "INSERT INTO docente (nombre_doc, apePat_doc, apeMa_doc, correo, pass, estatus) VALUES (:m_nombre, :m_apeP, :m_apeM, :m_correo, :m_pas, :m_est)";

       //hacemos uso de nuestro objeto conexion $dbs con la sentencia preparada le debemos de pasar la sentencia sql
       $resultado = $bds->prepare($sql);

       //ahora se ejecuta la sentencia prepara, debemos sustituir los marcadores por las variables que contiene la informacion que el usuario ingreso
       $resultado->execute(array(":m_nombre" => $name, ":m_apeP" => $apePat, ":m_apeM" => $apeMat, ":m_correo" => $correo, ":m_pas" => $ps, ":m_est" => $estatus));

       //liberamos la memoria para no consumirn recursos de manera innecesaria
       // $resultado->closeCursor();

       //mostramos mensaje de registro exitoso y direccionamos al inicio
       echo '<script>window.alert("Te has registrado!!");
            window.location.href ="user_directivo/index.php";
            </script>';

       //capturamos el error en caso de fallar la conexion
   } catch (Exception $e) {


       //indicamos que nos muestre la linea de error
       echo "Error en" . $e->getLine() . $e->getMessage();
   }
        
    }

}

//registrar Docente, primero validamos que no exista el correo registrado en la BD
function registraTutor($name, $apePat, $apeMat, $correo, $ps){
    //llamamos al archivo donde se efectua la conexion a la BD
    include("../conectBD/Conexion.php");

    //creamos la sentencia SQL SELECT empleamos marcadores con el fin de evitar inyecciones SQL 
    $sql = 'SELECT correo FROM docente WHERE correo =:m_correo';
    //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
    $resultado = $bds->prepare($sql);

    //ahora se ejecuta la sentencia, debemos sustituir el marcador por la variable que contiene el ID que el usuario ingreso
    $resultado->execute(array(":m_correo"=>$correo));

    $registro = $resultado->fetch(PDO::FETCH_ASSOC);
    //validamos si existe el registro 
    if ($registro) {
       
        echo '<script>window.alert("El correo electronico es invalido, ya se encuentra registrado");
            window.location.href ="registraUsr.php";
            </script>';
    } else {

        //Ahora que se ha validado que el correo no existe, se realiza el registro
       $estatus = "registrado";
   try {

       //llamamos al archivo donde se efectua la conexion a la BD
       include("../conectBD/Conexion.php");

       //creamos la sentencia SQL INSERT empleamos marcadores con el fin de evitar inyecciones SQL 
       $sql = "INSERT INTO docente (nombre_doc, apePat_doc, apeMa_doc, correo, pass, estatus) VALUES (:m_nombre, :m_apeP, :m_apeM, :m_correo, :m_pas, :m_est)";

       //hacemos uso de nuestro objeto conexion $dbs con la sentencia preparada le debemos de pasar la sentencia sql
       $resultado = $bds->prepare($sql);

       //ahora se ejecuta la sentencia prepara, debemos sustituir los marcadores por las variables que contiene la informacion que el usuario ingreso
       $resultado->execute(array(":m_nombre" => $name, ":m_apeP" => $apePat, ":m_apeM" => $apeMat, ":m_correo" => $correo, ":m_pas" => $ps, ":m_est" => $estatus));

       //liberamos la memoria para no consumirn recursos de manera innecesaria
       // $resultado->closeCursor();

       //mostramos mensaje de registro exitoso y direccionamos al inicio
       echo '<script>window.alert("Te has registrado!!");
            window.location.href ="user_directivo/index.php";
            </script>';

       //capturamos el error en caso de fallar la conexion
   } catch (Exception $e) {


       //indicamos que nos muestre la linea de error
       echo "Error en" . $e->getLine() . $e->getMessage();
   }
        
    }

}

//valida que los datos no se encuentren vacios
function validDat($name, $apePat, $apeMat, $correo, $ps, $confps){

    //validamos que ninguna caja este vacia
    if (empty($name)) {
        echo '<script>window.alert("El campo nombre es requerido");
            window.location.href ="formRegE.php";
            </script>';
    } elseif (empty($apePat)) {
        echo '<script>window.alert("El campo Apellido Paterno es requerido");
            window.location.href ="formRegE.php";
            </script>';
    } elseif (empty($apeMat)) {
        echo '<script>window.alert("El campo Apellido Materno es requerido");
            window.location.href ="formRegE.php";
            </script>';
    } elseif (empty($correo)) {
        echo '<script>window.alert("El correo electronico es requerido");
            window.location.href ="formRegE.php";
            </script>';
    } elseif (empty($ps)) {
        echo '<script>window.alert("El campo contraseña es requerido");
            window.location.href ="formRegE.php";
            </script>';
    } elseif (empty($confps)) {
        echo '<script>window.alert("El campo Confirmar contraseña es requerido");
            window.location.href ="formRegE.php";
            </script>';
    }

    //expresiones regulares para validar datos

    //si password no es vacia
    if (!empty($ps)) {
        //validamos que contengan 8 posiciones
        if (strlen($ps) != 8) {
            echo '<script>window.alert("La contraseña dedbe tener 8 caracteres");
            window.location.href ="formRegE.php";
            </script>';
        }
        //validamos que contengan letras en minusculas
        elseif (!preg_match('`[a-z]`', $ps)) {
            echo '<script>window.alert("La Contraseña de tener letras en minusulas");
            window.location.href ="formRegE.php";
            </script>';
        }

        //validamos que contenga letras en mayuscula
        elseif (!preg_match('`[A-Z]`', $ps)) {
            echo '<script>window.alert("La Contraseña de tener letras en Mayusculas");
            window.location.href ="formRegE.php";
            </script>';
        }

        //validamos que contenga letras en mayuscula
        elseif (!preg_match('`[1-9]`', $ps)) {
            echo '<script>window.alert("La Contraseña de tener al menos un numero");
            window.location.href ="formRegE.php";
            </script>';
        }

        //validamos que contengan numeros 
        elseif (!preg_match('`[#$&%._-]`', $ps)) {
            echo " ";
            echo '<script>window.alert("Contraseña debe tener algun caracter especial #,$,-,_,&,%");
            window.location.href ="formRegE.php";
            </script>';
        } else {

            //comparamos los strings de las variables usando strcmp y almacenamos en variable compstr
            $compstr = strcmp($ps, $confps);


            if ($compstr) {
                echo '<script>window.alert("Ambas contraseñas deben de coincidir");
            window.location.href ="formRegE.php";
            </script>';
            } else {
                //validamos que el correo no exista en la tabla alumno con la funcion, le pasamos la variable que contiene el dato correo ingresado por el usuario
               // validaCorreo($name, $apePat, $apeMat, $correo, $ps, $confps);
                //entra a este bloque si coinciden las contraseñas


            }
        }
    }
}

//funcion que valida el correo con una consulta SELECT en tabla de BD
function validaCorreo($correo, $tabla)
{

    //llamamos al archivo donde se efectua la conexion a la BD
    include("../conectBD/Conexion.php");

    //creamos la sentencia SQL SELECT empleamos marcadores con el fin de evitar inyecciones SQL 
    $sql = 'SELECT correo FROM :m_tabla WHERE correo =:m_correo';
    //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
    $resultado = $bds->prepare($sql);

    //ahora se ejecuta la sentencia, debemos sustituir el marcador por la variable que contiene el ID que el usuario ingreso
    $resultado->execute(array("m:_tabla"=>$tabla, ":m_correo"=>$correo));

    $registro = $resultado->fetch(PDO::FETCH_ASSOC);
    //validamos si existe el registro 
    if ($registro) {
       
        echo '<script>window.alert("El correo electronico es invalido, ya se encuentra registrado");
            window.location.href ="formRegE.php";
            </script>';
    } else {
        
    }
}

function creaMatricula()
{
    //generamos un random
    $mat1 = "AE";
    $mat2 = rand(10, 100);
    $mat3 = rand(100, 200);
    $matricula = $mat1 . $mat2 . $mat3;


    //llamamos al archivo donde se efectua la conexion a la BD
    include("../conectBD/Conexion.php");

    //creamos la sentencia SQL select para comparar si ya existe la matricula 
    $sql = "SELECT matricula FROM alumno WHERE matricula = :m_matricula";
    //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
    $resultado = $bds->prepare($sql);

    //ahora se ejecuta la sentencia, debemos sustituir el marcador por la variable que contiene el ID que el usuario ingreso
    $resultado->execute(array(":m_matricula" => $matricula));

    $registro = $resultado->fetch(PDO::FETCH_ASSOC);
    //validamos si existe el registro 
    if ($registro) {

        creaMatricula();
    } else {
        return $mat1 . $mat2 . $mat3;
    }
}
// funcion que hace insert en la tabla alumno, con datos validados previamente
function insertAl($nameEst, $apePat, $apeMat, $correo, $ps, $matricula)
{
    $estatus = "registrado";
    try {

        //llamamos al archivo donde se efectua la conexion a la BD
        include("../conectBD/Conexion.php");

        //creamos la sentencia SQL INSERT empleamos marcadores con el fin de evitar inyecciones SQL 
        $sql = "INSERT INTO alumno (nombre, apePat, apeMat, estatus, correo, pass, matricula) VALUES (:m_nombre, :m_apeP, :m_apeM, :m_est, :m_correo, :m_pas, :m_mat)";

        //hacemos uso de nuestro objeto conexion $dbs con la sentencia preparada le debemos de pasar la sentencia sql
        $resultado = $bds->prepare($sql);

        //ahora se ejecuta la sentencia prepara, debemos sustituir los marcadores por las variables que contiene la informacion que el usuario ingreso
        $resultado->execute(array(":m_nombre" => $nameEst, ":m_apeP" => $apePat, ":m_apeM" => $apeMat, ":m_est" => $estatus, ":m_correo" => $correo, ":m_pas" => $ps, ":m_mat" => $matricula));

        //liberamos la memoria para no consumirn recursos de manera innecesaria
        // $resultado->closeCursor();

        //mostramos mensaje de registro exitoso y direccionamos al inicio
        echo '<script>window.alert("Te has registrado!!");
             window.location.href ="formRegE.php";
             </script>';

        //capturamos el error en caso de fallar la conexion
    } catch (Exception $e) {


        //indicamos que nos muestre la linea de error
        echo "Error en" . $e->getLine() . $e->getMessage();
    }
}
