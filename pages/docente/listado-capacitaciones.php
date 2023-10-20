<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Capacitación continua INET</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php include('./config/db-connection.php');
    include('./functions/fechaPasada.php');

    ?>
    <?php
    $id_usuario = $_SESSION['usuario']['id_usuario'];
    $listaCapacitaciones = [];
    try {
        $sentenciaSQL = $conexion->prepare("SELECT c.id_capacitacion, c.nombre_capacitacion, c.fecha_inicio_capacitacion, c.fecha_fin_capacitacion, i.nombre_institucion
            FROM `detalle_docente` dd
            INNER JOIN `docentes` d ON dd.`id_docente` = d.`id_docente`
            INNER JOIN `instituciones` i ON dd.`id_institucion` = i.`id_institucion`
            INNER JOIN `capacitaciones` c ON i.`id_institucion` = c.`id_institucion`
            WHERE d.id_usuario = :id_usuario
            AND dd.estado_validacion_docente = 1
            AND c.`id_especialidad` = dd.`id_especialidad`
            AND c.fecha_inicio_capacitacion > CURDATE()
        ");
        $sentenciaSQL->bindParam(":id_usuario", $id_usuario);
        $sentenciaSQL->execute();
        $listaCapacitaciones = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>
    <hr class="mt-0" style="border:2ch solid rgba(125, 125, 125, 1); opacity: 1;">
    <div class="container" style="height: 75vh;">

        <?php require_once('./template/header-docente.php') ?>
        <h1 style="color: rgba(129, 129, 129, 1);">Capacitaciones disponibles</h1>
        <ul>
            <?php
            $currentInstitucion = null;

            foreach ($listaCapacitaciones as $capacitacion) {
                $institucion = $capacitacion['nombre_institucion'];
                $nombreCapacitacion = $capacitacion['nombre_capacitacion'];

                if ($institucion != $currentInstitucion) {
                    if ($currentInstitucion !== null) {
                        echo '</ul></div>';
                    }
                    echo '<div class="col-12 mt-4"><h3>' . $institucion . '</h3><ul>';
                }

                echo '<li style="margin-bottom: 10px; font-size: 20px;" class="text-primary"><a href="?t=docente&p=detalle-capacitacion&id=' . $capacitacion['id_capacitacion'] . '">';
                echo $nombreCapacitacion;
            ?>
                <span class="ms-5 badge <?php if (haPasadoFecha($capacitacion['fecha_fin_capacitacion'])) {
                                            echo 'bg-danger';
                                        } else if (haPasadoFecha($capacitacion['fecha_inicio_capacitacion'])) {
                                            echo 'bg-success';
                                        } else {
                                            echo 'bg-warning';
                                        } ?>">
                    <?php if (haPasadoFecha($capacitacion['fecha_fin_capacitacion'])) {
                        echo 'FINALIZADO';
                    } else if (haPasadoFecha($capacitacion['fecha_inicio_capacitacion'])) {
                        echo 'ACTIVO';
                    } else {
                        echo 'AUN NO INICIÓ';
                    } ?>
                </span>
            <?php
                echo '</a></li>';

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