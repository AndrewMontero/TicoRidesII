<?php
// Incluir el archivo que contiene las acciones del panel de control
require($_SERVER['DOCUMENT_ROOT'] . '/actions/dashboard_action.php');

// Verificar si se ha enviado el ID del viaje a editar
if (isset($_GET['id'])) {
    $ride_id = $_GET['id'];
} else {
    // Si el ID no se ha enviado, redirigir a la página del panel de control o mostrar un mensaje de error
    header("Location: dashboard.php");
    exit();
}

// Obtener los detalles del viaje a editar desde la base de datos
$sql = "SELECT ride_name, start_from, end_to, description, departure_time, arrival_time, days FROM rides WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $ride_id);
$stmt->execute();
$stmt->bind_result($ride_name, $start_from, $end_to, $description, $departure_time, $arrival_time, $days);
$stmt->fetch();
$stmt->close();

// Convertir la cadena de días en un array
$selected_days = explode(',', $days);

// Verificar si se ha enviado el formulario para actualizar los detalles del viaje
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $ride_name = $_POST['ridename'];
    $start_from = $_POST['startfrom'];
    $end_to = $_POST['endto'];
    $description = $_POST['description'];
    $departure_time = $_POST['departure'];
    $arrival_time = $_POST['arrival'];
    $days = implode(',', $_POST['day']);

    // Actualizar los detalles del viaje en la base de datos
    $sql_update = "UPDATE rides SET ride_name=?, start_from=?, end_to=?, description=?, departure_time=?, arrival_time=?, days=? WHERE id=?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("sssssssi", $ride_name, $start_from, $end_to, $description, $departure_time, $arrival_time, $days, $ride_id);
    $stmt_update->execute();

    // Verificar si la actualización fue exitosa y mostrar un mensaje al usuario
    if ($stmt_update->affected_rows > 0) {
        $message = "¡Detalles del viaje actualizados correctamente!";
        $success = true;
    } else {
        $message = "¡Error al actualizar los detalles del viaje!";
        $success = false;
    }

    $stmt_update->close();

    // Obtener los detalles del viaje actualizados desde la base de datos
    $sql_get_details = "SELECT ride_name, start_from, end_to, description, departure_time, arrival_time, days FROM rides WHERE id = ?";
    $stmt_get_details = $conn->prepare($sql_get_details);
    $stmt_get_details->bind_param("i", $ride_id);
    $stmt_get_details->execute();
    $stmt_get_details->bind_result($ride_name, $start_from, $end_to, $description, $departure_time, $arrival_time, $days);
    $stmt_get_details->fetch();
    $stmt_get_details->close();

    // Convertir la cadena de días en un array
    $selected_days = explode(',', $days);
}
?>
