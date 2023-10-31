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
                $conexion = new Conexion(); // Crea un objeto "conexion" de la clase Conexion para establecer la conexión a la base de datos.
                $opcion = $_POST['opcion']; // Obtiene la opción del formulario.
                $objeto = new Jesuita($conexion->conexion); // Crea un objeto "objeto" de la clase Jesuita y pasa la conexión como parámetro.

                // Realiza diferentes acciones según la opción seleccionada.
                switch ($opcion) {
                    case 'update':
                        if (isset($_POST['id']) && !empty($_POST['nombre']) && isset($_POST['firma'])) {
                            $id = $_POST['id'];
                            $nombre = $_POST['nombre'];
                            $firma = $_POST['firma'];
                            $objeto->actualizar($id, $nombre, $firma); // Llama al método 'actualizar' de la clase Jesuita.
                        } else {
                            // Muestra un mensaje de error si faltan campos para la actualización.
                            echo "No se ha podido modificar el jesuita porque falta un campo";
                            echo "<br>";
                            echo "<br>";
                            echo "<a href='../../vistas/crud_jesuita.html'>Volver</a>";
                        }
                        break;
                    case 'delete':
                        if (isset($_POST['si'])) {
                            if (isset($_POST['id'])) {
                                $id = $_POST['id'];
                                $objeto->eliminar($id); // Llama al método 'eliminar' de la clase Jesuita.
                            } else {
                                // Muestra un mensaje de error si falta el campo 'id' para la eliminación.
                                echo "No se ha podido borrar el jesuita porque falta un campo";
                                echo "<br>";
                                echo "<br>";
                                echo "<a href='../../vistas/crud_jesuita.html'>Volver</a>";
                            }
                        } else {
                            // Muestra un mensaje si no se confirmó la eliminación ('si' no está definido en el formulario).
                            echo "No se borró al jesuita";
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
    