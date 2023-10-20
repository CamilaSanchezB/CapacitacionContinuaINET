<?php
    function insertarDetalleDocente($id_docente, $id_institucion, $id_especialidad){
        include('./config/db-connection.php');
        try{
            $sentenciaSQL = $conexion -> prepare("
            INSERT INTO `detalle_docente`
            (`id_docente`, `id_institucion`, `id_especialidad`, `estado_validacion_docente`)
            VALUES (:id_docente, :id_institucion, :id_especialidad, 0)
            ");
            $sentenciaSQL -> bindParam(':id_docente', $id_docente);
            $sentenciaSQL -> bindParam(':id_institucion', $id_institucion);
            $sentenciaSQL -> bindParam(':id_especialidad', $id_especialidad);
            $sentenciaSQL-> execute();
        }catch(PDOException $e) {
            echo 'Error: '. $e -> getMessage();
        }
    }
?>