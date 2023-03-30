<?php

session_start(); // Iniciar la sesión

// Destruir todas las variables de sesión
$_SESSION = array();
session_destroy();
