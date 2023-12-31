<?php
include('./config/db-connection.php');
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $contrasena = $_POST["contrasena"];

    if (empty($email) || empty($contrasena)) {
        echo "Por favor, complete todos los campos.";
    } else {

        $sql = "SELECT * FROM `usuarios` WHERE `email_usuario` = :email AND `contrasena_usuario` = :contrasena";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":contrasena", $contrasena);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $_SESSION["usuario"] = $row;


            switch ($row['id_tipo_usuario']) {
                case 1:
                    header("Location: ?t=administrador&p=instituciones/listadoETP");
                    break;
                case 2:
                    header("Location: ?t=docente&p=listado-capacitaciones");
                    break;
                case 3:
                    header("Location: ?t=institucion&p=capacitaciones/capacitacion-instituciones");
                    break;
            }
            // header("Location: ?p=inicio");
            exit();
        } else {
            echo "<script>alert('Credenciales incorrectas')</script>";
        }
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
</head>

<body>
    <img src="./assets/image/logo-inet.png" alt="Imagen de encabezado" style="width: 20%; margin-left: 40%; margin-top: 70px;">
    <div class="container mt-5" style="min-height: 63vh;">
        <div class="card bg-light">
            <article class="card-body mx-auto" style="max-width: 400px;">
                <h4 class="card-title mt-3 text-center">Iniciar sesión</h4>
                <p class="text-center">Su usuario debe ser previamente validado por el INET o una institución ETP</p>
                <h6 class="text-danger text-center" id="texto-error"></h6>
                <p class="division">
                <p class="bg-light"></p>
                </p><br>
                <form method="POST">
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@ &shy</span>
                        </div>
                        <input name="email" class="form-control" placeholder="Correo electronico" type="text" required>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">🔒 </span>
                        </div>
                        <input name="contrasena" class="form-control" placeholder="Contraseña" type="password" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                    </div>
                </form>
                <!-- Enlace a la página de registro -->

                <p class="text-center">¿No tienes una cuenta? <a href="?t=cuenta&p=elegirDocenteInstitucion">Regístrate aquí</a></p>
            </article>
        </div>
    </div>
    <?php
    if (isset($_GET['f'])) {
    ?>
        <script>
            Swal.fire({
                title: 'Registro completado con éxito',
                text: "Para poder acceder a la plataforma el administrador o la respectiva institucion ETP deben autorizarte",
                icon: 'success',
                allowOutsideClick: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.replace("?p=inicio");
                }
            })
            
        </script>
    <?php }
    ?>
</body>

</html>