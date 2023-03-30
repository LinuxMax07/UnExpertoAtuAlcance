<?php
session_start();
$login = $_SESSION['login'];
if (!$login) {
    header('Location:/');
    exit;
}

$nombreUsu = $_SESSION['usuario'];
$id = $_SESSION['id'];
$token = $_SESSION['token'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body class="fondo">
    <section class="ftco-section">
        <div class="viewport">

            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap">
                        <div class=" p-4 p-md-4">
                            <div class="img_password">
                                <img src="img/circuloLobos.png" alt="">
                            </div>
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-2 text-center">Bienvenido: <span class="background-primary"><?php echo ucwords(strtolower($nombreUsu)); ?></php></span></h3>
                                    <p class="text-center">Para terminar tu registro ingresa una nueva contraseña para esta plataforma</p>
                                </div>
                            </div>
                            <form id="form-password-create" action="#" class="signin-form">
                                <div class="contenedor_pass">
                                    <div class="form-group mb-3">
                                        <label class="label" for="name">Contraseña</label>
                                        <input type="password" name="contraseña" class="form-control" placeholder="Ingresa una contraseña" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="label" for="password">Repite la contraseña</label>
                                        <input type="password" name="contraseña2" class="form-control" placeholder="Escribe de nuevo la contraseña" required>
                                        <input type="text" name="token" class="form-control" hidden value="<?php echo $token ?>">
                                    </div>
                                </div>
                                <div class="form-group d-flex">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3 w-50 m-auto">Guardar y acceder</button>
                                </div>

                            </form>
                        </div>

                        <!-- <p class="text-center">¿No tienes cuenta? <a data-toggle="tab" href="register.php">Regístrate</a>
                        </p> -->
                    </div>

                </div>
            </div>
        </div>

    </section>

</body>
<script src="../libs/js/jquery-3.3.1.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/app.js"></script>


</html>