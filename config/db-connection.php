<?php
$host = "localhost";
$bd = "capacitacion_continua";
$usuario = "root";
$contrasena = "";
try {
    $conexion = new PDO("mysql:host=$host; dbname=$bd;", $usuario, $contrasena);
} catch (Exception $e) {
    echo $e->getMessage();
}

?>
