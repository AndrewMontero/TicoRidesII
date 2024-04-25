<?php
// Iniciar la sesión si aún no se ha iniciado
session_start();

// Incluir el archivo de encabezado
require_once($_SERVER['DOCUMENT_ROOT'] . '../shared/header.php');

// Incluir el archivo de acción para agregar viajes
require_once($_SERVER['DOCUMENT_ROOT'] . '../actions/add_action.php');

// Definir el nombre de usuario predeterminado si no se encuentra en la sesión
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "no carga";
?>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <img src="../images/logo.png" class="img" alt="Fines Ilustrativos">
                <div class="card">
                    <div class="row align-items-start ml-1">
                        <!-- Enlaces de navegación -->
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
                    <img src="../images/user.png" alt="User Icon" class="user-icon">
                    <h2 class="title">Dashboard</h2>
                </div>
                <!-- Enlaces de navegación -->
                <div class="dashboard-link">
                    <a href="dashboard.php">Dashboard</a>
                    <span class="arrow">></span>
                    <a href="add.php">Add</a>
                </div>
                <!-- Sección de información -->
                <div class="info">
                    <!-- Mostrar mensajes de éxito o error -->
                    <?php if (isset($message)) : ?>
                        <div class="alert <?php echo $success ? 'alert-success' : 'alert-danger'; ?>" role="alert">
                            <?php echo $message; ?>
                        </div>
                    <?php endif; ?>
                    <!-- Formulario para agregar un viaje -->
                    <form method="POST">
                        <!-- Campos del formulario -->
                        <label for="ridename" class="form-label">Ride Name</label>
                        <input type="text" class="form-control" id="ridename" name="ridename" value="" placeholder="Ride Name">
                        <label for="startfrom" class="form-label">Start Location</label>
                        <input type="text" class="form-control" id="startfrom" name="startfrom" value="" placeholder="Start Location">
                        <label for="endto" class="form-label">End Location</label>
                        <input type="text" class="form-control" id="endto" name="endto" value="" placeholder="End Location">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" name="description" class="form-control" placeholder="Description"></textarea>
                        <h3>When</h3>
                        <div class="row align-items-start ml-3">
                            <div class="col">
                                <label for="departure" class="form-label">Departure Time</label>
                                <input type="time" class="form-control" id="departure" name="departure" value="07:00">
                                <label for="arrival" class="form-label">Estimated Arrival Time</label>
                                <input type="time" class="form-control" id="arrival" name="arrival" value="09:00">
                                <a class="cancel" href="dashboard.php">Cancel</a>
                            </div>
                            <div class="col">
                                <label for="days" class="form-label">Select Days</label>
                                <div id="days">
                                    <?php
                                    // Generar checkboxes para los días de la semana
                                    $week_days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                    foreach ($week_days as $day) {
                                        $checked = isset($selected_days) && in_array($day, $selected_days) ? 'checked' : '';
                                        echo "<input type='checkbox' id='$day' name='day[]' value='$day' $checked>";
                                        echo "<label for='$day'>$day</label><br>";
                                    }
                                    ?>
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
