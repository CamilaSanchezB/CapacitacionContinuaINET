<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulario de Evaluación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    include('./functions/fechaPasada.php');
    if (isset($_GET['id'])) {
        include('./functions/obtenerDetalleCapacitacion.php');
        $primerElemento = obtenerDetalleCapacitacion($_GET['id']);
        if($primerElemento['estado_respuesta'] || !haPasadoFecha($primerElemento['fecha_fin_capacitacion'])){
            header('Location: ?t=institucion&p=capacitacion-instituciones');
        }
    }
    ?>
    <hr class="mt-0" style="border: 2ch solid rgba(125, 125, 125, 1); opacity: 1;">
    <div class="container">
        <?php require_once('./template/header-institucion.php') ?>
        <h1 style="color: rgba(129, 129, 129, 1);">Formulario</h1>
        <h3 class="mt-4" style="color: rgba(129, 129, 129, 1);">Fin de capacitacion</h3>
        <div class="container">
            <form action="?t=institucion&p=procesar-formulario" method="POST">
                <label for="capacitacion">Capacitación:</label>
                <select disabled name="capacitacion" id="capacitacion" class="form-select">
                    <option value="institucion1"><?php echo $primerElemento['nombre_capacitacion'] ?></option>
                </select>
                <br>
                <label for="capacitacion">Especialidad:</label>
                <select disabled name="capacitacion" id="capacitacion" class="form-select">
                    <option value="institucion1"><?php echo $primerElemento['nombre_especialidad'] ?></option>
                </select>

                <br><br>

                <label>¿Considera que las/los docentes que realizaron la capacitación fueron buenos
                    replicadores?</label><br>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="replicador" value="Si">
                    <label class="form-check-label">Sí</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="replicador" value="Probablemente si">
                    <label class="form-check-label">Probablemente Sí</label>
                </div>
                <div class="form-check">
                    <input checked class="form-check-input" type="radio" name="replicador" value="Indeciso">
                    <label class="form-check-label" >Indeciso</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="replicador" value="Probablemente no">
                    <label class="form-check-label">Probablemente No</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="replicador" value="No">
                    <label class="form-check-label">No</label>
                </div>

                <br><br>

                <label>¿Considera que las/los docentes aplicaron lo visto, generando un impacto pedagógico?</label><br>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="impacto_pedagogico" value="Si">
                    <label class="form-check-label">Sí</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="impacto_pedagogico" value="Probablemente si">
                    <label class="form-check-label">Probablemente Sí</label>
                </div>
                <div class="form-check">
                    <input checked class="form-check-input" type="radio" name="impacto_pedagogico" value="Indeciso">
                    <label class="form-check-label">Indeciso</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="impacto_pedagogico" value="Probablemente no">
                    <label class="form-check-label">Probablemente No</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="impacto_pedagogico" value="No">
                    <label class="form-check-label">No</label>
                </div>

                <br><br>

                <label>¿Considera que debe continuar la capacitación recibida en la especialidad elegida?</label><br>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="continuar_capacitacion" value="Si">
                    <label class="form-check-label">Sí</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="continuar_capacitacion" value="Probablemente si">
                    <label class="form-check-label">Probablemente Sí</label>
                </div>
                <div class="form-check">
                    <input  checked class="form-check-input" type="radio" name="continuar_capacitacion" value="Indeciso">
                    <label class="form-check-label">Indeciso</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="continuar_capacitacion" value="Probablemente no">
                    <label class="form-check-label">Probablemente No</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="continuar_capacitacion" value="No">
                    <label class="form-check-label">No</label>
                </div>

                <br><br>

                <label>¿Su institución formaría parte de réplica para otras,en base a los docentes que considere
                    aptos?</label><br>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="replica_institucion" value="Si">
                    <label class="form-check-label" for="replica_institucion_si">Sí</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="replica_institucion" value="Probablemente si">
                    <label class="form-check-label" for="replica_institucion_Probablemente si">Probablemente Sí</label>
                </div>
                <div class="form-check">
                    <input checked class="form-check-input" type="radio" name="replica_institucion" value="Indeciso">
                    <label class="form-check-label" for="replica_institucion_indeciso">Indeciso</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="replica_institucion" value="Probablemente no">
                    <label class="form-check-label" for="replica_institucion_probablemente_no">Probablemente No</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="replica_institucion" value="No">
                    <label class="form-check-label" for="replica_institucion_no">No</label>
                </div>
                <input type="text" value="<?php echo $primerElemento['id_capacitacion']?>" name="id_capacitacion" hidden/>
                <br><br>

                <div class="mb-3">
                    <label for="sugerencias" class="form-label">¿Sugeriría cambios? ¿Cuáles?</label>
                    <textarea class="form-control" id="sugerencias" name="sugerencias" rows="3"></textarea>
                </div>




                <br><br>

                <div class="d-flex justify-content-center mb-5">
                    <input type="submit" value="Enviar" class="btn btn-success shadow-sm" style="width:20%">
                </div>
            </form>
        </div>
    </div>

</body>

</html>