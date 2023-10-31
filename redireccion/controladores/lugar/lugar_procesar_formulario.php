<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CRUD Lugar</title>
        <link rel="stylesheet" href="../../css/style.css">    
    </head>
    <body>
    <?php
        include '../../conexion/conexiondb.php'; // Incluye el archivo de conexión a la base de datos.
        include 'lugar.php'; // Incluye el archivo que define la clase Lugar.

        if (isset($_GET['opcion'])) {
            $conexion = new Conexion(); // Crea un objeto de la clase Conexion para establecer la conexión a la base de datos.
            $opcion = $_GET['opcion']; // Obtiene la opción (acción) del formulario.
            $objeto = new Lugar($conexion->conexion); // Crea un objeto de la clase Lugar y pasa la conexión como parámetro.

            switch ($opcion) {
                case 'insert':
                    if (!empty($_GET['ip']) && !empty($_GET['lugar']) && !empty($_GET['desc'])) {
                        // Verifica si los campos necesarios no están vacíos.
                        $ip = $_GET['ip'];
                        $lugar = $_GET['lugar'];
                        $descripcion = $_GET['desc'];
                        try {
                            $objeto->crear($ip, $lugar, $descripcion); // El objeto llama al metodo crear() para insertar un nuevo lugar en la base de datos.
                        } catch (mysqli_sql_exception $e) {
                            // Muestra un mensaje de error si no se puede insertar el lugar (puede ser debido a duplicados).
                            echo "No se pudo insertar el lugar porque está repetido";
                            echo "<br>";
                            echo "<br>";
                            echo "<a href='../../vistas/crud_lugar.html'>Volver</a>";
                        }
                    } else {
                        // Muestra un mensaje de error si falta algún campo en el formulario.
                        echo "No se ha podido añadir el lugar porque falta un campo";
                        echo "<br>";
                        echo "<br>";
                        echo "<a href='../../vistas/crud_lugar.html'>Volver</a>";
                    }
                    break;
                case 'update':
                    if (!empty($_GET['ip'])) {
                        // Verifica si el campo "ip" no está vacío.
                        $ip = $_GET['ip'];
                        $objeto_actualizar = $objeto->consultar($ip); // Crea un objeto para consultar y actualizar un lugar.
                    } else {
                        // Muestra un mensaje de error si falta el campo "ip" en el formulario.
                        echo "No se ha podido modificar el lugar porque falta un campo";
                        echo "<br>";
                        echo "<br>";
                        echo "<a href='../../vistas/crud_lugar.html'>Volver</a>";
                    }
                    break;
                case 'delete':
                    if (!empty($_GET['ip'])) {
                        // Verifica si el campo "ip" no está vacío.
                        $ip = $_GET['ip'];
                        echo "<h3>¿Seguro que quieres borrar al lugar con ip: " . $ip . "?</h3>";
                        echo "<a href='procesos.php?si=1&opcion=$opcion&ip=$ip'>Si</a><a href='procesos.php?si=2&opcion=$opcion'>No</a>";
                    } else {
                        // Muestra un mensaje de error si falta el campo "ip" en el formulario.
                        echo "No se ha podido borrar el lugar porque falta un campo";
                        echo "<br>";
                        echo "<br>";
                        echo "<a href='../../vistas/crud_lugar.html'>Volver</a>";
                    }
                    break;
            }
        }
    ?>
    </body>
</html>
   
    