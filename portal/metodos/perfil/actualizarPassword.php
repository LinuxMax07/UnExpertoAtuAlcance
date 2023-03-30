<?php
include '../../../includes/config/database.php';
$db = conectarDB();

$passActual = $_POST['passActual'];
$passNuevo = $_POST['passNuevo'];
$token = $_POST['token'];
$status = 0;


$existeToken =  mysqli_num_rows(mysqli_query($db, "SELECT * FROM usuarios WHERE token = '$token'"));

if ($existeToken != 0) {

    $query = "SELECT * FROM usuarios WHERE  token= '$token'";
    $resultado = mysqli_query($db, $query);

    // Verificar password actual
    $usuario = mysqli_fetch_assoc($resultado);
    $auth = password_verify($passActual, $usuario['password']);

    if ($auth) {
        $passwordHash = password_hash($passNuevo, PASSWORD_DEFAULT);

        $query = "UPDATE usuarios SET password ='$passwordHash' WHERE token='$token'";
        $resultado = mysqli_query($db, $query);

        $status = 1;
    } else {
        $status = 2;
    }
}

echo $status;
