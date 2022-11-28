<?php
echo session_start()? 'Se inicio' : 'No inicio';

    include_once('php/conection.php');
    include_once('modelos/Usuario.php');

    $usuario = new Usuario();
    $connection = new DB();

    if (!isset($_SESSION['nombreUsuario'])) {
        $_SESSION['nombreUsuario'] = $_GET['nombreUsuario'];
    }

    $procedure = $connection->gestionUsuario($_SESSION['nombreUsuario'], '', '', '', '', '', '', '', 0, 0, 'S');

    while ($row = $procedure->fetch(PDO::FETCH_ASSOC)) {
        $usuario->setNombreUsuario($row['nombreUsuario']);
        $usuario->setEmail($row['email']);
        $usuario->setContraseña($row['contraseña']);
        $usuario->setNombre($row['nombre']);
        $usuario->setApellidos($row['apellidos']);
        $usuario->setFechaNacimiento($row['fechaNacimiento']);
        $usuario->setSexo($row['sexo']);
        $usuario->setImagen(base64_encode($row['imagen']));
        $usuario->setIdRol($row['idRol']);

        $_SESSION['imagen'] = $row['imagen'];
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TotalShop</title>
    <link rel="icon" href="assets/totalshop-icon.png">
    <link rel="stylesheet" href="css/perfil.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
        crossorigin="anonymous"></script>
</head>

<body>
    <div id="navigation" class="top">

    </div>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="toast-container position-relative top-0 start-50 translate-middle-x p-3">
                    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <strong class="me-auto">TotalShop</strong>
                            <small>Justo ahora</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            El usuario ha sido modificado.
                        </div>
                    </div>
                </div>
                <h1>Tu Perfil</h1>
                <div class="personal-data">
                    <div class="buttons">
                        <button id="idEditar" type="button" class="btn" title="editar" onclick="editar()"><i
                                class="bi bi-pencil-fill"></i></button>
                        <!--Boton provisional solo para el avance-->
                        <button type="button" class="btn btn-primary" onclick="location.href='perfil_admin.html'"
                            title="Boton provisional solo para el avance">Perfil de
                            Admin</button>
                        <!---->
                        <button id="idEliminar" type="button" class="btn btn-danger" onclick="eliminar()"><i
                                class="bi bi-trash-fill"></i></button>
                    </div>

                    <form id="editarUsuario" class="row needs-validation" enctype="multipart/form-data" novalidate>
                        <div class="form-group">
                            <img id="imgPrev" src="<?php echo $usuario->getImagenUri();?>" alt="">
                            <div id="fileDiv" class="custom-file">
                                <input type="file" name="imagen" class="form-control" id="customFileLangHTML"
                                    accept="image/jpeg, image/png">
                                <div class="invalid-feedback">
                                    Elija una imagen.
                                </div>
                            </div>
                            <h3 id="nombreUsuario"><?php echo $usuario->getNombreUsuario();?></h3>
                        </div>
                        <div class="form-group" hidden>
                            <input type="text" name="imagenN" class="form-control" id="inputImagenN">
                        </div>
                        <div class="form-group" hidden>
                            <input type="text" name="nombreUsu" class="form-control" id="inputNombreUsu"
                                pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1]{3,}" required value="<?php echo $usuario->getNombreUsuario();?>">
                        </div>
                        <hr>
                        <div class="form-group col-6">
                            <label for="inputNombre">Nombre(s)</label>
                            <input type="text" name="nombre" class="form-control" id="inputNombre"
                                pattern="[A-Za-zÀ-ÿ\u00f1\u00d1 ]{3,}" required value="<?php echo $usuario->getNombre();?>">
                            <small id="nombreHelp" class="form-text text-muted">Mínimo 3 caracteres.</small>
                            <div class="invalid-feedback">
                                Ingrese su nombre.
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" name="apellido" class="form-control" id="inputApellidos"
                                pattern="[A-Za-zÀ-ÿ\u00f1\u00d1 ]{3,}" required value="<?php echo $usuario->getApellidos();?>">
                            <small id="nombreHelp" class="form-text text-muted">Mínimo 3 caracteres.</small>
                            <div class="invalid-feedback">
                                Ingrese su apellido.
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail">Email</label>
                            <input type="email" name="email" class="form-control" id="inputEmail"
                                pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$" placeholder="nombre@ejemplo.com"
                                required value="<?php echo $usuario->getEmail();?>">
                            <div class="invalid-feedback">
                                Ingrese un correo válido.
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputContraseña">Contraseña</label>
                            <input type="password" name="contra" class="form-control" id="inputContraseña"
                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*#?&]).{8,}" required value="<?php echo $usuario->getContraseña();?>">
                            <i id="verIconR" class="bi bi-eye-slash-fill" onclick="verContra()"></i>
                            <small id="contraseñaHelp" class="form-text text-muted">Mínimo 8 caracteres, una
                                mayúscula, un número y un signo de puntuación.</small>
                            <div class="invalid-feedback">
                                Ingrese una contraseña válida.
                            </div>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="inputFecha">Fecha de nacimiento</label>
                            <input type="date" name="fecha" class="form-control" id="inputFecha" required value="<?php echo $usuario->getFechaNacimiento();?>">
                            <div class="invalid-feedback">
                                Ingrese su fecha de nacimiento.
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputSexo">Sexo</label>
                            <select class="form-select" id="inputSexo" required>
                                <option selected disabled value="">Elige...</option>
                                <?php if ($usuario->getSexo() == 'F') {
                                    echo '<option value="F" selected>Femenino</option>';
                                    echo '<option value="M">Masculino</option>';
                                } else {
                                    echo '<option value="F">Femenino</option>';
                                    echo '<option value="M" selected>Masculino</option>';
                                } 
                                ?>
                                
                            </select>
                            <div class="invalid-feedback">
                                Elija una opción.
                            </div>
                        </div>
                        <div class="form-group d-grid mt-4">
                            <input type="hidden" name="idRol" value="<?php echo $usuario->getIdRol();?>">
                            <input type="hidden" name="accion" value="editar">
                            <button id="idGuardar" class="btn btn-block" type="submit">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="contenido col-6 d-grid gap-3">
                <div id="listas" class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        Mis listas
                        <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal"
                            data-bs-target="#nuevaLista"><i class="bi bi-plus-circle"></i></button>
                        <div class="modal fade" id="nuevaLista">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <div class="modal-title">Nueva lista</div>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <form method="POST">
                                            <div class="form-group">
                                                <input class="form-control" type="text" placeholder="Nombre de la lista"
                                                    name="email">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" type="text" placeholder="Descripcion"
                                                    name="password">
                                            </div>
                                            <div class="form-group">
                                                <label for="customFileLangHTML">Imagen</label>
                                                <div class="custom-file">
                                                    <input type="file" name="imagen" class="form-control" id="customFileLangHTML"
                                                        accept="image/jpeg, image/png" required>
                                                    <div class="invalid-feedback">
                                                        Elija una imagen.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="p-t-10">
                                                <button class="btn btn-block" type="submit"
                                                    data-target="#">Crear</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="editarLista">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <div class="modal-title">Editar lista</div>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <form method="POST">
                                            <div class="form-group">
                                                <input class="form-control" type="text" placeholder="Nombre de la lista"
                                                    name="email">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" type="text" placeholder="Descripcion"
                                                    name="password">
                                            </div>
                                            <div class="form-group">
                                                <label for="customFileLangHTML">Imagen</label>
                                                <div class="custom-file">
                                                    <input type="file" name="imagen" class="form-control" id="customFileLangHTML"
                                                        accept="image/jpeg, image/png" required>
                                                    <div class="invalid-feedback">
                                                        Elija una imagen.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="p-t-10">
                                                <button class="btn btn-block" type="submit"
                                                    data-target="#">Guardar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="listas">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                            aria-expanded="false" aria-controls="flush-collapseOne">
                                            1. Navidad
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                        aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Lista para regalos de navidad
                                            <div class="row">
                                                <a href="#" class="btn col-6" data-bs-toggle="modal"
                                                data-bs-target="#editarLista" style="background-color: #FF7C48;
                                                color: white;"><i
                                                        class="bi bi-pencil-fill"></i></a>
                                                <a href="#" class="btn btn-danger col-6"><i
                                                        class="bi bi-trash-fill"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                            aria-expanded="false" aria-controls="flush-collapseTwo">
                                            2. Para mi
                                        </button>
                                    </h2>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                        aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <p>Esta es mi wishlist</p>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <div class="card">
                                                        <img class="img-fluid" alt="100%x280"
                                                            src="assets/lonchera.webp">
                                                        <div class="card-body">
                                                            <h5 class="card-title"><a href="#"
                                                                    class="text-reset stretched-link">Lonchera
                                                                    térmica</a></h5>
                                                            <div class="row my-4">
                                                                <h5 class="col-6" style="color: #FF7C48;">$299</h5>
                                                                <p class="card-text col-6">
                                                                    <i class="bi bi-star-fill"></i>
                                                                    <i class="bi bi-star-fill"></i>
                                                                    <i class="bi bi-star-fill"></i>
                                                                    <i class="bi bi-star"></i>
                                                                    <i class="bi bi-star"></i>
                                                                </p>
                                                            </div>
                                                            <div class="row buttons">
                                                                <a href="#" class="btn col-6"><i
                                                                        class="bi bi-cart-plus"></i></a>
                                                                <a href="#" class="btn btn-danger col-6"><i
                                                                        class="bi bi-trash-fill"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="card">
                                                        <img class="img-fluid" alt="100%x280"
                                                            src="assets/lonchera.webp">
                                                        <div class="card-body">
                                                            <h5 class="card-title"><a href="#"
                                                                    class="text-reset stretched-link">Lonchera
                                                                    térmica</a></h5>
                                                            <div class="row my-4">
                                                                <h5 class="col-6" style="color: #FF7C48;">$299</h5>
                                                                <p class="card-text col-6">
                                                                    <i class="bi bi-star-fill"></i>
                                                                    <i class="bi bi-star-fill"></i>
                                                                    <i class="bi bi-star-fill"></i>
                                                                    <i class="bi bi-star"></i>
                                                                    <i class="bi bi-star"></i>
                                                                </p>
                                                            </div>
                                                            <div class="row buttons">
                                                                <a href="#" class="btn col-6"><i
                                                                        class="bi bi-cart-plus"></i></a>
                                                                <a href="#" class="btn btn-danger col-6"><i
                                                                        class="bi bi-trash-fill"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#editarLista" class="btn col-6" style="background-color: #FF7C48;
                                                color: white;"><i
                                                        class="bi bi-pencil-fill"></i></a>
                                                <a href="#" class="btn btn-danger col-6"><i
                                                        class="bi bi-trash-fill"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="productos" class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        Productos publicados
                        <button type="button" onclick="location.href='crearProducto.html'" class="btn btn-light btn-sm"><i class="bi bi-plus-circle"></i></button>
                    </div>
                    <div class="card-body">

                        <div class="productos-publicados">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="assets/lonchera.webp">
                                        <div class="card-body">
                                            <h5 class="card-title"><a href="#"
                                                    class="text-reset stretched-link">Lonchera térmica</a></h5>
                                            <div class="row my-4">
                                                <h5 class="col-6" style="color: #FF7C48;">$299</h5>
                                                <p class="card-text col-6">
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star"></i>
                                                    <i class="bi bi-star"></i>
                                                </p>
                                            </div>
                                            <div class="row buttons">
                                                <a href="#" class="btn btn-warning col-6"><i
                                                        class="bi bi-pencil-fill"></i></a>
                                                <a href="#" class="btn btn-danger col-6"><i
                                                        class="bi bi-trash-fill"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="assets/lonchera.webp">
                                        <div class="card-body">
                                            <h5 class="card-title"><a href="#"
                                                    class="text-reset stretched-link">Lonchera térmica</a></h5>
                                            <div class="row my-4">
                                                <h5 class="col-6" style="color: #FF7C48;">$299</h5>
                                                <p class="card-text col-6">
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star"></i>
                                                    <i class="bi bi-star"></i>
                                                </p>
                                            </div>
                                            <div class="row buttons">
                                                <a href="#" class="btn btn-warning col-6"><i
                                                        class="bi bi-pencil-fill"></i></a>
                                                <a href="#" class="btn btn-danger col-6"><i
                                                        class="bi bi-trash-fill"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="assets/lonchera.webp">
                                        <div class="card-body">
                                            <h5 class="card-title"><a href="#"
                                                    class="text-reset stretched-link">Lonchera térmica</a></h5>
                                            <div class="row my-4">
                                                <h5 class="col-6" style="color: #FF7C48;">$299</h5>
                                                <p class="card-text col-6">
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star"></i>
                                                    <i class="bi bi-star"></i>
                                                </p>
                                            </div>
                                            <div class="row buttons">
                                                <a href="#" class="btn btn-warning col-6"><i
                                                        class="bi bi-pencil-fill"></i></a>
                                                <a href="#" class="btn btn-danger col-6"><i
                                                        class="bi bi-trash-fill"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="assets/lonchera.webp">
                                        <div class="card-body">
                                            <h5 class="card-title"><a href="#"
                                                    class="text-reset stretched-link">Lonchera térmica</a></h5>
                                            <div class="row my-4">
                                                <h5 class="col-6" style="color: #FF7C48;">$299</h5>
                                                <p class="card-text col-6">
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star"></i>
                                                    <i class="bi bi-star"></i>
                                                </p>
                                            </div>
                                            <div class="row buttons">
                                                <a href="#" class="btn btn-warning col-6"><i
                                                        class="bi bi-pencil-fill"></i></a>
                                                <a href="#" class="btn btn-danger col-6"><i
                                                        class="bi bi-trash-fill"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="admins" class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        Administradores
                        <button type="button" onclick="location.href='#'" class="btn btn-light btn-sm"><i class="bi bi-plus-circle"></i></button>
                    </div>
                    <div class="card-body">
                        <div class="administradores">
                            <?php 
                                $procedure = $connection->gestionUsuario('', '', '', '', '', '', '', '', 0, 2, 'A');

                                while ($row = $procedure->fetch(PDO::FETCH_ASSOC)) {
                                    $admin = new Usuario();
                                    $admin->setNombreUsuario($row['nombreUsuario']);
                                    $admin->setEmail($row['email']);
                                    $admin->setContraseña($row['contraseña']);
                                    $admin->setNombre($row['nombre']);
                                    $admin->setApellidos($row['apellidos']);
                                    $admin->setFechaNacimiento($row['fechaNacimiento']);
                                    $admin->setSexo($row['sexo']);
                                    $admin->setImagen(base64_encode($row['imagen']));
                                    $admin->setIdRol($row['idRol']);
  
                                    echo '<div class="mb-3">';
                                        echo '<div class="card mb-3">';
                                            echo '<div class="row g-0">';
                                                echo '<div class="col-md-4" style="text-align: center;">';
                                                    echo '<img src="'. $admin->getImagenUri() .'" class="img-fluid rounded-circle" width="60%" alt="...">';
                                                echo '</div>';
                                                echo '<div class="col-md-8">';
                                                    echo '<div class="card-body">';
                                                        echo '<h5 class="card-title">'. $admin->getNombreUsuario() .'</h5>';
                                                        echo '<p class="card-text">'. $admin->getNombre() . ' ' . $admin->getApellidos() .'</p>';
                                                        echo '<p class="card-text"><small class="text-muted">'. $admin->getEmail() .'</small></p>';
                                                    echo '</div>';
                                                echo '</div>';
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                }
                            ?>
                        </div>
                    </div>
                </div>

                <div id="prod-autorizados" class="card">
                    <div class="card-header">
                        Pendientes de autorización
                    </div>
                    <div class="card-body">

                        <div class="productos-publicados">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="assets/lonchera.webp">
                                        <div class="card-body">
                                            <h5 class="card-title"><a href="#"
                                                    class="text-reset stretched-link">Lonchera térmica</a></h5>
                                            <div class="row my-4">
                                                <h5 class="col-6" style="color: #FF7C48;">$299</h5>
                                                <p class="card-text col-6">
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star"></i>
                                                    <i class="bi bi-star"></i>
                                                </p>
                                            </div>
                                            <div class="row buttons">
                                                <a href="#" class="btn btn-warning col-12"><i class="bi bi-check-lg"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="assets/lonchera.webp">
                                        <div class="card-body">
                                            <h5 class="card-title"><a href="#"
                                                    class="text-reset stretched-link">Lonchera térmica</a></h5>
                                            <div class="row my-4">
                                                <h5 class="col-6" style="color: #FF7C48;">$299</h5>
                                                <p class="card-text col-6">
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star"></i>
                                                    <i class="bi bi-star"></i>
                                                </p>
                                            </div>
                                            <div class="row buttons">
                                                <a href="#" class="btn btn-warning col-12"><i class="bi bi-check-lg"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="assets/lonchera.webp">
                                        <div class="card-body">
                                            <h5 class="card-title"><a href="#"
                                                    class="text-reset stretched-link">Lonchera térmica</a></h5>
                                            <div class="row my-4">
                                                <h5 class="col-6" style="color: #FF7C48;">$299</h5>
                                                <p class="card-text col-6">
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star"></i>
                                                    <i class="bi bi-star"></i>
                                                </p>
                                            </div>
                                            <div class="row buttons">
                                                <a href="#" class="btn btn-warning col-12"><i class="bi bi-check-lg"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="assets/lonchera.webp">
                                        <div class="card-body">
                                            <h5 class="card-title"><a href="#"
                                                    class="text-reset stretched-link">Lonchera térmica</a></h5>
                                            <div class="row my-4">
                                                <h5 class="col-6" style="color: #FF7C48;">$299</h5>
                                                <p class="card-text col-6">
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star"></i>
                                                    <i class="bi bi-star"></i>
                                                </p>
                                            </div>
                                            <div class="row buttons">
                                                <a href="#" class="btn btn-warning col-12"><i class="bi bi-check-lg"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="prod-pendientes" class="card">
                    <div class="card-header">
                        Productos autorizados
                    </div>
                    <div class="card-body">

                        <div class="productos-publicados">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="assets/lonchera.webp">
                                        <div class="card-body">
                                            <h5 class="card-title"><a href="#"
                                                    class="text-reset stretched-link">Lonchera térmica</a></h5>
                                            <div class="row my-4">
                                                <h5 class="col-6" style="color: #FF7C48;">$299</h5>
                                                <p class="card-text col-6">
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star"></i>
                                                    <i class="bi bi-star"></i>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="assets/lonchera.webp">
                                        <div class="card-body">
                                            <h5 class="card-title"><a href="#"
                                                    class="text-reset stretched-link">Lonchera térmica</a></h5>
                                            <div class="row my-4">
                                                <h5 class="col-6" style="color: #FF7C48;">$299</h5>
                                                <p class="card-text col-6">
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star"></i>
                                                    <i class="bi bi-star"></i>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="assets/lonchera.webp">
                                        <div class="card-body">
                                            <h5 class="card-title"><a href="#"
                                                    class="text-reset stretched-link">Lonchera térmica</a></h5>
                                            <div class="row my-4">
                                                <h5 class="col-6" style="color: #FF7C48;">$299</h5>
                                                <p class="card-text col-6">
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star"></i>
                                                    <i class="bi bi-star"></i>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="assets/lonchera.webp">
                                        <div class="card-body">
                                            <h5 class="card-title"><a href="#"
                                                    class="text-reset stretched-link">Lonchera térmica</a></h5>
                                            <div class="row my-4">
                                                <h5 class="col-6" style="color: #FF7C48;">$299</h5>
                                                <p class="card-text col-6">
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star"></i>
                                                    <i class="bi bi-star"></i>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="consultas" class="row my-5 consultas">
            <div class="col-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        Mis ventas
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="inputFechaI">Desde</label>
                                <input type="date" name="fechaIni" class="form-control" id="inputFechaI">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputFechaF">Hasta</label>
                                <input type="date" name="fechaFin" class="form-control" id="inputFechaF">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputFechaF">Categorias</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Todas</option>
                                    <option value="1">Electrónica</option>
                                    <option value="2">Muebles</option>
                                    <option value="3">Juguetes</option>
                                </select>
                            </div>
                        </div>
                        <style type="text/css">
                            .tftable {font-size:12px;color:#333333;width:100%;border-width: 1px;border-color: #a9a9a9;border-collapse: collapse;}
                            .tftable th {font-size:12px;background-color:#b8b8b8;border-width: 1px;padding: 8px;border-style: solid;border-color: #a9a9a9;text-align:left;}
                            .tftable tr {background-color:#ffffff;}
                            .tftable td {font-size:12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #a9a9a9;}
                            .tftable tr:hover {background-color:#ffff99;}
                            </style>
                            
                            <table class="tftable" border="1">
                            <tr><th>Header 1</th><th>Header 2</th><th>Header 3</th><th>Header 4</th><th>Header 5</th></tr>
                            <tr><td>Row:1 Cell:1</td><td>Row:1 Cell:2</td><td>Row:1 Cell:3</td><td>Row:1 Cell:4</td><td>Row:1 Cell:5</td></tr>
                            <tr><td>Row:2 Cell:1</td><td>Row:2 Cell:2</td><td>Row:2 Cell:3</td><td>Row:2 Cell:4</td><td>Row:2 Cell:5</td></tr>
                            <tr><td>Row:3 Cell:1</td><td>Row:3 Cell:2</td><td>Row:3 Cell:3</td><td>Row:3 Cell:4</td><td>Row:3 Cell:5</td></tr>
                            <tr><td>Row:4 Cell:1</td><td>Row:4 Cell:2</td><td>Row:4 Cell:3</td><td>Row:4 Cell:4</td><td>Row:4 Cell:5</td></tr>
                            <tr><td>Row:5 Cell:1</td><td>Row:5 Cell:2</td><td>Row:5 Cell:3</td><td>Row:5 Cell:4</td><td>Row:5 Cell:5</td></tr>
                            <tr><td>Row:6 Cell:1</td><td>Row:6 Cell:2</td><td>Row:6 Cell:3</td><td>Row:6 Cell:4</td><td>Row:6 Cell:5</td></tr>
                            </table>
                            
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        Mis compras
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="inputFechaI">Desde</label>
                                <input type="date" name="fechaIni" class="form-control" id="inputFechaI">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputFechaF">Hasta</label>
                                <input type="date" name="fechaFin" class="form-control" id="inputFechaF">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputFechaF">Categorias</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Todas</option>
                                    <option value="1">Electrónica</option>
                                    <option value="2">Muebles</option>
                                    <option value="3">Juguetes</option>
                                </select>
                            </div>
                        </div>
                        
                        <style type="text/css">
                            .tftable {font-size:12px;color:#333333;width:100%;border-width: 1px;border-color: #a9a9a9;border-collapse: collapse;}
                            .tftable th {font-size:12px;background-color:#b8b8b8;border-width: 1px;padding: 8px;border-style: solid;border-color: #a9a9a9;text-align:left;}
                            .tftable tr {background-color:#ffffff;}
                            .tftable td {font-size:12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #a9a9a9;}
                            .tftable tr:hover {background-color:#ffff99;}
                            </style>
                            
                            <table class="tftable" border="1">
                            <tr><th>Header 1</th><th>Header 2</th><th>Header 3</th><th>Header 4</th><th>Header 5</th></tr>
                            <tr><td>Row:1 Cell:1</td><td>Row:1 Cell:2</td><td>Row:1 Cell:3</td><td>Row:1 Cell:4</td><td>Row:1 Cell:5</td></tr>
                            <tr><td>Row:2 Cell:1</td><td>Row:2 Cell:2</td><td>Row:2 Cell:3</td><td>Row:2 Cell:4</td><td>Row:2 Cell:5</td></tr>
                            <tr><td>Row:3 Cell:1</td><td>Row:3 Cell:2</td><td>Row:3 Cell:3</td><td>Row:3 Cell:4</td><td>Row:3 Cell:5</td></tr>
                            <tr><td>Row:4 Cell:1</td><td>Row:4 Cell:2</td><td>Row:4 Cell:3</td><td>Row:4 Cell:4</td><td>Row:4 Cell:5</td></tr>
                            <tr><td>Row:5 Cell:1</td><td>Row:5 Cell:2</td><td>Row:5 Cell:3</td><td>Row:5 Cell:4</td><td>Row:5 Cell:5</td></tr>
                            <tr><td>Row:6 Cell:1</td><td>Row:6 Cell:2</td><td>Row:6 Cell:3</td><td>Row:6 Cell:4</td><td>Row:6 Cell:5</td></tr>
                            </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/perfil.js"></script>
</body>

</html>