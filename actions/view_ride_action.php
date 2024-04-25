<?php
// Incluir el archivo de conexión a la base de datos
require_once($_SERVER['DOCUMENT_ROOT'] . '/db/db.php');

// Consulta para obtener todos los viajes
$sql = "SELECT * FROM rides";
$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Mostrar los viajes en la tabla
    while ($row = $result->fetch_assoc()) {
        echo "<div class='row align-items-start ml-3'>";
        // Mostrar información del viaje
        echo "<div class='col'>" . $row['username'] . "</div>"; // Supongo que 'username' es el nombre del usuario que creó el viaje
        echo "<div class='col'>" . $row['start_from'] . "</div>"; // Mostrar punto de partida del viaje
        echo "<div class='col'>" . $row['end_to'] . "</div>"; // Mostrar destino del viaje
        echo "<div class='col'>";
        echo "<a href='' class='button'>View</a>"; // Enlace para ver detalles del viaje
        echo "</div>";
        echo "</div>";
    }
} else {
    // Si no hay viajes, mostrar un mensaje indicando que no hay resultados
    echo "No hay resultados de viajes.";
}
?>
