<?php
$pagina = 'empresas';
include 'includes/header.php';

?>

<!--Container Main start-->
<div class=" vh-100 fondo-inicio pt-5">

    <div id="tab-empresa" class="tabs ">
        <input type="radio" id="tab1" name="tab-control" checked>
        <!-- <input type="radio" id="tab2" name="tab-control">
        <input type="radio" id="tab3" name="tab-control"> -->
        <!--  <input type="radio" id="tab4" name="tab-control"> -->
        <ul>
            <li title="Features"><label for="tab1" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 16 16">
                        <g fill="currentColor">
                            <path d="M12.5 16a3.5 3.5 0 1 0 0-7a3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Z" />
                            <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v7.256A4.493 4.493 0 0 0 12.5 8a4.493 4.493 0 0 0-3.59 1.787A.498.498 0 0 0 9 9.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .39-.187A4.476 4.476 0 0 0 8.027 12H6.5a.5.5 0 0 0-.5.5V16H3a1 1 0 0 1-1-1V1Zm2 1.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5Zm3 0v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5Zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1ZM4 5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5ZM7.5 5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm2.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5ZM4.5 8a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Z" />
                        </g>
                    </svg>
                    <br><span>Mis Empresas</span></label>
            </li>

            <button type="button" id="btn-registrar-empresa" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticModal-empresa">+ Agregar Empresa</button>






        </ul>

        <div class="slider">
            <div class="indicator"></div>

        </div>

        <div class="slider2">
            <div class="indicator"></div>

        </div>

        <div class="content">
            <section>
                <!-- <button type="button" class="btn btn-primary">+ Agregar Empresa</button> -->

                <div id="list-empresas" class="seccion-empresas mt-4">
                    <!-- 
                    <div class="card-empresa">
                        <div class="card-empresa-foto">
                            <img src="uploads/perfil/joseenrique1676563705viaja-a-san-juan-del-rio.jpg" alt="Foto de Perfil">
                        </div>
                        <h1 class="text-center mt-3">Luminnus Press</h1>

                        <div class="d-flex gap-3 mt-4">
                            <button type="button" class="btn btn-success">Editar</button>
                            <button type="button" class="btn btn-danger">Borrar</button>
                        </div>
                    </div>
                    <div class="card-empresa">
                        <div class="card-empresa-foto">
                            <img src="uploads/perfil/joseenrique1676563705viaja-a-san-juan-del-rio.jpg" alt="Foto de Perfil">
                        </div>
                        <h1 class="text-center mt-3">Luminnus Press</h1>

                        <div class="d-flex gap-3 mt-4">
                            <button type="button" class="btn btn-success">Editar</button>
                            <button type="button" class="btn btn-danger">Borrar</button>
                        </div>
                    </div>
                    <div class="card-empresa">
                        <div class="card-empresa-foto">
                            <img src="uploads/perfil/joseenrique1676563705viaja-a-san-juan-del-rio.jpg" alt="Foto de Perfil">
                        </div>
                        <h1 class="text-center mt-3">Luminnus Press</h1>

                        <div class="d-flex gap-3 mt-4">
                            <button type="button" class="btn btn-success">Editar</button>
                            <button type="button" class="btn btn-danger">Borrar</button>
                        </div>
                    </div> -->


                </div>
            </section>
        </div>
        <div class="contador-empresas">
        </div>

    </div>

    <!-- Modal crear empresa -->
    <div class="modal fade" id="staticModal-empresa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title titulo-modal-empresa" id="staticBackdropLabel">Registro de Empresa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <form id="form-empresa-crear" action="#" class="contenido-nueva-empresa" enctype="multipart/form-data">

                        <div class="seccion-info-General">
                            <div>
                                <h2 class="text-center">Logo de la empresa</h2>

                                <div class="file-drop-area">

                                    <div class="img-container img-preview">
                                        <!-- <img src="img/default.png" width="250" height="250"> -->
                                    </div>
                                    <span class="fake-btn mt-3">Seleccionar archivo</span>
                                    <span class="file-msg">o arrastre y suelte el archivo</span>
                                    <input accept=".jpg, .jpeg, .png" name="logoEmpresa" id="logoEmpresa" class="file-input" type="file" multiple>

                                </div>

                            </div>
                            <div>
                                <p><b>Los campos marcados con un * son obligatorios.</b> </p>
                                <h2 class="text-center">Información General</h2>
                                <div class="d-flex gap-5">
                                    <div class="form-group mt-3 w-100">
                                        <label for="exampleFormControlInput1">Nombre *</label>
                                        <input type="text" id="input-nombre" name="nombre" class="form-control" required placeholder="Nombre de la empresa">
                                    </div>
                                    <div class="form-group mt-3 w-100">
                                        <label for="exampleFormControlSelect1">Categoría *</label>
                                        <select class="form-control" id="select-categoria" required name="categoria">
                                            <option value="0" disabled selected>Selecciona tu opción</option>
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

                                <div class="form-group mt-3 w-100">
                                    <label for="exampleFormControlInput1">Ubicación</label>
                                    <input type="text" id="input-ubicacion" class="form-control" name="ubicacion" placeholder="Ubicación de la empresa">
                                </div>

                                <div class="form-group mt-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Descripción *</label>
                                    <textarea class="form-control" id="textarea-descripcion" name="descripcion" required rows="5"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="w-100 mt-5">
                            <h2 class="text-center">Datos de contacto</h2>
                            <h4 class="text-center">Con esta información tus clientes se pondrán en contacto contigo</h4>

                            <div class="d-flex gap-5">
                                <div class="form-group mt-3 w-100">
                                    <label for="exampleFormControlInput1">Facebook</label>
                                    <input type="url" id="input-facebook" class="form-control" name="facebook" placeholder="Facebook de la empresa">
                                    <div class="form-text">*Obligatorio insertar un link</div>
                                </div>
                                <div class="form-group mt-3 w-100">
                                    <label for="exampleFormControlInput1">Instagram</label>
                                    <input type="url" id="input-instagram" class="form-control" name="instagram" placeholder="Instagram de la empresa">
                                    <div class="form-text">*Obligatorio insertar un link</div>
                                </div>
                                <div class="form-group mt-3 w-100">
                                    <label for="exampleFormControlInput1">WhatsApp</label>
                                    <input type="number" id="input-whatsApp" class="form-control" name="whatsApp" placeholder="WhatsApp de la empresa">
                                </div>
                            </div>

                            <div class="d-flex gap-5">
                                <div class="form-group mt-3 w-100">
                                    <label for="exampleFormControlInput1">Pagina Web</label>
                                    <input type="url" id="input-web" name="paginaWeb" class="form-control" placeholder="Pagina web de la empresa">
                                    <div class="form-text">*Obligatorio insertar un link</div>
                                </div>
                                <div class="form-group mt-3 w-100">
                                    <label for="exampleFormControlInput1">Correo</label>
                                    <input type="email" id="input-correo" name="correo" class="form-control" placeholder="Correo de la empresa">
                                </div>

                                <div class="form-group mt-3 w-100">
                                    <label for="exampleFormControlInput1">Teléfono</label>
                                    <input type="number" id="input-telefono" name="telefono" class="form-control" placeholder="Teléfono de la empresa">
                                </div>
                            </div>

                            <input type="text" hidden class="form-control" name="token" value="<?php echo $token ?>">
                            <input type="text" hidden class="form-control" id="token-empresa" name="tokenEmpresa" value="">


                        </div>


                        <div class="mt-5 d-flex justify-content-center gap-5">

                            <button type="submit" class="btn btn-primary btn-modal-empresa btns-registrar-cancelar">Registrar Empresa</button>
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
</div>

<!--Container Main end-->

<?php include 'includes/footer.php'; ?>

<script src="js/empresa.js?v=<?php echo (rand()); ?>"></script>