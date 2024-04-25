<?php
// Incluir archivos necesarios
require($_SERVER['DOCUMENT_ROOT'] . '/shared/header.php');
require($_SERVER['DOCUMENT_ROOT'] . '/actions/settings_actions.php');

// Verificar si hay una sesión de usuario establecida
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
        <!-- Fila para el contenido, centrado -->
        <div class="row justify-content-center mt-5">
            <!-- Columna con un ancho de 8 para pantallas medianas -->
            <div class="col-md-8">
                <!-- Imagen del logo -->
                <img src="../images/logo.png" class="img" alt="Fines Ilustrativos">
                <!-- Contenedor de tarjeta -->
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
                <!-- Enlaces de navegación -->
                <div class="dashboard-link">
                    <a href="dashboard.php">Dashboard</a>
                    <span href="settings.php" class="arrow">> Settings</span>
                </div>
                <!-- Sección de información -->
                <div class="info">
                    <!-- Formulario para actualizar la configuración del usuario -->
                    <form method="post" action="../actions/settings_actions.php">
                        <!-- Etiqueta y campo de entrada para el nombre completo -->
                        <label for="fullname" class="form-label">Full Name</label>
                        <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Full Name" value="<?php echo htmlspecialchars($full_name); ?>">
                        <!-- Etiqueta y campo de entrada para la velocidad promedio -->
                        <label for="speedAverage" class="form-label">Average Speed</label>
                        <input type="text" name="speedAverage" class="form-control" id="speedAverage" placeholder="km/h" value="<?php echo htmlspecialchars($average_speed); ?>">
                        <!-- Etiqueta y área de texto para la descripción personal -->
                        <label for="aboutMe" class="form-label">About Me</label>
                        <textarea name="aboutMe" id="aboutMe" class="form-control" placeholder="Something about me goes here"><?php echo htmlspecialchars($about_me); ?></textarea>
                        <!-- Botones para cancelar y guardar -->
                        <div class="buttons">
                            <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
