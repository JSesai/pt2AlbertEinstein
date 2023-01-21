cabecera del formulario incluir jquery y api recapcha <script
	  src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
	  integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
	  crossorigin="anonymous"></script>
 
	<!-- api recapcha -->
    <script src="https://www.google.com/recaptcha/api.js?render=6Leot9kiAAAAAKK2crAQQAS6-M5Wl2vO8VuOtU8x"></script>






<!-- en ek fina del body incluir js para generar token -->
 <script>
                $('#form').submit(function(event) {
                    event.preventDefault();
                    /**/
                    grecaptcha.ready(function() {
                        grecaptcha.execute('6Leot9kiAAAAAKK2crAQQAS6-M5Wl2vO8VuOtU8x', {action: 'registro'}).then(function(token) {
                            $('#form').prepend('<input type="hidden" name="token" value="' + token + '">');
                            $('#form').prepend('<input type="hidden" name="action" value="registro">');
                            $('#form').unbind('submit').submit();
                        });
                    });
              });
              </script>

<?php
		

				// Código para validar recaptcha con el formulario
				define("Recaptcha_V3", '6Leot9kiAAAAAAHLPgw2JotSg4Zqe7bk3TiE88SH');
				$token = $_POST['token'];
				$action = $_POST['action'];
				 
				// llama a la función  CURL  en el envío POST
				$curs = curl_init();
				curl_setopt($curs, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
				curl_setopt($curs, CURLOPT_POST, 1);
				curl_setopt($curs, CURLOPT_POSTFIELDS, http_build_query(array('secret' => Recaptcha_V3, 'response' => $token)));
				curl_setopt($curs, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($curs);
				curl_close($curs);
				$arrResponse = json_decode($response, true);
				 
				// verificar la respuesta de JSON valor 1 es humano menor a .5 es robot
				if($arrResponse["success"] == '1' && $arrResponse["action"] == $action && $arrResponse["score"] >= 0.5) {

                    $sql= "INSERT INTO alumno (nombre, apePat, apeMat, estatus, correo, pass, matricula) VALUES (:m_nombre, :m_apeP, :m_apeM, :m_est, :m_correo, :m_pas, :m_mat)";
            
                    //hacemos uso de nuestro objeto conexion $dbs con la sentencia preparada le debemos de pasar la sentencia sql
                    $resultado= $bds->prepare($sql);
                
                    //ahora se ejecuta la sentencia prepara, debemos sustituir los marcadores por las variables que contiene la informacion que el usuario ingreso
                    $resultado->execute(array(":m_nombre"=>$nameEst, ":m_apeP"=>$apePat, ":m_apeM"=>$apeMat, ":m_est"=>$estatus, ":m_correo"=>$correo, ":m_pas"=>$ps, ":m_mat"=>$matricula ));
                
                    //liberamos la memoria para no consumirn recursos de manera innecesaria
                    // $resultado->closeCursor();
        
                     //mostramos mensaje de registro exitoso y direccionamos al inicio
                     echo'<script>window.alert("Te has registrado!!");
                     window.location.href ="fLogin.php";
                     </script>';
                
				} else {
					echo "***** Los robots no pueden enviar datos del formulario ******";
				}
									
		// ----------------------------------------------INTENTO 44------------------------------------------------------------

               
                // recapcha....
                define("RECAPTCHA_V3_SECRET_KEY", '6Leot9kiAAAAAAHLPgw2JotSg4Zqe7bk3TiE88SH');
                $token = $_POST['token'];
                $action = $_POST['action'];
                 
                // call curl to POST request
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => RECAPTCHA_V3_SECRET_KEY, 'response' => $token)));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);
                $arrResponse = json_decode($response, true);
                 
                // verificar la respuesta
                if($arrResponse["success"] == '1' && $arrResponse["action"] == $action && $arrResponse["score"] >= 0.5) {
                    $sql= "INSERT INTO alumno (nombre, apePat, apeMat, estatus, correo, pass, matricula) VALUES (:m_nombre, :m_apeP, :m_apeM, :m_est, :m_correo, :m_pas, :m_mat)";
            
                    //hacemos uso de nuestro objeto conexion $dbs con la sentencia preparada le debemos de pasar la sentencia sql
                    $resultado= $bds->prepare($sql);
                
                    //ahora se ejecuta la sentencia prepara, debemos sustituir los marcadores por las variables que contiene la informacion que el usuario ingreso
                    $resultado->execute(array(":m_nombre"=>$nameEst, ":m_apeP"=>$apePat, ":m_apeM"=>$apeMat, ":m_est"=>$estatus, ":m_correo"=>$correo, ":m_pas"=>$ps, ":m_mat"=>$matricula ));
                
                    //liberamos la memoria para no consumirn recursos de manera innecesaria
                    // $resultado->closeCursor();
        
                     //mostramos mensaje de registro exitoso y direccionamos al inicio
                     echo'<script>window.alert("Te has registrado!!");
                     window.location.href ="fLogin.php";
                     </script>';
                } else {
                    // Si entra aqui, es un robot....
                    echo'<script>window.alert(Acceso denenegados a los bots!!");
                     window.location.href ="fLogin.php";
                     </script>';
                }
  
		






?>