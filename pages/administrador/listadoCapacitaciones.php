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
    $listaProvincias = [];
    $sentenciaSQL = $conexion->prepare("SELECT * FROM `provincias`");
    $sentenciaSQL->execute();
    $listaProvincias = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <hr class="mt-0" style="border:2ch solid rgba(125, 125, 125, 1); opacity: 1;">
    <div class="container">

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
                <a href='?t=administrador&p=listadoDocente' class="btn shadow-sm" style="height: 80%;width: 80% ;background-color: rgba(19, 140, 232, 1);  color: white;">
                    <i class="fas fa-check"></i> Docentes
                </a>
            </div>
            <div class="col-2 d-flex justify-content-end align-items-center" style="height: 6ch;">
                <a href='?t=administrador&p=listadoCapacitaciones' class="btn shadow-sm" style="height: 80%;width: 80% ;background-color: #e0e0e0;  color: light-grey;">
                    <i class="fas fa-check"></i> Capacitaciones
                </a>
            </div>
        </div>
        <hr style="border:2ch solid rgba(12, 104, 174, 1); opacity: 1;">
        <h1 style="color: rgba(129, 129, 129, 1);">Capacitaciones </h1>

        <ol>
            <?php
            if (!empty($listaProvincias)) {
                foreach ($listaProvincias as $provincia) { ?>
                    <li style="margin-bottom: 10px; font-size: 20px;" class="text-primary">
                        <a href='?t=administrador&p=detalleCapacitacion&id=<?php echo $provincia['id_provincia'] ?>' class="text-primary">
                            <?php echo $provincia['nombre_provincia'] ?>
                        </a>
                    </li>
            <?php
                }
            } else {
                echo 'No hay instituciones para validar';
            }
            ?>

        </ol>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <?php $conexion = null; ?>
</body>

</html>