<?php
include '../../../includes/config/database.php';
$db = conectarDB();
$token = $_POST['tokenServicio'];

$status = 0;
$existeTokenProducto =  mysqli_num_rows(mysqli_query($db, "SELECT * FROM servicios WHERE token = '$token'"));

if ($existeTokenProducto != 0) {

    // Eliminar logo en la carpeta upload
    $imagenEliminar =  mysqli_fetch_assoc(mysqli_query($db, "SELECT imagen FROM servicios WHERE token='$token'"));

    if ($imagenEliminar['imagen'] != '') {
        unlink('../../uploads/servicios/' . $imagenEliminar['imagen']);
    }


    $query = "DELETE FROM servicios WHERE token = '$token'";
    $resultado = mysqli_query($db, $query);
    $status = 1;
}

echo $status;
