<?php
    session_start();

    include_once('php/conection.php');
    include_once('modelos/Usuario.php');

    $usuario = new Usuario();
    $connection = new DB();

    if (isset($_SESSION['nombreUsuario'])) {
        $usuario->setNombreUsuario($_SESSION['nombreUsuario']);
        $usuario->setImagen(base64_encode($_SESSION['imagen']));
    } else {
        echo 'Nola sesion';
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
    <link rel="stylesheet" href="css/navbar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
        crossorigin="anonymous"></script>

</head>

<body>
    <nav class="navbar pb-0">
        <div class="container-fluid">
            <a class="navbar-brand" href="inicio.php">
                <img src="assets/totalshop-logo-shadow.png" alt="">
            </a>
            <div id="busqueda" class="input-group">
                <input type="text" class="form-control" aria-label="Text input with segmented dropdown button"
                    placeholder="Buscar...">
                <button type="button" class="btn btn-light"><i class="bi bi-search"></i></button>
                <button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <form id="busquedaAv" class="form-horizontal" onsubmit="return validarBusqueda()" method="GET">
                        <div class="form-group col-md-6">
                            <label for="inputFechaI">Desde</label>
                            <input type="date" name="fechaIni" class="form-control" id="inputFechaI">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputFechaF">Hasta</label>
                            <input type="date" name="fechaFin" class="form-control" id="inputFechaF">
                        </div>
                        <div class="form-group">
                            <label for="inputTituloB">Título o descripción</label>
                            <input class="form-control" type="text" name="buscar" id="inputTituloB" />
                        </div>
                        <div class="form-group">
                            <label for="inputPalabrasC">Palabras clave</label>
                            <input class="form-control" type="text" name="palabrasC" id="inputPalabrasC" />
                        </div>
                        <input type="hidden" name="accion" value="buscarAV">
                        <button type="submit" class="btn btn-dark" onclick=""><i class="bi bi-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="derecha">
                <div class="userInfo">
                    <a href="perfil.php"><img src="<?php echo $usuario->getImagenUri(); ?>" class="userImage" alt="..."
                            id="imgUser"></a>
                    <div class="userName">
                        <h6 id="userName" class="mt-0"><?php echo $usuario->getNombreUsuario(); ?></h6>
                    </div>
                    <button class="btn btn-outline-light my-2 my-sm-0 btn-sm" type="button" id="salir" onclick="<?php session_destroy(); ?>">Cerrar sesión</button>
                </div>
                <button id="shoppingCartBtn" class="btn" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <i class="bi bi-cart3"></i>
                </button>
            </div>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Carrito</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="row">

                        <div class="col-md-12 mb-3">
                            <div class="card">
                                <img class="img-fluid" alt="100%x280" src="assets/smartwatch.webp">
                                <div class="card-body">
                                    <h6 class="card-title"><a href="detalleProducto.html"
                                            class="text-reset stretched-link">Smartwatch Lige BW0223</a></h6>
                                    <div class="row my-2">
                                        <h5 class="col-sm-6" style="color: #FF7C48;">$599</h5>
                                        <p class="card-text col-sm-6">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </p>
                                    </div>
                                    <div class="input-group">
                                        <form id='myform'>
                                            <input type='button' value='-' class='qtyminus btn btn-light'
                                                field='quantity' />
                                            <input type='text' name='quantity' value='0' class='qty' />
                                            <input type='button' value='+' class='qtyplus btn btn-light'
                                                field='quantity' />
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="card">
                                <img class="img-fluid" alt="100%x280" src="assets/xiaomi.webp">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="#" class="text-reset stretched-link">Xiaomi Redmi
                                            9A</a></h5>
                                    <div class="row my-2">
                                        <h5 class="col-6" style="color: #FF7C48;">$2,999</h5>
                                        <p class="card-text col-6">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star"></i>
                                        </p>
                                    </div>
                                    <div class="input-group">
                                        <form id='myform'>
                                            <input type='button' value='-' class='qtyminus btn btn-light'
                                                field='quantity' />
                                            <input type='text' name='quantity' value='0' class='qty' />
                                            <input type='button' value='+' class='qtyplus btn btn-light'
                                                field='quantity' />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="card">
                                <img class="img-fluid" alt="100%x280" src="assets/lonchera.webp">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="#" class="text-reset stretched-link">Lonchera
                                            térmica</a></h5>
                                    <div class="row my-2">
                                        <h5 class="col-6" style="color: #FF7C48;">$129</h5>
                                        <p class="card-text col-6">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star"></i>
                                        </p>
                                    </div>
                                    <div class="input-group">
                                        <form id='myform'>
                                            <input type='button' value='-' class='qtyminus btn btn-light'
                                                field='quantity' />
                                            <input type='text' name='quantity' value='0' class='qty' />
                                            <input type='button' value='+' class='qtyplus btn btn-light'
                                                field='quantity' />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3 d-grid">
                            <button id="pagar" type="button" class="btn btn-block">Proceder al pago</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="categorias">
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link link-light" aria-current="page" href="#">Electrónica</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-light" href="#">Muebles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-light" href="#">Ropa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-light">Juguetes</a>
                </li>
            </ul>
        </div>
    </nav>
    <input type="checkbox" id="check"> <label class="chat-btn" for="check"> <i class="bi bi-chat-dots-fill comment"></i>
        <i class="bi bi-x close"></i> </label>
    <div class="wrapper">
        <div class="header">
            <h6>Chat con Luis</h6>
        </div>
        <div class="chat-form d-grid"> 
            <p>Hola</p>
            <textarea class="form-control my-2" placeholder="Escribe algo..." rows="1"></textarea>
            <button class="btn btn-block "><i class="bi bi-send"></i></button>
        </div>
    </div>
    <script src="js/navbar.js"></script>
</body>

</html>