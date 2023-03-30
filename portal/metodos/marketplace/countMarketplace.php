<?php
include '../../../includes/config/database.php';
$db = conectarDB();
$token = $_POST['tokenUsu'];

$datosUsuario =  mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM usuarios WHERE token = '$token'"));
$idUsuario = $datosUsuario['id'];


$query = "SELECT count(*) as total FROM marketplace WHERE usuarios_id='$idUsuario'";
$total =  mysqli_fetch_assoc(mysqli_query($db, $query));
echo $total['total'];
