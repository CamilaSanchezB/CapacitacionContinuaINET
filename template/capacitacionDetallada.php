<div>
    <?php
    include('./config/db-connection.php');
    $sentenciaSQL = $conexion->prepare('SELECT COUNT(*) as cantidad FROM `detalle_capacitaciones` WHERE `id_capacitacion` = ?');
    $sentenciaSQL->execute([$_GET['id']]);
    $cantidadDocentesInscriptos = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

   
    ?>
    <h1 style="color: rgba(129, 129, 129, 1);">Capacitaciones</h1>
    <div class="col-12 h5 mt-4" style="color: rgba(137, 137, 137, 1);">
        <?php echo $primerElemento['nombre_capacitacion'] ?>
        <span class="ms-5 badge <?php if (haPasadoFecha($primerElemento['fecha_fin_capacitacion'])) {
                                    echo 'bg-danger';
                                } else if (haPasadoFecha($primerElemento['fecha_inicio_capacitacion'])) {
                                    echo 'bg-success';
                                } else {
                                    echo 'bg-warning';
                                } ?>">
            <?php if (haPasadoFecha($primerElemento['fecha_fin_capacitacion'])) {
                echo 'FINALIZADO';
            } else if (haPasadoFecha($primerElemento['fecha_inicio_capacitacion'])) {
                echo 'ACTIVO';
            } else {
                echo 'AUN NO INICIÓ';
            } ?>
        </span>
    </div>
    <div class="col-6 h5 mt-3" style="color: rgba(137, 137, 137, 1);">
        Institución:
        <?php echo $primerElemento['nombre_institucion'] ?>
    </div>
    <div class="col-6 h5 mt-3" style="color: rgba(137, 137, 137, 1);">
        Tipo de educación:
        <?php echo $primerElemento['desc_tipo_educacion'] ?>
    </div>
    <div class="col-6 h5 mt-3" style="color: rgba(137, 137, 137, 1);">
        Especialidad:
        <?php echo $primerElemento['nombre_especialidad'] ?>
    </div>
    <div class="col-3 h5 mt-3" style="color: rgba(137, 137, 137, 1);">
        Fecha de inicio:
        <?php $dateTime = new DateTime($primerElemento['fecha_inicio_capacitacion']);
        $formattedDateTime = $dateTime->format("d/m/Y");
        echo $formattedDateTime ?>
    </div>
    <div class="col-12 h5 mt-3" style="color: rgba(137, 137, 137, 1);">
        Fecha de finalización:
        <?php $dateTime = new DateTime($primerElemento['fecha_fin_capacitacion']);
        $formattedDateTime = $dateTime->format("d/m/Y");
        echo $formattedDateTime ?>
    </div>
    <div class="col-12 h5 mt-3" style="color: rgba(137, 137, 137, 1);">
        Dias y horarios:
        <?php echo $primerElemento['dias_horarios_capacitacion'] ?>
    </div>

    <div class="col-3 h5 mt-3" style="color: rgba(137, 137, 137, 1);">
        Modalidad:
        <?php echo $primerElemento['modalidad_capacitacion'] ?>
    </div>
    <div class="col-12 h5 mt-3" style="color: rgba(137, 137, 137, 1);">
        Lugar/Plataforma:
        <?php echo $primerElemento['lugar_o_plataforma_capacitacion'] ?>
    </div>
    <?php if ($idTipoUsuario == 1) {
    ?>
        <hr class="col-7" />
        <h4>Total de docentes inscriptos: <?php echo $cantidadDocentesInscriptos['cantidad'] ?></h4><?php
                                                                                                }
                                                                                                    ?>
</div>