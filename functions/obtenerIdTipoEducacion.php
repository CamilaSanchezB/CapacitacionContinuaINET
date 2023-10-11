<?php 
    
    function obtenerIdTipoEducacion($tipoEducacion) {
        include('./config/db-connection.php');
        $sentenciaSQL_idtipoEducacion = $conexion->prepare("SELECT `id_tipo_educacion` FROM tipos_educacion WHERE `desc_tipo_educacion` = :tipoEducacion");
        $sentenciaSQL_idtipoEducacion->bindParam(":tipoEducacion", $tipoEducacion);
        $sentenciaSQL_idtipoEducacion->execute();
        $resultado_idtipoEducacion = $sentenciaSQL_idtipoEducacion->fetch(PDO::FETCH_ASSOC);

        return $resultado_idtipoEducacion ['id_tipo_educacion'];
    }
?>