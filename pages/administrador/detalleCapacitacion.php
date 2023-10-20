<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php include('./config/db-connection.php') ?>
    <?php
    include('./functions/fechaPasada.php');
    if (isset($_GET['id'])) {
        include('./functions/obtenerDetalleCapacitacion.php');
        $primerElemento = obtenerDetalleCapacitacion($_GET['id']);
        try {
            $sentenciaSQL = $conexion->prepare("SELECT * FROM `respuestas_institucion` WHERE `id_capacitacion` = ?");
            $sentenciaSQL->execute([$_GET['id']]);
            $respuestas = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    include('./functions/cerrarsesion.php');


    ?>
    <?php require_once('./template/header-administrador.php') ?>

    <?php require_once('./template/capacitacionDetallada.php') ?>
    <hr class="col-7" />
    <h1 class="text-secondary">Impacto pedagógico</h1>
    <?php
    if (!empty($respuestas)) {  ?>
        <table class="table table-striped mt-4">

            <tbody>
                <tr>
                    <th>¿Considera que las/los docentes que realizaron la capacitación fueron buenos replicadores?</th>
                    <td><?php echo $respuestas['respuesta_realizacion'] ?></td>
                </tr>
                <tr>
                    <th>¿Considera que las/los docentes aplicaron lo visto, generando un impacto pedagógico?</th>
                    <td><?php echo $respuestas['respuesta_aplicacion'] ?></td>
                </tr>
                <tr>
                    <th>¿Considera que debe continuar la capacitación recibida en la especialidad elegida?</th>
                    <td><?php echo $respuestas['respuesta_continuar'] ?></td>
                </tr>
                <tr>
                    <th>¿Su institución formaría parte de réplica para otras,en base a los docentes que considere aptos?</th>
                    <td><?php echo $respuestas['respuesta_replica'] ?></td>
                </tr>
                <tr>
                    <th>Sugerencias o cambios</th>
                    <td><?php echo ($respuestas['sugerencia'] != '') ? $respuestas['sugerencia'] : 'Ninguna' ?></td>
                </tr>
            </tbody>
        </table>
        <?php } else {?>
        <div class="mt-3">
            No completó el formulario
            <div class="d-flex justify-content-center"><button type="button" class="btn btn-warning text-dark">Enviar mail de aviso</button></div>
        </div>       
        
        <?php
        }
            ?>
        </div>

        <?php $conexion = null; ?>
</body>

</html>