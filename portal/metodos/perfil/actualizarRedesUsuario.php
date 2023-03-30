<?php
include '../../../includes/config/database.php';
$db = conectarDB();

$facebook = filter_var($_POST['facebook'], FILTER_SANITIZE_URL);
$instagram = filter_var($_POST['instagram'], FILTER_SANITIZE_URL);
$correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
$whatsApp = filter_var($_POST['whatsApp'], FILTER_SANITIZE_NUMBER_INT);
$telefono = filter_var($_POST['telefono'], FILTER_SANITIZE_NUMBER_INT);
$pagina = filter_var($_POST['pagina'], FILTER_SANITIZE_URL);
$token = $_POST['token'];

$status = 0;

$existeToken =  mysqli_num_rows(mysqli_query($db, "SELECT * FROM usuarios WHERE token = '$token'"));

if ($existeToken != 0) {
    // $datosUsuario =  mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM usuarios WHERE token = '$token'"));
    // $compararToken = md5($datosUsuario['correo'] . $datosUsuario['cve_persona']);

    // if ($compararToken == $token) {
    $query = "UPDATE usuarios SET facebook ='$facebook',instagram='$instagram',correo='$correo',whatsApp='$whatsApp',telefono='$telefono',paginaWeb='$pagina' WHERE token='$token'";
    $resultado = mysqli_query($db, $query);
    $status = 1;
    // } else {
    //     $status = 2;
    // }
}

echo $status;
