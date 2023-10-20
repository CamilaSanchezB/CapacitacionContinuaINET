<?php 
function haPasadoFecha($datetime) {
    // Convertir el datetime proporcionado a un objeto DateTime
    $fechaHora = new DateTime($datetime);
    
    // Obtener la fecha y hora actual
    $fechaActual = new DateTime();
    
    return $fechaHora < $fechaActual;
}
?>