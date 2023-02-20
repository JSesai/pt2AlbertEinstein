<?PHP
       
if($_POST['loginGoogle']){
    //recuperamos los datos enviados por post
    $ps= $_POST['idUser'];
    $nameEst= $_POST['nombre'];
    $apeMat= $_POST['ape'];
    $apePat= $_POST['ape'];
    $correo= $_POST['mail'];
    $imgPerfil= $_POST['imgPerfil'];
    echo $imgPerfil;
    
    //creamos matricula
    $matricula= creaMatricula();
    //incluimos el archivo de la conexion 
    include("../conectBD/Conexion.php");
    
    //validamos que correo no se encuentre registrado
    if(!validaCorreo($correo)){
        
        //llamamos al metodo que hace el registro del alumno, pasamos los datos
        insertAl($nameEst, $apePat, $apeMat, $correo, $ps, $matricula);

        //recuperamos el id matricula del estudiante para hacer el registro de la foto
        //creamos la sentencia SQL INSERT empleamos marcadores con el fin de evitar inyecciones SQL 
        $sql="SELECT id_matricula FROM alumno WHERE correo = :m_correo";
        //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
        $resultado= $bds->prepare($sql);
    
        //ahora se ejecuta la sentencia, debemos sustituir el marcador por la variable que contiene el ID que el usuario ingreso
        $resultado->execute(array(":m_correo"=>$correo));
        
        $registro= $resultado->fetch(PDO::FETCH_ASSOC);
        if($registro){
        
         $idMat= $registro['id_matricula'];
         $sql= "INSERT INTO datper_al (foto, id_matricula) VALUES (:m_foto, :m_matricula)";
         $resultado= $bds->prepare($sql);
    
         //ahora se ejecuta la sentencia prepara, debemos sustituir los marcadores por las variables que contiene la informacion que el usuario ingreso
         $resultado->execute(array(":m_foto"=>$imgPerfil, ":m_matricula"=>$idMat));
     
          
      }else{
          echo 'no esta registrado el usuario';
      }
    } 
    
    
}

//si se ha precionado el boton registraEst entra al siguiente bloque, el boton submit fuen nombrado: name="registraEst"
if(isset ($_POST["registraEst"])){

    //recuperamos variables globales del formulario y las almacenamos en variables locales
    
    $nameEst= $_POST["nombreAl"];
    $apePat= $_POST["apePat"];
    $apeMat= $_POST["apemat"];
    $correo= $_POST["correo"];
    $ps=$_POST["pass"];
    $confps=$_POST["passConf"];

    //llamamos a la funcion que nos valida campos le pasamos variables recuperadas del form
    validDat($nameEst, $apePat, $apeMat, $correo, $ps, $confps);
    //validamos que el correo no exista en la tabla alumno con la funcion, le pasamos la variable que contiene el dato correo ingresado por el usuario
    validaCorreo($correo);
    //creamos la matricula y la almacenamos
    $matricula= creaMatricula();
    //hacemos el insert y pasamos los datos
    insertAl($nameEst, $apePat, $apeMat, $correo, $ps, $matricula);


    
}

function validDat($nameEst, $apePat, $apeMat, $correo, $ps, $confps){

    //validamos que ninguna caja este vacia
    if(empty($nameEst)){
        echo'<script>window.alert("El campo nombre es requerido");
        window.location.href ="formRegE.php";
        </script>';
        

    } //validamos que nombre estudiante no contengan nuneros 
    elseif(!preg_match('/^[a-zA-ZÀ-ÿ\s]{1,40}$/',$nameEst)){
        echo'<script>window.alert("El nombre de usuario no debe contener numeros");
    window.location.href ="formRegE.php";
    </script>';
    } 
    // elseif(empty($apePat)){
    //     echo'<script>window.alert("El campo Apellido Paterno es requerido");
    //     window.location.href ="formRegE.php";
    //     </script>';
    // } //validamos que apellido paterno no contengan nuneros en apelido paterno
    elseif(!preg_match('/^[a-zA-ZÀ-ÿ\s]{0,40}$/',$apePat)){
        echo'<script>window.alert("Apellido paterno no debe de tener numeross");
    window.location.href ="formRegE.php";
    </script>';
    } 
    elseif(empty($apeMat)){
        echo'<script>window.alert("El campo Apellido Materno es requerido");
        window.location.href ="formRegE.php";
        </script>';
    }
        //validamos que no se metan numeros en apellido materno
        elseif(!preg_match('/^[a-zA-ZÀ-ÿ\s]{1,40}$/',$apeMat)){
        echo'<script>window.alert("Apellido materno no debe contener numeros");
    window.location.href ="formRegE.php";
    </script>';
    } 
    elseif(empty($correo)){
        echo'<script>window.alert("El correo electronico es requerido");
        window.location.href ="formRegE.php";
        </script>';
    } //validamos que el formato de correo sea correcto
    elseif(!preg_match('/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/',$correo)){
        echo'<script>window.alert("Formato de correo invalido");
    window.location.href ="formRegE.php";
    </script>';
    } 
    elseif(empty($ps)){
        echo'<script>window.alert("El campo contraseña es requerido");
        window.location.href ="formRegE.php";
        </script>';
    } //validamos el formato de contraseña tenga una minuscula
    elseif(!preg_match('/[a-z]{1,}/',$ps)){
        echo'<script>window.alert("Falta Minusculas en paswword");
    window.location.href ="formRegE.php";
    </script>';
    }  //validamos el formato de contraseña tenga una Mayuscula
    elseif(!preg_match('/[A-Z]{1,}/',$ps)){
        echo'<script>window.alert("Falta Mayusculas en paswword");
    window.location.href ="formRegE.php";
    </script>';
    }  //validamos el formato de contraseña tenga un nunmero
    elseif(!preg_match('/[0-9]{1,}/',$ps)){
        echo'<script>window.alert("Agrega por lo menos un Numero a tu paswword");
    window.location.href ="formRegE.php";
    </script>';
    }  //validamos el formato de contraseña tenga un Caracter especial
    elseif(!preg_match('/[#,$&%!¡._-]{1,}/',$ps)){
        echo'<script>window.alert("Agrega un caracter especial (#,$&%!¡._-) a tu paswword. ");
    window.location.href ="formRegE.php";
    </script>';
    }  //validamos el formato de contraseña tenga una longitud de 8 caracteres
    elseif(!preg_match('/.{8}$/',$ps)){
        echo'<script>window.alert("La longitud debe ser de 8 caracteres");
    window.location.href ="formRegE.php";
    </script>';
    } 
    elseif(empty($confps)){
        echo'<script>window.alert("El campo Confirmar contraseña es requerido");
        window.location.href ="formRegE.php";
        </script>';
    }

    //expresiones regulares para validar datos
    
    //si password no es vacia
    if(!empty($ps)){
        //validamos que contengan 8 posiciones
        if(strlen($ps)!=8){
            echo'<script>window.alert("La contraseña dedbe tener 8 caracteres");
        window.location.href ="formRegE.php";
        </script>';

        }elseif(!preg_match('`[a-z]`',$ps)){      //validamos que contengan letras en minusculas
        echo'<script>window.alert("La Contraseña de tener letras en minusulas");
        window.location.href ="formRegE.php";
        </script>';
        } elseif(!preg_match('`[A-Z]`',$ps)){ //validamos que contenga letras en mayuscula
            echo'<script>window.alert("La Contraseña de tener letras en Mayusculas");
        window.location.href ="formRegE.php";
        </script>';
        }elseif(!preg_match('`[1-9]`',$ps)){ //validamos que contenga letras en mayuscula
            echo'<script>window.alert("La Contraseña de tener al menos un numero");
        window.location.href ="formRegE.php";
        </script>';
        } elseif(!preg_match('`[#$&%._-]`',$ps)){    //validamos que contengan caracteres especiales 
               
            echo'<script>window.alert("Contraseña debe tener algun caracter especial #,$,-,_,&,%");
        window.location.href ="formRegE.php";
        </script>';
        }else{  //comparamos los strings de las contraseñas de las variables usando strcmp y almacenamos en variable compstr
       
        $compstr= strcmp($ps,$confps);
            
        
        if($compstr){
            echo'<script>window.alert("Ambas contraseñas deben de coincidir");
        window.location.href ="formRegE.php";
        </script>';
        } else{
            // //validamos que el correo no exista en la tabla alumno con la funcion, le pasamos la variable que contiene el dato correo ingresado por el usuario
            // validaCorreo($nameEst, $apePat, $apeMat, $correo, $ps, $confps);
            //entra a este bloque si coinciden las contraseñas
            
            
        }
   
        }
    }

}

//funcion que valida el correo con una consulta SELECT en tabla de BD
function validaCorreo($correo){
        
    //llamamos al archivo donde se efectua la conexion a la BD
    include("../conectBD/Conexion.php");

    //creamos la sentencia SQL select empleamos marcadores con el fin de evitar inyecciones SQL 
    $sql="SELECT correo FROM alumno WHERE correo = :m_correo";
    //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
    $resultado= $bds->prepare($sql);

    //ahora se ejecuta la sentencia, debemos sustituir el marcador por la variable que contiene el ID que el usuario ingreso
    $resultado->execute(array(":m_correo"=>$correo));
    
    $registro= $resultado->fetch(PDO::FETCH_ASSOC);
    //validamos si existe el registro 
    if($registro){
        $resultado->closeCursor();
        echo'<script>window.alert("El correo electronico ya se encuentra registrado");
        window.location.href ="formRegE.php";
        </script>';
        return true;
    }else{
        //vamos a generar una funcion que nos genera de manera aleatoria la matricula y valida que no exista en la BD
        //insertamos los registros ya validados 
        // $matricula= creaMatricula();
        
        // insertAl($nameEst, $apePat, $apeMat, $correo, $ps, $matricula);
        return false;
    }

}

function creaMatricula(){
    //generamos un random
    $mat1= "AE";
    $mat2= rand(10,100);
    $mat3= rand(100,200);
    $matricula=$mat1.$mat2.$mat3;


    //llamamos al archivo donde se efectua la conexion a la BD
    include("../conectBD/Conexion.php");

    //creamos la sentencia SQL select para comparar si ya existe la matricula 
    $sql="SELECT matricula FROM alumno WHERE matricula = :m_matricula";
    //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
    $resultado= $bds->prepare($sql);

    //ahora se ejecuta la sentencia, debemos sustituir el marcador por la variable que contiene el ID que el usuario ingreso
    $resultado->execute(array(":m_matricula"=>$matricula));
    
    $registro= $resultado->fetch(PDO::FETCH_ASSOC);
    //validamos si existe el registro 
    if($registro){
        
        creaMatricula();
    }else{
    return $mat1.$mat2.$mat3;
    }
 
}

// funcion que hace insert en la tabla alumno, con datos validados previamente
function insertAl($nameEst, $apePat, $apeMat, $correo, $ps, $matricula){
    $estatus="registrado";
    try{

        //llamamos al archivo donde se efectua la conexion a la BD
        include("../conectBD/Conexion.php");
    
        //creamos la sentencia SQL INSERT empleamos marcadores con el fin de evitar inyecciones SQL 
        $sql= "INSERT INTO alumno (nombre, apePat, apeMat, estatus, correo, pass, matricula) VALUES (:m_nombre, :m_apeP, :m_apeM, :m_est, :m_correo, :m_pas, :m_mat)";
        
        //hacemos uso de nuestro objeto conexion $dbs con la sentencia preparada le debemos de pasar la sentencia sql
        $resultado= $bds->prepare($sql);
    
        //ahora se ejecuta la sentencia prepara, debemos sustituir los marcadores por las variables que contiene la informacion que el usuario ingreso
        $resultado->execute(array(":m_nombre"=>$nameEst, ":m_apeP"=>$apePat, ":m_apeM"=>$apeMat, ":m_est"=>$estatus, ":m_correo"=>$correo, ":m_pas"=>$ps, ":m_mat"=>$matricula ));
    
        //liberamos la memoria para no consumirn recursos de manera innecesaria
        // $resultado->closeCursor();

            //mostramos mensaje de registro exitoso y direccionamos al inicio
            echo'<script>window.alert("Te has registrado!!");
            window.location.href ="formLogin.php";
            </script>';
    
        //capturamos el error en caso de fallar la conexion
        }catch(Exception $e){
    
            //indicamos que nos muestre la linea de error
            echo "Error en".$e->getLine() . $e->getMessage();
    
        }
}
