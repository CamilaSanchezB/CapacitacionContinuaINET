<?php
session_start();
  include('./config/db-connection.php');
  $id_usuario = $_SESSION['usuario']['id_usuario'];
  $sentenciaSQL_estadoValidacion = $conexion->prepare("SELECT `estado_validacion_institucion` FROM instituciones WHERE `id_usuario` = :id_usuario");
  $sentenciaSQL_estadoValidacion->bindParam(":id_usuario", $id_usuario);
  $sentenciaSQL_estadoValidacion->execute();
  $resultado_estadoValidacion = $sentenciaSQL_estadoValidacion->fetch(PDO::FETCH_ASSOC);
  // Función para verificar la existencia de la variable de sesión 'usuario' y obtener 'id_tipo_usuario'
  function obtenerIdTipoUsuario()
  {
    // Verificar si la variable de sesión 'usuario' existe
    if (isset($_SESSION['usuario'])) {
      // Obtener 'id_tipo_usuario' del arreglo de sesión 'usuario'
      return $_SESSION['usuario']['id_tipo_usuario'];
    } else {
      // La variable de sesión 'usuario' no existe
      return null;
    }


  }
  // Uso de la función para obtener 'id_tipo_usuario'
  $idTipoUsuario = obtenerIdTipoUsuario();
  if ($resultado_estadoValidacion['estado_validacion_institucion'] == 0||$idTipoUsuario === null || $idTipoUsuario != 3 ) {
    header("Location: ?p=inicio");
  }
?>