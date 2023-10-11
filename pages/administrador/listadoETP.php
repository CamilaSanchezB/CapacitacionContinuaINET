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
    $sentenciaSQL = $conexion->prepare("SELECT * FROM `instituciones` WHERE `estado_validacion_institucion` = '1'");
    $sentenciaSQL->execute();
    $listaInstituciones = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
    include('./functions/cerrarsesion.php');
    ?>
    <?php require_once('./template/header-administrador.php')?>
    <div class="container" style="min-height: 50vh;">

    
        
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
        </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <?php $conexion = null; ?>
</body>

</html>