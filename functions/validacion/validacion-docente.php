<?php
session_start();
  include('./config/db-connection.php');
  $id_usuario = $_SESSION['usuario']['id_usuario'];
  $sentenciaSQL_estadoValidacion = $conexion->prepare("SELECT `estado_validacion_docente` FROM detalle_docente LEFT JOIN `docentes` ON `detalle_docente`.`id_docente` = `docentes`.`id_docente` WHERE `docentes`.`id_usuario` = :id_usuario ORDER BY `estado_validacion_docente` DESC ");
  $sentenciaSQL_estadoValidacion->bindParam(":id_usuario", $id_usuario);
  $sentenciaSQL_estadoValidacion->execute();
  $resultado_estadoValidacion = $sentenciaSQL_estadoValidacion->fetch(PDO::FETCH_ASSOC);

  $sentenciaSQL_email = $conexion->prepare("SELECT `email_usuario` FROM usuarios WHERE `id_usuario` = :id_usuario");
  $sentenciaSQL_email->bindParam(":id_usuario", $id_usuario);
  $sentenciaSQL_email->execute();
  $resultado_email = $sentenciaSQL_email->fetch(PDO::FETCH_ASSOC);
  // Función para verificar la existencia de la variable de sesión 'usuario' y obtener 'id_tipo_usuario'
  include('./functions/obtenerIdTipoUsuario.php');
  // Uso de la función para obtener 'id_tipo_usuario'
  $idTipoUsuario = obtenerIdTipoUsuario();
  if ($resultado_email['email_usuario'] != $_SESSION['usuario']['email_usuario']||$resultado_estadoValidacion['estado_validacion_docente'] == 0||$idTipoUsuario === null || $idTipoUsuario != 2 ) {
    header("Location: ?p=inicio");
  }
?>