<?php
function decodificarPreguntaInstitucion($pregunta)
{
    switch ($pregunta) {
        case 0:
            return "respuesta_realizacion";
        case 1:
            return "respuesta_aplicacion";
        case 2:
            return "respuesta_continuar";
        case 3:
            return "respuesta_replica";
    }
}
function obtenerValoracionesInstitucion($pregunta)
{
    try {
        include('./config/db-connection.php');
        // Consulta SQL para contar la cantidad de cada valoración
        $sql = "SELECT " . decodificarPreguntaInstitucion($pregunta) . " AS Valoracion, COUNT(*) AS Cantidad 
         FROM respuestas_institucion
         GROUP BY " . decodificarPreguntaInstitucion($pregunta);
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