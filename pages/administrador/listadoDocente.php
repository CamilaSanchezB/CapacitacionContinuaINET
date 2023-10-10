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
    $listaInstituciones = [];
    $sentenciaSQL = $conexion->prepare("SELECT DISTINCT i.id_institucion, i.nombre_institucion FROM `detalle_docente` dd
    INNER JOIN `docentes` d ON dd.`id_docente` = d.`id_docente`
    INNER JOIN `instituciones` i ON dd.`id_institucion` = i.`id_institucion`
    INNER JOIN `especialidades` e ON dd.`id_especialidad` = e.`id_especialidad`");
    $sentenciaSQL->execute();
    $listaInstituciones = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
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
        <h1 style="color: rgba(129, 129, 129, 1);">Docentes </h1>

        <?php
        if (!empty($listaInstituciones)) {
            foreach ($listaInstituciones as $institucion) {
                echo '<h2>' . $institucion['nombre_institucion'] . '</h2>';

                $sentenciaSQL = $conexion->prepare("SELECT DISTINCT e.id_especialidad, e.nombre_especialidad FROM `detalle_docente` dd
        INNER JOIN `docentes` d ON dd.`id_docente` = d.`id_docente`
        INNER JOIN `instituciones` i ON dd.`id_institucion` = i.`id_institucion`
        INNER JOIN `especialidades` e ON dd.`id_especialidad` = e.`id_especialidad`
        WHERE i.id_institucion = ?");
                $sentenciaSQL->execute([$institucion['id_institucion']]);
                $listaEspecialidades = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

                if (!empty($listaEspecialidades)) {
                    foreach ($listaEspecialidades as $especialidad) {
                        echo '<h3>' . $especialidad['nombre_especialidad'] . '</h3>';
                        $sentenciaSQL = $conexion->prepare("SELECT d.nombre_docente, d.id_docente, d.dni_docente, d.apellido_docente FROM `detalle_docente` dd
                        INNER JOIN `docentes` d ON dd.`id_docente` = d.`id_docente`
                        INNER JOIN `especialidades` e ON dd.`id_especialidad` = e.`id_especialidad`
                        WHERE e.id_especialidad = ?");
                        $sentenciaSQL->execute([$especialidad['id_especialidad']]);
                        $listaDocentes = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

                        if (!empty($listaDocentes)) {
                            echo '<ul>';
                            foreach ($listaDocentes as $docente) {
        ?>
                                <li><a href="?t=administrador&p=detalleDocente&id=<?php echo $docente['id_docente']; ?>"><?php echo $docente['apellido_docente']; ?> <?php echo $docente['nombre_docente']; ?> - DNI: <?php echo $docente['dni_docente']; ?></a></li>
        <?php
                            }
                            echo '</ul>';
                        } else {
                            echo 'No hay docentes para esta especialidad';
                        }
                    }
                } else {
                    echo 'No hay especialidades para esta institución';
                }
            }
        } else {
            echo 'No hay instituciones para mostrar';
        }
        ?>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <?php $conexion = null; ?>
</body>

</html>