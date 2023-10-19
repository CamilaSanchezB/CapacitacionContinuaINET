<?php
function decodificarPreguntaDocente($pregunta)
{
    switch ($pregunta) {
        case 0:
            return "respuesta_contribucion";
        case 1:
            return "respuesta_calidad";
        case 2:
            return "respuesta_multiplicador";
        case 3:
            return "respuesta_acompanamiento";
    }
}
function obtenerValoracionesDocente($pregunta)
{
    try {
        include('./config/db-connection.php');
        $id = $_GET['id'];
        // Consulta SQL para contar la cantidad de cada valoración
        $sql = "SELECT " . decodificarPreguntaDocente($pregunta) . " AS Valoracion, COUNT(*) AS Cantidad 
         FROM respuestas_docentes 
         INNER JOIN detalle_capacitaciones 
         ON respuestas_docentes.id_detalle_capacitacion = detalle_capacitaciones.id_detalle_capacitacion 
         WHERE id_capacitacion = " . $id . " 
         GROUP BY " . decodificarPreguntaDocente($pregunta);
        $sql = $conexion->prepare($sql);
        $sql->execute();

        // Crear un array con el formato deseado
        $data = array();
        $data[] = ['Valoracion', 'Cantidad'];

        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $data[] = [$row['Valoracion'], (int) $row['Cantidad']];
        }

        // Cerrar la conexión a la base de datos
        $conexion = null;
        return $data;
        // Imprimir el array como JSON
        //var_dump($data[0][1]);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>