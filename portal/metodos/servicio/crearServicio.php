<?php
include '../../../includes/config/database.php';
$db = conectarDB();


$imagenServicio = $_FILES['imagenServicio'];
$nombre = $_POST['nombre'];
$categoria = $_POST['categoria'];
$precio = $_POST['precio'];
$vendedor = $_POST['vendedor'];
$descripcion = $_POST['descripcion'];
$token = $_POST['token'];
$tokenServicio = $_POST['tokenServicio'];

$status = 0;

$existeToken =  mysqli_num_rows(mysqli_query($db, "SELECT * FROM usuarios WHERE token = '$token'"));

if ($existeToken != 0) {

    // Inserta
    if ($tokenServicio == '') {
        // buscar id del usuario
        $datosUsuario =  mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM usuarios WHERE token = '$token'"));
        $idUsuario = $datosUsuario['id'];
        $newTokenServicio = uniqid(bin2hex(random_bytes(5)), true);

        // Asignar id de empresa si selecciono una empresa
        $idEmpresa = '';
        if ($_POST['vendedor'] === '0') {
            $idEmpresa = 'NULL';
        } else {
            $datosEmpresa =  mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM empresas WHERE token = '$vendedor'"));
            $idEmpresa = $datosEmpresa['id'];
        }

        // Validar si hay imagen que subir
        if ($imagenServicio['name'] == '') {
            $query = "INSERT INTO servicios (nombre,categoria,precio,descripcion,imagen,fecha_publicacion,vendedor,token,usuarios_id,empresas_id) VALUES ('$nombre','$categoria','$precio','$descripcion','',NOW(),'$vendedor','$newTokenServicio','$idUsuario',$idEmpresa)";
            $resultado = mysqli_query($db, $query);
        } else {
            // Guardar la nueva imagen en archivos
            $carpetaImagenes = '../../uploads/servicios/';
            if (!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }
            $nombreServicio = 'servicio-' . date("dmy") . '-' .  $imagenServicio['name'];
            move_uploaded_file($imagenServicio['tmp_name'], $carpetaImagenes . $nombreServicio);

            $query = "INSERT INTO servicios (nombre,categoria,precio,descripcion,imagen,fecha_publicacion,vendedor,token,usuarios_id,empresas_id) VALUES ('$nombre','$categoria','$precio','$descripcion','$nombreServicio',NOW(),'$vendedor','$newTokenServicio','$idUsuario',$idEmpresa)";
            $resultado = mysqli_query($db, $query);
        }
        $status = 1;
    } else {
        // Actualiza

        $existeTokenServicio =  mysqli_num_rows(mysqli_query($db, "SELECT * FROM servicios WHERE token = '$tokenServicio'"));
        if ($existeTokenServicio != 0) {
            // buscar id del usuario
            $datosUsuario =  mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM usuarios WHERE token = '$token'"));
            $idUsuario = $datosUsuario['id'];

            // Asignar id de empresa si selecciono una empresa

            $idEmpresaUpdate = '';
            if ($_POST['vendedor'] === '0') {
                $idEmpresaUpdate = 'NULL';
            } else {
                $datosEmpresa =  mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM empresas WHERE token = '$vendedor'"));
                $idEmpresaUpdate = $datosEmpresa['id'];
            }

            // Validar si hay imagen que actualizar
            if ($imagenServicio['name'] == '') {
                $query = "UPDATE servicios SET nombre ='$nombre',categoria='$categoria',precio='$precio',descripcion='$descripcion',vendedor='$vendedor',empresas_id=$idEmpresaUpdate  WHERE token='$tokenServicio'";
                $resultado = mysqli_query($db, $query);
            } else {
                // Guardar la nueva imagen en archivos
                $carpetaImagenes = '../../uploads/servicios/';
                if (!is_dir($carpetaImagenes)) {
                    mkdir($carpetaImagenes);
                }
                $nombreServicio = 'servicio-'  . date("dmy") . '-' . $imagenServicio['name'];
                move_uploaded_file($imagenServicio['tmp_name'], $carpetaImagenes . $nombreServicio);

                // Eliminar el logo anterior
                $imagenEliminar =  mysqli_fetch_assoc(mysqli_query($db, "SELECT imagen FROM servicios WHERE token='$tokenServicio'"));

                if ($imagenEliminar['imagen'] != '') {
                    unlink('../../uploads/servicios/' . $imagenEliminar['imagen']);
                }


                $query = "UPDATE servicios SET nombre ='$nombre',categoria='$categoria',precio='$precio',descripcion='$descripcion',imagen='$nombreServicio',vendedor='$vendedor',empresas_id=$idEmpresaUpdate  WHERE token='$tokenServicio'";
                $resultado = mysqli_query($db, $query);
            }
            $status = 2;
        }
    }
}
echo $status;
