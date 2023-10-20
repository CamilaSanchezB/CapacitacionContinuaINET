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
    ?>
    <?php
    $id_usuario = $_SESSION['usuario']['id_usuario'];

    $listaDetalleCapacitaciones = [];
    try {
        $sentenciaSQL = $conexion->prepare("SELECT c.id_capacitacion, dc.estado_capacitacion, dc.estado_respuesta, c.fecha_inicio_capacitacion, c.fecha_fin_capacitacion, dc.id_detalle_capacitacion, c.nombre_capacitacion, i.nombre_institucion
        FROM `detalle_capacitaciones` dc
        INNER JOIN `capacitaciones` c ON dc.id_capacitacion = c.id_capacitacion
        INNER JOIN `instituciones` i ON c.id_institucion = i.id_institucion
        INNER JOIN `docentes` d ON dc.id_docente = d.id_docente
        INNER JOIN `usuarios` u ON d.id_usuario = u.id_usuario
        WHERE d.id_usuario = :id_usuario ");
        $sentenciaSQL->bindParam(":id_usuario", $id_usuario);
        $sentenciaSQL->execute();
        $listaDetalleCapacitaciones = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>
    <hr class="mt-0" style="border:2ch solid rgba(125, 125, 125, 1); opacity: 1;">
    <div class="container" style="height: 75vh;">

        <?php require_once('./template/header-docente.php') ?>
        <h1 style="color: rgba(129, 129, 129, 1);">Mis capacitaciones</h1>
        <ul>
            <?php
            $currentInstitucion = null;

            foreach ($listaDetalleCapacitaciones as $detalleCapacitacion) {
                $institucion = $detalleCapacitacion['nombre_institucion'];
                $capacitacion = $detalleCapacitacion['nombre_capacitacion'];

                if ($institucion != $currentInstitucion) {
                    if ($currentInstitucion !== null) {
                        echo '</ul></div></div>';
                    }
                    echo '<div class="col-12 mt-4"><h3>' . $institucion . '<span></span></h3><ul>';
                }

                echo '<li style="margin-bottom: 10px; font-size: 20px;" class="text-primary">';
                echo '<a href="?t=docente&p=detalle-capacitacion&id=' . $detalleCapacitacion['id_capacitacion'] . (haPasadoFecha($detalleCapacitacion['fecha_inicio_capacitacion']) ? '&i=0' : '') . '">' . $capacitacion . '</a>'; ?>
                <span class="badge ms-2 bg-<?php if (haPasadoFecha($detalleCapacitacion['fecha_fin_capacitacion'])) {
                        echo 'danger';
                    } else if (haPasadoFecha($detalleCapacitacion['fecha_inicio_capacitacion'])) {
                        echo 'success';
                    } else {
                        echo 'warning';
                    } ?>">
                    <?php if (haPasadoFecha($detalleCapacitacion['fecha_fin_capacitacion'])) {
                        echo 'FINALIZADO';
                    } else if (haPasadoFecha($detalleCapacitacion['fecha_inicio_capacitacion'])) {
                        echo 'ACTIVO';
                    } else {
                        echo 'AUN NO INICIÓ';
                    } ?>


                </span>
                <?php if ($detalleCapacitacion['estado_capacitacion'] == 1 && $detalleCapacitacion['estado_respuesta'] == 0) {
                    echo '<a href="?t=docente&p=formulario-capacitacion&id=' . $detalleCapacitacion['id_capacitacion'] . '" class="btn badge btn-warning text-dark">Completar formulario de impacto pedagógico</a>';
                } else if ($detalleCapacitacion['estado_capacitacion'] == 1 && $detalleCapacitacion['estado_respuesta'] == 1) {
                    echo '<span  class="badge bg-success">Formulario de impacto pedagógico completado</span>';
                }
                ?>
            <?php
                echo '</li>';

                $currentInstitucion = $institucion;
            }
            ?>
        </ul>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <?php $conexion = null; ?>
</body>

</html>