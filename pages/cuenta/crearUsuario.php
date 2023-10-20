<?php
session_start();
include('./config/db-connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $contrasena = $_POST["contrasena"];
    if (empty($email) || empty($contrasena)) {
        echo '<script>alert("Por favor, complete todos los campos.");</script>';
    } else {
        $usuario = array(
            "email_usuario" => $email,
            "contrasena_usuario" => $contrasena,
            "id_tipo_usuario" => $_SESSION["tipo_usuario"] 
        );
        $_SESSION["usuario_registro"] = $usuario;
        $ubicacion = ($_SESSION["tipo_usuario"] == 2) ? 'docente/datosDocente' : 'institucion/datosRepInst';
        header("Location: ?t=cuenta&p=$ubicacion");
        exit; // Asegura que el script se detiene después de redirigir.
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear cuenta</title>
    <link rel="stylesheet" href="../elementos/estilos.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <img src="./assets/image/logo-inet.png" alt="Imagen de encabezado" style="width: 20%; margin-left: 40%; padding-top: 70px;">
    <div class="container mt-5" style="min-height:63vh;">
        <div class="card bg-light">
            <article class="card-body mx-auto col-4 mb-5">
                <h4 class="card-title mt-3 text-center">Crea el usuario</h4>
                <p class="text-center">Tipo de usuario: <b><?php echo ($_SESSION["tipo_usuario"] == 2) ? 'Docente' : 'Institución'; ?></b></p>
                <hr />
                <p class="bg-light"></p>
                </p><br>
                <form method="post" action="">
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@ &shy</span>
                        </div>
                        <input required name="email" class="form-control" placeholder="Correo electrónico" type="email" id="email" required>
                    </div>

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">🔒</span>
                        </div>
                        <input required name="contrasena" class="form-control" placeholder="Contraseña" type="password" id="contrasena" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Siguiente</button>
                    </div>
                </form>
            </article>
        </div>
    </div>

</body>

</html>