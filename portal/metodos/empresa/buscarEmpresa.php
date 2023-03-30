<?php
include '../../../includes/config/database.php';
$db = conectarDB();

$tokenEmpresa = $_POST['tokenEmpresa'];

$empresa =  mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM empresas WHERE token = '$tokenEmpresa'"));

echo  json_encode($empresa);
