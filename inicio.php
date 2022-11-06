<?php
    session_start();

    include_once('php/conection.php');
    include_once('modelos/Usuario.php');
    
    $usuario = new Usuario();
    $coneccion = new DB();
    
    if(isset($_POST['nombreUsuario'])) {
        $procedure = $coneccion->gestionUsuario($_POST['nombreUsuario'], '', '', '', '', '', '', '', 0, 0, 'S');
    
        if ($procedure) {
    
            while ($row = $procedure->fetch(PDO::FETCH_ASSOC)) {
    
                $usuario->setNombreUsuario($row['nombreUsuario']);
                $usuario->setContraseña($row['contraseña']);
                $usuario->setNombre($row['nombre']);
                $usuario->setApellidos($row['apellidos']);
                $usuario->setFechaNacimiento($row['fechaNacimiento']);
                $usuario->setEmail($row['email']);
                $usuario->setSexo($row['sexo']);
                $usuario->setImagen(base64_encode($row['imagen']));
                $usuario->setIdRol($row['idRol']);
    
                // nombreUsuario, contraseña, nombre, apellidos, fechaNacimiento, email, sexo, imagen, idRol
    
            }

            $_SESSION['nombreUsuario'] = $usuario->getNombreUsuario();
            $_SESSION['imagen'] = $usuario->getImagen();
        }

    } else {
        session_destroy();
        header('Location: index.php');
    }
    
    if (isset($_SESSION['nombreUsuario'])) {
        $usuario->setNombreUsuario($_SESSION['nombreUsuario']);
        $usuario->setImagen($_SESSION['imagen']);
    
        echo '<input type="text" id="sessionNombre" style="display: none;" value="'.$_SESSION['nombreUsuario'].'">';
        echo '<input type="text" id="sessionImagen" style="display: none;" value="'.$_SESSION['imagen'].'">';
    ?>
        <script type="text/javascript">
    
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById('entrar').style.display = 'none';
                document.getElementById('salir').style.display = 'inline-block';
            });
        </script>
    <?php
    
    } else {
        $usuario->setNombreUsuario('Invitado');
        $path = 'assets\stock-user-image.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $usuario->setImagen(base64_encode($data));
    ?>
        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById('entrar').style.display = 'inline-block';
                document.getElementById('salir').style.display = 'none';
                document.getElementById('userName').textContent = 'Invitado';
            });
        </script>
    <?php
    
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TotalShop</title>
    <link rel="icon" href="assets/totalshop-icon.png" >
    <link rel="stylesheet" href="css/inicio.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
</head>
<body>
    <div id="navigation" class="top">

    </div>
    <div class="container mas-vendidos">
        <div class="row">
            <div class="col-8">
                <div class="card h-100" id="top1">
                    <div class="card-body">
                      <h5 class="card-title"><a href="detalleProducto.html" class="text-reset stretched-link">Smartwatch Lige BW0223</a></h5>
                        <h6 class="card-subtitle mb-2 text-muted">#1 Ventas</h6>
                    </div>
                    <img src="assets/smartwatch.webp" class="card-img-bottom" alt="...">
                </div>
            </div>
            <div class="col d-grid gap-1">
                <div class="card" id="top2">
                    <div class="card-body">
                      <h5 class="card-title"><a href="#" class="text-reset stretched-link">Xiaomi Redmi 9A</a></h5>
                      <h6 class="card-subtitle mb-2 text-muted">#2</h6>
                    </div>
                    <img src="assets/xiaomi.webp" class="card-img-bottom" alt="...">
                </div>
                <div class="card" id="top3">
                    <div class="card-body">
                      <h5 class="card-title"><a href="#" class="text-reset stretched-link">Lonchera térmica</a></h5>
                      <h6 class="card-subtitle mb-2 text-muted">#3</h6>
                    </div>
                    <img src="assets/lonchera.webp" class="card-img-bottom" alt="...">
                </div>
            </div>
        </div>
    </div>
    <div class="container recomendados">
        <div class="row">
            <h2 class="col-6">Recomendados</h2>
            <div class="col-6 text-end">
                <a class="btn mb-3 mr-1" href="#carouselExampleIndicators2" role="button" data-bs-slide="prev" style="background-color: #FF415B; color: white;">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <a class="btn mb-3 " href="#carouselExampleIndicators2" role="button" data-bs-slide="next" style="background-color: #FF415B; color: white;">
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row">

                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <img class="img-fluid" alt="100%x280" src="assets/smartwatch.webp">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="detalleProducto.html" class="text-reset stretched-link">Smartwatch Lige BW0223</a></h5>
                                    <div class="row my-4">
                                        <h5 class="col-6" style="color: #FF7C48;">$599</h5>
                                        <p class="card-text col-6">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </p>
                                    </div>
                                    <div class="row buttons">
                                        <a href="#" class="btn col-6"><i class="bi bi-cart-plus"></i></a>
                                        <a href="#" class="btn col-6"><i class="bi bi-list-ul"></i></a>
                                    </div>
                                    
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <img class="img-fluid" alt="100%x280" src="assets/xiaomi.webp">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="#" class="text-reset stretched-link">Xiaomi Redmi 9A</a></h5>
                                    <div class="row my-4">
                                        <h5 class="col-6" style="color: #FF7C48;">$2,999</h5>
                                        <p class="card-text col-6">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star"></i>
                                        </p>
                                    </div>
                                    <div class="row buttons">
                                        <a href="#" class="btn col-6"><i class="bi bi-cart-plus"></i></a>
                                        <a href="#" class="btn col-6"><i class="bi bi-list-ul"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <img class="img-fluid" alt="100%x280" src="assets/lonchera.webp">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="#" class="text-reset stretched-link">Lonchera térmica</a></h5>
                                    <div class="row my-4">
                                        <h5 class="col-6" style="color: #FF7C48;">$129</h5>
                                        <p class="card-text col-6">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star"></i>
                                        </p>
                                    </div>
                                    <div class="row buttons">
                                        <a href="#" class="btn col-6"><i class="bi bi-cart-plus"></i></a>
                                        <a href="#" class="btn col-6"><i class="bi bi-list-ul"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <img class="img-fluid" alt="100%x280" src="assets/lonchera.webp">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="#" class="text-reset stretched-link">Lonchera térmica</a></h5>
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
                                        <a href="#" class="btn col-6"><i class="bi bi-cart-plus"></i></a>
                                        <a href="#" class="btn col-6"><i class="bi bi-list-ul"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">

                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <img class="img-fluid" alt="100%x280" src="assets/smartwatch.webp">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="#" class="text-reset stretched-link">Smartwatch Lige BW0223</a></h5>
                                    <div class="row my-4">
                                        <h5 class="col-6" style="color: #FF7C48;">$599</h5>
                                        <p class="card-text col-6">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </p>
                                    </div>
                                    <div class="row buttons">
                                        <a href="#" class="btn col-6"><i class="bi bi-cart-plus"></i></a>
                                        <a href="#" class="btn col-6"><i class="bi bi-list-ul"></i></a>
                                    </div>
                                    
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <img class="img-fluid" alt="100%x280" src="assets/xiaomi.webp">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="#" class="text-reset stretched-link">Xiaomi Redmi 9A</a></h5>
                                    <div class="row my-4">
                                        <h5 class="col-6" style="color: #FF7C48;">$2,999</h5>
                                        <p class="card-text col-6">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star"></i>
                                        </p>
                                    </div>
                                    <div class="row buttons">
                                        <a href="#" class="btn col-6"><i class="bi bi-cart-plus"></i></a>
                                        <a href="#" class="btn col-6"><i class="bi bi-list-ul"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <img class="img-fluid" alt="100%x280" src="assets/lonchera.webp">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="#" class="text-reset stretched-link">Lonchera térmica</a></h5>
                                    <div class="row my-4">
                                        <h5 class="col-6" style="color: #FF7C48;">$129</h5>
                                        <p class="card-text col-6">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star"></i>
                                        </p>
                                    </div>
                                    <div class="row buttons">
                                        <a href="#" class="btn col-6"><i class="bi bi-cart-plus"></i></a>
                                        <a href="#" class="btn col-6"><i class="bi bi-list-ul"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <img class="img-fluid" alt="100%x280" src="assets/lonchera.webp">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="#" class="text-reset stretched-link">Lonchera térmica</a></h5>
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
                                        <a href="#" class="btn col-6"><i class="bi bi-cart-plus"></i></a>
                                        <a href="#" class="btn col-6"><i class="bi bi-list-ul"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container recomendados">
        <div class="row">
            <h2 class="col-6">Populares</h2>
            <div class="col-6 text-end">
                <a class="btn mb-3 mr-1" href="#carouselExampleIndicators3" role="button" data-bs-slide="prev" style="background-color: #FF415B; color: white;">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <a class="btn mb-3 " href="#carouselExampleIndicators3" role="button" data-bs-slide="next" style="background-color: #FF415B; color: white;">
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        <div id="carouselExampleIndicators3" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row">

                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <img class="img-fluid" alt="100%x280" src="assets/smartwatch.webp">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="detalleProducto.html" class="text-reset stretched-link">Smartwatch Lige BW0223</a></h5>
                                    <div class="row my-4">
                                        <h5 class="col-6" style="color: #FF7C48;">$599</h5>
                                        <p class="card-text col-6">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </p>
                                    </div>
                                    <div class="row buttons">
                                        <a href="#" class="btn col-6"><i class="bi bi-cart-plus"></i></a>
                                        <a href="#" class="btn col-6"><i class="bi bi-list-ul"></i></a>
                                    </div>
                                    
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <img class="img-fluid" alt="100%x280" src="assets/xiaomi.webp">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="#" class="text-reset stretched-link">Xiaomi Redmi 9A</a></h5>
                                    <div class="row my-4">
                                        <h5 class="col-6" style="color: #FF7C48;">$2,999</h5>
                                        <p class="card-text col-6">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star"></i>
                                        </p>
                                    </div>
                                    <div class="row buttons">
                                        <a href="#" class="btn col-6"><i class="bi bi-cart-plus"></i></a>
                                        <a href="#" class="btn col-6"><i class="bi bi-list-ul"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <img class="img-fluid" alt="100%x280" src="assets/lonchera.webp">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="#" class="text-reset stretched-link">Lonchera térmica</a></h5>
                                    <div class="row my-4">
                                        <h5 class="col-6" style="color: #FF7C48;">$129</h5>
                                        <p class="card-text col-6">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star"></i>
                                        </p>
                                    </div>
                                    <div class="row buttons">
                                        <a href="#" class="btn col-6"><i class="bi bi-cart-plus"></i></a>
                                        <a href="#" class="btn col-6"><i class="bi bi-list-ul"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <img class="img-fluid" alt="100%x280" src="assets/lonchera.webp">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="#" class="text-reset stretched-link">Lonchera térmica</a></h5>
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
                                        <a href="#" class="btn col-6"><i class="bi bi-cart-plus"></i></a>
                                        <a href="#" class="btn col-6"><i class="bi bi-list-ul"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">

                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <img class="img-fluid" alt="100%x280" src="assets/smartwatch.webp">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="#" class="text-reset stretched-link">Smartwatch Lige BW0223</a></h5>
                                    <div class="row my-4">
                                        <h5 class="col-6" style="color: #FF7C48;">$599</h5>
                                        <p class="card-text col-6">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </p>
                                    </div>
                                    <div class="row buttons">
                                        <a href="#" class="btn col-6"><i class="bi bi-cart-plus"></i></a>
                                        <a href="#" class="btn col-6"><i class="bi bi-list-ul"></i></a>
                                    </div>
                                    
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <img class="img-fluid" alt="100%x280" src="assets/xiaomi.webp">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="#" class="text-reset stretched-link">Xiaomi Redmi 9A</a></h5>
                                    <div class="row my-4">
                                        <h5 class="col-6" style="color: #FF7C48;">$2,999</h5>
                                        <p class="card-text col-6">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star"></i>
                                        </p>
                                    </div>
                                    <div class="row buttons">
                                        <a href="#" class="btn col-6"><i class="bi bi-cart-plus"></i></a>
                                        <a href="#" class="btn col-6"><i class="bi bi-list-ul"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <img class="img-fluid" alt="100%x280" src="assets/lonchera.webp">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="#" class="text-reset stretched-link">Lonchera térmica</a></h5>
                                    <div class="row my-4">
                                        <h5 class="col-6" style="color: #FF7C48;">$129</h5>
                                        <p class="card-text col-6">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star"></i>
                                        </p>
                                    </div>
                                    <div class="row buttons">
                                        <a href="#" class="btn col-6"><i class="bi bi-cart-plus"></i></a>
                                        <a href="#" class="btn col-6"><i class="bi bi-list-ul"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <img class="img-fluid" alt="100%x280" src="assets/lonchera.webp">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="#" class="text-reset stretched-link">Lonchera térmica</a></h5>
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
                                        <a href="#" class="btn col-6"><i class="bi bi-cart-plus"></i></a>
                                        <a href="#" class="btn col-6"><i class="bi bi-list-ul"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/inicio.js"></script>
</body>
</html>