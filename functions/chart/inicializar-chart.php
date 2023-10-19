<?php
include('dibujo-chart-capacitacion-docente.php');
include('chart-capacitacion-docente.php');
$data = obtenerValoracionesDocente(0);
dibujarGrafico($data, '¿Cree que lo visto en la capacitación puede contribuir a sus prácticas docentes?', 'donutchart');
$data = obtenerValoracionesDocente(1);
dibujarGrafico($data, '¿Considera que el material visto fue de calidad y suficiente?', 'donutchart1');
$data = obtenerValoracionesDocente(2);
dibujarGrafico($data, '¿Será multiplicador de lo visto en la capacitación, le sirvió para serlo?', 'donutchart2');
$data = obtenerValoracionesDocente(3);
dibujarGrafico($data, '¿Se sintió acompañado/a por el capacitador/a?', 'donutchart3');
?>