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
    include ('./functions/fechaPasada.php'); ?>
    <?php

    if (isset($_GET['id'])) {
        try {
            $listaInstituciones = [];
            $id = $_GET['id'];
            $sentenciaSQL = $conexion->prepare("SELECT * FROM `instituciones`
            INNER JOIN `representantes_institucionales` ON `instituciones`.`id_representante` = `representantes_institucionales`.`id_representante`
            INNER JOIN `localidades` ON `instituciones`.`id_localidad` = `localidades`.`id_localidad`
            INNER JOIN `provincias` ON `localidades`.`id_provincia` = `provincias`.`id_provincia`
            INNER JOIN `usuarios` ON `instituciones`.`id_usuario` = `usuarios`.`id_usuario`
            WHERE `id_institucion` = '$id'");
            $sentenciaSQL->execute();
            $listaInstituciones = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($listaInstituciones)) {
                $primerElemento = array_shift($listaInstituciones);
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $listaCapacitaciones = [];
        try {
            $sentenciaSQL = $conexion->prepare("SELECT * FROM `capacitaciones` WHERE `id_institucion` = :id_institucion");
            $sentenciaSQL->bindParam(":id_institucion", $_GET['id']);
            $sentenciaSQL->execute();
            $listaCapacitaciones = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        include('./functions/cerrarsesion.php');
    } ?>
    <?php require_once('./template/header-administrador.php') ?>
    <div class="container" style="min-height: 50vh;">

        <h1 style="color: rgba(129, 129, 129, 1);">Datos de la institución</h1>
        <hr class="col-5">
        <div class="col-12 text-break h3" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;"><?php echo $primerElemento['nombre_institucion'] ?>, <?php echo $primerElemento['nombre_localidad'] ?>, <?php echo $primerElemento['nombre_provincia'] ?></div>
        <div class="col-7 text-break h4" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;">Teléfono: <?php echo $primerElemento['telefono_institucion'] ?></div>
        <div class="col-7 text-break h4" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;">Correo electrónico: <?php echo $primerElemento['email_usuario'] ?></div>
        <div class="col-7 text-break h4" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;">CUE: <?php echo $primerElemento['cue_institucion'] ?></div>
        <div class="col-7 text-break h4" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;">Domicilio: <?php echo $primerElemento['nombre_institucion'] ?></div>
        <h3 class="mt-5" style="color: rgba(129, 129, 129, 1);">Datos del representate institucional</h3>
        <hr class="col-5">
        <div class="col-7 text-break h4" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;">Nombre y apellido: <?php echo $primerElemento['nombre_representante'] ?> <?php echo $primerElemento['apellido_representante'] ?></div>
        <div class="col-7 text-break h4" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;">DNI: <?php echo $primerElemento['dni_representante'] ?></div>
        <div class="col-7 text-break h4" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;">Teléfono: <?php echo $primerElemento['telefono_representante'] ?></div>
        <hr class="col-5 mt-5">
        <h3 class="text-secondary">Capacitaciones brindadas:</h3>
        <?php
        if (!empty($listaCapacitaciones)) {
        ?>
            <ul>
                <?php
                foreach ($listaCapacitaciones as $capacitacion) { ?>
                    <li style="margin-bottom: 10px; font-size: 20px;" class="text-primary">
                        <a href="?t=administrador&p=capacitaciones/detalleCapacitacion&id=<?php echo $capacitacion['id_capacitacion']?>">
                        <?php echo $capacitacion['nombre_capacitacion']?>   
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
                    </a>
                    </li>
                <?php }
                ?>

            </ul>
        <?php
        }
        ?>
    </div>
    </div>
    <?php $conexion = null; ?>
</body>

</html>