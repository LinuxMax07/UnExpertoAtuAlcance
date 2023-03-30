<?php
include 'includes/config/database.php';
$db = conectarDB();
$productos = mysqli_query($db, "SELECT * FROM productos ORDER BY RAND()");
$servicios = mysqli_query($db, "SELECT * FROM servicios ORDER BY RAND()");
$marketplaces = mysqli_query($db, "SELECT * FROM marketplace ORDER BY RAND()");
$pagina = "index";
include 'includes/header.php';
?>

<main>

  <section class="seccion01_principal">
    <div class="grid_seccion01 contenedor">
      <div class="flex-juancho">
        <img class="animate__animated animate__slideInLeft" src="img/Juancho.png" alt="Imagen de Juancho">
      </div>
      <div class="seccion01_titulo">
        <img class="animate__animated animate__zoomInDown" src="img/portada.png" alt="Imagen de portada">
      </div>
    </div>
  </section>

  <section class="seccion02_resumen_productos">

    <div class="overlay-global">

      <div class="productos-resumen contenedor">
        <div class="portada-producto">
          <div class="contenedor_portada">
            <img src="img/portada_producto.jpg" alt="Imagen producto">
          </div>
        </div>
        <div class="list-producto-resumen">

          <div class="owl-carousel  owl-2">

            <?php while ($producto = mysqli_fetch_assoc($productos)) : ?>

              <div class="card-articulo">
                <a href="detalles?id=<?php echo $producto['id'] ?>" target="_blank">
                  <div class="single_course">
                    <div class="course_head">
                      <?php
                      if ($producto['imagen'] == '') {
                        echo '<img class="img-fluid" src="portal/uploads/productos/default_poduct.png" alt="" />';
                      } else {
                        echo '<img class="img-fluid" src="portal/uploads/productos/' . $producto['imagen'] . '" alt="" />';
                      }
                      ?>
                    </div>
                    <div class="course_content">
                      <span class="price">$<?php echo $producto['precio']; ?></span>
                      <span class="tag d-inline-block">Contactar</span>
                      <h4 class="mb-3">
                        <a href="detalles?id=<?php echo $producto['id'] ?>" target="_blank"><?php echo $producto['nombre']; ?></a>
                      </h4>
                      <div class="course_meta d-flex justify-content-lg-between align-items-lg-center flex-lg-row flex-column mt-3">


                        <!-- IDENTIFICA SI ES ES PUBLICADO POR EL USUARIO O POR UNA DE SUS EMPRESAS -->

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
                          <div class="authr_meta">
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
                            <span class="d-inline-block ml-2"><b>Publicado por: <br></b>

                              <div class="vendedor-publicado">
                                <?php echo ucwords(mb_strtolower($user['nombre'], 'UTF-8')); ?>
                              </div>

                            </span>
                          </div>
                        <?php endwhile ?>

                      </div>

                    </div>
                  </div>
                </a>
              </div>
            <?php endwhile ?>

          </div>

        </div>
      </div>

      <div class="productos-ver-mas contenedor ">
        <a href="productos"><button type="button" class="btn btn-primary">Ver todo</button></a>

      </div>

    </div>

    <br>
    <div class="overlay-global mt-4">
      <div class="servicios-resumen contenedor">

        <div class="list-producto-resumen">

          <div class="owl-carousel  owl-2-right">

            <?php while ($servicio = mysqli_fetch_assoc($servicios)) : ?>

              <div class="card-articulo">
                <a href="detalles_servicio?id=<?php echo $servicio['id'] ?>">
                  <div class="single_course">
                    <div class="course_head">

                      <?php

                      if ($servicio['imagen'] == '') {
                        echo '<img class="img-fluid" src="portal/uploads/servicios/default_poduct.png" alt="" />';
                      } else {
                        echo '<img class="img-fluid" src="portal/uploads/servicios/' . $servicio['imagen'] . '" alt="" />';
                      }
                      ?>

                    </div>
                    <div class="course_content text-start">
                      <span class="price">$<?php echo $servicio['precio']; ?></span>
                      <span class="tag d-inline-block">Contactar</span>
                      <h4 class="mb-3" dir="ltr">
                        <a href="detalles_servicio?id=<?php echo $servicio['id'] ?>"><?php echo $servicio['nombre']; ?></a>
                      </h4>
                      <div class="course_meta d-flex justify-content-lg-between align-items-lg-center flex-lg-row flex-column mt-3">
                        <?php

                        $tabla = '';
                        $identificador = '';

                        if ($servicio['vendedor'] === '0') {
                          $tabla = 'usuarios';
                          $identificador = $servicio['usuarios_id'];
                        } else {
                          $tabla = 'empresas';
                          $identificador = $servicio['empresas_id'];
                        }

                        $idUsuario = $servicio['usuarios_id'];
                        $usuarioSer = mysqli_query($db, "SELECT * FROM $tabla WHERE id ='$identificador'")
                        ?>

                        <?php while ($user = mysqli_fetch_assoc($usuarioSer)) : ?>
                          <div class="authr_meta2 w-100">
                            <span class="d-inline-block ml-2 " dir="ltr"><b>Publicado por: <br></b>
                              <div class="vendedor-publicado">
                                <?php echo ucwords(mb_strtolower($user['nombre'], 'UTF-8')); ?>
                              </div>
                            </span>
                            <img src="portal/uploads<?php
                                                    if ($servicio['vendedor'] === '0') {

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
                        <?php endwhile ?>

                      </div>
                    </div>
                  </div>
                </a>
              </div>

            <?php endwhile ?>


          </div>

        </div>

        <div class="portada-producto">
          <div class="contenedor_portada">
            <img src="img/portada_servicios.jpg" alt="Imagen producto">
          </div>
        </div>

      </div>

      <div class="servicios-ver-mas contenedor ">
        <a href="servicios"><button type="button" class="btn btn-primary">Ver todo</button></a>

      </div>
    </div>

    <br>
    <div class="overlay-global mt-4">
      <div class="productos-resumen contenedor">
        <div class="portada-producto">
          <div class="contenedor_portada">
            <img src="img/portada_marketplace.jpg" alt="Imagen producto">
          </div>
        </div>
        <div class="list-producto-resumen">

          <div class="owl-carousel  owl-2">


            <?php while ($marketplace = mysqli_fetch_assoc($marketplaces)) : ?>
              <div class="card-articulo">
                <a href="detalles_market?id=<?php echo $marketplace['id'] ?>">
                  <div class="single_course">
                    <div class="course_head">
                      <?php
                      if ($marketplace['imagen'] == '') {
                        echo '<img class="img-fluid" src="portal/uploads/marketplace/default_poduct.png" alt="" />';
                      } else {
                        echo '<img class="img-fluid" src="portal/uploads/marketplace/' . $marketplace['imagen'] . '" alt="" />';
                      }
                      ?> </div>
                    <div class="course_content">
                      <span class="price">$<?php echo $marketplace['precio']; ?></span>
                      <span class="tag d-inline-block">Contactar</span>
                      <h4 class="mb-3">
                        <a href="detalles_market?id=<?php echo $marketplace['id'] ?>"><?php echo $marketplace['nombre']; ?></a>
                      </h4>
                      <div class="course_meta d-flex justify-content-lg-between align-items-lg-center flex-lg-row flex-column mt-3">

                        <?php

                        $tabla = '';
                        $identificador = '';

                        if ($marketplace['vendedor'] === '0') {
                          $tabla = 'usuarios';
                          $identificador = $marketplace['usuarios_id'];
                        } else {
                          $tabla = 'empresas';
                          $identificador = $marketplace['empresas_id'];
                        }

                        $idUsuario = $marketplace['usuarios_id'];
                        $usuarioSer = mysqli_query($db, "SELECT * FROM $tabla WHERE id ='$identificador'")
                        ?>
                        <?php while ($user = mysqli_fetch_assoc($usuarioSer)) : ?>
                          <div class="authr_meta">
                            <img src="portal/uploads<?php
                                                    if ($marketplace['vendedor'] === '0') {

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
                            <span class="d-inline-block ml-2"><b>Publicado por: <br></b>
                              <div class="vendedor-publicado">
                                <?php echo ucwords(mb_strtolower($user['nombre'], 'UTF-8')); ?>
                              </div>
                            </span>
                          </div>
                        <?php endwhile ?>


                      </div>
                    </div>
                  </div>
                </a>
              </div>
            <?php endwhile ?>






          </div>

        </div>
      </div>

      <div class="marketplace-ver-mas contenedor ">
        <a href="marketplace"><button type="button" class="btn btn-primary">Ver todo</button></a>
      </div>
    </div>
  </section>

  <section class="seccion3_somos">
    <div class="seccion3_elementos contenedor">

      <div>
        <img src="img/Tienda.png" alt="Icono tienda">
      </div>
      <div class="seccion3_p">
        <p>
          Somos una plataforma digital en la que encontrarás todo lo que buscas, ofertado por los alumnos y personal
          de la Universidad Tecnológica de San Juan del Río.
        </p>
        <p>
          Impulsa y consume marcas locales , asi como a estudiantes que buscan culminar una gran etapa en sus vidas.
        </p>
      </div>
    </div>
  </section>
</main>

<?php
include 'includes/footer.php';
?>