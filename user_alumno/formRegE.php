<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/imgsysgerde/Logo_CAE.png" type="image/x-icon">
    <title>login</title>
    <link rel="stylesheet" href="../CSS/styleforms.css">






</head>

<body style=" background: rgb(176,223,226);
    background: linear-gradient(0deg, rgba(176,223,226,1) 0%, rgba(182,191,223,1) 48%);">

    <section>
        <div class="contenedorFormReg">
            <form action="registraE.php" method="POST" class="formReg" id="formulario">
                <h2 class="form_titleReg">Ingresa tus datos </h2>


                <div class="form_containerReg">
                    <div class="form_groupReg">
                        <input type="text" id="nombreAl" class="form_inputReg" placeholder=" " name="nombreAl" required>
                        <label for="nombreAl" class="form_labelReg">*Nombre:</label>
                        <span class="form_lineReg"></span>
                        <p class="mensajeError" id="mensajeError">Campo requerido, sin numeros, sin caracteres especiales</p>
                    </div>

                    <div class="form_groupReg">
                        <input type="text" id="apePat" class="form_inputReg" placeholder="  " name="apePat" >
                        <label for="apePat" class="form_labelReg">Apellido Paterno:</label>
                        <span class="form_lineReg"></span>
                        <p class="mensajeError" id="mensajeErrorApePat">Campo opcional sin numeros, sin caracteres especiales</p>
                    </div>

                    <div class="form_groupReg">
                        <input type="text" id="apemat" class="form_inputReg" placeholder=" " name="apemat" required>
                        <label for="apemat" class="form_labelReg">*Apellido Materno:</label>
                        <span class="form_lineReg"></span>
                        <p class="mensajeError" id="mensajeErrorApeMat">Campo requerido, sin numeros, sin caracteres especiales</p>

                    </div>

                    <div class="form_groupReg">
                        <input type="mail" id="correo" class="form_inputReg" placeholder=" " name="correo" required>
                        <label for="correo" class="form_labelReg">*Correo Electronico:</label>
                        <span class="form_lineReg"></span>
                        <p class="mensajeError" id="mensajeErrorMail">Formato de Correo Incorrecto</p>

                    </div>

                    <div class="form_groupReg">
                        <input type="password" id="pass" class="form_inputReg" placeholder=" " name="pass" id="pass" required>
                        <label for="pass" class="form_labelReg">*Contraseña:</label>
                        <span class="form_lineReg"></span>

                        <div class="validarPas" id="validarPas">
                            <p class="mensajeValidaciones" id="mensajeValidaciones">Tu contraseña debe contener:</p>
                            <p class="mensajeValidacion" id="mensajeValidacion">Una minuscula <img src="../img/imgsysgerde/correcto.png" alt="I/" id="imgOk" class="correcto"> <img src="../img/imgsysgerde/error.png" alt="X" id="imgMal" class="incorrecto"></p>
                            <p class="mensajeValidacion" id="mensajeValMay">Una Mayuscula <img src="../img/imgsysgerde/correcto.png" alt="I/" id="imgOkMay" class="correcto"> <img src="../img/imgsysgerde/error.png" alt="X" id="imgMalMay" class="incorrecto"></p>
                            <p class="mensajeValidacion" id="mensajeErrorPasNum">Un numero  <img src="../img/imgsysgerde/correcto.png" alt="I/" id="imgOkNum" class="correcto"> <img src="../img/imgsysgerde/error.png" alt="X" id="imgMalNum" class="incorrecto"></p>
                            <p class="mensajeValidacion" id="mensajeErrorPasChar">Un caracter especial <img src="../img/imgsysgerde/correcto.png" alt="I/" id="imgOkChar" class="correcto"> <img src="../img/imgsysgerde/error.png" alt="X" id="imgMalChar" class="incorrecto"></p>
                            <p class="mensajeValidacion" id="msgErrTamanio">Tamaño de 8 caracteres<img src="../img/imgsysgerde/correcto.png" alt="I/" id="imgOkTam" class="correcto"> <img src="../img/imgsysgerde/error.png" alt="X" id="imgMalTam" class="incorrecto"></p></p>
                         
                        </div>
                        <p class="FormatcorrectoPas"><img src="../img/imgsysgerde/correcto.png" alt="I/" id="imgOkPasFormato"></p>
                    </div>
                    <!-- grupo confirmar contraseña -->
                    <div class="form_groupReg">
                        <input type="password" id="passConf" class="form_inputReg" placeholder=" " name="passConf">
                        <label for="passConf" class="form_labelReg">*Confirma contraseña:</label>
                        <span class="form_lineReg"></span>
                        <p class="mensajeErrorPas" id="mensajeErrorPas">Contraseñas Coinciden <img src="../img/imgsysgerde/correcto.png" alt="I/" id="confContraOk" class="correcto"> <img src="../img/imgsysgerde/error.png" alt="X" id="confContraMal" class="incorrecto"></p>
                    </div>


                    <input type="submit" class="form_submitReg" value="Registrarme" name="registraEst">
                    <input type="button" onclick="location.href='../index.php';" value="Cancelar" class="form_cancelReg">

                </div>

              

                <script src="validarForm.js"></script>
            </form>
        </div>
        </div>
    </section>


</body>

</html>