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
            $conexion = new Conexion(); // Crea un objeto de la clase Conexion para establecer la conexión a la base de datos.
            $objeto = new Jesuita($conexion->conexion); // Crea un objeto de la clase Jesuita y pasa la conexión como parámetro.

            // Verifica si se ha enviado un parámetro de nombre 'insert' para mostrar el formulario de inserción.
            if (isset($_GET['insert'])) {
                echo '<br><form method="POST" action="jesuita_procesar_formulario.php">';
                echo '<label for="id">Número de puesto:</label>';
                echo '<input type="number" min="0" name="id"<br>';
                echo '<label for="nombre">Nombre:</label>';
                echo '<input type="text" name="nombre"<br>';
                echo '<label for="firma">Firma:</label>';
                echo '<input type="text" name="firma"><br>';
                echo '<input type="hidden" value="insert" name="opcion"><br><br>';
                echo '<input type="submit">';
                echo '</form>';
            }
        
            /*if(isset($_GET['select'])){
                $objeto->listar();
            }*/
        
            // Verifica si se ha enviado un parámetro de nombre 'update' para mostrar el formulario de actualización.
            if (isset($_GET['update'])) {
                echo '<br><form method="POST" action="jesuita_procesar_formulario.php">';
                echo '<label for "id">Número de puesto:</label>';
                echo '<input type="number" min="0" name="id"<br>';
                echo '<input type="hidden" value="update" name="opcion"><br><br>';
                echo '<input type="submit">';
                echo '</form>';
            }
        
            // Verifica si se ha enviado un parámetro de nombre 'delete' para mostrar el formulario de eliminación.
            if (isset($_GET['delete'])) {
                echo '<br><form method="POST" action="jesuita_procesar_formulario.php">';
                echo '<label for="id">Número de puesto:</label>';
                echo '<input type="number" min="0" name="id"<br>';
                echo '<input type="hidden" value="delete" name="opcion"><br><br>';
                echo '<input type="submit">';
                echo '</form>';
            }
        } catch (mysqli_sql_exception $e) {
            // Muestra un mensaje de error en caso de pérdida de conexión con la base de datos.
            echo "No se pudo conectar con la base de datos";
            echo "<br>";
            echo "<br>";
            echo "<a href='../../vistas/crud_jesuita.html'>Volver</a>";
        }
    ?>
    </body>
</html>
    