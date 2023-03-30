<?php
$pagina = 'productos';
include 'includes/header.php';
$empresasUsu = mysqli_query($db, "SELECT * FROM empresas WHERE usuarios_id='$id'");

?>

<!--Container Main start-->
<div class=" fondo-inicio pt-5">

    <div id="tab-empresa" class="tabs ">
        <input type="radio" id="tab1" name="tab-control" checked>
        <!-- <input type="radio" id="tab2" name="tab-control">
        <input type="radio" id="tab3" name="tab-control"> -->
        <!--  <input type="radio" id="tab4" name="tab-control"> -->
        <ul>
            <li title="Features"><label for="tab1" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M6.01 16.136L4.141 4H3a1 1 0 0 1 0-2h1.985a.993.993 0 0 1 .66.235a.997.997 0 0 1 .346.627L6.319 5H14v2H6.627l1.23 8h9.399l1.5-5h2.088l-1.886 6.287A1 1 0 0 1 18 17H7.016a.993.993 0 0 1-.675-.248a.998.998 0 0 1-.332-.616zM10 20a2 2 0 1 1-4 0a2 2 0 0 1 4 0zm9 0a2 2 0 1 1-4 0a2 2 0 0 1 4 0zm0-18a1 1 0 0 1 1 1v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0V6h-1a1 1 0 1 1 0-2h1V3a1 1 0 0 1 1-1z" />
                    </svg>
                    <br><span>Mis Productos</span></label>
            </li>

            <button type="button" id="btn-registrar-producto" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticModal-producto">+ Agregar Producto</button>






        </ul>

        <div class="slider">
            <div class="indicator"></div>

        </div>

        <div class="slider2">
            <div class="indicator"></div>

        </div>

        <div class="content">
            <section>

                <div id="list-empresas" class="seccion-empresas mt-4">

                    <!-- <div class="card-articulo  headline ">
                        <div class="single_course">
                            <div class="course_head">
                                <img class="img-fluid" src="img/default.png" alt="" />
                            </div>
                            <div class="course_content">
                                <span class="price">$246</span>
                                <span class="tag d-inline-block">Contactar</span>
                                <h4 class="mb-3 mt-3">
                                    <a href="#">Joyas y Accesorios</a>
                                </h4>
                            </div>
                        </div>
                        <div class="d-flex gap-3 mt-4">
                            <button type="button" class="btn btn-success">Editar</button>
                            <button type="button" class="btn btn-danger">Borrar</button>
                        </div>
                    </div> -->


                </div>
                <div class="contador-productos">
                </div>



            </section>

        </div>

    </div>


</div>

<!-- Modal crear producto -->
<div class="modal fade" id="staticModal-producto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title titulo-modal-producto" id="staticBackdropLabel">Registro de Producto </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <form id="form-crear-producto" action="#" enctype="multipart/form-data">

                    <div class="seccion-info-General">
                        <div>
                            <h2 class="text-center">Foto del producto</h2>

                            <div class="file-drop-area">

                                <div class="img-container img-preview">
                                    <!-- <img src="img/default.png" width="250" height="250"> -->
                                </div>
                                <span class="fake-btn mt-3">Seleccionar archivo</span>
                                <span class="file-msg">o arrastre y suelte el archivo</span>
                                <input accept=".jpg, .jpeg, .png" name="imagenProducto" id="imagen_producto" class="file-input" type="file" multiple>

                            </div>

                        </div>
                        <div>
                            <p><b>Los campos marcados con un * son obligatorios.</b> </p>
                            <h2 class="text-center">Información del producto</h2>
                            <div class="d-flex gap-5">
                                <div class="form-group mt-3 w-100">
                                    <label for="exampleFormControlInput1">Nombre del producto*</label>
                                    <input type="text" id="input-nombre" name="nombre" class="form-control" required placeholder="Nombre del producto">
                                </div>
                                <div class="form-group mt-3 w-100">
                                    <label for="exampleFormControlSelect1">Categoría *</label>
                                    <select class="form-control" id="select-categoria" required name="categoria">
                                        <option value="0" disabled selected>Selecciona una categoría</option>
                                        <option value="1">Accesorios Personales</option>
                                        <option value="2">Agronomía</option>
                                        <option value="3">Alimentos y Bebidas</option>
                                        <option value="4">Antigüedades</option>
                                        <option value="5">Arte, Papelería y Mercería</option>
                                        <option value="6">Autos, Motos y Otros</option>
                                        <option value="7">Bebés</option>
                                        <option value="8">Belleza</option>
                                        <option value="9">Cámaras y Accesorios</option>
                                        <option value="10">Construcción</option>
                                        <option value="11">Deportes</option>
                                        <option value="12">Educación</option>
                                        <option value="13">Electrodomésticos</option>
                                        <option value="14">Electrónica, Audio y Video</option>
                                        <option value="15">Entretenimiento</option>
                                        <option value="16">Gamer</option>
                                        <option value="17">Herramientas</option>
                                        <option value="18">Hogar, Muebles y Jardín</option>
                                        <option value="19">Inmuebles</option>
                                        <option value="20">Instrumentos Musicales</option>
                                        <option value="21">Juegos y juguetes</option>
                                        <option value="22">Libros, Revistas y Comics</option>
                                        <option value="23">Manualidades</option>
                                        <option value="24">Mascotas</option>
                                        <option value="25">Ropa, Bolsos y Calzado(niño)</option>
                                        <option value="26">Ropa, Bolsas y Calzado(niña)</option>
                                        <option value="27">Ropa, Bolsas y Calzado(mujer)</option>
                                        <option value="28">Ropa, Bolsos y Calzado(hombre)</option>
                                        <option value="29">Salud y Equipo Médico</option>
                                        <option value="30">Servicios Profesionales y Otros</option>
                                        <option value="31">Super Mercado</option>
                                        <option value="32">Tecnología</option>
                                        <option value="33">Telefonía</option>
                                        <option value="34">Otros</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex gap-5">
                                <div class="form-group mt-3 w-100">
                                    <label for="exampleFormControlInput1">Precio*</label>
                                    <input type="number" id="input-precio" name="precio" class="form-control" required placeholder="Ingresa el precio del producto">
                                </div>
                                <div class="form-group mt-3 w-100">
                                    <label for="exampleFormControlSelect1">Vendedor *</label>
                                    <select class="form-control" id="select-vendedor" required name="vendedor">
                                        <option disabled selected>¿Quién está vendiendo el producto?</option>

                                        <option value="0">Yo</option>

                                        <option disabled>Mis Empresas</option>
                                        <?php while ($empresa = mysqli_fetch_assoc($empresasUsu)) : ?>
                                            <option value="<?php echo $empresa['token']; ?>"> <?php echo $empresa['nombre']; ?></option>
                                        <?php endwhile ?>

                                    </select>
                                </div>
                            </div>
                            <!-- 
                                <div class="form-group mt-3 w-100">
                                    <label for="exampleFormControlInput1">Ubicación *</label>
                                    <input type="text" id="input-ubicacion" class="form-control" name="ubicacion" required placeholder="Ubicación de la empresa">
                                </div> -->

                            <div class="form-group mt-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Descripción del producto *</label>
                                <textarea class="form-control" id="textarea-descripcion" name="descripcion" required rows="5"></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="w-100 mt-5">

                        <input type="text" hidden class="form-control" name="token" value="<?php echo $token ?>">
                        <input type="text" hidden class="form-control" id="token-producto" name="tokenProducto" value="">

                    </div>


                    <div class="mt-5 d-flex justify-content-center gap-5">

                        <button type="submit" class="btn btn-primary btn-modal-producto btns-registrar-cancelar">Publicar producto</button>
                        <button type="button" class="btn btn-secondary btns-registrar-cancelar" data-bs-dismiss="modal">Cancelar</button>

                    </div>

                    <button id="btn-hidden-registrando" class="btn btn-primary m-auto" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Guardando datos...
                    </button>

                </form>

            </div>

            <div class="modal-footer ">


            </div>
        </div>
    </div>
</div>



<!--Container Main end-->

<?php include 'includes/footer.php'; ?>

<script src="js/producto.js?v=<?php echo (rand()); ?>"></script>