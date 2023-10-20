<!DOCTYPE html>
<html lang="en">
<?php
include('./config/db-connection.php');
include('./functions/fechaPasada.php');
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Capacitación continua INET</title>
    <?php 
    include('./functions/chart/docente/inicializar-chart.php')
    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php
    if (isset($_GET['id'])) {
        include('./functions/obtenerDetalleCapacitacion.php');
        $primerElemento = obtenerDetalleCapacitacion($_GET['id']);
        try {
            $sentenciaSQL = $conexion->prepare("SELECT
            d.id_docente,
            d.nombre_docente,
            d.apellido_docente,
            d.dni_docente,
            dc.estado_capacitacion,
            dc.estado_respuesta
        FROM
            docentes d
        INNER JOIN
            detalle_capacitaciones dc ON d.id_docente = dc.id_docente
        LEFT JOIN
            respuestas_docentes rd ON dc.id_detalle_capacitacion = rd.id_detalle_capacitacion
        WHERE
            dc.id_capacitacion = :id_capacitacion
        ORDER BY 
            d.apellido_docente;");
            $sentenciaSQL->bindParam(":id_capacitacion", $_GET['id']);
            $sentenciaSQL->execute();

            $docentesInscriptos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    } ?>

    <?php
    include('./functions/cerrarsesion.php');
    if (isset($_POST['Eliminar'])) {
        $id_capacitacion = $_POST['Eliminar'];
        try {
            $sentenciaSQL = $conexion->prepare("DELETE FROM  `capacitaciones` WHERE `id_capacitacion` = '$id_capacitacion'");
            $sentenciaSQL->execute();
            header("Location: ?t=institucion&p=capacitaciones/capacitacion-instituciones");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    try {
        $sentenciaSQL = "SELECT `sugerencia` FROM `respuestas_docentes` WHERE `sugerencia` IS NOT NULL AND `sugerencia` <> '';";
        $sentenciaSQL = $conexion->prepare($sentenciaSQL);
        $sentenciaSQL->execute();

        $sugerencias = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    ?>
    <hr class="mt-0" style="border:2ch solid rgba(125, 125, 125, 1); opacity: 1;">
    <div class="container" style="min-height: 75vh;">
        <?php require_once('./template/header-institucion.php') ?>
        <?php require_once('./template/capacitacionDetallada.php'); ?>
        <h1 class="text-secondary">Docentes inscriptos</h1>
        <?php

        if (!empty($docentesInscriptos)) { ?>
            <h5>Total: <?php echo count($docentesInscriptos) ?></h5>
            <ol>
                <?php
                foreach ($docentesInscriptos as $docenteInsripto) {
                ?>
                    <li class="mb-2">
                        <a href="?t=institucion&p=docentes/detalle-docente&id=<?php echo $docenteInsripto['id_docente'] ?>">
                            <?php echo $docenteInsripto['apellido_docente'] . ' ' . $docenteInsripto['nombre_docente'] . ' DNI:' . $docenteInsripto['dni_docente']; ?>
                        </a>
                        <span class="ms-3 badge bg-<?php echo ($docenteInsripto['estado_respuesta'] == 1) ? 'success' : 'danger' ?>"><?php echo ($docenteInsripto['estado_respuesta'] == 1) ? 'Completó el formulario' : 'No completó el formulario de impacto pedagógico aún' ?></span>
                        <?php if (!$docenteInsripto['estado_respuesta'] && $docenteInsripto['estado_capacitacion']) {
                        ?>
                            <a class="ms-3 badge btn bg-warning text-dark" href="#" onclick="alert('En desarrollo...')"></a>Enviar e-mail de aviso</a>
                        <?php
                        } ?>
                    </li>
                <?php
                }
                ?>
            </ol><?php
                } else {
                    echo 'No hay docentes inscriptos';
                }
                    ?>
        <?php if (haPasadoFecha($primerElemento['fecha_fin_capacitacion'])) {
            require_once('./template/chart-render-graficos.php');
        ?>
            <h1 class="text-secondary">Sugerencias</h1>
            <?php
            if (!empty($sugerencias)) { ?>
                <ul>
                    <?php
                    foreach ($sugerencias as $sugerencia) {
                        echo '<li>' . $sugerencia . '</li>';
                    } ?>
                </ul>
        <?php
            } else {
                echo 'No hay sugerencias';
            }
        } ?>


        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-center">
                <form method="POST">
                    <button class="btn btn-lg btn-danger shadow mb-5" name="Eliminar" value="<?php echo $primerElemento['id_capacitacion'] ?>">Eliminar capacitación</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>