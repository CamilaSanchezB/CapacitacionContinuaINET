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
    <hr class="mt-0" style="border:2ch solid rgba(125, 125, 125, 1); opacity: 1;">
    <div class="container" style="min-height: 75vh;">
    <div class="col-2 mb-5">
        <form method="POST">
          <button name="eliminar" value="eliminar" type="submit" class="btn btn-block" style="background-color: #e0e0e0;  color: rgba(77, 74, 74, 1);width: 100%;">
            <i class="fas fa-check"></i> Administrador
            <image src="./assets/image/logout.png" class="img-fluid" width="10%" height="10%" />
          </button>
        </form>

      </div>
        <div class="row d-flex align-items-center">
            <div class="col-6">
                <img src="./assets/image/logo-inet.png" class="img-fluid">
            </div>
            <div class="col-2 d-flex justify-content-end align-items-center" style="height: 6ch;">
                <a href='?t=administrador&p=listadoETP' class="btn shadow-sm" style="height: 80%;width: 80% ;background-color: rgba(19, 140, 232, 1);  color: white;">
                    <i class="fas fa-check"></i> Instituciones
                </a>
            </div>
            <div class="col-2 d-flex justify-content-end align-items-center" style="height: 6ch;">
                <a href='?t=administrador&p=listadoDocente' class="btn shadow-sm" style="height: 80%;width: 80% ;background-color: #e0e0e0;  color: light-grey;">
                    <i class="fas fa-check"></i> Docentes
                </a>
            </div>
            <div class="col-2 d-flex justify-content-end align-items-center" style="height: 6ch;">
                <a href='?t=administrador&p=listadoCapacitaciones' class="btn shadow-sm" style="height: 80%;width: 80% ;background-color: rgba(19, 140, 232, 1);  color: white;">
                    <i class="fas fa-check"></i> Capacitaciones
                </a>
            </div>
        </div>
        <hr style="border:2ch solid rgba(12, 104, 174, 1); opacity: 1;">
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
                    <a href='?t=administrador&p=detalleCapacitacion&id=<?php echo $capacitacion['id_capacitacion'] ?>' class="text-primary">
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
    <?php $conexion = null; ?>
</body>

</html>