<?php
    // Incluye el archivo de configuración de la base de datos (configdb.php).
    include '../../config/configdb.php';

    // Define una clase llamada "Conexion" para realizar la conexión a la base de datos.
    class Conexion {
        // Declara una variable llamada "conexion" que contendrá la conexión a la base de datos.
        public $conexion;

        // Constructor de la clase que se ejecutará al crear un objeto.
        public function __construct() {
            /* Crea un objeto de la clase "mysqli" para establecer la conexión a la base de datos y 
            utiliza las constantes HOST, USUARIO, CONTRASENA y BBDD definidas en el archivo de configuración.*/
            $this->conexion = new mysqli(HOST, USUARIO, CONTRASENA, BBDD);

            // Cambia la codificación de caracteres a "utf8" ya que con la base de datos del hosting los caracteres especiales no los coge correctamente.
            $this->conexion->set_charset("utf8");

            // Comprueba si hubo un error en la conexión.
            if ($this->conexion->connect_error) {
                // Si hay un error, muestra un mensaje de error y termina la ejecución del programa con die().
                die("Error de conexión: " . $this->conexion->connect_error);
            }
        }
    }
?>

   