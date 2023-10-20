<?php
include('./config/db-connection.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Almacena los datos POST en variables
    $id_capacitacion = $_POST['id_capacitacion'];
    $replicador = $_POST['replicador'];
    $impacto_pedagogico = $_POST['impacto_pedagogico'];
    $continuar_capacitacion = $_POST['continuar_capacitacion'];
    $replica_institucion = $_POST['replica_institucion'];
    $sugerencias = $_POST['sugerencias'];

    try {
        // Insertar respuestas en la tabla respuestas_docentes
        $sentenciaSQL = $conexion->prepare("INSERT INTO `respuestas_institucion` 
    (`id_capacitacion`, `respuesta_realizacion`, `respuesta_aplicacion`, `respuesta_continuar`, `respuesta_replica`, `sugerencia`)
    VALUES (:id_capacitacion, :realizacion, :aplicacion, :continuar, :respuesta_replica, :sugerencia)");
        $sentenciaSQL->bindParam(":id_capacitacion", $id_capacitacion);
        $sentenciaSQL->bindParam(":realizacion", $replicador); // Corrección aquí
        $sentenciaSQL->bindParam(":aplicacion", $impacto_pedagogico); // Corrección aquí
        $sentenciaSQL->bindParam(":continuar", $continuar_capacitacion);
        $sentenciaSQL->bindParam(":respuesta_replica", $replica_institucion);
        $sentenciaSQL->bindParam(":sugerencia", $sugerencias);
        $sentenciaSQL->execute();


        // Actualizar el estado de respuesta en la tabla capacitaciones
        $sentenciaSQL = $conexion->prepare("UPDATE `capacitaciones` SET `estado_respuesta` = 1 WHERE `id_capacitacion` = :id_capacitacion");
        $sentenciaSQL->bindParam(":id_capacitacion", $id_capacitacion);
        $sentenciaSQL->execute();

        header("Location: ?t=institucion&p=capacitaciones/capacitacion-instituciones");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
//$conexion = null;
