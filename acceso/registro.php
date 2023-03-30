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
    <section class="ftco-section2">
        <div class="viewport2">

            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap wrap-flex">
                        <div class="login-wrap p-4 p-md-4 cont-registro">
                            <div class="d-flex">
                                <div class="w-100">
                                    <!-- <h3 class="mb-1 text-center">Registro</h3> -->
                                    <p class="text-justify">Para poder registrarte a esta plataforma debes ingresar tus credenciales del portal de alumnos, si eres administrativo debes ingresar tus credenciales del SIISC para comprobar que eres parte de la UTSJR.</p>
                                </div>
                            </div>
                            <form id="form-registro" enctype="multipart/form-data" action="#" class="signin-form">
                                <div class="form-group mb-3">
                                    <label class="label" for="name">USUARIO</label>
                                    <input type="text" class="form-control" name="usuario" placeholder="Usuario" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="name">PASSWORD</label>
                                    <input type="password" class="form-control" name="password" placeholder="password" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password">EXPEDIENTE/MATRICULA</label>
                                    <input type="text" class="form-control" name="expediente" placeholder="Expediente" required>
                                </div>
                                <div class="form-group d-md-flex">
                                    <div class=" text-left">
                                        <label class="checkbox-wrap checkbox-primary mb-0"> <a href="../docs/TerminosYcondiciones.pdf" target="_blank">Acepto los términos y
                                                condiciones.</a>
                                            <input type="checkbox" name="condiciones">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <!-- <div class="w-50 text-md-right">
										<a href="#">Forgot Password</a>
									</div> -->
                                </div>
                                <div class="form-group">
                                    <button id="btn-registro-nuevo" type="submit" class="form-control btn btn-primary rounded submit px-3">
                                        Registrase
                                    </button>
                                </div>

                            </form>
                            <p class="text-center">¿Ya tienes una cuenta? <a data-toggle="tab" href="login">Inicia Sesión</a>
                            </p>
                        </div>

                        <div class="img fondo_registrar">
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