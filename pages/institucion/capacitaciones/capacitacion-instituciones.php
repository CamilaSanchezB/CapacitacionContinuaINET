<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Capacitación continua INET</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
  <?php
  include('./config/db-connection.php');
  include ('./functions/fechaPasada.php');
  $listaCapacitaciones = [];

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
  <?php require_once('./template/header-institucion.php')?>
    <h1 class="mb-4" style="color: rgba(129, 129, 129, 1);">Capacitaciones ofrecidas</h1>
    <ol style="margin-left: 10px;">
      <?php
      foreach ($listaCapacitaciones as $capacitacion) { ?>

        <li style="margin-bottom: 10px; font-size: 20px;" class="text-primary">
          <a href='?t=institucion&p=capacitaciones/detalle-capacitacion&id=<?php echo $capacitacion['id_capacitacion'] ?>'
            class="text-primary">
            <?php echo $capacitacion['nombre_capacitacion'] ?>
          </a>
          <span class="ms-3 badge bg-<?php if(haPasadoFecha($capacitacion['fecha_fin_capacitacion'])){echo 'danger';}else if(haPasadoFecha($capacitacion['fecha_inicio_capacitacion'])){echo 'success';}else{echo 'warning';}?>"><?php if(haPasadoFecha($capacitacion['fecha_fin_capacitacion'])){echo 'FINALIZADO';}else if(haPasadoFecha($capacitacion['fecha_inicio_capacitacion'])){echo 'ACTIVO';}else{echo 'AUN NO INICIÓ';}?></span>
          <?php
          if($capacitacion['estado_respuesta'] == 0 && haPasadoFecha($capacitacion['fecha_fin_capacitacion'])){
           ?>
           <a href="?t=institucion&p=capacitaciones/formulario-capacitacion&id=<?php echo $capacitacion['id_capacitacion']?>" class="btn btn-warning badge text-dark">Completar formulario de impacto pedagógico</a>
           <?php
          }
          ?>
        </li>
        <?php
      }
      ?>
    </ol>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>