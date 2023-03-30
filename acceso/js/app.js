$(document).ready(function () {
    // Reset de formularios
    $('#form-registro').trigger("reset");
    $('#form-password-create').trigger("reset");
    $('#form-login').trigger("reset");

    $("#form-registro").submit(function (e) {
        e.preventDefault();

        $("#btn-registro-nuevo").prop('disabled', true);
        $("#btn-registro-nuevo").html(`<div class="spinner-grow text-light" role="status">
        </div>
        <div class="spinner-grow text-light" role="status">
        </div>
        <div class="spinner-grow text-light" role="status">
        </div>
`);

        const data = new FormData(document.getElementById('form-registro'));
        const usuario = data.get('usuario').trim();
        const password = data.get('password').trim();
        const expediente = data.get('expediente').trim();
        const condiciones = data.get('condiciones');

        if (usuario == '' || password == '' || expediente == '') {
            Swal.fire({
                icon: 'warning',
                title: 'Faltan datos por agregar',

                confirmButtonColor: '#fff',
                showConfirmButton: false,
                timer: 2500
            })
            $("#btn-registro-nuevo").prop('disabled', false);
            $("#btn-registro-nuevo").html('Registrarse');
            return;
        }
        if (condiciones == null) {
            Swal.fire({
                icon: 'warning',
                title: 'Debes de marcar la casilla de términos y condiciones',
                confirmButtonColor: '#fff',
                showConfirmButton: false,
                timer: 2500
            })
            $("#btn-registro-nuevo").prop('disabled', false);
            $("#btn-registro-nuevo").html('Registrarse');
            return;
        }

        // Comprobar resultado
        const parametros = {
            usuario: usuario,
            password: password,
            expediente: expediente
        }

        $.post('metodos/validaUsuarioRegistro.php', parametros, function (respuesta) {
            $("#btn-registro-nuevo").prop('disabled', false);
            $("#btn-registro-nuevo").html('Registrarse');
            if (respuesta == 0) {

                Swal.fire({
                    icon: 'error',
                    title: 'No se puede realiza la petición en este momento, intenta mas tarde',
                    confirmButtonColor: '#fff',
                    showConfirmButton: false,
                    timer: 4000
                })

            }

            if (respuesta == 2) {
                Swal.fire({
                    icon: 'warning',
                    title: 'El usuario no existe, la contraseña es incorrecta o el usuario esta dado de baja',
                    confirmButtonColor: '#fff',
                    showConfirmButton: false,
                    timer: 4000
                })
            }

            if (respuesta == 3) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Tu expediente no coincide con tus accesos de usuario, por favor verifica',
                    confirmButtonColor: '#fff',
                    showConfirmButton: false,
                    timer: 3000
                })

            }
            if (respuesta == 4) {
                window.location.href = "password.php";
            }
            if (respuesta == 5) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Ya existe un usuario registrado con estos datos',
                    confirmButtonColor: '#fff',
                    showConfirmButton: false,
                    timer: 3000
                })
            }
        })

    })


    $("#form-password-create").submit(function (e) {
        e.preventDefault();
        const data = new FormData(document.getElementById('form-password-create'));
        const password1 = data.get('contraseña').trim();
        const password2 = data.get('contraseña2').trim();
        const token = data.get('token').trim();

        if (password1 == '' || password2 == '') {
            Swal.fire({
                icon: 'warning',
                title: 'Hay campos sin rellenar',
                confirmButtonColor: '#fff',
                showConfirmButton: false,
                timer: 2500
            })
            return;
        }

        if (password1 != password2) {
            Swal.fire({
                icon: 'warning',
                title: 'Las contraseñas no coinciden',
                confirmButtonColor: '#fff',
                showConfirmButton: false,
                timer: 2500
            })
            return;
        }



        const parametros = {
            token: token,
            password: password1,
        }

        $.post('metodos/actualizarPassword.php', parametros, function (respuesta) {

            if (respuesta == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error al actualizar la contraseña',
                    confirmButtonColor: '#fff',
                    showConfirmButton: false,
                    timer: 2500
                })
            }

            if (respuesta == 1) {
                Swal.fire({
                    icon: 'success',
                    title: 'Contraseña guardada',
                    confirmButtonColor: '#fff',
                    showConfirmButton: false,
                    timer: 2500
                })

                setTimeout(function () {

                    window.location.href = "../portal/index.php";
                }, 3000);
            }

            if (respuesta == 2) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No se pudo actualizar la nueva contraseña',
                    confirmButtonColor: '#fff',
                    showConfirmButton: false,
                    timer: 2500
                })
            }
        })





    });


    $("#form-login").submit(function (e) {
        e.preventDefault();
        const data = new FormData(document.getElementById('form-login'));
        const expediente = data.get('expediente').trim();
        const password = data.get('password').trim();

        if (expediente == '' || password == '') {
            Swal.fire({
                icon: 'warning',
                title: 'Faltan campos por rellenar',
                showConfirmButton: false,
                timer: 2500
            })

            return;
        }


        const parametros = {
            expediente: expediente,
            password: password,
        }

        $.post('metodos/validaUsuarioLogin.php', parametros, function (respuesta) {

            if (respuesta == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Ocurrió un error, inténtalo mas tarde',
                    showConfirmButton: false,
                    timer: 2500
                })
            }
            if (respuesta == 1) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Usuario no registrado',
                    showConfirmButton: false,
                    timer: 2500
                })
            }
            if (respuesta == 2) {

                window.location.href = "../portal/index";
            }
            if (respuesta == 3) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Contraseña incorrecta',
                    showConfirmButton: false,
                    timer: 2500
                })
            }

        });


    })
})

