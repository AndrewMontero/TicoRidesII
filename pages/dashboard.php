<?php
// Include los archivos necesarios
require_once($_SERVER['DOCUMENT_ROOT'] . '../shared/header.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '../actions/dashboard_action.php');

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
                <img src="../images/logo.png" class="img" alt="Fines Ilustrativos">
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
                    <img src="../images/user.png" alt="User Icon" class="user-icon">
                    <h2 class="title">Dashboard</h2>
                </div>

                <!-- Breadcrumbs -->
                <div class="dashboard-link">
                    <a href="#">Dashboard</a>
                    <span class="arrow">></span>
                </div>

                <!-- Título de la sección -->
                <p class="title">My Rides</p>
                <!-- Contenedor de la tarjeta para la información del viaje -->
                <div class="card">
                    <!-- Cuerpo de la tarjeta -->
                    <div class="card-body">
                        <!-- Tu lista actual de viajes -->
                        <p class="title">Your current list of Rides</p>
                        <!-- Botón para agregar un nuevo viaje -->
                        <div class="buttonplus" onclick="location.href='../pages/add.php'">
                            <div class="plus horizontal"></div>
                            <div class="plus vertical"></div>
                        </div>
                        <!-- Mostrar mensajes de éxito o error -->
                        <?php if (isset($message)) : ?>
                            <div class="alert <?php echo isset($success) ? 'alert-success' : 'alert-danger'; ?>" role="alert">
                                <?php echo $message; ?>
                            </div>
                        <?php endif; ?>
                        <!-- Tabla que muestra la información del viaje -->
                        <div class="table">
                            <!-- Fila de la tabla con los encabezados de las columnas -->
                            <div class="row align-items-start ml-3">
                                <div class="col">
                                    Name
                                </div>
                                <div class="col">
                                    Start
                                </div>
                                <div class="col">
                                    End
                                </div>
                                <div class="col">
                                    Actions
                                </div>
                            </div>
                            <!-- Iterar a través de los viajes y mostrar la información -->
                            <?php
                            foreach ($rides as $ride) {
                                echo "<div class='row align-items-start ml-3'>";
                                echo "<div class='col'>" . $ride['ride_name'] . "</div>";
                                echo "<div class='col'>" . $ride['start_from'] . "</div>";
                                echo "<div class='col'>" . $ride['end_to'] . "</div>";
                                echo "<div class='col'>";
                                echo "<a href='edit.php?id=" . $ride['id'] . "' class='button'>Edit -</a>";
                                echo "<a href='?delete_id=" . $ride['id'] . "' class='button'>Delete</a>";
                                echo "</div>";
                                echo "</div>";
                            }
                            ?>
                        </div>
                    </div>
                    <!-- Botón para agregar un nuevo viaje (similar al anterior) -->
                    <div class="buttonplus2" onclick="location.href='../pages/add.php'">
                        <div class="plus horizontal"></div>
                        <div class="plus vertical"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
