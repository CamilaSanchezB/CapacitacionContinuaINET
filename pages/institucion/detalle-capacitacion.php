<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php
    include('./functions/validacion-institucion.php');
    include('./config/db-connection.php');
    include('./functions/fechaPasada.php');


    if (isset($_GET['id'])) {
        include('./functions/obtenerDetalleCapacitacion.php');
        $primerElemento = obtenerDetalleCapacitacion($_GET['id']);
    } ?>

    <?php
    include('./functions/cerrarsesion.php');
    if (isset($_POST['Eliminar'])) {
        $id_capacitacion = $_POST['Eliminar'];
        try {
            $sentenciaSQL = $conexion->prepare("DELETE FROM  `capacitaciones` WHERE `id_capacitacion` = '$id_capacitacion'");
            $sentenciaSQL->execute();
            header("Location: ?t=institucion&p=capacitacion-instituciones");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    ?>
    <hr class="mt-0" style="border:2ch solid rgba(125, 125, 125, 1); opacity: 1;">
    <div class="container" style="min-height: 75vh;">
        <?php require_once('./template/header-institucion.php') ?>
        <?php require_once('./template/capacitacionDetallada.php'); ?>
        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-center">
                <form method="POST">
                    <button class="btn btn-lg btn-danger shadow mb-5" name="Eliminar"
                        value="<?php echo $primerElemento['id_capacitacion'] ?>">Eliminar capacitación</button>
                    <a href="" onclick="alert('En desarrollo...')" class="btn btn-lg btn-warning shadow mb-5" 
                        value="<?php echo $primerElemento['id_capacitacion'] ?>">Editar capacitación</a>
                </form>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>