<?php

include 'includes/config/database.php';
$db = conectarDB();

$valSearch = '';
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['submit'])) {
    // Se ha realizado el submit, recogemos los datos
    $search = trim($_GET['search']);
    $search = mysqli_real_escape_string($db, $search);

    // ... hacer algo con los datos ...
    $marketplaces = mysqli_query($db, "SELECT * FROM marketplace WHERE nombre LIKE '%$search%' ORDER BY RAND()");
    $valSearch = $search;
} else {
    // No se ha realizado el submit
    $marketplaces = mysqli_query($db, "SELECT * FROM marketplace ORDER BY RAND()");
}


$pagina = "marketplace";
include 'includes/header.php';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<main>
    <div class="fondo-pag-productos">
        <div class="presentacion_productos">
            <img src="img/presentacion_marketplace.png" alt="Imagen de servicios">
        </div>
        <div class=" d-flex justify-content-center align-items-center">


            <form action="" id="search">
                <div class="search">
                    <i class="fa fa-search"></i>
                    <input type="text" name="search" class="form-control" placeholder="Buscar productos" value="<?php echo $valSearch ?>">
                    <button class="btn btn-primary" type="submit" name="submit" value="3">Buscar</button>
                </div>
            </form>

        </div>

        <div class="fondo-contenido contenedor">

            <div class="lista-productos-card ">


                <?php while ($marketplace = mysqli_fetch_assoc($marketplaces)) : ?>

                    <div class="card-articulo headline ">
                        <a href="detalles_market?id=<?php echo $marketplace['id'] ?>" target="_blank">
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
                                        <a href="detalles_market?id=<?php echo $marketplace['id'] ?>" target="_blank"><?php echo $marketplace['nombre']; ?></a>
                                    </h4>
                                    <div class="course_meta d-flex justify-content-lg-between align-items-lg-center flex-lg-row flex-column mt-3">


                                        <!-- IDENTIFICA SI ES ES PUBLICADO POR EL USUARIO O POR UNA DE SUS EMPRESAS -->

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
                                        $usuario = mysqli_query($db, "SELECT * FROM $tabla WHERE id ='$identificador'")
                                        ?>

                                        <?php while ($user = mysqli_fetch_assoc($usuario)) : ?>
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
</main>



<?php
include 'includes/footer.php';
?>