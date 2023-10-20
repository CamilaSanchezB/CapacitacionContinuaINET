<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Capacitacion continua</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>

    <hr class="mt-0" style="border:2ch solid rgba(125, 125, 125, 1); opacity: 1;">

    <div class="container" style="min-height: 75vh">
        <?php require_once('./template/header-docente.php') ?>
        <?php
        include('./config/db-connection.php');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Almacena los datos POST en variables
            $contribucion = $_POST['contribucion'];
            $calidad_material = $_POST['calidad_material'];
            $multiplicador = $_POST['multiplicador'];
            $acompanamiento = $_POST['acompanamiento'];
            $sugerencias = $_POST['sugerencias'];

            try {
                $sentenciaSQL_idDetalleCapacitacion = $conexion->prepare("SELECT `id_detalle_capacitacion` FROM detalle_capacitaciones WHERE `id_docente` = :id_docente AND `id_capacitacion` = :id_capacitacion");
                $sentenciaSQL_idDetalleCapacitacion->bindParam(":id_docente", $_POST['id_docente']);
                $sentenciaSQL_idDetalleCapacitacion->bindParam(":id_capacitacion", $_POST['id_capacitacion']);
                $sentenciaSQL_idDetalleCapacitacion->execute();
                $resultado_idDetalleCapacitacion = $sentenciaSQL_idDetalleCapacitacion->fetch(PDO::FETCH_ASSOC);
            }catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            $id_detalle_capacitacion = $resultado_idDetalleCapacitacion['id_detalle_capacitacion'];
            try {
                $sentenciaSQL = $conexion->prepare("INSERT INTO  `respuestas_docentes` 
                (`id_detalle_capacitacion`, `respuesta_contribucion`, `respuesta_calidad`, `respuesta_multiplicador`, `respuesta_acompanamiento`, `sugerencia`)
                VALUES ('$id_detalle_capacitacion', '$contribucion', '$calidad_material', '$multiplicador', '$acompanamiento', '$sugerencias')");
                $sentenciaSQL->execute();

                $sentenciaSQL = $conexion->prepare("UPDATE  `detalle_capacitaciones` SET `estado_respuesta` = '1' WHERE `id_detalle_capacitacion` = '$id_detalle_capacitacion'");
                $sentenciaSQL->execute();

                header("Location: ?t=docente&p=listado-mis-capacitaciones");
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }


        }
        ?>
    </div>
</body>

</html>