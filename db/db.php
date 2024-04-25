<?php

require_once 'config.php'; // Incluye el archivo de configuración de la base de datos

// Intenta establecer la conexión con la base de datos
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Verifica si hay algún error en la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

?>
