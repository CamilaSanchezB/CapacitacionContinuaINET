<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php
    include('./config/db-connection.php');


    $id_usuario = $_SESSION['usuario']['id_usuario'];

    // Primera consulta para obtener id_institucion
    $sentenciaSQL_idInstitucion = $conexion->prepare("SELECT `id_institucion` FROM instituciones WHERE `id_usuario` = :id_usuario");
    $sentenciaSQL_idInstitucion->bindParam(":id_usuario", $id_usuario);
    $sentenciaSQL_idInstitucion->execute();
    $resultado_idInstitucion = $sentenciaSQL_idInstitucion->fetch(PDO::FETCH_ASSOC);

    $listadoDocentesNoValidados = [];
    $listadoDocentesValidados = [];
    // Consulta para obtener docentes agrupados por especialidad
    try {
        $sentenciaSQL = $conexion->prepare("SELECT e.`id_especialidad`,e.`nombre_especialidad`, d.`id_docente`, d.`nombre_docente`, d.`apellido_docente`, d.`dni_docente`
        FROM `detalle_docente` dd
        INNER JOIN `docentes` d ON dd.`id_docente` = d.`id_docente`
        INNER JOIN `especialidades` e ON dd.`id_especialidad` = e.`id_especialidad`
        WHERE `estado_validacion_docente` = '1' AND dd.`id_institucion` = :id_institucion
        ORDER BY e.`nombre_especialidad`");
        $sentenciaSQL->bindParam(":id_institucion", $resultado_idInstitucion['id_institucion']);
        $sentenciaSQL->execute();
        $listadoDocentesValidados = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error al obtener docentes: " . $e->getMessage();
    }
    try {
        $sentenciaSQL = $conexion->prepare("SELECT e.`id_especialidad`, e.`nombre_especialidad`, d.`id_docente`, d.`nombre_docente`, d.`apellido_docente`, d.`dni_docente`
        FROM `detalle_docente` dd
        INNER JOIN `docentes` d ON dd.`id_docente` = d.`id_docente`
        INNER JOIN `especialidades` e ON dd.`id_especialidad` = e.`id_especialidad`
        WHERE `estado_validacion_docente` = '0' AND dd.`id_institucion` = :id_institucion
        ORDER BY e.`nombre_especialidad`");
        $sentenciaSQL->bindParam(":id_institucion", $resultado_idInstitucion['id_institucion']);
        $sentenciaSQL->execute();
        $listadoDocentesNoValidados = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error al obtener docentes: " . $e->getMessage();
    }
    ?>


<hr class="mt-0" style="border:2ch solid rgba(125, 125, 125, 1); opacity: 1;">
    <div class="container" style="min-height: 75vh;">
        <?php require_once('./template/header-institucion.php') ?>
        <h1 style="color: rgba(129, 129, 129, 1);">Docentes</h1>
        <div class="row">
        <div class="col-6">
        <div class="h5" style="color: rgba(129, 129, 129, 1);">Validados</div>

        <?php
            // Variable para mantener el registro de la especialidad actual
            $currentEspecialidad = null;

            foreach ($listadoDocentesValidados as $docente) {
                $especialidad = $docente['nombre_especialidad'];

                // Si la especialidad actual es diferente de la anterior, muestra un nuevo encabezado
                if ($especialidad != $currentEspecialidad) {
                    if ($currentEspecialidad !== null) {
                        echo '</ol>'; // Cierre de la lista de docentes y div
                    }
                    echo '<h2>' . $especialidad . '</h2><ol>';
                }

                // Muestra los datos del docente
                echo '<li style="margin-bottom: 10px; font-size: 20px;" class="text-primary">';
                echo '<a href="?t=institucion&p=detalle-docente&id=' . $docente['id_docente'] . '" class="text-primary">';
                echo $docente['nombre_docente'] . ' ' . $docente['apellido_docente'] . ' DNI: ' . $docente['dni_docente'];
                echo '</a></li>';

                // Actualiza la especialidad actual
                $currentEspecialidad = $especialidad;
            }

            if (empty($listadoDocentesValidados)) {
                echo 'No hay docentes validados';
            }

            echo '</ol>'; // Cierre final
            ?>
      </div>
      <div class="col-6">
        <div style="color: rgba(129, 129, 129, 1);" class="h5">No Validados</div>
        <?php
            // Variable para mantener el registro de la especialidad actual
            $currentEspecialidad = null;

            foreach ($listadoDocentesNoValidados as $docente) {
                $especialidad = $docente['nombre_especialidad'];

                // Si la especialidad actual es diferente de la anterior, muestra un nuevo encabezado
                if ($especialidad != $currentEspecialidad) {
                    if ($currentEspecialidad !== null) {
                        echo '</ol>'; // Cierre de la lista de docentes y div
                    }
                    echo '<h2>' . $especialidad . '</h2><ol>';
                }

                // Muestra los datos del docente
                echo '<li style="margin-bottom: 10px; font-size: 20px;" class="text-primary">';
                echo '<a href="?t=institucion&p=detalle-validar-docente&id=' . $docente['id_docente'] . '&idE='. $docente['id_especialidad'] .'" class="text-primary">';
                echo $docente['nombre_docente'] . ' ' . $docente['apellido_docente'] . ' DNI: ' . $docente['dni_docente'];
                echo '</a></li>';

                // Actualiza la especialidad actual
                $currentEspecialidad = $especialidad;
            }

            if (empty($listadoDocentesNoValidados)) {
                echo 'No hay docentes para validar';
            }

            echo '</ol>'; // Cierre final
            ?>
      </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>