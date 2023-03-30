<?php
include '../../../includes/config/database.php';
$db = conectarDB();
$token = $_POST['tokenProducto'];

$status = 0;
$existeTokenProducto =  mysqli_num_rows(mysqli_query($db, "SELECT * FROM productos WHERE token = '$token'"));

if ($existeTokenProducto != 0) {

    // Eliminar logo en la carpeta upload
    $imagenEliminar =  mysqli_fetch_assoc(mysqli_query($db, "SELECT imagen FROM productos WHERE token='$token'"));

    if ($imagenEliminar['imagen'] != '') {
        unlink('../../uploads/productos/' . $imagenEliminar['imagen']);
    }


    $query = "DELETE FROM productos WHERE token = '$token'";
    $resultado = mysqli_query($db, $query);
    $status = 1;
}

echo $status;
