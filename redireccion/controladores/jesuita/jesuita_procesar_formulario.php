<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CRUD Jesuitas</title>
        <link rel="stylesheet" href="../../css/style.css">   
    </head>
    <body>
    <?php
        include '../../conexion/conexiondb.php'; // Incluye el archivo de conexión a la base de datos.
        include 'jesuita.php'; // Incluye el archivo que define la clase Jesuita.

        try {
            // Verifica si se ha enviado un formulario con la opción (acción) deseada.
            if (isset($_POST['opcion'])) {
                $conexion = new Conexion(); // Crea un objeto de la clase Conexion para establecer la conexión a la base de datos.
                $opcion = $_POST['opcion']; // Obtiene la opción (acción) del formulario.
                $objeto = new Jesuita($conexion->conexion); // Crea un objeto de la clase Jesuita y pasa la conexión como parámetro.

                // Realiza diferentes acciones según la opción seleccionada.
                switch ($opcion) {
                    case 'insert':
                        if (isset($_POST['id']) && !empty($_POST['nombre']) && isset($_POST['firma'])) {
                            $id = $_POST['id'];
                            $nombre = $_POST['nombre'];
                            $firma = $_POST['firma'];
                            try {
                                $objeto->crear($id, $nombre, $firma); // Llama al método 'crear' de la clase Jesuita para añadir una fila.
                            } catch (mysqli_sql_exception $e) {
                                // Muestra un mensaje de error si no se puede insertar el jesuita (por duplicación o campos faltantes).
                                echo "No se pudo insertar al jesuita porque está repetido o el número de puesto está vacío";
                                echo "<br>";
                                echo "<br>";
                                echo "<a href='../../vistas/crud_jesuita.html'>Volver</a>";
                            }
                        } else {
                            // Muestra un mensaje de error si faltan campos para la inserción.
                            echo "No se ha podido añadir el jesuita porque falta un campo";
                            echo "<br>";
                            echo "<br>";
                            echo "<a href='../../vistas/crud_jesuita.html'>Volver</a>";
                        }
                        break;
                    case 'update':
                        if (isset($_POST['id'])) {
                            $id = $_POST['id'];
                            $objeto->consultar($id); // Llama al método 'consultar' de la clase Jesuita para obtener detalles del jesuita.
                        } else {
                            // Muestra un mensaje de error si falta el campo 'id' para la actualización.
                            echo "No se ha podido modificar el jesuita porque falta un campo";
                            echo "<br>";
                            echo "<br>";
                            echo "<a href='../../vistas/crud_jesuita.html'>Volver</a>";
                        }
                        break;
                    case 'delete':
                        if (isset($_POST['id'])) {
                            $id = $_POST['id'];
                            echo "<h3>¿Seguro que quieres borrar al jesuita con número de puesto: " . $id . "?</h3>";
                            echo "<form action='jesuita_actualizar_borrar.php' method='POST'>";
                            echo "<input type='submit' name='si' value='Si'>";
                            echo "<input type='submit' name='no' value='No'>";
                            echo '<input type="hidden" name="opcion" value="delete"><br><br>';
                            echo '<input type="hidden" name="id" value="' . $id . '"><br><br>';
                            echo "</form>";
                        } else {
                            // Muestra un mensaje de error si falta el campo 'id' para la eliminación.
                            echo "No se ha podido borrar el jesuita porque falta un campo";
                            echo "<br>";
                            echo "<br>";
                            echo "<a href='../../vistas/crud_jesuita.html'>Volver</a>";
                        }
                        break;
                } 
            }
        } catch (mysqli_sql_exception $e) {
            // Muestra un mensaje de error en caso de pérdida de conexión con la base de datos.
            echo "Se perdió la conexión con la base de datos";
            echo "<br>";
            echo "<br>";
            echo "<a href='../../vistas/crud_jesuita.html'>Volver</a>";
        }
    ?>
    </body>
</html>
    