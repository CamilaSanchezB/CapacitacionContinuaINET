<!DOCTYPE html>
<?php
include('./functions/cerrarsesion.php');
include('./config/db-connection.php'); ?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <?php

    try {
        $listaTiposEducacion = [];
        $sentenciaSQL = $conexion->prepare("SELECT * FROM `tipos_educacion`");
        $sentenciaSQL->execute();
        $listaTiposEducacion = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    try {
        $listaEspecialidades = [];
        $sentenciaSQL = $conexion->prepare("SELECT * FROM `especialidades`");
        $sentenciaSQL->execute();
        $listaEspecialidades = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $id_usuario = $_SESSION['usuario']['id_usuario'];

    // Primera consulta para obtener id_institucion
    $sentenciaSQL_idInstitucion = $conexion->prepare("SELECT `id_institucion` FROM instituciones WHERE `id_usuario` = :id_usuario");
    $sentenciaSQL_idInstitucion->bindParam(":id_usuario", $id_usuario);
    $sentenciaSQL_idInstitucion->execute();
    $resultado_idInstitucion = $sentenciaSQL_idInstitucion->fetch(PDO::FETCH_ASSOC);
    if (isset($_POST['crear'])) {
        if (isset($_POST['nombre']) && isset($_POST['tipo_educacion']) && isset($_POST['fecha_inicio']) && isset($_POST['fecha_finalizacion']) && isset($_POST['dias_horarios']) && isset($_POST['modalidad']) && isset($_POST['lugar_plataforma'])) {
            $nombre = $_POST['nombre'];
            $tipo_educacion = $_POST['tipo_educacion'];
            $especialidad=$_POST['especialidad'];

            // Convierte las fechas a timestamps en formato Y-m-d H:i:s
            $fecha_inicio = $_POST['fecha_inicio'] . " 00:00:00"; // 00:00:00 es la hora inicial del día
            $fecha_finalizacion = $_POST['fecha_finalizacion'] . " 00:00:00"; // 00:00:00 es la hora inicial del día
    
            $dias_horarios = $_POST['dias_horarios'];
            $modalidad = $_POST['modalidad'];
            $lugar_plataforma = $_POST['lugar_plataforma'];

            // Usar una consulta preparada para la inserción de datos
            try {
                $sentenciaSQL_crear = $conexion->prepare("INSERT INTO `capacitaciones` 
                (`id_institucion`, `id_tipo_educacion`, `id_especialidad`,`nombre_capacitacion`, `fecha_inicio_capacitacion`, `dias_horarios_capacitacion`, `fecha_fin_capacitacion`, `modalidad_capacitacion`, `lugar_o_plataforma_capacitacion`) 
                VALUES (:id_institucion, :tipo_educacion, :id_especialidad, :nombre, :fecha_inicio, :dias_horarios, :fecha_finalizacion, :modalidad, :lugar_plataforma)");

                $sentenciaSQL_crear->bindParam(":id_institucion", $resultado_idInstitucion['id_institucion']);
                $sentenciaSQL_crear->bindParam(":tipo_educacion", $tipo_educacion);
                $sentenciaSQL_crear->bindParam(":id_especialidad", $especialidad);
                $sentenciaSQL_crear->bindParam(":nombre", $nombre);
                $sentenciaSQL_crear->bindParam(":fecha_inicio", $fecha_inicio);
                $sentenciaSQL_crear->bindParam(":dias_horarios", $dias_horarios);
                $sentenciaSQL_crear->bindParam(":fecha_finalizacion", $fecha_finalizacion);
                $sentenciaSQL_crear->bindParam(":modalidad", $modalidad);
                $sentenciaSQL_crear->bindParam(":lugar_plataforma", $lugar_plataforma);

                $sentenciaSQL_crear->execute();
                echo "<script>alert('Capacitación creada con éxito')</script>";
            } catch (PDOException $e) {
                echo "Error en la inserción en la base de datos: " . $e->getMessage();
            }
        } else {
            echo "<script>alert('Por favor, complete todos los campos.')</script>";
        }
    }



    ?>
    <hr class="mt-0" style="border:2ch solid rgba(125, 125, 125, 1); opacity: 1;">
    <div class="container">
        <?php require_once('./template/header-institucion.php') ?>
        <h1 style="color: rgba(129, 129, 129, 1);font-weight: normal; ">Crear capacitación</h1>
        <form method="POST">
            <div class="form-group row mt-4 d-flex align-items-center justify-content-start">
                <label for="nombre" class="col-sm-3 col-form-label text-secondary d-flex align-items-center">Nombre
                    Capacitación</label>
                <div class="col-sm-6">
                    <input required type="text" class="form-control" name="nombre" style="height: 6ch;">
                </div>
            </div>
            <div class="form-group row mt-4 d-flex align-items-center justify-content-start">
                <label for="seleccion" class="col-sm-3 col-form-label text-secondary d-flex align-items-center">Tipo de
                    educación</label>
                <div class="col-sm-6">
                    <select class="form-select col-6" name="tipo_educacion" style="height: 6ch;">
                        <?php
                        foreach ($listaTiposEducacion as $tipoEducacion) {
                            ?>
                            <option value="<?php echo $tipoEducacion['id_tipo_educacion']; ?>">
                                <?php echo $tipoEducacion['desc_tipo_educacion']; ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row mt-4 d-flex align-items-center justify-content-start">
                <label for="seleccion" class="col-sm-3 col-form-label text-secondary d-flex align-items-center">Especialidad</label>
                <div class="col-sm-6">
                    <select class="form-select col-6" name="especialidad" style="height: 6ch;">
                        <?php
                        foreach ($listaEspecialidades as $especialidad) {
                            ?>
                            <option value="<?php echo $especialidad['id_especialidad']; ?>">
                                <?php echo $especialidad['nombre_especialidad']; ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row mt-4 d-flex align-items-center justify-content-start">
                <label for="nombre" class="col-sm-3 col-form-label text-secondary d-flex align-items-center">Fecha de
                    inicio</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="fecha_inicio" style="height: 6ch;" required>
                </div>
            </div>
            <div class="form-group row mt-4 d-flex align-items-center justify-content-start">
                <label for="nombre" class="col-sm-3 col-form-label text-secondary d-flex align-items-center">Fecha de
                    finalización</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="fecha_finalizacion" style="height: 6ch;">
                </div>
            </div>
            <div class="form-group row mt-4 d-flex align-items-center justify-content-start">
                <label for="seleccion" class="col-sm-3 col-form-label text-secondary d-flex align-items-center">Dias y
                    horarios</label>
                <div class="col-sm-6">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="dias_horarios" style="height: 6ch;">
                    </div>
                </div>
            </div>
            <div class="form-group row mt-4 d-flex align-items-center justify-content-start">
                <label for="seleccion"
                    class="col-sm-3 col-form-label text-secondary d-flex align-items-center">Modalidad</label>
                <div class="col-sm-6">
                    <select class="form-select" name="modalidad" style="height: 6ch;">
                        <option value="Virtual">Virtual</option>
                        <option value="Presencial">Presencial</option>
                        <option value="Híbrido">Híbrido</option>
                    </select>
                </div>
            </div>
            <div class="form-group row mt-4 d-flex align-items-center justify-content-start">
                <label for="seleccion"
                    class="col-sm-3 col-form-label text-secondary d-flex align-items-center">Lugar/Plataforma</label>
                <div class="col-sm-6">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="lugar_plataforma" style="height: 6ch;">
                    </div>
                </div>
            </div>

            <div class="col-12 d-flex justify-content-center align-items-center mt-5" style="height: 6ch;">

                <button type="submit" name="crear" class="btn btn-primary btn-lg">Crear capacitación</button>

            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>