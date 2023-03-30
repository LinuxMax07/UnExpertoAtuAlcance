<?php
include '../../../includes/config/database.php';
$db = conectarDB();


$imagenProducto = $_FILES['imagenProducto'];
$nombre = htmlspecialchars($_POST['nombre']);
$categoria = $_POST['categoria'];
$precio = $_POST['precio'];
$vendedor = $_POST['vendedor'];
$descripcion = $_POST['descripcion'];
$token = $_POST['token'];
$tokenProducto = $_POST['tokenProducto'];

$status = 0;

$existeToken =  mysqli_num_rows(mysqli_query($db, "SELECT * FROM usuarios WHERE token = '$token'"));

if ($existeToken != 0) {

    // Inserta
    if ($tokenProducto == '') {
        // buscar id del usuario
        $datosUsuario =  mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM usuarios WHERE token = '$token'"));
        $idUsuario = $datosUsuario['id'];
        $newTokenProducto = uniqid(bin2hex(random_bytes(5)), true);

        // Asignar id de empresa si selecciono una empresa

        $idEmpresa = '';
        if ($vendedor === '0') {

            $idEmpresa = 'NULL';
        } else {
            $datosEmpresa =  mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM empresas WHERE token = '$vendedor'"));
            $idEmpresa = $datosEmpresa['id'];
        }

        // Validar si hay imagen que subir
        if ($imagenProducto['name'] == '') {
            $query = "INSERT INTO productos (nombre,categoria,precio,descripcion,imagen,fecha_publicacion,vendedor,token,usuarios_id,empresas_id) VALUES ('$nombre','$categoria','$precio','$descripcion','',NOW(),'$vendedor','$newTokenProducto','$idUsuario',$idEmpresa)";
            $resultado = mysqli_query($db, $query);
        } else {
            // Guardar la nueva imagen en archivos
            $carpetaImagenes = '../../uploads/productos/';
            if (!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }
            $nombreProducto = 'producto-' . date("dmy") . '-' . $imagenProducto['name'];
            move_uploaded_file($imagenProducto['tmp_name'], $carpetaImagenes . $nombreProducto);

            $query = "INSERT INTO productos (nombre,categoria,precio,descripcion,imagen,fecha_publicacion,vendedor,token,usuarios_id,empresas_id) VALUES ('$nombre','$categoria','$precio','$descripcion','$nombreProducto',NOW(),'$vendedor','$newTokenProducto','$idUsuario',$idEmpresa)";
            $resultado = mysqli_query($db, $query);
        }
        $status = 1;
    } else {
        // Actualiza

        $existeTokenProducto =  mysqli_num_rows(mysqli_query($db, "SELECT * FROM productos WHERE token = '$tokenProducto'"));
        if ($existeTokenProducto != 0) {
            // buscar id del usuario
            $datosUsuario =  mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM usuarios WHERE token = '$token'"));
            $idUsuario = $datosUsuario['id'];

            // Asignar id de empresa si selecciono una empresa

            $idEmpresaUpdate = '';
            if ($vendedor === '0') {
                $idEmpresaUpdate = 'NULL';
            } else {
                $datosEmpresa =  mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM empresas WHERE token = '$vendedor'"));
                $idEmpresaUpdate = $datosEmpresa['id'];
            }

            // Validar si hay imagen que actualizar
            if ($imagenProducto['name'] == '') {
                $query = "UPDATE productos SET nombre ='$nombre',categoria='$categoria',precio='$precio',descripcion='$descripcion',vendedor='$vendedor',empresas_id=$idEmpresaUpdate  WHERE token='$tokenProducto'";
                $resultado = mysqli_query($db, $query);
            } else {
                // Guardar la nueva imagen en archivos
                $carpetaImagenes = '../../uploads/productos/';
                if (!is_dir($carpetaImagenes)) {
                    mkdir($carpetaImagenes);
                }
                $nombreProducto = 'producto-' . date("dmy") . '-' . $imagenProducto['name'];
                move_uploaded_file($imagenProducto['tmp_name'], $carpetaImagenes . $nombreProducto);

                // Eliminar el logo anterior
                $imagenEliminar =  mysqli_fetch_assoc(mysqli_query($db, "SELECT imagen FROM productos WHERE token='$tokenProducto'"));

                if ($imagenEliminar['imagen'] != '') {
                    unlink('../../uploads/productos/' . $imagenEliminar['imagen']);
                }


                $query = "UPDATE productos SET nombre ='$nombre',categoria='$categoria',precio='$precio',descripcion='$descripcion',imagen='$nombreProducto',vendedor='$vendedor',empresas_id=$idEmpresaUpdate  WHERE token='$tokenProducto'";
                $resultado = mysqli_query($db, $query);
            }
            $status = 2;
        }
    }
}
echo $status;
