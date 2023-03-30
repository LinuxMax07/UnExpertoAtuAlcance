<?php
include '../../../includes/config/database.php';
$db = conectarDB();
$token = $_POST['token'];

$datosUsuario =  mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM usuarios WHERE token = '$token'"));
$idUsuario = $datosUsuario['id'];

$marketplace = mysqli_query($db, "SELECT * FROM marketplace WHERE usuarios_id='$idUsuario'");
header('Content-Type: application/json');

$marketplaceArray = array();

while ($row = mysqli_fetch_array($marketplace)) {
    $token = $row['token'];
    $nombre = $row['nombre'];
    $imagen = $row['imagen'];
    $precio = $row['precio'];
    $marketplaceArray[] = array('token' => $token, 'nombre' => $nombre, 'imagen' => $imagen, 'precio' => $precio);
}

echo json_encode($marketplaceArray);
