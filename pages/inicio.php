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
  <?php include('./config/db-connection.php') ?>
  <?php
  $listaCapacitaciones = [];
  $sentenciaSQL = $conexion->prepare("SELECT * FROM `capacitaciones`");
  $sentenciaSQL->execute();
  $listaCapacitaciones = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
  ?>
  <hr class="mt-0" style="border:2ch solid rgba(125, 125, 125, 1); opacity: 1;">
  <div class="container" style="height: 75vh;">

    <?php require_once('./template/header-inicio.php')?>
    <h1 style="color: rgba(129, 129, 129, 1);">Cursos de capacitación</h1>
    <h3 class="mt-4" style="color: rgba(129, 129, 129, 1);">Ofertas de cursos</h3>
    <ol>
      <?php
      foreach ($listaCapacitaciones as $capacitacion) { ?>
        <li style="margin-bottom: 10px; font-size: 20px;" class="text-primary">
          <a href='?p=capacitaciones&id=<?php echo $capacitacion['id_capacitacion'] ?>' class="text-primary">
            <?php echo $capacitacion['nombre_capacitacion'] ?>
          </a>
        </li>
        <?php
      }
      ?>

    </ol>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <?php $conexion = null; ?>
</body>

</html>