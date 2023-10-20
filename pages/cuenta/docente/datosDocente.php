<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $dni = $_POST["dni"];
    $apellido = $_POST["apellido"];

    if (empty($nombre) || empty($dni) || empty($apellido)) {
        echo '<script>alert("Por favor, complete todos los campos.");</script>';
    } else {
        $datos_docente = array(
            "nombre_docente" => $nombre,
            "apellido_docente" => $apellido,
            "dni_docente" => $dni
        );
        $_SESSION["docente"] = $datos_docente;
        header("Location: ?t=cuenta&p=docente/datosTrabajo");
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
    <img src="./assets/image/logo-inet.png" alt="Imagen de encabezado" style="width: 20%; margin-left: 40%; margin-top: 70px;">
    <div class="container mt-5" style="min-height:63vh;">
        <div class="card bg-light">
            <article class="card-body mx-auto col-4" >
                <h4 class="card-title mt-3 text-center">Datos personales</h4>
                <p class="division">
                <p class="bg-light"></p>
                </p><br>
                <form method="post">
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input name="nombre" class="form-control" placeholder="Nombre/s" type="text" id="nombre" required>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                        </div>
                        <input name="apellido" class="form-control" placeholder="Apellido/s" type="text" id="apellido" required>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input name="dni" class="form-control" placeholder="DNI" type="text" id="dni" required>
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

        document.addEventListener("DOMContentLoaded", function() {
            var card = document.querySelector(".card");
            card.classList.add("show");
        });
    </script>
</body>

</html>