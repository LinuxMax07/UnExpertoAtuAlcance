$(document).ready(function () {


    $("#act-foto-perfil").hide();
    $("#progreso-foto-perfil").hide();
    $(".overlay-perfil").click(function (e) {
        e.preventDefault();
        $("#perfil").trigger('click');
    });


    // DROP IMAGEN PERFIL
    var $fileInput = $('.file-input');
    var $droparea = $('.file-drop-area');

    $fileInput.on('dragenter focus click', function () {
        $droparea.addClass('is-active');
    });

    $fileInput.on('dragleave blur drop', function () {
        $droparea.removeClass('is-active');
    });

    $fileInput.on('change', function () {
        var filesCount = $(this)[0].files.length;
        var $textContainer = $(this).prev();

        if (filesCount === 1) {
            var fileName = $(this).val().split('\\').pop();
            $textContainer.text(fileName);
        } else {

        }
    });


    const inpFile = document.querySelector('#perfil');
    const preview = document.querySelector('.img-preview');

    inpFile.addEventListener('change', function () {
        const file = this.files[0];
        var filesCount = inpFile.files.length;
        const fileType = this.files[0].type;
        var fileSize = this.files[0].size;
        var siezekiloByte = parseInt(fileSize / 1024);


        const image = new Image(250, 250);
        if (filesCount === 1) {
            if (fileType == 'image/jpeg' || fileType == 'image/png') {
                if (siezekiloByte <= 5000) {
                    const reader = new FileReader;
                    reader.onload = () => {
                        const result = reader.result;
                        image.src = result;
                        image.className = 'img-thumbnail2';
                        preview.innerHTML = '';
                        preview.append(image);
                    }
                    reader.readAsDataURL(file);

                    activarSubirPerfil();

                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'La imagen supera los 5MB permitidos.',
                        confirmButtonColor: '#fff',
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Formato no permitido (Solo imágenes).',
                    confirmButtonColor: '#fff',
                    showConfirmButton: false,
                    timer: 2000
                })
            }


            return;
        }

        Swal.fire({
            icon: 'warning',
            title: 'Debes añadir solo un archivo.',
            confirmButtonColor: '#fff',
            showConfirmButton: false,
            timer: 2000
        })

    })



    mostrarDatosPerfil(token);

    $("#form-perfil-datos").submit(function (e) {
        e.preventDefault();
        const data = new FormData(document.getElementById('form-perfil-datos'));

        const nombre = data.get('nombre').trim();
        const apellido = data.get('apellido').trim();
        const direccion = data.get('direccion').trim();
        const token = data.get('token').trim();
        // const condiciones = data.get('condiciones');

        if (nombre == '') {
            Swal.fire({
                icon: 'warning',
                title: 'El campo de nombre no puede quedar vació',
                confirmButtonColor: '#fff',
                showConfirmButton: false,
                timer: 2500
            })
            return;
        }

        if (apellido == '') {
            Swal.fire({
                icon: 'warning',
                title: 'El campo de apellido no puede quedar vació',
                confirmButtonColor: '#fff',
                showConfirmButton: false,
                timer: 2500
            })
            return;
        }


        // Validar cadena sin caracteres 

        valNombre = validarCadena(nombre);
        valApellido = validarCadena(apellido);
        valDireccion = validarCadena(direccion);

        // console.log(valNombre);

        if (!valNombre || !valApellido || !valDireccion) {
            Swal.fire({
                icon: 'warning',
                title: 'No se permiten caracteres especiales.',
                confirmButtonColor: '#fff',
                showConfirmButton: false,
                timer: 2500
            })
            return;
        }

        const parametros = {
            nombre: nombre,
            apellido: apellido,
            direccion: direccion,
            token: token
        };

        $.post('metodos/perfil/actualizarDatosUsuario.php', parametros, function (respuesta) {

            if (respuesta == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Hubo un error al actualizar',
                    confirmButtonColor: '#fff',
                    showConfirmButton: false,
                    timer: 2000
                })

            }
            if (respuesta == 1) {
                Swal.fire({
                    icon: 'success',
                    title: 'Datos actualizados correctamente',
                    confirmButtonColor: '#fff',
                    showConfirmButton: false,
                    timer: 2000
                })

                // mostrarDatosPerfil();

            }
            if (respuesta == 2) {
                Swal.fire({
                    icon: 'error',
                    title: 'Hubo un error al actualizar',
                    confirmButtonColor: '#fff',
                    showConfirmButton: false,
                    timer: 2000
                })

            }
        })

    })





    $("#form-perfil-redes").submit(function (e) {
        e.preventDefault();
        const data = new FormData(document.getElementById('form-perfil-redes'));

        const facebook = data.get('facebook').trim();
        const instagram = data.get('instagram').trim();
        const correo = data.get('correo').trim();
        const whatsApp = data.get('whatsApp').trim();
        const telefono = data.get('telefono').trim();
        const pagina = data.get('pagina').trim();
        const token = data.get('token').trim();

        const parametros = {
            facebook: facebook,
            instagram: instagram,
            correo: correo,
            whatsApp: whatsApp,
            telefono: telefono,
            pagina: pagina,
            token: token
        };



        $.post('metodos/perfil/actualizarRedesUsuario.php', parametros, function (respuesta) {

            if (respuesta == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Hubo un error al actualizar',
                    confirmButtonColor: '#fff',
                    showConfirmButton: false,
                    timer: 2000
                })

            }
            if (respuesta == 1) {
                Swal.fire({
                    icon: 'success',
                    title: 'Datos actualizados correctamente',
                    confirmButtonColor: '#fff',
                    showConfirmButton: false,
                    timer: 2000,

                })

                // mostrarDatosPerfil();

            }
            if (respuesta == 2) {
                Swal.fire({
                    icon: 'error',
                    title: 'Hubo un error al actualizar',
                    confirmButtonColor: '#fff',
                    showConfirmButton: false,
                    timer: 2000
                })

            }
        })



    })



})

function mostrarDatosPerfil(token) {
    const parametros = {
        token: token,
    }

    $.post('metodos/perfil/datosUsuario.php', parametros, function (respuesta) {
        const usuario = JSON.parse(respuesta);

        $("#nombre").val(usuario['nombre']);
        $("#apellido").val(usuario['apellidos']);
        $("#direccion").val(usuario['direccion']);

        $("#facebook").val(usuario['facebook']);
        $("#instagram").val(usuario['instagram']);
        $("#correo").val(usuario['correo']);
        $("#pagina").val(usuario['paginaWeb']);
        $("#whatsApp").val(usuario['whatsApp']);
        $("#telefono").val(usuario['telefono']);

    });

}

$("#form-perfil-pass").submit(function (e) {
    e.preventDefault();
    const data = new FormData(document.getElementById('form-perfil-pass'));

    const passActual = data.get('actual').trim();
    const passNuevo = data.get('nueva').trim();
    const passNuevo2 = data.get('nueva2').trim();
    const token = data.get('token').trim();


    if (passActual == '') {
        Swal.fire({
            icon: 'warning',
            title: 'Falta agregar la contraseña Actual',
            confirmButtonColor: '#fff',
            showConfirmButton: false,
            timer: 2000
        })
        return;
    }
    if (passNuevo == '') {
        Swal.fire({
            icon: 'warning',
            title: 'Falta agregar la nueva contraseña',
            confirmButtonColor: '#fff',
            showConfirmButton: false,
            timer: 2000
        })

        return;
    }

    if (passNuevo != passNuevo2) {
        Swal.fire({
            icon: 'warning',
            title: 'Las contraseñas no coinciden. Verifica',
            confirmButtonColor: '#fff',
            showConfirmButton: false,
            timer: 2000
        })
        return;
    }

    const parametros = {
        passActual: passActual,
        passNuevo: passNuevo,
        token: token
    }

    $.post('metodos/perfil/actualizarPassword.php', parametros, function (respuesta) {

        if (respuesta == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Error al actualizar',
                confirmButtonColor: '#fff',
                showConfirmButton: false,
                timer: 2000
            })
        }
        if (respuesta == 1) {
            Swal.fire({
                icon: 'success',
                title: 'Contraseña actualizada',
                confirmButtonColor: '#fff',
                showConfirmButton: false,
                timer: 2000
            })

            $('#acceso_pass_actual').val('');
            $('#acceso_contraseña').val('');
            $('#acceso_contraseña2').val('');
        }
        if (respuesta == 2) {
            Swal.fire({
                icon: 'warning',
                title: 'La contraseñas actual es incorrecta',
                confirmButtonColor: '#fff',
                showConfirmButton: false,
                timer: 2000
            })
        }
    })



})

// FUNCIONES

function activarSubirPerfil() {
    $("#act-foto-perfil").show();
    activarSubir()
}
function desactivarSubirPerfil() {
    $("#act-foto-perfil").hide();
}

function activarSubir() {
    var porcentaje = document.getElementById('progress-perfil');
    $('#act-foto-perfil').click(async function () {
        $("#act-foto-perfil").hide();
        $("#progreso-foto-perfil").show();
        var formData = new FormData(document.getElementById('form-foto-perfil'));


        var xhr = new XMLHttpRequest();
        xhr.open("POST", "metodos/perfil/actualizarFotoPerfil.php", true);
        xhr.upload.addEventListener("progress", function (event) {
            if (event.lengthComputable) {
                var percentComplete = (event.loaded / event.total) * 100;
                // console.log(percentComplete + "% subido");
                porcentaje.style.width = `${percentComplete}%`;
                porcentaje.textContent = `${Math.trunc(percentComplete)}% subiendo archivo`;

                if (percentComplete == 100) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Imagen Actualizada Correctamente',
                        confirmButtonColor: '#fff',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    $("#progreso-foto-perfil").hide();
                }
            }
        }, false);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {

            }
        };

        xhr.send(formData);

    })
}

// aceptan letras mayúsculas y minúsculas, la letra ñ, comas, puntos, acentos, espacios en blanco y dígitos
function validarCadena(cadena) {
    if (cadena.trim() === "") {
        return true;
    }
    return /^[a-zA-ZñÑáéíóúÁÉÍÓÚ,\.\s\d#!?\-$]+$/.test(cadena);

}