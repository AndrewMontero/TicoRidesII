<?php
// Incluir archivos necesarios
require_once($_SERVER['DOCUMENT_ROOT'] . '/shared/header.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/db/db.php');

// Verificar si se proporciona un ID de viaje en la URL
if (isset($_GET['id'])) {
    $ride_id = $_GET['id'];

    // Consulta para recuperar los detalles del viaje con el ID proporcionado
    $sql = "SELECT * FROM rides WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ride_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encuentra el viaje
    if ($result->num_rows == 1) {
        $ride = $result->fetch_assoc();
?>

        <body>
            <!-- Contenedor para el contenido de la página -->
            <div class="container">
                <!-- Fila para el contenido, centrado -->
                <div class="row justify-content-center mt-5">
                    <!-- Columna con un ancho de 8 para pantallas medianas -->
                    <div class="col-md-8">
                        <!-- Imagen del logo -->
                        <img src="../Image/logo.png" class="img" alt="Illustrative Purposes">
                        <!-- Sección de información -->
                        <div class="info">
                            <!-- Etiqueta y campo de entrada para el nombre del viaje -->
                            <label for="ridename" class="form-label">Ride Name</label>
                            <!-- Mostrar el nombre del viaje -->
                            <input type="text" class="form-control" id="ridename" value="<?php echo $ride['ride_name']; ?>" disabled>
                            <!-- Etiqueta y campo de entrada para la ubicación de inicio -->
                            <label for="startfrom" class="form-label">Start Location</label>
                            <!-- Mostrar la ubicación de inicio -->
                            <input type="text" class="form-control" id="location" value="<?php echo $ride['start_from']; ?>" disabled>
                            <label for="startfrom" class="form-label">End Location</label>
                            <!-- Mostrar la ubicación de destino -->
                            <input type="text" class="form-control" id="location" value="<?php echo $ride['end_to']; ?>" disabled>
                            <!-- Etiqueta y área de texto para la descripción del viaje -->
                            <label for="description" class="form-label">Description</label>
                            <div class="description">
                                <!-- Mostrar la descripción del viaje -->
                                <textarea id="description" disabled><?php echo $ride['description']; ?></textarea>
                                <!-- Subtítulo para el horario -->
                                <h3>Schedule</h3>
                                <!-- Fila para los campos de horario -->
                                <div class="row align-items-start ml-3">
                                    <!-- Columna para los campos de tiempo -->
                                    <div class="col">
                                        <!-- Etiqueta y campo de entrada para la hora de salida -->
                                        <label for="departure" class="form-label">Departure Time</label>
                                        <!-- Mostrar la hora de salida -->
                                        <input type="time" class="form-control" id="departure" value="<?php echo $ride['departure_time']; ?>" disabled>
                                        <!-- Etiqueta y campo de entrada para la hora de llegada estimada -->
                                        <label for="arrival" class="form-label">Estimated Arrival Time</label>
                                        <!-- Mostrar la hora de llegada estimada -->
                                        <input type="time" class="form-control" id="arrival" value="<?php echo $ride['arrival_time']; ?>" disabled>
                                        <!-- Enlace para cancelar -->
                                        <a class="cancel" href="../index.php">Cancel</a>
                                    </div>
                                    <!-- Columna para seleccionar los días -->
                                    <div class="col">
                                        <!-- Etiqueta para la selección de días -->
                                        <label for="days" class="form-label">Days</label>
                                        <!-- Mostrar los días del viaje -->
                                        <div id="days">
                                            <?php
                                            // Convertir los días del viaje de formato numérico a nombre del día
                                            $days = explode(',', $ride['days']);
                                            $day_names = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                                            foreach ($day_names as $day_name) {
                                                // Verificar si el nombre del día está en la lista de días del viaje
                                                if (in_array($day_name, $days)) {
                                                    echo "<div><input type='checkbox' id='$day_name' name='day' value='$day_name' checked disabled>";
                                                    echo "<label for='$day_name'>$day_name</label></div>";
                                                } else {
                                                    echo "<div><input type='checkbox' id='$day_name' name='day' value='$day_name' disabled>";
                                                    echo "<label for='$day_name'>$day_name</label></div>";
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>

        </html>
<?php
    } else {
        // Si no se encuentra el viaje, mostrar un mensaje de error
        echo "The ride was not found.";
    }
} else {
    // Si no se proporciona un ID de viaje en la URL, mostrar un mensaje de error
    echo "No ride ID provided.";
}
?> 
