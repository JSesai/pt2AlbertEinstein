<?PHP
//se inicia o se reanuda la sesion cualquiera de las 2 posibilidades
session_start();
// Si existe una variable de sesión 'LAST_ACTIVITY' y ha pasado más de 15 minutos desde la última actividad
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    //redirige al archivo que destruye la sesion y rediracciona al login
    header("Location:../loginUsuarios/sessionExpired.php");
} elseif (!isset($_SESSION["usuario"]) && ($_SESSION['tpoUser'] != 'Administrator')) { //validamos si no existe la sesion con usuario y la sesion es distinta de directivo se expira la sesion
    //redirige al archivo que destruye la sesion y rediracciona al login
    header("Location:../loginUsuarios/sessionExpired.php");
} else {

    //recuperamos variables globales las almacenamos en locales para uso en este ambito
    //almacena el id del usuario
    $user = $_SESSION["IdUser"];
    //almacena el nombre del usuario
    $name = $_SESSION["usuario"];
    $imgPerfil = $_SESSION["imgPerfil"];
    $correo = $_SESSION["correo"];
    // echo $imgPerfil;
    include("../../conectBD/Conexion.php");
    try {
        //SI NO EXISTE EL REGISTRO HACERLO, SI YA EXISTE ACTUALIZARLO

        //llamamos al archivo donde se efectua la conexion a la BD

        //creamos la sentencia SQL select empleamos marcadores con el fin de evitar inyecciones SQL 
        $sql = "SELECT * FROM datper_admin WHERE id_admon=:m_id_admon";
        //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
        $resultado = $bds->prepare($sql);

        //ahora se ejecuta la sentencia, debemos sustituir el marcador por la variable que contiene el ID que el usuario ingreso
        $resultado->execute(array(":m_id_admon" => $user));

        $registro = $resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach ($registro as $admin) {
        }
        //capturamos el error en caso de fallar la conexion
    } catch (Exception $e) {


        //indicamos que nos muestre la linea de error
        echo "Error en linea: " . $e->getLine() . $e->getMessage();
    }
    try {
      
        //creamos la sentencia SQL select empleamos marcadores con el fin de evitar inyecciones SQL 
        $sql = "SELECT * FROM administrador WHERE id_admon=:m_id_admon";
        //hacemos uso de la sentencia preparada de nuestro objeto de conexion y le pasamos la sentencia sql
        $resultado = $bds->prepare($sql);

        //ahora se ejecuta la sentencia, debemos sustituir el marcador por la variable que contiene el ID que el usuario ingreso
        $resultado->execute(array(":m_id_admon" => $user));

        $registro = $resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach ($registro as $datAdm) {
        }
        //capturamos el error en caso de fallar la conexion
    } catch (Exception $e) {


        //indicamos que nos muestre la linea de error
        echo "Error en linea: " . $e->getLine() . $e->getMessage();
    }
}
// Asigna el tiempo actual a la variable de sesión 'LAST_ACTIVITY'
$_SESSION['LAST_ACTIVITY'] = time();
?>
<section class="d-flex justify-content-center">
       <article class="">
        <p class="">
        <h3 class="text-center">Datos personales</h3>
        </p>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Información básica</th>
                </tr>
                <tr>
                    <td colspan="3">Es posible que los directivos puedan ver parte de tu información al usar esta plataforma.</td>
                </tr>
            </thead>
            <tbody>
                <tr>

                </tr>
                <tr class="align-middle">
                    <th scope="row">Foto</th>
                    <td>Personaliza tu perfil con una foto</td>

                    <td colspan="2">
                        <?php ?>
                        <label for="imageInput" class="">
                            <img src="../datosPerfiles/imageProfile/<?php echo $imgPerfil ?>" class="imgAdmin" alt="Foto de perfil" onerror="this.onerror=null; this.src='../img/imgsysgerde/perfil.jpg'">
                        </label>
                        <input type="file" id="imageInput" accept="image/*" onchange="uploadImage(event)" style="display:none;">

                    </td>
                </tr>

                <tr>
                    <th scope="row">Nombre</th>
                    <td colspan="2"><?php echo  $datAdm['nombre_adm'].' '. $datAdm['apePat_adm'].' '.$datAdm['apeMa_adm'] ; ?></td>
                    <td colspan="2"><a href="#" data-bs-toggle="modal" data-bs-target="#modalNombre"><i class="bi bi-chevron-right"></i></a></td>

                </tr>
                <tr>
                    <th scope="row">Fecha de nacimiento</th>
                    <td colspan="2"><?php if (!empty($admin["fnac_admin"])) {echo $admin["fnac_admin"];} else {echo "Fecha de nacimiento no disponible";}?></td>
                    <td colspan="2"><a href="#" data-bs-toggle="modal" data-bs-target="#modalFnac"><i class="bi bi-chevron-right"></i></a></td>


                </tr>
                <tr>
                    <th scope="row">Edad</th>
                    <td colspan="2"><?php echo $admin["edad_admin"]; ?></td>
                    <td colspan="2"><a href="#"><i class="bi bi-chevron-right"></i></a></td>


                </tr>
                <tr>
                    <th scope="row">Genero</th>
                    <td colspan="2"><?php echo $admin["sexo_admin"] ?></td>
                    <td colspan="2"><a href="#" data-bs-toggle="modal" data-bs-target="#modalGenero"><i class="bi bi-chevron-right"></i></a></td>


                </tr>
                <tr>
                    <th scope="row">CURP</th>
                    <td colspan="2"><?php echo $admin["curp_admin"] ?></td>
                    <td colspan="2"><a href="#" data-bs-toggle="modal" data-bs-target="#modalCurp"><i class="bi bi-chevron-right"></i></a></td>
                </tr>
                <tr class="align-middle">
                    <th scope="row">Alergias</th>
                    <td colspan="2"><?php echo $admin["alergia_admin"] ?></td>
                    <td colspan="2"><a href="#" data-bs-toggle="modal" data-bs-target="#modalAlergia"><i class="bi bi-chevron-right"></i></a></td>
                </tr>
            </tbody>
        </table>

    </article>


    <!-- Modal Nombre -->
    <article>
        <div class="modal fade" id="modalNombre" name="modalNombre" tabindex="-1" aria-labelledby="modalNombreLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalNombreLabel">Edita tu Nombre</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="formDatoPersnalModal" name="formDatoPersnalModal" method="post" enctype="multipart/form-data">
                            
                                <div class="mb-3">
                                    <label for="Correo" class="form-label">Correo Establecido</label>
                                    <input type="text" id="correo" class="form-control" placeholder="<?php echo $correo ?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="nombreModal" id="nombreModal" placeholder="Nombre completo">
                                </div>
                                <div class="alto" id="validaNombre"></div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <input type="text" class="form-control" id="apePatModal" name="apePatModal" placeholder="Apeliido Paterno" aria-label="First name">
                                        <div class="alto" id="validaApe1"></div>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="apeMatModal" name="apeMatModal" placeholder="Apellido Materno" aria-label="Last name">
                                        <div class="alto" id="validaApe2"></div>
                                    </div>
                                    

                                </div>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </article>

    <!-- Modal fecha de nacimiento -->
    <article>

        <div class="modal fade" id="modalFnac" tabindex="-1" aria-labelledby="modalFnacLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalFnacLabel"><strong>Edita tu fecha de nacimiento</strong></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="mb-3" action="#" method="post" id="formFnacMod" name="formFnacMod">

                            <div class="mb-3">
                                <label for="correofna" class="form-label">Correo Establecido:</label>
                                <input type="text" id="correofna"  class="form-control" placeholder="<?php echo $correo ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="fechaNac" class="form-label">Selecciona tu fecha de nacimiento:</label>
                                <input type="date" name="fechaNac" id="fechaNac" class="form-control">
                            </div>

                            <div class="">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary" id="modFechnac">Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </article>

    <!-- Modal Curp -->
    <article>

        <div class="modal fade" id="modalCurp" tabindex="-1" aria-labelledby="modalCurpLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalCurpLabel">Edita tu CURP</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row" name="formCurp" id="formCurp">
                            <div class="mb-3">
                                <label for="disabledTextInput" class="form-label">Correo Establecido</label>
                                <input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $correo ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="curp" class="form-label">CURP</label>
                                <input type="text" class="form-control" id="inputCurp" name="inputCurp" placeholder="" value="<?= $admin['curp_admin']; ?>">
                            </div>
                            <div class="mb-3">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="modNombre">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </article>

    <!-- Modal genero -->
    <article>

        <div class="modal fade" id="modalGenero" tabindex="-1" aria-labelledby="modalGeneroLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalGeneroLabel">Edita tu Genero</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row" action="#" method="post" name="formGenero" id="formGenero">
                            <div class="mb-3">
                                <label for="disabledTextInput" class="form-label">Correo Establecido</label>
                                <input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $correo ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="genero" class="form-label">Genero</label>
                                <select class="form-select" id="genero" name="selectGnro">
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="No binario">Prefiero no decirlo</option>
                                </select>
                            </div>

                            <div class="">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="modNombre">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <!-- Modal Alergias -->
    <article>

        <div class="modal fade" id="modalAlergia" tabindex="-1" aria-labelledby="modalAlergiaLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalAlergiaLabel">Actualiza tus alergias</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row" action="#" method="post">
                            <div class="mb-3">
                                <label for="Correo" class="form-label">Correo Establecido</label>
                                <input type="text" id="correo" class="form-control" placeholder="<?php echo $correo ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="alergias" class="form-label">Describe tus alergias</label>
                                <textarea class="form-control" id="alergias" rows="3"> <?php echo $admin['alergia_admin']; ?> </textarea>
                            </div>
                            <div class="mb-3">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="modNombre">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </article>

</section>