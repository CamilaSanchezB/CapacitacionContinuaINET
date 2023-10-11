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
    session_start();
    $id_usuario = $_SESSION['usuario']['id_usuario'];

    $id_institucion = 1; // Reemplaza con el ID de la institución específica
    
    $listaCapacitaciones = [];
    try {
        $sentenciaSQL = $conexion->prepare("SELECT c.id_capacitacion, c.nombre_capacitacion, i.nombre_institucion
        FROM `capacitaciones` c
        INNER JOIN `instituciones` i ON c.id_institucion = i.id_institucion
        WHERE c.id_institucion = :id_institucion
            AND c.fecha_inicio_capacitacion > CURDATE()
        ");
        $sentenciaSQL->bindParam(":id_institucion", $id_institucion);
        $sentenciaSQL->execute();
        $listaCapacitaciones = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>
    <hr class="mt-0" style="border:2ch solid rgba(125, 125, 125, 1); opacity: 1;">
    <div class="container" style="height: 75vh;">

        <?php require_once('./template/header-docente.php') ?>
        <h1 style="color: rgba(129, 129, 129, 1);">Capacitaciones disponibles</h1>
        <ul>
            <?php
            $currentInstitucion = null;

            foreach ($listaCapacitaciones as $capacitacion) {
                $institucion = $capacitacion['nombre_institucion'];
                $nombreCapacitacion = $capacitacion['nombre_capacitacion'];

                if ($institucion != $currentInstitucion) {
                    if ($currentInstitucion !== null) {
                        echo '</ul></div></div>';
                    }
                    echo '<div class="col-12 mt-4"><h3>' . $institucion . '</h3><ul>';
                }

                echo '<li style="margin-bottom: 10px; font-size: 20px;" class="text-primary"><a href="?t=docente&p=detalle-capacitacion&id='.$capacitacion['id_capacitacion'].'">';
                echo $nombreCapacitacion;
                echo '</a></li>';

                $currentInstitucion = $institucion;
            }
            ?>
        </ul>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <?php $conexion = null; ?>
</body>

</html>