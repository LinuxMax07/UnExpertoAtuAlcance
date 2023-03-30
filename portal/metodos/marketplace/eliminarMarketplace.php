<?php
include '../../../includes/config/database.php';
$db = conectarDB();
$token = $_POST['tokenMarketplace'];

$status = 0;
$existeTokenMarketplace =  mysqli_num_rows(mysqli_query($db, "SELECT * FROM marketplace WHERE token = '$token'"));

if ($existeTokenMarketplace != 0) {

    // Eliminar logo en la carpeta upload
    $imagenEliminar =  mysqli_fetch_assoc(mysqli_query($db, "SELECT imagen FROM marketplace WHERE token='$token'"));

    if ($imagenEliminar['imagen'] != '') {
        unlink('../../uploads/marketplace/' . $imagenEliminar['imagen']);
    }

    $query = "DELETE FROM marketplace WHERE token = '$token'";
    $resultado = mysqli_query($db, $query);
    $status = 1;
}

echo $status;
