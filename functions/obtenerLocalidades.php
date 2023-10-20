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
try {
    if (isset($_GET['id_provincia'])) {
        $sentenciaSQL = $conexion->prepare("SELECT * FROM `localidades` WHERE `id_provincia` = :id_provincia");
        $sentenciaSQL->bindParam(':id_provincia', $_GET['id_provincia']);
        $sentenciaSQL->execute();
        $localidades = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

    } 
} catch (PDOException $e) {
    echo json_encode(array('error' => $e->getMessage()));
}

if(!empty($localidades)){
    echo '<option disabled selected value="Localidad"> Localidad </option>';
    foreach ($localidades as $localidad){
        echo '<option value="'.$localidad['id_localidad'].'">'.$localidad['nombre_localidad'].' </option>';
    }
}

?>
