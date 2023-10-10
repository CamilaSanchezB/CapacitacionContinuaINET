<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $contrasena = $_POST["contrasena"];

    if (empty($email) || empty($contrasena)) {
        echo "Por favor, complete todos los campos.";
    } else {
        // Aquí puedes realizar cualquier lógica adicional, como verificar las credenciales en una base de datos.
        // Si la validación es exitosa, puedes redirigir al usuario a otra página.
        // Por ejemplo:
        // header("Location: otra_pagina.php");
        // exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="/inet/elementos/estilos.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
    <img src="../image/logo-inet.png" alt="Imagen de encabezado" style="width: 20%; margin-left: 40%; margin-top: 70px;">
    <div class="container">
        <div class="card bg-light">
            <article class="card-body mx-auto" style="max-width: 400px;">
                <h4 class="card-title mt-3 text-center">Iniciar sesión</h4>
                <p class="division">
                <p class="bg-light"></p>
                </p><br>
                <form method="POST" action="">
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input name="email" class="form-control" placeholder="Correo electronico" type="text" required>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input name="contrasena" class="form-control" placeholder="Contraseña" type="password" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                    </div>
                </form>
                <!-- Enlace a la página de registro -->
                <p class="text-center">¿No tienes una cuenta? <a href="elegirDocente_Institucion.html">Regístrate aquí</a></p>
            </article>
        </div>
    </div>
</body>
</html>
