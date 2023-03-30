<?php
include '../../../includes/config/database.php';
$db = conectarDB();
$token = $_POST['token'];

$datosUsuario =  mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM usuarios WHERE token = '$token'"));
$idUsuario = $datosUsuario['id'];

$empresas = mysqli_query($db, "SELECT * FROM empresas WHERE usuarios_id='$idUsuario'");
header('Content-Type: application/json');

$empresasArray = array();

while ($row = mysqli_fetch_array($empresas)) {
    $token = $row['token'];
    $nombre = $row['nombre'];
    $logo = $row['logo'];
    $empresasArray[] = array('token' => $token, 'nombre' => $nombre, 'logo' => $logo);
}

echo json_encode($empresasArray);
