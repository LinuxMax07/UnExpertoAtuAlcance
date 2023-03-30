<?php
include '../../../includes/config/database.php';
$db = conectarDB();
$token = $_POST['tokenEmpresa'];

$status = 0;
$existeTokenEmpresa =  mysqli_num_rows(mysqli_query($db, "SELECT * FROM empresas WHERE token = '$token'"));

if ($existeTokenEmpresa != 0) {

    // Eliminar logo en la carpeta upload
    $logoEliminar =  mysqli_fetch_assoc(mysqli_query($db, "SELECT logo FROM empresas WHERE token='$token'"));

    if ($logoEliminar['logo'] != '') {
        unlink('../../uploads/logos/' . $logoEliminar['logo']);
    }


    $query = "DELETE FROM empresas WHERE token = '$token'";
    $resultado = mysqli_query($db, $query);
    $status = 1;
}

echo $status;
