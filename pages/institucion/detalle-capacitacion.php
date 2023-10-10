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
        try {
            $listaCapacitaciones = [];
            $id = $_GET['id'];
            $sentenciaSQL = $conexion->prepare("SELECT * FROM `capacitaciones`
            INNER JOIN `instituciones` ON `capacitaciones`.`id_institucion` = `instituciones`.`id_institucion`
            INNER JOIN `localidades` ON `instituciones`.`id_localidad` = `localidades`.`id_localidad`
            INNER JOIN `provincias` ON `localidades`.`id_provincia` = `provincias`.`id_provincia`
            INNER JOIN `tipos_educacion` ON `capacitaciones`.`id_tipo_educacion` = `tipos_educacion`.`id_tipo_educacion`
            WHERE `capacitaciones`.`id_capacitacion` = '$id'");
            $sentenciaSQL->execute();
            $listaCapacitaciones = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($listaCapacitaciones)) {
                $primerElemento = array_shift($listaCapacitaciones);
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } ?>

    <?php 
    if(isset($_POST['Eliminar'])){
        $id_capacitacion = $_POST['Eliminar'];
        try{
            $sentenciaSQL = $conexion ->prepare("DELETE FROM  `capacitaciones` WHERE `id_capacitacion` = '$id_capacitacion'");
        $sentenciaSQL->execute();
        header("Location: ?t=institucion&p=capacitacion-instituciones");
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }
    ?>

    <hr class="mt-0" style="border:2ch solid rgba(125, 125, 125, 1); opacity: 1;">
    <div class="container">
        <div class="row mt-3 d-flex align-items-center justify-content-end">
            <div class="col-2">
                <button type="button" class="btn btn-block" style="background-color: rgba(19, 140, 232, 1);  color: rgba(77, 74, 74, 1);width: 100%;">
                    <i class="fas fa-check"></i> Institución
                </button>
            </div>
        </div>
        <div class="row d-flex align-items-center">
            <div class="col-3">
                <img src="./assets/image/logo-inet.png" class="img-fluid">
            </div>
            <div class="col-3 d-flex justify-content-end align-items-center" style="height: 6ch;">
                <button type="button" class="btn shadow-sm" style="height: 80%;width: 80% ;background-color: rgba(217, 217, 217, 0.42);  color: rgba(188, 182, 182, 1);">
                    <i class="fas fa-check"></i> Capacitaciones
                </button>
            </div>
            <div class="col-3 d-flex justify-content-end align-items-center" style="height: 6ch;">
                <button type="button" class="btn shadow-sm" style="height: 80%;width: 80% ;background-color: rgba(217, 217, 217, 0.42);  color: rgba(188, 182, 182, 1);">
                    <i class="fas fa-check"></i> Crear Capacitaciones
                </button>
            </div>
            <div class="col-3 d-flex justify-content-end align-items-center" style="height: 6ch;">
                <button type="button" class="btn shadow-sm" style="height: 80%;width: 80% ;background-color: rgba(217, 217, 217, 0.42);  color: rgba(188, 182, 182, 1);">
                    <i class="fas fa-check"></i> Docentes
                </button>
            </div>
        </div>
        <hr style="border:2ch solid rgba(12, 104, 174, 1); opacity: 1;">
        <h1 style="color: rgba(129, 129, 129, 1);">Capacitaciones</h1>
        <div class="col-12 h5 mt-4" style="color: rgba(137, 137, 137, 1);">
            <?php echo $primerElemento['nombre_capacitacion'] ?>
            <span class="badge <?php if(haPasadoFecha($primerElemento['fecha_fin_capacitacion'])){echo 'bg-danger';}else{echo 'bg-success';} ?>"><?php if(haPasadoFecha($primerElemento['fecha_fin_capacitacion'])){echo 'FINALIZADO';}else{echo 'ACTIVO';} ?></span>
        </div>
        <div class="col-6 h5 mt-3" style="color: rgba(137, 137, 137, 1);">
            Tipo de educación: <?php echo $primerElemento['desc_tipo_educacion'] ?>
        </div>
        <div class="col-3 h5 mt-3" style="color: rgba(137, 137, 137, 1);">
            Fecha de inicio: <?php $dateTime = new DateTime($primerElemento['fecha_inicio_capacitacion']);
                                $formattedDateTime = $dateTime->format("d/m/y H:i");
                                echo $formattedDateTime ?>
        </div>
        <div class="col-12 h5 mt-3" style="color: rgba(137, 137, 137, 1);">
            Fecha de finalización: <?php $dateTime = new DateTime($primerElemento['fecha_fin_capacitacion']);
                                    $formattedDateTime = $dateTime->format("d/m/y H:i");
                                    echo $formattedDateTime ?>
        </div>
        <div class="col-12 h5 mt-3" style="color: rgba(137, 137, 137, 1);">
            Dias y horarios: <?php echo $primerElemento['dias_horarios_capacitacion']?>
        </div>
        
        <div class="col-3 h5 mt-3" style="color: rgba(137, 137, 137, 1);">
            Modalidad: <?php echo $primerElemento['modalidad_capacitacion']?>
        </div>
        <div class="col-3 h5 mt-3" style="color: rgba(137, 137, 137, 1);">
            Lugar/Plataforma: <?php echo $primerElemento['lugar_o_plataforma_capacitacion']?>
        </div>
        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-center">
                <form method="POST">
                    <button class="btn btn-lg btn-danger shadow mb-5" name="Eliminar" value="<?php echo $primerElemento['id_capacitacion']?>">Eliminar capacitación</button>
                </form>
            </div>
            
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>