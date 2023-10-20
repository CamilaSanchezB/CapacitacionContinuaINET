<?php
   $sentenciaSQL_idDocente = $conexion->prepare("SELECT `id_docente` FROM docentes WHERE `id_usuario` = :id_usuario");
   $sentenciaSQL_idDocente->bindParam(":id_usuario", $_SESSION['usuario']['id_usuario']);
   $sentenciaSQL_idDocente->execute();
   $resultado_idDocente = $sentenciaSQL_idDocente->fetch(PDO::FETCH_ASSOC);
?>