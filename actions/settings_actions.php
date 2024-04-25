<?php
// Incluir el archivo de conexión a la base de datos
require($_SERVER['DOCUMENT_ROOT'] . '../db/db.php');

// Iniciar la sesión
session_start();

// Verificar si el usuario está autenticado
if (isset($_SESSION['user_id'])) {
    // Obtener el ID de usuario de la sesión
    $user_id = $_SESSION['user_id'];

    // Verificar si el formulario ha sido enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $full_name = $_POST['fullname'];
        $average_speed = $_POST['speedAverage'];
        $about_me = $_POST['aboutMe'];

        // Verificar si los datos ya existen para este usuario
        $stmt_select = $conn->prepare("SELECT COUNT(*) FROM user_data WHERE user_id = ?");
        if (!$stmt_select) {
            echo "Error al preparar la consulta: " . $conn->error;
        } else {
            $stmt_select->bind_param("i", $user_id);
            if ($stmt_select->execute()) {
                $stmt_select->bind_result($count);
                $stmt_select->fetch();
                $stmt_select->close();

                if ($count > 0) {
                    // Si los datos existen, actualizarlos
                    $stmt_update = $conn->prepare("UPDATE user_data SET full_name = ?, average_speed = ?, about_me = ? WHERE user_id = ?");
                    if (!$stmt_update) {
                        echo "Error al preparar la consulta: " . $conn->error;
                    } else {
                        $stmt_update->bind_param("sssi", $full_name, $average_speed, $about_me, $user_id);
                        if ($stmt_update->execute()) {
                            // Redirigir al usuario al panel de configuraciones después de guardar los datos
                            header("Location: ../pages/settings.php");
                            exit();
                        } else {
                            // Mostrar mensaje de error si los datos no pudieron ser guardados
                            echo "Error al actualizar los datos en la base de datos.";
                        }
                        $stmt_update->close();
                    }
                } else {
                    // Si los datos no existen, insertar nuevos datos
                    $stmt_insert = $conn->prepare("INSERT INTO user_data (full_name, average_speed, about_me, user_id) VALUES (?, ?, ?, ?)");
                    if (!$stmt_insert) {
                        echo "Error al preparar la consulta: " . $conn->error;
                    } else {
                        $stmt_insert->bind_param("sssi", $full_name, $average_speed, $about_me, $user_id);
                        if ($stmt_insert->execute()) {
                            // Redirigir al usuario al panel de configuraciones después de guardar los datos
                            header("Location: ../pages/dashboard.php");
                            exit();
                        } else {
                            // Mostrar mensaje de error si los datos no pudieron ser guardados
                            echo "Error al insertar los datos en la base de datos.";
                        }
                        $stmt_insert->close();
                    }
                }
            } else {
                // Mostrar mensaje de error si la consulta no se pudo ejecutar
                echo "Error al ejecutar la consulta.";
            }
        }
    } else {
        // Si el formulario no ha sido enviado, obtener los datos del usuario
        // Consulta SQL para recuperar los datos del usuario de la tabla user_data
        $query = "SELECT full_name, average_speed, about_me FROM user_data WHERE user_id = ?";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            echo "Error al preparar la consulta: " . $conn->error;
        } else {
            $stmt->bind_param("i", $user_id);
            if ($stmt->execute()) {
                $stmt->bind_result($full_name, $average_speed, $about_me);
                $stmt->fetch();
                $stmt->close();
            } else {
                // Mostrar mensaje de error si la consulta no se pudo ejecutar
                echo "Error al ejecutar la consulta.";
            }
        }
    }
} else {
    // Si el usuario no está autenticado, redirigir al inicio de sesión
    header("Location: ../pages/login.php");
    exit();
}
?>
