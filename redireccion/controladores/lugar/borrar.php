<?php
    include '../../conexion/conexiondb.php'; // Incluye el archivo de conexión a la base de datos.
    include 'lugar.php'; // Incluye el archivo que define la clase Lugar.

    $conexion = new Conexion(); // Crea un objeto de la clase Conexion para establecer la conexión a la base de datos.
    $objeto = new Lugar($conexion->conexion); // Crea un objeto de la clase Lugar y pasa la conexión como parámetro.

    if ($_GET['si'] == 1) {
        if (!empty($_GET['ip'])) {
            // Verifica si se ha confirmado la eliminación y el campo 'ip' no está vacío.
            $ip = $_GET['ip'];
            $objeto->eliminar($ip);
        } else {
            // Muestra un mensaje de error si falta algún campo.
            echo "No se ha podido borrar el lugar porque falta un campo";
            echo "<br>";
            echo "<br>";
            echo "<a href='../../vistas/crud_lugar.html'>Volver</a>";
        }
    }
    
    if($_GET['si'] == 2){
        // Muestra un mensaje si no se confirma la eliminación.
        echo "No se borró el lugar";
        echo "<br>";
        echo "<br>";
        echo "<a href='../../vistas/crud_lugar.html'>Volver</a>";
    }
?>