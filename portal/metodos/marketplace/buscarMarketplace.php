<?php
include '../../../includes/config/database.php';
$db = conectarDB();

$tokenMarketplace = $_POST['tokenMarketplace'];

$tokenMarketplace =  mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM marketplace WHERE token = '$tokenMarketplace'"));

echo  json_encode($tokenMarketplace);
