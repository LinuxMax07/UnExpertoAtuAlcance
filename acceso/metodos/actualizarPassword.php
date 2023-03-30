<?php
include '../../includes/config/database.php';
$db = conectarDB();

$token = $_POST['token'];
$password = $_POST['password'];
$status = 0;

$existeToken =  mysqli_num_rows(mysqli_query($db, "SELECT * FROM usuarios WHERE token = '$token'"));

if ($existeToken != 0) {
    $datosUsuario =  mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM usuarios WHERE token = '$token'"));
    // echo $datosUsuario['token'];
    $compararToken = md5($datosUsuario['correo'] . $datosUsuario['cve_persona']);
    if ($compararToken == $token) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE usuarios SET password ='$passwordHash' WHERE token='$token'";
        $resultado = mysqli_query($db, $query);
        session_start();
        $_SESSION['setPassword'] = true;
        $status = 1;
    } else {
        $status = 2;
    }
}

echo $status;
