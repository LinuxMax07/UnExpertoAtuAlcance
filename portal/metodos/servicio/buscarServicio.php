<?php
include '../../../includes/config/database.php';
$db = conectarDB();

$tokenServicio = $_POST['tokenServicio'];

$producto =  mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM servicios WHERE token = '$tokenServicio'"));

echo  json_encode($producto);
