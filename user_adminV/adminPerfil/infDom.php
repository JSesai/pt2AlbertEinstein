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
    try {
        //SI NO EXISTE EL REGISTRO HACERLO, SI YA EXISTE ACTUALIZARLO

        //llamamos al archivo donde se efectua la conexion a la BD
        include("../../conectBD/Conexion.php");

        //creamos la sentencia SQL select empleamos marcadores con el fin de evitar inyecciones SQL 
        $sql = "SELECT * FROM datdom_admin WHERE id_admon=:m_id_admon";
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
}
// Asigna el tiempo actual a la variable de sesión 'LAST_ACTIVITY'
$_SESSION['LAST_ACTIVITY'] = time();
?>




<section class="d-flex justify-content-center  border border-danger">

    <article class="">
        <p class="">
        <h3 class="text-center">Datos del domicilio</h3>
        </p>
        <div class="msjIndicaciones">
            <p>Consideraciones:</p>
            <ul>
                <li>1. Presione sobre el botón Editar para llenar los campos.</li>
                <li>2. Capture su Código postal y dé clic en el botón Buscar para completar la información.</li>

            </ul>
        </div>

        <form class="row" action="#" method="post" id="datosDom">

            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="cp" class="form-label"><strong>Código postal*:</strong></label>
                </div>
                <div class="col-auto">
                    <input type="text" id="cp" class="form-control" placeholder="<?= $admin['cp']; ?>" disabled>
                </div>

            </div>
            <div class="row g-4 align-items-center">

                <div class="col-auto col-lg-4">
                    <label for="estado" class="form-label text-bold"><strong> Estado*:</strong></label>
                    <input type="text" id="estado" class="form-control" placeholder="<?= $admin['estado'] ?>" disabled>
                </div>
                <div class="col-auto col-lg-4">
                    <label for="municipio" class="form-label"><strong>Municipio*:</strong></label>
                    <input type="text" id="municipio" class="form-control" placeholder="<?= $admin['municipio']; ?>" disabled>
                </div>
                <div class="col-auto col-lg-4">
                    <label for="colonia" class="form-label"><strong>Colonia*:</strong></label>
                    <input type="text" id="colonia" class="form-control" placeholder="<?= $admin['colonia']; ?>" disabled>
                </div>
            </div>
            <div class="row g-3 align-items-center">

                <div class="col-auto col-lg-4">
                    <label for="calle" class="form-label text-bold"><strong> Calle*:</strong></label>
                    <input type="text" id="calle" class="form-control" placeholder="<?= $admin['calle'] ?>" disabled>
                </div>
                <div class="col-auto col-lg-4">
                    <label for="numExt" class="form-label"><strong>Numero exterior*:</strong></label>
                    <input type="text" id="numExt" class="form-control" placeholder="<?= $admin['numero'] ?>" disabled>
                </div>
                <div class="col-auto col-lg-4">
                    <label for="numInt" class="form-label"><strong>Numero interior:</strong></label>
                    <input type="text" id="numInt" class="form-control" placeholder="<?= $admin['num_int'] ?>" disabled>
                </div>
            </div>
            <div class="mb-3">
                <label for="ref" class="form-label"><strong>Referencia:</strong></label>
                <input type="email" class="form-control" id="ref" placeholder="<?= $admin['referencia']; ?>" disabled>
            </div>
            <div class="mb-3">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="modNombre">Cerrar</button> -->
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDatDom">Editar</a>
            </div>
        </form>
    </article>


</section>

<!-- Modal para datos del domicilio -->
<article>
    <div class="modal fade" id="modalDatDom" tabindex="-1" aria-labelledby="modalDatDomLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalDatDomLabel"><strong>Ingresa tus datos de domicilio</strong></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row" method="post" id="formDatosDomModal" name="formDatosDomModal">

                        <div class="row g-3 align-items-center">
                            <div class="col-auto">
                                <label for="inputCp" class="form-label"><strong>Código postal*:</strong></label>
                            </div>
                            <div class="col-auto">
                                <input type="text" id="inputCp" name="inputCp" class="form-control" value="<?= $admin['cp']; ?>">
                            </div>
                            <div class="col-auto">
                                <span id="" class="form-text">
                                    <a href="#" class="btn btn-success" id="btnCp">Buscar <i class="bi bi-search"></i></a>

                                </span>
                            </div>
                        </div>
                        <div class="row g-4 align-items-center">

                            <div class="col-auto col-lg-4">
                                <label for="estadoModal" class="form-label text-bold"><strong> Estado*:</strong></label>
                                <select class="form-select form-select-lg mb-3" name="estadoModal" id="estadoModal"></select>
                            </div>
                            <div class="col-auto col-lg-4">
                                <label for="municipioModal" class="form-label"><strong>Municipio*:</strong></label>
                                <select class="form-select form-select-lg mb-3" name="municipioModal" id="municipioModal"></select>
                            </div>
                            <div class="col-auto col-lg-4">
                                <label for="coloniaModal" class="form-label"><strong>Colonia*:</strong></label>
                                <select class="form-select form-select-lg mb-3" name="coloniaModal" id="coloniaModal"></select>
                            </div>
                        </div>
                        <div class="row g-3 mb-3 align-items-center">

                            <div class="col-auto col-lg-4">
                                <label for="calleModal" class="form-label text-bold"><strong> Calle*:</strong></label>
                                <input type="text" name="calleModal" id="calleModal" class="form-control" placeholder="<?= $admin['calle'] ?>" required>
                                <div class="alto" id="kalle"></div>
                            </div>
                            <div class="col-auto col-lg-4">
                                <label for="numExtModal" class="form-label"><strong>Numero exterior*:</strong></label>
                                <input type="text" name="numExtModal" id="numExtModal" class="form-control" placeholder="<?= $admin['numero'] ?>" required>
                                <div class="alto" id="numExterior"></div>
                            </div>
                            <div class="col-auto col-lg-4">
                                <label for="numIntModal" class="form-label"><strong>Numero interior:</strong></label>
                                <input type="text" name="numIntModal" id="numIntModal" class="form-control" placeholder="<?= $admin['num_int'] ?>">
                                <div class="alto" id="numeroInte"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="refModal" class="form-label"><strong>Referencia:</strong></label>
                            <input type="text" name="refModal" class="form-control" id="refModal" placeholder="<?= $admin['referencia']; ?>">
                            <div class="alto" id="referencia"></div>
                        </div>
                        <div class="mb-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="sas">Cerrar</button>
                            <button type="submit" class="btn btn-primary" id="enviaDat"> Guardar Cambios</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</article>