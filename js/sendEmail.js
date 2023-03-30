$(document).ready(function () {

    $('#form-ayuda').trigger("reset");
    $("#form-ayuda").submit(async function (e) {
        e.preventDefault();
        const data = new FormData(document.getElementById('form-ayuda'));
        const nombre = data.get('nombre').trim();
        const correo = data.get('correo');
        const mensaje = data.get('mensaje').trim();

        const datos = {
            nombre: nombre,
            correo: correo,
            mensaje: mensaje
        };

        $.post('portal/includes/enviarEmail.php', datos, function (respuesta) {


            Swal.fire({
                icon: 'success',
                title: 'Mensaje enviado, pronto recibirás una respuesta.',
                confirmButtonColor: '#fff',
                showConfirmButton: false,
                timer: 4000
            })



            $('#form-ayuda').trigger("reset");


        });

    })
})


