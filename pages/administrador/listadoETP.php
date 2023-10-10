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
session_start();

// Función para verificar la existencia de la variable de sesión 'usuario' y obtener 'id_tipo_usuario'
function obtenerIdTipoUsuario() {
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

if ($idTipoUsuario != 1 || $idTipoUsuario === null) {
    
    header('Location: ?p=inicio');
}
?>
    <?php
    $listaInstituciones = [];
    $sentenciaSQL = $conexion->prepare("SELECT * FROM `instituciones`");
    $sentenciaSQL->execute();
    $listaInstituciones = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
    include('./functions/cerrarsesion.php');
    ?>
    <hr class="mt-0" style="border:2ch solid rgba(125, 125, 125, 1); opacity: 1;">
    <div class="container" style="min-height: 75vh;">

    <div class="col-2 mb-5">
        <form method="POST">
          <button name="eliminar" value="eliminar" type="submit" class="btn btn-block" style="background-color: #e0e0e0;  color: rgba(77, 74, 74, 1);width: 100%;">
            <i class="fas fa-check"></i> Administrador
            <image src="./assets/image/logout.png" class="img-fluid" width="10%" height="10%" />
          </button>
        </form>

      </div>
        <div class="row d-flex align-items-center">
            
            <div class="col-6">
                <img src="./assets/image/logo-inet.png" class="img-fluid">
            </div>
            <div class="col-2 d-flex justify-content-end align-items-center" style="height: 6ch;">
                <a href='?t=administrador&p=listadoETP' class="btn shadow-sm" style="height: 80%;width: 80% ;background-color: #e0e0e0;  color: light-grey;">
                    <i class="fas fa-check"></i> Instituciones
                </a>
            </div>
            <div class="col-2 d-flex justify-content-end align-items-center" style="height: 6ch;">
                <a href='?t=administrador&p=listadoDocente' class="btn shadow-sm" style="height: 80%;width: 80% ;background-color: rgba(19, 140, 232, 1);  color: white;">
                    <i class="fas fa-check"></i> Docentes
                </a>
            </div>
            <div class="col-2 d-flex justify-content-end align-items-center" style="height: 6ch;">
                <a href='?t=administrador&p=listadoCapacitaciones' class="btn shadow-sm" style="height: 80%;width: 80% ;background-color: rgba(19, 140, 232, 1);  color: white;">
                    <i class="fas fa-check"></i> Capacitaciones
                </a>
            </div>
        </div>
        <hr style="border:2ch solid rgba(12, 104, 174, 1); opacity: 1;">
        <h1 style="color: rgba(129, 129, 129, 1);">Instituciones </h1>
        <div class="col-2 d-flex justify-content-start align-items-center" style="height: 6ch;">
            <a href='?t=administrador&p=validacionETP' class="btn shadow-sm" style="background-color: rgba(19, 140, 232, 1);  color: white;">
                <i class="fas fa-check"></i> Ir a validar instituciones
            </a>
        </div>
        <ol>
            <?php
            if (!empty($listaInstituciones)) {
                foreach ($listaInstituciones as $institucion) { ?>
                    <li style="margin-bottom: 10px; font-size: 20px;" class="text-primary">
                        <a href='?t=administrador&p=detalleETP&id=<?php echo $institucion['id_institucion'] ?>' class="text-primary">
                            <?php echo $institucion['nombre_institucion'] ?>
                        </a>
                    </li>
            <?php
                }
            } else {
                echo 'No hay instituciones para validar';
            }
            ?>

        </ol>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <?php $conexion = null; ?>
</body>

</html>