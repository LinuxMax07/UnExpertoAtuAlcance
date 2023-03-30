<?php
include '../../../includes/config/database.php';
$db = conectarDB();

$imagenMarketplace = $_FILES['imagenMarketplace'];
$nombre = $_POST['nombre'];
$categoria = $_POST['categoria'];
$precio = $_POST['precio'];
$vendedor = $_POST['vendedor'];
$descripcion = $_POST['descripcion'];
$token = $_POST['token'];
$tokenMarketplace = $_POST['tokenMarketplace'];

$status = 0;

$existeToken =  mysqli_num_rows(mysqli_query($db, "SELECT * FROM usuarios WHERE token = '$token'"));

if ($existeToken != 0) {

    // Inserta
    if ($tokenMarketplace == '') {
        // buscar id del usuario
        $datosUsuario =  mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM usuarios WHERE token = '$token'"));
        $idUsuario = $datosUsuario['id'];
        $newTokenMarketplace = uniqid(bin2hex(random_bytes(5)), true);

        // Asignar id de empresa si selecciono una empresa
        $idEmpresa = '';
        if ($vendedor === '0') {
            $idEmpresa = 'NULL';
        } else {
            $datosEmpresa =  mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM empresas WHERE token = '$vendedor'"));
            $idEmpresa = $datosEmpresa['id'];
        }

        // Validar si hay imagen que subir
        if ($imagenMarketplace['name'] == '') {
            $query = "INSERT INTO marketplace (nombre,categoria,precio,descripcion,imagen,fecha_publicacion,vendedor,token,usuarios_id,empresas_id) VALUES ('$nombre','$categoria','$precio','$descripcion','',NOW(),'$vendedor','$newTokenMarketplace','$idUsuario',$idEmpresa)";
            $resultado = mysqli_query($db, $query);
        } else {
            // Guardar la nueva imagen en archivos
            $carpetaImagenes = '../../uploads/marketplace/';
            if (!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }
            $nombreImg = 'marketplace-' . date("dmy") . '-' . $imagenMarketplace['name'];
            move_uploaded_file($imagenMarketplace['tmp_name'], $carpetaImagenes . $nombreImg);

            $query = "INSERT INTO marketplace (nombre,categoria,precio,descripcion,imagen,fecha_publicacion,vendedor,token,usuarios_id,empresas_id) VALUES ('$nombre','$categoria','$precio','$descripcion','$nombreImg',NOW(),'$vendedor','$newTokenMarketplace','$idUsuario',$idEmpresa)";
            $resultado = mysqli_query($db, $query);
        }
        $status = 1;
    } else {
        // Actualiza

        $existeTokenMarketplace =  mysqli_num_rows(mysqli_query($db, "SELECT * FROM marketplace WHERE token = '$tokenMarketplace'"));
        if ($existeTokenMarketplace != 0) {
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
            if ($imagenMarketplace['name'] == '') {
                $query = "UPDATE marketplace SET nombre ='$nombre',categoria='$categoria',precio='$precio',descripcion='$descripcion',vendedor='$vendedor',empresas_id=$idEmpresaUpdate  WHERE token='$tokenMarketplace'";
                $resultado = mysqli_query($db, $query);
            } else {
                // Guardar la nueva imagen en archivos
                $carpetaImagenes = '../../uploads/marketplace/';
                if (!is_dir($carpetaImagenes)) {
                    mkdir($carpetaImagenes);
                }
                $nombreImg = 'marketplace-' . date("dmy") . '-' . $imagenMarketplace['name'];
                move_uploaded_file($imagenMarketplace['tmp_name'], $carpetaImagenes . $nombreImg);

                // Eliminar el logo anterior
                $imagenEliminar =  mysqli_fetch_assoc(mysqli_query($db, "SELECT imagen FROM marketplace WHERE token='$tokenMarketplace'"));

                if ($imagenEliminar['imagen'] != '') {
                    unlink('../../uploads/marketplace/' . $imagenEliminar['imagen']);
                }

                $query = "UPDATE marketplace SET nombre ='$nombre',categoria='$categoria',precio='$precio',descripcion='$descripcion',imagen='$nombreImg',vendedor='$vendedor',empresas_id=$idEmpresaUpdate  WHERE token='$tokenMarketplace'";
                $resultado = mysqli_query($db, $query);
            }
            $status = 2;
        }
    }
}
echo $status;
