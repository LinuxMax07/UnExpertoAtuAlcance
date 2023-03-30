<?php
$pagina = 'perfil';
include 'includes/header.php';
$totalEmpresas =  mysqli_fetch_assoc(mysqli_query($db, "SELECT count(*) as total FROM empresas WHERE usuarios_id='$id'"));
$totalProductos =  mysqli_fetch_assoc(mysqli_query($db, "SELECT count(*) as total FROM productos WHERE usuarios_id='$id'"));
$totalServicios =  mysqli_fetch_assoc(mysqli_query($db, "SELECT count(*) as total FROM servicios WHERE usuarios_id='$id'"));
$totalMarketplace =  mysqli_fetch_assoc(mysqli_query($db, "SELECT count(*) as total FROM marketplace WHERE usuarios_id='$id'"));

?>


<!--Container Main start-->
<div class="vh-100 fondo-inicio pt-5">

    <div class="tabs">
        <input type="radio" id="tab1" name="tab-control" checked>
        <input type="radio" id="tab2" name="tab-control">
        <input type="radio" id="tab3" name="tab-control">
        <!--  <input type="radio" id="tab4" name="tab-control"> -->
        <ul>
            <li title="Features"><label for="tab1" role="button">
                    <!--                 
                <svg viewBox="0 0 24 24">
                        <path d="M14,2A8,8 0 0,0 6,10A8,8 0 0,0 14,18A8,8 0 0,0 22,10H20C20,13.32 17.32,16 14,16A6,6 0 0,1 8,10A6,6 0 0,1 14,4C14.43,4 14.86,4.05 15.27,4.14L16.88,2.54C15.96,2.18 15,2 14,2M20.59,3.58L14,10.17L11.62,7.79L10.21,9.21L14,13L22,5M4.93,5.82C3.08,7.34 2,9.61 2,12A8,8 0 0,0 10,20C10.64,20 11.27,19.92 11.88,19.77C10.12,19.38 8.5,18.5 7.17,17.29C5.22,16.25 4,14.21 4,12C4,11.7 4.03,11.41 4.07,11.11C4.03,10.74 4,10.37 4,10C4,8.56 4.32,7.13 4.93,5.82Z" />
                </svg>
                     -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4Z" />
                    </svg>

                    <br><span>Mis datos</span></label></li>
            <li title="Delivery Contents"><label for="tab2" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 32 32">
                        <circle cx="21" cy="21" r="2" fill="currentColor" />
                        <circle cx="7" cy="7" r="2" fill="currentColor" />
                        <path fill="currentColor" d="M27 31a4 4 0 1 1 4-4a4.012 4.012 0 0 1-4 4Zm0-6a2 2 0 1 0 2 2a2.006 2.006 0 0 0-2-2Z" />
                        <path fill="currentColor" d="M30 16A14.041 14.041 0 0 0 16 2a13.043 13.043 0 0 0-6.8 1.8l1.1 1.7a24.425 24.425 0 0 1 2.4-1A25.135 25.135 0 0 0 10 15H4a11.149 11.149 0 0 1 1.4-4.7L3.9 9A13.842 13.842 0 0 0 2 16a13.998 13.998 0 0 0 14 14a13.366 13.366 0 0 0 5.2-1l-.6-1.9a11.442 11.442 0 0 1-5.2.9A21.071 21.071 0 0 1 12 17h17.9a3.402 3.402 0 0 0 .1-1ZM12.8 27.6a13.02 13.02 0 0 1-5.3-3.1A12.505 12.505 0 0 1 4 17h6a25.002 25.002 0 0 0 2.8 10.6ZM12 15a21.446 21.446 0 0 1 3.3-11h1.4A21.446 21.446 0 0 1 20 15Zm10 0a23.278 23.278 0 0 0-2.8-10.6A12.092 12.092 0 0 1 27.9 15Z" />
                    </svg>


                    <br><span>Mis redes</span></label></li>

            <li title="Shipping"><label for="tab3" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M21 11c0 5.55-3.84 10.74-9 12c-5.16-1.26-9-6.45-9-12V5l9-4l9 4v6m-9 10c3.75-1 7-5.46 7-9.78V6.3l-7-3.12L5 6.3v4.92C5 15.54 8.25 20 12 21m2.8-10V9.5C14.8 8.1 13.4 7 12 7S9.2 8.1 9.2 9.5V11c-.6 0-1.2.6-1.2 1.2v3.5c0 .7.6 1.3 1.2 1.3h5.5c.7 0 1.3-.6 1.3-1.2v-3.5c0-.7-.6-1.3-1.2-1.3m-1.3 0h-3V9.5c0-.8.7-1.3 1.5-1.3s1.5.5 1.5 1.3V11Z" />
                    </svg>

                    <br><span>Contraseña</span></label></li>
            <!--<li title="Returns"><label for="tab4" role="button"><svg viewBox="0 0 24 24">
                        <path d="M11,9H13V7H11M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M11,17H13V11H11V17Z" />
                    </svg><br><span>Returns</span></label></li> -->
        </ul>

        <div class="slider">
            <div class="indicator"></div>

        </div>
        <div class="slider2">
            <div class="indicator"></div>

        </div>
        <div class="content">
            <section>
                <div class="seccion-datos-perfil">
                    <div class="seccion-datos-1">
                        <form id="form-perfil-datos" action="#">
                            <div class="inputs-content ">
                                <div class="mb-3 w-100">
                                    <label for="exampleFormControlInput1" class="form-label">Nombre(s)</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Agrega tu nombre" required readonly>
                                </div>
                                <div class="mb-3 w-100">
                                    <label for="exampleFormControlInput1" class="form-label">Apellidos(s)</label>
                                    <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Agrega tus apellidos" required readonly>
                                </div>
                            </div>

                            <div class="mb-4 w-100">
                                <label for="exampleFormControlInput1" class="form-label">Dirección <h4>(Lugar donde tus clientes te pueden encontrar)</h4></label>
                                <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Agrega una dirección">

                                <input type="text" hidden class="form-control" name="token" value="<?php echo $token ?>">
                            </div>

                            <div class="mb-3 mt-4 w-100 d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>

                        <h3 class="text-center mt-5">Resumen</h3>

                        <div class="d-flex justify-content-evenly mt-4">

                            <div class="flex-resumen">
                                <div class="info-perfil">

                                    <div class="circulo-indicador">
                                        <p><?php echo $totalEmpresas['total'] ?></p>
                                    </div>


                                    <p>Empresas</p>


                                </div>
                                <div class="info-perfil">

                                    <div class="circulo-indicador">
                                        <p><?php echo $totalProductos['total'] ?></p>
                                    </div>


                                    <p>Productos</p>


                                </div>
                            </div>

                            <div class="flex-resumen">
                                <div class="info-perfil">

                                    <div class="circulo-indicador">
                                        <p><?php echo $totalServicios['total'] ?></p>
                                    </div>


                                    <p>Servicios</p>


                                </div>
                                <div class="info-perfil">

                                    <div class="circulo-indicador">
                                        <p><?php echo $totalMarketplace['total'] ?></p>
                                    </div>


                                    <p>Marketplace</p>


                                </div>
                            </div>



                        </div>
                    </div>


                    <div class=" flex-foto-perfil">

                        <h1>Foto de perfil</h1>

                        <!--

                        <div class="circulo-foto-perfil">

                        </div> -->

                        <div class="file-drop-area">
                            <div class="overlay-perfil">
                                <h4>Click para seleccionar nueva foto</h4>

                            </div>
                            <div class="img-container img-preview">
                                <img src="uploads/perfil/<?php echo $datosUsuario['foto'] ?>" width="250" height="250">

                            </div>
                            <form id="form-foto-perfil" action="#" enctype="multipart/form-data">
                                <!-- <span class="fake-btn">Seleccionar archivo</span> -->
                                <!-- <span class="file-msg">o arrastre y suelte el archivo</span> -->
                                <input accept=".jpg, .jpeg, .png" name="perfil" id="perfil" class="file-input" type="file" multiple>
                                <input type="text" hidden class="form-control" name="token" id="1" value="<?php echo $token ?>">
                            </form>
                        </div>
                        <div class="mb-3 mt-5 w-100 d-flex justify-content-center flex-column gap-2 align-items-center">
                            <div id="progreso-foto-perfil" class="progress">
                                <div id="progress-perfil" class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">0%</div>
                            </div>
                            <button id="act-foto-perfil" type="submit" class="btn btn-primary">Actualizar foto</button>
                        </div>
                    </div>
                </div>
            </section>
            <section>
                <div class="seccion-perfil-redes">
                    <form id="form-perfil-redes" action="">
                        <div class="mb-4 row input-redes">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Facebook</label>
                            <div class="col-sm-10">
                                <input type="url" class="form-control" name="facebook" id="facebook" placeholder="Agrega tu pagina de facebook">
                                <div class="form-text">*Obligatorio insertar un link</div>

                            </div>
                        </div>
                        <div class="mb-4 row input-redes">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Instagram</label>
                            <div class="col-sm-10">
                                <input type="url" class="form-control" name="instagram" id="instagram" placeholder="Agrega tu Instagram">
                                <div class="form-text">*Obligatorio insertar un link</div>
                            </div>
                        </div>
                        <div class="mb-4 row input-redes">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Correo</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="correo" id="correo" placeholder="Agrega tu Correo Electrónico">
                            </div>
                        </div>
                        <div class="mb-4 row input-redes">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Pagina web</label>
                            <div class="col-sm-10">
                                <input type="url" class="form-control" name="pagina" id="pagina" placeholder="Agrega tu Pagina Web">
                                <div class="form-text">*Obligatorio insertar un link</div>
                            </div>
                        </div>
                        <div class="mb-4 row input-redes">
                            <label for="inputPassword" class="col-sm-2 col-form-label">WhatsApp</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="whatsApp" id="whatsApp" placeholder="Agrega tu WhatsApp">
                            </div>
                        </div>
                        <div class="mb-4 row input-redes">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Teléfono</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="telefono" id="telefono" placeholder="Agrega tu numero de teléfono">
                                <input type="text" hidden class="form-control" name="token" value="<?php echo $token ?>" placeholder="name@example.com">

                            </div>
                        </div>

                        <div class="mb-3 mt-5 w-100 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>

                </div>
            </section>
            <section>

                <div class="seccion-perfil-password">

                    <h1 class="text-center mt-4 mb-4">Actualizar contraseña</h1>

                    <form id="form-perfil-pass" action="#">

                        <div class="mb-4 input-password">
                            <label for="exampleFormControlInput1" class="form-label">Contraseña Actual</label>
                            <input type="password" name="actual" class="form-control" id="acceso_pass_actual" placeholder="Ingresa tu contraseña Actual">
                        </div>

                        <div class="mb-4 input-password">
                            <label for="exampleFormControlInput1" class="form-label">Nueva contraseña</label>
                            <input type="password" name="nueva" class="form-control" id="acceso_contraseña" placeholder="Ingresa una nueva contraseña">
                        </div>

                        <div class="mb-4 input-password">
                            <label for="exampleFormControlInput1" class="form-label">Repite la contraseña nueva</label>
                            <input type="password" name="nueva2" class="form-control" id="acceso_contraseña2" placeholder="Repite la nueva contraseña">
                        </div>

                        <div class="mb-4 input-password">
                            <input type="text" name="token" hidden class="form-control" name="token" value="<?php echo $token ?>">
                        </div>

                        <div class="mb-3 mt-5 w-100 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>

                </div>


            </section>
            <!--<section>
                <h2>Returns</h2>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa dicta vero rerum? Eaque repudiandae architecto libero reprehenderit aliquam magnam ratione quidem? Nobis doloribus molestiae enim deserunt necessitatibus eaque quidem incidunt.
            </section> -->
        </div>
    </div>





</div>
<!--Container Main end-->
<?php include 'includes/footer.php'; ?>

<script src="js/perfil.js?v=<?php echo (rand()); ?>"></script>