<?php
// Incluir el encabezado y el archivo de acción de inicio de sesión
require_once($_SERVER['DOCUMENT_ROOT'] . '/shared/header.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/login_action.php');
?>

<body>
    <!-- Contenedor de imagen de fondo -->
    <img src="../images/mason-kiesewetter-fYGKyASSuk0-unsplash (1).jpg" class="background-image" alt="Fines Ilustrativos">
    <!-- Contenedor para el contenido de la página -->
    <div class="container">
        <!-- Fila para el contenido, justificado a la izquierda -->
        <div class="row justify-content-left mt-5">
            <!-- Columna con un ancho de 4 para pantallas medianas -->
            <div class="col-md-4">
                <!-- Contenedor de tarjeta -->
                <div class="card">
                    <!-- Cuerpo de la tarjeta -->
                    <div class="card-body">
                        <!-- Imagen del logo -->
                        <img src="../images/logo.png" class="img" alt="Fines Ilustrativos">

                        <!-- Formulario de inicio de sesión -->
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div>
                                <!-- Entrada de nombre de usuario -->
                                <label for="fromLocation" class="form-label">Nombre de Usuario</label>
                                <input type="text" class="form-control" id="fromLocation" name="username" placeholder="Usuario">

                                <!-- Entrada de contraseña -->
                                <label class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="password" placeholder="Contraseña">

                                <!-- Mensaje de error -->
                                <?php if (isset($_SESSION['error'])) { ?>
                                    <div class="alert alert-danger mt-3" role="alert">
                                        <?php echo $_SESSION['error']; ?>
                                    </div>
                                <?php unset($_SESSION['error']);
                                } ?>

                                <!-- Enlace a la página de registro -->
                                <p class="pUser"> ¿No tiene cuenta? <a href="register.php">Regístrese aquí</a></p>

                                <!-- Botón para enviar el inicio de sesión -->
                                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
