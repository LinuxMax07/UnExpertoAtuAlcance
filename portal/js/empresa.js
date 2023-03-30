$(document).ready(function () {
    // console.log('Este el token:', token
    // );

    mostrarEmpresas(token);
    // boton registrar
    $('#btn-hidden-registrando').hide();

    // Reset formulario crear
    $('#form-empresa-crear').trigger("reset");

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

    const inpFile = document.querySelector('#logoEmpresa');
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
                if (siezekiloByte <= 3000) {
                    const reader = new FileReader;
                    reader.onload = () => {
                        const result = reader.result;
                        image.src = result;
                        image.className = 'img-thumbnail2';
                        preview.innerHTML = '';
                        preview.append(image);
                    }
                    reader.readAsDataURL(file);

                    // activarSubirPerfil();

                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'La imagen supera los 3MB permitidos.',
                        confirmButtonColor: '#fff',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    $('#logoEmpresa').val('');

                }
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Formato no permitido (Solo imágenes).',
                    confirmButtonColor: '#fff',
                    showConfirmButton: false,
                    timer: 2000
                })
                $('#logoEmpresa').val('');

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
        $('#logoEmpresa').val('');

    })


    $("#form-empresa-crear").submit(async function (e) {

        e.preventDefault();

        const data = new FormData(document.getElementById('form-empresa-crear'));

        const nombre = data.get('nombre').trim();
        const categoria = data.get('categoria');
        const ubicacion = data.get('ubicacion').trim();
        const descripcion = data.get('descripcion').trim();
        const logo = data.get('logoEmpresa');
        const token = data.get('token').trim();
        const tokenEmpresa = data.get('tokenEmpresa').trim();


        // contacto
        const facebook = data.get('facebook').trim();
        const instagram = data.get('instagram').trim();
        const whatsApp = data.get('whatsApp').trim();
        const paginaWeb = data.get('paginaWeb').trim();
        const correo = data.get('correo').trim();
        const telefono = data.get('telefono').trim();



        if (nombre == '' || descripcion == '') {
            Swal.fire({
                icon: 'warning',
                title: 'Hay campos obligatorios vacíos.',
                confirmButtonColor: '#fff',
                showConfirmButton: false,
                timer: 2000
            })
            return;
        }

        if (categoria == null) {
            Swal.fire({
                icon: 'warning',
                title: 'Debes seleccionar una categoría.',
                confirmButtonColor: '#fff',
                showConfirmButton: false,
                timer: 2000
            })
            return;
        }

        if (tokenEmpresa == '') {
            let total = await countEmpresas(token);

            if (total >= 3) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Alcanzaste el limite de Empresas',
                    confirmButtonColor: '#fff',
                    showConfirmButton: false,
                    timer: 2000
                })
                return;
            }
        }

        let valNombre = validarCadena(nombre);
        let valUbicacion = validarCadena(ubicacion);

        if (!valNombre) {
            Swal.fire({
                icon: 'warning',
                title: 'No se permiten caracteres especiales en el nombre.',
                confirmButtonColor: '#fff',
                showConfirmButton: false,
                timer: 2500
            })
            return;
        }
        if (!valUbicacion) {
            Swal.fire({
                icon: 'warning',
                title: 'No se permiten caracteres especiales en la ubicación',
                confirmButtonColor: '#fff',
                showConfirmButton: false,
                timer: 2500
            })
            return;
        }

        registrarEmpresa(data);

    })


    $("#btn-registrar-empresa").click(async function () {

        $("#token-empresa").val('');
        $('#form-empresa-crear').trigger("reset");
        $('.titulo-modal-empresa').text('Registro de Empresa');
        $('.btn-modal-empresa').text('Registrar Empresa');
        resetInputLogo()


    });


})

function validarCadena(cadena) {
    if (cadena.trim() === "") {
        return true;
    }
    return /^[a-zA-ZñÑáéíóúÁÉÍÓÚ,\.\s\d#!?\-$]+$/.test(cadena);
}


function mostrarEmpresas(token) {

    const datos = {
        token: token,
    }

    $.post('metodos/empresa/mostrarEmpresas.php', datos, function (respuesta) {

        let mostrarPap = "";

        respuesta.forEach(empresa => {
            let logo = '';

            if (empresa.logo == '') {
                logo = 'logo_default.png'
            } else {
                logo = empresa.logo;
            }
            mostrarPap = mostrarPap + `
            <div class="card-empresa">
            <div class="card-empresa-foto">
                <img src="uploads/logos/${logo}" alt="Foto de Perfil">
            </div>
            <h1 class="text-center mt-3">${empresa.nombre}</h1>

            <div class="d-flex gap-3 mt-4">
                <button type="button" onclick="editEm('${empresa.token}')" class="btn btn-success">Editar</button>
                <button type="button" onclick="deleteEm('${empresa.token}','${token}')" class="btn btn-danger">Borrar</button>
            </div>
            </div>
            `;
        })



        if (respuesta.length == 0) {
            $('#list-empresas').html(`<h3>No tienes empresas registradas</h3>`);
            $('.contador-empresas').html('');

        } else {

            $('#list-empresas').html(mostrarPap);
            $('.contador-empresas').html(`<p class="text-center mt-3">${respuesta.length}/3</p>`);

        }


    })

}
function deleteEm(tokenEmpresa, token) {

    Swal.fire({
        title: '¿Estas seguro de eliminar esta empresa?',
        text: "Los artículos publicados por esta empresa también se eliminaran ",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, borrar ahora',
        cancelButtonText: 'Cancelar',
    }).then((result) => {
        if (result.isConfirmed) {
            const data = {
                tokenEmpresa: tokenEmpresa
            };


            $.post('metodos/empresa/eliminarEmpresa.php', data, function (respuesta) {

                if (respuesta == 1) {
                    mostrarEmpresas(token);
                    Swal.fire({
                        icon: 'success',
                        title: 'Empresa eliminada',
                        confirmButtonColor: '#fff',
                        showConfirmButton: false,
                        timer: 2000
                    })

                }
                if (respuesta == 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al eliminar la empresa',
                        confirmButtonColor: '#fff',
                        showConfirmButton: false,
                        timer: 2000
                    })
                }

            })

        }
    })


}


function editEm(token) {
    resetInputLogo();
    $("#staticModal-empresa").modal("show");
    $('.titulo-modal-empresa').text('Editar Empresa');
    $('.btn-modal-empresa').text('Guardar datos');
    $("#token-empresa").val(token);

    const data = {
        tokenEmpresa: token
    };

    $.post('metodos/empresa/buscarEmpresa.php', data, function (respuesta) {
        let empresa = JSON.parse(respuesta);

        $("#input-nombre").val(empresa['nombre']);
        $("#input-ubicacion").val(empresa['ubicacion']);
        $("#textarea-descripcion").val(empresa['descripcion']);
        $("#select-categoria").val(empresa['categoria']);

        $("#input-facebook").val(empresa['facebook']);
        $("#input-instagram").val(empresa['instagram']);
        $("#input-whatsApp").val(empresa['whatsApp']);
        $("#input-web").val(empresa['paginaWeb']);
        $("#input-correo").val(empresa['correo']);
        $("#input-telefono").val(empresa['telefono']);

        $('.img-preview').html(`<img src="uploads/logos/${empresa['logo']}" width="250" height="250">`);

    })

}

function resetInputLogo() {

    $('.img-preview').html('');
    $('.file-msg').html('o arrastre y suelte el archivo');
    $('#logoEmpresa').val('');
}


function registrarEmpresa(data) {

    $('#btn-hidden-registrando').show();
    $('.btns-registrar-cancelar').hide();

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "metodos/empresa/crearEmpresa.php", true);
    xhr.upload.addEventListener("progress", function (event) {
        if (event.lengthComputable) {

        }
    }, false);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {

            if (xhr.responseText == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error al registrar la empresa',
                    confirmButtonColor: '#fff',
                    showConfirmButton: false,
                    timer: 2000
                })
            }
            if (xhr.responseText == 1) {
                $('#form-empresa-crear').trigger("reset");
                $('#staticModal-empresa').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Empresa registrada correctamente',
                    confirmButtonColor: '#fff',
                    showConfirmButton: false,
                    timer: 2000
                })

                mostrarEmpresas(token);
            }

            if (xhr.responseText == 2) {

                Swal.fire({
                    icon: 'success',
                    title: 'Datos actualizados',
                    confirmButtonColor: '#fff',
                    showConfirmButton: false,
                    timer: 2000
                })
                $('#staticModal-empresa').modal('hide');
                mostrarEmpresas(token);
            }


            $('#btn-hidden-registrando').hide();
            $('.btns-registrar-cancelar').show();
        }
    };
    xhr.send(data);
}

function countEmpresas(token) {
    return new Promise((resolve, reject) => {
        const datos = {
            tokenUsu: token,
        }
        $.post('metodos/empresa/countEmpresas.php', datos, function (respuesta) {
            resolve(respuesta);
        })
    });
}
