<?php
// Incluir el encabezado y el archivo de acción de registro de usuario
require($_SERVER['DOCUMENT_ROOT'] . '../shared/header.php');
require($_SERVER['DOCUMENT_ROOT'] . '../actions/register_user_action.php');
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

                        <!-- Formulario de registro -->
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <!-- Campo de mensaje -->
                            <div class="message"><?php echo $message; ?></div>
                            <!-- Campo de entrada para el nombre -->
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nombre">
                            <!-- Campo de entrada para el apellido -->
                            <label for="lastname" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Apellido">
                            <!-- Campo de entrada para el teléfono -->
                            <label for="phone" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="(XXX) XXX-XXX">
                            <!-- Campo de entrada para el nombre de usuario -->
                            <label for="username" class="form-label">Nombre de Usuario</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Nombre de Usuario">
                            <!-- Campo de entrada para la contraseña -->
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="*******">
                            <!-- Campo de entrada para confirmar la contraseña -->
                            <label for="rpassword" class="form-label">Repita Contraseña</label>
                            <input type="password" class="form-control" id="rpassword" name="confirm_password" placeholder="*******">
                            <!-- Enlace a la página de inicio de sesión -->
                            <p class="pUser"> ¿Ya tiene Usuario? <a href="login.php">Iniciar Sesión</a></p>
                            <!-- Botón para enviar el registro -->
                            <button type="submit" class="btn btn-primary">Registrese</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
