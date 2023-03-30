<?php

session_start();
$login = $_SESSION['login'];
$setPass = $_SESSION['setPassword'];
$nombreUsu = $_SESSION['usuario'];
$token = $_SESSION['token'];
$id = $_SESSION['id'];
if (!$login) {
    header("Location: ./../");
    exit;
}
if (!$setPass) {
    header("Location: ./../acceso/password.php");
    exit;
}

include '../includes/config/database.php';
$db = conectarDB();

$datosUsuario =  mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM usuarios WHERE token = '$token'"));

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal</title>
    <link rel="stylesheet" href="../libs/css/bootstrap.min.css">
    <link rel="stylesheet" href="../libs/css/boxicons.min.css">
    <link rel="stylesheet" href="../libs/css/sweetalert2.min.css">
    <link rel="stylesheet" href="css/style.css?v=<?php echo (rand()); ?>">
</head>

<script type="text/javascript" language="javascript">
    const token = "<?php echo $token ?>";
</script>


<body id="body-pd" class="body-pd">
    <header class="header body-pd" id="header">

        <div class="header_toggle"> <i class='bx bx-menu bx-x' id="header-toggle"></i> </div>
        <div class="logoheader"> <img src="../img/logos/LogoBlanco.png" alt="Logo"></div>
        <div class="header-user">
            <h4 id="nombre_usuario"><?php echo ucwords(strtolower($datosUsuario['nombre'])); ?></h4>
            <div class="header_img"><img src="uploads/perfil/<?php echo $datosUsuario['foto'] ?>" alt=""></div>
        </div>

    </header>
    <div class="l-navbar show-nav" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="#" class="nav_logo"> <i class='bx bxs-dashboard nav_logo-icon'></i> <span class="nav_logo-name">PANEL</span> </a>
                <div class="nav_list">
                    <a href="index" class="nav_link  <?php echo $pagina == 'index' ? 'active' : ''; ?>"> <i class='bx bx-grid-alt nav_icon'></i><span class="nav_name">Inicio</span> </a>
                    <a href="perfil" class="nav_link  <?php echo $pagina == 'perfil' ? 'active' : ''; ?>"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Mi perfil</span> </a>
                    <a href="empresas" class="nav_link <?php echo $pagina == 'empresas' ? 'active' : ''; ?> "> <i class='bx bx-buildings nav_icon'></i> <span class="nav_name">Mis empresas</span> </a>

                    <a href="#" class="nav_link  <?php echo $pagina == 'productos' ? 'active' : ''; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent"> <i class='bx bx-shopping-bag nav_icon'></i> <span class="nav_name">Vender</span> </a>
                    <div class="<?php echo $pagina == 'servicios' || $pagina == 'productos' || $pagina == 'marketplace' ? 'collapse.show' : 'collapse'; ?>" id="navbarToggleExternalContent">
                        <a href="productos" class="nav_link_sub"> <i class='bx bxs-t-shirt nav_icon'></i> <span class="nav_name">Productos</span> </a>
                        <a href="servicios" class="nav_link_sub"> <i class='bx bx-star nav_icon'></i> <span class="nav_name">Servicios</span> </a>
                        <a href="marketplace" class="nav_link_sub"> <i class='bx bxs-dollar-circle nav_icon'></i> <span class="nav_name">Marketplace</span> </a>
                    </div>
                    <a href="ayuda" class="nav_link <?php echo $pagina == 'ayuda' ? 'active' : ''; ?> "> <i class='bx bx-question-mark nav_icon'></i> <span class="nav_name">Ayuda</span> </a>
                </div>
            </div>

            <a href="#" id="cerrar-session" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Cerrar Sesión</span> </a>
        </nav>
    </div>