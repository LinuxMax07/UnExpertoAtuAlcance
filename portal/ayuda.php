<?php
$pagina = 'ayuda';
include 'includes/header.php';
?>

<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">



<!--Container Main start-->
<div class=" fondo-inicio">

    <div class="inicio-componentes">

        <div class="fondo-pag-ayuda">
            <div class="contenido-ayuda contenedor">
                <h2 class="text-center">¿CÓMO PODEMOS AYUDARTE <?php echo $datosUsuario['nombre']; ?>?</h2>

                <div class="wow-hr type_short">
                    <span class="wow-hr-h">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </span>
                </div>

                <div class="ayuda-info">
                    <p>Un Experto a tu Alcance está preocupado por brindarte servicios de calidad
                        y un ambiente idóneo para todos. Por ello, hemos establecido vías de comunicación eficaces a todas
                        nuestras partes interesadas que nos permitan mejorar el funcionamiento de la plataforma. </p>

                    <p>Ocupa este espacio como buzón de ayuda, quejas o sugerencias. Nuestro equipo se pondrá en contacto
                        contigo, lo más pronto posible para brindarte una solución.</p>

                </div>

                <div class="cont-form-ayuda">

                    <form id="form-ayuda">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nombre*</label>
                            <input type="text" name="nombre" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingresa tu nombre completo" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Correo Electrónico*</label>
                            <input type="email" name="correo" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Dirección de correo Electrónico" required>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Escribe tu mensaje*</label>
                            <textarea class="form-control" name="mensaje" id="exampleFormControlTextarea1" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>

                </div>
            </div>

        </div>


    </div>
</div>
<!--Container Main end-->

<?php include 'includes/footer.php'; ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/sendEmail.js"></script>