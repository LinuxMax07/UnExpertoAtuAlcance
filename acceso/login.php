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
                    <div class="wrap d-md-flex">
                        <div class="img fondo_login">
                        </div>

                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4 text-center">Iniciar Sesión</h3>
                                </div>
                            </div>
                            <form id="form-login" action="#" class="signin-form">
                                <div class="form-group mb-3">
                                    <label class="label" for="name">Expediente/Matrícula</label>
                                    <input type="text" name="expediente" class="form-control" placeholder="Usuario" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Contraseña</label>
                                    <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                                </div>
                                <!-- <div class="form-group d-md-flex">
                                    <div class=" text-left">
                                        <label class="checkbox-wrap checkbox-primary mb-0"><a href="#"> Acepto los términos y
                                                condiciones.</a>
                                            <input type="checkbox" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                           
                                </div> -->
                                <div class="form-group mt-4">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">Ingresar</button>
                                </div>

                            </form>
                            <p class="text-center">¿No tienes cuenta? <a data-toggle="tab" href="registro">Regístrate</a>
                            </p>
                        </div>

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