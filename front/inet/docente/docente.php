<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $dni = $_POST["dni"];
    $email = $_POST["email"];
    $especialidad = $_POST["especialidad"];
    $institucion = $_POST["institucion"];

    // Eliminar espacios en blanco al principio y al final de los valores ingresados
    $nombre = trim($nombre);
    $dni = trim($dni);
    $email = trim($email);
    $especialidad = trim($especialidad);
    $institucion = trim($institucion);

    if (empty($nombre) || empty($dni) || empty($email) || empty($especialidad) || empty($institucion)) {
        echo '<script>alert("Por favor, complete todos los campos.");</script>';
    } elseif (ctype_space($nombre) || ctype_space($dni) || ctype_space($email) || ctype_space($especialidad) || ctype_space($institucion)) {
        echo '<script>alert("Los campos no pueden contener solo espacios en blanco.");</script>';
    } else {
        // Realizar otras validaciones si es necesario
        // Si pasa todas las validaciones, puedes realizar el procesamiento adicional aquí
        echo '<script>alert("Registro exitoso. Puedes continuar.");</script>';
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
    <img src="../../image/logo-inet.png" alt="Imagen de encabezado" style="width: 20%; margin-left: 40%; margin-top: 70px;">
    <div class="container">
        <div class="card bg-light">
            <article class="card-body mx-auto" style="max-width: 400px;">
                <h4 class="card-title mt-3 text-center"></h4>
                <p class="division">
                <p class="bg-light"></p>
                </p><br>
                <form method="post">
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input name="nombre" class="form-control" placeholder="Nombre de usuario" type="text" id="nombre" required>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input name="dni" class="form-control" placeholder="DNI" type="text" id="dni" required>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                        </div>
                        <input name="email" class="form-control" placeholder="Correo electrónico" type="email" id="email" required>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                        </div>
                        <select name="especialidad" class="form-control" id="especialidad" required>
                            <option selected="" disabled>Especialidad</option>
                            <option>E-1</option>
                            <option>E-2</option>
                            <option>E-3</option>
                        </select>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                        </div>
                        <select name="institucion" class="form-control" id="institucion" required>
                            <option selected="" disabled>Institución</option>
                            <option>I-1</option>
                            <option>I-2</option>
                            <option>I-3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Registrarme</button>
                    </div>
                </form>
            </article>
        </div>
    </div>
    <script>
        function validarSoloNumeros(input) {
            input.value = input.value.replace(/[^0-9]/g, '');
        }

        document.addEventListener("DOMContentLoaded", function () {
            var card = document.querySelector(".card");
            card.classList.add("show");
        });
    </script>
</body>

</html>
