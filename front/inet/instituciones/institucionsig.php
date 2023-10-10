<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $dni = $_POST["dni"];
    $numero = $_POST["numero"];

    if (empty($nombre) || empty($apellido) || empty($dni) || empty($numero)) {
        echo '<script>alert("Por favor, complete todos los campos.");</script>';
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
                <h4 class="card-title mt-3 text-center">Crea tu usuario</h4>
                <p class="division">
                <p class="bg-light"></p>
                </p><br>
                <p class="card-title mt-3 text-center representante">Representante institucional</p>
                <br>
                <form method="post" action="">
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input name="nombre" class="form-control" placeholder="Nombre" type="text" id="nombre" required>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input name="apellido" class="form-control" placeholder="Apellido" type="text" id="apellido" required>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input name="dni" class="form-control" placeholder="DNI" type="text" id="dni" oninput="validarSoloNumeros(this)" required>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input name="numero" class="form-control" placeholder="Número celular" type="text" id="numero" oninput="validarSoloNumeros(this)" required>
                    </div>
                 
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Siguiente</button>
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
