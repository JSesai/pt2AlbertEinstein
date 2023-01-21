<!-- VALIDACION DEL FORMULARIO DE INGRESO DEL ALUMNO -->
<?PHP

//Validamos si se ha pulsado el boton submit nombrado: registraEst
if ($_POST["al_ingreso"]) {
    //recuperamos variables globales y las almacenamos en variables locales
    $correo = $_POST["alCorreo"];
    $pasUsr = $_POST["alPas"];


    if (empty($correo)) {
        echo '<script>window.alert("El campo correo es requerido");
        window.location.href ="formLogin.php";
        </script>';
    } elseif (empty($pasUsr)) {
        echo '<script>window.alert("El campo Contraseña es requerido");
        window.location.href ="formLogin.php";
        </script>';
    } else {

        validaLogAlumno($correo, $pasUsr);
    }
}




function validaLogAlumno($correo, $pasUsr)
{
    try {

        /*incluimos el archivo donde se encuentra la cadena de conexion */
        include("../conectBD/Conexion.php");
        //incluimos los atributos para manejo de errores
        $bds->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //incluimos uso de caracteres especiales
        $bds->exec("SET CHARACTER SET utf8");

        // creamos la sentencia SQL select donde se muestra resultado si el correo y Password coinciden con lo introducido
        // por el usuario,  empleamos marcadores con el fin de evitar inyecciones SQL 
        $sql = "SELECT  id_matricula , nombre, correo, pass FROM alumno WHERE correo = :m_correo AND pass = :m_pas";

        //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
        $resultado = $bds->prepare($sql);

        //sustituimos los marcadores por las variables recuperadas del metodo POST que contiene la informacion que el usuario ingreso
        $resultado->execute(array(":m_correo" => $correo, ":m_pas" => $pasUsr));

        //guardamos el resultado en la varible registro
        $registro = $resultado->fetch(PDO::FETCH_ASSOC);



        //validamos si existe el registro accediendo con la variable registro e indicando el nombre del campo tal cual esta en la base de datos
        if ($registro["pass"] == $pasUsr and $registro["pass"] == $pasUsr) {

            //aqui va EL CAPTCHA OJO MUCHO OJO CUENTASELO AL CODIGO QUE MAS CONFIANZA LE TENGAS

            //iniciamos una sesion para el usuario que se ha logeado para poder ingresar a las paginas destino
            session_start();

            //almacenamos en la variable global SESSION el id del usuario con el que ha niciado sesion para poder hacer consultas posteriormente usando where
            $_SESSION["IdUser"] = $registro["id_matricula"];

            //almacenamos en la variable global $_SESION el nombre del usuario con ayuda de lo recuperado de la consulta.
            $_SESSION["usuario"] = $registro["nombre"];


            //redirigimos a la pagina de Inicio de Alumno
            header("location:index.php");
        } else {

            echo '<script>window.alert("Información invalida, Revisa tus datos.");
            window.location.href ="formLogin.php";
            </script>';
        }
    } catch (Exception $e) {
        //cachamos el error y mostramos mensaje de error concatenando la linea del error

        die("Error: " . $e->getMessage() . "En linea: " . $e->getLine());
    }
}

//Validamos si se ha pulsado el boton submit nombrado: registraEst
if (isset($_POST["al_ingresoF"])) {
    //recuperamos variables globales y las almacenamos en variables locales
    $correo = $_POST["alCorreo"];
    $pasUsr = $_POST["alPas"];


    if (empty($correo)) {
        echo '<script>window.alert("El campo correo es requerido");
        window.location.href ="formLogin.php";
        </script>';
    } elseif (empty($pasUsr)) {
        echo '<script>window.alert("El campo Contraseña es requerido");
        window.location.href ="formLogin.php";
        </script>';
    } else {

        validaLogAlum($correo, $pasUsr);
    }
}


function validaLogAlum($correo, $pasUsr)
{
    try {

        /*incluimos el archivo donde se encuentra la cadena de conexion */
        include("../conectBD/Conexion.php");
        //incluimos los atributos para manejo de errores
        $bds->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //incluimos uso de caracteres especiales
        $bds->exec("SET CHARACTER SET utf8");

        // creamos la sentencia SQL select donde se muestra resultado si el correo y Password coinciden con lo introducido
        // por el usuario,  empleamos marcadores con el fin de evitar inyecciones SQL 
        $sql = "SELECT  id_matricula , nombre, correo, pass FROM alumno WHERE correo = :m_correo AND pass = :m_pas";

        //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
        $resultado = $bds->prepare($sql);

        //sustituimos los marcadores por las variables recuperadas del metodo POST que contiene la informacion que el usuario ingreso
        $resultado->execute(array(":m_correo" => $correo, ":m_pas" => $pasUsr));

        //guardamos el resultado en la varible registro
        $registro = $resultado->fetch(PDO::FETCH_ASSOC);



        //validamos si existe el registro accediendo con la variable registro e indicando el nombre del campo tal cual esta en la base de datos
        if ($registro["pass"] == $pasUsr and $registro["pass"] == $pasUsr) {

            //aqui va EL CAPTCHA OJO MUCHO OJO CUENTASELO AL CODIGO QUE MAS CONFIANZA LE TENGAS

            //iniciamos una sesion para el usuario que se ha logeado para poder ingresar a las paginas destino
            session_start();

            //almacenamos en la variable global SESSION el id del usuario con el que ha niciado sesion para poder hacer consultas posteriormente usando where
            $_SESSION["IdUser"] = $registro["id_matricula"];

            //almacenamos en la variable global $_SESION el nombre del usuario con ayuda de lo recuperado de la consulta.
            $_SESSION["usuario"] = $registro["nombre"];


            //redirigimos a la pagina de Inicio de Alumno
            header("location:catalogoAlumno.php");
        } else {

            echo '<script>window.alert("Información invalida, Revisa tus datos.");
            window.location.href ="fLogin.php";
            </script>';
        }
    } catch (Exception $e) {
        //cachamos el error y mostramos mensaje de error concatenando la linea del error

        die("Error: " . $e->getMessage() . "En linea: " . $e->getLine());
    }
}




?>