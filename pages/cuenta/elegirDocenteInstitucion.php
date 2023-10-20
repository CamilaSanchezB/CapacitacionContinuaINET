<?php
session_start(); // Iniciar la sesión

function guardarOpcionEnSesion($opcion)
{
    $_SESSION["tipo_usuario"] = $opcion;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["tipo_usuario"])) {
        switch ($_POST["tipo_usuario"]) {
            case 2:
                guardarOpcionEnSesion(2);
                break;
            case 3:
                guardarOpcionEnSesion(3);
                break;
        }
        header("Location: ?t=cuenta&p=crearUsuario");
    }
}

if (isset($_SESSION["tipo_usuario"])) {
    $opcionSeleccionada = $_SESSION["tipo_usuario"];
} else {
    $opcionSeleccionada = ""; // Valor inicial si no se ha seleccionado ninguna opción.
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INET - Capacitacion</title>
    <link rel="stylesheet" href="./elementos/estilos.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <img src="./assets/image/logo-inet.png" alt="Imagen de encabezado" style="width: 20%; margin-left: 40%; padding-top: 70px;">
    <div class="container mt-5" style="min-height:63vh;">
        <div class="card bg-light">
            <article class="card-body mx-auto col-5 mb-5">
                <h4 class="card-title mt-3 text-center">Bienvenido</h4>
                <p class="division">
                    <a class="bg-light"></a><br>
                </p>
                <h6 class="card-title mt-3 text-center">Selecciona una opción</h6>
                <form method="POST" class="form-group d-flex justify-content-center align-items-center">


                    <div class="col-6">
                        <button name="tipo_usuario" value="2" href="?p=crearUsuario" class="btn btn-primary" data-opcion="docente">
                            <img class="img-fluid" src="./assets/image/docente.png" alt="Profesor">
                            <h3>Docente</h3>
                        </button>
                    </div>
                    <div class="col-6">
                        <button name="tipo_usuario" value="3" href="?p=crearUsuario" class="btn btn-primary" data-opcion="institucion">
                            <img class="img-fluid" src="./assets/image/institucion.png" alt="Institución">
                            <h3>Institución</h3>
                        </button>
                    </div>

        </div>


        </article>
    </div>
    </div>

</body>

</html>