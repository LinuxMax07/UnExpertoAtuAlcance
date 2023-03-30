<?php
include '../../../includes/config/database.php';
$db = conectarDB();

$nombre = $_POST['nombre'];
$categoria = $_POST['categoria'];
$ubicacion = $_POST['ubicacion'];
$descripcion = $_POST['descripcion'];
$token = $_POST['token'];
$tokenEmpresa = $_POST['tokenEmpresa'];

$logo = $_FILES['logoEmpresa'];

$facebook = $_POST['facebook'];
$instagram = $_POST['instagram'];
$whatsApp = $_POST['whatsApp'];
$paginaWeb = $_POST['paginaWeb'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];


$status = 0;
$existeToken =  mysqli_num_rows(mysqli_query($db, "SELECT * FROM usuarios WHERE token = '$token'"));

if ($existeToken != 0) {

    // Inserta
    if ($tokenEmpresa == '') {
        // buscar id del usuario
        $datosUsuario =  mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM usuarios WHERE token = '$token'"));
        $idUsuario = $datosUsuario['id'];
        // $status = $idUsuario;
        $tokenEmpresa = uniqid(bin2hex(random_bytes(5)), true);

        // Validar si hay logo
        if ($logo['name'] == '') {
            $query = "INSERT INTO empresas (nombre,categoria,descripcion,ubicacion,facebook,instagram,correo,paginaWeb,whatsApp,telefono,fech_registro,token,logo,usuarios_id) VALUES ('$nombre','$categoria','$descripcion','$ubicacion','$facebook','$instagram','$correo','$paginaWeb','$whatsApp','$telefono',NOW(),'$tokenEmpresa','','$idUsuario')";
            $resultado = mysqli_query($db, $query);
        } else {
            // Guardar la nueva imagen en archivos
            $carpetaImagenes = '../../uploads/logos/';
            if (!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }
            $nombreImagen = str_replace(' ', '',  strtolower($nombre))  . '-' . date("dmy") . '-' . $logo['name'];
            move_uploaded_file($logo['tmp_name'], $carpetaImagenes . $nombreImagen);

            $query = "INSERT INTO empresas (nombre,categoria,descripcion,ubicacion,facebook,instagram,correo,paginaWeb,whatsApp,telefono,fech_registro,token,logo,usuarios_id) VALUES ('$nombre','$categoria','$descripcion','$ubicacion','$facebook','$instagram','$correo','$paginaWeb','$whatsApp','$telefono',NOW(),'$tokenEmpresa','$nombreImagen','$idUsuario')";
            $resultado = mysqli_query($db, $query);
        }

        $status = 1;
    } else {
        $existeTokenEmpresa =  mysqli_num_rows(mysqli_query($db, "SELECT * FROM empresas WHERE token = '$tokenEmpresa'"));
        // Actualiza
        if ($existeTokenEmpresa != 0) {
            // Validar si hay logo
            if ($logo['name'] == '') {
                $query = "UPDATE empresas SET nombre ='$nombre',categoria='$categoria',descripcion='$descripcion',ubicacion='$ubicacion',facebook='$facebook',instagram='$instagram',correo='$correo',paginaWeb='$paginaWeb',whatsApp='$whatsApp',telefono='$telefono'  WHERE token='$tokenEmpresa'";
                $resultado = mysqli_query($db, $query);
            } else {
                // Guardar la nueva imagen en archivos
                $carpetaImagenes = '../../uploads/logos/';
                if (!is_dir($carpetaImagenes)) {
                    mkdir($carpetaImagenes);
                }
                $nombreLogo = str_replace(' ', '',  strtolower($nombre)) . '-' . date("dmy") . '-' . $logo['name'];
                move_uploaded_file($logo['tmp_name'], $carpetaImagenes . $nombreLogo);
                // Eliminar el logo anterior

                $logoEliminar =  mysqli_fetch_assoc(mysqli_query($db, "SELECT logo FROM empresas WHERE token='$tokenEmpresa'"));


                if ($logoEliminar['logo'] != '') {
                    unlink('../../uploads/logos/' . $logoEliminar['logo']);
                }


                $query = "UPDATE empresas SET nombre ='$nombre',categoria='$categoria',descripcion='$descripcion',ubicacion='$ubicacion',facebook='$facebook',instagram='$instagram',correo='$correo',paginaWeb='$paginaWeb',whatsApp='$whatsApp',telefono='$telefono',logo = '$nombreLogo'  WHERE token='$tokenEmpresa'";
                $resultado = mysqli_query($db, $query);
            }
            $status = 2;
        }
    }
}

echo $status;
