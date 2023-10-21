<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Capacitación continua INET</title>
    <?php require_once('./functions/chart/institucion/inicializar-chart.php') ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php include('./config/db-connection.php') ?>
    <?php
     try {
        $sentenciaSQL = "SELECT `sugerencia` FROM `respuestas_institucion` WHERE `sugerencia` IS NOT NULL AND `sugerencia` <> '';";
        $sentenciaSQL = $conexion->prepare($sentenciaSQL);
        $sentenciaSQL->execute();

        $sugerencias = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    include('./functions/cerrarsesion.php');
    ?>
    <?php require_once('./template/header-administrador.php') ?>
    <div class="container" style="min-height: 50vh;">
        <?php require_once('./template/chart-render-graficos.php') ?>
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
            } ?>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <?php $conexion = null; ?>
</body>

</html>
