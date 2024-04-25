<?php
// Incluir el encabezado y el archivo de acción de edición
require($_SERVER['DOCUMENT_ROOT'] . '/shared/header.php');
require($_SERVER['DOCUMENT_ROOT'] . '/actions/edit_action.php');

// Verificar si existe una sesión de usuario
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    // Si no hay sesión establecida o el nombre de usuario no está disponible, mostrar un valor predeterminado
    $username = "no carga";
}
?>

<body>
    <!-- Contenedor para el contenido de la página -->
    <div class="container">
        <!-- Fila para el contenido, centrada -->
        <div class="row justify-content-center mt-5">
            <!-- Columna con un ancho de 8 para pantallas medianas -->
            <div class="col-md-8">
                <!-- Imagen del logo -->
                <img src="../Image/logo.png" class="img" alt="Fines Ilustrativos">
                <!-- Contenedor de la tarjeta -->
                <div class="card">
                    <!-- Fila para los enlaces de navegación -->
                    <div class="row align-items-start ml-1">
                        <!-- Columna para cada enlace de navegación -->
                        <div class="col">
                            <a href="dashboard.php" class="buttonmain">Dashboard</a>
                        </div>
                        <div class="col">
                            <a href="add.php" class="buttonmain">Rides</a>
                        </div>
                        <div class="col">
                            <a href="settings.php" class="buttonmain">Settings</a>
                        </div>
                    </div>
                </div>
                <!-- Mensaje de bienvenida con el nombre de usuario -->
                <div class="welcome-user">
                    <span>Welcome</span>
                    <a class="username"><?php echo $username; ?></a>
                    <img src="../Image/user.png" alt="User Icon" class="user-icon">
                    <h2 class="title">Dashboard</h2>
                </div>
                <!-- Breadcrumbs -->
                <div class="dashboard-link">
                    <a href="dashboard.php">Dashboard</a>
                    <span class="arrow">></span>
                    <a href="edit.php">Edit</a>
                </div>
                <!-- Sección de información -->
                <div class="info">
                    <!-- Mostrar mensajes de éxito o error -->
                    <?php if (isset($message)) : ?>
                        <div class="alert <?php echo isset($success) ? 'alert-success' : 'alert-danger'; ?>" role="alert">
                            <?php echo $message; ?>
                        </div>
                    <?php endif; ?>
                    <!-- Formulario para editar un viaje -->
                    <form method="POST">
                        <!-- Etiqueta y campo de entrada para el nombre del viaje -->
                        <label for="ridename" class="form-label">Ride Name</label>
                        <input type="text" class="form-control" id="ridename" name="ridename" value="<?php echo $ride_name; ?>">
                        <!-- Etiqueta y campo de entrada para la ubicación de inicio -->
                        <label for="startfrom" class="form-label">Start Location</label>
                        <input type="text" class="form-control" id="startfrom" name="startfrom" value="<?php echo $start_from; ?>">
                        <!-- Etiqueta y campo de entrada para la ubicación final -->
                        <label for="endto" class="form-label">End Location</label>
                        <input type="text" class="form-control" id="endto" name="endto" value="<?php echo $end_to; ?>">
                        <!-- Etiqueta y área de texto para la descripción del viaje -->
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" name="description" class="form-control"><?php echo $description; ?></textarea>
                        <!-- Subtítulo para el horario -->
                        <h3>When</h3>
                        <!-- Fila para los campos de horario -->
                        <div class="row align-items-start ml-3">
                            <!-- Columna para la hora de salida -->
                            <div class="col">
                                <!-- Etiqueta y campo de entrada para la hora de salida -->
                                <label for="departure" class="form-label">Departure Time</label>
                                <input type="time" class="form-control" id="departure" name="departure" value="<?php echo $departure_time; ?>">
                                <!-- Etiqueta y campo de entrada para la hora estimada de llegada -->
                                <label for="arrival" class="form-label">Estimated Arrival Time</label>
                                <input type="time" class="form-control" id="arrival" name="arrival" value="<?php echo $arrival_time; ?>">
                                <!-- Enlace para cancelar -->
                                <a class="cancel" href="dashboard.php">Cancel</a>
                            </div>
                            <!-- Columna para seleccionar los días -->
                            <div class="col">
                                <!-- Etiqueta para la selección de días -->
                                <label for="days" class="form-label">Select Days</label>
                                <div id="days">
                                    <!-- Casillas de verificación para cada día -->
                                    <?php
                                    $week_days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                    foreach ($week_days as $day) {
                                        $checked = in_array($day, $selected_days) ? 'checked' : '';
                                        echo "<input type='checkbox' id='$day' name='day[]' value='$day' $checked>";
                                        echo "<label for='$day'>$day</label><br>";
                                    }
                                    ?>
                                    <!-- Botón para guardar cambios -->
                                    <button type="submit" class="save">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
