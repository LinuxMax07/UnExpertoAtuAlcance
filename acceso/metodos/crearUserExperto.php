<?php
include '../../includes/config/database.php';
$db = conectarDB();


$password = $_GET['pass'];
$expediente = $_GET['exp'];
$claveSeguridad = $_GET['clave'];
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$status = 'Error al crear el usuario';

if ($claveSeguridad == 'q12w23e34') {
    // Comprueba que existan un usuario y un password
    if ($password != '') {

        // Busca los datos del usuario
        $usuario = "http://tiweb.utsjr.edu.mx/webserviceapi/jsp/un_experto_datos_registro.jsp?p_Expediente=" . $expediente;
        $respuestaUsu = file_get_contents($usuario);
        $datosUsuario = json_decode($respuestaUsu);

        if ($datosUsuario->encontrado != false) {
            $usuNombre = $datosUsuario->nombre;
            $usuApellidos = $datosUsuario->apellidos;
            $usuCorreo = $datosUsuario->correo;
            $usuCve = $datosUsuario->cve_persona;

            // Consultar y validar que el usuario no este registrado
            $resultadoBus =  mysqli_num_rows(mysqli_query($db, "SELECT * FROM usuarios WHERE matricula = $expediente"));
            if ($resultadoBus == 0) {
                // Crear token
                $token = md5($usuCorreo . strval($usuCve));
                // No esta registrado
                $query = "INSERT INTO usuarios (nombre,apellidos,matricula,password,foto,cve_persona,correo,direccion,facebook,instagram,telefono,whatsApp,paginaWeb,fecha_registro,token) VALUES ('$usuNombre','$usuApellidos','$expediente','$passwordHash','predeterminada.png','$usuCve','$usuCorreo','','','','','','',NOW(),'$token')";
                $resultado = mysqli_query($db, $query);
                $status = 'Usuario creado con Éxito!';
            } else {
                // Ya existe un registro
                $status = 'Ya existe un registro con ese expediente';
            }
        } else {
            $status = 'Expediente no encontrado';
        }
    }
} else {
    echo 'La clave de seguridad es incorrecta';
}

echo $status;
