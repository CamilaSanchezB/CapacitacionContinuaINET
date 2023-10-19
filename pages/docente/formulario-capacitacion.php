<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulario de Evaluación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <hr class="mt-0" style="border:2ch solid rgba(125, 125, 125, 1); opacity: 1;">
    <div class="container">
        <?php
        include('./config/db-connection.php');

        if (isset($_GET['id'])) {
            include('./functions/obtenerDetalleCapacitacion.php');
            $primerElemento = obtenerDetalleCapacitacion($_GET['id']);
        }
        include('./functions/obtener-idDocente.php');
        $sentenciaSQL_idDetalleCapacitacion = $conexion->prepare("SELECT `id_detalle_capacitacion` FROM detalle_capacitaciones WHERE `id_docente` = :id_docente AND `id_capacitacion` = :id_capacitacion");
        $sentenciaSQL_idDetalleCapacitacion->bindParam(":id_docente", $resultado_idDocente['id_docente']);
        $sentenciaSQL_idDetalleCapacitacion->bindParam(":id_capacitacion", $primerElemento['id_capacitacion']);
        $sentenciaSQL_idDetalleCapacitacion->execute();
        $resultado_idDetalleCapacitacion = $sentenciaSQL_idDetalleCapacitacion->fetch(PDO::FETCH_ASSOC);

        $id_detalle_capacitacion = $resultado_idDetalleCapacitacion['id_detalle_capacitacion'];


        $sentenciaSQL_estadoRespuesta = $conexion->prepare("SELECT `id_respuesta_docente` FROM respuestas_docentes WHERE `id_detalle_capacitacion` = :id_detalle_capacitacion");
        $sentenciaSQL_estadoRespuesta->bindParam(":id_detalle_capacitacion", $id_detalle_capacitacion);
        $sentenciaSQL_estadoRespuesta->execute();
        $resultado_estadoRespuesta = $sentenciaSQL_estadoRespuesta->fetch(PDO::FETCH_ASSOC);
        if(!empty($resultado_estadoRespuesta['id_respuesta_docente'])){
            header("Location:?t=docente&p=listado-mis-capacitaciones");
        }
        ?>
        <?php
        require_once('./template/header-docente.php')

            ?>
        <h2 class="text-secondary">Formulario de impacto pedagógico</h2>
        <div class="container mt-4">
            <form action="?t=docente&p=procesar_formulario" method="POST">
                <label for="capacitacion">ELECCION DE CAPACITACIÓN:</label>
                <select disabled name="capacitacion" id="capacitacion" class="form-select">
                    <option value="<?php echo $primerElemento['id_capacitacion'] ?>">
                        <?php echo $primerElemento['nombre_capacitacion'] ?> -
                        <?php echo $primerElemento['nombre_institucion'] ?>
                    </option>
                </select>

                <br><br>

                <label>¿Cree que lo visto en la capacitación puede contribuir a sus prácticas docentes?</label><br>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="contribucion" value="No">
                    <label class="form-check-label">No</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="contribucion" value="Probablemente no">
                    <label class="form-check-label">Probablemente No</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="contribucion" checked value="Indeciso">
                    <label class="form-check-label">Indeciso</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="contribucion" value="Probablemente si">
                    <label class="form-check-label">Probablemente Sí</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="contribucion" value="Si">
                    <label class="form-check-label">Sí</label>
                </div>

                <br><br>

                <label>¿Considera que el material visto fue de calidad y suficiente?</label><br>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="calidad_material" value="No">
                    <label class="form-check-label">No</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="calidad_material" value="Probablemente no">
                    <label class="form-check-label">Probablemente No</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="calidad_material" checked value="Indeciso">
                    <label class="form-check-label">Indeciso</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="calidad_material" value="Probablemente si">
                    <label class="form-check-label">Probablemente Sí</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="calidad_material" value="Si">
                    <label class="form-check-label">Sí</label>
                </div>

                <br><br>

                <label>¿Será multiplicador de lo visto en la capacitación, le sirvió para serlo?</label><br>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="multiplicador" value="No">
                    <label class="form-check-label">No</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="multiplicador" value="Probablemente no">
                    <label class="form-check-label">Probablemente No</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="multiplicador" checked value="Indeciso">
                    <label class="form-check-label">Indeciso</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="multiplicador" value="Probablemente si">
                    <label class="form-check-label">Probablemente Sí</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="multiplicador" value="Si">
                    <label class="form-check-label">Sí</label>
                </div>

                <br><br>

                <label>¿Se sintió acompañado/a por el capacitador/a?</label><br>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="acompanamiento" value="No">
                    <label class="form-check-label">No</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="acompanamiento" value="Probablemente no">
                    <label class="form-check-label">Probablemente No</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="acompanamiento" checked value="Indeciso">
                    <label class="form-check-label">Indeciso</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="acompanamiento" value="Probablemente si">
                    <label class="form-check-label">Probablemente Sí</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="acompanamiento" value="Si">
                    <label class="form-check-label">Sí</label>
                </div>

                <div class="mb-3 mt-5">
                    <label for="sugerencias" class="form-label">Sugerencias</label>
                    <textarea class="form-control" id="sugerencias" name="sugerencias" rows="3"></textarea>
                </div>
                <input hidden type="number" name="id_docente" value="<?php echo $resultado_idDocente['id_docente']; ?>">
                <input hidden type="number" name="id_capacitacion"
                    value="<?php echo $primerElemento['id_capacitacion']; ?>">
                <div class="d-flex justify-content-center mt-5 mb-5">
                    <input type="submit" value="Enviar" class="btn btn-success shadow-sm" style="width:20%">
                </div>
            </form>
        </div>
    </div>
    <script src="formulario.js"></script>
</body>

</html>