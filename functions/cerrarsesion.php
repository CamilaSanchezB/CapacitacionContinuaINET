<?php
if (isset($_POST['eliminar'])) {
    // Iniciar sesión si aún no está iniciada
    session_start();

    // Destruir la sesión actual (cerrar sesión)
    session_destroy();

    // Redirigir al usuario a una página de inicio o a donde desees después de cerrar sesión
    header("Location: ?p=inicio"); // Cambia "index.php" por la página a la que deseas redirigir al usuario
    exit(); // Asegúrate de que el script se detenga después de redirigir
  }
?>