<?php
include '../../includes/config/database.php';
$db = conectarDB();

$expediente = $_POST['expediente'];
$password = $_POST['password'];

$status = 0;


// Verificar si existe un registro con ese expediente
$resultadoBus =  mysqli_num_rows(mysqli_query($db, "SELECT * FROM usuarios WHERE matricula = '$expediente'"));

if ($resultadoBus != 0) {
    // validar password
    $datosUsuario =  mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM usuarios WHERE matricula = '$expediente'"));

    $idUsu = $datosUsuario['id'];
    $token = $datosUsuario['token'];
    $usuNombre = $datosUsuario['nombre'];

    $auth = password_verify($password, $datosUsuario['password']);

    if ($auth) {
        session_start();
        $_SESSION['id'] = $idUsu;
        $_SESSION['token'] = $token;
        $_SESSION['usuario'] = $usuNombre;
        $_SESSION['login'] = true;
        $_SESSION['setPassword'] = true;
        $status = 2;
    } else {
        $status = 3;
    }
} else {

    $status = 1;
}

echo $status;
