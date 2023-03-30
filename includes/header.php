<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Un Experto a tu Alcance</title>
    <link rel="stylesheet" href="libs/css/normalize.css" />
    <link rel="stylesheet" href="libs/css/owl.carousel.min.css">
    <link rel="stylesheet" href="libs/css/bootstrap.min.css">
    <link rel="stylesheet" href="libs/css/animate.min.css">
    <link rel="stylesheet" href="libs/css/sweetalert2.min.css">
    <link rel="stylesheet" href="css/style.css?v=<?php echo (rand()); ?>" />
</head>

<body>
    <nav>
        <div class="nav contenedor">
            <input type="checkbox" id="nav-check" />
            <a href="index.php"> <img src="img/logos/logo.png" alt="Logo un Experto"></a>
            <div class="nav-btn">
                <label for="nav-check">
                    <span></span>
                    <span></span>
                    <span></span>
                </label>
            </div>

            <div class="nav-links">
                <a href="index" class="<?php echo $pagina == 'index' ? 'link-activo' : ''; ?>">INICIO</a>
                <a href="productos" class="<?php echo $pagina == 'productos' ? 'link-activo' : ''; ?>">PRODUCTOS</a>
                <a href="servicios" class="<?php echo $pagina == 'servicios' ? 'link-activo' : ''; ?>">SERVICIOS</a>
                <a href="marketplace" class="<?php echo $pagina == 'marketplace' ? 'link-activo' : ''; ?>">MARKETPLACE</a>
                <a href="ayuda" class="<?php echo $pagina == 'ayuda' ? 'link-activo' : ''; ?>">AYUDA</a>
                <div class="flex-btns-nav">
                    <a href="acceso/login" target="_blank"> <button type="button" class="btn btn-primary">Inicia Sesión</button></a>
                    <a href="acceso/registro" target="_blank"><button type="button" class="btn btn-primary">Regístrate</button></a>
                </div>
            </div>

        </div>
    </nav>