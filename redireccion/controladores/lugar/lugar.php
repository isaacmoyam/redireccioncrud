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
        // Definición de la clase Lugar
        class Lugar {
            
            private $conexion;

            // Constructor de la clase que recibe una conexión a la base de datos
            public function __construct($conexion) {
                $this->conexion = $conexion;
            }

            // Función para listar todos los lugares en una tabla
            public function listar() {
                $sql = "SELECT * FROM lugar";
                $resultado = $this->conexion->query($sql);
                if ($resultado->num_rows > 0) {
                    echo "<table border='2px'>";
                    echo "<tr>";
                    echo "<th>IP</th>";
                    echo "<th>LUGAR</th>";
                    echo "<th>DESCRIPCION</th>";
                    echo "<th></th>";
                    echo "</tr>";
                    while ($fila = $resultado->fetch_assoc()){
                        echo "<tr>";
                        $ip = $fila['ip'];
                        $lugar = $fila['lugar'];
                        $desc = $fila['descripcion'];
                        echo "<td>".$ip."</td>";
                        echo "<td>".$lugar."</td>";
                        echo "<td>".$desc."</td>";
                        echo "<td><a href='lugar_procesar_formulario.php?opcion=delete&ip=$ip'>🗑</a><a href='lugar_procesar_formulario.php?opcion=update&ip=$ip'>✍</a></td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "<br>";
                    echo "<br>";
                    echo "<a href='../../vistas/crud_lugar.html'>Volver</a>";
                } else {
                    echo "No se encontraron resultados.";
                    echo "<br>";
                    echo "<br>";
                    echo "<a href='../../vistas/crud_lugar.html'>Volver</a>";
                }
                $resultado->close();
            }

            // Función para consultar y mostrar un lugar específico para su actualización
            public function consultar($ip) {
                $sql = "SELECT * FROM lugar where ip = '$ip'";
                $resultado = $this->conexion->query($sql);
                if ($resultado->num_rows > 0) {
                    $fila = $resultado->fetch_assoc();
                    $lugar = $fila['lugar'];
                    $descripcion = $fila['descripcion'];
                    echo '<br><form method="GET" action="procesos.php">';
                    echo '<label for="nombre">Lugar:</label>';
                    echo '<input type="text" name="lugar" value="'.$lugar.'"><br>';
                    echo '<label for="firma">Descripción:</label>';
                    echo '<input type="text" name="desc" value="'.$descripcion.'"><br>';
                    echo '<input type="hidden" name="opcion" value="update"><br><br>';
                    echo '<input type="hidden" name="ip" value="'.$ip.'"><br>';
                    echo '<input type="submit">';
                    echo '</form>';
                } else {
                    echo "No se encontraron resultados.";
                    echo "<br>";
                    echo "<br>";
                    echo "<a href='../../vistas/crud_lugar.html'>Volver</a>";
                }
                $resultado->close();
            }

            // Función para crear un nuevo lugar
            public function crear($ip, $lugar, $descripcion) {
                $sql = "INSERT INTO lugar (ip, lugar, descripcion) VALUES ('$ip','$lugar', '$descripcion')";
                $this->conexion->query($sql);
                echo "El lugar ".$lugar." ha sido añadido correctamente";
                echo "<br>";
                echo "<br>";
                echo "<a href='../../vistas/crud_lugar.html'>Volver</a>";
            }

            // Función para actualizar un lugar existente
            public function actualizar($ip, $lugar, $descripcion) {
                $sql = "SELECT * FROM lugar where ip = '$ip'";
                $resultado = $this->conexion->query($sql);
                if ($resultado->num_rows > 0) {
                    $sql = "UPDATE lugar SET lugar = '$lugar', descripcion = '$descripcion' WHERE ip = '$ip'";
                    $this->conexion->query($sql);
                    echo "El lugar ".$lugar." ha sido actualizado correctamente";
                    echo "<br>";
                    echo "<br>";
                    echo "<a href='../../vistas/crud_lugar.html'>Volver</a>";
                } else {
                    echo "No puedes actualizar un lugar que no existe";
                    echo "<br>";
                    echo "<br>";
                    echo "<a href='../../vistas/crud_lugar.html'>Volver</a>";
                }
            }

            // Función para eliminar un lugar
            public function eliminar($ip) {
                $sql = "SELECT * FROM lugar where ip = '$ip'";
                $resultado = $this->conexion->query($sql);
                if ($resultado->num_rows > 0) {
                    $sql = "DELETE FROM lugar WHERE ip = '$ip'";
                    $this->conexion->query($sql);
                    echo "El lugar ha sido borrado correctamente";
                    echo "<br>";
                    echo "<br>";
                    echo "<a href='../../vistas/crud_lugar.html'>Volver</a>";
                } else {
                    echo "No puedes borrar un lugar que no existe";
                    echo "<br>";
                    echo "<br>";
                    echo "<a href='../../vistas/crud_lugar.html'>Volver</a>";
                }
            }
        }
        echo "</body>";
        echo "</html>";
    ?>