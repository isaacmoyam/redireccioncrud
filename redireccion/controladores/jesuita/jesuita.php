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
        class Jesuita {
            
            private $conexion;

            // Constructor de la clase que recibe una conexión a la base de datos como parámetro.
            public function __construct($conexion) {
                $this->conexion = $conexion;
            }

            /* 
            public function listar() {
                // Método para listar todos los registros de la tabla "jesuita".
                $sql = "SELECT * FROM jesuita";
                $resultado = $this->conexion->query($sql);
                if ($resultado->num_rows > 0) {
                    echo "<table border='2px'>";
                    echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>NOMBRE</th>";
                    echo "<th>FIRMA</th>";
                    echo "</tr>";
                    while ($fila = $resultado->fetch_assoc()){
                        echo "<tr>";
                        $id = $fila['idJesuita'];
                        $nombre = $fila['nombre'];
                        $firma = $fila['firma'];
                        echo "<td>".$id."</td>";
                        echo "<td>".$nombre."</td>";
                        echo "<td>".$firma."</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }else{
                    echo "No se encontraron resultados.";
                    echo "<br>";
                    echo "<br>";
                    echo "<a href='../../vistas/crud_jesuita.html'>Volver</a>";
                }
                $resultado->close();
            }
            */

            public function consultar($id) {
                // Método para consultar un registro específico por su ID.
                $sql = "SELECT * FROM jesuita where idJesuita = $id";
                $resultado = $this->conexion->query($sql);
                if ($resultado->num_rows > 0) {
                    $fila = $resultado->fetch_assoc();
                    $nombre = $fila['nombre'];
                    $firma = $fila['firma'];
                    echo '<br><form method="POST" action="jesuita_actualizar_borrar.php">';
                    echo '<label for="nombre">Nombre:</label>';
                    echo '<input type="text" name="nombre" value="'.$nombre.'"><br>';
                    echo '<label for="firma">Firma:</label>';
                    echo '<input type="text" name="firma" value="'.$firma.'"><br>';
                    echo '<input type="hidden" name="opcion" value="update"><br><br>';
                    echo '<input type="hidden" name="id" value="'.$id.'"><br><br>';
                    echo '<input type="submit">';
                    echo '</form>';
                }else{
                    echo "No se encontraron resultados.";
                    echo "<br>";
                    echo "<br>";
                    echo "<a href='../../vistas/crud_jesuita.html'>Volver</a>";
                }
                $resultado->close();
            }

            public function crear($id,$nombre, $firma) {
                // Método para agregar un nuevo registro.
                $sql = "INSERT INTO jesuita (idJesuita, nombre, firma) VALUES ('$id','$nombre', '$firma')";
                $this->conexion->query($sql);
                echo "El jesuita ".$nombre." ha sido añadido correctamente"; 
                echo "<br>";
                echo "<br>";
                echo "<a href='../../vistas/crud_jesuita.html'>Volver</a>";
            }

            public function actualizar($id, $nombre, $firma) {
                // Método para actualizar un registro existente por su ID.
                $sql = "SELECT * FROM jesuita where idJesuita = $id";
                $resultado = $this->conexion->query($sql);
                if ($resultado->num_rows > 0) {
                    $sql = "UPDATE jesuita SET nombre = '$nombre', firma = '$firma' WHERE idJesuita = $id";
                    $this->conexion->query($sql);
                    echo "El jesuita ".$nombre." ha sido actualizado correctamente";
                    echo "<br>";
                    echo "<br>";
                    echo "<a href='../../vistas/crud_jesuita.html'>Volver</a>";
                } else {
                    echo "No puedes actualizar un jesuita que no existe";
                    echo "<br>";
                    echo "<br>";
                    echo "<a href='../../vistas/crud_jesuita.html'>Volver</a>";
                }
            }

            public function eliminar($id) {
                // Método para eliminar un registro por su ID.
                $sql = "SELECT * FROM jesuita where idJesuita = $id";
                $resultado = $this->conexion->query($sql);
                if ($resultado->num_rows > 0) {
                    $sql = "DELETE FROM jesuita WHERE idJesuita = $id";
                    $this->conexion->query($sql);
                    echo "El jesuita ha sido borrado correctamente";
                    echo "<br>";
                    echo "<br>";
                    echo "<a href='../../vistas/crud_jesuita.html'>Volver</a>";
                } else {
                    echo "No puedes borrar un jesuita que no existe";
                    echo "<br>";
                    echo "<br>";
                    echo "<a href='../../vistas/crud_jesuita.html'>Volver</a>";
                }
            }
        }
        echo "</body>";
        echo "</html>";
    ?> 