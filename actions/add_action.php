<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '../db/db.php');

// Inicializar variables
$message = "";
$success = false;

// Función para limpiar los datos del formulario
function cleanFormData($data) {
    return htmlspecialchars(trim($data));
}

// Función para validar la entrada
function validateInput($data) {
    return !empty($data);
}

// Comprobar si hay una sesión de usuario establecida y obtener el ID de usuario
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Asegurarse de iniciar la sesión antes de usar $_SESSION
}
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}

// Comprobar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Limpiar y validar los datos del formulario
    $ridename = cleanFormData($_POST['ridename']);
    $startfrom = cleanFormData($_POST['startfrom']); // Cambiar el nombre del campo a startfrom
    $endto = cleanFormData($_POST['endto']); // Agregar el campo endto
    $description = cleanFormData($_POST['description']);
    $departure = cleanFormData($_POST['departure']);
    $arrival = cleanFormData($_POST['arrival']);
    $days = isset($_POST['day']) ? implode(", ", $_POST['day']) : ""; // Convertir el array de días en una cadena

    // Validar los datos
    if (validateInput($ridename) && validateInput($startfrom) && validateInput($endto) && validateInput($description) && validateInput($departure) && validateInput($arrival) && validateInput($days)) {
        // Insertar los datos en la tabla de rides con el ID de usuario
        $sql = "INSERT INTO rides (ride_name, start_from, end_to, description, departure_time, arrival_time, days, user_id) VALUES ('$ridename', '$startfrom', '$endto', '$description', '$departure', '$arrival', '$days', $user_id)";

        if ($conn->query($sql) === TRUE) {
            $message = "Ride added successfully.";
            $success = true;
        } else {
            $message = "Error adding ride: " . $conn->error;
        }
    } else {
        $message = "Please fill out all fields.";
    }
}
?>
