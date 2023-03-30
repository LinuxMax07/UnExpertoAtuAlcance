<?php
include '../../../includes/config/database.php';
$db = conectarDB();
$token = $_POST['token'];
$status = 0;

$existeToken =  mysqli_num_rows(mysqli_query($db, "SELECT * FROM usuarios WHERE token = '$token'"));

if ($existeToken != 0) {
    $datosUsuario =  mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM usuarios WHERE token = '$token'"));
    echo  json_encode($datosUsuario);
    return;
}

echo $status;
