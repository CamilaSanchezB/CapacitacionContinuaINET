<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Capacitación continua INET</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php include('./config/db-connection.php') ?>
    <?php

if (isset($_GET['id'])) {
    try {
        $listaDocentes = [];
        $id = $_GET['id'];
        
        // Use a prepared statement with placeholders
        $sentenciaSQL = $conexion->prepare("SELECT * FROM `detalle_docente`
        INNER JOIN `docentes` ON  `detalle_docente`.`id_docente` = `docentes`.`id_docente`
        INNER JOIN `instituciones` ON  `detalle_docente`.`id_institucion` = `instituciones`.`id_institucion`
        INNER JOIN `usuarios` ON `docentes`.`id_usuario` = `usuarios`.`id_usuario`
        WHERE `detalle_docente`.`id_docente` = :id");
        
        // Bind the parameter
        $sentenciaSQL->bindParam(':id', $id, PDO::PARAM_INT);
        
        $sentenciaSQL->execute();
        $listaDocentes = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
        
        if (!empty($listaDocentes)) {
            $primerElemento = array_shift($listaDocentes);
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    include('./functions/cerrarsesion.php');
} ?>
    <?php require_once('./template/header-administrador.php')?>
    <div class="container" style="min-height: 50vh;">
    
        <h1 style="color: rgba(129, 129, 129, 1);">Datos del docente</h1>
        <hr class="col-5">
        <div class="col-7 text-break h4" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;">Nombre y apellido: <?php echo $primerElemento['nombre_docente'] ?> <?php echo $primerElemento['apellido_docente'] ?></div>
        <div class="col-7 text-break h4" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;">DNI: <?php echo $primerElemento['dni_docente'] ?></div>
        <div class="col-7 text-break h4" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;">Correo electrónico: <?php echo $primerElemento['email_usuario'] ?></div>
        <h1 class="mt-5" style="color: rgba(129, 129, 129, 1);">Capacitaciones</h1>
        <hr class="col-5">
        <?php
        try {
            $listaCapacitaciones = [];
            
            // Use a prepared statement with placeholders
            $sentenciaSQL = $conexion->prepare("SELECT * FROM `detalle_capacitaciones`
            INNER JOIN `docentes` ON  `detalle_capacitaciones`.`id_docente` = `docentes`.`id_docente`
            INNER JOIN `capacitaciones` ON  `detalle_capacitaciones`.`id_capacitacion` = `capacitaciones`.`id_capacitacion`
            WHERE `detalle_capacitaciones`.`id_docente` = :id");
            
            // Bind the parameter
            $sentenciaSQL->bindParam(':id', $id, PDO::PARAM_INT);
            
            $sentenciaSQL->execute();
            $listaCapacitaciones = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        if($listaCapacitaciones){
            foreach ($listaCapacitaciones as $capacitacion) { ?>
                <div class="col-12 text-break h5" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;">
                    <a href='?t=administrador&p=capacitaciones/detalleCapacitacion&id=<?php echo $capacitacion['id_capacitacion'] ?>' class="text-primary">
                        <?php echo $capacitacion['nombre_capacitacion'] ?>
                    </a>
                    <span class="ms-5 badge <?php if($capacitacion['estado_capacitacion'] == 0){echo 'bg-success';}else{echo 'bg-danger';}?>"><?php if($capacitacion['estado_capacitacion'] == 0){echo 'ACTIVO';}else{echo 'FINALIZADO';}?></span>
                </div>
        <?php
            }
        }else{
            echo "No realizó capacitaciones";
        }
            ?>
    </div>
    </div>
</div>
    <?php $conexion = null; ?>
</body>

</html>