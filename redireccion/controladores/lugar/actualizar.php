<?php
    include '../../conexion/conexiondb.php'; // Incluye el archivo de conexión a la base de datos.
    include 'lugar.php'; // Incluye el archivo que define la clase Lugar.

    $conexion = new Conexion(); // Crea un objeto de la clase Conexion para establecer la conexión a la base de datos.
    $objeto = new Lugar($conexion->conexion); // Crea un objeto de la clase Lugar y pasa la conexión como parámetro.

    if (!empty($_GET['ip']) && !empty($_GET['lugar']) && !empty($_GET['desc'])) {
        // Verifica si los campos necesarios no están vacíos.
        $ip = $_GET['ip'];
        $lugar = $_GET['lugar'];
        $descripcion = $_GET['desc'];
        $objeto->actualizar($ip, $lugar, $descripcion);
    } else {
        // Muestra un mensaje de error si falta algún campo.
        echo "No se ha podido modificar el lugar porque falta un campo";
        echo "<br>";
        echo "<br>";
        echo "<a href='../../vistas/crud_lugar.html'>Volver</a>";
    }
?>