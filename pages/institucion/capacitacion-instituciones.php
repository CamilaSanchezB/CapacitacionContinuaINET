<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
  <?php
  session_start();

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

  if ($idTipoUsuario === null || $idTipoUsuario != 3) {
    header("Location: ?p=inicio");
  }
  ?>
  <?php
  include('./config/db-connection.php');
  $listaCapacitaciones = [];
  $id_usuario = $_SESSION['usuario']['id_usuario'];

  // Primera consulta para obtener id_institucion
  $sentenciaSQL_idInstitucion = $conexion->prepare("SELECT `id_institucion` FROM instituciones WHERE `id_usuario` = :id_usuario");
  $sentenciaSQL_idInstitucion->bindParam(":id_usuario", $id_usuario);
  $sentenciaSQL_idInstitucion->execute();
  $resultado_idInstitucion = $sentenciaSQL_idInstitucion->fetch(PDO::FETCH_ASSOC);

  if ($resultado_idInstitucion) {
    $id_institucion = $resultado_idInstitucion['id_institucion'];

    // Segunda consulta utilizando el id_institucion obtenido
    $sentenciaSQL = $conexion->prepare("SELECT * FROM `capacitaciones` WHERE `id_institucion` = :id_institucion");
    $sentenciaSQL->bindParam(":id_institucion", $id_institucion);
    $sentenciaSQL->execute();

    // Obtener los resultados de la segunda consulta
    $listaCapacitaciones = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
  } else {
    echo "No se encontró el id_institucion para el usuario actual.";
  }

  include('./functions/cerrarsesion.php');
  ?>


  <hr class="mt-0" style="border:2ch solid rgba(125, 125, 125, 1); opacity: 1;">
  <div class="container" style="min-height: 75vh;">
    <div class="row mt-3 d-flex align-items-center justify-content-end">
      <div class="col-2">
        <form method="POST">
          <button name="eliminar" value="eliminar" type="submit" class="btn btn-block" style="background-color: rgba(19, 140, 232, 1);  color: rgba(77, 74, 74, 1);width: 100%;">
            <i class="fas fa-check"></i> Institución
            <image src="./assets/image/logout.png" class="img-fluid" width="10%" height="10%" />
          </button>
        </form>

      </div>
    </div>
    <div class="row d-flex align-items-center">
      <div class="col-3">
        <img src="./assets/image/logo-inet.png" class="img-fluid">
      </div>
      <div class="col-3 d-flex justify-content-end align-items-center" style="height: 6ch;">
        <button disabled type="button" class="btn shadow-sm" style="height: 80%;width: 80% ;background-color: rgba(217, 217, 217, 0.42);  color: rgba(188, 182, 182, 1);">
          <i class="fas fa-check"></i> Capacitaciones
        </button>
      </div>
      <div class="col-3 d-flex justify-content-end align-items-center" style="height: 6ch;">
        <button type="button" class="btn shadow-sm" style="height: 80%;width: 80% ;background-color: rgba(217, 217, 217, 0.42);  color: rgba(188, 182, 182, 1);">
          <i class="fas fa-check"></i> Crear Capacitaciones
        </button>
      </div>
      <div class="col-3 d-flex justify-content-end align-items-center" style="height: 6ch;">
        <button type="button" class="btn shadow-sm" style="height: 80%;width: 80% ;background-color: rgba(217, 217, 217, 0.42);  color: rgba(188, 182, 182, 1);">
          <i class="fas fa-check"></i> Docentes
        </button>
      </div>
    </div>
    <hr style="border:2ch solid rgba(12, 104, 174, 1); opacity: 1;">
    <h1 class="mb-4" style="color: rgba(129, 129, 129, 1);">Capacitaciones</h1>
    <ol style="margin-left: 10px;">
      <?php
      foreach ($listaCapacitaciones as $capacitacion) { ?>

        <li style="margin-bottom: 10px; font-size: 20px;" class="text-primary">
          <a href='?t=institucion&p=detalle-capacitacion&id=<?php echo $capacitacion['id_capacitacion'] ?>' class="text-primary">
            <?php echo $capacitacion['nombre_capacitacion'] ?>
          </a>
        </li>
      <?php
      }
      ?>
    </ol>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>