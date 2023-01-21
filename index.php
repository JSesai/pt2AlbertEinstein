<?PHP


    //llamamos al archivo donde se efectua la conexion a la BD
include("conectBD/Conexion.php");

//hacemos una consulta a la tabla de cursos
$registros = $bds->query('SELECT * FROM curso WHERE estatusCurso= "activo"')->fetchAll(PDO::FETCH_OBJ);

?>




<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/imgsysgerde/Logo_CAE.png" type="image/x-icon">
    <link rel="stylesheet" href="CSS/styles2.css">
    <title>SysGeRDE</title>
</head>

<body>
    <div class="container">


        <div class="menu">
            <nav>
                <input type="checkbox" name="" id="btnMenu" class="check">
                <label for="btnMenu" class="btnMenu"><img src="./img/imgsysgerde/meniu.png" alt="Menu"></label>
                <ul class="items">
                    <li class="itemMenu"><a href="index.php"><img src="img/imgsysgerde/Logo_CAE.png" alt="Inicio" class="logodeBarraNav"></a></li>
                    <li class="itemMenu"><a href="">Inicio</a></li>
                    <li class="itemMenu"><a href=""><img src="./img/imgsysgerde/mochila3.png" alt="mi mochila" class="imgMochila"></a></li>
                    <li class="itemMenu"><a href="temporal.php">Ofertas</a></li>
                    <li class="itemMenu"><a href="temporal.php">Contacto</a></li>
                    <li class="itemMenu"><a href="user_alumno/formLogin.php">Inicia Sesión</a></li>
                    <li class="itemMenu"><a href="user_alumno/formRegE.php">Registrate</a></li>
                    <li class="itemMenu"><input type="text" placeholder="Buscar"></li>
                    <li class="itemMenu"><a href="login.php">Administrar</a></li>


                </ul>
            </nav>
        </div>

        <!-- colocamos divs para contener las cards de los cursos-->


        <div class="cardCurso">
            <?PHP
            //empleamos un foreach para repetir la estructura de la tabla para cada registro y mostrarlos en pantalla
            foreach ($registros as $cursos) : ?>
                <div class="card">
                    <div class="card-header">
                        <h1 class="card_titulo"><?PHP echo $cursos->nombre_curso ?></h1>
                    </div>
                    <div class="card-body">
                        <div class="imagenCurso"><img src="img/<?php echo $cursos->imgCurso ?>" alt="" class="imgcard">
                        </div>
                        <div class="descripcionCurso">
                            <p><?PHP echo $cursos->descripcion_curso ?></p>

                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="costo">
                            <p><?PHP echo "$" . $cursos->valor ?></p>
                        </div>
                        <div class="mochila"><a href="user_alumno/fLogin.php?id=<?php echo $cursos->id_curso ?>"><img src="img/imgsysgerde/mochila3.png" alt="Agregar a mochila"></a></div>


                    </div>
                </div>
            <?PHP
            //cerramos el bucle
            endforeach;

            ?>



        </div>

        <div class="aside"></div>
        <div class="patas">
            <!-- Estructura del pie de pagina-->
            <div class="patas1">
                <!-- imagen y enlace a twiter-->
                <div class="itemfoot">
                    <a href="" id="twit"><img src="./img/imgsysgerde/twiter.png" alt="twiter"></a>



                </div>
                <!-- imagen y enlace a facebook-->
                <div class="itemfoot">
                    <a href="" id="faceb"><img src="./img/imgsysgerde/face.png" alt="facebook"></a>


                </div>

                <!-- imagen y enlace a whatsap-->
                <div class="itemfoot">
                    <a href="https://api.whatsapp.com/send/?phone=529516699142&text&type=phone_number&app_absent=0" id="wasap"><img src="./img/imgsysgerde/what.png" alt="Whatsap"></a>

                </div>

                <!-- imagen y enlace a telefono-->
                <div class="itemfoot">
                    <a href="tel:951 669 9142" id="phone"><img src="./img/imgsysgerde/tel.png" alt="Tel"></a>


                </div>

                <!-- imagen y enlace a maps-->
                <div class="itemfoot">
                    <a href="https://www.google.com/maps/place/Escuela+Albert+Einstein/@17.10813,-96.766385,16z/data=!4m5!3m4!1s0x0:0xbcba480ed497fd1c!8m2!3d17.1065512!4d-96.7669967?hl=es" target="_blank" rel="noopener noreferrer" id="map"><img src="./img/imgsysgerde/maps.png" alt="Maps"></a>

                </div>  
            </div>
            <div class="patas2">
            <p>&copy; Colegio Albert Einstein Oaxaca 2022. Todos los derechos reservados</p>
            <!-- © -->

            </div>

        </div>


    </div>




</body>

</html>