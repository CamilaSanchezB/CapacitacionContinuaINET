<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Capacitación continua INET</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php
    include('./config/db-connection.php');
    try {
        $listaDocentes = [];
        $id = $_GET['id'];

        // Use a prepared statement with placeholders
        $sentenciaSQL = $conexion->prepare("SELECT * FROM `detalle_docente`
        INNER JOIN `docentes` ON  `detalle_docente`.`id_docente` = `docentes`.`id_docente`
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

    try {
        $listaEspecialidades = [];
        $id = $_GET['id'];

        // Use a prepared statement with placeholders
        $sentenciaSQL = $conexion->prepare("SELECT * FROM `detalle_docente`
        INNER JOIN `especialidades` ON `detalle_docente`.`id_especialidad` = `especialidades`.`id_especialidad`
        WHERE `detalle_docente`.`id_docente` = :id");

        // Bind the parameter
        $sentenciaSQL->bindParam(':id', $id, PDO::PARAM_INT);

        $sentenciaSQL->execute();
        $listaEspecialidades = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    try {
        $listaCapacitaciones = [];

        // Use a prepared statement with placeholders
        $sentenciaSQL = $conexion->prepare("SELECT * FROM `detalle_capacitaciones`
    INNER JOIN `docentes` ON  `detalle_capacitaciones`.`id_docente` = `docentes`.`id_docente`
    INNER JOIN `capacitaciones` ON  `detalle_capacitaciones`.`id_capacitacion` = `capacitaciones`.`id_capacitacion`
    WHERE `detalle_capacitaciones`.`id_docente` = :id");

        // Bind the parameter
        $sentenciaSQL->bindParam(':id', $_GET['id'], PDO::PARAM_INT);

        $sentenciaSQL->execute();
        $listaCapacitaciones = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    if (isset($_POST['Rechazar'])) {

        $ids = explode("-", $_POST['Rechazar']);
        try {
            $sentenciaSQL = $conexion->prepare("DELETE FROM `detalle_docente` WHERE `id_docente` = '$ids[0]' AND `id_institucion` = '$ids[1]' AND `id_especialidad` = '$ids[2]'");
            $sentenciaSQL->execute();
            header("Location: ?t=institucion&p=docentes-validar");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    ?>
    <hr class="mt-0" style="border:2ch solid rgba(125, 125, 125, 1); opacity: 1;">
    <div class="container">
        <?php require_once('./template/header-institucion.php'); ?>
        <h1 style="color: rgba(129, 129, 129, 1);font-weight: normal; ">Docente</h1>
        <div class="col-7 h3" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;">Datos</div>
        <div class="form-group row mt-4 d-flex align-items-center justify-content-start">
            <label for="nombre" class="col-sm-3 col-form-label text-secondary d-flex align-items-center">
                <h3>Nombre y apellido</h3>
            </label>
            <div class="col-sm-6">
                <div class="form-control d-flex justify-content-start align-items-center">
                    <h4>
                        <?php echo $primerElemento['nombre_docente'] . ' ' . $primerElemento['apellido_docente'] ?>
                    </h4>
                </div>
            </div>
        </div>
        <div class="form-group row mt-4 d-flex align-items-center justify-content-start">
            <label for="nombre" class="col-sm-3 col-form-label text-secondary d-flex align-items-center">
                <h3>DNI</h3>
            </label>
            <div class="col-sm-6">
                <div class="form-control d-flex justify-content-start align-items-center">
                    <h4>
                        <?php echo $primerElemento['dni_docente'] ?>
                    </h4>
                </div>

            </div>
        </div>
        <div class="form-group row mt-4 d-flex align-items-center justify-content-start">
            <label for="nombre" class="col-sm-3 col-form-label text-secondary d-flex align-items-center">
                <h3>Correo electrónico</h3>
            </label>
            <div class="col-sm-6">
                <div class="form-control d-flex justify-content-start align-items-center">
                    <h4>
                        <?php echo $primerElemento['email_usuario'] ?>
                    </h4>
                </div>

            </div>
        </div>
        <div class="col-5 mt-5 mb-5">
            <hr />
        </div>
        <div>
            <h3 class="text-secondary">Especialidades en las que trabaja</h3>
            <ul>
                <?php
                foreach ($listaEspecialidades as $especialidad) {
                ?>
                    <li>
                        <h5>
                            <?php echo $especialidad['nombre_especialidad']; ?>
                        </h5>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
        <div class="col-5 mt-5 mb-5">
            <hr />
        </div>
        <div>
            <h3 class="text-secondary">Capacitaciones realizadas</h3>
            <?php

            if ($listaCapacitaciones) {
            ?><ol class="col-12 text-break h5" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;">
                    <?php foreach ($listaCapacitaciones as $capacitacion) {

                    ?> <li><a href='?t=institucion&p=capacitaciones/detalle-capacitacion&id=<?php echo $capacitacion['id_capacitacion'] ?>' class="text-primary">
                                <?php echo $capacitacion['nombre_capacitacion'] ?>
                            </a>
                            <span class="ms-5 badge <?php if ($capacitacion['estado_capacitacion'] == 0) {
                                                        echo 'bg-success';
                                                    } else {
                                                        echo 'bg-danger';
                                                    } ?>"><?php if ($capacitacion['estado_capacitacion'] == 0) {
                                                            echo 'ACTIVO';
                                                        } else {
                                                            echo 'FINALIZADO';
                                                        } ?></span>
                        </li>
                    <?php

                    }
                    ?>
                </ol>
            <?php
            } else {
                echo "No realizó capacitaciones";
            }
            ?>
        </div>
        <form method="POST" style="text-align: center">
            <button type="submit" value="<?php echo $primerElemento['id_docente'] ?>-<?php echo $primerElemento['id_institucion'] ?>-<?php echo $primerElemento['id_especialidad'] ?>" name="Rechazar" class="btn shadow-sm btn-danger mt-5" style=" width: 20%">
                Dar de baja
            </button>
        </form>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>