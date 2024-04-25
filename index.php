<?php
// Incluyendo archivos necesarios
require_once($_SERVER['DOCUMENT_ROOT'] . '../shared/header.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '../db/db.php'); // Incluye el archivo que contiene la conexión a la base de datos

// Verificar si se ha enviado el formulario, mostrar los resultados después de la búsqueda
// De lo contrario, mostrar todos los viajes disponibles
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $from = $_POST['from'];
    $to = $_POST['to'];

    // Consulta SQL para buscar viajes que coincidan con los criterios de búsqueda
    $sql = "SELECT rides.*, users.username 
            FROM rides 
            JOIN users ON rides.user_id = users.id 
            WHERE start_from LIKE '%$from%' AND end_to LIKE '%$to%'";

    // Ejecutar la consulta utilizando la conexión $conn
    $result = $conn->query($sql);
} else {
    // Consulta SQL para obtener todos los viajes si el formulario no se envía
    $sql = "SELECT rides.*, users.username 
            FROM rides 
            JOIN users ON rides.user_id = users.id";

    // Ejecutar la consulta utilizando la conexión $conn
    $result = $conn->query($sql);
}
?>

<!-- El resto de tu código HTML sigue aquí -->

<body>
    <!-- Contenedor para el contenido de la página -->
    <div class="container">
        <!-- Fila para el contenido, centrado -->
        <div class="row justify-content-center mt-5">
            <!-- Columna con un ancho de 8 para pantallas medianas -->
            <div class="col-md-8">
                <!-- Contenedor de la tarjeta -->
                <div class="card">
                    <!-- Cuerpo de la tarjeta -->
                    <div class="card-body">
                        <!-- Botón para iniciar sesión -->
                        <a href="../pages/login.php" class="btn btn-primary">Login</a>
                        <!-- Imagen del logo -->
                        <img src="../images/logo.png" class="img" alt="Illustrative Purposes">
                        <!-- Título -->
                        <h5 class="title">Welcome to TicoRides.com</h5>
                        <!-- Título para la sección de búsqueda -->
                        <p class="title">Search for a Ride</p>
                        <!-- Formulario de búsqueda -->
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <!-- Cuadro que contiene el formulario de búsqueda -->
                            <div class="box">
                                <!-- Texto para "From" -->
                                <span>From</span>
                                <!-- Campo de entrada para la ubicación "From" -->
                                <input type="text" name="from" class="input-text" placeholder="From" required>
                                <!-- Texto para "To" -->
                                <span>To</span>
                                <!-- Campo de entrada para la ubicación "To" -->
                                <input type="text" name="to" class="input-text" placeholder="To" required>
                                <!-- Botón para buscar viajes -->
                                <button type="submit" class="my-button">Find my Ride!</button>
                            </div>
                        </form>
                        <!-- Título para la sección de resultados -->
                        <p class="title">Results for Rides that match your criteria:</p>
                        <!-- Tabla que muestra los resultados de los viajes -->
                        <div class="table">
                            <!-- Fila de la tabla con encabezados de columna -->
                            <div class="row align-items-start ml-3">
                                <div class="col">
                                    User
                                </div>
                                <div class="col">
                                    Start
                                </div>
                                <div class="col">
                                    End
                                </div>
                                <div class="col">
                                    <!-- Columna vacía para acciones -->
                                </div>
                            </div>
                            <!-- Código PHP para mostrar los viajes -->
                            <?php
                            if ($result->num_rows > 0) {
                                // Mostrar los viajes
                                while ($row = $result->fetch_assoc()) {
                                    echo "<div class='row align-items-start ml-3'>";
                                    echo "<div class='col'>" . $row['username'] . "</div>";
                                    echo "<div class='col'>" . $row['start_from'] . "</div>";
                                    echo "<div class='col'>" . $row['end_to'] . "</div>";
                                    echo "<div class='col'>";
                                    echo "<a href='../pages/view_ride.php?id=" . $row['id'] . "' class='button'>View</a>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                            } else {
                                echo "No results found for rides.";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
