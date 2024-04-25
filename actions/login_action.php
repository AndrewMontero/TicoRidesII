<?php
// Comprobar si la sesión aún no ha sido iniciada y, de ser así, iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Incluir el archivo de conexión a la base de datos
require_once($_SERVER['DOCUMENT_ROOT'] . '/db/db.php');

// Función para limpiar los datos del formulario
function clean_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Verificar si se ha enviado el formulario mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Limpiar y obtener los datos del formulario
    $username = clean_input($_POST['username']);
    $password = $_POST['password'];

    // Consulta para obtener los datos del usuario
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró un usuario con el nombre de usuario proporcionado
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Verificar si la contraseña proporcionada coincide con la contraseña almacenada en la base de datos
        if (password_verify($password, $row['password'])) {
            // Las credenciales son válidas, iniciar sesión y redirigir al panel de control
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username']; // Almacenar el nombre de usuario en la sesión
            header("Location: dashboard.php");
            exit();
        } else {
            // Credenciales incorrectas, mostrar mensaje de error y redirigir a la página de inicio de sesión
            $_SESSION['error'] = "Nombre de usuario o contraseña incorrectos.";
            header("Location: login.php");
            exit();
        }
    } else {
        // No se encontró un usuario con el nombre de usuario proporcionado, mostrar mensaje de error y redirigir a la página de inicio de sesión
        $_SESSION['error'] = "Nombre de usuario o contraseña incorrectos.";
        header("Location: login.php");
        exit();
    }
}
?>
