<?php

require 'conexion.php';

$consulta = "SELECT serie, numero, comprobante, fecha FROM comprobantes ORDER by fecha";

if ($resultado = $mysqli->query($consulta)) {

    /* obtener un array asociativo */
    while ($fila = $resultado->fetch_assoc()) {
        printf ("%s %s - %s - %s\n", $fila["serie"], $fila["numero"],$fila["comprobante"], $fila["fecha"] );
        echo "<br>";
    }

    /* liberar el conjunto de resultados */
    $resultado->free();
}

/* cerrar la conexión */
$mysqli->close();
?>