<?php
function conectarDB(): mysqli
{
    $db = mysqli_connect('localhost', 'u395121333_adminExperto', '8nD9dg8g4sVrad', 'u395121333_unExperto');
    mysqli_set_charset($db, "utf8");
    if (!$db) {
        echo "No se pudo conectar a la base de datos";
        exit;
    }
    // else {
    //     echo 'conectado';
    // }
    return $db;
}
