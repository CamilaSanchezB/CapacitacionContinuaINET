<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $dni = $_POST["dni"];
    $numero = $_POST["numero"];

    if (empty($nombre) || empty($apellido) || empty($dni) || empty($numero)) {
        echo '<script>alert("Por favor, complete todos los campos.");</script>';
    }else{
        $representante_institucional = array(
            "nombre_representante_institucional" => $nombre,
            "apellido_representante_institucional" => $apellido,
            "dni_representante_institucional" => $dni,
            "telefono_representante_institucional" => $numero
        );
        $_SESSION["representante_institucional"] = $representante_institucional;
        header("Location: ?t=cuenta&p=institucion/datosInstitucion");
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
            <article class="card-body mx-auto col-4">
                <h4 class="card-title mt-3 text-center">Ingresa los datos</h4>

                <p class="text-center"><i class="text-center">Representante institucional</i></p>
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
                    <div class="form-group input-group mb-0">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input name="numero" class="form-control" placeholder="Número celular" type="text" id="numero" oninput="validarSoloNumeros(this)" required>
                    </div>
                    <small>Sin el 15 y con el código de área. <i>EJEMPLO: <span class="text-danger">223 6804125</span></i></small>

                    <div class="form-group mt-5">
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

        document.addEventListener("DOMContentLoaded", function() {
            var card = document.querySelector(".card");
            card.classList.add("show");
        });
    </script>
</body>

</html>