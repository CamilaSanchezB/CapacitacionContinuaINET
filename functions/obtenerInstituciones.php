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
    if (isset($_GET['id_localidad'])) {
        echo $_GET['id_localidad'];
        $sentenciaSQL = $conexion->prepare("SELECT * FROM `instituciones` WHERE `id_localidad` = :id_localidad");
        $sentenciaSQL->bindParam(':id_localidad', $_GET['id_localidad']);
        $sentenciaSQL->execute();
        $instituciones = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
        var_dump($instituciones);
    } 
} catch (PDOException $e) {
    echo json_encode(array('error' => $e->getMessage()));
}

if(!empty($instituciones)){
    echo '<option value="Institucion" selected>Institución</option>';
    foreach ($instituciones as $institucion){
        echo '<option value="'.$institucion['id_institucion'].'">'.$institucion['nombre_institucion'].' </option>';
    }
}

?>
