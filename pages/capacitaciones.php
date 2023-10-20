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

    if (isset($_GET['id'])) {
        include('./functions/obtenerDetalleCapacitacion.php');
        $primerElemento=obtenerDetalleCapacitacion($_GET['id']);
    } ?>
    <hr class="mt-0" style="border:2ch solid rgba(125, 125, 125, 1); opacity: 1;">
    <div class="container" style="min-height: 75vh;">
    <?php require_once('./template/header-inicio.php')?>
        <h1 style="color: rgba(129, 129, 129, 1);">Cursos de capacitación <span class="ms-5 badge bg-<?php if(haPasadoFecha($primerElemento['fecha_fin_capacitacion'])){echo 'danger';}else if(haPasadoFecha($primerElemento['fecha_inicio_capacitacion'])){echo 'secondary';}else{echo 'success';}?>"><?php if(haPasadoFecha($primerElemento['fecha_fin_capacitacion'])){echo 'Finalizada';}else if(haPasadoFecha($primerElemento['fecha_inicio_capacitacion'])){echo 'Iniciada';}else{echo 'Abierta';}?></span></h1>
        <hr class="col-5">
        <div class="col-7 text-break h3" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;"><?php echo $primerElemento['nombre_capacitacion'] ?></div>
        <div class="col-7 text-break h4" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;">Institución: <?php echo $primerElemento['nombre_institucion'] ?>, <?php echo $primerElemento['nombre_localidad']?>, <?php echo $primerElemento['nombre_provincia']?></div>
        <div class="col-7 text-break h4" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;">Tipo de educación: <?php echo $primerElemento['desc_tipo_educacion'] ?></div>
        <div class="col-7 text-break h4" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;">Fecha de inicio: <?php $dateTime = new DateTime($primerElemento['fecha_inicio_capacitacion']);$formattedDateTime = $dateTime->format("d/m/Y"); echo $formattedDateTime ?></div>
        <div class="col-7 text-break h4" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;">Fecha de finalización: <?php $dateTime = new DateTime($primerElemento['fecha_fin_capacitacion']);$formattedDateTime = $dateTime->format("d/m/Y"); echo $formattedDateTime ?></div>
        <div class="col-7 text-break h4" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;">Días y horarios: <?php echo $primerElemento['dias_horarios_capacitacion'] ?></div>
        <div class="col-7 text-break h4" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;">Modalidad: <?php echo $primerElemento['modalidad_capacitacion'] ?></div>
        <div class="col-7 text-break h4" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;">Lugar / plataforma: <?php echo $primerElemento['lugar_o_plataforma_capacitacion'] ?></div>

    </div>
    <?php $conexion = null; ?>
</body>

</html>