<?php
include '../../../includes/config/database.php';
$db = conectarDB();

$nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
$apellidos = htmlspecialchars($_POST['apellido'], ENT_QUOTES, 'UTF-8');
$direccion = htmlspecialchars($_POST['direccion'], ENT_QUOTES, 'UTF-8');
$token = htmlspecialchars($_POST['token'], ENT_QUOTES, 'UTF-8');

$status = 0;

$existeToken =  mysqli_num_rows(mysqli_query($db, "SELECT * FROM usuarios WHERE token = '$token'"));

if ($existeToken != 0) {
    // $datosUsuario =  mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM usuarios WHERE token = '$token'"));
    // $compararToken = md5($datosUsuario['correo'] . $datosUsuario['cve_persona']);
    // if ($compararToken == $token) {
    $query = "UPDATE usuarios SET nombre ='$nombre',apellidos='$apellidos',direccion='$direccion' WHERE token='$token'";
    $resultado = mysqli_query($db, $query);
    $status = 1;
    // } else {
    //     $status = 2;
    // }
}

echo $status;
