            <article>
                
                <h3 class="text-center">Otra información</h3>
                
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
                                <label for="imageInput">
                                    <img src="" class="img-thumbnail rounded-circle img-profile" alt="Foto de perfil" style="max-width: 80px;" onerror="this.onerror=null; this.src='../img/imgsysgerde/perfil.jpg'">
                                </label>
                                <input type="file" id="imageInput" accept="image/*" onchange="uploadImage(event)" style="display:none;">

                            </td>
                        </tr>

                        <tr>
                            <th scope="row">Nombre</th>
                            <td colspan="2">Julio Sesai</td>
                            <?php // include("modales.php") ?>
                            <td colspan="2"><a href="#" data-bs-toggle="modal" data-bs-target="#modalPrueba"><i class="bi bi-chevron-right"></i></a></td>

                        </tr>
                        <tr>
                            <th scope="row">Fecha de nacimiento</th>
                            <td colspan="2">22/12/1989</td>
                            <td colspan="2"><a href=""><i class="bi bi-chevron-right"></i></a></td>


                        </tr>
                        <tr>
                            <th scope="row">Genero</th>
                            <td colspan="2">Hombre</td>
                            <td colspan="2"><a href=""><i class="bi bi-chevron-right"></i></a></td>


                        </tr>
                    </tbody>
                </table>
                <form>

                    <div class="mb-3">
                        <label for="nombre" class="form-label"></label>
                        <input type="email" class="form-control" id="nombre" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </article>


    
  