<?php

$server = "localhost:336";
$username = "root";
$password = "";
$database = "riocode";

$conexion = new mysqli($server, $username, $password, $database);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

echo "Conexión exitosa";

?>
