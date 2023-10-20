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
    $listaCapacitaciones = [];
    $sentenciaSQL = $conexion->prepare("SELECT * FROM `respuestas_institucion`");
    $sentenciaSQL->execute();
    $listaCapacitaciones = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
    var_dump($listaCapacitaciones);
    include('./functions/cerrarsesion.php');
    ?>
    <?php require_once('./template/header-administrador.php') ?>
    <div class="container" style="min-height: 50vh;">
        <div class="d-flex justify-content-between align-items-center">
            <h1 style="color: rgba(129, 129, 129, 1);">Estadísticas generales de las capacitaciones</h1>
        </div>


        
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <?php $conexion = null; ?>
</body>

</html>