<?php
// Incluir el archivo de conexión a la base de datos
require($_SERVER['DOCUMENT_ROOT'] . '../db/db.php');

// Variable para almacenar mensajes
$message = "";

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password']; // Asegurarse de obtener el campo de confirmación de contraseña

    // Verificar si se ha establecido el campo 'confirm_password' en $_POST
    if (isset($confirm_password)) {
        // Verificar si todos los campos obligatorios están llenos
        if (empty($name) || empty($lastname) || empty($phone) || empty($username) || empty($password) || empty($confirm_password)) {
            $message = "<span style='color: red;'>Por favor, complete todos los campos.</span>";
        } elseif ($password != $confirm_password) {
            $message = "<span style='color: red;'>Las contraseñas no coinciden.</span>";
        } elseif (!preg_match('/^\d{8}$/', $phone)) {
            // Verificar si el número de teléfono tiene exactamente 8 dígitos
            $message = "<span style='color: red;'>El número de teléfono debe tener exactamente 8 dígitos.</span>";
        } else {
            // Verificar si el nombre de usuario o el número de teléfono ya existen en la base de datos
            $query = "SELECT * FROM users WHERE username = '$username' OR phone = '$phone'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                $message = "<span style='color: red;'>Ya existe un usuario con el mismo nombre de usuario o número de teléfono.</span>";
            } else {
                // Hash de la contraseña
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Insertar usuario en la base de datos
                $query = "INSERT INTO users (name, last_name, phone, username, password) 
                          VALUES ('$name', '$lastname', '$phone', '$username', '$hashed_password')";

                if (mysqli_query($conn, $query)) {
                    // Usuario registrado correctamente
                    $message = "<span style='color: green;'>Usuario registrado correctamente.</span>";

                    // Redirigir al usuario a login.php
                    header("Location: login.php");
                    exit(); // Asegurarse de salir después de redirigir para evitar que el script continúe la ejecución
                } else {
                    $message = "<span style='color: red;'>Error al registrar usuario: " . mysqli_error($conn) . "</span>";
                }
            }
        }
    } else {
        $message = "<span style='color: red;'>Error: No se recibió la confirmación de la contraseña.</span>";
    }
}
?>
