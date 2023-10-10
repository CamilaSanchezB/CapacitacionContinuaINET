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
    } 
    
    if(isset($_POST['Validar'])){
        $id_institucion = $_POST['Validar'];
        $sentenciaSQL = $conexion -> prepare("UPDATE `instituciones` SET `estado_validacion_institucion` = '1' WHERE `id_institucion` = '$id_institucion'");
        $sentenciaSQL->execute();
        echo "<script>alert('Institución validada');window.location.replace('')</script>";
    }
    include('./functions/cerrarsesion.php');
    ?>
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
                <a href='?t=administrador&p=listadoETP' class="btn shadow-sm" style="height: 80%;width: 80% ;background-color: #e0e0e0;  color: light-grey;">
                    <i class="fas fa-check"></i> Instituciones
                </a>
            </div>
            <div class="col-2 d-flex justify-content-end align-items-center" style="height: 6ch;">
                <a href='?t=administrador&p=listadoDocente' class="btn shadow-sm" style="height: 80%;width: 80% ;background-color: rgba(19, 140, 232, 1);  color: white;">
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
        <h1 style="color: rgba(129, 129, 129, 1);">Validar instituciones</h1>
        <hr class="col-5">
        <div class="col-12 text-break h3" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;"><?php echo $primerElemento['nombre_institucion'] ?>, <?php echo $primerElemento['nombre_localidad']?>, <?php echo $primerElemento['nombre_provincia']?></div>
        <div class="col-7 text-break h4" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;">Teléfono: <?php echo $primerElemento['telefono_institucion'] ?></div>
        <div class="col-7 text-break h4" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;">Correo electrónico: <?php echo $primerElemento['email_usuario'] ?></div>
        <div class="col-7 text-break h4" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;">CUE: <?php echo $primerElemento['cue_institucion'] ?></div>
        <div class="col-7 text-break h4" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;">Domicilio: <?php echo $primerElemento['nombre_institucion'] ?></div>
        <h3 class="mt-5" style="color: rgba(129, 129, 129, 1);">Datos del representate institucional</h3>
        <hr class="col-5">
        <div class="col-7 text-break h4" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;">Nombre y apellido: <?php echo $primerElemento['nombre_representante'] ?> <?php echo $primerElemento['apellido_representante'] ?></div>
        <div class="col-7 text-break h4" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;">DNI: <?php echo $primerElemento['dni_representante'] ?></div>
        <div class="col-7 text-break h4" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;">Teléfono: <?php echo $primerElemento['telefono_representante'] ?></div>

        <form method="POST">

        <button type="submit" value="<?php echo $primerElemento['id_institucion'] ?>" name="Validar" class="btn shadow-sm btn-secondary mt-5" style=" width: 20%">
            Validar
        </button>
        </form>
    </div>
    <?php $conexion = null; ?>
</body>

</html>