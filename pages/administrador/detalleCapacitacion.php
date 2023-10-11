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
    <?php include('./config/db-connection.php') ?>
    <?php
    include('./functions/fechaPasada.php');
    if (isset($_GET['id'])) {
        include('./functions/obtenerDetalleCapacitacion.php');
        $primerElemento=obtenerDetalleCapacitacion($_GET['id']);
    }
    include('./functions/cerrarsesion.php');
    
    
    ?>
    <?php require_once('./template/header-administrador.php')?>

    <?php require_once('./template/capacitacionDetallada.php')?>
</div>
    <?php $conexion = null; ?>
</body>

</html>