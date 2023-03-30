<?php
include '../../includes/config/database.php';
$db = conectarDB();
error_reporting(0);
$usuario = $_POST['usuario'];
$password = $_POST['password'];
$expediente = $_POST['expediente'];
// $usuario = 'BlasEsteban1';
// $password = 'joseBe0307.';

$status = 0;

// Comprueba que existan un usuario y un password
if ($usuario != '' || $password != '') {

    // $autentica = "https://tiweb.utsjr.edu.mx/app_loboz/jsp/valida_login.jsp?uz80we23=" . $usuario . "&pa90wo32=" . $password;
    $autentica = "http://tiweb.utsjr.edu.mx/webserviceapi/jsp/UnExpertoATuAlcanceValidaLogin.jsp?uz80we23=" . urlencode($usuario) . "&pa90wo32=" . urlencode($password);
    // https: //tiweb.utsjr.edu.mx/webserviceapi/jsp/UnExpertoATuAlcanceValidaLogin.jsp?uz80we23
    $repuestaAu = file_get_contents($autentica);
    $data = json_decode($repuestaAu);

    $headers = get_headers($autentica);
    if (strpos($headers[0], '200') !== false) {
        // // Comprueba que el usuario exista
        if ($data->folio_control != 0 || $data->folio_control != '') {

            // Busca los datos del usuario
            $usuario = "http://tiweb.utsjr.edu.mx/webserviceapi/jsp/un_experto_datos_registro.jsp?p_Expediente=" . $expediente;
            $respuestaUsu = file_get_contents($usuario);
            $datosUsuario = json_decode($respuestaUsu);
            if ($data->folio_control == $datosUsuario->cve_persona) {
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
                    $query = "INSERT INTO usuarios (nombre,apellidos,matricula,password,foto,cve_persona,correo,direccion,facebook,instagram,telefono,whatsApp,paginaWeb,fecha_registro,token) VALUES ('$usuNombre','$usuApellidos','$expediente','passNew','predeterminada.png','$usuCve','$usuCorreo','','','','','','',NOW(),'$token')";
                    $resultado = mysqli_query($db, $query);
                    $last_id = mysqli_insert_id($db);
                    session_start();
                    $_SESSION['id'] = $last_id;
                    $_SESSION['token'] = $token;
                    $_SESSION['usuario'] = $usuNombre;
                    $_SESSION['login'] = true;
                    $status = 4;
                } else {
                    // Ya existe un registro
                    $status = 5;
                }
            } else {
                $status = 3;
            }
        } else {
            $status = 2;
        }
    } else {
        $status = 0;
    }
}

echo $status;
