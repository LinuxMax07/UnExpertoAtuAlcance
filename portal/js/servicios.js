$(document).ready(function () {
    // console.log('Este el token:', token
    // );

    mostrarServicios(token);
    // boton registrar
    $('#btn-hidden-registrando').hide();


    // Reset formulario crear
    $('#form-crear-servicio').trigger("reset");

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

    const inpFile = document.querySelector('#imagen_servicio');
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


                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'La imagen supera los 3MB permitidos.',
                        confirmButtonColor: '#fff',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    $('#imagen_servicio').val('');
                }
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Formato no permitido (Solo imágenes).',
                    confirmButtonColor: '#fff',
                    showConfirmButton: false,
                    timer: 2000
                })
                $('#imagen_servicio').val('');
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
        $('#imagen_servicio').val('');

    })


    $("#form-crear-servicio").submit(async function (e) {

        e.preventDefault();
        const data = new FormData(document.getElementById('form-crear-servicio'));

        const nombre = data.get('nombre').trim();
        const categoria = data.get('categoria');
        const precio = data.get('precio').trim();
        const vendedor = data.get('vendedor');
        const descripcion = data.get('descripcion').trim();
        const imagenServicio = data.get('imagenServicio');
        const token = data.get('token').trim();
        const tokenServicio = data.get('tokenServicio').trim();

        if (nombre == '' || precio == '' || descripcion == '') {
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

        if (vendedor == null) {
            Swal.fire({
                icon: 'warning',
                title: 'Debes seleccionar un vendedor.',
                confirmButtonColor: '#fff',
                showConfirmButton: false,
                timer: 2000
            })
            return;
        }

        if (tokenServicio == '') {
            let total = await countServicios(token);

            if (total >= 5) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Alcanzaste el limite de servicios',
                    confirmButtonColor: '#fff',
                    showConfirmButton: false,
                    timer: 2000
                })
                return;
            }
        }

        // Validar texto
        let valNombre = validarCadena(nombre);
        let valPrecio = validarCadena(precio);
        let valDescripcion = validarCadena(descripcion);

        if (!valNombre || !valPrecio || !valDescripcion) {
            Swal.fire({
                icon: 'warning',
                title: 'No se permiten caracteres especiales.',
                confirmButtonColor: '#fff',
                showConfirmButton: false,
                timer: 2500
            })
            return;
        }


        registrarProducto(data);

    })

    $("#btn-registrar-producto").click(async function () {

        $("#token-servicio").val('');
        $('#form-crear-servicio').trigger("reset");
        $('.titulo-modal-servicio').text('Registro de Servicio');
        $('.btn-modal-servicio').text('Publicar servicio');
        resetInputImagen()
    });


})

// aceptan letras mayúsculas y minúsculas, la letra ñ, comas, puntos, acentos, espacios en blanco y dígitos
function validarCadena(cadena) {

    return /^[a-zA-ZñÑáéíóúÁÉÍÓÚ,\.\s\d#!?\-$:"()]+$/.test(cadena);
}

function mostrarServicios(token) {

    const datos = {
        token: token,
    }

    $.post('metodos/servicio/mostrarServicios.php', datos, function (respuesta) {


        let mostrarPap = "";
        respuesta.forEach(servicio => {

            let imagen = '';
            if (servicio.imagen == '') {
                imagen = 'default_poduct.png'
            } else {
                imagen = servicio.imagen;
            }

            mostrarPap = mostrarPap + `
            <div class="card-articulo  headline ">
            <div class="single_course">
                <div class="course_head">
                    <img class="img-fluid" src="uploads/servicios/${imagen}" alt="" />
                </div>
                <div class="course_content">
                    <span class="price">$${servicio.precio}</span>
                    <span class="tag d-inline-block">Contactar</span>
                    <h4 class="mb-3 mt-3">
                        <a href="#">${servicio.nombre}</a>
                    </h4>
                </div>
            </div>
            <div class="d-flex gap-3 mt-4">
                <button type="button" onclick="editSer('${servicio.token}')" class="btn btn-success">Editar</button>
                <button type="button" onclick="deleteSer('${servicio.token}','${token}')" class="btn btn-danger">Borrar</button>
            </div>
        </div>
            `;
        })



        if (respuesta.length == 0) {
            $('#list-empresas').html(`<h3>No tienes servicios publicados</h3>`);
            $('.contador-productos').html('');

        } else {

            $('#list-empresas').html(mostrarPap);
            $('.contador-servicios').html(`<p class="text-center mt-3">${respuesta.length}/5</p>`);

        }


    })

}

function deleteSer(tokenServicio, token) {

    Swal.fire({
        title: '¿Estas seguro de eliminar este servicio?',
        text: "El servicio se eliminara permanentemente",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, borrar ahora'
    }).then((result) => {
        if (result.isConfirmed) {
            const data = {
                tokenServicio: tokenServicio
            };


            $.post('metodos/servicio/eliminarServicio.php', data, function (respuesta) {

                if (respuesta == 1) {
                    mostrarServicios(token);
                    Swal.fire({
                        icon: 'success',
                        title: 'Servicio eliminado',
                        confirmButtonColor: '#fff',
                        showConfirmButton: false,
                        timer: 2000
                    })

                }
                if (respuesta == 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al eliminar el servicio',
                        confirmButtonColor: '#fff',
                        showConfirmButton: false,
                        timer: 2000
                    })
                }

            })

        }
    })
}

function editSer(token) {

    resetInputImagen();
    $("#staticModal-servicio").modal("show");
    $('.titulo-modal-servicio').text('Editar información del servicio');
    $('.btn-modal-servicio').text('Guardar datos');
    $("#token-servicio").val(token);

    const data = {
        tokenServicio: token
    };

    $.post('metodos/servicio/buscarServicio.php', data, function (respuesta) {
        let producto = JSON.parse(respuesta);

        $("#input-nombre").val(producto['nombre']);
        $("#select-categoria").val(producto['categoria']);
        $("#select-vendedor").val(producto['vendedor']);
        $("#input-precio").val(producto['precio']);
        $("#textarea-descripcion").val(producto['descripcion']);
        $('.img-preview').html(`<img src="uploads/servicios/${producto['imagen']}" width="250" height="250">`);

    })
}

function resetInputImagen() {
    $('.img-preview').html('');
    $('.file-msg').html('o arrastre y suelte el archivo');
    $('#imagen_servicio').val('');
}

function registrarProducto(data) {
    $('#btn-hidden-registrando').show();
    $('.btns-registrar-cancelar').hide();

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "metodos/servicio/crearServicio.php", true);
    xhr.upload.addEventListener("progress", function (event) {
        if (event.lengthComputable) {

        }
    }, false);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            console.log(xhr.responseText);

            if (xhr.responseText == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error al publicar el servicio',
                    confirmButtonColor: '#fff',
                    showConfirmButton: false,
                    timer: 2000
                })
            }
            if (xhr.responseText == 1) {
                $('#form-crear-servicio').trigger("reset");
                $('#staticModal-servicio').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Producto publicado correctamente',
                    confirmButtonColor: '#fff',
                    showConfirmButton: false,
                    timer: 2000
                })

                mostrarServicios(token);
            }

            if (xhr.responseText == 2) {

                Swal.fire({
                    icon: 'success',
                    title: 'Datos actualizados',
                    confirmButtonColor: '#fff',
                    showConfirmButton: false,
                    timer: 2000
                })
                $('#staticModal-servicio').modal('hide');
                mostrarServicios(token);
            }
            $('#btn-hidden-registrando').hide();
            $('.btns-registrar-cancelar').show();
        }
    };
    xhr.send(data);
}

function countServicios(token) {
    return new Promise((resolve, reject) => {
        const datos = {
            tokenUsu: token,
        }
        $.post('metodos/servicio/countServicios.php', datos, function (respuesta) {
            resolve(respuesta);
        })
    });
}
