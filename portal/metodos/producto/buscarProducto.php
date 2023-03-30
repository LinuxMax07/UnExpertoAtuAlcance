<?php
include '../../../includes/config/database.php';
$db = conectarDB();

$tokenProducto = $_POST['tokenProducto'];

$producto =  mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM productos WHERE token = '$tokenProducto'"));

echo  json_encode($producto);
