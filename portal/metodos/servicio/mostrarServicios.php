<?php
include '../../../includes/config/database.php';
$db = conectarDB();
$token = $_POST['token'];

$datosUsuario =  mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM usuarios WHERE token = '$token'"));
$idUsuario = $datosUsuario['id'];

$servicios = mysqli_query($db, "SELECT * FROM servicios WHERE usuarios_id='$idUsuario'");
header('Content-Type: application/json');

$serviciosArray = array();

while ($row = mysqli_fetch_array($servicios)) {
    $token = $row['token'];
    $nombre = $row['nombre'];
    $imagen = $row['imagen'];
    $precio = $row['precio'];
    $serviciosArray[] = array('token' => $token, 'nombre' => $nombre, 'imagen' => $imagen, 'precio' => $precio);
}

echo json_encode($serviciosArray);
