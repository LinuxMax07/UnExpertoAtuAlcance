<?php

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$mensaje = $_POST['mensaje'];

ini_set('display_errors', 1);
error_reporting(E_ALL);
$from = "unexperto@unexpertoatualcance.com";
$to = "joseenriqueblas0307@gmail.com";
$subject = "Reporte/Duda UnExpertoAtuAlcance";
$message = 'Nombre del usuario:' . $nombre . "\r\n" . 'Correo del usuario:' . $correo . "\r\n" . 'Mensaje:' . $mensaje;
$headers = "From:" . $from;
mail($to, $subject, $message, $headers);
echo 1;
