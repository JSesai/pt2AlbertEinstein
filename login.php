
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/Logo_CAE.png" type="image/x-icon">
    <title>login</title>
    <link rel="stylesheet" href="CSS/styleforms.css">

<!-- agregamos el script para recapcha -->
<script src="https://www.google.com/recaptcha/api.js?render=6Leot9kiAAAAAKK2crAQQAS6-M5Wl2vO8VuOtU8x"></script>

</head>
<body style="background-color: #c5e5ff;">
    
    <section>
    <div class="contenedorForm">
            <form action="validaLogin.php" method="POST" class="form">
                <div class="logoform"><img src="img/imgsysgerde/Logo_CAE.png" alt="Albert Einstein"></div>
                <h2 class="form_title">Ingresa</h2>
                <P class="form_paragraph">¿Aun no tienes cuenta? <a href="loginUsuarios/formUsuario.html" class="form_link">Registrate aqui</a></P>
                
                <div class="form_container">
                    <div class="form_group">
                        <input type="email" id="name" class="form_input" placeholder=" " name="correo" required>
                        <label for="name" class="form_label" >Correo:</label>
                        <span class="form_line"></span>
                    </div>

                    <div class="form_group">
                        <input type="password" id="user" class="form_input" placeholder=" " name="userPas" required>
                        <label for="user" class="form_label" >Contraseña:</label>
                        <span class="form_line"></span>
                    </div>

                    <div class="form_group">
                            <label for="opcion" class="form_label">Soy:</label>
                            <select name="tab" class="form_opcion" id="opcion">
                                <option >Administrador</option>
                                <option >Docente</option>
                                <option >Tutor</option>
                                <option >Control escolar</option>
                                <option >Directivo</option>

                            </select>
                        </div>

                    <input type="submit" class="form_submit2" value="Ingresar" name="loginUsers">
                    <input type="button" onclick="location.href='index.php';" value="Cancelar" class="form_cancel2">

                </div>
            </form>

            <script>
      function onClick(e) {
        e.preventDefault();
        grecaptcha.ready(function() {
          grecaptcha.execute('6Leot9kiAAAAAKK2crAQQAS6-M5Wl2vO8VuOtU8x', {action: 'submit'}).then(function(token) {
              // Add your logic to submit to your backend server here.
          });
        });
      }
  </script>

        </div>
    </div>
    </section>
  
</body>
</html>



