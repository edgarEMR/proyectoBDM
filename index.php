<?php
    session_start();
    
    include_once('php/conection.php');
    include_once('modelos/Usuario.php');

    $usuario = new Usuario();
    $coneccion = new DB();
    $nombreUsuario;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TotalShop</title>
    <link rel="icon" href="assets/totalshop-icon.png" >
    <link rel="stylesheet" href="css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</head>
<body>
    <div class="top">
        <div class="izquierda">
            <div class="info">
                <h5>Encuentra el regalo ideal</h5>
                <img src="assets/switch.png" alt="">
                <h5>O gana dinero, fácil y rápido</h5>
                <img src="assets/money-nobg.gif" alt="">
            </div>
        </div>
        <div class="derecha">
            <h1>¡Bienvenido!</h1>
            <div class="formulario-login">
                <div class="modal-content">
                    <div class="modal-header mb-4">
                        <h4 class="modal-title">Entrar</h4>
                    </div>
                    <div class="modal-body">
                        <form id="LoginForm" action="php/UsuarioProcesos.php" method="POST" class="row needs-validation" novalidate>
                            <div class="form-group mb-4">
                                <label for="nombreUsuario" class="text-dark">Nombre de usuario/Correo</label>
                                <input type="text" name="nombreUsuario" class="form-control" id="nombreUsuario" required>
                                <div class="invalid-feedback">
                                    Ingrese su nombre de usuario o correo.
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="contraseña" class="text-dark">Contraseña</label>
                                <input type="password" name="contraseña" class="form-control" id="contraseña" required>
                                <i id="verIcon" class="bi bi-eye-slash-fill" onclick="verContra()"></i>
                                <div class="invalid-feedback">
                                    Ingrese su contraseña.
                                </div>
                            </div>
                            <div class="form-check form-check-reverse form-switch mb-4">
                                <input class="form-check-input" type="checkbox" role="switch" id="inputRecordar">
                                <label class="form-check-label" for="inputRecordar">Recordar</label>
                            </div>                            
                            <div class="form-group d-grid mb-5">
                                <input type="hidden" name="accion" value="login" />
                                <button type="submit" class="btn btn-block">Entrar</button>
                            </div>
                        </form>

                        <h5>¿Eres nuevo?</h5>
                        <div class="d-grid">
                            <button type="button" class="btn btn-block" onclick="location.href='#registro'" >Regístrate</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="registro" class="registro">
        <div class="toast-container position-fixed top-0 start-50 translate-middle-x p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
              <div class="toast-header">
                <strong class="me-auto">TotalShop</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
              </div>
              <div class="toast-body">
                Usuario registrado exitosamente.
              </div>
            </div>
        </div>
        <h1>Crea una cuenta</h1>
        <div class="register-form">
            <form id="registroUsuario" action="php/UsuarioProcesos.php" class="row needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                <div class="form-group">
                    <label for="inputNombreUsu">Nombre de usuario</label>
                    <input type="text" name="nombreUsu" class="form-control" id="inputNombreUsu"
                        pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1]{3,}" required>
                    <small id="nombreUHelp" class="form-text text-muted">Mínimo 3 caracteres.</small>
                    <div class="invalid-feedback">
                        Elija un nombre de usuario válido.
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail">Email</label>
                    <input type="email" name="email" class="form-control" id="inputEmail"
                        pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$" aria-describedby="emailHelp"
                        placeholder="nombre@ejemplo.com" required>
                    <div class="invalid-feedback">
                        Ingrese un correo válido.
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputContraseña">Contraseña</label>
                    <input type="password" name="contra" class="form-control" id="inputContraseña"
                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*#?&]).{8,}" required>
                    <i id="verIconR" class="bi bi-eye-slash-fill" onclick="verContraR()"></i>
                    <small id="contraseñaHelp" class="form-text text-muted">Mínimo 8 caracteres, una
                        mayúscula, una minúscula, un número y un caracter especial.</small>
                    <div class="invalid-feedback">
                        Ingrese una contraseña válida.
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputNombre">Nombre(s)</label>
                    <input type="text" name="nombre" class="form-control" id="inputNombre"
                        pattern="[A-Za-zÀ-ÿ\u00f1\u00d1 ]{3,}" required>
                    <small id="nombreHelp" class="form-text text-muted">Mínimo 3 caracteres. Solo use letras.</small>
                    <div class="invalid-feedback">
                        Ingrese su nombre.
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputApellidos">Apellidos</label>
                    <input type="text" name="apellido" class="form-control" id="inputApellidos"
                        pattern="[A-Za-zÀ-ÿ\u00f1\u00d1 ]{3,}" required>
                    <small id="apellidoHelp" class="form-text text-muted">Mínimo 3 caracteres. Solo use letras.</small>
                    <div class="invalid-feedback">
                        Ingrese su apellido.
                    </div>
                </div>
                <div class="form-group col-md-8">
                    <label for="inputFecha">Fecha de nacimiento</label>
                    <input type="date" name="fecha" class="form-control" id="inputFecha" required>
                    <div class="invalid-feedback">
                        Ingrese su fecha de nacimiento.
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputSexo">Sexo</label>
                    <select class="form-select" id="inputSexo" name="sexo" required>
                        <option selected disabled value="">Elige...</option>
                        <option value="F">Femenino</option>
                        <option value="M">Masculino</option>
                      </select>
                    <div class="invalid-feedback">
                        Elija una opción.
                    </div>
                </div>
                <div class="form-group">
                    <label for="customFileLangHTML">Imagen de usuario</label>
                    <img id="imgPrev" src="assets/stock-user-image.png" alt="">
                    <div class="custom-file">
                        <input type="file" name="imagen" class="form-control" id="customFileLangHTML"
                            accept="image/jpeg, image/png" required>
                        <div class="invalid-feedback">
                            Elija una imagen.
                        </div>
                    </div>
                </div>
                <div class="form-group" hidden>
                    <input type="text" name="imagenN" class="form-control" id="inputImagenN">
                </div>
                <div class="form-group d-grid">
                    <input type="hidden" name="idRol" value="2">
                    <input type="hidden" name="accion" value="registrar">
                    <button class="btn btn-block" type="submit">Registrarse</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Mensaje Modal -->
    <div class="modal fade" id="modalMensaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Atencion</h5>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/index.js"></script>
</body>
</html>