
<?PHP

//Validamos si se ha pulsado el boton submit nombrado: registraEst
if ($_POST["loginUsers"]) {



    //recuperamos variables globales y las almacenamos en variables locales
    $correo = $_POST["correo"];
    $pasUsr = $_POST["userPas"];
    $tabla = $_POST["tab"];


    //validamos el tipo de usuario 
    //valida si es administrador 
    if ($tabla == "Administrador") {
        //empleamos la funcion validaLog que nos ayudara a validar si el usuario existe le pasamos las variables que contienen los datos del usuario
        validaLogAdmin($correo, $pasUsr);

        //valida si es control escolar
    } elseif ($tabla == "control escolar") {
        // validaCont_esc($correo, $pasUsr);
        echo '<script>window.alert("Sitio En construccion!!");
        window.location.href ="index.php";
        </script>';
    } elseif ($tabla == "Directivo") {
        validaDir($correo, $pasUsr);
        
    } elseif ($tabla == "Docente") {
        // validaDocte($correo, $pasUsr);
        echo '<script>window.alert("Sitio En construccion!!");
        window.location.href ="index.php";
        </script>';
    } elseif ($tabla == "Tutor") {
        // validaTut($correo, $pasUsr);
        echo '<script>window.alert("Sitio En construccion!!");
        window.location.href ="index.php";
        </script>';
    } else {
        echo "invalido";
    }
}
//FUNCIONES QUE VALIDAN EN LA BD EL USUARIO Y CONTTRASEÑA PARA LOS DISTINTOS TIPOS DE USUARIOS,NO PERMITEN SANEAR EL INGRESO DE COMILLAS DOBLES Y SIMPLES"" '' EMPLEA htmlentities


//valida el usuario tutor
function validaTut($correo, $pasUsr)
{
    try {
        /*incluimos el archivo donde se encuentra la cadena de conexion */
        include("conectBD/Conexion.php");
        //incluimos los atributos para manejo de errores
        $bds->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //incluimos uso de caracteres especiales
        $bds->exec("SET CHARACTER SET utf8");

        //creamos la sentencia SQL select donde se muestra resultado si el id_medico y Password coinciden con lo introducido
        //por el usuario,  empleamos marcadores con el fin de evitar inyecciones SQL 


        //creamos la sentencia SQL INSERT empleamos marcadores con el fin de evitar inyecciones SQL 
        $sql = "SELECT  nomTut, apePaTut, pass  FROM tutor WHERE correo = :m_correo AND pass = :m_pas";
        //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
        $resultado = $bds->prepare($sql);

        //escapamos caracteres para evitar inyeccion SQL y hacemos uso de las variables que recibe la funcion 
        $logcorreo = htmlentities(addslashes($correo));
        $logpas = htmlentities(addslashes($pasUsr));

        //Hacemos uso de bindValue para identificar los marcadores y sustituirlos por las variables que contiene id y contraseña
        $resultado->bindValue(":m_correo", $logcorreo);
        $resultado->bindValue(":m_pas", $logpas);

        //ejecutamos 
        $resultado->execute();

        //empleamos una variable para guardar lo que devuelve la funcion rowCount que devuelve el numero de filas en nuestro caso sera 1 ó 0
        $numero_reg = $resultado->rowCount();

        //evaluamos si se devolvio un 1
        if ($numero_reg != 0) {
            //si el usuario y contraseña son correctos entra a este bloque 



            //iniciamos una sesion para el usuario que se ha logeado para poder ingresar a las paginas destino
            session_start();

            //almacenamos en la variable global $_SESION el login del usuario con ayuda de la global post
            $_SESSION["usuario"] = $_POST["correo"];



            //redirigimos a la pagina de pacientes
            header("location:user_tutor/index.php");
        } else {

            echo '<script>
   alert("Datos incorrectos");
   
   </script>';

            header("location:login.php");
        }
    } catch (Exception $e) {
        die("Error:" . $e->getMessage());
    }
}

//valida el usuario directivo
function validaDir($correo, $pasUsr){
    
        try {
    
    
            /*incluimos el archivo donde se encuentra la cadena de conexion */
            include("conectBD/Conexion.php");
            //incluimos los atributos para manejo de errores
            $bds->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //incluimos uso de caracteres especiales
            $bds->exec("SET CHARACTER SET utf8");
    
            //creamos la sentencia SQL select donde se muestra resultado si el id_medico y Password coinciden con lo introducido
            //por el usuario,  empleamos marcadores con el fin de evitar inyecciones SQL 
            
            $status="activo";
            //creamos la sentencia SQL SELECT empleamos marcadores con el fin de evitar inyecciones SQL 
            $sql = 'SELECT id_directivo , correo, pass, estatus_directivo, nombre_dir, apePat_dir FROM directivo WHERE correo = :m_correo AND pass = :m_pas AND estatus_directivo= :m_status';
            //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
            $resultado = $bds->prepare($sql);
    
            //sustituir los marcadores por las variables recuperadas del metodo POST que contiene la informacion que el usuario ingreso
            $resultado->execute(array(":m_correo" => $correo, ":m_pas" => $pasUsr, ":m_status"=>$status));
    
            //guardamos el resultado en la varible registro
            $registro = $resultado->fetch(PDO::FETCH_ASSOC);
    
            //validamos si existe el registro accediendo con la variable registro e indicando el nombre del campo tal cual esta en la base de datos
            if ($registro["correo"] == $correo && $registro["pass"] == $pasUsr && $registro["estatus_directivo"] == $status) {
                //si el usuario y contraseña son correctos entra a este bloque 
    
    
                //iniciamos una sesion para el usuario que se ha logeado para poder ingresar a las paginas destino
                session_start();
    
                //almacenamos en la variable global SESSION el id del usuario con el que ha niciado sesion para poder hacer consultas posteriormente usando where
                $_SESSION["IdUser"] = $registro["id_directivo "];
    
                //almacenamos en la variable global $_SESION el nombre del usuario con ayuda de lo recuperado de la consulta.
                $_SESSION["usuario"] = $registro["nombre_dir"];
    
                $_SESION["TpoUser"]= "Directivo";
                //redirigimos a la pagina de index de directivo
                header("location:user_directivo/index.php");
            } else {
                //si no coinciden el id y contraseña dirige a la pagina de logeo
                //mostramos mensaje de registro exitoso
                echo '<script>window.alert("Valida los datos, o registrate!!");
            window.location.href ="login.php";
            </script>';
                $resultado->closeCursor();
            }
        } catch (Exception $e) {
            die("Error:" . $e->getMessage());
        }
    
}

//valida el usuario Docente
function validaDocte($idUsr, $pasUsr)
{
}





//FUNCIONES QUE VALIDAN EN LA BD EL USUARIO Y CONTTRASEÑA PARA LOS DISTINTOS TIPOS DE USUARIOS,NO PERMITEN SANEAR EL INGRESO DE COMILLAS DOBLES Y SIMPLES"" '' EMPLEA htmlentities
function validaCont_esc($idUsr, $pasUsr)
{


    echo '<script>window.alert("Sitio En construccion!!");
    window.location.href ="index.php";
    </script>';
    // try {


    //     /*incluimos el archivo donde se encuentra la cadena de conexion */
    //     include("BD/Conexion");
    //     //incluimos los atributos para manejo de errores
    //     $bds->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //     //incluimos uso de caracteres especiales
    //     $bds->exec("SET CHARACTER SET utf8");

    //     //creamos la sentencia SQL select donde se muestra resultado si el id_medico y Password coinciden con lo introducido
    //     //por el usuario,  empleamos marcadores con el fin de evitar inyecciones SQL 

    //     $sql = "SELECT id_medico, nombre, apellidoPaterno, Password  FROM medicos WHERE id_medico = :m_id AND Password = :m_pas";
    //     //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
    //     $resultado = $bds->prepare($sql);

    //     //sustituir los marcadores por las variables recuperadas del metodo POST que contiene la informacion que el usuario ingreso
    //     $resultado->execute(array(":m_id" => $idUsr, ":m_pas" => $pasUsr));

    //     //guardamos el resultado en la varible registro
    //     $registro = $resultado->fetch(PDO::FETCH_ASSOC);

    //     //validamos si existe el registro accediendo con la variable registro e indicando el nombre del campo tal cual esta en la base de datos
    //     if ($registro["id_medico"] == $idUsr && $registro["Password"] == $pasUsr) {
    //         //si el usuario y contraseña son correctos entra a este bloque 


    //         //iniciamos una sesion para el usuario que se ha logeado para poder ingresar a las paginas destino
    //         session_start();

    //         //almacenamos en la variable global SESSION el id del usuario con el que ha niciado sesion para poder hacer consultas posteriormente usando where
    //         $_SESSION["IdUser"] = $registro["id_medico"];

    //         //almacenamos en la variable global $_SESION el nombre del usuario con ayuda de lo recuperado de la consulta.
    //         $_SESSION["usuario"] = $registro["nombre"];


    //         //redirigimos a la pagina de MEDICOS
    //         header("location:medico/index.php");
    //     } else {
    //         //si no coinciden el id y contraseña dirige a la pagina de logeo
    //         echo "Valida Info, NOTA:Pon DIV con meje ERROR y que se borre con css";
    //         header("location:logeo.php");
    //     }
    // } catch (Exception $e) {
    //     die("Error:" . $e->getMessage());
    // }
}


function validaLogAdmin($correo, $pasUsr){
    try {


        /*incluimos el archivo donde se encuentra la cadena de conexion */
        include("conectBD/Conexion.php");
        //incluimos los atributos para manejo de errores
        $bds->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //incluimos uso de caracteres especiales
        $bds->exec("SET CHARACTER SET utf8");

        //creamos la sentencia SQL select donde se muestra resultado si el id_medico y Password coinciden con lo introducido
        //por el usuario,  empleamos marcadores con el fin de evitar inyecciones SQL 

        $sql = "SELECT  id_admon, correo, pass, nombre_adm, apePat_adm FROM administrador WHERE correo = :m_correo AND pass = :m_pas";
        //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
        $resultado = $bds->prepare($sql);

        //sustituir los marcadores por las variables recuperadas del metodo POST que contiene la informacion que el usuario ingreso
        $resultado->execute(array(":m_correo" => $correo, ":m_pas" => $pasUsr));

        //guardamos el resultado en la varible registro
        $registro = $resultado->fetch(PDO::FETCH_ASSOC);

        //validamos si existe el registro accediendo con la variable registro e indicando el nombre del campo tal cual esta en la base de datos
        if ($registro["correo"] == $correo && $registro["pass"] == $pasUsr) {
            //si el usuario y contraseña son correctos entra a este bloque 


            //iniciamos una sesion para el usuario que se ha logeado para poder ingresar a las paginas destino
            session_start();

            //almacenamos en la variable global SESSION el id del usuario con el que ha niciado sesion para poder hacer consultas posteriormente usando where
            $_SESSION["IdUser"] = $registro["id_admon"];

            //almacenamos en la variable global $_SESION el nombre del usuario con ayuda de lo recuperado de la consulta.
            $_SESSION["usuario"] = $registro["nombre_adm"];


            //redirigimos a la pagina de MEDICOS
            header("location:user_adminV/index.php");
        } else {
            //si no coinciden el id y contraseña dirige a la pagina de logeo
            //mostramos mensaje de registro exitoso
            echo '<script>window.alert("Valida los datos, o registrate!!");
        window.location.href ="login.php";
        </script>';
            $resultado->closeCursor();
        }
    } catch (Exception $e) {
        die("Error:" . $e->getMessage());
    }
}

//funcion que nos ayuda a validar en la bd los campos id y contraseña , ESTA FUNCION PERMITE EL INGRESO DE "" '' SI QUEREMOS SANEAR DEBEMOS EMPLEAR htmlentities
function validaLogAdmins($correo, $pasUsr)
{
    try {
        /*incluimos el archivo donde se encuentra la cadena de conexion */
        include("conectBD/Conexion.php");
        //incluimos los atributos para manejo de errores
        $bds->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //incluimos uso de caracteres especiales
        $bds->exec("SET CHARACTER SET utf8");

        //creamos la sentencia SQL select donde se muestra resultado si el id_medico y Password coinciden con lo introducido
        //por el usuario,  empleamos marcadores con el fin de evitar inyecciones SQL 


        //creamos la sentencia SQL INSERT empleamos marcadores con el fin de evitar inyecciones SQL 
        $sql = "SELECT  id_admon, nombre_adm, apePat_adm FROM administrador WHERE correo = :m_correo AND pass = :m_pas";
        //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
        $resultado = $bds->prepare($sql);

        //escapamos caracteres para evitar inyeccion SQL y hacemos uso de las variables que recibe la funcion 
        $logcorreo = htmlentities(addslashes($correo));
        $logpas = htmlentities(addslashes($pasUsr));

        //Hacemos uso de bindValue para identificar los marcadores y sustituirlos por las variables que contiene id y contraseña
        $resultado->bindValue(":m_correo", $logcorreo);
        $resultado->bindValue(":m_pas", $logpas);

        //ejecutamos 
        $resultado->execute();

        //empleamos una variable para guardar lo que devuelve la funcion rowCount que devuelve el numero de filas en nuestro caso sera 1 ó 0
        $numero_reg = $resultado->rowCount();

        //evaluamos si se devolvio un 1
        if ($numero_reg != 0) {
            //si el usuario y contraseña son correctos entra a este bloque 



            //iniciamos una sesion para el usuario que se ha logeado para poder ingresar a las paginas destino
            session_start();

            //almacenamos en la variable global $_SESION el login del usuario con ayuda de la global post
            $_SESSION["usuario"] = $_POST["id_admon"];
            $_SESION["nombre"] = $_POST["nombre_adm"];



            //redirigimos a la pagina de pacientes
            header("location:user_adminV/index.php");
        } else {

            echo '<script>
             alert("Datos incorrectos");
             
             </script>';

            header("location:login.php");
        }
    } catch (Exception $e) {
        die("Error:" . $e->getMessage());
    }
}

//funcion que nos ayuda a validar en la bd los campos y evita la insercion de comillas dobles y simples
function validaEscapaComillasc($idUsr, $pasUsr)
{

    try {
        //instanciamos la clase PDO para hacer uso de sus metodos con la variable $bds
        $bds = new PDO('mysql:host=localhost; dbname=cm_js', 'root', '');

        /*instanciamos la clase PDO y le pasamos la cadena de conexion, en este caso sera para web server infinity free
  $bds= new PDO('mysql:host=sql111.epizy.com; dbname=epiz_32190745_cm_js', 'epiz_32190745', 'S3YPRoT2cBQsbd'); */

        $bds->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $bds->exec("SET CHARACTER SET utf8");

        //creamos la sentencia SQL INSERT empleamos marcadores con el fin de evitar inyecciones SQL 
        $sql = "SELECT Id_Paciente, nombre, apellidoPaterno, Password  FROM pacientes WHERE Id_Paciente = :m_Id AND Password = :m_pas";
        //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
        $resultado = $bds->prepare($sql);

        //escapamos caracteres para evitar inyeccion SQL y hacemos uso de las variables que recibe la funcion 
        $logid = htmlentities(addslashes($idUsr));
        $logpas = htmlentities(addslashes($pasUsr));

        //Hacemos uso de bindValue para identificar los marcadores y sustituirlos por las variables que contiene id y contraseña
        $resultado->bindValue(":m_Id", $logid);
        $resultado->bindValue(":m_pas", $logpas);

        //ejecutamos 
        $resultado->execute();

        //empleamos una variable para guardar lo que devuelve la funcion rowCount que devuelve el numero de filas en nuestro caso sera 1 ó 0
        $numero_reg = $resultado->rowCount();

        //evaluamos si se devolvio un 1
        if ($numero_reg != 0) {
            //si el usuario y contraseña son correctos entra a este bloque 



            //iniciamos una sesion para el usuario que se ha logeado para poder ingresar a las paginas destino
            session_start();

            //almacenamos en la variable global $_SESION el login del usuario con ayuda de la global post
            $_SESSION["usuario"] = $_POST["iduser"];



            //redirigimos a la pagina de pacientes
            header("location:pacientes/index.php");
        } else {
            echo "Valida Info, NOTA:Pon DIV con meje ERROR y que se borre con css";
            header("location:logeo.php");
        }
    } catch (Exception $e) {
        die("Error:" . $e->getMessage());
    }
}



?>


