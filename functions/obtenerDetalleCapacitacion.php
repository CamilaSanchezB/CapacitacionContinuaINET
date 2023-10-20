<?php 
    function obtenerDetalleCapacitacion($id) {
        include ('./config/db-connection.php');
        try {
            $listaCapacitaciones = [];
            $sentenciaSQL = $conexion->prepare("SELECT * FROM `capacitaciones`
            INNER JOIN `especialidades` ON `capacitaciones`.`id_especialidad` = `especialidades`.`id_especialidad`
            INNER JOIN `instituciones` ON `capacitaciones`.`id_institucion` = `instituciones`.`id_institucion`
            INNER JOIN `localidades` ON `instituciones`.`id_localidad` = `localidades`.`id_localidad`
            INNER JOIN `provincias` ON `localidades`.`id_provincia` = `provincias`.`id_provincia`
            INNER JOIN `tipos_educacion` ON `capacitaciones`.`id_tipo_educacion` = `tipos_educacion`.`id_tipo_educacion`
            WHERE `capacitaciones`.`id_capacitacion` = '$id'");
            $sentenciaSQL->execute();
            $listaCapacitaciones = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($listaCapacitaciones)) {
                $primerElemento = array_shift($listaCapacitaciones);
                return $primerElemento;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
?>