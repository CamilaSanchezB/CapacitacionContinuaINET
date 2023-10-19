<?php
session_start();
  include('./config/db-connection.php');
  $id_usuario = $_SESSION['usuario']['id_usuario'];
  $sentenciaSQL_email = $conexion->prepare("SELECT `email_usuario` FROM usuarios WHERE `id_usuario` = :id_usuario");
  $sentenciaSQL_email->bindParam(":id_usuario", $id_usuario);
  $sentenciaSQL_email->execute();
  $resultado_email = $sentenciaSQL_email->fetch(PDO::FETCH_ASSOC);
  // Función para verificar la existencia de la variable de sesión 'usuario' y obtener 'id_tipo_usuario'
  include('./functions/obtenerIdTipoUsuario.php');

  // Uso de la función para obtener 'id_tipo_usuario'
  $idTipoUsuario = obtenerIdTipoUsuario();
  if ($resultado_email['email_usuario'] != $_SESSION['usuario']['email_usuario']||$idTipoUsuario === null || $idTipoUsuario != 1 ) {
    header("Location: ?p=inicio");
  }
