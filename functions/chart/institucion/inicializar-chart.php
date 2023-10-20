<?php
include('functions\chart\dibujo-chart-capacitacion-docente.php');
include('chart-instituciones.php');
$data = obtenerValoracionesInstitucion(0);
dibujarGrafico($data, '¿Considera que las/los docentes que realizaron la capacitación fueron buenos replicadores?', 'donutchart');
$data = obtenerValoracionesInstitucion(1);
dibujarGrafico($data, '¿Considera que las/los docentes aplicaron lo visto, generando un impacto pedagógico?', 'donutchart1');
$data = obtenerValoracionesInstitucion(2);
dibujarGrafico($data, '¿Considera que debe continuar la capacitación recibida en la especialidad elegida?', 'donutchart2');
$data = obtenerValoracionesInstitucion(3);
dibujarGrafico($data, '¿Su institución formaría parte de réplica para otras,en base a los docentes que considere aptos?', 'donutchart3');
?>