<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Capacitación continua INET</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php
    include('./config/db-connection.php');
    include('./functions/fechaPasada.php');

    if (isset($_GET['id'])) {
        include('./functions/obtenerDetalleCapacitacion.php');
        $primerElemento = obtenerDetalleCapacitacion($_GET['id']);
    } ?>

    <?php
    include('./functions/cerrarsesion.php');

    $inscripto_a_capacitacion = false;
    try {
        $sentenciaSQL = $conexion->prepare("SELECT `id_detalle_capacitacion` FROM detalle_capacitaciones
        INNER JOIN `docentes` ON `detalle_capacitaciones`.`id_docente` = `docentes`.`id_docente`
        INNER JOIN `usuarios` ON `docentes`.`id_usuario` = `usuarios`.`id_usuario`
        WHERE `docentes`.`id_usuario` = :id_usuario
        AND id_capacitacion = :id_capacitacion");
        $sentenciaSQL->bindParam(":id_usuario", $_SESSION['usuario']['id_usuario']);
        $sentenciaSQL->bindParam(":id_capacitacion", $_GET['id']);
        $sentenciaSQL->execute();
        $inscripto_a_capacitacion = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $sentenciaSQL_idDocente = $conexion->prepare("SELECT `id_docente` FROM docentes WHERE `id_usuario` = :id_usuario");
    $sentenciaSQL_idDocente->bindParam(":id_usuario", $_SESSION['usuario']['id_usuario']);
    $sentenciaSQL_idDocente->execute();
    $resultado_idDocente = $sentenciaSQL_idDocente->fetch(PDO::FETCH_ASSOC);


    if (isset($_POST['AltaInscripcion'])) {
        try {


            // Verifica que se haya obtenido el ID del docente
            if ($resultado_idDocente) {
                // Habilita la inserción en la base de datos
                $id_capacitacion = $_GET['id'];

                // Verifica que $id_capacitacion sea un valor válido antes de continuar
                // ...

                $sentenciaSQL_idDocente = $conexion->prepare("INSERT INTO `detalle_capacitaciones` (`id_docente`, `id_capacitacion`) VALUES (:id_docente, :id_capacitacion)");
                $sentenciaSQL_idDocente->bindParam(":id_docente", $resultado_idDocente['id_docente']);
                $sentenciaSQL_idDocente->bindParam(":id_capacitacion", $id_capacitacion);
                $sentenciaSQL_idDocente->execute();
                echo '<script>alert("Solicitud procesada con éxito"); window.location.replace("?t=docente&p=listado-mis-capacitaciones");</script>';
            } else {
                echo "No se pudo obtener el ID del docente.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    if (isset($_POST['BajaInscripcion'])) {
        try {
            if ($resultado_idDocente) {
                // Habilita la inserción en la base de datos
                $id_capacitacion = $_GET['id'];

                // Verifica que $id_capacitacion sea un valor válido antes de continuar
                // ...

                $sentenciaSQL_idDocente = $conexion->prepare("DELETE FROM `detalle_capacitaciones` WHERE `id_capacitacion` = :id_capacitacion AND `id_docente` = :id_docente");
                $sentenciaSQL_idDocente->bindParam(":id_docente", $resultado_idDocente['id_docente']);
                $sentenciaSQL_idDocente->bindParam(":id_capacitacion", $id_capacitacion);
                $sentenciaSQL_idDocente->execute();
                echo '<script>alert("Solicitud procesada con éxito"); window.location.replace("?t=docente&p=listado-mis-capacitaciones");</script>';
            } else {
                echo "No se pudo obtener el ID del docente.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    ?>
    <hr class="mt-0" style="border:2ch solid rgba(125, 125, 125, 1); opacity: 1;">
    <div class="container" style="min-height: 75vh;">
        <?php require_once('./template/header-docente.php') ?>
        <?php require_once('./template/capacitacionDetallada.php'); ?>
        <?php
        if (!isset($_GET['i'])) {
        ?>
            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center">
                    <form method="POST">
                        <?php
                        if ($inscripto_a_capacitacion ) { ?>
                            <button class="btn btn-lg btn-danger shadow mb-5" name="BajaInscripcion" value="<?php echo $primerElemento['id_capacitacion'] ?>">Dar de baja inscripcion</button>
                        <?php

                        } else{ ?>
                            <button class="btn btn-lg btn-success shadow mb-5" name="AltaInscripcion" value="<?php echo $primerElemento['id_capacitacion'] ?>">Inscribirme</button>
                        <?php

                        }
                        ?>

                    </form>
                </div>

            </div>
        <?php
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>