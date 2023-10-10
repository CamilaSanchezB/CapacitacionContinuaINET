<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php include('./config/db-connection.php') ?>
    <?php

    if (isset($_GET['id'])) {
        try {
            $listaProvincias = [];
            $id = $_GET['id'];
            $sentenciaSQL = $conexion->prepare("SELECT * FROM `provincias` WHERE `id_provincia` = '$id'");
            $sentenciaSQL->execute();
            $listaProvincias = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($listaProvincias)) {
                $primerElemento = array_shift($listaProvincias);
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } ?>
    <hr class="mt-0" style="border:2ch solid rgba(125, 125, 125, 1); opacity: 1;">
    <div class="container" style="min-height: 75vh;">
        <div class="row mt-3 d-flex align-items-center justify-content-end">
            <div class="col-2">
                <button type="button" class="btn btn-block" style="background-color: rgba(19, 140, 232, 1);  color: rgba(77, 74, 74, 1);width: 100%;">
                    <i class="fas fa-check"></i> Ingresar
                </button>
            </div>
        </div>
        <div class="row d-flex align-items-center">
            <div class="col-6">
                <img src="./assets/image/logo-inet.png" class="img-fluid">
            </div>
            <div class="col-3 d-flex justify-content-end align-items-center" style="height: 6ch;">
                <a href='?t=administrador&p=validacionETP' class="btn shadow-sm" style="height: 80%;width: 80% ;background-color: rgba(217, 217, 217, 0.42);  color: rgba(188, 182, 182, 1);">
                    <i class="fas fa-check"></i> Buscar Ofertas
                </a>
            </div>
            <div class="col-3 d-flex justify-content-end align-items-center" style="height: 6ch;">
                <button type="button" class="btn shadow-sm" style="height: 80%;width: 80% ;background-color: rgba(217, 217, 217, 0.42);  color: rgba(188, 182, 182, 1);">
                    <i class="fas fa-check"></i> Seleccionar pro..
                </button>
            </div>
        </div>
        <hr style="border:2ch solid rgba(12, 104, 174, 1); opacity: 1;">
        <h1 style="color: rgba(129, 129, 129, 1);">Cursos de capacitación <span class="badge bg-secondary">Abierto</span></h1>
        <hr class="col-5">
        <div class="col-7 text-break h3" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;"><?php echo $primerElemento['nombre_provincia'] ?></div>
        <div class="col-7 text-break h4" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;">Institución: <?php echo $primerElemento['nombre_provincia'] ?></div>
        <div class="col-7 text-break h4" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;">Tipo de educación: <?php echo $primerElemento['nombre_provincia'] ?></div>
        <div class="col-7 text-break h4" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;">Fecha de inicio: <?php echo $primerElemento['nombre_provincia'] ?></div>
        <div class="col-7 text-break h4" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;">Días y horarios: <?php echo $primerElemento['nombre_provincia'] ?></div>
        <div class="col-7 text-break h4" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;">Modalidad: <?php echo $primerElemento['nombre_provincia'] ?></div>
        <div class="col-7 text-break h4" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;">Lugar / plataforma: <?php echo $primerElemento['nombre_provincia'] ?></div>
        <div class="col-7 text-break h4" style="font-style: normal; color: rgba(56, 56, 56, 0.63) ;">Descripción: <?php echo $primerElemento['nombre_provincia'] ?></div>

    </div>
    <?php $conexion = null; ?>
</body>

</html>