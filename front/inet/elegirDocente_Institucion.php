<?php
session_start(); // Iniciar la sesión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tu lógica de procesamiento aquí si es necesario.
}

if (isset($_SESSION["opcionSeleccionada"])) {
    $opcionSeleccionada = $_SESSION["opcionSeleccionada"];
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
    <img src="../../image/logo-inet.png" alt="Imagen de encabezado" style="width: 20%; margin-left: 40%; padding-top: 70px;">
    <div class="container">
        <div class="card bg-light">
            <article class="card-body mx-auto" style="max-width: 400px;">
                <h4 class="card-title mt-3 text-center">Hola!</h4>
                <p class="division">
                    <a class="bg-light"></a><br>
                </p>
                <h6 class="card-title mt-3 text-center">Selecciona una opción</h6>
                <div class="form-group d-flex justify-content-between">
                    <a href="./docente/docenteCuenta.php" class="btn btn-primary elegir-boton" data-opcion="docente">
                        <img src="./img/docente.png" alt="Profesor">
                    </a>
                    <a href="./instituciones/institucionCuenta.php" class="btn btn-primary elegir-boton" data-opcion="institucion">
                        <img src="./img/institucion.png" alt="Institución">
                    </a>
                </div>
               
            </article>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var opciones = document.querySelectorAll(".elegir-boton");
    
            opciones.forEach(function (opcion) {
                opcion.addEventListener("click", function (event) {
                    var opcionSeleccionada = event.currentTarget.getAttribute("data-opcion");
                    <?php echo "localStorage.setItem('opcionSeleccionada', '$opcionSeleccionada');"; ?>
                    
                    // Almacena la opción seleccionada en la variable de sesión de PHP
                    <?php echo '$_SESSION["opcionSeleccionada"] = "' . $opcionSeleccionada . '";'; ?>

                });
            });
        });
    </script>
    
</body>
</html>
