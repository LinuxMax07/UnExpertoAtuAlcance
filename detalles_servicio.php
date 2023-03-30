<?php

include 'includes/config/database.php';
include 'includes/header.php';
$db = conectarDB();
$id = $_GET['id'];
$productos = mysqli_query($db, "SELECT * FROM servicios WHERE id='$id'");
?>

<main>
    <div class="fondo-pag-detalles">
        <?php while ($producto = mysqli_fetch_assoc($productos)) : ?>
            <div class="card-detalle">
                <div class="card-datalle_imagen">

                    <?php
                    if ($producto['imagen'] == '') {
                        echo '<img src="portal/uploads/servicios/default_poduct.png" alt="" />';
                    } else {
                        echo '<img src="portal/uploads/servicios/' . $producto['imagen'] . '" alt="" />';
                    }
                    ?>



                </div>
                <div class="card-detalle_cont">
                    <div class="detalle_titulo">
                        <h4><?php echo $producto['nombre'] ?></h4>
                    </div>


                    <div class="detalles_global">



                        <?php

                        $tabla = '';
                        $identificador = '';

                        if ($producto['vendedor'] === '0') {
                            $tabla = 'usuarios';
                            $identificador = $producto['usuarios_id'];
                        } else {
                            $tabla = 'empresas';
                            $identificador = $producto['empresas_id'];
                        }

                        $idUsuario = $producto['usuarios_id'];
                        $usuario = mysqli_query($db, "SELECT * FROM $tabla WHERE id ='$identificador'")
                        ?>

                        <?php while ($user = mysqli_fetch_assoc($usuario)) : ?>
                            <div class="detalles_perfil">
                                <div class="img_perfil">
                                    <img src="portal/uploads<?php

                                                            if ($producto['vendedor'] === '0') {

                                                                if ($user['foto'] == '') {
                                                                    echo "/perfil/predeterminada.png";
                                                                } else {

                                                                    echo "/perfil/" . $user['foto'];
                                                                }
                                                            } else {
                                                                if ($user['logo'] == '') {
                                                                    echo "/perfil/predeterminada.png";
                                                                } else {
                                                                    echo "/logos/" . $user['logo'];
                                                                }
                                                            }
                                                            ?>" alt="" />
                                </div>
                                <div class="nombre_perfil">
                                    <h4><?php echo ucwords(mb_strtolower($user['nombre'], 'UTF-8')); ?></h4>
                                </div>
                            </div>

                        <?php endwhile ?>


                        <div class="detalles_categoria">

                            <div class="detalles_precio">
                                <p>$<?php echo $producto['precio'] ?></p>

                            </div>

                            <div class="detalles_producto">
                                <p>Servicio</p>
                            </div>

                        </div>



                    </div>

                    <div class="detalles_descripcion">
                        <h1>Descripción</h1>

                        <p>
                            <?php echo $producto['descripcion'] ?>
                        </p>

                    </div>



                    <?php
                    $tabla = '';
                    $identificador = '';

                    if ($producto['vendedor'] === '0') {
                        $tabla = 'usuarios';
                        $identificador = $producto['usuarios_id'];
                    } else {
                        $tabla = 'empresas';
                        $identificador = $producto['empresas_id'];
                    }

                    $idUsuario = $producto['usuarios_id'];
                    $vendedores = mysqli_query($db, "SELECT * FROM $tabla WHERE id ='$identificador'")
                    ?>

                    <?php while ($vendedor = mysqli_fetch_assoc($vendedores)) : ?>

                        <div class="detalles_contacto">

                            <h1>Contacto</h1>

                            <?php if ($producto['vendedor'] === '0') {
                                if ($vendedor['direccion'] != '') {
                                    echo '<p>Dirección:' . $vendedor['direccion'] . '</p>';
                                }
                            } else {
                                if ($vendedor['ubicacion'] != '') {
                                    echo '<p>Dirección:' . $vendedor['ubicacion'] . '</p>';
                                }
                            }

                            if ($vendedor['correo'] != '') {
                                echo '<p>Correo:' . $vendedor['correo'] . '</p>';
                            }

                            if ($vendedor['telefono'] != '') {
                                echo '<p>Teléfono:' . $vendedor['telefono'] . '</p>';
                            }
                            ?>


                            <h1>Redes Sociales</h1>

                            <ul class="wrapper">

                                <?php
                                if ($vendedor['facebook'] != '') {
                                    echo '  <a href=" ' . $vendedor['facebook'] . ' " target="_blank">
                                    <li class="icon facebook">
                                        <span class="tooltip">Facebook</span>
                                        <span><i class="fab fa-facebook-f"></i></span>
                                    </li>
                                </a>';
                                }
                                ?>

                                <?php
                                if ($vendedor['whatsApp'] != '') {
                                    echo '   <a href="https://wa.me/52' . $vendedor['whatsApp'] . '" target="_blank">
                                    <li class="icon twitter">
                                       <span class="tooltip">Whatsapp</span>
                                       <span><i class="fab fa-twitter"></i></span>
                                   </li>
                               </a>';
                                }
                                ?>


                                <?php
                                if ($vendedor['instagram'] != '') {
                                    echo '  <a href="' . $vendedor['instagram'] . '"  target="_blank">
                                    <li class="icon instagram">
                                        <span class="tooltip">Instagram</span>
                                        <span><i class="fab fa-instagram"></i></span>
                                    </li>
                                </a>';
                                }
                                ?>


                                <?php
                                if ($vendedor['paginaWeb'] != '') {
                                    echo '  <a href="' . $vendedor['paginaWeb'] . '" target="_blank">
                                    <li class="icon web">
                                        <span class="tooltip">Web</span>
                                        <span><i class="fab fa-facebook-f"></i></span>
                                    </li>
                                </a>';
                                }
                                ?>




                            </ul>

                        </div>


                    <?php endwhile ?>



                </div>




            </div>
        <?php endwhile ?>
    </div>
    </div>
</main>


<?php
include 'includes/footer.php';
?>