<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $institucion = $_POST["institucion"];
    $cue = $_POST["cue"];
    $telefono = $_POST["telefono"];
    $localidad = $_POST["localidad"];
    $direccion = $_POST["direccion"];

    if (empty($institucion) || empty($cue) || empty($telefono) || empty($localidad) || empty($direccion)) {
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
                <form method="post" action="">
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                        </div>
                        <select class="form-control" name="institucion" required>
                            <option selected="" disabled>Institución</option>
                            <option>I-1</option>
                            <option>I-2</option>
                            <option>I-3</option>
                        </select>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input name="cue" class="form-control" placeholder="CUE" type="text" id="cue" oninput="validarSoloNumeros(this)" required>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input name="telefono" class="form-control" placeholder="Teléfono" type="text" id="telefono" oninput="validarSoloNumeros(this)" required>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                        </div>
                        <select class="form-control" name="localidad" required>
                            <option selected="" disabled>Localidad</option>
                            <option>L-1</option>
                            <option>L-2</option>
                            <option>L-3</option>
                        </select>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input name="direccion" class="form-control" placeholder="Dirección" type="text" id="direccion" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Completar</button>
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
