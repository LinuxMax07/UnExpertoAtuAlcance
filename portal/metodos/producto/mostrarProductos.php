<?php
include '../../../includes/config/database.php';
$db = conectarDB();
$token = $_POST['token'];

$datosUsuario =  mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM usuarios WHERE token = '$token'"));
$idUsuario = $datosUsuario['id'];

$productos = mysqli_query($db, "SELECT * FROM productos WHERE usuarios_id='$idUsuario'");
header('Content-Type: application/json');

$productosArray = array();

while ($row = mysqli_fetch_array($productos)) {
    $token = $row['token'];
    $nombre = $row['nombre'];
    $imagen = $row['imagen'];
    $precio = $row['precio'];
    $productosArray[] = array('token' => $token, 'nombre' => $nombre, 'imagen' => $imagen, 'precio' => $precio);
}

echo json_encode($productosArray);
