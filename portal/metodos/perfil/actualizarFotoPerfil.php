<?php
include '../../../includes/config/database.php';
$db = conectarDB();
$imagen = $_FILES['perfil'];
$token = $_POST['token'];


$existeToken =  mysqli_num_rows(mysqli_query($db, "SELECT * FROM usuarios WHERE token = '$token'"));

if ($existeToken != 0) {
    // Buscar la imagen anterior y borrarla
    $datosUsuario =  mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM usuarios WHERE token = '$token'"));
    if ($datosUsuario['foto'] != 'predeterminada.png') {
        unlink('../../uploads/perfil/' . $datosUsuario['foto']);
    }

    // Guardar la nueva imagen en archivos

    $carpetaImagenes = '../../uploads/perfil/';
    if (!is_dir($carpetaImagenes)) {
        mkdir($carpetaImagenes);
    }
    $nombreImagen = str_replace(' ', '',  strtolower($datosUsuario['nombre'])) . '-'  . date("dmy") . '-'  . $imagen['name'];
    move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);

    // Guardar nombre de imagen en BD

    $query = "UPDATE usuarios SET foto='$nombreImagen' WHERE token='$token'";
    $resultado = mysqli_query($db, $query);
}


echo $token;
